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

        // echo "<pre>";var_dump($user[0]['Role']); exit;
        $email = $request->only('email');
        $user = UserModel::where('Email', $email)->get();
        if ($user[0]['Role'] == 'admin') {
            return redirect()->route('adminHome_route');
        } elseif ($user[0]['Role'] == 'user') {
            // return redirect()->route('userHome.show', $email);
            return redirect()->route('userHome.show', $user[0]->id);
        }

    }
}
