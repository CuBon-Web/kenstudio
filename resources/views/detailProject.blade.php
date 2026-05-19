@extends('layouts.main.master')
@section('title')
{{$detail->name}}
@endsection
@section('description')
{{$detail->description}}
@endsection
@section('image')
{{ url(firstBeforeAfterImage($detail->images ?? '') ?: 'frontend/img/page-header-bg.png') }}
@endsection
@section('js')
@endsection
@section('css')
<style>
.project-details-wrap .project-details-img {
    height: auto;
}
.project-details-wrap .project-details-img .antra-image-comparison {
    width: 100%;
    min-height: 380px;
    border-radius: 24px;
    overflow: hidden;
}
.project-details-wrap .project-details-img .antra-image-comparison img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.project-details-wrap .project-details-img .twentytwenty-container.antra-image-comparison {
    min-height: 380px;
}
</style>
@endsection
@section('content')
<section class="page-header">
    <div class="bg-img bg-eager" data-background="{{ url(firstBeforeAfterImage($detail->images ?? '') ?: 'frontend/img/page-header-bg.png') }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">{{$detail->name}}</h1>
            <h4 class="sub-title"><a class='home' href='{{route('home')}}'>Home </a>
				<span class="icon">-</span>
				@if($detail->cateProject)
				<a class='inner-page' href='{{route('projectCategory',['slug'=>$detail->cateProject->slug])}}'> {{$detail->cateProject->name}}</a>
				@endif
				<span class="icon">-</span>
				<a class='inner-page' href='{{route('duanTieuBieuDetail',['slug'=>$detail->slug])}}'> {{$detail->name}}</a></h4>
        </div>
    </div>
</section>
<section class="portfolio-details pt-50 pb-50">
    <div class="container container-2">
        <div class="project-details-wrap">
            <div class="project-details-meta">
                <div class="details-meta">
                    <span>Architect :</span>
                    <h5>{{ $detail->cateProject->name ?? '—' }}</h5>
                </div>
                <div class="details-meta">
                    <span>Location:</span>
                    <h5>{{$detail->location}}</h5>
                </div>
                <div class="details-meta">
                    <span>Operate:</span>
                    <h5>{{$detail->operate}}</h5>
                </div>
                <div class="details-meta">
                    <span>Scale:</span>
                    <h5>{{$detail->scale}}</h5>
                </div>
            </div>
            <div class="project-details-img">
                <div class="row gy-4">
                    @php
                        $projectPairs = [];
                        if (!empty($detail->images)) {
                            $decoded = json_decode($detail->images, true);
                            if (is_array($decoded)) {
                                foreach ($decoded as $item) {
                                    if (is_array($item) && !empty($item['before']) && !empty($item['after'])) {
                                        $projectPairs[] = $item;
                                    }
                                }
                            }
                        }
                    @endphp
                    @forelse($projectPairs as $pair)
                    <div class="col-lg-6">
                        <div class="antra-image-comparison fade-top">
                            <img src="{{ $pair['before'] }}" alt="Before - {{ $detail->name }}">
                            <img src="{{ $pair['after'] }}" alt="After - {{ $detail->name }}">
                        </div>
                    </div>
                    @empty
                    @php $fallbackImg = firstBeforeAfterImage($detail->images ?? ''); @endphp
                    @if($fallbackImg)
                    <div class="col-lg-12">
                        <img src="{{ $fallbackImg }}" alt="{{ $detail->name }}">
                    </div>
                    @endif
                    @endforelse
                </div>
            </div>
            <h2>Details Information</h2>
            {!!languageName($detail->content)!!}
        </div>
    </div>
</section>
@endsection