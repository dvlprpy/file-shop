@extends('layouts.user_dashboard')


@section('content')
    <h4 class='text-center'>
        <span>سلام</span>
        <span class="text-success">
            {{ $user->fullname }}
        </span>
        <span>به پنل مدیریت خوش آمدید.</span>
    </h2>
@endsection