<?php
/*
Plugin Name: WP Instagram Widget
Plugin URI: https://github.com/cftp/wp-instagram-widget
Description: A WordPress widget for showing your latest Instagram photos
Version: 1.4.1
Author: Scott Evans (Code For The People)
Author URI: http://codeforthepeople.com
Text Domain: wpiw
Domain Path: /assets/languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This comment is added for compatibility with the null framework https://github.com/scottsweb/null
Widget Name: Instagram Widget

Copyright © 2013 Code for the People ltd

                _____________
               /      ____   \
         _____/       \   \   \
        /\    \        \___\   \
       /  \    \                \
      /   /    /          _______\
     /   /    /          \       /
    /   /    /            \     /
    \   \    \ _____    ___\   /
     \   \    /\    \  /       \
      \   \  /  \____\/    _____\
       \   \/        /    /    / \
        \           /____/    /___\
         \                        /
          \______________________/


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

class null_instagram_widget extends WP_Widget {

	function null_instagram_widget() {
		$widget_ops = array('classname' => 'null-instagram-feed', 'description' => __('Displays your latest Instagram photos', ET_DOMAIN) );
		parent::__construct('null-instagram-feed', __('Instagram', ET_DOMAIN), $widget_ops);
	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$username = empty($instance['username']) ? '' : $instance['username'];
		$limit = empty($instance['number']) ? 9 : $instance['number'];
		$size = empty($instance['size']) ? 'thumbnail' : $instance['size'];
		$target = empty($instance['target']) ? '_self' : $instance['target'];
		$link = empty($instance['link']) ? '' : $instance['link'];
		$slider = empty($instance['slider']) ? false : true;
		$spacing = empty($instance['spacing']) ? false : true;

		echo $before_widget;
		if(!empty($title)) { echo $before_title . $title . $after_title; };

		do_action( 'wpiw_before_widget', $instance );

		if ($username != '') {

			$media_array = $this->scrape_instagram($username, $limit);

			if ( is_wp_error($media_array) ) {

				echo $media_array->get_error_message();

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

				// filters for custom classes
				$liclass = esc_attr( apply_filters( 'wpiw_item_class', '' ) );
				$aclass = esc_attr( apply_filters( 'wpiw_a_class', '' ) );
				$imgclass = esc_attr( apply_filters( 'wpiw_img_class', '' ) );

				?><ul class="instagram-pics instagram-size-<?php echo esc_attr( $instance['size'] ); ?> <?php if($spacing) echo 'instagram-no-space'; ?> <?php if($slider) echo 'instagram-slider'; ?>"><?php
				foreach ( $media_array as $item ) {
					// copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly
					if ( locate_template( 'parts/wp-instagram-widget.php' ) != '' ) {
						include( locate_template( 'parts/wp-instagram-widget.php' ) );
					} else {
						echo '<li class="'. $liclass .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. $aclass .'"><img src="'. esc_url( $item['thumbnail'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. $imgclass .'"/></a></li>';
					}
				}
				?></ul><?php

				if($slider) {
					$large_items = 6;
					switch ($instance['size']) {
						case 'thumbnail':
							$large_items = 8;
						break;
						case 'small':
							$large_items = 6;
						break;
						case 'large':
							$large_items = 4;
						break;
					}
			        $items = '[[0, 2], [479,2], [619,3], [768,' . ($large_items - 2) . '],  [1200, ' . ($large_items - 1) . '], [1600, ' . $large_items . ']]';
					?>
			            <script type="text/javascript">
			                jQuery(".instagram-slider").owlCarousel({
			                    items:4, 
			                    lazyLoad : false,
			                    navigation: true,
			                    navigationText:false,
			                    rewindNav: false,
			                    itemsCustom: <?php echo $items; ?>
			                });
			            </script>
					<?php
				}
			}
		}

		if ($link != '') {
			?><p class="clear"><a href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo $link; ?></a></p><?php
		}

		do_action( 'wpiw_after_widget', $instance );

		echo $after_widget;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Instagram', ET_DOMAIN), 'username' => '', 'link' => __('Follow Us', ET_DOMAIN), 'number' => 9, 'size' => 'thumbnail', 'target' => '_self') );
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = absint($instance['number']);
		$size = esc_attr($instance['size']);
		$target = esc_attr($instance['target']);
		$link = esc_attr($instance['link']);
		$slider = esc_attr($instance['slider']);
		$spacing = esc_attr($instance['spacing']);

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', ET_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', ET_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos', ET_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Photo size', ET_DOMAIN); ?>:</label>
			<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat">
				<option value="thumbnail" <?php selected('thumbnail', $size) ?>><?php _e('Thumbnail', ET_DOMAIN); ?></option>
				<option value="small" <?php selected('small', $size) ?>><?php _e('Small', ET_DOMAIN); ?></option>
				<option value="large" <?php selected('large', $size) ?>><?php _e('Large', ET_DOMAIN); ?></option>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Open links in', ET_DOMAIN); ?>:</label>
			<select id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" class="widefat">
				<option value="_self" <?php selected('_self', $target) ?>><?php _e('Current window (_self)', ET_DOMAIN); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php _e('New window (_blank)', ET_DOMAIN); ?></option>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link text', ET_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
		<p>
			<input type="checkbox" <?php checked( true, $slider, true); ?> id="<?php echo $this->get_field_id('slider'); ?>" name="<?php echo $this->get_field_name('slider'); ?>">
			<label for="<?php echo $this->get_field_id('slider'); ?>"><?php _e('Carousel', ET_DOMAIN); ?></label>
		</p>
		<p>
			<input type="checkbox" <?php checked( true, $spacing, true); ?> id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>">
			<label for="<?php echo $this->get_field_id('spacing'); ?>"><?php _e('Without spacing', ET_DOMAIN); ?></label>
		</p>
		<?php

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = trim(strip_tags($new_instance['username']));
		$instance['number'] = !absint($new_instance['number']) ? 9 : $new_instance['number'];
		$instance['size'] = (($new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small') ? $new_instance['size'] : 'thumbnail');
		$instance['target'] = (($new_instance['target'] == '_self' || $new_instance['target'] == '_blank') ? $new_instance['target'] : '_self');
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['slider'] = ($new_instance['slider'] != '') ? true : false;
		$instance['spacing'] = ($new_instance['spacing'] != '') ? true : false;
		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {
		$username = strtolower( $username );
		if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {
			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );
			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'wpiw' ) );
			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'wpiw' ) );
			$shards = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );
			if ( !$insta_array )
				return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_json_2', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			}
			if ( !is_array( $images ) )
				return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			$instagram = array();
			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {
						if ( $image['user']['username'] == $username ) {
							$image['link']						  = preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );
							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  	=> $image['link'],
								'time'		  	=> $image['created_time'],
								'comments'	  	=> $image['comments']['count'],
								'likes'		 	=> $image['likes']['count'],
								'thumbnail'	 	=> $image['images']['thumbnail'],
								'large'		 	=> $image['images']['standard_resolution'],
								'small'		 	=> $image['images']['low_resolution'],
								'type'		  	=> $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {
						$image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );
						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}
						$instagram[] = array(
							'description'   => __( 'Instagram Image', 'wpiw' ),
							'link'		  	=> '//instagram.com/p/' . $image['code'],
							'time'		  	=> $image['date'],
							'comments'	  	=> $image['comments']['count'],
							'likes'		 	=> $image['likes']['count'],
							'thumbnail'	 	=> $image['display_src'],
							'type'		  	=> $type
						);
					}
				break;
			}
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}
		if ( ! empty( $instagram ) ) {
			$instagram = unserialize( base64_decode( $instagram ) );
			return array_slice( $instagram, 0, $slice );
		} else {
			return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'wpiw' ) );
		}
	}

	function images_only($media_item) {

		if ($media_item['type'] == 'image')
			return true;

		return false;
	}
}
