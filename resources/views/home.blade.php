@extends('layouts.main.master')
@section('title')
{{$setting->company}}
@endsection
@section('description')
{{$setting->webname}}
@endsection
@section('image')
@php
    $ogBanner = $banner->first();
    $ogImage = $ogBanner && $ogBanner->image
        ? url($ogBanner->image)
        : url($setting->logo ?? '');
@endphp
{{ $ogImage }}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
@include('partials.home-slider')
<section class="about-section-4 pt-60 pb-130 fade-wrapper tl-bg-color">
   <div class="container container">
       <div class="row section-heading-wrap fade-top">  
           <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading.png', 'alt' => 'shape'])</div>
           <div class="col-lg-4 col-md-12">
               <div class="section-heading mb-0">
                   <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">About KEN VISUAL</h4>
               </div>
           </div>
           <div class="col-lg-8 col-md-12">
               <div class="section-heading section-heading-2 mb-0">
                   <h2 class="section-title cursor-effect title-2">{{$setting->company}}</h2>
                   <div class="mb-0">{!! $gioithieu->description !!}</div>
                   <a href="{{ route('aboutUs') }}" class="btn-service">Read More</a>
                  </div>
           </div>
       </div>
       @php
       $gioithieuPairs = [];
       if (!empty($gioithieu) && !empty($gioithieu->image)) {
           $decoded = json_decode($gioithieu->image, true);
           if (is_array($decoded)) {
               foreach ($decoded as $item) {
                   if (
                       !is_array($item)
                       || empty($item['before'])
                       || empty($item['after'])
                       || $item['before'] === 'null'
                       || $item['after'] === 'null'
                   ) {
                       continue;
                   }
                   if (isset($item['status']) && (int) $item['status'] === 0) {
                       continue;
                   }
                   $gioithieuPairs[] = $item;
               }
           }
       }
   @endphp
   @if(count($gioithieuPairs))
   <div class="row about-item-wrap gy-lg-0 gy-4 fade-wrapper">
       @foreach($gioithieuPairs as $pair)
       <div class="col-lg-6 col-md-6">
           <div class="about-item-4 antra-hover-view mb-4">
               <div class="antra-image-comparison">
                   {!! lazy_img($pair['before'], $pair['title'] ?? 'Before') !!}
                   {!! lazy_img($pair['after'], $pair['title'] ?? 'After') !!}
               </div>
               @if(!empty($pair['title']))
               <p class="about-comparison-title">{{ $pair['title'] }}</p>
               @endif
           </div>
       </div>
       @endforeach
   </div>
   @endif
   
   </div>
</section>
<section class="service-section-5 pt-50 pb-50 fade-wrapper">
   <div class="bg-img" data-background="{{ static_bg('frontend/img/service-bg-2.png') }}"></div>
   <div class="container container">
       <div class="row section-heading-wrap fade-top">  
           <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading-2.png', 'alt' => 'shape'])</div>
           <div class="col-lg-4 col-md-12">
               <div class="section-heading mb-0 white-content">
                   <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Why choose us?</h4>
               </div>
           </div>
           <div class="col-lg-8 col-md-12">
               <div class="section-heading section-heading-2 mb-0 white-content">
                   <h2 class="section-title cursor-effect  title-2">Why choose KEN VISUAL?</h2>
               </div>
           </div>
       </div>
       @if($whyChoose->count())
       <div class="row gy-lg-0 gy-4 fade-wrapper">
           @foreach($whyChoose as $index => $item)
           @php $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT); @endphp
           <div class="col-lg-4 col-md-6 fade-top">
               <div class="service-item-5 {{ $index % 2 === 1 ? 'item-2' : '' }}">
                   <div class="service-content">
                       <h3 class="title">
                           <a href="{{ $item->link ?: '#' }}">{!! nl2br(e($item->title)) !!}</a>
                           <span class="number">{{ $num }}</span>
                       </h3>
                       @if($item->description)
                       <p>{{ $item->description }}</p>
                       @endif
                   </div>
                   @if($item->image)
                   <div class="service-img">
                       {!! lazy_img($item->image, $item->title) !!}
                   </div>
                   @endif
               </div>
           </div>
           @endforeach
       </div>
       @endif
   </div>
</section>
<!-- ./ about-section -->

<!-- ./ feature-section -->

<section class="service-section-2 fade-wrapper pt-60 pb-40">
   <div class="container container">
       <div class="row section-heading-wrap fade-top">  
           <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading.png', 'alt' => 'shape'])</div>
           <div class="col-lg-4 col-md-12">
               <div class="section-heading mb-0">
                   <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Our Services</h4>
               </div>
           </div>
           <div class="col-lg-8 col-md-12">
               <div class="section-heading section-heading-2 mb-0">
                   <h2 class="section-title cursor-effect  title-2">Explore our professional interior <br> photo editing services</h2>
               </div>
           </div>
       </div>
       @foreach ($servicehome as $item)
       <div class="row mb-5 fade-top">
     
        @php
        $serviceImagesArr = [];
        $serviceThumb = null;
        if (!empty($item->image)) {
            $decoded = json_decode($item->image, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                if (is_array($decoded) && isset($decoded[0])) {
                    $serviceImagesArr = $decoded;
                } elseif (is_array($decoded) && (isset($decoded['before']) || isset($decoded['after']))) {
                    $serviceImagesArr = [$decoded];
                }
            } else {
                // Du lieu cu dang string anh don
                $serviceThumb = $item->image;
            }
        }
        $serviceFirst = $serviceImagesArr[0] ?? null;
        if (is_array($serviceFirst)) {
            $serviceThumb = $serviceFirst['after'] ?? $serviceFirst['before'] ?? $serviceThumb;
        } elseif (is_string($serviceFirst)) {
            $serviceThumb = $serviceFirst;
        }
    
        $isEvenKey = ($loop->index % 2) === 0;
        @endphp
         <div class="col-lg-6 {{ $isEvenKey ? 'order-lg-1' : 'order-lg-2' }}">
            <div class="testi-img">
               @if(is_array($serviceFirst) && !empty($serviceFirst['before']) && !empty($serviceFirst['after']))
               <div class="antra-image-comparison">
                   {!! lazy_img($serviceFirst['before'], 'Before - ' . $item->name, ['eager' => true]) !!}
                   {!! lazy_img($serviceFirst['after'], 'After - ' . $item->name, ['eager' => true]) !!}
               </div>
               @elseif($serviceThumb)
               {!! lazy_img($serviceThumb, $item->name, ['eager' => true]) !!}
               @endif
            </div>
        </div>
        <div class="col-lg-6 {{ $isEvenKey ? 'order-lg-2' : 'order-lg-1' }}" style="margin: auto">
           <div class="service-item-2">
               <h2 class="title-service"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{ $item->name }}</a></h2>
              <p>{!! languageName($item->description) !!}</p>
              <a href="{{route('serviceList',['slug'=>$item->slug])}}" class="btn-service">Detail Service</a>
          </div>
        </div>
        
         
     </div>
     @endforeach
       {{-- <div class="service-carousel swiper fade-top">
           <div class="swiper-wrapper">
            @foreach($servicehome as $index => $item)
         <div class="swiper-slide">
               <div class="service-item-2">
                   <div class="service-thumb">
                     <a href="{{route('serviceList',['slug'=>$item->slug])}}">
                       {!! lazy_img($item->image, $item->name) !!}
                       <span class="number">{{ $index + 1 }}</span>
                       </a>
                   </div>
                   <div class="service-content">
                       <h5 class="title"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{ $item->name }}</a></h5>
                       <p class="line_2">{{ languageName($item->description) }}</p>
                   </div>
               </div>
           </div>
            @endforeach
           </div>
       </div> --}}
   </div>
</section>
<!-- ./ process-section -->
<section class="counter-section pb-20">
   <div class="container container">
      <div class="row gy-5 fade-wrapper">
         <div class="col-lg-3 col-md-6 fade-top col-6">
            <div class="counter-item">
               <h3 class="title"><span class="odometer" data-count="22">0</span><span class="icon">+</span></h3>
               <h4 class="sub-title">Years experience</h4>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 fade-top col-6">
            <div class="counter-item">
               <h3 class="title"><span class="odometer" data-count="189">0</span><span class="icon">+</span></h3>
               <h4 class="sub-title">Projects completed</h4>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 fade-top col-6">
            <div class="counter-item">
               <h3 class="title"><span class="odometer" data-count="265">0</span><span class="icon">+</span></h3>
               <h4 class="sub-title">Skilled Tradespeople</h4>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 fade-top col-6">
            <div class="counter-item">
               <h3 class="title"><span class="odometer" data-count="328">0</span><span class="icon">+</span></h3>
               <h4 class="sub-title">Client satisfaction</h4>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ./ counter-section -->

<section class="project-section-5 pt-50 pb-50 fade-wrapper tl-bg-color">
   <div class="container container">
       <div class="row section-heading-wrap fade-top">  
           <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading.png', 'alt' => 'shape'])</div>
           <div class="col-lg-4 col-md-12">
               <div class="section-heading mb-0">
                   <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">FEATURED PROJECTS</h4>
               </div>
           </div>
           <div class="col-lg-8 col-md-12">
               <div class="section-heading section-heading-2 mb-0">
                   <h2 class="section-title cursor-effect  title-2">Creative interior visuals that define <br> our signature style</h2>
                   <p>We turn ordinary interior photos into polished, market-ready visuals. Explore our portfolio <br> of expertly edited real estate and interior imagery designed to inspire and impress.</p>
               </div>
           </div>
       </div>
       <div class="row gy-5 fade-wrapper">
           @foreach($duan as $du)
           @php
               $duImagesArr = [];
               if (!empty($du->images)) {
                   $duImagesArr = json_decode($du->images, true) ?: [];
               }
               $duFirst = $duImagesArr[0] ?? null;
               if (is_array($duFirst)) {
                   $duThumb = $duFirst['after'] ?? $duFirst['before'] ?? null;
               } else {
                   $duThumb = is_string($duFirst) ? $duFirst : null;
               }
               $duLink = route('duanTieuBieuDetail', ['slug' => $du->slug]);
               $pos    = $loop->index % 4;
               // Pattern: index 0 = small, 1 = big, 2 = big, 3 = small ml-a
               if ($pos === 0) {
                   $itemClass = 'project-item-5 antra-hover-view';
               } elseif ($pos === 3) {
                   $itemClass = 'project-item-5 ml-a antra-hover-view';
               } else {
                   $itemClass = 'project-item-5 antra-hover-view';
               }
           @endphp
           <div class="col-lg-6 fade-top">
               <div class="{{ $itemClass }}">
                   <div class="project-img">
                       @if(is_array($duFirst) && !empty($duFirst['before']) && !empty($duFirst['after']))
                       <div class="antra-image-comparison">
                           {!! lazy_img($duFirst['before'], 'Before - ' . $du->name) !!}
                           {!! lazy_img($duFirst['after'], 'After - ' . $du->name) !!}
                       </div>
                       @elseif($duThumb)
                       {!! lazy_img($duThumb, $du->name) !!}
                       @endif
                       <ul>
                           @if($du->cateProject)
                           <li><a href="{{ $duLink }}">{{ $du->cateProject->name }}</a></li>
                           @endif
                           @if($du->location)
                           <li><a href="{{ $duLink }}">{{ $du->location }}</a></li>
                           @endif
                       </ul>
                   </div>
                   <div class="project-content">
                       <h3 class="title"><a href="{{ $duLink }}">{{ $du->name }}</a></h3>
                       @if($du->location || $du->operate)
                       <span>{{ $du->location }}{{ ($du->location && $du->operate) ? ' ? ' : '' }}{{ $du->operate }}</span>
                       @endif
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</section>
<section class="process-section overflow-hidden fade-wrapper">
   <div class="bg-shape" data-background="https://antra.ibthemespro.com/assets/img/shapes/process-shape-1.png"></div>
   <div class="container container">
      <div class="heading-space align-items-end">
         <div class="section-heading mb-0">
            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">How We Work</h4>
            <h2 class="section-title cursor-effect title-2">Precision editing designed to deliver <br> exceptional results</h2>
         </div>
         <div class="process-desc">
            <p class="mb-0">Every image tells a story. Our editing process enhances lighting, refines details, <br> and brings balance to every space ? transforming interior photos into <br> polished visuals designed to captivate.</p>
         </div>
      </div>
      <div class="row gy-xl-0 gy-4 process-wrap fade-wrapper">
         @forelse($processSteps as $step)
         @php $num = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); @endphp
         <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="process-item fade-top">
               <div class="process-thumb">
                  @if($step->image)
                  {!! lazy_img($step->image, $step->title) !!}
                  @else
                  @include('partials.img', ['src' => '/frontend/img/process-img-1.png', 'alt' => $step->title])
                  @endif
               </div>
               <div class="process-content">
                  <h3 class="title"><span>{{ $num }}</span>. {{ $step->title }}</h3>
                  @if($step->description)
                  <p>{!! nl2br(e($step->description)) !!}</p>
                  @endif
               </div>
               <span class="number">{{ $num }}</span>
            </div>
         </div>
         @empty
         {{-- Fallback khi ch?a c? d? li?u --}}
         @for($i = 1; $i <= 4; $i++)
         <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="process-item fade-top">
               <div class="process-thumb">
                  @include('partials.img', ['src' => '/frontend/img/process-img-' . $i . '.png', 'alt' => 'process'])
               </div>
               <div class="process-content">
                  <h3 class="title"><span>0{{ $i }}</span>. B??c {{ $i }}</h3>
               </div>
               <span class="number">0{{ $i }}</span>
            </div>
         </div>
         @endfor
         @endforelse
      </div>
   </div>
</section>
<!-- ./ project-section -->
<section class="testimonial-section pt-60 fade-wrapper">
   <div class="container container">
      <div class="row section-heading-wrap fade-top">
         <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading.png', 'alt' => 'shape'])</div>
         <div class="col-lg-4 col-md-12">
            <div class="section-heading mb-0">
               <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Owr clients say</h4>
            </div>
         </div>
         <div class="col-lg-8 col-md-12">
            <div class="section-heading section-heading-2 mb-0">
               <h2 class="section-title cursor-effect title-2">Here's What <span>warm words <br> our clients</span> say</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
            <div class="testi-img slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
               @include('partials.img', ['src' => '/frontend/img/process-img-3.jpg', 'alt' => 'testi'])
            </div>
         </div>
         <div class="col-lg-6">
            <div class="testi-carousel-wrap slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
               <div class="testi-top-content">
                  <div class="left-content">
                     <h3 class="rating">4.80</h3>
                     <div class="rating-list">
                        <ul>
                           <li><i class="fa-solid fa-star"></i></li>
                           <li><i class="fa-solid fa-star"></i></li>
                           <li><i class="fa-solid fa-star"></i></li>
                           <li><i class="fa-solid fa-star"></i></li>
                           <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <span>688 reviews</span>
                     </div>
                  </div>
                  <div class="right-content">
                     <p>From ordinary photos to stunning visuals, the team <br> transformed my property images with incredible <br> attention to  detail. The results exceeded my expectations.</p>
                  </div>
               </div>
               <div class="testi-carousel swiper">
                  <div class="swiper-wrapper">
                     @foreach($ReviewCus as $review)
                     <div class="swiper-slide">
                        <div class="testi-item">
                           {!! languageName($review->content) !!}
                           <div class="testi-author mt-3">
                              <div class="author-img">
                                 {!! lazy_img($review->avatar, $review->name) !!}
                              </div>
                              <h4 class="name">{!! languageName($review->name) !!} <span>{!! languageName($review->position) !!}</span></h4>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ./ testimonial-section -->
<section class="sponsor-section sponsor-1 bg-grey pt-30 pb-30 overflow-hidden">
   <div class="container">
      <div class="sponsor-carousel swiper">
         <div class="swiper-wrapper">
            @foreach ($Partner as $item)
            <div class="swiper-slide">
               <div class="sponsor-item">
                  <a href="{{ $item->link }}">{!! lazy_img($item->image, $item->name) !!}</a>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section>


<section class="blog-section pt-60 fade-wrapper tl-bg-color">
   <div class="container container">
      <div class="row section-heading-wrap fade-top">
         <div class="shape">@include('partials.img', ['src' => '/frontend/img/section-heading.png', 'alt' => 'shape'])</div>
         <div class="col-lg-4 col-md-12">
            <div class="section-heading mb-0">
               <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">amazing design team</h4>
            </div>
         </div>
         <div class="col-lg-8 col-md-12">
            <div class="section-heading section-heading-2 mb-0">
               <h2 class="section-title cursor-effect title-2">Blogs and News</h2>
            </div>
         </div>
      </div>
      <div class="blog-carousel swiper fade-top">
         <div class="swiper-wrapper">
            @foreach ($hotnews as $item)
            <div class="swiper-slide">
               <div class="post-card">
                  <div class="post-thumb">
                     {!! lazy_img($item->image, languageName($item->title)) !!}
                     {{-- <span class="category">{{ languageName($item->cate->name) }}</span> --}}
                  </div>
                  <div class="post-content">
                     <ul class="post-meta">
                        <li>{{ date_format($item->created_at,'d/m/Y') }}</li>
                        <li>By <span>Admin</span></li>
                     </ul>
                     <h3 class="title"><a href="{{ route('detailBlog',['slug'=>$item->slug]) }}">{{ languageName($item->title) }}</a></h3>
                     <p class="line_2">{!! languageName($item->description) !!}</p>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section>
<!-- ./ blog-section -->
<div class="gallary-section overflow-hidden">
   <div class="gallary-text"><span>gallery</span></div>
   @php
      $galleryCount = $gallery->count();
      $chunkSize = $galleryCount > 0 ? max(1, (int) ceil($galleryCount / 2)) : 1;
      $galleryChunks = $gallery->chunk($chunkSize);
      $galleryRow1 = $galleryChunks->first() ?? collect();
      $galleryRow2 = $galleryChunks->slice(1)->first() ?? collect();
   @endphp
   <div class="gallary-wrap wrap-1">
      <div class="gallery-scroll-wrap">
         @forelse($galleryRow1 as $item)
        <div class="gallary-scroll-item">
           @php $galleryImage = $item->after ?: $item->before; @endphp
           @if($galleryImage)
           <a href="{{ $galleryImage }}" class="venobox" data-gall="gallary1">{!! lazy_img($galleryImage, $item->title ?: 'Gallery') !!}</a>
           @endif
        </div>
         @empty
         <div class="gallary-scroll-item"><a href="{{ r2_asset('frontend/img/project-img-6.png') }}" class="venobox" data-gall="gallary1">@include('partials.img', ['src' => '/frontend/img/project-img-6.png', 'alt' => 'img'])</a></div>
         <div class="gallary-scroll-item"><a href="{{ r2_asset('frontend/img/project-img-7.png') }}" class="venobox" data-gall="gallary1">@include('partials.img', ['src' => '/frontend/img/project-img-7.png', 'alt' => 'img'])</a></div>
         @endforelse
      </div>
      </div>
   <div class="gallary-wrap gallery-scroll-direction-ltr">
      <div class="gallery-scroll-wrap align-items-start">
         @forelse($galleryRow2 as $item)
        <div class="gallary-scroll-item">
           @php $galleryImage = $item->after ?: $item->before; @endphp
           @if($galleryImage)
           <a href="{{ $galleryImage }}" class="venobox" data-gall="gallary1">{!! lazy_img($galleryImage, $item->title ?: 'Gallery') !!}</a>
           @endif
        </div>
         @empty
         <div class="gallary-scroll-item"><a href="{{ r2_asset('frontend/img/project-img-6.png') }}" class="venobox" data-gall="gallary1">@include('partials.img', ['src' => '/frontend/img/project-img-6.png', 'alt' => 'img'])</a></div>
         <div class="gallary-scroll-item"><a href="{{ r2_asset('frontend/img/project-img-7.png') }}" class="venobox" data-gall="gallary1">@include('partials.img', ['src' => '/frontend/img/project-img-7.png', 'alt' => 'img'])</a></div>
         @endforelse
      </div>
   </div>
</div>
<section class="home-cta-section fade-wrapper">
   <div class="home-cta-bg" data-background="{{ static_bg('frontend/img/page-header-bg.png') }}"></div>
   <div class="home-cta-overlay"></div>
   <div class="container">
      <div class="home-cta-inner fade-top">
         <h2 class="home-cta-title">Ready To Elevate Your Property Images?</h2>
         <p class="home-cta-desc">Get professional real estate photo editing with fast turnaround and consistent handcrafted quality.</p>
         <div class="home-cta-actions">
            <a href="{{ route('lienHe') }}" class="home-cta-btn home-cta-btn--primary">Get Started</a>
            <a href="{{ route('priceList') }}" class="home-cta-btn home-cta-btn--ghost">Free Test Edit</a>
         </div>
      </div>
   </div>
</section>
<section id="home-free-trial" class="newsletter-section pb-60 overflow-hidden tl-bg-color fade-wrapper pt-60">
   <div class="bg-shape">@include('partials.img', ['src' => '/frontend/img/newsletter-shape.png', 'alt' => 'shape'])</div>
   <div class="container">
      <div class="newsletter-wrap">
         <div class="section-heading text-center fade-top">
            <h2 class="section-title cursor-effect">Ready to Elevate Your Real Estate Photography?</h2>
            <p>Get your first images edited for free.</p>
          </div>
         <form class="newsletter-form newsletter-form--contact fade-top" action="{{ route('postcontact') }}" method="post">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Your Name *" required>
            <input type="email" name="email" class="form-control" placeholder="Email *" required>
            <input type="tel" name="phone" class="form-control" placeholder="Phone *" required>
            <textarea name="mess" class="form-control" rows="3" placeholder="Message"></textarea>
            <button type="submit" aria-label="Start Free Trial">Start Free Trial <i class="fa-regular fa-arrow-right-long"></i></button>
         </form>
      </div>
   </div>
</section>

<!-- ./ home-cta-section -->
@endsection
