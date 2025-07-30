<?php
$message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get and sanitize form inputs
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $msg = trim($_POST["message"]);

  // Validate inputs
  if (!empty($name) && !empty($email) && !empty($msg)) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "estate");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Insert message into contact_messages table
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $msg);

    if ($stmt->execute()) {
      $message = "✅ Your message has been sent successfully!";
    } else {
      $message = "❌ Failed to send message. Please try again.";
    }

    $stmt->close();
    $conn->close();
  } else {
    $message = "⚠️ Please fill in all fields.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us | Real Estate</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('image.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
    }

    .header {
      background: blue;
      padding: 30px 20px;
      text-align: center;
      color: white;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    .header p {
      margin-top: 10px;
      color: #f0f0f0;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .contact-form, .contact-info {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
      flex: 1 1 320px;
    }

    .contact-form h2, .contact-info h2 {
      margin-top: 0;
      color: #111;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid #bbb;
      border-radius: 8px;
      font-size: 1rem;
    }

    .contact-form button {
      background: #2563eb;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .contact-form button:hover {
      background: #1e40af;
    }

    .back-link {
      display: inline-block;
      margin-top: 10px;
      text-decoration: none;
      background: #e0e0e0;
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 0.9rem;
      color: #333;
      transition: background 0.3s;
    }

    .back-link:hover {
      background: #ccc;
    }

    .message-box {
      margin-top: 10px;
      color: green;
      font-weight: bold;
    }

    .contact-info p {
      margin: 10px 0;
      line-height: 1.6;
    }

    iframe {
      width: 100%;
      height: 300px;
      border: 0;
      border-radius: 10px;
      margin-top: 10px;
    }

    @media (max-width: 600px) {
      .container {
        flex-direction: column;
        gap: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you — whether you’re buying, selling, or renting.</p>
  </div>

  <div class="container">

    <div class="contact-form">
      <h2>Send Us a Message</h2>
      <form method="POST" action="">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required />

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required />

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Your message..." required></textarea>

        <button type="submit">Send Message</button>
      </form>
      <a href="hom.php" class="back-link">← Back to Home</a>
      <div class="message-box"><?php echo $message; ?></div>
    </div>

    <div class="contact-info">
      <h2>Real Estate Office</h2>
      <p><strong>📍 Address:</strong> 123 Anuradhapura</p>
      <p><strong>📞 Phone:</strong> +94 771653824</p>
      <p><strong>📧 Email:</strong> sasini253nawodhya@gmail.com</p>
      <p><strong>🕒 Hours:</strong> Mon–Fri: 9am – 5pm</p>

      <h2>Our Location</h2>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.735903827838!2d80.38813331432227!3d8.311524794303272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae365353fca551f%3A0xa00aa9e24e8d6d0!2sAnuradhapura!5e0!3m2!1sen!2slk!4v1620458062272!5m2!1sen!2slk" 
        allowfullscreen 
        loading="lazy">
      </iframe>
    </div>

  </div>

</body>
</html>
