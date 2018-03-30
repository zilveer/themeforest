<?php
	add_shortcode('social', 'social_handler');
	

	function social_handler($atts, $content=null, $code="") {
		/* Icon */
		$icon=$atts["icon"];
		$link=$atts["link"];

		switch ($icon) {
			case '62217':
				$name = __('Twitter', THEME_NAME);
				break;
			case '62220':
				$name = __('Facebook', THEME_NAME);
				break;
			case '62223':
				$name = __('Google+', THEME_NAME);
				break;
			case '62226':
				$name = __('Pinterest', THEME_NAME);
				break;
			case '62229':
				$name = __('Tumbrl', THEME_NAME);
				break;
			case '62211':
				$name = __('Flickr', THEME_NAME);
				break;
			case '62214':
				$name = __('Vimeo', THEME_NAME);
				break;
			case '62232':
				$name = __('LinkedIn', THEME_NAME);
				break;
			case '62235':
				$name = __('Dribbble', THEME_NAME);
				break;
			case '62238':
				$name = __('StumbleUpon', THEME_NAME);
				break;
			case '62241':
				$name = __('LastFM', THEME_NAME);
				break;
			case '62244':
				$name = __('Rdio', THEME_NAME);
				break;
			case '62247':
				$name = __('Spotify', THEME_NAME);
				break;
			case '62253':
				$name = __('Instagram', THEME_NAME);
				break;
			case '62280':
				$name = __('Soundcloud', THEME_NAME);
				break;
			case '62286':
				$name = __('Behance', THEME_NAME);
				break;
			
			default:
				$name = false;
				break;
		}
		$content = '<a href="'.$link.'" target="_blank" class="social-icon">
						<span class="icon-text">&#'.$icon.';</span>
						<b>'.$name.'</b>
						<i>'.__("Follow us", THEME_NAME).'</i>
					</a>';
		return $content;
	}
	
?>