<?php
/**
 * Search Sidebar
 */
?>

<?php if ( is_active_sidebar( 'search' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'search' ); ?>

</div>

<?php endif; ?>