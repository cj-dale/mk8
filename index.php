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
        } else {
          $error = true;
        }
      } else {
        $error = true;
      }
    }
    ?>

    
<?php
if (!isset($_SESSION["username"])) {
  // Show login form
?>
  <form action="<?php echo $_SERVER["PHP_SELF"]. "?".$_SERVER["QUERY_STRING"]; ?>" method="post">
    <label for="username">Username</label>
    <input name="username" type="text" />
    <label for="password">Password</label>
    <input name="password" type="password" />
    <input type="submit" value="Log in" />
  </form>
  <br>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="new_username">New Username</label>
    <input name="new_username" type="text" />
    <label for="new_password">New Password</label>
    <input name="new_password" type="password" />
    <input type="submit" name="create_account" value="Create Account" />
  </form>
<?php
} else {
?>
  <script>
      const username = "<?php echo $_SESSION['username'] ?>";
      document.write("Logged in as: " + username);
    </script>
    <?php if (isset($_SESSION["username"])): ?>
      <form action="logout.php" method="post">
      <input type="submit" value="Log out">
    </form>
<?php endif; ?>
<?php
}

if (isset($_POST["create_account"])) {
  $new_username = $_POST["new_username"];
  $new_password = $_POST["new_password"];

  // Check if user already exists
  $statement = $connection->prepare("SELECT * FROM users WHERE username = ?");
  $statement->bind_param("s", $new_username);
  $statement->execute();
  $result = $statement->get_result();
  if ($result->num_rows > 0) {
    echo "<p>User $new_username already exists. Please choose another username.</p>";
  } else {
    // Create new user
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $statement = $connection->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $statement->bind_param("ss", $new_username, $password_hash);
    if ($statement->execute()) {
      $_SESSION["username"] = $new_username;
      echo "<p>User $new_username created successfully, now logged in as $new_username</p>";
    } else {
      echo "<p>Error creating user $new_username.</p>";
    }
  }
}
?>
<br>
    
</body>

</html>