@extends('front.master')

@section('content')
<section id="page-title">

<div class="container clearfix">
    <h1>@lang('homepage.regulasi')</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Regulasi</a></li> -->
        <li class="breadcrumb-item active" aria-current="page">@lang('homepage.regulasi')</li>
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
									<th>Tahun</th>
									<th>Tipe Peraturan</th>
									<th>Nomor Peraturan</th>
									<th>Tentang</th>
									<th></th>
								</tr>
							</thead>
							
							<tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($regulasi as $regulasi)
                                <tr>
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $regulasi->tahun }}</td>
                                    <td>{{ $regulasi->tipe_peraturan }}</td>
                                    <td>{{ $regulasi->nomor_peraturan }}</td>
                                    <td>{{ $regulasi->tentang }}</td>
                                    <td><a href="{{ asset('file_app/regulasi_file/'.$regulasi->file) }}" class="btn btn-primary btn-sm" download="">Download</td>
                                </tr>
                                @endforeach
                               
                               
							</tbody>
						</table>
					</div>

				</div>

			</div>

		</section>
@endsection