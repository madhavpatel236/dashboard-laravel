<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormValidationRequest;
use App\Models\UserModel as UserModel;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $isCurrentUserEmail;
    protected $isCurrentUserRole;

    public function __construct(Request $request)
    {
        $this->isCurrentUserEmail = $request->session()->get('currentUserEmail');
        $this->isCurrentUserRole = $request->session()->get('currentUserRole');


        if ($this->isCurrentUserRole == 'admin') {
            // var_dump($this->isCurrentUserRole); exit;
            return redirect('/admin');
        }
    }

    public function authentication(Request $request, FormValidationRequest $req)
    {
        // var_dump($validator = $req->validated());

        // var_dump($validator->message()->first());
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);

        $email = $request->only('email');
        $user = UserModel::where('Email', $email)->get();


        if (Hash::check($request->input('password'), $user[0]['Password'])) {
            // var_dump('correct'); exit;
            if (isset($user) && $user[0]['Role'] == 'admin') {
                // session(['currentUserEmail' => $email['email']]);
                // session(['currentUserRole' => $user[0]['Role']]);
                $request->session()->put('currentUserEmail',  $email['email']);
                $request->session()->put('currentUserRole',  $user[0]['Role']);
                return redirect()->route('admin.index');
            } elseif (isset($user) && $user[0]['Role'] == 'user') {
                $request->session()->put('currentUserEmail',  $email['email']);
                $request->session()->put('currentUserRole',  $user[0]['Role']);
                $request->session()->put('userId', $user[0]->id);

                return redirect()->route('userHome.show', $user[0]->id);
                // return redirect()->route('userHome.show', $email);
            }
        }
    }

    public function logoutUser(Request $request)
    {
        $request->session()->forget('currentUserEmail');
        $request->session()->forget('currentUserRole');
        // var_dump($request->session()->get('currentUserRole')); exit;
        // return view('pages.Login');
        return redirect('/login');
    }
}
