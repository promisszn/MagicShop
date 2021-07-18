<?php

class UserValidator{

    private $data;
    private $errors = [];
    private static $fields = ['username', 'password'];

    public function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateUsername();
        $this->validatePassword();
        return $this->errors;
    }

    private function validateUsername() {
        $val = trim($this->data['username']);

        if(empty($val)){
            $this->addError('username', 'Username is required');
        }else {
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
                $this->addError('username','username must be 6-12 chars');
            }
        }
    }

    private function validatePassword() {
        $val = trim($this->data['password']);

        if(empty($val)){
            $this->addError('password', 'Password is required');
        }else {
            if(strlen($val) <= '6'){
                $this->addError('password','Password must contain at least 6 characters');
            }
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] = $val;
    }

}

?>