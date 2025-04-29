<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $isCurrentUserEmail;
    public $isCurrentUserRole;

    public function __construct(Request $request)
    {
        $this->isCurrentUserEmail = $request->session()->get('currentUserEmail');
        $this->isCurrentUserRole = $request->session()->get('currentUserRole');
        // if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
        //     var_dump('dfv');
        //     return redirect('/login');
        // }
    }
    public function index()
    {
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            return redirect('/login');
        }

        return view('pages.UserHome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (is_null($this->isCurrentUserEmail) && is_null($this->isCurrentUserRole)) {
            // var_dump('dfv');
            return redirect('/login');
        }

        $user = UserModel::findOrFail($id);
        // $userData =$user[''];
        // echo "<pre>"; var_dump($userData); exit;
        return view('pages.UserHome', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
