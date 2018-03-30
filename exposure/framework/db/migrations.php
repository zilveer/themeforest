<?php

if( false ) {
	/**
	 * Function to be run when migrating to a WordPress version after 3.6.
	 *
	 * - Post format adaptation: image, link, video, audio, quote
	 *
	 * @return void
	 */
	function thb_wp_migration_36() {
		$posts = get_posts(array(
			'posts_per_page' => -1,
			'post_status' => array('image', 'link', 'audio', 'video', 'quote')
		));

		$posts = (array) $posts;

		if( count($posts) > 0 ) {
			foreach( $posts as $post ) {
				$format = get_post_format($post->ID);

				switch( $format ) {
					case 'image':
						$featured_image = thb_get_featured_image($post->ID);

						if( ! empty($featured_image) ) {
							update_post_meta($post->ID, '_format_image', $featured_image);
							// delete_post_meta($post->ID, '_thumbnail_id');
						}

						break;
					case 'link':
						$link_url = thb_get_post_meta($post->ID, 'link_url');

						if( ! empty($link_url) ) {
							update_post_meta($post->ID, '_format_link_url', $link_url);
							// delete_post_meta($post->ID, THB_META_KEY . 'link_url');
						}

						break;
					case 'video':
					case 'audio':
						$url = thb_get_post_meta($post->ID, $format . '_url');

						if( !empty($url) ) {
							update_post_meta($post->ID, '_format_' . $format . '_embed', $url);
							// delete_post_meta($post->ID, THB_META_KEY . $format . '_url');
						}

						break;
					case 'quote':
						$quote_text = thb_get_post_meta($post->ID, 'quote');
						$quote_url = thb_get_post_meta($post->ID, 'quote_url');
						$quote_url = str_replace('http://', '', $quote_url);
						$quote_author = thb_get_post_meta($post->ID, 'quote_author');

						wp_update_post(array(
							'ID' => $post->ID,
							'post_content' => $quote_text
						));

						update_post_meta($post->ID, '_format_quote_source_url', $quote_url);
						update_post_meta($post->ID, '_format_quote_source_name', $quote_author);

						// delete_post_meta($post->ID, THB_META_KEY . 'quote');
						// delete_post_meta($post->ID, THB_META_KEY . 'quote_url');
						// delete_post_meta($post->ID, THB_META_KEY . 'quote_author');

						break;
				}

				wp_save_post_revision($post->ID);
			}
		}
	}
}