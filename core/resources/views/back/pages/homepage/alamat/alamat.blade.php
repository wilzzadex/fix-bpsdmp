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
                    Alamat
                </li>
              
              
            </ol>
            <div class="page-header">
                <h1>Alamat</h1>
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
                <form action="{{ route('admin.alamat.post') }}" method="POST">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" class="form-control" id="" cols="30" rows="5">{{ $alamat->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">Email</label>
                                            <input type="email" placeholder="Judul" name="email" value="{{ $alamat->email }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">No Telp</label>
                                            <input type="text" placeholder="Judul" name="no_telp" value="{{ $alamat->no_telp }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">Fax</label>
                                            <input type="text" placeholder="Judul" name="fax" value="{{ $alamat->fax }}" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-md-12 space20">
                                <!-- <a href="?menu=tambah_berita" class="btn btn-primary add-row">
                                    Simpan Ke Draft <i class="fa fa-paper-plane"></i>
                                </a> -->
                                <button type="submit" class="btn btn-success add-row pull-right">
                                    Simpan Perubahan <i class="fa fa-save" aria-hidden="true"></i>
                                </button>
                                <!-- <a href="?menu=m_slider" class="btn btn-default add-row pull-right">
                                    Cancel <i class="fa fa-remove" aria-hidden="true"></i>
                                </a> -->
                            </div>
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

    @if(session('sukses'))
        swal({
            icon:'success',
            title: 'Sukses !',
            text: '{{ session("sukses") }}'
        })
    @endif

    $('form').submit(function(){
        myBlock()
    })
</script>
{{-- <script>
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
                // img: {
                //     required: true
                // },
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
                    
                    form.submit();
                }
            }
        });
    };
    runValidator();
</script> --}}
    
@endsection