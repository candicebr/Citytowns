<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-03-27
 * Time: 09:26
 */


namespace controller;

use app\src\Request\Request;
use controller\ControllerBase;

class CountryController extends ControllerBase
{
    public function __construct($model) {
        parent::__construct($model);
    }

    public function countriesHandler(Request $request) {
        $countries = $this->app->getService('cityFinder')->findAllCountries();
        return $this->app->getService('render')('countries', ['countries' => $countries]);
    }

    public function countryHandler(Request $request, $country) {
        if(!$country) {
            return $this->app->getService('render')('404');
        }

        $cities = $this->app->getService('cityFinder')->findAByCountry($country);

        if(count($cities) === 0) {
            return $this->app->getService('render')('404');
        }

        return $this->app->getService('render')('country', ['cities' => $cities, 'country' => $country]);
    }


}