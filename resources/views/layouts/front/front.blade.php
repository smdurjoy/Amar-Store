<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Amar Store</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{asset('css/frontCSS/front.min.css')}}" media="screen"/>
	<link href="{{asset('css/frontCSS/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{asset('css/frontCSS/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('css/frontCSS/custom.css')}}" rel="stylesheet"/>
	<link href="{{asset('css/frontCSS/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{asset('js/frontJS/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
	<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('images/frontImages/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/frontImages/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/frontImages/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/frontImages/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('images/frontImages/ico/apple-touch-icon-57-precomposed.png')}}">
	<style type="text/css" id="enject"></style>
</head>
<body>
<!-- header -->
@include('layouts.front.header')

@include('front.banners.homePageBanner')

<div id="mainBody">
	<div class="container">
		<div class="row">
            <!-- sidebar -->
        @include('layouts.front.sidebar')

		@yield('content')
		</div>
	</div>
</div>
<!-- footer -->
@include('layouts.front.footer')

<script src="{{asset('js/frontJS/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('js/frontJS/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('js/frontJS/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/frontJS/google-code-prettify/prettify.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>
<script src="{{asset('js/frontJS/front.js')}}"></script>
<script src="{{asset('js/frontJS/script.js')}}"></script>
<script src="{{asset('js/frontJS/jquery.lightbox-0.5.js')}}"></script>
@yield('script')
</body>
</html>
