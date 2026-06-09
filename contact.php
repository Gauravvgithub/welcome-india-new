<?php
include_once('config/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/assets/script/php_mail/vendor/autoload.php';

$obj = new database();

function sendContactEmail($full_name, $phone, $email, $destination, $travel_date, $no_of_travelers, $message, &$errorMessage = '') {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Info.welcomeindiaholidays@gmail.com';
        $mail->Password   = 'gstrmjhpguidruiw';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('Info.welcomeindiaholidays@gmail.com', 'Welcome India Website');
            $mail->addAddress('Info.welcomeindiaholidays@gmail.com', 'Welcome India Holidays');
        if (!empty($email)) {
            $mail->addReplyTo($email);
        }

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';

        $travel_date_text = !empty($travel_date) ? htmlspecialchars($travel_date) : 'Not provided';
        $destination_text = !empty($destination) ? htmlspecialchars($destination) : 'Not provided';
        $no_of_travelers_text = !empty($no_of_travelers) ? (int)$no_of_travelers : 'Not provided';
        $message_text = !empty($message) ? nl2br(htmlspecialchars($message)) : 'Not provided';
        $email_text = !empty($email) ? htmlspecialchars($email) : 'Not provided';

        $mail->Body = "<h2>New Contact Inquiry</h2>"
            . "<p><strong>Name:</strong> " . htmlspecialchars($full_name) . "</p>"
            . "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>"
            . "<p><strong>Email:</strong> " . $email_text . "</p>"
            . "<p><strong>Destination:</strong> " . $destination_text . "</p>"
            . "<p><strong>Travel Date:</strong> " . $travel_date_text . "</p>"
            . "<p><strong>No. of Travelers:</strong> " . $no_of_travelers_text . "</p>"
            . "<p><strong>Message:</strong><br>" . $message_text . "</p>";
        $mail->AltBody = strip_tags($mail->Body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Validate required fields
  $required_fields = ['full_name', 'phone'];
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      die("Error: '$field' is required.");
    }
  }

  // Sanitize user input
  $full_name       = trim($_POST['full_name']);
  $phone           = trim($_POST['phone']);
  $email           = trim($_POST['email'] ?? '');
  $destination     = trim($_POST['destination'] ?? '');
  $travel_date     = trim($_POST['travel_date'] ?? '');
  $no_of_travelers = trim($_POST['no_of_travelers'] ?? '');
  $message         = trim($_POST['message'] ?? '');

  // Validate phone is numeric
  if (!is_numeric($phone)) {
    die("Error: Phone number must be valid.");
  }

  // Validate email format if provided
  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address.");
  }

  // Validate travel date if provided
  if (!empty($travel_date) && !strtotime($travel_date)) {
    die("Error: Invalid travel date.");
  }

  $tbl_name = 'general_inquiry';

  $arr = [
    'full_name'       => $full_name,
    'phone'           => $phone,
    'email'           => $email,
    'destination'     => $destination,   // ← added
    'travel_date'     => !empty($travel_date) ? $travel_date : null,
    'no_of_travelers' => !empty($no_of_travelers) ? (int)$no_of_travelers : null,
    'message'         => $message,
  ];

  $obj->insert_data($tbl_name, $arr);

  $email_error = '';
  $email_sent = sendContactEmail($full_name, $phone, $email, $destination, $travel_date, $no_of_travelers, $message, $email_error);

  if ($email_sent) {
      $alertMessage = 'Thank you! Your inquiry has been submitted successfully. Our team will contact you within 24 hours.';
  } else {
      $alertMessage = 'Thank you! Your inquiry has been submitted successfully, but the notification email could not be sent.';
  }

  echo "<script>
        alert('" . addslashes($alertMessage) . "');
        window.location.href = './';
    </script>";
  exit();
}
?>
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
  <meta
    name="description"
    content="Welcome India for travel agencies, tour operators, holiday planners, and booking." />
  <meta name="keywords" content="Welcome India for travel agencies, tour operators, holiday planners, and booking" />
  <meta name="author" content="HDT" />
  <meta name="robots" content="index, follow" />
  <?php include_once('includes/header-link.php'); ?>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <!-- LOADING AREA START ===== -->
  <?php include_once('includes/preloader.php'); ?>
  <!-- LOADING AREA  END ====== -->

  <!-- Curser Pointer -->
  <?php include_once('includes/cursor.php'); ?>

  <div class="page-wraper">
    <?php include_once('includes/header.php'); ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <!-- CONTENT START -->
        <div class="page-content">
          <!-- INNER PAGE BANNER -->
          <div
            class="relative bg-cover bg-center w-full bg-white bg-[url(../images/background/inr-banner.jpg)] overflow-hidden">
            <div class="opacity-100 absolute left-0 top-0 size-full"></div>
            <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
              <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                <div>
                  <h2 class="lg:text-60 md:text-52 text-28 relative">Contact Us</h2>
                </div>
                <!-- BREADCRUMB ROW -->
                <div>
                  <ul class="inline-block">
                    <li
                      class="text-base pr-7.5 relative inline-block font-semibold text-primary after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                      <a href="./">Home</a>
                    </li>
                    <li class="relative inline-block text-base font-semibold text-primary">Contact Us</li>
                  </ul>
                </div>
              </div>
              <!-- BREADCRUMB ROW END -->
            </div>
          </div>
          <!-- INNER PAGE BANNER END -->

          <!--CONTACT US SECTION START-->
          <div class="xl:py-30 py-12.5 px-5">
            <div
              class="max-w-437.5 mx-auto bg-white rounded-6xl xl:p-15 p-5 shadow-[0px_4px_80px_rgba(6,97,104,0.28)] relative">
              <!-- GOOGLE MAP -->
              <div class="w-full md:h-150 mb-15">
                <div class="gmap-outline">
                  <div class="google-map">
                    <div class="overflow-hidden" style="width: 100%">
                      <iframe
                        class="max-md:h-90 w-full rounded-4xl"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.6426924527937!2d77.08208797604519!3d28.610494085080063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b4b4d6988f9%3A0x83bce0e016f91b8e!2s18%2C%20Street%20No.%201%2C%20Dabri%20Village%2C%20Dabri%2C%20New%20Delhi%2C%20Delhi%2C%20110045!5e0!3m2!1sen!2sin!4v1777016060750!5m2!1sen!2sin"
                        width="600"
                        height="600"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-12 lg:gap-7.5">
                <div class="col-span-12">
                  <div>
                    <!-- ============================================================
  STEP 1: Replace your contact form HTML with this updated form
  (inside the bg-[#FFF8EB] div)
============================================================ -->

                    <div
                      class="bg-[#FFF8EB] xl:py-15 xl:px-12.5 sm:p-7.5 p-5 rounded-3xl w-full">
                      <!-- TITLE -->
                      <div class="sm:mb-15 mb-7.5">
                        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
                          <span class="text-citrusyellow">Reach</span> & Get in Touch With Us!
                        </h2>
                        <div class="text-base">
                          We'd love to hear from you. Our friendly team is always here to chat.
                        </div>
                      </div>

                      <!-- AUTO-FILL NOTICE (hidden by default, shown via JS if data passed) -->
                      <div
                        id="autoFillNotice"
                        style="
                            display: none;
                            background: linear-gradient(135deg, #006a72, #0a9ea8);
                            color: white;
                            padding: 12px 18px;
                            border-radius: 12px;
                            margin-bottom: 20px;
                            font-size: 14px;
                            font-weight: 600;
                            display: none;
                            align-items: center;
                            gap: 10px;
                          ">
                        <i class="fa-solid fa-circle-check" style="color: #f5c842; font-size: 18px"></i>
                        <span>Your details have been pre-filled from the enquiry form. Just review and click
                          <strong>Send Message</strong>!</span>
                      </div>

                      <form class="dz-form " method="POST" action=""> <!-- ← updated action -->
                        <div class="dzSubscribeMsg"></div>
                        <input type="hidden" name="dzToDo" value="Contact" />
                        <input type="hidden" name="reCaptchaEnable" value="0" />
                        <div class="dzFormMsg"></div>

                        <!-- Full Name -->
                        <div class="mb-5">
                          <input
                            id="cf-name"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            required
                            type="text"
                            name="full_name"
                            placeholder="Enter Your Full Name" />
                        </div>

                        <!-- Phone -->
                        <div class="mb-5">
                          <input
                            id="cf-phone"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            required
                            type="tel"
                            name="phone"
                            placeholder="Enter Your Phone Number" />
                        </div>

                        <!-- Email -->
                        <div class="mb-5">
                          <input
                            id="cf-email"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            type="email"
                            name="email"
                            placeholder="Enter Your Email Address" />
                        </div>

                        <!-- Destination -->
                        <div class="mb-5">
                          <input
                            id="cf-destination"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            type="text"
                            name="destination"
                            placeholder="Enter Trip Destination" />
                        </div>

                        <!-- Travel Date -->
                        <div class="mb-5">
                          <input
                            id="cf-date"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            type="date"
                            name="travel_date" /> <!-- ← was dzDate -->
                        </div>

                        <!-- No. of Travelers -->
                        <div class="mb-5">
                          <input
                            id="cf-travelers"
                            class="block w-full sm:h-18.5 h-12.5 rounded-5xl border border-primary/20 sm:py-5 sm:px-10 py-1.25 px-3.75 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            type="number"
                            min="1"
                            name="no_of_travelers"
                            placeholder="No. of Travelers" />
                        </div>

                        <!-- Message -->
                        <div class="mb-5">
                          <textarea
                            id="cf-message"
                            name="message"
                            class="block w-full min-h-42 h-full rounded-3xl border border-primary/20 py-10 px-7.5 sm:text-base text-sm text-bodycolor bg-white outline-0 placeholder:text-bodycolor"
                            placeholder="Write your message here..."
                            maxlength="400"></textarea>
                        </div>

                        <button name="submit" type="submit" value="Submit" class="site-button butn-bg-shape">
                          Send Message
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="2xl:col-span-6 lg:col-span-7 col-span-12">
                  <div class="relative z-1">
                    <div class="lg:pt-34.5 pt-12.5 lg:w-112.5 w-full lg:ml-6 max-lg:px-7.5 max-md:px-0">
                      <!-- TITLE START-->
                      <div class="sm:mb-15 mb-7.5">
                        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
                          Contact Us<span class="text-citrusyellow"> Detail</span>
                        </h2>
                        <div class="text-base">
                          Travlla is a multi-award-winning strategy and content creation agency that specializes in
                          travel marketing.
                        </div>
                      </div>
                      <!-- TITLE END-->

                      <ul>
                        <li class="mb-7.5">
                          <div class="sm:flex items-center max-sm:text-center">
                            <div
                              class="bg-[#45869D] size-25 rounded-5xl flex items-center justify-center max-sm:mx-auto max-sm:mb-5">
                              <div
                                class="bg-white shadow-[0px_4px_4px_rgba(0,0,0,0.25)] size-17.5 rounded-5xl flex items-center justify-center">
                                <i class="fa-solid fa-phone-volume text-34 text-skyblue"></i>
                              </div>
                            </div>
                            <div class="sm:w-[calc(100%_-_100px)] sm:pl-7.5">
                              <span class="text-lg font-normal text-primary leading-[1.4]">Phone</span>
                              <h6 class="md:text-28 text-xl text-darkcyan !font-semibold">
                                <a href="tel:9958656551">+91-9958656551</a>
                              </h6>
                            </div>
                          </div>
                        </li>
                        <li class="mb-7.5">
                          <div class="sm:flex items-center max-sm:text-center">
                            <div
                              class="bg-[#CE8594] size-25 rounded-5xl flex items-center justify-center max-sm:mx-auto max-sm:mb-5">
                              <div
                                class="bg-white shadow-[0px_4px_4px_rgba(0,0,0,0.25)] size-17.5 rounded-5xl flex items-center justify-center">
                                <i class="fa-solid fa-envelope text-34 text-[#CE8594]"></i>
                              </div>
                            </div>
                            <div class="sm:w-[calc(100%_-_100px)] sm:pl-7.5">
                              <span class="text-lg font-normal text-primary leading-[1.4]">Email</span>
                              <h6 class="md:text-28 text-xl text-darkcyan !font-semibold">
                                <a href="mailto:Info.welcomeindiaholidays@gmail.com">Info.welcomeindiaholidays@gmail.com</a>
                              </h6>
                            </div>
                          </div>
                        </li>
                        <li class="mb-7.5">
                          <div class="sm:flex items-center max-sm:text-center">
                            <div
                              class="bg-[#047881] size-25 rounded-5xl flex items-center justify-center max-sm:mx-auto max-sm:mb-5">
                              <div
                                class="bg-white shadow-[0px_4px_4px_rgba(0,0,0,0.25)] size-17.5 rounded-5xl flex items-center justify-center">
                                <i class="fa-solid fa-house text-34 text-[#047881]"></i>
                              </div>
                            </div>
                            <div class="sm:w-[calc(100%_-_100px)] sm:pl-7.5">
                              <span class="text-lg font-normal text-primary leading-[1.4]">Address</span>
                              <h6 class="md:text-28 text-xl text-darkcyan !font-semibold">
                               Suit No. 1/18A, Mahavir Enclave, Dwarka , Palam, Dabri Road , New Delhi-110045
                              </h6>
                            </div>
                          </div>
                        </li>
                      </ul>

                      <div class="lg:pt-12.5 max-sm:text-center">
                        <h3 class="!font-display md:text-48 sm:text-40 text-2xl">
                          Let's
                          <span class="text-citrusyellow">Talk</span> About You !
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--CONTACT US SECTION END-->
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php include_once('includes/footer.php'); ?>
        <!-- FOOTER END -->
      </div>
    </div>

    <!-- BUTTON TOP START -->
    <button class="scroltop">
      <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
    </button>

    <?php include_once('includes/off-canvas.php'); ?>
  </div>

  <!-- JAVASCRIPT  FILES ========================================= -->
  <?php include_once('includes/footer-link.php'); ?>
</body>

</html>
