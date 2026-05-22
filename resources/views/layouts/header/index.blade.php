 <!-- preloader -->
 <div class="preloader overflow-hidden">
     <div class="site-name"><span>KEN VISUAL</span></div>
     <div class="preloader-gutters">
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
         <div class="bar">
             <div class="inner-bar"></div>
         </div>
     </div>
 </div>
 <!-- /.preloader -->
 <!-- header-area-start -->
 <header class="header sticky-active">
     <div class="primary-header">
         <div class="container">
             <div class="primary-header-inner">
                 <div class="header-left-wrap">
                     <div class="header-logo d-lg-block">
                         <a href="{{route('home')}}">
                             {!! lazy_img($setting->logo, 'logo', ['width' => 200, 'eager' => true]) !!}
                         </a>
                     </div>
                     <div class="header-menu-wrap">
                         <div class="mobile-menu-items">
                             <ul>
                                 <li>
                                     <a href="{{ route('home') }}">Home</a>
                                 </li>
                                 <li class="menu-item-has-children">
                                     <a href="javascript:void(0)">Services</a>
                                     <ul>
                                         @foreach ($servicehome as $item)
                                             <li><a
                                                     href="{{ route('serviceList', ['slug' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                             </li>
                                         @endforeach
                                     </ul>
                                 </li>
                                 <li class="menu-item-has-children">
                                     <a href="javascript:void(0)">Projects</a>
                                     <ul>
                                         @foreach ($projectCate as $item)
                                            <li><a href="{{route('projectCategory',['slug'=>$item->slug])}}">{{($item->name)}}</a></li>
                                            @endforeach
                                     </ul>
                                 </li>
                                 <li class="menu-item-has-children">
                                     <a href="javascript:void(0)">Blog</a>
                                     <ul>
                                         @foreach ($blogCate as $item)
                                             <li><a
                                                     href="{{ route('listCateBlog', ['slug' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                             </li>
                                         @endforeach
                                     </ul>
                                 </li>
                                 <li><a href="{{ route('priceList') }}">Price List</a></li>
                                 <li><a href="{{ route('lienHe') }}">Contact</a></li>
                             </ul>
                         </div>
                     </div>
                     <!-- /.header-menu-wrap -->
                 </div>
                 <div class="header-right-wrap">
                     <a href="tel:{{$setting->phone1}}" class="header-contact">
                         <span class="icon"><i class="fa-regular fa-phone"></i></span>
                         <span class="content">
                             <span class="call-text">Call Us Phone</span>
                             <span class="call-number">{{$setting->phone1}}</span>
                         </span>
                     </a>
                     <div class="header-btn-wrap">
                         <a href="{{route('lienHe')}}" class="tl-primary-btn header-btn">Contact Now</a>
                     </div>
                     <div class="search-icon dl-search-icon">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </div>
                     <div class="sidebar-icon">
                         <button class="sidebar-trigger open">
                             <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M11 2C11 0.89543 11.8954 0 13 0H14C15.1046 0 16 0.895431 16 2V3C16 4.10457 15.1046 5 14 5H13C11.8954 5 11 4.10457 11 3V2Z"
                                     fill="white" />
                                 <path
                                     d="M0 2C0 0.89543 0.895431 0 2 0H3C4.10457 0 5 0.895431 5 2V3C5 4.10457 4.10457 5 3 5H2C0.89543 5 0 4.10457 0 3V2Z"
                                     fill="white" />
                                 <path
                                     d="M0 13C0 11.8954 0.895431 11 2 11H3C4.10457 11 5 11.8954 5 13V14C5 15.1046 4.10457 16 3 16H2C0.89543 16 0 15.1046 0 14V13Z"
                                     fill="white" />
                                 <path
                                     d="M11 13C11 11.8954 11.8954 11 13 11H14C15.1046 11 16 11.8954 16 13V14C16 15.1046 15.1046 16 14 16H13C11.8954 16 11 15.1046 11 14V13Z"
                                     fill="white" />
                             </svg>
                         </button>
                     </div>
                     <!-- /.header-right -->
                 </div>
             </div>
             <!-- /.primary-header-inner -->
         </div>
     </div>
 </header>
 <!-- /.Main Header -->
 <div id="popup-search-box">
     <div class="box-inner-wrap d-flex align-items-center">
         <form id="form" action="#" method="get" role="search">
             <input id="popup-search" type="text" name="s" placeholder="Type keywords here...">
         </form>
         <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
     </div>
 </div>
 <div id="sidebar-area" class="sidebar-area">
     <button class="sidebar-trigger close">
         <svg class="sidebar-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px" width="16px" height="12.7px" viewBox="0 0 16 12.7"
             style="enable-background: new 0 0 16 12.7" xml:space="preserve">
             <g>
                 <rect x="0" y="5.4" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.1569 7.5208)" width="16"
                     height="2"></rect>
                 <rect x="0" y="5.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 6.8431 -3.7929)" width="16"
                     height="2"></rect>
             </g>
         </svg>
     </button>
     <div class="side-menu-content">
         <div class="side-menu-logo">
            <a class="dark-img" href="{{route('home')}}"><img width="100" src="{{$setting->logo_footer}}" alt="logo"></a>
            <a class="light-img" href="{{route('home')}}"><img width="100" src="{{$setting->logo_footer}}" alt="logo"></a>
         </div>
         <div class="side-menu-wrap">
         </div>
         <div class="side-menu-contact">
             <ul class="side-menu-list">
                 <li>
                    {{languageName($setting->address1)}}
                 </li>
                 <li>
                     <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                 </li>
                 <li>
                     <a class="mail" href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                 </li>
             </ul>
         </div>
         <ul class="side-menu-social">
             <li class="facebook"><a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
             <li class="instagram"><a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a></li>
             <li class="twitter"><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
             <li class="g-plus"><a href="{{$setting->google}}"><i class="fab fa-fab fa-google-plus"></i></a></li>
         </ul>
     </div>
 </div>
 <div id="sidebar-overlay"></div>
 <div class="mobile-side-menu">
     <div class="side-menu-content">
         <div class="side-menu-head">
             <a href="{{route('home')}}"><img src="{{$setting->logo_footer}}"
                     alt="logo" width="150"></a>
             <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
         </div>
         <div class="side-menu-wrap"></div>
         <div class="side-menu-contact">
             <div class="side-menu-header">
                 <h3>Contact Us</h3>
             </div>
             <ul class="side-menu-list">
                 <li>
                     <i class="fas fa-map-marker-alt"></i>
                     <p>{{languageName($setting->address1)}}</p>
                 </li>
                 <li>
                     <i class="fas fa-phone"></i>
                     <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                 </li>
                 <li>
                     <i class="fas fa-envelope-open-text"></i>
                     <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                 </li>
             </ul>
         </div>
         <ul class="side-menu-social">
             <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
             <li class="instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
             <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
             <li class="g-plus"><a href="#"><i class="fab fa-fab fa-google-plus"></i></a></li>
         </ul>
     </div>
 </div>
 <!-- /.mobile-side-menu -->
 <div class="mobile-side-menu-overlay"></div>
