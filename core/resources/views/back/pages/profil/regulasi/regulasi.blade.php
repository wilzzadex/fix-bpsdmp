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
                    Homepage
                </li>
                <li class="active">
                    Regulasi & Kebijakan
                </li>

            </ol>
            <div class="page-header">
                <h1>Regulasi & Kebijakan</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.regulasi.add') }}" class="btn btn-success add-row pull-right">
                Tambah <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Tahun</th>
                        <th>Tipe Peraturan</th>
                        <th>Nomor Peraturan</th>
                        <th>Tentang</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($regulasi as $regulasi)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $regulasi->tahun }}</td>
                        <td>{{ $regulasi->tipe_peraturan }}</td>
                        <td>{{ $regulasi->nomor_peraturan }}</td>
                        <td>{{ $regulasi->tentang }}</td>
                        <td>
                            <a href="{{ route('admin.regulasi.edit',$regulasi->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-regulasi" id="{{ $regulasi->id }}"><i class="fa fa-trash"></i></button>
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

        $('.delete-regulasi').on('click',function(){
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
                        url : '{{ route("admin.regulasi.destroy") }}',
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