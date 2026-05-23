@extends('layouts.main.master')
@section('title')
{{($detail_service->name)}}
@endsection
@section('description')
{{($detail_service->description)}}
@endsection
@section('image')
{{url(''.$detail_service->image)}}
@endsection
@section('css')
<style>
.form-booking {
    margin-top: 28px;
    padding: 28px 24px;
    background: #fff;
    border: 1px solid rgba(0,0,0,.08);
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,.06);
}
.form-booking .review-form-wrap .title {
    margin-bottom: 6px;
    font-weight: 600;
}
.form-booking .review-form-wrap .publish {
    color: var(--tl-color-text-body, #666);
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 16px;
}
.form-booking .booking-service-badge {
    display: inline-block;
    font-size: 13px;
    font-weight: 500;
    color: var(--tl-color-theme-primary, #c9a227);
    background: rgba(201,162,39,.1);
    border-radius: 6px;
    padding: 6px 12px;
    margin-bottom: 18px;
}
.form-booking .booking-alert {
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 16px;
}
.form-booking .booking-alert--success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
}
.form-booking .booking-alert--error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ffcdd2;
}
.form-booking .form-item {
    margin-bottom: 14px;
}
.form-booking .form-item label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 6px;
    color: var(--tl-color-heading-primary, #1a1a1a);
}
.form-booking .form-control {
    width: 100%;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 15px;
    background: #fafafa;
    transition: border-color .2s, box-shadow .2s;
}
.form-booking .form-control:focus {
    outline: none;
    border-color: var(--tl-color-theme-primary, #c9a227);
    box-shadow: 0 0 0 3px rgba(201,162,39,.15);
    background: #fff;
}
.form-booking textarea.form-control {
    min-height: 100px;
    resize: vertical;
}
.form-booking .submit-btn {
    margin-top: 8px;
}
.form-booking .submit-btn .tl-primary-btn {
    width: 100%;
    justify-content: center;
}
.form-booking .review-form-wrap .review-form {
    margin-top: 0;
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
            <h1 class="title">{{$detail_service->name}}</h1>
            <h4 class="sub-title"><a class='home' href='{{route('home')}}'>Home </a>
				<span class="icon">-</span>
				<a class='inner-page' href='{{route('serviceList',['slug'=>$detail_service->cate_slug])}}'> {{$detail_service->cate->name}}</a></h4>
        </div>
    </div>
</section>
<section class="service-details pt-60 pb-60">
    <div class="container">
        <div class="row pin-inner">
            <div class="col-lg-8 col-md-12">
                <div class="service-details-content scroll-content">
                    {!!languageName($detail_service->content)!!}
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="service-details-left-content pin-box">
                    <div class="service-category-list">
                        <h3 class="list-title">Other Services</h3>
                        <ul>
                            @foreach ($servicehome as $item)
                            <li class="{{request()->get('slug') == $item->slug ? 'active' : '' }}"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
					@php $bookingServiceName = languageName($detail_service->name); @endphp
					<div class="form-booking">
						<div class="review-form-wrap">
							<h4 class="title">Booking Now</h4>
							<span class="publish">Fill in the form below to book your appointment</span>
							<span class="booking-service-badge">Service: {{ $bookingServiceName }}</span>

							@if(session('success'))
							<div class="booking-alert booking-alert--success">{{ session('success') }}</div>
							@endif
							@if(session('error'))
							<div class="booking-alert booking-alert--error">{{ session('error') }}</div>
							@endif

							<div class="blog-contact-form form-2 review-form">
								<div class="request-form">
									<form action="{{ route('postcontact') }}" method="post" class="service-booking-form">
										@csrf
										<input type="hidden" name="service_id" value="{{ $detail_service->id }}">
										<input type="hidden" name="service_name" value="{{ $bookingServiceName }}">
										<input type="hidden" name="service_slug" value="{{ $detail_service->slug }}">
										<input type="hidden" name="service_cate_slug" value="{{ $detail_service->cate_slug }}">
										<input type="hidden" name="redirect_url" value="{{ url()->current() }}">

										<div class="form-item">
											<label for="booking_name">Your Name *</label>
											<input type="text" id="booking_name" name="name" class="form-control" placeholder="Enter your name" required>
										</div>
										<div class="form-item">
											<label for="booking_email">Email *</label>
											<input type="email" id="booking_email" name="email" class="form-control" placeholder="email@example.com" required>
										</div>
										<div class="form-item">
											<label for="booking_phone">Phone *</label>
											<input type="tel" id="booking_phone" name="phone" class="form-control" placeholder="0xxx xxx xxx" required>
										</div>
										<div class="form-item message-item">
											<label for="booking_mess">Message</label>
											<textarea id="booking_mess" name="mess" cols="30" rows="4" class="form-control" placeholder="Describe your request..."></textarea>
										</div>
										<div class="submit-btn">
											<button class="tl-primary-btn" type="submit">
												Send Request
												<span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
                    <div class="service-details-cta">
                        <div class="cta-bg" data-background="{{url('frontend/img/service-cta-bg-2.png')}}"></div>
                        <div class="icon"><img src="{{url('frontend/img/service-details-cta.png')}}" alt="icon"></div>
                        <span>Do You Need Help?</span>
                        <a class="number" href="tel:{{$setting->phone1}}">+({{$setting->phone1}})</a>
                        <a class="mail" href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                        <div class="cta-btn">
                            <a href="tel:{{$setting->phone1}}">Get a call <br> Back</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection
