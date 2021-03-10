<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	/** @test */
	public function a_user_can_see_the_login_page_when_logged_out()
	{
		$this->assertGuest();
		$response = $this->get('/login');
		$response->assertStatus(200);
		$response->assertViewIs('auth.login');
	}

	/** @test */
	public function a_user_can_not_see_the_login_page_when_logged_in()
	{
		$user = User::factory()->make();

		$response = $this->actingAs($user)->get('/login');

		$response->assertStatus(302);
		$response->assertRedirect('/');
	}

	/** @test */
	public function a_user_can_log_in()
	{
		$user = User::factory()->create();

		$response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);

		$response->assertStatus(302);
		$response->assertRedirect('/');
		$this->assertAuthenticatedAs($user);
	}

	/** @test */
	public function a_user_can_see_the_register_page_when_logged_out()
	{
		$this->assertGuest();

		$response = $this->get('/register');

		$response->assertStatus(200);
		$response->assertViewIs('auth.register');
	}

	/** @test */
	public function a_user_can_not_see_the_register_page_when_logged_in()
	{
		$user = User::factory()->make();

		$response = $this->actingAs($user)->get('/register');

		$response->assertStatus(302);
		$response->assertRedirect('/');
	}

	/** @test */
	public function a_user_can_register()
	{
		$attributes = [
			'name' => $this->faker->name,
			'email' => $this->faker->email,
			'password' => 'password',
			'password_confirmation' => 'password'
		];

		$response = $this->post('/register', $attributes);

		$response->assertRedirect('/');

		$this->assertDatabaseCount('users', 1);
	}
}
