<?php

class TD_Divider_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Divider', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-arrows-v"></i>',
			'block_description' => __('Use to add spacing between sections or elements.', 'smartfood'),
			'block_category'    => 'layout',
			'resizable'         => false,
		);
		
		//create the block
		parent::__construct('td_divider_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '30px',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		echo td_field_input('text', $block_id, $text, $size = 'full');
		
	}// end form
	
	function block($instance) {
		extract($instance);

		echo do_shortcode('[tdp_spacing size="'.esc_attr($text).'"]');

	}//end block
	
}//end class