@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('membership.SIGNUP') }}
@stop

@section('content')
@if ($msg!='')
<div class="row">
	<div class="col-xs-12">
	<br />
	<div class="@if($msg=='thanks') alert alert-success @else alert alert-danger @endif"  role="alert">{{ trans("membership.$msg") }} 
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button></div>
	</div>
</div>
@endif
<form class="form-horizontal" id="signup_form" method="post"  action="{{ asset('membership/signup') }}">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <div class="form-group">
    <label for="email" class="col-xs-3 control-label">{{ trans('membership.email') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="email" name="email" placeholder="{{ trans('membership.email') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-xs-3 control-label">{{ trans('membership.username') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="username" name="username" placeholder="{{ trans('membership.username') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-xs-3 control-label">{{ trans('membership.password') }}:</label>
	<div class="col-sm-9 col-md-6">
		<input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('membership.password') }}">
	</div>
  </div>
  <div class="form-group @if($msg=='error_code_kaptcha') has-error @endif">
    <label for="code_capthca" class="col-xs-3 control-label">{{ trans('Title.code') }}:</label>
    <div class="col-xs-12 col-sm-3">
      <input type="text" class="form-control" id="code_capthca" name="code_capthca" placeholder="{{ trans('title.code') }}" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);">
    </div>
	<div class="col-xs-4 col-md-3">
      <img type="text" class="img-thumbnail" src="{{ asset('membership/imgcaptcha') }}" width="80" height="40" id="captcha_img" />
	  <button type="button" class="btn btn-default" aria-label="Left Align">
		<span class="glyphicon glyphicon-refresh" aria-hidden="true" onclick="document.getElementById('captcha_img').src = '{{ asset('membership/imgcaptcha') }}/' + Math.random();return false;"></span>
	  </button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
      <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('Titleresult') }}', $( '#Title_search' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('Title.search') }}</button>-->
      <button type="submit" class="btn btn-default">{{ trans('membership.signup') }}</button>
    </div>
  </div>
  
</form>
@stop