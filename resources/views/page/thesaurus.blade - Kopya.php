@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('thesaurus.thesaurus') }}
@stop
@section('content')
@if ($msg!='')
<div class="row">
	<div class="col-xs-12">
	<br />
	<p class="@if($msg=='thanks') bg-success @else bg-danger @endif">{{ trans("thesaurus.$msg") }}</p>
	</div>
</div>
@endif
<form class="form-horizontal" id="thesaurus_search" method="get"  action="{{ asset('pages/thesaurusresult') }}">
<!--<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />-->
  <div class="form-group">
    <label for="term" class="col-xs-3 control-label">{{ trans('thesaurus.term') }}:</label>
    <div class="col-sm-9 col-md-6">
      <input type="text" class="form-control" id="term" name="term" placeholder="{{ trans('thesaurus.term') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="category" class="col-sm-3 control-label">{{ trans('thesaurus.category') }}:</label>
    <div class="col-sm-9 col-md-6">
      <select class="form-control" id="category" name="category" placeholder="{{ trans('thesaurus.category') }}">
	  <option value=""></option>
	  @foreach ($cat as $cate)
		<option value="{{ $cate->id }}">{{ $cate->title }}</option>
	  @endforeach
	  </select>
    </div>
  </div>
  <div class="form-group @if($msg=='error_code_kaptcha') has-error @endif">
    <label for="code_capthca" class="col-xs-3 control-label">{{ trans('thesaurus.code') }}:</label>
    <div class="col-xs-4 col-md-3">
      <input type="text" class="form-control" id="code_capthca" name="code_capthca" placeholder="{{ trans('thesaurus.code') }}" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);">
    </div>
	<div class="col-xs-4 col-md-3">
      <img type="text" class="img-thumbnail" src="{{ asset('pages/imgcaptcha') }}" width="80" height="40" id="captcha_img" />
	  <button type="button" class="btn btn-default" aria-label="Left Align">
		<span class="glyphicon glyphicon-refresh" aria-hidden="true" onclick="document.getElementById('captcha_img').src = '{{ asset('pages/imgcaptcha') }}/' + Math.random();return false;"></span>
	  </button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('thesaurusresult') }}', $( '#thesaurus_search' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('thesaurus.search') }}</button>-->
      <button type="submit" class="btn btn-default">{{ trans('thesaurus.search') }}</button>
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