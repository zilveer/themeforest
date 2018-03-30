<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>
		<div class="one-third column" id="side">
			<aside class="gutter sidebar"><!--  the Sidebar -->
				<?php if ( is_active_sidebar( 'home-sidebar' ) ) : ?> <?php dynamic_sidebar( 'home-sidebar' ); ?>
				<?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
				<?php endif; ?>
			</aside>
		</div>
