<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Blog sidebar
*	--------------------------------------------------------------------- 
*/
?>
		<div class="page-sidebar">
			<div class="widget-area">
				<?php if ( ! dynamic_sidebar( 'blog-sidebar' ) ) : ?>

					<aside id="archives" class="widget" role="complementary">
						<h3 class="widget-title"><?php _e( 'Archives', 'care' ); ?></h3>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>

					<aside id="meta" class="widget" role="complementary">
						<h3 class="widget-title"><?php _e( 'Meta', 'care' ); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<aside role="complementary"><?php wp_loginout(); ?></aside>
							<?php wp_meta(); ?>
						</ul>
					</aside>

			<?php endif; ?>
			</div>
		</div><!-- .page-sidebar -->