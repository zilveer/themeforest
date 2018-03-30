<?php

/**
 * FILE: customizer.php 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: WPLMS
 */
if ( !defined( 'ABSPATH' ) ) exit;
include_once 'class.php';

//REgisterig Theme Settings/Cusomizer

function vibe_customizer_setup() {
  $customize = get_option('vibe_customizer');
  if(!isset($customize)){
      add_option('vibe_customizer','');
  }
}

// add some settings and such

add_action('customize_register', 'vibe_customize');
add_action('after_setup_theme','vibe_customizer_setup');



function vibe_customize($wp_customize) {

    require_once(dirname(__FILE__) . '/config.php');
/*====================================================== */
/*===================== SECTIONS ====================== */
/*====================================================== */
    $i=164; // Show sections after the WordPress default sections
    if(isset($vibe_customizer) && is_Array($vibe_customizer)){
        foreach($vibe_customizer['sections'] as $key=>$value){
            $wp_customize->add_section( $key, array(
            'title'          => $value,
            'priority'       => $i,
        ) );
            $i = $i+4;
        }
    }
    

/*====================================================== */
/*================= SETTINGS & CONTROLS ================== */
/*====================================================== */
if(isset($vibe_customizer) && is_array($vibe_customizer))
    foreach($vibe_customizer['controls'] as $section => $settings){ $i=1;
        foreach($settings as $control => $type){
            $i=$i+2;
            /*====== REGISTER SETTING =========*/
            $wp_customize->add_setting( 'vibe_customizer['.$control.']', array(
                                                'label'         => $type['label'],
                                                'type'           => 'option',
                                                'capability'     => 'edit_theme_options',
                                                'default'       => (empty($type['default'])?'':$type['default'])
                                            ) );
            
            switch($type['type']){
                case 'color':
                        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $control, array(
                        'label'   => $type['label'],
                        'section' => $section,
                        'settings'   => 'vibe_customizer['.$control.']',
                        'priority'       => $i
                        ) ) );            
                    break;
                case 'image':
                        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $control, array(
                            'label'   => $type['label'],
                            'section' => $section,
                            'settings'   => 'vibe_customizer['.$control.']',
                            'priority'       => $i
                        ) ) );
                    break;
                case 'select':
                        $wp_customize->add_control( $control, array(
                                'label'   => $type['label'],
                                'section' => $section,
                                'settings'   => 'vibe_customizer['.$control.']',
                                'priority'   => $i,
                                'type'    => 'select',
                                'choices'    => (empty($type['choices'])?'':$type['choices'])                        
                                ) );
                break;
                case 'text':
                        $wp_customize->add_control( $control, array(
                                'label'   => $type['label'],
                                'section' => $section,
                                'settings'   => 'vibe_customizer['.$control.']',
                                'priority'       => $i,
                                'type'    => 'text',
                                ) );
                    break;
                case 'slider':
                        $wp_customize->add_control( new Vibe_Customize_Slider_Control( $wp_customize, $control, array(
                                'label'   => $type['label'],
                                'section' => $section,
                                'settings'   => 'vibe_customizer['.$control.']',
                                'priority'       => $i,
                                'type'    => 'slider',
                                ) ) );
                    break;
                case 'textarea':
                        $wp_customize->add_control( new Vibe_Customize_Textarea_Control( $wp_customize, $control, array(
                                'label'   => $type['label'],
                                'section' => $section,
                                'settings'   => 'vibe_customizer['.$control.']',
                                'priority'       => $i,
                                'type'    => 'textarea',
                                ) ) );
                    break;
            }
        }
    }
}

add_action('customize_controls_print_styles', 'vibe_customize_css');

function vibe_customize_css(){
    wp_enqueue_style('customizer_css',VIBE_URL.'/includes/customizer/customizer.css');
}

add_action('customize_controls_print_scripts', 'vibe_customize_scripts');
function vibe_customize_scripts(){
    wp_enqueue_script('wplms_customizer_js',VIBE_URL.'/includes/customizer/customizer.js',array( 'jquery' ),WPLMS_VERSION,true);
}


add_action('wp_ajax_reset_customizer_colors','wplms_reset_customizer_colors');
function wplms_reset_customizer_colors(){
    $option = get_option('vibe_customizer');
    if(empty($option)){
       die(); 
    }
    $value = $_POST['value'];
    switch($value){
        case 'minimal':
            $option['header_top_bg'] = $option['header_bg'] = $option['nav_bg'] = $option['body_bg']= $option['content_bg']= $option['single_dark_color']= $option['single_light_color'] = $option['footer_bg'] = $option['footer_bottom_bg'] = $option['footer_bg'] = '#FFF';
            $option['single_dark_text']=$option['single_light_text']=$option['header_top_color'] = $option['header_color'] = $option['widget_title_color']= $option['nav_color']= $option['content_color']= $option['footer_color']= $option['footer_heading_color']= $option['footer_bottom_color'] = '#444';
            $option['single_dark_color'] = '#FAFAFA';
            
        break;
        case 'modern':
            $option['header_top_bg'] = '#232b2d';
            $option['header_top_color'] =  '#FFF';
            $option['header_bg'] = '#FFF';
            $option['header_color'] = '#444';
        break;
        case 'elegant':
            $option['header_top_bg'] = '#232b2d';
            $option['header_top_color'] =  '#FFF';
            $option['nav_bg'] = '#009dd8';
            $option['nav_color'] = $option['header_bg'] = '#FFF';
            $option['header_color'] = '#444';
        break;
        default:
            $option['header_top_bg'] = $option['single_dark_color'] = $option['footer_bottom_bg'] = $option['nav_bg'] = '#232b2d';
            $option['header_bg'] = $option['single_light_color'] = $option['footer_bg'] = '#313b3d';
            $option['body_bg']= '#f9f9f9';
            $option['single_dark_text']=$option['single_light_text']=$option['content_bg']= '#ffffff';
            $option['header_top_color'] = $option['header_color'] = $option['nav_color']= $option['footer_color']= $option['footer_heading_color']= $option['footer_bottom_color'] = '#ffffff';
            $option['widget_title_color']= $option['content_color']=  '#232323';
        break;
    }
    update_option('vibe_customizer',$option);
    die();
}
