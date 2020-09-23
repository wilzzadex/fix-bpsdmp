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
                    Home Page
                </li>
                <li class="active">
                    Master Popup
                </li>
                <li>
                    Tambah Popup
                </li>

            </ol>
            <div class="page-header">
                <h1>Tambah Popup</h1>
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
                    <form action="{{ route('admin.popup.store') }}" id="form-popup" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group validate">   
                                    <label for="">Nama File</label>
                                    <input type="text" name="nama_file" placeholder="Nama File ..." class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-4 validate">
                                        <label for="">File</label>
                                        <br>
                                        <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)" required></label>  
                                        <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>  

                                    </div>
                                    <div class="col-sm-4">
                                        <label class="recommendation">
                                            Keterangan:<br>
                                            <ul>
                                                <li>Rekomendasi Ukuran Gambar: 1000x1000 pixel</li>
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
                                <!-- <a href="?menu=tambah_berita" class="btn btn-primary add-row">
                                    Simpan Ke Draft <i class="fa fa-paper-plane"></i>
                                </a> -->
                                <a href="{{ route('admin.popup.index') }}" class="btn btn-default add-row">
                                    Batal <i class="fa fa-remove" aria-hidden="true"></i>
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
                    $('.label-gmbr').html('Tidak ada gambar');
                    $("#inputFile").val('');
                }else{
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function () {
                          var height = this.height;
                          var width = this.width;
                          console.log(width+'x'+height);
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
                $('.label-gmbr').text('Belum ada gambar.');
            }
        }


        function lihat_gmbr(obj) {
            var img = $(obj).attr('data-gmbr');
            $('#gambar_modal').attr('src', img);
        }

    var runValidator = function () {
        var form = $('#form-popup');
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
                nama_file: {
                    required: true
                },
                img: {
                    required: true
                },
            },
            messages: {
                nama_file  : "Nama file tidak boleh kosong !",
                img : "Gambar Tidak Boleh Kosong !",
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
                $('#pic-el').empty()
                
            },
            submitHandler: function (form) {
                $('#pic-el').empty()
                $('#alert').hide();
                successHandler.show();
                errorHandler.hide();
               
                // submit form
                if(successHandler.show()){
                  
                    myBlock(); 
                    form.submit();
                }
            }
        });
    };
    runValidator();
</script>
    
@endsection