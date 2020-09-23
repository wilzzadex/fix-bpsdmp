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
                    Berita
                </li>
                
            </ol>
            <div class="page-header">
                <h1>Berita</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.publikasi.berita.add') }}" class="btn btn-success add-row pull-right">
                Tambah Berita <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Judul</th>
                        <th style="min-width:100px">Tanggal</th>
                        <th style="min-width:100px">Jumlah Hit</th>
                        <th style="min-width:100px">Status</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($berita as $berita)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $berita->judul_id }}</td>
                        <td>{{ date('d M Y',strtotime($berita->tanggal_awal)) }}</td>
                        <td>{{ $berita->hit }}</td>
                        <td><span class="badge badge-{{ $berita->is_draft == 1 ? 'warning' : 'success' }}">{{ $berita->is_draft == 1 ? 'Draft' : 'Publish' }}</span></td>
                        <td>
                            <a target="_blank" href="{{ route('publikasi.berita.detail',$berita->slug) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.publikasi.berita.edit',$berita->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-berita" id="{{ $berita->id }}"><i class="fa fa-trash"></i></button>
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

        $('.delete-berita').on('click',function(){
            var id = $(this).attr('id');
            swal({
                // title: "Are you sure?",
                text: "Yakin akan menghapus ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    
                    $.ajax({
                        url : '{{ route("admin.publikasi.berita.destroy") }}',
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