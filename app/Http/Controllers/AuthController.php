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
        // var_dump($request->session()); exit;
        $this->isCurrentUserEmail = session('currentUserEmail');
        $this->isCurrentUserRole = session('currentUserRole');
        // $this->isCurrentUserEmail = $request->session()->get('currentUserEmail');
        // $this->isCurrentUserRole = $request->session()->get('currentUserRole');

        session(['credenetial_error' => null]);
        // if ($this->isCurrentUserRole == 'admin') {
        //     // var_dump($this->isCurrentUserRole); exit;
        //     return redirect('/admin');
        // }
    }

    public function authentication(Request $request)
    // public function authentication(Request $request)
    {
        // var_dump($validator = $req->validated());

        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);


        $email = $request->only('email');
        // $userModelObj = new UserModel();
        // $user = $userModelObj->where('Email', $email)->get();
        // dump($user); exit;


        $user = UserModel::where('Email', $email)->get();

        if (count($user) != 0 && Hash::check($request->input('password'), $user[0]['Password'])) {
        if (isset($user) && $user[0]['Role'] == 'admin') {
            session(['currentUserEmail' => $email['email']]);
            session(['currentUserRole' => $user[0]['Role']]);
            // $request->session()->put('currentUserEmail',  $email['email']);
            // $request->session()->put('currentUserRole',  $user[0]['Role']);
            // $request->session->put('credential_error', null);
            session(['credential_error' => null]);

            return redirect()->route('admin.index');
        } elseif (isset($user) && $user[0]['Role'] == 'user') {

            session(['currentUserEmail' => $email['email']]);
            session(['currentUserRole' => $user[0]['Role']]);

            // $request->session()->put('currentUserEmail',  $email['email']);
            // $request->session()->put('currentUserRole',  $user[0]['Role']);
            // $request->session->put('credential_error', null);
            session(['credential_error' => null]);
            // $request->session()->put('userId', $user[0]->id);
            session(['userId' => $user[0]->id]);

            return redirect()->route('userHome.show', $user[0]->id);
            return redirect()->route('userHome.show', $email);
        }
        } else {
            $cred_error = 'Invalid Credential!!';
            session(['credenetial_error' => $cred_error]);
            return redirect()->route('loginPage_route');
        }
    }

    public function logoutUser(Request $request)
    {
        session(['credenetial_error' => null]);
        $request->session()->forget('currentUserEmail');
        $request->session()->forget('currentUserRole');
        // var_dump($request->session()->get('currentUserRole')); exit;
        // return view('pages.Login');
        return redirect('/login');
    }
}
