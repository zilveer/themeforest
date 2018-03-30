<?php

/*********** Shortcode: Spacer ************************************************************/

$tcvpb_elements['spacer_tc'] = array(
	'name' => esc_html__('Spacer', 'ABdev_aeron' ),
	'notice' => esc_html__('This shortcode will add additional vertical space between elements', 'ABdev_aeron'),
	'icon' => 'pi-spacer',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'type' => 'block',
	'attributes' => array(
		'pixels' => array(
			'default' => '15',
			'description' => esc_html__('Height in Pixels', 'ABdev_aeron'),
		),
		'responsive_hide_mobile' => array(
			'description' => esc_html__( 'Hide Spacer on Mobile Size', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
		),
		'responsive_hide_tablet' => array(
			'description' => esc_html__( 'Hide Spacer on Tablet Size', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
		),
	),
);
function tcvpb_spacer_tc_shortcode( $attributes ) {
    extract(shortcode_atts(tcvpb_extract_attributes('spacer_tc'), $attributes));

    $classes  = array('clear');
    if($responsive_hide_mobile){
    	$classes[] = 'spacer_responsive_hide_mobile';
    }
    if($responsive_hide_tablet){
    	$classes[] = 'spacer_responsive_hide_tablet';
    }

    $class_out = implode(' ', $classes);

    return '<span class="clear '.esc_attr($class_out).'" style="height:'.esc_attr($pixels).'px;display:block;"></span>';
}





