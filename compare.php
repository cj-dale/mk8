<!DOCTYPE html>
<html>

<?php
session_start();
?>

<head>
    <link rel="stylesheet" type="text/css" href="mk8.css" media="screen" />
</head>

<body>

    <h1>Compare Customizations</h1>
    <nav>
        <ul id="navigation-bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="stats.php">MK8 Statistics</a></li>
            <li><a href="customizations.php">My Customizations</a></li>
            <li><a href="compare.php">Compare Customizations</a></li>
        </ul>
    </nav>

    <img style="width: 400px;
    height: auto;" src="compare.jpg" alt="compare_customizations">
    <br>
    <script>
        const username = "<?php echo $_SESSION['username'] ?>";
        document.write("Logged in as: " + username);
    </script>
    <?php $customization_set = 0;
    if (isset($_SESSION["username"])): ?>
        <form action="logout.php" method="post">
            <input type="submit" value="Log out">
        </form>
    
    <?php endif; ?>

    <?php
    if (isset($_SESSION['username'])) {
        $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
        $username = $_SESSION['username'];
        $table = $connection->prepare("SELECT customization_name FROM customizations WHERE username = ?");
        $table->bind_param("s", $username);
        $table->execute();
        $results = $table->get_result();

        if ($results->num_rows > 0 && $customization_set == 0) {
            echo ('<h3>Customization 1:</h3>
        <form method="post" action="compare.php"> 
            <select name="customization1" id="customization1">');
            while ($row = $results->fetch_assoc()) {
                echo '<option value ="' . $row['customization_name'] . '">' . $row['customization_name'] . '</option>';
            }
            echo '</select>';

            echo '<h3> Customization 2:</h3>';

            $results->data_seek(0); // reset the pointer to the beginning of the result set
            echo '<select name="customization2" id="customization2">';
            while ($row = $results->fetch_assoc()) {
                echo '<option value ="' . $row['customization_name'] . '">' . $row['customization_name'] . '</option>';
            }
            echo '</select>
        <br><br><input type="submit" value="Compare">
        </form>';
        }
    } else {
        echo ("<br><br><br>You haven't saved any customizations yet - make some to use the compare feature!");
    }
    ?>
    <?php

    $connection = new mysqli("localhost", "student", "CompSci364", "MK8");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['username'])) {
            if (isset($_POST['customization1']) && isset($_POST['customization2'])) {
                $customization1 = $_POST['customization1'];
                $customization2 = $_POST['customization2'];

                $statement1 = $connection->prepare("
                SELECT 
                    SUM(characters.speed + vehicles.speed + wheels.speed + gliders.speed) AS total_speed,
                    SUM(characters.acceleration + vehicles.acceleration + wheels.acceleration + gliders.acceleration) AS total_acceleration,
                    SUM(characters.traction + vehicles.traction + wheels.traction + gliders.traction) AS total_traction,
                    SUM(characters.handling + vehicles.handling + wheels.handling + gliders.handling) AS total_handling,
                    SUM(characters.miniturbo + vehicles.miniturbo + wheels.miniturbo + gliders.miniturbo) AS total_mini_turbo
                FROM customizations
                INNER JOIN characters ON customizations.character_name = characters.name
                INNER JOIN vehicles ON customizations.vehicle = vehicles.name
                INNER JOIN wheels ON customizations.wheel = wheels.name
                INNER JOIN gliders ON customizations.glider = gliders.name
                WHERE customizations.customization_name = ?
");

                if (!$statement1) {
                    die("Error in query: " . $connection->error);
                }
                $statement1->bind_param("s", $customization1);
                $statement1->execute();
                if ($statement1->error) {
                    die("Error in query: " . $statement1->error);
                }
                $result1 = $statement1->get_result();
                if ($result1) {
                    echo "<br><br> <table>";
                    echo "<tr><th>Customization</th><th>Total Speed</th><th>Total Acceleration</th><th>Total Traction</th><th>Total Handling</th><th>Total Mini Turbo</th></tr>";
                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . "1" . "</td>";
                        echo "<td>" . $row["total_speed"] . "</td>";
                        echo "<td>" . $row["total_acceleration"] . "</td>";
                        echo "<td>" . $row["total_traction"] . "</td>";
                        echo "<td>" . $row["total_handling"] . "</td>";
                        echo "<td>" . $row["total_mini_turbo"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                $statement2 = $connection->prepare("
                SELECT 
                    SUM(characters.speed + vehicles.speed + wheels.speed + gliders.speed) AS total_speed,
                    SUM(characters.acceleration + vehicles.acceleration + wheels.acceleration + gliders.acceleration) AS total_acceleration,
                    SUM(characters.traction + vehicles.traction + wheels.traction + gliders.traction) AS total_traction,
                    SUM(characters.handling + vehicles.handling + wheels.handling + gliders.handling) AS total_handling,
                    SUM(characters.miniturbo + vehicles.miniturbo + wheels.miniturbo + gliders.miniturbo) AS total_mini_turbo
                FROM customizations
                INNER JOIN characters ON customizations.character_name = characters.name
                INNER JOIN vehicles ON customizations.vehicle = vehicles.name
                INNER JOIN wheels ON customizations.wheel = wheels.name
                INNER JOIN gliders ON customizations.glider = gliders.name
                WHERE customizations.customization_name = ?
");

                if (!$statement2) {
                    die("Error in query: " . $connection->error);
                }
                $statement2->bind_param("s", $customization2);
                $statement2->execute();
                if ($statement2->error) {
                    die("Error in query: " . $statement2->error);
                }
                $result2 = $statement2->get_result();
                if ($result2) {
                    echo "<table>";
                    echo "<tr><th>Customization</th><th>Total Speed</th><th>Total Acceleration</th><th>Total Traction</th><th>Total Handling</th><th>Total Mini Turbo</th></tr>";
                    while ($row = $result2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . "2" . "</td>";
                        echo "<td>" . $row["total_speed"] . "</td>";
                        echo "<td>" . $row["total_acceleration"] . "</td>";
                        echo "<td>" . $row["total_traction"] . "</td>";
                        echo "<td>" . $row["total_handling"] . "</td>";
                        echo "<td>" . $row["total_mini_turbo"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                ?>
                </div>
            <?php }
        }
    }
    ?>
</body>

</html>