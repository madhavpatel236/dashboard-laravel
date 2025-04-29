@extends('templates.home_template')

@section('content')
    <div>
        <h2> Register New User </h2>
        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            First Name: <input name="firstname" id="firstname" type="text" /> <br /> <br />

            Last Name: <input name="lastname" id="lastname" type="text" /> <br /> <br />

            Email Name: <input name="email" id="email" type="email" /> <br /> <br />

            Password: <input name="password" id="password" type="password" /> <br /> <br />

            Role:
            <select name="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select> <br /> <br />

            <button id="createUser_btn" name="createUser_btn"> Create User </button>
        </form>
    </div>
@endsection
