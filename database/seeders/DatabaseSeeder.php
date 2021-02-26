<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GamesTableSeeder::class);
		if(config('app.env') == 'testing') {
			$this->call(UsersTableSeeder::class);
		}
    }
}
