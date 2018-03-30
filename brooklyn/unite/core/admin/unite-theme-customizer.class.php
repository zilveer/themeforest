<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 *
 * WP Customize Custom Controls
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if( class_exists( 'WP_Customize_Control' ) ) :
 
    class WP_Customize_UT_Field_Control extends WP_Customize_Control {
        
        public $unique  = '';
        public $type    = 'ut_field';
        public $options = array();        
        
        public function render_content() {
                   
            /* assign */
            $this->options['id'] = $this->id;
            $this->options['value'] = $this->value();
            $this->options['link'] = $this->get_link();
            $this->options['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
            
            /* function to call */
            $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $this->options['type'] );
            
            $args = ut_prepare_settings_field( $this->options, '', $this->unique );
            
            $this->before_option_output( $args );
            
            if( function_exists( $function_by_type ) ) {
                
                call_user_func( $function_by_type, $args, $this->options['type'] );
            
            }
        
        }
        
        public function before_option_output( $settings ) {
        
            /* render option @todo */        
            echo '<header class="ut-admin-panel-header" data-action="collapse" data-collapse-panel="' , $settings['id'] , '">';
                
                echo '<h3 class="ut-admin-panel-header-title ' , ( empty( $settings['desc'] ) ? 'no-description' : '' ) , '">' , $settings['title'] , '</h3>';
                
                if( !empty( $settings['desc'] ) ) {
                    
                    echo '<span class="ut-admin-panel-description">' , $settings['desc'] , '</span>';
                                    
                }
                
                echo '<div class="ut-admin-panel-actions"><a href="#"><i class="fa fa-angle-down"></i></a></div>';                
                
            echo '</header>';
        
        }
        
    
    }

endif;




class UT_Theme_Customizer {
    
    /**
     * Option Array
     * @var array
     */
    private $options;    
    
    /**
     * Customizer Option Key
     * @var string
     */
    protected $customize_key;    
        
    /**
     *
     * panel priority
     * @access public
     * @var bool
     *
     */
    public $priority = 1;
        
    /**
     * Constructor
     *
     * @since     1.0.0
     * @version   1.0.0
     */    
    public function __construct() {
    
        $this->options = apply_filters( 'unite_customizer_options', array() );
        
        /* options key */
        $this->customize_key = ut_customizer_key();
        
        if( empty( $this->options ) ) {
            return;            
        }
    
    }
    
    /**
     *  
     *
     * @since     1.0.0
     * @version   1.0.0
     */
    public function customize_register( $wp_customize ) {
        
        $panel_priority = 1;
        
        if( empty( $this->options ) ) {
            return;
        }
        
        foreach ( $this->options as $value ) {
            
            $this->priority = $panel_priority;
            
            if( isset( $value['sections'] ) ) {
                
                $wp_customize->add_panel( $value['name'], array(
                  'title'       => $value['title'],
                  'priority'    => ( isset( $value['priority'] ) ) ? $value['priority'] : $panel_priority,
                  'description' => ( isset( $value['description'] ) ) ? $value['description'] : '',
                ));
                
                $this->add_section( $wp_customize, $value, $value['name'] );    
            
            } else {

                $this->add_section( $wp_customize, $value );
        
            }
            
            $panel_priority++;                     
        
        }
        
    
    }
    
    public function add_section( $wp_customize, $value, $panel = false ) {
                
        $section_priority = ( $panel ) ? 1 : $this->priority;
        $sections  = ( $panel ) ? $value['sections'] : array( 'sections' => $value );
        
        foreach ( $sections as $section ) {
        
            /* add section */
            $wp_customize->add_section( $section['name'], array(
                'title'       => $section['title'],
                'priority'    => ( isset( $section['priority'] ) ) ? $section['priority'] : $section_priority,
                'description' => ( isset( $section['description'] ) ) ? $section['description'] : '',
                'panel'       => ( $panel ) ? $panel : '',
            ) );
             
            $setting_priority = 1;
             
            foreach ( $section['settings'] as $setting ) {
                                
                $setting_name = $this->customize_key . '[' . $setting['name'] .']';
                
                /* add_setting */
                $wp_customize->add_setting( 
                    $setting_name,
                    wp_parse_args( $setting, array(
                        'type'              => 'option',
                        'capability'        => 'edit_theme_options',
                        'sanitize_callback' => '_ut_sanitize_text',
                        )
                    )                    
                );
                
                /* add_control */
                $control_args = wp_parse_args( $setting['control'], array(
                    'unique'    => $this->customize_key,
                    'section'   => $section['name'],
                    'settings'  => $setting_name,
                    'priority'  => $setting_priority
                ));  
                
                if( $control_args['type'] == 'ut_field' ) {
                    
                    $wp_customize->add_control( new WP_Customize_UT_Field_Control( $wp_customize, $setting['name'], $control_args ) );
                
                } else {
                                
                    $wp_controls = array( 'color', 'upload', 'image', 'media' ); // @todo - add framework options
                    $call_class  = 'WP_Customize_'. ucfirst( $control_args['type'] ) .'_Control';
                    
                    if( in_array( $control_args['type'], $wp_controls ) && class_exists( $call_class ) ) {
                        
                        $wp_customize->add_control( new $call_class( $wp_customize, $setting['name'], $control_args ) );
                        
                    } else {
                        
                        $wp_customize->add_control( $setting['name'], $control_args );
                    
                    }               
                
                }
                
                $setting_priority++;
                
            }

            $section_priority++;    
        
        }
    
    }    
    
}