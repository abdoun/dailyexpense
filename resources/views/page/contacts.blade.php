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

    <tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="GitHub">
      <td>GitHub:</td><td>https://www.github.com/abdoun</td>
  </tr>
</table>
@stop