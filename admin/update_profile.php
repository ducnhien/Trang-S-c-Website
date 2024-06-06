<?php

include "../components/connect.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("location:admin_login.php");
}

if(isset($_POST["submit"])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    if(!empty($name)) {
        $select_name = mysqli_query($conn, "SELECT * FROM `admin` WHERE name = '$name'") or die('query failed');
        if(mysqli_num_rows($select_name) > 0) {
            $message[] = 'tên người dùng đã được sử dụng!';
        }else{
            $update_name = mysqli_query($conn, "UPDATE `admin` SET name = '$name' WHERE id = '$admin_id'") or die('query failed');
        }
    }

    $empty_pass = '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2';
    $select_old_pass = mysqli_query($conn, "SELECT password FROM `admin` WHERE id = '$admin_id'") or die("query failed");
    $fetch_prev_pass = mysqli_fetch_assoc($select_old_pass);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
            $message[] = 'mật khẩu cũ không khớp';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'xác nhận mật khẩu không khớp';
        }else{
            if($new_pass != $empty_pass){
                $update_pass = mysqli_query($conn,"UPDATE `admin` SET password = '$confirm_pass' WHERE id = '$admin_id'") or die('query failed');
                $message[] = 'Đã cập nhật mật khẩu thành công!';
            }else{
                $message[] = 'vui lòng nhập mật khẩu mới!';
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
    <title>cập nhật hồ sơ</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="form-container">
        <form action="" method="post">
            <h3>cập nhật hồ sơ</h3>
            <input type="text" name="name" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $fetch_profile['name']; ?>">
            <input type="password" name="old_pass" maxlength="20" placeholder="nhập mật khẩu cũ của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" maxlength="20" placeholder="Nhập mật khẩu mới của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="confirm_pass" maxlength="20" placeholder="xác nhận mật khẩu mới của bạn" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="cập nhật" name="submit" class="btn">
        </form>
    </section>

    <script src="../js/admin_script.js"></script>

</body>

</html>