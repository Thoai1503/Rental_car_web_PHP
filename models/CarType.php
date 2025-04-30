<?php
class CarType
{
    private int $id=0;
    private string $name='';


    
    private DateTime $created_at;

    public function __construct($id=0,$name='')
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public  function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}

?>