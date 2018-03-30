<?php

class AQ_Image_Block extends AQ_Block {
	
	function __construct() {
		$block_options = array(
			'name' => 'Image',
			'size' => 'span6',
			'block_icon' => '<i class="fa fa-camera"></i>',
			'block_description' => 'Use to add an Image<br />block to the page.'
		);
		parent::__construct('aq_image_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'link' => '',
			'image' => '',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Upload Image (Required)
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link Image? Enter URL here.
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
	?>
	
		<?php if( $link ) : ?>
			<a href="<?php echo esc_url($link); ?>">
		<?php endif; ?>
		
			<img src="<?php echo $image; ?>" alt="<?php echo $block_id; ?>" />
		
		<?php if( $link ) : ?>
			</a>
		<?php endif; ?>
		
	<?php
	}//end block
	
}//end class