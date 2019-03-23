<?php

namespace App;

use Illuminate\Support\Arr;

use App\Monster;
use App\City;

class MonsterCollection
{
    protected $monsters = array();

    public function addMonster(Monster $monster)
    {
      $this->monsters[] = $monster;
    }

    public function getMonsters()
    {
      return $this->monsters;
    }

    public function moveMonsters(CityCollection $cityCollection)
    {
       /** @var Monster $monster */
       foreach ($this->monsters as $monster) {
         if($monster->getLifespan() < 1) {
          $this->killMonster($monster);
        } else {
          $city = $monster->getCurrentCity();
          $cityName = $city->getName();
          $cityName = $city->getRandomNeighbour();
          $monster->setCurrentCity($cityCollection->getCity($cityName[0]));
        }
       }

       return $this->monsters;
     }

     public function getCityMonsters(City $city)
     {
       $monsterResidents = array();

       foreach ($this->monsters as $monster) {
         if($monster->getCurrentCity()->getName() === $city->getName()) {
           $monsterResidents[] = $monster;
         }
       }

       return $monsterResidents;
     }

     public function killMonster(Monster $monster)
     {
       foreach($this->monsters as $key => $value) {
         if($value->getName() === $monster->getName()) {
           unset($this->monsters[$key]);
         }
       }

       return $this->monsters;
     }

}
