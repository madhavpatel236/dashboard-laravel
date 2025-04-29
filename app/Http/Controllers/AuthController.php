<?php

namespace App\Http\Controllers;

use App\Models\UserModel as UserModel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->only('email');
        $user = UserModel::where('Email', $email)->get();
        // echo "<pre>";var_dump($user[0]['Role']); exit;

        if ($user[0]['Role'] == 'admin') {
            $request->session()->put('currentUserEmail',  $email['email']);
            $request->session()->put('currentUserRole',  $user[0]['Role']);
            // var_dump($request->session()->get('currentUserRole')); exit;
            return redirect()->route('adminHome_route');
        } elseif ($user[0]['Role'] == 'user') {
            $request->session()->put('currentUserEmail',  $email['email']);
            $request->session()->put('currentUserRole',  $user[0]['Role']);
            return redirect()->route('userHome.show', $user[0]->id);
            // return redirect()->route('userHome.show', $email);
        }
    }

    public function logoutUser(Request $request){
        $request->session()->forget('currentUserEmail');
        $request->session()->forget('currentUserRole');
        // $request->session()->flush();
        // var_dump($request->session()->get('currentUserRole')); exit;
        return view('pages.Login');

    }
}
