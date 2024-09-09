<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Login</title>
</head>

<body class="bg-light">

    <?php require_once('../inc/header.php'); ?>


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
                        <label class="form-label">USERNAME</label>
                        <input type="text" name="user" required class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" name="pass" required class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button name="submit" type="submit" class="btn btn-dark shadow-none">Đăng Nhập</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php
    // session_start();

    // if (isset($_SESSION['name'])) {
    //     echo "<script>window.location.href='" . SITE_URL . "' </script>";
    // }

    // if (isset($_POST['submit'])) {
    //     if (empty($_POST['user']) || empty($_POST['pass'])) {
    //         echo "<script>alert('Một hoặc nhiều ô nhập liệu bị bỏ trống')</script>";
    //     } else {
    //         $u = htmlspecialchars($_POST['user'], ENT_QUOTES);
    //         $p = htmlspecialchars($_POST['pass'], ENT_QUOTES);


    //         // Khởi tạo kết nối PDO riêng
    //         try {
    //             $pdo = new PDO("mysql:host=$hname;dbname=$db", $uname, $pass);
    //             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //             // Chuẩn bị và thực thi truy vấn
    //             $stmt = $pdo->prepare("SELECT password FROM user_cred WHERE id = :id");
    //             $stmt->bindParam(':id', $u, PDO::PARAM_STR);
    //             $stmt->execute();

    //             // Xử lý kết quả
    //         } catch (PDOException $e) {
    //             die("Không thể kết nối tới cơ sở dữ liệu: " . $e->getMessage());
    //         }



    //         $login = $pdo->query("SELECT password FROM user_cred WHERE id='$u'");
    //         // $ps = $db->query("SELECT pas FROM table2 WHERE id='$u'");
    //         var_dump($login);

    //         if ($login->rowCount() > 0) {
    //             $r = $login->fetch();
    //             if ($r['password'] === md5($p)) {
    //                 $_SESSION['us'] = $u;
    //                 echo "<script>window.location.href = 'index.php';</script>";
    //                 exit();
    //             } else {
    //                 session_destroy();

    //                 echo "<P>パスワードが違います<BR>
    //                     <A HREF='login.php'>ログオン</A>
    //                 </P>";
    //             }
    //         } else {
    //             session_destroy();
    //             echo "   <P>ユーザーが登録されていません<BR>
    //                 <A HREF='register.php'>ログオン画面へ</A>
    //             </P>";
    //         }
    //     }
    // }

    // Kiểm tra nếu người dùng đã đăng nhập
    // if (isset($_SESSION['us'])) {
    //     echo "<script>window.location.href='http://localhost/khachsan/index.php';</script>";
    //     exit();
    // }

    if (isset($_POST['submit'])) {
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            echo "<script>alert('Một hoặc nhiều ô nhập liệu bị bỏ trống')</script>";
        } else {
            $u = htmlspecialchars($_POST['user'], ENT_QUOTES);
            $p = htmlspecialchars($_POST['pass'], ENT_QUOTES);

            // Khởi tạo kết nối PDO
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=hotel-db", 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Chuẩn bị truy vấn
                $stmt = $pdo->prepare("SELECT password FROM user_cred WHERE name = '$u'");
                // $stmt->bindParam(':id', $u, PDO::PARAM_STR);
                $stmt->execute();

                // Kiểm tra xem có kết quả trả về không
                if ($stmt->rowCount() > 0) {
                    $r = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Kiểm tra mật khẩu
                    if ($r['password'] === md5($p)) {
                        $_SESSION['us'] = $u;
                        echo "<script>window.location.href = 'http://localhost/khachsan/';</script>";
                        exit();
                    } else {
                        session_destroy();
                        echo "<p>パスワードが違います<br>
                            <a href='login.php'>ログオン</a>
                        </p>";
                    }
                } else {
                    session_destroy();
                    echo "<p>ユーザーが登録されていません<br>
                        <a href='register.php'>ログオン画面へ</a>
                    </p>";
                }
            } catch (PDOException $e) {
                die("Không thể kết nối tới cơ sở dữ liệu: " . $e->getMessage());
            }
        }
    }
    ?>



    <?php require('../inc/footer.php'); ?>

</body>

</html>