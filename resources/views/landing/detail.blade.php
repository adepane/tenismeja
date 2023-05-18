@extends('landing.app')
@section('content')
    Still On Progress
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.detail-game', function(e) {
            e.preventDefault();
            let modalbig = $('.modal');
            let uri = "{!!url('/get/detail/game/')!!}/"+$(this).data('game');
            modalbig.find(".modal-title").html("");
            modalbig.find(".modal-body").html("");
            axios.get(uri, {
                params: {
                    '_':(new Date()).getTime()
                }
            })
            .then(response => {
                let loopData = '';
                response.data.matchs.forEach(data => {
                    loopData += `
                    <div class="df-timeline__event">
                        <div class="df-timeline__team-${(data.home_win == 1) ? "1" : "2"}">
                            <div class="df-timeline__event-info">
                                <div class="df-timeline__event-name"><h5>${(data.home_win == 1) ? data.get_player_match.player_home.name : data.get_player_match.player_away.name} Win ( ${data.home_score} - ${data.away_score} )</h5></div>
                                <div class="df-timeline__event-desc"></div>
                                <div class="df-timeline__event-desc"><img src="${data.photo}" height="75px"/></div>
                            </div>
                        </div>
                        <div class="df-timeline__time"><h4>${data.set_of_match}</h4></div>
                    </div>
                    `;
                });
                modalbig.find(".modal-body").html(`
                    <div class="widget__content card__content">
                        <!-- Game Score -->
                        <div class="widget-game-result__section">
                            <div class="widget-game-result__section-inner">
                                <header class="widget-game-result__header">
                                    <h3 class="widget-game-result__title">${response.data.winner}</h3>
                                    <time class="widget-game-result__date"
                                        datetime="2016-03-24">${response.data.lastUpdate}</time>
                                </header>
                                <div class="widget-game-result__main">
                                    <!-- 1st Team -->
                                    <div class="widget-game-result__team widget-game-result__team--first">
                                        <div class="widget-game-result__team-info">
                                            <h5 class="widget-game-result__team-name">${response.data.matchs[0].get_player_match.player_home.name}</h5>
                                        </div>
                                    </div>
                                    <!-- 1st Team / End -->
                                    <div class="widget-game-result__score-wrap">
                                        <div class="widget-game-result__score">
                                            <span class="widget-game-result__score-result">${response.data.matchs[0].get_player_match.home_score}</span>
                                            <span class="widget-game-result__score-dash">-</span>
                                            <span class="widget-game-result__score-result">${response.data.matchs[0].get_player_match.away_score}</span>
                                        </div>
                                        <div class="widget-game-result__score-label">Final Score</div>
                                    </div>
                                    <!-- 2nd Team -->
                                    <div class="widget-game-result__team widget-game-result__team--second">
                                        <div class="widget-game-result__team-info">
                                            <h5 class="widget-game-result__team-name">${response.data.matchs[0].get_player_match.player_away.name}</h5>
                                        </div>
                                    </div>
                                    <!-- 2nd Team / End -->
                                </div>
                            </div>
                        </div>
                        <!-- Game Score / End -->
                        <!-- Timeline -->
                        <div class="widget-game-result__section">
                            <div class="df-timeline-wrapper">
                                <div class="df-timeline">
                                    <div class="df-timeline__event df-timeline__event--start">
                                        <div class="df-timeline__team-1">
                                            <div class="df-timeline__team-shirt"><i class="icon-svg icon-shirt"></i></div>
                                        </div>
                                        <div class="df-timeline__time">Set</div>
                                        <div class="df-timeline__team-2">
                                            <div class="df-timeline__team-shirt"><i class="icon-svg icon-shirt-alt"></i></div>
                                        </div>
                                    </div>
                                    <div class="df-timeline__event df-timeline__event--empty"></div>
                                    
                                    ${loopData}
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                modalbig.modal({backdrop: 'static', keyboard: false});
                modalbig.modal('show');
            })
            .catch(error => {
                console.log(error);
            });
        })
    </script>
@endpush