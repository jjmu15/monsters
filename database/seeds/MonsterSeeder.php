<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Monster;

class MonsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $monster = new Monster();
      $monster->id = $faker->unique()->randomDigit;
      $monster->name = $faker->name;
      $monster->active = true;

      return $monster;
    }
}
