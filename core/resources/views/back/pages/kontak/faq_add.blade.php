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
                    Faq
                </li>
               
                <li>
                    Tambah Faq
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Tambah Faq</h1>
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
                    <form class="form-horizontal" action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data" id="form-faq">
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
                                                    <div class="col-sm-12">
                                                        <label for="">Pertanyaan</label>
                                                        <input type="text" placeholder="pertanyaan" name="pertanyaan_id" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="">Jawaban</label>
                                                        <textarea class="ckeditor form-control" name="jawaban_id" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="panel_tab3_example2">
                                        <p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="">Question</label>
                                                        <input type="text" name="pertanyaan_en" placeholder="Question" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="">Answer</label>
                                                        <textarea class="ckeditor form-control" name="jawaban_en" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                            <a href="{{ route('admin.faq') }}" class="btn btn-default add-row">
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
        var form = $('#form-faq');
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
                pertanyaan_id: {
                    required: true
                },
                
            },
            messages: {
                pertanyaan_id  : "Tidak boleh kosong !",
                // tanggal : "Tanggal Tidak Boleh Kosong !",
               
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