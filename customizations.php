<!DOCTYPE html>
<html>

<?php
session_start();
?>

<head>
    <link rel="stylesheet" type="text/css" href="mk8.css" media="screen" />
</head>

<body>

    <h1>My Customizations</h1>
    <img style="width: 200px;
    height: auto;" src="mario.jpeg" alt="Mario Drivin'">

    <nav>
        <ul id="navigation-bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="stats.php">MK8 Statistics</a></li>
            <li><a href="customizations.php">My Customizations</a></li>
            <li><a href="compare.php">Compare Customizations</a></li>
        </ul>
    </nav>
    <script>
      const username = "<?php echo $_SESSION['username'] ?>";
      document.write("Logged in as: " + username);
    </script>
    <?php if (isset($_SESSION["username"])): ?>
      <form action="logout.php" method="post">
      <input type="submit" value="Log out">
    </form>
    <?php endif; ?>
    
    <div style="display: flex; justify-content: center;">
    <div style="text-align: left; margin-right: 120px;">
        <h3>Make your own customization!</h3>
        <form method="post" action="customizations.php">
            <label for="name">Name this customization:</label><br>
            <input type="text" id="name" name="name"><br><br>
            <label for="character">Character:</label><br>
            <?php
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            $table = mysqli_query($connection, "SELECT name FROM characters");
            echo '<select name="character" id="character">';
            while ($row = mysqli_fetch_assoc($table)){
                echo 
                    '<option value ='.$row['name'].'>'.$row['name'].'</option>';
            }
            echo '</select>';
            ?>
            <br><br>
            <label for="vehicle">Vehicle:</label><br>
            <?php
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            $table = mysqli_query($connection, "SELECT name FROM vehicles");
            echo '<select name="vehicle" id="vehicle">';
            while ($row = mysqli_fetch_assoc($table)){
                echo 
                '<option value ='.$row['name'].'>'.$row['name'].'</option>';
            }
            echo '</select>';
            ?><br><br>
            <label for="wheel">Wheel:</label><br>
            <?php
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            $table = mysqli_query($connection, "SELECT name FROM wheels");
            echo '<select name="wheel" id="wheel">';
            while ($row = mysqli_fetch_assoc($table)){
                echo 
                '<option value ='.$row['name'].'>'.$row['name'].'</option>';
            }
            echo '</select>';
            ?><br><br>
            <label for="glider">Glider:</label><br>
            <?php
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            $table = mysqli_query($connection, "SELECT name FROM gliders");
            echo '<select name="glider" id="glider">';
            while ($row = mysqli_fetch_assoc($table)){
                echo 
                '<option value ='.$row['name'].'>'.$row['name'].'</option>';
            }
            echo '</select>';
            ?><br><br>
            <input type="submit" value="Save">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                    if (isset($_SESSION['username'])){
                        echo "Form submitted2";
                        $connection = new mysqli("localhost", "student", "CompSci364","MK8");
                        $username = $_SESSION['username'];
                        $name = $_POST['name'];
                        $character = $_POST['character'];
                        $vehicle = $_POST['vehicle'];
                        $wheel = $_POST['wheel'];
                        $glider = $_POST['glider'];
                        echo($character);
                        $sql = "INSERT INTO customizations (user, name, character_, vehicle, wheel, glider) VALUES ('$username', '$name', '$character', '$vehicle', '$wheel', '$glider')";
                        mysqli_query($connection, $sql);
                    }
                    else{
                        echo ("This feature is only available for registered users.");
                    }
                }
        ?>
        </form>
    </div>
    <div style="text-align: right;">
        <h3>My Customizations</h3>
        <?php
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            $table = mysqli_query($connection, "SELECT * FROM customizations");
            $count = mysqli_query($connection, "SELECT COUNT(*) FROM customizations");
            $num_rows = mysqli_num_rows($count);
            $row = mysqli_fetch_assoc($table);
            echo($row);
            //echo($num_rows);
            if ($num_rows > 1){
                echo '<table cellpadding="1" cellspacing="1" border="1">';
                echo "<tr>
                <th> Name<br></th>
                <th> Character<br></th>
                <th> Speed<br></th>
                <th> Acceleration<br></th>
                <th> Weight<br></th>
                <th> Handling<br></th>
                <th> Traction<br></th>
                <th> Mini-Turbo<br></th>
                </tr>";
                while ($row = mysqli_fetch_assoc($table)) {
                    echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['character_'] . "</td>
                        <td>" . $row['speed'] . "</td>
                        <td>" . $row['acceleration'] . "</td>
                        <td>" . $row['weight'] . "</td>
                        <td>" . $row['handling'] . "</td>
                        <td>" . $row['traction'] . "</td>
                        <td>" . $row['miniturbo'] . "</td>
                    </tr>";
                }
                echo "</table>";
                mysqli_close($connection);
        }
        else{
            echo("No customizations saved");
            //echo "Error: " . mysqli_error($connection);
        }
            ?>
    </div>
</div>
    </div>
</body>

</html>