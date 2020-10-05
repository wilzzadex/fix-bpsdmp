@extends('front.master')
@section('content')


<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.struktur_organisasi')</h1>
        <span>{{ $struktur->nama }}</span>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.struktur_organisasi')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Post Content
            ============================================= -->
            <div class="single-post nobottommargin text-center">

                <img src="{{ asset('file_app/struktur_image/'.$struktur->img) }}"
                width="60%" height="auto">

            </div><!-- .postcontent end -->

        </div>

    </div>
</section>


@endsection