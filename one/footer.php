<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */
?>
			<?php thb_footer_layout(); ?>

			<?php get_template_part('partials/partial-footer'); ?>

		</div><!-- /#thb-external-wrapper -->

		<div id="slide-menu-container">
			<a class="thb-trigger-close" href="#"><span>Close</span></a>

			<div class="slide-menu-container-wrapper">
				<nav id="slide-nav" class="slide-navigation primary">
					<h2 class="hidden"><?php _e( 'Mobile navigation', 'thb_text_domain' ); ?></h2>
					<?php
						$theme_location = 'mobile';

						if ( thb_is_header_layout_b() ) {
							$theme_location = 'primary';
							$theme_location = apply_filters( 'thb_layout_b_menu_location', $theme_location );
						}
					?>
					<?php wp_nav_menu( array( 'theme_location' => $theme_location ) ); ?>
				</nav>
			</div>

		</div>

		<a href="#" class="thb-scrollup thb-go-top">Go top</a>

		<?php thb_body_end(); ?>

		<?php thb_footer(); ?>
		<?php wp_footer(); ?>
	</body>
</html>