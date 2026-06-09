<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once('../config/db.php');
$obj = new database();
$type = $_GET['type'] ?? null;

// Packages
if ($type === 'packages') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete package entry along with all associated images
    if ($obj->delete_data('packages', "id = $id", ['image', 'gallery_1', 'gallery_2', 'gallery_3', 'gallery_4'])) {
      header("Location: manage-data.php?type=packages");
      exit;
    } else {
      die("Error: Failed to delete package.");
    }
  }
}

// Categories
if ($type === 'categories') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete destination entry along with image
    if ($obj->delete_data('destination', "id = $id", ['image'])) {
      header("Location: manage-data.php?type=categories");
      exit;
    } else {
      die("Error: Failed to delete destination.");
    }
  }
}

// Blog
if ($type === 'blog') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete blog entry along with image
    if ($obj->delete_data('blogs', "id = $id", ['image'])) {
      header("Location: manage-data.php?type=blog");  // ← was type=blog
      exit;
    } else {
      die("Error: Failed to delete blog.");  // ← updated message
    }
  }
}

// Testimonial
if ($type === 'testimonial') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete car entry along with all associated images
    if ($obj->delete_data('testimonial', "id = $id")) {
      header("Location: manage-data.php?type=testimonial");
      exit;
    } else {
      die("Error: Failed to delete entry.");
    }
  }
}

// Travel Inquiry
if ($type === 'travel_inquiry') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete inquiry entry (no images to delete)
    if ($obj->delete_data('inquiry', "id = $id")) {  // ← was 'inquiries'
      header("Location: manage-data.php?type=travel_inquiry");
      exit;
    } else {
      die("Error: Failed to delete inquiry.");  // ← updated message
    }
  }
}

// Booking Inquiry
if ($type === 'booking-inquiry') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete booking entry (no images to delete)
    if ($obj->delete_data('bookings', "id = $id")) {  // ← was 'inquiry'
      header("Location: manage-data.php?type=booking-inquiry");  // ← updated type
      exit;
    } else {
      die("Error: Failed to delete booking.");  // ← updated message
    }
  }
}

// General Inquiry
if ($type === 'general-inquiry') {
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete booking entry (no images to delete)
    if ($obj->delete_data('general_inquiry', "id = $id")) {  // ← was 'inquiry'
      header("Location: manage-data.php?type=general-inquiry");  // ← updated type
      exit;
    } else {
      die("Error: Failed to delete booking.");  // ← updated message
    }
  }
}

