<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savendra Gardens</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- swiper js cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- custom css link -->
    <link rel="stylesheet" href="./Styles/style.css">

    
</head>
<body>
   <header class="header">
    <a href="index.php" class="logo"><i class="fas fa-hotel"></i> Savendra Garden</a>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="payments.php">Payments</a>
        <a href="helpAndSupport.php">Help & Support</a>
        <a href="FAQ.php">FAQ</a>
        <a id="btnGetStarted" href="getStarted.php">Get Started</a>
        
    </nav>
    <div id="menu-btn" ><i class="fas fa-bars"></i></div>


   </header>

   <section class="home" id="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
        <div class="swiper-slide slide" style="background: url(images/homeSlide01.jpg) no-repeat; background-size: cover;">
            <div class="content">
                <h3 class="fade-item">Luxury Living</h3>
                <h2 class="fade-item">Book hotels instantly from Us <br> Find Your Perfect Stay</h2>
                <div class="button-group">
                    <a href="bookNow.php" class="btn fade-item">Book Now</a>
                    <a href="aboutUs.php" class="btn btn-outline fade-item">Learn More</a>
                </div>
            </div>
        </div>
         <div class="swiper-slide slide" style="background: url(images/homeSlide02.jpg) no-repeat; background-size: cover;">
            <div class="content">
                <h3 class="fade-item">Luxury Living</h3>
                <h2 class="fade-item">where comfort meets convenience <br> start your journey here</h2>
                <div class="button-group">
                    <a href="bookNow.php" class="btn fade-item">Book Now</a>
                    <a href="aboutUs.php" class="btn btn-outline fade-item">Learn More</a>
                </div>
            </div>
        </div>
         <div class="swiper-slide slide" style="background: url(images/homeSlide03.jpg) no-repeat; background-size: cover;">
            <div class="content">
                <h3 class="fade-item">Luxury Living</h3>
                <h2 class="fade-item">your next adventure starts with <br> the right room</h2>
                <div class="button-group">
                    <a href="bookNow.php" class="btn fade-item">Book Now</a>
                    <a href="aboutUs.php" class="btn btn-outline fade-item">Learn More</a>
                </div>
            </div>
        </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

   </section>
 
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./Script/script.js"></script>
</body>
</html>
