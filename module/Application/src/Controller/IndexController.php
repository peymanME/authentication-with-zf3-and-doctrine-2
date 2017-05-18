<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Models\Forms\LoginForm;
use Application\Models\Forms\RegisterForm;
use Application\Services\UserService;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $userService;
    protected $authService;
    protected $entityManager;
    
    function __construct($entityManager, $authenticationService) {
        $this->userService = new UserService($entityManager);
        $this->authService = $authenticationService;
        $this->entityManager = $entityManager;
   }
   
    public function indexAction(){
        
        $form = new LoginForm();
        
        $request = $this->getRequest();
        
        if ($request->isPost()){
            
            $form->setData($request->getPost());
            if ($form->isValid()){
                $data = $form->getData();
                $adapter = $this->authService->getAdapter();
                $adapter->setOptions(array( 
                    'objectManager'     => $this->entityManager, 
                    'identityClass'     => 'Application\Models\Entities\User', 
                    'identityProperty'  => 'Email', 
                    'credentialProperty'=> 'Password' ));
                $adapter->setIdentity($data['Email']);
                $adapter->setCredential($data['Password']);
                $authResult = $this->authService->authenticate();
                if ($authResult->isValid()) {
                    $identity = $authResult->getIdentity();
                    $this->authService->getStorage()->write($identity);
                   return $this->redirect()->toRoute('root', array('action'=>'firstPage'));
                }                
            }
        }        
        return new ViewModel(['form' => $form]);            
    }
    
    public function registerAction(){
       $message = null;
       $form = new RegisterForm();
       
       $request = $this->getRequest();
        
        if ($request->isPost()){
            
            $form->setData($request->getPost());
            if ($form->isValid()){
                $this->userService->register($form->getData());
                $form = new RegisterForm();
                $message = "You are registered! \n Please connect by Login page";
            }
        }       
       return new ViewModel(['form' => $form,'message' => $message]);            
   }
     
    public function firstPageAction(){
        $loggedUser = $this->authService->getIdentity();                
        if (isset($loggedUser)){
            $message = "You are loged in <br>" . $loggedUser->getFullName();
            return new ViewModel(['message' => $message]);
        }
        return $this->redirect()->toRoute('root');
    }
    
    public function logoutAction(){
      $this->authService->getStorage()->clear();     
      return $this->redirect()->toRoute('root');
    }
    
    
}
