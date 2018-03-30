<?php
/**
 * Header Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]>  <html> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php mysite_document_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php mysite_head(); ?>
<?php wp_head(); ?>
</head>

<body class="<?php mysite_body_class(); ?>">
<div class="multibg"><div class="multibg"></div></div>
<div id="body_inner">
	
<?php mysite_before_header();

?><div id="header">
		<div id="header_inner">
			
		<?php mysite_header(); 
		
		?></div><!-- #header_inner -->
	</div><!-- #header -->
	
<?php mysite_after_header();

?><div id="content">
		<div id="content_inner">
			
			<?php mysite_before_main();
			
			?><div id="main">
				<div id="main_inner">
					<?php mysite_before_page_content(); ?>