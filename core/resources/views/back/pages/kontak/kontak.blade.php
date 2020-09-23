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
                    Kontak
                </li>
                <!-- <li class="active">
                    Slider Beranda
                </li> -->
              
            </ol>
            <div class="page-header">
                <h1>Kontak</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">
        <!-- <div class="col-md-12 space20">
            <a href="?menu=tambah_slider" class="btn btn-success add-row pull-right">
                Tambah Slider <i class="fa fa-plus"></i>
            </a>
        </div> -->
        <div class="col-md-12">
            <table class="table table-bordered table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th style="min-width:200px">Nama</th>
                        <th style="min-width:100px">Email</th>
                        <th style="min-width:150px">No Telpon</th>
                        <th style="min-width:150px">Subjek</th>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kontak as $key => $kontak)
                    <tr id="bg_{{ $kontak->id }}" class="{{ $kontak->is_read == 0 ? 'bg-info' : ''  }}">
                        <td>{{ $key+1 }}.</td>
                        <td>{{ $kontak->nama }}</td>
                        <td>{{ $kontak->email }}</td>
                        <td>{{ $kontak->no_telp }}</td>
                        <td>{{ $kontak->subject }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary show" data-toggle="modal" data-target="#myModal" id="{{ $kontak->id }}"><i class="fa fa-commenting"></i> Lihat Pesan</a>
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

{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Isi Pesan</h4>
      </div>
      <div class="modal-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde illum repellat quos, voluptatem rem ullam distinctio esse aliquid tempore incidunt quisquam facilis itaque nostrum autem ducimus. Aspernatur modi ipsam recusandae.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div> --}}
<div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  
</div>
@endsection

@section('custom-script')
    <script>
         $(document).ready(function() {
            $("#sample_1").on("click",".show",function(){
                var m = $(this).attr("id");
                console.log(m);
                $.ajax({
                    url: "{{ route('admin.kontak.show') }}",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        // console.log(ajaxData)

                        $("#modalPesan").html(ajaxData);
                        $("#modalPesan").modal('show');
                        $("#bg_"+m).removeClass('bg-info')
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