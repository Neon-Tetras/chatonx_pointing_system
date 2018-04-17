<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use Doctrine\ORM\EntityRepository;

class PointRepository extends EntityRepository
{
   
    public function getUserPoints($userId)
    {

        return $this->getEntityManager()->getRepository(Points::class)->findOneBy(array("user"=>$userId));

    }

 
}

