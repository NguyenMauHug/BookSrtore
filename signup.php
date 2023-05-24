<?php
include "../ConnectDatabase/database.php";
$loi = "";
session_start();
if (isset($_SESSION['username'])) {
  header('Location: ../index.php');
}
$CheckLoi = "";
$CheckThanhCong="";
if (isset($_POST['submit'])) {

  if (empty($_POST['taikhoan']) || empty($_POST['matkhau']) || empty($_POST['nhatplaimatkhau'])) {
    $CheckLoi  = "Thông tin nhập chưa đầy đủ";
  } else {
    $taikhoan = filter_input(INPUT_POST, "taikhoan", FILTER_SANITIZE_SPECIAL_CHARS);
    $matkhau = $_POST['matkhau'];
    $nhaplaimatkhau = $_POST['nhatplaimatkhau'];
    if (strcasecmp($matkhau, $nhaplaimatkhau) != 0) {
      $CheckLoi  = "Mật khẩu nhập lại chưa chính xác";
    } else {
      if ($connection != null) {
        $sql = "select username,password from account";
        $CheckTaiKhoan = true;
        try {
          $statement = $connection->prepare($sql);
          $statement->execute();
          $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
          $acounts = $statement->fetchAll();
          foreach ($acounts as $acount) {
            $usernamedb = $acount['username'] ?? '';
            if (strcasecmp($usernamedb, $taikhoan) == 0) {
              $CheckTaiKhoan = false;
              $CheckLoi  = "Tên tài khoản đã được sử dụng";
            }
          }
        } catch (PDOException $e) {
          echo "Kết nối mysql lỗi không thể truy vấn được";
        }
        if ($CheckTaiKhoan) {
          $sokhong = 0;
          $sql = "INSERT INTO account(username, password, quyenhan) VALUES(?,?,?)";
          try {
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $taikhoan);
            $statement->bindParam(2, $matkhau);
            $statement->bindParam(3, $sokhong);
            $statement->execute();
            //echo "feedback inserted successfully";
            $CheckThanhCong = "Đã đăng ký tài khoản thành công";
          } catch (PDOException $e) {
            echo "Cannot insert feedback into database"
              . $e->getMessage();
          }
        }
      }
    }
  }
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
  <link rel="stylesheet" type="text/css" href="../css/login.css" />
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
            <img src="https://scontent.fdad2-1.fna.fbcdn.net/v/t1.15752-9/315442567_594540852440320_668913642577916755_n.png?_nc_cat=101&ccb=1-7&_nc_sid=ae9488&_nc_ohc=xdHqz5sc4woAX91zjN8&_nc_ht=scontent.fdad2-1.fna&oh=03_AdSBcef7kH3itojET-L0ounnRw2AoCnXGQuGgouHDF3tiQ&oe=63AE9E56" class="brand_logo" alt="Logo" />
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="taikhoan" class="form-control input_user" value="" placeholder="Tài khoản" />
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="matkhau" class="form-control input_pass" value="" placeholder="Mật khẩu" />
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="nhatplaimatkhau" class="form-control input_pass" value="" placeholder="Nhập lại mật khẩu" />
            </div>
            <p class="text-danger"><?php printf($CheckLoi) ?></p>
            <p class="text-success"><?php printf($CheckThanhCong) ?></p>
            <div class="d-flex justify-content-center mt-3 login_container">
              <input type="submit" class="btn login_btn" value="Đăng ký" name="submit" />
            </div>
            <h4> <a href="../index.php" class="ml-3">Trang chủ</a></h4>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>