<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

<title><?php bloginfo( 'name' ); ?> <?php wp_title( '|', true, 'right' ); ?></title>

<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
