<?php
/**
 * Events Sidebar
 */
?>

<?php if ( is_active_sidebar( 'events' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'events' ); ?>

</div>

<?php endif; ?>