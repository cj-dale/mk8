<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="mk8.css" media="screen" />
</head>

<body width="100%" overflow = "hidden" margin = "0">

    <h1>Mario Kart 8 Database</h1>
    <img style = "width: 200px;
    height: auto;"
    src="mario.jpeg" alt="Mario Drivin'">
    
    <nav>
        <ul id="navigation-bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="stats.php">MK8 Statistics</a></li>
            <li><a href="customizations.php">My Customizations</a></li>
            <li><a href="compare.php">Compare Customizations</a></li>
        </ul>
    </nav>

    <h2>Log-In</h2>
    <p>View statistics, compare vehicle customizations and save your own!</p>
    <br><br>
    
    <?php
    //dr coffman code
    session_start(); // start (or resume) session
    
    // create database connection ($connection)
    $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
    
    $error = false;
    if (! isset($_SESSION["username"]) // already authenticated
        && isset($_POST["username"], $_POST["password"])) {
      // query database for account information
      $statement = $connection->prepare("SELECT password_hash ".
                                        "FROM users ".
                                        "WHERE username = ?;");
      $statement->bind_param("s", $_POST["username"]);
      $statement->execute();
      $statement->bind_result($password_hash);
    
      // username present in database
      if ($statement->fetch()) {
        // verify that the password matches stored password hash
        if (password_verify($_POST["password"], $password_hash)) {
          // store the username to indicate authentication
          $_SESSION["username"] = $_POST["username"];
        }
      } else {
        echo "hello";
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $statement = $connection->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $statement->bind_param("ss", $_POST["username"], $password_hash);
        if ($statement->execute()) {
          $_SESSION["username"] = $_POST["username"];
        }
      }
      $error = true;
    }
    $connection->close();
    
     ?>
        <?php
          if ($error) {
            echo "Invalid username or password.";
          }
         ?>
        <form action="<?php echo $_SERVER["PHP_SELF"].
                                 "?".$_SERVER["QUERY_STRING"]; ?>"
              method="post">
          <label for="username">Username</label>
          <input name="username" type="text" />
          <label for="password">Password</label>
          <input name="password" type="password" />
    
          <input type="submit" value="Log in" />
        </form>
    <br>
    <h2>Don't have an account? Create one!</h2>

    <script>
      const username = "<?php echo $_SESSION['username'] ?>";
      document.write("Logged in as: " + username);
    </script>
    <?php if (isset($_SESSION["username"])): ?>
      <form action="logout.php" method="post">
      <input type="submit" value="Log out">
    </form>
<?php endif; ?>
    
</body>

</html>