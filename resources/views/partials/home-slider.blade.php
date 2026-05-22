@if($banner->count())
<section class="slider-section overflow-hidden">
   <div class="antra-slider swiper-container">
      <div class="swiper-wrapper">
         @foreach($banner as $slide)
         @php
            $youtubeId = $slide->isYoutube() ? $slide->youtube_id : null;
            $ctaLink = $slide->link ?: '#';
            $youtubeEmbed = $youtubeId
               ? 'https://www.youtube.com/embed/' . $youtubeId . '?autoplay=1&mute=1&loop=1&playlist=' . $youtubeId . '&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1'
               : null;
         @endphp
         <div class="swiper-slide">
            <div class="slider-item">
               @if($youtubeId)
               <div class="bg-video-youtube">
                  @if(!empty($slide->image))
                  <div class="bg-img bg-video-poster {{ $loop->first ? 'bg-eager' : '' }}" data-background="{{ url($slide->image) }}"></div>
                  @endif
                  <iframe
                     src="{{ $youtubeEmbed }}"
                     title="{{ $slide->title ?: 'Banner video' }}"
                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                     allowfullscreen
                  ></iframe>
               </div>
               @elseif(!empty($slide->image))
               <div class="bg-img {{ $loop->first ? 'bg-eager' : '' }}" data-background="{{ url($slide->image) }}"></div>
               @endif
               <div class="container slider-container">
                  <div class="slider-content-wrap">
                     <div class="slider-content">
                        @if($slide->title || $slide->description || $slide->link)
                        <div class="section-heading white-content">
                           <h4 class="sub-heading" data-animation="antra-fadeInDown" data-delay="1000ms" data-duration="1400ms">LUXURY PROPERTY VISUALS</h4>
                           @if($slide->title)
                           <h2 class="section-title cursor-effect" data-animation="antra-fadeInDown" data-delay="1200ms" data-duration="1400ms">{!! $slide->title !!}</h2>
                           @endif
                        </div>
                        <div class="bottom-content">
                           @if($slide->description)
                           <div class="antra-desc" data-animation="antra-fadeInUp" data-delay="1000ms" data-duration="1400ms">
                              <p>{!! nl2br(e($slide->description)) !!}</p>
                           </div>
                           
                           @endif
                           @if($slide->link)
                           <div class="antra-btn d-flex gap-2" data-animation="antra-fadeInUp" data-delay="1200ms" data-duration="1400ms">
                              <a href="{{ route('lienHe') }}" class="tl-primary-btn white-btn">Free Test Edit<span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                              <a href="{{ $ctaLink }}" target="_blank" class="tl-primary-btn white-btn">View Portfolio<span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                           </div>
                           @endif
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif
<!-- ./ slider-section -->
