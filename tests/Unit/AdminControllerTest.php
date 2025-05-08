<?php

namespace Tests\Unit;

use App\Http\Controllers\AdminController;
use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminController;


    public function setUp(): void
    {
        parent::setUp();

        $this->session(['currentUserEmail' => 'madhav@elsner.com']);

        $newUserData = [
            'firstname' => 'unitTest',
            'lastname' => 'unitTest',
            'email' => 'unitTest@gmail.com',
            'password' => 'Test@123',
            'role' => 'user',
        ];

        $this->adminController = new AdminController(request());
    }

    public function test_example(): void
    {
        $this->loginStatusCheckTest();
    }

    public function loginStatusCheckTest()
    {
        // Add your actual test assertions here
        $this->assertTrue(true);
    }

    public function createUserTest()
    {
        // Add your test implementation here
    }
}
