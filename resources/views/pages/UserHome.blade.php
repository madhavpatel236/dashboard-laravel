@extends('templates.home_template')
@section('content')
    <div>
        {{-- {{ $user }} --}}
        <br />
        <form method="post" action="{{ route('logout_route') }}">
            @csrf
            <button name="logout_btn" id="logout_btn" class="logout_btn"> Logout </button>
        </form>

        <br />
        <strong> First Name:</strong> {{ $user->firstName }} <br />
        <strong> Last Name: </strong> {{ $user->lastName }} <br />
        <strong> Email: </strong> {{ $user->Email }} <br />
        <strong> Role: </strong> {{ $user->Role }} <br />
    </div>
    <br />
@endsection
