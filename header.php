<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

<title><?php bloginfo( 'name' ); ?> <?php wp_title(); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />

<!-- Viewport -->
<!-- <meta name="viewport" content="width=device-width"> -->

<link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/img/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />

<?php wp_head(); ?>
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->