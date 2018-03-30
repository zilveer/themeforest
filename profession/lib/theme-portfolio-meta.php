<?php

include_once('post-meta.php');

class PortfolioPostMeta extends PostMeta
{
	public function __construct() 
	{
		parent::__construct('portfolio');
	}

	function GetMetaKeys()
	{
		return array('content_url',
					'portfolio_image_1' => array('type'=>'upload'),
					'portfolio_image_2' => array('type'=>'upload'),
					'portfolio_image_3' => array('type'=>'upload'),
					'portfolio_image_4' => array('type'=>'upload'),
					'portfolio_image_5' => array('type'=>'upload'),
					'portfolio_image_6' => array('type'=>'upload'),
					'portfolio_image_7' => array('type'=>'upload'),
					'portfolio_image_8' => array('type'=>'upload'),
					'portfolio_image_9' => array('type'=>'upload'),
					'portfolio_image_10' => array('type'=>'upload'),
					'video_server', 'video_id');
	}
	
	function px_register_scripts()
	{
		wp_enqueue_script('metabox', THEME_ADMIN_URI  .'/scripts/metabox.js', array('jquery'), '1');

		wp_enqueue_script('jquery-easing', THEME_JS_URI  .'/jquery.easing.1.3.js', array('jquery'), '1.3.0');
		
		wp_enqueue_style( 'nouislider', THEME_ADMIN_URI . '/css/nouislider.css', false, '2.1.4', 'screen' );
		wp_enqueue_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.min.js', array('jquery'), '2.1.4');
		
		wp_enqueue_style( 'colorpicker0', THEME_ADMIN_URI . '/css/colorpicker.css', false, '1.0.0', 'screen' );
		wp_enqueue_script('colorpicker0', THEME_ADMIN_URI  .'/scripts/colorpicker.js', array('jquery'), '1.0.0');
		
		wp_enqueue_style( 'chosen', THEME_ADMIN_URI . '/css/chosen.css', false, '1.0.0', 'screen' );
		wp_enqueue_script('chosen', THEME_ADMIN_URI  .'/scripts/chosen.jquery.min.js', array('jquery'), '1.0.0');
		
		wp_enqueue_style( 'theme-admin', THEME_ADMIN_URI . '/css/style.css', false, '1.0.0', 'screen' );
		wp_enqueue_script('theme-admin', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery'), '1.0.0');
	}
	
	
	// Add the Meta Box
	function AddMetabox() {
		add_meta_box(
			'portfolio_meta_box', // $id
			__('Portfolio Options', TEXTDOMAIN), // $title 
			array(&$this, 'ShowMetabox'), // $callback
			'portfolio', // $page
			'normal', // $context
			'high'); // $priority
	}
}

new PortfolioPostMeta();