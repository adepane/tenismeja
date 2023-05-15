<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<table class="datatables-basic table nowrap" id="tPermission" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
	table = $('#tPermission').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/permission/getpermissiondata")!!}',
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
				updateStatus($(this),"{!!url('/api/permission/statuspermissiondata')!!}");
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

$(document).on('click','.addpermission',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('permission/addpermission')!!}", 'Add New Permission');
});

$(document).on('click','.editpermission',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('permission/editpermission')!!}", 'Edit Permission', ['Permission'], $(this).data('value'));
});

$(document).on('click','.deletepermission',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	deleteData($(this).data('value'), "{{Core::api('permission/deletepermissiondata')}}");
});

</script>
<style>
	th.dt-center,
	td.dt-center {
		text-align: center;
	}

	th.dt-left,
	td.dt-left {
		text-align: left;
	}
</style>