<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<table class="datatables-basic table nowrap" id="tmodule" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Id</th>
							<th>Modules</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="md-ajax" class="modal fade container" tabindex="-1" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
		<h4 class="modal-title" style="text-transform:capitalize; font-weight:450;"></h4>
	</div>
	<div class="modal-body"></div>
</div>
@if (!request()->ajax())
@push('scripts')
@endif
<script>
jQuery(function() {
	$('#tmodule').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url:'{!!Core::api("module/getdirectory")!!}',
			headers: {'Authorization':defHeader},
		},
		 columns: [
			{data: 'id',"className": "dt-center", "width":"10%","sortered":"false"},
			{data: 'module',"className": "dt-left dt-capitalize" },
			{data: 'action',orderable:'false',searchable:'false',"className": "dt-center", "width":"25%","sortered":"false"}
		],
		dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		"drawCallback": function( settings ) {
			// feather.replace({});
		}
	});
});

$(document).on('click','.md-ajax-load', function(e){
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	let modalbig = $('#md-large');
	// $('body').modalmanager('loading');
	let slug = $(this).attr("value");
	modalbig.find('.modal-title').html('Permission Module Management');
	modalbig.find('.modal-body').html('');
	axios.get('{!!Core::api("module/vrole_profile")!!}',{
		headers: {'Authorization':defHeader},
		params: {
			slug:slug,
		}
	})
	.then(response => {
		modalbig.find('.modal-body').html(response.data);
		modalbig.modal({backdrop: 'static', keyboard: false});
		modalbig.modal("show");
	}).catch(error => {
		console.log(error);
	})
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

	th.dt-capitalize,
	td.dt-capitalize {
		text-transform: capitalize;
	}
</style>
@if (!request()->ajax())
@endpush
@endif