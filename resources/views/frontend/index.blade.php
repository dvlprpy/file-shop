@extends('layouts.home')

@section('desc')
    @include('frontend.HomeSection.desc')
@endsection

@section('content')
    @include('frontend.HomeSection.content', ['files' => $files, 'packages' => $packages])
@endsection

@section('footer')
    @include('frontend.HomeSection.footer')
@endsection