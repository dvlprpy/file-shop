@extends('layouts.user_dashboard')


@section('content')

    <h4 class='text-center'>
        <span>سلام</span>
        <span class="text-success">
            {{ $user->fullname }}
        </span>
        <span>به پنل مدیریت خوش آمدید.</span>
    </h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

@endsection