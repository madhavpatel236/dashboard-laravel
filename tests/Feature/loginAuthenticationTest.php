<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Requests\FormValidationRequest;
use App\Models\UserModel;
use Carbon\Factory;
use Illuminate\Container\Attributes\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        // $realFaker = \Faker\Factory::create();
        // $this->mockFakers = Mockery::mock('Faker');
    }

    public function loginAuth($email, $password, $role)
    {


        $cases = Roles::cases();
        $role = $cases[array_rand($cases)];

        $testData = [
            'email' => $email,
            'password' => $password,
            // 'role' => $role->name,
            // 'role' => 'admin',
        ];
        // dump($this->mockRequests); exit;


        $this->mockRequests->shouldReceive('isCurrentUserEmail')->with($email);
        $this->mockRequests->shouldReceive('isCurrentUserRole')->with($role);
        $this->mockRequests->shouldReceive('credential_error')->with(null);


        // $this->mockRequests->shouldReceive('validate')->with($dummyData)->andReturn($dummyData);
        $this->mockRequests->shouldReceive('only')->with('email')->andReturn($email);
        $this->mockRequests->shouldReceive('input')->with('email')->andReturn($email);
        $this->mockRequests->shouldReceive('input')->with('password')->andReturn($password);
        // dump($testData);

        // $user = UserModel::where('Email', $email)->get();
        // dump($user);
        // dump($testData);

        // dump(Hash::check($password, $user[0]['Password']));
        // exit;

        $res = $this->mockRequests->shouldReceive('authentication')->with($this->mockRequests)->andReturn(true);

        dump($this);
        $response = $this->post('/login/check/', $testData);
        // dump($response);

        // $response->assertStatus(200);
        // $response->assertRedirect('admin/');
        // $this->assertEmpty($response);
        // $response->assertStatus(200);


        // $this->mockRegisterUserTest->setUp();
        // $this->mockRegisterUserTest->registerUser();
        // $this->assertEquals(200, $response->getStatusCode());
    }

    // protected function tearDown(): void
    // {
    //     Mockery::close();

    //     parent::tearDown();
    // }
}
