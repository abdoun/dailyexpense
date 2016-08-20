@if(Session::has('username'))
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
<form class="form-horizontal" method="post" name="edit_category" id="edit_category" action="">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<input type="hidden" name="id_category" value="{{$category[0]['id']}}" />
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">name: </label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{$category[0]['name']}}">
  </div>
</div>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">Notes: </label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="notes" name="notes" placeholder="notes" value="{{$category[0]['notes']}}">
  </div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
	  <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('thesaurusresult') }}', $( '#thesaurus_search' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('thesaurus.search') }}</button>-->
	  <button type="button" class="btn btn-default" onclick="$.post('{{ asset('expense/editcategories') }}', $( '#edit_category' ).serialize(),function(data){$('#categories_edit_modal_').html(data);} );">{{ trans('expense.ok') }}</button>
      <!--<button type="submit" class="btn btn-default">{{ trans('expense.ok') }}</button>-->
	</div>
</div>
</form>
@endif