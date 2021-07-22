<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			'name' => 'Phinocio',
			'email' => 'contact@phinocio.com',
			'password' => \Hash::make('supersecret'),
			'is_admin' => true,
			'is_verified' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);

		\App\Models\User::factory(5)->create();
		
    }
}
