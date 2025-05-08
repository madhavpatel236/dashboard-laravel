<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class FeatureTest extends TestCase
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
        // $this->admin_home();
        // $this->user_home();
        // $this->create_new_user_get_page();
        // $this->create_new_user();
        // $this->edit_user_data_get_page();
        $this->user_delete();
        // $this->edit_user_data_update();

    }

    public function login_user_role_is_user_test()
    {
        $data = [
            'email' => 'madhav@gmail.com',
            'password' => 'Test@123'
        ];
        // $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com' , 'currentUserRole' => 'admin' ])->post('/login/check');

        $response = $this->post('/login/check', $data);
        // $response->dumpSession();
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

    public function admin_home()
    {
        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->get('admin');
        dump($response);
        $response->assertStatus(200);
        // $response->assertRedirect('admin');
    }

    public function user_home()
    {
        $response = $this->withSession(['currentUserEmail' => 'madhav@gmail.com', 'currentUserRole' => 'user'])->get('userHome/5');
        dump($response);
        $response->assertStatus(200);
    }

    public function create_new_user_get_page()
    {
        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->get('admin/create');
        dump($response);
        $response->assertStatus(200);
        // $response->assertViewHas('pages.Register');
    }

    public function create_new_user()
    {
        $data = [
            'firstname' => 'Testnew',
            'lastname' => 'Testnew',
            'email' => 'Testnew@gmail.com',
            'password' => 'Test@123',
            'role' => 'user'

        ];
        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->post('admin', $data);
        dump($response);
        // $response->assertStatus(200);
        $response->assertRedirect('/admin');
    }

    public function edit_user_data_get_page()
    {
        // admin/5/edit
        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->get('admin/5/edit');
        // dump($response);
        $response->assertStatus(200);
    }

    public function edit_user_data_update()
    {
        $data = [
            'firstname' => 'Testnew1',
            'lastname' => 'Testnew',
            'email' => 'Testnew@gmail.com',
            'password' => 'Test@123',
            'role' => 'user'

        ];

        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->put('admin' , $data);
        dump($response);
        $response->assertStatus(200);
    }

    public function user_delete()
    {
        $data = [
            'firstname' => 'Testnew1',
            'lastname' => 'Testnew',
            'email' => 'Testnew@gmail.com',
            'password' => 'Test@123',
            'role' => 'user'

        ];

        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->delete('admin/11', $data );
        dump($response);
        $response->assertStatus(200);
    }
}
