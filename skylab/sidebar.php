<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
	<?php global $woocommerce; ?>
	<?php if ( is_page() ) : ?>
		
		<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
		
	<?php elseif ( $woocommerce && is_woocommerce() ) : ?>
			
		<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
			
	<?php else :?>
			
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
			
	<?php endif; // end if ( is_page() ) ?>
	</div><!-- #secondary .widget-area -->