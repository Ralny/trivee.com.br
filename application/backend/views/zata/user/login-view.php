<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt-br" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pt-br" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Entrar na Conta - ZATA</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES --> 
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/simple-line-icons/simple-line-icons.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/uniform/css/uniform.default.css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/login3.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/css/components-rounded.css" id="style_components"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/css/plugins.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout/css/layout.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout/css/themes/default.css" id="style_color"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout/css/custom.css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?= base_url() ?>assets/backend/zata/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login" style="background: url('<?= base_url() ?>assets/backend/zata/imgs/whistler_coast_mountains_dock-wide.jpg') no-repeat;
">
<!--<body class="login">-->

<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="./">
		<img src="<?= base_url() ?>assets/backend/zata/imgs/logo.png" alt="" width="250"/>
		</a>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?= base_url()?>entrar" method="post">
		<h2 class="form-title">Entre na sua conta.</h2>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>Digite seu e-mail e sua senha! </span>
		</div>

			<?php
			//Pagina de login - Mensagem para Usuario ou senha Não encontrados 
			if ($this->session->flashdata('msg') == 'usuario-nao-encontrado') 
				{
				    usuarioOusenhaNaoEncontrado();
				}
			//Pagina de login - Mensagem para Usuario bloqueado 	
			if ($this->session->flashdata('msg') == 'usuario-bloqueado') 
				{
				    usuarioBloqueado();
				}
			//Pagina de Registro - Solicitação Pendente 	
			if ($this->session->flashdata('msg') == 'solicitacao-registro-pendente') 
				{
				    usuarioSolcitacaoPendente();
				}			
			//Pagina de Registro - Solicitação ja foi aprovada - realize o login 	
			if ($this->session->flashdata('msg') == 'solicitacao-registro-aprovada') 
				{
				    usuarioSolcitacaoAprovada();
				}
			//Pagina de Registro - O sistema não identificou se o status da aprovação na solicitação de registro 	
			if ($this->session->flashdata('msg') == 'falha-suporte-tecnico') 
				{
				    usuarioFalhaSuporteTecnico();
				}
			//Falha ao salvar solcitação de registro
			if ($this->session->flashdata('msg') == 'falha-salvar-solicitacao') 
				{
				    usuarioFalhaSalvarSolicitacao();
				}								
			?>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">E-mail</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail" name="username" id="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Senha</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Senha" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Mantenha-me conectado</label>
			<button type="submit" class="btn blue pull-right">Entrar <i class="m-icon-swapright m-icon-white"></i></button>
		</div>
		<!--
		<div class="login-options">
			<h4>Use sua conta:</h4>
			<ul class="social-icons">
				<li>
					<a class="facebook" data-original-title="facebook" href="javascript:;">
					</a>
				</li>
				<li>
					<a class="googleplus" data-original-title="Goole Plus" href="<?php base_url().'user_authentication' ?>">
					</a>
				</li>
			</ul>
		</div>
		<div class="forget-password">
			<h4>Esqueceu sua senha?</h4>
			<p>
				clique <a href="javascript:;" id="forget-password">aqui </a>para reseta-lá.
			</p>
		</div>
		<div class="create-account">
			<p>
				Não possui conta ainda?&nbsp; <a href="javascript:;" id="register-btn">	Solicite a sua! </a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM --
	<form class="forget-form" action="<?= base_url()?>" method="post">
		<h2 class="form-title">Esqueceu a senha?</h2>
		<p>
			 Digite seu endereço de e-mail para redefini-lá.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Voltar </button>
			<button type="submit" class="btn blue pull-right"> Resetar  <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	<!-- BEGIN REGISTRATION FORM --
	<form class="register-form" action="<?= base_url()?>solicitar" method="post">
		<h2 class="form-title">Solicite sua conta!</h2>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Nome</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" type="text" name="nome" placeholder="Nome"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Sobrenome</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" type="text" name="sobrenome" placeholder="Sobrenome"/>
			</div>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that--
			<label class="control-label visible-ie8 visible-ie9">E-mail</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" name="email" placeholder="Email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Telefone</label>
			<div class="input-icon">
				<i class="fa fa-phone"></i>
				<input class="form-control placeholder-no-fix" type="text" name="fone" id="fone" placeholder="Celular"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">CPF</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" name="cpf" id="cpf" placeholder="CPF"/>
			</div>
		</div>
		<div class="form-group">
			<label>
			<input type="checkbox" name="tnc"/> Eu concordo com os Termos de Serviços e a Politica de Privacidade </label>
			<div id="register_tnc_error">
			</div>
		</div>
		<div class="form-actions">
			<button id="register-back-btn" type="button" class="btn">
			<i class="m-icon-swapleft"></i> Voltar </button>
			<button type="submit" id="register-submit-btn" class="btn blue pull-right">
			Enviar <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2016 &copy; ZATA | Trivee Tecnologia.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url() ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]--> 
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/jquery.blockui.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/uniform/jquery.uniform.min.js"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/scripts/metronic.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/admin/layout/scripts/layout.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/admin/layout/scripts/demo.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/admin/pages/scripts/login.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>