@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('membership.membership') }}
@stop

@section('content')
@if(Session::has('username'))
	@if ($msg!='')
	<div class="row">
		<div class="col-xs-12">
		<br />
		<div class="@if($msg=='thanks') alert alert-success @else alert alert-danger @endif" role="alert">{{ Session::get('username') }} {{ trans("membership.$msg") }} 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button></div>
		</div>
	</div>
	@endif
	<div class="list-group">
	  <a href="#" class="list-group-item active">
		{{ trans("membership.membership") }}
	  </a>
	  <!--<a href="{{ asset('membership/login') }}" class="list-group-item">{{ trans("membership.login") }}</a>-->
	  <a href="{{ asset('membership/profile') }}" class="list-group-item">{{ trans("membership.profile") }}</a>
	  <a href="{{ asset('membership/changepass') }}" class="list-group-item">{{ trans("membership.changepass") }}</a>
	  <a href="{{ asset('membership/logout') }}" class="list-group-item">{{ trans("membership.logout") }}</a>
	</div>
@endif
@stop