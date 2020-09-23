@extends('front.master')

@section('content')
<section id="page-title">

<div class="container clearfix">
    <h1>@lang('homepage.kerja_sama')</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Regulasi</a></li> -->
        <li class="breadcrumb-item active" aria-current="page">@lang('homepage.kerja_sama')</li>
    </ol>
</div>

</section>
<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="table-responsive ">
						<table id="datatable1" class="table table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="myTable_info">
							<thead>
								<tr>
									<th width="10px">No</th>
									<th>Nomor</th>
									<th>Tanggal</th>
									<th>Uraian</th>
									<th>Institusi</th>
									<!-- <th>Kategori</th> -->
									<th></th>
								</tr>
							</thead>
							
							<tbody>
                                @php
                                    $no =1;
                                @endphp
                                @foreach ($kerja as $kerja)
                                <tr>
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $kerja->nomor }}</td>
                                    <td>{{ date('d M Y',strtotime($kerja->tanggal_kerjasama)) }}</td>
                                    <td>{{ $kerja->uraian }}</td>
                                    <td>
                                        {{ $kerja->institusi }}</td>
                                    <td><a href="{{ asset('file_app/kerjasama_file/'.$kerja->file) }}" class="btn btn-primary btn-sm" download="">Download</td>
                                </tr>
                                @endforeach
                                
                                
                              
							</tbody>
						</table>
					</div>

				</div>

			</div>

		</section>
@endsection