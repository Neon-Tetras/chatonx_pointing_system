<?php

/* 
 * This script gets a user point
 */

include_once '../bootstrap.php';

if(filter_input(INPUT_GET, "user_id") != null){
$user_id = filter_input(INPUT_GET, "user_id");
$pointRep = $entityManager->getRepository(Points::class);

$points = $pointRep->findBy(array("user"=>$user_id));
$array = array("user_id"=>$user_id,
                "point"=>$points[0]->getPoint(),
                "created"=>$points[0]->getCreated(),
                "last_updated"=>$points[0]->getUpdated());

echo json_encode($array);
}else{
    echo json_encode(array("error"=>"No user id"));
}