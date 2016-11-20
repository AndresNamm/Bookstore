<?php

class Application_Model_MemberMapper {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Members');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Member $member) {
    
        $data = array(
            //'member_id' => (int) $member->get_member_id(),
            'member_login' => (string) $member->get_member_login(),
            'member_password' => (string) $member->get_member_password(),
            'member_level' => (string) $member->get_member_level(),
            'first_name' => (string)$member->get_first_name(),
            'last_name' => (string)$member->get_last_name(),
            'email' => (string)$member->get_email(),
            'phone' => (string) $member->get_phone(),
            'birthday' =>(string) $member->get_birthday(),
            'address' => (string)$member->get_address(),
            'notes' =>(string)  $member->get_notes()
        );
        
        
        /*
        
       $data = array(
           // 'member_id' => $member->get_member_id(),
            'member_login' =>  '$member->get_member_login()',
            'member_password' => '$member->get_member_password()',
            'member_password' => 'andres',
            'member_level' => '$member->get_member_level()',
            'first_name' => '$member->get_first_name()',
            'last_name' => '$member->get_last_name()',
            'email' => '$member->get_email()',
            'phone' => '$member->get_phone()',
            'birthday' => '$member->get_birthday()',
            'address' => '$member->get_address()',
            'notes' => '$member->get_notes()'
        );
      
        */
        
        
        // debug_to_console( $data );
        
        
        if (null === ($id = $member->get_member_id())) {
            unset($data['member_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('member_id = ?' => $id));
        }
        
        
    }

    public function find($id, Application_Model_Member $member) {// As you can see, object passed by ref
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $member->set_member_id($row->member_id);
        $member->set_member_level($row->member_level);
        $member->set_member_login($row->member_login);
        $member->set_member_password($row->member_password);
        $member->set_first_name($row->first_name);
        $member->set_last_name($row->last_name);
        $member->set_address($row->address);
        $member->set_birthday($row->birthday);
        $member->set_email($row->email);
        return $row;
        
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchALL();
        $members = array();
        foreach ($resultSet as $row) {
            $member = new Application_Model_Member();
            $member->set_member_id($row->member_id);
            $member->set_member_level($row->member_level);
            $member->set_member_login($row->member_login);
            $member->set_member_password($row->member_password);
            $member->set_first_name($row->first_name);
            $member->set_last_name($row->last_name);
            $member->set_address($row->address);
            $member->set_birthday($row->birthday);
            $member->set_email($row->email);
            $members[] = $member;
            
            
     
        }
    
        return $members;
        
    }

}
