<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminControllerTest extends TestCase
{
    // Test valid login for admin
    public function test_admin_login()
    {
        // Setup: Create a user with the 'admin' role
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin_user',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Send login request
        $response = $this->post('/login', [
            'name' => 'admin_user',
            'password' => 'password123',
        ]);

        // Check if session data is set correctly
        $this->assertTrue(session()->has('user'));
        $this->assertEquals(session('user')['role'], 'admin');

        // Ensure it redirects to admin dashboard
        $response->assertRedirect(route('admin.dashboard'));
    }

    // Test invalid login for admin
    public function test_invalid_admin_login()
    {
        // Send login request with wrong credentials
        $response = $this->post('/login', [
            'name' => 'invalid_user',
            'password' => 'wrong_password',
        ]);

        // Check if error is shown
        $response->assertSessionHas('error', 'Invalid username or password');
        $response->assertRedirect();
    }
}
