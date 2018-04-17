<?php
require_once '../Bootstrap.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class PointCreator{
 private $entityManager;
 
function __construct(){
 
 $bootstrap = new Bootstrap();
    $this->entityManager = $bootstrap->getEntityManager();
}

function createPoint($userId,$point){
//    $userId = $argv[1];
//$point = $argv[2];

$points = new Points();
$user =  $this->entityManager->find(User::class,$userId);

$points->setUser($user);


if(!$user){
    echo sprintf("User with id %d does not exist",$userId);
    exit(1);
}

$p =  $this->entityManager->getRepository(Points::class)->getUserPoints($userId);
$total = 0;

if(!$p){
 $point += $total ; 
 $points->setPoint($point);
 $points->setCreated(new DateTime("now"));
 $points->setUpdated(new DateTime("now"));
 $this->entityManager->persist($points);


}else{
    $total = $p->getPoint();
    $points =$total + $point ; 
    $p->setPoint($point);
    $p->setUpdated(new DateTime("now"));
       
    
}
 $this->entityManager->flush();
echo sprintf("User %s awarded with %d points\n",$user->getUsername(),$point);

}
}



