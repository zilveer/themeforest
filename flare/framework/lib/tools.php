<?php
/**
 * This file is part of the BTP_Framework package.
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
 * @package BTP_Framework
 * @subpackage BTP_Tools 
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> PHP MISSING FUNCTIONS <<<---------------------------------- */
/* ------------------------------------------------------------------------- */



if ( ! function_exists( 'array_multimerge' ) ) :
/**
 * Merge multidimensional arrays
 * 
 * @param 			array $a1
 * @param 			array $a2
 * @return			array
 */
function array_multimerge( $a1, $a2 ) {
	foreach( $a2 as $k2 => $v2 ) {
		if ( !isset ( $a1[ $k2 ] ) ) {
    		$a1[ $k2 ] = $v2;
    	} else {
		   	if ( is_array( $v2 ) && is_array( $a1[ $k2 ] ) ){
		    	$a1[ $k2 ] = array_multimerge( $a1[ $k2 ], $v2 );
		    } else{
		    	$a1[ $k2 ] = $v2;
		    }
    	}
	}	
    return $a1;
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


if ( ! function_exists( 'add_taxonomy_support' ) ) :
/**
 * Registers support of certain features for a taxonomy
 * 
 * @param 			string $taxonomy The taxonomy for which to add the feature
 * @param 			string|array $feature the feature being added, can be an array of feature strings or a single string
 */
function add_taxonomy_support( $taxonomy, $feature ) {
	global $_BTP;
	if ( empty( $_BTP[ 'taxonomy_features' ] ) ) {
		$_BTP[ 'taxonomy_features' ] = array();
	}	

    $features = (array) $feature;
    foreach ( $features as $feature ) {
    	if ( func_num_args() == 2 ) {
    		if ( !isset( $_BTP[ 'taxonomy_features' ][ $taxonomy ] ) ) {
    			$_BTP[ 'taxonomy_features' ][ $taxonomy ] = array();
    		} 
    		
	    	$_BTP[ 'taxonomy_features' ][ $taxonomy ][ $feature ] = true;
	    }
    }	    
}
endif;



if ( ! function_exists( 'taxonomy_supports' ) ) :
/**
 * Checks a taxonomy's support for a given feature
 *
 * @param 			string $taxonomy The taxonomy being checked
 * @param 			string $feature the feature being checked
 * @return 			boolean
 */
function taxonomy_supports( $taxonomy, $feature ) {
	global $_BTP;
	
    if ( 
    	empty( $_BTP[ 'taxonomy_features' ] ) || 
    	empty( $_BTP[ 'taxonomy_features' ][ $taxonomy ] ) ||
    	empty( $_BTP[ 'taxonomy_features' ][ $taxonomy ][ $feature ] )
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
 * @param 			mixed $classes
 * @param 			string $fallback
 * @return			string
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
function btp_wp_link_pages($args = '') {
	$defaults = array(
    	'before' => '<p>' . __( 'Pages:', 'btp_theme' ), 
    	'after' => '</p>',
		'current_before' => '',
		'current_after'	=> '',
        'link_before' => '', 
        'link_after' => '',
        'next_or_number' => 'number', 
        'nextpagelink' => __( 'Next page', 'btp_theme' ),
        'previouspagelink' => __( 'Previous page', 'btp_theme' ), 
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




/**
 * Gets breadcrumbs for the current context.
 * 
 * If you want to add/delete some choices, hook into the btp_breadcrumbs custom filter.
 *  
 * @return array 
 */
function btp_breadcrumbs_get() {
	global $post;
	
	$breadcrumbs = array();
	$breadcrumbs[] = array(
		'href'		=> home_url( '/' ),
		'text'		=> __( 'Home', 'btp_theme' )
	);
	
	/* Blog Page */
	if ( is_home() && !is_front_page() ) {
		$id = intval( btp_theme_get_option_value( 'post_index_page' ) );
		
		/* WPML fallback */
	 	if ( function_exists( 'icl_object_id' ) ) {
    		$id = icl_object_id( $id, 'page', true );
  	 	}
		
		if ( $id ) {
			$href = get_permalink( $id );
			$text = get_the_title( $id );
		
			$breadcrumbs[] = array( 
				'href' => $href,
				'text' => $text,
			);
		}	
	} elseif ( is_singular() ) {
		if ( !is_page() ) {
			if( 'post' == get_post_type() ) {
				$id = intval( btp_theme_get_option_value( 'post_index_page' ) );
				$home_id = intval( btp_theme_get_option_value( 'page_home_page' ) );

				/* WPML fallback */
	 			if ( function_exists( 'icl_object_id' ) ) {
    				$id = icl_object_id( $id, 'page', true );
    				$home_id = icl_object_id( $home_id, 'page', true );
  	 			}
				
				if ( $id && $id != $home_id ) {
					$href = get_permalink( $id );
					$text = get_the_title( $id );
					
					$breadcrumbs[] = array(
						'href' => $href,
						'text' => $text,
					);
				}	
			} elseif( !is_attachment() ) {
				$post_type_obj = get_post_type_object( get_post_type() );
				$href = get_post_type_archive_link( get_post_type() );
        		$text = apply_filters('post_type_archive_title', $post_type_obj->labels->name, get_post_type() );
		
				$breadcrumbs[] = array( 
					'href' => $href,
					'text' => $text,
				);
			}	
		}		
		
		/* Add subpages if any */
		if ( $post->post_parent ) {
      		$parent_id  = $post->post_parent;
      		$parent_breadcrumbs = array();
      		while ( $parent_id ) {
        		$page = get_page($parent_id);
        		$parent_breadcrumbs[] = array(
        			'href'	=> get_permalink( $page->ID ),
        			'text'	=> get_the_title( $page->ID )
      			);
        		$parent_id  = $page->post_parent;
      		}

      		$parent_breadcrumbs = array_reverse( $parent_breadcrumbs );
      		
      		$breadcrumbs = array_merge( $breadcrumbs, $parent_breadcrumbs );
		}
		
		/* Add the current page */
		$breadcrumbs[] = array(
			'href'	=>	get_permalink( $post->ID ),	
			'text'	=>	get_the_title( $post->ID )
		);
	} elseif ( is_post_type_archive() ) {
		$href = get_post_type_archive_link( get_post_type() ); 						
        $text = post_type_archive_title( '', false );
        
        $breadcrumbs[] = array(
			'href'	=>	$href,	
			'text'	=>	$text,
		);		
	} elseif ( is_category() ) {
        $category_id = get_query_var('cat');
        $category = get_category( $category_id);

        /* Temporary array for the current category and parents (if any) */
        $temp = array();

        while ( $category_id ) {
            $temp[] = array(
                'href'	=> get_category_link( $category_id ),
                'text'	=> get_cat_name( $category_id )
            );

            /* Check for a parent category */
            if ( $category->category_parent ) {
                $category_id = $category->category_parent;
                $category = get_category( $category_id );
            } else {
                $category_id = 0;
            }
        }

        if ( count( $temp ) ) {
            $temp = array_reverse( $temp );
            $temp[0]['text'] = sprintf(__('%s', 'btp_theme'), $temp[0]['text']);
        }

        /* Merge with temporary array */
        $breadcrumbs = array_merge( $breadcrumbs, $temp );

	} elseif( is_tag() ) {
		$breadcrumbs[] = array(
			'href' => '',
			'text' => sprintf( __( 'Tag Archives: %s', 'btp_theme' ), single_term_title( '', false ) ),
		);
	} elseif( is_tax() ) {
        $term = get_queried_object();
        $term_id = $term->term_id;

        /* Temporary array for the current term and parents (if any) */
        $temp = array();

        while ( $term_id ) {
            $temp[] = array(
                'href'	=> get_term_link( $term ),
                'text'	=> $term->name
            );

            /* Check for a parent term */
            if ( $term->parent ) {
                $term_id = $term->parent;
                $term = get_term_by( 'id', $term_id,  $term->taxonomy );
            } else {
                $term_id = 0;
            }
        }

        if ( count( $temp ) ) {
            $temp = array_reverse( $temp );
        }

        /* Merge with temporary array */
        $breadcrumbs = array_merge( $breadcrumbs, $temp );

	} elseif ( is_year() ) {
		$breadcrumbs[] = array(
      		'href' => '',
      		'text' => get_the_time( 'Y' )
      	);
	} elseif ( is_month() ) {
		$breadcrumbs[] = array(
      		'href' => get_year_link( get_the_time( 'Y' ) ),
      		'text' => get_the_time( 'Y' )
      	);
      	
      	$breadcrumbs[] = array(
      		'href' => '',
      		'text' => get_the_time( 'F' )
      	);      	
	} elseif ( is_day() ) {
		$breadcrumbs[] = array(
      		'href' => get_year_link( get_the_time( 'Y' ) ),
      		'text' => get_the_time( 'Y' )
      	);
      	
      	$breadcrumbs[] = array(
      		'href' => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
      		'text' => get_the_time( 'F' )
      	);
      	
      	$breadcrumbs[] = array(
      		'href' => '',
      		'text' => get_the_time( 'd' )
      	);      	
	} elseif ( is_author() ) {			
		$curauth = null;
		if ( get_query_var( 'author_name' ) )
			$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );			
		
		if ( get_query_var( 'author' ) )
			$curauth = get_user_by( 'id', get_query_var( 'author' ) );
		
		$breadcrumbs[] = array(
			'href' => '',
			'text' => sprintf( __( 'Author Archives: %s', 'btp_theme' ), $curauth->display_name )
		);
	} elseif ( is_search() ) {
		$breadcrumbs[] = array(
			'href' => '',
			'text' => __( 'Search results', 'btp_theme' )
		);	
	} elseif ( is_404() ) {
		$breadcrumbs[] = array(
			'href' => '',
			'text' => __( '404 - page not found', 'btp_theme' )
		);	
	}		
	
	/* Call the functions added to a filter hook */
	$breadcrumbs = apply_filters( 'btp_breadcrumbs', $breadcrumbs ); 

	
	/* Remove duplicated hrefs */
	$uniques = array();	
	foreach ( $breadcrumbs as $k => $v ) {		
		if ( in_array( $v[ 'href' ], $uniques ) ) {
			unset( $breadcrumbs[ $k ] );
		} else {
			$uniques[] = $v[ 'href' ];
		}
	}	
	/* Re-index array */
	$breadcrumbs = array_values( $breadcrumbs );
	
	return $breadcrumbs;
}
	


/**
 * Captures breadcrumbs navigation markup
 * 
 * @param 			array $breadcrumbs
 * @param 			string $separator
 * @return			string
 */
function btp_breadcrumbs_capture( $breadcrumbs = null, $separator = ' &rsaquo; ' ) {
	if ( null === $breadcrumbs )
		$breadcrumbs = btp_breadcrumbs_get(); 

	/* Compose output */
	$out = '';	
	
	$counter = count( $breadcrumbs );
	if ( $counter ) {		
		$out .= '<nav class="breadcrumbs"><p class="meta">' . __( 'You are here: ', 'btp_theme' );
		
		for ( $i = 0; $i < $counter; $i++ ) {
			if ( $i == ( $counter - 1 ) )
				$out .= '<strong>' . $breadcrumbs[$i]['text'] . '</strong> ';
			else
				$out .= '<a href="' . $breadcrumbs[$i]['href'] . '">' . $breadcrumbs[$i]['text'] . '</a>' . $separator;
		}		
		$out .= '</p></nav>';
	}

	return $out;
}
function btp_breadcrumbs_render( $breadcrumbs = null, $separator = ' &rsaquo; ' ){
	echo btp_breadcrumbs_capture( $breadcrumbs, $separator );	
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
function btp_data_capture( $data ) {
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
function btp_data_render( $data ) {
	echo btp_data_capture( $data );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> LOOP <<<--------------------------------------------------- */
/* ------------------------------------------------------------------------- */


/* Add a global helper variable */
global $_BTP;
$_BTP[ 'temp_context' ]			= array();


/**
 * Stores the current context before the custom loop *  
 */
function btp_loop_before() {
	global $post;
	global $_BTP;	
	
	/* Save current post object for further operations */
	if ( $post ) {
		$_BTP[ 'temp_context' ][ 'post' ] = clone $post;
	} else {
		$_BTP[ 'temp_context' ][ 'post' ] = $post;
	}		
}



/**
 * Restores the original context after the custom loop
 */
function btp_loop_after() {
	global $post;
	global $_BTP;		
	
	/* Back to current post */
	if ( $_BTP[ 'temp_context' ][ 'post' ] ) {	
		$post = $_BTP[ 'temp_context' ][ 'post' ];	
		setup_postdata( $post );
	} else {
		$post = $_BTP[ 'temp_context' ][ 'post' ];	
	}	
}



/* ------------------------------------------------------------------------- */
/* ---------->>> TEMPLATE PART <<<------------------------------------------ */
/* ------------------------------------------------------------------------- */


/* Add a global helper variable */
global $_BTP;
$_BTP[ 'template_part_vars'	]	= array();



/**
 * Sets variables for template part
 * 
 * WordPress function get_template_part() doesn't support passing variables,
 * so we need a way to handle it.   
 */
function btp_part_set_vars( $array ) {
	global $_BTP;
	
	$_BTP[ 'template_part_vars' ] = $array;
}



/**
 * Gets variables for template part
 * 
 * WordPress function get_template_part() doesn't support passing variables,
 * so we need a way to handle it.   
 */
function btp_part_get_vars() {
	global $_BTP;
		
	return $_BTP[ 'template_part_vars' ];
}



/* ------------------------------------------------------------------------- */
/* ---------->>> HELP MODE <<<---------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Captures Help Mode markup
 * 
 * @param 			string $title
 * @param 			string $content
 * @param 			string $type
 * @return			string
 */
function btp_helpmode_capture( $title, $content, $type = 'error' ) {
	$out = '';

	if ( !current_user_can( 'administrator' ) || 'standard' !== btp_theme_get_option_value( 'general_help_mode' ) ) {
		return $out;
	}

	$out .= '<div class="help-mode ' . sanitize_html_class( 'help-mode-' . $type ) . '">';
		$out .= '<div class="help-mode-title"><span></span>' . esc_html( $title ) . '</div>';
		$out .= '<div class="help-mode-content">';
			$out .= $content;
		$out .= '</div>';
	$out .= '</div>';
	
	return $out;
}
function btp_helpmode_render( $title, $content, $type = 'error' ) {
	echo btp_helpmode_capture( $title, $content, $type );
}
	


/* ------------------------------------------------------------------------- */
/* ---------->>> SIDEBAR <<<------------------------------------------------ */
/* ------------------------------------------------------------------------- */



/**
 * Gets sidebars as an associative array (id => name)
 * 
 * @return 			array
 */	
function btp_sidebar_get_choices() {
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
function btp_sidebar_render( $s  = 'primary' ) {
	if ( is_active_sidebar( $s ) ) {
		dynamic_sidebar( $s );
		return;
	} elseif( current_user_can( 'administrator' ) ) {
		btp_helpmode_render(
			__( 'Empty sidebar', 'btp_theme' ),
			'<p>' . 
				sprintf( __( 'The "%s" sidebar is empty.', 'btp_theme' ), $s ) . ' ' .
			 	sprintf( __( 'You should <a href="%s">add some widgets</a> to it.', 'btp_theme' ), network_admin_url( 'widgets.php' ) ) . 
			'</p>'
		);
	}		
}




/**
 * Renders first active sidebar from the passed array.
 * 
 * @param 			array $sidebars
 */
function btp_sidebar_render_first_active( $sidebars = array() ) {
	foreach ( $sidebars as $s ) {
		if ( is_active_sidebar( $s ) ) {
			dynamic_sidebar( $s );
			return;
		}	
	}		
}



/* ------------------------------------------------------------------------- */
/* ---------->>> PAGINATION <<<--------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Builds pagination links 
 * 
 * @param 			int $range
 * @return 			string
 */
function btp_pagination_capture( $range = 3 ) {
	global $wp_query;
	
	if ( false ) { paginate_links(); }	
	
	$posts_per_page = absint( get_query_var( 'posts_per_page' ) );
	$paged 			= absint( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max_num_pages 	= absint( $wp_query->max_num_pages ) ? absint( $wp_query->max_num_pages ) : 1;	
	$request 		= $wp_query->request;
	$found_posts 	= $wp_query->found_posts;
		
	$max_num_links 	= 2 * $range + 1;
	$start_at		= 0;
	$end_at			= 0;		
	if ( $max_num_links >= $max_num_pages ) {
		$start_at	 = 1;
		$end_at	 	 = $max_num_pages;
	}
	else {
		/* Determine first page to display */
		$start_at = $paged - $range;
		if ( $start_at < 1 )
			$start_at = 1;
		
		/* Determine last page to display */
		$end_at		= $paged + $range;
		if ( $end_at > $max_num_pages )
			$end_at = $max_num_pages; 
	} 
	
	/* Compose output */
	$out = '';	
	if( $max_num_pages > 1 ) {
		$out .= '<nav class="pagination">';	
			$out .= '<p><strong>' . __( 'Pages:', 'btp_theme' ) . '</strong>';
	
				/* Previous Page Link */	
				$prev_page = $paged - 1;				
				if ( $prev_page >= 1 ) {
					$out .= '<a href="' . esc_url( get_pagenum_link( $prev_page ) ) . '" class="prev">';
						$out .= '<span>' . __( 'Prev', 'btp_theme' ) . '</span>';
					$out .= '</a>';
					
				}
				
				/* Page Links */				
				for ( $i = $start_at; $i <= $end_at; $i++ ) {
					$class = ( $i == $paged ) ? 'active' : 'tertiary';
					if ( $i != $paged ) {				
						$out .= '<a href="' . esc_url( get_pagenum_link( $i ) ) . '"><span>' . $i . '</span></a>';
					} else {
						$out .= '<strong class="current"><span>' . $i . '</span></strong>';
					}
				}					
				
				/* Next Page Link */	
				$next_page = $paged + 1;				
				if ( $next_page <= $max_num_pages ) {	
					$out .= '<a href="' . esc_url( get_pagenum_link( $next_page ) ) . '" class="next">';
						$out .= '<span>' . __( 'Next', 'btp_theme' ) . '</span>';
					$out .= '</a>';
				
				}
					
			$out .= '</p>';
		$out .= '</nav>';	
	}	
	return $out;
}
function btp_pagination_render( $range = 3 ) {
	echo btp_pagination_capture( $range );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> ELEMENTS <<<----------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Gets the configuration of elements for the current request.
 *  
 * @param			string $elem 
 * @return			mixed
 */	
function btp_elements_get( $elem = null ) {
	static $elems = null;

	if ( $elems === null ) {	
		$elems = array();	
		$elems = apply_filters( 'btp_elements_defaults', $elems );	
		
		if ( is_home() ) {
	    	$elems = array_multimerge( $elems, btp_elements_get_index() );
		} elseif ( is_post_type_archive() ) {
			$elems = array_multimerge( $elems, btp_elements_get_index() );
		} elseif ( is_archive() ) {		
			$elems = array_multimerge( $elems, btp_elements_get_archive() );
		} elseif ( is_singular() ) {
			$elems = array_multimerge( $elems, btp_elements_get_singular() );
		}		
		
		$elems = apply_filters( 'btp_elements', $elems );
	}	
	
	
	if ( strlen( $elem ) ) {
		if ( isset ( $elems[ $elem ] ) ) {
			return $elems[ $elem ];	
		} else {
			return null;
		}		
	} else {
		return $elems;
	}
}



/**
 * Gets the configuration of elements for the current index page.
 *  
 * @param			string $elem 
 * @return			mixed
 */	
function btp_elements_get_index( ) {
	$elems = array(
		'collection' => array(
			'title'				=> true,
			'date'				=> true,
			'author'			=> true,
			'comments_link' 	=> true,
			'featured_media'	=> true,
			'summary'			=> true,
			'categories'		=> true,
			'tags'				=> true,
			'button_1'			=> true,
		),
	);
	
	return apply_filters( 'btp_elements_index', $elems );
}



/**
 * Gets the configuration of elements for the current archive page.
 *  
 * @param			string $elem 
 * @return			mixed
 */	
function btp_elements_get_archive( ) {	
	$elems = array(
		'collection' => array(
			'title'				=> true,
			'date'				=> true,
			'author'			=> true,
			'comments_link' 	=> true,
			'featured_media'	=> true,
			'summary'			=> true,
			'categories'		=> true,
			'tags'				=> true,
			'button_1'			=> true,
		),
	);
	
	return apply_filters( 'btp_elements_archive', $elems );
}



/**
 * Gets the configuration of elements on the single page or post. 
 * 
 * @param 			integer $id
 * @return			array 
 */
function btp_elements_get_singular( $id = null ) {
	$post = get_post( $id );
	
	$elems = array(
		'sidebar_1'		=> 'primary',		
		'breadcrumbs'	=> true,
		'title' 		=> true,		
		'date'			=> true,
		'author'		=> true,
		'comments_link'	=> true,
		'categories'	=> true,
		'tags'			=> true,
		'mediabox'		=> true,
	);	
	
//	foreach( $elems as $elem_key => $elem_value ) {
//		$new_value = btp_entry_get_option_value( $post->ID, 'elem_' . $elem_key );
//		if( !empty( $new_value ) ) {
//			$elems[ $elem_key ] = $new_value;
//		}	
//	}
	
	
	$elems = apply_filters( 'btp_elements_singular', $elems, $post->ID );
	
	// Replace 'none' values with false
	foreach( $elems as $key => $value ) {
		if ( $value === 'none' ) {
			$elems[ $key ] = false;
		}
	}	
	
	return $elems;
}

















	
	
	
/** 
 * Determines bool value 
 * 
 * @param mixed $value
 * @return bool
 */
function btp_bool( $value ) {
	if( empty( $value ) || $value === 'false' || $value === 'off' || $value === 'no' )
		return false;
	
	return true;	 	
}
	
	
/**
 * Checks if passed value is null 
 * 
 * @param $value
 * @return true
 */
function btp_is_null( $value ) {
	if ( $value === null || $value === 'null' )
		return true;
		
	return false;	
}



/**
 * Limits a post collection to posts with comments.
 * 
 * @param			string $where
 * @return			string	  
 */
function btp_filter_where_commented_posts( $where = '' ) {	
	global $wpdb;
	$where .= " AND $wpdb->posts.comment_count > 0";
	
	return $where; 	
} 



/**
 * 
 * @param 			array $fields
 * @return			array
 */
function btp_comment_form_default_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
			
	$fields['author'] = 
		'<div class="form-row comment-form-author">' .
			'<label for="author">'.__( 'Name', 'btp_theme' ). 
			( $req ? ' <em class="meta">'.__('(required)', 'btp_theme').'</em>' : '' ).
			'</label>'.
            '<input class="u-4" id="author" name="author" type="text" value="'.
            esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />'.
 		'</div>';
            
	$fields['email'] =
		'<div class="form-row comment-form-email">'.
        	'<label for="email">'.__( 'Email', 'btp_theme' ).
            ( $req ? ' <em class="meta">'.__('(required)', 'btp_theme').'</em>' : '' ).'</label>'.
            '<input class="u-4 " id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />'.
   		'</div>';
                
    $fields['url'] =
    	'<div class="form-row comment-form-url">'.	 
        	'<label for="url">'.__( 'Website', 'btp_theme' ).'</label>' .
            '<input class="u-4" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />'.
		'</div>';
                
	return $fields;
}
	


/**
 * 
 * @param 			string $field
 * @return			string
 */
function btp_comment_form_field_comment( $field ) {
	$field =
    	'<div class="form-row comment-form-comment">' .
	        '<label for="comment">' . __( 'Comment', 'btp_theme' ) . ' <em class="meta">'.__('(required)', 'btp_theme').'</em></label>' .
    	    '<textarea class="u-8" id="comment" name="comment" cols="45" rows="8" tabindex="4"></textarea>' .
		'</div>';	
		
	return $field;
}
	


/**
 * 
 * @param 			array $defaults
 * @return			array
 */
function btp_comment_form_defaults( $defaults ) {
	$defaults['comment_notes_before'] = '';		
	$defaults['comment_notes_after'] = '';
	
	return $defaults;
} 


/**
 * Customizes password form.
 * 
 * @param 			string $form
 * @return			string
 */
function btp_get_the_password_form($form) {
	$object = get_post_type_object(get_post_type());
	$text = sprintf( __( "This %s is password protected. To view it please enter your password below:", 'btp_theme' ), $object->labels->singular_name );
 	
	$parts = array(
    	'#<p>This post is password protected. To view it please enter your password below:</p>#' => '<p>' . esc_html( $text ) . '</p>',
    	'#<input(.*?)type="password"(.*?) />#' => '<input$1type="password"$2 class="u-4" />',
  	);

 	return preg_replace( array_keys( $parts ), array_values( $parts ), $form );
}

	
	
/**
 * Sets attribute wmode to transparent
 * 
 * @param 			string $html
 * @param 			string $url
 * @param 			array $attr 
 * @return			string
 */	
function btp_flash_wmode_transparent( $html, $url, $attr ) {
   if ( strpos( $html, '<embed src=' ) !== false) {
    	$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
   }	
   
   return $html;
}
add_filter( 'embed_oembed_html', 'btp_flash_wmode_transparent', 10, 3 );


/**
 * Sets attribute wmode to transparent
 * 
 * @param 			string $html
 * @param 			string $url
 * @param 			array $attr 
 * @return			string
 */	
function btp_youtube( $html, $url, $attr ) {
   //if ( strpos( $html, '<embed src=' ) !== false) {
   // 	$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
   //}

	$html = str_replace('feature=oembed', 'feature=oembed&autohide=2&autoplay=0&controls=1&disablekb=0&fs=1&loop=0&rel=0&showinfo=0&wmode=transparent&enablejsapi=1' , $html);
	
   	return $html;
}
add_filter( 'embed_oembed_html', 'btp_youtube', 10, 3 );



/**
 * Excerpt length helper
 * 
 * Based on: http://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress
 *
 */
class BTP_Excerpt {
  public static $length = 55;

  
  public static function set_length( $v = null ) {
  	$v = absint( $v );
  	if ( $v ) {
    	BTP_Excerpt::$length = $v;
  	}	

    add_filter( 'excerpt_length', 'BTP_Excerpt::get_length', 999 );   
  }

   
  public static function get_length() {    
      return BTP_Excerpt::$length;
  }

  
  public static function capture( $length = null ) {
  	BTP_Excerpt::set_length( $length );
  	
    return apply_filters( 'the_excerpt', get_the_excerpt() );
  }
  
  public static function render( $length = null ) {
  	echo BTP_Excerpt::capture();
  }
}



/**
 * Converts string of coma separated names into an array of true bool values
 * 
 * @param string $string
 * @return array
 */ 
function btp_string_to_bools( $string ) {
	$string = preg_replace( '/[^0-9a-zA-Z,_-]*/', '', $string );
	
	$results = array();
	$bools = explode( ',', $string );
			
	foreach ( $bools as $key => $value )
		$results[$value] = true; 
		
	return $results;
}
?>