<?php


class Car
{
   
    private $table = 'cars';
    private int $id =0;
    private string $name;
    private int $brand;
    private int $type;
    
    private string $brand_name;
    private string $type_name;
    private string $fuel_type;
    private int $seats;
    private string $transmission;

    private  $price_per_day;
    private string $image;
    private DateTime $created_at;
    private $updated_at;  
    
    private $status ='available';



    public function __construct($id,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image,$status)
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
        $this->status = $status;
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

    public function getBrandName()
    {
        return $this->brand_name;
    }
    public function getTypeName()
    {
        return $this->type_name;
    }
        
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function getStatus()
    {
        return $this->status;
    }
   public function setName($name)
    {
        $this->name = $name;
    }
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function setFuelType($fuel_type)
    {
        $this->fuel_type = $fuel_type;
    }
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }
    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;
    }
     public function setTypeName($type_name)
    {
        $this->type_name = $type_name;
    }
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;
    }
}
?>x