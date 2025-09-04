@extends('layouts.admin')


@section('content')
    

    @include('admin.package.form', [
        'package' => $package, 
        'category' => $category, 
        'selectedPackages' => $selectedPackages
    ])


@endsection