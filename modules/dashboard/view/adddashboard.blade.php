{{ Form::open(array('url' => '/api/dashboard/adddashboardd','class'=>'form-horizontal parsley-validated','id'=>'fdashboard')) }}
<div class="form-group row">
	{{ Form::label('dashboard Name','',['class'=>'control-label col-sm-2']) }}
	<div class="row col-sm-10">
		<div class="col-sm-12">
			{{ Form::text('name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'dashboard Name Required','id'=>'name']) }}
		</div>
	</div>
</div>

<div class="form-group row">
	{{ Form::label('select','',['class'=>'control-label col-sm-2']) }}
	<div class="row col-sm-10">
		<div class="col-sm-12">
			<?
				// $select = App\Models\select::pluck('name','id')->all();
			?>
			{{Form::select('select',array('0' => 'Select select'),'',['class'=>'select2 form-control','parsley-required'=>'true','parsley-required-message'=>'select Users Must Be Selected','id'=>'select'])}}
		</div>
	</div>
</div>

<div class="form-group offset">
	<div class="offset-sm-3 col-sm-9">
		{{ Form::submit('Add New',['class'=>'btn btn-primary','id'=>'bdashboard']) }}
		<button type="reset" class="btn btn-secondary" id="reset">Reset</button>
	</div>
</div>
{{ Form::close() }}

<script>
$('.select2').select2({
	width:"100%"
});
jQuery(function(){
	$("#fdashboard").submit(function(event){
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