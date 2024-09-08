<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Login</title>
</head>

<body class="bg-light">

    <?php require('../inc/header.php'); ?>


    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="login.php" method="POST" id="login-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Khách Hàng Đăng Nhập
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / SĐT</label>
                        <input type="text" name="email" required class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" required class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button name="submit" type="submit" class="btn btn-dark shadow-none">Đăng Nhập</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php

    if (isset($_SESSION['name'])) {
        echo "<script>window.location.href='" . SITE_URL . "' </script>";
    }



    if (isset($_POST['submit'])) {
        if (empty($_POST['email']) or empty($_POST['password'])) {
            echo "<script>alert('one ore more input are empty')</script>";
        } else {

            $email = $_POST['email'];
            $password = $_POST['password'];

            //validate the email with query

            $login = $con->query("SELECT * FROM user_cred WHERE email='$email'");
            $login->execute();

            $fetch = $login->fetch(PDO::FETCH_ASSOC);

            //get the row count

            if ($login->rowCount() > 0) {

                if (password_verify($password, $fetch['password'])) {

                    // echo "<script>alert('LOGGED IN')</script>";

                    $_SESSION['name'] = $fetch['name'];
                    $_SESSION['id'] = $fetch['id'];

                    header("location: " . SITE_URL . "");
                    exit();
                } else {

                    echo "<script>alert('email or password is wrong')</script>";
                }
            } else {

                echo "<script>alert('email or password is wrong')</script>";
            }
        }
    }

    ?>
    <?php require('../inc/footer.php'); ?>

</body>

</html>