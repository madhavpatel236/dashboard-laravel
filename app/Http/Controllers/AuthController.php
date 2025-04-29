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
        // var_dump($email); exit;
        // var_dump($user[0]['Role']); exit;
        if ($user[0]['Role'] == 'admin') {
            return redirect()->route('adminHome_route');
        } elseif ($user[0]['Role'] == 'user') {
            return redirect()->route('userHome_route');
        }
        // echo "<pre>";var_du  mp($user[0]['Role']); exit;

    }
}
