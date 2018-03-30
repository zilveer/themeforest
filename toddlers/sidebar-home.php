		<div id="sidebar" class="col-md-4 column homesidebar">

			<?php if ( is_active_sidebar( 'homesidebar' ) ) :
					 dynamic_sidebar( 'homesidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>