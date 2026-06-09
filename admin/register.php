<?php
header("Location: login.php");
exit;

include_once('../config/db.php');
$obj= new database();

if (isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $plain_password = $_POST['password'];

  $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

  $stmt = $obj->connection->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $email, $hashed_password);
  $stmt->execute();

  echo "<script>alert('Admin added!')</script>";
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
                    <h4 class="text-dark my-4">Register to Admin Panel</h4>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email here" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password here" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block font-18">Register</button>
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