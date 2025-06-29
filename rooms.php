<?php
session_start();
require_once 'config.php'; // Database connection

// Retain 'name' but show alerts only once
$name = $_SESSION['name'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];

// Clear only used values
if ($name !== null) $_SESSION['name'] = $name;
$N0_ROOMS_AVAILABLE = false; // Initialize availability flag

// Capture form values
isset($_POST['check_availability']);

$rooms = [];
    $stmt = $conn->prepare("SELECT * FROM rooms");
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
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

   
<?php if (!empty($rooms)): ?>
    <section class="available-rooms">
        <h2>Our Rooms</h2>
        <div class="room-grid">
            <?php foreach ($rooms as $room): ?>
                <div class="room-card">
                    <img src="uploads/<?= $room['roomImage'] ?>" alt="<?= htmlspecialchars($room['roomNumber']) ?>">
                    <h3><?= htmlspecialchars($room['roomType']) ?> Room</h3>
                    <p><?= htmlspecialchars($room['roomDescription']) ?></p>
                    <h4 class="price">Rs. <?= number_format($room['rPricePerDay'], 2) ?> <span class="price-span">per night</span></h4>
                    <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="<?= $room['isAvailable'] == 1 ? 'available' : 'not-available' ?>">
                      <?= $room['isAvailable'] == 1 ? 'Available' : 'Not Available' ?>
                    </span><br>
                    <div class="responsive-btn"><a href="singleRoomDetails.php?id=<?= $room['roomID'] ?>" class="btn-view">View Details</a></div>
                    
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php else : ?>
    <section class="available-rooms-false">
        <h2>Our Rooms</h2>
        <p style="padding: 20px; font-size: 18px;">No rooms available.</p>
    </section>
<?php endif; ?>

   <!-- <section class="room" id="room">
    <h1 class="heading">Our Rooms</h1>
    <div class="swiper room-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <div class="image">
            <span class="price">Rs.1000</span>
            <img src="images/hotel.jpg" alt="">
            <a href="" class="fas fa-shopping-cart"></a>
          </div>
          <div class="content">
            <h3>exclusive room</h3>
            <p>sample sdfhidjgsos sfhsdiufhsdhjvg seghusidfhsig senijahgbuanfg</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <a href="" class="btn">Book Now</a>
          </div>
        </div>

        
      </div>
    </div>
   </section> -->
    
   
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./Script/script.js"></script>
</body>
</html>
