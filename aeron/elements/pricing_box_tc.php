<?php

/*********** Shortcode: Price Box ************************************************************/

$tcvpb_elements['pricing_box_tc'] = array(
	'name' => esc_html__('Pricing box', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-pricing-box',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'child' => 'pricing_feature_tc',
	'child_title' => esc_html__('List', 'ABdev_aeron'),
	'child_button' => esc_html__('Add List', 'ABdev_aeron'),
	'attributes' => array(
		'style' => array(
			'default' => '1',
			'type' => 'select',
			'values' => array(
				'1' => esc_html__('Style 1', 'ABdev_aeron'),
				'2' => esc_html__('Style 2', 'ABdev_aeron'),
			),
			'description' => esc_html__('Style', 'ABdev_aeron'),
		),
		'name' => array(
			'description' => esc_html__('Title', 'ABdev_aeron'),
		),
		'featured_text' => array(
			'description' => esc_html__('Featured Text', 'ABdev_aeron'),
			'info' => esc_html__('Displays an eye catching badge above box. e.g: Most Popular', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'currency' => array(
			'description' => esc_html__('Currency Sign', 'ABdev_aeron'),
		),
		'price' => array(
			'description' => esc_html__('Price', 'ABdev_aeron'),
		),
		'monthly' => array(
			'description' => esc_html__('Interval', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'decsription' => array(
			'description' => esc_html__('Decsription', 'ABdev_aeron'),
		),
		'link' => array(
			'description' => esc_html__('Box Link', 'ABdev_aeron'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__( 'Target', 'ABdev_aeron' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_aeron' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_aeron' ),
			),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);
function tcvpb_pricing_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('pricing_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$featured_output=($featured_text!='')?' tcvpb_popular-plan':'';
	$decsription_output=($decsription!='')?'<span class="tcvpb_pricebox_decsription">'.$decsription.'</span>':'';
	$featured_text_output=($featured_text!='')?'<div class="tcvpb_pricebox_featured_text">'.$featured_text.'</div>':'';

	$link_output = ($link != '')?'<a href="'.esc_url($link).'" class="tcvpb_pricebox_link"></a>':'';
	$link_class_output = ($link != '')?'with_link':'';

	static $count_priceboxes;
	$count_priceboxes++;
	return '
	<div '.esc_attr($id_out).' class="tcvpb_pricing-table-'.$style.' '.$link_class_output.'">
		<div class="tcvpb_plan tcvpb_plan'.$count_priceboxes.$featured_output.'">
			'.$featured_text_output.'
			<div class="tcvpb_pricebox_header">
				<span class="tcvpb_pricebox_name">'.$name.'</span>
				<span class="tcvpb_pricebox_currency">'.$currency.'</span>
				<span class="tcvpb_pricebox_price">'.$price.'</span>
				<span class="tcvpb_pricebox_monthly">'.$monthly.'</span>
				'.$decsription_output.'
			</div>
			'.do_shortcode($content).' 
			'.$link_output.'          
		</div>
	</div>';
}

$tcvpb_elements['pricing_feature_tc'] = array(
	'name' => esc_html__('List', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Feature', 'ABdev_aeron'),
		),
		'value' => array(
			'description' => esc_html__('Value', 'ABdev_aeron'),
		),
		'list_icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'ABdev_aeron'),
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'ABdev_aeron'),
			'type' => 'color',
		),
	),
);
function tcvpb_pricing_feature_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('pricing_feature_tc'), $attributes));
	$list_icon_output = ($list_icon!='')?'<i class="'.esc_attr($list_icon).'" style="color:'.esc_attr($icon_color).';"></i>':'';
	return '<span class="tcvpb_pricebox_feature">'.$list_icon_output.'<strong>'.esc_attr($value).'</strong> '.esc_attr($name).'</span>';
}