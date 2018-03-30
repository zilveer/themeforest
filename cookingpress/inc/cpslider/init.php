<?php
/*
Plugin Name: cpSlider
Plugin URI: http://www.purethemes.net/
Description: WYSIWYG fullscreen cpgraphy slider!
Version: 1.0
Author: purethemes.net
*/

/**
*
*/
require "inc/class.slide.php";
require "inc/class.sliders.php";

class CP_Slider
{

    function __construct()
    {

      //  add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
        add_action( 'admin_menu', array( $this, 'add_menus' ) );
        if(is_admin()) {

            add_action( 'wp_ajax_get_cpslide_thumb', array($this, 'ajax_get_cpslide_thumb') );
        }
    }

    public function register_plugin_styles() {
        wp_register_style( 'cpslider-css', get_template_directory_uri().'/inc/cpslider/css/cpslider.css' );
        wp_enqueue_style( 'cpslider-css' );
    }

    public function register_plugin_scripts() {

        wp_register_script( 'cpslider-js',  get_template_directory_uri().'/inc/cpslider/js/cpslider.js' );
        wp_enqueue_script( 'cpslider-js' );
        if ( is_home() || is_page() ) {
            if(ot_get_option('pp_slider_on') == 'on') {
                $slider = ot_get_option('pp_slider_select');
                if(is_page()) {
                    global $post;
                     $slider = get_post_meta($post->ID, 'pp_page_slider', true);
                }
                $sliderarray = get_option( 'cp_slider_'.$slider );
                
                if($sliderarray['arrowsNav'] == "true") { $arrows = true; }  else { $arrows = false; }
                if($sliderarray['fadeinLoadedSlide'] == "true") { $fadeinLoadedSlide = true; }  else { $fadeinLoadedSlide = false; }
                if($sliderarray['keyboardNavEnabled'] == "true") { $keyboardNavEnabled = true; }  else { $keyboardNavEnabled = false; }
                if(isset($sliderarray['delay'])) {
                    $delay= $sliderarray['delay'];
                } else {
                        $delay = 3000;
                }
                wp_localize_script('cpslider-js', 'cpslidervars', array(
                            'arrowsNav' => $arrows,
                            'fadeinLoadedSlide' => $fadeinLoadedSlide,
                            'keyboardNavEnabled' => $keyboardNavEnabled,
                            'imageScaleMode' => $sliderarray['imageScaleMode'],
                            'slidesOrientation' => $sliderarray['slidesOrientation'],
                            'transitionType' => $sliderarray['transitionType'],
                            'transitionSpeed' => $sliderarray['transitionSpeed'],
                            'delay' => $delay,
                        )
                    );
            }
        }
    }

    public function add_menus() {

        if ( array_key_exists( 'page', $_GET ) && 'cp-slider' == $_GET['page'] )  {

            wp_register_style( 'cpslider-admin-css', get_template_directory_uri() . '/inc/cpslider/css/cpslider.admin.css' );
            wp_enqueue_style( 'cpslider-admin-css' );


            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'wp-ajax-response' );

            wp_enqueue_media();
            wp_enqueue_script( 'postbox' );

            wp_enqueue_script( 'jquery-ui-draggable' );
            wp_enqueue_script( 'jquery-ui-droppable' );
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_enqueue_script('jquery-ui-dialog');
            wp_enqueue_style("wp-jquery-ui-dialog");

            wp_register_script(
                'cp-slider-js',                                         /* handle */
                get_template_directory_uri().'/inc/cpslider/js/cpslider.admin.js',   /* src */
                array(
                    'jquery', 'jquery-ui-draggable', 'jquery-ui-droppable',
                    'jquery-ui-sortable'
                    ),                                                          /* deps */
                date("YmdHis", @filemtime(  get_template_directory_uri().'/inc/cpslider/js/cpslider.admin.js'  ) ),            /* ver */
                true                                                        /* in_footer */
                );
            wp_enqueue_script( 'cp-slider-js' );
            wp_localize_script( 'cp-slider-js', 'CPVars', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'getthumb' => wp_create_nonce( 'cp_getthumb_ajax_nonce' ),
                ));
        }

        /* Top-level menu page */
        add_menu_page(

            __( 'CookingPress Slider', 'purepress' ),                                 /* title of options page */
            __( 'CP Slider', 'purepress' ),                                 /* title of options menu item */
            'edit_theme_options',                               /* permissions level */
            'cp-slider',                                                 /* menu slug */
            array( $this, 'print_slide_groups_page' ),             /* callback to print the page to output */
            'dashicons-slides',    /* icon file */
            null                                                            /* menu position number */
            );

        /* First child, 'Slide Groups' */


    }

    /***********    // !Print functions for each page  ***********/

    public static function print_slide_groups_page() {

        require( dirname( __FILE__ ) . '/inc/admin.sliders.php' );

    }

    public static function print_slides_page() {

        require( dirname( __FILE__ ) . '/inc/admin.slides.php' );

    }

    function ajax_get_cpslide_thumb() {
        //check_ajax_referer('custom_nonce');
        if(isset($_POST['thumbid'])) {
            $image = wp_get_attachment_image_src( $_POST['thumbid'] );
            echo $image[0];
        }
        die();
    }
    function get_cpslide_thumb($id) {
        //check_ajax_referer('custom_nonce');
        $image = wp_get_attachment_image_src( $id );
        return $image[0];
    }

    public function getCPslider($name) {
        $slider = get_option( 'cp_slider_'.$name );
       
        if(!empty($slider)) {
            switch ($slider['slidertype']) {
                case 'postssel':
                    $args= array(
                        'post__in' => $slider['posts'],
                        'meta_key'    => '_thumbnail_id',
                        'post__not_in' => get_option( 'sticky_posts' ),
                        'orderby' => 'post__in'
                        );
                break;

                case 'posts':
                    if($slider['posts_type'] == 'random') {
                        $orderby = 'rand';
                    } else {
                        $orderby = $slider['posts_order'];
                    }

                    $args= array(
                        'posts_per_page'   => $slider['posts_number'],
                        'orderby' => $orderby,
                        'meta_key'    => '_thumbnail_id',
                        'post__not_in' => get_option( 'sticky_posts' ),
                        'category__in' => $slider['cats'],
                        'tag__and' => $slider['tags']
                        );

                break;

                default:
                # code...
                break;
            }

            ?>
    <div class="row" id="mainslider">
                <section id="video-gallery" class="royalSlider videoGallery rsDefault">

                    <?php
                    $cpslider_query = new WP_Query($args);
                    while ($cpslider_query->have_posts()) : $cpslider_query->the_post();
                    $thumb = wp_get_attachment_image_src ( get_post_thumbnail_id (), 'slider-big' );
                    ?>
                    <div class="rsContent">
                        <img class="rsImg" src="<?php echo $thumb[0]; ?>" alt="image description" />
                        <figure class="rsCaption">
                            <h2 >
                                <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a>
                            </h2>
                            <p>
                                <?php printf(__('<span>In</span> %2$s', 'cookingpress'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list(', ')); ?>
                            </p>
                        </figure>
                        <div class="rsTmb">
                            <?php
                            $first_img = wp_get_attachment_image_src ( get_post_thumbnail_id (  ), 'slider-thumb');
                            echo '<img src="' . $first_img[0] . '" width="' . $first_img[1] . '" height="' . $first_img[2] . '"/>';
                            ?>
                            <?php the_title(); ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_query();?>
            </section>
        </div>

           

        <?php
        }
    }
}
?>