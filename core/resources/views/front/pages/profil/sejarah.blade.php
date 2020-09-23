@extends('front.master')
@section('title')
Sejarah
@endsection
@section('content')

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.sejarah')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.sejarah')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h4>@lang('homepage.sejarah') BPSDMP</h4>
            </div>

            <div class="col_full text-justify">
                @php
                    $deskripsi = $sejarah->deskripsi_id;
                    if(Session::has('locale')){
                        if(Session::get('locale') == 'id'){
                            $deskripsi = $sejarah->deskripsi_id;
                        }else{
                            if(!empty($sejarah->deskripsi_en)){
                                $deskripsi = $sejarah->deskripsi_en;
                            }else{
                                $deskripsi = $sejarah->deskripsi_id;
                            }
                            
                        }
                    }
                @endphp
                {!! $deskripsi !!}
            </div>

        </div>



    </div>

</section>

@endsection