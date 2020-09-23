@extends('front.master')
@section('content')

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.visi')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.profile')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.visi')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

    

        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h4>@lang('homepage.visi_aja')</h4>
            </div>

            <div class="col_full">
                <h5 class="text-justify">{!! Session::has('locale') ? Session::get('locale') == 'id' ? $visi->deskripsi_id : ( (!empty($visi->deskripsi_en)) ? $visi->deskripsi_en : $visi->deskripsi_id ) : $visi->deskripsi_id !!}
                </h5>

            </div>

        </div>

        <div class="container clearfix">
            <div class="heading-block fancy-title nobottomborder title-bottom-border">
                <h4>@lang('homepage.misi_aja')</h4>
            </div>
            <div class="row">
                @php
                    $no = 1;
                @endphp
                @if (Session::has('locale'))
                   @if (Session::get('locale') == 'id')
                        @foreach ($misi_id as $misi_id)
                        <div class="col-sm-6">
                            <p class="text-justify">
                                {{ $no++ }}.&nbsp; {{ $misi_id->deskripsi_id }}
                            </p>
                        </div>       
                        @endforeach
                   @else 
                        @foreach ($misi_en as $misi_en)
                        <div class="col-sm-6">
                            <p class="text-justify">
                                {{ $no++ }}.&nbsp; {{ $misi_en->deskripsi_en }}
                            </p>
                        </div>       
                        @endforeach
                   @endif
                @else 
                    @foreach ($misi_id as $misi_id2)
                    <div class="col-sm-6">
                        <p class="text-justify">
                            {{ $no++ }}.&nbsp; {{ $misi_id2->deskripsi_id }}
                        </p>
                    </div>       
                    @endforeach
                @endif
               
            </div>

        </div>


    </div>

</section>


@endsection