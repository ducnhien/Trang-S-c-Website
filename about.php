<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thông Tin</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <div class="heading">
        <h3>Giới thiệu</h3>
        <p><a href="home.php">trang chủ</a> <span> / tranng thông tin</span></p>
    </div>

    <section class="about">

        <div class="row">

            <div class="image">
                <img src="images/about.png" alt="">
            </div>

            <div class="content">
                <h3>Vì sao bạn nên chọn chúng tôi?</h3>
                <p>Cửa hàng trang sức của chúng tôi tự hào mang đến những sản phẩm tinh tế và sang trọng, được chế tác từ các loại đá quý hiếm và kim loại quý như vàng, bạc, bạch kim. Mỗi món trang sức đều được thiết kế tỉ mỉ, kết hợp hài hòa giữa phong cách truyền thống và hiện đại, tạo nên vẻ đẹp độc đáo và cuốn hút.</p>
                <a href="menu.php" class="btn">trang sản phẩm</a>
            </div>

        </div>

    </section>

    <section class="steps">

        <h1 class="title">các bước đơn giản</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/step-1.png" alt="">
                <h3>chọn sản phẩm</h3>
                <p>Hãy lựa chọn sản phẩm mà bạn cần, sau đó thêm nó vào giỏ hàng và thanh toán!</p>
            </div>

            <div class="box">
                <img src="images/step-2.png" alt="">
                <h3>giao hàng nhanh</h3>
                <p>sản phẩm sẽ được giao đếm bạn trong thời gian sớm nhất</p>
            </div>

            <div class="box">
                <img src="images/step-3.png" alt="">
                <h3>Trải nghiệm sản phẩm</h3>
                <p>Hãy trải nghiệm phẩm và đừng quên để lại đánh giá của mình</p>
            </div>

        </div>

    </section>

    <section class="reviews">

        <h1 class="title">đánh giá từ khách hàng</h1>

        <div class="swiper reviews-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/pic-1.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 1</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-2.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 2</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-3.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 3</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-4.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 4</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-5.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 5</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-6.png" alt="">
                    <p>Sản phẩm thực sự tuyệt vời ngoài sức mong đợi của tôi.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>khách hàng 6</h3>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".reviews-slider", {
            loop: true,
            grabCursor: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                700: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>