<?
	$data = $models['User']::find(request('data'));
	$url = url('/validate/usercheck?id='.$data->id);
?>

{{ Form::open(array('url' => '/api/users/editusersdata','class'=>'form-horizontal','id'=>'fedituser')) }}
{{ Form::hidden('idUser',$data->id) }}
<div class="form-group row mb-2">
	<div class="col-md-6 col-6">
		{{ Form::label('Name','',['class'=>'form-label']) }}
		{{ Form::text('name',$data->name,['class'=>'form-control
		parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Name
		Required','id'=>'name','tabindex'=>"1"]) }}
	</div>
	<div class="col-md-6 col-6">
		{{ Form::label('Username','',['class'=>'form-label']) }}
		{{ Form::text('username',$data->username,['class'=>'form-control
		parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Username
		Required','parsley-remote'=>$url,'parsley-remote-message'=>"Username Already
		Exists",'tabindex'=>"2",'id'=>'username']) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-6">
		{{ Form::label('Email','',['class'=>'form-label']) }}
		{{ Form::text('email',$data->email,['class'=>'form-control
		parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Email
		Required','parsley-type'=>"email",'parsley-type-email-message'=>'Wrong Email
		Format','parsley-remote'=>"$url",'parsley-remote-message'=>"Email Already
		Exists",'id'=>'email','tabindex'=>"3"]) }}
	</div>
	<div class="col-md-6">
		{!! Form::label('Phone', '', ['class'=>'form-label']) !!}
		{{ Form::text('phone',$data->phone,['class'=>'form-control parsley-validated','id'=>'phone','tabindex'=>"4"]) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-12">
		{!! Form::label('Address', '', ['class'=>'form-label']) !!}
		{{ Form::textarea('address',$data->address,['class'=>'form-control parsley-validated','id'=>'address','tabindex'=>"5",
		'rows'=>4]) }}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-md-6">
		{{ Form::label('Password','',['class'=>'form-label']) }}
		{{ Form::password('password',['class'=>'form-control
		parsley-validated','id'=>'pass','parsley-minlength'=>'6','tabindex'=>"6"]) }}
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
		{{Form::select('is_custom', [''=> 'Define Role', true => 'True', false => 'False']  ,$data->is_custom,['class'=>"select2 form-select",'parsley-required'=>"true",'tabindex'=>"8",'id'=>'is_custom'])}}
	</div>
</div>

<div class="form-group row mb-2">
	<div class="col-sm-12">
		{{ Form::label('Permission','',['class'=>'form-label']) }}
		<?
			$permissions = $models['Permission']::pluck('name','id')->all();
		?>
		{{Form::select('permission',array('' => 'Select Permission') + $permissions ,$data->permission_id,['class'=>"select2
		form-select",'parsley-required'=>"true",'parsley-required-message'=>"Permission Users Must Be
		Selected",'tabindex'=>"8",'id'=>'permission'])}}
	</div>
</div>
@endif

<div class="form-group row mb-3">
	<div class="col-md-12">
		<div class="d-flex justify-content-end">
			{{ Form::submit('Update',['class'=>'btn btn-primary','tabindex'=>"9",'id'=>'submit']) }}
		</div>
	</div>
</div>
{{ Form::close() }}

<script>
$('.select2').select2({
	width:"100%"
})
jQuery(function(){
	$("#fedituser").submit(function(event){
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
				if (response.data.status == 1) {
					toastr.success(response.data.message,'Success :)');
					table.ajax.reload(null, false);
					modalbig.modal('hide');
				} else {
					toastr.error(response.data.message,'Error :)');
				}
			}).catch(error => {
				toastr.error(error,'Error :(');
			});
		}else{
			toastr.error('Please check again','Error :(');
		}
	});
});
$('#username').keyup(function(event) {
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	$(this).parsley('validate');
});
$('#email').keyup(function(event) {
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	$(this).parsley('validate');
});
</script>