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

    <div class="container" text-align="left">
        <div style="flex: 1; text-align: left; margin-left: 500px">
            <h3>Make your own customization!</h3>
            <form method="post" action="customizations.php">
                <input type="hidden" name="form_id" value="form1">
                <label for="name">Name this customization:</label><br>
                <input type="text" id="name" name="name"><br><br>
                <label for="character">Character:</label><br>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $table = mysqli_query($connection, "SELECT name FROM characters");
                echo '<select name="character" id="character">';
                while ($row = mysqli_fetch_assoc($table)) {
                    echo
                        '<option value ="' . $row['name'] . '">' . $row['name'] . '</option>';
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
                        '<option value ="' . $row['name'] . '">' . $row['name'] . '</option>';
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
                        '<option value ="' . $row['name'] . '">' . $row['name'] . '</option>';
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
                        '<option value ="' . $row['name'] . '">' . $row['name'] . '</option>';
                }
                echo '</select>';
                ?><br><br>
                <input type="submit" value="Save">
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['name']) && isset($_POST['character']) && isset($_POST['vehicle']) && isset($_POST['wheel']) && isset($_POST['glider'])) {
                    if (isset($_SESSION['username'])) {
                        if ($_POST['form_id'] == 'form1') {
                            $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                            $username = $_SESSION['username'];
                            $name = $_POST['name'];
                            $character = htmlspecialchars($_POST['character']);
                            $vehicle = htmlspecialchars($_POST['vehicle']);
                            $wheel = htmlspecialchars($_POST['wheel']);
                            $glider = htmlspecialchars($_POST['glider']);

                            $statement = $connection->prepare("INSERT INTO customizations (username, customization_name, character_name, vehicle, wheel, glider) VALUES (?, ?, ?, ?, ?, ?)");

                            $statement->bind_param("ssssss", $username, $name, $character, $vehicle, $wheel, $glider);
                            $statement->execute();

                        }
                    } else {
                        echo ("This feature is only available for registered users.");
                    }
                }

            }

            //     echo ('<h3>Update customization?</h3>');
            //     echo ('<form method="POST"><input type= "hidden" name="form_id" value="form3">');
            //     echo ('<label for="update">Which customization would you like to update?</label><br>
            //     <input type="text" name="update">
            //     ');
            //     echo ('<br><br><label for="update1">Choose attribute to update:</label><br>
            //     <select name="update1">
            //     <option value ="name">Name</option>
            //     <option value ="character_name">Character</option>
            //     <option value ="vehicle">Vehicle</option>
            //     <option value ="wheel">Wheel</option>
            //     <option value ="glider">Glider</option>
            //     </select>
            //     ');
            //     echo ('<br><br><label for="update2">Type the updated value (case sensitive):</label>
            //     <br><input type="text" name="update2"><input type="submit" value="Update">
            // ');
            


            echo ('</form><form method="POST"><input type= "hidden" name="form_id" value="form2"><h3> Delete customization?</h3>');
            echo '<label for="delete">Name of customization:</label><br><input type="text" name="delete"><input type="submit" value="Delete"></form></div>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_SESSION['username'])) {
                    if (isset($_POST['form_id'])) {
                        // if ($_POST['form_id'] == 'form3') {
                        //     if (isset($_POST['update1']) && isset($_POST['update2']) && isset($_POST['update'])) {
                        //         $username = $_SESSION['username'];
                        //         $name = $_POST['update'];
                        //         $attribute = $_POST['update1'];
                        //         $option = $_POST['update2'];
                        //         $statement = $connection->prepare('UPDATE customizations SET $attribute = ? WHERE username=? AND customization_name = ?');
                        //         $statement->bind_param('sss', $option, $username, $name);
                        //         if (!$statement->execute()) {
                        //             $error_message = mysqli_error($connection);
                        //             echo "Error: " . $error_message;
                        //         }
                        //         $statement->execute();
                
                        //     }
                
                        // } else 
                        if ($_POST['form_id'] == 'form2') {
                            if (isset($_POST['delete'])) {
                                $username = $_SESSION['username'];
                                $name = $_POST['delete'];

                                $customization_name = $row['customization_name'];
                                $statement = $connection->prepare('DELETE FROM customizations WHERE username=? AND customization_name = ?');
                                $statement->bind_param('ss', $username, $name);
                                $statement->execute();

                            }
                        }
                    }
                } else {
                    echo "This feature is only for authorized users.";
                }
            }


            ?>

            <div class="column" style="margin-right: 300px;" ;>
                <h3>My Customizations</h3>
                <?php
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $statement = $connection->prepare("SELECT * FROM customizations WHERE username = ?");
                    $statement->bind_param("s", $username);
                    $statement->execute();
                    $result = $statement->get_result();
                }

                if (isset($result)) {
                    if (mysqli_num_rows($result) > 0) {
                        $username = $_SESSION['username'];
                        $i = 0;
                        echo '<table cellpadding="1" cellspacing="1" border="1">';
                        echo '<tr>';
                        echo "<th>Name<br></th>";
                        echo "<th>Character<br></th>";
                        echo "<th>Vehicle<br></th>";
                        echo "<th>Wheel<br></th>";
                        echo "<th>Glider<br></th>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo "<td>" . $row["customization_name"] . "</td>";
                            echo "<td>" . $row["character_name"] . "</td>";
                            echo "<td>" . $row["vehicle"] . "</td>";
                            echo "<td>" . $row["wheel"] . "</td>";
                            echo "<td>" . $row["glider"] . "</td>";
                            echo ('</tr>');
                        }
                    } else {
                        echo "No customizations yet.";
                    }
                } else {
                    echo "No customizations yet.";
                }
                ?>

            </div>
            <?php
            if (isset($_SESSION['username'])) {
                $connection = new mysqli("localhost", "student", "CompSci364", "MK8");
                $username = $_SESSION['username'];
                $table = $connection->prepare("SELECT customization_name FROM customizations WHERE username = ?");
                $table->bind_param("s", $username);
                $table->execute();
                $results = $table->get_result();

                if ($results->num_rows > 0) {
                    echo ('<h3>Update Customization Name:</h3>
                        <form method="post" action="customizations.php"> 
                            <select name="customization1" id="customization1">');
                    while ($row = $results->fetch_assoc()) {
                        echo '<option value ="' . $row['customization_name'] . '">' . $row['customization_name'] . '</option>';
                    }
                    ?>

                    </select><br><br>
                    <label for="new_customization">New Customization Name: </label>
                    <input type="text" name="new_customization" id="new_customization"><br><br>
                    <input type="submit" value="Update">
                    <br><br>

                    <?php
                    if (isset($_POST['new_customization'])) {
                        $new_customization = $_POST['new_customization'];
                        $selected_customization = $_POST['customization1'];
                        $statement1 = $connection->prepare("UPDATE customizations SET customization_name = ? WHERE customization_name = ?");
                        $statement1->bind_param("ss", $new_customization, $selected_customization);
                        $statement1->execute();
                        if ($statement1->error) {
                            die("Error in query: " . $statement1->error);
                        }
                    }
                }

            }
            ?>

            </form>

        </div>
</body>

</html>