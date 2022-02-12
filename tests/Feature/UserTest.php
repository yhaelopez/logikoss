<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware, WithFaker;

    public function test_can_fetch_all_users()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('users.index'));

        $response->assertViewHas('users');
    }


    public function test_can_delete_user()
    {
        $this->withoutExceptionHandling();

        $user = User::create([
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post(route('users.destroy', ['user' => $user]), [
            '_method' => 'DELETE',
        ]);

        $response->assertRedirect(route('users.index'));
    }
}
