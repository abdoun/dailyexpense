@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('passwords.forgetpass') }}
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
<form class="form-horizontal" id="thesaurus_search" method="post"  action="{{ asset('membership/forgetpass') }}">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <div class="form-group">
    <label for="username" class="col-xs-3 control-label">{{ trans('membership.username') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="username" name="username" placeholder="{{ trans('membership.username') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-xs-3 control-label">{{ trans('membership.email') }}:</label>
	<div class="col-sm-9 col-md-6">
		<input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('membership.email') }}">
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
    <div class="col-sm-offset-3 col-sm-4">
      <button type="submit" class="btn btn-default">{{ trans('passwords.send') }}</button>
    </div>
  </div>
  
</form>
@stop