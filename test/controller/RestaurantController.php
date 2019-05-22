<?php


namespace controller;

use app\src\App;
use app\src\Request\Request;
use controller\ControllerBase;
use model\gateway\RestaurantGateway;

class RestaurantController extends ControllerBase
{

    public function __construct(App $app) {
        parent::__construct($app);
        //session_start();
    }

    public function restaurantsHandler(Request $request) {
        if($_SESSION['flash']) {
            $flash = urldecode($_SESSION['flash']);
        }
        $_SESSION['flash']=null;

        $restaurants = $this->app->getService('restaurantFinder')->findAllRestaurants();
        return $this->app->getService('render')('restaurants', ["restaurants" => $restaurants, 'flash' => $flash ?? null]);
    }

    public function restaurantHandler(Request $request, $id) {
        if(!$id) {
            return $this->app->getService('render')('404');
        }

        $restaurant = $this->app->getService('restaurantFinder')->findOneRestaurant($id);

        return $this->app->getService('render')('restaurant', ['restaurant' => $restaurant]);
    }

    public function createHandlerRestaurant(Request $request) {
        return $this->app->getService('render')('createRestaurant');
    }

    public function createDBHandlerRestaurant(Request $request) {
        $result = new RestaurantGateway($this->app);
        $restaurant = [

            $result->setNom($request->getParameters('nom')),
            $result->setReputation($request->getParameters('reputation')),
        ];


        $result->insert();

        if(!$result) {
            return $this->app->getService('render')('createRestaurant', ['restaurant' => $restaurant, 'error' => true]);
        }

            $flash= "New restaurant has been sucessfully created";
            $_SESSION['flash'] =$flash;

            $this->redirect('/test/restaurants.php');

    }
/*
    public function deleteHandlerRestaurant() {
        $this->app->getService('render')('createRestaurant');
    }
*/
    public function deleteDBHandlerRestaurant(Request $request){

        $result = new RestaurantGateway($this->app);

        $restaurant = [
            $result->getId()
        ];

        $result->delete();

        if(!$result) {
            return $this->app->getService('render')('createRestaurant', ['restaurant' => $restaurant, 'error' => true]);
        }

        $flash= "New restaurant has been sucessfully delated";
        $_SESSION['flash'] =$flash;

        $this->redirect('/test/restaurants.php');
    }

    public function updateHandlerRestaurant(Request $request) {
        return $this->app->getService('render')('createRestaurant');
    }

    public function updateDBHandlerRestaurant(Request $request){

        $result = new RestaurantGateway($this->app);

        $restaurant = [
            $result->setNom($_POST['nom']),
            $result->setReputation($_POST['reputation']),
        ];


        $result->update();

        if(!$result) {
            return $this->app->getService('render')('updateRestaurant', ['restaurant' => $restaurant, 'error' => true]);
        }

        $flash= "New restaurant has been sucessfully updated";
        $_SESSION['flash'] =$flash;

        $this->redirect('/test/restaurants.php');

    }

}