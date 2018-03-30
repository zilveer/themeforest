<?php
if( !function_exists('shortcode_empty_paragraph_fix') ):
function shortcode_empty_paragraph_fix($content)
{
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
endif;
add_filter('the_content', 'shortcode_empty_paragraph_fix');

if( !function_exists('ci_tracklisting_shortcode_handler') ):
function ci_tracklisting_shortcode_handler($params, $content = '')
{
	if(!empty($content))
		return ci_tracklisting_old_shortcode($params, $content);
	else
		return ci_tracklisting_shortcode($params, $content);
}
endif;
add_shortcode('tracklisting', 'ci_tracklisting_shortcode_handler');


if( !function_exists('ci_tracklisting_old_shortcode') ):
function ci_tracklisting_old_shortcode($params, $content = '')
{
	return '<ul class="tracklisting widget-tracks">' . do_shortcode($content) . '</ol>';
}
endif;


if( !function_exists('ci_tracklisting_shortcode') ):
function ci_tracklisting_shortcode($params, $content = '') {
	extract( shortcode_atts( array(
		'id' => '',
		'slug' => '',
		'limit' => -1,
		'tracks' => '',
		'hide_numbers' => '',
		'hide_buttons' => '',
		'hide_players' => '',
		'hide_titles' => ''
	), $params ) );

	$tracks = empty($tracks) ? '' : explode(',', $tracks);

	global $post;

	// By default, when the shortcode tries to get the tracklisting of any discography item, should be
	// restricted to only published discographies.
	// However, when the discography itself shows its own tracklisting, it should be allowed to do so,
	// no matter what its post status may be.
	$args = array(
		'post_type' => 'cpt_discography',
		'post_status' => 'publish',
		'numberposts' => '1',
		'suppres_filters' => false
	);
	
	if(empty($id) and empty($slug))
	{
		$args['p'] = $post->ID;

		// We are showing the current post's tracklisting (since we didn't get any parameters),
		// so we need to make sure we can retrieve it whatever its post status might be.
		$args['post_status'] = 'any';
	}
	elseif(!empty($id) and $id > 0)
	{
		$args['p'] = $id;

		// Check if the current post's ID matches what was passed.
		// If so, we need to make sure we can retrieve it whatever its post status might be.
		if($post->ID == $args['p'])
			$args['post_status'] = 'any';
	}
	elseif(!empty($slug))
	{
		$args['name'] = sanitize_title_with_dashes($slug, '', 'save');

		// Check if the current post's slug matches what was passed.
		// If so, we need to make sure we can retrieve it whatever its post status might be.
		if($post->post_name == $args['name'])
			$args['post_status'] = 'any';
	}

	$posts = get_posts($args);

	if(count($posts) >= 1)
	{
		$post_id = $posts[0]->ID;

		$fields = get_post_meta( $post_id, 'ci_cpt_discography_tracks', true );
		$fields = ci_theme_convert_discography_tracks_from_unnamed( $fields );

		ob_start();
	
		if(!empty($fields))
		{
			$track_num = 0; // Helps count actual songs (instead of increments of field groups, i.e. 6)
			$outputted = 0; // Helps count actually outputted songs. Used with 'limit' parameter.
			?>
			<ul class="tracklisting widget-tracks">
				<?php foreach( $fields as $field ): ?>
					<?php
						$track_num++;
						$track_id = $post_id.'_'.$track_num;

						if(is_array($tracks) and !in_array($track_num, $tracks))
							continue;
					?>
	
					<li id="custom_player<?php echo $track_id; ?>" class="gradient track group custom_player<?php echo $track_id; ?>">
					
						<?php if( empty($hide_numbers) ): ?>
							<span class="track-no"><?php echo $track_num; ?></span>
						<?php endif; ?>
	
						<?php if( empty($hide_titles) ): ?>
							<div class="track-info">
								<h4 class="pair-title"><?php echo $field['title']; ?></h4>
								<?php if(!empty($field['subtitle'])): ?>
									<p class="pair-sub"><?php echo $field['subtitle']; ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
	
						<?php if( empty($hide_buttons) ): ?>
							<div class="btns">
								<?php if(!empty($field['download_url'])): ?>
									<a href="<?php echo esc_url(add_query_arg('force_download', esc_url($field['download_url']))); ?>" class="btn download-track inline-exclude"><?php _e('Download track', 'ci_theme'); ?></a>
								<?php endif; ?>
								<?php if(!empty($field['buy_url'])): ?>
									<a href="<?php echo esc_url($field['buy_url']); ?>" class="btn buy-track"><?php _e('Buy track', 'ci_theme'); ?></a>
								<?php endif; ?>
								<?php if(!empty($field['lyrics'])): ?>
									<?php $lyrics_id = sanitize_html_class($field['title'].'-lyrics-'.$track_num); ?>
									<a data-rel="prettyPhoto" href="#<?php echo $lyrics_id; ?>" title="<?php echo sprintf(_x('%s Lyrics', 'song name lyrics', 'ci_theme'), $field['title']); ?>" class="btn lyrics-track"><?php _e('Lyrics', 'ci_theme'); ?></a>
									<div id="<?php echo $lyrics_id; ?>" class="track-lyrics-hold"><?php echo wpautop($field['lyrics']); ?></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
	
						<?php if( empty($hide_players) ): ?>
							<?php if((substr_left($field['play_url'], 25)=='http://api.soundcloud.com') or (substr_left($field['play_url'], 26)=='https://api.soundcloud.com')): ?>
								<a href="#track<?php echo $track_id; ?>" class="track-listen sc"><?php _e('Listen','ci_theme'); ?></a>
								<div id="track<?php echo $track_id; ?>" class="track-audio">
									<?php echo do_shortcode('[soundcloud width="100%" url="'.esc_url($field['play_url']).'" iframe="true" /]'); ?>
								</div>
							<?php else: ?>
								<a class="sm2_button" href="<?php echo esc_url($field['play_url']); ?>"><?php echo $field['title']; ?></a>
							<?php endif; ?>
						<?php endif; ?>
	
					</li>
	
					<?php
						if($limit > 0)
						{
							$outputted++;
							if($outputted >= $limit)
								break;
						}
					?>
				<?php endforeach; ?>
			</ul>
			<?php
		}
		
		$output = ob_get_clean();
	}
	else
	{
		$output = apply_filters('ci_tracklisting_shortcode_error_msg', __('Cannot show track listings from non-public, non-published posts.', 'ci_theme'));
	}

	return $output;
}
endif;


if( !function_exists('ci_track_shortcode') ):
function ci_track_shortcode($params, $content = '') {
	extract( shortcode_atts( array(
		'track_no' => '1',
		'title'	 => 'Track title',
		'subtitle' => 'Track subtitle',
		'type'	 => 'soundcloud',
		'buy_url'	 => '',
		'download_url' => ''
	), $params ) );

	STATIC $i = 0;
	$i++;
	$p = "";
	$b = "";
	$d = "";
	$s = "";
	$m = "";
	$t = "";


	if ($download_url != "") {
		$download_url = add_query_arg('force_download', $download_url);
		$d = '<a href="'. esc_url($download_url) .'" class="btn download-track inline-exclude">' . __('Download track','ci_theme') . '</a>';
	}

	if ($buy_url != "") {
		$b = '<a href="'. esc_url($buy_url) .'" class="btn buy-track">' . __('Buy track','ci_theme') . '</a>';
	}

	if ('soundcloud' == strtolower($type)) {
		$t = "custom_soundcloud";
		$p =	'<div class="btns">' . $d . $b . '</div><a href="#track' . $track_no . '" class="track-listen sc">' . __('Listen','ci_theme') . '</a>'.
				'<div id="track'. $track_no . '" class="track-audio">' .
					do_shortcode($content) .
				'</div>';
	}
	else {
		$t = "custom_player";
		$p =	'<div class="btns">' . $d . $b . '</div>';

		$p .= 	'<a class="sm2_button" href="'.do_shortcode($content).'">'.$title.'</a>';
	}

	if ($subtitle != "")
		$s = '<p class="pair-sub">' . $subtitle . '</b>';

	return
		'<li id="' . $t . $i . '" class="gradient track group ' . $t . $i . '">' .  
			'<span class="track-no">' . $track_no . '</span>' .
			'<div class="track-info title-pair">' .
				'<h4 class="pair-title">' . $title . '</h4>' .
				$s .
			'</div>' . $p .
		'</li>'; 
}
endif;
add_shortcode('track', 'ci_track_shortcode');

?>