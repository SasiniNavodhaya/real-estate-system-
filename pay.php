<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "estate");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $nic = trim($_POST['nic'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $payment_date = trim($_POST['payment_date'] ?? '');

    // Validation
    if ($name === '') $errors[] = "Name is required.";
    if ($nic === '' || !preg_match("/^[0-9]{9}[vV]$|^[0-9]{12}$/", $nic)) {
        $errors[] = "Invalid NIC format. Use 123456789V or 200012345678.";
    }
    if ($amount === '' || !is_numeric($amount) || floatval($amount) <= 0) {
        $errors[] = "Enter a valid amount.";
    }
    if ($payment_date === '' || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $payment_date)) {
        $errors[] = "Enter a valid payment date (YYYY-MM-DD).";
    }

    // File validation
    if (!isset($_FILES['slip']) || $_FILES['slip']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Bank slip upload failed.";
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = mime_content_type($_FILES['slip']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Only JPG, JPEG, PNG files are allowed.";
        }
    }

    if (empty($errors)) {
        $ext = strtolower(pathinfo($_FILES['slip']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid('slip_', true) . "." . $ext;
        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['slip']['tmp_name'], $uploadPath)) {
            $stmt = $conn->prepare("INSERT INTO payment (name, nic, amount, slip, payment_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $name, $nic, $amount, $newFileName, $payment_date);

            if ($stmt->execute()) {
                $success = "Payment submitted successfully!";
                $_POST = [];
            } else {
                $errors[] = "Database error: " . $stmt->error;
                unlink($uploadPath);
            }
            $stmt->close();
        } else {
            $errors[] = "Failed to move uploaded file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Make a Payment</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('house.webp') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 10px;
      color: #333;
    }
    .container {
      max-width: 480px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    h1 {
      margin-bottom: 20px;
      font-weight: 700;
      color: #222;
      text-align: center;
    }
    form label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
    }
    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1.5px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }
    input:focus {
      border-color: #007bff;
      outline: none;
    }
    button {
      width: 100%;
      background-color: #007bff;
      color: white;
      font-size: 18px;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #0056b3;
    }
    .error-message {
      color: #dc3545;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }
    .success-message {
      color: #28a745;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Make a Payment</h1>

  <?php if (!empty($errors)): ?>
    <div class="error-message">
      <?php foreach ($errors as $error) echo htmlspecialchars($error) . "<br>"; ?>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="success-message"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" action="" onsubmit="return validateNIC()">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required />

    <label for="nic">NIC:</label>
    <input type="text" id="nic" name="nic" value="<?= htmlspecialchars($_POST['nic'] ?? '') ?>" required />

    <label for="amount">Amount (LKR):</label>
    <input type="number" step="0.01" id="amount" name="amount" value="<?= htmlspecialchars($_POST['amount'] ?? '') ?>" required />

    <label for="slip">Upload Bank Slip (JPG, PNG):</label>
    <input type="file" id="slip" name="slip" accept="image/jpeg,image/png" required />

    <label for="payment_date">Payment Date:</label>
    <input type="date" id="payment_date" name="payment_date" value="<?= htmlspecialchars($_POST['payment_date'] ?? date('Y-m-d')) ?>" required />

    <button type="submit">Submit Payment</button>
  </form>

  <a href="hom.php">← Back</a>
</div>

<script>
function validateNIC() {
  const nicInput = document.getElementById("nic");
  const nic = nicInput.value.trim();

  const oldNICPattern = /^[0-9]{9}[vV]$/;
  const newNICPattern = /^[0-9]{12}$/;

  if (!oldNICPattern.test(nic) && !newNICPattern.test(nic)) {
    alert("Invalid NIC number. Use 9 digits + V (e.g., 123456789V) or 12-digit format (e.g., 200012345678).");
    nicInput.focus();
    return false;
  }

  return true;
}
</script>

</body>
</html>
