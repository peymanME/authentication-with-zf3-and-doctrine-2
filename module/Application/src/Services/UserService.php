<?php
namespace Application\Services;

use Application\Services\Interfaces\UserServiceInterface;
use Application\Models\Entities\User;

use Zend\Session\Container;
use Zend\Crypt\Password\Bcrypt;

class UserService implements UserServiceInterface 
{
    protected $entityManager;
    
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }
    
    
    public function getUserBySession(){
        $sessionUser = new Container('Autenticate');
        $id = ($sessionUser->offsetExists('Id'))? (int)$sessionUser->Id : 0;
        if ($id !== 0){
            return $this->find(Users::class, $id);
        }
        return null;
    }
    private function getEntity($entity){
        $user = new User();
        $user->mapFormToObject($entity);
        return $user;
  
    }

    public function register ($entityArray){
        $user = $this->getEntity($entityArray);
        //$user->setPassword(hash ( 'md5', $user->getPassword () ));
        return $this->save($user); 
    }
    
    public function login ($entityArray){
        $user = $this->getEntity($entityArray);
        $userDB = $this->findBy(Users::class,array('Email'=>$user->getEmail()));
        if (is_array($userDB)){
            if (count($userDB) === 1) {
                return $this->Authenticate($userDB[0], $user);
            }
        }
        return false;
    }
    
    public function save($entity){
        if ($entity->getid()===null){		
            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
        return $entity;
        
    }

    
    
    
    public function Authenticate($formArray) {
        $rt = new \DoctrineORMModule();
        $rt->
        $authAdapter = new \Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter ($this->entityManager);
 echo "it is O.k";
        $authAdapter
            ->setTableName('User')
            ->setIdentityColumn('Email')
            ->setCredentialColumn('Password');
        echo "it is O.k";
        
    }
    

    private function createToken($authentecation) {
            $sessionToken = new Container ( 'Autenticate' );
            $sessionToken->Aouth    = $authentecation->getFullname ();
            $sessionToken->Id       = ($authentecation->getid ());
            $sessionToken->State    = true;
    }
    
    public function deleteToken() {
            $sessionToken = new Container ( 'Autenticate' );
            $sessionToken->getManager ()->getStorage ()->clear ();
    }
    public function Is_Authenticate() {
        $sessionToken = new Container ( 'Autenticate' );
        return ($sessionToken->offsetExists("State"))? $sessionToken->State: false;
    }
}