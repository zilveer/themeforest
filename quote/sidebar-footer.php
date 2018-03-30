<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package quote
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


	<?php dynamic_sidebar( 'footer' ); ?>

