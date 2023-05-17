<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Basic Page Needs
	================================================== -->
        <title>Alchemists Soccer Club &amp; Sports News HTML Template - Home</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="TenisMeja.club" />
        <meta name="keywords" content="tenis meja club" />
        <!-- Favicons
	================================================== -->
        <link rel="shortcut icon" href="/guest/assets/images/soccer/favicons/favicon.ico" />
        <link rel="apple-touch-icon" sizes="120x120" href="/guest/assets/images/soccer/favicons/favicon-120.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/guest/assets/images/soccer/favicons/favicon-152.png" />
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
                    <a href="_soccer_index.html"><img src="/guest/assets/images/soccer/logo.png" srcset="/guest/assets/images/soccer/logo@2x.png 2x" alt="Alchemists" class="header-mobile__logo-img" /></a>
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
                                <a href="_soccer_index.html"><img src="/guest/assets/images/soccer/logo.png" srcset="/guest/assets/images/soccer/logo@2x.png 2x" alt="Alchemists" class="header-logo__img" /></a>
                            </div>
                            <!-- Header Logo / End --><!-- Main Navigation -->
                            <nav class="main-nav clearfix">
                                <ul class="main-nav__list">
                                    <li class="active"><a href="_soccer_index.html">Home</a></li>
                                    <li class="">
                                        <a href="#">Features</a>
                                        <div class="main-nav__megamenu clearfix">
                                            <ul class="col-lg-2 col-md-3 col-12 main-nav__ul">
                                                <li class="main-nav__title">Features</li>
                                                <li><a href="_soccer_features-shortcodes.html">Shortcodes</a></li>
                                                <li><a href="_soccer_features-typography.html">Typography</a></li>
                                                <li><a href="_soccer_features-widgets-blog.html">Widgets - Blog</a></li>
                                                <li><a href="_soccer_features-widgets-shop.html">Widgets - Shop</a></li>
                                                <li><a href="_soccer_features-widgets-sports.html">Widgets - Sports</a></li>
                                                <li><a href="_soccer_features-404.html">404 Error Page</a></li>
                                                <li><a href="_soccer_features-search-results.html">Search Results</a></li>
                                                <li><a href="_soccer_page-contacts.html">Contact Us</a></li>
                                            </ul>
                                            <ul class="col-lg-2 col-md-3 col-12 main-nav__ul">
                                                <li class="main-nav__title">Other Pages</li>
                                                <li><a href="_soccer_page-sponsors.html">Sponsors</a></li>
                                                <li><a href="_soccer_page-faqs.html">FAQs</a></li>
                                                <li><a href="_soccer_staff-single.html">Staff Member</a></li>
                                                <li><a href="_soccer_event-tournament.html">Tournament</a></li>
                                                <li><a href="_soccer_shop-list.html">Shop Page</a></li>
                                                <li><a href="_soccer_shop-cart.html">Shopping Cart</a></li>
                                                <li><a href="_soccer_shop-wishlist.html">Wishlist</a></li>
                                                <li><a href="_soccer_shop-checkout.html">Checkout</a></li>
                                            </ul>
                                            <div class="col-lg-4 col-md-3 col-12">
                                                <div class="posts posts--simple-list posts--simple-list--lg">
                                                    <div class="posts__item posts__item--category-1">
                                                        <div class="posts__inner">
                                                            <div class="posts__cat"><span class="label posts__cat-label">The Team</span></div>
                                                            <h6 class="posts__title"><a href="#">The team is starting a new power breakfast regimen</a></h6>
                                                            <time datetime="2017-08-23" class="posts__date">August 23rd, 2017</time>
                                                            <div class="posts__excerpt">Lorem ipsum dolor sit amet, consectetur adipisi nel elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                                        </div>
                                                        <div class="posts__footer card__footer">
                                                            <div class="post-author">
                                                                <figure class="post-author__avatar"><img src="/guest/assets/images/samples/avatar-1.jpg" alt="Post Author Avatar" /></figure>
                                                                <div class="post-author__info"><h4 class="post-author__name">James Spiegel</h4></div>
                                                            </div>
                                                            <ul class="post__meta meta">
                                                                <li class="meta__item meta__item--likes">
                                                                    <a href="#"><i class="meta-like meta-like--active icon-heart"></i> 530</a>
                                                                </li>
                                                                <li class="meta__item meta__item--comments"><a href="#">18</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-12">
                                                <ul class="posts posts--simple-list">
                                                    <li class="posts__item posts__item--category-1">
                                                        <figure class="posts__thumb">
                                                            <a href="#"><img src="/guest/assets/images/samples/post-img3-xs.jpg" alt="" /></a>
                                                        </figure>
                                                        <div class="posts__inner">
                                                            <div class="posts__cat"><span class="label posts__cat-label">The Team</span></div>
                                                            <h6 class="posts__title"><a href="#">The new eco friendly stadium won a Leafy Award in 2016</a></h6>
                                                            <time datetime="2016-08-21" class="posts__date">August 21st, 2016</time>
                                                        </div>
                                                    </li>
                                                    <li class="posts__item posts__item--category-2">
                                                        <figure class="posts__thumb">
                                                            <a href="#"><img src="/guest/assets/images/samples/post-img1-xs.jpg" alt="" /></a>
                                                        </figure>
                                                        <div class="posts__inner">
                                                            <div class="posts__cat"><span class="label posts__cat-label">Injuries</span></div>
                                                            <h6 class="posts__title"><a href="#">Mark Johnson has a Tibia Fracture and is gonna be out</a></h6>
                                                            <time datetime="2016-08-23" class="posts__date">August 23rd, 2016</time>
                                                        </div>
                                                    </li>
                                                    <li class="posts__item posts__item--category-1">
                                                        <figure class="posts__thumb">
                                                            <a href="#"><img src="/guest/assets/images/samples/post-img4-xs.jpg" alt="" /></a>
                                                        </figure>
                                                        <div class="posts__inner">
                                                            <div class="posts__cat"><span class="label posts__cat-label">The Team</span></div>
                                                            <h6 class="posts__title"><a href="#">The team is starting a new power breakfast regimen</a></h6>
                                                            <time datetime="2016-08-21" class="posts__date">August 21st, 2016</time>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
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
                <!-- Footer Widgets -->
                <div class="footer-widgets">
                    <div class="footer-widgets__inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="footer-col-inner">
                                        <!-- Footer Logo -->
                                        <div class="footer-logo footer-logo--has-txt">
                                            <a href="index.html">
                                                <img src="/guest/assets/images/soccer/logo-footer.png" srcset="/guest/assets/images/soccer/logo-footer@2x.png 2x" alt="The Alchemists" class="footer-logo__img" />
                                                <div class="footer-logo__heading">
                                                    <h5 class="footer-logo__txt">The Alchemists</h5>
                                                    <span class="footer-logo__tagline">Elric Bros School</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Footer Logo / End --><!-- Widget: Contact Info -->
                                        <div class="widget widget--footer widget-contact-info">
                                            <div class="widget__content">
                                                <div class="widget-contact-info__desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur cing elit, sed do eiusmod tempor incididunt uten labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                                </div>
                                                <div class="widget-contact-info__body info-block">
                                                    <div class="info-block__item">
                                                        <svg role="img" class="df-icon df-icon--soccer-ball"><use xlink:href="/guest/assets/images/icons-soccer.svg#soccer-ball" /></svg>
                                                        <h6 class="info-block__heading">Contact Us</h6>
                                                        <a class="info-block__link" href="mailto:tryouts@alchemists.com">tryouts@alchemists.com</a>
                                                    </div>
                                                    <div class="info-block__item">
                                                        <svg role="img" class="df-icon df-icon--whistle"><use xlink:href="/guest/assets/images/icons-soccer.svg#whistle" /></svg>
                                                        <h6 class="info-block__heading">Join Our Team!</h6>
                                                        <a class="info-block__link" href="mailto:info@alchemists.com">info@alchemists.com</a>
                                                    </div>
                                                    <div class="info-block__item info-block__item--nopadding">
                                                        <ul class="social-links">
                                                            <li class="social-links__item">
                                                                <a href="#" class="social-links__link"><i class="fab fa-facebook"></i> Facebook</a>
                                                            </li>
                                                            <li class="social-links__item">
                                                                <a href="#" class="social-links__link"><i class="fab fa-twitter"></i> Twitter</a>
                                                            </li>
                                                            <li class="social-links__item">
                                                                <a href="#" class="social-links__link"><i class="fab fa-instagram"></i> Instagram</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Widget: Contact Info / End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Widgets / End --><!-- Footer Secondary -->
                <div class="footer-secondary">
                    <div class="container">
                        <div class="footer-secondary__inner">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="footer-copyright"><a href="_soccer_index.html">The Alchemists</a> 2020 &nbsp; | &nbsp; All Rights Reserved</div>
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
    </body>
</html>
