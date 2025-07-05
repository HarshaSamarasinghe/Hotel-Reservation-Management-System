<?php
session_start();

// Retain 'name' but show alerts only once
$name = $_SESSION['name'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';

// Clear only used values
unset($_SESSION['alerts'], $_SESSION['active_form']);
if ($name !== null) $_SESSION['name'] = $name;
?>

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
        
    </nav>
    <div id="menu-btn" ><i class="fas fa-bars"></i></div>

    <div class="user-auth">
      <?php if(!empty($name)) : ?>
        <div class="profile-box">
          <div class="avatar-circle"><?= strtoupper($name[0]); ?></div>
          <div class="user-dropdown">
            <a href="#">My Account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      <?php else : ?>
          <a id="btnGetStarted" href="getStarted.php" >Get Started</a>
      <?php endif; ?>
      </div>
      


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

   <!-- about Section -->
  <section class="about" id="about">
  <h1 class="heading">About <span>Us</span></h1>
  <div class="row">
    <div class="image">
      <img src="images/aboutUs.jpg" alt="Savendra Garden">
    </div>
    <div class="content">
      <h3>Welcome to Savendra Gardens</h3>
      <p class="about-description">
        Nestled amidst the lush greenery and peaceful surroundings, <strong>Savendra Gardens</strong> is your perfect escape from the 
        hustle and bustle of everyday life. Our hotel blends modern luxury with natural beauty, offering a serene retreat
         for travelers seeking comfort, relaxation, and memorable experiences.<br>

        At Savendra Gardens, we pride ourselves on exceptional service, eco-friendly hospitality, and attention to every detail. 
        Whether you're here for a romantic getaway, a family vacation, or a business trip, we ensure your stay is both peaceful and inspiring.<br>

        From tastefully designed rooms and lush garden views to personalized guest services and convenient amenities, we create an environment 
        where you feel at home , yet completely refreshed.<br>
        Come experience <strong>Savendra Gardens</strong>, where every stay tells a story.
      </p>

      <div class="philosophy">
  <div class="philosophy-item">
    <i class="fas fa-globe"></i>
    <h4>Global Elegance</h4>
    <p>Our design and ambiance reflect a refined global standard, 
        offering every guest a touch of luxury and sophistication inspired by the world's finest stays.</p>
  </div>
  <div class="philosophy-item">
    <i class="fas fa-heart"></i>
    <h4>Heartfelt Service</h4>
    <p>We believe in genuine hospitality. Every detail, from your arrival to your farewell, 
        is guided by warmth, care, and a deep passion for guest satisfaction.</p>
  </div>
  <div class="philosophy-item">
    <i class="fas fa-leaf"></i>
    <h4>Eco-Friendly Living</h4>
    <p>At Savendra Gardens, sustainability is more than a promise. We embrace green choices
         to protect nature and ensure a cleaner tomorrow.</p>
  </div>
</div>

    </div>
  </div>
</section>
<!-- about Section End -->

<!-- Service section starts  -->

<section class="services" id="services">
  <h1 class="heading">Our <span>Services</span></h1>
  <div class="box-container">
    <div class="box">
      <i class="fas fa-swimming-pool"></i>
      <h3>Swimming Pool</h3>
      <p>Enjoy a refreshing dip in our luxurious outdoor pool.</p>
    </div>
    <div class="box">
      <i class="fas fa-utensils"></i>
      <h3>Food & Drink</h3>
      <p>Delight in a variety of local and international cuisine.</p>
    </div>
    <div class="box">
      <i class="fas fa-hotel"></i>
      <h3>Restaurant</h3>
      <p>Dine in style with gourmet meals served daily.</p>
    </div>
    <div class="box">
      <i class="fas fa-dumbbell"></i>
      <h3>Fitness</h3>
      <p>Stay active with our fully equipped fitness center.</p>
    </div>
    <div class="box">
      <i class="fas fa-spa"></i>
      <h3>Beauty Spa</h3>
      <p>Relax and rejuvenate with our signature spa treatments.</p>
    </div>
    <div class="box">
      <i class="fas fa-umbrella-beach"></i>
      <h3>Resort Beach</h3>
      <p>Unwind by the private beach with golden sands and waves.</p>
    </div>
    <div class="box">
      <i class="fas fa-concierge-bell"></i>
      <h3>24/7 Concierge</h3>
      <p>Our concierge team is always here to assist you.</p>
    </div>
    <div class="box">
      <i class="fas fa-parking"></i>
      <h3>Car Parking</h3>
      <p>Safe and spacious parking facilities available onsite.</p>
    </div>
  </div>
</section>
<!--Service section end-->

<section class="gallery" id="gallery">
        <h1 class="heading">Our <span> Gallery</span></h1>
        <div class="swiper gallery-slider">
          <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <img src="./images/gallery01.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery02.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery03.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery04.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery05.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery06.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
            <div class="swiper-slide slide">
                <img src="./images/gallery07.jpg" alt="">
                <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
                </div>
            </div>
          </div>
        </div>
</section>
<div class="popup-image">
  <div class="popup-header">
    <span class="image-count">1/6</span>
    <span class="close-btn">&times;</span>
  </div>

  <button class="prev-btn">&#10094;</button>
  <button class="next-btn">&#10095;</button>
  <img src="" alt="">
</div>

 
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>