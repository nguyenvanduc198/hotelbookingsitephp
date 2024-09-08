<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo isset($settings_r['site_title']) ? htmlspecialchars($settings_r['site_title'], ENT_QUOTES, 'UTF-8') : 'Default Title'; ?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="<?php echo SITE_URL; ?>">Trang Chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="<?php echo SITE_URL; ?>rooms.php">Phòng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="<?php echo SITE_URL; ?>facilities.php">Tiện Nghi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="<?php echo SITE_URL; ?>contact.php">Liên Hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo SITE_URL; ?>about.php">Giới Thiệu</a>
        </li>
        <?php if (!isset($_SESSION['name'])) : ?>
          <li class="nav-item"><a href="<?php echo SITE_URL; ?>auth/login.php" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="<?php echo SITE_URL; ?>auth/register.php" class="nav-link">Register</a></li>
        <?php else : ?>
          <!-- Add additional menu items for logged-in users here if needed -->
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i> Khách Hàng Đăng Nhập
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email / SĐT</label>
            <input type="text" name="email_mob" required class="form-control shadow-none">
          </div>
          <div class="mb-4">
            <label class="form-label">Mật Khẩu</label>
            <input type="password" name="pass" required class="form-control shadow-none">
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">Đăng Nhập</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <!-- <i class="bi bi-person-circle fs-3 me-2"></i> Quên mật khẩu -->
          </h5>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Lưu ý: Một liên kết sẽ được gửi đến email của bạn để đặt lại mật khẩu của bạn!
          </span>
          <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" required class="form-control shadow-none">
          </div>
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              HUỶ
            </button>
            <button type="submit" class="btn btn-dark shadow-none">GỬI LINK</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>