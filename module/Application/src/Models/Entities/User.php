<?php

namespace Application\Models\Entities;

use Application\Models\Entities\Abstracts\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="Application\Models\Entities\Repositories\UserRepository") */
class User extends Entity{

    public function __construct() {
    }
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
	public function setid($id) {
            $this->id = $id;
            return $this;
	}
	public function getid() {
            return $this->id;
	}

        /** @ORM\Column(type="string") */
    protected $Email;
	public function setEmail($email) {
            $this->Email = $email;
            return $this;
	}
	public function getEmail() {
            return $this->Email;
	}
        
    /** @ORM\Column(type="string") */
    protected $Password;
	public function setPassword($password) {
            $this->Password = $password;
            return $this;
	}
	public function getPassword() {
            return $this->Password;
	}

    /** @ORM\Column(type="string") */
    protected $FirstName;
	public function setFirstName($firstName) {
		$this->FirstName = $firstName;
		return $this;
	}
	public function getFirstName() {
		return $this->FirstName;
	}
        
    /** @ORM\Column(type="string") */
    protected $LastName;
	public function setLastName($lastName) {
		$this->LastName = $lastName;
		return $this;
	}
	public function getLastName() {
		return $this->LastName;
	}
	public function getFullName() {
		return $this->getFirstName () . ' ' . $this->getLastName ();
	}

        public function exchangeArray($data) {
        $this->id 		= (! empty ( $data [$this->getFieldName('id')] )) 		? $data [$this->getFieldName('id')] 		: null;
        $this->Email 		= (! empty ( $data [$this->getFieldName('Email')] )) 		? $data [$this->getFieldName('Email')] 		: null;
        $this->FirstName 	= (! empty ( $data [$this->getFieldName('FirstName')] )) 	? $data [$this->getFieldName('FirstName')] 	: null;
        $this->LastName 	= (! empty ( $data [$this->getFieldName('LastName')] )) 	? $data [$this->getFieldName('LastName')] 	: null;
        $this->Password   	= (! empty ( $data [$this->getFieldName('Password')] ))          ? $data [$this->getFieldName('Password')] 	: null;
   }

    public function getArrayValue (){
        return [
            'id'                => $this->id,
            'Email' 		=> $this->Email,
            'FirstName' 	=> $this->FirstName,
            'LastName' 		=> $this->LastName ,
            'Password' 		=> $this->Password ,
       ];
    }	
}
