<?php

class TD_Cta_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Call To Action', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-instagram fa-fw"></i>',
			'block_description' => __('Use to add a fullwidth call to action area.', 'smartfood'),
			'block_category'    => 'layout',
			'resizable'         => false
		);
		
		//create the block
		parent::__construct('td_cta_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'title'        => '',
			'subtitle'     => '',
			'button_label' => '',
			'button_url'   => '',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description"><?php _e('Title', 'smartfood');?></p>
		<?php echo td_field_input('title', $block_id, $title, $size = 'full') ?>

		<p class="description"><?php _e('Subtitle', 'smartfood');?></p>
		<?php echo td_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>

		<p class="description"><?php _e('Button Label', 'smartfood');?></p>
		<?php echo td_field_input('button_label', $block_id, $button_label, $size = 'full') ?>

		<p class="description"><?php _e('Button URL', 'smartfood');?></p>
		<?php echo td_field_input('button_url', $block_id, $button_url, $size = 'full') ?>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
	?>
	
	<div class="row clearfix">
		<div class="col-sm-6 col-xs-12 pull-left">
			<h3><?php echo htmlspecialchars_decode($title); ?></h3>
			<p><?php echo htmlspecialchars_decode($subtitle); ?></p>
		</div>
			
		<div class="col-sm-4 col-xs-12 pull-right text-right">
			<a href="<?php echo esc_url($button_url); ?>" class="btn-ghost"><?php echo htmlspecialchars_decode($button_label); ?></a>
		</div>
	</div>

	<div class="clearfix"></div>
	
	<?php		
	}//end block
	
}//end class