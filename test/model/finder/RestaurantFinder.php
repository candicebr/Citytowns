<?php


namespace model\finder;

use app\src\App;
use model\finder\FinderInterfaceR;
use model\gateway\RestaurantGateway;

class RestaurantFinder implements FinderInterfaceR
{
    /**
     * @var \PDO
     */
    private $conn;

    /**
     * @var App
     */
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->conn = $this->app->getService('database')->getConnection();
    }

    public function findAllRestaurants()
    {
        $query = $this->conn->prepare('SELECT r.id, r.nom, r.reputation FROM restaurant r ORDER BY r.nom'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($elements) == 0) return null;

        $restaurants = [];
        $restaurant = null;

        foreach ($elements as $element)
        {
            $restaurant = new RestaurantGateway($this->app);
            $restaurant->hydrate($element);

            $restaurants[] = $restaurant;
        }

        return $restaurants;
    }

    public function findOneRestaurant($id)
    {
        $query = $this->conn->prepare('SELECT r.id, r.nom, r.reputation FROM restaurant r WHERE r.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if ($element == null) return null;

        $restaurant = new RestaurantGateway($this->app);
        $restaurant->hydrate($element);

        return $restaurant;
    }

}