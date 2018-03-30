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
<body <?php body_class(); ?>>

<!--PRELOADER-->
<div class="preloader">
	<div class="status"></div>
</div>
<!--/PRELOADER-->

<?php
	$slug = 'main_menu';
	if(MthemeInterface::isSiteMenuHasItems($slug)) { 
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
		   </div>
		   <div class="collapse navbar-collapse" id="example-navbar-collapse">
			  <?php MthemeInterface::renderSiteMenu($slug); ?>
		   </div>
		</nav>
	</div>
</div>
<!--/HEADER-->
<?php }else{ ?>
<div class="header">
	<div class="container">
		<nav class="navbar navbar-default" role="navigation" style="min-height:0;">
			<!-- Menu is empty -->
		</nav>
	</div>
</div>
<?php } ?>