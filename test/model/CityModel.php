<?php

namespace model;

use database\Database;
use model\CitiesInterface;


class CityModel implements CitiesInterface {

    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

    public function findAll() : Array {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAllCountries() : Array {
        $query = $this->conn->prepare('SELECT DISTINCT c.country FROM city c ORDER BY c.country'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAByCountry($name) : Array {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.country = :name ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':name' => $name]); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($searchString) {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.name like :search ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':search' => '%' . $searchString .  '%']); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOneById(int $id) {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function save(Array $city) : Bool {
        $query = $this->conn->prepare('INSERT INTO city (name, country, life) VALUES (:name, :country, :life)'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        return $query->execute([
            ':name' => $city['name'],
            ':country'=> $city['country'],
            ':life' => $city['life']
        ]);
    }
}

