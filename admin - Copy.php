<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      display: flex;
      min-height: 100vh;
      background-color: #f4f4f4;
    }

    aside#sidebar {
      width: 220px;
      background-color:rgb(9, 17, 128);
      color: #fff;
      padding: 20px 0;
      transition: all 0.3s;
    }

    #sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    #sidebar ul {
      list-style: none;
      padding: 0;
    }

    #sidebar ul li {
      padding: 15px 20px;
    }

    #sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: #fff;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #ccc;
    }

    #toggleBtn {
      font-size: 24px;
      background: none;
      border: none;
      cursor: pointer;
    }

    .dashboard-container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .dashboard-box {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      flex: 1 1 250px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dashboard-box.ad {
      flex-basis: 100%;
      text-align: center;
    }

    .dashboard-box.ad img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      #sidebar {
        position: fixed;
        top: 0;
        left: -220px;
        height: 100%;
        z-index: 1000;
      }
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- Sidebar -->
    <aside id="sidebar">
      <h2>Admin</h2>
      <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="lo.php">Admin</a></li>
        <li><a href="ap.php">Properties</a></li>
        <li><a href="mana.php">Manage Property</a></li>
        <li><a href="logou.php">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main>

      <!-- Header -->
      <header>
        <button id="toggleBtn">&#9776;</button>
        <h1>Dashboard</h1>
      </header>

      <!-- Dashboard Content -->
      <section class="dashboard-container">
        <div class="dashboard-box">
          Welcome to the Admin Panel!
        </div>
        <div class="dashboard-box">
          You can manage users and properties here.
        </div>
        <div class="dashboard-box ad">
          <h3>Advertisement</h3>
          <img src="house.webp" alt="Ad Banner" />
        </div>
      </section>

    </main>
  </div>

  <!-- Script -->
  <script>
    const toggleBtn = document.getElementById("toggleBtn");
    const sidebar = document.getElementById("sidebar");

    toggleBtn.addEventListener("click", () => {
      sidebar.style.left = sidebar.style.left === "0px" ? "-220px" : "0px";
    });

    window.addEventListener("resize", () => {
      if (window.innerWidth <= 768) {
        sidebar.style.position = "fixed";
        sidebar.style.left = "-220px";
        sidebar.style.height = "100%";
      } else {
        sidebar.style.position = "";
        sidebar.style.left = "";
        sidebar.style.height = "";
      }
    });
  </script>
</body>
</html>
