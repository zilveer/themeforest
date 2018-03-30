<?php
/**
 * Primary Sidebar (Regular Pages)
 */
?>

<?php if ( is_active_sidebar( 'primary' ) ) : ?>

<div id="sidebar-right" role="complementary">

	<?php dynamic_sidebar( 'primary' ); ?>

</div>

<?php endif; ?>