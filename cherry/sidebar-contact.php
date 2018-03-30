<?php
/**
 * The Sidebar containing the secondary Page widget area.
 */
?>
<?php do_action('st_before_sidebar');?>

<?php // secondary widget area
	global $contact_sidebar, $contact_sidebar_exists;
	if (($contact_sidebar == 'default_sidebar') || (!$contact_sidebar_exists)) : $contact_s_name = 'contact-widget-area'; else : $contact_s_name = $contact_sidebar; endif;
	
	if ( is_active_sidebar( $contact_s_name ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $contact_s_name ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('st_after_sidebar');?>

