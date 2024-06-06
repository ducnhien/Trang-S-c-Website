<?php
include 'components/connect.php';

if (isset($message)) {
    foreach ($message as $message) {
        echo '
            <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        ';
    }
}
?>

<header class="header">

    <section class="flex">

        <a href="home.php" class="logo">TrangSucS.VN</a>

        <nav class="navbar">
            <a href="home.php">trang chủ</a>
            <a href="about.php">thông tin</a>
            <a href="menu.php">sản phẩm</a>
            <a href="orders.php">đơn hàng</a>
            <a href="contact.php">liên hệ</a>
        </nav>

        <div class="icons">
            <?php
            $count_cart_items = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
            $total_cart_items = mysqli_num_rows($count_cart_items);
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <?php
            $select_profile = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
            if (mysqli_num_rows($select_profile)) {
                $fetch_profile = mysqli_fetch_assoc($select_profile);
            ?>
                <p class="name"><?= $fetch_profile['name']; ?></p>
                <div class="flex">
                    <a href="profile.php" class="btn">Cá nhân</a>
                    <a href="components/user_logout.php" onclick="return confirm('bạn có chắc muốn đăng xuất?');" class="delete-btn">logout</a>
                </div>
                <p class="account">
                    <a href="login.php">đăng nhập</a>
                    <a href="register.php">đăng ký</a>
                </p>
            <?php
            } else {
            ?>
                <p class="name">Đăng nhập để mua hàng!</p>
                <a href="login.php" class="btn">Đăng nhập</a>
            <?php
            }
            ?>
        </div>

    </section>

</header>