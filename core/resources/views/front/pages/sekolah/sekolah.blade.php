@extends('front.master')
@section('content')
    

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.sekolah_kedinasan')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.sekolah_kedinasan')</li>
        </ol>
    </div>

</section>

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Portfolio Filter
            ============================================= -->
            <ul class="portfolio-filter clearfix" data-container="#portfolio">

        

            <li class="activeFilter"><a href="#" data-filter="*">Semua</a></li>
            @foreach ($matra as $matra)
                <li><a href="#" data-filter=".pf-{{ $matra->slug }}" style="text-transform: capitalize">{{ $matra->nama }}</a></li>
            @endforeach
           
           

            </ul><!-- #portfolio-filter end -->

            <div class="portfolio-shuffle" data-container="#portfolio">
                <i class="icon-random"></i>
            </div>

            <div class="clear"></div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="portfolio grid-container clearfix">


                @foreach ($sekolah as $sekolah)
              
                <article class="portfolio-item pf-{{ $sekolah->matra->slug }}">
                    <div class="portfolio-image custom-img2">
                        <a href="sekolah_detail.html">
                            <img src="{{ asset('file_app/logo_sekolah/'.$sekolah->logo) }}" class="custom-img2" alt="no image">
                        </a>
                        <div class="portfolio-overlay">
                            <a href="{{ $sekolah->website }}" target="_blank" class="center-icon"><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ route('sekolah.detail',$sekolah->slug) }}">{{ $sekolah->singkatan }}
                        </a></h3>
                        {{-- <span> <i class="fa fa-map-marker" aria-hidden="true"></i> Medan</span> --}}
                    </div>
                </article>
                @endforeach
                

            </div><!-- #portfolio end -->

        </div>

    </div>

</section>


@endsection

@section('custom-script')

    <script>

        var $container = $('#portfolio');

        // $(document).ready(function(){
		// 	var selector = '.pf-darat';
		// 	$container.isotope({ filter: selector });
		// 	return false;
        // })

        // $('#portfolio-filter a').click(function(){
			
		// });
    </script>
    
@endsection