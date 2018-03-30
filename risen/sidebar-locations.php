<?php
/**
 * Locations Sidebar
 */
?>

<?php if ( is_active_sidebar( 'locations' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'locations' ); ?>

</div>

<?php endif; ?>