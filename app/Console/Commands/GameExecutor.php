<?php

namespace App\Console\Commands;

use App\Events\ReainigTimeChanged;
use App\Events\WinnerNumberGenerated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start excuting the game';

    private $time = 15;

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
     * @return int
     */
    public function handle()
    {
        Log::debug("holaaaa");
        while (true) {
            
            $test =  broadcast(new ReainigTimeChanged($this->time));
            
            $this->time--;
            sleep(1);

            if ($this->time === 0) {
                $this->time = 'Waiting to start';
                broadcast(new ReainigTimeChanged($this->time));

                broadcast(new WinnerNumberGenerated(mt_rand(1, 12)));
                sleep(5);
                $this->time = 15;
            }
        }
    }
}
