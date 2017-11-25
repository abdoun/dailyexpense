@extends('page.master')
@section('header')
	@parent
@stop
@section('header_bar')
	@parent
@stop
@section('content_title')
{{ trans('expense.categories') }}
@stop

@section('content')
@if(count($results)>0)
	<button class="btn btn-primary" type="button">
	  {{trans('Title.total_records')}}: <span class="badge">{{count($count)}}</span>
	</button>	
	@if($name!='')
		<button class="btn btn-primary" type="button">
		  {{trans('expense.categories')}} :<span class="badge">{{$name}}</span>
		</button>
	@endif
{{--*/ $i = 1 /*--}}
<nav>
  <ul class="pagination">
    <li @if($input['rec']==0) class="disabled" @endif><a href="@if($input['rec']==0) # @else {{ asset('expense/categories') }}/{{$input['name']}}/{{$input['rec']-10}} @endif" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	@for ($j = 0; $j <= (count($count)/10); $j++)
		<li @if($input['rec']==($j*10)) class="active" @endif><a href="{{ asset('expense/categories') }}/{{$input['name']}}/{{$j*10}}">{{$j+1}}</a></li>
	@endfor
    
    <li @if((($input['rec']/10)+1)>=(count($count)/10)) class="disabled" @endif><a href=" @if(($input['rec']/10)+1>=(count($count)/10)) # @else {{asset('expense/categories')}}/{{$input['name']}}/{{$input['rec']+10}} @endif" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
  </ul>
</nav>
<table class="table table-hover">
  <tr><th><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#categories_edit_modal" style="color:#008000;cursor:pointer;" aria-hidden="true" onclick="$.get('{{ asset('expense/editcategories') }}/new',function(data){$('#categories_edit_modal_').html(data);} );"></span></th><th>{{trans('expense.category')}}</th>@if(Session::has('username')) <th>{{trans('expense.edit')}}</th><th>{{trans('expense.delete')}}</th> @endif</tr>
  @foreach ($results as $result)
	<tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{ $result->name }}"><td>{{$result->id}}</td><td>{{ $result->name }}</td>@if(Session::has('username')) <td><span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#categories_edit_modal" style="color:#265a88;cursor:pointer;" aria-hidden="true" onclick="$.get('{{ asset('expense/editcategories') }}/{{$result->id}}',function(data){$('#categories_edit_modal_').html(data);} );"></span></td><td><span class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#categories_edit_modal" style="color:red;cursor:pointer;" aria-hidden="true" onclick="$.get('{{ asset('expense/delcategory') }}/{{$result->id}}',function(data){$('#categories_edit_modal_').html(data);} );"></span></td> @endif</tr>
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
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload();">{{trans('Title.close')}}</button>        
      </div>
    </div>
  </div>
</div>
@endif
@stop