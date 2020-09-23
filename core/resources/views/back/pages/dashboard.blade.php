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
                    Dashboard
                </li>
              
            </ol>
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">

        <div class="col-sm-4">
            <div class="core-box col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <i class="fa fa-newspaper-o circle-icon circle-teal"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="card-title">{{ $jml_publikasi }}</p>
                        <p class="card-status">Jumlah Publikasi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="core-box col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <i class="fa fa-archive circle-icon circle-teal"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="card-title">{{ $jml_draft }}</p>
                        <p class="card-status">Jumlah Draft</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="core-box col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <i class="fa fa-bullhorn circle-icon circle-teal"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="card-title">{{ $jml_publish }}</p>
                        <p class="card-status">Jumlah Publish</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="row mt-5">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-external-link-square"></i> Berita Paling sering dilihat

                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover" id="sample-table-1">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Judul</th>
                                <th style="min-width: 100px;">Jumlah Hit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita_top as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->judul_id }}</td>
                                <td>{{ $item->hit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- end: PAGE CONTENT-->
</div>
@endsection