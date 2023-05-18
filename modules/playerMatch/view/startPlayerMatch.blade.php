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
					@if (!$datamodul->finish)
						<div class="col-md-12">
							<button class="btn btn-primary col-12 addMatchSet"
								data-match="{!!$datamodul->id!!}">Add Match Set</button>
						</div>
					@endif
					@if ($datamodul->finish)
						<h4 class="text-center text-success">Match Has Been Finish</h4>
						<h1 class="text-center text-primary">Winner: {!! ($datamodul->home_score > $datamodul->away_score) ? $datamodul->playerHome->name : $datamodul->playerAway->name !!}</h1>
					@endif
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
							@if (!$datamodul->finish)
							<th>Action</th>
							@else
							<th class="d-none">Action</th>
							@endif
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
				<div class="col-md-12 mt-2">
					@if (!$datamodul->finish)
					<div class="col-md-12">
						<button class="btn btn-danger col-12 finishMatch"
							data-match="{!!$datamodul->id!!}">Finish Match</button>
					</div>
					@endif
				</div>
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
			url:'{!!url("/api/playerMatch/getPlayerMatchStatus")!!}',
			headers: {'Authorization':defHeader},
            data: {
                matchId: $('#data-match').val(),
            },
		},
		"columns": [
			{ "width": "5%","data":"set_of_match","className": "dt-right" },
			// { "width": "10%","data":"versus","className": "dt-center" },
			{ "width": "20%","data":"winner","className": "dt-left" },
			{ "width": "10%","data":"score","className": "dt-center" },
			{ "width": "5%","data":"action","className": "dt-center", "sortable": false }
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
$(document).on('click','.addMatchSet',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('playerMatch/addSet')!!}", 'Add Match Set', ['PlayerMatch'], $(this).data('match'));
});

$(document).on('click','.editPlayerMatch',function(event){
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();
	viewTemplate("{!!Core::modal('playerMatch/editSet')!!}", 'Edit Data', ['PlayerMatch', 'MatchSet'], $(this).data('value'));
});

$(document).on('click','.deletePlayerMatch',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	deleteData($(this).data('value'), "{{Core::api('playerMatch/deletePlayerMatchData')}}");
});

$(document).on('click','.finishMatch',function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
	customModalData("Are you sure to Finish this Match?","","question",$(this).data('match'), "{{Core::api('playerMatch/finishTheMatch')}}");
});
</script>