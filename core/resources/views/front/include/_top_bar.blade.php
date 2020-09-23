<div id="top-bar" style="background-color: #007dc2 !important;">

    <div class="container clearfix">

        <div class="col_half nobottommargin">

            <!-- Top Links
            ============================================= -->
            
            <div class="top-links">
                <ul class="sf-js-enabled clearfix" style="touch-action: pan-y;">
                    <li><a href="{{ url('language/id') }}" class="{{ $locale=='id' ? 'text-yellow' : 'text-white' }}">ID</a></li>
                    <li><a href="{{ url('language/en') }}" class="{{ $locale=='en' ? 'text-yellow' : 'text-white' }}">EN</a></li>
                </ul>
            </div><!-- .top-links end -->

        </div>

        <div class="col_half fright col_last nobottommargin">

            <!-- Top Social
            ============================================= -->
            <div id="top-social">
               
                <ul>
                    @foreach ($social_media as $sm)
                    <li><a href="{{ $sm->url }}" target="_blank" class="si-{{ $sm->flag }} text-white" data-hover-width="108.625"
                        style="width: 40px;"><span class="ts-icon"><i class="icon-{{ $sm->flag }}"></i></span><span
                            class="ts-text">{{ ucfirst($sm->flag) }}</span></a></li>
                    @endforeach
                  
                    <li><a href="{{ route('kontak.faq') }}" class="text-white"
                            style="width: 40px;"><img width="90%" src="{{ asset('front/gambar/faq.png') }}" alt=""></a></li>
                </ul>
            </div><!-- #top-social end -->

        </div>

    </div>

</div>