<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Requests\FormValidationRequest;
use Carbon\Factory;
use Illuminate\Container\Attributes\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;


enum Roles
{
    case admin;
    case user;
}


class loginAuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $mockRequests;
    public $mockFormValidationRequest;
    public $mockAuthController;
    public $mockFakers;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockRequests = Mockery::mock(Request::class);
        $this->mockFormValidationRequest = Mockery::mock(FormValidationRequest::class);
        $this->mockAuthController = Mockery::mock(AuthController::class);
        // $this->mockRegisterUserTest = Mockery::mock(RegisterUserTest::class);

        $realFaker = \Faker\Factory::create();
        $this->mockFakers = Mockery::mock('Faker');
        $this->mockFakers->shouldReceive('email')->andReturn($realFaker->email());
        $this->mockFakers->shouldReceive('password')->andReturn($realFaker->password());
    }

    public function test_example()
    {
        $cases = Roles::cases();
        $role = $cases[array_rand($cases)];

        $dummyData = [
            'email' => $this->mockFakers->email(),
            'password' => $this->mockFakers->password(),
            // 'role' => $role->name,
            'role' => 'admin',
        ];


        $this->mockRequests->shouldReceive('isCurrentUserEmail')->with($dummyData['email']);
        $this->mockRequests->shouldReceive('isCurrentUserRole')->with($dummyData['password']);
        $this->mockRequests->shouldReceive('credential_error')->with(null);


        $this->mockRequests->shouldReceive('validate')->with($dummyData)->andReturn($dummyData);
        $this->mockRequests->shouldReceive('only')->with('email')->andReturn($dummyData['email']);
        $this->mockRequests->shouldReceive('input')->with('email')->andReturn($dummyData['email']);
        $this->mockRequests->shouldReceive('input')->with('password')->andReturn($dummyData['password']);

        $res = $this->mockRequests->shouldReceive('authentication')->with($this->mockRequests, $this->mockFormValidationRequest)->andReturn(true);
        $response = $this->post('login/check', $dummyData);
        dump($response);
        $response->assertStatus(200);
        // $response->assertRedirect('admin/');

        // $this->assertEmpty($response);

        // $response->assertStatus(200);


        // $this->mockRegisterUserTest->setUp();
        // $this->mockRegisterUserTest->registerUser();

    }
}
