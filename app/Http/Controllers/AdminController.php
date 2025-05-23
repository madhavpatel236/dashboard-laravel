<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel as UserModel;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Hash;
use Mockery;
use PhpParser\Node\Expr\Isset_;

class AdminController extends Controller
{
    public $isCurrentUserEmail;
    public $isCurrentUserRole;

    public function __construct(Request $request)
    {
        // dump($request->session()->get('currentUserEmail'));
        // if (isset($request)) {
        $this->isCurrentUserEmail = session('currentUserEmail');
        $this->isCurrentUserRole = session('currentUserRole');
        // $this->isCurrentUserEmail = $request->session()->get('currentUserEmail');
        // $this->isCurrentUserRole = $request->session()->get('currentUserRole');
        // }
    }

    public function index()
    {
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            return redirect('/login');
        }

        $allUsers = UserModel::all();
        // echo "<pre>";var_dump($users[0]['Role']); exit;
        $users = [];
        foreach ($allUsers as $user) {
            if ($user['Role'] != 'admin') {
                $users[] = $user;
            }
        }
        return view('pages.AdminHome', compact('users'));
    }

    public function create()
    {
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            return redirect('/login');
        }
        return view('pages.Register');
    }


    // register new user by the admin
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->session());
        // exit;
        // $password = $request->all()['password'];
        $password = $request->input('password');
        $hashed = Hash::make($password, [
            'rounds' => 12,
        ]);

        try {
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|unique:auth',
                'password' => [
                    'required',
                    'string',
                    // 'min:6',
                    // 'max:10',
                    // 'regex:/[a-z]/',
                    // 'regex:/[A-Z]/',
                    // 'regex:/[0-9]/',
                    // 'regex:/[@$!%*#?&]/'
                ],
                'role' => 'required',
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e)->withInput();
        }

        $userModel = new UserModel();
        $userModel->fill([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email'  => $request->email,
            'password'  => $hashed,
            'role'  => $request->role,
        ]);
        $userModel->save();
        return redirect('/admin');
    }


    /**
     * Display the specified resource.
     */
    public function check(UserModel $user_model, Request $request)
    {
        $email = $request->input('email');
        var_dump('dfvb');
        exit;
        // $users = $users->intersect(User::whereIn('id', [1, 2, 3])->get());
        // $data = UserModel::findOrFail($email);
        // $res = UserModel::findOrFail($email);
    }


    public function edit(string $id)
    {
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            return redirect('/login');
        }

        $user = UserModel::findOrFail($id);
        return view('pages.UserEdit', compact('user'));
        // echo "<pre>";var_dump($user['Email']); exit;
    }


    public function update(Request $request, string $id)
    {

        // dump($request); exit;
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $data = UserModel::findOrFail($id);
        $data->update($request->only(['firstname', 'lastname', 'email', 'role']));
        // echo "<pre>";
        // var_dump($data->update());
        // exit;
        return redirect('/admin');
    }


    public function destroy(string $id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect('/admin');
    }
}
