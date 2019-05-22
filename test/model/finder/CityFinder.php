<?php


namespace model\finder;

use app\src\App;
use model\finder\FinderInterface;
use model\gateway\CityGateway;

class CityFinder implements FinderInterface
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

    public function findAll()
    {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($elements) == 0) return null;

        $cities = [];
        $city = null;

        foreach ($elements as $element)
        {
            $city = new CityGateway($this->app);
            $city->hydrate($element);

            $cities[] = $city;
        }

        return $cities;
    }

    public function findOneById($id)
    {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $element = $query->fetch(\PDO::FETCH_ASSOC);

        if ($element == null) return null;

        $city = new CityGateway($this->app);
        $city->hydrate($element);

        return $city;
    }

    public function findAllCountries()
    {
        $query = $this->conn->prepare('SELECT DISTINCT c.country FROM city c ORDER BY c.country'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if($elements == 0) return null;

        $countries = [];
        $country = null;

        foreach ($elements as $element)
        {
            $country = new CityGateway($this->app);
            $country->hydrateCountry($element);

            $countries[] = $country;
        }

        return $countries;
    }

    public function findAByCountry($name)
    {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.country = :name ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':name' => $name]); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if($elements == 0) return null;

        $cities = [];
        $city = null;

        foreach ($elements as $element)
        {
            $city = new CityGateway($this->app);
            $city->hydrate($element);

            $cities[] = $city;
        }

        return $cities;
    }

    public function search($searchString)
    {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.name like :search ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':search' => '%' . $searchString .  '%']); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if($elements == 0) return null;

        $cities = [];
        $city = null;

        foreach ($elements as $element)
        {
            $city = new CityGateway($this->app);
            $city->hydrate($element);

            $cities[] = $city;
        }

        return $cities;
    }

}