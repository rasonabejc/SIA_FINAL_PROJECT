
@extends('pages.base')

@section('content')
<div class="container">
    <h1>Import user from CSV</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('users.import.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">CSV File</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Import CSV</button>
    </form>
</div>
@endsection
