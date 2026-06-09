document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".limit-words");

  elements.forEach(function (el) {
    const words = el.textContent.trim().split(/\s+/);
    if (words.length > 35) {
      el.textContent = words.slice(0, 35).join(" ") + "...";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".limit-word6");

  elements.forEach(function (el) {
    const words = el.textContent.trim().split(/\s+/);
    if (words.length > 6) {
      el.textContent = words.slice(0, 6).join(" ") + "...";
    }
  });
});