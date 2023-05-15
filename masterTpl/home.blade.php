<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<table class="datatables-basic table nowrap" id="t$modulModels" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Action</th>
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
	table = $('#t$modulModels').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/$module/get$moduledata")!!}',
			headers: {'Authorization':defHeader},
		},
		"columns": [
			{ "width": "5%","data":"id","className": "dt-center" },
			{ "width": "*","data":"name","className": "dt-left" },
			{ "width": "16%","data":"action","className": "dt-center", "sortable": false }
		],
		dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		"drawCallback": function( settings ) {
			$('.switch').change(function (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
				updateStatus($(this),"{!!url('/api/$module/status$moduledata')!!}");
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

$(document).on('click','.add$module',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('$module/add$module')!!}", 'Add New Data');
});

$(document).on('click','.edit$module',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('$module/edit$module')!!}", 'Edit Data', ['$modulModels'], $(this).data('value'));
});

$(document).on('click','.delete$module',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	deleteData($(this).data('value'), "{{Core::api('$module/delete$moduledata')}}");
});

</script>