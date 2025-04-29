<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authentication(Request $request)
    {
        // var_dump("user");
        // exit;
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->only('email');
        $user = userModel::find($email);
    }
}
