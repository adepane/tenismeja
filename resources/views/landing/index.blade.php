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
                                            <th>Team Positions</th>
                                            <th>P</th>
                                            <th>W</th>
                                            <th>L</th>
                                            <th>D</th>
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
                                            <td>36</td>
                                            <td>36</td>
                                            <td>14</td>
                                            <td>10</td>
                                            <td>118</td>
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
                            <a href="#"
                                class="btn btn-default btn-outline btn-xs card-header__button">Expand Stats</a>
                        </div>
                        <div class="widget__content card__content">
                            <!-- Game Score -->
                            <div class="widget-game-result__section">
                                <div class="widget-game-result__section-inner">
                                    <header class="widget-game-result__header">
                                        <h3 class="widget-game-result__title">Championship Quarter Finals</h3>
                                        <time class="widget-game-result__date"
                                            datetime="2016-03-24">Saturday, March 24th, 2016</time>
                                    </header>
                                    <div class="widget-game-result__main">
                                        <!-- 1st Team -->
                                        <div class="widget-game-result__team widget-game-result__team--first">
                                            <figure class="widget-game-result__team-logo">
                                                <a href="#"><img
                                                        src="/guest/assets/images/soccer/logos/alchemists_last_game_results_big.png"
                                                        alt="" /></a>
                                            </figure>
                                            <div class="widget-game-result__team-info">
                                                <h5 class="widget-game-result__team-name">Alchemists</h5>
                                                <div class="widget-game-result__team-desc">Elric Bros School</div>
                                            </div>
                                        </div>
                                        <!-- 1st Team / End -->
                                        <div class="widget-game-result__score-wrap">
                                            <div class="widget-game-result__score">
                                                <span
                                                    class="widget-game-result__score-result widget-game-result__score-result--winner">2</span>
                                                <span class="widget-game-result__score-dash">-</span>
                                                <span
                                                    class="widget-game-result__score-result widget-game-result__score-result--loser">0</span>
                                            </div>
                                            <div class="widget-game-result__score-label">Final Score</div>
                                        </div>
                                        <!-- 2nd Team -->
                                        <div class="widget-game-result__team widget-game-result__team--second">
                                            <figure class="widget-game-result__team-logo">
                                                <a href="#"><img src="/guest/assets/images/samples/logo-l-clovers--sm.png"
                                                        alt="" /></a>
                                            </figure>
                                            <div class="widget-game-result__team-info">
                                                <h5 class="widget-game-result__team-name">Clovers</h5>
                                                <div class="widget-game-result__team-desc">St Paddy's Institute</div>
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
                                                <div class="df-timeline__team-shirt"><i class="icon-svg icon-shirt"></i>
                                                </div>
                                            </div>
                                            <div class="df-timeline__time">0’</div>
                                            <div class="df-timeline__team-2">
                                                <div class="df-timeline__team-shirt"><i class="icon-svg icon-shirt-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="df-timeline__event df-timeline__event--empty"></div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__team-1">
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">F. Stevens</div>
                                                    <div class="df-timeline__event-desc">Alchemists 1-0</div>
                                                </div>
                                                <div class="df-timeline__event-icon"><i
                                                        class="icon-svg icon-soccer-ball"></i></div>
                                            </div>
                                            <div class="df-timeline__time">22’</div>
                                        </div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__time">36’</div>
                                            <div class="df-timeline__team-2">
                                                <div class="df-timeline__event-icon"><i
                                                        class="icon-svg icon-yellow-card"></i></div>
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">Johnny Griffin</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="df-timeline__event df-timeline__event--empty"></div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__time">HT</div>
                                            <div class="df-timeline__team-2">
                                                <div class="df-timeline__event-icon"><i
                                                        class="icon-svg icon-substitution"></i></div>
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">Markus Jackson</div>
                                                    <div class="df-timeline__event-name">Rick Valentine</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__team-1">
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">Brian Kingster</div>
                                                </div>
                                                <div class="df-timeline__event-icon"><i class="icon-svg icon-red-card"></i>
                                                </div>
                                            </div>
                                            <div class="df-timeline__time">59’</div>
                                        </div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__team-1">
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">Christofer Grass (P)</div>
                                                    <div class="df-timeline__event-desc">Alchemists 2-0</div>
                                                </div>
                                                <div class="df-timeline__event-icon"><i
                                                        class="icon-svg icon-soccer-ball-penalty"></i></div>
                                            </div>
                                            <div class="df-timeline__time">68’</div>
                                        </div>
                                        <div class="df-timeline__event df-timeline__event--empty"></div>
                                        <div class="df-timeline__event">
                                            <div class="df-timeline__time">84’</div>
                                            <div class="df-timeline__team-2">
                                                <div class="df-timeline__event-icon"><i
                                                        class="icon-svg icon-yellow-card"></i></div>
                                                <div class="df-timeline__event-info">
                                                    <div class="df-timeline__event-name">Wally Christison</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Timeline / End -->
                            <!-- Game Statistics -->
                            <div class="widget-game-result__section">
                                <header
                                    class="widget-game-result__subheader card__subheader card__subheader--sm card__subheader--nomargins">
                                    <h5 class="widget-game-result__subtitle">Game Statistics</h5>
                                </header>
                                <div class="widget-game-result__section-inner">
                                    <!-- Progress: Shots on Goal -->
                                    <div class="progress-double-wrapper">
                                        <h6 class="progress-title">Shots on Goal</h6>
                                        <div class="progress-inner-holder">
                                            <div class="progress__digit progress__digit--left progress__digit--40">15</div>
                                            <div class="progress__double">
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar-width-60"
                                                        role="progressbar"
                                                        aria-valuenow="60"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar--success progress__bar-width-80"
                                                        role="progressbar"
                                                        aria-valuenow="80"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div
                                                class="progress__digit progress__digit--right progress__digit--highlight progress__digit--40">
                                                24</div>
                                        </div>
                                    </div>
                                    <!-- Progress: Shots on Goal / End -->
                                    <!-- Progress: Ball Possession -->
                                    <div class="progress-double-wrapper">
                                        <h6 class="progress-title">Ball Possession</h6>
                                        <div class="progress-inner-holder">
                                            <div
                                                class="progress__digit progress__digit--left progress__digit--highlight progress__digit--40">
                                                75%</div>
                                            <div class="progress__double">
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar-width-80"
                                                        role="progressbar"
                                                        aria-valuenow="80"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar--success progress__bar-width-40"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="progress__digit progress__digit--right progress__digit--40">35%
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Progress: Ball Possession / End -->
                                    <!-- Progress: Fouls -->
                                    <div class="progress-double-wrapper">
                                        <h6 class="progress-title">Fouls</h6>
                                        <div class="progress-inner-holder">
                                            <div class="progress__digit progress__digit--left progress__digit--40">5</div>
                                            <div class="progress__double">
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar-width-30"
                                                        role="progressbar"
                                                        aria-valuenow="30"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar--success progress__bar-width-60"
                                                        role="progressbar"
                                                        aria-valuenow="60"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div
                                                class="progress__digit progress__digit--right progress__digit--highlight progress__digit--40">
                                                8</div>
                                        </div>
                                    </div>
                                    <!-- Progress: Fouls / End -->
                                    <!-- Progress: Corner Kicks -->
                                    <div class="progress-double-wrapper">
                                        <h6 class="progress-title">Corner Kicks</h6>
                                        <div class="progress-inner-holder">
                                            <div class="progress__digit progress__digit--left progress__digit--40">10</div>
                                            <div class="progress__double">
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar-width-30"
                                                        role="progressbar"
                                                        aria-valuenow="30"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress__bar progress__bar--success progress__bar-width-80"
                                                        role="progressbar"
                                                        aria-valuenow="80"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div
                                                class="progress__digit progress__digit--right progress__digit--highlight progress__digit--40">
                                                12</div>
                                        </div>
                                    </div>
                                    <!-- Progress: Corner Kicks / End -->
                                </div>
                            </div>
                            <!-- Game Statistics / End -->
                        </div>
                    </aside>
                </div>
                <!-- Sidebar / End -->
            </div>
        </div>
    </div>
@endsection