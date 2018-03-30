<?php

class TD_Section_Title_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Section Title', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-text-width"></i>',
			'block_description' => __('Use to add important titles to your sections.', 'smartfood'),
			'block_category'    => 'text',
			'resizable'         => false,
		);
		
		//create the block
		parent::__construct('td_section_title_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'subtitle' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
			
		echo __('Title', 'smartfood');
		echo td_field_input('title', $block_id, $title, $size = 'full');
		echo "<br/><br/>";
		echo __('Sub Title (optional)', 'smartfood');
		echo td_field_input('subtitle', $block_id, $subtitle, $size = 'full');
		
	}// end form
	
	function block($instance) {
		extract($instance);

		echo '<h2>'.esc_attr( $title ).'</h2>';
		echo '<h3>'.esc_attr( $subtitle ).'</h3>';

	}//end block
	
}//end class