@extends('back.master')
@section('content')
<div class="container">
    <!-- start: PAGE HEADER -->
    <div class="row">
        <div class="col-sm-12">

            <!-- start: PAGE TITLE & BREADCRUMB -->
            <ol class="breadcrumb">
                <li>
                    <i class="clip-home-3"></i>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li class="active">
                    Homepage
                </li>
                <li class="active">
                    Slider
                </li>
                <li>
                    Edit Slider
                </li>
              
            </ol>
            <div class="page-header">
                <h1>Edit Slider</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-external-link-square"></i>
                    <div class="panel-tools">
                       
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.slider.epost',$slider->id) }}" method="POST" id="form-slider" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable">
                                    <ul id="myTab4" class="nav nav-tabs tab-padding tab-space-3 tab-blue">
                                        <li class="active">
                                            <a href="#panel_tab3_example1" data-toggle="tab"  aria-expanded="true">
                                                Bahasa Indonesia (Default)
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#panel_tab3_example2" data-toggle="tab" aria-expanded="false">
                                                English
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="panel_tab3_example1">
                                            <p>
                                                
                                                    <div class="form-group">
                                                        <div class="col-sm-12 validate">
                                                            <label for="">Judul Slider</label>
                                                            <input  type="text" value="{{ $slider->judul_id }}" placeholder="Judul" class="form-control" name="judul_id">
                                                        </div>
                                                    </div>
                                                
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="panel_tab3_example2">
                                        <p>
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="">Slider Title</label>
                                                        <input type="text" placeholder="Slider Title" class="form-control" value="{{ $slider->judul_en }}" name="judul_en">
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-4 validate">
                                        <label for="">Gambar</label>
                                        <br>
                                        <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                        
                                        <span class="label-gmbr" style="margin-left: 2%;"><a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/slider_image/'.$slider->img) }}">{{ $slider->img }}</a></span> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="recommendation">
                                            Keterangan:<br>
                                            <ul>
                                                <li>Rekomendasi Ukuran Gambar: 1000x600 pixel</li>
                                                <li>Ukuran File Image Maksimal: 5 Mb</li>
                                                <li>Format Gambar : jpg,jpeg,png</li>
                                            </ul>
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                               
                                <a href="{{ route('admin.slider.index') }}" class="btn btn-default add-row">
                                    Batal <i class="fa fa-remove" aria-hidden="true"></i>
                                </a>
                                <button type="submit" class="btn btn-success add-row">
                                    Simpan Perubahan <i class="fa fa-save" aria-hidden="true"></i>
                                </button>
                            
                            </div>
                        </div>
                    </form>
                </div>
                
               
            </div>
        </div>
    </div>
    <!-- end: PAGE CONTENT-->
</div>
@endsection
@section('custom-script')
<script>
        function hasilgmbr(obj) {
            var url = $(obj).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var text = url.substring(12);
            
            if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                if(obj.files[0].size > 5242880){
                    var mb = (5242880/1024/1024);
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File gambar harus lebih kecil dari '+mb+' MB',
                    });
                    $('.label-gmbr').html(`<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/slider_image/'.$slider->img) }}">{{ $slider->img }}</a>`);
                    // $("#inputFile").val('');
                }else{
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function () {
                          var height = this.height;
                          var width = this.width;
                        //   console.log(width+'x'+height);
                        };
                        $('.label-gmbr').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+e.target.result+'">'+text+'</a>');
                    }
                    reader.readAsDataURL(obj.files[0]);  
                }
                              
            }
            else{
                swal({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda salah memasukan gambar. Gambar harus dalam format png/jpeg/jpg!',
               
                });
                $(obj).val('');
                $('.label-gmbr').html(`<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/slider_image/'.$slider->img) }}">{{ $slider->img }}</a>`);
            }
        }


        function lihat_gmbr(obj) {
            var img = $(obj).attr('data-gmbr');
            $('#gambar_modal').attr('src', img);
        }

    var runValidator = function () {
        var form = $('#form-slider');
        var errorHandler = $('.errorHandler', form);
        var successHandler = $('.successHandler', form);

        form.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                judul_id: {
                    required: true
                },
               
            },
            messages: {
                judul_id  : "Judul Bahasa Indonesia tidak boleh kosong !",
                // img : "Gambar Slider Tidak Boleh Kosong",
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler.hide();
                errorHandler.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.validate ').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
                $('#btn_tab_id').trigger('click');

            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.validate ').removeClass('has-error');
                // set error class to the control group
                
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.validate ').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                $('#alert').hide();
                successHandler.show();
                errorHandler.hide();
                // submit form
                if(successHandler.show()){
                    myBlock()
                    form.submit();
                }
            }
        });
    };
    runValidator();
</script>
    
@endsection