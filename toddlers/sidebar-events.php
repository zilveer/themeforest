		<div id="sidebar" class="col-md-4 column eventssidebar">

			<?php if ( is_active_sidebar( 'eventssidebar' ) ) :
					 dynamic_sidebar( 'eventssidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>