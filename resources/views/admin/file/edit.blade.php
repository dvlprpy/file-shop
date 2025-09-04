@extends('layouts.admin')

@section('content')
'file', 'categories', 'selectedCategories'
    @include('admin.file.form', ['file' => $file, 'categories' => $categories, 'selectedCategories' => $selectedCategories]);
    
@endsection