@extends('front.master')
@section('content')

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.tugas')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.tugas')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">



        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h4>@lang('homepage.tugas_aja')</h4>
            </div>

            <div class="col_full">
                <h5 class="text-justify">
                    {!! Session::has('locale') ? Session::get('locale') == 'id' ? $tugas->deskripsi_id : ( (!empty($tugas->deskripsi_en)) ? $tugas->deskripsi_en : $tugas->deskripsi_id ) : $tugas->deskripsi_id !!}
                </h5>

            </div>

        </div>

        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h4>@lang('homepage.fungsi_aja')</h4>
            </div>
         
                <div class="col-full">
                    <h5 class="text-justify">
                        {!! Session::has('locale') ? Session::get('locale') == 'id' ? $fungsi->deskripsi_id : ( (!empty($fungsi->deskripsi_en)) ? $fungsi->deskripsi_en : $fungsi->deskripsi_id ) : $fungsi->deskripsi_id !!}
                    </h5>
                </div>
        </div>
    </div>

</section>

@endsection