@extends('layouts.admin')

@section('content')

    @include('admin.category.form', $categoryEdit);
    
@endsection