<?php
/**
 * The Sidebar containing the primary widget area.
 *

 */
?>

		<div id="primary" class="widget-area grid4 sider" role="complementary" >
				
			<ul class="xoxo">

<?php

	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'localize' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'localize' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->

<?php

