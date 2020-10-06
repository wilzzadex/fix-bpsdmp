@extends('front.master')
@section('content')
<section id="page-title" class="page-title-mini">

    <div class="container clearfix">
        <h1>
            @lang('homepage.galeri_video')
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.galeri')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.galeri_video')</li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="single-post nobottommargin">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $video->judul_id : ( (!empty($video->judul_en)) ? $video->judul_en : $video->judul_id ) : $video->judul_id }}</h2>
                    </div><!-- .entry-title end -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($video->created_at)) }}</li>
                    </ul>

                    

                    <div class="entry-image bottommargin">
                        @php
                            $url = explode("watch?v=",$video->url_video);
                            $url_video = $url[1];
                        @endphp
                        <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;"><iframe src="//www.youtube.com/embed/{{ $url_video }}" frameborder="0" allowfullscreen="" id="fitvid1"></iframe></div>
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
                    ============================================= -->
                    
                    <div class="entry-content notopmargin">
                        
                        <p>{!! Session::has('locale') ? Session::get('locale') == 'id' ? $video->deskripsi_id : ( (!empty($video->deskripsi_en)) ? $video->deskripsi_en : $video->deskripsi_id ) : $video->deskripsi_id  !!}</p>

                        <!-- Post Single - Share
                        ============================================= -->
                        <div class="si-share noborder clearfix">
                            <span>Share :</span>
                           <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                        </div>
                    </div>
                </div><!-- .entry end -->


                <h4>Video Lainnya :</h4>

                <div class="related-posts clearfix">
                    <div class="row">
                        @foreach ($video_lain as $v)
                        <div class="col-md-6">
                            <div class="mpost clearfix">
                                <div class="entry-image">
                                    @php
                                        $url = explode("watch?v=",$v->url_video);
                                        $url_video = $url[1];
                                        $tmp_id = strip_tags($v->deskripsi_id);
                                        $tmp_en = strip_tags($v->deskripsi_en);
                                    @endphp
                                    <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;"><iframe src="//www.youtube.com/embed/{{ $url_video }}" frameborder="0" allowfullscreen="" id="fitvid1"></iframe></div>
                                </div>
                                <div class="entry-c">
                                    <div class="entry-title">
                                        <h4><a href="{{ route('galeri.video.preview',$v->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $v->judul_id : ( (!empty($v->judul_en)) ? $v->judul_en : $v->judul_id ) : $v->judul_id }}</a></h4>
                                    </div>
                                    <ul class="entry-meta clearfix">
                                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($v->created_at)) }}</li>
                                        
                                    </ul>
                                    <div class="entry-content">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</div>
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
@endsection
@section('custom-script')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f744702ac19a900122180d7&product=sop' async='async'></script>
@endsection