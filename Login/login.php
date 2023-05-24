<?php
include "../ConnectDatabase/database.php";
$loi = "";
session_start();
if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];
    //Lấy dữ liệu từ mysql
    $sql = "select username,password from account";
    if ($connection != null) {
        try {
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $acounts = $statement->fetchAll();
            foreach ($acounts as $acount) {
                $usernamedb = $acount['username'] ?? '';
                $passworddb = $acount['password'] ?? '';
                // echo "$usernamedb,$passworddb<br>";
                if (strcasecmp($usernamedb, $usernamedb) == 0 && strcasecmp($password, $passworddb) == 0) {
                    $_SESSION['username'] = $username;
                    header('Location: ../index.php');
                }
            }
        } catch (PDOException $e) {
            echo "Kết nối mysql lỗi không thể truy vấn được";
        }
    }
    $loi = "Tài khoản hoặc mật khẩu sai";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="../css/loginn.css" />
    <style>
        /* background image page web */
    </style>
</head>

<body class="bg">
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../image/logo.jpg" class="brand_logo" alt="Logo" />
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" placeholder="Tài khoản" />
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" placeholder="Mật khẩu" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline" />
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <p class="text-danger"><?php printf($loi) ?></p>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <input type="submit" class="btn login_btn" value="Đăng nhập" name="submit" />
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Bạn không có tài khoản? <a href="signup.php" class="ml-2">Đăng ký</a>
                    </div>
                    <h4> <a href="../index.php" class="ml-2">Trang chủ</a></h4>
                </div>
            </div>
        </div>
    </div>
</body>

</html>