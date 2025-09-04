@extends('layouts.admin')

@section('content')
    
    @include('admin.file.form', [
        'file' => $file,
        'categories' => $categories ?? [],   // همه دسته‌ها
        'selectedCategories' => $selectedCategories ?? []  // دسته‌های انتخاب‌شده (خالی برای create)
    ])

@endsection