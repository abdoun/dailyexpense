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

{{print_r($_POST)}}
@stop