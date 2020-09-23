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
                    Event
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Event</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <a href="{{ route('admin.publikasi.event.add') }}" class="btn btn-success add-row pull-right">
                Tambah Event <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Judul</th>
                        <th style="min-width:100px">Tanggal</th>
                        <!-- <th style="min-width:100px">Jam</th> -->
                        <th style="min-width:150px">Lokasi</th>
                        {{-- <th style="min-width:100px">Thumbnail</th> --}}
                        <th style="">Jumlah Hit</th>
                        <th style="">Status</th>
                        <th style="min-width:100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no =1
                    @endphp
                    @foreach ($event as $event)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $event->judul_id }}</td>
                        <td>{{ date('d M Y',strtotime($event->tanggal_awal)) . " - " . date('d M Y',strtotime($event->tanggal_akhir)) . " " . $event->jam }}</td>
                        <td>{{ $event->lokasi }}</td>
                        <td>{{ $event->hit }}</td>
                        <td><span class="badge badge-{{ $event->is_draft == 1 ? 'warning' : 'success' }}">{{ $event->is_draft == 1 ? 'Draft' : 'Publish' }}</span></td>
                        <td>
                            <a target="_blank" href="{{ route('publikasi.event.detail',$event->slug) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.publikasi.event.edit',$event->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-xs btn-danger delete-event" id="{{ $event->id }}"><i class="fa fa-trash"></i></button>
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
            customSwal('success','Sukses !' ,'{{ session("sukses") }}')
        @endif
        $('.delete-event').on('click',function(){
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
                        url : '{{ route("admin.publikasi.event.destroy") }}',
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