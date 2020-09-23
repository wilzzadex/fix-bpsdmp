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
                    Kerja Sama
                </li>
                <li>
                    Tambah Kerja Sama
                </li>

            </ol>
            <div class="page-header">
                <h1>Tambah Tambah Kerja Sama</h1>
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
                    <i class="fa fa-external-link-square"></i>Formulir Kerja Sama
                    <div class="panel-tools">
                       
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form-kerja_sama" action="{{ route('admin.kerja.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">                 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            Nomor
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <input type="text" name="nomor" class="form-control" id="" placeholder="Nomor ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            Tanggal
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <div class="input-group">
                                                <input placeholder="Tanggal ..." type="text" name="tanggal" id="tanggal" class="form-control">
                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            Uraian
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <textarea class="form-control" cols="10" name="uraian" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            Institusi
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <input type="text" name="institusi" class="form-control" id="" placeholder="Institusi ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            File
                                        </label>
                                        <div class="col-sm-9 validate">
                                            <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-file"></i> Pilih File<input type="file" name="file"  accept="application/pdf,image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada File</span> 
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-9 validate">
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
                                <a href="{{ route('admin.kerja.index') }}" class="btn btn-default add-row my-2">
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
        $(document).ready(function(){
            $('#tanggal').bootstrapMaterialDatePicker({
                time:false,
                format : 'DD MMMM YYYY'
            });
        })

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
                    text: 'Anda salah memasukan File. File harus dalam format pdf/ png/ jpg/ jpeg!',
               
                });
                $(obj).val('');
                $('.label-gmbr').text('Belum ada File.');
            }
        }

        

    var runValidator = function () {
        var form = $('#form-kerja_sama');
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
                nomor: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                uraian: {
                    required: true
                },
                institusi: {
                    required: true
                },
                file: {
                    required: true
                },
            },
            messages: {
                nomor  : "Nomor tidak boleh kosong !",
                tanggal : "Tanggal Tidak Boleh Kosong !",
                uraian : "Uraian Tidak Boleh Kosong !",
                institusi : "Institusi Tidak Boleh Kosong !",
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