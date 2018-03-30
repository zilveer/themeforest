<?php
/**
 * The Sidebar containing the primary blog sidebar
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // primary widget area
	global $posts_sidebar, $posts_sidebar_exists;
	if (($posts_sidebar == 'default_sidebar') || (!$posts_sidebar_exists)) : $posts_s_name = 'primary-widget-area'; else : $posts_s_name = $posts_sidebar; endif;
	
	if ( is_active_sidebar( $posts_s_name ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $posts_s_name ); ?>
	</ul>
<?php endif; // end primary widget area ?>


<?php do_action('st_after_sidebar');?>

