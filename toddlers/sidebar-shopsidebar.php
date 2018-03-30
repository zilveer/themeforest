		<div id="sidebar" class="col-md-4 column shopsidebar">

			<?php if ( is_active_sidebar( 'shopsidebar' ) ) :
					 dynamic_sidebar( 'shopsidebar' );
					 else: dynamic_sidebar( 'sidebar' );
					 endif; // end sidebar widget area ?>

		</div>