<?php
/**
 * This file is part of the G1_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents:
 * 
 * 1. PHP missing functions
 * 2. WordPress missing functions
 * 3. Breadcrumbs
 * 4. Data
 * 5. Loop
 * 6. Template Part
 * 7. Help Mode
 * 8. Sidebar
 * 9. Pagination
 * 10. Elements
 *  
 * @package G1_Framework
 * @subpackage G1_Tools
 * @since G1_Tools 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/* ------------------------------------------------------------------------- */
/* ---------->>> PHP MISSING FUNCTIONS <<<---------------------------------- */
/* ------------------------------------------------------------------------- */

if ( ! function_exists( 'g1_truncate_text' ) ) :
    function g1_truncate_text ($text, $chars = 30, $more = '...', $break = ' ') {
        if ( strlen($text) <= $chars ) {
            return $text;
        }

        $truncated = substr( $text, 0, $chars );

        if ( isset($text[$chars]) && $text[$chars] != $break) {
            if(false !== ($breakpoint = strrpos($truncated, $break))) {
                $truncated = substr($truncated, 0, $breakpoint);
            }
        }

        return $truncated.$more;
    }
endif;

if ( ! function_exists( 'is_html_code' ) ) :
    function is_html_code( $string ) {
        return (false !== strpos($string, '<'));
    }
endif;



if ( ! function_exists( 'mb_unserialize' ) ) :
/**
 * Multibyte version of the serialize() function
 * 
 * @param 			string $str
 * @return			string
 */
function mb_unserialize($str)
{
    $res = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $str );
    return unserialize($res);
}
endif;



if ( ! function_exists( 'str_endswith' ) ) :
/**
 * Checkes whether a string ends with an another string
 * 
 * @param 			string $haystack
 * @param 			string $needle
 * #return			bool
 */
function str_endswith( $haystack, $needle) {
    $haystack_length = strlen( $haystack );
    $needle_length = strlen( $needle );
    
    if ( $needle_length > $haystack_length ) {
    	return false;
    }
    
    return substr_compare( $haystack, $needle, -$needle_length) === 0;
}
endif;


if ( ! function_exists( 'sanitize_mail_header' ) ) :
function sanitize_mail_header($value) {
    return preg_replace('=((<CR>|<LF>|0x0A/%0A|0x0D/%0D|\\n|\\r)\S).*=i', null, $value);
}
endif;

/* ------------------------------------------------------------------------- */
/* ---------->>> WORDPRESS MISSING FUNCTIONS <<<---------------------------- */
/* ------------------------------------------------------------------------- */
if ( ! function_exists( 'g1_has_current_user_role' ) ) :
    function g1_has_current_user_role ( $role ) {
        $user = wp_get_current_user();

        if ( !empty( $user->roles ) ) {
            return in_array( $role, $user->roles );
        }

        return false;
    }
endif;


if ( ! function_exists( 'shortcode_exists' ) ) :
    function shortcode_exists( $shortcode ) {
        global $shortcode_tags;

        if ( array_key_exists( $shortcode, $shortcode_tags ) )
            return true;

        return false;
    }
endif;

if ( ! function_exists( 'add_taxonomy_support' ) ) :
/**
 * Registers support of certain features for a taxonomy
 * 
 * @param string $taxonomy The taxonomy for which to add the feature
 * @param string|array $feature the feature being added, can be an array of feature strings or a single string
 */
function add_taxonomy_support( $taxonomy, $feature ) {
	global $_G1;
	if ( empty( $_G1[ 'taxonomy_features' ] ) ) {
		$_G1[ 'taxonomy_features' ] = array();
	}	

    $features = (array) $feature;
    foreach ( $features as $feature ) {
    	if ( func_num_args() == 2 ) {
    		if ( !isset( $_G1[ 'taxonomy_features' ][ $taxonomy ] ) ) {
    			$_G1[ 'taxonomy_features' ][ $taxonomy ] = array();
    		} 
    		
	    	$_G1[ 'taxonomy_features' ][ $taxonomy ][ $feature ] = true;
	    }
    }	    
}
endif;



if ( ! function_exists( 'taxonomy_supports' ) ) :
/**
 * Checks a taxonomy's support for a given feature
 *
 * @param string $taxonomy The taxonomy being checked
 * @param string $feature the feature being checked
 * @return boolean
 */
function taxonomy_supports( $taxonomy, $feature ) {
	global $_G1;
	
    if ( 
    	empty( $_G1[ 'taxonomy_features' ] ) ||
    	empty( $_G1[ 'taxonomy_features' ][ $taxonomy ] ) ||
    	empty( $_G1[ 'taxonomy_features' ][ $taxonomy ][ $feature ] )
    ) {
    	return false;
    }    
    
    return true;
}
endif;




if ( ! function_exists( 'sanitize_html_classes' ) ) :
/**
 * sanitize_html_class (WordPress core function) wrapper.
 * 
 * Now it is possible to sanitize multiple clasess.
 * 
 * @param mixed $classes
 * @param string $fallback
 * @return string
 */
function sanitize_html_classes( $classes, $fallback = '' ) {
	if ( !is_array( $classes ) ) {
		$classes = explode( ' ', $classes );
		if ( !is_array( $classes ) ) {
			$classes = array();
		}
	}
	
	if ( count( $classes ) ) {
		$classes = array_map( 'sanitize_html_class', $classes );
		$classes = implode( ' ', $classes );
		
		return $classes;
	} else {
		return $fallback;
	}
}
endif;



/* ------------------------------------------------------------------------- */
/* ---------->>> BREADCRUMBS <<<-------------------------------------------- */
/* ------------------------------------------------------------------------- */
function g1_wp_link_pages($args = '') {
	$defaults = array(
    	'before' => '<p>' . __( 'Pages:', 'g1_theme' ),
    	'after' => '</p>',
		'current_before' => '',
		'current_after'	=> '',
        'link_before' => '', 
        'link_after' => '',
        'next_or_number' => 'number', 
        'nextpagelink' => __( 'Next page', 'g1_theme' ),
        'previouspagelink' => __( 'Previous page', 'g1_theme' ),
        'pagelink' => '%',
        'echo' => 1
    );

	$r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    $output = '';
    if ( $multipage ) {
    	if ( 'number' == $next_or_number ) {
        	$output .= $before;
            for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
             	$j = str_replace('%',$i,$pagelink);
            	$output .= ' ';
                if ( ($i != $page) || ((!$more) && ($page==1)) ) {
                  	$output .= _wp_link_page($i);
                } else {
                	$output .= $current_before;
                }
                                
                $output .= $link_before . $j . $link_after;
                
                if ( ($i != $page) || ((!$more) && ($page==1)) ) {
                  	$output .= '</a>';
                } else {
                	$output .= $current_after;
                }  	
            }
        	$output .= $after;
        } else {
        	if ( $more ) {
            	$output .= $before;
                $i = $page - 1;
                if ( $i && $more ) {
                	$output .= _wp_link_page($i);
                    $output .= $link_before. $previouspagelink . $link_after . '</a>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                	$output .= _wp_link_page($i);
                    $output .= $link_before. $nextpagelink . $link_after . '</a>';
                }
                $output .= $after;
            }
        }
   	}

	if ( $echo )
    	echo $output;

	return $output;
}



/* ------------------------------------------------------------------------- */
/* ---------->>> IMAGE SIZE <<<--------------------------------------------- */
/* ------------------------------------------------------------------------- */
	
function g1_get_image_dimensions ( $size ) {
    switch ( $size ) {
        case 'thumbnail':
        case 'medium':
        case 'medium':
            return get_wp_image_dimensions($size);
            break;

        case 'full':
            return array(9999,9999);
            break;
    }

    global $_wp_additional_image_sizes;

    if ( !empty($_wp_additional_image_sizes[$size]) ) {
        $width = $_wp_additional_image_sizes[ $size ][ 'width' ];
        $height = $_wp_additional_image_sizes[ $size ][ 'height' ];

        if ( $height >= 9999 ) {
            $height = absint(round(9 * $width / 16));
        }

        return array($width, $height);
    }

    return array(0,0);
}

function get_wp_image_dimensions ( $size ) {
    $width = intval(get_option($size.'_size_w'));
    $height = intval(get_option($size . '_size_h'));

    return array($width, $height);
}




/* ------------------------------------------------------------------------- */
/* ---------->>> DATA <<<--------------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Captures data array as proper markup for jQuery Metadata Plugin
 * 
 * @param 			array $data 
 * @return			string
 */
function g1_data_capture( $data ) {
	$out = '';
	$out .= '{ ';
	
	foreach( $data as $key => $value ) {
		if ( $value === true )
			$out .= $key . ': \'1\',';
		elseif ( $value === false )	
			$out .= $key . ': \'0\',';
		else
			$out .= $key . ': \'' . $value . '\',';	
	}
		
	$out = trim( $out, ',' );		
	$out .= ' }';
		
	return $out;		
}
function g1_data_render( $data ) {
	echo g1_data_capture( $data );
}






/* ------------------------------------------------------------------------- */
/* ---------->>> TEMPLATE PART <<<------------------------------------------ */
/* ------------------------------------------------------------------------- */


// Add a global helper variable
global $_G1;
$_G1[ 'template_part_vars'	]	= array();



/**
 * Sets variables for template part
 * 
 * WordPress function get_template_part() doesn't support passing variables,
 * so we need a way to handle it.   
 */
function g1_part_set_data( $data ) {
    global $_G1;

    $_G1[ 'template_part_data' ] = $data;
}


/**
 * Gets variables for template part
 *
 * WordPress function get_template_part() doesn't support passing variables,
 * so we need a way to handle it.
 */
function g1_part_get_data() {
    global $_G1;

    return $_G1[ 'template_part_data' ];
}


/* ------------------------------------------------------------------------- */
/* ---------->>> SIDEBAR <<<------------------------------------------------ */
/* ------------------------------------------------------------------------- */



/**
 * Gets sidebars as an associative array (id => name)
 * 
 * @return 			array
 */	
function g1_sidebar_get_choices() {
	global $wp_registered_sidebars;
	
    $options = array();
    foreach ( $wp_registered_sidebars as $x )
    	$options[$x['id']] = $x['name'];

    return $options;	
}



/**
 * Renders sidebar.
 * 
 */
function g1_sidebar_render( $s  = 'primary' ) {
	if ( is_active_sidebar( $s ) ) {
		dynamic_sidebar( $s );
		return;
	} elseif( current_user_can( 'administrator' ) ) {
        $helpmode = new G1_Helpmode(
            'empty_sidebar_' . $s,
            __( 'Empty sidebar', 'g1_theme' ),
            '<p>' .
                sprintf( __( 'The "%s" sidebar is empty.', 'g1_theme' ), $s ) . ' ' .
                sprintf( __( 'You should <a href="%s">add some widgets</a> to it.', 'g1_theme' ), network_admin_url( 'widgets.php' ) ) .
            '</p>',
            'warning'
        );

        $helpmode->render();
	}		
}

	
	
/**
 * Sets attribute wmode to transparent
 * 
 * @param 			string $html
 * @param 			string $url
 * @param 			array $attr 
 * @return			string
 */	
function g1_flash_wmode_transparent( $html, $url, $attr ) {
   if ( strpos( $html, '<embed src=' ) !== false) {
    	$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
   }	
   
   return $html;
}
add_filter( 'embed_oembed_html', 'g1_flash_wmode_transparent', 10, 3 );


/**
 * Sets attribute wmode to transparent
 * 
 * @param 			string $html
 * @param 			string $url
 * @param 			array $attr 
 * @return			string
 */	
function g1_youtube_rich_interface( $html, $url, $attr ) {
    $youtube_url = false !== strpos( $url, 'youtube' );
    $y2u_url = false !== strpos( $url, 'y2u' );
    $youtu_url = false !== strpos( $url, 'youtu' );

    if ( !$youtube_url && !$y2u_url && !$youtu_url ) {
        return $html;
    }

	// autohide - indicates whether the video controls will automatically hide after a video begins playing
    // controls - indicates whether the video player controls will display
    // disablekb - setting to 1 will disable the player keyboard controls
    // fs - full screen
    // rel - indicates whether the player should show related videos when playback of the initial video ends.
    // showinfo - if you set the parameter value to 0, then the player will not display information like the video title and uploader before the video starts playing.
    // enablejsapi - setting this to 1 will enable the Javascript API

    $base_params = array(
        'feature=oembed',
        'wmode=transparent',
    );

    $custom_params = array(
        'autohide=2',
        'autoplay=0',
        'disablekb=0',
        'fs=1',
        'loop=0',
        'enablejsapi=1',
        'rel=0',
        'controls=2',
        'showinfo=1',
    );

    $params = array_merge( $base_params, $custom_params );

	$html = str_replace('feature=oembed', implode('&amp;', $params) , $html);

   	return $html;
}
add_filter( 'embed_oembed_html', 'g1_youtube_rich_interface', 10, 3 );

function g1_youtube_simple_interface( $html, $url, $attr ) {
    $youtube_url = false !== strpos( $url, 'youtube' );
    $y2u_url = false !== strpos( $url, 'y2u' );
    $youtu_url = false !== strpos( $url, 'youtu' );

    if ( !$youtube_url && !$y2u_url && !$youtu_url ) {
        return $html;
    }

    $base_params = array(
        'feature=oembed',
        'wmode=transparent',
    );

    $custom_params = array(
        'autohide=1',
        'autoplay=0',
        'disablekb=0',
        'fs=1',
        'loop=0',
        'enablejsapi=1',
        'rel=0',
        'controls=2',
        'showinfo=0',
    );

    $params = array_merge( $base_params, $custom_params );

    $html = str_replace('feature=oembed', implode('&amp;', $params) , $html);

    return $html;
}

function g1_vimeo_simple_interface( $html, $url, $attr ) {
    $vimeo_url = false !== strpos( $url, 'vimeo' );

    if ( !$vimeo_url ) {
        return $html;
    }

    if ( !preg_match( '/src="([^"]+)"/', $html, $matches ) ) {
        return $html;
    }

    $player_url = $matches[1];

    $params = array(
        'title=0',
        'byline=0',
        'portrait=0'
    );

    $player_url_with_params = sprintf( '%s?%s', $player_url, implode( '&amp;', $params ) );

    $html = str_replace($player_url, $player_url_with_params, $html);

    return $html;
}

/**
 * Excerpt length helper
 * 
 * Based on: http://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress
 *
 */
class G1_Excerpt {
  public static $length = 55;

  
  public static function set_length( $v = null ) {
  	$v = absint( $v );
  	if ( $v ) {
    	G1_Excerpt::$length = $v;
  	}	

    add_filter( 'excerpt_length', 'G1_Excerpt::get_length', 999 );
  }

   
  public static function get_length() {    
      return G1_Excerpt::$length;
  }

  
  public static function capture( $length = null ) {
  	G1_Excerpt::set_length( $length );
  	
    return apply_filters( 'the_excerpt', get_the_excerpt() );
  }
  
  public static function render( $length = null ) {
  	echo G1_Excerpt::capture();
  }
}



/**
 * Converts string of coma separated names into an array of true bool values
 * 
 * @param string $string
 * @return array
 */ 
function g1_string_to_bools( $string ) {
	$string = preg_replace( '/[^0-9a-zA-Z,_-]*/', '', $string );
	
	$results = array();
	$bools = explode( ',', $string );
			
	foreach ( $bools as $key => $value )
		$results[$value] = true; 
		
	return $results;
}





/* ------------------------------------------------------------------------- */
/* ---------->>> ENTRY RENDERERS <<<---------------------------------------- */
/* ------------------------------------------------------------------------- */



if ( ! function_exists( 'g1_capture_entry_title' ) ) :
    /**
     * Capture the HTML code with the title based on the title linking method.
     *
     * @param			string $before
     * @param			string $after
     * @return			string
     */
    function g1_capture_entry_title(  $lightbox_group = '', $before = '<h3>', $after = '</h3>' ) {
        global $post;

        $args = array(
            'lightbox_group' => $lightbox_group,
            'before' => $before,
            'after' => $after,
        );

        // Apply custom filters
        $args = apply_filters( 'g1_capture_entry_title_args', $args );
        $link = apply_filters( 'the_permalink', get_permalink() );

        if ( get_post_format($post) === 'link' ) {
            // handle WP 3.6
            $link_url = get_post_meta( $post->ID, '_format_link_url', true );

            // try to find link in content
            if ( empty($link_url) ) {
                $link_url = get_content_url($post->post_content);
            }

            // if link was found
            if ( !empty($link_url) ) {
                $link = $link_url;
            }
        }

        $class = '';
        $title = $title = the_title_attribute( 'echo=0' );

        $out = '';
        $out .= $args['before'];
        if ( !empty( $link ) ) {
            $out .= '<a href="' . esc_url( $link ) . '" ';
            $out .= strlen( $class ) ? 'class="' . esc_attr( $class ) . '" ' : '';
            $out .= strlen( $title ) ? 'title="' . esc_attr( $title ) . '" ' : '';
            $out .= '>';
        }
        $out .= the_title('', '', false);
        $out .= !empty( $link ) ? '</a>' : '';
        $out .= $args['after'];

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_title' ) ) :
    function g1_render_entry_title( $lightbox_group = '', $before = '<h3>', $after = '</h3>' ) {
        echo g1_capture_entry_title( $lightbox_group, $before, $after );
    }
endif;

if ( ! function_exists( 'g1_capture_post_audio' ) ) :
    /**
     * Captures the HTML code for the audio post format
     *
     * @param   Post ID $post_id
     * @param   string $size Image size name
     *
     * @return  string
     */
    function g1_capture_post_audio ( $post_id, $size ) {
	$out = '';
        $url_embed = get_post_meta( $post_id, '_format_audio_embed', true );

	if ( empty( $url_embed ) ) {
	    $post = get_post($post_id);
	    $url_embed = get_content_url($post->post_content);
	}

	if ( !empty( $url_embed ) ) {
	    $is_html_code = is_html_code($url_embed);
            $is_mp3 = !$is_html_code && (false !== strpos($url_embed, '.mp3'));

	    list ( $width, $height ) = g1_get_image_dimensions( $size );

    	    // resolve what type of content was used
            if ( $is_mp3 ) {
	        $out = '[audio_player mp3="'. $url_embed .'"]';
    	    } else if ( !$is_html_code ) {
        	global $wp_embed;
                $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url_embed ) . '[/embed]') ;

	        $out = $embed;
    	    } else {
        	$out = $url_embed;
    	    }
	}

        return $out;
    }
endif;

if ( ! function_exists( 'g1_capture_post_video' ) ) :
    /**
     * Captures the HTML code for the video post format
     *
     * @param   Post $post
     * @param   string $size Image size name
     *
     * @return  string
     */
    function g1_capture_post_video ( $post_id, $size ) {
	$out = '';
        $url_embed = get_post_meta( $post_id, '_format_video_embed', true );
	$post = get_post($post_id);

	if ( empty( $url_embed ) ) {
	    if ( preg_match('/^http:\/\/[^\s]+/', $post->post_content, $matches) ) {
		$url_embed = $matches[0];
	    }
	}

	if ( empty( $url_embed ) ) {
	    if ( preg_match('/^\[.+\]/', $post->post_content, $matches) ) {
		$url_embed = $matches[0];
	    }
	}
	
	if ( !empty( $url_embed ) ) {
            list ($width, $height) = g1_get_image_dimensions($size);

    	    if ( is_html_code( $url_embed ) ) {
        	$out = '[fluid_wrapper width="'. $width .'" height="'. $height .'"]'. $url_embed .'[/fluid_wrapper]';
            } else {
	        global $wp_embed;
    	        $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url_embed ) . '[/embed]') ;

        	$out = $embed;
    	    }
	}

        return $out;
    }
endif;




function g1_get_post_format_gallery( $id, $size ) {
    $post = get_post( $id );
    if ( empty( $post ) ) {
        return array();
    }

    $arr = array();

    $query_args = array(
        'order'          => 'ASC',
        'post_type'      => 'attachment',
        'post_parent'    => $post->ID,
        'post_mime_type' => 'image',
        'post_status'    => null,
        'numberposts'    => -1,
    );
    $attachments = get_posts($query_args);

    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            $item = array();

            $temp = wp_get_attachment_image_src( $attachment->ID, $size );

            $item['url'] = $temp[0];
            $item['width'] = $temp[1];
            $item['height'] = $temp[2];

            $arr[] = $item;
        }
    }
    return $arr;
}



if ( ! function_exists( 'g1_capture_entry_featured_media' ) ) :
    /**
     * Captures the HTML code with the featured media based on featured media linking method.
     *
     * @param				array $args
     * @return				string
     */
    function g1_capture_entry_featured_media( $args ) {
        // Prepare arguments
        $defaults = array(
            'size'              => '',
            'lightbox_group'    => '',
            'force_placeholder' => true,
        );
        $r = wp_parse_args( $args, $defaults );

        /* We need a static counter to generate unique ids for inline lightboxes */
        static $inline_lightbox_counter = 0;

        global $post;

        $url = '';
        $linking = '';
        $holder = '';
        $placeholder = '';
        $out = '';

        // Try to return a placeholder when an entry is password protected
        if ( post_password_required( $post ) ) {
            if ( !$r['force_placeholder'] ) {
                return '';
            }

            $out = sprintf( '[placeholder icon="lock" size="%s"]', $r['size'] );
        }
        // Try to return a placeholder when there is no featured media
        else {
            $post_format = get_post_format( $post->ID );

            switch ( $post_format ) {
                case 'audio':
                    $audio = g1_capture_post_audio( $post->ID, $r['size'] );
                    $audio = do_shortcode( $audio );

                    $js_id = 'g1_var_' . rand();
                    $js =   '<script id="' . esc_attr( $js_id ) . '" class="g1-var">' .
                                'var ' . $js_id .' = ' . json_encode( array('html_code' => $audio) ) . ';' .
                            '</script>';

                    // Thumbnail image triggers an inline lightbox with the audio player
                    if ( has_post_thumbnail( $post->ID ) ) {
                        $thumb = get_the_post_thumbnail( $post->ID, $r['size'] );

                        // Compose the template
                        $out =  '<figure class="entry-featured-media">' .
                                    '[frame link="%LINK%"]' .
                                        '%THUMB%' .
                                    '[/frame]' .
                                    $js .
                                '</figure>';

                        // Fill in the template
                        $out = str_replace(
                            array(
                                '%LINK%',
                                '%THUMB%',
                            ),
                            array(
                               '#',
                                $thumb,
                            ),
                            $out
                        );
                    }
                    // The audio player
                    else {
                        if ( $r['force_placeholder'] ) {
                            $placeholder = '[placeholder size="' . $r['size'] . '"]';
                        }

                        $out =  '<figure class="entry-featured-media">' .
                                    $audio .
                                    $placeholder .
                                    $js .
                                '</figure>';
                    }

                    break;


                case 'image':
                    // Thumbnail image triggers the full version
                    if ( has_post_thumbnail( $post->ID ) ) {
                        $thumb = get_the_post_thumbnail( $post->ID, $r['size'] );

                        $image = get_post_meta( $post->ID, '_format_image', true );
                        // @todo get url from $image
                        $url = $image;

                        if ( !strlen( $url) ) {
                            $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                            $url = $url[0];
                        }

                        // Compose the template
                        $out =  '<figure class="entry-featured-media">' .
                                    '[frame link="%LINK%"]' .
                                        '%THUMB%' .
                                    '[/frame]' .
                                '</figure>';

                        // Fill in the template
                        $out = str_replace(
                            array(
                                '%LINK%',
                                '%THUMB%',
                            ),
                            array(
                                $url,
                                $thumb,
                            ),
                            $out
                        );
                    }
                    
		            // WP 3.6 post format
                    if ( empty($out) ) {
                        $image = get_post_meta( $post->ID, '_format_image', true );

                        if ( !empty( $image ) ) {
                            if ( is_html_code( $image ) ) {
                            $out =  '<figure class="entry-featured-media">' .
                                                        $image .
                                                '</figure>';
                            } else {
                                $out =  '<figure class="entry-featured-media">' .
                                            '<img src="'. $image .'" alt="'. $post->post_title .'" />' .
                                                '</figure>';
                            }
                        }
                    }
		    
		            // post fromat < WP 3.6
		            if ( empty($out) ) {
                        // first img tag
                        $img_tag = G1_Post_Format::find_html_tag('img', $post->post_content);

                        // first link tag
                        $url = get_content_url($post->post_content);

                        if ( !empty($img_tag) ) {
                            $out =  '<figure class="entry-featured-media">' .
                                        $img_tag .
                                                '</figure>';
                        } else if ( !empty($url) ) {
                            $out =  '<figure class="entry-featured-media">' .
                                        '<img src="'. $url .'" alt="'. $post->post_title .'" />' .
                                                '</figure>';
                        }
		            }

                    break;


                case 'gallery':
                    // Thumbnail image triggers the full gallery
                    if ( has_post_thumbnail( $post->ID ) ) {

                        $thumb = get_the_post_thumbnail( $post->ID, $r['size'] );
                        $url = apply_filters( 'the_permalink', get_permalink( $post->ID ) );

                        $items = g1_get_post_format_gallery( $post->ID, 'full' );

                        // Compose gallery as a list of links
                        $gallery_data = '';
                        foreach ( $items as $item ) {
                            $gallery_data .= str_replace(
                                array(
                                    '%URL%',
                                    '%WIDTH%',
                                    '%HEIGHT%',
                                ),
                                array(
                                    esc_url( $item['url'] ),
                                    absint( $item['width'] ),
                                    absint( $item['height'] ),
                                ),
                                '<li><a href="%URL%" data-g1-width="%WIDTH%" data-g1-height="%HEIGHT%"></a></li>'
                            );
                        }

                        // Compose the template
                        $out =  '<figure class="entry-featured-media">' .
                                    '[frame link="%LINK%"]' .
                                    '%THUMB%' .
                                    '[/frame]' .
                                    '<ul class="g1-gallery-data">' .
                                        '%GALLERY_DATA%' .
                                    '</ul>' .
                                '</figure>';

                        // Fill in the template
                        $out = str_replace(
                            array(
                                '%LINK%',
                                '%THUMB%',
                                '%GALLERY_DATA%',
                            ),
                            array(
                                esc_url( $url ),
                                $thumb,
                                $gallery_data,
                            ),
                            $out
                        );
                    }
                    // The full gallery
                    else {
                        $items = g1_get_post_format_gallery( $post->ID, $r['size'] );

                        $gallery = '';
                        foreach ( $items as $item ) {
                            $gallery .= str_replace(
                                array(
                                    '%URL%',
                                    '%WIDTH%',
                                    '%HEIGHT%',
                                ),
                                array(
                                    esc_url( $item['url'] ),
                                    absint( $item['width'] ),
                                    absint( $item['height'] ),
                                ),
                                '<li><img src="%URL%" width="%WIDTH%" height="%HEIGHT%" alt=""/></li>'
                            );
                        }

                        // Compose gallery as a list of links
                        $items = g1_get_post_format_gallery( $post->ID, 'full' );
                        $gallery_data = '';

                        foreach ( $items as $item ) {
                            $gallery_data .= str_replace(
                                array(
                                    '%URL%',
                                    '%WIDTH%',
                                    '%HEIGHT%',
                                ),
                                array(
                                    esc_url( $item['url'] ),
                                    absint( $item['width'] ),
                                    absint( $item['height'] ),
                                ),
                                '<li><a href="%URL%" data-g1-width="%WIDTH%" data-g1-height="%HEIGHT%"></a></li>'
                            );
                        }

                        $out =  '<figure class="entry-featured-media">' .
                                    '<ul class="g1-gallery-items">' .
                                    $gallery .
                                    '</ul>' .
                                    '<ul class="g1-gallery-data">' .
                                        $gallery_data .
                                    '</ul>' .
                                '</figure>';
                    }

                    break;


                case 'video':
                    $big_video = g1_capture_post_video( $post->ID, 'g1_max' );
                    $big_video = do_shortcode( $big_video );

                    $js_id = 'g1_var_' . rand();
                    $js =   '<script id="' . esc_attr( $js_id ) . '" class="g1-var">' .
                                'var ' . $js_id .' = ' . json_encode( array('html_code' => $big_video) ) . ';' .
                            '</script>';

                    // Thumbnail image triggers the video
                    if ( has_post_thumbnail( $post->ID ) ) {
                        $thumb = get_the_post_thumbnail( $post->ID, $r['size'] );

                        // Compose the template
                        $out =  '<figure class="entry-featured-media">' . "\n" .
                                    '[frame link="%LINK%"]' .
                                        '%THUMB%' .
                                    '[/frame]' .  "\n" .
                                    $js .
                                '</figure>';

                        $embed = get_post_meta( $post->ID, '_format_video_embed', true );
                        if ( false === strpos($embed, 'http://') && false === strpos($embed, 'https://') ) {
                            $embed = the_permalink($post->ID);
                        }

                        // Fill in the template
                        $out = str_replace(
                            array(
                                '%LINK%',
                                '%THUMB%',
                            ),
                            array(
                                esc_url( $embed ),
                                $thumb,
                            ),
                            $out
                        );
                    }
                    // The video
                    else {
                        $small_video = g1_capture_post_video( $post->ID, $r['size'] );
                        $small_video = do_shortcode( $small_video );

                        $out =  '<figure class="entry-featured-media">' .
                                    $small_video .
                                    $js .
                                '</figure>';
                    }

                    break;

                case 'link':
                    $linking = 'new-window';

                    // first link tag
                    $url = get_content_url($post->post_content);

                default:
                    if ( !has_post_thumbnail( $post->ID ) ) {
                        if ( !$r['force_placeholder'] ) {
                            return '';
                        }

                        $placeholder = sprintf( '[placeholder size="%s" icon="post-format"]', $r['size'] );
                    } else {
                        $holder = get_the_post_thumbnail( $post->ID, $r['size'] );
                    }

                    if ( empty($url) ) {
                        $has_url = get_the_post_format_url( $post->ID );

                        $url = $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
                    }

                    // Compose the template
                    $out = '<figure class="entry-featured-media">' . "\n" .
                                '[frame link="%LINK%" linking="%LINKING%"]' .
                                    '%HOLDER%' .
                                    '%PLACEHOLDER%' .
                                '[/frame]' .  "\n" .
                            '</figure>';

                    // Fill in the template
                    $out = str_replace(
                        array(
                            '%LINK%',
                            '%LINKING%',
                            '%HOLDER%',
                            '%PLACEHOLDER%',
                        ),
                        array(
                            $url,
                            $linking,
                            $holder,
                            $placeholder,
                        ),
                        $out
                    );

                    break;
            }
        }

        // Apply shortcodes
        $out = do_shortcode( $out );

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_featured_media' ) ) :
    function g1_render_entry_featured_media( $args ) {
        echo g1_capture_entry_featured_media( $args );
    }
endif;



if ( ! function_exists( 'g1_render_entry_media_box' ) ) :
/**
 * Renders the HTML code with the mediabox for the current entry.
 */
function g1_render_entry_media_box( $args ) {
    $defaults = array(
        'type' => 'list',
        'force_placeholder' => true
    );

    $args = wp_parse_args($args, $defaults);

    if ( $args['type'] === true ) {
        $args['type'] = 'list';
    }

    extract($args);

    switch ( $type ) {
        case 'list':
            // Our tricky way to pass variables to a template part
            g1_part_set_data( $args );
            get_template_part( 'template-parts/g1_media_box' );
            break;

        case 'featured_media':
        case 'featured-media':
            g1_part_set_data( $args );
            get_template_part( 'template-parts/g1_media_box', 'featured_media' );
            break;

        default:
            do_action( 'g1_mediabox', $args );
    }
}
endif;



if ( ! function_exists( 'g1_capture_entry_summary' ) ) :
    /**
     * Captures the HTML code with the summary for the current entry.
     */
    function g1_capture_entry_summary( $words = null, $type = 'excerpt' ) {
        global $_G1;

        $words = absint( $words );

        $out = '';

        $out .= '<div class="entry-summary">';
        if ( $words ) {
            $out .= G1_Excerpt::capture( $words );
        } else {
            switch ( $type ) {
                case 'excerpt':
                    $out .= apply_filters( 'the_excerpt', get_the_excerpt() );
                    break;

                case 'full':
                    $content = get_the_content();
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]&gt;', $content);
                    $out .= $content;
                    break;

                case 'cut-off':
                    global $post;

                    $hasMoreTag = false !== strpos($post->post_content, '<!--more-->');

                    if (!$hasMoreTag) {
                        $out .= apply_filters( 'the_excerpt', get_the_excerpt() );
                    } else {
                        $content = get_the_content('');
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        $out .= $content;
                    }
                    break;
            }
        }

        $out .= '</div>';

        $_G1[ 'excerpt_length' ] = null;

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_summary' ) ) :
    function g1_render_entry_summary( $words = null, $type = 'excerpt' ) {
        echo g1_capture_entry_summary( $words, $type );
    }
endif;



if ( ! function_exists( 'g1_capture_entry_date' ) ) :
    /**
     * Captures the HTML code with the date for the current entry
     */
    function g1_capture_entry_date( $d = '' ) {
        $d = !strlen( $d ) ? get_option( 'date_format' ) : $d;

        $out =  '<time itemprop="datePublished" datetime="' . esc_attr( get_the_time( 'Y-m-d') . 'T' . get_the_time( 'H:i:s') ) . '" class="entry-date">' .
                    apply_filters( 'the_time', get_the_time( $d ), $d ) .
                '</time>';

        return $out;
    }
endif;
if ( ! function_exists( 'g1_entry_render_date' ) ) :
    function g1_render_entry_date( $d = '' ) {
        echo g1_capture_entry_date( $d );
    }
endif;



if ( ! function_exists( 'g1_render_entry_author' ) ) :
    /**
     * Renders the HTML code with the author link for the current entry
     */
    function g1_render_entry_author() {
        ?>
    <span class="entry-author"><?php _e('by', 'g1_theme'); ?> <?php the_author_posts_link(); ?></span>
    <?php
    }
endif;



if ( ! function_exists( 'g1_render_entry_comments_link' ) ) :
    /**
     * Renders the HTML code with the comments link for the current entry
     */
    function g1_render_entry_comments_link() {
        ?>
    <span class="entry-comments-link">
    	<?php
        comments_popup_link(
            __('0 <span>Comments</span>', 'g1_theme'),
            __('1 <span>Comment</span>', 'g1_theme'),
            __('% <span>Comments</span>', 'g1_theme'),
            '',
            __('Comments are off', 'g1_theme')
        );
        ?>
    </span>
    <?php
    }
endif;



if ( ! function_exists( 'g1_capture_entry_categories' ) ) :
    /**
     * Captures the HTML with all hierarchical categories for the current entry.
     */
    function g1_capture_entry_categories() {
        global $post;

        $taxonomy_objects = get_object_taxonomies( $post, 'objects' );

        // Remove non-public and hierarchical taxonomies
        foreach ( $taxonomy_objects as $name => $object ) {
            if ( !$object->query_var || !$object->hierarchical ) {
                unset( $taxonomy_objects[$name] );
            }
        }

        $count = count( $taxonomy_objects );

        $out = '';
        foreach ( $taxonomy_objects as $object ) {
            $list = get_the_term_list( $post->ID, $object->name, '<ul><li>', '</li><li>', '</li></ul>' );

            if ( !empty( $list ) ) {
                $label = ( $count > 1 ) ? $object->labels->name: __( 'Posted in:', 'g1_theme' ) ;

                $out .= '<div>' .
                            '<span>' . $label . '</span>' .
                            get_the_term_list( $post->ID, $object->name, '<ul><li>', '</li><li>', '</li></ul>' ) .
                        '</div>';
            }
        }

        if ( !empty( $out ) ) {
            $out =  '<div class="entry-categories">' .
                        $out .
                    '</div>';
        }

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_categories' ) ) :
    function g1_render_entry_categories() {
        echo g1_capture_entry_categories();
    }
endif;



if ( ! function_exists( 'g1_capture_entry_tags' ) ) :
    /**
     * Captures the HTML with all non-hierarchical taxonomies for the current entry.
     */
    function g1_capture_entry_tags() {


        global $post;

        $taxonomy_objects = get_object_taxonomies( $post, 'objects' );

        // Remove non-public and hierarchical taxonomies
        foreach ( $taxonomy_objects as $name => $object ) {
            if ( !$object->query_var || $object->hierarchical ) {
                unset( $taxonomy_objects[$name] );
            }
        }
        // Remove post formats
        unset( $taxonomy_objects['post_format'] );

        $count = count( $taxonomy_objects );

        $out = '';
        foreach ( $taxonomy_objects as $object ) {
            $list = get_the_term_list( $post->ID, $object->name, '<ul><li>', '</li><li>', '</li></ul>' );

            if ( !empty( $list ) ) {
                $label = ( $count > 1 ) ? $object->labels->name: __( 'Tagged with:', 'g1_theme' ) ;

                $out .= '<div>' .
                            '<span>' . $label . '</span>' .
                            get_the_term_list( $post->ID, $object->name, '<ul><li>', '</li><li>', '</li></ul>' ) .
                        '</div>';
            }
        }

        if ( !empty( $out ) ) {
            $out =  '<div class="entry-tags">' .
                        $out .
                    '</div>';
        }

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_tags' ) ) :
    function g1_render_entry_tags() {
        echo g1_capture_entry_tags();
    }
endif;



if ( ! function_exists( 'g1_capture_entry_button_1' ) ) :
    /**
     * Captures the HTML with the primary button for the current entry
     */
    function g1_capture_entry_button_1( $args = array() ) {
        global $post;

        $defaults = array(
            'size' => 'small',
            'link' => apply_filters( 'the_permalink', get_permalink() )
        );
        $args = wp_parse_args($args, $defaults);

        $atts = '';

        foreach ( $args as $key => $value ) {
            $atts .= $key . '="' . $value . '" ';
        }

        echo do_shortcode( '[button ' . $atts . ']' . __( 'More', 'g1_theme' ) . '[/button]');
    }
endif;
if ( ! function_exists( 'g1_render_entry_button_1' ) ) :
    function g1_render_entry_button_1( $args = array() ) {
        echo g1_capture_entry_button_1( $args );
    }
endif;



if ( ! function_exists( 'g1_capture_entry_filters' ) ) :
    /**
     * Captures the HTML with the isotope filters for the current entry
     *
     * since			1.1.0
     */
    function g1_capture_entry_filters( $taxonomies ) {
        global $post;

        $filters = array();

        foreach ( $taxonomies as $taxonomy ) {
            $terms = get_the_terms( $post->ID, $taxonomy );

            if ( $terms && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $filters[] = 'filter-' . $term->term_id;
                }
            }
        }

        $filters = implode( ' ', $filters );

        return $filters;
    }
endif;
if ( ! function_exists( 'g1_render_entry_filters' ) ) :
    function g1_render_entry_filters( $taxonomies ) {
        echo g1_capture_entry_filters( $taxonomies );
    }
endif;



if ( ! function_exists( 'g1_capture_entry_flags' ) ) :
    /**
     * Captures the HTML with all flags for the current entry
     *
     * since			1.1.0
     */
    function g1_capture_entry_flags() {
        global $post;

        $out = '';

        if ( is_sticky() ) {
            $out .= '<li class="g1-flag-sticky">' .
                        '<span title="' . __( 'Featured entry', 'g1_theme' ) . '">' .
                            __( 'Featured entry', 'g1_theme' ) .
                        '</span>' .
                    '</li>';
        }

        $out .= '<li class="g1-flag-post-format">' .
                    '<span title="' . esc_attr( sprintf( __('Post format: %s', 'g1_theme'), get_post_format() ) ) . '">' .
                        get_post_format() .
                    '</span>' .
                 '</li>';

        $out =  '<ul class="g1-flags">' .
                    $out .
                '</ul>';

        return $out;
    }
endif;
if ( ! function_exists( 'g1_render_entry_flags' ) ) :
    function g1_render_entry_flags() {
        echo g1_capture_entry_flags();
    }
endif;





function g1_capture_entry_itemtype( $args = array()) {
    return 'http://schema.org/BlogPosting';
}

function g1_render_entry_itemtype( $args = array()) {
    echo g1_capture_entry_itemtype( $args );
}