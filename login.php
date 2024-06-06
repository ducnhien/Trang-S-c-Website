<?php

include "components/connect.php";

session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $select_user);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');
    } else {
        $message[] = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <!-- header section -->
    <?php include 'components/user_header.php'; ?>

    <section class="form-container">
        <form action="" method="post">
            <input type="email" name="email" required placeholder="Nhập email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Nhập mật khẩu" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="đăng nhập" name="submit" class="btn">
            <p>Bạn không có tài khoản? <a href="register.php">đăng ký ngay</a></p>
        </form>
    </section>

</body>

</html>