@extends('layouts.main.master')
@section('title')
{{($Cate->name)}}
@endsection
@section('description')
{{($Cate->description)}}
@endsection
@section('image')
{{ url(firstBeforeAfterImage($Cate->image) ?: 'frontend/img/page-header-bg.png') }}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="page-header">
    <div class="bg-img bg-eager" data-background="{{ url(firstBeforeAfterImage($Cate->image ?? '') ?: 'frontend/img/page-header-bg.png') }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">{{$Cate->name}}</h1>
            <h4 class="sub-title"><a class='home' href='{{route('home')}}'>Home </a>
				<span class="icon">-</span>
				<a class='inner-page' href='{{route('duanTieuBieu')}}'> Projects</a>
				<span class="icon">-</span>
				<a class='inner-page' href='{{route('projectCategory',['slug'=>$Cate->slug])}}'> {{$Cate->name}}</a></h4>
        </div>
    </div>
</section>
<section class="project-section-inner pt-130 pb-130">
    <div class="container">
        <div class="row gy-5">
            
            @forelse($list as $du)
            @php
                $duImagesArr = !empty($du->images) ? (json_decode($du->images, true) ?: []) : [];
                $duFirst = $duImagesArr[0] ?? null;
                $duThumb = firstBeforeAfterImage($du->images ?? '');
                $duLink = route('duanTieuBieuDetail', ['slug' => $du->slug]);
            @endphp
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="project-item antra-hover-view">
                    <div class="project-img">
                        @if(is_array($duFirst) && !empty($duFirst['before']) && !empty($duFirst['after']))
                        <div class="antra-image-comparison">
                            <img src="{{ $duFirst['before'] }}" alt="Before - {{ $du->name }}">
                            <img src="{{ $duFirst['after'] }}" alt="After - {{ $du->name }}">
                        </div>
                        @elseif($duThumb)
                        <a class="d-block p-relative z-1" href="{{ $duLink }}">
                            <img src="{{ $duThumb }}" alt="{{ $du->name }}">
                        </a>
                        @endif
                        <ul>
                            @if($du->cateProject)
                            <li><a href="{{ route('projectCategory', ['slug' => $du->cateProject->slug]) }}">{{ $du->cateProject->name }}</a></li>
                            @endif
                            @if($du->location)
                            <li><a href="{{ $duLink }}">{{ $du->location }}</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="project-content">
                        <h3 class="title"><a href="{{ $duLink }}">{{ $du->name }}</a></h3>
                        @if($du->location || $du->operate)
                        <span>{{ $du->location }}@if($du->location && $du->operate)<br>@endif{{ $du->operate }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center mb-0">Chưa có dự án trong danh mục này.</p>
            </div>
            @endforelse
            @if($list->hasPages())
            <div class="col-12">
                {{ $list->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
