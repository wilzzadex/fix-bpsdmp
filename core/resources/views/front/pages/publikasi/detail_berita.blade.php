@extends('front.master')

@section('content')

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.berita')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.publish')</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.berita')</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">BPSDMP SELENGGARAKAN WISUDA DAN TRADISI BON VOYAGE BAGI LULUSAN MASTER KEPELAUTAN BP3IP -->
            </li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="single-post nobottommargin">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $berita->judul_id : ( (!empty($berita->judul_en)) ? $berita->judul_en : $berita->judul_id ) : $berita->judul_id  }}</h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($berita->tanggal_awal)) }}</li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Image
                    ============================================= -->
                    <div class="entry-image bottommargin">
                       
                        @if ($berita->is_youtube == 1)
                        @php
                            $video = explode("watch?v=",$berita->media);
                            $video_url = $video[1];
                            // dd($video);
                        @endphp
                        <iframe  height="150px" src="https://www.youtube.com/embed/{{$video_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else 
                        <img class="image_fade" src="{{ asset('file_app/berita_image/'.$berita->media) }}">
                        @endif
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">

                        {!! Session::has('locale') ? Session::get('locale') == 'id' ? $berita->deskripsi_id : ( (!empty($berita->deskripsi_en)) ? $berita->deskripsi_en : $berita->deskripsi_id ) : $berita->deskripsi_id !!}   
                    </div>
                    <div class="si-share noborder clearfix">
                        <span>Share :</span>
                       <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                    </div>

                </div><!-- .entry end -->
                <h4>Berita Lainnya :</h4>
                <div class="related-posts clearfix">
                    <div class="col_full nobottommargin">
                        <div class="row">
                            @foreach ($berita_lain as $item)
                            @php
                                $tmp_id = strip_tags($item->deskripsi_id);
                                $tmp_en = strip_tags($item->deskripsi_en);
                            @endphp
                                @if ($item->is_youtube==1)
                                <div class="col-md-6 mt-3">
                                    <div class="mpost clearfix">
                                        <div class="entry-image">
                                            @php
                                                $video = explode("watch?v=",$item->media);
                                                $video_url = $video[1];
                                                // dd($video);
                                            @endphp
                                            <iframe height="210px" src="https://www.youtube.com/embed/{{ $video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                        <div class="entry-c">
                                            <div class="entry-title">
                                                <h4 class="card-title t700 mb-2"><a
                                                        href="{{ route('publikasi.berita.detail',$item->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $item->judul_id : ( (!empty($item->judul_en)) ? $item->judul_en : $item->judul_id ) : $item->judul_id  }}</a></h4>
                                            </div>
                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($item->tanggal_awal)) }}</li>
                                            </ul>
                                            <div class="entry-content">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Description.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6 mt-5">
                                    <div class="mpost clearfix">
                                        <div class="entry-image">
                                            <a href="{{ asset('file_app/berita_image/'.$item->media) }}"
                                                data-lightbox="image">
                                                <img src="{{ asset('file_app/berita_image/'.$item->media) }}"
                                                    alt="1587954464-3.jpeg" class="img-post-custom">
                                            </a>
            
                                        </div>
                                        <div class="entry-c">
                                            <div class="entry-title">
                                                <h4 class="card-title t700 mb-2"><a
                                                        href="{{ route('publikasi.berita.detail',$item->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $item->judul_id : ( (!empty($item->judul_en)) ? $item->judul_en : $item->judul_id ) : $item->judul_id  }}</a></h4>
                                            </div>
                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($item->tanggal_awal)) }}</li>
                                            </ul>
                                            <div class="entry-content">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Description.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                               
                            @endforeach
                        </div>
                       
                       
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