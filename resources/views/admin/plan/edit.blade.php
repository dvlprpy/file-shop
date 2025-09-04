@extends('layouts.admin')

@section('content')

    @include('admin.plan.form', $get_plan);
    
@endsection