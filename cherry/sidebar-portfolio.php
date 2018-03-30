<?php
/**
 * The Sidebar containing the secondary Page widget area.
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // secondary widget area
	global $portfolio_sidebar, $portfolio_sidebar_exists;
	if (($portfolio_sidebar == 'default_sidebar') || (!$portfolio_sidebar_exists)) : $portfolio_s_name = 'portfolio-widget-area'; else : $portfolio_s_name = $portfolio_sidebar; endif;
	
	if ( is_active_sidebar( $portfolio_s_name ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $portfolio_s_name ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('st_after_sidebar');?>