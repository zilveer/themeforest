<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<?php $class = ( get_option('use_preloader', 1) == 1 ) ? 'royal_loader' : ''; ?>

<body <?php body_class($class); ?>>

<div id="header"> 
	<div class="col-sm-12 col-lg-12">
		<div class="row">
		
			<div id="logo">
				<a class="scroll" href="<?php echo home_url(); ?>">
					<?php if( get_option('custom_logo') ) : ?>
						<img src="<?php echo get_option('custom_logo'); ?>" alt="<?php echo get_option('custom_logo_alt_text'); ?>" class="retina" />
					<?php else : ?>
						<span><?php echo bloginfo('name'); ?></span>
					<?php endif; ?>
				</a>
			</div>
			
			<?php
				if ( has_nav_menu( 'primary' ) ){
				    wp_nav_menu( 
				    	array(
					        'theme_location'    => 'primary',
					        'depth'             => 3,
					        'container'         => false,
					        'container_class'   => false,
					        'menu_class'        => '',
					        'menu_id'           => 'menu'
				        )
				    );
					    
				} else {
					echo '<a href="'. admin_url('nav-menus.php') .'">Set up a navigation menu now</a>';
				}
			?>
			
			<div id="nav-toggle">
				<i class="fa fa-bars"></i>
			</div>
		
		</div>
	</div>
</div>