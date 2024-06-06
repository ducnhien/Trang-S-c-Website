<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' OR number = '$number'") or die('query failed');
    $row = mysqli_fetch_array($select_user);

    if (mysqli_num_rows($select_user) > 0) {
        $message[] = 'email or number already exsits';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched';
        } else {
            $insert_user = mysqli_query($conn, "INSERT INTO `users`(name, email, number, password) VALUES('$name', '$email', '$number', '$cpass')");
            $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'");
            $row = mysqli_fetch_assoc($select_user);
            if (mysqli_num_rows($select_user) > 0) {
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <?php include 'components/user_header.php' ?>

    <section class="form-container">
        <form action="" method="post">
            <h3>đăng ký ngay</h3>
            <input type="text" name="name" placeholder="nhập tên" class="box" maxlength="50">
            <input type="email" name="email" placeholder="nhập email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="number" name="number" placeholder="nhập số điện thoại" class="box" min="0" max="9999999999" maxlength="10">
            <input type="password" name="pass" placeholder="nhập mật khẩu" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" placeholder="xác nhận lại mật khẩu" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="đăng ký" name="submit" class="btn">
            <p>bạn đã có tài khoản rồi ? <a href="login.php">đăng nhập ngay</a></p>
        </form>
    </section>

    <?php include 'components/footer.php' ?>

    <script src="js/script.js"></script>

</body>

</html>