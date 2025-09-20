@extends('layouts.admin')

@section('content')

    @include('admin.file.form', ['file' => $file, 'categories' => $categories, 'selectedCategories' => $selectedCategories]);
    
@endsection