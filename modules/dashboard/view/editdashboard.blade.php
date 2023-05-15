<?php
	$modul = new App\Models\Dashboard;
	$datamodul = $modul::find(request('data'));
?>

{{ Form::open(array('url' => '/api/dashboard/editdashboardd','class'=>'form-horizontal','id'=>'feditdashboard')) }}
{{Form::hidden("iddashboard",$datamodul->id)}}

<div class="form-group offset">
	<div class="offset-sm-3 col-sm-9">
		{{ Form::submit('Update',['class'=>'btn btn-primary','id'=>'beditdashboard']) }}
	</div>
</div>
{{ Form::close() }}

<script>
jQuery(function(){
	$("#feditdashboard").submit(function(event){
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