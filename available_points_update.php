<!--
 This page allows the admin to specify the total points available to be spent in the system
-->
<html>
    <head>
        <title>Total Points Update</title>
    </head>
    <body>
        <div >


            <h2>Update Total Available System Points</h2>
            <?php 
            
            $file = fopen("points/total_points.txt", "r") or die("Unable to open file");
            
            if (filter_input(INPUT_POST, "available_system_points") != null) {
                
                $file2 = fopen("points/total_points.txt", "w") or die("Unable to open file");
                fwrite($file2, filter_input(INPUT_POST, "available_system_points"));
                fclose($file2);
            }
            ?>
            
            
            <p>Total points available in system: <?= fgets($file); ?></p>
            <?php fclose($file); ?>

            <form name="available_system_points_form" method="POST" action="available_points_update.php">
                <input type="number" name="available_system_points" value="" required />
                <p></p>
                <input type="submit" value="Update" name="update" />
            </form>
        </div>
    </body>



</html>