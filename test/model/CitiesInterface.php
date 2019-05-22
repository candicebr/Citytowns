<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 11:00
 */

namespace model;

interface CitiesInterface
{
    public function findAll();

    public function save(Array $city);
}