<?php

/*
 * Frontend theme scripts
 */
if(!function_exists('a13_theme_scripts')){
    function a13_theme_scripts($special_pass = false){
        global $apollo13;

        if((is_admin() || 'wp-login.php' == basename($_SERVER['PHP_SELF'])) && !$special_pass){
            return;
        }

	    //Modernizr custom build
	    wp_enqueue_script( 'a13-modernizr-custom', A13_TPL_JS . '/modernizr.min.js', false, '2.7.1', false);

        /* We add some JavaScript to pages with the comment form
          * to support sites with threaded comments (when in use).
          */
        if ( is_singular() && get_option( 'thread_comments' ) ){
            wp_enqueue_script( 'comment-reply' );
        }

        $script_depends = array( 'apollo13-plugins' );

        //plugins used in theme (cheat sheet)
        wp_register_script('apollo13-plugins', A13_TPL_JS . '/plugins.js',
            array('jquery'), //depends
            A13_THEME_VER, //version number
            true //in footer
        );


        //APOLLO Slider
        wp_register_script( 'a13-slider', A13_TPL_JS . '/a13-slider.js', array('jquery'), A13_THEME_VER, true);

        //masonry
        wp_register_script( 'a13-masonry', A13_TPL_JS . '/a13.masonry-with-resize-plugin.min.js', array('jquery'), '2.5', true);

        //counter - for counter shortcode
        wp_register_script( 'jquery.countTo', A13_TPL_JS . '/jquery.countTo.js', array('jquery'), '1.0', true);

	    //Jackbox lightbox
	    wp_register_script( 'jackbox', A13_TPL_JS . '/jackbox/js/jackbox-packed.min.js', array('jquery'), A13_THEME_VER, true);

	    //magnific Popup lightbox
	    wp_register_script( 'magnific-popup', A13_TPL_JS . '/magnific-popup.min.js', array('jquery'), '0.9.9', true);


        $is_gallery         = defined('A13_GALLERY_PAGE');
        $is_work            = defined('A13_WORK_PAGE');
        $is_works_list      = defined('A13_WORKS_LIST_PAGE');
        $is_gallery_list    = defined('A13_GALLERIES_LIST_PAGE');

        //add masonry if needed
        if(
            (a13_is_post_list() && $apollo13->get_option('blog', 'blog_variant') === 'variant_masonry')
        ||  ($is_gallery && $apollo13->get_meta('_theme') == 'bricks')
        ||  ($is_works_list)
        ||  ($is_gallery_list)
        ){
            array_push($script_depends, 'a13-masonry');
        }

        if(
            ($is_gallery && $apollo13->get_meta('_theme') == 'slider')
        ||  ($is_work && $apollo13->get_meta('_theme') == 'slider')

        ){
            array_push($script_depends, 'a13-slider');
        }

	    //lightbox
	    $lightbox = $apollo13->get_option( 'advanced', 'apollo_lightbox' );
	    //should include jackbox?
	    if($lightbox === 'on' || $lightbox === 'jackbox'){
		    array_push($script_depends, 'jackbox');
	    }
	    elseif($lightbox === 'magnific-popup'){
		    array_push($script_depends, 'magnific-popup');
	    }

        //options passed to JS
        $apollo_params = a13_js_parameters();
        //hand written scripts for theme
        wp_enqueue_script('apollo13-scripts', A13_TPL_JS . '/script.js', $script_depends, A13_THEME_VER, true );
        //transfer options
        wp_localize_script( 'apollo13-plugins', 'ApolloParams', $apollo_params );
    }
}

if(!function_exists('a13_js_parameters')){
    function a13_js_parameters(){
        global $apollo13;

        $params = array(
            /* GLOBAL OPTIONS */
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'jsurl'             => A13_TPL_JS,
            'defimgurl'         => A13_TPL_GFX . '/holders/photo.jpg',
            'validation_class'  => A13_VALIDATION_CLASS,
            'load_more'         => __( 'Load more', 'fame' ),
            'hd_logo'           => $apollo13->get_option( 'appearance', 'logo_image_high_dpi' ),
            'hd_logo_size'      => $apollo13->get_option( 'appearance', 'logo_image_high_dpi_sizes' ),
            'msg_cookie_string' => $apollo13->get_option( 'appearance', 'top_bar_new_message' )
        );

        $is_works_list      = defined('A13_WORKS_LIST_PAGE');
        $is_gallery_list    = defined('A13_GALLERIES_LIST_PAGE');

        if(defined('A13_WORK_PAGE') ){
            if($apollo13->get_meta('_theme') == 'slider'){
                $params['fit_variant']          = $apollo13->get_meta( '_fit_variant' );
                $params['autoplay']             = $apollo13->get_meta( '_autoplay' );
                $params['transition']           = $apollo13->get_meta( '_transition' );
                $params['transition_speed']     = $apollo13->get_option( 'cpt_work', 'transition_time' );
                $params['slide_interval']       = $apollo13->get_option( 'cpt_work', 'slide_interval' );
            }
        }
        elseif( $is_works_list || $is_gallery_list ){
            if($is_works_list){
                $variant = $apollo13->get_option('cpt_work', 'works_size');
            }
            else{
                $variant = $apollo13->get_option('cpt_gallery', 'galleries_size');
            }
            if($is_works_list && $variant === 'fluid'){
                $params['brick_height']         = $apollo13->get_option( 'cpt_work', 'brick_height' );
                $params['brick_width']          = $apollo13->get_option( 'cpt_work', 'brick_width' );
                $params['brick_margin']         = $apollo13->get_option( 'cpt_work', 'brick_margin' );
            }
            elseif($is_gallery_list && $variant === 'fluid'){
                $params['brick_width']          = $apollo13->get_option( 'cpt_gallery', 'gl_brick_width' );
                $params['brick_height']         = $apollo13->get_option( 'cpt_gallery', 'gl_brick_height' );
                $params['brick_margin']         = $apollo13->get_option( 'cpt_gallery', 'gl_brick_margin' );
            }
            elseif($variant === 'big'){
                $params['brick_width']          = 525;
                $params['brick_margin']         = 26;
            }
            elseif($variant === 'medium'){
                $params['brick_width']          = 340;
                $params['brick_margin']         = 26;
            }
            elseif($variant === 'small'){
                $params['brick_width']          = 250;
                $params['brick_margin']         = 26;
            }
        }
        elseif( defined('A13_GALLERY_PAGE') ){
            if($apollo13->get_meta('_theme') == 'slider'){
                $params['fit_variant']          = $apollo13->get_meta( '_fit_variant' );
                $params['autoplay']             = $apollo13->get_meta( '_autoplay' );
                $params['transition']           = $apollo13->get_meta( '_transition' );
                $params['transition_speed']     = $apollo13->get_option( 'cpt_gallery', 'transition_time' );
                $params['slide_interval']       = $apollo13->get_option( 'cpt_gallery', 'slide_interval' );
            }
            elseif($apollo13->get_meta('_theme') == 'bricks'){
                $params['brick_width']          = $apollo13->get_option( 'cpt_gallery', 'brick_width' );
                $params['brick_height']         = $apollo13->get_option( 'cpt_gallery', 'brick_height' );
                $params['brick_margin']         = $apollo13->get_option( 'cpt_gallery', 'brick_margin' );
            }
        }
        //blog or archive
        elseif(a13_is_post_list()){
            $params['brick_width']          = $apollo13->get_option( 'blog', 'brick_width' );
            $params['brick_margin']         = $apollo13->get_option( 'blog', 'brick_margin' );
            $params['per_page']             = get_option( 'posts_per_page' );
        }

        //options transferred to js files
        return $params;
    }
}

/*
 * Adds CSS files to theme
 */
if(!function_exists('a13_theme_styles')){
    function a13_theme_styles($special_pass = false){
        if((is_admin() || 'wp-login.php' == basename($_SERVER['PHP_SELF'])) && !$special_pass){
            return;
        }

        global $apollo13;

        $user_css_depends = array();

        //builder activated? push it as first style
        if(function_exists('vc_set_as_theme')){
            array_push($user_css_depends,'js_composer_front');
        }

        //main style next
        array_push($user_css_depends,'main-style');


        //woocommerce
        if(a13_is_woocommerce_activated()){
            array_push($user_css_depends,'a13-woocommerce');
            wp_register_style( 'a13-woocommerce', A13_TPL_CSS . '/woocommerce.css', array('main-style'), A13_THEME_VER);
        }

	    wp_register_style( 'a13-font-awesome', A13_TPL_CSS.'/font-awesome.min.css', false, '4.4.0');
        wp_register_style( 'main-style', A13_TPL_URI . '/style.css', array('a13-font-awesome'), A13_THEME_VER);

	    //Jackbox lightbox
	    wp_register_style('jackbox', A13_TPL_JS . '/jackbox/css/jackbox.min.css', false, A13_THEME_VER);
	    //magnific Popup lightbox
	    wp_register_style('magnific-popup', A13_TPL_CSS . '/magnific-popup.css', false, '0.9.9');

	    //lightbox
	    $lightbox = $apollo13->get_option( 'advanced', 'apollo_lightbox' );
	    //should include jackbox?
	    if($lightbox === 'on' || $lightbox === 'jackbox'){
		    wp_enqueue_style('jackbox');
	    }
	    elseif($lightbox === 'magnific-popup'){
		    wp_enqueue_style('magnific-popup');
	    }

        wp_register_style('user-css', $apollo13->user_css_name(true), $user_css_depends, A13_THEME_VER);
        wp_enqueue_style('user-css');
    }
}

/*
 * adds google analytics code and google fonts (cause JSON is not easily passed by wp_localize_script
 */
if(!function_exists('a13_theme_head')){
    function  a13_theme_head(){
        if(is_admin() || 'wp-login.php' == basename($_SERVER['PHP_SELF'])){
            return;
        }

        global $apollo13;

        //WEB FONTS LOADING
        $fonts = array( 'families' => array());
        //check if classic or google font is selected
        //colon in name = google font
        $temp = $apollo13->get_option('fonts', 'normal_fonts');
        (strpos($temp, ':') !== false)? array_push($fonts['families'], $temp) : false;
        $temp = $apollo13->get_option('fonts', 'titles_fonts');
        (strpos($temp, ':') !== false)? array_push($fonts['families'], $temp) : false;
        $temp = $apollo13->get_option('fonts', 'nav_menu_fonts');
        (strpos($temp, ':') !== false)? array_push($fonts['families'], $temp) : false;

        if(sizeof($fonts['families'])):
            $fonts = json_encode($fonts);
    ?>

    <script type="text/javascript">
        // <![CDATA[
        WebFontConfig = {
            google: <?php echo $fonts; ?>,
            active: function() {
                //tell listeners that fonts are loaded
				if (window.jQuery){
                	jQuery(document.body).trigger('webfontsloaded');
				}
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = '<?php echo A13_TPL_JS; ?>/webfontloader.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
	    // ]]>
    </script>

    <?php
        endif;

        //Google Analytics Tracking Code
        echo $apollo13->get_option( 'settings', 'ga_code' );
    }
}

add_action( 'wp_enqueue_scripts', 'a13_theme_scripts', 26 ); //put it later then woocommerce
add_action( 'wp_enqueue_scripts', 'a13_theme_styles', 26 ); //put it later then woocommerce
