@extends('layouts.main.master')
@section('title')
About Us
@endsection
@section('description')
{{$setting->company}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="page-header">
    <div class="bg-img bg-eager" data-background="{{ static_bg('frontend/img/page-header-bg.png') }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">About Us</h1>
            <h4 class="sub-title">
                <a class='home' href='{{route('home')}}'>Home </a>
                <span class="icon">-</span>
				<a class='inner-page' href='{{route('aboutUs')}}'> About Us</a></h4>
        </div>
    </div>
</section>

<section class="blog-details pt-50 pb-50 overflow-hidden">
    <div class="container">
        <div class="row gy-5 pin-inner">
            <div class="col-lg-12 col-md-12">
                <div class="content-post">
                    {!! $gioithieu->content !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection