<?php

// Register custom controls to be used in customizer
require_once(get_template_directory() . '/includes/style-customizer/custom-controls.php');

// Include customizer sections
$section_path = get_template_directory() . '/includes/style-customizer/sections';
require_once($section_path . '/readme.php');
require_once($section_path . '/global.php');
require_once($section_path . '/site-background.php');
require_once($section_path . '/header.php');
require_once($section_path . '/menu.php');
require_once($section_path . '/home-slider.php');
require_once($section_path . '/page-intro.php');
require_once($section_path . '/content.php');
require_once($section_path . '/footer.php');
require_once($section_path . '/footer-bar.php');
require_once($section_path . '/others.php');
require_once(get_template_directory() . '/includes/style-customizer/output.php');


add_action('customize_register', 'uxbarn_ctmzr_register_customizer_sections');
add_action('customize_preview_init', 'uxbarn_ctmzr_load_customizer_live_preview');
add_action('customize_controls_enqueue_scripts', 'uxbarn_ctmzr_load_customizer_assets');
add_action('admin_menu', 'uxbarn_ctmzr_register_customizer_menu');


if( ! function_exists('uxbarn_ctmzr_register_customizer_sections')) {

    function uxbarn_ctmzr_register_customizer_sections($wp_customize) {
        
		uxbarn_ctmzr_register_readme($wp_customize);
		uxbarn_ctmzr_init_global_tab($wp_customize);
		uxbarn_ctmzr_init_site_bg_tab($wp_customize);
		uxbarn_ctmzr_init_header_tab($wp_customize);
		uxbarn_ctmzr_init_menu_tab($wp_customize);
		uxbarn_ctmzr_init_homeslider_tab($wp_customize);
		uxbarn_ctmzr_init_intro_tab($wp_customize);
		uxbarn_ctmzr_init_content_tab($wp_customize);
		uxbarn_ctmzr_init_footer_tab($wp_customize);
		uxbarn_ctmzr_init_footer_bar_tab($wp_customize);
		uxbarn_ctmzr_init_others_tab($wp_customize);
        
        // Remove any default sections
        $wp_customize->remove_section('title_tagline');
        $wp_customize->remove_section('nav');
        $wp_customize->remove_section('static_front_page');
        
    }

}
    
    
    
// ---------------------------------------------- //
// Data for Custom Controls
// ---------------------------------------------- //
    
if( ! function_exists('uxbarn_ctmzr_get_font_array')) {
	
    function uxbarn_ctmzr_get_font_array() {
        
        // System font list
        $font_array = array(
            'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
            'Georgia, serif' => 'Georgia, serif',
            'Helvetica, sans-serif' => 'Helvetica, sans-serif',
            '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
            'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
            '\'Times New Roman\', Times, serif' => '"Times New Roman", Times, serif',
            '\'Trebuchet MS\', Helvetica, sans-serif' => '"Trebuchet MS", Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
        );
        
        // Load Google Fonts into the list
        $raw_list = '';
        if ( function_exists( 'ot_get_option' ) ) {
            $raw_list = ot_get_option('uxbarn_to_setting_google_fonts_loader');
        }
        
        if(trim($raw_list) == '') {
            $raw_list = DEFAULT_GOOGLE_FONTS;
        }
        
        $raw_list = explode('|', $raw_list);
        
        $google_font_list = array();
        foreach($raw_list as $item) {
            if(trim($item) != '') {
                $clean_item = str_replace('+', ' ', $item);
                $google_font_list['[#GF#]' . $clean_item] = '[Google Fonts] ' . $clean_item;
            }
        }
    
        return $font_array + $google_font_list;
    }

}


if( ! function_exists('uxbarn_ctmzr_get_font_size_array')) {
    
    function uxbarn_ctmzr_get_font_size_array() {
        $font_size_array = array();
        
        for ($i=8; $i<=72; $i++) {
            $font_size_array[$i . 'px'] = $i . 'px';
        }
        
        return $font_size_array;
    }
	
}


if( ! function_exists('uxbarn_ctmzr_get_font_style_array')) {
    
    function uxbarn_ctmzr_get_font_style_array() {
        $font_style_array = array(
            'normal' => __('Normal', 'uxbarn'),
            'italic' => __('Italic', 'uxbarn'),
            'oblique' => __('Oblique', 'uxbarn'),
            'inherit' => __('Inherit', 'uxbarn'),
        );
        
        return $font_style_array;
    }
	
}


if( ! function_exists('uxbarn_ctmzr_get_font_weight_array')) {
    
    function uxbarn_ctmzr_get_font_weight_array() {
        $font_weight_array = array(
            'normal' => __('Normal', 'uxbarn'),
            'bold' => __('Bold', 'uxbarn'),
            'bolder' => __('Bolder', 'uxbarn'),
            'lighter' => __('Lighter', 'uxbarn'),
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
            'inherit' => __('Inherit', 'uxbarn'),
        );
        
        return $font_weight_array;
    }
	
}


if( ! function_exists('uxbarn_ctmzr_get_line_height_array')) {
    
    function uxbarn_ctmzr_get_line_height_array() {
        $line_height_array = array(
            '1em' => '1em',
            '1.1em' => '1.1em',
            '1.2em' => '1.2em',
            '1.3em' => '1.3em',
            '1.4em' => '1.4em',
            '1.5em' => '1.5em',
            '1.6em' => '1.6em',
            '1.7em' => '1.7em',
            '1.8em' => '1.8em',
            '1.9em' => '1.9em',
            '2em' => '2em',
            '2.1em' => '2.1em',
            '2.2em' => '2.2em',
            '2.3em' => '2.3em',
            '2.4em' => '2.4em',
            '2.5em' => '2.5em',
        );
        
        return $line_height_array;
    }

}


if( ! function_exists('uxbarn_ctmzr_get_background_repeat_array')) {
    
    function uxbarn_ctmzr_get_background_repeat_array() {
        $items = array(
            'no-repeat' => __('No Repeat', 'uxbarn'),
            'repeat' => __('Repeat All', 'uxbarn'),
            'repeat-x' => __('Repeat Horizontally', 'uxbarn'),
            'repeat-y' => __('Repeat Vertically', 'uxbarn'),
            'inherit' => __('Inherit', 'uxbarn'),
        );
        
        return $items;
    }

}


if( ! function_exists('uxbarn_ctmzr_get_background_position_array')) {
    
    function uxbarn_ctmzr_get_background_position_array() {
        $items = array(
            'left top' => __('Left Top', 'uxbarn'),
            'left center' => __('Left Center', 'uxbarn'),
            'left bottom' => __('Left Bottom', 'uxbarn'),
            'right top' => __('Right Top', 'uxbarn'),
            'right center' => __('Right Center', 'uxbarn'),
            'right bottom' => __('Right Bottom', 'uxbarn'),
            'center top' => __('Center Top', 'uxbarn'),
            'center center' => __('Center Center', 'uxbarn'),
            'center bottom' => __('Center Bottom', 'uxbarn'),
        );
        
        return $items;
    }

}


if( ! function_exists('uxbarn_ctmzr_get_opacity_array')) {
    
    function uxbarn_ctmzr_get_opacity_array() {
        $items = array(
            '0' => '0',
            '0.1' => '10%',
            '0.2' => '20%',
            '0.3' => '30%',
            '0.4' => '40%',
            '0.5' => '50%',
            '0.6' => '60%',
            '0.7' => '70%',
            '0.8' => '80%',
            '0.9' => '90%',
            '1' => '100%',
        );
        
        return $items;
    }
	
}


if( ! function_exists('uxbarn_ctmzr_get_default_color_by_scheme')) {

    function uxbarn_ctmzr_get_default_color_by_scheme() {
        $option = get_option('uxbarn_sc_global_color_scheme');
        switch($option) {
            case 'blue': return '#1B83BE'; break;
            case 'green': return '#88C425'; break;
            case 'orange': return '#F38630'; break;
            case 'purple': return '#B21C58'; break;
            case 'red': return '#F73917'; break;
            case 'yellow': return '#FCBC12'; break;
            case 'custom': 
                $option_set = get_option('uxbarn_sc_global_styles');
                $primary_color = $option_set['primary_color'];
                return $primary_color;
                break;
            default: return '#1B83BE'; break;
        }
    }
	
}
    
    
    
// ---------------------------------------------- //
// Sanitization
// ---------------------------------------------- //

if( ! function_exists('uxbarn_ctmzr_sanitize_text')) {
	
    function uxbarn_ctmzr_sanitize_text($input) {
        return wp_kses_post(force_balance_tags($input));
    }

}


if( ! function_exists('uxbarn_ctmzr_sanitize_checkbox')) {
    
    function uxbarn_ctmzr_sanitize_checkbox($input) {
        if ($input == 1) {
            return true;
        } else {
            return false;
        }
    }
	
}


if( ! function_exists('uxbarn_ctmzr_sanitize_google_fonts_loader')) {
    
    function uxbarn_ctmzr_sanitize_google_fonts_loader($input) {
        return esc_html(trim($input));
    }

}


if( ! function_exists('uxbarn_ctmzr_sanitize_pixel_input')) {
    
    function uxbarn_ctmzr_sanitize_pixel_input($input) {
        $input = preg_replace('/\D/', '', esc_html($input));
        if(is_numeric($input)) {
            return $input;
        } else {
            return 0;
        }
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_sanitize_custom_css' ) ) {
    
    function uxbarn_ctmzr_sanitize_custom_css( $input ) {
        return wp_strip_all_tags( $input, false ); // false = not remove line breaks in the code
    }
    
}
    
    
    
// ---------------------------------------------- //
// Live Preview Script
// ---------------------------------------------- //

if( ! function_exists('uxbarn_ctmzr_load_customizer_live_preview')) {
	
    function uxbarn_ctmzr_load_customizer_live_preview() {
        
        wp_enqueue_script('customizer-preview-js', get_template_directory_uri() . '/includes/style-customizer/js/live-preview.js', array('jquery', 'customize-preview'), null, true);
        
    }
	
}
    
    
    
// ---------------------------------------------- //
// Required Scripts for Customizer
// ---------------------------------------------- //

if( ! function_exists('uxbarn_ctmzr_load_customizer_assets')) {
	
    function uxbarn_ctmzr_load_customizer_assets() {
        
        wp_enqueue_style('customizer', get_template_directory_uri() . '/includes/style-customizer/css/customizer.css');
        
    }
	
}

if( ! function_exists('uxbarn_ctmzr_register_customizer_menu')) {
    
    function uxbarn_ctmzr_register_customizer_menu() {
        // Add the Customize link on admin panel
        add_menu_page(__('Style Customizer', 'uxbarn'), __('Style Customizer', 'uxbarn'), 'edit_theme_options', 'customize.php', '', IMAGE_PATH . '/admin/uxbarn-admin-s.jpg');
    }
	
}
    