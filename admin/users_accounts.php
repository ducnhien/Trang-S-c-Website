<?php

include "../components/connect.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_users = mysqli_query($con, "DELETE FROM `users` WHERE id = '$delete_id'") or die("query failed");
   $delete_order = mysqli_query($con, "DELETE FROM `orders` WHERE user_id = '$delete_id'") or die("query failed");
   $delete_cart = mysqli_query($con, "DELETE FROM `cart` WHERE user_id = '$delete_id'") or die("query failed");
   header("location:users_accounts.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tài khoản người dùng</title>

   <!-- Font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="../CSS/admin_style.css">
</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <section class="accounts">
      <h1 class="heading">tài khoản người dùng</h1>

      <div class="box-container">
         <?php
         $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if (mysqli_num_rows($select_account) > 0) {
            while ($fetch_accounts = mysqli_fetch_assoc($select_account)) {
         ?>
               <div class="box">
                  <p> tên người dùng : <span><?= $fetch_accounts['id']; ?></span> </p>
                  <p> tên tài khoản : <span><?= $fetch_accounts['name']; ?></span> </p>
                  <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('xóa tài khoản này?');">xóa</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">không có tài khoản nào</p>';
         }
         ?>
      </div>

   </section>

   <script src="../js/admin_script.js"></script>

</body>

</html>