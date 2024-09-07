<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/common.css">

<?php

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');


// require('admin/inc/db_config.php');

// Đặt đường dẫn tuyệt đối hoặc tương đối chính xác
require __DIR__ . '/../admin/inc/db_config.php';
require __DIR__ . '/../admin/inc/essentials.php';

// require('admin/inc/essentials.php');

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
// $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
// $settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));


if ($settings_r['shutdown']) {
  echo <<<alertbar
      <div class='bg-warning text-center p-2 fw-bold text-light'>
        <i class="bi bi-exclamation-triangle-fill"></i>
        Khách sạn đag bảo trì, vui lòng quay lại sau!
      </div>
    alertbar;
}

?>