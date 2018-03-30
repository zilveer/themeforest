<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 02/10/15
 * Time: 11:45 AM
 */

if( !function_exists('houzez_check_role') ) {
    function houzez_check_role() {
        global $current_user;
        $current_user = wp_get_current_user();
        //houzez_agent, subscriber, author, houzez_buyer
        $use_houzez_roles = houzez_option('use_houzez_roles');

        if( $use_houzez_roles != 0 ) {
            if (in_array('houzez_buyer', (array)$current_user->roles) || in_array('subscriber', (array)$current_user->roles)) {
                return false;
            }
            return true;
        }
        return true;
    }
}

if ( ! function_exists( 'houzez_http_or_https' ) ) {
    function houzez_http_or_https() {
        if (is_ssl()) {
            $http_or_https = 'https';
        } else {
            $http_or_https = 'http';
        }

        return $http_or_https;
    }
}
/* --------------------------------------------------------------------------
 * Removes version scripts number if enabled for better Google Page Speed Scores. @since Houzez 1.4.0
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_remove_wp_ver_css_js' ) ) {
    function houzez_remove_wp_ver_css_js( $src ) {
        //if ( houzez_option( 'remove_scripts_version', '1' ) ) {
            if ( strpos( $src, 'ver=' ) ) {
                $src = remove_query_arg( 'ver', $src );
            }
        //}
        return $src;
    }
}
add_filter( 'style_loader_src', 'houzez_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'houzez_remove_wp_ver_css_js', 9999 );

/* --------------------------------------------------------------------------
 * Houzez get term array by name, slug, id
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_get_term_by') ) {
    function houzez_get_term_by( $field, $value, $taxonomy ) {
        $term = get_term_by( $field, $value, $taxonomy );
        if( $term ) {
            return $term;
        }
        return;
    }
}

if ( !function_exists( 'houzez_get_property_status_meta' ) ):
    function houzez_get_property_status_meta( $term_id = false, $field = false ) {
        $defaults = array(
            'color_type' => 'inherit',
            'color' => '#000000',
            'ppp' => ''
        );

        if ( $term_id ) {
            $meta = get_option( '_houzez_property_status_'.$term_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

if ( !function_exists( 'houzez_get_property_label_meta' ) ):
    function houzez_get_property_label_meta( $term_id = false, $field = false ) {
        $defaults = array(
            'color_type' => 'inherit',
            'color' => '#bcbcbc',
            'ppp' => ''
        );

        if ( $term_id ) {
            $meta = get_option( '_houzez_property_label_'.$term_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

if ( !function_exists( 'houzez_get_property_area_meta' ) ):
    function houzez_get_property_area_meta( $term_id = false, $field = false ) {
        $defaults = array(
            'parent_city' => ''
        );

        if ( $term_id ) {
            $meta = get_option( '_houzez_property_area_'.$term_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

if( !function_exists('houzez_get_all_cities') ):
    function houzez_get_all_cities( $selected = '' ) {
        $taxonomy       =   'property_city';
        $args = array(
            'hide_empty'    => false
        );
        $tax_terms      =   get_terms($taxonomy,$args);
        $select_city    =   '';

        foreach ($tax_terms as $tax_term) {
            $select_city.= '<option value="' . $tax_term->name.'" ';
            if($tax_term->name == $selected){
                $select_city.= ' selected="selected" ';
            }
            $select_city.= ' >' . $tax_term->name . '</option>';
        }
        return $select_city;
    }
endif;

if ( !function_exists( 'houzez_get_property_city_meta' ) ):
    function houzez_get_property_city_meta( $term_id = false, $field = false ) {
        $defaults = array(
            'parent_state' => ''
        );

        if ( $term_id ) {
            $meta = get_option( '_houzez_property_city_'.$term_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

if ( !function_exists( 'houzez_get_property_state_meta' ) ):
    function houzez_get_property_state_meta( $term_id = false, $field = false ) {
        $defaults = array(
            'parent_country' => ''
        );

        if ( $term_id ) {
            $meta = get_option( '_houzez_property_state_'.$term_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

if( !function_exists('houzez_get_all_states') ):
    function houzez_get_all_states( $selected = '' ) {
        $taxonomy       =   'property_state';
        $args = array(
            'hide_empty'    => false
        );
        $tax_terms      =   get_terms($taxonomy,$args);
        $select_state    =   '';

        foreach ($tax_terms as $tax_term) {
            $select_state.= '<option value="' . $tax_term->name.'" ';
            if($tax_term->name == $selected){
                $select_state.= ' selected="selected" ';
            }
            $select_state.= ' >' . $tax_term->name . '</option>';
        }
        return $select_state;
    }
endif;

if ( !function_exists( 'houzez_update_recent_colors' ) ):
    function houzez_update_recent_colors( $color, $num_col = 10 ) {
        if ( empty( $color ) )
            return false;

        $current = get_option( 'houzez_recent_colors' );
        if ( empty( $current ) ) {
            $current = array();
        }

        $update = false;

        if ( !in_array( $color, $current ) ) {
            $current[] = $color;
            if ( count( $current ) > $num_col ) {
                $current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
            }
            $update = true;
        }

        if ( $update ) {
            update_option( 'houzez_recent_colors', $current );
        }

    }
endif;

if ( !function_exists( 'houzez_update_property_status_colors' ) ):
    function houzez_update_property_status_colors( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_cat_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'houzez_property_status_colors', $colors );

    }
endif;


if ( !function_exists( 'houzez_update_property_label_colors' ) ):
    function houzez_update_property_label_colors( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_label_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'houzez_property_label_colors', $colors );

    }
endif;


/* --------------------------------------------------------------------------
 * Metabox map filter
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_metabox_map_filter') ) {
    function houzez_metabox_map_filter() {

        $googlemap_ssl = houzez_option('googlemap_ssl');
        $googlemap_api_key = houzez_option('googlemap_api_key');

        if( esc_html( $googlemap_ssl ) == 'yes' ) {
            wp_enqueue_script('google-map', 'https://maps-api-ssl.google.com/maps/api/js?libraries=places&language='.get_locale().'&amp;key='.esc_html( $googlemap_api_key ),array('jquery'), '1.0', false);
        } else {
            wp_enqueue_script('google-map', 'http://maps.googleapis.com/maps/api/js?libraries=places&language='.get_locale().'&amp;key=' . esc_html( $googlemap_api_key ), array('jquery'), '1.0', false);
        }
    }
    add_filter('rwmb_google_maps_url', 'houzez_metabox_map_filter');
}

/* --------------------------------------------------------------------------
 * Remove Recent Comment Style
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_remove_recent_comments_style') ) {
    function houzez_remove_recent_comments_style()
    {
        global $wp_widget_factory;
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }

    add_action('widgets_init', 'houzez_remove_recent_comments_style');
}

/* --------------------------------------------------------------------------
 * Get excerpt limit 
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_get_excerpt') ) {
    function houzez_get_excerpt($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
        return $excerpt;
    }
}

/* --------------------------------------------------------------------------
 * Get content limit 
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_get_content') ) {
    function houzez_get_content($limit)
    {
        $content = explode(' ', get_the_content(), $limit);
        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }
        $content = preg_replace('/\[.+\]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}


/* --------------------------------------------------------------------------
 * Open Graph
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_add_opengraph' ) ) {

    function houzez_add_opengraph() {
        global $post; // Ensures we can use post variables outside the loop

        // Start with some values that don't change.
        echo "<meta property='og:site_name' content='". esc_url( get_bloginfo('name') ) ."'/>"; // Sets the site name to the one in your WordPress settings
        echo "<meta property='og:url' content='" . esc_url( get_permalink() ) . "'/>"; // Gets the permalink to the post/page

        if (is_singular()) { // If we are on a blog post/page
            echo "<meta property='og:title' content='" . esc_attr( get_the_title() ) . "'/>"; // Gets the page title
            echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
            if( has_post_thumbnail( $post->ID )) { // If the post has a featured image.
                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
                echo "<meta property='og:description' content='".wp_html_excerpt($post->post_content, 100 )."'/>"; // Sets the content type to be article.
            }

        } elseif(is_front_page() or is_home()) { // If it is the front page or home page
            echo "<meta property='og:title' content='" . esc_attr( get_bloginfo("name") ) . "'/>"; // Get the site title
            echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
        }

    }


    if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin')) {
        add_action( 'wp_head', 'houzez_add_opengraph', 5 );
    }
}

/*-----------------------------------------------------------------------------------*/
// Number List
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_number_list') ) {
    function houzez_number_list($list_for) {
        $num_array = array(1,2,3,4,5,6,7,8,9,10);
        $searched_num = '';

        if( $list_for == 'bedrooms' ) {
            if( isset( $_GET['bedrooms'] ) ) {
                $searched_num = $_GET['bedrooms'];
            }

            $adv_beds_list = houzez_option('adv_beds_list');
            if( !empty($adv_beds_list) ) {
                $adv_beds_list_array = explode( ',', $adv_beds_list );

                if( is_array( $adv_beds_list_array ) && !empty( $adv_beds_list_array ) ) {
                    $temp_adv_beds_list_array = array();
                    foreach( $adv_beds_list_array as $beds ) {
                        $temp_adv_beds_list_array[] = $beds;
                    }

                    if( !empty( $temp_adv_beds_list_array ) ) {
                        $num_array = $temp_adv_beds_list_array;
                    }
                }
            }

        }
        if( $list_for == 'bathrooms' ) {
            if( isset( $_GET['bathrooms'] ) ) {
                $searched_num = $_GET['bathrooms'];
            }

            $adv_baths_list = houzez_option('adv_baths_list');
            if( !empty($adv_baths_list) ) {
                $adv_baths_list_array = explode( ',', $adv_baths_list );

                if( is_array( $adv_baths_list_array ) && !empty( $adv_baths_list_array ) ) {
                    $temp_adv_baths_list_array = array();
                    foreach( $adv_baths_list_array as $baths ) {
                        $temp_adv_baths_list_array[] = $baths;
                    }

                    if( !empty( $temp_adv_baths_list_array ) ) {
                        $num_array = $temp_adv_baths_list_array;
                    }
                }
            }
        }

        if( !empty( $num_array ) ) {
            foreach( $num_array as $num ){
                if( $searched_num == $num ) {
                    echo '<option value="'.esc_attr( $num ).'" selected="selected">'.esc_attr( $num ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $num ).'">'.esc_attr( $num ).'</option>';
                }
            }
        }

        if( $searched_num == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'houzez').'</option>';
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Get attachment meta by attachment ID
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_attachment_metadata' ) ) {
    function houzez_get_attachment_metadata($attachment_id)
    {
        $thumbnail_image = get_posts(array('p' => $attachment_id, 'post_type' => 'attachment'));

        if ($thumbnail_image && isset($thumbnail_image[0])) {
            return $thumbnail_image[0];
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Favethemes object to array
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_objectToArray') ):
    function houzez_objectToArray ($object) {

        if(!is_object($object) && !is_array($object))
            return $object;

        return array_map('houzez_objectToArray', (array) $object);
    }
endif;

/* --------------------------------------------------------------------------
 * Get author by post id
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_get_author_by_post_id') ):
    function houzez_get_author_by_post_id( $post_id = 0 ){
        $post = get_post( $post_id );
        return $post->post_author;
    }
endif;

/* --------------------------------------------------------------------------
 * Get get author avatar
 ---------------------------------------------------------------------------*/
if ( !function_exists('houzez_get_avatar_url') ) {
    function houzez_get_avatar_url($get_avatar){
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);
        return $matches[1];
    }
}

/* --------------------------------------------------------------------------
 * Get fave get author
 ---------------------------------------------------------------------------*/
if( !function_exists('houzez_get_author') ):
    function houzez_get_author( $post_id = 0 ){
        $post = get_post( $post_id );
        return $post->post_author;
    }
endif;

/* --------------------------------------------------------------------------
 * Get image url
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'houzez_get_image_url' ) ):
    function houzez_get_image_url( $image_size ) {
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src( $thumb_id, $image_size, true );

        return $thumb_url_array;
    }
endif;

/* --------------------------------------------------------------------------
 * Get image url by image ID
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'houzez_get_image_by_id' ) ):
    function houzez_get_image_by_id( $thumb_id, $image_size ) {
        $thumb_url_array = wp_get_attachment_image_src( $thumb_id, $image_size, true );

        return $thumb_url_array;
    }
endif;

/* --------------------------------------------------------------------------
 * Get invoice post type meta with default values
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'houzez_get_invoice_meta' ) ):
    function houzez_get_invoice_meta( $post_id, $field = false ) {

        $defaults = array(
            'invoice_billion_for' => '',
            'invoice_billing_type' => '',
            'invoice_item_id' => '',
            'invoice_item_price' => '',
            'invoice_payment_method' => '',
            'invoice_purchase_date' => '',
            'invoice_buyer_id' => ''
        );

        $meta = get_post_meta( $post_id, '_houzez_invoice_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

/* --------------------------------------------------------------------------
 * Get user package post type meta with default values
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'houzez_get_user_packages_meta' ) ):
    function houzez_get_user_packages_meta( $post_id, $field = false ) {

        $defaults = array(
            'package_name' => ''
        );

        $meta = get_post_meta( $post_id, '_houzez_user_package_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }
endif;

/* --------------------------------------------------------------------------
 * Get property post type meta with default values
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'houzez_get_property_meta' ) ):
    function houzez_get_property_meta( $post_id, $field = false ) {

        /*$defaults = array(
            'fave_payment_status' => ''
        );*/

        //$meta = get_post_meta( $post_id, 'fave_payment_status', true );
        //$meta = wp_parse_args( (array) $meta, $defaults );

        /*if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }*/
        //return $meta;
    }
endif;

/* --------------------------------------------------------------------------
 * Remove special chars and spaces from string
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_clean' ) ) {
    function houzez_clean($string)
    {
        $string = preg_replace('/&#36;/', '', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/\D/', '', $string);
        return $string;
    }
}

/* --------------------------------------------------------------------------
 * Get term
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_taxonomy_simple' ) ) {
    function houzez_taxonomy_simple( $tax_name )
    {
        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "names"));
        $t = '';
        if (!empty($terms)):
            foreach( $terms as $term ):
                $t .= $term.', ';
            endforeach;
            $trimed = rtrim ( $t, ', ' );
            return $trimed;
        endif;
        return '';
    }
}

if ( ! function_exists( 'houzez_taxonomy_simple_2' ) ) {
    function houzez_taxonomy_simple_2( $tax_name, $propID )
    {
        $terms = wp_get_post_terms( $propID, $tax_name, array("fields" => "names"));
        $t = '';
        if (!empty($terms)):
            foreach( $terms as $term ):
                $t .= $term.', ';
            endforeach;
            $trimed = rtrim ( $t, ', ' );
            return $trimed;
        endif;
        return '';
    }
}

if ( ! function_exists( 'houzez_get_taxonomy_id' ) ) {
    function houzez_get_taxonomy_id( $tax_name )
    {
        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "ids"));
        $term_id = '';
        if (!empty($terms)):
            foreach( $terms as $term ):
                $term_id = $term;
            endforeach;
            return $term_id;
        endif;
        return '';
    }
}

if ( ! function_exists( 'houzez_get_taxonomy' ) ) {
    function houzez_get_taxonomy($tax_name)
    {
        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "all"));
        if (!empty($terms)):
            foreach ($terms as $term):
                $term_link = get_term_link($term, $tax_name);
                if (is_wp_error($term_link))
                    continue;
                $taxonomy = '<a href="' . esc_url( $term_link ) . '">' . esc_attr( $term->name ) . '</a>&nbsp';
                return $taxonomy;
            endforeach;
        endif;
        return '';
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   46.0 - Add prev and next links to a numbered link list - the pagination on single.
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if( !function_exists('houzez_link_pages_args_prevnext_add') ) {
    function houzez_link_pages_args_prevnext_add($args)
    {
        global $page, $numpages, $more, $pagenow;

        if (!$args['next_or_number'] == 'next_and_number')
            return $args; # exit early

        $args['next_or_number'] = 'number'; # keep numbering for the main part
        if (!$more)
            return $args; # exit early

        if ($page - 1) # there is a previous page
            $args['before'] .= _wp_link_page($page - 1)
                . $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';

        if ($page < $numpages) # there is a next page
            $args['after'] = _wp_link_page($page + 1)
                . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
                . $args['after'];

        return $args;
    }

    add_filter('wp_link_pages_args', 'houzez_link_pages_args_prevnext_add');
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Favethemes Pagination
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if( !function_exists( 'houzez_pagination' ) ){
    function houzez_pagination($pages = '', $range = 2 ) {
        global $paged;

        if(empty($paged))$paged = 1;

        $prev = $paged - 1;
        $next = $paged + 1;
        $showitems = ( $range * 2 )+1;
        $range = 2; // change it to show more links

        if( $pages == '' ){
            global $wp_query;

            $pages = $wp_query->max_num_pages;
            if( !$pages ){
                $pages = 1;
            }
        }

        if( 1 != $pages ){

            echo '<div class="pagination-main">';
                echo '<ul class="pagination">';
                    echo ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) ? '<li><a rel="First" href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span></a></li>' : '';
                    echo ( $paged > 1 ) ? '<li><a rel="Prev" href="'.get_pagenum_link($prev).'"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>' : '<li class="disabled"><a aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
                    for ( $i = 1; $i <= $pages; $i++ ) {
                        if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
                        {
                            if ( $paged == $i ){
                                echo '<li class="active"><a href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
                            } else {
                                echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                            }
                        }
                    }
                    echo ( $paged < $pages ) ? '<li><a rel="Next" href="'.get_pagenum_link($next).'"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>' : '';
                    echo ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) ? '<li><a rel="Last" href="'.get_pagenum_link( $pages ).'"><span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span></a></li>' : '';
                echo '</ul>';
            echo '</div>';

        }
    }
}


if( !function_exists( 'houzez_loadmore' ) ) {
    function houzez_loadmore($max_num_pages) {
        $more_link = get_next_posts_link( __('Load More', 'houzez'), $max_num_pages );
        $allowed_html_array = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            )
        );

        if(!empty($more_link)) : ?>
        <div id="fave-pagination-loadmore" class="pagination-wrap fave-load-more">
            <div class="pagination">
                <?php echo wp_kses( $more_link, $allowed_html_array); ?>
            </div>
        </div>
<?php   endif;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Include simple pagination
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'houzez_pagination' ) ):
    function houzez_pagination() {
        global $wp_query, $wp_rewrite;
        $allowed_html_array = array(
            'i' => array(
                'class' => array()
            ),
            'span' => array(
                'aria-hidden' => array()
            )
        );

        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        $pagination = array(
            'base' => @add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'prev_text' => wp_kses(__( '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>', 'houzez' ), $allowed_html_array),
            'next_text' => wp_kses(__( '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>', 'houzez' ), $allowed_html_array),
            'type' => 'array'
        );
        if ( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        if ( !empty( $wp_query->query_vars['s'] ) )
            $pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

        $links = paginate_links( $pagination );

        if( is_array( $links ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="pagination-main"><ul class="pagination">';

            foreach ( $links as $link ) {
                echo "<li>$link</li>";
            }
            echo '</ul></div>';
        }
    }
endif;


if( !function_exists('houzez_listing_meta_v1') ) {
    function houzez_listing_meta_v1()
    {
        $propID = get_the_ID();
        $prop_bed     = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
        $prop_bath     = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );

        $output = '';
        $output .= '<p>';
        if( !empty( $prop_bed ) ) {
            $prop_bed = esc_attr( $prop_bed );
            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Beds', 'houzez' ) : esc_html__( 'Bed', 'houzez' );

            $output .= '<span>';
            $output .= $prop_bed_lebel .': '. $prop_bed;
            $output .= '</span>';
        }
        if( !empty( $prop_bath ) ) {
            $prop_bath = esc_attr( $prop_bath );
            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Baths', 'houzez' ) : esc_html__( 'Bath', 'houzez' );

            $output .= '<span>';
            $output .= $prop_bath_lebel .': '. $prop_bath;
            $output .= '</span>';
        }

        if( !empty( houzez_get_listing_area_size( $propID ) ) ) {
            $output .= '<span>';
            $output .= houzez_get_listing_size_unit($propID) . ': ' . houzez_get_listing_area_size($propID);
            $output .= '</span>';
        }

        $output .= '</p>';

        return $output;

    }
}

if( !function_exists('houzez_listing_meta_v3') ) {
    function houzez_listing_meta_v3()
    {
        $propID = get_the_ID();
        $prop_bed     = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
        $prop_bath     = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );

        $output = '';
        $output .= '<ul class="item-amenities">';
        if( !empty( $prop_bed ) ) {
            $prop_bed = esc_attr( $prop_bed );
            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Bedrooms', 'houzez' ) : esc_html__( 'Bedroom', 'houzez' );

            $output .= '<li>';
            $output .= '<span>'.$prop_bed.'</span>';
            $output .= $prop_bed_lebel;
            $output .= '</li>';
        }
        if( !empty( $prop_bath ) ) {
            $prop_bath = esc_attr( $prop_bath );
            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Bathrooms', 'houzez' ) : esc_html__( 'Bathroom', 'houzez' );

            $output .= '<li>';
            $output .= '<span>'.$prop_bath.'</span>';
            $output .= $prop_bath_lebel;
            $output .= '</li>';
        }

        if( !empty( houzez_get_listing_area_size( $propID ) ) ) {
            $output .= '<li>';
            $output .= '<span>'.houzez_get_listing_area_size($propID).'</span>';
            $output .= houzez_get_listing_size_unit($propID);
            $output .= '</li>';

        }

        $output .= '</ul>';

        return $output;

    }
}

if( !function_exists('houzez_get_listing_area_size ') ) {
    function houzez_get_listing_area_size( $propID ) {
        $prop_area_size = '';
        $prop_size     = get_post_meta( $propID, 'fave_property_size', true );
        $houzez_base_area = houzez_option('houzez_base_area');

        if( !empty( $prop_size ) ) {

            if( isset( $_COOKIE[ "houzez_current_area" ] ) ) {
                if( $_COOKIE[ "houzez_current_area" ] == 'sq_meter' && $houzez_base_area != 'sq_meter'  ) {
                    $prop_size = $prop_size * 0.09290304; //m2 = ft2 x 0.09290304

                } elseif( $_COOKIE[ "houzez_current_area" ] == 'sqft' && $houzez_base_area != 'sqft' ) {
                    $prop_size = $prop_size / 0.09290304; //ft2 = m2 ÷ 0.09290304
                }
            }

            $prop_area_size = esc_attr( round( $prop_size ) );

        }
        return $prop_area_size;

    }
}

if( !function_exists('houzez_get_listing_size_unit ') ) {
    function houzez_get_listing_size_unit( $propID ) {
        $measurement_unit_global = houzez_option('measurement_unit_global');
        $area_switcher_enable = houzez_option('area_switcher_enable');

        if( $area_switcher_enable != 0 ) {
            $prop_size_prefix = houzez_option('houzez_base_area');

            if( isset( $_COOKIE[ "houzez_current_area" ] ) ) {
                $prop_size_prefix =$_COOKIE[ "houzez_current_area" ];
            }

            if( $prop_size_prefix == 'sqft' ) {
                $prop_size_prefix = houzez_option('measurement_unit_sqft_text');
            } elseif( $prop_size_prefix == 'sq_meter' ) {
                $prop_size_prefix = houzez_option('measurement_unit_square_meter_text');
            }

        } else {
            if ($measurement_unit_global == 1) {
                $prop_size_prefix = houzez_option('measurement_unit');

                if( $prop_size_prefix == 'sqft' ) {
                    $prop_size_prefix = houzez_option('measurement_unit_sqft_text');
                } elseif( $prop_size_prefix == 'sq_meter' ) {
                    $prop_size_prefix = houzez_option('measurement_unit_square_meter_text');
                }

            } else {
                $prop_size_prefix = get_post_meta( $propID, 'fave_property_size_prefix', true);
            }
        }
        return $prop_size_prefix;
    }
}


if( !function_exists('houzez_listing_meta_widget ') ) {
    function houzez_listing_meta_widget()
    {
        $prop_bed     = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
        $prop_bath     = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
        $prop_size     = get_post_meta( get_the_ID(), 'fave_property_size', true );
        //$prop_size_prefix     = get_post_meta( get_the_ID(), 'fave_property_size_prefix', true );

        if( !empty( $prop_bed ) ) {
            $prop_bed = esc_attr( $prop_bed );
            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'beds', 'houzez' ) : esc_html__( 'bed', 'houzez' );

            echo esc_attr( $prop_bed ).' '.esc_attr( $prop_bed_lebel ).' • ';
        }
        if( !empty( $prop_bath ) ) {
            $prop_bath = esc_attr( $prop_bath );
            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'baths', 'houzez' ) : esc_html__( 'bath', 'houzez' );

            echo esc_attr( $prop_bath ).' '. esc_attr( $prop_bath_lebel ).' • ';
        }
        if( !empty( $prop_size ) ) {
            echo houzez_property_size( 'after' );
        }

    }
}

if( !function_exists('houzez_listing_meta_v2 ') ) {
    function houzez_listing_meta_v2()
    {
        $prop_bed     = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
        $prop_bath     = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
        $prop_size     = get_post_meta( get_the_ID(), 'fave_property_size', true );
        //$prop_size_prefix     = get_post_meta( get_the_ID(), 'fave_property_size_prefix', true );

        if( !empty( $prop_bed ) ) {
            $prop_bed = esc_attr( $prop_bed );
            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'bd', 'houzez' ) : esc_html__( 'bd', 'houzez' );

            echo '<li>';
            echo esc_attr( $prop_bed ).' '. esc_attr( $prop_bed_lebel );
            echo '</li>';
        }
        if( !empty( $prop_bath ) ) {
            $prop_bath = esc_attr( $prop_bath );
            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'ba', 'houzez' ) : esc_html__( 'ba', 'houzez' );

            echo '<li>';
            echo esc_attr( $prop_bath ).' '. esc_attr( $prop_bath_lebel );
            echo '</li>';
        }
        if( !empty( $prop_size ) ) {

            echo '<li>';
            echo houzez_property_size( 'after' );
            echo '</li>';
        }

    }
}

if( !function_exists('houzez_property_size ') ) {
    function houzez_property_size( $position ) {

        $propID = get_the_ID();
        if( $position == 'before' ) {
            $prop_size = houzez_get_listing_size_unit( $propID ).' '.houzez_get_listing_area_size( $propID );
        } else {
            $prop_size = houzez_get_listing_area_size( $propID ).' '.houzez_get_listing_size_unit( $propID );
        }
        return  $prop_size;
    }
}

if( !function_exists('houzez_property_land_area ') ) {
    function houzez_property_land_area( $position ) {

        $propID = get_the_ID();
        $land_area_unit = get_post_meta( $propID, 'fave_property_land_postfix', true);
        $land_area = get_post_meta( $propID, 'fave_property_land', true);

        if( $position == 'before' ) {
            $prop_size = esc_attr($land_area_unit).' '.esc_attr($land_area);
        } else {
            $prop_size = esc_attr($land_area).' '.esc_attr($land_area_unit);
        }
        return  $prop_size;
    }
}

if( !function_exists('houzez_property_size_by_id ') ) {
    function houzez_property_size_by_id( $propID, $position ) {

        // Since v1.3.0
        if( $position == 'before' ) {
            $prop_size = houzez_get_listing_size_unit( $propID ).' '.houzez_get_listing_area_size( $propID );
        } else {
            $prop_size = houzez_get_listing_area_size( $propID ).' '.houzez_get_listing_size_unit( $propID );
        }
        return  $prop_size;
    }
}

if( !function_exists('houzez_property_slider_meta ') ) {
    function houzez_property_slider_meta()
    {
        $propID = get_the_ID();
        $prop_bed     = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
        $prop_bath     = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
        $prop_size     = get_post_meta( get_the_ID(), 'fave_property_size', true );

        $measurement_unit_global = houzez_option('measurement_unit_global');
        if( $measurement_unit_global == 1 ) {
            $prop_size_prefix = houzez_option('measurement_unit');
        } else {
            $prop_size_prefix = get_post_meta(get_the_ID(), 'fave_property_size_prefix', true);
        }

        echo '<ul class="list-inline">';
        if( !empty( $prop_bed ) ) {
            $prop_bed = esc_attr( $prop_bed );
            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Beds', 'houzez' ) : esc_html__( 'Bed', 'houzez' );

            echo '<li>';
            echo '<strong>'.$prop_bed_lebel .':</strong> '. $prop_bed;
            echo '</li>';
        }
        if( !empty( $prop_bath ) ) {
            $prop_bath = esc_attr( $prop_bath );
            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Baths', 'houzez' ) : esc_html__( 'Bath', 'houzez' );

            echo '<li>';
            echo '<strong>'.$prop_bath_lebel .'</strong> '. $prop_bath;
            echo '</li>';
        }
        if( !empty( $prop_size ) ) {
            $prop_size = esc_attr( $prop_size );

            echo '<li>';
            echo '<strong>'.houzez_get_listing_size_unit( $propID ) .':</strong> '. houzez_get_listing_area_size( $propID );
            echo '</li>';
        }
        echo '</ul>';

    }
}

/*-----------------------------------------------------------------------------------*/
// Featured image place holder
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_image_placeholder')){
    function houzez_get_image_placeholder( $image_size ){

        global $_wp_additional_image_sizes;
        $img_width = 0;
        $img_height = 0;
        $img_text = get_bloginfo('name');

        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

            $img_width = get_option( $image_size . '_size_w' );
            $img_height = get_option( $image_size . '_size_h' );

        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

            $img_width = $_wp_additional_image_sizes[ $image_size ]['width'];
            $img_height = $_wp_additional_image_sizes[ $image_size ]['height'];

        }

        if( intval( $img_width ) > 0 && intval( $img_height ) > 0 ) {
            return '<img src="http://placehold.it/' . $img_width . 'x' . $img_height . '&text=' . urlencode( $img_text ) . '" />';
        }

        return '';
    }
}

if( !function_exists( 'houzez_image_placeholder' ) ) {
    function houzez_image_placeholder( $image_size ) {
        echo houzez_get_image_placeholder( $image_size );
    }
}

if( !function_exists('houzez_get_image_placeholder_url')){
    function houzez_get_image_placeholder_url( $image_size ){

        global $_wp_additional_image_sizes;
        $img_width = 0;
        $img_height = 0;
        $img_text = get_bloginfo('name');

        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

            $img_width = get_option( $image_size . '_size_w' );
            $img_height = get_option( $image_size . '_size_h' );

        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

            $img_width = $_wp_additional_image_sizes[ $image_size ]['width'];
            $img_height = $_wp_additional_image_sizes[ $image_size ]['height'];

        }

        if( intval( $img_width ) > 0 && intval( $img_height ) > 0 ) {
            return 'http://placehold.it/' . $img_width . 'x' . $img_height . '&text=' . urlencode( $img_text ) . '';
        }

        return '';
    }
}

/*-----------------------------------------------------------------------------------*/
// Get submit property url
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_dashboard_add_listing') ) {
    function houzez_dashboard_add_listing() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/submit_property.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get required *
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_required_field') ) {
    function houzez_required_field( $field ) {
        if( $field != 0 ) {
            return '*';
        }
        return '';
    }
}

/*-----------------------------------------------------------------------------------*/
// Get user properties dashboard
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_dashboard_listings') ) {
    function houzez_dashboard_listings() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_dashboard_properties.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get favorites properties dashboard
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_dashboard_favorites_link') ) {
    function houzez_dashboard_favorites_link() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_dashboard_favorites.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get template link
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_template_link') ) {
    function houzez_get_template_link($template) {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $template
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get template link
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_template_link_2') ) {
    function houzez_get_template_link_2($template) {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $template
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = '';
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get Saved Search dashboard
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_dashboard_saved_search_link') ) {
    function houzez_dashboard_saved_search_link() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_dashboard_saved_search.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get search page link
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_search_template_link') ) {
    function houzez_get_search_template_link() {

        $search_result_page = houzez_option('search_result_page');
        if( $search_result_page == 'half_map' ) {
            $template = 'template/property-listings-map.php';
        } else {
            $template = 'template/template-search.php';
        }

        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $template
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

if( !function_exists('houzez_properties_listing_link') ) {
    function houzez_properties_listing_link() {
        global $post;
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/property-listing-template.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $post->ID );//get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

if( !function_exists('houzez_properties_listing_full_link') ) {
    function houzez_properties_listing_full_link() {
        global $post;
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/property-listing-fullwidth.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $post->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}



/*-----------------------------------------------------------------------------------*/
// Get Invoices dashboard
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_dashboard_invoices_link') ) {
    function houzez_dashboard_invoices_link() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_dashboard_invoices.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

/*-----------------------------------------------------------------------------------*/
// Generate Hirarchical terms
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_hirarchical_options')){
    function houzez_hirarchical_options($taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ){

        if (!empty($taxonomy_terms) && taxonomy_exists($taxonomy_name)) {
            foreach ($taxonomy_terms as $term) {

                if( $taxonomy_name == 'property_area' ) {
                    $term_meta= get_option( "_houzez_property_area_$term->term_id");
                    $parent_city = sanitize_title($term_meta['parent_city']);

                    if ($searched_term == $term->slug) {
                        echo '<option data-parentcity="'.$parent_city.'" value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                    } else {
                        echo '<option data-parentcity="'.$parent_city.'" value="' . $term->slug . '">' . $prefix . $term->name .'</option>';
                    }
                } elseif( $taxonomy_name == 'property_city' ) {
                    $term_meta= get_option( "_houzez_property_city_$term->term_id");
                    $parent_state = sanitize_title($term_meta['parent_state']);

                    if ($searched_term == $term->slug) {
                        echo '<option data-parentstate="'.$parent_state.'" value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                    } else {
                        echo '<option data-parentstate="'.$parent_state.'" value="' . $term->slug . '">' . $prefix . $term->name .'</option>';
                    }
                }  elseif( $taxonomy_name == 'property_state' ) {
                    $term_meta= get_option( "_houzez_property_state_$term->term_id");
                    $parent_country = sanitize_title($term_meta['parent_country']);

                    if ($searched_term == $term->slug) {
                        echo '<option data-parentcountry="'.$parent_country.'" value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                    } else {
                        echo '<option data-parentcountry="'.$parent_country.'" value="' . $term->slug . '">' . $prefix . $term->name .'</option>';
                    }
                } else {
                    if ($searched_term == $term->slug) {
                        echo '<option value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                    } else {
                        echo '<option value="' . $term->slug . '">' . $prefix . $term->name . '</option>';
                    }
                }


                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    /* Recursive Call */
                    houzez_hirarchical_options( $taxonomy_name, $child_terms, $searched_term, "- ".$prefix );
                }
            }
        }
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property type tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_type_id_array' ) ) {
    function houzez_get_property_type_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_type',
        ));

        $houzez_property_type_id_array_walker = new houzez_property_type_id_array_walker;
        $houzez_property_type_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All Types -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_type_id_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_type_id_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_type_id_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property type tree by slug
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_type_slug_array' ) ) {
    function houzez_get_property_type_slug_array($add_all_category = true) {


        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_type',
        ));

        $houzez_property_type_slug_array_walker = new houzez_property_type_slug_array_walker;
        $houzez_property_type_slug_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All Types -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_type_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_type_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_type_slug_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property status tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_status_id_array' ) ) {
    function houzez_get_property_status_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_status',
        ));

        $houzez_property_status_id_array_walker = new houzez_property_status_id_array_walker;
        $houzez_property_status_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_status_id_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_status_id_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_status_id_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property status tree slug
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_status_slug_array' ) ) {
    function houzez_get_property_status_slug_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_status',
        ));

        $houzez_property_status_slug_array_walker = new houzez_property_status_slug_array_walker;
        $houzez_property_status_slug_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_status_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_status_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_status_slug_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property city tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_city_id_array' ) ) {
    function houzez_get_property_city_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_city',
        ));

        $houzez_property_city_id_array_walker = new houzez_property_city_id_array_walker;
        $houzez_property_city_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_city_id_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_city_id_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_city_id_array_walker extends Walker {
    var $tree_type = 'property_city';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property city tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_city_slug_array' ) ) {
    function houzez_get_property_city_slug_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_city',
        ));

        $houzez_property_city_slug_array_walker = new houzez_property_city_slug_array_walker;
        $houzez_property_city_slug_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_city_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_city_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_city_slug_array_walker extends Walker {
    var $tree_type = 'property_city';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}


if( !function_exists('houzez_count_property_views') ) {
    function houzez_count_property_views( $prop_id ) {

        $total_views = intval( get_post_meta($prop_id, 'houzez_total_property_views', true) );

        if( $total_views != '' ) {
            $total_views++;
        } else {
            $total_views = 1;
        }
        update_post_meta( $prop_id, 'houzez_total_property_views', $total_views );

        $today = date('m-d-Y', time());
        //$today = date('m-d-Y', strtotime("-1 days"));
        $views_by_date = get_post_meta($prop_id, 'houzez_views_by_date', true);

        if( $views_by_date != '' || is_array($views_by_date) ) {
            if (!isset($views_by_date[$today])) {

                if (count($views_by_date) > 60) {
                    array_shift($views_by_date);
                }
                $views_by_date[$today] = 1;

            } else {
                $views_by_date[$today] = intval($views_by_date[$today]) + 1;
            }
        } else {
            $views_by_date = array();
            $views_by_date[$today] = 1;
        }

        update_post_meta($prop_id, 'houzez_views_by_date', $views_by_date);
        update_post_meta($prop_id, 'houzez_recently_viewed', $today);

    }
}

if( !function_exists('houzez_return_traffic_labels') ) {
    function houzez_return_traffic_labels( $prop_id ) {

        $record_days = houzez_option('houzez_stats_days');
        if( empty($record_days) ) {
            $record_days = 14;
        }

        $views_by_date = get_post_meta($prop_id, 'houzez_views_by_date', true);

        if (!is_array($views_by_date)) {
            $views_by_date = array();
        }
        $array_labels = array_keys($views_by_date);
        $array_labels = array_slice( $array_labels, -1 * $record_days, $record_days, false );

        return $array_labels;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property state tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_state_slug_array' ) ) {
    function houzez_get_property_state_slug_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_state',
        ));

        $houzez_property_state_slug_array_walker = new houzez_property_state_slug_array_walker;
        $houzez_property_state_slug_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_state_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_state_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_state_slug_array_walker extends Walker {
    var $tree_type = 'property_state';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a property post type property area tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_property_area_slug_array' ) ) {
    function houzez_get_property_area_slug_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'property_area',
        ));

        $houzez_property_area_slug_array_walker = new houzez_property_area_slug_array_walker;
        $houzez_property_area_slug_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_property_area_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_property_area_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_property_area_slug_array_walker extends Walker {
    var $tree_type = 'property_area';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

if( !function_exists('houzez_return_traffic_data') ) {
    function houzez_return_traffic_data($prop_id) {

        $record_days = houzez_option('houzez_stats_days');
        if( empty($record_days) ) {
            $record_days = 14;
        }

        $views_by_date = get_post_meta( $prop_id, 'houzez_views_by_date', true );
        if ( !is_array( $views_by_date ) ) {
            $views_by_date = array();
        }
        $array_values = array_values( $views_by_date );
        $array_values = array_slice( $array_values, -1 * $record_days, $record_days, false );

        return $array_values;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a taxonomy tree slug array
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'houzez_get_agent_category_slug_array' ) ) {
    function houzez_get_agent_category_slug_array($add_all_taxonomy = true ) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'agent_category',
        ));

        $houzez_get_agent_category_slug_array_walker = new houzez_get_agent_category_slug_array_walker;
        $houzez_get_agent_category_slug_array_walker->walk($categories, 4);

        if ($add_all_taxonomy === true) {
            $categories_buffer['- All -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_get_agent_category_slug_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_get_agent_category_slug_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_get_agent_category_slug_array_walker extends Walker {
    var $tree_type = 'agent_category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/*-----------------------------------------------------------------------------------*/
// Generate ID Based Hirarchical Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_id_based_hirarchical_options')){
    function houzez_id_based_hirarchical_options($taxonomy_name, $taxonomy_terms, $target_term_id, $prefix = " " ){
        if (!empty($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {
                if ($target_term_id == $term->term_id) {
                    echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
                }
                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    /* Recursive Call */
                    houzez_id_based_hirarchical_options( $taxonomy_name, $child_terms, $target_term_id, "- ".$prefix );
                }
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Generate ID Based Hirarchical Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_taxonomy_hirarchical_options_for_search')){
    function houzez_taxonomy_hirarchical_options_for_search($taxonomy_name, $taxonomy_terms, $target_term_name, $prefix = " " ){
        if (!empty($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {
                if ($target_term_name == $term->name) {
                    echo '<option value="' . $term->name . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->name . '">' . $prefix . $term->name . '</option>';
                }
                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    /* Recursive Call */
                    houzez_taxonomy_hirarchical_options_for_search( $taxonomy_name, $child_terms, $target_term_name, "- ".$prefix );
                }
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Get taxonomy by post id and taxonomy name
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_taxonomy_by_postID')){
    function houzez_taxonomy_by_postID( $property_id, $taxonomy_name ){

        $tax_terms = get_the_terms( $property_id, $taxonomy_name );
        $tax_name = '';
        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $tax_name = $tax_term->name;
                break;
            }
        }
        return $tax_name;
    }
}

/* -----------------------------------------------------------------------------------------------------------
 *  Get user current listings
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_current_listings') ):
    function houzez_get_current_listings( $userID ) {
        $args = array(
            'post_type'   => 'property',
            'post_status' => 'any',
            'author'      => $userID,

        );
        $posts = new WP_Query( $args );
        return $posts->found_posts;
        wp_reset_postdata();
    }
endif;

/* -----------------------------------------------------------------------------------------------------------
 *  Get user current featured listings
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_current_featured_listings') ):
    function houzez_get_current_featured_listings( $userID ) {

        $args = array(
            'post_type'     =>  'property',
            'post_status'   =>  'any',
            'author'        =>  $userID,
            'meta_query'    =>  array(
                array(
                    'key'   => 'fave_featured',
                    'value' => 1,
                    'meta_compare '=>'='
                )
            )
        );
        $posts = new WP_Query( $args );
        return $posts->found_posts;
        wp_reset_postdata();

    }
endif;

/*-----------------------------------------------------------------------------------*/
// Propert Edit Form Hierarchichal Taxonomy Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_edit_form_hierarchichal_options')){
    function houzez_edit_form_hierarchichal_options( $property_id, $taxonomy_name ){

        $existing_term_id = 0;
        $tax_terms = get_the_terms( $property_id, $taxonomy_name );

        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $existing_term_id = $tax_term->term_id;
                break;
            }
        }

        $existing_term_id = intval($existing_term_id);
        if( $existing_term_id == 0 || empty($existing_term_id) ){
            echo '<option value="-1" selected="selected">'.esc_html__( 'None', 'houzez').'</option>';
        } else {
            echo '<option value="-1">'.esc_html__( 'None', 'houzez').'</option>';
        }

        $top_level_terms = get_terms(
            array(
                $taxonomy_name
            ),
            array(
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'parent' => 0
            )
        );
        houzez_id_based_hirarchical_options( $taxonomy_name, $top_level_terms, $existing_term_id );

    }
}

/*-----------------------------------------------------------------------------------*/
// Propert Edit Form Hierarchichal Taxonomy Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_taxonomy_edit_hirarchical_options_for_search')){
    function houzez_taxonomy_edit_hirarchical_options_for_search( $property_id, $taxonomy_name ){

        $existing_term_name = '';
        $tax_terms = get_the_terms( $property_id, $taxonomy_name );

        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $existing_term_name = $tax_term->name;
                break;
            }
        }

        if( empty($existing_term_name) ){
            echo '<option value="" selected="selected">'.esc_html__( 'None', 'houzez').'</option>';
        } else {
            echo '<option value="">'.esc_html__( 'None', 'houzez').'</option>';
        }

        $top_level_terms = get_terms(
            array(
                $taxonomy_name
            ),
            array(
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'parent' => 0
            )
        );
        houzez_taxonomy_hirarchical_options_for_search( $taxonomy_name, $top_level_terms, $existing_term_name );

    }
}

/* ------------------------------------------------------------------------------
/  Country list function
/ ------------------------------------------------------------------------------ */
if( !function_exists('houzez_country_list') ):
    function houzez_country_list($selected, $class='') {
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique","Montenegro", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles","Serbia", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
        $country_select = '<select id="property_country"  name="property_country" class="'.$class.'">';

        foreach ($countries as $country) {
            $country_select.='<option value="' . $country . '"';
            if ($selected == $country) {
                $country_select.='selected="selected"';
            }
            $country_select.='>' . $country . '</option>';
        }

        $country_select.='</select>';
        return $country_select;
    }
endif; // end   houzez_country_list

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Get excerpt with limit and read more on/off
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'houzez_clean_excerpt' ) ) {
    function houzez_clean_excerpt ($fave_characters, $fave_read_more = false) {
        global $post;
        $fave_excerpt_output = $post->post_excerpt;

        if ( $fave_excerpt_output == NULL ) {

            $fave_excerpt_output = get_the_content();
            $fave_excerpt_output = preg_replace(" (\[.*?\])",'',$fave_excerpt_output);
            $fave_excerpt_output = strip_shortcodes($fave_excerpt_output);
            $fave_excerpt_output = strip_tags($fave_excerpt_output);
            $fave_characters = intval($fave_characters);
            $fave_excerpt_output = substr( $fave_excerpt_output, 0, $fave_characters );
            $fave_excerpt_output = substr( $fave_excerpt_output, 0, strripos($fave_excerpt_output, " ") );
            $fave_excerpt_output = trim( preg_replace( '/\s+/', ' ', $fave_excerpt_output) );

            if ( $fave_read_more != "false" ) {
                $fave_excerpt_output = $fave_excerpt_output.'. <a class="continue-reading" href="'. get_permalink() .'">'.esc_html__( "Continue reading", "houzez").' <i class="fa fa-angle-double-right"></i></a>';
            } else {
                $fave_excerpt_output = $fave_excerpt_output . '...';
            }
        }

        return $fave_excerpt_output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   Generates a category tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */
if ( ! function_exists( 'houzez_get_category_id_array' ) ) {
    function houzez_get_category_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0
        ));

        $houzez_category_id_array_walker = new houzez_category_id_array_walker;
        $houzez_category_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                $houzez_category_id_array_walker->houzez_array_buffer
            );
        } else {
            return $houzez_category_id_array_walker->houzez_array_buffer;
        }
    }
}

class houzez_category_id_array_walker extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $houzez_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->houzez_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/* --------------------------------------------------------------------------
 * Generate Unique ID each elemement
 ---------------------------------------------------------------------------*/
if ( !function_exists('houzez_unique_key') ) {

    function houzez_unique_key(){

        $key = uniqid();
        return $key;
    }
}

/* --------------------------------------------------------------------------
 * Walkscore API
 ---------------------------------------------------------------------------*/

if( !function_exists('houzez_walkscore') ) {
    function houzez_walkscore($post_id) {

        $walkscore_api = houzez_option('houzez_walkscore_api');
        $property_location = get_post_meta( $post_id,'fave_property_location',true);
        $lat_lng = explode(',', $property_location);

        $address = stripslashes($property_location);
        $address = urlencode( $address );


        $url = "http://api.walkscore.com/score?format=json&address=$address";
        $url .= "&lat=$lat_lng[0]&lon=$lat_lng[1]&wsapikey=$walkscore_api";

        $response = wp_remote_get( $url, array( 'timeout' => 120 ) );
        if ( is_array( $response ) ) {
            $body   = wp_remote_retrieve_body($response); // use the content
            $walkscore = json_decode( $body ); // json decode

            print '<div class="walkscore_details"><img src="https://cdn.walk.sc/images/api-logo.png" alt="walkscore">';
            print '<span>' . $walkscore->walkscore . ' / ' . $walkscore->description;
            print ' <a href="' . $walkscore->ws_link . '" target="_blank">' . __('more details here', 'houzez') . '</a> </span></div>';

        }

    }
}

/* ------------------------------------------------------------------------------
/  Country Code to Country Name
/ ------------------------------------------------------------------------------ */
if( !function_exists('HOUZEZ_billing_period') ) {
    function HOUZEZ_billing_period($biling_period) {

        if ($biling_period == 'Day') {
            return esc_html__('day', 'houzez');
        } else if ($biling_period == 'Days') {
            return esc_html__('days', 'houzez');
        } else if ($biling_period == 'Week') {
            return esc_html__('week', 'houzez');
        } else if ($biling_period == 'Weeks') {
            return esc_html__('weeks', 'houzez');
        } else if ($biling_period == 'Month') {
            return esc_html__('month', 'houzez');
        } else if ($biling_period == 'Months') {
            return esc_html__('months', 'houzez');
        } else if ($biling_period == 'Year') {
            return esc_html__('year', 'houzez');
        }
    }
}

/* ------------------------------------------------------------------------------
/  Country Code to Country Name
/ ------------------------------------------------------------------------------ */
if( !function_exists('houzez_country_code_to_country') ):
function houzez_country_code_to_country( $code ){
    $country = '';
    if( $code == 'AF' ) $country = esc_html__('Afghanistan', 'houzez');
    if( $code == 'AX' ) $country = esc_html__('Aland Islands', 'houzez');
    if( $code == 'AL' ) $country = esc_html__('Albania', 'houzez');
    if( $code == 'DZ' ) $country = esc_html__('Algeria', 'houzez');
    if( $code == 'AS' ) $country = esc_html__('American Samoa', 'houzez');
    if( $code == 'AD' ) $country = esc_html__('Andorra', 'houzez');
    if( $code == 'AO' ) $country = esc_html__('Angola', 'houzez');
    if( $code == 'AI' ) $country = esc_html__('Anguilla', 'houzez');
    if( $code == 'AQ' ) $country = esc_html__('Antarctica', 'houzez');
    if( $code == 'AG' ) $country = esc_html__('Antigua and Barbuda', 'houzez');
    if( $code == 'AR' ) $country = esc_html__('Argentina', 'houzez');
    if( $code == 'AM' ) $country = esc_html__('Armenia', 'houzez');
    if( $code == 'AW' ) $country = esc_html__('Aruba', 'houzez');
    if( $code == 'AU' ) $country = esc_html__('Australia', 'houzez');
    if( $code == 'AT' ) $country = esc_html__('Austria', 'houzez');
    if( $code == 'AZ' ) $country = esc_html__('Azerbaijan', 'houzez');
    if( $code == 'BS' ) $country = esc_html__('Bahamas the', 'houzez');
    if( $code == 'BH' ) $country = esc_html__('Bahrain', 'houzez');
    if( $code == 'BD' ) $country = esc_html__('Bangladesh', 'houzez');
    if( $code == 'BB' ) $country = esc_html__('Barbados', 'houzez');
    if( $code == 'BY' ) $country = esc_html__('Belarus', 'houzez');
    if( $code == 'BE' ) $country = esc_html__('Belgium', 'houzez');
    if( $code == 'BZ' ) $country = esc_html__('Belize', 'houzez');
    if( $code == 'BJ' ) $country = esc_html__('Benin', 'houzez');
    if( $code == 'BM' ) $country = esc_html__('Bermuda', 'houzez');
    if( $code == 'BT' ) $country = esc_html__('Bhutan', 'houzez');
    if( $code == 'BO' ) $country = esc_html__('Bolivia', 'houzez');
    if( $code == 'BA' ) $country = esc_html__('Bosnia and Herzegovina', 'houzez');
    if( $code == 'BW' ) $country = esc_html__('Botswana', 'houzez');
    if( $code == 'BV' ) $country = esc_html__('Bouvet Island (Bouvetoya)', 'houzez');
    if( $code == 'BR' ) $country = esc_html__('Brazil', 'houzez');
    if( $code == 'IO' ) $country = esc_html__('British Indian Ocean Territory (Chagos Archipelago)', 'houzez');
    if( $code == 'VG' ) $country = esc_html__('British Virgin Islands', 'houzez');
    if( $code == 'BN' ) $country = esc_html__('Brunei Darussalam', 'houzez');
    if( $code == 'BG' ) $country = esc_html__('Bulgaria', 'houzez');
    if( $code == 'BF' ) $country = esc_html__('Burkina Faso', 'houzez');
    if( $code == 'BI' ) $country = esc_html__('Burundi', 'houzez');
    if( $code == 'KH' ) $country = esc_html__('Cambodia', 'houzez');
    if( $code == 'CM' ) $country = esc_html__('Cameroon', 'houzez');
    if( $code == 'CA' ) $country = esc_html__('Canada', 'houzez');
    if( $code == 'CV' ) $country = esc_html__('Cape Verde', 'houzez');
    if( $code == 'KY' ) $country = esc_html__('Cayman Islands', 'houzez');
    if( $code == 'CF' ) $country = esc_html__('Central African Republic', 'houzez');
    if( $code == 'TD' ) $country = esc_html__('Chad', 'houzez');
    if( $code == 'CL' ) $country = esc_html__('Chile', 'houzez');
    if( $code == 'CN' ) $country = esc_html__('China', 'houzez');
    if( $code == 'CX' ) $country = esc_html__('Christmas Island', 'houzez');
    if( $code == 'CC' ) $country = esc_html__('Cocos (Keeling) Islands', 'houzez');
    if( $code == 'CO' ) $country = esc_html__('Colombia', 'houzez');
    if( $code == 'KM' ) $country = esc_html__('Comoros the', 'houzez');
    if( $code == 'CD' ) $country = esc_html__('Congo', 'houzez');
    if( $code == 'CG' ) $country = esc_html__('Congo the', 'houzez');
    if( $code == 'CK' ) $country = esc_html__('Cook Islands', 'houzez');
    if( $code == 'CR' ) $country = esc_html__('Costa Rica', 'houzez');
    if( $code == 'CI' ) $country = esc_html__("Cote d'Ivoire", 'houzez');
    if( $code == 'HR' ) $country = esc_html__('Croatia', 'houzez');
    if( $code == 'CU' ) $country = esc_html__('Cuba', 'houzez');
    if( $code == 'CY' ) $country = esc_html__('Cyprus', 'houzez');
    if( $code == 'CZ' ) $country = esc_html__('Czech Republic', 'houzez');
    if( $code == 'DK' ) $country = esc_html__('Denmark', 'houzez');
    if( $code == 'DJ' ) $country = esc_html__('Djibouti', 'houzez');
    if( $code == 'DM' ) $country = esc_html__('Dominica', 'houzez');
    if( $code == 'DO' ) $country = esc_html__('Dominican Republic', 'houzez');
    if( $code == 'EC' ) $country = esc_html__('Ecuador', 'houzez');
    if( $code == 'EG' ) $country = esc_html__('Egypt', 'houzez');
    if( $code == 'SV' ) $country = esc_html__('El Salvador', 'houzez');
    if( $code == 'GQ' ) $country = esc_html__('Equatorial Guinea', 'houzez');
    if( $code == 'ER' ) $country = esc_html__('Eritrea', 'houzez');
    if( $code == 'EE' ) $country = esc_html__('Estonia', 'houzez');
    if( $code == 'ET' ) $country = esc_html__('Ethiopia', 'houzez');
    if( $code == 'FO' ) $country = esc_html__('Faroe Islands', 'houzez');
    if( $code == 'FK' ) $country = esc_html__('Falkland Islands (Malvinas)', 'houzez');
    if( $code == 'FJ' ) $country = esc_html__('Fiji the Fiji Islands', 'houzez');
    if( $code == 'FI' ) $country = esc_html__('Finland', 'houzez');
    if( $code == 'FR' ) $country = esc_html__('France', 'houzez');
    if( $code == 'GF' ) $country = esc_html__('French Guiana', 'houzez');
    if( $code == 'PF' ) $country = esc_html__('French Polynesia', 'houzez');
    if( $code == 'TF' ) $country = esc_html__('French Southern Territories', 'houzez');
    if( $code == 'GA' ) $country = esc_html__('Gabon', 'houzez');
    if( $code == 'GM' ) $country = esc_html__('Gambia the', 'houzez');
    if( $code == 'GE' ) $country = esc_html__('Georgia', 'houzez');
    if( $code == 'DE' ) $country = esc_html__('Germany', 'houzez');
    if( $code == 'GH' ) $country = esc_html__('Ghana', 'houzez');
    if( $code == 'GI' ) $country = esc_html__('Gibraltar', 'houzez');
    if( $code == 'GR' ) $country = esc_html__('Greece', 'houzez');
    if( $code == 'GL' ) $country = esc_html__('Greenland', 'houzez');
    if( $code == 'GD' ) $country = esc_html__('Grenada', 'houzez');
    if( $code == 'GP' ) $country = esc_html__('Guadeloupe', 'houzez');
    if( $code == 'GU' ) $country = esc_html__('Guam', 'houzez');
    if( $code == 'GT' ) $country = esc_html__('Guatemala', 'houzez');
    if( $code == 'GG' ) $country = esc_html__('Guernsey', 'houzez');
    if( $code == 'GN' ) $country = esc_html__('Guinea', 'houzez');
    if( $code == 'GW' ) $country = esc_html__('Guinea-Bissau', 'houzez');
    if( $code == 'GY' ) $country = esc_html__('Guyana', 'houzez');
    if( $code == 'HT' ) $country = esc_html__('Haiti', 'houzez');
    if( $code == 'HM' ) $country = esc_html__('Heard Island and McDonald Islands', 'houzez');
    if( $code == 'VA' ) $country = esc_html__('Holy See (Vatican City State)', 'houzez');
    if( $code == 'HN' ) $country = esc_html__('Honduras', 'houzez');
    if( $code == 'HK' ) $country = esc_html__('Hong Kong', 'houzez');
    if( $code == 'HU' ) $country = esc_html__('Hungary', 'houzez');
    if( $code == 'IS' ) $country = esc_html__('Iceland', 'houzez');
    if( $code == 'IN' ) $country = esc_html__('India', 'houzez');
    if( $code == 'ID' ) $country = esc_html__('Indonesia', 'houzez');
    if( $code == 'IR' ) $country = esc_html__('Iran', 'houzez');
    if( $code == 'IQ' ) $country = esc_html__('Iraq', 'houzez');
    if( $code == 'IE' ) $country = esc_html__('Ireland', 'houzez');
    if( $code == 'IM' ) $country = esc_html__('Isle of Man', 'houzez');
    if( $code == 'IL' ) $country = esc_html__('Israel', 'houzez');
    if( $code == 'IT' ) $country = esc_html__('Italy', 'houzez');
    if( $code == 'JM' ) $country = esc_html__('Jamaica', 'houzez');
    if( $code == 'JP' ) $country = esc_html__('Japan', 'houzez');
    if( $code == 'JE' ) $country = esc_html__('Jersey', 'houzez');
    if( $code == 'JO' ) $country = esc_html__('Jordan', 'houzez');
    if( $code == 'KZ' ) $country = esc_html__('Kazakhstan', 'houzez');
    if( $code == 'KE' ) $country = esc_html__('Kenya', 'houzez');
    if( $code == 'KI' ) $country = esc_html__('Kiribati', 'houzez');
    if( $code == 'KP' ) $country = esc_html__('Korea', 'houzez');
    if( $code == 'KR' ) $country = esc_html__('Korea', 'houzez');
    if( $code == 'KW' ) $country = esc_html__('Kuwait', 'houzez');
    if( $code == 'KG' ) $country = esc_html__('Kyrgyz Republic', 'houzez');
    if( $code == 'LA' ) $country = esc_html__('Lao', 'houzez');
    if( $code == 'LV' ) $country = esc_html__('Latvia', 'houzez');
    if( $code == 'LB' ) $country = esc_html__('Lebanon', 'houzez');
    if( $code == 'LS' ) $country = esc_html__('Lesotho', 'houzez');
    if( $code == 'LR' ) $country = esc_html__('Liberia', 'houzez');
    if( $code == 'LY' ) $country = esc_html__('Libyan Arab Jamahiriya', 'houzez');
    if( $code == 'LI' ) $country = esc_html__('Liechtenstein', 'houzez');
    if( $code == 'LT' ) $country = esc_html__('Lithuania', 'houzez');
    if( $code == 'LU' ) $country = esc_html__('Luxembourg', 'houzez');
    if( $code == 'MO' ) $country = esc_html__('Macao', 'houzez');
    if( $code == 'MK' ) $country = esc_html__('Macedonia', 'houzez');
    if( $code == 'MG' ) $country = esc_html__('Madagascar', 'houzez');
    if( $code == 'MW' ) $country = esc_html__('Malawi', 'houzez');
    if( $code == 'MY' ) $country = esc_html__('Malaysia', 'houzez');
    if( $code == 'MV' ) $country = esc_html__('Maldives', 'houzez');
    if( $code == 'ML' ) $country = esc_html__('Mali', 'houzez');
    if( $code == 'MT' ) $country = esc_html__('Malta', 'houzez');
    if( $code == 'MH' ) $country = esc_html__('Marshall Islands', 'houzez');
    if( $code == 'MQ' ) $country = esc_html__('Martinique', 'houzez');
    if( $code == 'MR' ) $country = esc_html__('Mauritania', 'houzez');
    if( $code == 'MU' ) $country = esc_html__('Mauritius', 'houzez');
    if( $code == 'YT' ) $country = esc_html__('Mayotte', 'houzez');
    if( $code == 'MX' ) $country = esc_html__('Mexico', 'houzez');
    if( $code == 'FM' ) $country = esc_html__('Micronesia', 'houzez');
    if( $code == 'MD' ) $country = esc_html__('Moldova', 'houzez');
    if( $code == 'MC' ) $country = esc_html__('Monaco', 'houzez');
    if( $code == 'MN' ) $country = esc_html__('Mongolia', 'houzez');
    if( $code == 'ME' ) $country = esc_html__('Montenegro', 'houzez');
    if( $code == 'MS' ) $country = esc_html__('Montserrat', 'houzez');
    if( $code == 'MA' ) $country = esc_html__('Morocco', 'houzez');
    if( $code == 'MZ' ) $country = esc_html__('Mozambique', 'houzez');
    if( $code == 'MM' ) $country = esc_html__('Myanmar', 'houzez');
    if( $code == 'NA' ) $country = esc_html__('Namibia', 'houzez');
    if( $code == 'NR' ) $country = esc_html__('Nauru', 'houzez');
    if( $code == 'NP' ) $country = esc_html__('Nepal', 'houzez');
    if( $code == 'AN' ) $country = esc_html__('Netherlands Antilles', 'houzez');
    if( $code == 'NL' ) $country = esc_html__('Netherlands the', 'houzez');
    if( $code == 'NC' ) $country = esc_html__('New Caledonia', 'houzez');
    if( $code == 'NZ' ) $country = esc_html__('New Zealand', 'houzez');
    if( $code == 'NI' ) $country = esc_html__('Nicaragua', 'houzez');
    if( $code == 'NE' ) $country = esc_html__('Niger', 'houzez');
    if( $code == 'NG' ) $country = esc_html__('Nigeria', 'houzez');
    if( $code == 'NU' ) $country = esc_html__('Niue', 'houzez');
    if( $code == 'NF' ) $country = esc_html__('Norfolk Island', 'houzez');
    if( $code == 'MP' ) $country = esc_html__('Northern Mariana Islands', 'houzez');
    if( $code == 'NO' ) $country = esc_html__('Norway', 'houzez');
    if( $code == 'OM' ) $country = esc_html__('Oman', 'houzez');
    if( $code == 'PK' ) $country = esc_html__('Pakistan', 'houzez');
    if( $code == 'PW' ) $country = esc_html__('Palau', 'houzez');
    if( $code == 'PS' ) $country = esc_html__('Palestinian Territory', 'houzez');
    if( $code == 'PA' ) $country = esc_html__('Panama', 'houzez');
    if( $code == 'PG' ) $country = esc_html__('Papua New Guinea', 'houzez');
    if( $code == 'PY' ) $country = esc_html__('Paraguay', 'houzez');
    if( $code == 'PE' ) $country = esc_html__('Peru', 'houzez');
    if( $code == 'PH' ) $country = esc_html__('Philippines', 'houzez');
    if( $code == 'PN' ) $country = esc_html__('Pitcairn Islands', 'houzez');
    if( $code == 'PL' ) $country = esc_html__('Poland', 'houzez');
    if( $code == 'PT' ) $country = esc_html__('Portugal, Portuguese Republic', 'houzez');
    if( $code == 'PR' ) $country = esc_html__('Puerto Rico', 'houzez');
    if( $code == 'QA' ) $country = esc_html__('Qatar', 'houzez');
    if( $code == 'RE' ) $country = esc_html__('Reunion', 'houzez');
    if( $code == 'RO' ) $country = esc_html__('Romania', 'houzez');
    if( $code == 'RU' ) $country = esc_html__('Russian Federation', 'houzez');
    if( $code == 'RW' ) $country = esc_html__('Rwanda', 'houzez');
    if( $code == 'BL' ) $country = esc_html__('Saint Barthelemy', 'houzez');
    if( $code == 'SH' ) $country = esc_html__('Saint Helena', 'houzez');
    if( $code == 'KN' ) $country = esc_html__('Saint Kitts and Nevis', 'houzez');
    if( $code == 'LC' ) $country = esc_html__('Saint Lucia', 'houzez');
    if( $code == 'MF' ) $country = esc_html__('Saint Martin', 'houzez');
    if( $code == 'PM' ) $country = esc_html__('Saint Pierre and Miquelon', 'houzez');
    if( $code == 'VC' ) $country = esc_html__('Saint Vincent and the Grenadines', 'houzez');
    if( $code == 'WS' ) $country = esc_html__('Samoa', 'houzez');
    if( $code == 'SM' ) $country = esc_html__('San Marino', 'houzez');
    if( $code == 'ST' ) $country = esc_html__('Sao Tome and Principe', 'houzez');
    if( $code == 'SA' ) $country = esc_html__('Saudi Arabia', 'houzez');
    if( $code == 'SN' ) $country = esc_html__('Senegal', 'houzez');
    if( $code == 'RS' ) $country = esc_html__('Serbia', 'houzez');
    if( $code == 'SC' ) $country = esc_html__('Seychelles', 'houzez');
    if( $code == 'SL' ) $country = esc_html__('Sierra Leone', 'houzez');
    if( $code == 'SG' ) $country = esc_html__('Singapore', 'houzez');
    if( $code == 'SK' ) $country = esc_html__('Slovakia (Slovak Republic)', 'houzez');
    if( $code == 'SI' ) $country = esc_html__('Slovenia', 'houzez');
    if( $code == 'SB' ) $country = esc_html__('Solomon Islands', 'houzez');
    if( $code == 'SO' ) $country = esc_html__('Somalia, Somali Republic', 'houzez');
    if( $code == 'ZA' ) $country = esc_html__('South Africa', 'houzez');
    if( $code == 'GS' ) $country = esc_html__('South Georgia and the South Sandwich Islands', 'houzez');
    if( $code == 'ES' ) $country = esc_html__('Spain', 'houzez');
    if( $code == 'LK' ) $country = esc_html__('Sri Lanka', 'houzez');
    if( $code == 'SD' ) $country = esc_html__('Sudan', 'houzez');
    if( $code == 'SR' ) $country = esc_html__('Suriname', 'houzez');
    if( $code == 'SJ' ) $country = esc_html__('Svalbard & Jan Mayen Islands', 'houzez');
    if( $code == 'SZ' ) $country = esc_html__('Swaziland', 'houzez');
    if( $code == 'SE' ) $country = esc_html__('Sweden', 'houzez');
    if( $code == 'CH' ) $country = esc_html__('Switzerland, Swiss Confederation', 'houzez');
    if( $code == 'SY' ) $country = esc_html__('Syrian Arab Republic', 'houzez');
    if( $code == 'TW' ) $country = esc_html__('Taiwan', 'houzez');
    if( $code == 'TJ' ) $country = esc_html__('Tajikistan', 'houzez');
    if( $code == 'TZ' ) $country = esc_html__('Tanzania', 'houzez');
    if( $code == 'TH' ) $country = esc_html__('Thailand', 'houzez');
    if( $code == 'TL' ) $country = esc_html__('Timor-Leste', 'houzez');
    if( $code == 'TG' ) $country = esc_html__('Togo', 'houzez');
    if( $code == 'TK' ) $country = esc_html__('Tokelau', 'houzez');
    if( $code == 'TO' ) $country = esc_html__('Tonga', 'houzez');
    if( $code == 'TT' ) $country = esc_html__('Trinidad and Tobago', 'houzez');
    if( $code == 'TN' ) $country = esc_html__('Tunisia', 'houzez');
    if( $code == 'TR' ) $country = esc_html__('Turkey', 'houzez');
    if( $code == 'TM' ) $country = esc_html__('Turkmenistan', 'houzez');
    if( $code == 'TC' ) $country = esc_html__('Turks and Caicos Islands', 'houzez');
    if( $code == 'TV' ) $country = esc_html__('Tuvalu', 'houzez');
    if( $code == 'UG' ) $country = esc_html__('Uganda', 'houzez');
    if( $code == 'UA' ) $country = esc_html__('Ukraine', 'houzez');
    if( $code == 'AE' ) $country = esc_html__('United Arab Emirates', 'houzez');
    if( $code == 'GB' ) $country = esc_html__('United Kingdom', 'houzez');
    if( $code == 'US' ) $country = esc_html__('United States', 'houzez');
    if( $code == 'UM' ) $country = esc_html__('United States Minor Outlying Islands', 'houzez');
    if( $code == 'VI' ) $country = esc_html__('United States Virgin Islands', 'houzez');
    if( $code == 'UY' ) $country = esc_html__('Uruguay, Eastern Republic of', 'houzez');
    if( $code == 'UZ' ) $country = esc_html__('Uzbekistan', 'houzez');
    if( $code == 'VU' ) $country = esc_html__('Vanuatu', 'houzez');
    if( $code == 'VE' ) $country = esc_html__('Venezuela', 'houzez');
    if( $code == 'VN' ) $country = esc_html__('Vietnam', 'houzez');
    if( $code == 'WF' ) $country = esc_html__('Wallis and Futuna', 'houzez');
    if( $code == 'EH' ) $country = esc_html__('Western Sahara', 'houzez');
    if( $code == 'YE' ) $country = esc_html__('Yemen', 'houzez');
    if( $code == 'ZM' ) $country = esc_html__('Zambia', 'houzez');
    if( $code == 'ZW' ) $country = esc_html__('Zimbabwe', 'houzez');
    if( $country == '') $country = $code;
    return $country;
}
endif;

if( !function_exists('houzez_countries_list') ) {
    function houzez_countries_list() {
        $Countries = array(
            'US' => esc_html__('United States', 'houzez'),
            'CA' => esc_html__('Canada', 'houzez'),
            'AU' => esc_html__('Australia', 'houzez'),
            'FR' => esc_html__('France', 'houzez'),
            'DE' => esc_html__('Germany', 'houzez'),
            'IS' => esc_html__('Iceland', 'houzez'),
            'IE' => esc_html__('Ireland', 'houzez'),
            'IT' => esc_html__('Italy', 'houzez'),
            'ES' => esc_html__('Spain', 'houzez'),
            'SE' => esc_html__('Sweden', 'houzez'),
            'AT' => esc_html__('Austria', 'houzez'),
            'BE' => esc_html__('Belgium', 'houzez'),
            'FI' => esc_html__('Finland', 'houzez'),
            'CZ' => esc_html__('Czech Republic', 'houzez'),
            'DK' => esc_html__('Denmark', 'houzez'),
            'NO' => esc_html__('Norway', 'houzez'),
            'GB' => esc_html__('United Kingdom', 'houzez'),
            'CH' => esc_html__('Switzerland', 'houzez'),
            'NZ' => esc_html__('New Zealand', 'houzez'),
            'RU' => esc_html__('Russian Federation', 'houzez'),
            'PT' => esc_html__('Portugal', 'houzez'),
            'NL' => esc_html__('Netherlands', 'houzez'),
            'IM' => esc_html__('Isle of Man', 'houzez'),
            'AF' => esc_html__('Afghanistan', 'houzez'),
            'AX' => esc_html__('Aland Islands ', 'houzez'),
            'AL' => esc_html__('Albania', 'houzez'),
            'DZ' => esc_html__('Algeria', 'houzez'),
            'AS' => esc_html__('American Samoa', 'houzez'),
            'AD' => esc_html__('Andorra', 'houzez'),
            'AO' => esc_html__('Angola', 'houzez'),
            'AI' => esc_html__('Anguilla', 'houzez'),
            'AQ' => esc_html__('Antarctica', 'houzez'),
            'AG' => esc_html__('Antigua and Barbuda', 'houzez'),
            'AR' => esc_html__('Argentina', 'houzez'),
            'AM' => esc_html__('Armenia', 'houzez'),
            'AW' => esc_html__('Aruba', 'houzez'),
            'AZ' => esc_html__('Azerbaijan', 'houzez'),
            'BS' => esc_html__('Bahamas', 'houzez'),
            'BH' => esc_html__('Bahrain', 'houzez'),
            'BD' => esc_html__('Bangladesh', 'houzez'),
            'BB' => esc_html__('Barbados', 'houzez'),
            'BY' => esc_html__('Belarus', 'houzez'),
            'BZ' => esc_html__('Belize', 'houzez'),
            'BJ' => esc_html__('Benin', 'houzez'),
            'BM' => esc_html__('Bermuda', 'houzez'),
            'BT' => esc_html__('Bhutan', 'houzez'),
            'BO' => esc_html__('Bolivia, Plurinational State of', 'houzez'),
            'BQ' => esc_html__('Bonaire, Sint Eustatius and Saba', 'houzez'),
            'BA' => esc_html__('Bosnia and Herzegovina', 'houzez'),
            'BW' => esc_html__('Botswana', 'houzez'),
            'BV' => esc_html__('Bouvet Island', 'houzez'),
            'BR' => esc_html__('Brazil', 'houzez'),
            'IO' => esc_html__('British Indian Ocean Territory', 'houzez'),
            'BN' => esc_html__('Brunei Darussalam', 'houzez'),
            'BG' => esc_html__('Bulgaria', 'houzez'),
            'BF' => esc_html__('Burkina Faso', 'houzez'),
            'BI' => esc_html__('Burundi', 'houzez'),
            'KH' => esc_html__('Cambodia', 'houzez'),
            'CM' => esc_html__('Cameroon', 'houzez'),
            'CV' => esc_html__('Cape Verde', 'houzez'),
            'KY' => esc_html__('Cayman Islands', 'houzez'),
            'CF' => esc_html__('Central African Republic', 'houzez'),
            'TD' => esc_html__('Chad', 'houzez'),
            'CL' => esc_html__('Chile', 'houzez'),
            'CN' => esc_html__('China', 'houzez'),
            'CX' => esc_html__('Christmas Island', 'houzez'),
            'CC' => esc_html__('Cocos (Keeling) Islands', 'houzez'),
            'CO' => esc_html__('Colombia', 'houzez'),
            'KM' => esc_html__('Comoros', 'houzez'),
            'CG' => esc_html__('Congo', 'houzez'),
            'CD' => esc_html__('Congo, the Democratic Republic of the', 'houzez'),
            'CK' => esc_html__('Cook Islands', 'houzez'),
            'CR' => esc_html__('Costa Rica', 'houzez'),
            'CI' => esc_html__('Cote d\'Ivoire', 'houzez'),
            'HR' => esc_html__('Croatia', 'houzez'),
            'CU' => esc_html__('Cuba', 'houzez'),
            'CW' => esc_html__('Curaçao', 'houzez'),
            'CY' => esc_html__('Cyprus', 'houzez'),
            'DJ' => esc_html__('Djibouti', 'houzez'),
            'DM' => esc_html__('Dominica', 'houzez'),
            'DO' => esc_html__('Dominican Republic', 'houzez'),
            'EC' => esc_html__('Ecuador', 'houzez'),
            'EG' => esc_html__('Egypt', 'houzez'),
            'SV' => esc_html__('El Salvador', 'houzez'),
            'GQ' => esc_html__('Equatorial Guinea', 'houzez'),
            'ER' => esc_html__('Eritrea', 'houzez'),
            'EE' => esc_html__('Estonia', 'houzez'),
            'ET' => esc_html__('Ethiopia', 'houzez'),
            'FK' => esc_html__('Falkland Islands (Malvinas)', 'houzez'),
            'FO' => esc_html__('Faroe Islands', 'houzez'),
            'FJ' => esc_html__('Fiji', 'houzez'),
            'GF' => esc_html__('French Guiana', 'houzez'),
            'PF' => esc_html__('French Polynesia', 'houzez'),
            'TF' => esc_html__('French Southern Territories', 'houzez'),
            'GA' => esc_html__('Gabon', 'houzez'),
            'GM' => esc_html__('Gambia', 'houzez'),
            'GE' => esc_html__('Georgia', 'houzez'),
            'GH' => esc_html__('Ghana', 'houzez'),
            'GI' => esc_html__('Gibraltar', 'houzez'),
            'GR' => esc_html__('Greece', 'houzez'),
            'GL' => esc_html__('Greenland', 'houzez'),
            'GD' => esc_html__('Grenada', 'houzez'),
            'GP' => esc_html__('Guadeloupe', 'houzez'),
            'GU' => esc_html__('Guam', 'houzez'),
            'GT' => esc_html__('Guatemala', 'houzez'),
            'GG' => esc_html__('Guernsey', 'houzez'),
            'GN' => esc_html__('Guinea', 'houzez'),
            'GW' => esc_html__('Guinea-Bissau', 'houzez'),
            'GY' => esc_html__('Guyana', 'houzez'),
            'HT' => esc_html__('Haiti', 'houzez'),
            'HM' => esc_html__('Heard Island and McDonald Islands', 'houzez'),
            'VA' => esc_html__('Holy See (Vatican City State)', 'houzez'),
            'HN' => esc_html__('Honduras', 'houzez'),
            'HK' => esc_html__('Hong Kong', 'houzez'),
            'HU' => esc_html__('Hungary', 'houzez'),
            'IN' => esc_html__('India', 'houzez'),
            'ID' => esc_html__('Indonesia', 'houzez'),
            'IR' => esc_html__('Iran, Islamic Republic of', 'houzez'),
            'IQ' => esc_html__('Iraq', 'houzez'),
            'IL' => esc_html__('Israel', 'houzez'),
            'JM' => esc_html__('Jamaica', 'houzez'),
            'JP' => esc_html__('Japan', 'houzez'),
            'JE' => esc_html__('Jersey', 'houzez'),
            'JO' => esc_html__('Jordan', 'houzez'),
            'KZ' => esc_html__('Kazakhstan', 'houzez'),
            'KE' => esc_html__('Kenya', 'houzez'),
            'KI' => esc_html__('Kiribati', 'houzez'),
            'KP' => esc_html__('Korea, Democratic People\'s Republic of', 'houzez'),
            'KR' => esc_html__('Korea, Republic of', 'houzez'),
            'KV' => esc_html__('kosovo', 'houzez'),
            'KW' => esc_html__('Kuwait', 'houzez'),
            'KG' => esc_html__('Kyrgyzstan', 'houzez'),
            'LA' => esc_html__('Lao People\'s Democratic Republic', 'houzez'),
            'LV' => esc_html__('Latvia', 'houzez'),
            'LB' => esc_html__('Lebanon', 'houzez'),
            'LS' => esc_html__('Lesotho', 'houzez'),
            'LR' => esc_html__('Liberia', 'houzez'),
            'LY' => esc_html__('Libyan Arab Jamahiriya', 'houzez'),
            'LI' => esc_html__('Liechtenstein', 'houzez'),
            'LT' => esc_html__('Lithuania', 'houzez'),
            'LU' => esc_html__('Luxembourg', 'houzez'),
            'MO' => esc_html__('Macao', 'houzez'),
            'MK' => esc_html__('Macedonia', 'houzez'),
            'MG' => esc_html__('Madagascar', 'houzez'),
            'MW' => esc_html__('Malawi', 'houzez'),
            'MY' => esc_html__('Malaysia', 'houzez'),
            'MV' => esc_html__('Maldives', 'houzez'),
            'ML' => esc_html__('Mali', 'houzez'),
            'MT' => esc_html__('Malta', 'houzez'),
            'MH' => esc_html__('Marshall Islands', 'houzez'),
            'MQ' => esc_html__('Martinique', 'houzez'),
            'MR' => esc_html__('Mauritania', 'houzez'),
            'MU' => esc_html__('Mauritius', 'houzez'),
            'YT' => esc_html__('Mayotte', 'houzez'),
            'MX' => esc_html__('Mexico', 'houzez'),
            'FM' => esc_html__('Micronesia, Federated States of', 'houzez'),
            'MD' => esc_html__('Moldova, Republic of', 'houzez'),
            'MC' => esc_html__('Monaco', 'houzez'),
            'MN' => esc_html__('Mongolia', 'houzez'),
            'ME' => esc_html__('Montenegro', 'houzez'),
            'MS' => esc_html__('Montserrat', 'houzez'),
            'MA' => esc_html__('Morocco', 'houzez'),
            'MZ' => esc_html__('Mozambique', 'houzez'),
            'MM' => esc_html__('Myanmar', 'houzez'),
            'NA' => esc_html__('Namibia', 'houzez'),
            'NR' => esc_html__('Nauru', 'houzez'),
            'NP' => esc_html__('Nepal', 'houzez'),
            'NC' => esc_html__('New Caledonia', 'houzez'),
            'NI' => esc_html__('Nicaragua', 'houzez'),
            'NE' => esc_html__('Niger', 'houzez'),
            'NG' => esc_html__('Nigeria', 'houzez'),
            'NU' => esc_html__('Niue', 'houzez'),
            'NF' => esc_html__('Norfolk Island', 'houzez'),
            'MP' => esc_html__('Northern Mariana Islands', 'houzez'),
            'OM' => esc_html__('Oman', 'houzez'),
            'PK' => esc_html__('Pakistan', 'houzez'),
            'PW' => esc_html__('Palau', 'houzez'),
            'PS' => esc_html__('Palestinian Territory, Occupied', 'houzez'),
            'PA' => esc_html__('Panama', 'houzez'),
            'PG' => esc_html__('Papua New Guinea', 'houzez'),
            'PY' => esc_html__('Paraguay', 'houzez'),
            'PE' => esc_html__('Peru', 'houzez'),
            'PH' => esc_html__('Philippines', 'houzez'),
            'PN' => esc_html__('Pitcairn', 'houzez'),
            'PL' => esc_html__('Poland', 'houzez'),
            'PR' => esc_html__('Puerto Rico', 'houzez'),
            'QA' => esc_html__('Qatar', 'houzez'),
            'RE' => esc_html__('Reunion', 'houzez'),
            'RO' => esc_html__('Romania', 'houzez'),
            'RW' => esc_html__('Rwanda', 'houzez'),
            'BL' => esc_html__('Saint Barthélemy', 'houzez'),
            'SH' => esc_html__('Saint Helena', 'houzez'),
            'KN' => esc_html__('Saint Kitts and Nevis', 'houzez'),
            'LC' => esc_html__('Saint Lucia', 'houzez'),
            'MF' => esc_html__('Saint Martin (French part)', 'houzez'),
            'PM' => esc_html__('Saint Pierre and Miquelon', 'houzez'),
            'VC' => esc_html__('Saint Vincent and the Grenadines', 'houzez'),
            'WS' => esc_html__('Samoa', 'houzez'),
            'SM' => esc_html__('San Marino', 'houzez'),
            'ST' => esc_html__('Sao Tome and Principe', 'houzez'),
            'SA' => esc_html__('Saudi Arabia', 'houzez'),
            'SN' => esc_html__('Senegal', 'houzez'),
            'RS' => esc_html__('Serbia', 'houzez'),
            'SC' => esc_html__('Seychelles', 'houzez'),
            'SL' => esc_html__('Sierra Leone', 'houzez'),
            'SG' => esc_html__('Singapore', 'houzez'),
            'SX' => esc_html__('Sint Maarten (Dutch part)', 'houzez'),
            'SK' => esc_html__('Slovakia', 'houzez'),
            'SI' => esc_html__('Slovenia', 'houzez'),
            'SB' => esc_html__('Solomon Islands', 'houzez'),
            'SO' => esc_html__('Somalia', 'houzez'),
            'ZA' => esc_html__('South Africa', 'houzez'),
            'GS' => esc_html__('South Georgia and the South Sandwich Islands', 'houzez'),
            'LK' => esc_html__('Sri Lanka', 'houzez'),
            'SD' => esc_html__('Sudan', 'houzez'),
            'SR' => esc_html__('Suriname', 'houzez'),
            'SJ' => esc_html__('Svalbard and Jan Mayen', 'houzez'),
            'SZ' => esc_html__('Swaziland', 'houzez'),
            'SY' => esc_html__('Syrian Arab Republic', 'houzez'),
            'TW' => esc_html__('Taiwan, Province of China', 'houzez'),
            'TJ' => esc_html__('Tajikistan', 'houzez'),
            'TZ' => esc_html__('Tanzania, United Republic of', 'houzez'),
            'TH' => esc_html__('Thailand', 'houzez'),
            'TL' => esc_html__('Timor-Leste', 'houzez'),
            'TG' => esc_html__('Togo', 'houzez'),
            'TK' => esc_html__('Tokelau', 'houzez'),
            'TO' => esc_html__('Tonga', 'houzez'),
            'TT' => esc_html__('Trinidad and Tobago', 'houzez'),
            'TN' => esc_html__('Tunisia', 'houzez'),
            'TR' => esc_html__('Turkey', 'houzez'),
            'TM' => esc_html__('Turkmenistan', 'houzez'),
            'TC' => esc_html__('Turks and Caicos Islands', 'houzez'),
            'TV' => esc_html__('Tuvalu', 'houzez'),
            'UG' => esc_html__('Uganda', 'houzez'),
            'UA' => esc_html__('Ukraine', 'houzez'),
            'AE' => esc_html__('United Arab Emirates', 'houzez'),
            'UM' => esc_html__('United States Minor Outlying Islands', 'houzez'),
            'UY' => esc_html__('Uruguay', 'houzez'),
            'UZ' => esc_html__('Uzbekistan', 'houzez'),
            'VU' => esc_html__('Vanuatu', 'houzez'),
            'VE' => esc_html__('Venezuela, Bolivarian Republic of', 'houzez'),
            'VN' => esc_html__('Viet Nam', 'houzez'),
            'VG' => esc_html__('Virgin Islands, British', 'houzez'),
            'VI' => esc_html__('Virgin Islands, U.S.', 'houzez'),
            'WF' => esc_html__('Wallis and Futuna', 'houzez'),
            'EH' => esc_html__('Western Sahara', 'houzez'),
            'YE' => esc_html__('Yemen', 'houzez'),
            'ZM' => esc_html__('Zambia', 'houzez'),
            'ZW' => esc_html__('Zimbabwe', 'houzez')
        );
        return $Countries;
    }
}

/* --------------------------------------------------------------------------
 * Breadcrumb Adapted from http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_breadcrumbs' ) ) {
    function houzez_breadcrumbs($options = array())
    {

        global $post;
        $allowed_html_array = array(
            'i' => array(
                'class' => array()
            )
        );

        $text['home']     = '<i class="fa fa-home"></i>'; // text for the 'Home' link
        $text['category'] = esc_html__('%s', 'houzez'); // text for a category page
        $text['tax']      = esc_html__('%s', 'houzez'); // text for a taxonomy page
        $text['search']   = esc_html__('Search Results for "%s" Query', 'houzez'); // text for a search results page
        $text['tag']      = esc_html__('%s', 'houzez'); // text for a tag page
        $text['author']   = esc_html__('%s', 'houzez'); // text for an author page
        $text['404']      = esc_html__('Error 404', 'houzez'); // text for the 404 page

        $defaults = array(
            'show_current' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
            'show_on_home' => 0, // 1 - show breadcrumbs on the homepage, 0 - don't show
            'delimiter' => '',
            'before' => '<li class="active">',
            'after' => '</li>',

            'home_before' => '',
            'home_after' => '',
            'home_link' => home_url() . '/',

            'link_before' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',
            'link_after'  => '</li>',
            'link_attr'   => '',
            'link_in_before' => '',
            'link_in_after'  => ''
        );

        extract($defaults);

        $link = '<a itemprop="url" href="%1$s">' . $link_in_before . '%2$s' . $link_in_after . '</a>';

        // form whole link option
        $link = $link_before . $link . $link_after;

        if (isset($options['text'])) {
            $options['text'] = array_merge($text, (array) $options['text']);
        }

        // override defaults
        extract($options);

        // regex replacement
        $replace = $link_before . '<a' . esc_attr( $link_attr ) . '\\1>' . $link_in_before . '\\2' . $link_in_after . '</a>' . $link_after;

        /*
         * Use bbPress's breadcrumbs when available
         */
        if (function_exists('bbp_breadcrumb') && is_bbpress()) {

            $bbp_crumbs =
                bbp_get_breadcrumb(array(
                    'home_text' => $text['home'],
                    'sep' => '',
                    'sep_before' => '',
                    'sep_after'  => '',
                    'pad_sep' => 0,
                    'before' => $home_before,
                    'after' => $home_after,
                    'current_before' => $before,
                    'current_after'  => $after,
                ));

            if ($bbp_crumbs) {
                echo '<ul class="breadcrumb favethemes_bbpress_breadcrumb">' .$bbp_crumbs. '</ul>';
                return;
            }
        }

        // normal breadcrumbs
        if ((is_home() || is_front_page())) {

            if ($show_on_home == 1) {
                echo '<li>'. esc_attr( $home_before ) . '<a href="' . esc_url( $home_link ) . '">' . esc_attr( $text['home'] ) . '</a>'. esc_attr( $home_after ) .'</li>';
            }

        } else {

            echo '<ol class="breadcrumb">' .$home_before . sprintf($link, $home_link, $text['home']) . $home_after . $delimiter;

            if (is_category() || is_tax())
            {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                if( $term ) {

                    $taxonomy_object = get_taxonomy( get_query_var( 'taxonomy' ) );
                    //echo '<li><a>'.$taxonomy_object->rewrite['slug'].'</a></li>';

                    $parent = $term->parent;

                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);

                        // For each parent, create a breadcrumb item
                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));

                            $term_link = get_term_link( $item );
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }
                            echo '<li><a href="'.$term_link.'">'.$item->name.'</a></li>';
                        endforeach;
                    endif;

                    // Display the current term in the breadcrumb
                    echo '<li>'.$term->name.'</li>';

                } else {

                    $the_cat = get_category(get_query_var('cat'), false);

                    // have parents?
                    if ($the_cat->parent != 0) {

                        $cats = get_category_parents($the_cat->parent, true, $delimiter);
                        $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

                        echo $cats;
                    }

                    // print category
                    echo $before . sprintf((is_category() ? $text['category'] : $text['tax']), single_cat_title('', false)) . $after;
                } // end terms else

            }
            else if (is_search()) {

                echo $before . sprintf($text['search'], get_search_query()) . $after;

            }
            else if (is_day()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter
                    . $before . get_the_time('d') . $after;

            }
            else if (is_month()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . $before . get_the_time('F') . $after;

            }
            else if (is_year()) {

                echo $before . get_the_time('Y') . $after;

            }
            // single post or page
            else if (is_single() && !is_attachment()) {

                // custom post type
                if (get_post_type() != 'post' && get_post_type() != 'property' ) {

                    $post_type = get_post_type_object(get_post_type());
                    //printf($link, get_post_type_archive_link(get_post_type()), $post_type->labels->name);

                    if ($show_current == 1) {
                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
                    }
                }
                elseif( get_post_type() == 'property' ){

                    $terms = get_the_terms( get_the_ID(), 'property_type' );
                    if( !empty($terms) ) {
                        foreach ($terms as $term) {
                            $term_link = get_term_link($term);
                            // If there was an error, continue to the next term.
                            if (is_wp_error($term_link)) {
                                continue;
                            }
                            echo '<li><a href="' . esc_url($term_link) . '">' . esc_attr( $term->name ). '</a></li>';
                        }
                    }

                    if ($show_current == 1) {
                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
                    }
                }
                else {

                    $cat = get_the_category();
                    $cats = get_category_parents($cat[0], true, esc_attr($delimiter));

                    if ($show_current == 0) {
                        $cats = preg_replace("#^(.+)esc_attr($delimiter)$#", "$1", $cats);
                    }

                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

                    echo $cats;

                    if ($show_current == 1) {
                        echo $before . get_the_title() . $after;
                    }
                } // end else

            }
            elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

                $post_type = get_post_type_object(get_post_type());

                echo $before . $post_type->labels->name . $after;

            }
            elseif (is_attachment()) {

                $parent = get_post($post->post_parent);
                $cat = current(get_the_category($parent->ID));
                $cats = get_category_parents($cat, true, esc_attr($delimiter));

                if (!is_wp_error($cats)) {
                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
                    echo $cats;
                }

                printf($link, get_permalink($parent), $parent->post_title);

                if ($show_current == 1) {
                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
                }

            }
            elseif (is_page() && !$post->post_parent && $show_current == 1) {

                echo $before . get_the_title() . $after;

            }
            elseif (is_page() && $post->post_parent) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo ( $breadcrumbs[$i] );

                    if ($i != count($breadcrumbs)-1) {
                        echo esc_attr($delimiter);
                    }
                }

                if ($show_current == 1) {
                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
                }

            }
            elseif (is_tag()) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            }
            elseif (is_author()) {

                global $author;

                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

            }
            elseif (is_404()) {
                echo $before . esc_attr( $text['404'] ). $after;
            }

            // have pages?
            if (get_query_var('paged')) {

                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ' (' . esc_html__('Page', 'houzez') . ' ' . get_query_var('paged') . ')';
                }
            }

            echo '</ol>';
        }

    } // breadcrumbs()
}

if( !function_exists('countries_dropdown') ) {
    function countries_dropdown($country_searched = '' ) {
        global $wpdb;
        $sql_2 = $wpdb->prepare( "SELECT * from $wpdb->postmeta WHERE meta_key = '%s' GROUP BY meta_value", 'fave_property_country');

        $countries = $wpdb->get_results( $sql_2, OBJECT_K );

        foreach( $countries as $con ) {
            if ( $country_searched == $con->meta_value ) {
                echo '<option value="' . $con->meta_value . '" selected="selected">' . houzez_country_code_to_country( $con->meta_value ) . '</option>';
            } else {
                echo '<option value="' . $con->meta_value . '">' . houzez_country_code_to_country( $con->meta_value ) .'</option>';
            }
        }
    }
}

if( !function_exists('houzez_get_all_countries') ):
    function houzez_get_all_countries( $selected = '' ) {

        global $wpdb;
        $sql_2 = $wpdb->prepare( "SELECT * from $wpdb->postmeta WHERE meta_key = '%s' GROUP BY meta_value", 'fave_property_country');

        $countries = $wpdb->get_results( $sql_2, OBJECT_K );

        $select_country = '';

        foreach( $countries as $con ) {
            $select_country.= '<option value="' . $con->meta_value.'" ';
            if($con->meta_value == $selected){
                $select_country.= ' selected="selected" ';
            }
            $select_country.= ' >' . houzez_country_code_to_country( $con->meta_value ) . '</option>';
        }
        return $select_country;

    }
endif;

if( !function_exists('yelp_widget_curl') ) {
    function yelp_widget_curl($signed_url)
    {

        // Send Yelp API Call using WP's HTTP API
        $data = wp_remote_get($signed_url);

        //Use curl only if necessary
        if (empty($data['body'])) {

            $ch = curl_init($signed_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch); // Yelp response
            curl_close($ch);
            $data = yelp_update_http_for_ssl($data);
            $response = json_decode($data);

        } else {
            $data = yelp_update_http_for_ssl($data);
            $response = json_decode($data['body']);
        }

        // Handle Yelp response data
        return $response;

    }
}

/**
 * Function update http for SSL
 *
 */
if( !function_exists('yelp_update_http_for_ssl') ) {
    function yelp_update_http_for_ssl($data)
    {

        if (!empty($data['body']) && is_ssl()) {
            $data['body'] = str_replace('http:', 'https:', $data['body']);
        } elseif (is_ssl()) {
            $data = str_replace('http:', 'https:', $data);
        }
        $data = str_replace('http:', 'https:', $data);

        return $data;
    }
}