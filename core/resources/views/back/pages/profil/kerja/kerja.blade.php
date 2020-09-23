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
                    Kerja Sama
                </li>

            </ol>
            <div class="page-header">
                <h1>Kerja Sama</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.kerja.add') }}" class="btn btn-success add-row pull-right">
                Tambah <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Uraian</th>
                        <th>Institusi</th>
                        <!-- <th>Kategori</th> -->
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kerja_sama as $item)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ date('d M Y',strtotime($item->tanggal_kerjasama)) }}</td>
                        <td>{{ $item->uraian }}
                        </td>
                        <td>
                           {{$item->institusi}}</td>
                        <td>
                            <a href="{{ route('admin.kerja.edit',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-kerja" id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
    $('.delete-kerja').on('click',function(){
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
                        url : '{{ route("admin.kerja.destroy") }}',
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