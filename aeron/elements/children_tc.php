<?php

/*********** Shortcode: Children of page ************************************************************/

$tcvpb_elements['children_tc'] = array(
	'name' => esc_html__('Children of Page', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-children-of-page',
	'category' => esc_html__('Navigation', 'ABdev_aeron' ),
	'attributes' => array(
		'id' => array(
			'description' => esc_html__('Parent Page ID', 'ABdev_aeron'),
		),
		'depth' => array(
			'default' => '9',
			'description' => esc_html__('Depth', 'ABdev_aeron'),
		),
		'id_out' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	)
);
function tcvpb_children_tc_shortcode($attributes) {
	extract(shortcode_atts(tcvpb_extract_attributes('children_tc'), $attributes));
	$id = ($id == '')? get_the_ID() : $id;
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$children = wp_list_pages('title_li=&child_of='.esc_attr($id).'&echo=0&depth='.esc_attr($depth));
	if ($children)
		return '<ul '.esc_attr($id_out).' class="tcvpb_children '.esc_attr($class).'">'.$children.'</ul>'; 
	else
		return '';
}

