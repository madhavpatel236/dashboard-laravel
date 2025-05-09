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
    }

    public function test_example(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        // $this->login_user_is_user();
        // $this->login_user_is_admin();
        // $this->admin_home();
        // $this->user_home();
        // $this->create_new_user_get_page();
        // $this->create_new_user();
        // $this->edit_user_data_get_page();
        // $this->user_delete();
        // $this->edit_user_data_update();
        // $this->logout_user();
    }

    public function login_user_is_user()
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'Test@123'
        ];
        // $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com' , 'currentUserRole' => 'admin' ])->post('/login/check');

        $response = $this->post('/login/check', $data);
        // $response->dumpSession();
        dump($response);
        $response->assertRedirect('userHome/3');
    }

    public function login_user_is_admin()
    {
        $data = [
            'email' => 'admin@elsner.com',
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
            'firstname' => 'new',
            'lastname' => 'new',
            'email' => 'new@gmail.com',
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
            'email' => 'ewf@sfv.fv',
            // 'password' => 'Test@123',
            'role' => 'user'

        ];

        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->put('admin/6/', $data);
        dump($response);
        $response->assertStatus(200);
        // $response->assertRedirect('admin');

    }

    public function user_delete()
    {
        $response = $this->withSession(['currentUserEmail' => 'madhav@elsner.com', 'currentUserRole' => 'admin'])->delete('admin/13');
        dump($response);
        $response->assertRedirect('admin');
    }

    public function logout_user(){
        $response = $this->get('/');
        // $response->assertRedirect('/login');
        dump($response);
        $this->assertEmpty(session('currentUserEmail'));
    }
}
