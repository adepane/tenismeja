<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Basic Page Needs
	================================================== -->
        <title>Kopi Sore Lague - Al-Jannah Mosque Present</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Liga Kopi Sore Al-Jannah - Perumahan Puri Tanjung Sari Kota Medan" />
        <meta name="keywords" content="tenis meja club" />
        <!-- Favicons
	================================================== -->
        <link rel="shortcut icon" href="/guest/assets/favicon.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="/guest/assets/favicon.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/guest/assets/favicon.png" />
        <!-- Mobile Specific Metas
	================================================== -->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
        <!-- Google Web Fonts
	================================================== -->
        <link rel="preconnect" href="https://fonts.googleapis.com/" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&amp;family=Source+Sans+Pro:wght@400;700&amp;display=swap" rel="stylesheet" />
        <!-- CSS
	================================================== -->
        <!-- Vendor CSS -->
        <link href="{!! asset('/guest/assets/vendor/bootstrap/css/bootstrap.css')!!}" rel="stylesheet" />
        <link href="{!! asset('/guest/assets/fonts/font-awesome/css/all.min.css')!!}" rel="stylesheet" />
        <link href="{!! asset('/guest/assets/fonts/simple-line-icons/css/simple-line-icons.css')!!}" rel="stylesheet" />
        <link href="{!! asset('/guest/assets/vendor/magnific-popup/dist/magnific-popup.css')!!}" rel="stylesheet" />
        <link href="{!! asset('/guest/assets/vendor/slick/slick.css')!!}" rel="stylesheet" />
        <!-- Template CSS-->
        <link href="{!! asset('/guest/assets/css/style-soccer-dark.css')!!}" rel="stylesheet" />
        <!-- Custom CSS-->
        <link href="{!! asset('/guest/assets/css/custom.css')!!}" rel="stylesheet" />
    </head>

    <body data-template="template-soccer">
        <div class="site-wrapper clearfix">
            <div class="site-overlay"></div>
            <!-- Header
		================================================== --><!-- Header Mobile -->
            <div class="header-mobile clearfix" id="header-mobile">
                <div class="header-mobile__logo">
                    <a href="{!!url('/')!!}"><img src="/guest/assets/logo-league.png" srcset="/guest/assets/logo-league.png 2x" alt="Kopi Sore League" class="header-mobile__logo-img" /></a>
                </div>
                <div class="header-mobile__inner">
                    <a id="header-mobile__toggle" class="burger-menu-icon"><span class="burger-menu-icon__line"></span></a> <span class="header-mobile__search-icon" id="header-mobile__search-icon"></span>
                </div>
            </div>
            <!-- Header Desktop -->
            <header class="header header--layout-1">
                <!-- Header Top Bar -->
                <div class="header__top-bar clearfix">
                    <div class="container">
                        <div class="header__top-bar-inner">
                            <!-- Account Navigation -->
                            <ul class="nav-account">
                                <li class="nav-account__item"><a href="{!!route('login')!!}">login</a></li>
                                {{-- <li class="nav-account__item nav-account__item--logout"><a href="_soccer_shop-login.html">Logout</a></li> --}}
                            </ul>
                            <!-- Account Navigation / End -->
                        </div>
                    </div>
                </div>
                <!-- Header Primary -->
                <div class="header__primary">
                    <div class="container">
                        <div class="header__primary-inner">
                            <!-- Header Logo -->
                            <div class="header-logo">
                                <a href="{!!url('/')!!}"><img src="/guest/assets/logo-league.png" srcset="/guest/assets/logo-league.png 2x" alt="Kopi Sore League" class="header-logo__img" /></a>
                            </div>
                            <!-- Header Logo / End --><!-- Main Navigation -->
                            <nav class="main-nav clearfix">
                                <ul class="main-nav__list">
                                    <li class="active"><a href="{!!url('/')!!}">Home</a></li>
                                </ul>
                                <!-- Pushy Panel Toggle -->
                                <a href="#" class="pushy-panel__toggle"><span class="pushy-panel__line"></span> </a>
                                <!-- Pushy Panel Toggle / Eng -->
                            </nav>
                            <!-- Main Navigation / End -->
                        </div>
                    </div>
                </div>
                <!-- Header Primary / End -->
            </header>
            <!-- Header / End -->
            @yield('content')
            <!-- Content / End -->
            <!-- Footer ================================================== -->
            <footer id="footer" class="footer">
               <!-- Footer Secondary -->
                <div class="footer-secondary">
                    <div class="container">
                        <div class="footer-secondary__inner">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="footer-copyright"><a href="{!!url('/')!!}">Create with <svg style="color: white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="18"
                                        height="18"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-coffee">
                                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"
                                            fill="white"></path>
                                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"
                                            fill="white"></path>
                                        <line x1="6"
                                            y1="1"
                                            x2="6"
                                            y2="4"></line>
                                        <line x1="10"
                                            y1="1"
                                            x2="10"
                                            y2="4"></line>
                                        <line x1="14"
                                            y1="1"
                                            x2="14"
                                            y2="4"></line>
                                    </svg> by Ade Pane</a> {!!date('Y')!!} &nbsp; | &nbsp; All Rights Reserved</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Secondary / End -->
            </footer>
            <!-- Footer / End -->
        </div>
        <!-- Javascript Files
	================================================== --><!-- Core JS -->
        <script src="{!! asset('/guest/assets/vendor/jquery/jquery.min.js')!!}"></script>
        <script src="{!! asset('/guest/assets/vendor/jquery/jquery-migrate.min.js')!!}"></script>
        <script src="{!! asset('/guest/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')!!}"></script>
        <script src="{!! asset('/guest/assets/js/core.js')!!}"></script>
        <!-- Vendor JS -->
        <!-- Template JS -->
        <script src="{!! asset('/guest/assets/js/init.js')!!}"></script>
        <script src="{!! asset('/guest/assets/js/custom.js')!!}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
            integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
        @stack('scripts')
    </body>
</html>
