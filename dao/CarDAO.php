<?php

include_once("models/Car.php");

class CarDAO implements CarDAOInterface {

    private $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function findAll(){

        $cars = [];

        $sql = "SELECT * FROM cars";
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll();

        foreach($data as $itemCar){

            $car = new Car();

            $car->setId($itemCar['id']);
            $car->setBrand($itemCar['brand']);
            $car->setKm($itemCar['km']);
            $car->setColor($itemCar['color']);

            $cars[] = $car;

        }

        return $cars;

    }

    public function create(Car $car) {

        $sql = "INSERT INTO cars (brand, km, color) values (:brand, :km, :color)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(":brand", $car->getBrand());
        $stmt->bindparam(":km", $car->getKm());
        $stmt->bindparam(":color", $car->getColor());

        $stmt->execute();

    }
    
}