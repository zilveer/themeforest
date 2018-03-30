<?php
/**
 * This is where all the themes frontend actions at
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

// Register main menu
register_nav_menus( array(
    'primary' => __( 'Primary Navigation', THEME_ADMIN_TD ),
));

/**
 * Creates the top menu
 *
 * @return void
 * @since 1.0
 **/
function oxy_top_nav() {
    wp_nav_menu( array( 'container' => 'nav', 'theme_location' => 'primary' ) );
}

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class OxyNavWalker extends Walker_Nav_Menu {
    function check_current( $classes ) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if( $item->is_dropdown && ($depth === 0) ) {
            $hover_attr = "";
            $disabled = "";
            if( oxy_get_option( 'menu' ) == 'hover' ){
                $hover_attr = 'data-hover="dropdown" data-delay="300"';
                $disabled = 'disabled';
            }
            $item_html = str_replace('<a', '<a class="dropdown-toggle '.$disabled.'" data-toggle="dropdown" '.$hover_attr.' data-target="#"', $item_html);
            //$item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
        }
        elseif( stristr($item_html, 'li class="divider') ) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        }
        elseif( stristr($item_html, 'li class="nav-header') ) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }

        $output .= $item_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $element->is_dropdown = !empty( $children_elements[$element->ID] );

        if( $element->is_dropdown ) {
            if( $depth === 0 ) {
                $element->classes[] = 'dropdown';
            }
            elseif( $depth === 1 ) {
                $element->classes[] = 'dropdown-submenu';
            }
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

function oxy_create_logo() {
    if( function_exists( 'icl_get_home_url' ) ) {
        $home_link = icl_get_home_url();
    }
    else {
        $home_link = site_url();
    }
    switch( oxy_get_option('logo_type') ) {
        case 'text': ?>
            <div class="brand">
                <a href="<?php echo $home_link; ?>">
                    <?php echo oxy_filter_title( oxy_get_option( 'logo_text' ) ); ?>
                </a>
            </div>
<?php   break;
        case 'image':
            $id = oxy_get_option( 'logo_image' ); ?>
            <!-- added class brand to float it left and add some left margins -->
            <a class="brand" href="<?php echo $home_link; ?>">
                <?php echo wp_get_attachment_image( $id, 'full' ); ?>
            </a>
<?php
        break;
    }
}

/**
 * Gets a theme option
 *
 * @return theme option value or false if not set
 * @since 1.0
 **/
function oxy_get_option( $name ) {
    global $oxy_theme_options;
    if( isset( $oxy_theme_options[$name] ) ) {
        return apply_filters ( 'oxy_option_value', $oxy_theme_options[$name],  $name );
    }
    else {
        return false;
    }
}


/**
 * Loads theme scripts
 *
 * @return void
 *
 **/
function oxy_load_scripts() {
    global $oxy_theme_options;
    global $wp_query;
    global $post;

    // load js
    wp_enqueue_script( 'bootstrap', JS_URI . 'bootstrap.js', array( 'jquery' ), '2.3.1', true );

    wp_enqueue_script( 'flexslider', JS_URI. 'jquery.flexslider-min.js', array('jquery'), '2.1', true );

    wp_enqueue_script( 'fancybox_pack' ,JS_URI. 'jquery.fancybox.pack.js' , array('jquery'), '2.1.4', true );

    wp_enqueue_script( 'fancybox_media' ,JS_URI. 'jquery.fancybox-media.js' , array('jquery'), '2.1.4', true );

    wp_enqueue_script( 'script', JS_URI . 'script.js',array( 'bootstrap' , 'jquery', 'flexslider' ), '1.0', true  );

    wp_enqueue_script( 'wpscript', JS_URI . 'wpscript.js', array( 'bootstrap' , 'jquery', 'flexslider' ), '1.0', true );

    // post may not be set if we are in shortcode editor
    if( isset($post) ){
        if (get_post_type( $post->ID ) == 'oxy_timeline'){
            $custom_fields = get_post_custom($post->ID);
            if ( isset ($custom_fields[THEME_SHORT.'_timeline']) ){
                // retrieve the post count for the category
                if($custom_fields[THEME_SHORT.'_timeline'][0] == " "){
                     wp_localize_script( 'wpscript', 'dynData', array('category' => "" , 'total_results' => wp_count_posts()) );
                }
                else{
                    $cat_name = get_term_by('name', $custom_fields[THEME_SHORT.'_timeline'][0] , 'category');
                    $cat_id = $cat_name->term_id;
                    $cat = get_category($cat_id);
                    $count = (int)$cat->count;
                    wp_localize_script( 'wpscript', 'dynData', array('category' => $custom_fields[THEME_SHORT.'_timeline'][0] , 'total_results' => $count) );
                }

            }
        }
    }

    // send stored date to the theme script
    // also send ajax url and nonce for sign up
    wp_localize_script( 'wpscript', 'localData', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'        => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID "myajax-post-comment-nonce"
        // so that you can check it later when an AJAX request is sent
        'nonce'          => wp_create_nonce( 'oxygenna-sign-me-up-nonce' ),

        'posts_per_page' => get_option('posts_per_page'),
        )
    );

    // if we are on a page and we want to display a map , enqueue the google maps scripts
    if( isset($post) ) {
        if( is_page() || get_post_type( get_the_ID() ) == 'oxy_service' || get_post_type( get_the_ID() ) == 'oxy_timeline'  ){
             $custom_fields = get_post_custom($post->ID);
             if ( isset($custom_fields[THEME_SHORT.'_header_type']) ){
                if ( $custom_fields[THEME_SHORT.'_header_type'][0] == 'map' ){
                    wp_enqueue_script( 'google', 'https://maps.googleapis.com/maps/api/js?sensor=false' ,  array( 'jquery' ) );
                    wp_enqueue_script( 'map', JS_URI . 'maps.js', array( 'jquery' , 'google' ) );

                    // get the coordinates from the metabox value
                    $coords =  $custom_fields['loc'][0];
                    if ( $coords ){
                        list( $lat, $lng ,$zoom) = explode( ',', $coords );
                    }
                    wp_localize_script( 'map', 'mapData', array(
                        'lat'   =>  $lat,
                        'lng'   =>  $lng,
                        'zoom'  =>  $zoom
                        )
                    );
                }
            }
        }
    }

    // check for social links on single page
    if( is_single() ) {
        if( oxy_get_option( 'fb_show' ) == 'show' ) {
            wp_enqueue_script( 'facebook', JS_URI . 'facebook.js', array(), '1.0', true );
        }
        if( oxy_get_option( 'twitter_show' ) == 'show' ) {
            wp_enqueue_script( 'twitter', JS_URI . 'twitter.js', array(), '1.0', true );
        }
        if( oxy_get_option( 'google_show' ) == 'show' ) {
            wp_enqueue_script( 'google', JS_URI . 'google.js', array(), '1.0', true );
        }
    }

    // add hover dropdown menus
    if( oxy_get_option( 'menu' ) == 'hover' ) {
        wp_enqueue_script( 'hover_menus', JS_URI . 'twitter-bootstrap-hover-dropdown.min.js',  array( 'bootstrap' , 'jquery' ), '1.0', true );
    }

    // load styles
    if( is_rtl() ) {
        wp_enqueue_style( 'bootstrap', CSS_URI . 'rtl/bootstrap.css', array(), false, 'all' );
        wp_enqueue_style( 'responsive', CSS_URI . 'rtl/responsive.css', array( 'bootstrap' ), false, 'all' );
        wp_enqueue_style( 'rtl', CSS_URI . 'rtl.css', array( 'style' ), false, 'all' );
    }
    else {
        wp_enqueue_style( 'bootstrap', CSS_URI . 'bootstrap.css', array(), false, 'all' );
        wp_enqueue_style( 'responsive', CSS_URI . 'responsive.css', array( 'bootstrap' ), false, 'all' );
    }
    wp_enqueue_style( 'font-awesome-all', CSS_URI . 'font-awesome-all.css', array( 'bootstrap' ), false, 'all' );
    wp_enqueue_style( 'font', CSS_URI . oxy_get_option('main_site_font'), array( 'bootstrap' ), false, 'all' );
    wp_enqueue_style( 'fancybox', CSS_URI . 'fancybox.css', array( 'bootstrap' ), false, 'all' );
    wp_enqueue_style( 'style', CSS_URI . 'style.css', array( 'bootstrap' ), false, 'all' );



}
add_action( 'wp_enqueue_scripts', 'oxy_load_scripts' , 0);

/*************** POST ***************************/

// add post format support
add_theme_support( 'post-formats', array( 'gallery', 'video', 'link' ) );
add_theme_support( 'automatic-feed-links' );

// dont use default gallery styles
add_filter( 'use_default_gallery_style', '__return_false' );

// use option read more link
add_filter( 'the_content_more_link', 'oxy_read_more_link', 10, 2 );

function oxy_read_more_link( $more_link, $more_link_text ) {
    // remove #more
    $more_link = preg_replace( '|#more-[0-9]+|', '', $more_link );
    return str_replace( $more_link_text, oxy_get_option('blog_readmore'), $more_link );
}

/**
 * Adds rounded class to avatars
 *
 * @return modified css
 * @since 1.0
 **/
function oxy_change_avatar_css($class , $id , $size) {
    // if it's the admin bar , don't touch it.
    if( $size == 300 ) {
        // comment walker sends an object
        if( is_object( $id ) ) {
            $author_url = $id->user_id == 0 ? '#' : get_author_posts_url( $id->user_id );
        }
        else {
            $author_url = get_author_posts_url( $id );
        }
        // show avatar option
        if( oxy_get_option('site_avatars') == 'on'){
            $class = str_replace("class='avatar", "class='img-circle ", $class);
            return  '<a class="box-inner" href="' . $author_url . '">' . $class . '</a>';
        }
        //don't show anything
        return '';
    }
    return $class;

}
add_filter( 'get_avatar', 'oxy_change_avatar_css' ,10 , 5);

/*************** HEADERS ***************************/

// add support for featured images
add_theme_support( 'post-thumbnails' );

/**
 * Creates header for all pages / posts
 *
 * @return void
 * @since 1.0
 **/
function oxy_create_hero_section( $image = null, $title = null ) {
    $image = $image === null ? get_header_image() : $image;
    $title = $title === null ? oxy_get_option( 'blog_title' ) : $title;
?>
<section class="section section-alt">
    <div class="row-fluid">
        <div class="super-hero-unit">
            <figure>
                <img alt="<?php echo sanitize_text_field($title); ?>" src="<?php echo $image; ?>">
                <figcaption class="flex-caption">
                    <h1 class="super animated fadeinup delayed">
                        <?php echo oxy_filter_title( $title ); ?>
                    </h1>
                </figcaption>
            </figure>
        </div>
    </div>
</section>
<?php
}

function create_image_sizes() {
// create theme specific image size for the iphone slider
    if( function_exists( 'add_image_size' ) ) {

        add_image_size( 'portfolio-thumb', 300, 300, true );
    }

}
add_action( 'init', 'create_image_sizes');

function display_image_sizes( $sizes ) {
    $sizes['portfolio-thumb'] = __( 'Portfolio Thumbnail Size', THEME_ADMIN_TD);
    return $sizes;
}
// hook for displaying the size in the media screen
add_filter( 'image_size_names_choose', 'display_image_sizes');


function oxy_create_flexslider( $slug_or_ids, $options = array(), $echo = true ) {
    global $oxy_theme_options;
    global $post;
    $tmp_post = $post;
    extract( shortcode_atts( array(
        'captions'         => $oxy_theme_options['captions'],
        'animation'        => $oxy_theme_options['animation'],
        'speed'            => $oxy_theme_options['speed'],
        'duration'         => $oxy_theme_options['duration'],
        'directionnav'     => $oxy_theme_options['directionnav'],
        'directionnavpos'  => $oxy_theme_options['directionnavpos'],
        'controlsposition' => $oxy_theme_options['controlsposition'],
        'itemwidth'        => '',
        'showcontrols'     => $oxy_theme_options['showcontrols'],
        'captionanimation' => $oxy_theme_options['captionanimation'],
        'captionsize'      => $oxy_theme_options['captionsize'],
        'autostart'        => $oxy_theme_options['autostart'],
    ), $options ) );

    if( is_array( $slug_or_ids ) ){
                $slides = get_posts( array( 'post_type' => 'attachment', 'post__in' => $slug_or_ids, 'orderby' => 'post__in', 'posts_per_page' => -1 ) );
        $captions = 'hide';
    }
    else {
        $slides = get_posts( array(
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'oxy_slideshow_categories',
                    'field' => 'slug',
                    'terms' => $slug_or_ids
                )
            ),
            'post_type' => 'oxy_slideshow_image',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
    }
    $xtracapsclss = ( $captionanimation =='animated')?' fadeup animated delayed':'';
    $flex_itemwidth = ($itemwidth!=='')?' data-flex-itemwidth='.$itemwidth.'px':'';
    $id = 'flexslider-' . rand(1,100);
    $output = '';
    $output .= '<div id="' . $id . '" class="flexslider flex-directions-fancy"'.$flex_itemwidth.' data-flex-animation="'.$animation.'" data-flex-controlsalign="center" data-flex-controlsposition="'.$controlsposition.'" data-flex-directions="'.$directionnav.'" data-flex-speed="'.$speed.'" data-flex-directions-position="'.$directionnavpos.'" data-flex-controls="'.$showcontrols.'" data-flex-slideshow="' . $autostart . '" data-flex-duration="'.$duration.'">';
    $output .= '<ul class="slides">';

    global $post;
    foreach( $slides as $post ) {
        setup_postdata( $post );
        $output .= '<li><div class="super-hero-unit"><figure>';

        if( $post->post_type == 'attachment' ) {
            $output .= '<a class="fancybox" rel="' . $id . '" href="' . $post->guid . '">';
            $output .= '<img src="' . $post->guid . '"/>';
            $output .= '</a>';
        }
        else {
            $link = oxy_get_slide_link( $post );
            if( null !== $link ) {
                $output .= '<a href="' . $link . '">';
            }
            $output .= get_the_post_thumbnail( $post->ID, 'full' );
            if( null !== $link ) {
                $output .= '</a>';
            }
        }
        if( $captions == 'show') {
            $output .= '<figcaption class="flex-caption"><p class="'.$captionsize . $xtracapsclss.'">' . oxy_filter_title( get_the_title() ) . '</p></figcaption>';
        }
        $output .= '</figure></div></li>';
    }
    $output .=  '</ul></div>';

    $post = $tmp_post;
    if( $post !== null ) {
        setup_postdata( $post );
    }
    if( $echo ) {
        echo $output;
    }
    else {
        return $output;
    }
}

/**
 * Gets the url that a slide should link to
 *
 * @return url link
 * @since 1.2
 **/
function oxy_get_slide_link( $post ) {
    $link_type = get_post_meta( $post->ID, THEME_SHORT . '_link_type', true );
    switch( $link_type ) {
        case 'page':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_page_link', true );
            return get_permalink( $id );
        break;
        case 'post':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_post_link', true );
            return get_permalink( $id );
        break;
        case 'category':
            $slug = get_post_meta( $post->ID, THEME_SHORT . '_category_link', true );
            $cat = get_category_by_slug( $slug );
            return get_category_link( $cat->term_id );
        break;
        case 'portfolio':
            $id = get_post_meta( $post->ID, THEME_SHORT . '_portfolio_link', true );
            return get_permalink( $id );
        break;
        case 'url':
            return get_post_meta( $post->ID, THEME_SHORT . '_url_link', true );
        break;
    }
}

// enable support for custom backgrounds
$args = array(
    'default-color' => '',
    'default-image' => '%s/images/bundled/bedge_grunge.png',
);

global $wp_version;
if ( version_compare( $wp_version, '3.4', '>=' ) ) {
    add_theme_support( 'custom-background' , $args );
}
else {
    add_custom_background( $args );
}


// this theme supports custom headers
add_theme_support( 'custom-header', array(
    'default-image' => '%s/images/bundled/landscape-2-1250x300.jpg',
    'header-text' => false,
    'width' => 1250,
    'height' => 300
));

// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
register_default_headers( array(
    '1' => array(
        'url' => '%s/images/bundled/landscape-1-1250x300.jpg',
        'thumbnail_url' => '%s/images/bundled/landscape-1-300x300.jpg',
        /* translators: header image description */
        'description' => __( 'Landscape 1', THEME_ADMIN_TD )
    ),
    '2' => array(
        'url' => '%s/images/bundled/landscape-2-1250x300.jpg',
        'thumbnail_url' => '%s/images/bundled/landscape-2-300x300.jpg',
        /* translators: header image description */
        'description' => __( 'Landscape 2', THEME_ADMIN_TD )
    ),
    '3' => array(
        'url' => '%s/images/bundled/landscape-3-1250x300.jpg',
        'thumbnail_url' => '%s/images/bundled/landscape-3-300x300.jpg',
        /* translators: header image description */
        'description' => __( 'Landscape 3', THEME_ADMIN_TD )
    ),
    '4' => array(
        'url' => '%s/images/bundled/landscape-4-1250x300.jpg',
        'thumbnail_url' => '%s/images/bundled/landscape-4-300x300.jpg',
        /* translators: header image description */
        'description' => __( 'Landscape 4', THEME_ADMIN_TD )
    ),
    '5' => array(
        'url' => '%s/images/bundled/landscape-5-1250x300.jpg',
        'thumbnail_url' => '%s/images/bundled/landscape-5-300x300.jpg',
        /* translators: header image description */
        'description' => __( 'Landscape 5', THEME_ADMIN_TD )
    ),
));

function oxy_page_header() {
    global $post;
    // check if it is the blog list page
    if ( is_home() ) {
        $post_id =get_option('page_for_posts');
    }
    else {
        $post_id = $post->ID;
    }
    switch( get_post_meta( $post_id, THEME_SHORT . '_header_type', true ) ) {
        case 'none':
            if ( is_home() ) {
                oxy_create_hero_section(null, null);
            }
        break;
        case 'slideshow':
            ?>
            <section class="section section-alt">
                <div class="row-fluid">
                    <?php
                    $slideshow_slug = get_post_meta( $post_id, THEME_SHORT . '_slideshow', true );
                    oxy_create_flexslider( $slideshow_slug );
                    ?>
                </div>
            </section><?php
        break;
        case 'revslider':
            ?>
            <section class="section section-alt">
                <div class="row-fluid">
                    <?php
                    $slideshow_alias = get_post_meta( $post_id, THEME_SHORT . '_revslider', true );
                    if (function_exists('putRevSlider')) {
                        putRevSlider( $slideshow_alias );
                    }
                    ?>
                </div>
            </section>
            <?php
        break;
        case 'super_hero':
            $override_image = get_post_meta( $post_id, THEME_SHORT . '_thickbox', true );
            $img = null;
            if( !empty( $override_image ) ) {
                $img = wp_get_attachment_image_src( $override_image, 'full' );
                if( $img[0] !== null ) {
                    $img = $img[0];
                }
            }
            $title = get_post_meta( $post_id, THEME_SHORT . '_header_title', true ) == '' ? get_the_title():get_post_meta( $post_id, THEME_SHORT . '_header_title', true );
            oxy_create_hero_section( $img, $title );
        break;
        case 'map':?>
            <section class="section section-alt">
                <div id="map"></div>
            </section>
        <?php
        break;
    }
}

/**************** TIMELINE ***************************/

function oxy_infinite_scroll(){
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'oxygenna-sign-me-up-nonce') ) {
            $paged           = $_POST['page_no'];
            $cat             = $_POST['category'];
            $posts_per_page  = get_option('posts_per_page');

            # Load the posts
            if ( $_POST['category'] == "")
                $args = array( 'paged' => $paged , 'post_type' => 'post' );
            else
                $args = array( 'paged' => $paged , 'category_name' => $cat , 'post_type' => 'post' );
            $myposts = new WP_Query( $args );
            while( $myposts->have_posts() ):
                $myposts->the_post();
                get_template_part( 'partials/timeline/content' , get_post_format() );
            endwhile;

            wp_reset_postdata();
            exit;
        }
    }
}

add_action('wp_ajax_infinite_scroll', 'oxy_infinite_scroll');
add_action('wp_ajax_nopriv_infinite_scroll', 'oxy_infinite_scroll');



/*************** COMMENTS ***************************/


/** COMMENTS WALKER */
class OxyCommentWalker extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );


    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
           return;

        $id_field = $this->db_fields['id'];
        $id = $element->$id_field;

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        // If we're at the max depth, and the current element still has children, loop over those and display them at this level
        // This is to prevent them being orphaned to the end of the list.
        if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
            foreach ( $children_elements[ $id ] as $child )
                $this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );

            unset( $children_elements[ $id ] );
        }

    }

    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>

        <div id="comment-list">

    <?php }

    /** START_LVL
     * Starts the list before the CHILD elements are added. Unlike most of the walkers,
     * the start_lvl function means the start of a nested comment. It applies to the first
     * new level under the comments that are not replies. Also, it appear that, by default,
     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

                <!--<ul class="children">-->
    <?php }

    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        <!--</ul>--><!-- /.children -->

    <?php }

    /** START_EL */
    function start_el( &$output, $comment, $depth=0, $args=array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
        <?php
        switch ( $comment->comment_type ) :
             case 'pingback':
             case 'trackback':
             // Display trackbacks differently than normal comments.
        ?>
        <div>
            <p><?php _e( 'Pingback:', THEME_FRONT_TD ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', THEME_FRONT_TD ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
            default:
            // Proceed with normal comments.
            global $post;
        ?>

        <div <?php comment_class( 'media media-comment' ); ?> >
            <div class="round-box box-mini pull-left">
                <?php echo get_avatar( $comment, 300 ); ?>
            </div>
            <div class="media-body">
                <div class="media-inner">
                    <div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
                        <h5 class="media-heading">
                            <?php comment_author_link(); ?>
                            -
                            <?php comment_date(); ?>
                            <span class="comment-reply pull-right">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', THEME_FRONT_TD ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </span>
                        </h5>
                        <?php comment_text(); ?>
                    </div>
                </div>
    <?php endswitch; ?>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) {
        switch ( $comment->comment_type ) :
            case 'pingback':
            case 'trackback':
             // Display trackbacks differently than normal comments.
        ?>
        </div>
        <?php
            break;
            default:
        ?>
            </div><!-- /media body -->
        </div><!-- /comment-->
        <?php endswitch;

    }

    /** DESTRUCTOR
     * I just using this since we needed to use the constructor to reach the top
     * of the comments list, just seems to balance out :) */
    function __destruct() { ?>

    </div><!-- /#comment-list -->

    <?php }
}


/**
 * Customize comments form
 *
 *@return void
 *@since 1.0
 **/
function oxy_comment_form( $args = array(), $post_id = null ) {
    global $user_identity, $id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();

    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<div class="control-group"><div class="controls"><input id="author" name="author" placeholder="' . __('your name', THEME_FRONT_TD) . '" type="text" class="input-xlarge" value="' . esc_attr( $commenter['comment_author'] ) .  '"/></div></div>',
        'email'  => '<div class="control-group"><div class="controls"><input id="email" name="email" placeholder="' . __('your email address', THEME_FRONT_TD) . '" type="text" class="input-xlarge" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div></div>',
        'url'    => '',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s', THEME_FRONT_TD), '<span class="required"><a>*</a></span>' );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<div class="control-group message"><div class="controls"><textarea id="comment" name="comment" placeholder="' . __('add your comment here', THEME_FRONT_TD) . '" class="input-xxlarge" rows="3"></textarea></div></div>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', THEME_FRONT_TD ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', THEME_FRONT_TD ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',

        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Add your comment', THEME_FRONT_TD ),
        'title_reply_to'       => __( 'Leave a Reply', THEME_FRONT_TD ),
        'cancel_reply_link'    => __( 'Cancel reply', THEME_FRONT_TD ),
        'label_submit'         => __( 'Add comment', THEME_FRONT_TD ),
    );

    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    ?>
        <?php if ( comments_open() ) : ?>
            <?php do_action( 'comment_form_before' ); ?>
            <div class="comments-form"  id="respond">
                <h3 id="reply-title" class="comment-form small-screen-center"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small id="cancel-comment-reply"><?php cancel_comment_reply_link('Cancel') ?></small></h3>
                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                    <?php echo $args['must_log_in']; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                        <fieldset>
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                        <?php else : ?>
                            <?php echo $args['comment_notes_before']; ?>
                            <?php
                            do_action( 'comment_form_before_fields' );
                            foreach( (array) $args['fields'] as $name => $field ) {
                                echo apply_filters( 'comment_form_field_'.$name, $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                            ?>
                        <?php endif; ?>
                        <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                        <?php echo $args['comment_notes_after']; ?>
                        <div class="control-group">
                            <div class="controls small-screen-center">
                                <button name="submit" type="submit" class="btn btn-primary" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>
                                <?php comment_id_fields(); ?>
                            </div>
                        </div>


                        <?php do_action( 'comment_form', $post_id ); ?>
                        </fieldset>
                    </form>
                <?php endif; ?>
            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php else : ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php endif; ?>
    <?php
}

/**
 * Enables threaded comments
 *
 *@return void
 *@since 1.0
 **/

function oxy_enable_threaded_comments(){
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}

add_action('get_header', 'oxy_enable_threaded_comments');


/**
 * post navigation
 */
function oxy_results_nav( $nav_id ) {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <ul class="pager">
                <li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', THEME_FRONT_TD ) ); ?></li>
                <li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', THEME_FRONT_TD ) ); ?></li>
            </ul>
        </nav><!-- #nav-above -->
    <?php endif;
}

function oxy_pagination( $pages = '', $range = 2 ){
    $showitems = ($range * 2)+1;
    //$showitems =2;
    global $paged;
    if(empty($paged)) {
        $paged = 1;
    }

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages){
            $pages = 1;
        }
    }

    if(1 != $pages){
        echo "<div class='pagination pagination-centered'><ul>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
        if($paged > 1 && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
        if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages)
            echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
        echo "</ul></div>\n";
    }
}

function oxy_limit_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if( count($words) > $word_limit ) {
        array_pop($words);
        return implode(' ', $words).'...';
    }
    else{
        return implode(' ', $words);
    }
}

/* -------------------- OVERRIDE DEFAULT SEARCH WIDGET OUTPUT ------------------*/
function oxy_custom_search_form( $form ) {

    $output = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" ><div class="input-append row-fluid">';
    $output.= '<input type="text" value="' . get_search_query() . '" name="s" id="s" class="span12" placeholder="' . __('search', THEME_FRONT_TD) . '"/><i class="icon-search"></i>';
    $output.= '<button class="btn hide" type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" >search</button></div></form>';

    return $output;
}
add_filter( 'get_search_form', 'oxy_custom_search_form' );

// override default tag cloud widget output
function oxy_custom_wp_tag_cloud_filter($content, $args) {
    $content = str_replace('<a' , '<li><a' , $content);
    $content = str_replace('</a>' , '</a></li>' , $content);
    return '<ul>'. $content . '</ul>';
}

add_filter('wp_tag_cloud','oxy_custom_wp_tag_cloud_filter', 10, 2);

// 11px tag cloud font size
function oxy_custom_tag_cloud_args($args) {
    $args['largest'] = 11; //largest tag
    $args['smallest'] = 11; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'oxy_custom_tag_cloud_args' );

/* --------------- add a wrapper for the embeded videos -------------*/
add_filter('embed_oembed_html', 'oxy_add_video_embed_note', 10, 3);

function oxy_add_video_embed_note( $html, $url, $attr ) {
    return '<div class="videoWrapper">'. $html .'</div>';
}


/* Function for replacing title contents including underscores with span tags*/
function oxy_filter_title( $title ) {
    $title = preg_replace("/_(.*)_\b/",'<span class="light">$1</span>' , $title);
    return $title;
}

/* function to return an icon depending the format of the post */

function oxy_post_icon( $post_id , $echo =true){
    $format = get_post_format( $post_id );
    switch ($format) {
        case 'gallery':
            $output = '<i class="icon-picture"></i>';
            break;
        case 'link':
            $output = '<i class="icon-link"></i>';
            break;
        case 'quote':
            $output = '<i class="icon-quote-left"></i>';
            break;
        case 'video':
            $output = '<i class="icon-play"></i>';
            break;
        default:
            $output = '';
            break;
    }
    if($echo)
        echo $output;
    else
        return $output;
}

function oxy_get_content_gallery( $post ) {
    $pattern = get_shortcode_regex();
    $gallery_ids = null;
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'gallery', $matches[2] ) ) {
        // gallery shortcode is being used

        // do we have some attribues?
        if( array_key_exists( 3, $matches ) ) {
            if( array_key_exists( 0, $matches[3] ) ) {
                $gallery_attrs = shortcode_parse_atts( $matches[3][0] );
                if( array_key_exists( 'ids', $gallery_attrs) ) {
                    $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                    return $gallery_ids;
                }
            }
        }
    }
}

function oxy_get_content_shortcode( $post, $shortcode_name ) {
    $pattern = get_shortcode_regex();
    // look for an embeded shortcode in the post content
    if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( $shortcode_name, $matches[2] ) ) {
        return $matches;
    }
}

function oxy_remove_readmore_span($content) {
    global $post;
    if( isset( $post ) ) {
        $content = str_replace('<span id="more-' . $post->ID . '"></span><!--noteaser-->', '', $content);
        $content = str_replace('<span id="more-' . $post->ID . '"></span>', '', $content);
    }
    return $content;
}
add_filter('the_content', 'oxy_remove_readmore_span');

function oxy_fix_shortcodes($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'oxy_fix_shortcodes');

function oxy_output_extra_css() { ?>
    <style type="text/css" media="screen">
        <?php echo get_option( THEME_SHORT . '-header-css', '' ); ?>
        <?php echo oxy_get_option( 'extra_css' ); ?>
    </style>
<?php
}
add_action('wp_head', 'oxy_output_extra_css');

function oxy_wp_link_pages($args = '') {
    $defaults = array(
            'before' => '' ,
        'after' => '',
            'link_before' => '',
        'link_after' => '',
            'next_or_number' => 'number',
        'nextpagelink' => __('Next page'),
            'previouspagelink' => __('Previous page'),
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
            $output .= $before . '<ul>';
            $laquo = $page == 1 ? 'class="disabled"' : '';
            $output .= '<li ' . $laquo .'>' . _wp_link_page($page -1) . '&laquo;</a></li>';
            for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
                $j = str_replace('%',$i,$pagelink);

                if ( ($i != $page) || ((!$more) && ($page==1)) ) {
                    $output .= '<li>';
                    $output .= _wp_link_page($i) ;
                }
                else{
                    $output .= '<li class="active">';
                    $output .= _wp_link_page($i) ;
                }
                $output .= $link_before . $j . $link_after ;
                $output .= '</a>';

                $output .= '</li>';
            }
            $raquo = $page == $numpages ? 'class="disabled"' : '';
            $output .= '<li ' . $raquo .'>' . _wp_link_page($page +1) . '&raquo;</a></li>';
            $output .= '</ul>' . $after;
        }
        else {
            if ( $more ) {
                $output .= $before . '<ul class="pager">';
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= '<li class="previous">' . _wp_link_page($i);
                    $output .= $link_before. $previouspagelink . $link_after . '</a></li>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= '<li class="next">' .  _wp_link_page($i);
                    $output .= $link_before. $nextpagelink . $link_after . '</a></li>';
                }
                $output .= '</ul>' . $after;
            }
        }
    }

    if ( $echo ) {
        echo $output;
    }

    return $output;
}

if ( ! isset( $content_width ) )  {
    $content_width = 1250;
}


function oxy_related_posts( $post_id ){
    $tags = wp_get_post_tags($post_id);
    $span = oxy_get_option('related_posts_number') == 4? 'span3':'span2';
    if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag)
            $tag_ids[] = $individual_tag->term_id;

        $args=array(
            'tag__in'        => $tag_ids,
            'post__not_in'   => array($post_id),
            'posts_per_page' => oxy_get_option('related_posts_number'),
        );
        global $post;
        $saved_post = $post;
        $related = new wp_query( $args );
        $output = '';
        if( $related->have_posts() ) {
            $output .= '<h3 class="text-center">'. __('Related Posts', THEME_FRONT_TD ).'</h3>';
            $output .= '<ul class="unstyled row-fluid post-navigation">';
            while( $related->have_posts() ) {
                $related->the_post();
                if('link' == get_post_format()){
                    $post_link = oxy_get_external_link();
                }
                else{
                    $post_link = get_permalink();
                }
                $output .= '<li class="'.$span.'">';
                $output .= '<div class="round-box round-medium box-colored box-small-icon">';
                $output .= '<a rel="tooltip" href="' . $post_link . '" class="box-inner" data-placement="bottom" data-toggle="tooltip" data-original-title="'.get_the_title().'">';
                            if( has_post_thumbnail( $post->ID ) ) {
                                $output .= get_the_post_thumbnail( $post->ID, 'portfolio-thumb', array( 'class' => 'img-circle' ) );
                                $output .= oxy_post_icon($post->ID ,false);
                            }
                            else{
                                $output .= '<img class="img-circle" src="'.IMAGES_URI.'box-empty.gif">';
                                $output .= oxy_post_icon($post->ID ,false);
                            }
                $output.= '</a></div></li>';
            }
            $output .= '</ul>';;
        }
        $post = $saved_post;
        wp_reset_query();
        echo $output;
    }
}

/**
 * Apple device icons
 *
 * @return echos html for apple icons
 **/
function oxy_add_apple_icons( $option_name, $sizes = '' ) {
    $icon = oxy_get_option( $option_name );
    if( false !== $icon ) {
        $rel = oxy_get_option( $option_name . '_pre', 'apple-touch-icon' );
        echo '<link rel="' . $rel . '" href="' . $icon . '" ' . $sizes  . ' />';
    }
}

function oxy_author_bio( $author_id ){
    $output = '<div class="row-fluid post-navigation">';
    $output .= '<div class="span2 post-info"><div class="round-box box-small">';
    $output .= get_avatar( $author_id, 300 ) . '</div>';
    $output .= '</div>';
    $output .= '<div class="span10">';
    $output .= '<h3 class="small-screen-center">'. __( 'About ', THEME_FRONT_TD ) . get_the_author_meta('display_name') . '</h3>';
    $output .= get_the_author_meta('description');
    $output .= '</div></div>';

    echo $output;
}

function oxy_get_external_link(){
    global $post;
    $link_shortcode = oxy_get_content_shortcode( $post, 'link' );
    if( $link_shortcode !== null ) {
        if( isset( $link_shortcode[5] ) ) {
            $link_shortcode = $link_shortcode[5];
            if( isset( $link_shortcode[0] ) ) {
                return $link_shortcode[0] ;
            }
            else{
                return get_permalink();
            }
        }
    }
}

function oxy_get_icon_color( $icon ) {
    switch( $icon ) {
        case 'icon-facebook':
        case 'icon-facebook-sign':
            return '#3b5998';
        break;
        case 'icon-twitter':
        case 'icon-twitter-sign':
            return '#00a0d1';
        break;
        case 'icon-linkedin':
        case 'icon-linkedin-sign':
            return '#5FB0D5';
        break;
        case 'icon-github':
        case 'icon-github-sign':
        case 'icon-github-alt':
        case 'icon-git-fork':
        break;
        case 'icon-pinterest':
        case 'icon-pinterest-sign':
            return '#910101';
        break;
        case 'icon-google-plus':
        case 'icon-google-plus-sign':
            return '#E45135';
        break;

        case 'icon-skype':
            return '#00aff0';
        break;

        case 'icon-youtube-sign':
        case 'icon-youtube':
            return '#c4302b';
        break;

        case 'icon-dropbox':
            return '#3d9ae8';
        break;
        case 'icon-drupal':
            return '#0c76ab';
        break;

        break;
        case 'icon-instagram':
            return '#634d40';
        break;

        case 'icon-share-this-sign':
        break;
        case 'icon-share-this':
        break;

        case 'icon-foursquare':
        case 'icon-foursquare-sign':
            return '#25a0ca';
        break;

        case 'icon-hacker-news':
            return '#ff6600';
        break;
        case 'icon-spotify':
            return '#81b71a';
        break;
        case 'icon-soundcloud':
            return '#ff7700';
        break;
        case 'icon-paypal':
            return '#3b7bbf';
        break;

        case 'icon-reddit':
        break;

        case 'icon-blogger':
        case 'icon-blogger-sign':
            return '#fc4f08';
        break;

        case 'icon-dribbble-sign':
        case 'icon-dribbble':
            return '#ea4c89';
        break;
        case 'icon-evernote-sign':
        case 'icon-evernote':
            return '#5ba525';
        break;

        case 'icon-flickr-sign':
            return '#ff0084';
        break;
        case 'icon-flickr':
            return '#0063dc';
        break;

        case 'icon-forrst-sign':
        case 'icon-forrst':
            return '#5b9a68';
        break;

        case 'icon-delicious':
            case '#205cc0';
        break;
        case 'icon-lastfm':
        case 'icon-lastfm-sign':
            return '#c3000d';
        break;

        case 'icon-picasa-sign':
        break;
        case 'icon-picasa':
        break;

        case 'icon-stack-overflow':
            return '#ef8236';
        break;
        case 'icon-tumblr-sign':
        case 'icon-tumblr':
            return '#34526f';
        break;
        case 'icon-vimeo':
        case 'icon-vimeo-sign':
            return '#86c9ef';
        break;

        case 'icon-wordpress-sign':
            return '#464646';
        break;
        case 'icon-wordpress':
            return '#21759b';
        break;
        case 'icon-yelp-sign':
        case 'icon-yelp':
            return '#c41200';
        break;
    }
}