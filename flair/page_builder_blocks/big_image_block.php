<?php

class AQ_Big_Image_Block extends AQ_Block {
	
	function __construct() {
		$block_options = array(
			'name' => 'Big Image',
			'size' => 'span12',
			'block_icon' => '<i class="fa fa-camera"></i>',
			'block_description' => 'Use to add an Image<br />block to the page.',
			'resizable' => false
		);
		parent::__construct('aq_big_image_block', $block_options);
	}
	
	function form($instance) {
		$defaults = array();
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Upload Image (Required)
				<?php echo aq_field_upload('title', $block_id, $title, $media_type = 'image') ?>
			</label>
		</p>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
		
		echo '<section id="big_image" style="background-image: url(' . $title . ');"> </section>';

	}//end block
	
}//end class