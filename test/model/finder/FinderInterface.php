<?php

namespace model\finder;

interface FinderInterface{
    public function findAll();
    public function findOneById($id);
    public function findAllCountries();
    public function findAByCountry($name);
    public function search($searchString);

}

