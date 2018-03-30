<?php
/**
 * Multimedia (Sermons) Sidebar
 */
?>

<?php if ( is_active_sidebar( 'multimedia' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'multimedia' ); ?>

</div>

<?php endif; ?>