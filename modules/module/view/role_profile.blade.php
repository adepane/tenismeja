<table class="datatables-basic table" id="role-table">
	<thead>
		<tr>
			<th>Name</th>
			<th>View</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<script>
jQuery(function() {
	$('#role-table').DataTable({
		processing: true,
		serverSide: true,
		searching:false,
		lengthChange:false,
		ajax: {
			url:'{!!Core::api("module/getprofilesdata")!!}',
			headers: {'Authorization':defHeader},
			data: function (d) {
				d.slug = '{!!$slug!!}';
			}
		},
		"fnDrawCallback": function (oSettings) {
			$('.form-check-input').change(function (event) {
				let name = $(this).attr('name');
				let nsplit = name.split("-");
				let value = $(this).is(':checked');
				axios({
					url:"{!!Core::api('module/sendrole')!!}",
					headers:{
						'Authorization': defHeader,
						'accept': 'application/json'
					},
					data:{
						idprofile: nsplit[1],
						module: nsplit[0],
						slugaction: nsplit[2],
						statusrole:value,
						_token:"{{ csrf_token() }}"
					},
					method:"post"
				}).then(response => {
					if (response.data.status == 1) {
						toastr.success(response.data.message,'Success');
					} else {
						toastr.warning('somethings wrong :(','Warning');
					}
				}).catch(error => {
					toastr.error(error.data.message,'Error');
				});
				event.preventDefault();
			});
		},
		"columns": [
			{ "width": "20%","data":"name","className": "dt-left", "sortable": false },
			{ "width": "25%","data":"view","className": "dt-center", "sortable": false },
			{ "width": "25%","data":"action","className": "dt-center", "sortable": false }
		],
	});	
});
</script>

<style>
	th.dt-center,
	td.dt-center {
		text-align: center;
		vertical-align: top !important;
	}

	th.dt-left,
	td.dt-left {
		text-align: left;
		vertical-align: top !important;
	}
</style>