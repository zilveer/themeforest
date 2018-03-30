<?php
/**
 * Helper functions
 *
 * @package Organique
 */



/**
 * Adds light class (width <span> element) to the first word
 *
 * @param string $str The input string
 * @return string The properly formatted string with class .light
 */
if ( ! function_exists( 'lighted_title' ) ) {
	function lighted_title( $str ) {
		$out = "";
		$str = trim( strip_tags( $str ) );
		if ( strpos( $str, " " ) !== FALSE ) {
			$first_space = strpos( $str, " " );
		}
		if ( ! empty( $first_space ) ) {
			$out .= '<span class="light">';
			$out .= substr( $str, 0, $first_space );
			$out .= '</span>';
			$out .= substr( $str, $first_space );
			return $out;
		} else {
			return $str;
		}
}
}



/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
if ( ! function_exists( 'organique_wp_title' ) ) {
	function organique_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'organique_wp' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'organique_wp_title', 10, 2 );
}




/**
 * Function for creating breadcrumbs navigation
 *
 * @see http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */
if ( ! function_exists( 'dimox_breadcrumbs' ) ) {
	function dimox_breadcrumbs() {

		/* === OPTIONS === */
		$text['home']     = __( 'Home Page', 'organique_wp' ); // text for the 'Home' link
		$text['category'] = __( 'Archive by Category &quot;%s&quot;', 'organique_wp' ); // text for a category page
		$text['search']   = __( 'Search Results for &quot;%s&quot; Query', 'organique_wp' ); // text for a search results page
		$text['tag']      = __( 'Posts Tagged &quot;%s&quot;', 'organique_wp' ); // text for a tag page
		$text['author']   = __( 'Articles Posted by %s', 'organique_wp' ); // text for an author page
		$text['404']      = __( 'Error 404', 'organique_wp' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = ''; // delimiter between crumbs
		$before      = '<li class="current">'; // tag before the current crumb
		$after       = '</li>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink = home_url() . '/';
		$linkBefore = '<li>';
		$linkAfter = '</li>';
		$linkAttr = '';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if ( is_front_page() ) {

			if ($showOnHome == 1) echo '<ul class="breadcrumb"><a href="' . $homeLink . '">' . $text['home'] . '</a></ul>';

		} else {

			echo '<ul class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
				}
				echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, get_post_type_archive_link( get_post_type() ), $post_type->labels->singular_name);
					if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if ( is_object( $post_type ) ) {
					echo $before . $post_type->labels->name . $after;
				} else {
					if ( is_woocommerce_active() && is_shop() ) {
						echo $before . __( 'No products found', 'organique_wp' ) . $after;
					} else {
						echo '';
					}
				}

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = @get_the_category($parent->ID);
				if( !empty( $cat ) ) {
					$cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					printf($link, get_permalink($parent), $parent->post_title);
					if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
				}


			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;

			} elseif ( is_home() && !is_front_page() ) {
				$blog_id = get_option( 'page_for_posts' );
				$blog = get_page( $blog_id );
				if ( 1 == $showCurrent ) echo $before . $blog->post_title . $after;
			}

			if ( get_query_var('paged') ) {
				echo $delimiter;
				echo $linkBefore . '(';
				echo __( 'Page', 'organique_wp' ) . ' ' . get_query_var('paged');
				echo ')' . $linkAfter;

			}

			echo '</ul>';

		}
	} // end dimox_breadcrumbs()
}



/**
 * Check if we are on the login page
 */
if ( ! function_exists( 'is_login_page' ) ) {
	function is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}



/**
 * Pagination for WP
 *
 * @see http://codex.wordpress.org/Function_Reference/paginate_links
 */
if ( ! function_exists( 'organique_pagination' ) ) {
	function organique_pagination() {
		global $wp_query;
		$big = 1e6;

		$pagination = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'total'     => $wp_query->max_num_pages,
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'type'      => 'array',
			'prev_text' => '<span class="glyphicon  glyphicon-chevron-left"></span>',
			'next_text' => '<span class="glyphicon  glyphicon-chevron-right"></span>'
		) );

		if ( ! empty( $pagination ) ) {
			foreach ( $pagination as $key => $link ) {
				if ( 0 === $key ) {
					if ( strstr( $link, 'prev' ) ) {
						printf( '%s<div class="pagination__page-numbers">', $link );
					} else {
						printf( '<div class="pagination__page-numbers">%s', $link );
					}
				} else if ( ( count( $pagination ) - 1 ) === $key ) {
					if ( strstr( $link, 'next' ) ) {
						printf( '</div>%s', $link );
					} else {
						printf( '%s</div>', $link );
					}
				} else {
					echo $link;
				}
			}
		}
}
}


/**
 * Calculate darker hexdec color variant
 *
 * @see http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
if ( ! function_exists( 'darken_css_color' ) ) {
	function darken_css_color( $color = '', $percent = 20 ) {
		// return if not specified
		if ( empty( $color ) )
			return;

		$percent = 100 - $percent;

		// Extract the colors. I'd prefer to use regular expressions, though there are probably other more efficient ways too.
		if( ! preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts ) )
			return "#000000";

		// Now we have red in $parts[1], green in $parts[2] and blue in $parts[3]. Now, let's convert them from hexadecimal to integers:
		$out = ''; // Prepare to fill with the results
		for( $i = 1; $i <= 3; $i++ ) {
			$parts[$i] = hexdec( $parts[$i] );
			// Then we'll decrease them by 20 %:
			$parts[$i] = round( $parts[$i] * ( (int)$percent/100 ) ); // 80/100 = 80%, i.e. 20% darker

			// Now, we'll turn them back into hexadecimal and add them to our output string
			$out .= str_pad( dechex( $parts[$i] ), 2, '0', STR_PAD_LEFT );
		}
		return "#" . $out;
	}
}



/**
 * Create a style for the HTML attribute from the array of the CSS properties
 */
if ( ! function_exists( 'create_style_attr' ) ) {
	function create_style_attr( $attrs ) {
		$bg_style = '';

		if( is_array( $attrs ) ) {
			$attrs = array_filter( $attrs, "strlen" );
		}

		if( ! empty($attrs) ) {
			$bg_style = ' style="';
			foreach ($attrs as $key => $value) {
				if( 'background-image' === $key ) {
					$bg_style .= $key . ': url(\'' . $value . '\'); ';

				} else {
					$bg_style .= $key . ': ' . $value . '; ';
				}
			}
			$bg_style .= '"';
		}

		return $bg_style;
	}
}


/**
 * Get the hex dec color and return the rgba CSS value
 * @param  string $color       hex dec color
 * @param  float  $transparent amount of transparent channel
 * @return string
 */
if ( ! function_exists( 'transparentize_css_color' ) ) {
	function transparentize_css_color( $color,  $transparent = 0.8 ) {
		$parts = get_rgb_parts( $color );
		$out = '';
		list($bla, $r, $g, $b) = $parts;

		return "rgba({$r}, {$g}, {$b}, {$transparent});";
	}
}



/**
 * Filter the theme mods only for the social icons options
 * @return array The array of the social icons and links, or empty array when there is no options in the DB
 */
if ( ! function_exists( 'get_social_icons_links' ) ) {
	function get_social_icons_links() {
		// get the non-empty theme mods
		$mods = get_theme_mod( 'social_icons' );

		if( ! is_array( $mods ) ) {
			return array();
		}

		$mods = array_filter( $mods, 'strlen' );

		// flip, so we can filter the array
		$flipped = array_flip( $mods );

		// return false if empty
		if ( empty( $filtered ) ) {
			return array();
		}

		// sort the array alphabetically
		asort( $filtered );

		$out = array();

		// reverse the key and value and sanitize
		foreach ( $filtered as $key => $value ) {
			$new_key       = str_replace( '_', '-', $value );
			$new_value     = esc_url( $key );
			$out[$new_key] = $new_value;
		}

		return $out;
	}
}


/**
 * Check if WooCommerce is active
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		return class_exists( 'Woocommerce' );
	}
}


/**
 * Polyfill for the array_replace_recursive native PHP >= 5.3.0 function
 *
 * @link http://php.net/manual/en/function.array-replace-recursive.php
 */

if ( ! function_exists( 'array_replace_recursive' ) ) {
	function array_replace_recursive( $array, $array1 ) {

		if ( ! function_exists( 'recurse' ) ) {
			function recurse( $array, $array1 ) {
				foreach ( $array1 as $key => $value ) {
					// create new key in $array, if it is empty or not an array
					if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
						$array[$key] = array();
					}

					// overwrite the value in the base array
					if (is_array($value)) {
						$value = recurse($array[$key], $value);
					}
					$array[$key] = $value;
				}
				return $array;
			}
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array)) {
			return $array;
		}
		for ($i = 1; $i < count($args); $i++) {
			if (is_array($args[$i])) {
				$array = recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}



/**
 * Copies the contents of the ZIP archive to the wp-uploads/ folder.
 * Should perform only once, after the initial setup, but the "after_switch_theme"
 * is called too soon and the WP_Filesystem class is not yet initialized.
 *
 * So the Options API is called to set a flag in a DB
 *
 * @link http://codex.wordpress.org/Filesystem_API
 * @link http://ottopress.com/2011/tutorial-using-the-wp_filesystem/
 *
 * @return void
 */
if ( ! function_exists( "organique_extract_su_skin" ) ) {
	function organique_extract_su_skin() {
		if( 1 === (int)get_option( 'organique_su_skin_copied' ) ) {
			return;
		} else {
			$method = '';

			// okay, let's see about getting credentials
			$url = wp_nonce_url( 'themes.php' );
			if ( false === ( $creds = request_filesystem_credentials( $url, $method, false ) ) ) {
				return true; // stop the normal page form from displaying
			}

			// now we have some credentials, try to get the wp_filesystem running
			if ( ! WP_Filesystem( $creds ) ) {
				// our credentials were no good, ask the user for them again
				request_filesystem_credentials( $url, $method, true );
				return true;
			}

			// get the upload directory
			$upload_dir = wp_upload_dir();

			// by this point, the $wp_filesystem global should be working, so let's use it to unzip an archive
			global $wp_filesystem;

			// all the magic happens here
			unzip_file(
				trailingslashit( __DIR__ ) . 'assets/shortcodes-ultimate-skins.zip',
				$upload_dir['basedir']
			);

			// set a flag in DB, no matter if that was successful or not
			add_option( 'organique_su_skin_copied', 1 );

			return;
		}
	}
	add_action( 'admin_init', 'organique_extract_su_skin' );
}


/**
 * Check the array settings for google maps
 */
if ( ! function_exists( 'organique_maps_array' ) ) {
	function organique_maps_array() {
		$arr = ot_get_option( 'gmap_locations', array() );

		if ( empty( $arr ) ) {
			$arr = array( array(
				'title' => get_bloginfo( 'title' ),
				'link'  => ot_get_option( 'gm_lat_lng', '0,0' ),
			) );
		}

		return (array)$arr;
	}
}



/**
 * Set some things when the theme is activated
 */
if ( ! function_exists( 'pt_theme_activated' ) ) {
	function pt_theme_activated() {
		// set skin for plugin SU
		update_option( 'su_option_skin', 'organique' );
	}
	add_action( 'after_switch_theme', 'pt_theme_activated' );
}


/**
 * Get the Google maps API URL with API key.
 */
if ( ! function_exists( 'organique_get_google_maps_api_url' ) ) {
	function organique_get_google_maps_api_url() {
		$google_maps_api_url = '//maps.google.com/maps/api/js';
		$google_maps_api_key = get_theme_mod( 'google_maps_api_key', '' );

		if ( ! empty( $google_maps_api_key ) ) {
			$google_maps_api_url = add_query_arg( 'key', $google_maps_api_key, $google_maps_api_url );
		}

		return $google_maps_api_url;
	}
}
