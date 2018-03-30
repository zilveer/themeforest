<?php
/**
 * The Sidebar for the blog pages.
 */
?>

	<div id="sidebar" class="one-third column last">

		<?php if ( ! dynamic_sidebar( 'sidebar-blog' ) ) : ?>

			<!-- No widgets -->

		<?php endif; ?>

	</div><!-- #sidebar -->