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
            <select name="character" id="character">
                <option value="mario">Mario</option>
                <option value="luigi">Luigi</option>
                <option value="peach">Peach</option>
                <option value="daisy">Daisy</option>
                <option value="yoshi">Yoshi</option>
                <option value="toad">Toad</option>
                <option value="koopa">Koopa Troopa</option>
            </select><br><br>
            <label for="vehicle">Vehicle:</label><br>
            <select name="vehicle" id="vehicle">
                <option value="standard">Standard Kart</option>
                <option value="pipe">Pipe Frame</option>
                <option value="steel">Steel Driver</option>
                <option value="cat">Cat Cruiser</option>
                <option value="circuit">Circuit Special</option>
                <option value="tri">Tri-Speeder</option>
                <option value="bad">Badwagon</option>
            </select><br><br>
            <label for="wheel">Wheel:</label><br>
            <select name="wheel" id="wheel">
                <option value="standard">Standard</option>
                <option value="monster">Monster</option>
                <option value="roller">Roller</option>
                <option value="slime">Slim</option>
            </select><br><br>
            <label for="glider">Glider:</label><br>
            <select name="glider" id="glider">
                <option value="super">Super Glide</option>
                <option value="cloud">Cloud Glider</option>
                <option value="wario">Wario Wing</option>
                <option value="waddle">Waddle Wing</option>
                <option value="peach">Peach Parasol</option>
                <option value="parachut">Parachute</option>
            </select><br><br>
            <br>
            <input type="submit" value="Save">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'];
            $character = $_POST['character'];
            $vehicle = $_POST['vehicle'];
            $wheel = $_POST['wheel'];
            $glider = $_POST['glider'];

            $customization = array(
                'name' => $name,
                'character' => $character,
                'vehicle' => $vehicle,
                'wheel' => $wheel,
                'glider' => $glider
            );

            $customizations = unserialize(file_get_contents('customizations.txt'));

            $customizations[] = $customization;

            file_put_contents('customizations.txt', serialize($customizations));
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