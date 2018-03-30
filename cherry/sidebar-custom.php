<?php
/**
 * The dynamically generated custom sidebars
 */
?>

<?php do_action('st_before_sidebar');?>
<?php global $pages_sidebar, $posts_sidebar; ?>


<?php // primary widget area
	if ( is_active_sidebar( $pages_sidebar ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $pages_sidebar ); ?>
	</ul>
<?php endif; // end primary widget area ?>



<?php // secondary widget area
	if ( is_active_sidebar( $posts_sidebar ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $posts_sidebar ); ?>
	</ul>
<?php endif; // end primary widget area ?>


<?php do_action('st_after_sidebar');?>

