<!DOCTYPE html>
<html>

<?php
session_start();
?>

<head>
    <link rel="stylesheet" type="text/css" href="mk8.css" media="screen" />
</head>

<body>

    <h1>Vehicle Customizations</h1>
    <nav>
        <ul id="navigation-bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="stats.php">MK8 Statistics</a></li>
            <li><a href="customizations.php">My Customizations</a></li>
            <li><a href="compare.php">Compare Customizations</a></li>
        </ul>
    </nav>
    <h3>Character</h3>
    <br>
    <?php
    // Establish a connection to the database
    $connection = new mysqli("localhost", "student", "CompSci364","MK8");
    $table = mysqli_query($connection, "SELECT * FROM characters");
    echo '<table cellpadding="1" cellspacing="1" border="1">';
    echo "<tr>
    <th> Character<br></th>
    <th> Speed<br></th>
    <th> Acceleration<br></th>
    <th> Weight<br></th>
    <th> Handling<br></th>
    <th> Traction<br></th>
    <th> Mini-Turbo<br></th>
    </tr>";
    while ($row = mysqli_fetch_assoc($table)){
        echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['speed']."</td>
            <td>".$row['acceleration']."</td>
            <td>".$row['weight']."</td>
            <td>".$row['handling']."</td>
            <td>".$row['traction']."</td>
            <td>".$row['miniturbo']."</td>
          </tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
    <br>
    <br>
    <img style="width: 600px; display: block; margin-left: 15%;
    height: auto; float: left;" src="characters.jpg" alt="characters">
    </div>
    <h3>Vehicle</h3>
    <br>
    <?php
    // Establish a connection to the database
    $connection = new mysqli("localhost", "student", "CompSci364","MK8");
    $table = mysqli_query($connection, "SELECT * FROM vehicles");
    echo '<table cellpadding="1" cellspacing="1" border="1">';
    echo "<tr>
    <th> Vehicle <br></th>
    <th> Speed<br></th>
    <th> Acceleration<br></th>
    <th> Weight<br></th>
    <th> Handling<br></th>
    <th> Traction<br></th>
    <th> Mini-Turbo<br></th>
    </tr>";
    while ($row = mysqli_fetch_assoc($table)){
        echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['speed']."</td>
            <td>".$row['acceleration']."</td>
            <td>".$row['weight']."</td>
            <td>".$row['handling']."</td>
            <td>".$row['traction']."</td>
            <td>".$row['miniturbo']."</td>
          </tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
    <img style="width: 600px; display: block; margin-left: 15%;
    height: auto; float: left;" src="vehicles.jpg" alt="vehicle">
    
    <h3>Wheels</h3>
    <br>
    <?php
    // Establish a connection to the database
    $connection = new mysqli("localhost", "student", "CompSci364","MK8");
    $table = mysqli_query($connection, "SELECT * FROM wheels");
    echo '<table cellpadding="1" cellspacing="1" border="1">';
    echo "<tr>
    <th> Wheel <br></th>
    <th> Speed<br></th>
    <th> Acceleration<br></th>
    <th> Weight<br></th>
    <th> Handling<br></th>
    <th> Traction<br></th>
    <th> Mini-Turbo<br></th>
    </tr>";
    while ($row = mysqli_fetch_assoc($table)){
        echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['speed']."</td>
            <td>".$row['acceleration']."</td>
            <td>".$row['weight']."</td>
            <td>".$row['handling']."</td>
            <td>".$row['traction']."</td>
            <td>".$row['miniturbo']."</td>
          </tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
    <img style="width: 600px; display: block; margin-left: 15%;
        height: auto; float: left;" src="wheels.jpg" alt="wheels">
    <h3>Glider</h3>
    <br>
    <?php
    // Establish a connection to the database
    $connection = new mysqli("localhost", "student", "CompSci364","MK8");
    $table = mysqli_query($connection, "SELECT * FROM gliders");
    echo '<table cellpadding="1" cellspacing="1" border="1">';
    echo "<tr>
    <th> Glider <br></th>
    <th> Speed<br></th>
    <th> Acceleration<br></th>
    <th> Weight<br></th>
    <th> Handling<br></th>
    <th> Traction<br></th>
    <th> Mini-Turbo<br></th>
    </tr>";
    while ($row = mysqli_fetch_assoc($table)){
        echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['speed']."</td>
            <td>".$row['acceleration']."</td>
            <td>".$row['weight']."</td>
            <td>".$row['handling']."</td>
            <td>".$row['traction']."</td>
            <td>".$row['miniturbo']."</td>
          </tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
    <img style="width: 600px; display: block; margin-left: 15%;
        height: auto; float: left;" src="glider.jpg" alt="glider">
    
</body>

    <script>
      const username = "<?php echo $_SESSION['username'] ?>";
      document.write("Logged in as: " + username);
    </script>
    <?php if (isset($_SESSION["username"])): ?>
      <form action="logout.php" method="post">
      <input type="submit" value="Log out">
    </form>
    <?php endif; ?>

</html>