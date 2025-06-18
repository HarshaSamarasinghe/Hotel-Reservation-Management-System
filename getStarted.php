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
    <link rel="stylesheet" href="./Styles/getStarted.css">

    
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

  <section class="containerWrapper">
    <div class="container<?= $active_form === 'signup' ? ' active' : '' ?>" id="container">
      
      <!-- Sign Up Form -->
      <div class="form-container sign-up">
        <form action="auth_process.php" method="POST" class="register-form" onsubmit="return validatePasswords()">
          <h1>Sign Up</h1><br>
          <input type="text" placeholder="Full Name" name="fullName" required>
          <input type="email" placeholder="Email" name="email" required>
          <input type="tel" placeholder="Phone Number" name="phoneNumber" required pattern="^0\d{9}$" maxlength="10" 
                  title="Phone number must be 10 digits and start with 0" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          <input type="password" placeholder="Password" id="password" name="password" required minlength="8" 
                 title="Password must be at least 8 characters long!">
          <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required>
          <span>By signing up, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.</span><br>
          <button type="submit" name="register" value="login">Sign Up</button>
        </form>
      </div>
      <script>
          function validatePasswords() {
              const password = document.getElementById('password').value.trim();
              const confirmPassword = document.getElementById('confirmPassword').value.trim();

              if (password !== confirmPassword) {
                  // alert("Passwords do not match!");
                  showToast('error', 'Passwords do not match. Please try again!');
                  return false;
              }

              return true; 
          }
      </script>


      <!-- Login Form -->
      <div class="form-container sign-in">
        <form action="auth_process.php" method="POST" class="login-form">
          <h1>Login Here</h1><br>
          <span>Enter your username & password</span><br>
          <input type="text" placeholder="User Name" name="userName" required>
          <input type="password" placeholder="Password" name="password" required>
          <a href="#">Forgot Your Password?</a>
          <button type="submit" name="login">Log In</button>
        </form>
      </div>

      <!-- Form Switch Toggle -->
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Welcome to Savendra Garden</h1>
            <p>If you already have an account<br> Login here</p>
            <button class="hidden" id="login">Log In</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Oh! Don't have an account yet?</h1>
            <p>Click below to sign up.</p>
            <button class="hidden" id="register">Create Account</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>
  </section>

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
