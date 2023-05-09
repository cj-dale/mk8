<!DOCTYPE html>
<html>

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
    <div>
        <h3 style="display: inline;
    float: left;
    padding-left: 30%; ">Make your own customization!</h3>
        <h3 style="display: inline; padding-right: 20%; padding-top: 0px;">My Customizations</h3>
        <form method="post" action="customizations.php" class="center" style="display: inline-block; float: left;">
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
            <br>
            <input type="submit" value="Save">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $connection = new mysqli("localhost", "student", "CompSci364","MK8");
            //$username = mysqli_query($connection, "SELECT user FROM users WHERE id = SESSION_ID")
            $name = $_POST['name'];
            $character = $_POST['character'];
            $vehicle = $_POST['vehicle'];
            $wheel = $_POST['wheel'];
            $glider = $_POST['glider'];

            $sql = "INSERT INTO customizations (user, name, character, vehicle, wheel, glider) VALUES ('$username', '$name', '$vehicle', '$wheel', 
            '$glider')";
            mysqli_query($connection, $sql);    
        }
        ?>

        <ul style="display: inline-block;">
            <?php
            if (filesize('customizations.txt') == 0) {
                echo "No customizations yet.";
            } else {
                $customizations = unserialize(file_get_contents('customizations.txt'));

                foreach ($customizations as $key => $customization) {
                    $name = $customization['name'];
                    echo '<li><a href="customization.php?name=' . urlencode($name) . '">' . $name . '</a></li>';
                }
            }
            ?>
        </ul>

        <?php
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            $customizations = unserialize(file_get_contents('customizations.txt'));

            foreach ($customizations as $key => $customization) {
                if ($customization['name'] == $name) {
                    $character = $customization['character'];
                    $vehicle = $customization['vehicle'];
                    $wheel = $customization['wheel'];
                    $glider = $customization['glider'];

                    echo "<h2>Customization for $name</h2>";
                    echo "<p>Character: $character</p>";
                    echo "<p>Vehicle: $vehicle</p>";
                    echo "<p>Wheel: $wheel</p>";
                    echo "<p>Glider: $glider</p>";
                }
            }
        }
        ?>
    </div>
</body>

</html>