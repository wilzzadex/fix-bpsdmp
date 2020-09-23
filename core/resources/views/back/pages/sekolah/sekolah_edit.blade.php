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
                    Sekolah
                </li>
                <li class="active">
                    Edit
                </li>


            </ol>
            <div class="page-header">
                <h1>Edit Sekolah</h1>
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
                    <form action="{{ route('admin.sekolah.update',$sekolah->id) }}" method="POST" enctype="multipart/form-data" id="form-sekolah">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                            
                                    <div class="form-group validate">
                                        <label for="">Nama</label>
                                        <input type="text" name="nama" value="{{ $sekolah->nama }}" placeholder="Nama ..." class="form-control">
                                    </div>
                                    <div class="form-group validate">
                                        <label for="">Singkatan</label>
                                        <input type="text" value="{{ $sekolah->singkatan }}"  name="singkatan" placeholder="Singkatan ..." class="form-control" style="text-transform: uppercase">
                                    </div>
                                    <div class="form-group validate">
                                        <label for="">Matra</label>
                                        <select name="id_matra" required class="form-control">
                                            {{-- <option value="{{ $sekolah->matra->id }}">{{ $sekolah->matra->nama }}</option> --}}
                                            @foreach ($matra as $matra)
                                                <option value="{{ $matra->id }}" {{$sekolah->matra->id == $matra->id  ? 'selected' : ''}}>{{ $matra->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group validate">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" placeholder="Alamat ..." cols="30" class="form-control"
                                            rows="3">{{ $sekolah->alamat }}</textarea>
                                    </div>
                                    <div class="form-group validate">
                                        <label for="">Email</label>
                                        <input type="email" value="{{ $sekolah->email }}" name="email" placeholder="Email ..." class="form-control">
                                    </div>
                                    <div class="form-group validate">
                                        <label for="">No Telp</label>
                                        <input type="text" value="{{ $sekolah->no_telp }}" name="no_tlp" placeholder="No Telp ..." class="form-control">
                                    </div>
                                    <div class="form-group validate">

                                        <label for="">Website</label>
                                        <input type="url" name="url" value="{{ $sekolah->website }}" placeholder="Website ..." class="form-control">
                                    </div>
                                    <div class="form-group validate">

                                        <label for="">Deskripsi (ID)</label>
                                        <textarea name="deskripsi_id" class="ckeditor form-control" cols="30"
                                                        rows="10">{{ $sekolah->deskripsi_id }}</textarea>

                                    </div>
                                    <div class="form-group validate">

                                        <label for="">Deskripsi (EN)</label>
                                        <textarea name="deskripsi_en" class="ckeditor form-control" cols="30"
                                        rows="10">{{ $sekolah->deskripsi_en }}</textarea>

                                    </div>
                                    <br>
                                    <div class="form-group validate">
                                        <!-- <div class="col-sm-3"> -->
                                        <label for="">Logo</label>
                                        <br>
                                        <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Logo<input type="file" name="logo" accept="image/*" style="opacity: 0;" onchange="hasillogo(this)"></label>  
                                        <span class="label-logo" style="margin-left: 2%;"> <a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/logo_sekolah/'.$sekolah->logo) }}"> {{ $sekolah->logo }}</a></span>
                                        <br>
                                        <br>
                                        <br>
                                        <label class="recommendation" style="margin-top: 20px;">
                                            Keterangan:<br>
                                            <ul>
                                                <li>Rekomendasi Ukuran Logo: 300x300 pixel</li>
                                                <li>Ukuran File Image Maksimal: 5 Mb</li>
                                                <li>Format Gambar : jpg,jpeg,png</li>
                                            </ul>
                                        </label>

                                        <!-- </div> -->

                                    </div>
                            
                                <div class="form-group">


                                    <table class="table table-bordered mt-5">

                                        <thead>
                                            <tr>
                                                <th colspan="4"><b>
                                                        <center> Galeri </center>
                                                    </b></th>
                                            </tr>
                                            <tr>
                                                <th>Judul(ID)</th>
                                                <th>Judul(EN)</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="gambar">
                                            @if ($galeri != 'no')
                                                @foreach ($galeri as $key => $galeri)
                                                <tr id="imgDB_{{ $key }}">
                                                    <input type="hidden" name="idg[]" value="{{$galeri->id}}">
                                                    <input type="hidden" name="gambar_db[]" value="{{$galeri->img}}" class="gmbr_db">
                                                    <td class="validate">
                                                        <input type="text" value="{{ $galeri->judul_id }}" name="judul_foto_id[]" required placeholder="Judul ..." class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" value="{{ $galeri->judul_en }}" name="judul_foto_en[]" placeholder="Judul ..." class="form-control">
                                                    </td>
                                                    <td class="validate">
                                                        <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img[]" accept="image/*" style="opacity: 0;" onchange="hasilgmbrdb(this)"></label>  
                                                         <span class="label-gmbr" style="margin-left: 2%;"> <a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/galeri/galeri_sekolah/'.$galeri->img) }}"> {{ $galeri->img }}</a></span>
    
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" id="{{ $galeri->id }}" data-key="{{ $key }}" onclick="removeGambarDB(this)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                           
                                        </tbody>
                                    </table>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="addGambar()">Tambah Gambar</button>
                                </div>
                                <label class="recommendation" style="margin-top: 20px;">
                                    Keterangan:<br>
                                    <ul>
                                        <li>Rekomendasi Ukuran Gambar: 1000x650 pixel</li>
                                        <li>Ukuran File Image Maksimal: 5 Mb</li>
                                        <li>Format Gambar : jpg,jpeg,png</li>
                                    </ul>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row pull-right">
                            <div class="col-md-12 space20">
                                <a href="{{ route('admin.sekolah') }}" class="btn btn-default add-row">
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
    @if(session('gagal'))
        customSwal('warning','Gagal !','{{ session("gagal") }}')
    @endif

    img_id = 1;
    function addGambar() {
        $('#gambar').append(`
            <tr id="img_`+ img_id + `">
                <input type="hidden" name="idg[]" value="no-db">
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
       
            $('#img_' + id).remove()
       
    }
    function removeGambarDB(obj) {
        var items = $('.btn-danger')
            // console.log(items.length) 
          
                    var id = $(obj).attr('id');
                    var key = $(obj).attr('data-key');
                    swal({
                        // title: "Are you sure?",
                        text: "Yakin akan menghapus data ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            
                            $.ajax({
                                url : '{{ route("admin.sekolah.destroy_foto") }}',
                                type: 'GET',
                                data : {id: id,},
                                success:function(res){
                                    console.log(res)
                                    swal("Foto Berhasil di hapus!", {
                                        icon: "success",
                                    }).then(function() {
                                        $('#imgDB_'+key).remove()
                                    });
                                    
                                }
                            })

                            
                        }
                    });
                
                
         
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
    function hasillogo(obj) {
        var url = $(obj).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var text = url.substring(12);
        var image_url = '{{ asset("file_app/logo_sekolah/") }}'
        var image = '{{ $sekolah->logo }}'
        
        if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
            if(obj.files[0].size > 5242880){
                var mb = (5242880/1024/1024);
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File Logo harus lebih kecil dari '+mb+' MB',
                });
                $('.label-logo').html('<a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+image_url+'/'+image+'">'+image+'</a>');
                $("#inputFile").val('');
            }else{
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        // console.log(width+'x'+height);
                    };
                    $('.label-logo').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+e.target.result+'">'+text+'</a>');
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
            $('.label-logo').html('<a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+image_url+'/'+image+'">'+image+'</a>');
        }
    }

    function hasilgmbrdb(obj) {
            var url = $(obj).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var text = url.substring(12);
            if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(obj).closest('td').find('.label-gmbr').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+e.target.result+'">'+text+'</a>');
                }
                reader.readAsDataURL(obj.files[0]);                
            }
            else{
                swal({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda salah memasukan gambar. Gambar harus dalam format png/jpeg/jpg!',
               
                });
                    var gambarnya = $('.gmbr_db').val();
                // console.log(gambarnya)
                    var urlnya = "{{asset('file_app/galeri/galeri_image')}}"+"/"+gambarnya+"";
                    $(obj).val('');
                    $(obj).closest('td').find('.label-gmbr').html('<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="'+urlnya+'">'+gambarnya+'</a>');
               
            }
        }


        function lihat_gmbr(obj) {
            var img = $(obj).attr('data-gmbr');
            $('#gambar_modal').attr('src', img);
        }

        var runValidator = function () {
            var form = $('#form-sekolah');
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
                    nama: {
                        required: true
                    },
                    singkatan: {
                        required: true
                    },
                    alamat: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    url: {
                        required: true
                    },
                    no_tlp: {
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