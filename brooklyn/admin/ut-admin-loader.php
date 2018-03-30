<?php
/*
|--------------------------------------------------------------------------
| Admin Init
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'ut_admin_init' ) ) :

    function ut_admin_init() {
        	
		/*
		* Section Manager
		*/
		
        /* no section and page options for front and blog page */
        if( isset( $_GET['post'] ) && $_GET['post'] != get_option('page_on_front') && $_GET['post'] != get_option('page_for_posts') ) {
        
		    add_action('admin_print_styles-post.php', 'load_ut_section_manager_styles');
		
        }
        
        add_action('admin_print_styles-post-new.php', 'load_ut_section_manager_styles');
        
        /*
		* Column Views
		*/
        
        add_action('admin_print_styles-edit.php', '_ut_page_column_type_scripts');
        
        /*
		* Option Tree Styles
		*/
                 
		add_action('admin_print_scripts-brooklyn_page_ot-theme-options', 'load_ut_option_tree_styles'); 

		
    }

endif;


/*
|--------------------------------------------------------------------------
| Needed JS for Option Tree to make it more interactive
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'load_ut_option_tree_styles' ) ) :

	function load_ut_option_tree_styles() {
	    
        wp_enqueue_style(
            'ut-select2-css',
            THEME_WEB_ROOT . '/admin/assets/vendor/select2/css/select2.min.css'
        );
        
        wp_enqueue_script(
            'ut-select2-js', 
            THEME_WEB_ROOT .'/admin/assets/vendor/select2/js/select2.full.js', 
            array('jquery')
        );        
        
		wp_enqueue_script(
            'ut-option-tree-js', 
            THEME_WEB_ROOT .'/admin/assets/js/ut-option-effects.js', 
            array( 'jquery', 'jquery-ui-autocomplete', 'jquery-effects-highlight' )
        );		
		
        $popup_vars = array( 
            'pop_url' => THEME_WEB_ROOT . '/admin/',
            'google_fonts' => THEME_WEB_ROOT . '/admin/assets/google/google_fonts.json'
        );
        
		wp_localize_script( 'ut-option-tree-js', 'ut_font_popup', $popup_vars );		
		
	}

endif;


/*
|--------------------------------------------------------------------------
| Needed CSS and JS
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'load_ut_section_manager_styles' ) ) :

	function load_ut_section_manager_styles() {
		
		wp_enqueue_style(
            'ut-section-font',
            THEME_WEB_ROOT . '/css/ut-fontface.css'
        );
		
        wp_enqueue_style(
            'ut-section-manager', 
            THEME_WEB_ROOT . '/admin/assets/css/ut-section-manager.css'
        );		
				
		wp_register_script(
            'ut-section-manager-js', 
            THEME_WEB_ROOT .'/admin/assets/js/ut-section-manager.js', 
            array('jquery','jquery-ui-accordion')
        );
        
		wp_enqueue_script( 'ut-section-manager-js' );		
		
	}

endif;


/*
|--------------------------------------------------------------------------
| Add Action for Admin Init
|--------------------------------------------------------------------------
*/
if( is_admin() ){
    add_action('admin_init' , 'ut_admin_init');
	
} 


/*
|--------------------------------------------------------------------------
| Highlight Widgets
|--------------------------------------------------------------------------
*/

if ( ! function_exists( 'ut_custom_widget_style' ) ) :

    function ut_custom_widget_style() {
    
    echo '<style type="text/css">
                div.widget[id*="_ut_video"] .widget-title,
                div.widget[id*="_lw_ut_twitter"] .widget-title,
                div.widget[id*="_ut_flickr"] .widget-title {
                    color: #77be32 !important;
                }
            </style>';
    }
    
    add_action('admin_print_styles-widgets.php', 'ut_custom_widget_style');

endif;

/*
|--------------------------------------------------------------------------
| Enhanced Gallery Settings
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'ut_create_gallery_options' ) ) :

    function ut_create_gallery_options() {
        
        $goption = '<script type="text/html" id="tmpl-ut-gallery-setting">';
            
            $goption .= '<div class="clear"></div>';
            $goption .= '<h3>Lightbox Option</h3>';
            
            $goption .= '<label class="setting">';
      
              $goption .= '<span>'.esc_html__('Lightbox' , 'unitedthemes').'</span>';
              
              $goption .= '<select data-setting="ut_gallery_lightbox">';
                $goption .= '<option value="off">'.esc_html__('Off' , 'unitedthemes').'</option>';       
                $goption .= '<option value="on">'.esc_html__('On' , 'unitedthemes').'</option>';
              $goption .= '</select>';
              
              $goption .= '<p>'.esc_html__('Please make sure you are linking to the "Media File" when turning this option "on". See "Link to" Option above!' , 'unitedthemes').'</p>';
              
            $goption .= '</label>';
            
            $goption .= '<div class="clear"></div>';
            $goption .= '<h3>Image Border</h3>';
            
            $goption .= '<label class="setting">';
                
                $goption .= '<span>'.esc_html__('Image Border' , 'unitedthemes').'</span>';
                  
                $goption .= '<select data-setting="ut_image_border">';
                    $goption .= '<option value="off">'.esc_html__('Off' , 'unitedthemes').'</option>';
                    $goption .= '<option value="on">'.esc_html__('On' , 'unitedthemes').'</option>';
                $goption .= '</select>';
            
            $goption .= '</label>';
            
            $goption .= '<label class="setting">';
                
                $goption .= '<span>'.esc_html__('Radius' , 'unitedthemes').'</span>';                  
                $goption .= '<input type="text" data-setting="ut_image_border_radius">';
                $goption .= '<div class="clear"></div>';	    
                $goption .= '<p>'.esc_html__('Please insert a value in pixel: e.g. "3px".' , 'unitedthemes').'</p>';
                
            $goption .= '</label>';
            
        $goption .= '</script>';
        
        
        $goption .= '<script type="text/javascript">';            
            
            $goption .= "jQuery(document).ready(function(){

              _.extend(wp.media.gallery.defaults, {
                ut_gallery_lightbox: 'off',
                ut_image_border: 'off',
                ut_image_border_radius: '0'
              });
        
              wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                template: function(view){
                  return wp.media.template('gallery-settings')(view)
                       + wp.media.template('ut-gallery-setting')(view);
                }
              });
        
            });";
        
        $goption .= '</script>';
        
        echo $goption;
    
    }
        
    add_action('print_media_templates','ut_create_gallery_options');

endif; 


/*
|--------------------------------------------------------------------------
| Update Page Settings Tabs
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'ut_update_page_type' ) ) :

    function ut_update_page_type( $menu_data ) {
        
        $menu_object = wp_get_nav_menu_items( $menu_data );
        
        /* no menu, leave here  */
        if( ! $menu_object ) {
            return false;
        }
        
        foreach ( (array) $menu_object as $key => $menu_item ) {
                    
            update_post_meta( $menu_item->object_id, 'ut_page_type', $menu_item->menutype );    
                
        }
        
    }

endif;

add_action( 'wp_update_nav_menu', 'ut_update_page_type', 90, 1 );


/** 
 * Add Column View CSS
 *
 * @return    string
 *
 * @access    private
 * @since     4.0
 * @version   1.0.0
 */
 
if( !function_exists( '_ut_page_column_type_scripts' ) ) {

    function _ut_page_column_type_scripts() {
        
        wp_enqueue_style(
            'ut-column-views',
            THEME_WEB_ROOT . '/admin/assets/css/ut-column-views.css'
        );
        
        wp_enqueue_script(
            'ut-column-views-js', 
            THEME_WEB_ROOT . '/admin/assets/js/ut-column-views.js',
            array('jquery')
        );      
        
    }

}

/** 
 * Add new column to WordPress Posts Dashbaord
 *
 * @return    string
 *
 * @access    private
 * @since     4.0
 * @version   1.0.0
 */
if( !function_exists( '_ut_page_column_type' ) ) {
    
    function _ut_page_column_type( $defaults ){

        $defaults['page_type']  = esc_html__( 'Type', 'unitedthemes' );
        return $defaults; 
      
    }
    
    add_filter( 'manage_pages_columns', '_ut_page_column_type' );

}

/** 
 * Add Page Type to columns inside WordPress Posts Dashbaord
 *
 * @return    int
 *
 * @access    private
 * @since     4.0
 * @version   1.0.0
 */
if( !function_exists( '_ut_page_custom_column_type' ) ) {

    function _ut_page_custom_column_type( $column_name, $id ){
                
        if( $column_name === 'page_type' ) {
            
            $type = get_post_meta( get_the_ID(), 'ut_page_type', true );
            
            if( $type == 'section' && get_the_ID() != get_option('page_for_posts') && get_the_ID() != get_option('page_on_front') ) {
                
                echo '<span class="ut-page-type section">' . esc_html__( 'section', 'unitedthemes' ) . '</span>';
                
            } else {
                
                echo '<span class="ut-page-type page">' . esc_html__( 'page', 'unitedthemes' ) . '</span>';
                
            }            
        
        }        
        
    }
    
    add_action( 'manage_pages_custom_column', '_ut_page_custom_column_type', 5, 2 );

}

/** 
 * Adjust Typography Field
 *
 * @return    array
 *
 * @access    private
 * @since     4.0
 * @version   1.0.0
 */
if( !function_exists( '_ut_typography_settings' ) ) {

    function _ut_typography_settings( $font_settings, $field_id ){
            
        if( $field_id == 'ut_global_headline_font_style_settings' ) {
            
            $font_settings = array_diff( $font_settings, array('font-family', 'font-weight') );
                    
        }
        
        if( $field_id == 'ut_global_page_headline_font_style_settings' ) {
            
            $font_settings = array_diff( $font_settings, array('font-family', 'font-weight') );
                    
        }
        
        if( $field_id == 'ut_image_loader_font' || $field_id == 'ut_image_loader_percentage_font' ) {
            
            $font_settings = array_diff( $font_settings, array( 'line-height' ) );
                    
        }
        
        if( $field_id == 'ut_image_loader_percentage_font' ) {
            
            $font_settings = array_diff( $font_settings, array( 'text-transform','font-variant' ) );
                    
        }
        
        if( $field_id == 'ut_global_navigation_submenu_font_style' ) {
            
            $font_settings = array_diff( $font_settings, array( 'font-family', 'letter-spacing', 'font-variant', 'line-height' ) );
                    
        }
        
        if( $field_id == 'ut_global_mobile_navigation_font_style' ) {
            
            $font_settings = array_diff( $font_settings, array( 'font-family', 'font-style', 'letter-spacing', 'font-variant', 'line-height', 'text-decoration' ) );
                    
        }
        
        if( $field_id == 'ut_global_navigation_websafe_font_style' || $field_id == 'ut_global_navigation_google_font_style' ) {
            
            $font_settings = array_diff(  $font_settings, array( 'line-height', 'font-variant', 'letter-spacing' ) );
        
        }
        
        if( $field_id == 'ut_global_blog_titles_font_style' || $field_id == 'ut_global_blog_single_titles_font_style' ) {
            
            $font_settings = array_diff(  $font_settings, array( 'font-family', 'font-style', 'letter-spacing', 'font-variant', 'line-height', 'text-decoration', 'font-weight', 'text-transform' ) );
        
        }
        
        if( $field_id == 'ut_global_header_text_logo_websafe_font_style' ) {
            
            $font_settings = array_diff(  $font_settings, array( 'font-family', 'font-style', 'letter-spacing', 'font-variant', 'line-height', 'text-decoration', 'font-size', 'text-transform' ) );
        
        }
        
        if( $field_id == 'ut_global_hero_catchphrase_websafe_font_style' || $field_id == 'ut_front_catchphrase_websafe_font_style' || $field_id == 'ut_blog_catchphrase_websafe_font_style' || $field_id == 'ut_page_caption_description_websafe_font_style' ) {
            
            $font_settings = array_diff(  $font_settings, array( 'font-family', 'font-style', 'font-variant', 'line-height', 'text-decoration' ) );    
        
        }
        
        return $font_settings;        
    
    }
    
    add_filter( 'ot_recognized_typography_fields', '_ut_typography_settings', 10, 2 );
    
}

/** 
 * Adjust Font Size Field
 *
 * @return    array
 *
 * @access    private
 * @since     4.0
 * @version   1.0.0
 */
if( !function_exists( '_ut_typography_font_sizes' ) ) {

    function _ut_typography_font_sizes( $font_size, $field_id ){
        
        if( $field_id == 'ut_image_loader_font' || $field_id == 'ut_image_loader_percentage_font' ) {
            
            $font_size = 30;
                    
        }
        
        if( $field_id == 'ut_global_navigation_google_font_style' || $field_id == 'ut_global_navigation_submenu_font_style' ) {
            
            $font_size = 20;
            
        }
        
        return $font_size;  
                
    }
    
    add_filter( 'ot_font_size_high_range', '_ut_typography_font_sizes', 10, 2 );

} 


/** 
 * Adjust EM Min Val
 *
 * @return    array
 *
 * @access    private
 * @since     4.1
 * @version   1.0.0
 */
if( !function_exists( '_ut_typography_em_min_sizes' ) ) {

    function _ut_typography_em_min_sizes( $field, $field_id ){
        
        if( $field_id == 'ut_global_hero_catchphrase_websafe_font_style' || $field_id == 'ut_front_catchphrase_websafe_font_style' || $field_id == 'ut_blog_catchphrase_websafe_font_style' || $field_id == 'ut_page_caption_description_websafe_font_style' ) {
            
            $field = 0.1;
                    
        }
        
        return $field;  
                
    }
    
    add_filter( 'ot_letter_spacing_high_range', '_ut_typography_em_min_sizes', 10, 2 );

}

/** 
 * Adjust EM High Val
 *
 * @return    array
 *
 * @access    private
 * @since     4.1
 * @version   1.0.0
 */
if( !function_exists( '_ut_typography_em_high_sizes' ) ) {

    function _ut_typography_em_high_sizes( $field, $field_id ){
        
        if( $field_id == 'ut_global_hero_catchphrase_websafe_font_style' || $field_id == 'ut_front_catchphrase_websafe_font_style' || $field_id == 'ut_blog_catchphrase_websafe_font_style' || $field_id == 'ut_page_caption_description_websafe_font_style' ) {
            
            $field = 1;
                    
        }
                
        return $field;  
                
    }
    
    add_filter( 'ot_letter_spacing_low_range', '_ut_typography_em_high_sizes', 10, 2 );

}

/** 
 * Adjust EM Interval
 *
 * @return    array
 *
 * @access    private
 * @since     4.1
 * @version   1.0.0
 */
if( !function_exists( '_ut_typography_em_interval' ) ) {

    function _ut_typography_em_interval( $field, $field_id ){
        
        if( $field_id == 'ut_global_hero_catchphrase_websafe_font_style' || $field_id == 'ut_front_catchphrase_websafe_font_style' || $field_id == 'ut_blog_catchphrase_websafe_font_style' || $field_id == 'ut_page_caption_description_websafe_font_style' ) {
            
            $field = 0.1;
                    
        }
                
        return $field;  
                
    }
    
    add_filter( 'ot_letter_spacing_range_interval', '_ut_typography_em_interval', 10, 2 );

}




?>