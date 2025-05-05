<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{

    use WithFaker;

    public $userModel;
    public $router;
    public $adminController;
    public $request;
    public $facker;

    public function setUp(): void
    {
        parent::setUp();
        // $this->request = Mockery::mock('Request');
        // $this->userModel = Mockery::mock('UserModel');
        $this->router = Mockery::mock('web');
        $this->adminController = Mockery::mock(AdminController::class);
        // $this->faker = Mockery::mock(faker);

    }

    public function test_example()
    {
        $dummyData = [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'role' => 'user',
        ];

        $res = $this->adminController->shouldReceive('store')->with($dummyData)->andReturn($dummyData);
        // $this->assertNotEmpty($res);

        // $response = $this->router->shouldReceive('/login');
        $response = $this->get('/admin');
        $response->assertStatus(302);

        // $this->assertIsReadable($response);
    }

    // public function StoreUserTest()
    // {
    // $dummyData = [
    //     'firstname' => $this->faker->firstName(),
    //     'lastname' => $this->faker->lastName(),
    //     'email' => $this->faker->email(),
    //     'password' => $this->faker->password(),
    //     'role' => 'user',
    // ];

    // return $dummyData;

    // }
}


// $request = new Request();
        // $request->merge(['firstname' => 'test']);
        // $request->merge(['lastname' => 'new']);
        // $request->merge(['email' => 'test@gmail.com']);
        // $request->merge(['password' => 'Test@123']);
        // $request->merge(['role' => 'user']);

        // $requestData = $request->all();
        // $requestData['firstname'] = 'test';
        // $requestData['lastname'] = 'new';
        // $requestData['email'] = 'test@gmail.com';
        // $requestData['passoword'] = 'tet@123';
        // $requestData['role'] = 'user';


        // $registerMock = Mockery::mock(AdminController::class);
        // $registerMock->shouldReceive('store')->with($request)->once()->andReturn(true);

        // $controller = new AdminController($request, $registerMock);
        // $res = $controller->store($request);

        // $this->assertTrue($res);

        // $res = $controller->store(['firstname' => 'test', 'lastname' => 'new']);
        // $response = $this->get('/login');
        // $response->assertStatus(200);
