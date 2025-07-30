<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Interactive Brand</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <div class="overlay">
        <h1>Turn Your Ideas into reality</h1>
        <p>Start for free and get attractive offers from the community</p>
      </div>
    </div>

    <div class="right-panel">
      <!-- Login form posts to hom.php -->
      <form class="login-form" action="hom.php" method="post">
        <h2>Interactive Brand</h2>
        <h3>Login</h3>
        <p>Welcome Back! Please enter your details.</p>

        <!-- Display error message if any -->
        <?php if (!empty($error)) : ?>
          <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <div class="form-options">
          <label><input type="checkbox" name="remember"> Remember me for 30 days</label>
          
        </div>

        <button type="submit" class="login-btn">Log in</button>

        <a href="Register.php" class="register-btn">Register</a>

        <p class="signup-text">Don’t have an account? <a href="hom.php">Sign up for free</a></p>
      </form>
    </div>
  </div>
</body>
</html>
