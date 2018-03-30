<?php
add_action('add_meta_boxes', 'az_metabox_transparent_header');

function az_metabox_transparent_header(){
    
/*-----------------------------------------------------------------------------------*/
/*	Transparent Header Setting Meta
/*-----------------------------------------------------------------------------------*/

$post_types = array( 'page', 'post', 'portfolio', 'team', 'product');

$meta_box = array(
	'id' => 'az-transparent-header',
	'title' => __('Transparent Header Settings', AZ_THEME_NAME),
	'description' => __('Here you can configure the transparent header.', AZ_THEME_NAME),
	'post_type' => $post_types,
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Transparent Header Settings', AZ_THEME_NAME),
			'desc' => __('Enable or Disable Transparent Header.', AZ_THEME_NAME),
			'id' => '_az_transparent_header_settings',
			'type' => 'select',
			'std' => 'disabled',
			'options' => array(
				"enabled" => "Enabled",
				"disabled" => "Disabled"
			)
		),

		array( 
			'name' => __('Transparent Header Color Settings', AZ_THEME_NAME),
			'desc' => __('Select the color of logo and menu when the header is transparent.', AZ_THEME_NAME),
			'id' => '_az_transparent_header_color_settings',
			'type' => 'select',
			'std' => 'white-color',
			'options' => array(
				"white-color" => "White Color",
				"default-color" => "Default Color"
			)
		)
	)
);
$callback = create_function( '$post,$meta_box', 'az_create_meta_box( $post, $meta_box["args"] );' );

foreach( $post_types as $post_type) {
    add_meta_box(
        $meta_box['id'],
		$meta_box['title'],
		$callback,
		$post_type,
        $meta_box['context'],
		$meta_box['priority'],
		$meta_box
    );
}
}
?>