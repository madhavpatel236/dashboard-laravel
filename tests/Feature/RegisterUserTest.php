<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Testing\Concerns\TestDatabases;
use Illuminate\Validation\Rules\DatabaseRule;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Feature\loginAuthenticationTest;

// enum Roles
// {
//     case admin;
//     case user;
// }


class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $userModel;
    public $route;
    public $adminController;
    public $mockRequest;
    public $fakerMock;
    public $loginTestMock;


    public function setUp(): void
    {
        parent::setUp();
        $this->mockRequest = Mockery::mock(Request::class);
        $this->adminController = Mockery::mock(AdminController::class);
        $this->loginTestMock = Mockery::mock(loginAuthenticationTest::class)->makePartial();

        $realFaker = \Faker\Factory::create();
        $this->fakerMock = Mockery::mock('faker');
        $this->fakerMock->shouldReceive('firstName')->andReturn($realFaker->firstName());
        $this->fakerMock->shouldReceive('lastName')->andReturn($realFaker->lastName());
        $this->fakerMock->shouldReceive('email')->andReturn($realFaker->email());
        $this->fakerMock->shouldReceive('password')->andReturn($realFaker->password());
    }

    public function test_example()
    {

        $dummySessionData = [
            'isCurrentUserEmail' => 'madhav@elsner.com',
            'isCurrentUserRole' => 'admin'
        ];

        // $cases = Roles::cases();
        // $role = $cases[array_rand($cases)];

        $dummyData = [
            'firstname' => $this->fakerMock->firstName(),
            'lastname' => $this->fakerMock->lastName(),
            'email' => $this->fakerMock->email(),
            'password' => $this->fakerMock->password(),
            // 'role' => $role->name,
            'role' => 'user',
        ];
        // dump($dummyData);


        $this->mockRequest->shouldReceive('isCurrentUserEmail')->with($dummySessionData['isCurrentUserEmail']);
        $this->mockRequest->shouldReceive('isCurrentUserRole')->with($dummySessionData['isCurrentUserRole']);
        // new $this->adminController($this->mockRequest);

        // $this->assertNotEmpty($this->mockRequest->shouldReceive('fill')->with($dummyData)->andReturn($dummyData));
        $this->mockRequest->shouldReceive('input')->with('password')->andReturn($dummyData['password']);
        $this->mockRequest->shouldReceive('validate')->with($dummyData)->andReturn($dummyData);
        // $this->mockRequest->shouldReceive('fill')->with($dummyData)->andReturn($dummyData);
        $storeRes = $this->adminController->shouldReceive('store')->with($this->mockRequest)->andReturn(true);

        // dump($dummyData);
        $response = $this->post('admin/', $dummyData);
        dump($response);
        $response->assertRedirect('admin/');
        // dump($this->assertDatabaseHas('auth', [
        //     'Email' => $dummyData['email'],
        //     // 'password' => $dummyData['password'],
        // ])); exit;
        // dump($dummyData['email']);
        $setup = $this->loginTestMock->setUp();
        $this->loginTestMock->loginAuth($dummyData['email'], $dummyData['password'], $dummyData['role']);
    }
}
