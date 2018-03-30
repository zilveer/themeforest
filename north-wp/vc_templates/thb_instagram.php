<?php function thb_instagram( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_instagram', $atts );
  extract( $atts );
    
	switch($columns) {
		case 2:
			$col = 'medium-6';
			break;
		case 3:
			$col = 'medium-4';
			break;
		case 4:
			$col = 'medium-6 large-3';
			break;
		case 5:
			$col = 'thb-five';
			break;
		case 6:
			$col = 'medium-4 large-2';
			break;
	  }
 	$output = $out ='';
	$username = strtolower($username);
	ob_start();
	
	if (false === ($instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($username)))) {

		$remote = wp_remote_get('http://instagram.com/'.trim($username));
		
		if (is_wp_error($remote)) {
			return __('Unable to communicate with Instagram.', 'north');
		}

		if ( 200 != wp_remote_retrieve_response_code( $remote ) )
			return __('Instagram did not return a 200.', 'north');

		$shards = explode('window._sharedData = ', $remote['body']);
		$insta_json = explode(';</script>', $shards[1]);
		$insta_array = json_decode($insta_json[0], TRUE);

		if (!$insta_array)
			return new WP_Error('bad_json', __('Instagram has returned invalid data.', 'north'));

		$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
		
		$instagram = array();

		foreach ($images as $image) {
				$image['link'] = $image['code'];
				$image['display_src'] = $image['display_src'];

				$instagram[] = array(
					'link'          => $image['link'],
					'large'         => $image['display_src']
				);
		}

		$instagram = thb_encode( serialize( $instagram ) );
		set_transient('instagram-media-'.sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS*2));
	} else {
		$instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($username));
	}

	$instagram = unserialize( thb_decode( $instagram ) );
	
	$media_array = array_slice($instagram, 0, $number);
	?>
	<div class="row no-padding instagram-row"><?php
				foreach ($media_array as $item) {
					echo '<div class="small-12 '.$col.' columns cf"><figure style="background-image:url('. esc_url($item['large']) .')">';
					if ($link == 'true') {
						echo '<a href="https://instagram.com/p/'. $item['link'] .'" target="_blank"></a>';
					}
					echo '</figure></div>';
				}
				?>
	</div>
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	   
	return $out;
}
add_shortcode('thb_instagram', 'thb_instagram');
