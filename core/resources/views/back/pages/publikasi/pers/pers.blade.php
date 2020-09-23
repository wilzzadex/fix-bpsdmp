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
                    Siaran Pers
                </li>
                
            </ol>
            <div class="page-header">
                <h1>Siaran Pers</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.publikasi.pers.add') }}" class="btn btn-success add-row pull-right">
                Tambah <i class="fa fa-plus"></i>
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
                        <th>Status</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pers as $pers)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pers->judul_id }}</td>
                        <td>{{ date('d M Y',strtotime($pers->tanggal_awal)) }}</td>
                        <td>{{ $pers->hit }}</td>
                        <td><span class="badge badge-{{ $pers->is_draft==1 ? 'warning' : 'success' }}">{{ $pers->is_draft==1 ? 'Draft' : 'Publish' }}</span></td>

                        <td>
                            <a target="_blank" href="{{ route('publikasi.pers.detail',$pers->slug) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.publikasi.pers.edit',$pers->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-pers" id="{{ $pers->id }}"><i class="fa fa-trash"></i></button>
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

        $('.delete-pers').on('click',function(){
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
                        url : '{{ route("admin.publikasi.pers.destroy") }}',
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