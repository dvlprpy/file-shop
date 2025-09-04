@extends('layouts.home')


@section('content')
    @include('frontend.HomeSection.content', ['file' => $file, 'package' => $package])
@endsection


@section('footer')
    @include('frontend.HomeSection.footer')
@endsection



@section('desc')
    @include('frontend.HomeSection.desc')
@endsection