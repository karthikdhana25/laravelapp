<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

use App\User;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Name Change Successfully!';

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
        // \DB::table('users')
        //     ->where('id', 1)
        //     ->update(['name' => 'crontest1']);
       
        \DB::table('products')->insert(array (
				'name' => 'sdf',
            'category' => 'dsdsfsdf',
            'description' => bcrypt(str_random(10)),  
				"created_at" => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now(),
				
		 ));

    	$this->info('User Name Change Successfully!');
    }
}
