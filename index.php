<!doctype html>
<html lang="en">

<head>
  <!-- Character Encoding -->
  <meta charset="UTF-8" />

  <!-- Responsive Design -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title>Welcome India</title>

  <meta name="title" content="Welcome India" />
  <meta name="description" content="Welcome India for travel agencies, tour operators, holiday planners, and booking." />
  <meta name="keywords" content="Welcome India for travel agencies, tour operators, holiday planners, and booking" />
  <meta name="author" content="HDT"/>
  <meta name="robots" content="index, follow" />
  <?php
  include_once('includes/header-link.php');
  ?>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <!-- LOADING AREA START ===== -->
  <?php
  include_once('includes/preloader.php');
  ?>
  <!-- LOADING AREA  END ====== -->

  <!-- Curser Pointer -->
  <?php
  include_once('includes/cursor.php');
  ?>

  <div class="page-wraper">

    <?php
    include_once('includes/header.php');
    ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <!-- CONTENT START -->
        <div class="page-content">
          <!-- Banner Style One -->
          <?php
          include_once('includes/hero-section.php');
          ?>
          <!-- Banner Style One End -->

          <!-- SEARCH BAR START-->
          <?php
          include_once('includes/search-bar.php');
          ?>
          <!-- SEARCH BAR END-->

          <!--INDIA TOUR PACKAGES SECTION START-->
          <?php
          include_once ('includes/india-tour-packages.php');
          ?>
          <!--INDIA TOUR PACKAGES SECTION END-->

          <!-- Customize packages -->
          <?php
          include_once('includes/customize-packages.php');
          ?>
          <!-- End Customize packages -->

          <!-- Amazing Destinations  -->
          <?php
          include_once('includes/amazing-destionation.php');
          ?>
          <!-- End of Amazing Destination -->

          <!-- Most Popular Domestic Packages -->
          <?php
          include_once('includes/domestic-packages.php');
          ?>

          <!-- Internation Holidays Packages -->
          <?php
          include_once('includes/international-packages.php');
          ?>

          <!-- VIDEO WITH ACHIVMENT SECTION START-->
          <?php
          include_once('includes/video-achivement.php');
          ?>
          <!--VIDEO WITH ACHIVMENT SECTION END-->

          <!--WE OFFER SERVICES SECTION START-->
          <?php
          include_once('includes/travel-services.php');
          ?>

          <!-- ADVENTURE SECTION START -->
          <?php
          include_once('includes/adventure.php');
          ?>
          <!-- ADVENTURE SECTION END -->
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php
        include_once('includes/footer.php');
        ?>
        <!-- FOOTER END -->
      </div>
    </div>

    <!-- BUTTON TOP START -->
    <button class="scroltop">
      <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
    </button>

    <?php
    include_once('includes/off-canvas.php');
    ?>
  </div>

  <!-- JAVASCRIPT  FILES ========================================= -->
  <?php
  include_once('includes/footer-link.php');
  ?>

  <!-- Search bar: text search across all packages -->
  <script>
    document
      .getElementById("locationSearchForm")
      .addEventListener("submit", function(e) {
        e.preventDefault();

        var packageName = document
          .getElementById("locationInput")
          .value.trim();

        if (packageName !== "") {
          window.location.href = "search.php?q=" + encodeURIComponent(packageName);
        } else {
          document.getElementById("locationInput").focus();
        }
      });
  </script>

  <!-- Slider: hero section slide auto-play -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const slides = document.querySelectorAll(".slider .slide");
      let index = 0;

      setInterval(() => {
        slides[index].classList.remove("active");
        index = (index + 1) % slides.length;
        slides[index].classList.add("active");
      }, 4000);
    });
  </script>

  <!-- Destination slider (amazing destinations prev/next) -->
  <script>
    const slider = document.querySelector(".destination-slider");
    const next = document.querySelector(".next");
    const prev = document.querySelector(".prev");

    if (next && prev && slider) {
      next.addEventListener("click", () => {
        slider.scrollBy({ left: 300, behavior: "smooth" });
      });
      prev.addEventListener("click", () => {
        slider.scrollBy({ left: -300, behavior: "smooth" });
      });
    }
  </script>

  <script src="assets/js/swiper-custom.js"></script>

  <!-- Card sliders (domestic / international package cards) -->
  <script>
    document.querySelectorAll(".card-slider").forEach((slider) => {
      let slides = slider.querySelectorAll(".slide");
      let index = 0;

      setInterval(() => {
        slides[index].classList.remove("active");
        index++;
        if (index >= slides.length) {
          index = 0;
        }
        slides[index].classList.add("active");
      }, 3000);
    });
  </script>

  <!-- Enquiry form disabled -->

  <!-- ===== ENQUIRY MODAL ===== -->
  <div id="enquiryModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;align-items:flex-start;justify-content:center;background:rgba(0,0,0,0.55);opacity:0;transition:opacity 0.4s;z-index:9999;overflow-y:auto;-webkit-overflow-scrolling:touch;">

  <div id="enquiryBox" style="background:#fff;border-radius:18px;max-width:680px;width:100%;box-shadow:0 16px 48px rgba(0,0,0,0.25);transform:scale(0.92);transition:transform 0.4s;overflow:visible;margin:20px auto;display:flex;flex-direction:column;max-height:90vh;">

    <!-- ── HEADER ── -->
    <div style="background:linear-gradient(135deg,#006a72 0%,#0a9ea8 100%);padding:18px 28px 16px;position:relative;flex-shrink:0;">

      <button onclick="closeEnquiry()" style="position:absolute;top:14px;right:14px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);border:none;color:#fff;font-size:18px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;">&times;</button>

      <div style="display:flex;align-items:center;gap:14px;">
        <div style="width:48px;height:48px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;">✈️</div>
        <div>
          <h3 style="margin:0;color:#fff;font-size:22px;font-weight:700;font-family:Arial,sans-serif;line-height:1.2;">Plan Your Perfect Trip</h3>
          <p style="margin:4px 0 0;color:rgba(255,255,255,0.85);font-size:13px;font-family:Arial,sans-serif;">Fill in details &amp; we'll get back to you shortly!</p>
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap;">
        <span style="background:rgba(255,255,255,0.15);color:#fff;font-size:12px;padding:5px 12px;border-radius:20px;font-family:Arial,sans-serif;">🛡️ 100% Safe</span>
        <span style="background:rgba(255,255,255,0.15);color:#fff;font-size:12px;padding:5px 12px;border-radius:20px;font-family:Arial,sans-serif;">🕐 24/7 Support</span>
        <span style="background:rgba(255,255,255,0.15);color:#fff;font-size:12px;padding:5px 12px;border-radius:20px;font-family:Arial,sans-serif;">⭐ 4.8 Rated</span>
      </div>
    </div>

    <!-- ── FORM BODY ── -->
    <div id="enquiryFormContainer" style="padding:20px 28px;background:#fff;flex:1;min-height:0;overflow-y:auto;-webkit-overflow-scrolling:touch;display:flex;flex-direction:column;">
      <form id="enquiryForm" method="POST" action="submit_enquiry.php">

        <div class="enq-row" style="margin-bottom:18px;">
          <div>
            <label class="enq-label">👤 Full Name <span style="color:#e53e3e;">*</span></label>
            <input id="enqName" type="text" name="name" placeholder="Your full name" required class="enq-input" />
          </div>
          <div>
            <label class="enq-label">📞 Phone Number <span style="color:#e53e3e;">*</span></label>
            <input id="enqPhone" type="tel" name="phone" placeholder="Your phone number" required pattern="\d{10}" maxlength="10" class="enq-input" />
          </div>
        </div>

        <div class="enq-row" style="margin-bottom:18px;">
          <div>
            <label class="enq-label">✉️ Email Address</label>
            <input id="enqEmail" type="email" name="email" placeholder="Your email address" maxlength="50" class="enq-input" />
          </div>
          <div>
            <label class="enq-label">📍 Destination</label>
            <input id="enqDestination" type="text" name="destination" placeholder="Where do you want to go?" class="enq-input" />
          </div>
        </div>

        <div class="enq-row" style="margin-bottom:18px;">
          <div>
            <label class="enq-label">📅 Travel Date</label>
            <input id="enqDate" type="date" name="travel_date" class="enq-input" />
          </div>
          <div>
            <label class="enq-label">👥 No. of Travelers</label>
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

        <div style="margin-bottom:18px;">
          <label class="enq-label">🧳 Tour Type</label>
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

        <div style="margin-bottom:16px;">
          <label class="enq-label">💬 Your Message</label>
          <textarea id="enqMessage" name="message" rows="3" placeholder="Tell us about your dream trip..." class="enq-input" style="resize:vertical;"></textarea>
        </div>

        <div id="enqError" style="display:none;color:#e53e3e;font-size:13px;margin-bottom:14px;font-family:Arial,sans-serif;"></div>

        <button type="submit" class="enq-submit-btn">✈&nbsp;&nbsp;<strong>Continue to Send Enquiry</strong> &nbsp;→</button>

      </form>

      <div style="display:flex;justify-content:center;gap:24px;margin-top:16px;flex-wrap:wrap;">
        <span style="color:#6b7280;font-size:12px;font-family:Arial,sans-serif;">🔒 Secure &amp; Private</span>
        <span style="color:#6b7280;font-size:12px;font-family:Arial,sans-serif;">⚡ Quick Response</span>
        <span style="color:#6b7280;font-size:12px;font-family:Arial,sans-serif;">👍 No Hidden Charges</span>
      </div>
    </div>

  </div>
</div>

<!-- ===== ENQUIRY MODAL CSS ===== -->
<style>
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
  box-sizing: border-box;
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
  -webkit-appearance: none;
  appearance: none;
}
.enq-input::placeholder { color: #9ca3af; }
.enq-input:focus {
  border-color: #006a72;
  box-shadow: 0 0 0 3px rgba(0,106,114,0.12);
  background: #fff;
}
select.enq-input {
  cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 36px;
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
  letter-spacing: 0.3px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.enq-submit-btn:hover {
  background: linear-gradient(135deg, #005a61, #088992);
  transform: translateY(-1px);
  box-shadow: 0 8px 24px rgba(0,106,114,0.35);
}

/* Two-column grid on desktop, single column on mobile */
.enq-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px;
}

@media (max-width: 560px) {
  .enq-row {
    grid-template-columns: 1fr;
    margin-bottom: 10px !important;
  }
  .enq-label {
    font-size: 11px !important;
    margin-bottom: 4px !important;
  }
  .enq-input {
    font-size: 12px !important;
    padding: 8px 10px !important;
    margin-bottom: 6px !important;
  }
  textarea.enq-input {
    rows: 2 !important;
    min-height: 60px !important;
  }
  #enquiryBox {
    max-height: calc(100vh - 16px) !important;
    height: auto !important;
    margin: 8px auto !important;
    border-radius: 12px !important;
    display: flex !important;
    flex-direction: column !important;
  }
  #enquiryBox > div:first-child {
    padding: 12px 14px 10px !important;
    flex-shrink: 0 !important;
  }
  #enquiryBox > div:first-child h3 {
    font-size: 18px !important;
  }
  #enquiryBox > div:first-child p {
    font-size: 11px !important;
  }
  #enquiryFormContainer {
    padding: 12px 14px 12px !important;
    flex: 1 !important;
    min-height: 0 !important;
    overflow-y: auto !important;
    -webkit-overflow-scrolling: touch !important;
    display: flex !important;
    flex-direction: column !important;
  }
  #enquiryForm {
    display: flex !important;
    flex-direction: column !important;
    flex: 1 !important;
  }
  #enquiryModal {
    align-items: flex-start !important;
    justify-content: flex-start !important;
    overflow-y: auto !important;
    padding: 4px !important;
  }
  .enq-submit-btn {
    padding: 10px 14px !important;
    font-size: 12px !important;
    margin-top: auto !important;
    flex-shrink: 0 !important;
  }
  div[style*="display:flex;justify-content:center;gap:24px"] {
    gap: 10px !important;
    font-size: 10px !important;
    margin-top: 10px !important;
    flex-shrink: 0 !important;
  }
}
</style>

<!-- ===== ENQUIRY MODAL JS ===== -->
<script>
function openEnquiry() {
  const modal = document.getElementById('enquiryModal');
  modal.style.display = 'flex';
  setTimeout(() => {
    modal.style.opacity = '1';
    document.getElementById('enquiryBox').style.transform = 'scale(1)';
  }, 10);
}

function closeEnquiry() {
  const modal = document.getElementById('enquiryModal');
  modal.style.opacity = '0';
  document.getElementById('enquiryBox').style.transform = 'scale(0.92)';
  setTimeout(() => { modal.style.display = 'none'; }, 400);
}

// Enquiry form disabled: do not auto-open the popup.
// window.addEventListener('load', openEnquiry);

document.getElementById('enquiryModal').addEventListener('click', function(e) {
  if (e.target === this) closeEnquiry();
});

document.addEventListener('keydown', function(e) {
  if (e.key === "Escape") closeEnquiry();
});

document.getElementById("enquiryForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const name        = document.getElementById("enqName").value.trim();
  const phone       = document.getElementById("enqPhone").value.trim();
  const email       = document.getElementById("enqEmail").value.trim();
  const destination = document.getElementById("enqDestination").value.trim();
  const travelers   = document.getElementById("enqTravelers").value;
  const tourType    = document.getElementById("enqTourType").value;
  const message     = document.getElementById("enqMessage").value.trim();
  const error       = document.getElementById("enqError");
  let errors = [];

  if (!name)                                                        errors.push("Name is required.");
  if (!phone)                                                       errors.push("Phone is required.");
  else if (!/^\d{10}$/.test(phone))                                 errors.push("Phone must be exactly 10 digits.");
  if (email && email.length > 50)                                   errors.push("Email max 50 characters.");
  else if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))     errors.push("Invalid email format.");
  if (!destination)                                                 errors.push("Destination is required.");
  if (!travelers)                                                   errors.push("Please select number of travelers.");
  if (!tourType)                                                    errors.push("Please select a tour type.");
  if (message && message.length < 10)                               errors.push("Message must be at least 10 characters.");

  if (errors.length > 0) {
    error.style.display = "block";
    error.innerHTML = errors.join("<br>");
    return;
  }
  error.style.display = "none";
  this.submit();
});
</script>
</body>
</html>
