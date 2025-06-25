<?php
session_start();
require_once 'config.php'; // Database connection

// Retain 'name' for navbar
$name = $_SESSION['name'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';
unset($_SESSION['alerts'], $_SESSION['active_form']);
if ($name !== null) $_SESSION['name'] = $name;

// Get room ID from URL
$roomID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$room = null;
$featuresByCategory = [];

if ($roomID > 0) {
    // Fetch room data
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE roomID = ?");
    $stmt->bind_param('i', $roomID);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();

    if ($room) {
        // Fetch feature data grouped by category
        $featureSQL = "
            SELECT rf.fName, rf.fCategory
            FROM room_feature_map rfm
            JOIN room_features rf ON rfm.featureID = rf.featureID
            WHERE rfm.roomID = ?
        ";
        $stmt2 = $conn->prepare($featureSQL);
        $stmt2->bind_param("i", $roomID);
        $stmt2->execute();
        $featuresResult = $stmt2->get_result();

        while ($feature = $featuresResult->fetch_assoc()) {
            $fCategory = $feature['fCategory'];
            $fName = $feature['fName'];
            if (!isset($featuresByCategory[$fCategory])) {
                $featuresByCategory[$fCategory] = [];
            }
            $featuresByCategory[$fCategory][] = $fName;
        }
    }
}

// Handle room not found
if (!$room) {
    echo "<h2>Room not found</h2>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Savendra Gardens</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="./Styles/style.css">

</head>
<body>
  <!-- Header -->
  <header class="header">
    <a href="index.php" class="logo"><i class="fas fa-hotel"></i> Savendra Garden</a>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="rooms.php">Rooms</a>
      <a href="payments.php">Payments</a>
      <a href="helpAndSupport.php">Help & Support</a>
      <a href="FAQ.php">FAQ</a>
    </nav>
    <div id="menu-btn"><i class="fas fa-bars"></i></div>
    <div class="user-auth">
      <?php if (!empty($name)) : ?>
        <div class="profile-box">
          <div class="avatar-circle"><?= strtoupper($name[0]); ?></div>
          <div class="user-dropdown">
            <a href="#">My Account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      <?php else : ?>
        <a id="btnGetStarted" href="getStarted.php">Get Started</a>
      <?php endif; ?>
    </div>
  </header>

  <div class="free-space"></div>

  <!-- Room Details -->
  <div class="room-details-container">
    <a href="bookNow.php" class="back-arrow"><i class="fa fa-angle-left" style="font-size:36px"></i></a>
    
    <div class="room-header">
      <h2><?= htmlspecialchars($room['roomNumber']) ?></h2>
    </div>

    <div class="room-main">
      <div class="room-image">
        <img src="uploads/<?= htmlspecialchars($room['roomImage']) ?>" alt="<?= htmlspecialchars($room['roomNumber']) ?>">
      </div>
      <div class="room-description">
        <p><?= nl2br(htmlspecialchars($room['roomDescription'])) ?></p>
      </div>
    </div>

    <?php if (!empty($featuresByCategory)) : ?>
      <div class="facilities-section">
        <?php foreach ($featuresByCategory as $fCategory => $features): ?>
          <div class="facility-column">
            <h3><?= htmlspecialchars($fCategory) ?></h3>
            <ul>
              <?php foreach ($features as $featureName): ?>
                <li><?= htmlspecialchars($featureName) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="btn-box">
      <a href="checkout.php?id=<?= $room['roomID'] ?>" class="btn-view2">Book Now</a>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="./Script/script.js"></script>
</body>
</html>
