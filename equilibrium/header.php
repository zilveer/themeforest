<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	
	<!-- title -->
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	
	<!-- meta tags -->
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="author" content="onioneye" />
	<meta name="author-url" content="http://www.onioneye.com" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	
  	<!-- RSS and pingback -->
  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- main stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/styles/custom.php?ver=<?php of_file_version( 'styles/custom.php' ); ?>" />	
	
	<!-- print stylesheet -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/styles/print.css" media="print" />
	
	<!-- google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic&v2' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		
	<!-- wp head -->
	<?php wp_head(); ?>
	<!-- wp head end -->
</head>

<!--[if IE 8 ]> <body <?php body_class( 'ie ie8' ); ?>> <![endif]-->
<!--[if IE 9 ]> <body <?php body_class( 'ie ie9' ); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <body <?php body_class(); ?>> <!--<![endif]-->
	
	<!-- START #secondary-wrapper --> 
	<div id="secondary-wrapper" class="container_12 group">
			
			<!-- START .header_info --> 
			<p class="header-info grid_6"><?php echo of_get_option( 'header_text', '' ) ?></p>
			<!-- END .header_info -->
			
			<!-- START #social-networking --> 
			<ul class="grid_6" id="social-networking">
				<?php eq_social_networks(); ?>
			</ul>
			<!-- END #social-networking -->
			
	</div>	
	<!-- END #secondary-wrapper -->
	
	<!-- START #main-wrapper --> 
	<div id="main-wrapper" class="container_12 group">
	
		<!-- START #header -->
	 	<header id="header" class="grid_12">
	 			 		
			<!-- START Custom Menu -->
			<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => 'nav', 'menu' => 'custom_menu', 'container_id' => 'menu', 'container_class' => 'container_12 group', 'depth' => 2, 'walker' => new Nfr_Menu_Walker() ) ); ?>
			<!-- END Custom Menu -->
			
			<!-- START #logo -->
			<div id="logo">
				<?php eq_the_custom_logo(); ?>
			</div>
			<!-- END #logo -->
				
		</header>
		<!-- END #header -->
				  	
		<!-- START #content --> 
		<div id="content" class="grid_12 group">	