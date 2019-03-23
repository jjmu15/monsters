<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Monster;
use App\MonsterCollection;
use App\MonsterGenerator;


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

        $this->cityCollection = array();
        $this->monsterCollection = new MonsterCollection();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

      $monsterGenerator  = new MonsterGenerator();
      $monsterGenerator = $monsterGenerator->generateMonsters($this->monsterPopulation, $this->monsterCollection);
      $this->monsterCollection = $monsterGenerator;


    }
}
