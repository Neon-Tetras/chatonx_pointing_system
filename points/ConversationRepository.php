<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use Doctrine\ORM\EntityRepository;


class ConversationRepository extends EntityRepository
{
    
  
    
     public function getConversationsByDates($userId,$from,$to)
    {
        
        
            $dql = "SELECT c,s,r,m FROM Conversations c JOIN c.sender s JOIN c.recipient r JOIN c.messages m"
                    . "      WHERE  (s = :uid OR r = :uid) AND DATE(m.date) between :from and :to group by m.id  ";
         $parameters = array("uid"=>$userId ,
                                "from" =>$from,
                                "to" =>$to
                            );
        return $this->getEntityManager()->createQuery($dql)
                             ->setParameters($parameters)
                             ->getResult();
    }
    public function getConversations($userId)
    {
        
            $dql = "SELECT c,s,r,m FROM Conversations c JOIN c.sender s JOIN c.recipient r JOIN c.messages m"
                    . "      WHERE  (s = :uid OR r = :uid) AND m.date <=:date group by m.id  ";
         $parameters = array("uid"=>$userId,
                                "date" =>"2018-01-27"
                            );
        return $this->getEntityManager()->createQuery($dql)
                             ->setParameters($parameters)
                             ->getResult();
    }

    public function getReceivedMessages($userId,$conversationId)
    {
           $parameters = array("rec"=>$userId,
                            "con"=>$conversationId);
        
            $dql = "SELECT c,u,m  FROM Messages m JOIN m.user u JOIN m.conversation c  "
                    . "      WHERE   m.user =:rec and c.recipient = :rec and c = :con";
   
        return $this->getEntityManager()->createQuery($dql)
                             ->setParameters($parameters)
                             ->getResult();
    }

 
}

