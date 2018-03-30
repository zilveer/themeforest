<?php
/**
 * Home Column Right Widgets "Sidebar"
 * This shows widgets in a right-hand column at the bottom of the homepage
 */
?>

<?php if ( is_active_sidebar( 'home-column-right' ) ) : ?>

<div id="home-column-widgets-right">

	<?php dynamic_sidebar( 'home-column-right' ); ?>

</div>

<?php endif; ?>