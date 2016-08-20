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
<p>{{ trans('contacts.contacts') }}</p>
@stop