@extends('front.master')
@section('custom-css')
    <style>
        .custom-img3 {
            min-height: 400px;
            max-height: 400px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
<section id="page-title" class="page-title-mini">

    <div class="container clearfix">
        <h1>{{ $sekolah->singkatan }}</h1>
        <!-- <span>Everything you need to know about our Company</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.sekolah_kedinasan')</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sekolah->singkatan }}</li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix" style="margin-top: -60px">
            <div class="col_full">
                @if ($galeri != 'no')
                <div class="fslider" data-animation="fade" data-thumbs="true" data-arrows="false" data-speed="1200" data-pause="7000">
					<div class="flexslider">
						<div class="slider-wrap" data-lightbox="gallery">
                            @foreach ($galeri as $galeri)
							<div class="slide" data-thumb="{{ asset('file_app/galeri/galeri_sekolah/'.$galeri->img) }}">
								<a href="{{ asset('file_app/galeri/galeri_sekolah/'.$galeri->img) }}" data-lightbox="gallery-item">
									<img class="custom-img3" src="{{ asset('file_app/galeri/galeri_sekolah/'.$galeri->img) }}" alt="Slide 2">
									<div class="flex-caption slider-caption-bg">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $galeri->judul_id : ( (!empty($galeri->judul_en)) ? $galeri->judul_en : $galeri->judul_id ) : $galeri->judul_id }}</div>
								</a>
                            </div>
                            @endforeach
						</div>
					</div>
				</div>
                @endif
            </div>
        </div>
        
        <div class="container clearfix" id="berita_render" style="margin-top: -50px">
            <div class="heading-block center nobottomborder">
                <h2>{{ $sekolah->nama }}</h2>
                {{-- <span>We value Work Ethics &amp; Environment as it helps in creating a Creative Thinktank</span> --}}
            </div>
        </div>
         <br>
        <div class="container clearfix">
            <div class="promo promo-light bottommargin">
                <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i><span style="color: black;"> {{ $sekolah->alamat }} </span></a> &nbsp;
                <a href=""><i class="fa fa-envelope" aria-hidden="true"></i><span style="color: black;"> {{ $sekolah->email }}</span></a> &nbsp;
                <a href=""><i class="fa fa-phone" aria-hidden="true"></i><span style="color: black;"> {{ $sekolah->no_telp }} </span></a>
                <a target="_blank" href="{{ $sekolah->website }}" class="button button-xlarge button-rounded"> Go To Website</a>
            </div>
        </div>
        
        
        <div class="container clearfix">
           {!! Session::has('locale') ? Session::get('locale') == 'id' ? $sekolah->deskripsi_id : ( (!empty($sekolah->deskripsi_en)) ? $sekolah->deskripsi_en : $sekolah->deskripsi_id ) : $sekolah->deskripsi_id !!}
        </div>

        
    </div>

</section>

@endsection
@section('custom-script')

<script>
    $(document).ready(function(){
        $("html, body").animate({ scrollTop: $('#berita_render').offset().top-150 }, 1000);
    })
</script>
    
@endsection