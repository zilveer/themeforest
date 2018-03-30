<?php
/**
 * The Sidebar containing the secondary Page widget area.
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // secondary widget area
	global $pages_sidebar, $pages_sidebar_exists;
	if (($pages_sidebar == 'default_sidebar') || (!$pages_sidebar_exists)) : $pages_s_name = 'secondary-widget-area'; else : $pages_s_name = $pages_sidebar; endif;
	
	if ( is_active_sidebar( $pages_s_name ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $pages_s_name ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('st_after_sidebar');?>

