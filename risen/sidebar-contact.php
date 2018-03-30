<?php
/**
 * Contact Sidebar
 */
?>

<?php if ( is_active_sidebar( 'contact' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'contact' ); ?>

</div>

<?php endif; ?>