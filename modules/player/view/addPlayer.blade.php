{{ Form::open(array('url' => '/api/player/addPlayerData','class'=>'form form-horizontal parsley-validated','id'=>'fPlayer')) }}
<div class="form-group row mb-3">
	<div class="col-md-12">
		{{ Form::label('Name','',['class'=>'form-label']) }}
		{{ Form::text('name','',['class'=>'form-control
		parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
	</div>
</div>
<div class="form-group row mb-3">
	<div class="col-md-12">
		{{ Form::label('Leg 1 Pts','',['class'=>'form-label']) }}
		{{ Form::text('l1_pts','',['class'=>'form-control
		parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
	</div>
</div>
<div class="form-group row">
	<div class="col-md-12">
		<div class="d-flex justify-content-end">
			{{ Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit']) }}
		</div>
	</div>
</div>
{{ Form::close() }}
<script>
jQuery(function(){
	$("#fPlayer").submit(function(event){
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
				if (response.data.success) {
					toastr.success(response.data.message,'Success :)');
					table.ajax.reload(null, false);
					modalbig.modal('hide');
				} else {
					toastr.error(response.data.message,'Error :(');
				}
			}).catch(error => {
				toastr.error(error,'Error :(');
			});
		}else{
			toastr.error('Please check again','Error :(');
		}
	});
});
</script>