<html @if($lang_default=='ar')dir="rtl" @else dir="ltr" @endif>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ trans('home.Title') }}</title>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
</head>
    <body>
	<div class="container" style="border:1px #f0f0f0 solid;">
	
	
		@section('header_bar')
		<nav class="navbar navbar-default" style="background-color:#8B9206;margin-bottom:0;min-height:20px;border:0px;">
			  <div class="container">
				<div class="navbar-header @if($lang_default=='ar') navbar-right @else navbar-left @endif">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				  </button>
				  <a class="navbar-brand href="#">{{ trans('home.Title') }}</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				<div>
				  <ul class="nav navbar-nav @if($lang_default=='ar') navbar-right pull-right @else navbar-left @endif">
					<li @if($active=='home') class="active" @endif @if($lang_default=='ar') style="float:right" @endif><a href="{{ asset('pages/index') }}">{{ trans('home.HOME') }}</a></li>
					<!--<li class="@if($active=='Title') active @endif" @if($lang_default=='ar') style="float:right" @endif><a href="{{ asset('pages/Title') }}">{{ trans('Title.title') }}</a></li>
					<li class="@if($active=='list') active @endif" @if($lang_default=='ar') style="float:right" @endif><a href="{{ asset('pages/list') }}"> {{ trans('list.LIST') }}</a></li>-->
					@if(Session::has('username'))
						<li class="dropdown @if($active=='membership') active @endif">
						  <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" class="dropdown-toggle">
						  {{trans('membership.membership')}}
							<span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" role="menu">
							<!--<li class="@if($active=='membership_login') active @endif"><a href="{{ asset('membership/login') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> {{ trans("membership.login") }}</a></li>-->
							<li class="@if($active=='membership_profile') active @endif"><a href="{{ asset('membership/profile') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ trans("membership.profile") }}</a></li>
							<li class="@if($active=='membership_changepass') active @endif"><a href="{{ asset('membership/changepass') }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> {{ trans("membership.changepass") }}</a></li>
							<li class="divider"></li>
							<li><a href="{{ asset('membership/logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> {{ trans("membership.logout") }}</a></li>
						  </ul>
						</li>
                        <li class="dropdown @if($active=='expense') active @endif">
						  <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" class="dropdown-toggle">
						  {{trans('page.expense')}}
							<span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" role="menu">
							<!--<li class="@if($active=='membership_login') active @endif"><a href="{{ asset('membership/login') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> {{ trans("membership.login") }}</a></li>-->
							<li class="@if($active=='transactions') active @endif"><a href="{{ asset('expense/transactions') }}"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> {{ trans("expense.transactionsedit") }}</a></li>
							<li class="@if($active=='categories') active @endif"><a href="{{ asset('expense/categories') }}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ trans("expense.categories") }}</a></li>
							<li class="divider"></li>
                            <li class="@if($active=='budget') active @endif"><a href="{{ asset('page/budget') }}"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> {{ trans("expense.budget") }}</a></li>
							<li><a href="{{ asset('page/report') }}"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> {{ trans("expense.report") }}</a></li>
                            <li><a href="{{ asset('page/charts') }}"><span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span> {{ trans("expense.charts") }}</a></li>
                            <li><a href="{{ asset('page/calendar') }}"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ trans("expense.calendar") }}</a></li>
                            <li class="divider"></li>
                            <li class="@if($active=='export_import') active @endif"><a href="{{ asset('page/export_import') }}"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> {{ trans("expense.export_import") }}</a></li>
						  </ul>
						</li>
					@else
						<li class="@if($active=='membership_login') active @endif"><a href="{{ asset('membership/login') }}">{{ trans('membership.LOGIN') }}</a></li>
                        <li class="@if($active=='membership_signup') active @endif"><a href="{{ asset('membership/signup') }}">{{ trans('membership.SIGNUP') }}</a></li>
					@endif
                    <li class="dropdown @if($active=='about') active @endif">
						  <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" class="dropdown-toggle">
						  {{trans('about.ABOUT')}}
							<span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" role="menu">
							<!--<li class="@if($active=='membership_login') active @endif"><a href="{{ asset('membership/login') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> {{ trans("membership.login") }}</a></li>-->
							<li class="@if($active=='about_project') active @endif"><a href="{{ asset('pages/aboutproject') }}"><span class="" aria-hidden="true"></span> {{ trans("about.about_pro") }}</a></li>
							<li class="@if($active=='about_me') active @endif"><a href="{{ asset('pages/aboutme') }}"><span class="" aria-hidden="true"></span> {{ trans("about.about_me") }}</a></li>
							
						  </ul>
						</li>
                    <li class="@if($active=='contacts') active @endif" @if($lang_default=='ar') style="float:right" @endif><a href="{{ asset('pages/contacts') }}">{{ trans('contacts.CONTACTS') }}</a></li>					
				  </ul>
				  <ul class="nav navbar-nav @if($lang_default=='ar') navbar-left @else navbar-right @endif">
					<li class="dropdown">
					  <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
					  @if($lang_default=='ar') عربي @elseif($lang_default=='en') English @elseif($lang_default=='de') Deutsch @elseif($lang_default=='tr') Türkçe @else {{trans('home.languages')}} @endif
						<span class="caret"></span>
					  </a> 
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li @if($lang_default=='en') class="active" @endif><a href="{{ asset('pages/lang/en') }}">English</a></li>
						<li @if($lang_default=='tr') class="active" @endif><a href="{{ asset('pages/lang/tr') }}">Türkçe</a></li>
                        <li @if($lang_default=='de') class="active" @endif><a href="{{ asset('pages/lang/de') }}">Deutsch</a></li>
						<li @if($lang_default=='ar') class="active" @endif><a href="{{ asset('pages/lang/ar') }}">عربي</a></li>
					  </ul>
					</li>
				  </ul>
				</div>
			  </div>
			</nav>
        @show
		
		<div class="row" style="border:1px #f0f0f0 solid;">
        @section('header')
            <div class="col-xs-12" style="padding:0"><img src="{{ asset('assets/images/ust1.jpg') }}" width="100%" height="40%" /> </div>
        @show
	</div>
        <div class="row" style="background-image:url('{{ asset('assets/images/bg.jpg') }}');background-repeat: repeat-x;background-position: top;">
			<div class="col-xs-12">
				<h2 style="text-align:center"> @yield('content_title', trans('home.HOME') ) </h2>
				@yield('content',trans('home.home_content'))
			</div>
			@section('footer')
				<div class="col-xs-12" style="padding:0;text-align:center;direction: ltr;"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>  Abdullah Alaswad</div>
			@show
		</div>
		
    </div>
    </body>
</html>