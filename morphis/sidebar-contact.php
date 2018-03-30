<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

?>
		<aside id="secondary" class="widget-area sidebar-right four columns omega" role="complementary">
			<?php if ( ! dynamic_sidebar( 'contact-page-sidebar' ) ) : ?>

				<aside id="archives" class="container-frame sidebar-borders widget">
					<h6 class="widget-title"><?php _e( 'Archives', 'morphis' ); ?></h6>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget container-frame sidebar-borders ">
					<h6 class="widget-title"><?php _e( 'Meta', 'morphis' ); ?></h6>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</aside><!-- #secondary .widget-area -->
<?php //endif; ?>