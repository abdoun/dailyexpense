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
@if($msg=='thanks') <script>location.reload();</script> @endif
@endif
<form class="form-horizontal" method="post" name="edit_transaction" id="edit_transaction" action="">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<input type="hidden" name="id" value="{{$expenditure[0]['id']}}" />
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">{{trans('expense.value')}}: </label>
  <div class="col-sm-1">
  <select name="to_from" id="to_from" >
    <option value="to" @if($expenditure[0]['to_from']=='to') selected @endif>-</option>
    <option value="from" @if($expenditure[0]['to_from']=='from') selected @endif>+</option>
    </select>
  </div>
  <div class="col-sm-8">
    <input type="number" min="0" step="1" data-bind="value:replyNumber" class="form-control" id="qty" name="qty" placeholder="value" value="{{$expenditure[0]['qty']}}">
  </div>
</div>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">{{trans('expense.date')}}: </label>
  <div class="col-sm-9">
    <input data-provide="datepicker" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="date_time" name="date_time" placeholder="date" value="{{$expenditure[0]['date_time']}}">
  </div>
</div>
<script>$('.datepicker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    //daysOfWeekDisabled: "0",
    daysOfWeekHighlighted: "0",
    todayHighlight: true});</script>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">{{trans('expense.category')}}: </label>
  <div class="col-sm-9">
    <select class="form-control" id="category" name="category">
    @foreach ($category as $result)
    <option value="{{ $result->id }}" @if($expenditure[0]['category']==$result->id) selected @endif >{{ $result->name }}</option>
    @endforeach
    </select>
  </div>
</div>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">{{trans('expense.notes')}}: </label>
  <div class="col-sm-9">
    <textarea class="form-control" name="notes" id="notes">{{$expenditure[0]['notes']}}</textarea>
  </div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
	  <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('thesaurusresult') }}', $( '#thesaurus_search' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('thesaurus.search') }}</button>-->
	  <button type="button" class="btn btn-default" onclick="$.post('{{ asset('expense/edittansactions') }}', $( '#edit_transaction' ).serialize(),function(data){$('#transactions_edit_modal_').html(data);} );">{{ trans('membership.ok') }}</button>
      <!--<button type="submit" class="btn btn-default">{{ trans('expense.ok') }}</button>-->
	</div>
</div>
</form>
@endif