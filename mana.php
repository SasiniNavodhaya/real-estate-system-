<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "estate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all properties
$sql = "SELECT * FROM properties ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Properties</title>
  <style>
    body {

      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 10px;
      color: #333;
      /* Full-page background */
      background: url('item7.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }

    .container {
      max-width: 900px;
      margin: auto;
      position: relative;
      border-radius: 8px;
      padding: 20px;
      overflow: hidden;
    }

    /* Container background image with transparency */
    .container::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: url('prop6.webp') no-repeat center center;
      background-size: cover;
      opacity: 0.25;  /* subtle background */
      z-index: 0;
      border-radius: 8px;
    }

    /* Content above the background overlay */
    .container > * {
      position: relative;
      z-index: 1;
      background-color: rgba(255,255,255,0.9);
      padding: 20px;
      border-radius: 8px;
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 0.75rem;
      border: 1px solid #ddd;
      text-align: left;
      vertical-align: middle;
    }

    th {
      background: #f8f8f8;
    }

    img {
      max-width: 80px;
      height: auto;
      border-radius: 4px;
    }

    button {
      padding: 0.4rem 0.8rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: white;
      font-weight: bold;
      margin-right: 0.3rem;
    }

    .update-btn {
      background: #007bff;
    }

    .update-btn:hover {
      background: #0056b3;
    }

    .remove-btn {
      background: #dc3545;
    }

    .remove-btn:hover {
      background: #a71d2a;
    }

    a {
      text-decoration: none;
    }

    .message {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Manage Properties</h2>

  <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="message">Property deleted successfully.</div>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Location</th>
        <th>Price</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td>Rs<?= number_format((float)$row['price'], 2) ?></td>
            <td><?= htmlspecialchars(ucfirst($row['type'])) ?></td>
            <td>
              <a href="up.php?id=<?= $row['id'] ?>">
                <button class="update-btn">Update</button>
              </a>
              <a href="delet.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this property?');">
                <button class="remove-btn">Remove</button>
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" style="text-align:center;">No properties found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
