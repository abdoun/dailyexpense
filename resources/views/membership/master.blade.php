<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ trans('home.THESAURUS') }}</title>
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<style>
	.link{
		color:#fff;
		padding-right:10px;
	}
	
	.link:hover,.active,.active:hover{
		color:#D6E014;
		padding-right:10px;
		text-decoration:none;
	}
	</style>
</head>
    <body>
	<div class="container" style="border:1px #f0f0f0 solid;">
	<div class="row" style="border:1px #f0f0f0 solid;">
        @section('header')
            <div class="col-xs-12" style="padding:0"><img src="{{ asset('assets/images/ust1.jpg') }}" width="100%" /> </div>
        @show
	</div>
	<div class="row" style="background-color:#8B9206;">
		@section('header_bar')
			<div class="col-xs-9 col-sm-10">
				<a class="@if($active=='home') active @else link @endif" role="button" href="{{ asset('pages/index') }}">{{ trans('home.HOME') }}</a> 
				<a class="@if($active=='thesaurus') active @else link @endif" role="button" href="{{ asset('pages/thesaurus') }}">{{ trans('thesaurus.THESAURUS') }}</a> 
				<a class="@if($active=='list') active @else link @endif" role="button" href="{{ asset('pages/list') }}">{{ trans('list.LIST') }}</a> 
				<a class="@if($active=='contacts') active @else link @endif" role="button" href="{{ asset('pages/contacts') }}">{{ trans('contacts.CONTACTS') }}</a> 
				<a class="@if($active=='membership') active @else link @endif" role="button" href="{{ asset('membership/index') }}">{{ trans('membership.LOGIN') }}</a> 
				<!--<a class="@if($lang_default=='en') btn btn-primary @else btn btn-default @endif" role="button" href="{{ asset('lang/en') }}">English</a> 
				<a class="@if($lang_default=='tr') btn btn-primary @else btn btn-default @endif" role="button" href="{{ asset('lang/tr') }}">Türkçe</a>-->
			</div>
			<div class="col-xs-3 col-sm-2">
					<!--<select class="form-control" onchange="location.href=this.value;">
					  <option value="{{ asset('lang/en') }}" @if($lang_default=='en') selected @endif>English</option>
					  <option value="{{ asset('lang/tr') }}" @if($lang_default=='tr') selected @endif>Türkçe</option>
					</select>-->
					<div class="dropdown">
					  <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" class="link">
					  {{trans('home.languages')}}
						<span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="{{ asset('lang/en') }}" class="@if($lang_default=='en') active @else link @endif">English</a></li>
						<li><a href="{{ asset('lang/tr') }}" class="@if($lang_default=='tr') active @else link @endif">Türkçe</a></li>
					  </ul>
					</div>
				</div>
        @show
		</div>
		<div class="row" style="border:1px #f0f0f0 solid;">
			@section('header_bg')
				<div class="col-xs-12" style="padding:0"><img src="{{ asset('assets/images/ust2.jpg') }}" width="100%" /> </div>
			@show
		</div>
        <div class="row" style="background-image:url('{{ asset('assets/images/bg.jpg') }}');background-repeat: repeat-x;background-position: top;">
			<div class="col-xs-12">
				<h2 style="text-align:center"> @yield('content_title', trans('home.HOME') ) </h2>
				@yield('content',trans('home.home_content'))
			</div>
			@section('footer')
				<div class="col-xs-12" style="padding:0;text-align:center">Mikrobeta</div>
			@show
		</div>
		
    </div>
    </body>
</html>