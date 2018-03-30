		<div id="sidebar" class="col-md-4 column blogsidebar">

			<?php if ( is_active_sidebar( 'sidebar' ) ) :
					 dynamic_sidebar( 'sidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>