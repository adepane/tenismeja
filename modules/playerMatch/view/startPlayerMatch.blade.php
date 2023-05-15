<?php
    $datamodul = App\Models\PlayerMatch::find(request('data'));
?>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row mb-2 mt-2">
                    <div class="col-md-12 mb-2">
                        <h2 class="text-center">{!!$datamodul->playerHome->name!!} <span class="text-danger"> VS </span>{!!$datamodul->playerAway->name!!}</h2>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary col-12 addMatchSet" data-match="{!!$datamodul->id!!}">Add Match Set</button>
                    </div>
                </div>
                <table class="datatables-basic table nowrap"
                    id="tPlayerMatchStatus"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <input type="hidden" value="{!!$datamodul->id!!}" id="data-match">
                    <thead>
                        <tr>
                            <th>Set</th>
                            <th>Winner</th>
                            <th>Score</th>
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
	table = $('#tPlayerMatchStatus').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			url:'{!!url("/api/PlayerMatch/getPlayerMatchStatus")!!}',
			headers: {'Authorization':defHeader},
            data: {
                matchId: $('#data-match').val(),
            },
		},
		"columns": [
			{ "width": "5%","data":"set_of_match","className": "dt-right" },
			// { "width": "10%","data":"versus","className": "dt-center" },
			{ "width": "20%","data":"winner","className": "dt-left" },
			{ "width": "*%","data":"score","className": "dt-center", "sortable": false }
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
$(document).on('click','.addMatchSet',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('playerMatch/addSet')!!}", 'Add Match Set', ['PlayerMatch'], $(this).data('match'));
});
</script>