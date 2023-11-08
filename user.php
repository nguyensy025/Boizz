<?php
class User{
    public $id;
    public $name;
    public $role;
    
    function __construct($id, $name,$role){
        $this->id = $id;
        $this->name =$name;
        $this->role = $role;
    }
}
?>