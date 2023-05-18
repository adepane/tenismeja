<?php
    $datamodul = $models['PlayerMatch']::find(request('data'));
    $playerHome = $datamodul->playerHome;
    $playerAway = $datamodul->playerAway;
    $countSet = $datamodul->getMatchSets->count();
    // dd($countSet);
?>

{{ Form::open(array('url' => '/api/playerMatch/addPlayerMatchSetdata','class'=>'form form-horizontal
parsley-validated','id'=>'fPlayerMatchSet')) }}
<input type="hidden" name="player_match_id" value="{!!$datamodul->id!!}">
<div class="form-group row mb-1">
    <div class="col-md-12">
        {{ Form::label('Game Set','',['class'=>'form-label']) }}
        {{ Form::text('game_set',$countSet + 1,['class'=>'form-control
        parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
    </div>
</div>
<div class="form-group row mb-1">
    <div class="col-md-12">
        {{ Form::label($playerHome->name,'',['class'=>'form-label']) }}
        {{ Form::text('home_score','',['class'=>'form-control
        parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
    </div>
</div>
<div class="form-group row mb-1">
    <div class="col-md-12">
        {{ Form::label($playerAway->name,'',['class'=>'form-label']) }}
        {{ Form::text('away_score','',['class'=>'form-control
        parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'important!']) }}
    </div>
</div>
<div class="form-group row mb-1">
    <div class="col-md-12">
        {{ Form::label('Photo','',['class'=>'form-label']) }}
        <div id="photo-res" width="100%" height="240"></div>
        {{ Form::hidden('photo','',['id'=>'photo_score']) }}
    </div>
</div>

<div style="width:100%">
    <div id="my_camera"></div>
</div>
<button class="btn btn-secondary d-none" id="re-take" type="button">Re-take Photo</button>

<button class="btn btn-danger" id="click-photo" type="button">Score Photo</button>
<div class="form-group row">
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            {{ Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit']) }}
        </div>
    </div>
</div>
{{ Form::close() }}

<script>
    Webcam.set({
        width: 240,
        height: 360,
        dest_width: 720,
        dest_height: 1080,
        image_format: 'jpeg',
        jpeg_quality: 100,
        constraints: {
            facingMode: 'environment'
        }
    });
    Webcam.attach( '#my_camera' );
    $(document).on('click', '#click-photo', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        Webcam.snap( function(data_uri) {
            $('#photo_score').val(data_uri);
            $('#photo-res').html('<img src="'+data_uri+'" style="width:100%" />');
            $('#click-photo').addClass('d-none');
            $('#my_camera').addClass('d-none');
            $('#re-take').removeClass('d-none');
        });
    });
    $(document).on('click', '#re-take', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        $('#photo_score').val('');
        $('#photo-res').html('');
        $('#click-photo').removeClass('d-none');
        $('#my_camera').removeClass('d-none');
        $('#re-take').addClass('d-none');
    })
    // function take_snapshot() {
    
    //     Webcam.snap( function(data_uri) {
    //     document.getElementById('photo-res').innerHTML =
    //     '<img src="'+data_uri+'" />';
    //     $(this).addClass('d-none')
    // } );
    // }
jQuery(function(){
	$("#fPlayerMatchSet").submit(function(event){
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
                    Webcam.reset();
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