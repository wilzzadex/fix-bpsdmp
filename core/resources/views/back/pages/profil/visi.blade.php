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
                    Visi Misi
                </li>
                
            </ol>
            <div class="page-header">
                <h1>Visi Misi</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">

        <div class="col-md-12">
            <form action="{{ route('admin.profil.visi.update') }}" method="POST">
                {{ csrf_field() }}
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
                                <label for="">Visi (ID)</label>
                                <textarea name="visi_id" class="ckeditor form-control" cols="30" rows="10">{{ $visi->deskripsi_id }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Misi (ID)</label>
                                <table class="table table-bordered" style="width: 100%;">
                                    <tbody  id="misi">
                                        @foreach ($misi_id as $key => $misi_id)
                                        <tr id="misiid_{{ $key }}">
                                            <td><input placeholder="Misi ..." value="{{ $misi_id->deskripsi_id }}" type="text" class="form-control" name="misi_id[]"></td>
                                            <td> &nbsp<button type="button" class="btn btn-danger btn-sm remove-misi" onclick="removeMisi('{{ $key }}')"> <i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <br>
                            <button class="btn btn-primary btn-sm" type="button" onclick="addMisi()">Tambah Misi</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="panel_tab3_example2">
                            <div class="form-group">
                                <label for="">Visi (EN)</label>
                                <textarea name="visi_en" class="ckeditor form-control" cols="30" rows="10">{{ $visi->deskripsi_en }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Misi (EN)</label>
                                <table class="table table-bordered" style="width: 100%;">
                                    <tbody  id="misiEn">
                                        @foreach ($misi_en as $key => $misi_en)
                                        <tr id="misien_{{ $key }}">
                                            <td><input placeholder="Misi ..." value="{{ $misi_en->deskripsi_en }}" type="text" class="form-control" name="misi_en[]"></td>
                                            <td> &nbsp<button type="button" class="btn btn-danger btn-sm remove-misi" onclick="removeMisiEn('{{ $key }}')"> <i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>   
                                </table>
                            <br>
                            <button class="btn btn-primary btn-sm" type="button" onclick="addMisiEn()">Tambah Misi</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success add-row pull-right">
                    Simpan Perubahan <i class="fa fa-save" aria-hidden="true"></i>
                </button>
            </form>
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

    misi_id = 1;
    function addMisi(){
        $('#misi').append(`
            <tr id="misiid_`+misi_id+`">
                <td><input placeholder="Misi ..." type="text" class="form-control" name="misi_id[]"></td>
                <td> &nbsp<button type='button' class="btn btn-danger btn-sm remove-misi" onclick="removeMisi(`+misi_id+`)"> <i class="fa fa-trash"></i></button></td>
            </tr>
        `)
        misi_id++
    }
    misi_en = 1;
    function addMisiEn(){
        $('#misiEn').append(`
            <tr id="misien_`+misi_en+`">
                <td><input placeholder="Misi ..." type="text" class="form-control" name="misi_en[]"></td>
                <td> &nbsp<button type='button' class="btn btn-danger btn-sm remove-misi" onclick="removeMisiEn(`+misi_en+`)"> <i class="fa fa-trash"></i></button></td>
            </tr>
        `)
        misi_en++
    }
    function removeMisi(id){
       
       myBlock()
         
        setTimeout($.unblockUI, 1000)
        
            $('#misiid_'+id).remove() 
       
           
       
        
    }
    function removeMisiEn(id){
       
        myBlock()
         
        setTimeout($.unblockUI, 1000)
        $('#misien_'+id).remove() 
    }
</script>
@endsection