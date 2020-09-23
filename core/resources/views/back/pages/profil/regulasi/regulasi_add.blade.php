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
                    Regulasi & Kebijakan
                </li>
                <li>
                    Tambah Regulasi & Kebijakan
                </li>

            </ol>
            <div class="page-header">
                <h1>Tambah Regulasi & Kebijakan</h1>
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
                    <i class="fa fa-external-link-square"></i>Formulir Regulasi dan Kebijakan
                    <div class="panel-tools">
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.regulasi.store') }}" id="form-regulasi" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                              
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            Tahun
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <select name="tahun" class="form-control">
                                                <option value="">--PILIH TAHUN--</option>
                                                <script>
                                                    // var thn = 2020 - 25;
                                                    for(var i = 2020; i > (2020-26); i--){
                                                        document.write('<option>'+i+'</option>')
                                                    }
                                                </script>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            Tipe Peraturan
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <select name="tipe" class="form-control">
                                                <option value="">--PILIH--</option>
                                                <option>SE</option>
                                                <option>SK</option>
                                                <option>KM</option>
                                                <option>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            Nomor Peraturan
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <input type="text" name="nomor_peraturan" class="form-control" id="" placeholder="Nomor Peraturan ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            Tentang
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <textarea class="form-control" name="tentang" cols="10" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            File
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-file"></i> Pilih File<input type="file" accept="application/pdf,image/*" name="file" style="opacity: 0;" onchange="hasilgmbr(this)" required></label>  
                                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada File</span> 
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-9">
                                            <label class="recommendation">
                                                Keterangan:<br>
                                                <ul>
                                                    <li>Ukuran File Image Maksimal: 5 Mb</li>
                                                    <li>Format File : pdf/ png/ jpg/ jpeg</li>
                                                </ul>
                                            </label>
                                        </div>
                                    </div>
                              

                            </div>
                        
                        </div>
                        <div class="row pull-right">
                            <div class="col-md-12 space20 ">
                                <a href="{{ route('admin.regulasi.index') }}" class="btn btn-default add-row my-2">
                                    Batal <i class="fa fa-remove "></i>
                                </a>
                            
                                <button type="submit" class="btn btn-success add-row my-2">
                                    Simpan <i class="fa fa-save" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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
            
            if (obj.files && obj.files[0] && (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg")) {
                if(obj.files[0].size > 5242880){
                    var mb = (5242880/1024/1024);
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File harus lebih kecil dari '+mb+' MB',
                    });
                    $('.label-gmbr').html('Belum ada File');
                    $("#inputFile").val('');
                }else{
                    $('.label-gmbr').text(text);
                }  
            }
            else{
                swal({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda salah memasukan File. File harus dalam format pdf/ png/ jpg/ jpeg !',
               
                });
                $(obj).val('');
                $('.label-gmbr').text('Belum ada File.');
            }
        }

        

    var runValidator = function () {
        var form = $('#form-regulasi');
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
                tahun: {
                    required: true
                },
                tipe: {
                    required: true
                },
                nomor_peraturan: {
                    required: true
                },
                tentang: {
                    required: true
                },
            },
            messages: {
                tahun  : "Tahun tidak boleh kosong !",
                tipe : "Tipe Tidak Boleh Kosong !",
                nomor_peraturan : "Tentang Tidak Boleh Kosong !",
                tentang : "Tentang Tidak Boleh Kosong !",
                file: "File tidak boleh kosong !"
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
                    $.blockUI({ css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } }); 
                    form.submit();
                }
            }
        });
    };
    runValidator();

    </script>
@endsection