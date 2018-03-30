<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
		
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	    <?php wp_head(); ?>
	</head>

	<body  <?php body_class( ); ?>>

    	<a href="#" id="menu-toggle-wrapper">
			<div id="menu-toggle"></div>	
		</a>
		
		<!-- inner bar wrapper -->
    	<a href="#" id="inner-bar">
    		<?php if (ot_get_option('show_small_logo')=='on'): ?>
			
			<div class="logo-alt">
				<img src="<?php echo ot_get_option('small_logo') ?>" alt="logo-mini">
			</div><!-- /Small logo -->

			<?php endif; ?>
		</a>
		<!-- /inner bar wrapper -->

		
    	<!-- Sidebar -->	
		<div id="side-bar">
			<div class="inner-wrapper">	
				<div id="side-inner">

					
					<!-- Logo -->	
					<div id="logo-wrapper">
					<?php if (ot_get_option('site_logo') != ''): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo ot_get_option('site_logo') ?>" alt="logo"></a>
					<?php else: ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo generate_blank_image(150,70); ?>" alt="logo"></a>
					<?php endif; ?>
					</div>
					<!-- /Logo -->
					

					<div id="side-contents">

						
						<?php
						if ( has_nav_menu( 'main-menu' ) ) {
							wp_nav_menu( array(
								'theme_location' => 'main-menu',
								'menu' => '',
								'container' => false,
								'menu_class' => false,
								'items_wrap' => '<ul id = "navigation" class = "%2$s">%3$s</ul>',
								'depth' => 0,
								'walker' => new toranj_walker()
							) );
						}
						?>	

					</div>	

					<!-- Sidebar footer -->	
					<div id="side-footer">
					<?php if (is_active_sidebar( 'sidebar-2' )): ?>
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<?php endif; ?>

						<!-- Social icons -->	
						<ul class="social-icons">
							<?php toranj_social_icons();?>
						</ul>
						<!-- /Social icons -->
							
						<div id="copyright">
							<?php echo ot_get_option('copyright') ?>
						</div>
					</div>
					<!-- /Sidebar footer -->	

				</div>
			</div>
		</div>
		<!-- /Sidebar -->

		
				