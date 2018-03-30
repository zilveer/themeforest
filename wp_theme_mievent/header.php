<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>		
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="<?php echo MthemeCore::getOption('meta_author','multia.in'); ?>">
	<meta name="description" content="<?php echo MthemeCore::getOption('meta_description','multia.in'); ?>">
	<meta name="keywords" content="<?php echo MthemeCore::getOption('meta_keywords','multia.in'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
			
	<!-- PAGE TITLE -->
	<meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?></title>
		
	<?php wp_head(); ?>
</head>
<?php if ( is_page_template('template-event-landing.php') || is_singular('event') ) { ?>
<body id="top" <?php body_class(); ?>>
<?php }else{ ?>
<body <?php body_class(); ?>>
<?php } ?>
<!--PRELOADER-->
<div class="preloader">
	<div class="status"></div>
</div>
<!--/PRELOADER-->

<?php if ( !is_page_template('template-event-landing.php') && !is_singular('event')) { 
?>
<!--HEADER-->
<div class="header header-hide">
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" 
					 data-target="#example-navbar-collapse">
					 <span class="sr-only">Toggle navigation</span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
				</button>		
				<a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo MthemeCore::getOption("site_logo",""); ?>" alt="<?php echo MthemeCore::getOption('logo_text','logo');?>"/></a>
		   </div>
		   <?php $slug = 'main_menu'; ?>
		   <div class="collapse navbar-collapse" id="example-navbar-collapse">
			  <?php MthemeInterface::renderSiteMenu($slug); ?>
		   </div>
		</nav>
	</div>
</div>
<!--/HEADER-->
<?php
} ?>
	