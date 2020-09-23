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
                
            </ol>
            <div class="page-header">
                <h1>Album</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.galeri.foto.add') }}" class="btn btn-success add-row pull-right">
                Tambah Album <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Album</th>
                        <th>Album</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($album as $album)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $album->judul_id }}</td>
                        <td>
                            <a href="{{ route('galeri.foto.detail',$album->slug) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-picture-o"></i> Lihat Foto</a>
                        </td>
                        <td>
                        <a href="{{ route('admin.galeri.foto.edit',$album->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                             <button type="button" class="btn btn-xs btn-danger delete-album" id="{{ $album->id }}"><i class="fa fa-trash"></i></button>
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

        $('.delete-album').on('click',function(){
            var id = $(this).attr('id');
            swal({
                // title: "Are you sure?",
                text: "Yakin akan menghapus data ?" ,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    
                    $.ajax({
                        url : '{{ route("admin.galeri.foto.destroy") }}',
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