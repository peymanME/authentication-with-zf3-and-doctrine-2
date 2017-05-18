<?php
namespace Application\Models\Forms;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;

class RegisterForm extends Form
{   
  public function __construct(){
      parent::__construct('RegisterForm');
     
    $FirstName = new Text(
                'FirstName',            // Name of the element
                [                     // Array of options
                 'label'=> 'First name'  // Text label
                ]);
    $FirstName->setAttributes(array (
        'id' => 'FirstName',
        'placeholder' => 'First name',
        'required' => '',
        'class'    => "form-control"));
    $this->add($FirstName);
    $LastName = new Text(
                'LastName',            // Name of the element
                [                     // Array of options
                 'label'=> 'LastName'  // Text label
                ]);
    $LastName->setAttributes(array (
        'id' => 'FastName',
        'placeholder' => 'Last name',
        'required' => '',
        'class'    => "form-control"));
    $this->add($LastName);
  
    $email = new Text(
                'Email',            // Name of the element
                [                     // Array of options
                 'label'=> 'Email'  // Text label
                ]);
    $email->setAttributes(array (
        'id' => 'Email',
        'placeholder' => 'Email',
        'required' => '',
        'class'    => "form-control"));

    $this->add($email);

    $password = new Password(
                'Password',            // Name of the element
                [                     // Array of options
                 'label'=> 'Password'  // Text label
                ]);
    $password->setAttributes(array (
        'id' => 'Password',
        'placeholder' => 'Password',
        'required' => '',
        'class'    => "form-control"));
    $this->add($password);

    $repassword = new Password(
                'repassword',            // Name of the element
                [                     // Array of options
                 'label'=> 'Retype password'  // Text label
                ]);
    $repassword->setAttributes(array (
        'id' => 'repassword',
        'placeholder' => 'Retype password',
        'required' => '',
        'class'    => "form-control"));
    $this->add($repassword);
    
        
   
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
    

    $inputFilter->add([
        'name'     => 'repassword',
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
           [
            'name'    => 'Identical',
            'options' => [
                'token' => 'Password',
            ],
               
           ], 
        ],
      ]
    );
    $inputFilter->add([
        'name'     => 'LastName',
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
                'min' => 1,
                'max' => 45
              ],
           ],
        ],
      ]
    );
    $inputFilter->add([
        'name'     => 'FirstName',
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
                'min' => 1,
                'max' => 45
              ],
           ],
        ],
      ]
    );

  }
  
  
  
  
  
  
  
}