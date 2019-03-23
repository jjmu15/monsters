<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Monsters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monsters
                            {count: The number of monsters in the world}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a doomed world full of monsters, death and destruction.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
