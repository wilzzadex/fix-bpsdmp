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
                    Sosial Media
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Sosial Media</h1>
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
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Nama</th>
                        <th style="min-width:100px">Url</th>
                        <th style="min-width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($smedia as $smedia)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ ucfirst($smedia->flag) }}</td>
                        <td>{{ $smedia->url }}</td>
                        <td>
                         <button class="btn btn-sm btn-info editurl" id="{{ $smedia->id }}" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="urlModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  
</div>

    
@endsection
@section('custom-script')
    <script>

        @if(session('sukses'))
            swal({
                icon : 'success',
                title : 'Sukses !',
                text : '{{ session("sukses") }}'
            })
        @endif

        $('#urlModal').on('submit','form',function(){
            $('#urlModal').block({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
        })

        $(document).ready(function() {
            $("#sample_1").on("click",".editurl",function(){
                var m = $(this).attr("id");
                // console.log(m);
                $.ajax({
                    url: "social-media/"+m+"/edit",
                    type: "GET",
                    // data : {id: m,},
                    success: function (ajaxData){
                        // console.log(ajaxData)
                        $("#urlModal").html(ajaxData);
                        $("#urlModal").modal('show');
                    },
                    error: function(err)
                    {
                        console.log(err);
                    }
                });
            });
        })
    </script>
@endsection