<?php
class Booking
{
    private int $id;
    private int $userId;
    private int $carId;
    private string $startDate;
    private string $endDate;
    private string $status;

    public function __construct($id, $userId, $carId, $startDate, $endDate, $status)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->carId = $carId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCarId()
    {
        return $this->carId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
?>