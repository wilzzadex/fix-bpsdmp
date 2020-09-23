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
                    Profil
                </li>
                <li class="active">
                    Sautuan Kerja
                </li>
                <li class="">
                    {{ $satker->nama }}
                </li>
               
            </ol>
            <div class="page-header">
                <h1>{{ $satker->nama }}</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">

    <div class="col-md-12">
        <form id="form-satker" action="{{ route('admin.profil.satuan.update',$satker->id) }}" method="POST">
            {{ csrf_field() }}
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
                    <div class="form-group">
                        <div class="form-group validate">
                            <label for="">Deskripsi</label>
                            <textarea required name="deskripsi_id" class="ckeditor form-control" cols="30" rows="10">{{ $satker->deskripsi_id }}</textarea>
                        </div>
                        
                    </div>
                    </div>
                    <div class="tab-pane" id="panel_tab3_example2">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="deskripsi_en" class="ckeditor form-control" cols="30" rows="10">{{ $satker->deskripsi_en }}</textarea>
                        </div>
                        
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success add-row pull-right">
                Simpan Perubahan <i class="fa fa-save" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>
    <!-- end: PAGE CONTENT-->
</div>
@endsection
@section('custom-script')
    <script>
         @if(session('sukses'))
            customSwal('success','Sukses !','{{ session("sukses") }}')
         @endif
    </script>
    <script>
       
        var runValidator = function () {
            var form = $('#form-satker');
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
                ignore: [],
                debug: false,
                rules: { 

                    deskripsi_id:{
                         required: function() 
                        {
                         CKEDITOR.instances.deskripsi_id.updateElement();
                        },

                         minlength:10
                    }
                },
                messages:
                    {

                    deskripsi_id:{
                        required:"Deskripsi Bahasa Indonesia tidak boleh kosong !",
                        minlength:"Please enter 10 characters"


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

