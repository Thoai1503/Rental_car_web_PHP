<?php
class User
{
    private int $id=0;
    private string $name;
    private string $email;
    private  $auth_id;
    public function __construct($id,$name,$email,$auth_id){
      $this->id=$id;
      $this->name=$name;
      $this->email=$email;
      $this->auth_id=$auth_id;


    }
    public function getId(){
      return  $this->id;
    }

    public function getName(){
      return  $this->name;
    }
    public function getEmail(){
      return  $this->email;
    }

    public function getAuthId(){
       return $this->auth_id;
    }


}

