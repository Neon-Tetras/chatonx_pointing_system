<?php


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groups
 *
 * @author NeonTetras
 * 
 * @ORM\Entity
 * @ORM\Table (name="chx_groups")
 */
class Groups {
    
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column (type="integer")
     * @var int
     */
    protected $id;
    /**
     * 
     * 
     * @ORM\Column (type="string")
     * @var string
     */
    protected $name;
    /**
     * ]
     * @ORM\Column (type="string")
     * @var string
     */
    protected $image;
    /**
     * ]
     * @ORM\Column (type="datetimetz")
     * @var DateTime
     */
    protected $date;
    /**
     * @ORM\ManyToMany (targetEntity="User", inversedBy="groups")
     */
    protected $user;
    
    /**
     * @ORM\OneToMany (targetEntity="Messages", mappedBy="groups")
     */
    protected $messages;
    /**
     * ]
     * @ORM\Column (type="string", name="notification_key")
     * @var string
     */
    protected $notificationKey;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getUser() {
        return $this->user;
    }

    public function getNotificationKey() {
        return $this->notificationKey;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setDate(DateTime $date) {
        $this->date = $date;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setNotificationKey($notificationKey) {
        $this->notificationKey = $notificationKey;
    }

    public function getMessages() {
        return $this->messages;
    }

    public function setMessages($messages) {
        $this->messages = $messages;
        $messages->setGroup($this);
    }

    public function __construct() {
        
        $this->messages = new ArrayCollection();
        
    }



    
}
