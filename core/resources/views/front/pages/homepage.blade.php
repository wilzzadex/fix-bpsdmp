@extends('front.master')
@section('custom-css')
    <style>
        .swiper-slide {
        opacity: .65;
        }
        /* .swiper-slide-visible {
        opacity: 1;
        } */
        /* .swiper-slide.container{
            opacity: .90;
        } */
    </style>
@endsection
@section('content')
<section id="slider" class="slider-element slider-parallax swiper_wrapper clearfix slider-parallax-visible" style="transform: translateY(0px);" data-autoplay="6000" data-loop="true" >
    <!-- <section id="slider" class="slider-element slider-parallax swiper_wrapper clearfix" > -->
        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                @foreach ($slider as $slider)
                <div class="swiper-slide dark" style="background-image: url('{{ asset('file_app/slider_image/'.$slider->img) }}');">
                    <div class="container clearfix">
                        <div class="slider-caption text-white">
                            @php
                                $judul = $slider->judul_id;
                                if(Session::has('locale')){
                                    if(Session::get('locale') == 'id'){
                                        $judul = $slider->judul_id;
                                    }else{
                                        if(!empty($slider->judul_en)){
                                            $judul = $slider->judul_en;
                                        }else{
                                            $judul = $slider->judul_id;
                                        }
                                        
                                    }
                                }
                            @endphp
                            <h2 data-animate="fadeInUp" class="text-white"> {{ $judul }}</h2>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
            <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
            <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
            <div class="slide-number">
                <div class="slide-number-current"></div><span>/</span>
                <div class="slide-number-total"></div>
            </div>
        </div>

    </section>
    <section id="content">

        <!-- <div class="content-wrap"> -->

        <div class="row sicon">
            <div class="col-md-3 text-center">
                <a href="{{ route('profil.regulasi') }}"><img src="{{ asset('front/icon/file.png') }}" style="width: 40px; padding-top: 30px;" alt=""></a>
                <p>@lang('homepage.regulasi')</p>
            </div>
            <div class="col-md-3 text-center">
            <a href="{{ route('profil.kerja') }}"><img src="{{ asset('front/icon/clip.png') }}" style="width: 40px; padding-top: 30px;" alt=""></a>
                <p>@lang('homepage.kerja_sama')</p>
            </div>
            <div class="col-md-3 text-center">
                <img src="{{ asset('front/icon/bigdata.png') }}" style="width: 40px; padding-top: 30px;" alt="">
                <p>Laporan Diklat SDM Perhubungan</p>
            </div>
            <div class="col-md-3 text-center">
                <img src="{{ asset('front/icon/penerimaan.png') }}" style="width: 40px; padding-top: 30px;" alt="">
                <p>@lang('homepage.penerimaan')</p>
            </div>
            
        </div>


        <!-- </div> -->

    </section>

    

    <section id="content" style="margin-bottom: 0px;height: 330px; background-color: #F1F4FC;">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="heading-block border-color center" style="margin-top: -50px !important;">
                    <h3>
                        @lang('homepage.sekolah_kedinasan') </h3>
                    <!-- <span>Some of the Awesome Projects we've worked on.</span> -->
                </div>

                <!-- Portfolio Filter
                ============================================= --
                <!-- Portfolio Items
                ============================================= -->
                <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="30"
                    data-nav="false" data-items-xs="1" data-items-sm="2" data-items-md="3"
                    data-items-xl="3">

                    <div class="oc-item">
                        <div class="iportfolio">
                            <div class="portfolio-image ">
                                <a href="{{ route('sekolah.matra','matra-darat') }}">
                                    <center><img style="width: 100px;"
                                            src="{{ asset('front/gambar/suv.png') }}"></center>
                                </a>
                            </div>
                            <div class="portfolio-desc">
                                <center>
                                    <h5 style="font-size: 17px;">@lang('homepage.darat')</h5>
                                </center>

                            </div>
                        </div>
                    </div>
                    <div class="oc-item">
                        <div class="iportfolio">
                            <div class="portfolio-image ">
                                <a href="{{ route('sekolah.matra','matra-laut') }}">
                                    <center><img style="width: 100px;"
                                            src="{{ asset('front/gambar/ship.png') }}"
                                            alt="Console Activity"></center>
                                </a>
                            </div>
                            <div class="portfolio-desc">
                                <center>
                                    <h5 style="font-size: 17px;">@lang('homepage.laut')</h5>
                                </center>

                            </div>
                        </div>
                    </div>
                    <div class="oc-item">
                        <div class="iportfolio">
                            <div class="portfolio-image ">
                                <a href="{{ route('sekolah.matra','matra-udara') }}">
                                    <center><img style="width: 100px;"
                                            src="{{ asset('front/gambar/army.png') }}"
                                            alt="Console Activity"></center>
                                </a>
                            </div>
                            <div class="portfolio-desc">
                                <center>
                                    <h5 style="font-size: 17px;">@lang('homepage.udara')</h5>
                                </center>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-md-6">
                        <div class="heading-block border-color center">
                            <h4>@lang('homepage.galeri_foto')</h4>
                        </div>
                        <!-- galeri foto -->
                        <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget"
                            data-margin="30" data-nav="false"  data-items-xs="1"
                            data-items-sm="2" data-items-md="2" data-items-xl="2">

                            @foreach ($galeri as $galeri)
                            @php
                                $d_foto = DB::table('gallery')->where('relasi',1)->where('relasi_id',$galeri->id)->first();
                            @endphp
                            <div class="oc-item">
                                <div class="iportfolio">
                                    <div class="portfolio-image ">
                                        <a href="{{ route('galeri.foto.detail',$galeri->slug) }}">
                                            <center><img class="custom-img"
                                                    src="{{ asset('file_app/galeri/galeri_foto/'.$d_foto->img) }}"></center>
                                        </a>
                                    </div>
                                    <div class="portfolio-desc">
                                        <div class="entry-title">
                                            <h3><a href="{{ route('galeri.foto.detail',$galeri->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $galeri->judul_id : ( (!empty($galeri->judul_en)) ? $galeri->judul_en : $galeri->judul_id ) : $galeri->judul_id }}
                                                </a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                           
                           

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="heading-block border-color center">
                            <h4>@lang('homepage.galeri_video')</h4>
                        </div>
                        <!-- Galeri Video -->
                        <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget"
                            data-margin="30" data-nav="false" data-items-xs="1"
                            data-items-sm="2" data-items-md="2" data-items-xl="2">

                            @foreach ($video as $video)
                            @php
                                $url = explode("watch?v=",$video->url_video);
                                $url_video = $url[1];
                            @endphp
                            <div class="oc-item">
                                <div class="iportfolio">
                                    <div class="portfolio-image ">
                                        <a href="portfolio-single.html">
                                            <center>
                                                <div style="height: 190px;" class="fluid-width-video-wrapper" style="padding-top: 56.25%;">
                                                    <iframe src="http://www.youtube.com/embed/{{ $url_video }}" frameborder="0" allowfullscreen="" id="fitvid1"></iframe>
                                                </div>
                                            </center>
                                        </a>
                                    </div>
                                    <div class="portfolio-desc">
                                        <div class="entry-title">
                                            <h3><a href="{{ route('galeri.video.preview',$video->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $video->judul_id : ( (!empty($video->judul_en)) ? $video->judul_en : $video->judul_id ) : $video->judul_id }}
                                                </a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="content" style="margin-bottom: 0px; ">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="heading-block border-color center">
                    <h3>
                        @lang('homepage.publish') </h3>
                </div>

                <div class="tabs tabs-alt tabs-justify clearfix" id="tab-10">

                    <ul class="tab-nav clearfix">
                        <li><a href="#tabs-37">@lang('homepage.berita')</a></li>
                        <li><a href="#tabs-38">@lang('homepage.pers')</a></li>
                        <li><a href="#tabs-39">@lang('homepage.infografis')</a></li>
                        <!-- <li class="hidden-phone"><a href="#tabs-40">Aen/ean lacinia</a></li> -->
                    </ul>

                    <div class="tab-container">

                        <div class="tab-content clearfix" id="tabs-37">
                            <div class="row">
                                @foreach ($berita as $beritas)
                                @php
                                    $tmp_id = strip_tags($beritas->deskripsi_id);
                                    $tmp_en = strip_tags($beritas->deskripsi_en);
                                @endphp
                                    @if ($beritas->is_youtube == 1)
                                    <div class="col-md-4">
                                        <article class="entry entry-custom">
                                            <div class="ipost clearfix">
                                                <div class="entry-image">
                                                    @php
                                                        $video = explode("watch?v=",$beritas->media);
                                                        $video_url = $video[1];
                                                        // dd($video);
                                                    @endphp
                                                    <iframe src="https://www.youtube.com/embed/{{ $video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <div class="entry-title">
                                                    <h3><a href="{{ route('publikasi.berita.detail',$beritas->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $beritas->judul_id : ( (!empty($beritas->judul_en)) ? $beritas->judul_en : $beritas->judul_id ) : $beritas->judul_id }}
                                                    </a></h3>
                                                </div>
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($beritas->tanggal_awal)) }}</li>
                                                    <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                                                </ul>
                                                <div class="entry-content">
                                                    <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</p>
                                                </div>
                                                <a href="{{ route('publikasi.berita.detail',$beritas->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                                            </div>
                                        </article>
                                    </div>  
                                    @else 
                                    <div class="col-md-4">
                                        <article class="entry entry-custom">
                                            <div class="ipost clearfix">
                                                <div class="entry-image">
                                                    <a href="{{ asset('file_app/berita_image/'.$beritas->media) }}"
                                                    data-lightbox="image"><img class="image_fade custom-img"
                                                        src="{{ asset('file_app/berita_image/'.$beritas->media) }}"></a>
                                                </div>
                                                <div class="entry-title">
                                                    <h3><a href="{{ route('publikasi.berita.detail',$beritas->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $beritas->judul_id : ( (!empty($beritas->judul_en)) ? $beritas->judul_en : $beritas->judul_id ) : $beritas->judul_id }}
                                                    </a></h3>
                                                </div>
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($beritas->tanggal_awal)) }}</li>
                                                    <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                                                </ul>
                                                <div class="entry-content">
                                                    <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,120).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .')  }}</p>
                                                </div>
                                                <a href="{{ route('publikasi.berita.detail',$beritas->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                                            </div>
                                        </article>
                                    </div>
                                    @endif
                            
                                @endforeach

                               
                            </div>
                        </div>
                        <div class="tab-content clearfix" id="tabs-38">
                            <div class="row">

                               
                                    @foreach ($pers as $pers)
                                    @php
                                        $tmp_id = strip_tags($pers->deskripsi_id);
                                        $tmp_en = strip_tags($pers->deskripsi_en);
                                    @endphp
                                        @if ($pers->is_youtube == 1)
                                        <div class="col-md-4">
                                            <article class="entry entry-custom">
                                                <div class="ipost clearfix">
                                                    <div class="entry-image">
                                                        @php
                                                            $video = explode("watch?v=",$pers->media);
                                                            $video_url = $video[1];
                                                            // dd($video);
                                                        @endphp
                                                        <iframe src="https://www.youtube.com/embed/{{ $video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="entry-title">
                                                        <h3><a href="{{ route('publikasi.pers.detail',$pers->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $pers->judul_id : ( (!empty($pers->judul_en)) ? $pers->judul_en : $pers->judul_id ) : $pers->judul_id }}
                                                        </a></h3>
                                                    </div>
                                                    <ul class="entry-meta clearfix">
                                                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($pers->tanggal_awal)) }}</li>
                                                        <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                                                    </ul>
                                                    <div class="entry-content">
                                                        <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</p>
                                                    </div>
                                                    <a href="{{ route('publikasi.pers.detail',$pers->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                                                </div>
                                            </article>
                                        </div>  
                                        @else 
                                        <div class="col-md-4">
                                            <article class="entry entry-custom">
                                                <div class="ipost clearfix">
                                                    <div class="entry-image">
                                                        <a href="{{ asset('file_app/pers_image/'.$pers->media) }}"
                                                        data-lightbox="image"><img class="image_fade custom-img"
                                                            src="{{ asset('file_app/pers_image/'.$pers->media) }}"></a>
                                                    </div>
                                                    <div class="entry-title">
                                                        <h3><a href="{{ route('publikasi.pers.detail',$pers->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $pers->judul_id : ( (!empty($pers->judul_en)) ? $pers->judul_en : $pers->judul_id ) : $pers->judul_id }}
                                                        </a></h3>
                                                    </div>
                                                    <ul class="entry-meta clearfix">
                                                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($pers->tanggal_awal)) }}</li>
                                                        <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                                                    </ul>
                                                    <div class="entry-content">
                                                        <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,120).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .')  }}</p>
                                                    </div>
                                                    <a href="{{ route('publikasi.pers.detail',$pers->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                                                </div>
                                            </article>
                                        </div>
                                        @endif
                                   
                                    @endforeach
                               
                            </div>
                        </div>
                        <div class="tab-content clearfix" id="tabs-39">
                            <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget"
                                data-margin="30" data-nav="false" data-autoplay="5000" data-items-xs="1"
                                data-items-sm="2" data-items-md="3" data-items-xl="3">
                                @foreach ($infografis as $infos)
                                <div class="oc-item">
                                    <div class="iportfolio">

                                        <div class="portfolio-image">
                                            <a href="#">
                                                <img width="" class="custom-img" src="{{ asset('file_app/infografis_image/'.$infos->media) }}" alt="Open Imagination">
                                            </a>
                                            <div class="portfolio-overlay">
                                                <a href="{{ asset('file_app/infografis_image/'.$infos->media) }}" class="left-icon" data-lightbox="image"><i
                                                        class="icon-eye"></i></a>
                                                <a target="_blank" href="{{ asset('file_app/infografis_image/'.$infos->media) }}" class="right-icon" download><i
                                                        class="icon-download"></i></a>
                                            </div>
                                        </div>
                                        <div class="portfolio-desc">
                                            <h3><a href="portfolio-single.html">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $infos->judul_id : ( (!empty($infos->judul_en)) ? $infos->judul_en : $infos->judul_id ) : $infos->judul_id  }}</a></h3>
                                            <!-- <span><a href="#">UI Elements</a>, <a href="#">Media</a></span> -->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>


                    </div>

                </div>


            </div>
            <div class="container">

            </div>
        </div>
    </section>

    <!-- SOSIAL MEDIA -->
    <section id="content" style="margin-bottom: 0px;">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Posts
                ============================================= -->
                <div id="posts" class="post-grid grid-container post-masonry grid-3 clearfix"
                    style="position: relative; height: 1890.71px;">


                    <div class="entry clearfix" style="position: absolute; left: 0px; top: 0px;">
                        <div class="heading-block border-color center">
                            <h4 style="color: black !important;">
                                Facebook </h4>
                        </div>
                        <div class="entry-image">
                            <div class="fb-page" data-href="https://www.facebook.com/bpsdmkemenhub/"
                                data-tabs="timeline" data-width="" data-height="" data-small-header="false"
                                data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/bpsdmkemenhub/"
                                    class="fb-xfbml-parse-ignore"><a
                                        href="https://www.facebook.com/bpsdmkemenhub/">Bpsdm Perhubungan</a>
                                </blockquote>
                            </div>
                        </div>

                    </div>

                    <div class="entry clearfix" style="position: absolute; left: 0px; top: 0px;">
                        <div class="heading-block border-color center">
                            <h4 style="color: black !important;">
                                Instagram </h4>
                        </div>
                        <div class="entry-image">
                            <blockquote class="instagram-media"
                                data-instgrm-permalink="https://www.instagram.com/p/CB2m1eND95h/?utm_source=ig_embed&amp;utm_campaign=loading"
                                data-instgrm-version="12"
                                style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                                <div style="padding:16px;"> <a
                                        href="https://www.instagram.com/p/CB2m1eND95h/?utm_source=ig_embed&amp;utm_campaign=loading"
                                        style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                        target="_blank">
                                        <div style=" display: flex; flex-direction: row; align-items: center;">
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                                </div>
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding: 19% 0;"></div>
                                        <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                            <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                                xmlns="https://www.w3.org/2000/svg"
                                                xmlns:xlink="https://www.w3.org/1999/xlink">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-511.000000, -20.000000)"
                                                        fill="#000000">
                                                        <g>
                                                            <path
                                                                d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div style="padding-top: 8px;">
                                            <div
                                                style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                                View this post on Instagram</div>
                                        </div>
                                        <div style="padding: 12.5% 0;"></div>
                                        <div
                                            style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                            <div>
                                                <div
                                                    style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                                </div>
                                                <div
                                                    style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                                </div>
                                                <div
                                                    style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                                </div>
                                            </div>
                                            <div style="margin-left: 8px;">
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                                </div>
                                                <div
                                                    style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                                </div>
                                            </div>
                                            <div style="margin-left: auto;">
                                                <div
                                                    style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                                </div>
                                                <div
                                                    style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                                </div>
                                                <div
                                                    style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                            <div
                                                style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                            </div>
                                            <div
                                                style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                            </div>
                                        </div>
                                    </a>
                                    <p
                                        style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                        <a href="https://www.instagram.com/p/CB2m1eND95h/?utm_source=ig_embed&amp;utm_campaign=loading"
                                            style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                            target="_blank">A post shared by BPSDM PERHUBUNGAN (Official)
                                            (@bpsdmp151)</a> on <time
                                            style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;"
                                            datetime="2020-06-25T09:35:12+00:00">Jun 25, 2020 at 2:35am PDT</time>
                                    </p>
                                </div>
                            </blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
                        </div>
                    </div>

                    <div class="entry clearfix" style="position: absolute; left: 0px; top: 0px;">
                        <div class="heading-block border-color center">
                            <h4 style="color: black !important;">
                                Twitter </h4>
                        </div>
                        <div class="entry-image">
                            <a class="twitter-timeline" data-height="500"
                                href="https://twitter.com/BPSDMP151?ref_src=twsrc%5Etfw">Tweets by BPSDMP151</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>

                    </div>

                </div><!-- #posts end -->

            </div>

        </div>

    </section>

    @include('front.include._modals')

@endsection
