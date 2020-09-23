@extends('front.master')

@section('content')
<section id="page-title">

	<div class="container clearfix">
		<h1>@lang('homepage.s_result')</h1>
		<span>@lang('homepage.keyword') "{{ $_GET['q'] }}"</span>
		{{-- <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">@lang('messages.welcome')</li>
		</ol> --}}
	</div>

</section>
<section id="content">

	<div class="content-wrap">

		<div class="container clearfix">

			<gcse:searchresults-only></gcse:searchresults-only>

		</div>

	</div>
</section><!-- #content end -->
@stop

@section('modal')

@stop
@section('custom-script')
<script>
	(function() {
		var cx = '5ec5d5ec9b0316afe';
		var gcse = document.createElement('script');
		gcse.type = 'text/javascript';
		gcse.async = true;
		gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			'//www.google.com/cse/cse.js?cx=' + cx;
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(gcse, s);
	})();
</script>

@stop