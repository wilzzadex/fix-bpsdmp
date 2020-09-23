@extends('front.master')
@section('content')
<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.galeri_foto')</h1>
        <!-- <span>Powerful Form Processor</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.galeri')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('homepage.galeri_foto')</li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="row mt-2">
                <div class="col-sm-12 col-md-6">
                    <div class="input-group w-100">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="icon-line-search"></i>
							</span>
						</div>
						<input type="text" id="icons-filter" class="form-control" value="" placeholder="@lang('homepage.cari')">
						<a href="javascript:void(0);" class="btn btn-primary cari" style="margin-left: 10px;">@lang('homepage.cari')</a>
					</div>
                </div>
                <div class="col-sm-12 col-md-6 " id="container-show">
                    <div id="datatable1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer float-right">
                        <div class="dataTables_length" id="datatable1_length">
                            <label style="float: right;">@lang('homepage.tampilkan') 
                                <select name="datatable1_length" aria-controls="datatable1" id="shows" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="3">3</option>
                                    <option value="6" selected>6</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                    <option value="15">15</option>
                                </select> @lang('homepage.halaman')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div id="reload" style="display: none;">
                <a href="javascript:void(0);" id="reload-page" class="btn btn-secondary btn-md btn-block mx-auto topmargin-lg" style="max-width: 15rem;"><i class="icon-repeat" style="position: relative; top: 1px;"></i> Muat Ulang </a>
            </div>
            <div id="berita_render"></div>

           
        </div>
    </div>
</section>


<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  
</div>
@endsection
@section('custom-script')
<script>
    var page = 1;
    var show = $('#shows').val();
    var category = "berita";

    $("#berita_render").on("click",".show-image",function(){
        var m = $(this).attr("id");
        // console.log(m);
        $.ajax({
            url: "{{ route('galeri.foto.preview') }}",
            type: "GET",
            data : {id: m,},
            success: function (ajaxData){
                console.log(ajaxData)
                $("#imageModal").html(ajaxData);
                $("#imageModal").modal('show');
            },
            error: function(err)
            {
                console.log(err);
            }
        });
    });

    (function() {
      'use strict';
      document.onreadystatechange = function () {
        if ( document.readyState === "complete" ) {
            load_data(page,show,category);
        }
      }
    }());

    $('.cari').on('click', function(){
        cek = $('#icons-filter').val();
        if(cek !='' && cek != undefined){
            cari = cek;
            page = 1;
        }else{
            cari = null;
        }
        $.ajax({
            type: "GET",
            url: "{{ route('galeri.foto.cari') }}",
            dataType: "html",
            data: {
                'page'   : page,
                'show'   : show,
                'cari'   : cari,
                'page_id' : category,
            },
            beforeSend:function(res){
                myBlock()
            },
            success:function(data){
                // console.log(data);
                $('#reload').hide();
                $('#berita_render').html(data);
                $("html, body").animate({ scrollTop: $('#berita_render').offset().top-150 }, 1000);
                $.unblockUI();
                var $lightboxImageEl = $('[data-lightbox="image"]');
                if( $lightboxImageEl.length > 0 ) {
                    $lightboxImageEl.magnificPopup({
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        fixedContentPos: true,
                        mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                        image: {
                            verticalFit: true
                        }
                    });
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                $("html, body").animate({ scrollTop: $('#berita_render').offset().top-150 }, 1000);
                $('#container-show').hide();
                $('#reload').show();
            }
        });
        
    });

    $('#shows').on('change',function(e){
        page = 1;
        show = $(this).val();
        load_data(page,show,category);
         myBlock()
    });

    $('#reload-page').on('click',function(e){
        load_data(page,show,category);
         myBlock()
    });

    $('body').on('click','#wrapper #content .content-wrap .container #berita_render .pagination .page-item a',function(e) {
        e.preventDefault();
        page = $(this).attr('href').split('page=')[1];
        load_data(page,show,category);
         myBlock()
    });

    function load_data(page,show,category)
    {
        $.ajax({
            type: "GET",
            url: "{{ route('galeri.foto.data') }}",
            dataType: "html",
            data: {
                'page'   : page,
                'show'   : show,
                'page_id' : category
            },
            beforeSend: function(res){
                myBlock()
            },
            success:function(data){
                // console.log(data);
                $('#reload').hide();
                $('#berita_render').html(data);
                $("html, body").animate({ scrollTop: $('#berita_render').offset().top-150 }, 1000);
                $.unblockUI();
                var $lightboxImageEl = $('[data-lightbox="image"]');
                if( $lightboxImageEl.length > 0 ) {
                    $lightboxImageEl.magnificPopup({
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        fixedContentPos: true,
                        mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                        image: {
                            verticalFit: true
                        }
                    });
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                $("html, body").animate({ scrollTop: $('#berita_render').offset().top-150 }, 1000);
                $('#container-show').hide();
                $('#reload').show();
            }
        });
    }    
</script>
@endsection