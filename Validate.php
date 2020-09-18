<?php


class Validate
{
    private $pdo = null, $errors = [], $passed = false;

    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    public function check($post,$fields = []){
        vd($post);
        foreach ($fields as $field => $rules) {
            foreach($rules as $rule => $rule_val){
                $value = $_POST[$field];
                $files = $_FILES[$field];

                if($rule == 'required' && empty($value) && empty($files)){
                    $this->addError("{$field} is required");
                }elseif(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_val){
                                $this->addError("{$field} must be a minimum of {$rule_val} characters");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_val){
                                $this->addError("{$field} must be a maximum of {$rule_val} characters");
                            }
                        break;
                        case 'email':
                            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                                $this->addError("{$field} is not email");
                            }
                        break;
                        case 'unique':
                            $check = $this->pdo->get($rule_val,[$field,'=',$value]);
                            if($check->count()){
                                $this->addError("$field is already exist");
                            }
                        break;
                        case 'matches':
                            if($value != $post[$rule_val]){
                                $this->addError("{$rule_val} must be match with {$field}");
                            }
                        break;

                    }
                }
            }
        }

        if(empty($this->errors)){
            $this->passed = true;
        }

    }

    public function addError($error){
        $this->errors [] = $error;
    }

    public function errors(){
        return $this->errors;
    }

    public function passed(){
        return $this->passed;
    }
}