
<!-- Handle point transfer between two users -->
<?php
include_once '../bootstrap.php';

if (filter_input(INPUT_GET, "u_id") != null && filter_input(INPUT_GET, "r_id")) {
    if (filter_input(INPUT_GET, "point") == null) {
        echo json_encode(array("error" => "No point"));
        exit();
    }
    $transer_point = filter_input(INPUT_GET, "point");
    $user_id = filter_input(INPUT_GET, "u_id");
    $recipient_id = filter_input(INPUT_GET, "r_id");
  

    $user_points = $entityManager->getRepository(Points::class)->getUserPoints($user_id);

    
    if ($user_points->getPoint() <= $transer_point) {
        echo json_encode(array("error" => "Low activity points"));
        exit();
    }
    
    //Deduct the transfer point from the user making the transfer
    $p = $user_points->getPoint();
    $user_points->setPoint(($p - $transer_point));
    
    $entityManager->flush();
    
//    credit the recipient users with the point
      $recipient_points = $entityManager->getRepository(Points::class)->getUserPoints($recipient_id);
      $r_point = $recipient_points->getPoint() ;
    $recipient_points->setPoint(($r_point+ $transer_point));
    $entityManager->flush();

$array = array("message"=> sprintf("Transfer of %f activity points successful",$transer_point));

    echo json_encode($array);
} else {
    echo json_encode(array("error" => "No user id"));
}