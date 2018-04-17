<?php


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conversations
 *
 * @author NeonTetras
 * @ORM\Entity (repositoryClass = "ConversationRepository")
 * @ORM\Table (name="chx_conversations")
 * 
 */
class Conversations {
    
    /**
     * @ORM\Column (type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @var int
     */
    protected $id;
     /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="conversations")
     * 
      * @var 
     * 
     */
    protected $sender;
     /**
     *@ORM\ManyToOne(targetEntity="User", inversedBy="conversations")
     * 
     * @var User
     */
    protected $recipient;
     /**
     * @ORM\Column (type="datetimetz")
     * 
     * @var DateTime
     */
    protected $date;
    
    /**
     * @ORM\OneToMany(targetEntity="Messages", mappedBy="conversation")
     * @var Messages an ArrayCollection of Messages
     */
    protected $messages = null;
   
    
    public function getId() {
        return $this->id;
    }

    public function getSender() {
        return $this->sender;
    }

    public function getRecipient() {
        return $this->recipient;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function assignUser(User $user){
        $user->assignToConversation($this);
      }
    

    public function setId($id) {
        $this->id = $id;
    }

    public function setSender($sender) {
        $this->sender = $sender;
    }

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    public function setDate(DateTime $date) {
        $this->date = $date;
    }

    public function getMessages(){
        return $this->messages;
    }

    public function setMessages(Messages $messages) {
        $this->messages[] = $messages;
    }
    
   

    
     
    public function __construct() {
      $this->messages = new ArrayCollection();   
      $this->replyMessages = new ArrayCollection();
    }

}
