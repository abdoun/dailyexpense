@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('join.JOİN') }}
@stop
@section('content')
<form class="form-horizontal" id="kitap_ekle" method="post"  action="{{ asset('joinresult') }}">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <div class="form-group">
    <label for="name" class="col-xs-3 control-label">{{ trans('join.name') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('join.name') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">{{ trans('join.email') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('join.email') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="book_name" class="col-sm-3 control-label">{{ trans('join.book_name') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="book_name" name="book_name" placeholder="{{ trans('join.book_name') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="code_capthca" class="col-xs-3 control-label">{{ trans('join.code') }}:</label>
    <div class="col-xs-4 col-md-3">
      <input type="text" class="form-control" id="code_capthca" name="code_capthca" placeholder="{{ trans('join.code') }}">
    </div>
	<div class="col-xs-4 col-md-3">
      <img type="text" class="img-thumbnail" src="{{ asset('imgcaptcha') }}" width="80" height="40" id="captcha_img" />
	  <button type="button" class="btn btn-default" aria-label="Left Align">
		<span class="glyphicon glyphicon-refresh" aria-hidden="true" onclick="document.getElementById('captcha_img').src = '{{ asset('imgcaptcha') }}/' + Math.random();return false;"></span>
	  </button>
    </div>
  </div>
  <!--<div class="form-group">
    <label for="code" class="col-sm-2 control-label">{{ trans('join.code') }}</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="code" name="code" placeholder="{{ trans('join.code') }}" readonly value="{{ $cod or '100000' }}">
    </div>
  </div>-->
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('joinresult') }}', $( '#kitap_ekle' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('join.print') }}</button>
      <!--<button type="submit" class="btn btn-default">{{ trans('join.print') }}</button>-->
    </div>
  </div>
  
</form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('join.print') }}</h4>
      </div>
      <div class="modal-body" id="yaz_print">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="javascript:PrintDiv_('etiket');">{{ trans('join.print') }}</button>
      </div>
    </div>
  </div>
</div>
@stop