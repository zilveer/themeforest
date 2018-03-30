<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

global $post_format;
global $post_meta;

switch($post_format) {

	// STANDARD & IMAGE
	case 'standard':
	case 'image':
		if(has_post_thumbnail()) {
			$meta = wp_get_attachment_metadata(get_post_thumbnail_id());
			echo '<div class="mpcth-hidden-thumb-meta" data-width="' . $meta['width'] . '" data-height="' . $meta['height'] . '" data-ratio="' . ($meta['height'] / $meta['width']) . '"></div>';

			the_post_thumbnail();
		}
	break;

	// STATUS - TWITTER
	case 'status':
		$post_id = '#post-'.$post->ID;
		?>
		<script>
			jQuery(document).ready(function($) {
				var $tweet = $("<?php echo $post_id; ?> .mpcth-post-thumbnail");

				$tweet.oembed("<?php echo ((isset($post_meta['tweet_url'][0])) ? $post_meta['tweet_url'][0] : ''); ?>" , { embedMethod: 'fill', afterEmbed: function() {

				}});

				var simpleCheck = setInterval(function() {
					if($tweet.children('iframe').length && $tweet.children('iframe').attr('height') != undefined) {
						clearInterval(simpleCheck);

						setTimeout(function() {
							$(window).trigger('isotopeResize');
							$('.mpcth-post-thumbnail').append('<span class="mpcth-corner-tl"></span><span class="mpcth-corner-tr"></span>');
						}, 200);
					}
				}, 50);
				setTimeout(function() {
					clearInterval(simpleCheck);
				}, 2000);
			});
		</script>
	<?php
	break;

	// LINK
	case 'link':
		echo '<h3 class="mpcth-post-title"><span class="mpcth-sc-icon-link"></span><a href="'.((isset($post_meta['link_url'][0])) ? $post_meta['link_url'][0] : '').'" target="_blank" title="Permalink to: '.((isset($post_meta['link_url'][0])) ? $post_meta['link_url'][0] : '').'">'.get_the_title().'</a></h3>';
	break;

	// QUOTE
	case 'quote':
		echo '<span class="mpcth-format-quote">'.((isset($post_meta['quote'][0])) ? $post_meta['quote'][0] : '').'</span>';
		if(isset($post_meta['quote_author'][0]) && $post_meta['quote_author'][0] != '')
			echo '<span class="mpcth-format-quote-author">'.$post_meta['quote_author'][0].'</span>';
	break;

	// GALLERY
	case 'gallery':
		$id_list = isset($post_meta['gallery_images_val'][0]) ? explode(',', $post_meta['gallery_images_val'][0]) : array();

		if(!empty($id_list[0])) {
			$meta = wp_get_attachment_metadata($id_list[0]);
			echo '<div class="mpcth-hidden-thumb-meta" data-width="' . $meta['width'] . '" data-height="' . $meta['height'] . '" data-ratio="' . ($meta['height'] / $meta['width']) . '"></div>';
		}

		$id_list = implode(',',$id_list);
		echo do_shortcode('[vc_gallery type="flexslider_fade" interval="5" onclick="" img_size="full" images="'.$id_list.'" custom_links_target="_self" width="1/1" el_position="first last"]');
	break;

	// AUDIO
	case 'audio':
		if(isset($post_meta['mp3'][0]) || isset($post_meta['ogg'][0])) {
			echo do_shortcode('[mejsaudio mp3="'.((isset($post_meta['mp3'][0])) ? $post_meta['mp3'][0] : '').'" ogg="'.((isset($post_meta['ogg'][0])) ? $post_meta['ogg'][0] : '').'" preload="true"]');
		}
	break;

	// VIDEO
	case 'video':
		if(isset($post_meta['embed_code'][0]) && $post_meta['embed_code'][0] == '') {
			echo '<div class="mpcth-hidden-thumb-meta" data-ratio="0.5625"></div>';

			$shortcode = '';

			$shortcode .= '[mejsvideo mp4="'.((isset($post_meta['m4v'][0])) ? $post_meta['m4v'][0] : '').'" ogg="'.((isset($post_meta['ogv'][0])) ? $post_meta['ogv'][0] : '').'"';

			if(isset($post_meta['video_width'][0]) && $post_meta['video_width'][0] != '')
				$shortcode.= ' width="'.$post_meta['video_width'][0].'"';
			else
				$shortcode.= ' width="100%"';

			if(isset($post_meta['video_height'][0]) && $post_meta['video_height'][0] != '')
				$shortcode.= ' height="'.$post_meta['video_height'][0].'"';
			else
				$shortcode.= ' height="100%"';

			$shortcode.= ' preload="true"]';

			echo do_shortcode($shortcode);
		} elseif(isset($post_meta['embed_code'][0])) {
			echo '<div class="mpcth-hidden-thumb-meta" data-ratio="0.6289473684210526"></div>';

			echo '<div class="mpcth-video-container">';
			echo str_replace('\"', '"', urldecode($post_meta['embed_code'][0]));
			echo '</div>';
		}
	break;
} ?>