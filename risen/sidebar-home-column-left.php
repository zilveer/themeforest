<?php
/**
 * Home Column Left Widgets "Sidebar"
 * This shows widgets in a left-hand column at the bottom of the homepage
 */
?>

<?php if ( is_active_sidebar( 'home-column-left' ) ) : ?>

<div id="home-column-widgets-left">

	<?php dynamic_sidebar( 'home-column-left' ); ?>
	
</div>

<?php endif; ?>