<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;




class RegisterUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public $userModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->userModel = $this->mock('app\Model\UserModel');
    }

    public function test_example(): void
    {

        $request = new Request();
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


        $registerMock = Mockery::mock(AdminController::class);
        $registerMock->shouldReceive('store')->with($request)->once()->andReturn(true);

        $controller = new AdminController($request, $registerMock);
        $res = $controller->store($request);

        $this->assertTrue($res);

        // $res = $controller->store(['firstname' => 'test', 'lastname' => 'new']);
        // $response = $this->get('/login');
        // $response->assertStatus(200);
    }


    // public function test()
    // {

    // $this->instance(
    //     AdminController::class,
    //     Mockery::mock(AdminController::class, function (MockInterface $moke) {
    //         $moke->shouldReceive('store')->once();
    //     })
    // );
    // }
}
