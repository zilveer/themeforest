<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'WBC_HelperFunctions' ) ) {
	class WBC_HelperFunctions {
		/**
		 * WBC_Core
		 *
		 * @var object
		 */
		static public $_parent;



		public static $_length = 55;

		/**
		 * Adds shortcodes to array, so later can be
		 * filtered and have the stray <p> and <br>'s
		 * removed from.
		 *
		 * @param string  $shortcode shortcode to add to array
		 */
		public static function shortcode_array( $shortcode = '' ) {

			if ( empty( $shortcode ) ) return;

			if ( !in_array( $shortcode, self::$_parent->wbc_shortcodes ) ) {
				self::$_parent->wbc_shortcodes[] = $shortcode;
			}

		}

		/**
		 * Applies shortcode wpautop fix to added shortcodes,
		 * from within the shortcode director
		 *
		 * @param string  $content post content filter
		 * @return string          with auto p,br removed around shortcodes
		 */
		public static function wbc_shortcode_fix( $content = '' ) {//TODO

			// array of custom shortcodes requiring the fix
			$block = join( "|", self::$_parent->wbc_shortcodes );
			// opening tag
			$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
			// closing tag
			$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );
			return $rep;

		}


		/**
		 * Applies shortcode wpautop fix to added shortcodes,
		 * from within the shortcode director
		 *
		 * @param string  $content post content filter
		 * @return string          with auto p,br removed around shortcodes
		 */
		public static function wbc_inline_shortcode_fix( $content = '' ) {//TODO
			$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
			return do_shortcode( shortcode_unautop( $content ) );

		}



		public static function get_meta( $post_id = '' ) {

			if ( empty( $post_id ) ) return;

			$post_meta = get_post_meta( $post_id );
			$post_meta2 = array();
			if ( ! empty( $post_meta ) ) {
				foreach ( $post_meta as $key => $value ) {
					if ( count( $value ) == 1 ) {
						$post_meta2[ $key ] = maybe_unserialize( $value[0] );
					} else {
						$post_meta2[ $key ] = array_map( 'maybe_unserialize', $value );
					}

				}
			}
			return $post_meta2;
		}

		/**
		 * Sets new excerpt length
		 *
		 * @param int     $length excerpt length
		 *
		 * @return int
		 */
		public static function new_length( $length ) {
			return self::$_length;
		}

		/**
		 * Gets post excerpt, build tries to build
		 * one from post if no excerpt found.
		 *
		 * @param integer $length length of string/excerpt
		 * @return string          post excerpt
		 */
		public static function get_excerpt( $length = 55 ) {
			global $post;

			if ( $length == 0 ) return;

			self::$_length = $length;

			add_filter( 'excerpt_length', 'WBC_HelperFunctions::new_length', 999 );

			if ( has_excerpt() ) {

				return '<p>'.trim( substr( get_the_excerpt(), 0, $length ) ).'...</p>';

			}else {

				if ( !get_the_excerpt() ) {

					$content = ( isset( $post->post_content ) ) ? $post->post_content  : '' ;// apply_filters('the_content', $content );

					$content = preg_replace( "/(<p>)?\[(wbc_portfolio|wbc_blog)(\s[^\]]+)?\](<\/p>|<br \/>)?/", " ", $content );

					preg_match_all( '#<\s*p[^>]*>(.*?)<\s*/\s*p>#ui', $content, $matches );

					if ( isset( $matches[0][0] ) ) {
						$matched = $matches[0][0];
						if ( isset( $matches[0][1] ) ) {
							$matched = $matches[0][0].$matches[0][1];
						}
						$text = strip_tags( $matched );
						return '<p>'.trim( substr( $text, 0, $length ) ).'...</p>';

					}else {

						if ( isset( $post->post_content ) && !empty( $post->post_content ) ) {

							$text = preg_replace( '#\[[^\]]+\]#ui', '', $post->post_content );
							$text = strip_tags( $text );

							if ( strlen( $text ) > 0 ) {
								return '<p>'.trim( substr( $text, 0, $length ) ).'...</p>';
							}
						}
					}

				}
				return '<p>'.trim( substr( get_the_excerpt(), 0, $length ) ).'...</p>';
			}
		}


		public static function generate_css( $cssArray = array(), $echo = false ) {
			if ( !is_array( $cssArray ) || empty( $cssArray ) ) {
				return;
			}

			$css = '';

			$pixelArray = array(
				'border-radius',
				'border-width',
				'padding',
				'padding-top',
				'padding-bottom',
				'padding-left',
				'padding-right',
				'margin',
				'margin-top',
				'margin-bottom',
				'margin-left',
				'margin-right',
				'font-size',
				'width',
				'height',
				'line-height',
				'letter-spacing',
				'max-width'
			);

			$pixelArray = join( "|" , $pixelArray );

			foreach ( $cssArray as $property => $value ) {

				if ( !empty( $value ) || is_numeric( $value ) ) {

					if ( preg_match( '/('.$pixelArray.')/', $property ) ) {
						$value = ( preg_match( '/(px|em|\%|pt|cm|auto)$/', $value ) ? $value : $value . 'px' );
					}

					$css .= $property.':'.$value.';';
				}
			}

			if ( !empty( $css ) ) {
				$css = 'style="'.esc_attr( $css ).'"';
				return $css;
			}

			return;
		}

	}
}


if ( !function_exists( 'wbc_inline_shortcode_fix' ) ) {

	function wbc_inline_shortcode_fix( $content ) {

		return WBC_HelperFunctions::wbc_inline_shortcode_fix( $content );

	}
}

/**
 * Get's post meta, return array.
 *
 * Must pass post id.
 */
if ( !function_exists( 'wbc_get_meta' ) ) {

	function wbc_get_meta( $post_id = '' ) {

		return WBC_HelperFunctions::get_meta( $post_id );

	}
}

/**
 * Excerpt function for pages that don't have
 * excerpts and are built with shortcodes.
 */
if ( !function_exists( 'wbc_get_excerpt' ) ) {

	function wbc_get_excerpt( $length = 55 ) {

		return WBC_HelperFunctions::get_excerpt( $length );

	}
}

/**
 * Adds shortcode to p/br fix for plugin shortcodes only.
 */
if ( !function_exists( 'wbc_shortcode_array' ) ) {

	function wbc_shortcode_array( $shortcode = '' ) {

		WBC_HelperFunctions::shortcode_array( $shortcode );

	}
}

/**
 * Generates CSS styles
 */
if ( !function_exists( 'wbc_generate_css' ) ) {

	function wbc_generate_css( $cssArray = array(), $echo = false ) {

		return WBC_HelperFunctions::generate_css( $cssArray , $echo );

	}
}

/**
 * Visual Composer: checks if editing in frontend editor
 *
 * @return  bool true/false
 */
if ( !function_exists( 'wbc_check_inline' ) ) {

	function wbc_check_inline() {

		if ( function_exists( 'vc_is_inline' ) && vc_is_inline() === true ) {
			return true;
		}

		return false;

	}
}

/**
 * Creates shortcodes from array
 *
 * @param array   $sc_array requires $sc_array['base'] to be set
 * @return string           returns shortcode ie [shortcode param="value"]
 */
if ( !function_exists( 'wbc_array_to_shortcode' ) ) {
	function wbc_array_to_shortcode( $sc_array = array(), $content = '' ) {

		if ( empty( $sc_array['base'] ) ) {
			return;
		}else {
			$shortcode = '['.$sc_array['base'];
		}
		foreach ( $sc_array as $param => $value ) {
			if ( isset( $value ) && !empty( $value ) && $param !='base' ) {
				$shortcode .= ' '.$param.'="'.$value.'"';
			}
		}

		$shortcode .=']';

		if ( !empty( $content ) ) {
			$shortcode .= $content; //do_shortcode()?
			$shortcode .= '[/'.$sc_array['base'].']';
		}

		return $shortcode;
	}
}


/**
 *  Adds css selectors to options.
 */
if ( !function_exists( 'wbc_arrays_to_options' ) ) {
	function wbc_arrays_to_options( $new_array = array() , $array = array() ) {
		if ( is_array( $array ) ) {
			foreach ( $new_array as $key => $value ) {
				if ( array_key_exists( $key, $array ) && !empty( $array[$key] ) ) {
					$array[$key] .= ','.$value;
				}else {
					$array[$key] = $value;
				}
			}
		}

		return $array;
	}
}


/**
 * Color Field using pipe | character
 */
if ( !function_exists( 'wbc_pipe_to_color' ) ) {
	function wbc_pipe_to_color( $string = '', $color = '' ) {

		if( empty( $string ) ) return false;

		$wbc_color_before = ( !empty( $color ) ) ? '[wbc_color color="'.$color.'"]' : '[wbc_color]';
		$wbc_color_after = '[/wbc_color]';


		if ( preg_match_all( "/\|([^\|]+)\|/", $string, $matches, PREG_SET_ORDER ) !== false ) {

			foreach ( $matches as $key => $value ) {
				if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
					$string = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $string );
				}
			}
		}

		return do_shortcode( $string );
	}
}

/**
 * From VC to prevent error undefined function
 * when plugin not active
 *
 * @param string  $value page in URL multi string
 * @return array
 */

if ( !function_exists( 'wbc_build_link' ) ) {
	function wbc_build_link( $value ) {
		return wbc_parse_multi_attribute( $value, array( 'url' => '', 'title' => '', 'target' => '' ) );
	}
}
if ( !function_exists( 'wbc_parse_multi_attribute' ) ) {
	function wbc_parse_multi_attribute( $value, $default = array() ) {
		$result = $default;
		$params_pairs = explode( '|', $value );
		foreach ( $params_pairs as $pair ) {
			$param = preg_split( '/\:/', $pair );
			if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
				$result[$param[0]] = rawurldecode( $param[1] );
			}
		}
		return $result;
	}
}

if ( !function_exists( 'wbc_fontawesome_array' ) ) {

	function wbc_fontawesome_array( $sort = true, $w_name = false, $no_fa = false ) {

		//FontAwesome Array
		$icons = array("fa fa-glass",
				"fa fa-music",
				"fa fa-search",
				"fa fa-envelope-o",
				"fa fa-heart",
				"fa fa-star",
				"fa fa-star-o",
				"fa fa-user",
				"fa fa-film",
				"fa fa-th-large",
				"fa fa-th",
				"fa fa-th-list",
				"fa fa-check",
				"fa fa-times",
				"fa fa-search-plus",
				"fa fa-search-minus",
				"fa fa-power-off",
				"fa fa-signal",
				"fa fa-cog",
				"fa fa-trash-o",
				"fa fa-home",
				"fa fa-file-o",
				"fa fa-clock-o",
				"fa fa-road",
				"fa fa-download",
				"fa fa-arrow-circle-o-down",
				"fa fa-arrow-circle-o-up",
				"fa fa-inbox",
				"fa fa-play-circle-o",
				"fa fa-repeat",
				"fa fa-refresh",
				"fa fa-list-alt",
				"fa fa-lock",
				"fa fa-flag",
				"fa fa-headphones",
				"fa fa-volume-off",
				"fa fa-volume-down",
				"fa fa-volume-up",
				"fa fa-qrcode",
				"fa fa-barcode",
				"fa fa-tag",
				"fa fa-tags",
				"fa fa-book",
				"fa fa-bookmark",
				"fa fa-print",
				"fa fa-camera",
				"fa fa-font",
				"fa fa-bold",
				"fa fa-italic",
				"fa fa-text-height",
				"fa fa-text-width",
				"fa fa-align-left",
				"fa fa-align-center",
				"fa fa-align-right",
				"fa fa-align-justify",
				"fa fa-list",
				"fa fa-outdent",
				"fa fa-indent",
				"fa fa-video-camera",
				"fa fa-picture-o",
				"fa fa-pencil",
				"fa fa-map-marker",
				"fa fa-adjust",
				"fa fa-tint",
				"fa fa-pencil-square-o",
				"fa fa-share-square-o",
				"fa fa-check-square-o",
				"fa fa-arrows",
				"fa fa-step-backward",
				"fa fa-fast-backward",
				"fa fa-backward",
				"fa fa-play",
				"fa fa-pause",
				"fa fa-stop",
				"fa fa-forward",
				"fa fa-fast-forward",
				"fa fa-step-forward",
				"fa fa-eject",
				"fa fa-chevron-left",
				"fa fa-chevron-right",
				"fa fa-plus-circle",
				"fa fa-minus-circle",
				"fa fa-times-circle",
				"fa fa-check-circle",
				"fa fa-question-circle",
				"fa fa-info-circle",
				"fa fa-crosshairs",
				"fa fa-times-circle-o",
				"fa fa-check-circle-o",
				"fa fa-ban",
				"fa fa-arrow-left",
				"fa fa-arrow-right",
				"fa fa-arrow-up",
				"fa fa-arrow-down",
				"fa fa-share",
				"fa fa-expand",
				"fa fa-compress",
				"fa fa-plus",
				"fa fa-minus",
				"fa fa-asterisk",
				"fa fa-exclamation-circle",
				"fa fa-gift",
				"fa fa-leaf",
				"fa fa-fire",
				"fa fa-eye",
				"fa fa-eye-slash",
				"fa fa-exclamation-triangle",
				"fa fa-plane",
				"fa fa-calendar",
				"fa fa-random",
				"fa fa-comment",
				"fa fa-magnet",
				"fa fa-chevron-up",
				"fa fa-chevron-down",
				"fa fa-retweet",
				"fa fa-shopping-cart",
				"fa fa-folder",
				"fa fa-folder-open",
				"fa fa-arrows-v",
				"fa fa-arrows-h",
				"fa fa-bar-chart",
				"fa fa-twitter-square",
				"fa fa-facebook-square",
				"fa fa-camera-retro",
				"fa fa-key",
				"fa fa-cogs",
				"fa fa-comments",
				"fa fa-thumbs-o-up",
				"fa fa-thumbs-o-down",
				"fa fa-star-half",
				"fa fa-heart-o",
				"fa fa-sign-out",
				"fa fa-linkedin-square",
				"fa fa-thumb-tack",
				"fa fa-external-link",
				"fa fa-sign-in",
				"fa fa-trophy",
				"fa fa-github-square",
				"fa fa-upload",
				"fa fa-lemon-o",
				"fa fa-phone",
				"fa fa-square-o",
				"fa fa-bookmark-o",
				"fa fa-phone-square",
				"fa fa-twitter",
				"fa fa-facebook",
				"fa fa-github",
				"fa fa-unlock",
				"fa fa-credit-card",
				"fa fa-rss",
				"fa fa-hdd-o",
				"fa fa-bullhorn",
				"fa fa-bell",
				"fa fa-certificate",
				"fa fa-hand-o-right",
				"fa fa-hand-o-left",
				"fa fa-hand-o-up",
				"fa fa-hand-o-down",
				"fa fa-arrow-circle-left",
				"fa fa-arrow-circle-right",
				"fa fa-arrow-circle-up",
				"fa fa-arrow-circle-down",
				"fa fa-globe",
				"fa fa-wrench",
				"fa fa-tasks",
				"fa fa-filter",
				"fa fa-briefcase",
				"fa fa-arrows-alt",
				"fa fa-users",
				"fa fa-link",
				"fa fa-cloud",
				"fa fa-flask",
				"fa fa-scissors",
				"fa fa-files-o",
				"fa fa-paperclip",
				"fa fa-floppy-o",
				"fa fa-square",
				"fa fa-bars",
				"fa fa-list-ul",
				"fa fa-list-ol",
				"fa fa-strikethrough",
				"fa fa-underline",
				"fa fa-table",
				"fa fa-magic",
				"fa fa-truck",
				"fa fa-pinterest",
				"fa fa-pinterest-square",
				"fa fa-google-plus-square",
				"fa fa-google-plus",
				"fa fa-money",
				"fa fa-caret-down",
				"fa fa-caret-up",
				"fa fa-caret-left",
				"fa fa-caret-right",
				"fa fa-columns",
				"fa fa-sort",
				"fa fa-sort-desc",
				"fa fa-sort-asc",
				"fa fa-envelope",
				"fa fa-linkedin",
				"fa fa-undo",
				"fa fa-gavel",
				"fa fa-tachometer",
				"fa fa-comment-o",
				"fa fa-comments-o",
				"fa fa-bolt",
				"fa fa-sitemap",
				"fa fa-umbrella",
				"fa fa-clipboard",
				"fa fa-lightbulb-o",
				"fa fa-exchange",
				"fa fa-cloud-download",
				"fa fa-cloud-upload",
				"fa fa-user-md",
				"fa fa-stethoscope",
				"fa fa-suitcase",
				"fa fa-bell-o",
				"fa fa-coffee",
				"fa fa-cutlery",
				"fa fa-file-text-o",
				"fa fa-building-o",
				"fa fa-hospital-o",
				"fa fa-ambulance",
				"fa fa-medkit",
				"fa fa-fighter-jet",
				"fa fa-beer",
				"fa fa-h-square",
				"fa fa-plus-square",
				"fa fa-angle-double-left",
				"fa fa-angle-double-right",
				"fa fa-angle-double-up",
				"fa fa-angle-double-down",
				"fa fa-angle-left",
				"fa fa-angle-right",
				"fa fa-angle-up",
				"fa fa-angle-down",
				"fa fa-desktop",
				"fa fa-laptop",
				"fa fa-tablet",
				"fa fa-mobile",
				"fa fa-circle-o",
				"fa fa-quote-left",
				"fa fa-quote-right",
				"fa fa-spinner",
				"fa fa-circle",
				"fa fa-reply",
				"fa fa-github-alt",
				"fa fa-folder-o",
				"fa fa-folder-open-o",
				"fa fa-smile-o",
				"fa fa-frown-o",
				"fa fa-meh-o",
				"fa fa-gamepad",
				"fa fa-keyboard-o",
				"fa fa-flag-o",
				"fa fa-flag-checkered",
				"fa fa-terminal",
				"fa fa-code",
				"fa fa-reply-all",
				"fa fa-star-half-o",
				"fa fa-location-arrow",
				"fa fa-crop",
				"fa fa-code-fork",
				"fa fa-chain-broken",
				"fa fa-question",
				"fa fa-info",
				"fa fa-exclamation",
				"fa fa-superscript",
				"fa fa-subscript",
				"fa fa-eraser",
				"fa fa-puzzle-piece",
				"fa fa-microphone",
				"fa fa-microphone-slash",
				"fa fa-shield",
				"fa fa-calendar-o",
				"fa fa-fire-extinguisher",
				"fa fa-rocket",
				"fa fa-maxcdn",
				"fa fa-chevron-circle-left",
				"fa fa-chevron-circle-right",
				"fa fa-chevron-circle-up",
				"fa fa-chevron-circle-down",
				"fa fa-html5",
				"fa fa-css3",
				"fa fa-anchor",
				"fa fa-unlock-alt",
				"fa fa-bullseye",
				"fa fa-ellipsis-h",
				"fa fa-ellipsis-v",
				"fa fa-rss-square",
				"fa fa-play-circle",
				"fa fa-ticket",
				"fa fa-minus-square",
				"fa fa-minus-square-o",
				"fa fa-level-up",
				"fa fa-level-down",
				"fa fa-check-square",
				"fa fa-pencil-square",
				"fa fa-external-link-square",
				"fa fa-share-square",
				"fa fa-compass",
				"fa fa-caret-square-o-down",
				"fa fa-caret-square-o-up",
				"fa fa-caret-square-o-right",
				"fa fa-eur",
				"fa fa-gbp",
				"fa fa-usd",
				"fa fa-inr",
				"fa fa-jpy",
				"fa fa-rub",
				"fa fa-krw",
				"fa fa-btc",
				"fa fa-file",
				"fa fa-file-text",
				"fa fa-sort-alpha-asc",
				"fa fa-sort-alpha-desc",
				"fa fa-sort-amount-asc",
				"fa fa-sort-amount-desc",
				"fa fa-sort-numeric-asc",
				"fa fa-sort-numeric-desc",
				"fa fa-thumbs-up",
				"fa fa-thumbs-down",
				"fa fa-youtube-square",
				"fa fa-youtube",
				"fa fa-xing",
				"fa fa-xing-square",
				"fa fa-youtube-play",
				"fa fa-dropbox",
				"fa fa-stack-overflow",
				"fa fa-instagram",
				"fa fa-flickr",
				"fa fa-adn",
				"fa fa-bitbucket",
				"fa fa-bitbucket-square",
				"fa fa-tumblr",
				"fa fa-tumblr-square",
				"fa fa-long-arrow-down",
				"fa fa-long-arrow-up",
				"fa fa-long-arrow-left",
				"fa fa-long-arrow-right",
				"fa fa-apple",
				"fa fa-windows",
				"fa fa-android",
				"fa fa-linux",
				"fa fa-dribbble",
				"fa fa-skype",
				"fa fa-foursquare",
				"fa fa-trello",
				"fa fa-female",
				"fa fa-male",
				"fa fa-gratipay",
				"fa fa-sun-o",
				"fa fa-moon-o",
				"fa fa-archive",
				"fa fa-bug",
				"fa fa-vk",
				"fa fa-weibo",
				"fa fa-renren",
				"fa fa-pagelines",
				"fa fa-stack-exchange",
				"fa fa-arrow-circle-o-right",
				"fa fa-arrow-circle-o-left",
				"fa fa-caret-square-o-left",
				"fa fa-dot-circle-o",
				"fa fa-wheelchair",
				"fa fa-vimeo-square",
				"fa fa-try",
				"fa fa-plus-square-o",
				"fa fa-space-shuttle",
				"fa fa-slack",
				"fa fa-envelope-square",
				"fa fa-wordpress",
				"fa fa-openid",
				"fa fa-university",
				"fa fa-graduation-cap",
				"fa fa-yahoo",
				"fa fa-google",
				"fa fa-reddit",
				"fa fa-reddit-square",
				"fa fa-stumbleupon-circle",
				"fa fa-stumbleupon",
				"fa fa-delicious",
				"fa fa-digg",
				"fa fa-pied-piper",
				"fa fa-pied-piper-alt",
				"fa fa-drupal",
				"fa fa-joomla",
				"fa fa-language",
				"fa fa-fax",
				"fa fa-building",
				"fa fa-child",
				"fa fa-paw",
				"fa fa-spoon",
				"fa fa-cube",
				"fa fa-cubes",
				"fa fa-behance",
				"fa fa-behance-square",
				"fa fa-steam",
				"fa fa-steam-square",
				"fa fa-recycle",
				"fa fa-car",
				"fa fa-taxi",
				"fa fa-tree",
				"fa fa-spotify",
				"fa fa-deviantart",
				"fa fa-soundcloud",
				"fa fa-database",
				"fa fa-file-pdf-o",
				"fa fa-file-word-o",
				"fa fa-file-excel-o",
				"fa fa-file-powerpoint-o",
				"fa fa-file-image-o",
				"fa fa-file-archive-o",
				"fa fa-file-audio-o",
				"fa fa-file-video-o",
				"fa fa-file-code-o",
				"fa fa-vine",
				"fa fa-codepen",
				"fa fa-jsfiddle",
				"fa fa-life-ring",
				"fa fa-circle-o-notch",
				"fa fa-rebel",
				"fa fa-empire",
				"fa fa-git-square",
				"fa fa-git",
				"fa fa-hacker-news",
				"fa fa-tencent-weibo",
				"fa fa-qq",
				"fa fa-weixin",
				"fa fa-paper-plane",
				"fa fa-paper-plane-o",
				"fa fa-history",
				"fa fa-circle-thin",
				"fa fa-header",
				"fa fa-paragraph",
				"fa fa-sliders",
				"fa fa-share-alt",
				"fa fa-share-alt-square",
				"fa fa-bomb",
				"fa fa-futbol-o",
				"fa fa-tty",
				"fa fa-binoculars",
				"fa fa-plug",
				"fa fa-slideshare",
				"fa fa-twitch",
				"fa fa-yelp",
				"fa fa-newspaper-o",
				"fa fa-wifi",
				"fa fa-calculator",
				"fa fa-paypal",
				"fa fa-google-wallet",
				"fa fa-cc-visa",
				"fa fa-cc-mastercard",
				"fa fa-cc-discover",
				"fa fa-cc-amex",
				"fa fa-cc-paypal",
				"fa fa-cc-stripe",
				"fa fa-bell-slash",
				"fa fa-bell-slash-o",
				"fa fa-trash",
				"fa fa-copyright",
				"fa fa-at",
				"fa fa-eyedropper",
				"fa fa-paint-brush",
				"fa fa-birthday-cake",
				"fa fa-area-chart",
				"fa fa-pie-chart",
				"fa fa-line-chart",
				"fa fa-lastfm",
				"fa fa-lastfm-square",
				"fa fa-toggle-off",
				"fa fa-toggle-on",
				"fa fa-bicycle",
				"fa fa-bus",
				"fa fa-ioxhost",
				"fa fa-angellist",
				"fa fa-cc",
				"fa fa-ils",
				"fa fa-meanpath",
				"fa fa-buysellads",
				"fa fa-connectdevelop",
				"fa fa-dashcube",
				"fa fa-forumbee",
				"fa fa-leanpub",
				"fa fa-sellsy",
				"fa fa-shirtsinbulk",
				"fa fa-simplybuilt",
				"fa fa-skyatlas",
				"fa fa-cart-plus",
				"fa fa-cart-arrow-down",
				"fa fa-diamond",
				"fa fa-ship",
				"fa fa-user-secret",
				"fa fa-motorcycle",
				"fa fa-street-view",
				"fa fa-heartbeat",
				"fa fa-venus",
				"fa fa-mars",
				"fa fa-mercury",
				"fa fa-transgender",
				"fa fa-transgender-alt",
				"fa fa-venus-double",
				"fa fa-mars-double",
				"fa fa-venus-mars",
				"fa fa-mars-stroke",
				"fa fa-mars-stroke-v",
				"fa fa-mars-stroke-h",
				"fa fa-neuter",
				"fa fa-genderless",
				"fa fa-facebook-official",
				"fa fa-pinterest-p",
				"fa fa-whatsapp",
				"fa fa-server",
				"fa fa-user-plus",
				"fa fa-user-times",
				"fa fa-bed",
				"fa fa-viacoin",
				"fa fa-train",
				"fa fa-subway",
				"fa fa-medium",
				"fa fa-y-combinator",
				"fa fa-optin-monster",
				"fa fa-opencart",
				"fa fa-expeditedssl",
				"fa fa-battery-full",
				"fa fa-battery-three-quarters",
				"fa fa-battery-half",
				"fa fa-battery-quarter",
				"fa fa-battery-empty",
				"fa fa-mouse-pointer",
				"fa fa-i-cursor",
				"fa fa-object-group",
				"fa fa-object-ungroup",
				"fa fa-sticky-note",
				"fa fa-sticky-note-o",
				"fa fa-cc-jcb",
				"fa fa-cc-diners-club",
				"fa fa-clone",
				"fa fa-balance-scale",
				"fa fa-hourglass-o",
				"fa fa-hourglass-start",
				"fa fa-hourglass-half",
				"fa fa-hourglass-end",
				"fa fa-hourglass",
				"fa fa-hand-rock-o",
				"fa fa-hand-paper-o",
				"fa fa-hand-scissors-o",
				"fa fa-hand-lizard-o",
				"fa fa-hand-spock-o",
				"fa fa-hand-pointer-o",
				"fa fa-hand-peace-o",
				"fa fa-trademark",
				"fa fa-registered",
				"fa fa-creative-commons",
				"fa fa-gg",
				"fa fa-gg-circle",
				"fa fa-tripadvisor",
				"fa fa-odnoklassniki",
				"fa fa-odnoklassniki-square",
				"fa fa-get-pocket",
				"fa fa-wikipedia-w",
				"fa fa-safari",
				"fa fa-chrome",
				"fa fa-firefox",
				"fa fa-opera",
				"fa fa-internet-explorer",
				"fa fa-television",
				"fa fa-contao",
				"fa fa-500px",
				"fa fa-amazon",
				"fa fa-calendar-plus-o",
				"fa fa-calendar-minus-o",
				"fa fa-calendar-times-o",
				"fa fa-calendar-check-o",
				"fa fa-industry",
				"fa fa-map-pin",
				"fa fa-map-signs",
				"fa fa-map-o",
				"fa fa-map",
				"fa fa-commenting",
				"fa fa-commenting-o",
				"fa fa-houzz",
				"fa fa-vimeo",
				"fa fa-black-tie",
				"fa fa-fonticons",
				"fa fa-reddit-alien",
				"fa fa-edge",
				"fa fa-credit-card-alt",
				"fa fa-codiepie",
				"fa fa-modx",
				"fa fa-fort-awesome",
				"fa fa-usb",
				"fa fa-product-hunt",
				"fa fa-mixcloud",
				"fa fa-scribd",
				"fa fa-pause-circle",
				"fa fa-pause-circle-o",
				"fa fa-stop-circle",
				"fa fa-stop-circle-o",
				"fa fa-shopping-bag",
				"fa fa-shopping-basket",
				"fa fa-hashtag",
				"fa fa-bluetooth",
				"fa fa-bluetooth-b",
				"fa fa-percent");

		if ( true == $no_fa ) $icons = str_replace( 'fa fa-', 'fa-', $icons );

		if ( true == $sort ) sort( $icons );

		if ( true == $w_name ) {
			$iconArray = array();

			foreach ( $icons as $icon ) {
				$name = ucwords( str_replace( '-', ' ', str_replace( array(
								'fa-',
								'-play',
								'-square',
								'-alt',
								'-circle'
							), '', $icon ) ) );
				$iconArray[ 'fa ' . $icon ] = $name;
			}

			$icons = $iconArray;
		}

		return $icons;

	}

}
?>