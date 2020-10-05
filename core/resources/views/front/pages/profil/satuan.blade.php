@extends('front.master')
@section('content')
    
<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.satuan_kerja')</h1>
        <span>{{ $satker->nama }}</span>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.satuan_kerja')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h3>{{ $satker->nama }}</h3>
            </div>

            <div class="col_full">
                @php
                    $deskripsi = $satker->deskripsi_id;
                    if(Session::has('locale')){
                        if(Session::get('locale') == 'id'){
                            $deskripsi = $satker->deskripsi_id;
                        }else{
                            if(!empty($satker->deskripsi_en)){
                                $deskripsi = $satker->deskripsi_en;
                            }else{
                                $deskripsi = $satker->deskripsi_id;
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
