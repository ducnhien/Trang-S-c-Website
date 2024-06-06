<?php

include "../components/connect.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="dashboard">

        <h1 class="heading">Bảng điều khiển</h1>

        <div class="box-container">

            <div class="box">
                <h3>Chào mừng</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update_profile.php" class="btn">cập nhật thông tin</a>
            </div>

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
                    $total_pendings += $fetch_pendings['total_price'];
                }
                ?>
                <h3><span></span><?= $total_pendings; ?><span> VND</span></h3>
                <p>tổng đang sử lý</p>
                <a href="placed_orders.php" class="btn">xem</a>
            </div>

            <div class="box">
                <?php
                $select_orders = mysqli_query($conn,'SELECT * FROM `orders`') or die('query failed');
                $numbers_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?= $numbers_of_orders; ?></h3>
                <p>tổng đơn hàng</p>
                <a href="placed_orders.php" class="btn">Xem đơn</a>
            </div>

            <div class="box">
                <?php
                $select_products = mysqli_query($conn,'SELECT * FROM `products`') or die('query failed');
                $numbers_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?= $numbers_of_products; ?></h3>
                <p>Sản phẩm đã thêm</p>
                <a href="products.php" class="btn">Xem sản phẩm</a>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query($conn,'SELECT * FROM `users`') or die('query failed');
                $numbers_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?= $numbers_of_users; ?></h3>
                <p>Tải khoản người dùng</p>
                <a href="users_accounts.php" class="btn">Xem</a>
            </div>

            <div class="box">
                <?php
                $select_admins = mysqli_query($conn,'SELECT * FROM `admin`') or die('query failed');
                $numbers_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?= $numbers_of_admins; ?></h3>
                <p>tải khoản quản trị</p>
                <a href="admin_accounts.php" class="btn">Xem</a>
            </div>

            <div class="box">
                <?php
                $select_messages = mysqli_query($conn,'SELECT * FROM `messages`') or die('query failed');
                $numbers_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?= $numbers_of_messages; ?></h3>
                <p>Thông báo mới</p>
                <a href="messages.php" class="btn">Xem thông báo</a>
            </div>

        </div>

    </section>


    <script src="../js/script.js"></script>

</body>

</html>