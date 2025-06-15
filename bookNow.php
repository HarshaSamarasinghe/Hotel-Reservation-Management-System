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
    <title>Book Now</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- swiper js cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- custom css link -->
    <link rel="stylesheet" href="./Styles/style.css">
    <link rel="stylesheet" href="./Styles/bookNow.css">
    

    
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
