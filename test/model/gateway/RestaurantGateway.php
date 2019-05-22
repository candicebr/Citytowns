<?php


namespace Model\gateway;

use app\src\App;

class RestaurantGateway
{
    /**
     * @var \PDO
     */
    private $conn;

    private $id;

    private $nom;

    private $reputation;


    public function __construct(App $app)
    {
        $this->conn = $app->getService('database')->getConnection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getReputation()
    {
        return $this->reputation;
    }

    /**
     * @param mixed $reputation
     */
    public function setReputation($reputation): void
    {
        $this->reputation = $reputation;
    }


    public function insert() : void
    {
        $query = $this->conn->prepare('INSERT INTO restaurant (nom, reputation) VALUES (:nom, :reputation)');
        $executed = $query->execute([
            ':nom' => $this->nom,
            ':reputation' => $this->reputation,
        ]);

        if(!$executed) throw new \Error('Insert Failed');

        $this->id = $this->conn->lastInsertId();
    }

    public function update() : void
    {
        if(!$this->id) throw new \Error('Instance does not exist in base');

        $query = $this->conn->prepare('UPDATE restaurant SET nom = :nom, reputation = :reputation WHERE id = :id');
        $executed = $query->execute([
            ':nom' => $this->nom,
            ':reputation' => $this->reputation,
            ':id' => $this->id
        ]);

        if(!$executed) throw new \Error('Update failed');

    }

    public function delete() : void
    {
        if(!$this->id) throw new \Error('Instance does not exist in base');

        $query = $this->conn->prepare('DELETE FROM restaurant WHERE id = :id');
        $executed = $query->execute([
            ':nom' => $this->nom,
            ':reputation' => $this->reputation,
            ':id' => $this->id
        ]);

        if(!$executed) throw new \Error('Delete failed');

    }

    public function hydrate(Array $element)
    {
        $this->id = $element['id'];
        $this->nom = $element['nom'];
        $this->reputation = $element['reputation'];

    }

}