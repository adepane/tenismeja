<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<table class="datatables-basic table nowrap" id="tUsers" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(function() {
	table = $('#tUsers').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/users/getusersdata")!!}',
			headers: {'Authorization':defHeader},
		},
		"columns": [
			{ "width": "5%","data":"id","className": "dt-left" },
			{ "width": "*","data":"name","className": "dt-left" },
			{ "width": "*","data":"email","className": "dt-left" },
			{ "width": "*","data":"permission_id","className": "dt-left" },
			{ "width": "10%","data":"action","className": "dt-center", "sortable": false }
		],
		dom:
		'<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		"drawCallback": function( settings ) {
			$('.switch').change(function (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
				updateStatus($(this),"{!!url('/api/users/statususerdata')!!}");
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

$(document).on('click','.adduser', function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('users/adduser')!!}", 'Add New User', ['Permission']);
});

$(document).on('click','.edituser',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('users/edituser')!!}", 'Edit Permission',['Permission','User'], $(this).data('value'));
});

$(document).on('click','.deleteuser',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	deleteData($(this).attr('valueajax'), "{{Core::api('users/deleteuserdata')}}");
});

$(document).on('click','.loginasuser',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	Swal.fire({ 
		title: "Are you sure?", 
		text: "Do you want login as this user!", 
		icon: "info", 
		showCancelButton: !0, 
		confirmButtonColor: "#34c38f", 
		cancelButtonColor: "#f46a6a", 
		confirmButtonText: "Yes",
		preConfirm: (valueid) => {
			return $(this).data('value');
		},
	})
	.then(function(data) {
		if (data.value) {
			axios({
				url: "{{url('/loginasuser')}}",
				headers:{
					'Authorization':defHeader,
					'accept':'application/json'
				},
				params:{
					'data':data.value,
				},
				method:"get"
			}).then(response => {
				if (response.data.status) {
					table.ajax.reload(null, false);
					setTimeout(function () { window.location.replace(response.data.redir);location.reload(); }, 1000);
					return data.value && Swal.fire("Success!", response.data.message, "success");

				} else {
					return data.value && Swal.fire("Failed!", response.data.message, "error");
				}
			}).catch(error => {
				return data.value && Swal.fire("Error!", error, "error");
			});			
		}
    });
});

$(document).on('click', '.customrole', function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	var data = table.row($(this).parents('tr')).data();
	viewTemplate('{!!Core::modal("users/customrole")!!}', `Custom Role "${data.name}"`, [], $(this).data('value'));
});
</script>