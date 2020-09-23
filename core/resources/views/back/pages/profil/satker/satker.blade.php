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
                    Satuan kerja
                </li>
               
            </ol>
            <div class="page-header">
                <h1>Satuan Kerja</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>
    <!-- end: PAGE HEADER -->
    <!-- start: PAGE CONTENT -->
    <div class="row">

    <div class="col-md-12">
            <table id="example" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th width="15px"></th>
                        <th >Nama</th>
                        <th>Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($single as $single)
                    <tr>
                        <td></td>
                        <td width="493px">{{ $single->nama }}</td>
                        <td width="400px">{{ date('d M Y',strtotime($single->updated_at))  }}</td>
                        <td><a href="{{ route('admin.profil.satuan.edit',$single->slug) }}" class="btn btn-info btn-xs">Edit</a></td>
                    </tr>
                    @endforeach
                    @foreach ($parent as $parent)
                    <tr>
                        <td class="details-control" data-id="{{ $parent->id }}"></td>
                        <td>{{ $parent->nama }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            <!-- <a href="?menu=sejarah" class="btn btn-success add-row pull-right">
                Ubah</i>
            </a> -->

        </div>
    </div>
    <!-- end: PAGE CONTENT-->
</div>
@endsection
@section('custom-script')
    <script>
        function formatTanggal(tanggal)
        {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            let dateObj = new Date(tanggal);
            let month = monthNames[dateObj.getMonth()];
            let day = String(dateObj.getDate()).padStart(2, '0');
            let year = dateObj.getFullYear();
            let output = day + ' ' + month  + ' ' + year;
            return output;
        }
        function listTable (data) {
            
            return data;
        }
        $(document).ready(function(){
            var table = $('#example').DataTable()

            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var id_parent = $(this).attr('data-id')
                var table_header = `<table cellpadding="5" class="table table-bordered" cellspacing="0" border="0" style="padding-left:50px;">`
                var table_footer = `</table>`
                   
                   
                // console.log($(this).attr('data-id'))
                var isi = '';
               
                $.ajax({
                    url : '{{ route("admin.profil.satuan.child") }}',
                    type : 'get',
                    data: {
                        id:id_parent
                    },
                    beforeSend: function(res){
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    },
                    success: function (response) {
                        var no = 1
                        $.each(response, function(key, data) {
                            // var tanggal = data.updated_at( moment().format('MMM D, YYYY') );
                           
                            isi += `<tr>
                                        <td width="28px">`+(no++)+`.</td>
                                        <td width="493px">`+data.nama+`</td>
                                        <td width="400px">`+formatTanggal(data.updated_at) +`</td>
                                        <td><a href="{{ url('admin/profil/satuan-kerja/`+data.slug+`/edit') }}" class="btn btn-info btn-xs">Edit</a></td>
                                    </tr>`
                        });

                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                            // Open this row
                            row.child( listTable(table_header + isi + table_footer) ).show();
                            tr.addClass('shown');
                        }

                        $.unblockUI()
                        
                    },
                    error: function (xhr) {
                        console.log(xhr)
                    }
                })

        
                
            } );
            
        })
    </script>
@endsection