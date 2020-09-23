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
                    Master Data
                </li>
                <li class="active">
                    Slider Beranda
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Slider</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.slider.add') }}" class="btn btn-success add-row pull-right">
                Tambah Slider <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Judul</th>
                        <th style="min-width:100px">Gambar</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($slider as $slider)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $slider->judul_id }}</td>
                        <td>
                            <a href="{{ asset('file_app/slider_image/'.$slider->img) }}" target="_blank"><img src="{{ asset('file_app/slider_image/'.$slider->img) }}" class="img-thumbnail" style="width: 100px" alt=""></a>
                        </td>
                        <td>
                         <a href="{{ route('admin.slider.vedit',$slider->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                         <button class="btn btn-xs btn-danger slider-delete" id="{{ $slider->id }}"><i class="fa fa-trash"></i></button>
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
            swal({
                icon: 'success',
                title: 'Sukses...',
                text: '{{ session("sukses") }}',
            });
         @endif

         $('.slider-delete').on('click',function(){
            var id = $(this).attr('id');
            swal({
                // title: "Are you sure?",
                text: "Yakin akan menghapus slider ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    
                    $.ajax({
                        url : '{{ route("admin.slider.delete") }}',
                        type: 'GET',
                        data : {id: id,},
                        success:function(res){
                            swal("Slider Berhasil di hapus!", {
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