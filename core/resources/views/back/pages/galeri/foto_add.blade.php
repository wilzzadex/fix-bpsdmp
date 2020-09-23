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
                   Galeri
                </li>
                <li class="active">
                    Album
                </li>
                <li>
                    Tambah Album
                </li>

            </ol>
            <div class="page-header">
                <h1>Tambah Album</h1>
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
                    <form action="{{ route('admin.galeri.foto.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-foto">
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
                                                    <div class="col-sm-12 validate">
                                                        <label for="">Judul Album</label>
                                                        <input type="text" name="judul_id" placeholder="Judul Album"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="panel_tab3_example2">
                                            <p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="">Album Title</label>
                                                        <input type="text" name="judul_en" placeholder="Album Title"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label for="">Gambar</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Judul (ID)</th>
                                            <th >Judul (EN)</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gambar">
                                        <tr id="img_0">
                                        
                                            <td  class="validate"><input required type="text" name="judul_foto_id[]" placeholder="Judul ..." class="form-control"></td>
                                            <td><input type="text" name="judul_foto_en[]" placeholder="Judul ..." class="form-control"></td>
                                            <td class="validate">
                                                <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input required type="file" name="img[]" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                                <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>  
                                            
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(0)"><i
                                                        class="fa fa-trash"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary btn-sm" id="tambah-gambar" onclick="addGambar()">Tambah Gambar</button><br>
                                <label class="recommendation" style="margin-top: 20px;">
                                    Keterangan:<br>
                                    <ul>
                                        <li>Rekomendasi Ukuran Gambar: 200x350 pixel</li>
                                        <li>Ukuran File Image Maksimal: 5 Mb</li>
                                        <li>Format Gambar : jpg,jpeg,png</li>
                                    </ul>
                                </label> <br>
                                <br>
                                <br>

                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                                <a href="{{ route('admin.galeri.foto') }}" class="btn btn-default add-row">
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
   

    img_id = 1;
    function addGambar() {
        $('#gambar').append(`
            <tr id="img_`+ img_id + `">
            <td class="validate"><input type="text" required name="judul_foto_id[]" placeholder="Judul ..." class="form-control"></td>
            <td><input type="text" name="judul_foto_en[]" placeholder="Judul ..." class="form-control"></td>
            <td class="validate">
                <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img[]" required accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>  
                
            </td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(`+ img_id + `)"><i class="fa fa-trash"></i></button></td>
        </tr>
        `)
        img_id++;
    }


    function removeGambar(id) {
        var items = $('.btn-danger')
            // console.log(items.length) 
            if(items.length == 1){
                swal({
                    text: "Minimal Terdapat 1 Foto !",
                    icon: "warning",
                });
                // alert('Minimal harus ada 1 gambar !')
            }else{
                $('#img_'+id).remove()
            }
    }
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
                        $(obj).closest('td').find('.label-gmbr').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+e.target.result+'">'+text+'</a>');
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
        var form = $('#form-foto');
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
                    myBlock()
                    form.submit();
                }
            }
        });
    };
    runValidator();

</script>
@endsection