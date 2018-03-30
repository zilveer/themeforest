<!-- Header -->
<header class="primary">

	<!-- Social Icons -->
	<?php get_template_part( 'partials/social' ); ?>

	<!-- Nav -->
	<nav class="navbar">
		<div class="navbar-inner">
			
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand animated">
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
			</a>

			<?php
				$args = array(
					'theme_location' => 'top-bar',
					'depth'          => 2,
					'container'      => false,
					'menu_class'     => 'nav',
					'menu_id'        => 'nav_menu',
					'walker'         => new Bootstrap_Walker_Nav_Menu()
				);
				if ( has_nav_menu( 'top-bar' ) ) 
					wp_nav_menu( $args );
			?>

			<!-- Search Form -->
			<?php get_template_part( 'searchform' ); ?>

		</div>

	</nav>	<!-- /Nav -->

</header> <!-- /Header -->