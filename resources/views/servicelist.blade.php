@extends('layouts.main.master')
@section('title')
{{$cateService->name}}
@endsection
@section('description')
{{$cateService->description}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
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
.form-booking .review-form-wrap .title { margin-bottom: 6px; font-weight: 600; }
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
.form-booking .booking-alert--success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
.form-booking .booking-alert--error { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
.form-booking .form-item { margin-bottom: 14px; }
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
.form-booking textarea.form-control { min-height: 100px; resize: vertical; }
.form-booking .submit-btn { margin-top: 8px; }
.form-booking .submit-btn .tl-primary-btn { width: 100%; justify-content: center; }
.form-booking .review-form-wrap .review-form { margin-top: 0; }
.form-booking select.form-control { cursor: pointer; }
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
            <h1 class="title">{{$cateService->name}}</h1>
            <h4 class="sub-title"><a class='home' href='{{route('home')}}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{route('serviceList',['slug'=>$cateService->slug])}}'> {{$cateService->name}}</a></h4>
        </div>
    </div>
</section>
<section class="service-details pt-60 pb-60">
    <div class="container container-2">
        <div class="row pin-inner">
            <div class="col-lg-8 col-md-12">
                <div class="service-details-content scroll-content">
                    {!!($cateService->content)!!}
                </div>
                <section class="service-inner pt-20 pb-20">
                    <div class="container container-2">
                        <div class="row section-heading-wrap fade-top feature-top">  
                            <div class="shape"><img src="{{url('frontend/img/section-heading.png')}}" alt="shape"></div>
                            <div class="col-lg-3 col-md-12">
                                <div class="section-heading mb-0">
                                    <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">More Services</h4>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12">
                                <div class="section-heading section-heading-2 mb-0">
                                    <h2 class="section-title cursor-effect title-2">Services Detail</h2>
                                 </div>
                            </div>
                        </div>
                        <div class="row gy-5">
                            @foreach ($list as $item)
                            <div class="col-lg-6 col-md-6">
                                <div class="service-item-3 antra-hover-view">
                                    <a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug, 'slug'=>$item->slug])}}">
                                    <div class="service-thumb">
                                        <img src="{{url(''.$item->image)}}" alt="service">
                                        <span class="number">{{$loop->iteration}}</span>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="title"><a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug, 'slug'=>$item->slug])}}">{{$item->name}}</a></h5>
                                        <p class="line_2">{!!languageName($item->description)!!}</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{$list->links()}}
                        </div>
                    </div>
                </section>
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
                    @php
                        $bookingCateName = languageName($cateService->name);
                    @endphp
                    <div class="form-booking">
						<div class="review-form-wrap">
							<h4 class="title">Booking Now</h4>
							<span class="publish">Fill in the form below to book your appointment</span>
							<span class="booking-service-badge">Service Category: {{ $bookingCateName }}</span>

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
										<input type="hidden" name="service_id" value="">
										<input type="hidden" name="service_name" value="{{ $bookingCateName }}">
										<input type="hidden" name="service_slug" value="">
										<input type="hidden" name="service_cate_slug" value="{{ $cateService->slug }}">
										<input type="hidden" name="redirect_url" value="{{ url()->current() }}">

										<div class="form-item">
											<label for="booking_cate_name">Your Name *</label>
											<input type="text" id="booking_cate_name" name="name" class="form-control" placeholder="Enter your name" required>
										</div>
										<div class="form-item">
											<label for="booking_cate_email">Email *</label>
											<input type="email" id="booking_cate_email" name="email" class="form-control" placeholder="email@example.com" required>
										</div>
										<div class="form-item">
											<label for="booking_cate_phone">Phone *</label>
											<input type="tel" id="booking_cate_phone" name="phone" class="form-control" placeholder="0xxx xxx xxx" required>
										</div>
										@if($list->count())
										<div class="form-item">
											<label for="booking_service_pick">Service Interested (optional)</label>
											<select id="booking_service_pick" name="service_pick" class="form-control">
												<option value="">— Select service in category —</option>
												@foreach($list as $svc)
												<option value="{{ languageName($svc->name) }}">{{ languageName($svc->name) }}</option>
												@endforeach
											</select>
										</div>
										@endif
										<div class="form-item message-item">
											<label for="booking_cate_mess">Message</label>
											<textarea id="booking_cate_mess" name="mess" cols="30" rows="4" class="form-control" placeholder="Mô tả nhu cầu của bạn..."></textarea>
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