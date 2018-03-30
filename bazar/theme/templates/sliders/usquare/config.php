<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */                               

define( 'YIT_USQUARE_DIR', dirname(__FILE__) );
define( 'YIT_USQUARE_URL', YIT_THEME_SLIDERS_URL . '/' . $slider_type );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
	array(
        'type' => 'simple-text',
        'desc' => sprintf( __( 'Configure the slider in <a href="%s">uSquare Slider</a> page and then select below the slider to use for this slider.', 'yit' ), admin_url( 'admin.php?page=usquare' ) )
    ),
	array(
        'id' => 'slider_name', 
        'name' => __('Select the slider', 'yit'),        
        'desc' => __('Select the slider you want to show when you want to show this slider.', 'yit'),
        'type' => 'select',   
        'options' => yit_get_usquare_sliders()
    )
));

function yit_get_usquare_sliders() {
    global $wpdb;

    if ( ! yit_if_thereis_usquareslider() ) {
        return array();
    }
    
	$prefix = $wpdb->prefix;
	$usquares = $wpdb->get_results("SELECT * FROM " . $prefix . "usquare ORDER BY id");
    
	if (count($usquares) == 0) { return array(); }

	$sliders = array();
	foreach($usquares as $usquare) {
		$sliders[ $usquare->id ] = $usquare->name ? $usquare->name : 'usquare #' . $usquare->id . ' (untitled)';
	}
		
	return $sliders;
}  

function yit_if_thereis_usquareslider() {
    global $wpdb;
	
	$prefix = $wpdb->prefix;
    if ( $wpdb->get_var("show tables like '{$prefix}usquare'") ) {
        return true;
    }
    
    return false;
    
} 

yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'title-font',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Configure the title.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#aa620d' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .usquare_module_wrapper h2',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'paragraphs-font',
        'type' => 'typography',
        'name' => __( 'Paragraphs', 'yit' ),
        'desc' => __( 'Configure the paragraphs.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 11,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#676768' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .usquare_module_wrapper span, .slider-%s.slider .usquare_block_extended, .slider-%s.slider .usquare_block_extended .usquare_about',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    )
));              

// add the table for the importer of sample data
function yit_add_usquare_tables( $tables ) {
    global $wpdb;                                
    
    $tables[] = 'usquare';
    
    return $tables;    
}           
add_filter( 'yit_sample_data_tables', 'yit_add_usquare_tables' );