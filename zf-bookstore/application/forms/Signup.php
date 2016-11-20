<?php

class Application_Form_Signup extends Zend_Form
{

    public function init()
    {
        
        $member_login = new Zend_Form_Element_Text('member_login');
        $member_login ->setLabel('Login ID')->setRequired('true');
        $member_login ->setValue("andres");
        $member_login ->addValidator(new Zend_Validate_StringLength(array('min'=>5)));
        
       
        $password = new Zend_Form_Element_Password('member_password');
        $password->setLabel('Password')->setRequired('true');
        $password->addValidator(new Zend_Validate_StringLength(array('min'=>5)));
        
               
        $confirm_password = new Zend_Form_Element_Password('confirm_password');
        $confirm_password->setLabel('Confirm Password')->setRequired('true');
        
        $confirm_password->addValidator(new Zend_Validate_StringLength(array('min'=>5)));
        $confirm_password->addValidator(new Zend_Validate_Identical(array('token' => 'member_password' ,'strict' => FALSE)));
        
        
        $first_name = new Zend_Form_Element_Text('first_name');
        $first_name->setLabel('First Name')->setRequired('true');
        $first_name->setValue("andres");
        $first_name->addValidator(new Zend_Validate_StringLength(array('min'=>3)));
        
        
        
        $last_name = new Zend_Form_Element_Text('last_name');
        $last_name->setLabel('Last Name')->setRequired('false');
        $last_name->setValue("andres");
        $last_name->addValidator(new Zend_Validate_StringLength(array('min'=>3)));
        
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')->setRequired('true');
        $email->setValue("andres.namm.001@gmail.com");
        $email->addValidator(new Zend_Validate_EmailAddress(array('domain'=>true)));
        
        
        
        $birthday = new Zend_Form_Element_Text('birthday');
        $birthday->setLabel('Birthday')->setRequired('true');
        $birthday->addValidator(new Zend_Validate_Date());
        $birthday->setValue("1992-08-08");
        
        
        
        
        
       
        
        
        
        /* Form Elements & Other Definitions up ... */
        $this->setMethod('post');
        $this->addElements(array($member_login,$password,$confirm_password,$first_name,$last_name,$email,$birthday));
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add Book',
        ));
        
        
    }


}

