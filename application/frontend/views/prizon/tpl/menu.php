<!--======================================
        START HEADER AREA
    ======================================-->
    <section class="<?= $class_header_menu?>">
    <!--<div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-top-info header-left-info">
                        <ul class="info-list">
                            <li><i class="la la-envelope-o"></i><a href="mailto:example@gmail.com">comercial@trivee.com.br</a></li>
                            <li><i class="la la-phone"></i><a href="tel:18008012718">+55 86 99541-5491</a></li>
                        </ul>
                    </div><--- end header-top-info ->
                </div><--- end col-lg-7 ->
                <div class="col-lg-5">
                    <div class="header-top-info header-right-info">
                        <ul class="info-list">
                            <--
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
->
                            <li>
                                <a href="#" class="theme-btn">
                                    Suporte <span class="la la-caret-right"></span>
                                </a>
                            </li>
                        </ul>
                    </div><--- end header-top-info ->
                </div><--- end col-lg-5 ->
            </div><--- end row ->
        </div><--- end container ->
    </div>--><!-- end header-top -->
    <div class="header-menu-fluid">
        <div class="container">
            <div class="row align-items-center menu-content">
                <div class="col-lg-3">
                    <div class="logo-box">
                        <a href="<?=base_url() ?>" class="logo" title="Prizon"><img height=60px" src="<?= base_url()?>assets/frontend/trivee/prizon/images/logo4.png" alt="Prizon"></a>
                    </div>
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="menu-wrapper">
                        <nav class="main-menu">
                            <ul>
                                <li>
                                    <a href="#">Serviços</a>
                                    <ul class="dropdown-menu-item" style="width:250px">
                                        <li><a href="<?= base_url() ?>servicos/trivee-it-care">Trivee IT Care</a></li>
                                        <li><a href="<?= base_url() ?>servicos/trivee-cftv-guard">Trivee CFTV Guard</a></li>
                                        <li><a href="<?= base_url() ?>servicos/consultoria">Consultoria</a></li>
                                        <li><a href="<?= base_url() ?>servicos/noc">Monitoramento (NOC)</a></li>
                                        <li><a href="<?= base_url() ?>servicos/treinamentos">Treinamentos</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Soluções</a>
                                    <ul class="dropdown-menu-item mega-menu">
                                       <!-- <li>
                                            <div class="mega-menu-item">
                                                <h3 class="mega-menu-item-title">Redes Estruturadas</h3>
                                                <div class="section-divider"></div>
                                                <ul class="mega-menu-inner">
                                                    <li><a href="#">Cabeamento estruturado</a></li>
                                                    <li><a href="#">Rede Lan</a></li>
                                                    <li><a href="#">Rede Wan</a></li>
                                                    <li><a href="#">Rede Wan</a></li>
                                                </ul>
                                                <h3 class="mega-menu-item-title">Infraestrutura</h3>
                                                <div class="section-divider"></div>
                                                <ul class="mega-menu-inner">
                                                    <li><a href="#">Cabeamento estruturado</a></li>
                                                    <li><a href="#">Rede Lan</a></li>
                                                    <li><a href="#">Rede Wan</a></li>
                                                    <li><a href="#">Rede Wan</a></li>
                                                </ul>
                                            </div>
                                        </li> -->
                                        <li>
                                            <div class="mega-menu-item" style=" width:320px;">
                                                <h3 class="mega-menu-item-title">Aplicações web</h3>
                                                <div class="section-divider"></div>
                                                <ul class="mega-menu-inner">
                                                    <li><a href="#">Criação de Sites</a></li>
                                                    <li><a href="#">Intranets</a></li>
                                                    <li><a href="#">Portais de Clientes</a></li>
                                                    <li><a href="#">Portais de Parceiros</a></li>
                                                    <li><a href="#">Plataformas de integração</a></li>
                                                    <li><a href="#">Apps para o seu negócio</a></li>
                                                </ul>
                                                <!--<h3 class="mega-menu-item-title">Marketing</h3>
                                                <div class="section-divider"></div>
                                                <ul class="mega-menu-inner">
                                                    <li><a href="#">Midia Indoor</a></li>
                                                </ul> -->
                                            </div>
                                        </li>
                                        <!--<li>
                                            <div class="mega-menu-item">
                                                <h3 class="mega-menu-item-title">Segurança</h3>
                                                 <div class="section-divider"></div>
                                                <ul class="mega-menu-inner">
                                                    <li><a href="cards.html"><span class="la la-file-text"></span>cards</a></li>
                                                    <li><a href="info-box.html"><span class="la la-file-o"></span>info box</a></li>
                                                    <li><a href="icon-box.html"><span class="la la-tree"></span>icon box</a></li>
                                                    <li><a href="progress-bar.html"><span class="la la-tasks"></span>progress bar</a></li>
                                                    <li><a href="instagram-Widgets.html"><span class="la la-instagram"></span>Instagram Widgets</a></li>
                                                    <li><a href="video-galleries.html"><span class="la la-video-camera"></span>video galleries</a></li>
                                                    <li><a href="blockquotes.html"><span class="la la-quote-left"></span>blockquotes</a></li>
                                                    <li><a href="counters.html"><span class="la la-clock-o"></span>counters</a></li>
                                                </ul>
                                            </div>
                                        </li> -->
                                    </ul>
                                </li>
                                <li><a href="<?= base_url() ?>produtos">Produtos</a>
                                </li>
                                <li><a href="<?= base_url() ?>suporte">Suporte</a></li>
                                <li><a href="<?= base_url() ?>contato">Contato</a></li>
                                <!--
                                <li>
                                    <div class="cart-wrap">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span class="cart-count">2</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <div class="cart-title">
                                                    <h4>Shopping Cart</h4>
                                                </div>
                                                <div class="cart-items">
                                                    <div class="items">
                                                        <img src="images/shop-img-small.jpg" alt="product">
                                                        <div class="item__info">
                                                            <a href="shop-single.html">Blue Round-Neck T-shirt</a>
                                                            <span class="item__info-price">$20.00</span>
                                                        </div>
                                                        <a href="#" class="item__remove">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div><-- end items -->
                                                    <!--
                                                    <div class="items items2">
                                                        <img src="images/shop-img-small.jpg" alt="product">
                                                        <div class="item__info">
                                                            <a href="shop-single.html">Blue Round-Neck T-shirt</a>
                                                            <span class="item__info-price">$10.00</span>
                                                        </div>
                                                        <a href="#" class="item__remove">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div><-- end items -->
                                                    <!--
                                                    <div class="cart-info">
                                                        <p>Total: <span>$30.00</span></p>
                                                        <a class="theme-btn" href="shopping-cart.html">View Cart</a>
                                                        <a class="theme-btn checkout__btn" href="checkout.html">Checkout</a>
                                                    </div><-- end cart-info -->
                                                    <!--
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                            </ul><!-- end ul -->
                        </nav><!-- end main-menu -->
                        <div class="side-nav-container">
                            <div class="humburger-menu">
                                <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
                            </div><!-- end humburger-menu -->
                            <div class="side-menu-wrap">
                                <ul class="side-menu-ul">
                                    <li class="sidenav__item">
                                        <a href="index.html">home</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="index.html">home - main</a></li>
                                            <li><a href="home-2.html">home - agency</a></li>
                                            <li><a href="home-3.html">home - SEO</a></li>
                                            <li><a href="home-4.html">home  - IT Service</a></li>
                                            <li><a href="home-5.html">home - Medical</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidenav__item">
                                        <a href="#">pages</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="about-us.html">about us</a></li>
                                            <li><a href="services.html">services</a></li>
                                            <li><a href="service-single.html">service single</a></li>
                                            <li><a href="team.html">our team</a></li>
                                            <li><a href="team-single.html">team single</a></li>
                                            <li><a href="contact-us.html">contact us</a></li>
                                            <li><a href="page-404.html">404 page</a></li>
                                            <li><a href="page-faq.html">FAQ</a></li>
                                            <li><a href="login.html">log in</a>
                                            </li>
                                            <li><a href="sign-up.html">sign up</a>
                                            </li>
                                            <li><a href="recover.html">recover</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sidenav__item">
                                        <a href="#">portfolio</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="portfolio-2.html">2 columns</a></li>
                                            <li><a href="portfolio-3.html">3 columns</a></li>
                                            <li><a href="portfolio-4.html">4 columns</a></li>
                                            <li><a href="portfolio-masonry.html">portfolio masonry</a></li>
                                            <li><a href="portfolio-full-width.html">wide version</a></li>
                                            <li><a href="portfolio-single.html">single portfolio</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidenav__item">
                                        <a href="#">blog</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="blog-2.html">2 columns</a></li>
                                            <li><a href="blog-3.html">3 columns</a></li>
                                            <li><a href="blog-4.html">4 columns</a></li>
                                            <li><a href="blog-masonry.html">blog masonry</a></li>
                                            <li><a href="blog-full-width.html">wide version</a></li>
                                            <li><a href="blog-single.html">single blog</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidenav__item">
                                        <a href="#">shop</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="shop-home.html">shop home</a></li>
                                            <li><a href="shop-grid.html">shop grid</a></li>
                                            <li><a href="shop-single.html">shop single</a></li>
                                            <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidenav__item">
                                        <a href="#">elements</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            <li><a href="team-members.html"><span class="la la-users"></span>team members</a></li>
                                            <li><a href="pricing-tables.html"><span class="la la-money"></span>pricing tables</a></li>
                                            <li><a href="buttons.html"><span class="la la-mouse-pointer"></span>buttons</a></li>
                                            <li><a href="icon-hover-effects.html"><span class="la la-leaf"></span>icon hover effects</a></li>
                                            <li><a href="content-boxes.html"><span class="la la-question-circle"></span>content boxes</a></li>
                                            <li><a href="flip-boxes.html"><span class="la la-file"></span>flip boxes</a></li>
                                            <li><a href="alert-boxes.html"><span class="la la-warning"></span>alert boxes</a></li>
                                            <li><a href="countdown.html"><span class="la la-clock-o"></span>countdown</a></li>
                                            <li><a href="social-icons.html"><span class="la la-facebook"></span>social icons</a></li>
                                            <li><a href="google-maps.html"><span class="la la-map"></span>google maps</a></li>
                                            <li><a href="charts.html"><span class="la la-line-chart"></span>charts</a></li>
                                            <li><a href="content-carousels.html"><span class="la la-sliders"></span>content carousels</a></li>
                                            <li><a href="bullet-list.html"><span class="la la-list"></span>bullet list</a></li>
                                            <li><a href="accordions.html"><span class="la la-plus"></span>accordions</a></li>
                                            <li><a href="tabs.html"><span class="la la-list-alt"></span>tabs</a></li>
                                            <li><a href="image-galleries.html"><span class="la la-image"></span>image galleries</a></li>
                                            <li><a href="testimonials.html"><span class="la la-star"></span>testimonials</a></li>
                                            <li><a href="faqs.html"><span class="la la-question"></span>faqs</a></li>
                                            <li><a href="timeline.html"><span class="la la-hourglass"></span>timeline</a></li>
                                            <li><a href="tooltip.html"><span class="la la-bolt"></span>tooltip</a></li>
                                            <li><a href="modal.html"><span class="la la-columns"></span>modal</a></li>
                                            <li><a href="heading.html"><span class="la la-h-square"></span>heading</a></li>
                                            <li><a href="highlight-box.html"><span class="la la-bolt"></span>highlight box</a></li>
                                            <li><a href="dual-button.html"><span class="la la-toggle-on"></span>dual button</a></li>
                                            <li><a href="cards.html"><span class="la la-file-text"></span>cards</a></li>
                                            <li><a href="info-box.html"><span class="la la-file-o"></span>info box</a></li>
                                            <li><a href="icon-box.html"><span class="la la-tree"></span>icon box</a></li>
                                            <li><a href="progress-bar.html"><span class="la la-tasks"></span>progress bar</a></li>
                                            <li><a href="instagram-Widgets.html"><span class="la la-instagram"></span>Instagram Widgets</a></li>
                                            <li><a href="video-galleries.html"><span class="la la-video-camera"></span>video galleries</a></li>
                                            <li><a href="blockquotes.html"><span class="la la-quote-left"></span>blockquotes</a></li>
                                            <li><a href="counters.html"><span class="la la-clock-o"></span>counters</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="side-btn-box">
                                    <a href="#" class="theme-btn">get started <span class="la la-caret-right"></span></a>
                                </div>
                            </div><!-- end side-menu-wrap -->
                        </div><!-- end side-nav-container -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-9 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-fluid -->
</section><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->