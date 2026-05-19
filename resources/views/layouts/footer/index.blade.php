<footer class="footer-section overflow-hidden">
    <div class="footer-bg" data-background="{{ static_bg('frontend/img/footer-bg.png') }}"></div>
    <div class="footer-shade"></div>
    <div class="container container-2">
       <div class="row footer-wrap">
          <div class="col-lg-3 col-md-6">
             <div class="footer-widget">
                <div class="widget-header">
                   <div class="footer-logo">
                      <a href="{{route('home')}}">{!! lazy_img($setting->logo, 'logo', ['width' => 200, 'lazy' => true]) !!}</a>
                   </div>
                </div>
                <p class="mb-10">{{languageName($setting->company)}}</p>
                <p class="mb-0">{{languageName($setting->address1)}}</p>
             </div>
          </div>
          <div class="col-lg-3 col-md-6">
             <div class="footer-widget footer-col-2">
                <ul class="footer-list">
                   @foreach ($servicehome as $item)
                   <li><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                   @endforeach
                   <li><a href="{{route('lienHe')}}">Contact Us</a></li>
                </ul>
             </div>
          </div>
          <div class="col-lg-3 col-md-6">
             <div class="footer-widget footer-col-2 pl-0">
                <ul class="footer-list">
                   <li><a href="">Our Projects</a></li>
                   @foreach ($projectCate as $item)
                   <li><a href="{{route('projectCategory',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                   @endforeach
                </ul>
             </div>
          </div>
          <div class="col-lg-3 col-md-6">
             <div class="footer-widget">
                <div class="footer-address">
                   <a class="number" href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                   <a class="mail" href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                  
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="copyright-area">
       <div class="container">
          <div class="copyright-content">
             <p>© 2025 KEN VISUALS. All Rights Reserved.</p>
          </div>
       </div>
    </div>
 </footer>