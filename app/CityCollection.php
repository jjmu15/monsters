<?php

namespace App;

use App\City;
use Illuminate\Support\Arr;

class CityCollection
{
    protected $cities = array();

    public function addCity(City $city)
    {
      $this->cities[] = $city;
    }

    public function getCities()
    {
      return $this->cities;
    }

    public function getRandomCity()
    {
      return Arr::random($this->cities, 1);
    }

    public function getCity($name)
    {
      foreach ($this->cities as $city) {
        if($city->getName() === $city->getName()) {
          return $city;
        }
      }

      return false;
    }

    public function setCollection($collection)
    {
      $this->cities = $collection;
    }

    public function destroyCity(City $city)
    {
      foreach($this->cities as $key => $value) {
        if($value->getName() === $city->getName()) {
          unset($this->cities[$key]);
        }
      }

      return $this->cities;
    }
}
