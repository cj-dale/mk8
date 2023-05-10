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
    <?php if (isset($_SESSION["username"])): ?>
        <form action="logout.php" method="post">
            <input type="submit" value="Log out">
        </form>
    <?php endif; ?>


    <?php
    $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
    $table = $connection->prepare("SELECT customization_name FROM customizations");
    $table->execute();
    $results = $table->get_result();

    if ($results->num_rows > 0) {
        echo ('<h3>Customization 1:</h3>
      <form method="post" action="compare.php"> 
          <select name="1" id="1">');
        while ($row = $results->fetch_assoc()) {
            echo '<option value ="' . $row['customization_name'] . '">' . $row['customization_name'] . '</option>';
        }
        echo '</select>';

        echo '<h3> Customization 2:</h3>';

        $results->data_seek(0); // reset the pointer to the beginning of the result set
        echo '<select name="2" id="2">';
        while ($row = $results->fetch_assoc()) {
            echo '<option value ="' . $row['customization_name'] . '">' . $row['customization_name'] . '</option>';
        }
        echo '</select>
      <br><br><input type="submit" value="Compare">
      </form>';
    } else {
        echo ("<br><br><br>You haven't saved any customizations yet - make some to use the compare feature!");
    }
    ?>
    <?php

    $connection = new mysqli("localhost", "student", "CompSci364", "MK8");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['username'])) {
            $customization1 = $_POST['1'];
            $customization2 = $_POST['2'];

            $statement = $connection->prepare("
            SELECT 
                'Customization 1' AS customization,
                SUM(character.speed + vehicle.speed + wheel.speed + glider.speed) AS total_speed,
                SUM(character.acceleration + vehicle.acceleration + wheel.acceleration + glider.acceleration) AS total_acceleration,
                SUM(character.traction + vehicle.traction + wheel.traction + glider.traction) AS total_traction,
                SUM(character.handling + vehicle.handling + wheel.handling + glider.handling) AS total_handling,
                SUM(character.miniturbo + vehicle.miniturbo + wheel.miniturbo + glider.miniturbo) AS total_mini_turbo
            FROM customizations
            INNER JOIN character ON customizations.character = character.name
            INNER JOIN vehicle ON customizations.vehicle = vehicle.name
            INNER JOIN wheel ON customizations.wheel = wheel.name
            INNER JOIN glider ON customizations.glider = glider.name
            WHERE customizations.customization_name = ?
            UNION
            SELECT 
                'Customization 2' AS customization,
                SUM(character.speed + vehicle.speed + wheel.speed + glider.speed) AS total_speed,
                SUM(character.acceleration + vehicle.acceleration + wheel.acceleration + glider.acceleration) AS total_acceleration,
                SUM(character.traction + vehicle.traction + wheel.traction + glider.traction) AS total_traction,
                SUM(character.handling + vehicle.handling + wheel.handling + glider.handling) AS total_handling,
                SUM(character.miniturbo + vehicle.miniturbo + wheel.miniturbo + glider.miniturbo) AS total_mini_turbo
            FROM customizations
            INNER JOIN character ON customizations.character = character.name
            INNER JOIN vehicle ON customizations.vehicle = vehicle.name
            INNER JOIN wheel ON customizations.wheel = wheel.name
            INNER JOIN glider ON customizations.glider = glider.name
            WHERE customizations.customization_name = ?
        ");
            $statement->bind_param("ss", $customization1, $customization2);
            $statement->execute();
            $result = $statement->get_result();
            if (isset($result)) {
                ?>

                <div>
                    <h2>Comparison Results:</h2>
                    <table>
                        <tr>
                            <th></th>
                            <th>Speed</th>
                            <th>Acceleration</th>
                            <th>Traction</th>
                            <th>Handling</th>
                            <th>Mini-Turbo</th>
                        </tr>
                        <td>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <?php echo $row["customization"] ?>
                                    </td>
                                    <?php echo $row["total_speed"] ?>
                            </td>
                            <td>
                                <?php echo $row["total_acceleration"] ?>
                            </td>
                            <td>
                                <?php echo $row["total_traction"] ?>
                            </td>
                            <td>
                                <?php echo $row["total_handling"] ?>
                            </td>
                            <td>
                                <?php echo $row["total_mini_turbo"] ?>
                            </td>
                            </tr>
                        <?php endwhile; ?>

                </div>
            <?php }
        }
    } ?>
</body>

</html>