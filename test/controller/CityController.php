<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 15:10
 */

namespace controller;

use Controller\ControllerBase;
use app\src\App;
use model\gateway\CityGateway;
use app\src\Request\Request;

class CityController extends ControllerBase
{
    public function __construct(App $app) {
        parent::__construct($app);
        session_start();
    }

    public function citiesHandler(Request $request) {
        if($_SESSION['flash']) {
            $flash = urldecode($_SESSION['flash']);
        }
        $_SESSION['flash']=null;

        $cities = $this->app->getService('cityFinder')->findAll();

        //var_dump($request->getParameters('test'));
        return $this->app->getService('render')('cities', ["cities" => $cities, 'flash' => $flash ?? null]);
    }

    public function cityHandler(Request $request, $id) {
        if(!$id) {
            return $this->app->getService('render')('404');
        }

        $city = $this->app->getService('cityFinder')->findOneById($id);

        return $this->app->getService('render')('city', ['city' => $city]);
    }

    public function createHandler(Request $request) {
        return $this->app->getService('render')('createCity');
    }

    public function createDBHandler(Request $request) {

        $result = new CityGateway($this->app);
            $city = [
                //$result->setName($_POST['name']),
                //$result->setCountry($_POST['country']),
               // $result->setLife($_POST['life'])

                $result->setName($request->getParameters('name')),
                $result->setCountry($request->getParameters('country')),
                $result->setLife($request->getParameters('life'))
            ];


            $result->insert();

            if(!$result) {
                $this->app->getService('render')('createCity', ['city' => $city, 'error' => true]);
            }
            $flash= "New city has been sucessfully created";
            $_SESSION['flash'] =$flash;

            $this->redirect('/test/');

    }

    public function searchHandlerV(Request $request) {
        if(!key_exists('search', $_GET)) { // On vérfie si la référence est bien passée
            return $this->app->getService('render')('404');
        }

        $search = $_GET['search'];

        $cities = $this->app->getService('cityFinder')->search($search);

        return $this->app->getService('render')('cities', ['cities' => $cities]);
    }


    public function searchHandler(Request $request, $search) {
        if(!$search) {
            return $this->app->getService('render')('404');
        }

        $cities = $this->app->getService('cityFinder')->search($search);

        return $this->app->getService('render')('cities', ['cities' => $cities]);
    }

/*
    public function deleteDBHandlerCity(Request $request){

        $result = new CityGateway($this->app);

        $city = [
            $result->getId()
        ];

        $result->delete();

        if(!$result) {
            return $this->app->getService('render')('createCity', ['city' => $city, 'error' => true]);
        }

        $flash= "New city has been sucessfully delated";
        $_SESSION['flash'] =$flash;

        $this->redirect('/test/cities.php');
    }*/

}