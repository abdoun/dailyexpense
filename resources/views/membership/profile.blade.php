@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('membership.profile') }}
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

  
</form>
@stop