@extends('landing.app')
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
                            <h4>Club</h4>
                            <a href="#"
                                class="btn btn-default btn-outline btn-xs card-header__button">See All Stats</a>
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
                                                        <h6 class="team-meta__name">{!!$player->name!!}</h6>
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
                                                class="btn btn-default btn-outline btn-xs card-header__button mt-2" data-game="{!!$lastGame->id!!}">Detail</a>
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
@endsection