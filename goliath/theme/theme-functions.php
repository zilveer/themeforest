<?php
add_action( 'after_setup_theme', 'plsh_setup' );
add_action( 'wp_enqueue_scripts', 'plsh_add_stylesheets' );
add_action( 'wp_enqueue_scripts', 'plsh_add_scripts' );
add_action( 'wp_default_scripts', 'plsh_print_scripts_in_footer' );
add_action( 'parse_query', 'wpse_71157_parse_query' );  //fix wp bug
add_action( 'widgets_init', 'plsh_add_widgets');

add_filter( 'wp_title', 'plsh_wp_title_for_home', 10, 2 );
add_filter( 'excerpt_length', 'plsh_custom_excerpt_length', 999 );
add_filter( 'excerpt_more', 'plsh_custom_excerpt_more', 999 );
add_filter( 'the_title','wp_kses_post' );
//add_filter( 'the_content','wp_kses_post' );
add_filter( 'comment_text','wp_kses_post' );
add_filter( 'comment_author_url','wp_kses_post' );

add_action( 'customize_register', 'plsh_customize_register' );
add_action( 'wp_head', 'plsh_header_output');

add_action( 'show_user_profile', 'plsh_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'plsh_extra_user_profile_fields' );
add_action( 'personal_options_update', 'plsh_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'plsh_save_extra_user_profile_fields' );

add_action( 'add_meta_boxes', 'plsh_post_meta_boxes' );
add_action( 'save_post', 'plsh_post_save_postdata' );

add_action( 'wp_ajax_mosaic', 'plsh_mosaic_callback' );
add_action( 'wp_ajax_nopriv_mosaic', 'plsh_mosaic_callback' );

add_action( 'wp_ajax_sharrre', 'plsh_sharrre_callback' );
add_action( 'wp_ajax_nopriv_sharrre', 'plsh_sharrre_callback' );

add_action( 'init', 'plsh_add_gallery_post_type' );
add_action( 'admin_head', 'plsh_add_menu_icons_styles' );

add_filter( 'img_caption_shortcode', 'plsh_fix_image_margins', 10, 3);
add_filter( 'constellation_sidebar_args', 'plsh_setup_constellation_sidebar');

add_action( 'tgmpa_register', 'plsh_register_required_plugins' );
add_action( 'wp_head', 'plsh_output_theme_version' );

add_filter( 'woocommerce_output_related_products_args', 'plsh_related_products_args' );
add_filter( 'widget_title', 'plsh_widget_title_force');

/* SETUP */

if(!function_exists('plsh_setup'))
{
    function plsh_setup() 
    {
        /* Make theme available for translation.
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain( PLSH_THEME_DOMAIN, get_template_directory() . '/languages' );
		if(is_child_theme())
		{
			load_child_theme_textdomain( PLSH_THEME_DOMAIN, get_stylesheet_directory() . '/languages' );
		}
		
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();
        add_theme_support( 'woocommerce' );
        add_theme_support( 'automatic-feed-links' );
        add_post_type_support( 'page', 'excerpt' );
        add_theme_support( 'post-thumbnails' );
        
        register_nav_menu( 'primary-menu', __( 'Primary Menu', 'goliath' ) );
        register_nav_menu( 'footer-menu', __( 'Footer Menu', 'goliath' ) );

        plsh_add_image_sizes();
        
        if(!plsh_is_woocommerce_active())
        {
            plsh_remove_woocommerce_settings();
        }

        $sidebars = plsh_gs('sidebars');
        if(!empty($sidebars))
        {
            foreach($sidebars as $sidebar)
            {
                register_sidebar( $sidebar );
            }
        }

        include_once('vc_content_blocks.php');
        include_once('shortcodes.php');
		
		//VC content blocks
		add_shortcode( 'mosaic', 'sc_mosaic' );
		add_shortcode( 'slider', 'sc_slider' );
		add_shortcode( 'post_list_1', 'sc_post_list_1' );
		add_shortcode( 'post_list_2', 'sc_post_list_2' );
		add_shortcode( 'post_list_3', 'sc_post_list_3' );
		add_shortcode( 'banner150', 'sc_banner_four150' );
		add_shortcode( 'banner300', 'sc_banner300' );
		add_shortcode( 'banner468', 'sc_banner468' );
		add_shortcode( 'banner728', 'sc_banner728' );
		add_shortcode( 'latest_galleries', 'sc_latest_galleries' );
		add_shortcode( 'review_summary', 'sc_review_summary' );
		add_shortcode( 'rating', 'sc_review_summary_rating');
		add_shortcode( 'gallery_post_embed', 'sc_gallery_post_embed');
		add_shortcode( 'text_block_nav', 'sc_text_block_nav');
		
		//Shortcodes
		add_shortcode( 'button', 'sc_button' );
		add_shortcode( 'list', 'sc_list' );
		add_shortcode( 'list_item', 'sc_list_item' );
		add_shortcode( 'info_box', 'sc_info_box' );

    }
}


/* ASSETS */

if(!function_exists('plsh_add_stylesheets'))
{
    function plsh_add_stylesheets() 
    {
        wp_enqueue_style( 'plsh-bootstrap', PLSH_CSS_URL . 'bootstrap.min.css' );
        wp_enqueue_style( 'plsh-font-awesome', PLSH_CSS_URL . 'font-awesome.min.css' );
        
        wp_enqueue_style( 'plsh-main', PLSH_CSS_URL . 'main.css' );
        wp_enqueue_style( 'plsh-tablet', PLSH_CSS_URL . 'tablet.css' );
        wp_enqueue_style( 'plsh-phone', PLSH_CSS_URL . 'phone.css' );
        wp_enqueue_style( 'plsh-woocommerce', PLSH_CSS_URL . 'woocommerce.css' );
        wp_enqueue_style( 'plsh-bbpress', PLSH_CSS_URL . 'bbpress.css' );
        wp_enqueue_style( 'plsh-wordpress_style', PLSH_CSS_URL . 'wordpress.css' );
        wp_enqueue_style( 'plsh-sharrre', PLSH_CSS_URL . 'sharrre.css' );
        wp_enqueue_style( 'plsh-style', get_bloginfo( 'stylesheet_url' ) );   
		wp_enqueue_style( 'plsh-google-fonts', plsh_google_fonts_url(), array(), null );
    }
}
    
if(!function_exists('plsh_print_scripts_in_footer'))
{
    function plsh_print_scripts_in_footer( &$scripts) 
    {
        if ( ! is_admin() )
        {
            $scripts->add_data( 'comment-reply', 'group', 1 );
        }
    }
}

if(!function_exists('plsh_add_scripts'))
{
    function plsh_add_scripts() 
    {
        //wp_enqueue_script( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false )
        wp_enqueue_script( 'jquery');
        wp_enqueue_script( 'jquery-ui-core');
        wp_enqueue_script( 'jquery-effects-slide');
        wp_enqueue_script( 'jquery-effects-size');
        wp_enqueue_script( 'plsh-modernizr', PLSH_JS_URL . 'vendor/modernizr-2.6.2-respond-1.1.0.min.js');
        wp_enqueue_script( 'plsh-bootstrap', PLSH_JS_URL . 'vendor/bootstrap.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-bootstrap-hover-dropdown', PLSH_JS_URL . 'vendor/bootstrap-hover-dropdown.js', array( 'jquery', 'plsh-bootstrap' ), false, true);
        wp_enqueue_script( 'plsh-cycle2', PLSH_JS_URL . 'vendor/jquery.cycle2.min.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-scroll-vertical', PLSH_JS_URL . 'vendor/jquery.cycle2.scrollVert.js', array( 'jquery', 'plsh-cycle2' ), false, true);
        wp_enqueue_script( 'plsh-cycle2-swipe', PLSH_JS_URL . 'vendor/jquery.cycle2.swipe.min.js', array( 'jquery', 'plsh-cycle2' ), false, true);
        wp_enqueue_script( 'plsh-inview', PLSH_JS_URL . 'vendor/jquery.inview.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-hoverintent', PLSH_JS_URL . 'vendor/jquery.hoverintent.min.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-sharrre', PLSH_JS_URL . 'vendor/jquery.sharrre.min.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-particles', PLSH_JS_URL . 'vendor/jquery.particleground.js', array( 'jquery' ), false, true);
        wp_enqueue_script( 'plsh-theme', PLSH_JS_URL . 'theme.js', array( 'jquery', 'plsh-sharrre' ), false, true);
        
        $ajax_object = array();
        $ajax_object['ajaxurl'] = admin_url( 'admin-ajax.php' );
        $ajax_object['readmore'] = __('Read more', 'goliath');
        $ajax_object['article'] = __('Article', 'goliath');
        $ajax_object['show_post_quick_view'] = plsh_gs('show_post_quick_view');
        $ajax_object['show_mosaic_overlay'] = plsh_gs('show_mosaic_overlay');
        $ajax_object['enable_sidebar_affix'] = plsh_gs('enable_sidebar_affix');
        
        if(function_exists('icl_get_languages'))
        {
            $ajax_object['lang'] = ICL_LANGUAGE_CODE;
        }

        $ajax_object['particle_color'] = get_theme_mod('particle_color', plsh_gs('particle_color'));
        
        wp_localize_script( 'plsh-theme', 'ajax_object', $ajax_object );
    }
}

if(!function_exists('plsh_extra_user_profile_fields'))
{
    function plsh_extra_user_profile_fields($user)
    {
        ?>
            <h3><?php _e('Additional user information', 'goliath'); ?></h3>

            <table class="form-table">

                <tr>
                    <th><label for="position"><?php _e('Position', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="position" id="position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Users position in this magazine. For example "Editor in chief" or "Food critic"', 'goliath'); ?></span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="twitter"><?php _e('Twitter account', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Twitter account URL', 'goliath'); ?></span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="facebook"><?php _e('Facebook account', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Facebook account URL', 'goliath'); ?></span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="youtube"><?php _e('Youtube account', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Youtube account URL', 'goliath'); ?></span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="gplus"><?php _e('Google+ account', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Google+ account URL', 'goliath'); ?></span>
                    </td>
                </tr>
                
                <tr>
                    <th><label for="pinterest"><?php _e('Pinterest account', 'goliath'); ?></label></th>
                    <td>
                        <input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php _e('Pinterest account URL', 'goliath'); ?></span>
                    </td>
                </tr>

            </table>
        <?php
    }
}

if(!function_exists('plsh_save_extra_user_profile_fields'))
{
    function plsh_save_extra_user_profile_fields( $user_id ) {

        if ( !current_user_can( 'edit_user', $user_id ) )
        {
            return false;
        }

        update_user_meta( $user_id, 'position', $_POST['position'] );
        update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
        update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
        update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
        update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
        update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
    }
}

if(!function_exists('plsh_remove_woocommerce_settings'))
{
    function plsh_remove_woocommerce_settings()
    {
        global $_SETTINGS;
        if(!empty($_SETTINGS->admin_head['general']['children']['shop']))
        {
            unset($_SETTINGS->admin_head['general']['children']['shop']);
        }
        if(!empty($_SETTINGS->active['page_types']['shop']))
        {
            unset($_SETTINGS->active['page_types']['shop']);
        }
        if(!empty($_SETTINGS->active['page_types']['product']))
        {
            unset($_SETTINGS->active['page_types']['product']);
        }
    }
}

    
/* FILTERS */

if(!function_exists('plsh_custom_excerpt_length'))
{
    function plsh_custom_excerpt_length( $length ) 
    {
        return 50;
    }
}

if(!function_exists('plsh_custom_excerpt_more'))
{
    function plsh_custom_excerpt_more( $more )
    {
        return '...';
    }
}

if(!function_exists('wpse_71157_parse_query'))
{
    function wpse_71157_parse_query( $wp_query )
    {
        if ( $wp_query->is_post_type_archive && $wp_query->is_tax )
        {
            $wp_query->is_post_type_archive = false;
        }
    }
}

/* OTHER FUNCTIONS */

if(!function_exists('plsh_add_widgets'))
{
    function plsh_add_widgets()
    {
        require_once( PLSH_WIDGET_PATH . 'goliath-dropdown-large-featured.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-dropdown-category-posts.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-dropdown-tag-posts.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-dropdown-post-list.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-banner-large.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-banner-four-items.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-post-tabs.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-recent-posts.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-archive.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-tag-cloud.php');
        require_once( PLSH_WIDGET_PATH . 'goliath-category-cloud.php');
       
        register_widget( 'GoliathDropdownLargeFeatured' );
        register_widget( 'GoliathDropdownCategoryPosts' );
        register_widget( 'GoliathDropdownTagPosts' );
        register_widget( 'GoliathDropdownPostList' );
        register_widget( 'GoliathBannerLarge' );
        register_widget( 'GoliathBannerFourItems' );
        register_widget( 'GoliathPostTabs' );
        register_widget( 'GoliathRecentPosts' );
        register_widget( 'GoliathArchive' );
        register_widget( 'GoliathTagCloud' );
        register_widget( 'GoliathCategoryCloud' );
        
    }
}


//post style
if(!function_exists('plsh_post_meta_boxes'))
{
    function plsh_post_meta_boxes() 
    {
        add_meta_box(
            'post_settings',
            __('Post settings', 'goliath'),
            'plsh_post_inner_meta_box',
            'post'
        );
        
        add_meta_box(
            'page_settings',
            __('Page settings', 'goliath'),
            'plsh_page_inner_meta_box',
            'page'
        );
    }
}

if(!function_exists('plsh_post_inner_meta_box'))
{
    function plsh_post_inner_meta_box( $post ) 
    {
        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'page_noncename' );

        $is_featured = get_post_meta( $post->ID, $key = 'is_featured', $single = true );
        echo '<p>';
        echo '<input type="checkbox" id="is_featured" name="is_featured" ' . ($is_featured == true ? 'checked' : '')  . ' />';
        echo '<label for="is_featured">';
             _e("This post is featured", 'goliath');
        echo '</label>';
        echo '</p>';

        $show_nav = get_post_meta( $post->ID, $key = 'show_nav', $single = true );
        echo '<p>';
        echo '<input type="checkbox" id="show_nav" name="show_nav" ' . ($show_nav == true ? 'checked' : '')  . ' />';
        echo '<label for="show_nav">';
             _e("Show navigation bar", 'goliath');
        echo '</label>';
        echo '</p>';        
        
        $post_style = get_post_meta( $post->ID, $key = 'post_style', $single = true );
        echo '<p>';
        echo '<label for="post_style">';
             _e("Post style:", 'goliath');
        echo '</label><br/>';
        echo '<select id="post_style" name="post_style" value="' . esc_attr($post_style) . '"" style="min-width: 300px;">'
                . '<option value="global" ' . ($post_style == 'global' ? 'selected="selected"' : '')  . '>' . __('Global theme setting', 'goliath') . '</option>'
                . '<option value="sidebar"' . ($post_style == 'sidebar' ? 'selected="selected"' : '')  . '>' . __('With sidebar', 'goliath') . '</option>'
                . '<option value="no-sidebar"' . ($post_style == 'no-sidebar' ? 'selected="selected"' : '')  . '>' . __('Full width', 'goliath') . '</option>'
            . '</select>';
        echo '</p>';
        
		
        $rating_stars = get_post_meta( $post->ID, $key = 'rating_stars', $single = true );
        echo '<p>';
        echo '<label for="rating_stars">';
             _e("Stars (for reviews):", 'goliath');
        echo '</label><br/>';
        echo '<select id="rating_stars" name="rating_stars" value="' . esc_attr($post_style) . '"" style="min-width: 300px;">'
                . '<option value="disabled" ' . ($rating_stars == 'disabled' ? 'selected="selected"' : '')  . '>Disabled</option>'
                . '<option value="0"' . ($rating_stars == '0' ? 'selected="selected"' : '')  . '>0</option>'
                . '<option value="5"' . ($rating_stars == '5' ? 'selected="selected"' : '')  . '>0.5</option>'
                . '<option value="10"' . ($rating_stars == '10' ? 'selected="selected"' : '')  . '>1</option>'
                . '<option value="15"' . ($rating_stars == '15' ? 'selected="selected"' : '')  . '>1.5</option>'
                . '<option value="20"' . ($rating_stars == '20' ? 'selected="selected"' : '')  . '>2</option>'
                . '<option value="25"' . ($rating_stars == '25' ? 'selected="selected"' : '')  . '>2.5</option>'
                . '<option value="30"' . ($rating_stars == '30' ? 'selected="selected"' : '')  . '>3</option>'
                . '<option value="35"' . ($rating_stars == '35' ? 'selected="selected"' : '')  . '>3.5</option>'
                . '<option value="40"' . ($rating_stars == '40' ? 'selected="selected"' : '')  . '>4</option>'
                . '<option value="45"' . ($rating_stars == '45' ? 'selected="selected"' : '')  . '>4.5</option>'
                . '<option value="50"' . ($rating_stars == '50' ? 'selected="selected"' : '')  . '>5</option>'
            . '</select>';
        echo '</p>';
		
		
		$image_size = get_post_meta( $post->ID, $key = 'image_size', $single = true );
        echo '<p>';
        echo '<label for="image_size">';
             _e("Image mode:", 'goliath');
        echo '</label><br/>';
        echo '<select id="image_size" name="image_size" value="' . esc_attr($image_size) . '"" style="min-width: 300px;">'
                . '<option value="global" ' . ($image_size == 'global' ? 'selected="selected"' : '')  . '>' . __('Global theme setting', 'goliath') . '</option>'
                . '<option value="text_width"' . ($image_size == 'text_width' ? 'selected="selected"' : '')  . '>' . __('As wide as text', 'goliath') . '</option>'
                . '<option value="container_width"' . ($image_size == 'container_width' ? 'selected="selected"' : '')  . '>' . __('Site container width (requires sidebar)', 'goliath') . '</option>'
                . '<option value="full_screen"' . ($image_size == 'full_screen' ? 'selected="selected"' : '')  . '>Full screen width</option>'
                . '<option value="no_image"' . ($image_size == 'no_image' ? 'selected="selected"' : '')  . '>No image</option>'
				. '<option value="video"' . ($image_size == 'video' ? 'selected="selected"' : '')  . '>Video</option>'
				. '<option value="video_autoplay"' . ($image_size == 'video_autoplay' ? 'selected="selected"' : '')  . '>Video with autoplay</option>'
            . '</select>';
        echo '</p>';
		
		
		$video_url = get_post_meta( $post->ID, $key = 'video_url', $single = true );
		echo '<p>';
		echo '<label for="video_url">';
			_e("Video url (Optional. Used when image mode - video is set):", 'goliath');
		echo '</label><br/>';
		echo '<input type="text" id="video_url" name="video_url" value="' . $video_url . '" style="min-width: 300px;"/>';       
		echo '</p>';
    }
}

if(!function_exists('plsh_post_save_postdata'))
{
    function plsh_post_save_postdata( $post_id ) 
    {
        // Check if the current user is authorised to do this action. 
        if ( 'post' == plsh_get($_POST, 'post_type') || 'post' == plsh_get($_GET, 'post_type')) 
        {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                  return;
        } 
        else
        {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                  return;
        }

        //Nonce verfy
        if ( ! isset( $_POST['page_noncename'] ) || ! wp_verify_nonce( $_POST['page_noncename'], plugin_basename( __FILE__ ) ) )
            return;


        $post_ID = $_POST['post_ID'];
        $type = get_post_type($post_ID);
        if($type == 'post')
        {
            $post_style = trim(sanitize_text_field( $_POST['post_style'] ));
            $is_featured  = ( !empty($_POST['is_featured']) ? sanitize_text_field($_POST['is_featured']) : false);
            $show_nav  = ( !empty($_POST['show_nav']) ? sanitize_text_field($_POST['show_nav']) : false);
            $rating_stars = trim(sanitize_text_field( $_POST['rating_stars'] ));
            $image_size = trim(sanitize_text_field( $_POST['image_size'] ));
			$video_url = trim(sanitize_text_field( $_POST['video_url'] ));
            
            update_post_meta($post_ID, 'post_style', $post_style);
            update_post_meta($post_ID, 'is_featured', $is_featured);
            update_post_meta($post_ID, 'show_nav', $show_nav);
            update_post_meta($post_ID, 'rating_stars', $rating_stars);
            update_post_meta($post_ID, 'image_size', $image_size);
			update_post_meta($post_ID, 'video_url', $video_url);
        }
        else
        {
            $show_nav  = ( !empty($_POST['show_nav']) ? sanitize_text_field($_POST['show_nav']) : false);
            $show_share  = ( !empty($_POST['show_share']) ? sanitize_text_field($_POST['show_share']) : false);
            $image_size = trim(sanitize_text_field( $_POST['image_size'] ));
			$video_url = trim(sanitize_text_field( $_POST['video_url'] ));
            
            update_post_meta($post_ID, 'show_nav', $show_nav);
            update_post_meta($post_ID, 'show_share', $show_share);
            update_post_meta($post_ID, 'image_size', $image_size);
            update_post_meta($post_ID, 'video_url', $video_url);
			
            if(function_exists('set_revslider_as_theme')) 
            { 
                $page_rev_slider = trim(sanitize_text_field( $_POST['page_rev_slider'] ));
                update_post_meta($post_ID, 'page_rev_slider', $page_rev_slider);
            }
        }
        
    }
}
 

if(!function_exists('plsh_page_inner_meta_box'))
{
    function plsh_page_inner_meta_box( $post ) 
    {
        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'page_noncename' );

        $show_nav = get_post_meta( $post->ID, $key = 'show_nav', $single = true );
        echo '<p>';
        echo '<input type="checkbox" id="show_nav" name="show_nav" ' . ($show_nav == true ? 'checked' : '')  . ' />';
        echo '<label for="show_nav">';
             _e("Show navigation bar", 'goliath');
        echo '</label>';
        echo '</p>';
        
        $show_share = get_post_meta( $post->ID, $key = 'show_share', $single = true );
        echo '<p>';
        echo '<input type="checkbox" id="show_share" name="show_share" ' . ($show_share == true ? 'checked' : '')  . ' />';
        echo '<label for="show_share">';
             _e("Show share icons", 'goliath');
        echo '</label>';
        echo '</p>';
        
        $image_size = get_post_meta( $post->ID, $key = 'image_size', $single = true );
        echo '<p>';
        echo '<label for="image_size">';
             _e("Image mode:", 'goliath');
        echo '</label><br/>';
        echo '<select id="image_size" name="image_size" value="' . esc_attr($image_size) . '"" style="min-width: 300px;">'
                . '<option value="global" ' . ($image_size == 'global' ? 'selected="selected"' : '')  . '>' . __('Global theme setting', 'goliath') . '</option>'
                . '<option value="text_width"' . ($image_size == 'text_width' ? 'selected="selected"' : '')  . '>' . __('As wide as text', 'goliath') . '</option>'
                . '<option value="container_width"' . ($image_size == 'container_width' ? 'selected="selected"' : '')  . '>' . __('Site container width (requires sidebar)', 'goliath') . '</option>'
                . '<option value="full_screen"' . ($image_size == 'full_screen' ? 'selected="selected"' : '')  . '>Full screen width</option>'
                . '<option value="no_image"' . ($image_size == 'no_image' ? 'selected="selected"' : '')  . '>No image</option>'
				. '<option value="video"' . ($image_size == 'video' ? 'selected="selected"' : '')  . '>Video</option>'
				. '<option value="video_autoplay"' . ($image_size == 'video_autoplay' ? 'selected="selected"' : '')  . '>Video with autoplay</option>'
            . '</select>';
        echo '</p>';
        
		$video_url = get_post_meta( $post->ID, $key = 'video_url', $single = true );
		echo '<p>';
		echo '<label for="video_url">';
			_e("Video url (Optional. Used when image mode - video is set):", 'goliath');
		echo '</label><br/>';
		echo '<input type="text" id="video_url" name="video_url" value="' . $video_url . '" style="min-width: 300px;"/>';       
		echo '</p>';
		
        if(function_exists('set_revslider_as_theme')) 
        { 
            $page_rev_slider = get_post_meta( $post->ID, $key = 'page_rev_slider', $single = true );
            echo '<p>';
            echo '<label for="page_rev_slider">';
                _e("Full width Revolution Slider Shortcode (Optional):", 'goliath');
            echo '</label><br/>';
            echo '<input type="text" id="page_rev_slider" name="page_rev_slider" value="' . $page_rev_slider . '" style="min-width: 300px;"/>';       
            echo '</p>';        
        }
        
    }
}

if(!function_exists('get_post_image_style'))
{
    function get_post_image_width($post_id)
    {
        //get image style for this post
        $post_image_width = plsh_gs('post_image_width');
        $local_image_size = get_post_meta( $post_id, $key = 'image_size', true);
        if($local_image_size == 'text_width' || $local_image_size == 'container_width' || $local_image_size == 'full_screen' || $local_image_size == 'no_image' || $local_image_size == 'video' || $local_image_size == 'video_autoplay')
        {
            $post_image_width = $local_image_size;
        }
        return $post_image_width;
    }
}



if(!function_exists('plsh_is_review'))
{
    function plsh_is_review()
    {
        $stars = get_post_meta(get_the_ID(), 'rating_stars', true );
        if($stars !== '' && $stars !== 'disabled')
        {
            return true;
        }
        
        return false;
    }
}


if(!function_exists('plsh_get_rating_stars'))
{
    function plsh_get_rating_stars($display = 'block', $class='')
    {
        if(plsh_is_review())
        {
            $stars = get_post_meta(get_the_ID(), 'rating_stars', true );
            $original_stars = $stars;
            
            $tag = 'div';
            if($display == 'inline')
            {
                $tag = 'span';
            }

            echo '<' . $tag . ' class="' . $class . ' stars">';
            $full_stars = intval($stars/10);
            for($full = 0; $full < $full_stars; $full++)
            {
                echo '<i class="fa fa-star"></i>';
            }

            if($stars%10 > 0)
            {
                echo '<i class="fa fa-star-half-o"></i>';
                $stars = $stars + 5;
            }

            for($empty = 50-$stars; $empty > 0; $empty-=10)
            {
                echo '<i class="fa fa-star-o"></i>';
            }
            ?>
            
            <?php if(is_single(get_the_ID())) : ?>
            <span itemprop="rating" class="item-rating-hidden"><?php echo round($original_stars/10, 1); ?></span>
            <?php endif; ?>

            <?php          
            echo '</' . $tag . '>';
        }
    }
}

if(!function_exists('plsh_get_featured_posts'))
{
    function plsh_get_featured_posts()
    {
        $posts = array();
        $title = __('Featured', 'goliath');
        $url = '#';
        
        if(plsh_is_blog())
        {
            $type = plsh_gs('blog_index_featured_type');
            if($type == 'category')
            {
                $category = plsh_gs('blog_index_featured_category');
                if(intval($category) > 0)
                {
                    $params = array(
                        'cat' => $category
                    );
                    $posts = plsh_get_post_collection($params, 3);
                    
                    $catObj = get_category($category);
                    $title .= ' ' . $catObj->name;
                    $url = get_category_link($category);
                }
            }
            else
            {
                $posts = plsh_get_posts_by_meta('is_featured', 'on', 3);
            }
        }
        else
        {
            
            if(plsh_is_gallery())
            {
                $category = plsh_gs('gallery_index_featured_category');
                $type = plsh_gs('gallery_index_featured_type'); 
            }
            else
            {
                $category = plsh_gs('blog_archive_featured_category');
                $type = plsh_gs('blog_archive_featured_type');            
            }
            
            if($type == 'category')
            {
                if(intval($category) > 0)
                {
                    $params = array(
                        'cat' => $category
                    );
                    $posts = plsh_get_post_collection($params, 3);
                    
                    $catObj = get_category($category);
                    $title .= ' ' . $catObj->name;
                    $url = get_category_link($category);
                }
            }
            else
            {
                $tag = false;
                $category = false;
                if(is_tag())
                {
                    $tag = get_query_var('tag_id');
                    $tagObj = get_tag($tag);
                    $title .= ' ' . $tagObj->name;
                    $url = get_tag_link($tag);
                }
                
                if(is_category())
                {
                    $catObj = get_the_category();
                    $category = $catObj[0]->cat_ID;
                    $title .= ' ' . $catObj[0]->name;
                    $url = get_category_link($category);
                }
                
                $params = array(
                    'cat' => $category,
                    'tag_id' => $tag,
                    'meta_key' => 'is_featured',
                    'meta_value' => 'on'
                );
                $posts = plsh_get_post_collection($params, 3);                
            }
        }
        
        return array(
            'posts' => $posts,
            'count' => count($posts),
            'title' => $title,
            'url' => $url
        );
        
    }
}

if(!function_exists('plsh_is_gallery'))
{
    function plsh_is_gallery()
    {
        if(is_post_type_archive('gallery') || is_singular('gallery'))
        {
           return true; 
        }
        return false;
    }
}

if(!function_exists('plsh_mosaic_callback'))
{
    function plsh_mosaic_callback()
    {
        global $post;
        ob_start();
        $page = $_POST['page'];
        $last_page = false;

        $args = array(
            'category_name' => $_POST['category'],
            'tag' => $_POST['tag']
        );
    
        $items = plsh_get_post_collection($args, 5, $page);
        
        foreach($items as $key => $post)
        {
            setup_postdata($post);                
            if($page % 2 == 0)
            {
                if($key == 2)
                {
                    get_template_part( 'theme/templates/mosaic-item-large');
                } 
                else
                { 
                    get_template_part( 'theme/templates/mosaic-item-small');
                }
            }
            else
            {
                if($key == 0)
                {
                    get_template_part( 'theme/templates/mosaic-item-large');
                } 
                else
                { 
                    get_template_part( 'theme/templates/mosaic-item-small');
                }
            }

            ?>
            <?php
        }
        
        $items = plsh_get_post_collection($args, 5, $page+1);
        if(empty($items))
        {
            $last_page = true;
        }
        
        $data = ob_get_contents();
        ob_end_clean();
        
        die(json_encode(array('html'=>$data, 'last'=>$last_page)));
    }
}
        
if(!function_exists('plsh_sharrre_callback'))
{
    function plsh_sharrre_callback()
    {
        header('content-type: application/json');
        ob_start();
        //Sharrre by Julien Hany
        $json = array('url'=>'','count'=>0);
        $json['url'] = $_GET['url'];
        $url = urlencode($_GET['url']);
        $type = urlencode($_GET['type']);
        
        if(filter_var($_GET['url'], FILTER_VALIDATE_URL))
        {
            if($type == 'googlePlus') //source http://www.helmutgranda.com/2011/11/01/get-a-url-google-count-via-php/
            {  
                $contents = plsh_parse('https://plusone.google.com/u/0/_/+1/fastbutton?url=' . $url . '&count=true');
                preg_match( '/window\.__SSR = {c: ([\d]+)/', $contents, $matches );

                if(isset($matches[0]))
                {
                  $json['count'] = (int)str_replace('window.__SSR = {c: ', '', $matches[0]);
                }
            }
            else if($type == 'stumbleupon') 
            {
                $content = plsh_parse("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=$url");

                $result = json_decode($content);
                if (isset($result->result->views))
                {
                    $json['count'] = $result->result->views;
                }
            }
        }
        
        echo str_replace('\\/','/',json_encode($json));
        $data = ob_get_contents();
        ob_end_clean();
        die($data);
    }
}


if(!function_exists('plsh_parse'))
{
    function plsh_parse($encUrl){
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => 'sharrre', // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
            CURLOPT_TIMEOUT => 10, // timeout on response
            CURLOPT_MAXREDIRS => 3, // stop after 10 redirects
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        $ch = curl_init();

        $options[CURLOPT_URL] = $encUrl;  
        curl_setopt_array($ch, $options);

        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);

        curl_close($ch);

        if ($errmsg != '' || $err != '') {
          /*print_r($errmsg);
          print_r($errmsg);*/
        }

        return $content;
    }
}

if(!function_exists('plsh_get_popular_posts'))
{
    function plsh_get_popular_posts($range='monthly', $count=5)
    {
        //if popular post plugin class is defined
        if(class_exists('WordpressPopularPosts'))
        {
            global $wpdb;

            if ( !$range || 'all' == $range ) 
            {
                $querydetails = $wpdb->prepare("SELECT
                    pop.postid FROM $wpdb->prefix popularpostsdata as pop,
                    {$wpdb->prefix}posts as p WHERE pop.postid = p.ID
                    AND p.post_type = \"post\"
                    ORDER BY pop.pageviews DESC LIMIT %d", $count);      
            } 
            else
            {
                $interval = "";

                switch( $range ){
                    case "yesterday":
                        $interval = "1 DAY";
                    break;

                    case "daily":
                        $interval = "1 DAY";
                    break;

                    case "weekly":
                        $interval = "1 WEEK";
                    break;

                    case "monthly":
                        $interval = "1 MONTH";
                    break;

                    default:
                        $interval = "1 DAY";
                    break;
                }

                $now = current_time('mysql');
                $querydetails = $wpdb->prepare("SELECT pop.postid FROM {$wpdb->prefix}popularpostssummary as pop,
                    {$wpdb->prefix}posts as p WHERE pop.postid = p.ID
                    AND pop.last_viewed > DATE_SUB('%s', INTERVAL $interval )
                    AND p.post_type = \"post\"
                    GROUP BY pop.postid
                    ORDER BY SUM(pop.pageviews) DESC LIMIT %d",
                    $now,
                    $count
                    );
            }
            $result = $wpdb->get_results($querydetails);
            if (empty($result) )
            {
                return false;
            }
			
			$double_check = array();
			// WPML support, get original post/page ID
			if ( defined('ICL_LANGUAGE_CODE') && function_exists('icl_object_id') ) {
				global $sitepress;
				
				if ( isset( $sitepress )) { // avoids a fatal error with Polylang
					
					foreach($result as $key => &$item)
					{
						$new_id = icl_object_id( $item->postid, get_post_type( $item->postid ), false, ICL_LANGUAGE_CODE );
						if($new_id && !isset($double_check[$new_id]))
						{
							$double_check[$new_id] = true;
							$item->postid = $new_id;
						}
						else
						{
							unset($result[$key]);
						}
					}
				}
				
			}
			
            return $result;
        }
        return false;
    }
}


if(!function_exists('plsh_is_post_hot'))
{
    function plsh_is_post_hot($post_id)
    {
        //if popular post plugin class is defined
        if(class_exists('WordpressPopularPosts'))
        {
            global $wpdb;
            
            $cached = get_option('plsh_cached_popular_posts', json_encode(array()));
            $cached = json_decode($cached, true);
            $result = array();

            if(empty($cached) || (!empty($cached) && $cached['timestamp'] < time()))  //if cache is older one hour
            {
                $table_name = $wpdb->prefix . "popularposts";
                $interval = "1 WEEK";
                $now = current_time('mysql');
                $query = "SELECT pop.postid FROM {$table_name}summary as pop, {$wpdb->prefix}posts as p WHERE pop.postid = p.ID AND pop.last_viewed > DATE_SUB('{$now}', INTERVAL {$interval}) AND p.post_type = \"post\" GROUP BY pop.postid ORDER BY SUM(pop.pageviews) DESC LIMIT 5";
                $result = $wpdb->get_results($query);
                
                $data = array();
                if(!empty($result))
                {
                    foreach($result as $item)
                    {
                        $data[] = $item->postid;
                    }
                }
                $cached = array('data' => $data, 'timestamp' => time() + 60*60);
                update_option('plsh_cached_popular_posts', json_encode($cached));
            }

            if(empty($cached) || empty($cached['data']))
            {
                return false;
            }            
                         
            if(in_array($post_id, $cached['data']))
            {
                return true;
            }
        }
        return false;
    }
}


if(!function_exists('plsh_excerpt'))
{
    function plsh_excerpt($limit=50) 
    {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) 
		{
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
		}
		else
		{
            $excerpt = implode(" ",$excerpt);
		}
        
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		$excerpt = strip_tags($excerpt);
		return $excerpt;
    }
}

if(!function_exists('plsh_get_banner_by_size_and_slug'))
{
    function plsh_get_banner_by_size_and_slug($slug='default', $size='728x90') 
    {
        if(empty($size) || empty($slug)) return array();
        
        $banners = plsh_gs($size);
        $banner = array();
        
        if(!empty($banners))
        {
            foreach($banners as $item)
            {
                if($item['ad_slug'] == $slug)
                {
                    $banner = $item;
                }
            }
        }   
        return $banner;
    }
}

    
if(!function_exists('plsh_get_banner_by_location'))
{
    function plsh_get_banner_by_location($location='header_ad', $extra_wrapper_class='') 
    {
        $location = plsh_gs($location);
        $return = '';
        
        if($location && $location['ad_enabled'] == 'on')
        {
            $location_item = plsh_get_rotated_banner($location);
            $banner = plsh_get_banner_by_size_and_slug($location_item['ad_slug'], $location_item['ad_size']);
            
            if(!empty($banner))
            {
                $return .= '<div class="banner-' . $location_item['ad_size'] . ' ' . $extra_wrapper_class . '">';   
                
                if($banner['ad_type'] == 'banner') 
                {
                    $return .= '<a href="' . $banner['ad_link'] . '" target="_blank"><img src="' . $banner['ad_file'] . '" alt="' . $banner['ad_title'] . '"></a>';
                }
                elseif($banner['ad_type'] == 'iframe')
                {
                    $return .= '<iframe class="iframe-' . $location_item['ad_size'] . '" scrolling="no" src="' . $banner['ad_iframe_src'] . '"></iframe>';
                }
                else
                {                    
                    $return .= stripslashes($banner['googlead_content']);
                }
                
                $return .= '</div>';
            }
        }
        
        return $return;        
    }
}

if(!function_exists('plsh_get_active_banners'))
{
    function plsh_get_active_banners($size='728x90') 
    {
        $banners = plsh_gs($size);
        $return = array();
        if(!empty($banners))
        {
            foreach($banners as $banner)
            {
                if(!empty($banner['ad_enabled']) && $banner['ad_enabled'] == 'on')
                {
                    $return[] = $banner;
                }
            }
        }
        return $return;
    }
}

if(!function_exists('plsh_get_rotated_banner'))
{
    function plsh_get_rotated_banner($location)
    {
        if(!empty($location) && !empty($location['ads_linked']))
        {
            $linked = $location['ads_linked'];
            if(sizeof($linked)> 1)
            {
                $rand = rand(0, sizeof($linked)-1);
                return $linked[$rand];
            }
            
            return $linked[0];
        }
    }
}


/* Register gallery */
if(!function_exists('plsh_add_gallery_post_type'))
{
    function plsh_add_gallery_post_type() 
    {
        $labels = array(
          'name' => 'Galleries',
          'singular_name' => 'Gallery item',
          'add_new' => 'Add New',
          'add_new_item' => 'Add New Item',
          'edit_item' => 'Edit Item',
          'new_item' => 'New Item',
          'all_items' => 'All Gallery Items',
          'view_item' => 'View Item',
          'search_items' => 'Search Gallery Items',
          'not_found' =>  'No gallery items found',
          'not_found_in_trash' => 'No gallery items found in Trash', 
          'parent_item_colon' => '',
          'menu_name' => 'Galleries'
        );

        $args = array(
          'labels' => $labels,
          'public' => true,
          'publicly_queryable' => true,
          'show_ui' => true, 
          'show_in_menu' => true, 
          'query_var' => true,
          'has_archive' => true,
          'menu_icon' => '',
          'menu_position' => 5,
          'rewrite' => array('slug' => 'gallery', 'with_front' => false),
          'capability_type' => 'post',
          'hierarchical' => false,
          'menu_position' => null,
          'supports' => array( 'title', 'editor', )
        ); 

        register_post_type( 'gallery', $args );
    }
}
 
if(!function_exists('plsh_add_menu_icons_styles'))
{
    function plsh_add_menu_icons_styles(){
    ?>
        <style>
        #menu-posts-gallery div.wp-menu-image:before {
          content: "\f232";
        }
        </style>
    <?php
    }
}

//Attachments plugin setup
if( class_exists( 'Attachments' ) )
{
    add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance
    add_action( 'attachments_register', 'plsh_galleries' );
}

if(!function_exists('plsh_galleries'))
{
    function plsh_galleries( $attachments )
    {
        $fields         = array(
            array(
                'name'      => 'caption',                       // unique field name
                'type'      => 'textarea',                      // registered field type
                'label'     => __( 'Caption', 'attachments' ),  // label to display
                'default'   => 'caption',                       // default value upon selection
            )
        );

      $args = array(

        // title of the meta box (string)
        'label'         => 'Gallery',

        // all post types to utilize (string|array)
        'post_type'     => array( 'gallery' ),

        // meta box position (string) (normal, side or advanced)
        'position'      => 'normal',

        // meta box priority (string) (high, default, low, core)
        'priority'      => 'high',

        // allowed file type(s) (array) (image|video|text|audio|application)
        'filetype'      => array('image'),  // no filetype limit

        // include a note within the meta box (string)
        'note'          => 'Attach images to gallery using the button below!',

        // by default new Attachments will be appended to the list
        // but you can have then prepend if you set this to false
        'append'        => true,

        // text for 'Attach' button in meta box (string)
        'button_text'   => __( 'Attach Images', 'goliath' ),

        // text for modal 'Attach' button (string)
        'modal_text'    => __( 'Attach', 'goliath' ),

        // which tab should be the default in the modal (string) (browse|upload)
        'router'        => 'browse',

        // whether Attachments should set 'Uploaded to' (if not already set)
        'post_parent'   => false,

        // fields array
        'fields'        => $fields,

      );

      $attachments->register( 'plsh_galleries', $args ); // unique instance name
    }
}

/*
 * Description: removes the silly 10px margin from the new caption based images
 * Author: Justin Adie
 * Version: 0.1.0
 * Author URI: http://rathercurious.net
 */

if(!function_exists('plsh_fix_image_margins'))
{
    function plsh_fix_image_margins($x=null, $attr, $content)
    {
        extract(shortcode_atts(array(
            'id'    => '',
            'align'    => 'alignnone',
            'width'    => '',
            'caption' => ''
        ), $attr));

        if ( 1 > (int) $width || empty($caption) )
        {
            return $content;
        }

        if ( $id )
        {
            $id = 'id="' . $id . '" ';
        }

        return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + 0) . 'px">'
        . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}

if(!function_exists('search_excerpt_highlight'))
{
    function search_excerpt_highlight() {
        $excerpt = get_the_excerpt();
        $keys = implode('|', explode(' ', get_search_query()));
        $excerpt = preg_replace('/(' . $keys .')/iu', '<s>\0</s>', $excerpt);
        echo  $excerpt;
    }
}

if(!function_exists('search_title_highlight'))
{
    function search_title_highlight() {
        $title = get_the_title();
        $keys = implode('|', explode(' ', get_search_query()));
        $title = preg_replace('/(' . $keys .')/iu', '<s>\0</s>', $title);
        
        echo $title;
    }
}

if(!function_exists('plsh_setup_constellation_sidebar'))
{
    function plsh_setup_constellation_sidebar($args) {
        
        $args['before_widget'] = '<div id="%1$s" class="sidebar-item constellation-widget widget %2$s">';
        $args['after_widget'] = '</div></div>';
        $args['before_title'] = '<div class="title-default"><span class="active">';
        $args['after_title'] = '</span></div><div class="widget-content">';
                
        return $args;
    }
}

if(!function_exists('plsh_navbar_active'))
{
    function plsh_navbar_active() {
        global $post;
        
        if(plsh_gs('post_navigation') == 'enabled')
        {
            return true;
        }
        elseif(plsh_gs('post_navigation') == 'selected')
        {
            $meta = get_post_meta(get_the_ID());
            if(!empty($meta['show_nav']) && $meta['show_nav'][0] == 'on')
            {
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('plsh_language_selector_flags'))
{
    function plsh_language_selector_flags(){
        if(function_exists('icl_get_languages'))
        {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if(!empty($languages)){
                echo '<li>';
                
                foreach($languages as $l){
                    if(!$l['active']) { echo '<a href="'.$l['url'].'">'; }
                    echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> ';
                    if(!$l['active']) { echo '</a>'; }
                }
                
                echo '</li>';
            }
        }
    }
}

if(!function_exists('get_wpml_admin_text_string'))
{
    function get_wpml_admin_text_string($name)
    {
        $text = false;
        if(function_exists('icl_get_languages') && function_exists('icl_t'))
        {
            $text = icl_t('admin_texts_theme_goliath', 'goliath' . '_' . $name);
        }

        if(!$text)
        {
            $text = plsh_gs($name);
        }

        return $text;
    }
}

if(!function_exists('plsh_related_products_args'))
{
    function plsh_related_products_args( $args )
    {
        $args['posts_per_page'] = 4; // 4 related products
        $args['columns'] = 4; // arranged in 2 columns
        return $args;
    }
}

if(!function_exists('plsh_wp_title_for_home'))
{
    function plsh_wp_title_for_home( $title, $sep ) {
        if ( is_feed() ) 
        {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo( 'name', 'display' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) 
        {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) 
        {
            $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
        }

        return $title;
    }
}
    
if(!function_exists('plsh_widget_title_force'))
{
    function plsh_widget_title_force($title)
    {
        if(empty($title))
        {
            $title = ' ';
        }

        return $title;
    }
}

if(!function_exists('plsh_register_required_plugins'))
{
    function plsh_register_required_plugins()
    {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin pre-packaged with a theme
            array(
                'name'     				=> 'Visual Composer', // The plugin name
                'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
                'source'   				=> PLSH_PLUGIN_PATH . 'js_composer.zip', // The plugin source
                'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> plsh_get_bundled_plugin_version('js_composer'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'     				=> 'Revolution Slider', // The plugin name
                'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
                'source'   				=> PLSH_PLUGIN_PATH . 'revslider.zip', // The plugin source
                'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> plsh_get_bundled_plugin_version('revslider'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'     				=> 'Constellation Mega Menu for Goliath', // The plugin name
                'slug'     				=> 'constellation', // The plugin slug (typically the folder name)
                'source'   				=> PLSH_PLUGIN_PATH . 'constellation.zip', // The plugin source
                'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> '1.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'     				=> 'bbPress', // The plugin name
                'slug'     				=> 'bbpress', // The plugin slug (typically the folder name)
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> ''
            ),
            array(
                'name'     				=> 'Woocommerce', // The plugin name
                'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> ''
            ),
            array(
                'name'     				=> 'Attachments', // The plugin name
                'slug'     				=> 'attachments', // The plugin slug (typically the folder name)
                'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> ''
            ),
            array(
                'name'     				=> 'WordPress Popular Posts', // The plugin name
                'slug'     				=> 'wordpress-popular-posts', // The plugin slug (typically the folder name)
                'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '3.3.1'
            ),
            array(
                'name'     				=> 'Contact Form 7', // The plugin name
                'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> ''
            ),
            array(
                'name'     				=> 'Regenerate Thumbnails', // The plugin name
                'slug'     				=> 'regenerate-thumbnails', // The plugin slug (typically the folder name)
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> ''
            ),             
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'       		=> 'goliath',         	// Text domain - likely want to be the same as your theme.
            'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
            'menu'         		=> 'tgmpa-install-plugins', 	// Menu slug
            'parent_slug'  		=> 'themes.php',            	// Parent menu slug.
            'capability'   		=> 'edit_theme_options',
            'has_notices'      	=> true,                       	// Show admin notices or not
            'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
            'message' 			=> '',							// Message to output right before the plugins table
            'strings'      		=> array(
                'page_title'                       			=> __( 'Install Required Plugins', 'goliath' ),
                'menu_title'                       			=> __( 'Install Plugins', 'goliath' ),
                'installing'                       			=> __( 'Installing Plugin: %s', 'goliath' ), // %1$s = plugin name
                'oops'                             			=> __( 'Something went wrong with the plugin API.', 'goliath' ),
                'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','goliath' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'goliath' ), // %1$s = plugin name(s)
                'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'goliath' ), // %1$s = plugin name(s)
                'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'goliath' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'goliath' ), // %1$s = plugin name(s)
                'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'goliath' ), // %1$s = plugin name(s)
                'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'goliath' ), // %1$s = plugin name(s)
                'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'goliath' ), // %1$s = plugin name(s)
                'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'goliath' ),
                'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'goliath' ),
                'return'                           			=> __( 'Return to Required Plugins Installer', 'goliath' ),
                'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'goliath' ),
                'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'goliath' ), // %1$s = dashboard link
                'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa( $plugins, $config );
    }
}


/**
 * Force Visual Composer & Revslider to initialize as "built into the theme".
 */
if(function_exists('vc_set_as_theme')) { vc_set_as_theme(true); }

if(function_exists('set_revslider_as_theme')) { set_revslider_as_theme(); }

?>