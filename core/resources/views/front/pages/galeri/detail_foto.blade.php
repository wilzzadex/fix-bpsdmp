@extends('front.master')

@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $album->judul_id : ( (!empty($album->judul_en)) ? $album->judul_en : $album->judul_id ) : $album->judul_id }}</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.galeri')</a></li>
            <li class="breadcrumb-item active" aria-current="page">Foto</li>
        </ol>
    </div>

</section>
<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">
        <div class="container clearfix">
            <div class="col_full clearfix">

                <div class="masonry-thumbs grid-5" data-big="1" data-lightbox="gallery"
                    style="margin-right: -1px; position: relative; height: 513.75px;">
                    @foreach ($foto as $foto)
                    <a href="{{ asset('file_app/galeri/galeri_foto/'.$foto->img) }}" data-lightbox="gallery-item"
                    style="width: 228px; position: absolute; left: 912px; top: 342.5px; transition-property: opacity, transform; transition-duration: 0.4s; transition-delay: 0ms; transform: translate3d(0px, 0px, 0px);"><img class="image_fade lazy" data-src="{{ asset('file_app/galeri/galeri_foto/'.$foto->img) }}" ></a>
                    @endforeach
                   
                </div>

            </div>
        </div>

    </div>

    

</section>
@endsection

@section('custom-script')
    <script>
         $(function() {
            $('.lazy').lazy({
                effect: "fadeIn",
                effectTime: 2000,
                threshold: 0
            });
        });
    </script>
@endsection