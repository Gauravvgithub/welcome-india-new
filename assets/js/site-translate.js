(function () {
  "use strict";

  var storageKey = "welcomeIndiaTranslateLanguage";
  var cookieName = "googtrans";
  var defaultLanguage = "en";
  var customSelectId = "site-language-select";
  var confirmModalId = "languageConfirmModal";
  var pendingLanguage = null;
  var lastFocusedElement = null;

  function getStoredLanguage() {
    try {
      return localStorage.getItem(storageKey) || defaultLanguage;
    } catch (error) {
      return defaultLanguage;
    }
  }

  function storeLanguage(language) {
    try {
      localStorage.setItem(storageKey, language || defaultLanguage);
    } catch (error) {
      // localStorage can be unavailable in strict browser privacy modes.
    }
  }

  function setTranslateCookie(language) {
    var cookieValue = "/" + defaultLanguage + "/" + language;
    var expires = new Date();
    expires.setFullYear(expires.getFullYear() + 1);

    document.cookie =
      cookieName + "=" + cookieValue + ";expires=" + expires.toUTCString() + ";path=/";
  }

  function clearTranslateCookie() {
    document.cookie = cookieName + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
  }

  function getCustomSelect() {
    return document.getElementById(customSelectId);
  }

  function setCustomSelectValue(language) {
    var customSelect = getCustomSelect();

    if (customSelect && customSelect.value !== language) {
      customSelect.value = language;
    }
  }

  function getGoogleSelect() {
    return document.querySelector(".goog-te-combo");
  }

  function getLanguageName(language) {
    var customSelect = getCustomSelect();
    var selectedOption = customSelect
      ? customSelect.querySelector('option[value="' + language + '"]')
      : null;

    return selectedOption ? selectedOption.textContent : language;
  }

  function getConfirmModal() {
    return document.getElementById(confirmModalId);
  }

  function closeLanguageConfirm() {
    var modal = getConfirmModal();

    pendingLanguage = null;

    if (!modal) {
      return;
    }

    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("language-confirm-open");

    if (lastFocusedElement && typeof lastFocusedElement.focus === "function") {
      lastFocusedElement.focus();
    }
  }

  function openLanguageConfirm(language) {
    var modal = getConfirmModal();
    var message = modal ? modal.querySelector("#languageConfirmMessage") : null;
    var applyButton = modal ? modal.querySelector("[data-language-confirm-apply]") : null;
    var languageName = getLanguageName(language);

    if (!modal) {
      applyLanguage(language);
      return;
    }

    pendingLanguage = language;
    lastFocusedElement = document.activeElement;

    if (message) {
      message.textContent =
        'Are you sure you want to change the website language to "' + languageName + '"?';
    }

    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("language-confirm-open");

    if (applyButton) {
      applyButton.focus();
    }
  }

  function bindLanguageConfirm() {
    var modal = getConfirmModal();

    if (!modal || modal.dataset.translateConfirmBound === "true") {
      return;
    }

    modal.addEventListener("click", function (event) {
      if (
        event.target === modal ||
        event.target.closest("[data-language-confirm-cancel]")
      ) {
        setCustomSelectValue(getStoredLanguage());
        closeLanguageConfirm();
      }

      if (event.target.closest("[data-language-confirm-apply]")) {
        var languageToApply = pendingLanguage;

        closeLanguageConfirm();

        if (languageToApply) {
          applyLanguage(languageToApply);
        }
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && modal.classList.contains("is-open")) {
        setCustomSelectValue(getStoredLanguage());
        closeLanguageConfirm();
      }
    });

    modal.dataset.translateConfirmBound = "true";
  }

  function applyStoredLanguage() {
    var language = getStoredLanguage();

    setCustomSelectValue(language);

    if (language && language !== defaultLanguage) {
      setTranslateCookie(language);
    }
  }

  function applyLanguage(language) {
    var selectedLanguage = language || defaultLanguage;

    storeLanguage(selectedLanguage);
    setCustomSelectValue(selectedLanguage);

    if (selectedLanguage === defaultLanguage) {
      clearTranslateCookie();
    } else {
      setTranslateCookie(selectedLanguage);
    }

    window.location.reload();
  }

  function bindCustomSelect() {
    var customSelect = getCustomSelect();

    if (!customSelect || customSelect.dataset.translateBound === "true") {
      return;
    }

    customSelect.value = getStoredLanguage();
    customSelect.addEventListener("change", function () {
      var selectedLanguage = customSelect.value;
      var currentLanguage = getStoredLanguage();

      if (selectedLanguage === currentLanguage) {
        return;
      }

      setCustomSelectValue(currentLanguage);
      openLanguageConfirm(selectedLanguage);
    });
    customSelect.dataset.translateBound = "true";
  }

  function syncWidgetSelect() {
    var select = getGoogleSelect();
    var storedLanguage = getStoredLanguage();

    if (!select) {
      return false;
    }

    select.setAttribute("aria-label", "Select language");
    select.classList.add("notranslate");
    select.setAttribute("translate", "no");

    if (storedLanguage && storedLanguage !== defaultLanguage && select.value !== storedLanguage) {
      select.value = storedLanguage;
      select.dispatchEvent(new Event("change"));
    }

    if (select.dataset.translateBound === "true") {
      return true;
    }

    select.addEventListener("change", function () {
      var selectedLanguage = select.value || defaultLanguage;

      storeLanguage(selectedLanguage);
      setCustomSelectValue(selectedLanguage);

      if (selectedLanguage === defaultLanguage) {
        clearTranslateCookie();
      } else {
        setTranslateCookie(selectedLanguage);
      }
    });
    select.dataset.translateBound = "true";

    return true;
  }

  function waitForWidgetSelect() {
    if (syncWidgetSelect()) {
      return;
    }

    var observer = new MutationObserver(function () {
      if (syncWidgetSelect()) {
        observer.disconnect();
      }
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  }

  applyStoredLanguage();
  bindCustomSelect();
  bindLanguageConfirm();

  document.addEventListener("DOMContentLoaded", function () {
    applyStoredLanguage();
    bindCustomSelect();
    bindLanguageConfirm();
  });

  window.googleTranslateElementInit = function () {
    if (!document.getElementById("google_translate_element")) {
      return;
    }

    new google.translate.TranslateElement(
      {
        pageLanguage: defaultLanguage,
        includedLanguages:
          "en,hi,bn,gu,kn,ml,mr,pa,ta,te,ur,ar,de,es,fr,it,ja,ko,ru,zh-CN",
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false,
      },
      "google_translate_element"
    );

    waitForWidgetSelect();
  };
})();
