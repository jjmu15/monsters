<?php

namespace App;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

use App\Monster;

class MonsterGenerator
{
  public function generateMonsters($monsterCount, $monsterCollection, $cityCollection)
  {
    $faker = Faker::create();

    $x = 0;
    while ($x <= $monsterCount) {
      $randomCity = Arr::random($cityCollection->getCities());

      $monster = new Monster();
      $monster->setId(now());
      $monster->setName($faker->name);
      $monster->setLifespan(10000);
      $monster->setActive();
      $monster->setCurrentCity($randomCity);
      $monsterCollection->addMonster($monster);
      $x++;
    }

    return $monsterCollection;
  }
}
