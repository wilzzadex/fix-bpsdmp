@extends('front.master')
@section('custom-css')
<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
	.validate {
		color: #E42C3E;
		border-color: #E42C3E;
	}

	/* .validate input{
		border-color: #E42C3E;
	} */
</style>

@endsection
@section('content')

<section id="page-title">

	<div class="container clearfix">
		<h1>@lang('homepage.kontak')</h1>
		<!-- <span>Get in Touch with Us</span> -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">@lang('homepage.kontak')</li>
		</ol>
	</div>

</section>

<section id="content" style="margin-bottom: 0px;">

	<div class="content-wrap">

		<div class="container clearfix">

			<div class="postcontent nobottommargin">

				<div class="fancy-title title-dotted-border">
					<h3>@lang('kontak.kirim_kami')</h3>
				</div>


				{{-- <div class="form-result"></div> --}}

				<form class="nobottommargin" id="form-slider" action="{{ route('kontak.store') }}" method="post">
					{{ csrf_field() }}
					{{-- <div class="form-process"></div> --}}

					<div class="col_one_third validate">
						<label for="template-contactform-email">@lang('kontak.nama') <small>*</small></label>
						<input type="text" value="{{ old('nama') }}" name="nama" required class="sm-form-control">
					</div>

					<div class="col_one_third validate">
						<label for="template-contactform-email">@lang('kontak.email') <small>*</small></label>
						<input type="email" value="{{ old('email') }}" name="email" required class="sm-form-control">
					</div>

					<div class="col_one_third col_last validate">
						<label for="template-contactform-phone">@lang('kontak.no_tlp')</label>
						<input type="text" value="{{ old('no_tlp') }}" onkeypress="return onlyNumberKey(event)" name="no_tlp" required
							class="sm-form-control">
					</div>

					<div class="clear"></div>

					<div class="col_full validate">
						<label for="template-contactform-subject">@lang('kontak.subjek') <small>*</small></label>
						<input type="text" value="{{ old('subjek') }}" name="subjek" required class="sm-form-control">
					</div>


					<div class="clear"></div>

					<div class="col_full validate">
						<label for="template-contactform-message">@lang('kontak.pesan') <small>*</small></label>
						<textarea class="sm-form-control" required name="pesan" rows="6" cols="30">{{ old('pesan') }}</textarea>
					</div>


					<div class="col_full">
						<div class="col-md-6 pull-center">
							{!! app('captcha')->display() !!}

							@if ($errors->has('g-recaptcha-response'))
							<span class="text-danger">
								<strong>Invalid Captcha !</strong>
							</span>
							@endif
						</div>
					</div>


					<div class="col_full">
						<button class="button button-3d nomargin" type="submit"
							value="submit">@lang('kontak.kirim')</button>
					</div>

					{{-- <input type="hidden" name="prefix" value="template-contactform-"> --}}

				</form>

			</div>
			<div class="sidebar col_last nobottommargin">

				<i class="fa fa-map-marker" aria-hidden="true"></i>{{ $alamat->alamat }}<br>
				<i class="fa fa-phone" aria-hidden="true"></i> {{ $alamat->no_telp }} <br>
				<i class="fa fa-envelope" aria-hidden="true"></i> {{ $alamat->email }}
				<div class="widget noborder notoppadding">


				</div>

				<div class="widget noborder notoppadding">

					@foreach ($smedia as $med)
					<a href="{{ $med->url }}" target="_blank"
						class="social-icon si-small si-dark si-{{ $med->flag }}">
						<i class="icon-{{ $med->flag }}"></i>
						<i class="icon-{{ $med->flag }}"></i>
					</a>
					@endforeach
				</div>

			</div>
			<!-- Post Content
					============================================= -->
			<!-- .postcontent end -->


		</div>
	</div>


</section>

@endsection
@section('custom-script')
<script>

	@if ($errors->has('g-recaptcha-response'))
		swal({
			icon: 'error',
			text: 'Invalid Captcha !'
		})
	@endif

	@if (session('sukses'))
		swal({
			icon: 'success',
			text: '@lang("kontak.alert")'
		})
	@endif

	function onlyNumberKey(evt) {

		// Only ASCII charactar in that range allowed 
		var ASCIICode = (evt.which) ? evt.which : evt.keyCode
		if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
			return false;
		return true;
	}


	var runValidator = function () {
		var form = $('#form-slider');
		var errorHandler = $('.errorHandler', form);
		var successHandler = $('.successHandler', form);

		form.validate({
			errorElement: "span", // contain the error msg in a span tag
			errorClass: 'help-block',
			errorPlacement: function (error, element) { // render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
					error.insertAfter($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore: "",
			rules: {

			},
			messages: {
				// nama  : "Judul Bahasa Indonesia tidak boleh kosong !",
				// img : "Gambar Slider Tidak Boleh Kosong",
			},
			invalidHandler: function (event, validator) { //display error alert on form submit
				successHandler.hide();
				errorHandler.show();
			},
			highlight: function (element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.validate ').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
				// add the Bootstrap error class to the control group
				$('#btn_tab_id').trigger('click');

			},
			unhighlight: function (element) { // revert the change done by hightlight
				$(element).closest('.validate ').removeClass('has-error');
				// set error class to the control group

			},
			success: function (label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.validate ').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
			},
			submitHandler: function (form) {
				$('#alert').hide();
				successHandler.show();
				errorHandler.hide();
				// submit form
				if (successHandler.show()) {
					myBlock2()
					form.submit();
				}
			}
		});
	};
	runValidator();

</script>
@endsection