<?php

class TD_Image_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Image Section', 'smartfood'),
			'size'              => 'span6',
			'block_icon'        => '<i class="fa fa-font fa-text-width"></i>',
			'block_description' => __('Use to add an image section, generally used on the homepage.', 'smartfood'),
			'block_category'    => 'layout',
		);
		
		//create the block
		parent::__construct('td_image_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'image_1' => '',
			'image_2' => '',
			'image_3' => '',
			'image_4' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
			
		echo __('Image 1', 'smartfood');
		echo td_field_upload('image_1', $this->block_id, $image_1, $media_type = 'image');
		echo "<br/><br/>";

		echo __('Image 2', 'smartfood');
		echo td_field_upload('image_2', $this->block_id, $image_2, $media_type = 'image');
		echo "<br/><br/>";

		echo __('Image 3', 'smartfood');
		echo td_field_upload('image_3', $this->block_id, $image_3, $media_type = 'image');
		echo "<br/><br/>";

		echo __('Image 4', 'smartfood');
		echo td_field_upload('image_4', $this->block_id, $image_4, $media_type = 'image');
		echo "<br/><br/>";
		
	}// end form
	
	function block($instance) {
		extract($instance);

		echo '<div class="tdp-column tdp-one-half tdp-column-first tdp-all">';
			echo '<img src="'.esc_url($image_1).'"/>';
		echo '</div>';

		echo '<div class="tdp-column tdp-one-half tdp-column-last tdp-all">';
			echo '<img src="'.esc_url($image_2).'"/>';
		echo '</div>';

		echo '<div class="tdp-column tdp-one-half tdp-column-first tdp-all">';
			echo '<img src="'.esc_url($image_3).'"/>';
		echo '</div>';

		echo '<div class="tdp-column tdp-one-half tdp-column-last tdp-all">';
			echo '<img src="'.esc_url($image_4).'"/>';
		echo '</div>';

	}//end block
	
}//end class