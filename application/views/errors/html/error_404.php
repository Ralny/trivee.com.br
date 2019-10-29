<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | 404 Page Option 3</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="http://www.trivee.com.br/zata/assets/admin/pages/css/error.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="http://www.trivee.com.br/zata/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="http://www.trivee.com.br/zata/assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="http://www.trivee.com.br/zata/assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-404-3">
<div class="page-inner">
	<img src="http://www.trivee.com.br/zata/assets/admin/pages/media/pages/earth.jpg" class="img-responsive" alt="">
</div>
<div class="container error-404">
	<h1 style="font-size: 90px;"> <?php echo $heading; ?></h1>
	<h2>Houston, we have a problem.</h2>
	<p>
		 <?php echo $message; ?>
	</p>
	<p>
	<!--
		<a href="">
		Return home </a> -->
		<br>
	</p>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="http://www.trivee.com.br/zata/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="http://www.trivee.com.br/zata/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script>
	jQuery(document).ready(function() {    
    	Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Demo.init(); // init demo features
	});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>