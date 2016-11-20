<?php

class AuthController extends Zend_Controller_Action
{

    public function loginAction()
    {
        $db = $this->_getParam('db');

        $loginForm = new Application_Form_Login();

        if($this->getRequest()->isPost()){
            if ($loginForm->isValid($_POST)) {

            
            $adapter = new Zend_Auth_Adapter_DbTable(
                    $db, 'members', 'member_login', 'member_password');
                    
            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);

            
            if ($result->isValid()) {
                $authStorage = $auth->getStorage();
                $authStorage->write($adapter->getResultRowObject(null, 'password'));
                $this->_helper->FlashMessenger('Successful Login');
                $this->_helper->redirector->gotoSimple('editinf','books');
                return;
            }
            
            else{
                $this->_helper->redirector->gotoSimple('signup','books');
                
            }
            
        }
            
        }
        

        $this->view->loginForm = $loginForm;
        
        
        
        
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector->gotoSimple('login','auth');
    }


}


