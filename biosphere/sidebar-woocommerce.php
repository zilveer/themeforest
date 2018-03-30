<?php
/**
 * The Sidebar for the blog pages.
 */
?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php if ( ! dynamic_sidebar( 'sidebar-woocommerce' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->