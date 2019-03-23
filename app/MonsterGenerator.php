<?php

namespace App;

use Faker\Factory as Faker;
use App\Monster;

class MonsterGenerator
{
  public function generateMonsters($monsterCount, $monsterCollection)
  {
    $faker = Faker::create();

    $x = 0;
    while ($x <= $monsterCount) {
      $monster = new Monster();
      $monster->setId(now());
      $monster->setName($faker->name);
      $monster->setLifespan(10000);
      $monster->setActive();
      $monsterCollection->addMonster($monster);
      $x++;
    }

    return $monsterCollection;
  }
}
