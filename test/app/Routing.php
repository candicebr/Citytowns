<?php

namespace app;

use controller\CityController;
use controller\CountryController;
use controller\RestaurantController;
use app\src\App;


class Routing
{
    private $app;

    /**
     *Routing constructor
     *@param App $app
     */

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function setup() {
        //cities
        $city = new CityController($this->app);

        $this->app->get('/', [$city, 'citiesHandler']);

        $this->app->get('/city/(\d+)', [$city, 'cityHandler']);

        $this->app->get('/recherche.php/(\w*)', [$city, 'searchHandler']);

        $this->app->get('/recherche.php', [$city, 'searchHandlerV']);

        $this->app->get('/create.php', [$city, 'createHandler']);

        $this->app->post('/handleCreate.php', [$city, 'createDBHandler']);

       // $this->app->post('/deleteCities.php', [$city, 'deleteDBHandlerCities']);


        //countries
        $country = new CountryController($this->app);

        $this->app->get('/countries.php', [$country, 'countriesHandler']);

        $this->app->get('/country.php/(\w*)', [$country, 'countryHandler']);


        //Restaurants
        $restaurant = new RestaurantController($this->app);

        $this->app->get('/restaurants.php', [$restaurant, 'restaurantsHandler']);

        $this->app->get('/restaurant/(\d+)', [$restaurant, 'restaurantHandler']);

        $this->app->get('/createRestaurant.php', [$restaurant, 'createHandlerRestaurant']);

        $this->app->post('/handlerCreateRestaurant.php', [$restaurant, 'createDBHandlerRestaurant']);

        $this->app->get('/updateRestaurant.php', [$restaurant, 'updateHandlerRestaurant']);

        $this->app->post('/handlerUpdateRestaurant.php', [$restaurant, 'updateDBHandlerRestaurant']);

        $this->app->get('/deleteRestaurants.php', [$restaurant, 'deleteDBHandlerRestaurant']);

    }

}