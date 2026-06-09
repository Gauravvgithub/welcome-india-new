(function () {
  function injectEnquiryStyles() {
    if (document.getElementById("globalEnquiryStyles")) return;

    const style = document.createElement("style");
    style.id = "globalEnquiryStyles";
    style.textContent = `
      #stickyEnquiryBtn {
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 100000;
        border: 0;
        border-radius: 12px 0 0 12px;
        background: linear-gradient(135deg, #006a72, #0a9ea8);
        color: #fff;
        padding: 14px 10px;
        min-width: 48px;
        min-height: 132px;
        box-shadow: 0 10px 28px rgba(0, 106, 114, 0.35);
        cursor: pointer;
        font-family: Arial, sans-serif;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0;
        writing-mode: vertical-rl;
        text-orientation: mixed;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
      }

      #stickyEnquiryBtn:hover,
      #stickyEnquiryBtn:focus {
        background: linear-gradient(135deg, #005a61, #088992);
        outline: none;
      }

      #enquiryModal * {
        box-sizing: border-box;
      }

      .enq-label {
        display: block;
        font-family: Arial, sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 6px;
      }

      .enq-input {
        width: 100%;
        border: 1.5px solid #c6eef0;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 14px;
        color: #374151;
        background: #f0fbfc;
        outline: none;
        display: block;
        transition: border-color 0.25s, box-shadow 0.25s;
        font-family: Arial, sans-serif;
        appearance: none;
      }

      .enq-input::placeholder {
        color: #9ca3af;
      }

      .enq-input:focus {
        border-color: #006a72;
        box-shadow: 0 0 0 3px rgba(0, 106, 114, 0.12);
        background: #fff;
      }

      select.enq-input {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
      }

      .enq-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
      }

      .enq-submit-btn {
        width: 100%;
        background: linear-gradient(135deg, #006a72, #0a9ea8);
        color: #fff;
        font-size: 16px;
        padding: 15px 24px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: Arial, sans-serif;
        letter-spacing: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
      }

      .enq-submit-btn:hover {
        background: linear-gradient(135deg, #005a61, #088992);
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(0, 106, 114, 0.35);
      }

      #enquiryMobileFooter {
        display: contents;
      }

      #enquiryFormContainer {
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
      }

      #enquiryForm {
        overflow: visible;
      }

      @media (max-width: 767px) {
        #enquiryModal {
          padding: 12px !important;
          align-items: center !important;
          justify-content: center !important;
          height: var(--enq-mobile-height, 100vh) !important;
          max-height: var(--enq-mobile-height, 100vh) !important;
          overflow: hidden !important;
          background: rgba(0, 0, 0, 0.55) !important;
        }

        #stickyEnquiryBtn {
          min-height: 112px;
          min-width: 42px;
          padding: 12px 8px;
          font-size: 13px;
        }

        .enq-row {
          grid-template-columns: 1fr;
          gap: 10px;
          margin-bottom: 10px;
        }

        .enq-label {
          font-size: 12px;
          margin-bottom: 4px;
        }

        .enq-input {
          font-size: 12px;
          padding: 8px 10px;
        }

        #enquiryBox {
          width: 95vw !important;
          max-width: 95vw !important;
          height: 90vh !important;
          height: calc(var(--enq-mobile-height, 100vh) * 0.9) !important;
          min-height: 0 !important;
          max-height: 90vh !important;
          max-height: calc(var(--enq-mobile-height, 100vh) * 0.9) !important;
          margin: 0 auto !important;
          border-radius: 14px !important;
          box-shadow: 0 16px 48px rgba(0, 0, 0, 0.25) !important;
          overflow: hidden !important;
          display: flex !important;
          flex-direction: column !important;
        }

        #enquiryBox > div:first-child {
          border-radius: 14px 14px 0 0 !important;
          min-height: 58px !important;
          flex: 0 0 auto !important;
          padding: 11px 50px 11px 15px !important;
        }

        #enquiryBox > div:first-child > div {
          gap: 10px !important;
        }

        #enquiryBox > div:first-child > div > div:first-child {
          display: flex !important;
          width: 38px !important;
          height: 38px !important;
          font-size: 16px !important;
        }

        #enquiryBox h3 {
          font-size: 19px !important;
          line-height: 1.2 !important;
        }

        #enquiryBox p {
          display: none !important;
        }

        #enquiryFormContainer {
          flex: 1 1 auto !important;
          min-height: 0 !important;
          height: 100% !important;
          display: block !important;
          overflow-y: scroll !important;
          overflow-x: hidden !important;
          -webkit-overflow-scrolling: touch !important;
          touch-action: pan-y !important;
          padding: 0 !important;
          border-radius: 0 0 14px 14px !important;
        }

        #enquiryForm {
          flex: none;
          min-height: 0;
          height: auto;
          overflow: visible;
          padding: 14px 14px 0;
          display: block;
        }

        #enquiryMobileFooter {
          display: block !important;
          position: static;
          padding: 12px 14px calc(12px + env(safe-area-inset-bottom));
          background: #fff;
          border-top: 1px solid #e4f5f6;
          box-shadow: 0 -10px 24px rgba(0, 0, 0, 0.08);
        }

        .enq-submit-btn {
          position: static;
          margin-top: 0;
          min-height: 48px;
          padding: 13px 16px;
          font-size: 14px;
          box-shadow: 0 8px 24px rgba(0, 106, 114, 0.24);
        }

        #closeEnquiryBtn {
          top: 12px !important;
          right: 12px !important;
          width: 34px !important;
          height: 34px !important;
        }

        .enq-row {
          grid-template-columns: 1fr;
          gap: 11px;
          margin-bottom: 11px;
        }

        .enq-label {
          display: block;
          font-size: 13px;
          margin-bottom: 5px;
          line-height: 1.2;
        }

        .enq-input {
          min-height: 45px;
          font-size: 14px;
          padding: 11px 13px;
          border-radius: 10px;
        }

        select.enq-input {
          padding-right: 34px;
          height: 45px;
          line-height: 1.2;
        }

        .enq-full-row {
          display: block !important;
          width: 100% !important;
          flex: 0 0 auto !important;
        }

        #enqMessage {
          min-height: 96px;
          max-height: 140px;
        }

        #enquiryForm > div {
          margin-bottom: 12px !important;
          width: 100% !important;
        }

        #enqError {
          font-size: 13px !important;
          margin-bottom: 10px !important;
        }
      }

      @media (min-width: 360px) and (max-width: 767px) {
        .enq-row {
          grid-template-columns: 1fr;
        }
      }

      @media (max-width: 359px) {
        .enq-input {
          font-size: 11px;
          padding-left: 6px;
          padding-right: 6px;
        }

        .enq-submit-btn {
          font-size: 11px;
        }
      }
    `;
    document.head.appendChild(style);
  }

  function getFormAction() {
    const base = document.querySelector("base[href]");
    if (base) {
      return new URL("submit_enquiry.php", window.location.href).pathname;
    }
    return "submit_enquiry.php";
  }

  function createStickyButton() {
    if (document.getElementById("stickyEnquiryBtn")) return;

    const button = document.createElement("button");
    button.type = "button";
    button.id = "stickyEnquiryBtn";
    button.setAttribute("aria-label", "Open enquiry form");
    button.innerHTML = '<i class="fa-solid fa-paper-plane" aria-hidden="true"></i><span>Enquiry</span>';
    document.body.appendChild(button);
  }

  function createEnquiryModal() {
    const existingModal = document.getElementById("enquiryModal");
    if (existingModal) {
      if (existingModal.getAttribute("data-global-enquiry") === "true") return;
      existingModal.remove();
    }

    const wrapper = document.createElement("div");
    wrapper.innerHTML = `
      <div id="enquiryModal" data-global-enquiry="true" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;align-items:center;justify-content:center;background:rgba(0,0,0,0.55);opacity:0;transition:opacity 0.4s;z-index:99999;overflow-y:auto;-webkit-overflow-scrolling:touch;padding:16px;">
        <div id="enquiryBox" style="background:#fff;border-radius:18px;max-width:1100px;width:min(100%,1100px);box-shadow:0 16px 48px rgba(0,0,0,0.25);transform:scale(0.92);transition:transform 0.4s;overflow:hidden;margin:0 auto;display:flex;flex-direction:column;height:calc(100vh - 32px);height:calc(100dvh - 32px);max-height:none;">
          <div style="background:linear-gradient(135deg,#006a72 0%,#0a9ea8 100%);padding:18px 28px 16px;position:relative;flex-shrink:0;border-radius:18px 18px 0 0;">
            <button type="button" id="closeEnquiryBtn" style="position:absolute;top:14px;right:14px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);border:none;color:#fff;font-size:18px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;">&times;</button>
            <div style="display:flex;align-items:center;gap:14px;">
              <div style="width:48px;height:48px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;"><i class="fa-solid fa-plane"></i></div>
              <div>
                <h3 style="margin:0;color:#fff;font-size:22px;font-weight:700;font-family:Arial,sans-serif;line-height:1.2;">Plan Your Perfect Trip</h3>
                <p style="margin:4px 0 0;color:rgba(255,255,255,0.85);font-size:13px;font-family:Arial,sans-serif;">Fill in details and we will get back to you shortly.</p>
              </div>
            </div>
          </div>
          <div id="enquiryFormContainer" style="padding:20px 28px;background:#fff;flex:1;min-height:0;overflow-y:auto;-webkit-overflow-scrolling:touch;display:flex;flex-direction:column;border-radius:0 0 18px 18px;">
            <form id="enquiryForm" method="POST" action="${getFormAction()}">
              <div class="enq-row">
                <div>
                  <label class="enq-label">Full Name <span style="color:#e53e3e;">*</span></label>
                  <input id="enqName" type="text" name="name" placeholder="Your full name" required class="enq-input" />
                </div>
                <div>
                  <label class="enq-label">Phone Number <span style="color:#e53e3e;">*</span></label>
                  <input id="enqPhone" type="tel" name="phone" placeholder="Your phone number" required pattern="[0-9]{10}" maxlength="10" class="enq-input" />
                </div>
              </div>
              <div class="enq-row">
                <div>
                  <label class="enq-label">Email Address</label>
                  <input id="enqEmail" type="email" name="email" placeholder="Your email address" maxlength="50" class="enq-input" />
                </div>
                <div>
                  <label class="enq-label">Destination</label>
                  <input id="enqDestination" type="text" name="destination" placeholder="Where do you want to go?" class="enq-input" />
                </div>
              </div>
              <div class="enq-row">
                <div>
                  <label class="enq-label">Travel Date</label>
                  <input id="enqDate" type="date" name="travel_date" class="enq-input" />
                </div>
                <div>
                  <label class="enq-label">No. of Travelers</label>
                  <select id="enqTravelers" name="travelers" class="enq-input">
                    <option value="">Select travelers</option>
                    <option value="1 Person">1 Person</option>
                    <option value="2 Persons">2 Persons</option>
                    <option value="3-5 Persons">3 - 5 Persons</option>
                    <option value="6-10 Persons">6 - 10 Persons</option>
                    <option value="10+ Persons">10+ Persons</option>
                  </select>
                </div>
              </div>
              <div class="enq-full-row" style="margin-bottom:18px;">
                <label class="enq-label">Tour Type</label>
                <select id="enqTourType" name="tour_type" class="enq-input">
                  <option value="">Select tour type</option>
                  <option value="Wildlife">Wildlife</option>
                  <option value="Hill Stations">Hill Stations</option>
                  <option value="Pilgrimage">Pilgrimage</option>
                  <option value="Heritage">Heritage</option>
                  <option value="Beach">Beach</option>
                  <option value="Honeymoon">Honeymoon</option>
                  <option value="Yoga & Wellness">Yoga &amp; Wellness</option>
                  <option value="Adventure & Trekking">Adventure &amp; Trekking</option>
                  <option value="International">International</option>
                </select>
              </div>
              <div class="enq-full-row" style="margin-bottom:16px;">
                <label class="enq-label">Your Message</label>
                <textarea id="enqMessage" name="message" rows="3" placeholder="Tell us about your dream trip..." class="enq-input" style="resize:vertical;"></textarea>
              </div>
              <div id="enqError" style="display:none;color:#e53e3e;font-size:13px;margin-bottom:14px;font-family:Arial,sans-serif;"></div>
            </form>
            <div id="enquiryMobileFooter">
              <button type="submit" form="enquiryForm" class="enq-submit-btn"><strong>Continue to Send Enquiry</strong></button>
            </div>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(wrapper.firstElementChild);
  }

  function setMobileEnquiryHeight() {
    const height = window.visualViewport ? window.visualViewport.height : window.innerHeight;
    document.documentElement.style.setProperty("--enq-mobile-height", height + "px");
  }

  function openEnquiryModal() {
    const modal = document.getElementById("enquiryModal");
    const box = document.getElementById("enquiryBox");
    const formContainer = document.getElementById("enquiryFormContainer");
    const form = document.getElementById("enquiryForm");

    if (!modal || !box) return;

    setMobileEnquiryHeight();
    document.body.style.overflow = "hidden";
    modal.style.display = "flex";
    modal.scrollTop = 0;
    if (formContainer) formContainer.scrollTop = 0;
    if (form) form.scrollTop = 0;
    setTimeout(function () {
      modal.style.opacity = "1";
      box.style.transform = "scale(1)";
    }, 10);
  }

  function closeEnquiryModal() {
    const modal = document.getElementById("enquiryModal");
    const box = document.getElementById("enquiryBox");

    if (!modal || !box) return;

    modal.style.opacity = "0";
    box.style.transform = "scale(0.92)";
    setTimeout(function () {
      modal.style.display = "none";
      document.body.style.overflow = "";
    }, 400);
  }

  function validateEnquiryForm(event) {
    const form = event.currentTarget;
    const error = document.getElementById("enqError");
    const name = document.getElementById("enqName").value.trim();
    const phone = document.getElementById("enqPhone").value.trim();
    const email = document.getElementById("enqEmail").value.trim();
    const destination = document.getElementById("enqDestination").value.trim();
    const travelers = document.getElementById("enqTravelers").value;
    const tourType = document.getElementById("enqTourType").value;
    const message = document.getElementById("enqMessage").value.trim();
    const errors = [];

    if (!name) errors.push("Name is required.");
    if (!phone) errors.push("Phone is required.");
    else if (!/^[0-9]{10}$/.test(phone)) errors.push("Phone must be exactly 10 digits.");
    if (email && email.length > 50) errors.push("Email max 50 characters.");
    else if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push("Invalid email format.");
    if (!destination) errors.push("Destination is required.");
    if (!travelers) errors.push("Please select number of travelers.");
    if (!tourType) errors.push("Please select a tour type.");
    if (message && message.length < 10) errors.push("Message must be at least 10 characters.");

    if (errors.length > 0) {
      event.preventDefault();
      error.style.display = "block";
      error.innerHTML = errors.join("<br>");
      return;
    }

    error.style.display = "none";
    form.action = getFormAction();
  }

  document.addEventListener("DOMContentLoaded", function () {
    injectEnquiryStyles();
    createStickyButton();
    createEnquiryModal();

    window.openEnquiry = openEnquiryModal;
    window.closeEnquiry = closeEnquiryModal;

    const stickyButton = document.getElementById("stickyEnquiryBtn");
    const modal = document.getElementById("enquiryModal");
    const closeButton = document.getElementById("closeEnquiryBtn");
    const form = document.getElementById("enquiryForm");

    if (stickyButton) stickyButton.addEventListener("click", openEnquiryModal);
    if (closeButton) closeButton.addEventListener("click", closeEnquiryModal);
    if (modal) {
      modal.addEventListener("click", function (event) {
        if (event.target === modal) closeEnquiryModal();
      });
    }

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") closeEnquiryModal();
    });

    window.addEventListener("resize", setMobileEnquiryHeight);
    if (window.visualViewport) window.visualViewport.addEventListener("resize", setMobileEnquiryHeight);
    window.addEventListener("orientationchange", function () {
      setTimeout(setMobileEnquiryHeight, 250);
    });

    if (form) form.addEventListener("submit", validateEnquiryForm);
  });
})();
