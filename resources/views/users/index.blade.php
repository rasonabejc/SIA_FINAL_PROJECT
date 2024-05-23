@extends('pages.base')

@section('content')
@if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
    <a href="{{ url('users/pdf') }}" target="_blank" class="btn btn-primary me-md-2 mb-3">Export PDF</a>
    <form action="{{ route('users.export.csv') }}" method="GET" class="me-md-2">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Export CSV</button>
    </form>

    <a href="{{ route('users.import') }}" class="btn btn-secondary mb-3">Import CSV</a>

    <a href="users/scan" class="btn btn-primary mb-3">Scanner</a>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
@foreach($users as $user)
    <div class="col mb-4">
        <div class="card">
            <div class="card-body">
                <?php
                    // Concatenate ID, username, and full name into a single string
                    $qrString = $user->id . '-' . $user->full_name;
                ?>
                {!! QrCode::size(100)->generate($qrString) !!}
                <h5 class="card-title">{{ $user->full_name }}</h5>
                <p class="card-text">ID: {{ $user->id }}</p>
                <p class="card-text">Username: {{ $user->username }}</p>
                <p class="card-text">Email: {{ $user->email }}</p>
                <a href="{{ url('/users/' . $user->id) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>

@endsection
