@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('list.LIST') }}
@stop

@section('content')
<p>{{ trans('list.list') }}</p>
@stop