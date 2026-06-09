<?php
require_once 'config/db.php';  // existing DB file ka path

$db = new Database();  // existing DB class ka name check karo

$name        = $_POST['name'] ?? '';
$phone       = $_POST['phone'] ?? '';
$email       = $_POST['email'] ?? '';
$destination = $_POST['destination'] ?? '';
$travel_date = $_POST['travel_date'] ?? '';
$travelers   = $_POST['travelers'] ?? '';
$tour_type   = $_POST['tour_type'] ?? '';
$message     = $_POST['message'] ?? '';

if(!$name || !$phone){
    die('Name and Phone required');
}

$data = [
    'name'=>$name,
    'phone'=>$phone,
    'email'=>$email,
    'destination'=>$destination,
    'travel_date'=>$travel_date,
    'travelers'=>$travelers,
    'tour_type'=>$tour_type,
    'message'=>$message,
    'created_at'=>date('Y-m-d H:i:s')
];

$insert = $db->insert_data('enquiries', $data);  // function name check karo

if($insert){
    echo "<script>alert('Thank you! Your enquiry has been submitted');window.history.back();</script>";
} else {
    echo "<script>alert('Error submitting form');window.history.back();</script>";
}
?>