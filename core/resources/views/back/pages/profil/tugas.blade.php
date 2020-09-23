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
                    Profil
                </li>
                <li class="active">
                    Tugas & Fungsi
                </li>

            </ol>
            <div class="page-header">
                <h1>Tugas & Fungsi</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <form action="{{ route('admin.profil.tugas.update') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="tabbable">
                    <ul id="myTab4" class="nav nav-tabs tab-padding tab-space-3 tab-blue">
                        <li class="active">
                            <a href="#panel_tab3_example1" data-toggle="tab" aria-expanded="true">
                                Bahasa Indonesia (Default)
                            </a>
                        </li>
                        <li class="">
                            <a href="#panel_tab3_example2" data-toggle="tab" aria-expanded="false">
                                English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel_tab3_example1">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Tugas</label>
                                    <textarea name="tugas_id" class="ckeditor form-control" id="" cols="30" rows="10">{{ $tugas->deskripsi_id }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Fungsi</label>
                                    <textarea name="fungsi_id" class="ckeditor form-control" id="" cols="30" rows="10">{{ $fungsi->deskripsi_id }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="panel_tab3_example2">
                            <div class="form-group">
                                <label for="">Job</label>
                                <textarea name="tugas_en" class="ckeditor form-control" id="" cols="30" rows="10">{{ $tugas->deskripsi_en }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Function</label>
                                <textarea name="fungsi_en" class="ckeditor form-control" id="" cols="30" rows="10">{{ $fungsi->deskripsi_en }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success add-row pull-right">
                    Simpan Perubahan <i class="fa fa-save" aria-hidden="true"></i>
                </button>

            </div>
        </form>
    </div>
    <!-- end: PAGE CONTENT-->
</div>
@endsection
@section('custom-script')
    <script>
        @if(session('sukses'))
            customSwal('success','Sukses !','{{ session("sukses") }}')
        @endif

        $('form').submit(function(){
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
        })
    </script>
@endsection