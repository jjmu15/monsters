<?php

namespace App;

use Illuminate\Support\Arr;
use App\Monster;

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

    public function moveMonster(CityCollection $cityCollection)
    {
       /** @var Monster $monster */
       foreach ($this->monsters as $monster) {
           $city = $monster->getCurrentCity();
           $cityName = $city->getName();
           $cityName = $city->getRandomNeighborCity();
           if (!is_null($cityName)) {
               $monster->setCurrentCity($cityCollection->getCityByName($cityName));
           }
       }
     }

     public function getcityMonsters(City $city)
     {
       $monsterResidents = array();

       foreach ($this->monsters as $monster) {
         if($monster->getCurrentCity() === $city) {
           $monsterResidents = $monster;
         }
       }

       return $monsterResidents;
     }

     public function monsterBattle()
     {

     }

     public function monsterDeath(Monster $monster)
     {
       Arr::forget($this->monsters, $monster);
     }

}
