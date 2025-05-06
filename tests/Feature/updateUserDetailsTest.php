<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class updateUserDetailsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $adminController;
    public $mockRequest;
    public $mokeFacker;

    public function setUp(): void
    {
        parent::setUp();
        $this->adminController = Mockery::mock(AdminController::class);
        $this->mockRequest = Mockery::mock(Request::class);

        // $realFaker = \Faker\Factory::create();
        $realFaker = \Faker\Factory::create();
        $this->mokeFacker = Mockery::mock('faker');
        $this->mokeFacker->shouldReceive('firstName')->andReturn($realFaker->firstName());
        $this->mokeFacker->shouldReceive('lastName')->andReturn($realFaker->lastName());
        $this->mokeFacker->shouldReceive('email')->andReturn($realFaker->email());
        $this->mokeFacker->shouldReceive('id')->andReturn($realFaker->numberBetween(20, 50));
    }


    public function test_example(): void
    {
        $dummySessionData = [
            'isCurrentUserEmail' => 'madhav@elsner.com',
            'isCurrentUserRole' => 'admin'
        ];

        $dummyData = [
            'firstname' => $this->mokeFacker->firstName(),
            'lastname' => $this->mokeFacker->lastName(),
            'email' => $this->mokeFacker->email(),
            'id' => $this->mokeFacker->id(),
            'role' => 'user',
        ];
        $this->mockRequest->shouldReceive('isCurrentUserEmail')->with($dummySessionData['isCurrentUserEmail']);
        $this->mockRequest->shouldReceive('isCurrentUserRole')->with($dummySessionData['isCurrentUserRole']);

        $this->adminController->shouldReceive('validate')->with($dummyData)->andReturn(true);
        $mockModel = $this->adminController->shouldReceive(UserModel::class);
        $mockModel->shouldReceive('findOrFail')->once()->with($dummyData['id'])->andReturn(true);
        $response = $this->put('admin/' . $dummyData['id'], $dummyData);
        $this->adminController->shouldReceive('update')->with($this->mockRequest, $dummyData['id']);
        dump($response);
        // $this->assertIsReadable($response);
        // $response->assertStatus(200);
        // $response->assertRedirect('admin/');
    }

    // protected function tearDown(): void
    // {
    //     Mockery::close();
    //     parent::tearDown();
    // }
}
