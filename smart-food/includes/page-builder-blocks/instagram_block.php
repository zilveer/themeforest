<?php

class TD_Instagram_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Instagram', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-instagram fa-fw"></i>',
			'block_description' => __('Use to add a feed of recent instagram images.', 'smartfood'),
			'block_category'    => 'social',
			'resizable'         => false
		);
		
		//create the block
		parent::__construct('td_instagram_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'title' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description"><?php _e('Instagram Username', 'smartfood');?></p>
		<?php echo td_field_input('title', $block_id, $title, $size = 'full') ?>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
	?>
	
		
		<div class="instagram-feed">
			<div class="instafeed" data-user-name="<?php echo esc_attr($title); ?>">
				<ul></ul>
			</div>
		</div>
	
	<?php		
	}//end block
	
}//end class