@extends('layouts.main.master')
@section('title')
{{ $blog_detail->seo_title ? $blog_detail->seo_title : languageName($blog_detail->title) }}
@endsection
@section('description')
{{ $blog_detail->meta_description ? $blog_detail->meta_description : languageName($blog_detail->description) }}
@endsection
@section('image')
{{url(''.$blog_detail->image)}}
@endsection
@section('schema')
@php
    $cleanText = function ($value) {
        $text = (string) $value;
        // Remove zero-width chars that usually appear from copy/paste.
        return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
    };
    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
    $postTitle = $cleanText(languageName($blog_detail->title));
    $postDescription = $cleanText($blog_detail->meta_description ?: strip_tags(languageName($blog_detail->description)));
    $postContentText = trim($cleanText(strip_tags(languageName($blog_detail->content))));
    preg_match_all('/[\p{L}\p{N}]+/u', $postContentText, $wordMatches);
    $postWordCount = count($wordMatches[0]);
    $postUrl = url()->current();
    $homeUrl = route('home');
    $categoryUrl = route('listCateBlog', ['slug' => $blog_detail->category]);
    $siteName = $setting->webname ?? $setting->company ?? 'Website';
    $publisherName = $setting->company ?? $siteName;
    $publisherLogo = !empty($setting->logo) ? url($setting->logo) : url(''.$blog_detail->image);
@endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": {!! json_encode(url('/') . '#website', $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "name": {!! json_encode($siteName, $jsonFlags) !!}
    },
    {
      "@type": "Organization",
      "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!},
      "name": {!! json_encode($publisherName, $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "logo": {
        "@type": "ImageObject",
        "url": {!! json_encode($publisherLogo, $jsonFlags) !!}
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": {!! json_encode($postUrl . '#breadcrumb', $jsonFlags) !!},
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": {!! json_encode($homeUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
          "item": {!! json_encode($categoryUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": {!! json_encode($postTitle, $jsonFlags) !!},
          "item": {!! json_encode($postUrl, $jsonFlags) !!}
        }
      ]
    },
    {
      "@type": "BlogPosting",
      "@id": {!! json_encode($postUrl . '#article', $jsonFlags) !!},
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": {!! json_encode($postUrl, $jsonFlags) !!}
      },
      "headline": {!! json_encode($postTitle, $jsonFlags) !!},
      "description": {!! json_encode($postDescription, $jsonFlags) !!},
      "articleSection": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
      "inLanguage": "vi-VN",
      "wordCount": {{ $postWordCount }},
      "datePublished": {!! json_encode(optional($blog_detail->created_at)->toIso8601String(), $jsonFlags) !!},
      "dateModified": {!! json_encode(optional($blog_detail->updated_at)->toIso8601String(), $jsonFlags) !!},
      "image": [
        {
          "@type": "ImageObject",
          "url": {!! json_encode(url(''.$blog_detail->image), $jsonFlags) !!}
        }
      ],
      "author": {
        "@type": "Person",
        "name": {!! json_encode($cleanText($blog_detail->author ?: 'Admin'), $jsonFlags) !!}
      },
      "publisher": {
        "@type": "Organization",
        "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!}
      }
    }
  ]
}
</script>
@endsection
@section('css')
<style>
@media (min-width: 992px) {
    .blog-details .blog-details-sidebar.pin-box {
        align-self: flex-start;
    }
}
@media (max-width: 991px) {
    .blog-details .blog-details-sidebar.pin-box {
        position: static !important;
    }
}
</style>
@endsection
@section('js')
@endsection
@section('content')
<section class="page-header">
    <div class="bg-img bg-eager" data-background="{{ static_bg('frontend/img/page-header-bg.png') }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">{{languageName($blog_detail->title)}}</h1>
            <h4 class="sub-title">
                <a class='home' href='{{route('home')}}'>Home </a>
				<span class="icon">-</span>
                <a href='{{route('listCateBlog',['slug'=>$blog_detail->cate->slug])}}'> {{languageName($blog_detail->cate->name)}}</a>
                <span class="icon">-</span>
				<a class='inner-page' href='{{route('detailBlog',['slug'=>$blog_detail->slug])}}'> {{languageName($blog_detail->title)}}</a></h4>
        </div>
    </div>
</section>

<section class="blog-details pt-50 pb-50 overflow-hidden">
    <div class="container container-2">
        <div class="row gy-5 pin-inner">
            <div class="col-lg-8 col-md-12">
                <div class="blog-details-wrap scroll-content">
                    <div class="post-card post-card-2 inner-post">
                        <div class="post-content">
                            <ul class="post-meta">
                                <li class="category">{{languageName($blog_detail->cate->name)}}</li>
                                <li>{{date_format($blog_detail->created_at,'d/m/Y')}}</li>
                                <li>By <span>Admin</span></li>
                            </ul>
                            <h2>{{languageName($blog_detail->title)}}</h2>
                        </div>
                    </div>
                    <div class="blog-details-img mb-30">
                        {!! lazy_img($blog_detail->image, languageName($blog_detail->title), ['eager' => true]) !!}
                    </div>
                    <div class="blog-details-content">
                        {!!languageName($blog_detail->content)!!}
                    </div>
                </div>
            </div>
            <!-- Sidebar Widgets -->
            <div class="col-lg-4 col-md-12">
                <div class="blog-details-sidebar pin-box">
                <div class="sidebar-widget">
                    <h3 class="widget-title">Our Service</h3>
                    <ul class="category-list">
                        @foreach ($servicehome as $item)
                        <li><a href="{{ route('serviceList', ['slug' => $item->slug]) }}">{{($item->name)}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="sidebar-widget">
                    <h3 class="widget-title">Recent Post</h3>
                    @foreach ($bloglq as $item)
                    <div class="sidebar-post">
                        <img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}">
                        <div class="post-content">
                            <ul class="post-meta">
                                <li>{{date_format($item->created_at,'d/m/Y')}}</li>
                            </ul>
                            <h3 class="title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h3>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection