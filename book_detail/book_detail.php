<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <title>Document</title>
</head>
<style>
    /* background image page web */
    body,
    html {
        height: 100%;
        margin: 0;
    }

    .bg {
        background-image: url("../images/background.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body class="bg">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['category']) && $_GET['category'] != '') {
        $conn = new mysqli("localhost", "root", "", "booksql")  or die("Ket noi that bai");
        $conn->set_charset("UTF8");
        $sql = "select * from products where category = " . $_GET['category'];
        $result = $conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        foreach ($data as $key => $pro) {
            if ($pro['id'] == $_GET['id']) {
                $data[$key] = $data[1];
                $data[1] = $pro;
            }
        }
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
    ?>
    <main>
        <!-- COLLECTION-->
        <div class="container collection">
            <div class="section_header">
                <h1 style="text-align: center"><?php echo $data[1]['name'] ?></h1>
            </div>
            <h2>Information</h2>
            <p>
                <?php echo $data[1]['description'] ?> </p>
            <h2>Product</h2>
            <div class="container-fluid content row">
                <?php foreach ($data as $product) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="img_frame">
                                <img src="../<?php echo $product['image'] ?>" height="400px" class="card-img-top" alt="..." />
                            </div>
                            <div class="card-body">
                                <a href="/Book_Store/cart/cart.php?action=add&id=<?php echo $product['id'] ?>&name=<?php echo $product['name'] ?>&price=<?php echo $product['price'] ?>&image=<?php echo $product['image'] ?>" class=" btn btn-primary">Mua ngay</a>
                                <a class="btn btn-primary"><?php echo number_format($product['price'], 0, '.', ',') ?>$</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </main>
</body>

</html>