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
        <a href="gallery.php">Payments</a>
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




 <?php if (!empty($alerts)) : ?>
        <div class="alert-box">
            <?php foreach ($alerts as $alert) : ?>
                <div class="alert <?= $alert['type']; ?>">
                    <i class="bx <?php $alert['type'] === 'success' ? 'bxs-check-circle' : 'cxs-x-circle'; ?>"></i>
                    <span><?php $alert['message']; ?></span>
                </div>
                <?php endforeach; ?>
        </div>
        <?php endif; ?>

   
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
