@extends('layouts.default')

@section('page_name', 'Edit User Data')
@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit User Data</h3>
    </div>
    <!-- /.card-header -->
    <!-- Form start -->
    <form class="form-horizontal" action="{{ route('update-user', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updates -->
        <div class="card-body">
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select class="form-control" id="title" name="title">
                        <option value="">Select Title</option>
                        @foreach($titles->sortBy('tit_order') as $title)
                        <option value="{{ $title->tit_name }}">{{ $title->tit_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Other form fields with pre-populated values from $user -->
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group row">
                <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <a href="{{ route('homepage') }}" class="btn btn-default float-right">Cancel</a>
            <button type="reset" class="btn btn-default float-right mr-2">Reset</button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->
@endsection
