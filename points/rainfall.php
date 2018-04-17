<!-- 
    This page handles the distribution of points to all users
    Admin inputs the point he wants to distribute to all users and the points remaining in system after distribution is computed
--->


<html>
    <head>
        <title>ChatonX -Rainfall</title>
    </head>
    <body>
        <?php
        require_once '../bootstrap.php';
        $file = fopen("total_points.txt", "r") or die("Unable to open file");

        $totalPointsInSystem = fgets($file);
        $user_rep = $entityManager->getRepository(User::class);
        $allUsers = $user_rep->findAll();
        ?>
        <h3>Award points to all users</h3>
        <?php
        $points_to_award = filter_input(INPUT_POST, "point");
        if ($points_to_award != null && $points_to_award > 0) {



            if ((count($allUsers) * $points_to_award) >= $totalPointsInSystem) {
                exit("Error:> Too many points to be awarded");
            }
            foreach ($allUsers as $users) {
                // echo $users->getId();
                $points = new Points();
                $points->createPoint($entityManager, $users->getId(), $points_to_award);
            }
        }
        ?>
        <input type="hidden" id="points_in_system"/>
        <input type="hidden" id="total_users" value="<?= count($allUsers); ?>"/>
        <p>Total points available in system: <i id="point_balance"><?= $totalPointsInSystem; ?></i></p>
        <?php fclose($file); ?>
        <form action="#" method="post">
            <p>Points to award to all users:<br>
            <input type="number" step="any" min="0" name="point" id="point" onKeyup="doSum()"/> <p>
                <button type="submit" name="submit" id="submit">Submit</button>
        </form>

        <script>
            function doSum() {
                
                balance = document.getElementById("points_in_system").value;
                point_inputed = document.getElementById("point").value;
                total_users = document.getElementById("total_users").value;
                total_points_to_award = point_inputed * total_users;
                sum = balance - total_points_to_award;

                document.getElementById("point_balance").innerHTML = sum;

//                if ( 0 > sum) {
//                    //  document.getElementById("submit")("visibility","collapse");
//                    ///alert("Too many points to be awarded");
//                }


            }
        </script>
    </body>



</html>