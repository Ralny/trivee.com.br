<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->
   <?php $this->load->view('gelato_grano/app_producao/tpl/head.php') ?>
    <body>
        <div id="page-wrapper" class="page-loading">
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                 <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Sidebar Brand --
                    <div id="sidebar-brand" class="themed-background">
                        <a href="index.html" class="sidebar-title">
                            <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">App<strong>UI</strong></span>
                        </a>
                    </div>
                    <!-- END Sidebar Brand -->

                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="<?= base_url() ?>gelato_grano/app_producao" class=" active"><span class="sidebar-nav-mini-hide">INICIO</span></a>
                                </li>
                                <!--
                                <li>
                                    <a href="<?= base_url() ?>app_producao/cuba/9"><i class="gi gi-inbox sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">CUBA</span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>prod_gelato_grano/page/peso_balanca"><i class="fa fa-share-alt sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">PESO</span></a>
                                </li>-->
                            </ul>
                            <!-- END Sidebar Navigation -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                </div>


                <!-- END Main Sidebar -->
                <!-- Main Container -->
                <div id="main-container">+

                    <!-- Header -->
                   <header class="navbar navbar-inverse navbar-fixed-top">
                        <!-- Left Header Navigation -->
                        <ul class="nav navbar-nav-custom">
                            <!-- Main Sidebar Toggle Button -->
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                                    <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                                </a>
                            </li>
                            <!-- END Main Sidebar Toggle Button -->

                            <!-- Header Link -->
                            <li class="hidden-xs animation-fadeInQuick">
                                <a><strong>APP DE PRODUCAO</strong></a>
                            </li>
                            <!-- END Header Link -->
                        </ul>
                        <!-- END Left Header Navigation -->

                        <!-- Right Header Navigation -->
                        <ul class="nav navbar-nav-custom pull-right">
            
                            <!-- END Alternative Sidebar Toggle Button -->

                            <!-- User Dropdown --
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url()?>assets/prod_gelato_grano/img/placeholders/avatars/avatar9.jpg" alt="avatar">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">
                                        <strong>ADMINISTRATOR</strong>
                                    </li>
                                    <li>
                                        <a href="page_app_email.html">
                                            <i class="fa fa-inbox fa-fw pull-right"></i>
                                            Inbox
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_app_social.html">
                                            <i class="fa fa-pencil-square fa-fw pull-right"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_app_media.html">
                                            <i class="fa fa-picture-o fa-fw pull-right"></i>
                                            Media Manager
                                        </a>
                                    </li>
                                    <li class="divider"><li>
                                    <li>
                                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                                            <i class="gi gi-settings fa-fw pull-right"></i>
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_ready_lock_screen.html">
                                            <i class="gi gi-lock fa-fw pull-right"></i>
                                            Lock Account
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_ready_login.html">
                                            <i class="fa fa-power-off fa-fw pull-right"></i>
                                            Log out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END User Dropdown -->
                        </ul>
                        <!-- END Right Header Navigation -->
                    </header>
                    <!-- END Header -->
                    <!-- Page content -->
                    <?php $this->load->view($page) ?>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->
        <?php $this->load->view('gelato_grano/app_producao/tpl/js.php') ?>
    </body>
</html>