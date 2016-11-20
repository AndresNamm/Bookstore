<?php

include "toConsole.php";

class BooksController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        /* default to the view action */
        $this->_redirect('/books/view');
        //$this->_helper->redirector('view');		
    }

    public function viewAction() {
        $book = new Application_Model_BookMapper();
        $this->view->books = $book->fetchAll();
    }

    public function insertAction() {
        $request = $this->getRequest();
        $form = new Application_Form_Book();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $book = new Application_Model_Book($form->getValues());
                $mapper = new Application_Model_BookMapper();
                //debug_to_console($form->getValues() );
                //debug_to_console($book->getAuthor() );
                $mapper->save($book);
                return $this->_helper->redirector('view');
            }
        }

        $this->view->form = $form;
    }

    public function editAction() {
        //$request = $this->getRequest();
        $id = $request->getParam("id");



        $book = new Application_Model_Book();
        $mapper = new Application_Model_BookMapper();
        $mapper->find($id, $member);
        //	$this->view->book = $book;

        $form->populate($member);
        $this->view->form = $form;
    }

    public function detailAction() {
        $request = $this->getRequest();
        $id = $request->getParam("id");
        $book = new Application_Model_Book();
        $mapper = new Application_Model_BookMapper();
        $mapper->find($id, $book);
        $this->view->book = $book;
    }

    public function signupAction() {
        // action body loads a new view with signup form ...  
        // called by layout. The callin place does not actually matter 
        $request = $this->getRequest();
        $form = new Application_Form_Signup();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $member = new Application_Model_Member($form->getValues());
                $mapper = new Application_Model_MemberMapper();
                //debug_to_console($form->getValues() );
                debug_to_console(array($member->get_member_login()));
                $mapper->save($member);
                return $this->_helper->redirector('login', 'Auth');
            }
        }

        $this->view->form = $form;
    }

    public function editinfAction() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector->gotoSimple('index', 'books');
        }


        $form = new Application_Form_Signup();
        $request = $this->getRequest();
        $userInfo = Zend_Auth::getInstance()->getStorage()->read();
        $id = $userInfo->member_id;
        $mapper = new Application_Model_MemberMapper();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                //debug_to_console($form->getValues() );


                $member = new Application_Model_Member($form->getValues());
                $member->set_member_id($id);
                $mapper->save($member);
                return $this->_helper->redirector('index', 'books');
            }
        }


        //$this->view->username = $userInfo->member_login;

        $member = new Application_Model_Member();
        $row = $mapper->find($id, $member);

        $this->view->username = $member->get_member_login();
        $form->populate($row->toArray());
        $this->view->form = $form;
    }
   

    public function searchAction() {
        // action body
        //$this->_helper->layout()->disableLayout();

        $this->_helper->layout('layout')->disableLayout();
        $q = $_GET['searchword'];
        $this->view->search = 'searchword' . $q;
        if ($this->getRequest()->isXmlHttpRequest()) {
            if ($this->getRequest()->isGet()) {
                $bookMapper = new Application_Model_BookMapper();
                $book = new Application_Model_Book();
                if ($q =='q'){
                    $this->view->books = $bookMapper->fetchAll();
                } else {
                    $bookMapper->find((int)$q, $book);
                    $this->view->books = array($book);
                }
            }
        }
    }

}
