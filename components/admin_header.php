<?php
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

        <a href="dashboard.php" class="logo">Bảng<span> quản lý</span></a>

        <nav class="navbar">
            <a href="dashboard.php">Trang chủ</a>
            <a href="products.php">Sản phẩm</a>
            <a href="placed_orders.php">Đơn hàng</a>
            <a href="admin_accounts.php">Tài khoản</a>
            <a href="users_accounts.php">Người dùng</a>
            <a href="messages.php">Thông báo</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            $select_profile = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$admin_id'");
            $fetch_profile = mysqli_fetch_assoc($select_profile);
            ?>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">cập nhật thông tin</a>
            <div class="flex-btn">
                <!-- <a href="admin_login.php" class="option-btn">đăng nhập</a> -->
                <!-- <a href="register_admin.php" class="option-btn">đăng ký</a> -->
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('bạn có chắc muốn đăng xuất?'); " class="delete-btn">đăng xuất</a>
        </div>

    </section>

</header>