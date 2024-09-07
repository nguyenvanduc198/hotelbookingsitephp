<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../inc/links.php'); ?>
</head>

<body class="bg-light">
    <?php require('../inc/header.php'); ?>

    <?php
    // Kết nối cơ sở dữ liệu

    // Xử lý form khi được gửi
    if (isset($_POST['submit'])) {
        // Kiểm tra các trường không được để trống
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass'])) {
            echo "<script>alert('Please fill in all fields.')</script>";
        } else {
            // Lấy dữ liệu từ form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            // Chuẩn bị và thực thi câu lệnh INSERT
            try {
                $insert = $conn->prepare("INSERT INTO user_cred (name, email, mypassword) VALUES (:name, :email, :mypassword)");
                $insert->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":mypassword" => $password,
                ]);

                // Chuyển hướng sau khi đăng ký thành công
                // header("Location: login.php");
                // exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    ?>

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    </div>

    <?php require('../inc/footer.php'); ?>

</body>

</html>