<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author NeonTetras
 * @ORM\Entity
 * @ORM\Table(name="chx_users")
 */
class User {
   
    /**
     * @ORM\Column (type="integer")
     * @ORM\GeneratedValue
     * @var int
     * @ORM\Id
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=20)
     * @var string
     * 
     */
    protected $username;
    /**
     *@ORM\Column(type="integer",length=255,nullable=false)
     * @var int
     */
    protected $phone;
    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     * @var string
     */
    protected $country;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $image;
    /**
     * @ORM\Column(type="string",name="auth_token")
     */
    protected $authToken;
    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    protected $status;
    /**
     * @ORM\Column(type="integer", length=11,  nullable=false,name="status_date")
     */
    protected $statusDate;
    /**
     * @ORM\Column(type="integer", length=1, nullable=false,name="is_activated")
     */
    protected $activated = 0;
    /**
     * @ORM\Column(type="integer", length=1, nullable=false,name="has_backup")
     */
    protected $hasBackup = 0;
    /**
     * @ORM\Column(type="string",  nullable=true,name="backup_hash")
     */
    protected $backupHash;
    /**
     * @ORM\Column(type="text",  nullable=false)
     */
    protected $registered;
    
     /**
     * @ORM\OneToMany(targetEntity="Messages", mappedBy="user")
     * @var Messages[] An ArrayCollection of Message objects
     */
    protected $messages = null;
    /**
     * @ORM\OneToMany(targetEntity="Groups", mappedBy="user")
     * @var Groups An ArrayCollection of Group objects
     */
    protected $groups = null;
    
       /**
     * @ORM\OneToMany(targetEntity="Conversations", mappedBy="user")
     * @var Conversations An ArrayCollection of conversation objects
     */
    protected $conversations = null;

    public function __construct() {
        $this->messages = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->conversations = new ArrayCollection();
    }
    
    public function assignToMessage(Messages $msg){
        $this->messages[] = $msg;
    }
    
      public function assignToConversation(Conversations $conv){
        $this->conversations[] = $conv;
    }

        public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getImage() {
        return $this->image;
    }

    public function getAuthToken() {
        return $this->authToken;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getStatusDate() {
        return $this->statusDate;
    }

    public function getActivated() {
        return $this->activated;
    }

    public function getHasBackup() {
        return $this->hasBackup;
    }

    public function getBackupHash() {
        return $this->backupHash;
    }

    public function getRegisteredId() {
        return $this->registeredId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setAuthToken($authToken) {
        $this->authToken = $authToken;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setStatusDate($statusDate) {
        $this->statusDate = $statusDate;
    }

    public function setActivated($activated) {
        $this->activated = $activated;
    }

    public function setHasBackup($hasBackup) {
        $this->hasBackup = $hasBackup;
    }

    public function setBackupHash($backupHash) {
        $this->backupHash = $backupHash;
    }

    public function setRegisteredId($registeredId) {
        $this->registeredId = $registeredId;
    }


    public function getGroups(): Groups {
        return $this->groups;
    }

    public function setGroups(Groups $groups) {
        $this->groups[] = $groups;
    }

    public function getConversations(): Conversations {
        return $this->conversations;
    }

    public function setConversations(Conversations $conversations) {
        $this->conversations = $conversations;
    }



 

}
