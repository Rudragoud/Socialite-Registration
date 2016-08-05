<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\User;

class LovelyWrite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lovely:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write description';

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
       $headers = ['Name', 'Email'];

       $users = App\User::all(['name', 'email'])->toArray();

       $this->table($headers, $users);
    
    }
}
