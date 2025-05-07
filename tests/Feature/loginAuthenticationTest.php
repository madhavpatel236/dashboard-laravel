<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Requests\FormValidationRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

use function PHPUnit\Framework\isNan;

// enum Roles
// {
//     case admin;
//     case user;
// }


class loginAuthenticationTest extends TestCase
{
    use WithFaker;
    // use RefreshDatabase;


    public $mockRequests;
    public $mockFormValidationRequest;
    public $mockAuthController;
    public $mockFakers;
    public $mockUserModel;
    public function setUp(): void
    {

        parent::setUp();
        // $this->artisan('migrate');
        $this->mockRequests = Mockery::mock(Request::class);
        $this->mockFormValidationRequest = Mockery::mock(FormValidationRequest::class);
        $this->mockAuthController = Mockery::mock(AuthController::class);
        // $this->mockRegisterUserTest = Mockery::mock(RegisterUserTest::class);

        // $realFaker = \Faker\Factory::create();
        // $this->mockFakers = Mockery::mock('Faker');
    }

    public function loginAuth($email, $password, $role)
    {
        // $cases = Roles::cases();
        // $role = $cases[array_rand($cases)];


        // dump($this->assertDatabaseHas('auth', [
        //     'Email' => $email,
        //     // 'role' => $role,
        // ]));
        // exit;

        // dump($this->getConnection());
        // exit;

        $testData = [
            'email' => $email,
            'password' => $password,
            // 'role' => $role->name,
        ];


        $this->mockRequests->shouldReceive('isCurrentUserEmail')->with($email);
        $this->mockRequests->shouldReceive('isCurrentUserRole')->with($role);
        $this->mockRequests->shouldReceive('credential_error')->with(null);

        // $userModel = Mockery::mock(UserModel::class);
        // $where = $userModel->shouldReceive('where')->with(['Email' =>$email]);
        // dump($userModel->shouldReceive('get')->andReturn(true)); exit;


        // $this->mockRequests->shouldReceive('validate')->with($dummyData)->andReturn($dummyData);
        $this->mockRequests->shouldReceive('only')->with('email')->andReturn($email);
        $this->mockRequests->shouldReceive('input')->with('email')->andReturn($email);
        $this->mockRequests->shouldReceive('input')->with('password')->andReturn($password);
        $this->mockRequests->shouldReceive('userModelObj')->with()->andReturnSelf();
        // dump($testData);


        $res = $this->mockRequests->shouldReceive('authentication')->with($this->mockRequests)->andReturn(true);
        $response = $this->post('/login/check/', $testData);
        // dump($response);exit;
        // $response->assertStatus(200);
        // $response->assertFound();
        $response->assertRedirect('/admin');
    }

    // protected function tearDown(): void
    // {
    //     Mockery::close();

    //     parent::tearDown();
    // }
}
