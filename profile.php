<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cá Nhân</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <?php include 'components/user_header.php'; ?>


    <section class="user-details">

        <div class="user">
            <?php
            $select_user = mysqli_query($conn, "SELECT * FROM  `users` WHERE id = '$user_id'") or die('query failed');
            $fetch_profile = mysqli_fetch_assoc($select_user);
            ?>
            <img src="images/user-icon.png" alt="">
            <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
            <a href="update_profile.php" class="btn">cập nhật thông tin</a>
            <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') {
                                                                                echo 'Điền vào địa chỉ của bạn';
                                                                            } else {
                                                                                echo $fetch_profile['address'];
                                                                            } ?></span></p>
            <a href="update_address.php" class="btn">cập nhật địa chỉ</a>
            <p></p>
        </div>

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>