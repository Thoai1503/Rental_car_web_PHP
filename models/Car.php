<?php


class Car
{
    private $pdo;
    private $table = 'cars';
    private int $id =0;
    private string $name;
    private string $brand;
    private string $type;
    private string $fuel_type;
    private int $seats;
    private string $transmission;

    private  $price_per_day;
    private string $image;
    private DateTime $created_at;
    private $updated_at;  
    



    public function __construct($id=0,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->type = $type;
        $this->fuel_type = $fuel_type;
        $this->seats = $seats;
        $this->transmission = $transmission;
        $this->price_per_day = $price_per_day;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getBrand()
    {
        return $this->brand;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getFuelType()
    {
        return $this->fuel_type;
    }
    public function getSeats()
    {
        return $this->seats;
    }
    public function getTransmission()
    {
        return $this->transmission;
    }
    public function getPricePerDay()
    {
        return $this->price_per_day;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
  
 
}
?>