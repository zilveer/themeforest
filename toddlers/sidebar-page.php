		<div id="sidebar" class="col-md-4 column pagesidebar">

			<?php if ( is_active_sidebar( 'pagesidebar' ) ) :
					 dynamic_sidebar( 'pagesidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>