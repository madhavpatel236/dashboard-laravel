<?php

namespace Tests\Unit;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\UserModel;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{

    protected $adminController;

    public $requestObj;


    public function setUp(): void
    {
        parent::setUp();
        $this->requestObj = new Request();
    }


    public function test_example(): void
    {
        // $this->loginStatusCheckTest();
        // $this->createUserTest();
        // $this->AdminIndexTest();
        // $this->editUserTest();
        // $this->updateUserTest();
        // $this->deleteUserTest();
        $this->userHomeTest();
    }

    public function loginStatusCheckTest()
    {
        $data = [
            'email' => 'admin@elsner.com',
            'password' => 'Test@123',
        ];

        $this->requestObj->merge($data);
        $authControllerObj = new AuthController($this->requestObj);
        $request = $authControllerObj->authentication($this->requestObj);
        // dump($request);
        // exit;

        // $request->assertOk();
        // $this->assertEquals( 'sdc' ,$request );

        // $this->assertNotEmpty($request);
        // $request->assertStatus(200);

    }


    public function loginUserStatusCheckTest()
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'Test@123',
        ];

        $this->requestObj->merge($data);
        $authControllerObj = new AuthController($this->requestObj);
        $request = $authControllerObj->authentication($this->requestObj);
        // dump($request);
        // exit;

        // $request->assertOk();
        // $this->assertEquals( 'sdc' ,$request );

        // $this->assertNotEmpty($request);
        // $request->assertStatus(200);

    }



    public function createUserTest()
    {
        $this->loginStatusCheckTest();

        $data = [
            'firstname' => 'Testnew',
            'lastname' => 'Testnew',
            'email' => 'Test2222@gmail.com',
            'password' => 'Test@123',
            'role' => 'user'
        ];
        $this->requestObj->merge($data);
        $adminControllerObj = new AdminController($this->requestObj);
        $request = $adminControllerObj->store($this->requestObj);

        // $this->assertTrue($request);
    }


    public function AdminIndexTest()
    {
        $this->loginStatusCheckTest();

        $adminControllerObj = new AdminController($this->requestObj);
        $request = $adminControllerObj->index();
        dump($request);
    }


    public function editUserTest()
    {
        $this->loginStatusCheckTest();
        $adminControllerObj = new AdminController($this->requestObj);
        $request = $adminControllerObj->edit(3);
        // $this->assertNotEmpty($request);
        // $this->assertEquals(60, $request);
        dump($request);
    }

    public function updateUserTest()
    {
        $this->loginStatusCheckTest();

        $data = [
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@elsner.com',
            'role' => 'admin'
        ];
        $this->requestObj->merge($data);
        $adminControllerObj = new AdminController($this->requestObj);
        $request = $adminControllerObj->update($this->requestObj, 2);
        // $this->assertNotEmpty($request);
        // $this->assertEquals(60, $request);
        dump($request);
    }

    public function deleteUserTest()
    {
        $this->loginStatusCheckTest();

        $adminControllerObj = new AdminController($this->requestObj);
        $request = $adminControllerObj->destroy(12);
        // $this->assertNotEmpty($request);
        // $this->assertEquals(60, $request);
        dump($request);
    }

    public function userHomeTest()
    {
        $this->loginUserStatusCheckTest();
        $userControllerObj = new UserController($this->requestObj);
        $request = $userControllerObj->show(3);
        // $this->assertNotEmpty($request);
        // $this->assertEquals(60, $request);
        dump($request);
    }
}
