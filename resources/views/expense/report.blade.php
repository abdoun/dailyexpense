@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('expense.report') }}
@stop

@section('content')
@if(count($res))
	<button class="btn btn-primary" type="button">
	  {{trans('expense.remaining')}}: <span class="badge">{{$resu_p-$resu_n}}</span>
	</button>
    <button class="btn btn-success" type="button">
	  {{trans('expense.income')}}: <span class="badge">{{$resu_p}}</span>
	</button>
    <button class="btn btn-danger" type="button">
	  {{trans('expense.expense')}}: <span class="badge">{{$resu_n}}</span>
	</button>
{{--*/ $i = 1 /*--}}
<nav>
  
</nav>
<table class="table table-hover">
  <tr><th></th><th>{{trans('expense.category')}}</th> <th>{{trans('expense.sum')}}</th><th>{{trans('expense.percentage')}}</th></tr>
  @foreach ($res as $cate=>$result)
	<tr style="@if($result<0) background-color: #FBB0B0; @else background-color: #B5FE9D; @endif" data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{ $cate }}"><td></td><td>{{$cate}}</td><td>{{ $result }}</td><td>@if($result<0) {{round($result*100/$resu_n,2)}} @else {{round($result*100/$resu_p,2)}} @endif %</td></tr>
	{{--*/ $i++ /*--}}
  @endforeach  
</table>
<script>$(function () {
  //$('tr').popover('hide');
  $('[data-toggle="popover"]').popover();
})</script>
@else
<div class="row">
		<div class="col-xs-12">
		<br />
		<div class="alert alert-danger" role="alert">{{trans('expense.no_record')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button></div>
		</div>
	</div>
@endif
@if(Session::has('username'))
<!-- Modal -->
<div class="modal fade" id="categories_edit_modal" tabindex="-1" role="dialog" aria-labelledby="categories_edit_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="categories_edit_modalLabel">{{ trans('expense.edit') }}</h4>
      </div>
      <div class="modal-body" id="categories_edit_modal_">
        ... hhhhkkkkkkkkkkkkkk
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload();">{{trans('expense.close')}}</button>        
      </div>
    </div>
  </div>
</div>
@endif
@stop