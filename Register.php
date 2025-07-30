+++++++++++++++++++++++++++++++++++++++++++--<?php
// Database connection setup
$host = 'localhost';
$dbname = 'estate';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// If connection fails, stop script and display error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Function to validate ID number formats:
// Old NIC format: 9 digits followed by 'v' or 'V'
// New NIC format: 12 digits only
function validateID($id) {
    return preg_match('/^\d{9}[vV]$/', $id) || preg_match('/^\d{12}$/', $id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize POST inputs
    $fullname = trim($_POST['fullname']);
    $idNumber = trim($_POST['idNumber']);
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Server-side validations
    if (!validateID($idNumber)) {
        $message = "Invalid ID Number. Use 9 digits + 'V' or 12-digit format.";
    } elseif (!preg_match('/^\d{10}$/', $mobile)) {
        $message = "Mobile number must be exactly 10 digits.";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match!";
    } else {
        // Check if email already exists in DB
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Email already registered.";
        } else {
            // Hash the password securely before storing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user record into DB
            $stmtInsert = $conn->prepare("INSERT INTO users (fullname, id_number, address, mobile, email, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("ssssss", $fullname, $idNumber, $address, $mobile, $email, $hashedPassword);

            if ($stmtInsert->execute()) {
                $message = "Registration successful!";
            } else {
                $message = "Error: " . $stmtInsert->error;
            }
            $stmtInsert->close();
        }
        $stmt->close();
    }
}
?>

<!-- HTML form for user registration -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register | Interactive Brand</title>
  <link rel="stylesheet" href="Registerr.css" />
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <div class="overlay-text">
        <h1>Join Us and Unlock Your Potential</h1>
        <p>Sign up to access exclusive features and community support</p>
      </div>
    </div>
    <div class="right-panel">
      <div class="form-box">
        <h2>Register</h2>
        <form method="POST" action="" id="registerForm">
          <label for="fullname">Full Name</label>
          <input type="text" name="fullname" placeholder="Full Name" required />

          <label for="idNumber">ID Number</label>
          <input type="text" name="idNumber" placeholder="Old: 9 digits + V | New: 12 digits" required />

          <label for="address">Address</label>
          <input type="text" name="address" placeholder="Address" required />

          <label for="mobile">Mobile Number</label>
          <input type="tel" name="mobile" placeholder="10 digits only" required />

          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Email" required />

          <label for="password">Password</label>
          <input type="password" name="password" placeholder="At least 8 characters" required />

          <label for="confirmPassword">Confirm Password</label>
          <input type="password" name="confirmPassword" placeholder="Confirm Password" required />

          <button type="submit">Register</button>

          <!-- Display server-side messages (errors or success) -->
          <?php if (!empty($message)): ?>
            <p class="message <?= strpos($message, 'successful') !== false ? 'success' : '' ?>">
              <?= htmlspecialchars($message) ?>
            </p>
          <?php endif; ?>

          <!-- Placeholder for client-side validation messages -->
          <p id="clientMessage" class="message"></p>
        </form>

        <p class="login-link">Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </div>
  </div>

  <!-- Client-side JavaScript validation before submitting form -->
  <script>
    document.getElementById("registerForm").addEventListener("submit", function(e) {
      const idInput = document.querySelector('input[name="idNumber"]');
      const mobileInput = document.querySelector('input[name="mobile"]');
      const passwordInput = document.querySelector('input[name="password"]');
      const confirmPasswordInput = document.querySelector('input[name="confirmPassword"]');
      const clientMsg = document.getElementById('clientMessage');

      const idValue = idInput.value.trim();
      const mobileValue = mobileInput.value.trim();
      const passwordValue = passwordInput.value;
      const confirmPasswordValue = confirmPasswordInput.value;

      const nicOldFormat = /^\d{9}[vV]$/;  // Regex for old NIC
      const nicNewFormat = /^\d{12}$/;      // Regex for new NIC
      const mobileFormat = /^\d{10}$/;      // Regex for mobile number

      let errorMessage = "";

      if (!nicOldFormat.test(idValue) && !nicNewFormat.test(idValue)) {
        errorMessage = "Invalid ID Number. Use 9 digits + 'V' or 12-digit format.";
      } else if (!mobileFormat.test(mobileValue)) {
        errorMessage = "Mobile number must be exactly 10 digits.";
      } else if (passwordValue.length < 8) {
        errorMessage = "Password must be at least 8 characters.";
      } else if (passwordValue !== confirmPasswordValue) {
        errorMessage = "Passwords do not match!";
      }

      if (errorMessage !== "") {
        e.preventDefault();               // Prevent form submission if error
        clientMsg.textContent = errorMessage;
        clientMsg.classList.remove("success");
      } else {
        clientMsg.textContent = "";       // Clear client message on success
      }
    });
  </script>
</body>
</html>
