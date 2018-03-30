<?php

function current_page_url($forDisplay = false) {
	$pageURL = 'http';
	if ( isset( $_SERVER["HTTPS"] ) ) {
		if ( $_SERVER["HTTPS"] == "on" ) {
			$pageURL .= "s";
		}
	}
	$pageURL .= "://";
	if ( $_SERVER["SERVER_PORT"] != "80" ) {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

	//escape it if we need to display it. REQUEST_URI could be overwritten somewhere
	return $forDisplay?esc_url($pageURL):$pageURL;
}

/**
 * Returns option
 *
 * @param string $id
 * @param string $default
 *
 * @throws Exception
 * @return string
 */
function ct_get_option( $id, $default = '' ) {
	/** @var $NHP_Options ctNHP_Options */
	global $NHP_Options;
	if ( $NHP_Options ) {
		return $NHP_Options->get( $id, $default );
	}

	throw new Exception( "Settings not initialized!" );
}

/**
 * Do we have an option?
 *
 * @param $id
 *
 * @return mixed
 * @throws Exception
 */

function ct_has_option( $id ) {
	global $NHP_Options;
	if ( $NHP_Options ) {
		return $NHP_Options->has( $id );
	}

	return false;
}

/**
 * Options initialized?
 * @return bool
 */

function ct_options_initialized() {
	global $NHP_Options;

	return (bool) $NHP_Options;
}

/**
 * Set option
 *
 * @param string $id
 * @param string $value
 *
 * @throws Exception
 */

function ct_set_option( $id, $value ) {
	/** @var $NHP_Options ctNHP_Options */
	global $NHP_Options;
	if ( $NHP_Options ) {
		return $NHP_Options->set( $id, $value );
	}

	throw new Exception( "Settings not initialized!" );
}

/**
 * Returns option and wraps it into a pattern
 *
 * @param string $name
 * @param string $pattern
 * @param null $default
 *
 * @return string
 */
function ct_get_option_pattern( $name, $pattern, $default = null ) {
	if ( ( $v = ct_get_option( $name ) ) && $v != $default ) {
		return sprintf( $pattern, esc_attr( $v ) ) . "\n";
	}

	return '';
}

/**
 * Returns option and wraps it into a pattern
 *
 * @param $params
 * @param $container
 * @param null $default
 *
 * @return string
 */
function ct_get_option_patterns( $params, $container, $default = null ) {
	$data = array();
	foreach ( $params as $name => $pat ) {
		if ( ( $e = ct_get_option( $name ) ) ) {
			if ( $e != $default ) {
				$data[] = sprintf( $pat, $e );
			}
		}
	}
	if ( $data ) {
		return $container . '{' . implode( ';', $data ) . '}';
	}

	return '';

}


/**
 * @param $thumbId
 * @param string $size
 * @param string $width
 * @param string $height
 * @return array
 */
function  ct_get_image_data ($thumbId, $size = '', $width = '', $height = '') {
    $finalSize = $size?$size:'';
    if(!$finalSize){
        $finalSize = array($width,$height);
    }

    $image = wp_get_attachment_image_src($thumbId, $finalSize);
    $imageUrl = $image[0];
    $width = $image[1];
    $height = $image[2];
    $alt = get_post_meta($thumbId , '_wp_attachment_image_alt', true);
    $title = get_the_title($thumbId);

    return array(
        'id'=>  $thumbId,
        'url'=> $imageUrl,
        'width'=> $width,
        'height' =>$height,
        'alt'=>$alt,
        'title'=>$title,
    );



}

/**
 * @param $postId
 * @param $width
 * @param $height
 * @return array
 */
function ct_get_featured_image_data($postId,$width,$height){
    return ct_get_image_data(get_post_thumbnail_id($postId),$width,$height);
}

/**
 * returns feature image source for the post
 *
 * @param $postId
 * @param string $size
 *
 * @return string
 */
function ct_get_feature_image_src( $postId, $size = "thumbnail" ) {
	$imgsrc = '';
	if ( has_post_thumbnail( $postId ) ) {
		$image  = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), $size );
		$imgsrc = $image[0];
	}

	return $imgsrc;
}

/**
 * returns
 *
 * @param $postId
 *
 * @return array string[]
 */
function ct_get_categories_names( $postId, $taxonomy = 'category' ) {
	$cats   = get_the_terms( $postId, $taxonomy );
	$result = array();
	if ( $cats ) {
		foreach ( $cats as $cat ) {
			$result[ $cat->term_id ] = $cat->name;
		}
	}

	return $result;
}

/**
 * returns
 *
 * @param $postId
 * @param string $separator
 *
 * @return string
 */
function ct_get_categories_string( $postId, $separator = ',', $taxonomy = 'category' ) {
	$cats   = get_the_terms( $postId, $taxonomy );
	$result = '';
	if ( $cats ) {
		foreach ( $cats as $cat ) {
			$result .= ( $cat->name . $separator );
		}
	}

	return substr( $result, 0, ( - 1 * strlen( $separator ) ) );
}

/**
 * returns
 *
 * @param $postId
 * @param string $separator
 *
 * @return string
 */
function ct_get_categories_slug_string( $postId, $separator = ',', $taxonomy = 'category' ) {
	$cats   = get_the_terms( $postId, $taxonomy );
	$result = '';
	if ( $cats ) {
		foreach ( $cats as $cat ) {
			if (is_object($cat)){
				$result .= ( $cat->slug . $separator );
			}
		}
	}

	return substr( $result, 0, ( - 1 * strlen( $separator ) ) );
}

/**
 * returns posts grouped by categories ids
 *
 * @param $atts
 * @param string $taxonomy
 * @param bool $allowWithoutCategories
 *
 * @return array
 */
function ct_get_posts_grouped_by_cat( $atts, $taxonomy = 'category', $allowWithoutCategories = false ) {
	if ( ! isset( $atts['orderby'] ) ) {
		$atts['orderby'] = 'menu_order';
	}

	if ( ! isset( $atts['order'] ) ) {
		$atts['order'] = 'ASC';
	}

	$empty = true;
	if ( class_exists( 'TheTaxonomySort' ) ) {
		$result = array();
		$terms  = get_terms( 'faq_category', 'hide_empty=1' );
		foreach ( $terms as $term ) {
			$result[ $term->term_id ]['cat'] = $term->name;
		}

		$query = new WP_Query;
		$faqs  = $query->query( $atts );

		foreach ( $faqs as $faq ) {
			if ( $cats = get_the_terms( $faq->ID, $taxonomy ) ) {
				$empty = false;
				foreach ( $cats as $cat ) {
					if ( isset( $result[ $cat->term_id ]['cat'] ) ) {
						$result[ $cat->term_id ]['posts'][] = $faq;
					}
				}
			}
		}

		if ( $empty && $allowWithoutCategories ) {
			return $faqs;
		}

		return $result;
	} else {
		$result = array();
		$query  = new WP_Query;
		$faqs   = $query->query( $atts );
		foreach ( $faqs as $faq ) {
			if ( $cats = get_the_terms( $faq->ID, $taxonomy ) ) {
				$empty = false;
				foreach ( $cats as $cat ) {
					$result[ $cat->term_id ]['cat']     = $cat->name;
					$result[ $cat->term_id ]['posts'][] = $faq;
				}
			}
		}

		if ( $empty && $allowWithoutCategories ) {
			return $faqs;
		}

		return $result;
	}
}

/**
 * returns blog url
 * @return string|void
 */
function ct_get_blog_url() {
	if ( $posts_page_id = get_option( 'page_for_posts' ) ) {
		if ( function_exists( 'icl_object_id' ) ) {
			$iclpageid     = icl_object_id( $posts_page_id, 'page', true, ICL_LANGUAGE_CODE );
			$posts_page_id = $iclpageid ? $iclpageid : $posts_page_id;
		}

		return home_url( get_page_uri( $posts_page_id ) );
	} else {
		return home_url('/');
	}
}

/**
 * handles dynamic sidebars
 */
function ct_dynamic_sidebar( $name = 'sidebar-primary' ) {
	if ( function_exists( 'MS_dynamic_sidebar' ) ) {
		MS_dynamic_sidebar();
	} else {
		if (is_active_sidebar($name)){
			dynamic_sidebar( $name );
		}
	}
}

/**
 * gets excerpt from content by post id
 *
 * @param $post_id
 * @param $excerpt_length - number of words
 */
if ( ! function_exists( 'get_excerpt_by_id' ) ) {
	function get_excerpt_by_id( $post_id, $excerpt_length = 35 ) {
		$the_post = get_post( $post_id ); //Gets post ID
		if ( $the_excerpt = $the_post->post_excerpt ) {
			return '<p>' . $the_excerpt . '</p>';
		}
		$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
		$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); //Strips tags and images
		$words       = explode( ' ', $the_excerpt, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			array_push( $words, '&#8230;' );
			$the_excerpt = implode( ' ', $words );
		endif;
		$the_excerpt = '<p>' . $the_excerpt . '</p>';

		return $the_excerpt;
	}
}

/**
 * wp_nav_menu custom walker for breadcrumbs
 */
class ctBreadCrumbWalker extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * @see Walker::$db_fields
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * delimiter for crumbs
	 * @var string
	 */
	var $delimiter = '';

	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		//increasead compatiblity for WP >=3.6
		$this->start_element( $output, $item, $depth, $args );
	}

	function start_element( &$output, $item, $depth, $args ) {

		//Check if menu item is an ancestor of the current page
		$classes             = empty( $item->classes ) ? array() : (array) $item->classes;
		$current_identifiers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' );
		$ancestor_of_current = array_intersect( $current_identifiers, $classes );

		if ( $ancestor_of_current ) {
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			//Preceed with delimter for all but the first item.
			if ( 0 != $depth ) {
				$output .= $this->delimiter;
			}

			//Link tag attributes
			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

			//Add to the HTML output
			$isCurrent = false;
			foreach ( $classes as $class ) {
				if ( $class == 'current-menu-item' ) {
					$isCurrent = true;
					break;
				}
			}

			'<a href="/">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="./">Parent page</a>&nbsp;&nbsp;/&nbsp;&nbsp;<span>Current page</span>';

			if ( $isCurrent ) {
				$output .= '<span>' . $title . '</span>';

			} else {
				$output .= '<a' . $attributes . '>' . $title . '</a>&nbsp;&nbsp;/&nbsp;&nbsp;';
			}
		}
	}
}



