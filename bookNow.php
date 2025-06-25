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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $check_in = $_POST["check_in"];
    $check_out = $_POST["check_out"];
    $adults = (int)$_POST["adults"];
    $children = (int)$_POST["children"];
    

    // Example: Search rooms based on adult/child capacity and availability
    $stmt = $conn->prepare("SELECT * FROM rooms 
    WHERE isAvailable = 1 AND adultsCapacity >= ? AND childrenCapacity >= ? ");
    $stmt->bind_param("ii", $adults, $children);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = $result->fetch_all(MYSQLI_ASSOC);
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
   <div class="container">
   <section class="home" id="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
           <div class="swiper-slide slide" style="background: url(images/bookNowPic01.jpg) no-repeat; background-size: cover;">
            <div class="form-content">
              <div class="form-box">
                <form action="bookNow.php" method="POST" class="availability-form">
                  <div class="box">
                    <p>Check In<span>*</span></p>
                    <input type="date" name="check_in" class="input" required>
                  </div>
                  <div class="box">
                    <p>Check Out<span>*</span></p>
                    <input type="date" name="check_out" class="input" required>
                  </div>
                  <div class="box">
                    <p>Adults<span>*</span></p>
                    <select name="adults" id="adults" class="input" required>
                      <option value="">Select Adults</option>
                      <option value="1">1 Adult</option>
                      <option value="2">2 Adults</option>
                      <option value="3">3 Adults</option>
                      <option value="4">4 Adults</option>
                      <option value="5">5 Adults</option>
                      <option value="6">6 Adults</option>
                    </select>
                  </div>
                  <div class="box">
                    <p>Children<span>*</span></p>
                    <select name="children" id="children" class="input" required>
                      <option value="">Select Children</option>
                      <option value="0">No Children</option>
                      <option value="1">1 Child</option>
                      <option value="2">2 Children</option>
                      <option value="3">3 Children</option>
                      <option value="4">4 Children</option>
                      <option value="5">5 Children</option>
                      <option value="6">6 Children</option>
                    </select>
                  </div>
                  <div class="box">
                    <p>Rooms<span>*</span></p>
                    <select name="rooms" id="rooms" class="input" required>
                      <option value="">Select Rooms</option>
                      <option value="1">1 Room</option>
                      <option value="2">2 Rooms</option>
                      <option value="3">3 Rooms</option>
                      <option value="4">4 Rooms</option>
                      <option value="5">5 Rooms</option>
                    </select>
                  </div>
                  <div class="box">
                    <input type="submit" value="Check Availability" class="btn-availability" name="check_availability">
                </form>
              </div>  
              
            </div> 

              <?php if(isset($_POST['check_availability'])) : ?>
                <div class="room-container">
                 <h2 class="room-container-title">According to your search<br>We Have the best options in the area<br> Scroll down to see.</h2>
                </div>
              <?php else: ?>
                <div class="room-container">
                 <h2 class="room-container-title">Fill the above form to see options.</h2>
                </div>
               <?php endif; ?>            

               
        </div>
      
      </div>
       
    </section>
    
   </div>

  <?php ?>

<?php if (!empty($rooms)): ?>
    <section class="available-rooms">
        <h2>Available Rooms</h2>
        <div class="room-grid">
            <?php foreach ($rooms as $room): ?>
                <div class="room-card">
                    <img src="uploads/<?= $room['roomImage'] ?>" alt="<?= htmlspecialchars($room['roomNumber']) ?>">
                    <h3><?= htmlspecialchars($room['roomNumber']) ?></h3>
                    <p>Adults: <?= $room['adultsCapacity'] ?> | Children: <?= $room['childrenCapacity'] ?></p>
                    <p class="price">Rs. <?= number_format($room['rPricePerDay'], 2) ?> per night</p>
                    <a href="singleRoomDetails.php?id=<?= $room['roomID'] ?>" class="btn-view">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php elseif (isset($_POST['check_availability'])): 
    // If the form was submitted but no rooms are available
    $_SESSION['alerts'][] = [
        'type' => 'error',
        'message' => 'No rooms available for the selected criteria.'
    ];

  ?>

    <section class="available-rooms-false">
        <h2>Available Rooms</h2>
        <p style="padding: 20px; font-size: 18px;">No rooms available.</p>
    </section>
<?php endif; ?>



     <!-- Toast Container -->
    <div id="toast-container"></div>
       <script>
    function showToast(type, message) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}"></i> ${message}`;
        container.appendChild(toast);

        setTimeout(() => {
        toast.style.animation = "fadeOut 0.5s ease forwards";
        }, 4000);
        setTimeout(() => toast.remove(), 4600);
    }

    document.addEventListener('DOMContentLoaded', () => {
        <?php foreach ($alerts as $alert): ?>
        showToast("<?= $alert['type'] ?>", "<?= addslashes($alert['message']) ?>");
        <?php endforeach; ?>
    });
    </script>

   
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./script.js"></script>
</body>
</html>
