<?php
class User
{
    private int $id=0;
    private string $name;
    private string $email;
    private string $phone;
    private  $auth_id;
    public function __construct($id,$name,$phone,$email,$auth_id){
      $this->id=$id;
      $this->name=$name;
      $this->phone=$phone;
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
    public function getPhone(){
      return $this->phone;
    }
    public function setName($name){
      $this->name=$name;
    }
    public function setEmail($email){
      $this->email=$email;
    }
    public function setPhone($phone){
      $this->phone=$phone;
    }
    public function setAuthId($auth_id){
      $this->auth_id=$auth_id;
    }
    public function setId($id){
      $this->id=$id;
    }
    


}

