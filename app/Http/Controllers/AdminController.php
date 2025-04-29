<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel as UserModel;

class AdminController extends Controller
{
    public $isCurrentUserEmail;
    public $isCurrentUserRole;

    public function __construct(Request $request)
    {
        $this->isCurrentUserEmail = $request->session()->get('currentUserEmail');
        $this->isCurrentUserRole = $request->session()->get('currentUserRole');
        // $isCurrentUserEmail = session(['isCurrentUserEmail']);
        // $isCurrentUserRole  = session(['currentUserRole']);
        // var_dump(is_null($isCurrentUserEmail) && is_null($isCurrentUserRole));
        // var_dump(($isCurrentUserEmail));
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            // return view('pages.Login');
            return redirect('/login');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
        //     // var_dump('dfv');
        //     return redirect('/login');
        // }

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname',
            'lastname',
            'email',
            'password',
            'role',
        ]);

        UserModel::create($request->all());
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = UserModel::findOrFail($id);
        return view('pages.UserEdit', compact('user'));
        // echo "<pre>";var_dump($user['Email']); exit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect('/admin');
    }
}
