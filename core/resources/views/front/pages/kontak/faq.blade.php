@extends('front.master')
@section('content')

<section id="page-title">

	<div class="container clearfix">
		<h1>Faq</h1>
		<!-- <span>Get in Touch with Us</span> -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Faq</li>
		</ol>
	</div>

</section>

<section id="section-faq" class="page-section mb-5" style="margin-top: 0px;">
	

	<div class="container clearfix">
		
		<div id="faqs" class="faqs mt-5">
			@foreach ($faq as $key => $faq)
			<div class="toggle faq faq-marketplace faq-authors">
				<div class="togglet"><i class="toggle-closed icon-comments-alt"></i><i
						class="toggle-open icon-comments-alt"></i>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $faq->pertanyaan_id : ( (!empty($faq->pertanyaan_en)) ? $faq->pertanyaan_en : $faq->pertanyaan_id ) : $faq->pertanyaan_id }}</div>
				<div class="togglec" style="display: none;">
					{!! Session::has('locale') ? Session::get('locale') == 'id' ? $faq->jawaban_id : ( (!empty($faq->jawaban_en)) ? $faq->jawaban_en : $faq->jawaban_id ) : $faq->jawaban_id !!}
				</div>
			</div>
			@endforeach
			
		</div>

	</div>

</section>

@endsection