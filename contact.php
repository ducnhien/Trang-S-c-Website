<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $name = mysqli_real_escape_string($conn, $name);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email);
    $number = $_POST['number'];
    $number = mysqli_real_escape_string($conn, $number);
    $msg = $_POST['msg'];
    $msg = mysqli_real_escape_string($conn, $msg);

    $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'");

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'đã gửi tin nhắn rồi!';
    } else {

        mysqli_query($conn, "INSERT INTO `messages`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')");

        $message[] = 'đã gửi tin nhắn thành công!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang phản hồi</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <div class="heading">
        <h3>Liên hệ chúng tôi</h3>
        <p><a href="home.php">Trang chủ</a> <span> / Liên hệ</span></p>
    </div>

    <section class="contact">

        <div class="row">

            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>

            <form action="" method="post">
                <h3>Phản hồi ý kiến của bạn!</h3>
                <input type="text" name="name" maxlength="50" class="box" placeholder="nhập tên của bạn">
                <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="nhập số của bạn" required maxlength="10">
                <input type="email" name="email" maxlength="50" class="box" placeholder="nhập email của bạn">
                <textarea name="msg" class="box" required placeholder="Nhập tin nhắn của bạn" maxlength="500" cols="30" rows="10"></textarea>
                <input type="submit" value="gửi tin nhắn" name="send" class="btn">
            </form>

        </div>

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>