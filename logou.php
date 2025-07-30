<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logged Out</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('J.jpeg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }

    /* Dark overlay for better text contrast */
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .logout-container {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.95);
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      text-align: center;
      max-width: 400px;
    }

    h1 {
      color: #222;
      margin-bottom: 1rem;
    }

    p {
      color: #555;
      margin-bottom: 2rem;
    }

    .btn {
      background-color: #007bff;
      color: white;
      padding: 0.7rem 1.5rem;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      display: inline-block;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="logout-container">
  <h1>You have been logged out</h1>
  <p>Thank you for using the system.</p>
  <a class="btn" href="hom.php">Login Again</a>
</div>

</body>
</html>
