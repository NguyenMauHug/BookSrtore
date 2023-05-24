<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Order Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['action']) && $_GET['action'] = 'delete') {
        if (isset($_SESSION['carts'])) {
            $carts = $_SESSION['carts'];
            unset($carts[$_GET['id']]);
            $_SESSION['carts'] = $carts;
        }
        echo header("Refresh: 0; url = /Book_Store/cart/cart.php");
    }

    if (isset($_GET['action']) && $_GET['action'] = 'add') {
        if (isset($_SESSION['carts'])) {
            $carts = $_SESSION['carts'];
            if (!array_key_exists($_GET['id'], $carts)) {
                $carts[$_GET['id']] = [
                    'name' => $_GET['name'],
                    'price' => $_GET['price'],
                    'image' => $_GET['image'],
                    'quantity' => 1
                ];
            } else {
                $carts[$_GET['id']] = [
                    'name' => $_GET['name'],
                    'price' => $_GET['price'],
                    'image' => $_GET['image'],
                    'quantity' => $carts[$_GET['id']]['quantity'] + 1
                ];
            }
            $_SESSION['carts'] = $carts;
        } else {
            $carts[$_GET['id']] = [
                'name' => $_GET['name'],
                'price' => $_GET['price'],
                'image' => $_GET['image'],
                'quantity' => 1
            ];
            $_SESSION['carts'] = $carts;
        }
        echo header("Refresh: 0; url = /Book_Store/cart/cart.php");
    }
    // Thanh toán
    if (isset($_POST['checkout'])) {
        if (isset($_SESSION['carts']) && count((array) $_SESSION['carts']) > 0) {
            $conn = new mysqli("localhost", "root", "", "booksql")  or die("Ket noi that bai");
            $conn->set_charset("UTF8");
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            $total = $_POST['total'];
            try {
                $insert_order = "insert into orders(name, phone, address, note, total) 
            values('$name', '$phone', '$address','$note', '$total')";
                $result = $conn->query($insert_order);
                $query_get_order_id = "select * from orders order by id desc limit 1";
                $order_cur = $conn->query($query_get_order_id)->fetch_assoc();
                $order_id = $order_cur['id'];
                $carts = (array) $_SESSION['carts'];
                foreach ($carts as $key => $product) {
                    $quantity = $product['quantity'];
                    $price_unit = $product['price'];
                    $conn->query("insert into order_detail(order_id, product_id, quantity, price_unit) 
            values('$order_id', '$key', '$quantity','$price_unit')");
                }
            } catch (Exception $e) {
                echo '<script>alert("Đặt hàng không thành công")</script>';
            }
            echo '<script>alert("Đặt hàng thành công")</script>';
            unset($_SESSION['carts']);
        }
        echo header("Refresh: 0; url = /Book_Store/cart/cart.php");
    }
    ?>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="/Book_Store" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>SHOPPING</a></h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">CART</p>
                                            <p class="mb-0">Your shopping cart contains: <?php echo isset($_SESSION['carts']) ? count((array) $_SESSION['carts']) : 0; ?> products of cart</p>
                                        </div>
                                    </div>
                                    <?php
                                    $total = 0;
                                    if (isset($_SESSION['carts']) && count((array) $_SESSION['carts']) > 0) {
                                        foreach ($_SESSION['carts'] as $key => $product) {
                                            $total += $product['quantity'] * $product['price'];
                                    ?>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div>
                                                                <img src="../<?php echo $product['image'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h5><?php echo $product['name'] ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                <h5 class="fw-normal mb-0"><?php echo $product['quantity'] ?></h5>
                                                            </div>
                                                            <div style="width: 120px;">
                                                                <h5 class="mb-0"><?php echo number_format($product['price'], 0, '.', ',') ?>$</h5>
                                                            </div>
                                                            <a href="/Book_Store/cart/cart.php?action=delete&id=<?php echo $key ?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><?php  }
                                            } ?>

                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body" style="background-color: #E5B7BF;">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Payment</h5>
                                            </div>

                                            <form class="mt-4" method="POST" action="">
                                                <div class="form-outline form-white mb-4">
                                                    <input type="text" id="typeName" name="name" class="form-control form-control-lg" siez="17" placeholder="Tên người nhận" required />
                                                    <label class="form-label" for="typeName">Receiver</label>
                                                </div>

                                                <div class="form-outline form-white mb-4">
                                                    <input type="text" id="typeText" name="phone" class="form-control form-control-lg" siez="17" placeholder="Số điện thoại" required minlength="10" maxlength="10" />
                                                    <label class="form-label" for="typeText">Phone number</label>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="typeExp" name="address" class="form-control form-control-lg" placeholder="Địa chỉ" required size="100" id="exp" minlength="1" maxlength="200" />
                                                            <label class="form-label" for="typeExp">Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="typeText" name="note" class="form-control form-control-lg" placeholder="Ghi chú" size="1" minlength="3" maxlength="200" />
                                                            <label class="form-label" for="typeText">Note</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Price</p>
                                                    <p class="mb-2"><?php echo number_format($total, 0, '.', ',') ?>$</p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Delivery charges</p>
                                                    <p class="mb-2"><?php echo number_format(3, 0, '.', ',') ?>$</p>
                                                </div>

                                                <div class="d-flex justify-content-between mb-4">
                                                    <p class="mb-2">Total</p>
                                                    <p class="mb-2"><?php echo isset($_SESSION['carts']) && count((array) $_SESSION['carts']) > 0 ? number_format($total + 3, 0, '.', ',') : 0 ?>$</p>
                                                </div>

                                                <button name="checkout" class="btn btn-block btn-lg" style="background-color: #DA86A5;">
                                                    <div class="d-flex justify-content-between">
                                                        <span><?php echo isset($_SESSION['carts']) && count((array) $_SESSION['carts']) > 0 ? number_format($total + 3, 0, '.', ',') : 0 ?> $</span>
                                                        <span>Payment<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>
                                                <input type="hidden" name="total" value="<?php echo $total ?>" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>