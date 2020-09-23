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
                    Struktur Organisasi
                </li>
                <li class="active">
                    Edit Struktur Organisasi
                </li>
                <li>
                    {{ $struktur->nama }}
                </li>
               
            </ol>
            <div class="page-header">
                <h1>         Edit Struktur Organisasi {{ $struktur->nama }}
</h1>
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
                    <form action="{{ route('admin.profil.struktur.update',$struktur->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                            
                            <div class="form-group">
                                    <div class="col-sm-4">
                                        <!-- <label for="">Gambar</label> -->
                                        <div id="kv-avatar-errors" class="center-block" style="display:none"></div>
                                        <div class="kv-avatar ">
                                            <img id="myImg" src="{{ asset('file_app/struktur_image/'.$struktur->img) }}" alt="users avatar" class="" height="200px">
                                            <br>
                                            <br>
                                            <label class="btn btn-sm btn-primary" style="cursor: pointer;width:100px;height:30px">Change<input type="file" name="img" accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  &nbsp; 
                                                <a href="#" id="btnReset" onclick="resetImage()" class="btn btn-sm btn-dark" style="height: 30px;display:none">Reset</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="recommendation">
                                            Keterangan:<br>
                                            <ul>
                                                <li>Rekomendasi Ukuran Gambar: 700x1000 pixel</li>
                                                <li>Ukuran File Image Maksimal: 5 Mb</li>
                                                <li>Format Gambar : jpg,jpeg,png</li>
                                            </ul>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-md-12 space20">
                                <!-- <a href="?menu=tambah_berita" class="btn btn-primary add-row">
                                    Simpan Ke Draft <i class="fa fa-paper-plane"></i>
                                </a> -->
                                <button type="submit" class="btn btn-success add-row pull-right">
                                    Simpan <i class="fa fa-save" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('admin.profil.struktur') }}" class="btn btn-default add-row pull-right">
                                    Batal <i class="fa fa-remove" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                
               
            </div>
        </div>
    </div>
    <!-- end: PAGE CONTENT-->
</div>
<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="content-modal" role="document">
      
    </div>
</div>
@endsection
@section('custom-script')
<script>
    @if(session('sukses'))
        customSwal('success','Sukses !','{{ session("sukses") }}')
    @endif

    $('form').submit(function(){
        myBlock()
    })

     var url_image =  '{{ asset("file_app/struktur_image/") }}';
     var image = '{{ $struktur->img }}'
    //  $("#struktur").fileinput({
    //         overwriteInitial: !0,
    //         maxFileSize: 2e3,
    //         showClose: !1,
    //         showCaption: !1,
    //         showRemove: !1,
    //         browseLabel: "",
    //         removeLabel: "",
    //         browseIcon: '<i class="glyphicon glyphicon-picture"></i> Ganti Gambar',
    //         removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    //         removeTitle: "Cancel or reset changes",
    //         elErrorContainer: "#kv-avatar-errors",
    //         msgErrorClass: "alert alert-block alert-danger",
    //         defaultPreviewContent: '<a href="#" onclick="modalShow()"><img class="text-center" width="200px" src="'+url_image+'/'+image+'" alt="Your Avatar" ></a>',
    //         layoutTemplates: {
    //             main2: "{preview} {remove} {browse}"
    //         },
    //         allowedFileExtensions: ["jpg", "png", "gif"]
    //  })

        function modalShow()
        {
            $('#content-modal').empty()
            $('#modalGambar').modal('show')
            
                $('#content-modal').append(`
                <center><img class="text-center" width="300px" style="width: 500px;border-radius: 10px;" src="`+url_image+`/`+image+`" ></center>
                `)
            

        }

        var url_image = '{{ asset("file_app/struktur_image") }}'
        var gambarnya = '{{ $struktur->img }}'

    function resetImage(){
        $('#myImg').attr('src',url_image+'/'+gambarnya)
        document.getElementById('btnReset').style.display = 'none'
    }

    function hasilgmbr(obj) {
        var url = $(obj).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var text = url.substring(12);
        
        if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
            if(obj.files[0].size > 5242880){
                var mb = (5242880/1024/1024);
                customSwal('error','Oopss..','Image size must be smaller than 5 MB !')
                $('#myImg').attr('src',url_image+'/'+gambarnya)
                $("#inputFile").val('');
                document.getElementById('btnReset').style.display = ''
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
                    // $('.label-gmbr').html('<a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" style="height:40px" class="btn btn-primary btn-sm" data-gmbr="'+e.target.result+'"> <i class="bx bx-show"></i> Show Image</a>');
                    // $('#judulGambar').html('Change Image')
                    $('#myImg').attr('src',e.target.result)
                    document.getElementById('btnReset').style.display = ''
                }
                reader.readAsDataURL(obj.files[0]);  
            }
                            
        }
        else{
            customSwal('error','Oopss..','The image format is not supported!')
            $('#myImg').attr('src',url_image+'/'+gambarnya)
            $(obj).val('');
            document.getElementById('btnReset').style.display = 'none'
        }
    }
</script>
@endsection