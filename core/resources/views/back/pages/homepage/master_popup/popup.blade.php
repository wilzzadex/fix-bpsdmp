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
                    Master Popup
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Master Popup</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.popup.add') }}" class="btn btn-success add-row pull-right">
                Tambah Popup <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Nama File</th>
                        <th style="min-width:100px">File</th>
                        <th>Status Aktif</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($popup as $item)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $item->nama_file }}</td>
                        <td><a href="{{ asset('file_app/popup_image/'.$item->file) }}" target="_blank"><img style="width: 100px" class="img-thumbnail" src="{{ asset('file_app/popup_image/'.$item->file) }}" alt=""></td>
                        <td>
                        <input data-size="normal" class="switch-input" data-on-color="success" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-remove'></i>" data-label="fa fa-user" name="status" id="inp_{{ $item->id }}" onchange="tesChange('{{ $item->id }}')" type="checkbox" {{ $item->is_active == 1 ? 'checked' : ''  }}>
                        </td>
                        <td>
                         <a href="{{ route('admin.popup.edit',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                         <button class="btn btn-xs btn-danger delete-popup" id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
                icon:'success',
                title: 'Sukses!',
                text: '{{ session("sukses") }}'
            })
        @endif

        $(document).ready(function(){
            $("input:checkbox[name=status]").bootstrapSwitch();
        })

        $('.delete-popup').on('click',function(){
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
                        url : '{{ route("admin.popup.destroy") }}',
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

        function tesChange(id){
            // var c_id  = $('#inp_'+id).attr('id')
            // console.log(c_id)
            swal({
                title: "Ubah Status Aktif",
                text: "Apakah anda yakin akan mengubah status aktif ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                        $.ajax({
                            url : '{{ route("admin.popup.isactive") }}',
                            type: 'GET',
                            data : {id : id},
                            success: function(res){
                                console.log(res)
                                swal({
                                    icon:'success',
                                    text:"Status Berhasil di ubah",
                                }).then(function (){
                                    location.reload();
                                })
                               
                            }
                        })
                       
                } else {
                    location.reload();
                }
            });
        }
    </script>
@endsection