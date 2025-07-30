<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us | Real Estate</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f7ff;
      color: #1a1a1a;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: auto;
    }

    /* Header */
    .header {
      background: #ffffff;
      padding: 20px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solidrgb(38, 19, 211);
    }

    .logo {
      font-size: 1.8em;
      color:rgb(9, 36, 185)8, 255);
      font-weight: bold;
    }

    .nav {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .nav a {
      color:rgb(14, 12, 136);
      text-decoration: none;
      font-weight: 600;
    }

    .nav button {
      background-color:rgb(16, 26, 172);
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .nav button:hover {
      background-color: #0056b3;
    }

    /* Hero Section */
    .about-hero {
      background: linear-gradient(rgba(0,123,255,0.5), rgba(0,123,255,0.5)),
        url('https://via.placeholder.com/1600x500') no-repeat center/cover;
      padding: 80px 20px;
      text-align: center;
      color: #ffffff;
    }

    .about-hero h2 {
      font-size: 2.8rem;
      margin-bottom: 10px;
    }

    .about-hero p {
      font-size: 1.2rem;
    }

    /* About Content */
    .about-content {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      padding: 60px 0;
      align-items: center;
      background-color: #ffffff;
      border-radius: 12px;
      margin-top: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .about-text {
      flex: 1 1 50%;
      padding: 20px;
    }

    .about-text h3 {
      color:rgb(6, 4, 114);
      margin-bottom: 10px;
    }

    .about-text p {
      color: #333;
      margin-bottom: 20px;
    }

    .about-image {
      flex: 1 1 40%;
      padding: 20px;
    }

    .about-image img {
      width: 100%;
      border-radius: 10px;
    }

    /* Footer */
    .footer {
      background: #007bff;
      color: #fff;
      text-align: center;
      padding: 25px 0;
      font-size: 14px;
      margin-top: 60px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .about-content {
        flex-direction: column;
        text-align: center;
      }

      .about-image {
        order: -1;
      }

      .nav {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

  <header class="header container">
    <h1 class="logo">RealEstatePro</h1>
    <div class="nav">
      <a href="hom.php">Home</a>
      <button onclick="window.location.href='hom.php'">Log Out</button>
    </div>
  </header>

  <section class="about-hero">
    <div class="container">
      <h2>About Us</h2>
      <p>Your trusted partner in finding your dream home.</p>
    </div>
  </section>

  <section class="about-content container">
    <div class="about-text">
      <h3>Who We Are</h3>
      <p>RealEstatePro is a modern real estate platform offering innovative tools and personalized service to help you buy, sell, or rent property with confidence. With years of experience and a passion for real estate, we make your journey seamless and stress-free.</p>

      <h3>Our Mission</h3>
      <p>To revolutionize the real estate experience through transparency, technology, and trust. We aim to connect people to properties efficiently and effectively.</p>
    </div>
    <div class="about-image">
      <img src="prop2.webp" alt="Our team at work">
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 RealEstatePro. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
