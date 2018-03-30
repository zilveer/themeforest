<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package humbleshop
 */
?>
	<div id="secondary" class="widget-area col-sm-3" role="complementary">
		
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<aside id="archives" class="widget">
				<p class="widget-title"><strong><?php _e( 'Archives', 'humbleshop' ); ?></strong></p>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<p class="widget-title"><strong><?php _e( 'Meta', 'humbleshop' ); ?></strong></p>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>	
		
	</div><!-- #secondary -->
