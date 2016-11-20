<?php

class Application_Model_Member
{
    protected $_member_id;
    protected $_member_login;
    protected $_member_password;
    protected $_member_level;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_phone;
    protected $_birthday;
    protected $_address;
    protected $_notes;
    
    
    
    
    public function __construct(array $options = null)
    {
        
        //$this->set_address($options["address"]);
      //  $this->set_member_login(options["address"]);
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
     
            $method = 'set_' . $key;
            
            if (in_array($method, $methods)) {
                $this->$method($value);
                debug_to_console($method);
                
            }
        }
        return $this;
    }
    
    function get_member_id() {
        return $this->_member_id;
    }

    function get_member_login() {
        return $this->_member_login;
    }

    function get_member_password() {
        return $this->_member_password;
    }

    function get_member_level() {
        return $this->_member_level;
    }

    function get_first_name() {
        return $this->_first_name;
    }

    function get_last_name() {
        return $this->_last_name;
    }

    function get_email() {
        return $this->_email;
    }

    function get_phone() {
        return $this->_phone;
    }

    function get_birthday() {
        return $this->_birthday;
    }

    function get_address() {
        return $this->_address;
    }

    function get_notes() {
        return $this->_notes;
    }

    function set_member_id($_member_id) {
        $this->_member_id = (int) $_member_id;
    }

    function set_member_login($_member_login) {
        $this->_member_login =  (string) $_member_login;
    }

    function set_member_password($_member_password) {
        $this->_member_password = (string) $_member_password;
    }

    function set_member_level($_member_level) {
        $this->_member_level =  (int) $_member_level;
    }

    function set_first_name($_first_name) {
        $this->_first_name =  (string) $_first_name;
    }

    function set_last_name($_last_name) {
        $this->_last_name = (string) $_last_name;
    }

    function set_email($_email) {
        $this->_email = (string) $_email;
    }

    function set_phone($_phone) {
        $this->_phone = (string) $_phone;
    }

    function set_birthday($_birthday) {
        $this->_birthday = (string) $_birthday;
    }

    function set_address($_address) {
        $this->_address = (string)$_address;
    }

    function set_notes($_notes) {
        $this->_notes = (string) $_notes;
    }



}

