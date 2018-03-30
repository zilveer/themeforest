<?php
/**
 * Blog Sidebar
 */
?>

<?php if ( is_active_sidebar( 'blog' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'blog' ); ?>

</div>

<?php endif; ?>