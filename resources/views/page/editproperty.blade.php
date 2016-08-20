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
<form class="form-horizontal" method="post" name="edit_author" id="edit_author" action="">
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<input type="hidden" name="id_author" value="{{$author[0]['id']}}" />
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">{{ trans('thesaurus.term') }}:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="term" name="term" placeholder="{{ trans('thesaurus.term') }}" value="{{$author[0]['title']}}">
  </div>
</div>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">Scope Note:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="scope_note" name="scope_note" placeholder="Scope Note" value="{{$author[0]['scope_note']}}">
  </div>
</div>
<div class="form-group">
  <label for="term" class="col-xs-3 control-label">birth death:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="birth_death" name="birth_death" placeholder="birth death" value="{{$author[0]['birth_death']}}">
  </div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
	  <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="$.post('{{ asset('thesaurusresult') }}', $( '#thesaurus_search' ).serialize(),function(data){$('#yaz_print').html(data);} );">{{ trans('thesaurus.search') }}</button>-->
	  <button type="button" class="btn btn-default" onclick="$.post('{{ asset('pages/editauthor') }}', $( '#edit_author' ).serialize(),function(data){$('#thesaurus_edit_modal_').html(data);} );">{{ trans('thesaurus.edit') }}</button>
	</div>
</div>
</form>
@foreach ($category as $kat)
    <span class="label label-primary">{{ $kat->title }}</span>
@endforeach
 <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#thesaurus_edit_property_modal" style="color:#265a88;cursor:pointer;" onclick="$.get('{{ asset('pages/editcatid') }}/{{$author[0]['id']}}',function(data){$('#thesaurus_edit_property_modal_').html(data);} );"></span>
<!-- Modal -->
<div class="modal fade bs-example-modal-sm" data-backdrop="static" data-keyboard="false" id="thesaurus_edit_property_modal" tabindex="-1" role="dialog" aria-labelledby="thesaurus_edit_property_modalLabel" aria-hidden="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close"  onclick="$('#thesaurus_edit_property_modal').modal('hide');$.get('{{ asset('pages/deleteauthor') }}/{{$author[0]['id']}}',function(data){$('#thesaurus_edit_modal_').html(data);} );" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="thesaurus_edit_property_modalLabel">{{ trans('thesaurus.edit') }}</h4>
      </div>
      <div class="modal-body" id="thesaurus_edit_property_modal_">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="$('#thesaurus_edit_property_modal').modal('hide');$.get('{{ asset('pages/editproperty') }}/{{$author[0]['id']}}',function(data){$('#thesaurus_edit_modal_').html(data);} );">{{trans('thesaurus.close')}}</button>        
      </div>
    </div>
  </div>
</div>
@endif