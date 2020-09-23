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
                    Event
                </li>
                <li>
                    Edit Event
                </li>

            </ol>
            <div class="page-header">
                <h1>Edit Event</h1>
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
                    <i class="fa fa-external-link-square"></i>Formulir Event
                    <div class="panel-tools">

                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.publikasi.event.update',$event->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-event">
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
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        Judul
                                                    </label>
                                                    <div class="col-sm-9 validate">
                                                        <input type="text" placeholder="Judul"
                                                           value="{{ $event->judul_id }}" class="form-control" name="judul_id">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        Deskripsi
                                                    </label>
                                                    <div class="col-sm-9 validate" >
                                                        <textarea class="ckeditor form-control" cols="10"
                                                            rows="10" name="deskripsi_id">{{ $event->deskripsi_id }}</textarea>
                                                    </div>
                                                </div>
                                               
                                                 
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="panel_tab3_example2">
                                            <p>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        Title
                                                    </label>
                                                    <div class="col-sm-9 validate">
                                                        <input type="text" placeholder="Title"
                                                           value="{{ $event->judul_en }}" class="form-control" name="judul_en">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        Description
                                                    </label>
                                                    <div class="col-sm-9 validate">
                                                        <textarea class="ckeditor form-control" cols="10"
                                                            rows="10" name="deskripsi_en">{{ $event->deskripsi_en }}</textarea>
                                                    </div>
                                                </div>        
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Lokasi
                                </label>
                                <div class="col-sm-9 validate">
                                    <input type="text" placeholder="Lokasi"
                                       value="{{ $event->lokasi }}" class="form-control" name="lokasi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Waktu Event
                                </label>
                                <div class="col-sm-9 validate">
                                    {{-- <label for="">Rentang tanggal</label> --}}
                                    <div class="input-group">
                                        <span class="input-group-addon"> <i
                                                class="fa fa-calendar"></i> </span>
                                        <input type="text" value="{{ date('d/m/Y',strtotime($event->tanggal_awal)) }}" name="tanggal" class="form-control date-time-range">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Thumbnail
                                </label>
                                <div class="col-sm-4 validate">
                                   
                                    <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="thumbnail" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                    <span class="label-gmbr" style="margin-left: 2%;"> <a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/event_image/'.$event->media) }}"> {{ $event->media }}</a></span>
                                </div>
                                <div class="col-sm-4">
                                    <label class="recommendation">
                                        Keterangan:<br>
                                        <ul>
                                            <li>Rekomendasi Ukuran Image: 350x200 pixel</li>
                                            <li>Ukuran File Image Maksimal: 5 Mb</li>
                                            <li>Format Gambar : jpg,jpeg,png</li>
                                        </ul>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="row pull-right">
                            <div class="col-md-12 space20 ">
                                <a href="{{ route('admin.publikasi.berita') }}" class="btn btn-default add-row my-2">
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
{{-- @php
    dd($event->tanggal_awal);
@endphp --}}
@endsection
@section('custom-script')
    <script>
        @if(session('gagal'))
            customSwal('warning','Gagal !' ,'{{ session("gagal") }}')
        @endif

        var awal = '{{ $event->tanggal_awal }}'
        var akhir = '{{ $event->tanggal_akhir }}'

        $(".date-range").daterangepicker({
            
        }), $(".date-time-range").daterangepicker({
            timePicker: !0,
            timePickerIncrement: 30,
            locale: {
                format: "MM/DD/YYYY h:mm A"
            },
            startDate: new Date(awal),
            endDate: new Date(akhir),

        })
        $('.time-picker').timepicker({
            timeFormat: 'hh:mm',
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
        var form = $('#form-event');
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
                    deskripsi_id:{
                            required: function() 
                            {
                            CKEDITOR.instances.deskripsi_id.updateElement();
                            },

                            minlength:10
                    },
                lokasi: {
                    required: true
                },
                tanggal: {
                    required: true
                },
            },
            messages: {
                judul_id  : "Judul Bahasa Indonesia tidak boleh kosong !",
                thumbnail : "Thumbnail Tidak Boleh Kosong !",
                lokasi : "Lokasi Tidak Boleh Kosong !",
                deskripsi_id : "Deskripsi Bahasa Indonesia Tidak Boleh Kosong !",
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