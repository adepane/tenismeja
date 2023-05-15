<?php
	$url = url('/validate/userinfo');
?>

{{ Form::open(array('url' => '/api/users/adduserdata','class'=>'form form-horizontal','id'=>'fuser')) }}

<div class="form-group row mb-2">
	<div class="col-md-6 col-6">
		{{ Form::label('Name','',['class'=>'form-label']) }}
		{{ Form::text('name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Name Required','id'=>'name','tabindex'=>"1"]) }}
	</div>
	<div class="col-md-6 col-6">
		{{ Form::label('Username','',['class'=>'form-label']) }}
		{{ Form::text('username','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Username Required','parsley-remote'=>$url,'parsley-remote-message'=>"Username Already Exists",'tabindex'=>"2",'id'=>'username']) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-6">
		{{ Form::label('Email','',['class'=>'form-label']) }}
		{{ Form::text('email','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Email Required','parsley-type'=>"email",'parsley-type-email-message'=>'Wrong Email Format','parsley-remote'=>"$url",'parsley-remote-message'=>"Email Already Exists",'id'=>'email','tabindex'=>"3"]) }}
	</div>
	<div class="col-md-6">
		{!! Form::label('Phone', '', ['class'=>'form-label']) !!}
		{{ Form::text('phone','',['class'=>'form-control parsley-validated','id'=>'phone','tabindex'=>"4"]) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-12">
		{!! Form::label('Address', '', ['class'=>'form-label']) !!}
		{{ Form::textarea('address','',['class'=>'form-control parsley-validated','id'=>'address','tabindex'=>"5", 'rows'=>4]) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-6">
		{{ Form::label('Password','',['class'=>'form-label']) }}
		{{ Form::password('password',['class'=>'form-control parsley-validated','id'=>'pass','parsley-minlength'=>'6','parsley-required'=>'true','parsley-required-message'=>'Password Required','tabindex'=>"6"]) }}
	</div>
	<div class="col-md-6">
		{{ Form::label('Confirm Password','',['class'=>'form-label']) }}
		{{ Form::password('repassword',['class'=>'form-control
			parsley-validated','parsley-equalto'=>'#pass','tabindex'=>"7",'id'=>'repass']) }}
	</div>
</div>

@if (Auth::user()->permission_id == 1)	
<div class="form-group row mb-2">
	<div class="col-sm-12">
		{{ Form::label('Custom Role','',['class'=>'form-label']) }}
		{{Form::select('is_custom', [''=> 'Define Role', true => 'True', false => 'False']  ,'',['class'=>"select2 form-select",'parsley-required'=>"true",'tabindex'=>"8",'id'=>'is_custom'])}}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-sm-12">
		{{ Form::label('Permission','',['class'=>'form-label']) }}
		<?
			$permissions = $models['Permission']::pluck('name','id')->all();
		?>
		{{Form::select('permission',array('' => 'Select Permission') + $permissions  ,'',['class'=>"select2 form-select",'parsley-required'=>"true",'parsley-required-message'=>"Permission Users Must Be Selected",'tabindex'=>"9",'id'=>'permission'])}}
	</div>
</div>
@endif

<div class="form-group row mb-3">
	<div class="col-md-12">
		<div class="d-flex justify-content-end">
			{{ Form::submit('Submit',['class'=>'btn btn-primary','tabindex'=>"9",'id'=>'submit']) }}
		</div>
	</div>
</div>
{{ Form::close() }}

<script>
$('.select2').select2();
jQuery(function(){
	$('#is_custom').change(function(){
		if($(this).val() == true){
			$('#permission').prop('disabled',true);
		}else{
			$('#permission').prop('disabled',false);
		}
	});
	$("#fuser").submit(function(event){
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