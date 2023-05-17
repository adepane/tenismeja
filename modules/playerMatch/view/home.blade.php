<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
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
jQuery(function() {
	table = $('#tPlayerMatch').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/PlayerMatch/getPlayerMatchdata")!!}',
			headers: {'Authorization':defHeader},
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
				updateStatus($(this),"{!!url('/api/PlayerMatch/statusPlayerMatchdata')!!}");
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
	viewTemplate("{!!Core::modal('PlayerMatch/addPlayerMatch')!!}", 'Add New Data');
});

$(document).on('click','.editPlayerMatch',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('PlayerMatch/editPlayerMatch')!!}", 'Edit Data', ['PlayerMatch'], $(this).data('value'));
});



</script>