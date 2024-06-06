<?php

include "../components/connect.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};

if (isset($_POST['update'])) {

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);

    $update_product = mysqli_query($conn, "UPDATE `products` SET name = '$name', category = '$category', price = '$price' WHERE id = '$pid'") or die("query failed");

    $message[] = 'sản phẩm được cập nhật!';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'kích thước hình ảnh quá lớn';
        } else {
            $update_image = mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$pid'") or die('query failed');
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../uploaded_img/' . $old_image);
            $message[] = 'hình ảnh được cập nhật';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>

    <!-- Font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../CSS/admin_style.css">
</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="update-product">

        <h1 class="heading">Cập nhật sản phẩm</h1>

        <?php
        $update_id = $_GET['update'];
        $show_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        if (mysqli_num_rows($show_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($show_products)) {
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
                    <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                    <span>cập nhật tên</span>
                    <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
                    <span>cập nhật giá</span>
                    <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
                    <span>cập nhật danh mục</span>
                    <select name="category" class="box" required>
                        <option value="main dish">Rau</option>
                        <option value="fast food">Củ quả</option>
                        <option value="drinks">Thịt</option>
                    </select>
                    <span>cập nhật hình ảnh</span>
                    <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
                    <div class="flex-btn">
                        <input type="submit" value="cập nhật" class="btn" name="update">
                        <a href="products.php" class="option-btn">quay lại</a>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
        }
        ?>

    </section>

    <script src="../js/admin_script.js"></script>

</body>

</html>