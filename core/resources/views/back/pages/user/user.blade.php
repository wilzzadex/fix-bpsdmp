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
                    User 
                </li>
                <li class="active">
                    Manajemen User
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Manajemen User</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.user.add') }}" class="btn btn-success add-row pull-right">
                Tambah User <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="">Nama</th>
                        <th style="">Username</th>
                        <th style="">Role</th>
                        <th style="">Status</th>
                        <th style="">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}.</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                           
                            <input data-size="mini" class="switch-input" data-on-color="success" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-remove'></i>" data-label="fa fa-user" name="status" id="inp_{{ $user->id }}" onchange="tesChange('{{ $user->id }}')" type="checkbox" {{ $user->status == 1 ? 'checked' : '' }}>

                        </td>
                        <td>
                         <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                         <button id="{{ $user->id }}" class="btn btn-xs btn-danger delete-user"><i class="fa fa-trash"></i></button>
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

        $(document).ready(function(){
            $("input:checkbox[name=status]").bootstrapSwitch();
        })

        function tesChange(id){
            // var c_id  = $('#inp_'+id).attr('id')
            // console.log(c_id)
            swal({
                title: "Ubah Status Aktif",
                text: "Apakah anda yakin akan mengaktifkan kembali akun yang telah di blok ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                        $.ajax({
                            url : '{{ route("admin.user.active") }}',
                            type: 'GET',
                            data : {id : id},
                            success: function(res){
                                // console.log(res)
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

        $('.delete-user').on('click',function(){
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
                        url : '{{ route("admin.user.destroy") }}',
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