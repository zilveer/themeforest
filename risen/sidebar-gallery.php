<?php
/**
 * Gallery Sidebar
 */
?>

<?php if ( is_active_sidebar( 'gallery' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'gallery' ); ?>

</div>

<?php endif; ?>