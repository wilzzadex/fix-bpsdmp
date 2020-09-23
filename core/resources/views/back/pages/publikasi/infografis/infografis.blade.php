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
                    Publikasi
                </li>
                <li class="active">
                    Infografis
                </li>
              
            </ol>
            <div class="page-header">
                <h1>Infografis</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.publikasi.infografis.add') }}" class="btn btn-success add-row pull-right">
                Tambah Infografis <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Nama</th>
                        <th style="min-width:100px">Thumbnail</th>
                        <th style="min-width:100px">Status</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1
                    @endphp
                    @foreach ($info as $info)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $info->judul_id }}</td>
                        <td><a href="#" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="{{ asset('file_app/infografis_image/'.$info->media) }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Lihat</a></td>
                        <td><span class="badge badge-{{ $info->is_draft==1 ? 'warning' : 'success' }}">{{ $info->is_draft==1 ? 'Draft' : 'Publish' }}</span></td>
                        <td> 
                            <a href="{{ route('admin.publikasi.infografis.edit',$info->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-info" id="{{ $info->id }}"><i class="fa fa-trash"></i></button>
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

        function lihat_gmbr(obj) {
            var img = $(obj).attr('data-gmbr');
            $('#gambar_modal').attr('src', img);
        }

        $('.delete-info').on('click',function(){
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
                        url : '{{ route("admin.publikasi.infografis.destroy") }}',
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