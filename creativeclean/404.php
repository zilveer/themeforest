<?php

get_header(); ?>

				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
					<h1><?php _e( 'Not Found', 'creativeclean' ); ?></h1>
					<p><?php _e( 'Apologies, but the page you requested could not be found.', 'creativeclean' ); ?></p>
					</div><!-- #maincontent -->
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
						<?php get_sidebar(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>			
			
<?php get_footer(); ?>
