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

                    if (isset($_SESSION['username'])) {
                        //echo "Form submitted2";
                        $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                        $username = $_SESSION['username'];
                        $name = $_POST['name'];
                        $character = $_POST['character'];
                        $vehicle = $_POST['vehicle'];
                        $wheel = $_POST['wheel'];
                        $glider = $_POST['glider'];
                        $sql = "INSERT INTO customizations (username, name, character_, vehicle, wheel, glider) VALUES ('$username', '$name', '$character', '$vehicle', '$wheel', '$glider')";
                        $getcustomizations = "SELECT * FROM customizations";
                        var_dump($sql);
                        var_dump($getcustomizations);
                        $result = mysqli_query($connection, $getcustomizations);

// Loop through the result set and print each row
while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
}
                    } else {
                        echo ("This feature is only available for registered users.");
                    }
                }
                
            echo('</form>
        </div>
        <div style="text-align: right;">
            <h3>My Customizations</h3>');
            if (isset($_SESSION['username'])) {
                $table = mysqli_query($connection, "SELECT * FROM customizations WHERE username = '" . $_SESSION['username'] . "'");
                $count = mysqli_query($connection, "SELECT COUNT(*) FROM customizations WHERE username = '" . $_SESSION['username'] . "'");
                $num_rows = mysqli_num_rows($count);
                echo($num_rows);
                var_dump($table);
                $getcustomizations = "SELECT * FROM customizations";
                        var_dump($getcustomizations);
                if ($num_rows > 1) {
                    echo '<table id = "table2" cellpadding="1" cellspacing="1" border="1">';
                    echo "<tr>
                    <th> Name<br></th>
                    <th> Character<br></th>
                    <th> Vehicle<br></th>
                    <th> Wheels<br></th>
                    <th> Glider<br></th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($table)) {
                        echo "<tr>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['character_'] . "</td>
                            <td>" . $row['vehicle'] . "</td>
                            <td>" . $row['wheel'] . "</td>
                            <td>" . $row['glider'] . "</td>
                        </tr>";
                    }
                    echo "</table>";
                    mysqli_close($connection);
                } else {
                    echo ("No customizations saved");
                }
            }
            else{
                echo ("No customizations saved");
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>