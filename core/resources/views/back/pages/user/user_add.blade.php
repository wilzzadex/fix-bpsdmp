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
                    Manajemen User
                </li>
                <li class="active">
                    Tambah User
                </li>
            </ol>
            <div class="page-header">
                <h1>Tambah User</h1>
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
                    <form action="{{ route('admin.user.store') }}" id="form-slider" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                    @if ($errors->has('username'))
                                        <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                                    @endif
                                    <div class="form-group validate">

                                        <label for="">Nama User</label>
                                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama User ..."
                                            class="form-control">

                                    </div>
                                    <div class="form-group validate">

                                        <label for="">Username</label>
                                        <input type="text" value="{{ old('username') }}" placeholder="Username ..." name="username"
                                            class="form-control">

                                    </div>
                                    <!-- <br> -->
                                    <div class="mt-2"></div>
                                    {{-- <div class="form-group">

                                        <label for="">Email</label>
                                        <input type="email" placeholder="Email ..." class="form-control">

                                    </div> --}}
                                    <div class="form-group validate">

                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Password ..."
                                            class="form-control">

                                    </div>
                                    <div class="form-group validate">

                                        <label for="">Konfirmasi Password</label>
                                        <input type="password" name="password_c" placeholder="Konfirmasi Password ..."
                                            class="form-control">

                                    </div>
                                 
                                    <!-- <div class="form-group">

                                        <label for="">Role</label>
                                        <select name="" class="form-control" id="">
                                            <option value="">-- Pilih Role --</option>
                                            <option value="">Admin</option>
                                            <option value="">Laut</option>
                                            <option value="">Udara</option>
                                        </select>


                                    </div> -->
                               
                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                                <a href="{{ route('admin.user') }}" class="btn btn-default add-row">
                                    Batal <i class="fa fa-remove "></i>
                                </a>
                                <button type="submit" class="btn btn-success add-row">
                                    Simpan <i class="fa fa-save" aria-hidden="true"></i>
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
                username: {
                    required: true,
                    minlength: 3,
                },
                nama: {
                    required: true,
                    // minlength: 3,
                },
                password : {
                    required: true,
                    minlength : 6
                },
                password_c : {
                    required: true,
                    minlength : 6,
                    equalTo : "#password"
                }

                // img: {
                //     required: true
                // },
            },
            messages: {
                // judul_id  : "Judul Bahasa Indonesia tidak boleh kosong !",
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