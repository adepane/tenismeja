@extends('landing.app')
@push('style')
    <style>
        .team-meta {
            padding: 15px 0;
        }
        .table>tbody>tr>td, .team-meta__name, .widget-standings .table-standings>tbody>tr>td:first-child>.team-meta:before {
            font-size: 16px!important;
        }
    </style>
@endpush
@section('content')
    <div class="site-content">
        <div class="container">
            <div class="row">
                <!-- Content / End -->
                <!-- Sidebar -->
                <div id="sidebar"
                    class="sidebar col-md-12">
                    <!-- Widget: Standings -->
                    <aside class="widget card widget--sidebar widget-standings">
                        <div class="widget__title card__header card__header--has-btn">
                            <h4>Players</h4>
                            
                        </div>
                        <div class="widget__content card__content">
                            <div class="table-responsive">
                                <table class="table table-hover table-standings">
                                    <thead>
                                        <tr>
                                            <th>Player Positions</th>
                                            <th>P</th>
                                            <th>W</th>
                                            <th>L</th>
                                            <th>L1</th>
                                            <th>PTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($players as $player)
                                            
                                        <tr>
                                            
                                            <td>
                                                <div class="team-meta">
                                                    <div class="team-meta__info">
                                                        <a href="{!!route('getDetailUser', $player->id)!!}"><h2 class="team-meta__name">{!!$player->name!!}  </h2></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{!!$player->homeGame->count() + $player->awayGame->count()!!}</td>
                                            <td>{!!$player->playerWin->count()!!}</td>
                                            <td>{!!$player->playerLost->count()!!}</td>
                                            <td>{!!$player->l1_pts!!}</td>
                                            <td>{!!$player->total_point!!}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <!-- Widget: Featured Player / End -->
                    <!-- Widget: Game Result -->
                    <aside class="widget card widget--sidebar widget-game-result">
                        <div class="widget__title card__header card__header--has-btn">
                            <h4>Last Game Results</h4>
                        </div>
                        <div class="widget__content card__content">
                            <!-- Game Score -->
                            <div class="widget-game-result__section">
                                @foreach ($lastGames as $key => $lastGame)
                                <div class="widget-game-result__section-inner" {!!(($key+1) % 2 == 0) ? 'style="background-color:#333"' : ''!!}>
                                    <header class="widget-game-result__header">
                                        <h3 class="widget-game-result__title">{!! ($lastGame->home_score > $lastGame->away_score) ? $lastGame->playerHome->name : $lastGame->playerAway->name !!}</h3>
                                        <time class="widget-game-result__date"
                                            datetime="2016-03-24"> {!!$lastGame->updated_at->format('d-m-Y')!!}</time>
                                    </header>
                                    <div class="widget-game-result__main">
                                        <!-- 1st Team -->
                                        <div class="widget-game-result__team widget-game-result__team--first">
                                            {{-- <figure class="widget-game-result__team-logo">
                                                <a href="#"><img
                                                        src="/guest/assets/images/soccer/logos/alchemists_last_game_results_big.png"
                                                        alt="" /></a>
                                            </figure> --}}
                                            <div class="widget-game-result__team-info">
                                                <h5 class="widget-game-result__team-name">{!!$lastGame->playerHome->name!!}</h5>
                                                {{-- <div class="widget-game-result__team-desc"></div> --}}
                                            </div>
                                        </div>
                                        <!-- 1st Team / End -->
                                        <div class="widget-game-result__score-wrap">
                                            <div class="widget-game-result__score">
                                                <span
                                                    class="widget-game-result__score-result {!! ($lastGame->home_score > $lastGame->away_score) ? "widget-game-result__score-result--winner" : "widget-game-result__score-result--loser" !!}">{!!$lastGame->home_score!!}</span>
                                                <span class="widget-game-result__score-dash">-</span>
                                                <span
                                                    class="widget-game-result__score-result {!! ($lastGame->home_score < $lastGame->away_score) ? "widget-game-result__score-result--winner" : "widget-game-result__score-result--loser" !!} ">{!!$lastGame->away_score!!}</span>
                                            </div>
                                            <div class="widget-game-result__score-label">Final Score</div>
                                            <a href="#"
                                                class="btn btn-default btn-outline btn-xs card-header__button mt-2 detail-last" data-game="{!!$lastGame->id!!}">Detail</a>
                                        </div>
                                        <!-- 2nd Team -->
                                        <div class="widget-game-result__team widget-game-result__team--second">
                                            {{-- <figure class="widget-game-result__team-logo">
                                                <a href="#"><img src="/guest/assets/images/samples/logo-l-clovers--sm.png"
                                                        alt="" /></a>
                                            </figure> --}}
                                            <div class="widget-game-result__team-info">
                                                <h5 class="widget-game-result__team-name">{!!$lastGame->playerAway->name!!}</h5>
                                                {{-- <div class="widget-game-result__team-desc">St Paddy's Institute</div> --}}
                                            </div>
                                        </div>
                                        <!-- 2nd Team / End -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- Sidebar / End -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-login-register-tabs" tabindex="-1" role="dialog" id="md-large">
        <div class="modal-dialog modal-lg modal--login modal--login-only" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.detail-last', function(e) {
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
@endsection