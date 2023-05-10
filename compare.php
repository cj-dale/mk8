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
        $connection = new mysqli("localhost", "student", "CompSci364","MK8");
        $table = $connection->prepare("SELECT customization_name FROM customizations");
        $table->execute();
        $results = $table->get_result();
        $results2 = $table->get_result();
        
        if (mysqli_num_rows($results) > 0){
            echo('<h3>Customization 1:</h3>
                <form method="post" action="compare.php" <select name="1" id="1">');
            while ($row = mysqli_fetch_assoc($results)){
                echo 
                '<option value ='.$row['customization_name'].'>'.$row['customization_name'].'</option>';
            }
            echo '</select>';
            
            echo '<h3> Customization 2:</h3>';

            echo '<select name="2" id="2">';
            while ($row = mysqli_fetch_assoc($results2)){
                echo 
                '<option value ='.$row['customization_name'].'>'.$row['customization_name'].'</option>';
            }
            echo '</select><input type="submit" value="Compare">';
        }
            else{
                echo("<br><br><br>You haven't saved any customiations yet - make some to use the compare feature!");
            }
            ?> <br> <br> <br>
        
    </form>

</body>

</html>