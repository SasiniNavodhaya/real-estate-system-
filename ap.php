<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "estate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $location = $_POST['location'] ?? '';
    $type = $_POST['type'] ?? '';
    $want_to = strtolower($_POST['want_to'] ?? '');

    // Handle image upload
    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $imageName);
    }

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO properties (title, description, price, location, type, image, want_to) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssss", $title, $description, $price, $location, $type, $imageName, $want_to);

    if ($stmt->execute()) {
        header("Location: hom.php"); // Redirect after successful insert
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Add Property</title>
<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: url('new.webp') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 10px;
    color: #333;
  }
  .container {
    max-width: 600px;
    margin: 2rem auto;
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #222;
  }
  label {
    display: block;
    margin-bottom: 0.3rem;
    font-weight: bold;
    color: #555;
  }
  input[type="text"],
  input[type="number"],
  textarea,
  select,
  input[type="file"] {
    width: 100%;
    padding: 0.7rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="number"]:focus,
  textarea:focus,
  select:focus {
    border-color: #28a745;
    outline: none;
  }
  textarea {
    resize: vertical;
  }
  button {
    background: rgb(2, 12, 104);
    color: white;
    padding: 0.8rem;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background: #218838;
  }
  a {
    display: block;
    margin-top: 1rem;
    text-align: center;
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
    transition: color 0.3s ease;
  }
  a:hover {
    color: #0056b3;
  }
  .error {
    background-color: #f8d7da;
    color: #842029;
    padding: 10px;
    margin-bottom: 1rem;
    border-radius: 4px;
  }
</style>
</head>
<body>

<div class="container">
  <h2>Add New Property</h2>

  <?php if (!empty($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Price (Rs.)</label>
    <input type="number" name="price" min="0" step="0.01" required>

    <label>Location</label>
    <input type="text" name="location" required>

    <label>I want to</label>
    <select name="want_to" required>
      <option value="">Select</option>
      <option value="buy">Buy</option>
      <option value="rent">Rent</option>
    </select>

    <label>Type</label>
    <select name="type" required>
      <option value="">Select Type</option>
      <option value="house">House</option>
      <option value="apartment">Apartment</option>
      <option value="land">Land</option>
    </select>

    <label>Image</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">Add Property</button>
  </form>

  <a href="hom.php">← Back to Gallery</a>
</div>

</body>
</html>
