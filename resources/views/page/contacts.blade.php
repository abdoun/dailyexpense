@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('contacts.CONTACTS') }}
@stop
@section('content')
<table class="table table-hover">
  <tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{trans('contacts.name')}}">
      <td>{{trans('contacts.name')}}:</td><td>Abdullah Alaswad</td>
  </tr>
  <tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{trans('contacts.tel')}}">
      <td>{{trans('contacts.tel')}}:</td><td>+49 176 47602988</td>
  </tr>
  <tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{trans('contacts.email')}}">
      <td>{{trans('contacts.email')}}:</td><td>abdoun79@gmail.com</td>
  </tr>
  <tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{trans('contacts.facebook')}}">
      <td>{{trans('contacts.facebook')}}:</td><td>https://www.facebook.com/abdullah.alasswad</td>
  </tr>
  </tr>
</table>
@stop