@extends('layouts.default')

@section('page_name', 'Users Data')
@section('content')
    <div class="float-right pb-4">
        <a href="{{ url('/add-user') }}" class="btn btn-success"> Add User </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="35px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Title</th>
                <th width="150px">Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr> 
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset($user->avatar) }}" width='50' height='50' class="img img-responsive" alt="">
                        @else
                            No Avatar
                        @endif
                    </td>
                    <td>{{ $user->title }}</td>
                    <td>
                        <a href="{{ url('/edit-user/'.$user->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Add delete functionality -->
                        <form method="post" action="{{ url('/delete-user/'.$user->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
