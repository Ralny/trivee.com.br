<?php
//Verificando se o Usuario esta logado
if(!$this->session->userdata('is_logged_in')) redirect(base_url('login'));
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>Área Restrita - ZATA</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/simple-line-icons/simple-line-icons.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/uniform/css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/css/print.css" media="print">

<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
	<!-- TIMELINE -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/timeline.css"/>
	<!-- TOASTR -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-toastr/toastr.css"/>	
	<!-- DROPDOWNS-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/select2/select2.css"/>
	<!-- CHECKBOX E RADIOS -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/icheck/skins/all.css"/>
	<!-- CLOCKFACE -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
	<!-- DATEPICKER-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>	
	<!-- FORM TOOLS-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/typeahead/typeahead.css">	
	<!-- GRIDS -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>	
	<!--PAGES-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/profile.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/tasks.css"/>	
<!--TODO -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/todo.css">
<!-- PORTFOLIO-->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/fancybox/source/jquery.fancybox.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/portfolio.css"/>
<!-- EDIT TABLE -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>

<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/css/components-rounded.css" id="style_components">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/css/plugins.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout3/css/layout.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout3/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/layout3/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/admin/pages/css/invoice.css"/>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link hrel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/zata/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>

<!-- END THEME STYLES -->
<script type="text/javascript" src="<?= base_url() ?>assets/backend/zata/global/plugins/jquery.min.js"></script>

<link rel="shortcut icon" href="<?= base_url() ?>assets/backend/zata/imgs/favicon.ico"/>
</head>