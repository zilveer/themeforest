<?php
/**
 * This file contain theme's basic functions
 */


if ( ! function_exists( 'list_gallery_images' ) ) {
	/**
	 * Get list of Gallery Images - use in gallery post format
	 *
	 * @param string $size
	 */
	function list_gallery_images( $size = 'post-featured-image' ) {
		global $post;

		$gallery_images = rwmb_meta( 'REAL_HOMES_gallery', 'type=plupload_image&size=' . $size, $post->ID );

		if ( ! empty( $gallery_images ) ) {
			foreach ( $gallery_images as $gallery_image ) {
				$caption = ( ! empty( $gallery_image[ 'caption' ] ) ) ? $gallery_image[ 'caption' ] : $gallery_image[ 'alt' ];
				echo '<li><a href="' . $gallery_image[ 'full_url' ] . '" title="' . $caption . '" class="' . get_lightbox_plugin_class() . '">';
				echo '<img src="' . $gallery_image[ 'url' ] . '" alt="' . $gallery_image[ 'title' ] . '" />';
				echo '</a></li>';
			}
		} else if ( has_post_thumbnail( $post->ID ) ) {
			echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '" >';
			the_post_thumbnail( $size );
			echo '</a></li>';
		}
	}
}


if ( ! function_exists( 'framework_excerpt' ) ) {
	/**
	 * Output custom excerpt of required length
	 *
	 * @param int $len     number of words
	 * @param string $trim string to appear after excerpt
	 */
	function framework_excerpt( $len = 15, $trim = "&hellip;" ) {
		echo get_framework_excerpt( $len, $trim );
	}
}


if ( ! function_exists( 'get_framework_excerpt' ) ) {
	/**
	 * Returns custom excerpt of required length
	 *
	 * @param int $len     number of words
	 * @param string $trim string after excerpt
	 * @return array|string
	 */
	function get_framework_excerpt( $len = 15, $trim = "&hellip;" ) {
		$limit = $len + 1;
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
		$num_words = count( $excerpt );
		if ( $num_words >= $len ) {
			array_pop( $excerpt );
		} else {
			$trim = "";
		}
		$excerpt = implode( " ", $excerpt ) . "$trim";
		return $excerpt;
	}
}


if ( ! function_exists( 'comment_custom_excerpt' ) ) {
	/**
	 * Output comment's excerpt of required length from given contents
	 *
	 * @param int $len                number of words
	 * @param string $comment_content comment contents
	 * @param string $trim            text after excerpt
	 */
	function comment_custom_excerpt( $len = 15, $comment_content = "", $trim = "&hellip;" ) {
		$limit = $len + 1;
		$excerpt = explode( ' ', $comment_content, $limit );
		$num_words = count( $excerpt );
		if ( $num_words >= $len ) {
			array_pop( $excerpt );
		} else {
			$trim = "";
		}
		$excerpt = implode( " ", $excerpt ) . "$trim";
		echo $excerpt;
	}
}


if ( ! function_exists( 'get_framework_custom_excerpt' ) ) {
	/**
	 * Return excerpt of required length from given contents
	 *
	 * @param string $contents contents to extract excerpt
	 * @param int $len         number of words
	 * @param string $trim     string to appear after excerpt
	 * @return array|string
	 */
	function get_framework_custom_excerpt( $contents = "", $len = 15, $trim = "&hellip;" ) {
		$limit = $len + 1;
		$excerpt = explode( ' ', $contents, $limit );
		$num_words = count( $excerpt );
		if ( $num_words >= $len ) {
			array_pop( $excerpt );
		} else {
			$trim = "";
		}
		$excerpt = implode( " ", $excerpt ) . "$trim";
		return $excerpt;
	}
}


if ( ! function_exists( 'admin_js' ) ) {
	/**
	 * Register and load admin javascript
	 *
	 * @param $hook
	 */
	function admin_js( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_register_script( 'admin-script', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ) );
			wp_enqueue_script( 'admin-script' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'admin_js', 10, 1 );
}


/**
 * Disable Post Format UI in WordPress 3.6 and Keep the Old One Working
 */
add_filter( 'enable_post_format_ui', '__return_false' );


if ( ! function_exists( 'remove_category_list_rel' ) ) {
	/**
	 * Remove rel attribute from the category list
	 *
	 * @param $output
	 * @return mixed
	 */
	function remove_category_list_rel( $output ) {
		$output = str_replace( ' rel="tag"', '', $output );
		$output = str_replace( ' rel="category"', '', $output );
		$output = str_replace( ' rel="category tag"', '', $output );
		return $output;
	}

	add_filter( 'wp_list_categories', 'remove_category_list_rel' );
	add_filter( 'the_category', 'remove_category_list_rel' );
}


if ( ! function_exists( 'get_lightbox_plugin_class' ) ) {
	/**
	 * Get Lightbox Plugin Class
	 *
	 * @return mixed|string|void
	 */
	function get_lightbox_plugin_class() {
		$lightbox_plugin_class = get_option( 'theme_lightbox_plugin' );
		if ( $lightbox_plugin_class ) {
			return $lightbox_plugin_class;
		} else {
			return 'swipebox';
		}
	}
}


if ( ! function_exists( 'generate_gallery_attribute' ) ) {
	/**
	 * Generate Gallery Attribute
	 *
	 * @param string $gallery_name
	 * @return string
	 */
	function generate_gallery_attribute( $gallery_name = 'real_homes' ) {
		$lightbox_plugin_class = get_lightbox_plugin_class();
		if ( $lightbox_plugin_class == 'pretty-photo' ) {
			return 'data-rel="prettyPhoto[' . $gallery_name . ']"';
		} elseif ( $lightbox_plugin_class == 'swipebox' ) {
			return 'rel="gallery_' . $gallery_name . '"';
		}
		return '';
	}
}


if ( ! function_exists( 'custom_taxonomy_page_url' ) ) {
	/**
	 * Current Page URL
	 *
	 * @return string
	 */
	function custom_taxonomy_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER[ "HTTPS" ] ) && $_SERVER[ "HTTPS" ] == "on" ) {
			$pageURL .= "s";
		}

		$pageURL .= "://";
		if ( $_SERVER[ "SERVER_PORT" ] != "80" ) {
			$pageURL .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "REQUEST_URI" ];
		} else {
			$pageURL .= $_SERVER[ "SERVER_NAME" ] . $_SERVER[ "REQUEST_URI" ];
		}

		if ( $_SERVER[ 'QUERY_STRING' ] ) {
			$pos = strpos( $pageURL, 'view' );
			if ( $pos ) {
				$pageURL = substr( $pageURL, 0, $pos - 1 );
			}
		}

		return $pageURL;
	}
}


if ( ! function_exists( 'addhttp' ) ) {
	/**
	 * Add http:// in url if not exists
	 *
	 * @param $url
	 * @return string
	 */
	function addhttp( $url ) {
		if ( ! preg_match( "~^(?:f|ht)tps?://~i", $url ) ) {
			$url = "http://" . $url;
		}
		return $url;
	}
}


if ( ! function_exists( 'custom_login_logo_url' ) ) {
	/**
	 * WordPress login page logo URL
	 *
	 * @return string|void
	 */
	function custom_login_logo_url() {
		return home_url();
	}

	add_filter( 'login_headerurl', 'custom_login_logo_url' );
}


if ( ! function_exists( 'custom_login_logo_url_title' ) ) {
	/**
	 * WordPress login page logo url title
	 *
	 * @return string|void
	 */
	function custom_login_logo_url_title() {
		return get_bloginfo( 'name' );
	}

	add_filter( 'login_headertitle', 'custom_login_logo_url_title' );
}


if ( ! function_exists( 'custom_login_style' ) ) {
	/**
	 * WordPress login page custom styles
	 */
	function custom_login_style() {
		wp_enqueue_style( 'login-style', get_template_directory_uri() . "/css/login-style.css", false );
	}

	add_action( 'login_enqueue_scripts', 'custom_login_style' );
}


if ( ! function_exists( 'alert' ) ) {
	/**
	 * Alert function to display messages on member pages
	 *
	 * @param string $heading
	 * @param string $message
	 */
	function alert( $heading = '', $message = '' ) {
		echo '<div class="inspiry-message">';
		echo '<strong>' . $heading . '</strong> <span>' . $message . '</span>';
		echo '</div>';
	}
}


if ( ! function_exists( 'modify_user_contact_methods' ) ) {
	/**
	 * Add Additional Contact Info to User Profile Page
	 *
	 * @param $user_contactmethods
	 * @return mixed
	 */
	function modify_user_contact_methods( $user_contactmethods ) {
		$user_contactmethods[ 'mobile_number' ] = __( 'Mobile Number', 'framework' );
		$user_contactmethods[ 'office_number' ] = __( 'Office Number', 'framework' );
		$user_contactmethods[ 'fax_number' ] = __( 'Fax Number', 'framework' );

		return $user_contactmethods;
	}

	add_filter( 'user_contactmethods', 'modify_user_contact_methods' );
}


if ( ! function_exists( 'get_icon_for_extension' ) ) {
	/**
	 * Fontawsome icon based on file extension
	 *
	 * @param $ext
	 * @return string
	 */
	function get_icon_for_extension( $ext ) {
		switch ( $ext ) {
			/* PDF */
			case 'pdf':
				return '<i class="fa fa-file-pdf-o"></i>';

			/* Images */
			case 'jpg':
			case 'png':
			case 'gif':
			case 'bmp':
			case 'jpeg':
			case 'tiff':
			case 'tif':
				return '<i class="fa fa-file-image-o"></i>';

			/* Text */
			case 'txt':
			case 'log':
			case 'tex':
				return '<i class="fa fa-file-text-o"></i>';

			/* Documents */
			case 'doc':
			case 'odt':
			case 'msg':
			case 'docx':
			case 'rtf':
			case 'wps':
			case 'wpd':
			case 'pages':
				return '<i class="fa fa-file-word-o"></i>';

			/* Spread Sheets */
			case 'csv':
			case 'xlsx':
			case 'xls':
			case 'xml':
			case 'xlr':
				return '<i class="fa fa-file-excel-o"></i>';

			/* Zip */
			case 'zip':
			case 'rar':
			case '7z':
			case 'zipx':
			case 'tar.gz':
			case 'gz':
			case 'pkg':
				return '<i class="fa fa-file-zip-o"></i>';

			/* Audio */
			case 'mp3':
			case 'wav':
			case 'm4a':
			case 'aif':
			case 'wma':
			case 'ra':
			case 'mpa':
			case 'iff':
			case 'm3u':
				return '<i class="fa fa-file-audio-o"></i>';

			/* Video */
			case 'avi':
			case 'flv':
			case 'm4v':
			case 'mov':
			case 'mp4':
			case 'mpg':
			case 'rm':
			case 'swf':
			case 'wmv':
				return '<i class="fa fa-file-video-o"></i>';

			/* Others */
			default:
				return '<i class="fa fa-file-o"></i>';
		}
	}
}


if ( ! function_exists( 'get_inspiry_image_placeholder' ) ) {
	/**
	 * Returns image place holder for given size
	 *
	 * @param $image_size
	 * @return string
	 */
	function get_inspiry_image_placeholder( $image_size ) {

		global $_wp_additional_image_sizes;

		$holder_width = 0;
		$holder_height = 0;
		$holder_text = get_bloginfo( 'name' );

		if ( in_array( $image_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$holder_width = get_option( $image_size . '_size_w' );
			$holder_height = get_option( $image_size . '_size_h' );

		} elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

			$holder_width = $_wp_additional_image_sizes[ $image_size ][ 'width' ];
			$holder_height = $_wp_additional_image_sizes[ $image_size ][ 'height' ];

		}

		if ( intval( $holder_width ) > 0 && intval( $holder_height ) > 0 ) {
			return '<img src="http://placehold.it/' . $holder_width . 'x' . $holder_height . '&text=' . urlencode( $holder_text ) . '" />';
		}

		return '';
	}
}


if ( ! function_exists( 'inspiry_image_placeholder' ) ) {
	/**
	 * Output image place holder for given size
	 *
	 * @param $image_size
	 */
	function inspiry_image_placeholder( $image_size ) {
		echo get_inspiry_image_placeholder( $image_size );
	}
}


if ( ! function_exists( 'inspiry_log' ) ) {
	/**
	 * Function to help in debugging
	 *
	 * @param $message
	 */
	function inspiry_log( $message ) {
		if ( WP_DEBUG === true ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}


if ( ! function_exists( 'google_map_needed' ) ) {
	/**
	 * Check if google map script is needed or not
	 *
	 * @return bool
	 */
	function google_map_needed() {
		if ( is_page_template( 'template-contact.php' ) && ( get_option( 'theme_show_contact_map' ) == 'true' ) ) {
			return true;
		} else if ( is_page_template( 'template-map-based-listing.php' ) || is_page_template( 'template-submit-property.php' ) ) {
			return true;
		} else if ( is_singular( 'property' ) && ( get_option( 'theme_display_google_map' ) == 'true' ) ) {
			return true;
		} else if ( is_page_template( 'template-home.php' ) ) {
			$theme_homepage_module = get_option( 'theme_homepage_module' );
			if ( isset( $_GET[ 'module' ] ) ) {
				$theme_homepage_module = $_GET[ 'module' ];
			}
			if ( $theme_homepage_module == 'properties-map' ) {
				return true;
			}
		} else if ( is_page_template( 'template-search.php' ) && ( get_option( 'theme_search_module' ) == 'properties-map' ) ) {
			return true;
		} else if ( is_page_template( 'template-search-sidebar.php' ) && ( get_option( 'theme_search_module' ) == 'properties-map' ) ) {
			return true;
		} else if ( is_page_template( 'template-property-listing.php' ) || is_page_template( 'template-property-grid-listing.php' ) || is_tax( 'property-city' ) || is_tax( 'property-status' ) || is_tax( 'property-type' ) || is_tax( 'property-feature' ) ) {
			// Theme Listing Page Module
			$theme_listing_module = get_option( 'theme_listing_module' );
			// Only for demo purpose only
			if ( isset( $_GET[ 'module' ] ) ) {
				$theme_listing_module = $_GET[ 'module' ];
			}
			if ( $theme_listing_module == 'properties-map' ) {
				return true;
			}
		}
		return false;
	}
}