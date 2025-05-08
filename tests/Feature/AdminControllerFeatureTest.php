<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AdminControllerFeatureTest extends TestCase
{

    public $adminControllerObj;
    public $requestObj;
    public $authControllerObj;

    public function setUp(): void
    {
        parent::setUp();

        $this->requestObj = new Request();
        // $this->requestObj->session()->put('currentUserEmail',  'madhav@elsner.com');
        // $this->requestObj->session()->put('currentUserRole',  'admin');
        // $this->requestObj->merge(['currentUserEmail' => 'madhav@elsner.com']);
        // $this->authControllerObj = new AuthController($this->requestObj);
        // $this->adminControllerObj = new AdminController($this->requestObj);
    }

    public function test_example(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        // $this->login_user_role_is_user_test();
        // $this->login_user_role_is_admin_test();
    }

    public function login_user_role_is_user_test()
    {
        $data = [
            'email' => 'madhav@gmail.com',
            'password' => 'Test@123'
        ];
        // $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com' , 'currentUserRole' => 'admin' ])->post('/login/check');

        $response = $this->post('/login/check', $data);
        dump($response);
        $response->assertRedirect('userHome/5');
    }

    public function login_user_role_is_admin_test()
    {
        $data = [
            'email' => 'madhav@elsner.com',
            'password' => 'Test@123'
        ];
        // $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com' , 'currentUserRole' => 'admin' ])->post('/login/check');

        $response = $this->post('/login/check', $data);
        dump($response);
        $response->assertRedirect('admin');
    }
}
