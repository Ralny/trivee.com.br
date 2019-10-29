<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<?php $this->load->view('tpl/header') ?>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-menu-fixed">
<!--<body class="page-header-menu-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed">-->
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div <?= $layout_class ?>>
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?= base_url() ?>receitas-de-gelato/listar"><img src="<?= base_url() ?>assets/zata/logo-default.png" width="170" heigth="50" alt="logo" class="logo-default"></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<?php // $this->load->view('tpl/notification') ?>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<?php // $this->load->view('tpl/todo') ?>
					<!-- END TODO DROPDOWN --
					<li class="droddown dropdown-separator">
						<span class="separator"></span>
					</li>
					<!-- BEGIN INBOX DROPDOWN -->
					<?php // $this->load->view('tpl/inbox') ?>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<?php $this->load->view('tpl/login') ?>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
	                    <span class="sr-only">Toggle Quick Sidebar</span>
	                    <i class="icon-logout"></i>
	                </li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div <?= $layout_class ?>>
			<!-- BEGIN HEADER SEARCH BOX -->
			<?php $this->load->view('tpl/search') ?>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			
			<?php

				if($this->session->userdata('id_perfil') == '1' ) 
				{
				 	$this->load->view('tpl/navbar_root');
				}

				if($this->session->userdata('id_perfil') == '2' )
				{
				 	$this->load->view('tpl/navbar_admin');
				}

				if($this->session->userdata('id_perfil') == '3' )
				{
				 	$this->load->view('tpl/navbar_estoque');
				}

				if($this->session->userdata('id_perfil') == '4' )
				{
				 	$this->load->view('tpl/navbar_producao');
				} 	 

			 ?>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div <?= $layout_class ?>>
			<!-- BEGIN PAGE TITLE -->
			<?php if (isset($page_title)){ ?>
			<div class="page-title">
				<h1><?= $page_title ?></h1>
			</div> 
			<?php } ?>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				<!-- BEGIN THEME PANEL -->
				<?php // $this->load->view('tpl/theme') ?>
				<!-- END THEME PANEL -->
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div <?= $layout_class ?>>
		<?php // $this->load->view('msg/alerts') ?>
		<?php //$this->load->view('msg/notes') ?> 
		<?php $this->load->view('msg/toastr') ?>	
		<?php $this->load->view($page) ?>
		</div>
	</div>	
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<?php $this->load->view('tpl/footer') ?>
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<?php $this->load->view('tpl/js') ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>