<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Points
 *
 * @author NeonTetras
 * @ORM\Entity(repositoryClass="PointRepository")
 * @ORM\Table (name="points")
 *
 */
class Points implements \JsonSerializable {
    
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * 
        @ORM\OneToOne(targetEntity="User")  
     *  @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *    */
    protected $user;
    
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $point;
     /**
     * @ORM\Column (type="datetime")
     * @var DateTime
     */
    protected $created;
    
     /**
     * @ORM\Column (type="datetime")
     * @var DateTime
     */
    protected $updated;
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPoint() {
        return $this->point;
    }

   
    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPoint($point) {
        $this->point = $point;
    }

    public function getCreated(): DateTime {
        return $this->created;
    }

    public function setCreated(DateTime $created) {
        $this->created = $created;
    }

    public function getUpdated(): DateTime {
        return $this->updated;
    }

    public function setUpdated(DateTime $updated) {
        $this->updated = $updated;
    }



    public function createPoint($entityManager,$userId,$point){
        $points = new Points();
$user = $entityManager->find(User::class,$userId);

$points->setUser($user);
$points->setCreated(new DateTime("now"));

if(!$user){
    echo sprintf("\nUser with id %d does not exist\n",$userId);
    exit(1);
}

$p = $entityManager->getRepository(Points::class)->getUserPoints($userId);
$total = 0;

if(!$p){
 $point = $point + $total ; 
 $points->setPoint($point);
 $points->setUpdated(new DateTime("now"));
$entityManager->persist($points);


}else{
    $total = $p->getPoint();
    $point = $total + $point ; 
    $p->setPoint($point);
    $p->setUpdated(new DateTime("now"));
       
    
}
$entityManager->flush();
echo sprintf("\nUser %s awarded with %f points\n",$user->getUsername(),$point);

    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
