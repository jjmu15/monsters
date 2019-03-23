<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use App\Monster;
use App\MonsterCollection;
use App\MonsterGenerator;
use App\City;
use App\CityCollection;
use App\mapGenerator;


class Monsters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monsters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a doomed world full of monsters, death and destruction.';

    protected $monsterPopulation;
    protected $cityCollection;
    protected $monsterCollection;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->cityCollection = new CityCollection();

        $mapGenerator = new mapGenerator(File::get(storage_path('world_map_medium.txt')));
        $this->cityCollection = $mapGenerator->generate($this->cityCollection);

        $this->monsterCollection = new MonsterCollection();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      // set out put styles
      $style = new OutputFormatterStyle('white', 'blue');
      $this->output->getFormatter()->setStyle('blue', $style);

      $style = new OutputFormatterStyle('white', 'red', ['bold']);
      $this->output->getFormatter()->setStyle('destruction', $style);

      $style = new OutputFormatterStyle('black', 'white', ['bold']);
      $this->output->getFormatter()->setStyle('end', $style);

      // begin world
      $this->setPopulation();
      $this->setupMonsters();
      $this->runWorld();
    }

    /*
     * Set the population size of the world
     */
    public function setPopulation()
    {
      $monsterPopulation = $this->ask('How many monsters are in this tormented world?');

      try {
          if($monsterPopulation < 2) {
            throw new Exception('At least two monsters must exist in this world. Lonely monsters cause no destruction');
        }
      }
      catch (Exception $e) {
        exit($e->getMessage());
      }

      $this->monsterPopulation = $monsterPopulation;
    }

    // create population consisting of monsters
    public function setupMonsters()
    {
      $monsterGenerator  = new MonsterGenerator();
      $monsterGenerator = $monsterGenerator->generateMonsters(
        $this->monsterPopulation,
        $this->monsterCollection,
        $this->cityCollection);
      $this->monsterCollection = $monsterGenerator;
    }

    // now that world is setup, run until total death or destruction
    public function runWorld()
    {
      while (count($this->cityCollection->getCities()) > 0 && intval(count($this->monsterCollection->getMonsters())) > 0) {
        $this->progressTime();
      }

      $citiesRemaining = count($this->cityCollection->getCities());
      $monstersRemaining = count($this->monsterCollection->getMonsters());

      if($citiesRemaining > 0) {
        $this->line("<end>Thankfully the monsters destroyed themselves before the whole world was destroyed. A lucky " . $citiesRemaining . " cities survived the onslaught.</end>", "\n");
      } else {
        $this->line("<end>The monsters destroyed the whole world in their ramapage. " . $monstersRemaining . " remain, isolted in their conquered cities.</end>", "\n");
      }

      exit();
    }

    // each turn in the game
    public function progressTime()
    {
      foreach($this->cityCollection->getCities() as $city) {
        $residents = $this->monsterCollection->getCityMonsters($city);
        if(count($residents) > 1) {
          $this->line("<blue>" . $city->getName() . " is in panic. A monster battle commences.</blue>", "\n");
          foreach($residents as $monster) {
            $this->monsterCollection->killMonster($monster);
            $this->line("<destruction>" . $monster->getName() . " was killed in battle trying to conquer " . $city->getName() . "</destruction>");
          }

          $this->cityCollection->destroyCity($city);
          $this->line("<destruction>" . $city->getName() . " lies in ruins after an epic battle!</destruction>", "\n");
        }
      }

      // age monsters
      foreach($this->monsterCollection->getMonsters() as $monster) {
        $monster->setLifespan($monster->getLifespan() - 1);
      }

      $this->monsterCollection->moveMonsters($this->cityCollection);

      return;
    }
}
