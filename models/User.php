<?php
class User
{
    private int $id=0;
    private string $name;
    private string $email;
    private int $auth_id;
    public function __construct($id,$name,$email,$auth_id){
      $this->id=$id;
      $this->name=$name;
      $this->email=$email;
      $this->auth_id=$auth_id;


    }
    public function getId(){
        $this->id;
    }

    public function getName(){
        $this->name;
    }
    public function getEmail(){
        $this->email;
    }

    public function getAuthId(){
        $this->auth_id;
    }


}

