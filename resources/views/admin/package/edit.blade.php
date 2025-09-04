@extends('layouts.admin')

@section('content')

    @include('admin.package.form', [
        'selectedPackages' => $selectedPackages, 
        'category' => $category,
        'package' => $package,
    ]);
    
@endsection