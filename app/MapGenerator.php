<?php

namespace App;

use Illuminate\Support\Arr;
use App\Monster;
use App\City;

class mapGenerator
{
    protected $mapSource;

    public function __construct($mapSource)
    {
      $this->mapSource = $mapSource;
    }

    public function generate($cityCollection)
    {
      //foreach line in text file
      foreach (explode("\n", $this->mapSource) as $key=>$line){
        // split values
        $cityData = explode(' ', $line);

        for ($i = 1; $i < count($cityData); $i++) {
            $neighborData = explode('=', $cityData[$i]);
            $neighbors[$neighborData[0]] = $neighborData[1];
        }

        $city = new City();
        $city->setName($cityData[0]);
        $city->setDestroyed(false);
        $city->setNeighbours($neighbors);

        $cityCollection->addCity($city);
      }

      return $cityCollection;
    }

}
