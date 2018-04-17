<!---
  This page allows admin to assign points to a selected user
-->
<html>
    <head>
        <title>ChatonX-Assign Points</title>
      
    </head>
    <body>
        <?php
        require '../Bootstrap.php';

        $bootstrap = new Bootstrap();
        $entityManager = $bootstrap->getEntityManager();

        $userRep = $entityManager->getRepository(User::class);

        $allUsers = $userRep->findAll();
        ?>
        <?php 
            if(filter_input(INPUT_POST, "users") != null){
            
                $pointCreator = new PointCreator();
                $pointCreator->createPoint(filter_input(INPUT_POST, "users"), filter_input(INPUT_POST, "point"));
                
            }
            
        ?>
        <form action="#" method="post">
            <label for="user_select">Select user</label><br/>
            <select name="users" id="user_select"  >
                <?php foreach ($allUsers as $user):
                    ?>
                    <option value="<?= $user->getId(); ?>" ><?= $user->getUsername(); ?></option>
                    <?php
                endforeach;
                ?>
            </select>
            <br>
            <label for="point">Award point</label><br>
            <input type="number" name="point" id="point" step="any" min="0" required /><br>

            <button  type="submit">Award Point</button>
        </form>
    </body>

</html>