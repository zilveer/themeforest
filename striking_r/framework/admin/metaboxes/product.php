<?php 
class Theme_Metabox_Product extends Theme_Metabox {
	public $slug = 'product';
	public function config(){
		return array(
			'title' => sprintf(__('Image Hover Effect Options','theme_admin'),THEME_NAME),
			'post_types' => array('product'),
			'callback' => '',
			'context' => 'side',
			'priority' => 'low',
		);
	}
	public function options(){
		return array(
			array(
				"name" => __("Hover effect on <strong>Overview Pages</strong>",'theme_admin'),
				"desc" => __("On the catalogue page, one can employ some hover effects for the image. &nbsp;Choose from the dropdown list below the desired effect.",'theme_admin'),
				"id" => "_product_hover",
				"default" => '',
				"type" => "select",
				"options" => array(
					"false" => __('No hover effect','theme_admin'),
					"true" => __('Yes - show first gallery image on hover','theme_admin'),
					"zoom" => __("Zoom",'theme_admin'),
					"rotate" => __("Rotate",'theme_admin'),
				),
			),
		);
	}
}