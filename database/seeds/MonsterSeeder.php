<?php

use Illuminate\Database\Seeder;

use App\Monster;
use Faker\Generator as Faker;

class MonsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $monster = new Monster();
      $faker = new Faker();

      $monster->id = now();
      $momster->name = $faker->name;
      $monster->active = true;
      $monster->lifespan = 10000;

      return $monster;
    }
}
