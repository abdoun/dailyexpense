@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('about.about_me') }}
@stop
@section('content')
<p>{{ trans('about.about_me') }}</p>
@stop