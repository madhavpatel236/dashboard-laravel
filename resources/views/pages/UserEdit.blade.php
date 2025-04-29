@extends('templates.home_template')

@section('content')
    <div>
        {{-- {{ $user['id'] }} --}}
        <h2> Edit User </h2>
        <form method="POST" action="{{ route('admin.update', $user->id) }} ">
            @csrf
            @method('PUT')

            First Name: <input name="firstname" id="firstname" type="text"
                value="{{ isset($user->firstName) ? $user->firstName : '' }}" /> <br /> <br />

            Last Name: <input name="lastname" id="lastname" type="text"
                value="{{ isset($user->lastName) ? $user->lastName : '' }}" /> <br /> <br />

            Email Name: <input name="email" id="email" type="email"
                value="{{ isset($user->Email) ? $user->Email : '' }}" /> <br /> <br />

            Role:
            <select name="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select> <br /> <br />

            <button id="update_btn" name="update_btn"> Update </button>
        </form>
    </div>
@endsection
