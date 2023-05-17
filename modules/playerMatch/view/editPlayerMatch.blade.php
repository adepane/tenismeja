<?php
	$datamodul = $models['PlayerMatch']::find(request('data'));
?>

{{ Form::open(['url' => '/api/PlayerMatch/editPlayerMatchdata','class'=>'form form-horizontal parsley-validated','id'=>'feditPlayerMatch']) }}
{!! Form::hidden('PlayerMatchId', $datamodul->id, []) !!}
<div class="form-group row mb-3">
	<div class="col-md-12">
		{{ Form::label('Name','',['class'=>'form-label']) }}
		{{ Form::text('name',$datamodul->name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
	</div>
</div>
<div class="form-group row">
	<div class="col-md-12">
		<div class="d-flex justify-content-end">
			{{ Form::submit('Update',['class'=>'btn btn-primary','id'=>'submit']) }}
		</div>
	</div>
</div>
{{ Form::close() }}

<script>
jQuery(function(){
	$("#feditPlayerMatch").submit(function(event){
		event.preventDefault();
		event.stopPropagation();
		event.stopImmediatePropagation();
		if($(this).parsley( 'validate' )){
			let uri = $(this).attr('action');
			let dataSerialize = $(this).serialize();
			let modalbig = $('#md-large');
			axios({
				url:uri,
				headers:{
					'Authorization':defHeader,
					'accept':'application/json'
				},
				data:dataSerialize,
				method:"post"
			}).then(response => {
				toastr.success(response.data.message,'Success :)');
				table.ajax.reload(null, false);
				modalbig.modal('hide');
			}).catch(error => {
				toastr.error(error.data.message,'Error :(');
			});
		}else{
			toastr.error('','Error :(');
		}
	});
});
</script>