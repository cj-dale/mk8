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
            <li><a href="stats.html">MK8 Statistics</a></li>
            <li><a href="customizations.php">My Customizations</a></li>
            <li><a href="compare.html">Compare Customizations</a></li>
        </ul>
    </nav>
    <img style="width: 400px;
    height: auto;" src="compare.jpg" alt="compare_customizations">
    <h3>Customization 1:</h3>
    <form method="post" action="compare.php">
        <?php
        $fileContents = file_get_contents('customizations.txt');
        $customizations = unserialize($fileContents);

        echo '<select name="customization">';
        foreach ($customizations as $c) {
            echo '<option value="' . $c['name'] . '">' . $c['name'] . '</option>';
        }
        echo '</select>';
        ?>
        <h3> Customization 2:</h3>

        <?php
        $fileContents = file_get_contents('customizations.txt');
        $customizations = unserialize($fileContents);

        echo '<select name="customization">';
        foreach ($customizations as $c) {
            echo '<option value="' . $c['name'] . '">' . $c['name'] . '</option>';
        }
        echo '</select>';
        ?> <br> <br> <br>
        <input type="submit" value="Compare">
    </form>

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