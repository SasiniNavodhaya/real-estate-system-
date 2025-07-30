<?php
// Connect to the MySQL database
$conn = new mysqli("localhost", "root", "", "estate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter values from the URL (GET request)
$type = $_GET['type'] ?? '';
$want_to = $_GET['want_to'] ?? '';
$location = $_GET['location'] ?? '';

// Start SQL query
$sql = "SELECT * FROM properties WHERE deleted = 0 AND status = 'active'";
$params = [];
$types = "";

// Add filters to SQL if values are provided
if ($type) {
    $sql .= " AND type = ?";
    $params[] = $type;
    $types .= "s";
}
if ($want_to) {
    $sql .= " AND want_to = ?";
    $params[] = $want_to;
    $types .= "s";
}
if ($location) {
    $sql .= " AND location LIKE ?";
    $params[] = "%$location%";
    $types .= "s";
}

// Prepare and execute the SQL statement
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Property Gallery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 10px;
    }
    h1 {
      text-align: center;
    }
    .filter-form {
      max-width: 800px;
      margin: 0 auto 20px auto;
      background: white;
      padding: 15px;
      border-radius: 8px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .filter-form select, .filter-form input {
      padding: 8px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 30%;
    }
    .filter-form button {
      padding: 8px 16px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .property {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      color: #333;
      display: flex;
      flex-direction: column;
      text-decoration: none;
    }
    .property img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .property-info {
      padding: 15px;
      flex-grow: 1;
    }
    .property-info h3 {
      margin: 0 0 10px;
      font-size: 1.1rem;
    }
    .property-info p {
      margin: 5px 0;
      font-size: 0.95rem;
    }
    .btns {
      display: flex;
      gap: 10px;
      padding: 0 15px 15px;
    }
    .btn {
      flex: 1;
      text-align: center;
      background: #007bff;
      color: white;
      text-decoration: none;
      padding: 10px 0;
      border-radius: 6px;
      font-weight: bold;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #0056b3;
    }
    .no-results {
      text-align: center;
      padding: 50px;
      color: #888;
    }
  </style>
</head>
<body>

<h1>Property Gallery</h1>

<!-- Filter Form -->
<form method="GET" class="filter-form">
  <select name="type">
    <option value="">All Types</option>
    <option value="house" <?= $type === 'house' ? 'selected' : '' ?>>House</option>
    <option value="apartment" <?= $type === 'apartment' ? 'selected' : '' ?>>Apartment</option>
    <option value="land" <?= $type === 'land' ? 'selected' : '' ?>>Land</option>
  </select>

  <select name="want_to">
    <option value="">Buy or Rent</option>
    <option value="buy" <?= $want_to === 'buy' ? 'selected' : '' ?>>Buy</option>
    <option value="rent" <?= $want_to === 'rent' ? 'selected' : '' ?>>Rent</option>
  </select>

  <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($location) ?>" />

  <button type="submit">Filter</button>
</form>

<!-- Property Cards -->
<div class="gallery">
  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="property">
        <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Property Image">
        <div class="property-info">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
          <p><strong>Price:</strong> Rs. <?= number_format($row['price'], 2) ?></p>
          <p><strong>Type:</strong> <?= htmlspecialchars($row['type']) ?> | 
             <strong>Want to:</strong> <?= htmlspecialchars($row['want_to']) ?></p>
        </div>
        <div class="btns">
          <a href="pay.php?id=<?= $row['id'] ?>" class="btn">Buy</a>
          <a href="a.php?id=<?= $row['id'] ?>" class="btn">More Details</a>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="no-results">No properties found matching your criteria.</div>
  <?php endif; ?>
</div>

</body>
</html>

<?php
// Close database resources
$stmt->close();
$conn->close();
?>
