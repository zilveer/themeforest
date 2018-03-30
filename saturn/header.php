<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
	<header class="header">
		<div class="container">
			<?php if( get_header_image() ):?>
				<div class="logo">
					<a href="<?php print esc_url( home_url() );?>" title="<?php print esc_attr( get_bloginfo( 'description' ) );?>">
						<img alt="<?php print esc_attr( get_bloginfo( 'description' ) );?>" src="<?php header_image();?>">
					</a>
				</div><!-- end logo -->
			<?php endif;?>
			<?php if( has_nav_menu('main_navigation') ):?>
				<div id="navigation-wrapper" class="navigation">
				    <div class="navbar-header">
					  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
				    </div>
				    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
				    	<?php 
				    		wp_nav_menu( apply_filters( 'saturn_nav_menu_args' , array(
				    			'menu_class'		=>	'nav navbar-nav list-inline menu',
				    			'theme_location'	=>	'main_navigation',
				    			'container'			=>	null,
				    			'walker'			=>	class_exists( 'Saturn_Walker_Nav_Menu' ) ? new Saturn_Walker_Nav_Menu() : ''
				    		)) );
				    	?>		    
				    </nav>	
				</div><!-- end navigation -->
			<?php endif;?>
		</div><!-- end container -->
	</header><!-- End Header -->