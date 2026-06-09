<?php
include_once('config/db.php');
$obj = new database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Validate required fields
  $required_fields = ['dzName', 'dzPhone'];
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      die("Error: '$field' is required.");
    }
  }

  // Sanitize user input
  $package_name    = trim($_POST['packageName']);
  $full_name       = trim($_POST['dzName']);
  $phone           = trim($_POST['dzPhone']);
  $email           = trim($_POST['dzEmail'] ?? '');
  $travel_date     = trim($_POST['dzTravelDate'] ?? '');
  $no_of_travelers = trim($_POST['dzTravelers'] ?? '');
  $message         = trim($_POST['dzMessage'] ?? '');

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

  $tbl_name = 'bookings';

  $arr = [
    'package_name'    => $package_name,
    'full_name'       => $full_name,
    'phone'           => $phone,
    'email'           => $email,
    'travel_date'     => !empty($travel_date) ? $travel_date : null,
    'no_of_travelers' => !empty($no_of_travelers) ? (int)$no_of_travelers : null,
    'message'         => $message,
  ];

  $obj->insert_data($tbl_name, $arr);

  // After successful insert
  echo "<script>
    alert('Thank you! Your booking has been submitted successfully. Our team will contact you within 24 hours.');
    window.location.href = './';
</script>";
  exit();
}
