<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('games')->insert([
			'name' => "Skyrim",
		]);

		DB::table('games')->insert([
			'name' => "Skyrim Special Edition",
		]);
    }
}
