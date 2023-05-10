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
        $username = "<?php echo $_SESSION['username'] ?>";
        document.write("Logged in as: " + $username);
    </script>
    <?php if (isset($_SESSION["username"])): ?>
        <form action="logout.php" method="post">
            <input type="submit" value="Log out">
        </form>
    <?php endif; ?>

    <div style="display: flex; justify-content: center;"> <!--  -->
        <div style="text-align: left; margin-right: 120px;">
            <h3>Make your own customization!</h3>
            <form method="post" action="customizations.php">
                <label for="name">Name this customization:</label><br>
                <input type="text" id="name" name="name"><br><br>
                <label for="character">Character:</label><br>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $table = mysqli_query($connection, "SELECT name FROM characters");
                echo '<select name="character" id="character">';
                while ($row = mysqli_fetch_assoc($table)) {
                    echo
                        '<option value =' . $row['name'] . '>' . $row['name'] . '</option>';
                }
                echo '</select>';
                ?>
                <br><br>
                <label for="vehicle">Vehicle:</label><br>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $table = mysqli_query($connection, "SELECT name FROM vehicles");
                echo '<select name="vehicle" id="vehicle">';
                while ($row = mysqli_fetch_assoc($table)) {
                    echo
                        '<option value =' . $row['name'] . '>' . $row['name'] . '</option>';
                }
                echo '</select>';
                ?><br><br>
                <label for="wheel">Wheel:</label><br>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $table = mysqli_query($connection, "SELECT name FROM wheels");
                echo '<select name="wheel" id="wheel">';
                while ($row = mysqli_fetch_assoc($table)) {
                    echo
                        '<option value =' . $row['name'] . '>' . $row['name'] . '</option>';
                }
                echo '</select>';
                ?><br><br>
                <label for="glider">Glider:</label><br>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $table = mysqli_query($connection, "SELECT name FROM gliders");
                echo '<select name="glider" id="glider">';
                while ($row = mysqli_fetch_assoc($table)) {
                    echo
                        '<option value =' . $row['name'] . '>' . $row['name'] . '</option>';
                }
                echo '</select>';
                ?><br><br>
                <input type="submit" value="Save">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['name']) && isset($_POST['character']) && isset($_POST['vehicle']) && isset($_POST['wheel']) && isset($_POST['glider'])) {
                        if (isset($_SESSION['username'])) {

                            $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                            $username = $_SESSION['username'];
                            $name = $_POST['name'];
                            $character = $_POST['character'];
                            $vehicle = $_POST['vehicle'];
                            $wheel = $_POST['wheel'];
                            $glider = $_POST['glider'];

                            $statement = $connection->prepare("INSERT INTO customizations (username, customization_name, character_name, vehicle, wheel, glider) VALUES (?, ?, ?, ?, ?, ?)");
                            $statement->bind_param("ssssss", $username, $name, $character, $vehicle, $wheel, $glider);
                            $statement->execute();

                        } else {
                            echo ("This feature is only available for registered users.");
                        }
                    } else {
                        echo ("Incomplete form");
                    }
                }
                ?>
        </div>
        <div style="text-align: right;">
            <h3>My Customizations</h3>
            <?php
            
            // Connect to the database
            $connection = new mysqli("localhost", "student", "CompSci364", "MK8");

            // Check connection
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Select all values from the customizations table
            if(isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $statement = $connection->prepare("SELECT * FROM customizations WHERE username = ?");
                $statement->bind_param("s", $username);
                $statement->execute();
                $result = $statement->get_result();
            }

            // Display the results
            if (isset($result)) {
                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "Customization " . $i . " Name: " . $row["customization_name"] . "<br>";
                        echo "Character Name: " . $row["character_name"] . "<br>";
                        echo "Vehicle: " . $row["vehicle"] . "<br>";
                        echo "Wheel: " . $row["wheel"] . "<br>";
                        echo "Glider: " . $row["glider"] . "<br>";
                        echo "ASSOCIATED USERNAME: " . $row["username"] . "<br>";
                        $i++;
                    }
                }
                else {
                    echo "No customizations yet.";
                }
            } else {
                echo "No customizations yet.";
            }

            mysqli_close($connection);
            ?>
        </div>
    </div>
    </div>
</body>

</html>