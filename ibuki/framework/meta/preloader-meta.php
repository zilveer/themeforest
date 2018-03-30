<?php
add_action('add_meta_boxes', 'az_metabox_preloader');

function az_metabox_preloader(){
    
/*-----------------------------------------------------------------------------------*/
/*	Prealoder Setting Meta
/*-----------------------------------------------------------------------------------*/

$post_types = array( 'page', 'post', 'portfolio', 'team', 'product');

$meta_box = array(
	'id' => 'az-metabox-preloader',
	'title' => __('Prealoder Settings', AZ_THEME_NAME),
	'description' => __('Here you can configure how you want a preloader.', AZ_THEME_NAME),
	'post_type' => $post_types,
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Prealoder Settings', AZ_THEME_NAME),
			'desc' => __('Enable or Disable Prealoader.', AZ_THEME_NAME),
			'id' => '_az_preloader_settings',
			'type' => 'select',
			'std' => 'disabled',
			'options' => array(
				"enabled" => "Enabled",
				"disabled" => "Disabled"
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