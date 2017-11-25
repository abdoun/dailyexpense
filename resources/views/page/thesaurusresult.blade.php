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

@if(count($results)>0)
	<button class="btn btn-primary" type="button">
	  {{trans('thesaurus.total_records')}}: <span class="badge">{{count($count)}}</span>
	</button>
	@if($cate[0]['title']!='')
		<button class="btn btn-primary" type="button">
		{{trans('thesaurus.category')}} :<span class="badge">{{$cate[0]['title']}}</span>
		</button>
	@endif
	@if($term!='')
		<button class="btn btn-primary" type="button">
		  {{trans('thesaurus.term')}} :<span class="badge">{{$term}}</span>
		</button>
	@endif
{{--*/ $i = 1 /*--}}
<nav>
  <ul class="pagination">
    <li @if($input['rec']==0) class="disabled" @endif><a href="@if($input['rec']==0) # @else {{ asset('pages/thesaurusresult') }}/{{$input['term']}}/{{$input['category']}}/{{$input['rec']-10}} @endif" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	@for ($j = 0; $j <= (count($count)/10); $j++)
		<li @if($input['rec']==($j*10)) class="active" @endif><a href="{{ asset('pages/thesaurusresult') }}/{{$input['term']}}/{{$input['category']}}/{{$j*10}}">{{$j+1}}</a></li>
	@endfor
    <!--<li class="active"><a href="{{ asset('pages/thesaurusresult') }}/{{$input['term']}}/{{$input['category']}}/0">1</a></li>
    <li><a href="{{ asset('pages/thesaurusresult') }}/{{$input['term']}}/{{$input['category']}}/10">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>-->
    <li @if((($input['rec']/10)+1)>=(count($count)/10)) class="disabled" @endif><a href=" @if(($input['rec']/10)+1>=(count($count)/10)) # @else {{asset('pages/thesaurusresult')}}/{{$input['term']}}/{{$input['category']}}/{{$input['rec']+10}} @endif" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
  </ul>
</nav>
<table class="table table-hover">
  <tr><th>#</th><th>{{trans('thesaurus.term')}}</th>@if(Session::has('username')) <th>{{trans('thesaurus.edit')}}</th><th>{{trans('thesaurus.delete')}}</th> @endif</tr>
  @foreach ($results as $result)
	<tr data-toggle="popover" data-placement="bottom" data-trigger="focus" tabindex="0" title="" data-content="{{ $result->term }}"><td>{{$result->id}}</td><td>{{ $result->term }}</td>@if(Session::has('username')) <td><span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#thesaurus_edit_modal" style="color:#265a88;cursor:pointer;" aria-hidden="true" onclick="$.get('{{ asset('pages/editproperty') }}/{{$result->id}}',function(data){$('#thesaurus_edit_modal_').html(data);} );"></span></td><td><span class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#thesaurus_edit_modal" style="color:red;cursor:pointer;" aria-hidden="true" onclick="$.get('{{ asset('pages/deleteauthor') }}/{{$result->id}}',function(data){$('#thesaurus_edit_modal_').html(data);} );"></span></td> @endif</tr>
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
		<div class="alert alert-danger" role="alert">{{trans('thesaurus.no_record')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button></div>
		</div>
	</div>
@endif
@if(Session::has('username'))
<!-- Modal -->
<div class="modal fade" id="thesaurus_edit_modal" tabindex="-1" role="dialog" aria-labelledby="thesaurus_edit_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="thesaurus_edit_modalLabel">{{ trans('thesaurus.edit') }}</h4>
      </div>
      <div class="modal-body" id="thesaurus_edit_modal_">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload();">{{trans('thesaurus.close')}}</button>        
      </div>
    </div>
  </div>
</div>
@endif
@stop