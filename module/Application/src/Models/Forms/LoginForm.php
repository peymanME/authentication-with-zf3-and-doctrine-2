<?php
namespace Application\Models\Forms;

use Zend\Form\Form;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;

class LoginForm extends Form
{   
  public function __construct(){
      
    parent::__construct('LoginForm');
     
  
    $email = new Email(
                'Email',            // Name of the element
                [                     // Array of options
                 'label'=> 'Email'  // Text label
                ]);
    $email->setAttributes(array (
        'ng-model' => 'Email',
        //'id' => 'Email',
        'placeholder' => 'Email',
        'required' => true,
        'class'    => "form-control",
         ));

    $this->add($email);

    $password = new Password(
                'Password',            // Name of the element
                [                     // Array of options
                 'label'=> 'Password'  // Text label
                ]);
    $password->setAttributes(array (
        'id' => 'Password',
        'placeholder' => 'Password',
        'required' => true,
        'class'    => "form-control",
        'data-ng-model' => 'Password'
        ));
    $this->add($password);
   $this->addInputFilter(); 
  }
  
  private function addInputFilter() 
  {
    $inputFilter = new \Zend\InputFilter\InputFilter();        
    $this->setInputFilter($inputFilter);
        
    $inputFilter->add([
        'name'     => 'Email',
        'required' => true,
        'filters'  => [
           ['name' => 'StringTrim'],                    
        ],                
        'validators' => [
           [
            'name' => 'EmailAddress',
            'options' => [
              'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
              'useMxCheck' => false,                            
            ],
          ],
        ],
      ]
    );
    
    $inputFilter->add([
        'name'     => 'Password',
        'required' => true,
        'filters'  => [
           ['name' => 'StringTrim'],
           ['name' => 'StripTags'],
           ['name' => 'StripNewlines'],
        ],                
        'validators' => [
           [
            'name' => 'StringLength',
              'options' => [
                'min' => 8
              ],
           ],
        ],
      ]
    );
    
  }
}