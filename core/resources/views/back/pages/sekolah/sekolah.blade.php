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
                <!-- <li class="active">
                    Event
                </li> -->
               
            </ol>
            <div class="page-header">
                <h1>Sekolah Kedinasan</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.sekolah.add') }}" class="btn btn-success add-row pull-right">
                Tambah <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-full-width dataTable" id="sample_1"
                aria-describedby="sample_1_info">
                <thead style="text-align: center">
                    <tr role="row">
                      <th>No</th>
                      <th>Nama</th>
                      <th>Singkatan</th>
                      <th>Matra</th>
                      <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sekolah as $key => $sekolah)
                    <tr>
                        
                        <td width="10px">{{ $key+1 }}.</td>
                        <td>{{ $sekolah->nama }}</td>
                        <td>{{ $sekolah->singkatan }}</td>
                        <td>{{ $sekolah->matra->nama }}</td>
                        <td><a href="{{ route('admin.sekolah.edit',$sekolah->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" id="{{ $sekolah->id }}" class="btn btn-danger btn-xs delete-sekolah"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
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

        $('.delete-sekolah').on('click',function(){
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
                        url : '{{ route("admin.sekolah.destroy") }}',
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