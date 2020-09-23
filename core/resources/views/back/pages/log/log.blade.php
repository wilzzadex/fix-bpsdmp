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
                    Log
                </li>
                
               
            </ol>
            <div class="page-header">
                <h1>Log</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 space20">
            <!-- <a href="?menu=tambah_slider" class="btn btn-success add-row pull-right">
                Tambah Slider <i class="fa fa-plus"></i>
            </a> -->
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-full-width" id="dataTable">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th style="min-width:200px">Aksi</th>
                        <th>Halaman</th>
                        <th>Tanggal</th>
                        <!-- <th style="min-width:150px">Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log as $key => $logs)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $logs->name}}</td>
                        <td>{{ $logs->username}}</td>
                        <td>{{ $logs->action}}</td>
                        <td>{{ $logs->page}}</td>
                        <td>{{ $logs->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="pull-right">{{ $log->links() }}</div>
        </div>
    </div>
    <!-- end: PAGE CONTENT-->
</div>
@endsection
@section('custom-script')
    <script>
        $('#dataTable').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false
        });
    </script>
@endsection