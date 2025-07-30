<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Real Estate Home</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* --------------------------------------------------
       Global CSS Variables - theme color settings
    -------------------------------------------------- */
    :root {
      --primary: #1e2f97;             /* Main theme blue color */
      --accent: #00e5ff;              /* Highlight/Accent color */
      --white: #ffffff;               /* White color */
      --light-blue: rgb(234, 252, 255); /* Light background shade */
      --gray: blue;                   /* Gray (temporarily set to blue) */
    }

    /* -----------------------------------------------
       Base Styles
    ----------------------------------------------- */
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--light-blue);
    }

    /* -----------------------------------------------
       Header Section: logo + nav + buttons
    ----------------------------------------------- */
    header {
      background-color: var(--primary);
      color: var(--white);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 30px;
    }

    .logo img {
      height: 40px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      padding: 0;
      margin: 0;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--white);
      font-weight: 500;
      display: flex;
      align-items: center;
    }

    nav ul li a i {
      margin-right: 6px;
    }

    .actions {
      display: flex;
      gap: 10px;
    }

    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-signin {
      background-color: #00bfff;
      color: var(--white);
    }

    .btn-logout {
      background-color: #00e5ff;
      color: var(--white);
    }

    /* -----------------------------------------------
       Hero Section - Banner + Text + Search Bar
    ----------------------------------------------- */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 60px 10%;
      background-color: var(--light-blue);
      flex-wrap: wrap;
    }

    .hero-content {
      flex: 1;
      max-width: 520px;
    }

    .hero-content h1 {
      font-size: 2.6rem;
      margin-bottom: 10px;
      color: #1c1c1c;
    }

    .hero-content p {
      font-size: 1.05rem;
      margin-bottom: 25px;
      color: #444;
    }

    /* -----------------------------------------------
       Search Box Styles
    ----------------------------------------------- */
    .search-box {
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      padding: 18px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items: center;
      max-width: 600px;
    }

    .search-box select,
    .search-box input {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid var(--gray);
      font-size: 1rem;
      flex: 1;
      min-width: 120px;
    }

    .search-box button {
      background-color: var(--primary);
      color: var(--white);
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .search-box button:hover {
      background-color: #14207a;
    }

    .hero-image img {
      width: 100%;
      max-width: 450px;
      border-radius: 12px;
    }

    /* -----------------------------------------------
       Responsive Design for Smaller Screens
    ----------------------------------------------- */
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .hero-content,
      .hero-image {
        max-width: 100%;
      }

      .search-box {
        flex-direction: column;
      }

      .search-box select,
      .search-box input,
      .search-box button {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- ===============================================
       Header Section
  ================================================ -->
  <header>
    <!-- Logo -->
    <div class="logo">
      <img src="logo.png" alt="Logo" />
    </div>

    <!-- Navigation Menu -->
    <nav>
      <ul>
        <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
        <li><a href="lo.php"><i class="fas fa-user-shield"></i>Admin Dashboard</a></li>
        <li><a href="gallery.php"><i class="fas fa-building"></i>Property</a></li>
        <li><a href="contract.php"><i class="fas fa-envelope"></i>Contact</a></li>
        <li><a href="about.php"><i class="fas fa-info-circle"></i>About</a></li>
      </ul>
    </nav>

    <!-- User Action Buttons -->
    <div class="actions">
      <a href="Register.php" class="btn btn-signin"><i class="fas fa-sign-in-alt"></i> Sign In</a>
      <a href="logou.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </header>

  <!-- ===============================================
       Hero Section (Main Banner Area)
  ================================================ -->
  <section class="hero">
    <!-- Text and Search Box -->
    <div class="hero-content">
      <h1>Find a place<br> where you can be yourself.</h1>
      <p>If you're looking for a place where you can be yourself, don't give up. Keep searching until you find a place that feels like home.</p>

      <!-- Property Search Form -->
      <form class="search-box" method="GET" action="gallery.php">
        <!-- Property Purpose -->
        <select name="want_to" required>
          <option value="">Want to</option>
          <option value="rent">Rent</option>
          <option value="buy">Buy</option>
          <option value="sell">Sell</option>
        </select>

        <!-- Property Type -->
        <select name="type">
          <option value="">Property type</option>
          <option value="house">House</option>
          <option value="apartment">Apartment</option>
          <option value="land">Land</option>
        </select>

        <!-- Location Search -->
        <input type="text" name="location" placeholder="Street, City, Zip" />

        <!-- Submit Button -->
        <button type="submit"><i class="fas fa-search"></i> Search</button>
      </form>
    </div>

    <!-- Hero Image -->
    <div class="hero-image">
      <img src="item7.jpg" alt="House Image">
    </div>
  </section>

</body>
</html>
