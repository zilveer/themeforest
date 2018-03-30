<?php

class TD_Food_Section_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Food Section', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-cutlery"></i>',
			'block_description' => __('Use to add a fullwidth food menu section with image.', 'smartfood'),
			'block_category'    => 'layout',
			'resizable'         => false,
		);
		
		//create the block
		parent::__construct('td_food_section_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title'          => '',
			'image'          => '',
			'image_side'     => '',
			'shortcode'      => '',
			'shortcode_type' => '',
			'move_image'     => 0
		);

		$side_options = array(
			'left'  => __('left', 'smartfood'),
			'right' => __('right', 'smartfood'),
		);

		$shortcode_type_options = array(
			'full'     => __('Full Food Menu', 'smartfood'),
			'category' => __('Food Category', 'smartfood'),
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
			
		echo __('Title', 'smartfood');
		echo td_field_input('title', $block_id, $title, $size = 'full');
		echo "<br/><br/>";

		echo __('Upload an image that will be used as background', 'smartfood');echo "<br/>";
		echo td_field_upload('image', $this->block_id, $image, $media_type = 'image');
		echo "<br/><br/>";

		echo __('Select which side the image should be displayed', 'smartfood');
		echo td_field_select('image_side', $this->block_id, $side_options, $image_side);
		echo "<br/><br/>";

		echo __('Select which menu should be displayed', 'smartfood');
		echo td_field_select('shortcode_type', $this->block_id, $shortcode_type_options, $shortcode_type);
		echo "<br/><br/>";

		echo __('Enter the food menu category you wish to display', 'smartfood');
		echo td_field_input('shortcode', $block_id, $shortcode, $size = 'full');

		echo __('Stretch Image to side container?', 'smartfood');
		echo td_field_checkbox('move_image', $this->block_id, $move_image);
		echo "<br/><br/>";

		
	}// end form
	
	function block($instance) {
		extract($instance);


		$stretch_image = null;

		if(isset($move_image) && $move_image) {
			$stretch_image = true;
		} else {
			$stretch_image = false;
		}

		if($image_side == 'right') {
			
			echo '<section class="side-image text-heavy clearfix food-section-side-image '.esc_attr( $image_side ).'">
					<div class="image-container col-md-5 col-sm-3 pull-right">';
						
						if($stretch_image) {
							echo '<div class="background-image-holder" style="background-image:url('.esc_url($image).')"></div>';
						} else {
							echo '<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. esc_url($image) .'">
						</div>';
						}

					echo '</div>
					<div class="container">
					 <div class="row">
						      <div class="col-md-6 content col-sm-8 clearfix">
						    	  <div class="row">';
						    	  if($shortcode_type == 'full') : 
						    	  	echo do_shortcode( '[wprm_menu category_title="true" category_description="true" hyperlink="true" description="true" price="true" display_images="true"]' );
						    	  else :
						    	  	echo do_shortcode( '[wprm_menu_category category_slug="'.esc_attr($shortcode).'" category_title="true" category_description="true" hyperlink="true" description="true" price="true" display_images="true"]');
						    	  endif;
						    	  echo '</div>
						      </div>
						  </div>
				      </div></section>';
		} else {

			echo '<section class="side-image text-heavy clearfix food-section-side-image '.esc_attr( $image_side ).'">
					<div class="image-container col-md-5 col-sm-3 pull-left">';
						
						if($stretch_image) {
							echo '<div class="background-image-holder" style="background-image:url('.esc_url($image).')"></div>';
						} else {
							echo '<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. esc_url($image) .'">
						</div>';
						}
						
					echo '</div>
					<div class="container">
						<div class="row">
						    <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 content clearfix">
						    	<div class="row">';
						    		if($shortcode_type == 'full') : 
						    	  	echo do_shortcode( '[wprm_menu category_title="true" category_description="true" hyperlink="true" description="true" price="true" display_images="true"]' );
						    	  else :
						    	  	echo do_shortcode( '[wprm_menu_category category_slug="'.esc_attr($shortcode).'" category_title="true" category_description="true" hyperlink="true" description="true" price="true" display_images="true"]');
						    	  endif;
						    	echo '</div>
						    </div>
						</div>
				    </div>
				   </section>';

		}

	}//end block
	
}//end class