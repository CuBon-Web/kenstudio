@extends('layouts.main.master')
@section('title')
Contact Us
@endsection
@section('description')
Contact Us
@endsection
@section('image')
    {{ url('' . $setting->logo) }}
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
            <h1 class="title">Contact Us</h1>
            <h4 class="sub-title">
                <a class='home' href='{{route('home')}}'>Home </a>
                <span class="icon">-</span>
				<a class='inner-page' href='{{route('lienHe')}}'> Contact Us</a></h4>
        </div>
    </div>
</section>
<section class="contact-section pt-50 pb-50">
    <div class="container container-2">
        <div class="row section-heading-wrap w-100 ml-0">  
            <div class="shape"><img src="/frontend/img/section-heading.png" alt="shape"></div>
            <div class="col-lg-4 col-md-12">
                <div class="section-heading mb-0">
                    <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">get in touch</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="section-heading section-heading-2 mb-0">
                    <h2 class="section-title title-2">Have a Project in <span>Mind? Let’s <br> Make</span> It Happen</h2>
                </div>
            </div>
        </div>
        <div class="row request-wrap contact-page-area">
            <div class="col-lg-6">
                <div class="request-content">
                    <div class="request-item-wrap">
                        <div class="request-item white-content">
                            <span>Address</span>
                            <p>{{languageName($setting->address1)}}</p>
                        </div>
                        <div class="request-item white-content">
                            <span>Support</span>
                            <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                            <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                        </div>
                    </div>
                    <div class="contact-img">
                        <img src="frontend/img/contact-img-1.png" alt="img">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="request-form-wrap">
                    <form action="{{route('postcontact')}}" method="post" id="ajax_contact" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-item">
                                    <h4 class="form-title">Full Name *</h4>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Designer">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-item">
                                    <h4 class="form-title">phone *</h4>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="{{$setting->phone1}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-item">
                                    <h4 class="form-title">Email Address *</h4>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="{{$setting->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-item">
                                    <h4 class="form-title">Services *</h4>
                                    <select name="service_id" id="service_id" class="form-control">
                                        <option value="">Select Service</option>
                                        @foreach ($servicehome as $item)
                                            <option value="{{$item->id}}">{{languageName($item->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-item message-item">
                                    <h4 class="form-title">Write Message *</h4>
                                    <textarea id="mess" name="mess" cols="30" rows="5" class="form-control address" placeholder="Your message.."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="submit-btn">
                            <button id="submit" class="tl-primary-btn" type="submit">Send Message <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./ contact-section -->

<div class="map-wrapper pb-150">
    <div class="container">
        {!!$setting->iframe_map!!}
    </div>
</div>
@endsection
