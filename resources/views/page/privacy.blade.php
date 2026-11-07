@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('privacy.privacy_notes') }}
@stop
@section('content')
<ul>
	<li>{{ trans('privacy.account_data') }}</li>
	<li>{{ trans('privacy.passwords') }}</li>
	<li>{{ trans('privacy.cookies_sessions') }}</li>
	<li>{{ trans('privacy.third_party') }}</li>
	<li>{{ trans('privacy.data_sharing') }}</li>
	<li>{{ trans('privacy.sensitive_data') }}</li>
	<li>{{ trans('privacy.data_requests') }}</li>
</ul>
@stop
