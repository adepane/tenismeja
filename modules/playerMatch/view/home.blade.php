<?php
	$players = App\Models\Player::pluck('name','id')->all();
?>

<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<form class="form-horzontal filterPlayer mb-1" id="filterPlayer">
					<div class="form-group row">
						<div class="col-md-3 col-sm-12 mb-1">
							{{Form::select('_home_id',['' => 'Pilih Pemain'] + $players,'',['class'=>"select2
							form-control",'data-live-search'=>'true','id'=>'_home_id'])}}
						</div>
						<div class="col-md-3 col-sm-12 mb-1">
							{{Form::select('_away_id',['' => 'Pilih Lawan'] + $players,'',['class'=>"select2
							form-control",'data-live-search'=>'true','id'=>'_away_id'])}}
						</div>
						<div class="col-md-6 col-sm-12 mb-1 text-center">
							<button class="btn btn-info filter"
								type="submit">Filter</button>
							<button class="btn btn-primary resetFilter"
								id="resetFilter"
								type="button">Reset Filter</button>
						</div>
					</div>
				</form>
				<table class="datatables-basic table nowrap" id="tPlayerMatch" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th class="dt-left">Stat</th>
							<th class="dt-right">Player</th>
							<th class="dt-center">VS</th>
							<th class="dt-left">Player</th>
							<th class="dt-center">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
$('.select2').select2();
jQuery(function() {
	table = $('#tPlayerMatch').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/playerMatch/getPlayerMatchData")!!}',
			headers: {'Authorization':defHeader},
			data: function(d) {
				param = $('#filterPlayer').serializeArray();
				d.cari=param;
			},
		},
		"columns": [
			{ "width": "5%","data":"finish","className": "dt-left" },
			{ "width": "5%","data":"home_id","className": "dt-right" },
			{ "width": "3%","data":"versus","className": "dt-center" },
			{ "width": "5%","data":"away_id","className": "dt-left" },
			{ "width": "4%","data":"action","className": "dt-center", "sortable": false }
		],
		dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		"drawCallback": function( settings ) {
			$('.switch').change(function (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
				updateStatus($(this),"{!!url('/api/playerMatch/statusPlayerMatchdata')!!}");
			});
		}
	});
	table.on( 'responsive-display.dt', function ( e, datatable, row, showHide, update ) {
		$('.switch').change(function (event) {
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			updateStatus($(this));
		});
	});
});

$(document).on('click','.addPlayerMatch',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('playerMatch/addPlayerMatch')!!}", 'Add New Data');
});

$(document).on('click','.editPlayerMatch',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('playerMatch/editPlayerMatch')!!}", 'Edit Data', ['PlayerMatch'], $(this).data('value'));
});

$(document).on('submit','#filterPlayer',function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	table.ajax.reload();
});

$(document).on('click','#resetFilter',function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	$('#_home_id').val("");
	$('#_away_id').val("");
	table.ajax.reload();
});

</script>