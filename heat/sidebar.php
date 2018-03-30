<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

$current_layout = ot_get_option( 'layout' );

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
		<?php if ( is_page() ) : ?>
		
			<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
			
		<?php else :?>
			
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
			
		<?php endif; // end if ( is_page() ) ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>