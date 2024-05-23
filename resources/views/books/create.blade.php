@extends('pages.base')

@section('content')
<h1>Create Book</h1>
<div class="row">
    <div class="col-md-5">
        <form action="{{ url('books/create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Select User</label>
                <select name="user_id" id="user_id" class="form-select">
                    @foreach ($users as $userId => $user)
                        <option value="{{ $userId }}">{{ $user }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="published_year">Published Year</label>
                <input type="text" name="published_year" id="published_year" class="form-control">
            </div>
            <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary mt-2" type="submit">Add Book</button>
            </div>
        </form>
    </div>
</div>
@endsection
