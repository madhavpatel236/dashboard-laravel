{{-- <div> --}}
{{-- Admin --}}
{{-- </div> --}}

@extends('templates.home_template')

@section('content')
    {{-- <h2> Admin </h2> --}}<br/>
    <a href="{{ route('user.create') }}" > Register New User </a> <br/><br/>

    <table border="1">
        <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($users as $eachUser)
                {{-- <div> {{ $eachUser->id }} </div> --}}
                <tr>
                    <td>{{ $eachUser['firstName'] }}</td>
                    <td>{{ $eachUser['lastName'] }}</td>
                    <td>{{ $eachUser['Email'] }}</td>
                    <td>
                        <a href="{{ route('user.edit', $eachUser->id) }}"> Edit </a>
                        {{-- <form action="{{ route('user.edit', $eachUser->id) }}" >
                            @csrf
                            <button>Edit</button>
                        </form> --}}
                        <form action="{{ route('user.destroy', $eachUser->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div> No user is present in the db </div>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $users }} --}}
@endsection
