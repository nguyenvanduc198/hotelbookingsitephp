<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ĐĂNG KÝ</title>
</head>

<body class="bg-light">

    <?php require('../inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ĐĂNG KÝ TÀI KHOẢN</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Tạo tài khoản mới tại đây <br>
        </p>
    </div>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <form id="register-form"> -->
            <form action="register.php" method="POST" role="form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> Khách Hàng Đăng Ký
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ và Tên</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số Điện Thoại</label>
                                <input name="phonenum" type="number" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ảnh</label>
                                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Tỉnh</label>
                                <input name="pincode" type="number" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày Sinh</label>
                                <input name="dob" type="date" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật Khẩu</label>
                                <input name="pass" type="password" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nhập Lại Mật Khẩu</label>
                                <input name="cpass" type="password" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button name="submit" type="submit" class="btn btn-dark shadow-none">ĐĂNG KÝ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    ob_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Kiểm tra nếu nút gửi được nhấn
        if (isset($_POST['submit'])) {
            // Kiểm tra nếu có dữ liệu gửi lên
            if (!isset($_FILES['profile']) || $_FILES['profile']['error'] != UPLOAD_ERR_OK) {
                $profile_image = ''; // Không có ảnh được tải lên
            } else {
                // Xử lý file upload
                $profile_image = $_FILES['profile']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($profile_image);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Kiểm tra định dạng file
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "webp") {
                    alert('error', 'Chỉ hỗ trợ các định dạng JPG, JPEG, PNG và WEBP.');
                    $uploadOk = 0;
                }

                // Kiểm tra kích thước file
                if ($_FILES["profile"]["size"] > 500000) {
                    alert('error', 'File quá lớn.');
                    $uploadOk = 0;
                }

                // Kiểm tra nếu $uploadOk bị đặt thành 0 bởi lỗi
                if ($uploadOk == 0) {
                    alert('error', 'File không được tải lên.');
                } else {
                    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
                        // Thành công khi upload
                    } else {
                        alert('error', 'Có lỗi khi tải lên file.');
                    }
                }
            }

            // Lọc dữ liệu từ POST
            $frm_data = filteration($_POST);

            // Kiểm tra mật khẩu khớp
            if ($frm_data['pass'] != $frm_data['cpass']) {
                alert('error', 'Passwords do not match!');
            } else {
                // Hash mật khẩu
                $password = password_hash($frm_data['pass'], PASSWORD_DEFAULT);

                // Chuẩn bị câu truy vấn
                $q = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`) VALUES (?,?,?,?,?,?,?,?)";
                $values = [
                    $frm_data['name'],
                    $frm_data['email'],
                    $frm_data['phonenum'],
                    $profile_image, // Có thể là chuỗi rỗng nếu không có ảnh
                    $frm_data['address'],
                    $frm_data['pincode'],
                    $frm_data['dob'],
                    $password,
                ];

                // Gọi hàm insert
                $res = insert($q, $values, 'ssssssss');
                // if ($res == 1) {
                //     // alert('success', 'Đăng ký thành công!');
                //     header("location: login.php");
                //     exit();
                // } else {
                //     alert('error', 'Lỗi máy chủ, vui lòng thử lại!');
                // }

                if ($res == 1) {
                    // Nếu đăng ký thành công, chuyển hướng đến trang đăng nhập
                    // header("Location: login.php");
                    // exit();
                    echo "<script>window.location.href = 'login.php';</script>";
                    exit();
                } else {
                    // Nếu có lỗi, hiển thị thông báo lỗi
                    alert('error', 'Lỗi máy chủ, vui lòng thử lại!');
                }
            }
        }
    }
    ob_end_flush();
    ?>


    <?php require('../inc/footer.php'); ?>

</body>

</html>