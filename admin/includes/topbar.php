<?php
if (session_status() === PHP_SESSION_NONE) {
}
$email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : '';
//  $email = $_SESSION['admin_email'];
?>
<div class="topbar">
  <!-- Start row -->
  <div class="row align-items-center">
    <!-- Start col -->
    <div class="col-md-12 d-flex justify-content-between align-items-center">
      <div class="togglebar">
        <div class="menubar">
          <a class="menu-hamburger" href="javascript:void();">
            <img src="assets/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse" />
            <img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close" />
          </a>
        </div>
      </div>
      <div class="infobar mt-2">
        <div class="profilebar">
          <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="assets/images/users/profile.svg" class="img-fluid" alt="profile" /><span class="feather icon-chevron-down live-icon"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
              <div class="dropdown-item">
                <div class="profilename">
                  <h5><?php echo $email; ?></h5>
                </div>
              </div>
              <div class="userbox">
                <ul class="list-unstyled mb-0">
                  <li class="media dropdown-item">
                    <a href="logout.php" class="profile-icon"><img src="assets/images/svg-icon/logout.svg" class="img-fluid" alt="logout" />Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End col -->
  </div>
  <!-- End row -->
</div>
