		<div id="sidebar" class="col-md-4 column singlesidebar">

			<?php if ( is_active_sidebar( 'singlesidebar' ) ) :
					 dynamic_sidebar( 'singlesidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>