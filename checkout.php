<?php
session_start();
require_once 'config.php'; // Database connection

// Retain 'name' but show alerts only once
$name = $_SESSION['name'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';

// Clear only used values
unset($_SESSION['alerts'], $_SESSION['active_form']);
if ($name !== null) $_SESSION['name'] = $name;

$roomID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$room = null;

if ($roomID > 0) {
    // 3. Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE roomID = ?");
    $stmt->bind_param('i', $roomID);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();
}

// If no room found, handle gracefully
if (!$room) {
    echo "<h2>Room not found</h2>";
    exit;
}
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
<body style="background-image: url(images/bookNowPic01.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    /* background-attachment: fixed; */
    background-position: center;">
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
    <div class="free-space"></div>

  <div class="booking-container" >
  
    <div class="booking-form-section">
      <h2><?= htmlspecialchars($room['roomType']) ?> Room</h2>
      <div class="row">
        <div>
          <label>Check In</label>
          <input type="text" value="2025-06-24" readonly>
        </div>
        <div>
          <label>Check Out</label>
          <input type="date" value="2025-06-24" readonly>
        </div>
      </div>

      <div class="row">
        <div>
          <label>First Name *</label>
          <input type="text">
        </div>
        <div>
          <label>Last Name *</label>
          <input type="text">
        </div>
      </div>

      <div class="row">
        <div>
          <label>Adult</label>
          <input type="text" value="adult size" readonly>
        </div>
        <div>
          <label>Child</label>
          <input type="text" value="child size" readonly>
        </div>
      </div>

      <label>Special Request</label>
      <textarea placeholder="Special Request"></textarea>

      <label>Estimated arrival time</label>
      <input type="text" placeholder="AM/PM">

      <label>Contact Details</label>
      <div class="row">
        <div>
           <input type="tel" placeholder="Phone Number*" name="phoneNumber" required pattern="^0\d{9}$" maxlength="10" 
                  title="Phone number must be 10 digits and start with 0" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div>
          <input type="email" placeholder="Email *">
        </div>
      </div>
    </div>

  <!-- Booking Summary -->
  <div class="booking-section">
    <h2>Booking Details</h2>
    <div class="summary-box">
      <div><strong><?= htmlspecialchars($room['roomType']) ?> Room</strong></div>
      <div>Check In: 23 Jun 2025</div>
      <div>Check Out: 24 Jun 2025</div>
      <div>Price: LKR 8,263</div>
      <div>Taxes: LKR 2,737.54</div>
      <div class="total">Total: LKR 11,000.54</div>
    </div>

    <div class="checkbox-group">
      
      <label for="terms" class="terms-statement">Clicking the pay now button, you are automatically agreed to the <a href="#">Terms & Conditions.</a></label>
    </div>


   <div class="btn-box2">
     <button class="btn-view2">Pay Now</button>
    <button class="btn-cancel" onclick="window.location.href='index.php'">Cancel</button>
   </div>

   <?php if (empty($name)) : ?>
   <div class="not-login-alert">
            <p>*You may <a href="getStarted.php">Login</a> first to proceed with the booking.</p>
   </div>
    <?php endif ?>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./Script/script.js"></script>
</body>
</html>
