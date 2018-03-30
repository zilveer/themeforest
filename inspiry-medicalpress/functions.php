<?php
/*-----------------------------------------------------------------------------------*/
/*	Basic Theme Setup
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_theme_setup')) {
    function inspiry_theme_setup(){

        /*	Load Text Domain */
        load_theme_textdomain('framework', get_template_directory() . '/languages');

        /*	Add Automatic Feed Links Support */
        add_theme_support('automatic-feed-links');

        /* Add Post Formats Support */
        add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio'));

        /* Add Menu Support */
        add_theme_support('menus');
        register_nav_menus( array ( 'main-menu' => __( 'Main Menu', 'framework' ) ) );

        /* Add Post Thumbnails Support and Related Image Sizes */
        add_theme_support('post-thumbnails');
        add_image_size('blog-page', 732, 9999, false);                  // For Blog Page
        add_image_size('default-page', 1140, 9999, false);              // Default Page and Full Width Page
        add_image_size('blog-post-thumb', 732, 447, true);              // For Home Blog Section and Gallery Slider on Single and Blog Page
        add_image_size('testimonial-thumb', 130, 130, true);            // For Testimonial Post
        add_image_size('services-one-col-thumb', 570, 250, true);       // For one column services page
        add_image_size('service-gallery-thumb', 848, 518, true);        // For service single page and two columns, three columns, four columns services pages.
        add_image_size('gallery-post-single', 670, 500, true);          // For Gallery Single Post Slider and Various Other Parts of theme like doctors pages
        add_image_size('gallery-post-single-thumb', 111, 69, true);     // For Gallery Single Post Thumbnail

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

    }
}
add_action('after_setup_theme', 'inspiry_theme_setup');


/*-----------------------------------------------------------------------------------*/
/* WooCommerce related function
/*-----------------------------------------------------------------------------------*/
if ( class_exists( 'woocommerce' ) ) {
    require_once( get_template_directory() . '/include/inspiry-woocommerce-functions.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation Class and related code to get the plugins installed and activated
/*-----------------------------------------------------------------------------------*/
require_once( get_template_directory() . '/tgm/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/tgm/plugins-list.php' );


/*-----------------------------------------------------------------------------------*/
/*	Include Theme Options Framework
/*-----------------------------------------------------------------------------------*/
if ( class_exists('ReduxFramework') ) {
    require_once( get_template_directory() . '/theme-options/loader.php' );
    require_once( get_template_directory() . '/theme-options/medical-config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Include Contact Form Handler and Theme Comment
/*-----------------------------------------------------------------------------------*/
require_once(get_template_directory() . '/include/contact_form_handler.php');
require_once(get_template_directory() . '/include/theme_comment.php');


/*-----------------------------------------------------------------------------------*/
/*	Include Meta Box
/*-----------------------------------------------------------------------------------*/
require_once(get_template_directory() . '/meta-box/config-meta-boxes.php');


/*-----------------------------------------------------------------------------------*/
/*	Include Shortcodes
/*-----------------------------------------------------------------------------------*/
require_once(get_template_directory() . '/include/shortcodes/elements.php');
require_once(get_template_directory() . '/include/shortcodes/vc-map.php');


/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Types
/*-----------------------------------------------------------------------------------*/
require_once(get_template_directory() . '/include/doctor-post-type.php');
require_once(get_template_directory() . '/include/testimonial-post-type.php');
require_once(get_template_directory() . '/include/faq-post-type.php');
require_once(get_template_directory() . '/include/service-post-type.php');
require_once(get_template_directory() . '/include/gallery-post-type.php');


/*-----------------------------------------------------------------------------------*/
//	Dynamic CSS
/*-----------------------------------------------------------------------------------*/
require_once( get_template_directory() . '/css/dynamic-css.php' );


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_admin_js')) {
    function inspiry_admin_js($hook){

        if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
            if ( isset ( $_GET['post'] ) ) {
                $post_id = intval( $_GET['post'] );
                if ("post" == get_post_type($post_id)) {
                    wp_register_script('admin-script', get_template_directory_uri() . '/js/admin.js', 'jquery');
                    wp_enqueue_script('admin-script');
                }
            }
        }

        if( $hook == 'toplevel_page__options' ) {
            wp_enqueue_style( 'inspiry-admin-css', get_template_directory_uri() . '/css/admin.css' );
        }
    }
}
add_action('admin_enqueue_scripts', 'inspiry_admin_js', 10, 1);


/*-----------------------------------------------------------------------------------*/
/*	Add Widget Areas
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_sidebar' ) ) {

    // Location: Default Sidebar
    register_sidebar(array(
        'id' => 'default',
        'name' => __('Default Sidebar', 'framework'),
        'description' => __('This sidebar is for blog page, blog posts and pages that use default template.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Footer First Column
    register_sidebar(array(
        'id' => 'footer-1st-column',
        'name' => __('Footer First Column', 'framework'),
        'description' => __('This represents the 1st column widget area in footer.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget animated fadeInLeft %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Footer Second Column
    register_sidebar(array(
        'id' => 'footer-2nd-column',
        'name' => __('Footer Second Column', 'framework'),
        'description' => __('This represents the 2nd column widget area in footer.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget animated fadeInLeft %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Footer Third Column
    register_sidebar(array(
        'id' => 'footer-3rd-column',
        'name' => __('Footer Third Column', 'framework'),
        'description' => __('This represents the 3rd column widget area in footer.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget animated fadeInLeft %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Footer Fourth Column
    register_sidebar(array(
        'id' => 'footer-4th-column',
        'name' => __('Footer Fourth Column', 'framework'),
        'description' => __('This represents the 4th column widget area in footer.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget animated fadeInLeft %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Service Detail Page Sidebar
    register_sidebar(array(
        'id' => 'service-detail-page',
        'name' => __('Service Detail Page', 'framework'),
        'description' => __('This sidebar is for service detail page.', 'framework'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    if ( class_exists( 'woocommerce' ) ) {
        // Location: Shop page sidebar
        register_sidebar(array(
            'id' => 'shop',
            'name' => __('Shop Page', 'framework'),
            'description' => __('This sidebar is for WooCommerce shop page.', 'framework'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Widgets
/*-----------------------------------------------------------------------------------*/
require_once(get_template_directory() . '/widgets/' . 'tabs-widget.php');


/*-----------------------------------------------------------------------------------*/
/*	Theme Breadcrumb
/*-----------------------------------------------------------------------------------*/

if (!function_exists('theme_breadcrumb')) {
    function theme_breadcrumb()
    {
        global $theme_options;
        if( $theme_options['breadcrumb'] == '0' ){
            return;
        }

        echo '<ul class="breadcrumb clearfix">';

        /* For all pages other than front page */
        if ( !is_front_page() ) {
            echo '<li>';
            echo '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>';
            echo '<span class="divider"></span></li>';
        }

        /* For index.php OR blog posts page */
        if ( is_home() ) {
            $page_for_posts = get_option('page_for_posts');
            if ( $page_for_posts ) {
                $blog = get_post( $page_for_posts );
                echo '<li>';
                echo $blog->post_title;
                echo '</li>';
            } else {
                echo '<li>';
                _e('Blog', 'framework');
                echo '<li>';
            }
        }

        if ( is_category() || is_singular( 'post' ) ) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo '<li>';
            echo get_category_parents( $ID, TRUE, ' <span class="divider"></span></li><li>', FALSE );
        }

        if ( is_tax( 'gallery-item-type' ) || is_tax( 'department' ) ) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            if ( !empty( $current_term->name ) ) {
                echo '<li class="active">';
                echo $current_term->name;
                echo '</li>';
            }
        }

        if ( is_singular('post') || is_singular('doctor') || is_singular('service') || is_singular('gallery-item') || is_page() ) {

            global $post;

            if ( is_page() ) {
                inspiry_page_parent_breadcrumbs( $post );
            } elseif ( is_singular( 'doctor' ) ) {
                $inspiry_doctors_page = $theme_options['inspiry_doctors_page'];
                if ( !empty( $inspiry_doctors_page ) ) {
                    inspiry_page_parent_breadcrumbs( get_post( $inspiry_doctors_page ) );
                    inspiry_page_breadcrumb( $inspiry_doctors_page );
                }
            } elseif ( is_singular( 'service' ) ) {
                $inspiry_services_page = $theme_options['inspiry_services_page'];
                if ( !empty( $inspiry_services_page ) ) {
                    inspiry_page_parent_breadcrumbs( get_post( $inspiry_services_page ) );
                    inspiry_page_breadcrumb( $inspiry_services_page );
                }
            } elseif ( is_singular( 'gallery-item' ) ) {
                $inspiry_gallery_page = $theme_options['inspiry_gallery_page'];
                if ( !empty( $inspiry_gallery_page ) ) {
                    inspiry_page_parent_breadcrumbs( get_post( $inspiry_gallery_page ) );
                    inspiry_page_breadcrumb( $inspiry_gallery_page );
                }
            }

            // Simple title
            echo '<li class="active">';
            the_title();
            echo '</li>';
        }

        if (is_tag()) {
            echo '<li>';
            _e('Tag: ', 'framework');
            echo single_tag_title('', FALSE);
            echo '</li>';
        }

        if (is_404()) {
            echo '<li>';
            _e('404 - Page not Found', 'framework');
            echo '</li>';

        }

        if (is_search()) {
            echo '<li>';
            _e('Search', 'framework');
            echo '</li>';
        }

        if (is_year()) {
            echo '</li>';
            echo get_the_time('Y');
            echo '</li>';
        }

        echo "</ul>";

    }
}

if( !function_exists( 'inspiry_page_parent_breadcrumbs' ) ) :
    function inspiry_page_parent_breadcrumbs( $page ) {
        $parent_id = $page->post_parent;
        if ( $parent_id ) {

            $parents = array();

            while ( $parent_id ) {
                $parents[] = $parent_id;
                $page = get_post( $parent_id );
                $parent_id = $page->post_parent;
            }

            $parents_count = count( $parents );
            for ( $i = $parents_count; $i > 0; ) {
                $parent_id = $parents[--$i];
                echo '<li>';
                echo '<a href="' . get_the_permalink( $parent_id ) . '">' ;
                echo get_the_title( $parent_id );
                echo '</a>';
                echo '<span class="divider"></span>';
                echo '</li>';
            }
        }
    }
endif;

if( !function_exists( 'inspiry_page_breadcrumb' ) ) :
    /**
     * Output single page breadcrumb part
     * Example: Page Title -->
     * @param $page_id
     */
    function inspiry_page_breadcrumb( $page_id ) {
        printf( '<li><a href="%1$s">%2$s</a><span class="divider"></span></li>',
            esc_url( get_the_permalink( $page_id ) ),
            get_the_title( $page_id )
        );
    }
endif;



/*-----------------------------------------------------------------------------------*/
/*	Inspiry Theme Pagination
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_pagination')) {
    function inspiry_pagination($query){
        echo "<div class='pagination'>";
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'prev_text' => __(' < ', 'framework'),
            'next_text' => __(' > ', 'framework'),
            'current' => max(1, get_query_var('paged')),
            'total' => $query->max_num_pages
        ));
        echo "</div>";
    }
}


/*-----------------------------------------------------------------------------------*/
/*	List Gallery Images
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_list_gallery_images')) {
    function inspiry_list_gallery_images($size = 'blog-post-thumb') {
        ?>
        <ul class="slides">
            <?php
            global $post;

            $gallery_images = rwmb_meta('MEDICAL_META_gallery', 'type=plupload_image&size=' . $size, $post->ID);

            if (!empty($gallery_images)) {
                foreach ($gallery_images as $gallery_image) {
                    $caption = (!empty($gallery_image['caption'])) ? $gallery_image['caption'] : $gallery_image['alt'];
                    echo '<li><a href="' . $gallery_image['full_url'] . '" title="' . $caption . '" >';
                    echo '<img src="' . $gallery_image['url'] . '" alt="' . $gallery_image['title'] . '" />';
                    echo '</a></li>';
                }
            } else if (has_post_thumbnail($post->ID)) {
                echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '" >';
                the_post_thumbnail($size);
                echo '</a></li>';
            }
            ?>
        </ul>
    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*	List Gallery Images based on custom gallery meta data
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_list_custom_gallery_images')) {
    function inspiry_list_custom_gallery_images( $size = 'gallery-post-single' ) {
        ?>
        <ul class="slides">
            <?php
            global $post;
            $gallery_images = rwmb_meta('MEDICAL_META_custom_gallery', 'type=plupload_image&size=' . $size, $post->ID);
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $gallery_image) {
                    $caption = (!empty($gallery_image['caption'])) ? $gallery_image['caption'] : $gallery_image['alt'];
                    echo '<li><a href="' . $gallery_image['full_url'] . '" title="' . $caption . '" >';
                    echo '<img src="' . $gallery_image['url'] . '" alt="' . $gallery_image['title'] . '" />';
                    echo '</a></li>';
                }
            } else if ( has_post_thumbnail($post->ID) ) {
                echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '" >';
                the_post_thumbnail($size);
                echo '</a></li>';
            }
            ?>
        </ul>
    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Inspiry Standard Featured Image
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_standard_thumbnail')) {
    function inspiry_standard_thumbnail($size = 'blog-page')
    {
        global $post;
        if (has_post_thumbnail($post->ID) && (is_singular('post') || is_singular('doctor') || is_singular('service') || is_singular('gallery-item'))) {
            $image_id = get_post_thumbnail_id();
            $full_image_url = wp_get_attachment_url($image_id);
            ?>
            <figure>
                <a class="swipebox" href="<?php echo $full_image_url; ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail($size); ?>
                </a>
            </figure>
        <?php
        } else if (has_post_thumbnail($post->ID)) {
            ?>
            <figure>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail($size); ?>
                </a>
            </figure>
        <?php
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Get Banner Image
/*-----------------------------------------------------------------------------------*/
if (!function_exists('get_banner_image')) {
    function get_banner_image()
    {
        global $post;
        $post_id = $post->ID;

        if( is_home() ){
            $post_id = get_option( 'page_for_posts' );
        }

        $banner_image_id = get_post_meta( $post_id, 'MEDICAL_META_page_banner', true );
        if ($banner_image_id) {
            $banner_image_path = wp_get_attachment_url($banner_image_id);
        } else {
            $banner_image_path = get_default_banner();
        }
        return $banner_image_path;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Get Default Banner
/*-----------------------------------------------------------------------------------*/
if (!function_exists('get_default_banner')) {
    function get_default_banner()
    {
        global $theme_options;
        $banner_image_path = "";
        if (!empty($theme_options['default_page_banner'])) {
            $banner_image_path = $theme_options['default_page_banner']['url'];
        }
        return empty($banner_image_path) ? get_template_directory_uri() . '/images/banner.jpg' : $banner_image_path;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Load Required CSS Styles
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_load_styles')) {
    function inspiry_load_styles()
    {
        if (!is_admin()) {
            global $data;
            global $theme_options;

            // enqueue required fonts
            $protocol = is_ssl() ? 'https' : 'http';
            wp_enqueue_style('google-raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900");
            wp_enqueue_style('google-droid-serif', "$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic");

            wp_register_style('flexslider-css', get_template_directory_uri() . '/js/flexslider/flexslider.css', array(), '2.3.0', 'all');
            wp_register_style('animations-css', get_template_directory_uri() . '/css/animations.css', array(), '1.0', 'all');
            wp_register_style('font-awesome-css', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.0.3', 'all');
            wp_register_style('datepicker-css', get_template_directory_uri() . '/css/datepicker.css', array(), '1.10.4', 'all');
            wp_register_style('swipebox-css', get_template_directory_uri() . '/css/swipebox.css', array(), '1.2.1', 'all');
            wp_register_style('meanmenu-css', get_template_directory_uri() . '/css/meanmenu.css', array(), '2.0.6', 'all');
            wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.0', 'all');
            wp_register_style('main-css', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
            wp_register_style('custom-responsive-css', get_template_directory_uri() . '/css/custom-responsive.css', array(), '1.0', 'all');
            wp_register_style('select2-css', get_template_directory_uri() . '/css/select2.min.css', array(), '4.0.3', 'all');

            if ( is_rtl() ) {
                wp_register_style('bootstrap-rtl-css', get_template_directory_uri() . '/css/bootstrap-rtl.css', array(), '1.0', 'all');
                wp_register_style('main-rtl-css', get_template_directory_uri() . '/css/main-rtl.css', array('main-css'), '1.0', 'all');
                wp_register_style('custom-responsive-rtl-css', get_template_directory_uri() . '/css/custom-responsive-rtl.css', array(), '1.0', 'all');
            }

            wp_register_style('parent-default', get_stylesheet_uri(), array(), '1.0', 'all');
            wp_register_style('parent-custom',  get_template_directory_uri() . '/css/custom.css', array(), '1.2', 'all');

            // enqueue bootstrap styles
            wp_enqueue_style('bootstrap-css');
            if ( is_rtl() ) {
                wp_enqueue_style('bootstrap-rtl-css');
            }

            // enqueue Flex Slider styles
            wp_enqueue_style('flexslider-css');

            // enqueue animations styles
            if( $theme_options['animation'] ) {
                wp_enqueue_style('animations-css');
            }

            // enqueue Font Awesome styles
            wp_enqueue_style('font-awesome-css');

            // enqueue Date Picker styles
            wp_enqueue_style('datepicker-css');

            // enqueue Swipe Box styles
            if ( ! is_singular( 'product' ) ) {
                wp_enqueue_style('swipebox-css');
            }

            // enqueue Mean Menu styles
            wp_enqueue_style('meanmenu-css');

            // enqueue Select2 DropDown styles
            wp_enqueue_style('select2-css');

            // enqueue Theme's Main styles
            wp_enqueue_style('main-css');

            if ( is_rtl() ) {
                wp_enqueue_style('main-rtl-css');
            }

            // enqueue customer responsive css
            wp_enqueue_style('custom-responsive-css');

            if ( is_rtl() ) {
                wp_enqueue_style('custom-responsive-rtl-css');
            }

            // default css
            wp_enqueue_style('parent-default');

            // parent theme custom css
            wp_enqueue_style('parent-custom');

        }
    }
}
add_action('wp_enqueue_scripts', 'inspiry_load_styles');


/*-----------------------------------------------------------------------------------*/
/*	Load Required JS Scripts
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_load_scripts')) {
    function inspiry_load_scripts() {
        if (!is_admin()) {

            global $theme_options;

            /* Defining scripts directory uri */
            $js_path = get_template_directory_uri() . '/js/';
            $inspiry_localized_data = array();

            /* Registering Scripts */
            wp_register_script('bootstrap', $js_path . 'bootstrap.min.js', array('jquery'), '3.1.0', true);
            wp_register_script('flexslider', $js_path . 'flexslider/jquery.flexslider-min.js', array('jquery'), '2.3.0', true);
            wp_register_script('swipebox', $js_path . 'jquery.swipebox.min.js', array('jquery'), '1.2.1', true);
            wp_register_script('isotope', $js_path . 'jquery.isotope.min.js', array('jquery'), '1.5.25', true);
            wp_register_script('appear', $js_path . 'jquery.appear.js', array('jquery'), '0.3.3', true);
            wp_register_script('validate', $js_path . 'jquery.validate.min.js', array('jquery'), '1.11.1', true);
            wp_register_script('jquery-form', $js_path . 'jquery.form.js', array('jquery'), '3.43.0', true);
            wp_register_script('jplayer', $js_path . 'jquery.jplayer.min.js', array('jquery'), '2.6.0', true);
            wp_register_script('autosize', $js_path . 'jquery.autosize.min.js', array('jquery'), '1.18.7', true);
            wp_register_script('meanmenu', $js_path . 'jquery.meanmenu.min.js', array('jquery'), '2.0.6', true);
            wp_register_script('velocity', $js_path . 'jquery.velocity.min.js', array('jquery'), '0.0.0', true);
            wp_register_script('select2-js', $js_path . 'select2.min.js', array('jquery'), '4.0.3', true);


            /* Custom Script */
            wp_register_script('custom-script', $js_path . 'custom.js', array('jquery','velocity','meanmenu'), '1.0', true);

            /* Enqueue Scripts that are needed on all the pages */
            wp_enqueue_script('jquery');
            wp_enqueue_script('bootstrap');
            wp_enqueue_script('flexslider');

            // swipebox - control flag
            if ( $theme_options['swipebox'] == '1' && ( ! is_singular( 'product' ) ) ) {
                wp_enqueue_script('swipebox');
            }

            wp_enqueue_script('isotope');
            wp_enqueue_script('appear');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('validate');
            wp_enqueue_script('jquery-form');
            wp_enqueue_script('jplayer');
            wp_enqueue_script('autosize');
            wp_enqueue_script('meanmenu');
            wp_enqueue_script('velocity');
            wp_enqueue_script('select2-js');

            if ( is_page_template('contact-template.php') ) {

                $google_map_arguments = array();
                global $theme_options;

                // Get Google Map API Key if available
                if ( isset( $theme_options[ 'google_map_api_key' ] ) && ! empty( $theme_options[ 'google_map_api_key' ] ) ) {
                    $google_map_arguments[ 'key' ] = urlencode( $theme_options[ 'google_map_api_key' ] );
                }

                $google_map_api_uri = add_query_arg( apply_filters( 'inspiry_google_map_arguments', $google_map_arguments ) ,  '//maps.google.com/maps/api/js' );

                wp_enqueue_script(
                    'google-map-api',
                    esc_url_raw( $google_map_api_uri ),
                    array(),
                    '3.21',
                    false
                );
            }

            if (is_single() || is_page()) {
                wp_enqueue_script('comment-reply');
            }

            // for future use
            // wp_localize_script( 'custom-script', 'inspiry_localized_object', $inspiry_localized_data );

            wp_enqueue_script('custom-script');
        }
    }
}
add_action('wp_enqueue_scripts', 'inspiry_load_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Method
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_excerpt')) {
    function inspiry_excerpt($len = 15, $trim = "&hellip;")
    {
        $limit = $len + 1;
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        $num_words = count($excerpt);
        if ($num_words >= $len) {
            $last_item = array_pop($excerpt);
        } else {
            $trim = "";
        }
        $excerpt = implode(" ", $excerpt) . "$trim";
        echo $excerpt;
    }
}


if (!function_exists('get_inspiry_excerpt')) {
    function get_inspiry_excerpt($len = 15, $trim = "&hellip;")
    {
        $limit = $len + 1;
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        $num_words = count($excerpt);
        if ($num_words >= $len) {
            $last_item = array_pop($excerpt);
        } else {
            $trim = "";
        }
        $excerpt = implode(" ", $excerpt) . "$trim";
        return $excerpt;
    }
}


if (!function_exists('inspiry_comment_excerpt')) {
    function inspiry_comment_excerpt($len = 15, $comment_content = "", $trim = "&hellip;")
    {
        $limit = $len + 1;
        $excerpt = explode(' ', $comment_content, $limit);
        $num_words = count($excerpt);
        if ($num_words >= $len) {
            $last_item = array_pop($excerpt);
        } else {
            $trim = "";
        }
        $excerpt = implode(" ", $excerpt) . "$trim";
        echo $excerpt;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Generate Dynamic JavaScript
/*-----------------------------------------------------------------------------------*/
if (!function_exists('generate_dynamic_javascript')) {
    function generate_dynamic_javascript()
    {

        if (is_page_template('contact-template.php')) {
            global $theme_options;
            /* check if related theme option is enabled */
            if ($theme_options['display_google_map']) {
                /* Generate */
                ?>
                <script>
                    function initializeContactMap() {
                        var officeLocation = new google.maps.LatLng(<?php  echo $theme_options['google_map_latitude'];  ?>, <?php echo $theme_options['google_map_longitude'];  ?>);
                        var contactMapOptions = {
                            zoom:  <?php echo $theme_options['google_map_zoom'];  ?>,
                            center: officeLocation,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            scrollwheel: false
                        }
                        var contactMap = new google.maps.Map(document.getElementById('map-canvas'), contactMapOptions);

                        var contactMarker = new google.maps.Marker({
                            position: officeLocation,
                            map: contactMap
                        });

                    }
                    window.onload = initializeContactMap();
                </script>
            <?php
            }
        }
    }
}
/* Attach dynamic javascript generation function with wp_footer action hook */
add_action('wp_footer', 'generate_dynamic_javascript');



/*-----------------------------------------------------------------------------------*/
/*	HTML5 shim IE8 support of HTML5 elements
/*-----------------------------------------------------------------------------------*/
if (!function_exists('add_ie_html5_shim')) {
    function add_ie_html5_shim()
    {
        echo '<!--[if lt IE 9]>';
        echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
        echo '<script src="' . get_template_directory_uri() . '/js/respond.min.js"></script>';
        echo '<![endif]-->';
    }
}
add_action('wp_head', 'add_ie_html5_shim');


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
if (!isset($content_width)) $content_width = 1170;


/*-----------------------------------------------------------------------------------*/
/*	Add Class Next Post Link
/*-----------------------------------------------------------------------------------*/
if (!function_exists('add_class_next_post_link')) {
    function add_class_next_post_link($html)
    {
        $html = str_replace('<a', '<a class="next fa fa-chevron-right"', $html);
        return $html;
    }
}
add_filter('next_post_link', 'add_class_next_post_link', 10, 1);


if (!function_exists('add_class_previous_post_link')) {
    function add_class_previous_post_link($html)
    {
        $html = str_replace('<a', '<a class="prev fa fa-chevron-left"', $html);
        return $html;
    }
}
add_filter('previous_post_link', 'add_class_previous_post_link', 10, 1);


/*-----------------------------------------------------------------------------------*/
/*	Function to output different bootstrap classes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('get_bc')) {
    function get_bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
    {
        $bootstrap_classes = "";
        if (!empty($col_lg)) {
            $bootstrap_classes .= "col-lg-$col_lg ";
        }
        if (!empty($col_md)) {
            $bootstrap_classes .= "col-md-$col_md ";
        }
        if (!empty($col_sm)) {
            $bootstrap_classes .= "col-sm-$col_sm ";
        }
        if (!empty($col_xs)) {
            $bootstrap_classes .= "col-xs-$col_xs ";
        }
        return $bootstrap_classes;
    }
}

if (!function_exists('bc')) {
    function bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
    {
        echo get_bc($col_lg, $col_md, $col_sm, $col_xs);
    }
}

if (!function_exists('get_bc_all')) {
    function get_bc_all($column)
    {
        return "col-lg-$column col-md-$column col-sm-$column";
    }
}

if (!function_exists('bc_all')) {
    function bc_all($column)
    {
        echo get_bc_all($column);
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Some Helper Functions
/*-----------------------------------------------------------------------------------*/
if (!function_exists('nothing_found')) {
    function nothing_found($message) {
        ?>
        <div class="<?php bc_all('12'); ?>">
            <p class="nothing-found"><?php echo $message; ?></p>
        </div>
        <?php
    }
}

/*-----------------------------------------------------------------------------------*/
//	Generate Quick CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'generate_quick_css' ) ) {
    function generate_quick_css() {
        global $theme_options;
        if ( isset ( $theme_options['quick_css'] ) ) {
            if ( !empty( $theme_options['quick_css'] ) ) {
                $quick_css = stripslashes( $theme_options['quick_css'] );
                if ( !empty( $quick_css ) ) {
                    echo "\n<style type='text/css' id='quick-css'>\n";
                    echo $quick_css . "\n";
                    echo "</style>". "\n\n";
                }
            }
        }
    }
    add_action('wp_head', 'generate_quick_css');
}



/*-----------------------------------------------------------------------------------*/
//	Generate Quick JavaScript
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'generate_quick_js' ) ){
    function generate_quick_js(){
        global $theme_options;
        if ( isset ( $theme_options['quick_css'] ) ) {
            if( $theme_options['quick_js'] ) {
                $quick_js = stripslashes( $theme_options['quick_js'] );
                if ( !empty( $quick_js ) ) {
                    echo "\n<script type='text/javascript' id='quick-js'>\n";
                    echo $quick_js . "\n";
                    echo "</script>". "\n\n";
                }
            }
        }
    }
}
add_action('wp_footer', 'generate_quick_js');


/*-----------------------------------------------------------------------------------*/
//	Creates a nicely formatted and more specific title
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_wp_title' ) ){
    function inspiry_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name', 'display' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'framework' ), max( $paged, $page ) );

        return $title;
    }
}
// add_filter( 'wp_title', 'inspiry_wp_title', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/*	Sticky Header Class
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('inspiry_sticky_header') ) {
    function inspiry_sticky_header($classes){
        global $theme_options;
        if( $theme_options['sticky_header'] ){
            $classes[] = 'sticky-header';
        }
        return $classes;
    }
}
add_filter('body_class', 'inspiry_sticky_header');


/*-----------------------------------------------------------------------------------*/
/*	Output reCAPTCHA related JavaScript
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'output_recaptcha_js' ) ){
    function output_recaptcha_js(){
        global $theme_options;

            $reCAPTCHA_public_key = $theme_options['recaptcha_public_key'];
            $reCAPTCHA_private_key = $theme_options['recaptcha_private_key'];

            if ( !empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) ) {
                ?>
                <script type="text/javascript">
                    var RecaptchaOptions = {
                        theme: 'custom',
                        custom_theme_widget: 'recaptcha_widget'
                    };
                </script>
                <?php

            }
    }
}
if( !function_exists( 'enqueue_recaptcha_js' ) ){
    function enqueue_recaptcha_js(){
        global $theme_options;
        if( is_page_template('contact-template.php') &&  $theme_options['display_contact_recaptcha'] ) {
            output_recaptcha_js();
        } else if( ( is_page_template('home-template.php') || is_page_template('demo-home-two-template.php') || is_page_template('demo-home-three-template.php') || is_page_template('demo-home-four-template.php') || is_page_template('demo-home-template-five.php') ) &&  $theme_options['display_appointment_recaptcha'] ) {
            output_recaptcha_js();
        } else if( is_page_template('make-appointment-template.php') &&  $theme_options['display_appointment_recaptcha'] ){
            output_recaptcha_js();
        }
    }
}
add_action('wp_head','enqueue_recaptcha_js');


/*-----------------------------------------------------------------------------------*/
/*	Inspiry Themes and Medical Press Class in body
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_body_classes' ) ){
    function inspiry_body_classes( $classes ) {
        $classes[] = 'inspiry-themes';
        $classes[] = 'inspiry-medicalpress-theme';
        return $classes;
    }
    add_filter( 'body_class', 'inspiry_body_classes' );
}
?>