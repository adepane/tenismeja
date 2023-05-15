<table class="datatables-basic table" id="role-table">
	<thead>
		<tr>
			<th>Module</th>
			<th>Pages</th>
			<th>Actions</th>
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
			url:'{!!Core::api("users/getmodulepermission")!!}',
			headers: {'Authorization':defHeader},
			data: function (d) {
				d.user = '{!!request("data")!!}';
			}
		},
		"fnDrawCallback": function (oSettings) {
			$('.form-check-input').change(function (event) {
				let name = $(this).attr('name');
				let nsplit = name.split("-");
				let value = $(this).is(':checked');
				axios({
					url:"{!!Core::api('users/sendcustomrole')!!}",
					headers:{
						'Authorization': defHeader,
						'accept': 'application/json'
					},
					data:{
						userId: nsplit[1],
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
			{ "width": "20%","data":"module","className": "dt-left", "sortable": false },
			{ "width": "25%","data":"pages","className": "dt-center", "sortable": false },
			{ "width": "25%","data":"actions","className": "dt-center", "sortable": false }
		],
	});	
});
</script>