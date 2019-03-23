<?php

namespace App;

use App\City;
use Illuminate\Support\Arr;

class CityCollection
{
    protected $cities = array();

    public function addCity(City $city)
    {
      Arr::add($this->cities, $city);
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
      $city = Arr::get($this->cities, $name);

      if($city) : return $city;

      return false;
    }

    public function destroyCity(City $city)
    {
      Arr::forget($this->cities, $city);
    }
}
