<?php
// Get template args
extract(morning_records_template_get_args('counters'));

$show_all_counters = !isset($post_options['counters']);
$counters_tag = is_single() ? 'span' : 'a';

//if (is_array($post_options['counters'])) $post_options['counters'] = join(',', $post_options['counters']);

// Views
if ($show_all_counters || morning_records_strpos($post_options['counters'], 'views')!==false) {
	?>
	<<?php echo trim($counters_tag); ?> class="post_counters_item post_counters_views underline" title="<?php echo esc_attr( sprintf(__('Views - %s', 'morning-records'), $post_data['post_views']) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php echo trim($post_data['post_views']); ?></span><?php echo ' '.esc_html__('Views', 'morning-records'); ?></<?php echo trim($counters_tag); ?>>
	<?php
}

// Comments
if ($show_all_counters || morning_records_strpos($post_options['counters'], 'comments')!==false) {
	?>
	<a class="post_counters_item post_counters_comments underline" title="<?php echo esc_attr( sprintf(__('Comments - %s', 'morning-records'), $post_data['post_comments']) ); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><span class="post_counters_number"><?php echo trim($post_data['post_comments']); ?></span><?php echo ' '.esc_html__('Comments', 'morning-records'); ?></a>
	<?php 
}
 
// Rating
$rating = $post_data['post_reviews_'.(morning_records_get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
if ($rating > 0 && ($show_all_counters || morning_records_strpos($post_options['counters'], 'rating')!==false)) { 
	?>
	<<?php echo trim($counters_tag); ?> class="post_counters_item post_counters_rating icon-star" title="<?php echo esc_attr( sprintf(__('Rating - %s', 'morning-records'), $rating) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php echo trim($rating); ?></span></<?php echo trim($counters_tag); ?>>
	<?php
}

// Likes
if ($show_all_counters || morning_records_strpos($post_options['counters'], 'likes')!==false) {
	// Load core messages
	morning_records_enqueue_messages();
	$likes = isset($_COOKIE['morning_records_likes']) ? $_COOKIE['morning_records_likes'] : '';
	$allow = morning_records_strpos($likes, ','.($post_data['post_id']).',')===false;
	?>
	<a class="post_counters_item post_counters_likes underline <?php echo !empty($allow) ? 'enabled' : 'disabled'; ?>" title="<?php echo !empty($allow) ? esc_attr__('Like', 'morning-records') : esc_attr__('Dislike', 'morning-records'); ?>" href="#"
		data-postid="<?php echo esc_attr($post_data['post_id']); ?>"
		data-likes="<?php echo esc_attr($post_data['post_likes']); ?>"
		data-title-like="<?php esc_attr_e('Like', 'morning-records'); ?>"
		data-title-dislike="<?php esc_attr_e('Dislike', 'morning-records'); ?>"><span class="post_counters_number"><?php echo trim($post_data['post_likes']); ?></span><?php echo ' '.esc_html__('Likes', 'morning-records'); ?></a>
	<?php
}

// Edit page link
if (morning_records_strpos($post_options['counters'], 'edit')!==false) {
	edit_post_link( esc_html__( 'Edit', 'morning-records' ), '<span class="post_edit edit-link">', '</span>' );
}

// Markup for search engines
if (is_single() && morning_records_strpos($post_options['counters'], 'markup')!==false) {
	?>
	<meta itemprop="interactionCount" content="User<?php echo esc_attr(morning_records_strpos($post_options['counters'],'comments')!==false ? 'Comments' : 'PageVisits'); ?>:<?php echo esc_attr(morning_records_strpos($post_options['counters'], 'comments')!==false ? $post_data['post_comments'] : $post_data['post_views']); ?>" />
	<?php
}
?>