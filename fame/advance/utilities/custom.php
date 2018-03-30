<?php

/*
 * For getting URL of current page
 */
if(!function_exists('a13_current_url')){
    function a13_current_url(){
        global $wp;

        //no permalinks
        if($wp->request === NULL){
            $current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
        }
        else{
            $current_url = esc_url( trailingslashit(home_url(add_query_arg(array(),$wp->request))) );
        }

        return $current_url;
    }
}


/*
 * Filter that change default permalinks for posts and custom post types
 */
if(!function_exists('a13_custom_permalink')){
    function a13_custom_permalink($url, $post, $leavename){
        $custom_link_types = array('post', A13_CUSTOM_POST_TYPE_WORK, A13_CUSTOM_POST_TYPE_GALLERY);
        if ( in_array($post->post_type, $custom_link_types) ) {
            $custom_url = get_post_meta($post->ID,'_alt_link', true);
            //use custom link if available
            if(strlen($custom_url)){
                return $custom_url;
            }
            return $url;
        }
        return $url;
    }
}


/*
 * Check if current page is type of Posts list
 */
if(!function_exists('a13_is_post_list')){
    function a13_is_post_list(){
        return is_home() || (is_archive() && !defined('A13_WORKS_LIST_PAGE')) || is_search();
    }
}


/*
 * Checks if current page has active sidebar
 * returns false if there is no active sidebar,
 * if there is active sidebar it returns its name
 */
if(!function_exists('a13_has_active_sidebar')){
    function a13_has_active_sidebar() {
        global $apollo13;
        $test = '';
        $shop = a13_is_woocommerce();
        $shop_with_sidebar = a13_is_woocommerce_sidebar_page();

        if(!$shop && (is_home() || is_archive() || is_search() || defined('A13_NO_STYLED_PAGE') )){
            $test = 'blog-widget-area';
        }
        elseif(defined('A13_WORK_PAGE')){}
        elseif(!$shop &&  is_single() ){
            $test = 'post-widget-area';
        }
        elseif($shop_with_sidebar){
            $meta_id = woocommerce_get_page_id( 'shop' );
            $custom_sidebar = $apollo13->get_meta('_sidebar_to_show', $meta_id);
            if(strlen($custom_sidebar) && $custom_sidebar !== 'default'){
                $test = $custom_sidebar;
            }
        }
        elseif(!$shop && is_page() ){
            $test = 'page-widget-area';
            $meta_id = $shop? woocommerce_get_page_id( 'shop' ) : get_the_ID();
            $custom_sidebar = $apollo13->get_meta('_sidebar_to_show', $meta_id);
            if(strlen($custom_sidebar) && $custom_sidebar !== 'default'){
                $test = $custom_sidebar;
            }

            //if has children nav and it is activated then sidebar is active
            $sidebar_meta = $apollo13->get_meta('_widget_area', $meta_id);
            if(strrchr($sidebar_meta, 'nav') && a13_page_menu(true)){
                return $test;
            }
        }

        if( is_active_sidebar($test)){
            return $test;
        }
        else{
            return false;
        }
    }
}


/*
 * Get classes for body element
 */
if(!function_exists('a13_body_classes')){
    function a13_body_classes( $classes ) {
        global $apollo13, $wp_version;

        //WP version compare snippet
//        if(version_compare( $wp_version, '3.8', '>=')){
//            $classes[] = 'wp-3_8';
//        }

        //adding woocommerce class so mini cart will look good
        //if this will produce any issues then we will need to remove it
        //and style mini cart independent
        if(a13_is_woocommerce_activated()){
            $classes[] = 'woocommerce-page';
        }

        //forms validation
        $classes[] = ($apollo13->get_option( 'advanced', 'apollo_validation' ) == 'on')? A13_VALIDATION_CLASS : '';

        //layout style
        $classes[] = 'layout-'.$apollo13->get_option( 'appearance', 'layout_style' );
        //background fit
        $classes[] = 'bg-'.$apollo13->get_option( 'appearance', 'body_image_fit' );

        //protected album
        if(defined('A13_PAGE_PROTECTED')){
            $classes[] = 'password-protected';
        }

        if(defined('A13_WORK_PAGE')){
        }

        if(defined('A13_WORKS_LIST_PAGE')){
            $classes[] = 'works-list-page';
            $classes[] = 'cpt-list-page';
        }

        if(defined('A13_GALLERIES_LIST_PAGE')){
            $classes[] = 'galleries-list-page';
            $classes[] = 'cpt-list-page';
        }

        if(is_page_template('contact.php') || is_page_template('contact2.php')){
            if(is_page_template('contact2.php')){
                $classes[] = 'map-in-content';
            }
            $classes[] = 'contact-page';
        }

        //page with posts list
        if(a13_is_post_list() && !defined('A13_NO_STYLED_PAGE'))
            $classes[] = 'posts-list';

        //no results page
        if(defined('A13_NO_STYLED_PAGE'))
            $classes[] = 'no-results';

        return $classes;
    }
}


/*
 * Get classes for mid element
 */
if(!function_exists('a13_get_mid_classes')){
    function a13_get_mid_classes() {
        global $apollo13;

        //mid classes for type of layout align and widget area display(on/off)
        $mid_classes = '';
        //404 error page, no-result page, etc.
        $is_empty_page = defined('A13_NO_STYLED_PAGE');

        $page_type = a13_what_page_type_is_it();
//        var_dump($page_type);
        $page = $page_type['page'];
        $shop = a13_is_woocommerce();

        //check if there is active sidebar for current page
        $force_full_width = false;
        if( $page_type['cpt_list'] || //it is page, so it can gain page sidebar
            $page_type['cpt']       || //it doesn't have sidebar
            a13_has_active_sidebar() === false
        ){
            $force_full_width = true;
        }

        function __inner_a13_set_full_width(&$mid_classes){
            global $content_width;
            define('A13_FULL_WIDTH', true); /* so we don't have to check again in sidebar.php */
            $mid_classes .= ' no-sidebars';
            //content width
            $content_width = 1080;
        }
        function __inner_a13_set_sidebar_class(&$mid_classes, $sidebar){
            if(($sidebar == 'off')){
                __inner_a13_set_full_width($mid_classes);
            }
            else{
                $mid_classes .= ' '.$sidebar;
            }
        }

        /*
         * content padding classes
         * */
        if($page){
            $padding = $apollo13->get_meta('_content_padding');
            if($padding === 'top'){
                $mid_classes .= ' no-bottom-space';
            }
            elseif($padding === 'bottom'){
                $mid_classes .= ' no-top-space';
            }
            elseif($padding === 'off'){
                $mid_classes .= ' no-top-space no-bottom-space';
            }
        }

        /*
         * sidebar classes
         * */
        if($page && ($apollo13->get_meta('_full_width_elements') === 'on')){
            __inner_a13_set_full_width($mid_classes);
            $mid_classes .= ' full-width-elements';
        }
        elseif($force_full_width){
            __inner_a13_set_full_width($mid_classes);
        }
        //blog | attachment | or empty page
        elseif(!$shop && ($page_type['home'] || $page_type['attachment'] || $is_empty_page)){
            __inner_a13_set_sidebar_class($mid_classes, $apollo13->get_option('blog', 'blog_sidebar'));
        }
        //archive | search
        elseif(!$shop && ($page_type['archive'] || $page_type['search'])){
            __inner_a13_set_sidebar_class($mid_classes, $apollo13->get_option('blog', 'archive_sidebar'));
        }
        //single post
        elseif(!$shop && ($page_type['single'])){
            __inner_a13_set_sidebar_class($mid_classes, $apollo13->get_meta('_widget_area'));
        }
        //single page
        elseif($page || $shop){
            //special treatment cause of children menu option
            $meta_id = $shop? woocommerce_get_page_id( 'shop' ) : get_the_ID();
            $sidebar = $apollo13->get_meta('_widget_area', $meta_id);
            if(strrchr($sidebar, 'left')){
                $sidebar = 'left-sidebar';
            }
            elseif(strrchr($sidebar, 'right')){
                $sidebar = 'right-sidebar';
            }
            __inner_a13_set_sidebar_class($mid_classes, $sidebar);
        }

        return $mid_classes;
    }
}


/*
 * Returns array with type of current page
 */
if(!function_exists('a13_what_page_type_is_it')){
    function a13_what_page_type_is_it() {
        static $types;

        if ( empty( $types ) ) {
            $types = array(
                'page'          => is_page(),
                'work'          => defined('A13_WORK_PAGE'),
                'gallery'       => defined('A13_GALLERY_PAGE'),
                'home'          => is_home(),
                'front_page'    => is_front_page(),
                'archive'       => is_archive(),
                'search'        => is_search(),
                'single'        => is_single(),
                'attachment'    => is_attachment(),
                'works_list'    => defined('A13_WORKS_LIST_PAGE'),
                'galleries_list'=> defined('A13_GALLERIES_LIST_PAGE')
            );

            $types['single_not_post']   = $types['page'] || $types['work'] || $types['gallery'];
            $types['post']              = $types['single'] && !$types['single_not_post'];
            $types['cpt']               = $types['work'] || $types['gallery'];
            $types['cpt_list']          = $types['works_list'] || $types['galleries_list'];
            $types['blog_type']         = ($types['home'] || $types['archive'] || $types['search']) && !$types['cpt_list'];
        }

        return $types;
    }
}


/*
 * If page is empty search result or 404 it is no property page
 */
if(!function_exists('a13_is_no_property_page')){
    function a13_is_no_property_page() {
        global $post;

        return !is_object($post);
    }
}


/*
 * Adding class for compatibility with Wp-paginate plugin + infinite scroll configuration
 */
if(!function_exists('a13_next_posts_link_class')){
    function a13_next_posts_link_class() {
        return 'class="next"';
    }
}

if(!function_exists('a13_prev_posts_link_class')){
    function a13_prev_posts_link_class() {
        return 'class="prev"';
    }
}


/*
 * Making featured images
 */
if(!function_exists('a13_make_post_image')){
    function a13_make_post_image( $post_id, $thumb_size){
        if(empty($post_id)){
            $post_id = get_the_ID();
        }
        if ( has_post_thumbnail($post_id) ) {
            return get_the_post_thumbnail($post_id, $thumb_size );
        }

        return false;
    }
}


/**
 * ADDING THUMBNAIL TO RSS
 */
if(!function_exists('a13_rss_post_thumbnail')){
    function a13_rss_post_thumbnail($content) {
        global $post;
        if(has_post_thumbnail($post->ID)) {
            $content = '<p>' . get_the_post_thumbnail($post->ID, 'medium') .
                '</p>' . get_the_excerpt();
        }
        else
            $content = get_the_excerpt();

        return $content;
    }
}


/* Register your custom function to override some LayerSlider data */
function a13_layerslider_overrides() {
	// Disable auto-updates
	$GLOBALS['lsAutoUpdateBox'] = false;
}
add_action('layerslider_ready', 'a13_layerslider_overrides');


/* no styles for language switcher */
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
function a13_wpml_deregister_styles() {
    wp_deregister_style( 'language-selector' );
}
add_action( 'init', 'a13_wpml_deregister_styles');


/**
 * FILTER HOOKS
 */
add_filter( 'post_link', 'a13_custom_permalink', 10, 3 );
add_filter( 'post_type_link', 'a13_custom_permalink', 10, 3 );
add_filter( 'body_class', 'a13_body_classes' );
add_filter( 'the_excerpt_rss', 'a13_rss_post_thumbnail');
add_filter( 'the_content_feed', 'a13_rss_post_thumbnail');
add_filter( 'next_posts_link_attributes', 'a13_next_posts_link_class' );
add_filter( 'previous_posts_link_attributes', 'a13_prev_posts_link_class' );