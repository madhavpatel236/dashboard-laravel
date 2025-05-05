<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

use function PHPUnit\Framework\assertIsCallable;
use function PHPUnit\Framework\assertIsReadable;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertTrue;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $userModel;
    public $route;
    public $adminController;
    public $mockRequest;
    public $fakerMock;


    public function setUp(): void
    {
        parent::setUp();
        $this->mockRequest = Mockery::mock(Request::class);
        // $this->route = Mockery::mock(Route::class);
        $this->adminController = Mockery::mock(AdminController::class);

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

        $dummyData = [
            'firstname' => $this->fakerMock->firstName(),
            'lastname' => $this->fakerMock->lastName(),
            'email' => $this->fakerMock->email(),
            'password' => $this->fakerMock->password(),
            'role' => 'user',
        ];
        $this->mockRequest->shouldReceive('isCurrentUserEmail')->with($dummySessionData['isCurrentUserEmail']);
        $this->mockRequest->shouldReceive('isCurrentUserRole')->with($dummySessionData['isCurrentUserRole']);
        // new $this->adminController($this->mockRequest);

        $this->assertNotEmpty($this->mockRequest->shouldReceive('fill')->with($dummyData)->andReturn($dummyData));
        $this->mockRequest->shouldReceive('input')->with('password')->andReturn($dummyData['password']);
        $this->mockRequest->shouldReceive('validate')->with($dummyData)->andReturn($dummyData);
        $this->mockRequest->shouldReceive('fill')->with($dummyData)->andReturn($dummyData);

        dump($dummyData);
        $storeRes = $this->adminController->shouldReceive('store')->with($this->mockRequest)->andReturn(true);
        $response = $this->post('/admin', $dummyData);
        // $response->assertStatus(200);
        // $response->assertRedirect('/admin');
    }
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}








// public function test_store_user_creates_user_in_db()
// {
//     $data = [
//         'firstname' => 'Test',
//         'lastname' => 'User',
//         'email' => 'testuser@example.com',
//         'password' => 'Test@123', // Valid password with all required chars
//         'role' => 'user',
//     ];

//     $response = $this->post('/admin/store', $data); // assumes your route is POST /admin/store

//     $response->assertRedirect('/admin'); // check redirection
//     $this->assertDatabaseHas('auth', [  // change `auth` if table name is different
//         'email' => 'testuser@example.com',
//         'role' => 'user',
//     ]);
// }











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
