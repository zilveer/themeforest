<?php
// Get template args
extract(morning_records_template_get_args('post-info'));

$thumb_sizes = array(
	'w' => 420,
	'h' => 420
);

$post_meta = get_post_meta($post_data['post_id'], morning_records_storage_get('options_prefix') . '_post_options', true);

$match_date = 	!empty($post_meta['match_date']) && !morning_records_param_is_inherit($post_meta['match_date']) ? date("d M", strtotime($post_meta['match_date'])) : '';	
$match_time = 	!empty($post_meta['match_time']) && !morning_records_param_is_inherit($post_meta['match_time']) ? $post_meta['match_time'] : '';	
$match_score = 	!empty($post_meta['match_score']) && !morning_records_param_is_inherit($post_meta['match_score']) ? $post_meta['match_score'] : '0-0';
$match_passed = false;

$start_date = $post_meta['match_date'] . ' ' . $post_meta['match_time'];
$today = date("Y-m-d G:i");  

if ($start_date > $today) {
    $match_passed = true;
}

$first_player = $post_meta['match_player_1'];
if (!empty($first_player) && $first_player!='none' && ($first_player_obj = (intval($first_player) > 0 ? get_post($first_player, OBJECT) : get_page_by_title($first_player, OBJECT, 'players'))) != null) {
	$first_player_post_meta = get_post_meta($first_player_obj->ID, morning_records_storage_get('options_prefix') . '_post_options', true);
					
	$first_player_name = $first_player_obj->post_title;
	$first_player_country = $first_player_post_meta['player_country'];
	$first_player_club = $first_player_post_meta['player_club'];
	$first_player_link = !empty($first_player_post_meta['player_link']) && $first_player_post_meta['player_link'] != 'inherit' ? $first_player_post_meta['player_link'] : get_permalink($first_player_obj->ID);
	$first_player_photo = wp_get_attachment_url(get_post_thumbnail_id($first_player_obj->ID));
	
	$first_player_photo = morning_records_get_resized_image_tag($first_player_photo, $thumb_sizes['w'], $thumb_sizes['h']);
}
		
$second_player = $post_meta['match_player_2'];
if (!empty($second_player) && $second_player!='none' && ($second_player_obj = (intval($second_player) > 0 ? get_post($second_player, OBJECT) : get_page_by_title($second_player, OBJECT, 'players'))) != null) {
	$second_player_post_meta = get_post_meta($second_player_obj->ID, morning_records_storage_get('options_prefix') . '_post_options', true);
					
	$second_player_name = $second_player_obj->post_title;
	$second_player_country = $second_player_post_meta['player_country'];
	$second_player_club = $second_player_post_meta['player_club'];
	$second_player_link = !empty($second_player_post_meta['player_link']) && $first_player_post_meta['player_link'] != 'inherit' ? $second_player_post_meta['player_link'] : get_permalink($second_player_obj->ID);
	$second_player_photo = wp_get_attachment_url(get_post_thumbnail_id($second_player_obj->ID));
	
	$second_player_photo = morning_records_get_resized_image_tag($second_player_photo, $thumb_sizes['w'], $thumb_sizes['h']);
}
		
if (!empty($first_player) && $first_player!='none' && ($first_player_obj = (intval($first_player) > 0 ? get_post($first_player, OBJECT) : get_page_by_title($first_player, OBJECT, 'players'))) != null
	&& !empty($second_player) && $second_player!='none' && ($second_player_obj = (intval($second_player) > 0 ? get_post($second_player, OBJECT) : get_page_by_title($second_player, OBJECT, 'players')))) {
		
	$first_player_points = get_post_meta($first_player_obj->ID, 'points', true);
	$second_player_points = get_post_meta($second_player_obj->ID, 'points', true);
?>
	<div class="match_block"><?php
		// First player
		?><div class="player player_first">
			<div class="player_country"><?php echo trim($first_player_country); ?></div>
			<div class="player_photo">
				<a class="hover_icon hover_icon_view" href="<?php echo esc_url($first_player_link); ?>" title="<?php echo esc_attr($first_player_name); ?>">
					<?php echo trim($first_player_photo); ?>
				</a>				
			</div>
			<div class="player_name"><a href="<?php echo trim($first_player_link); ?>"><?php echo trim($first_player_name);  ?></a></div>
		</div><?php
		// Score
		?><div class="match_info">
			<div class="match_date"><?php echo trim($match_date); ?> <?php echo trim($match_time); ?></div>
			<div class="match_score"><?php echo ($match_passed ? 'VS' : trim($match_score)); ?></div>
			<div class="match_category">
				<?php
					$post_categories = wp_get_post_terms( $post_data['post_id'],  'matches_group');
					if (is_array($post_categories) && count($post_categories)>0) {
						foreach ($post_categories as $cat){
							//$cat = get_category( $c );
							echo '<a href="'.esc_url(get_term_link($cat->term_id)).'">'.esc_html($cat->name).'</a> ';
						}
					}
				?>
			</div>
		</div><?php
		// Second player
		?><div class="player player_second">
			<div class="player_country"><?php echo trim($second_player_country); ?></div>
			<div class="player_photo">
				<a class="hover_icon hover_icon_view" href="<?php echo esc_url($second_player_link); ?>" title="<?php echo esc_attr($second_player_name); ?>">
					<?php echo trim($second_player_photo); ?>
				</a>				
			</div>
			<div class="player_name"><a href="<?php echo trim($second_player_link); ?>"><?php echo trim($second_player_name);  ?></a></div>
		</div>
	</div>
<?php
}
?>