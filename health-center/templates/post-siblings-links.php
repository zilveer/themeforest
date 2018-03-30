<?php

/**
 * Prev/next/view all buttons for posts and portfolio items
 *
 * @package wpv
 * @subpackage health-center
 */

global $post;

$same_cat = count(wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'))) > 0;
if($post->post_type == 'portfolio')
	$same_cat = false;

$view_all = wpv_get_option($post->post_type.'-all-items');

if(is_singular(array('tribe_events', 'tribe_organizer', 'tribe_venue')) && function_exists('tribe_get_events_link')) {
	$view_all = tribe_get_events_link();
}

$prev_anchor = '<span class="icon theme">'.wpv_get_icon('theme-arrow-left3').'</span>';
$next_anchor = '<span class="icon theme">'.wpv_get_icon('theme-arrow-right3').'</span>';

?>
<span class="post-siblings">
	<?php
		if(is_singular('tribe_events') && function_exists('tribe_the_prev_event_link')) {
			tribe_the_prev_event_link( $prev_anchor );
		} else {
			previous_post_link('%link', $prev_anchor, $same_cat);
		}
	?>

	<?php if(!empty($view_all)): ?>
		<a href="<?php echo $view_all ?>" class="all-items"><?php echo do_shortcode('[icon name="theme-grid"]') ?></a>
	<?php endif ?>

	<?php
		if(is_singular('tribe_events') && function_exists('tribe_the_next_event_link')) {
			tribe_the_next_event_link( $next_anchor );
		} else {
			next_post_link('%link', $next_anchor, $same_cat);
		}
	?>
</span>