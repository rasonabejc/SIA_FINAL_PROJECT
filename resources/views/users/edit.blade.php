@extends('pages.base')

@section('content')

@if (session('message'))
<div class="success">{{session('message')}}</div>
@endif

    <h1>
        UPDATE USER
    </h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('users/'.$user->id)}}" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter full name..." class="form-control" value="{{$user->full_name}}">
                    @error('full_name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter username..." class="form-control" value="{{$user->username}}">
                    @error('username')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter email..." class="form-control" value="{{$user->email}}">
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                    <button class="btn btn-primary">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
