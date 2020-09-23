@extends('front.master')


@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.agenda')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.publish')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.agenda')</li>
        </ol>
    </div>

</section>
<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="single-event">

                <div class="col_three_fourth">
                    <h3>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $event->judul_id : ( (!empty($event->judul_en)) ? $event->judul_en : $event->judul_id ) : $event->judul_id  }}</h3>
                    <div class="entry-image nobottommargin">
                        <a href="#"><img
                                src="{{ asset('file_app/event_image/'.$event->media) }}"
                                alt="Event Single"></a>
                    </div>
                    <div class="card events-meta mb-3">

                        <div class="card-body">
                            <ul class="iconlist nobottommargin">
                                <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($event->tanggal_awal)) ." - ". date('d M Y',strtotime($event->tanggal_akhir))}} &nbsp <i class="icon-time"></i> {{ $event->jam }} &nbsp <i class="icon-map-marker2"></i> {{ $event->lokasi }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col_one_fourth col_last">
                    <div class="widget clearfix mt-5" style="margin-top: 250px;">

                        <h4>@lang('homepage.more_event')</h4>

                        @foreach ($event_lain as $item)
                        <div id="popular-post-list-sidebar">
                            <div class="spost clearfix">
                                <div class="entry-image">
                                    <a href="{{ route('publikasi.event.detail',$item->slug) }}" class="nobg"><img class="rounded-circle"
                                            src="{{ asset('file_app/event_image/'.$item->media) }}" alt=""></a>
                                </div>
                                <div class="entry-c">
                                    <div class="entry-title">
                                        <h4><a href="{{ route('publikasi.event.detail',$item->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $item->judul_id : ( (!empty($item->judul_en)) ? $item->judul_en : $item->judul_id ) : $item->judul_id  }}</a></h4>
                                    </div>
                                    <ul class="entry-meta">
                                        <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($event->tanggal_awal)) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                        @endforeach

                        
                     
                    </div>
                    <!-- <a href="#" class="btn btn-success btn-block btn-lg">Buy Tickets</a> -->
                </div>

                <div class="clear"></div>

                <div class="col_three_fourth">

                    {{-- <h3>Detail</h3> --}}

                    {!! Session::has('locale') ? Session::get('locale') == 'id' ? $event->deskripsi_id : ( (!empty($event->deskripsi_en)) ? $event->deskripsi_en : $event->deskripsi_id ) : $event->deskripsi_id  !!}



                </div>



                <div class="clear"></div>




            </div>

        </div>

    </div>

</section>
@endsection