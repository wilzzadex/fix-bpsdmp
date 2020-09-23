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
                    Publikasi
                </li>
                <li class="active">
                    Infografis
                </li>
                <li>
                    Edit Siaran Pers
                </li>

            </ol>
            <div class="page-header">
                <h1>Edit Siaran Pers</h1>
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
                    <form action="{{ route('admin.publikasi.pers.update',$pers->id) }}" id="form-pers" method="POST" class="form-horizontal"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable">
                                    <ul id="myTab4" class="nav nav-tabs tab-padding tab-space-3 tab-blue">
                                        <li class="active">
                                            <a href="#panel_tab3_example1" data-toggle="tab" aria-expanded="true">
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
                                            <div class="form-group validate">
                                                <div class="col-sm-12">
                                                    <label for="">Judul</label>
                                                    <input type="text" value="{{ $pers->judul_id }}" name="judul_id" placeholder="Judul"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group validate">
                                                <div class="col-sm-12">
                                                    <label for="">Deskripsi</label>
                                                    <textarea name="deskripsi_id" class="ckeditor form-control" cols="30"
                                                        rows="10">{{ $pers->deskripsi_id }}</textarea>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="panel_tab3_example2">
                                            <p>
                                            <div class="form-group validate">
                                                <div class="col-sm-12">
                                                    <label for="">Title</label>
                                                    <input type="text" value="{{ $pers->judul_en }}" name="judul_en" placeholder=" Title"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group validate">
                                                <div class="col-sm-12">
                                                    <label for="">Description</label>
                                                    <textarea name="deskripsi_en" class="ckeditor form-control" cols="30"
                                                        rows="10">{{ $pers->deskripsi_en }}</textarea>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: 20px;margin-right:20px">
                                    <label class="control-label">
                                        Tanggal
                                    </label>
                                    <div class="input-group validate">
                                        <input placeholder="Tanggal ..." value="{{ date('d M Y',strtotime($pers->tanggal_awal)) }}" type="text" name="tanggal" id="tanggal"
                                            class="form-control">
                                        <span class="input-group-addon"> <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" style="margin-left: 20px;margin-right:20px">

                                    <p>
                                        Thumbnail
                                    </p>
                                    <label class="radio-inline">
                                        <input type="radio" name="videosource" {{ $pers->is_youtube == 1 ? 'checked' : '' }} value="yt">
                                        Youtube
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="videosource" {{ $pers->is_youtube == 0 ? 'checked' : '' }} value="gambar">
                                        Gambar
                                    </label>


                                </div>
                                <div class="form-group validate" style="margin-left: 20px;margin-right:20px" id="elemen">
                                        @if ($pers->is_youtube == 1)
                                        <input type="text" required name="url_youtube" placeholder="Url Youtube" class="form-control" value="{{ $pers->media }}">
                                        @else 
                                        <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="thumbnail" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                        <span class="label-gmbr" style="margin-left: 2%;"><a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/pers_image/'.$pers->media) }}">{{ $pers->media }}</a></span>
                                        @endif
                                </div>

                            </div>
                            <div class="col-sm-4" style="margin-left: 20px;margin-right:20px" id="recomend">

                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                                <a href="{{ route('admin.publikasi.pers') }}" class="btn btn-default add-row my-2">
                                    Batal <i class="fa fa-remove "></i>
                                </a>
                                <button type="submit" name="btn" value="btn-draft"
                                    class="btn btn-primary add-row my-2">
                                    Simpan Ke Draft <i class="fa fa-paper-plane "></i>
                                </button>
                                <button name="btn" type="submit" value="btn-publish"
                                    class="btn btn-success add-row my-2">
                                    Publikasi <i class="fa fa-bullhorn" aria-hidden="true"></i>
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
<div class="modal fade" id="detil" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="gambar_modal" width="100%" />
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    @if(session('gagal'))
        customSwal('warning','Gagal !','{{ session("gagal") }}')
    @endif
    $(document).ready(function () {
        $('#tanggal').bootstrapMaterialDatePicker({
            time:false,
            format : 'DD MMMM YYYY'
        });
        $('input:radio[name="videosource"]').change(
            function () {
                var type = $(this).val()
                if (type == 'yt') {
                    $('#elemen').empty()
                    $('#elemen').append(` <input type="url" required name="url_youtube" placeholder="Url Youtube" class="form-control">`)
                    $('#recomend').empty()

                } else {
                    // console.log(type)
                    $('#elemen').empty()
                    $('#elemen').append(`
                          <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="thumbnail" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)" required></label>  
                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>
                                              `)
                    $('#recomend').append(`
                                <br>
                                <br>
                                <label class="recommendation">
                                    Keterangan:<br>
                                    <ul>
                                        <li>Rekomendasi Ukuran Gambar: 350x200 pixel</li>
                                        <li>Ukuran File Image Maksimal: 5 Mb</li>
                                        <li>Format Gambar : jpg,jpeg,png</li>
                                    </ul>
                                </label>
                            
                        `)
                }

            });
    });

    function hasilgmbr(obj) {
        var url = $(obj).val();
        // console.log(url);
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var text = url.substring(12);



        if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
            if (obj.files[0].size > 5242880) {
                var mb = (5242880 / 1024 / 1024);
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'File gambar harus lebih kecil dari ' + mb + ' MB',
                }, function () {
                    $(obj).closest('td').find('.label-gmbr').html('Tidak ada gambar');
                    $("#inputFile").val('');
                });
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        //   console.log(width+'x'+height);
                    };
                    // console.log(text)
                    $('.label-gmbr').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="' + e.target.result + '">' + text + '</a>');
                }
                reader.readAsDataURL(obj.files[0]);
            }

        }
        else {
            swal({
                text: "Format Gambar yang anda masukan salah !",
                icon: "warning",
            });
            $(obj).val('');
            $('.label-gmbr').text('Belum ada gambar.');
        }
    }


    function lihat_gmbr(obj) {
        var img = $(obj).attr('data-gmbr');
        $('#gambar_modal').attr('src', img);
    }

    var runValidator = function () {
        var form = $('#form-pers');
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
                tanggal: {
                    required: true
                },
                deskripsi_id:{
                         required: function() 
                        {
                         CKEDITOR.instances.deskripsi_id.updateElement();
                        },

                         minlength:10
                },
            },
            messages: {
                judul_id  : "Judul Bahasa Indonesia tidak boleh kosong !",
                tanggal : "Tanggal Tidak Boleh Kosong !",
                deskripsi_id:{
                        required:"Deskripsi Bahasa Indonesia tidak boleh Kosong !",
                        minlength:"Masukan minimal 10 karakter !"
                    }
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