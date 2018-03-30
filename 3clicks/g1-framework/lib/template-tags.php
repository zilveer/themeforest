<?php


/* ------------------------------------------------------------------------- */
/* ---------->>> HELP MODE <<<---------------------------------------------- */
/* ------------------------------------------------------------------------- */

class G1_Helpmode {
    private $id;
    private $title;
    private $content;
    private $type;

    public function __construct( $id, $title, $content, $type ) {
        $this->set_id( $id );
        $this->set_title( $title );
        $this->set_content( $content );
        $this->set_type( $type );
    }

    public function set_id( $val ) { $this->id = $val; }
    public function get_id() { return $this->id; }

    public function set_title( $val ) { $this->title = $val; }
    public function get_title() { return $this->title; }

    public function set_content( $val ) { $this->content = $val; }
    public function get_content() { return $this->content; }

    public function set_type( $val ) { $this->type = $val; }
    public function get_type() { return $this->type; }


    /**
     * Captures helpmode message
     */
    public function capture() {
        $out = '';

        $helpmode_enabled = g1_get_theme_option( 'general', 'helpmode', 'none' );

        if ( !current_user_can( 'administrator' ) || $helpmode_enabled === 'none' ) {
            return $out;
        }

        $final_id = $this->get_id();
        $final_class = array(
            'g1-helpmode',
            'g1-type-' . $this->get_type(),
        );


        // Compose the template
        $out = '<div id=%ID% class="%CLASS%">' .
            '<div class="g1-helpmode-title">
                        <span></span>%TITLE%
                    </div>' .
            '<div class="g1-helpmode-content">' .
            '%CONTENT%' .
            '</div>' .
            '</div>';

        // Fill in the template
        $out = str_replace(
            array(
                '%ID%',
                '%CLASS%',
                '%TITLE%',
                '%CONTENT%',
            ),
            array(
                esc_attr( $final_id ),
                sanitize_html_classes( $final_class ),
                esc_html( $this->get_title() ),
                $this->get_content()
            ),
            $out
        );

        return $out;
    }
    public function render() {
        echo $this->capture();
    }

}

function G1_Helpmode( $id, $title, $content, $type = 'error' ) {
    return new G1_Helpmode(
        $id, $title, $content, $type
    );
}




class G1_Breadcrumbs {
    private $separator;
    private $breadcrumbs;

    public function __construct() {
        $this->set_separator( ' &rsaquo; ' );
    }

    public function set_separator( $val ) { $this->separator= $val; }
    public function get_separator() { return $this->separator; }

    /**
     * Gets breadcrumbs for the current context.
     *
     * If you want to add/delete some choices, hook into the g1_breadcrumbs custom filter.
     *
     * @return array
     */
    public function get() {
        global $post;

        $this->breadcrumbs = array();
        $this->breadcrumbs[] = array(
            'href'		=> home_url( '/' ),
            'text'		=> __( 'Home', 'g1_theme' )
        );

        // Blog Page
        if ( is_home() && !is_front_page() ) {
            $id = intval( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );

            // WPML fallback
            if ( G1_WPML_LOADED ) {
                $id = absint( icl_object_id( $id, 'page', true ) );
            }

            if ( $id ) {
                $href = get_permalink( $id );
                $text = get_the_title( $id );

                $this->breadcrumbs[] = array(
                    'href' => $href,
                    'text' => $text,
                );
            }
        } elseif ( is_singular() ) {
            if ( !is_page() ) {
                if( 'post' == get_post_type() ) {
                    $id = intval( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );

                    // WPML fallback
                    if ( G1_WPML_LOADED ) {
                        $id = absint( icl_object_id( $id, 'page', true ) );
                    }

                    if ( $id ) {
                        $href = get_permalink( $id );
                        $text = get_the_title( $id );

                        $this->breadcrumbs[] = array(
                            'href' => $href,
                            'text' => $text,
                        );
                    }
                } elseif( !is_attachment() ) {
                    $post_type_obj = get_post_type_object( get_post_type() );

                    if ( $post_type_obj ) {
                        $href = get_post_type_archive_link( get_post_type() );
                        $text = apply_filters('post_type_archive_title', $post_type_obj->labels->name );

                        $this->breadcrumbs[] = array(
                            'href' => $href,
                            'text' => $text,
                        );
                    }
                }
            }

            // Add subpages if any
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

                $this->breadcrumbs = array_merge( $this->breadcrumbs, $parent_breadcrumbs );
            }

            // Add the current page
            $this->breadcrumbs[] = array(
                'href'	=>	get_permalink( $post->ID ),
                'text'	=>	get_the_title( $post->ID )
            );
        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type();

            $href = get_post_type_archive_link( $post_type );
            $text = post_type_archive_title( '', false );

            $page_id = G1_Archive_Page_Feature()->get_page_id( $post_type );

            // WPML fallback
            if ( G1_WPML_LOADED ) {
                $page_id = absint( icl_object_id( $page_id, 'page', true ) );
            }

            if ( !empty( $page_id ) ) {
                $title = get_the_title( $page_id );
            }

            if ( !empty( $title ) ) {
                $text = $title;
            }

            $this->breadcrumbs[] = array(
                'href'	=>	$href,
                'text'	=>	$text,
            );
        } elseif ( is_category() ) {
            $category_id = get_query_var('cat');
            $category = get_category( $category_id);

            // Temporary array for the current category and parents (if any)
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
            }

            /* Merge with temporary array */
            $this->breadcrumbs = array_merge( $this->breadcrumbs, $temp );
        } elseif( is_tag() ) {
            $this->add_tag_breadcrumbs();
        } elseif( is_tax() ) {
            $this->add_tax_breadcrumbs();
        } elseif ( is_year() ) {
            $this->add_year_breadcrumbs();
        } elseif ( is_month() ) {
            $this->add_month_breadcrumbs();
        } elseif ( is_day() ) {
            $this->add_day_breadcrumbs();
        } elseif ( is_author() ) {
            $this->add_author_breadcrumbs();
        } elseif ( is_search() ) {
            $this->add_search_breadcrumbs();
        } elseif ( is_404() ) {
            $this->add_404_breadcrumbs();
        }

        // Call the functions added to a filter hook
        $this->breadcrumbs = apply_filters( 'g1_breadcrumbs', $this->breadcrumbs );

        $this->remove_duplicates();

        return $this->breadcrumbs;
    }


    /**
     * Removes duplicated items
     */
    protected function remove_duplicates(){

        $uniques = array();
        foreach ( $this->breadcrumbs as $k => $v ) {
            if ( in_array( $v[ 'href' ], $uniques ) ) {
                unset( $this->breadcrumbs[ $k ] );
            } else {
                $uniques[] = $v[ 'href' ];
            }
        }
        // Re-index array
        $this->breadcrumbs = array_values( $this->breadcrumbs );
    }


    public function add_tag_breadcrumbs(){
        $this->add_breadcrumb(
            '',
            sprintf( __( 'Tag Archives: %s', 'g1_theme' ), single_term_title( '', false ) )
        );
    }

    public function add_tax_breadcrumbs(){
        $this->add_breadcrumb(
            '',
            single_term_title( '', false )
        );
    }

    public function add_year_breadcrumbs(){
        $this->add_breadcrumb(
            '',
            get_the_time( 'Y' )
        );
    }


    public function add_month_breadcrumbs(){
        $this->add_breadcrumb(
            get_year_link( get_the_time( 'Y' ) ),
            get_the_time( 'Y' )
        );

        $this->add_breadcrumb(
            '',
            get_the_time( 'F' )
        );
    }


    public function add_day_breadcrumbs(){
        $this->add_breadcrumb(
            get_year_link( get_the_time( 'Y' ) ),
            get_the_time( 'Y' )
        );

        $this->add_breadcrumb(
            get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
            get_the_time( 'F' )
        );

        $this->add_breadcrumb(
            '',
            get_the_time( 'd' )
        );
    }


    public function add_author_breadcrumbs(){
        $curauth = null;
        if ( get_query_var( 'author_name' ) )
            $curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );

        if ( get_query_var( 'author' ) )
            $curauth = get_user_by( 'id', get_query_var( 'author' ) );

        $this->add_breadcrumb(
            '',
            sprintf( __( 'Author Archives: %s', 'g1_theme' ), $curauth->display_name )
        );
    }


    public function add_search_breadcrumbs(){
        $this->add_breadcrumb(
            '',
            __( 'Search results', 'g1_theme' )
        );
    }


    public function add_404_breadcrumbs(){
        $this->add_breadcrumb(
            '',
            __( '404 - page not found', 'g1_theme' )
        );
    }

    public function add_breadcrumb( $href, $text ) {
        $this->breadcrumbs[] = array(
            'href' => $href,
            'text' => $text
        );
    }



    /**
     * Captures breadcrumbs navigation markup
     *
     * @param array $breadcrumbs
     * @param string $separator
     * @return string
     */
    public function capture() {
        $breadcrumbs = $this->get();

        // Compose output
        $out = '';

        $counter = count( $breadcrumbs );
        if ( 1 < $counter ) {
            for ( $i = 0; $i < $counter; $i++ ) {
                if ( strlen($breadcrumbs[$i]['text']) === 0 ) {
                    continue;
                }

                if ( $i == ( $counter - 1 ) ) {
                    $out .= '<li class="g1-nav-breadcrumbs__item">' .
                                $breadcrumbs[$i]['text'] .
                            '</li>';
                } else {
                    $out .= '<li class="g1-nav-breadcrumbs__item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' .
                                '<a itemprop="url" href="' . $breadcrumbs[$i]['href'] . '">' .
                                    '<span itemprop="title">' . $breadcrumbs[$i]['text'] . '</span>' .
                                '</a>' .
                            '</li>';
                }
            }


            $out = '<nav class="g1-nav-breadcrumbs g1-meta">' .
                        '<p class="assistive-text">' . __( 'You are here: ', 'g1_theme' ) .'</p>' .
                        '<ol>' .
                            $out .
                        '</ol>' .
                    '</nav>';
        }

        return $out;
    }
    public function render(){
        echo $this->capture();
    }

}

function G1_Breadcrumbs() {
    return new G1_Breadcrumbs();
}




/* ------------------------------------------------------------------------- */
/* ---------->>> PAGINATION <<<--------------------------------------------- */
/* ------------------------------------------------------------------------- */

class G1_Pagination {
    private $range;

    public function __construct() {
        $this->set_range( 3 );
    }

    public function set_range( $val ) { $this->range = $val; }
    public function get_range() { return $this->range; }


    public function capture() {
        global $wp_query;

        $range = $this->get_range();

        if ( false ) {
            paginate_links();
        }

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
            // Determine first page to display
            $start_at = $paged - $range;
            if ( $start_at < 1 )
                $start_at = 1;

            // Determine last page to display
            $end_at		= $paged + $range;
            if ( $end_at > $max_num_pages )
                $end_at = $max_num_pages;
        }

        // Compose output
        $out = '';
        if( $max_num_pages > 1 ) {
            $out .= '<nav class="g1-pagination">';
            $out .= '<p><strong>' . __( 'Pages', 'g1_theme' ) . '</strong>';

            // Previous Page Link
            $prev_page = $paged - 1;
            if ( $prev_page >= 1 ) {
                $out .= '<a href="' . esc_url( get_pagenum_link( $prev_page ) ) . '" class="prev">';
                $out .= '<span>' . __( 'Prev', 'g1_theme' ) . '</span>';
                $out .= '</a>';

            }

            // Page Links
            for ( $i = $start_at; $i <= $end_at; $i++ ) {
                $class = ( $i == $paged ) ? 'active' : 'tertiary';
                if ( $i != $paged ) {
                    $out .= '<a href="' . esc_url( get_pagenum_link( $i ) ) . '"><span>' . $i . '</span></a>';
                } else {
                    $out .= '<strong class="current"><span>' . $i . '</span></strong>';
                }
            }

            // Next Page Link
            $next_page = $paged + 1;
            if ( $next_page <= $max_num_pages ) {
                $out .= '<a href="' . esc_url( get_pagenum_link( $next_page ) ) . '" class="next">';
                $out .= '<span>' . __( 'Next', 'g1_theme' ) . '</span>';
                $out .= '</a>';

            }

            $out .= '</p>';
            $out .= '</nav>';
        }
        return $out;
    }



    public function render() {
        echo $this->capture();
    }

}
function G1_Pagination() {
    return new G1_Pagination();
}


