<?php
class Authorization
{
    private int $id_authen=0;
    private string $url;
   
    private string $title;
    public function __construct($id_authen,$url,$title){
      $this->id_authen=$id_authen;
      $this->url=$url;
    
      $this->$title=$title;
    }
    public function getIdAuthen(){
      return  $this->id_authen;
    }

    public function getUrl(){
      return  $this->url;
    }


    public function getTitle(){
      return  $this->title;
    }


}
?>