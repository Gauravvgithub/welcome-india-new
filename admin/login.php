<?php

include_once('../config/db.php');
$obj= new database();

session_start();
if (isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Use prepared statement to prevent SQL injection
  $stmt = $obj->connection->prepare("SELECT id, email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($admin = $result->fetch_assoc()) {
    if (password_verify($password, $admin['password'])) {
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_id'] = $admin['id'];
      $_SESSION['admin_email'] = $admin['email'];
      header("Location: index.php");
      exit;
    } else {
      echo "<script>alert('Invalid password.')</script>";
    }
  } else {
    echo "<script>alert('User not found.')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <?php
  include_once('./includes/header-link.php');
  ?>
</head>

<body class="vertical-layout">
  <!-- Start Containerbar -->
  <div id="containerbar" class="containerbar authenticate-bg">
    <!-- Start Container -->
    <div class="container">
      <div class="auth-box login-box">
        <!-- Start row -->
        <div class="row no-gutters align-items-center justify-content-center">
          <!-- Start col -->
          <div class="col-md-6 col-lg-5">
            <!-- Start Auth Box -->
            <div class="auth-box-right">
              <div class="card">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-head">
                      <a href="index.php" class="logo"><img src="./assets/images/logo.png" class="img-fluid" alt="logo"></a>
                    </div>
                    <h4 class="text-dark my-4">Login to Admin Panel</h4>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email here" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password here" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block font-18">Login</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Auth Box -->
          </div>
          <!-- End col -->
        </div>
        <!-- End row -->
      </div>
    </div>
    <!-- End Container -->
  </div>
  <!-- End Containerbar -->
  <?php
  include_once('./includes/footer-link.php');
  ?>
</body>

</html>