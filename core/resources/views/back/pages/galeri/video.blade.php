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
                    Video
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Video</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.galeri.video.add') }}" class="btn btn-success add-row pull-right">
                Tambah Video <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Judul</th>
                        <th style="min-width:150px">Video</th>
                        <th style="">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($video as $video)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $video->judul_id }}</td>
                        <td><a href="{{ $video->url_video }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-play"></i> Lihat Video</a></td>
                        <td>
                        <a href="{{ route('admin.galeri.video.edit',$video->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                             <button class="btn btn-xs btn-danger delete-video" id="{{ $video->id }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>


            <!-- end: DYNAMIC TABLE PANEL -->
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

        $('.delete-video').on('click',function(){
            var id = $(this).attr('id');
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
                        url : '{{ route("admin.galeri.video.destroy") }}',
                        type: 'GET',
                        data : {id: id,},
                        success:function(res){
                            // console.log(res)
                            swal("Data Berhasil di hapus!", {
                                icon: "success",
                            }).then(function() {
                                location.reload();
                            });
                            
                        }
                    })

                    
                }
            });
         });
    </script>
@endsection