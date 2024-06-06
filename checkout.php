<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = mysqli_real_escape_string($conn, $name);
    $number = $_POST['number'];
    $number = mysqli_real_escape_string($conn, $number);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email);
    $method = $_POST['method'];
    $method = mysqli_real_escape_string($conn, $method);
    $address = $_POST['address'];
    $address = mysqli_real_escape_string($conn, $address);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

    if (mysqli_num_rows($check_cart) > 0) {

        if ($address == '') {
            $message[] = 'vui lòng thêm địa chỉ của bạn!';
        } else {

            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price')");

            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");

            $message[] = 'đơn hàng đã được đặt thành công!';
        }
    } else {
        $message[] = 'Giỏ của bạn trống';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thủ tục thanh toán</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <div class="heading">
        <h3>Thủ tục thanh toán</h3>
        <p><a href="home.php">Trang chủ</a> <span> / Thanh toán</span></p>
    </div>

    <section class="checkout">
        <h1 class="title">Tóm tắt theo thứ tự</h1>

        <form action="" method="post">
            <div class="cart-items">
                <h3>các mặt hàng giỏ hàng</h3>
                <?php
                $grand_total = 0;
                $cart_items = array();
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                ?>
                        <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
                <?php
                    }
                } else {
                    echo '<p class="empty">Giỏ của bạn trống!</p>';
                }
                ?>
                <p class="grand-total"><span class="name">Tổng cộng :</span><span class="price"><?= $grand_total; ?> VND</span></p>
                <a href="cart.php" class="btn">Xem giỏ hàng</a>
            </div>
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

            <div class="user-info">
                <h3>thông tin của bạn</h3>
                <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
                <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
                <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
                <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
                <h3>địa chỉ giao hàng</h3>
                <p><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') {
                                                                    echo 'please enter your address';
                                                                } else {
                                                                    echo $fetch_profile['address'];
                                                                } ?></span></p>
                <a href="update_address.php" class="btn">cập nhật địa chỉ</a>
                <select name="method" class="box" required>
                    <option value="" disabled selected>chọn phương thức thanh toán --</option>
                    <option value="cash on delivery">thanh toán khi giao hàng</option>
                    <option value="credit card">thẻ tín dụng</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
                <input type="submit" value="đặt hàng" class="btn <?php if ($fetch_profile['address'] == '') {
                                                                        echo 'disabled';
                                                                    } ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
            </div>

        </form>

    </section>

</body>

</html>