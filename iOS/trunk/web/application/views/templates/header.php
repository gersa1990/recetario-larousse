<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="resources/img/icon.png">
	<script src="<?php echo base_url()?>js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo base_url(); ?>Resources/js/colorpicker.js"></script>
	<script src="<?php echo base_url()?>js/leanModal.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/reset.css" type="text/css" media="screen"/> 
	<link rel="stylesheet" href="<?php echo base_url()?>css/styles.css" type="text/css" media="screen"/> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/jquery-ui.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/colorpicker.css" type="text/css" media="screen">	
	<!--Termina CSS -->

	<!-- JS -->
	<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>js/tinymce.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/funcionesJS.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/validation/jquery.validate.js"></script>


	<script>
	$(function() {
  		$('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '#ventana .modal_close' }); 
	});
	</script>

	<!-- Termina JS -->
	
</head>

<body>
	<header>
		<div class="wrapper">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>resources/img/logo.png" width="200"></a>
		</div>
	</header>