<?php
/**
 * Staff Sidebar
 */
?>

<?php if ( is_active_sidebar( 'staff' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'staff' ); ?>

</div>

<?php endif; ?>