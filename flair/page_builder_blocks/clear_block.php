<?php

class AQ_Spacer_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Spacer',
			'size' => 'span12',
			'block_icon' => '<i class="icon-picons-cog"></i>',
			'block_description' => 'Use to add spacing<br />to your content.'
		);
		
		//create the block
		parent::__construct('aq_spacer_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'title' => '70',
			'line' => 0
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Spacer Height
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full', $type = 'number') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('line') ?>">
				Show Horizontal Line?<br/>
				<?php echo aq_field_checkbox('line', $block_id, $line) ?>
			</label>
		</p>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		if( $line == 0 ) :
	?>
		
		<div style="clear: both; width: 100%; height: <?php echo $title; ?>px;"></div>
	
	<?php	
		else : 
	?>
		
		<div style="clear: both; width: 100%; height: <?php echo round($title / 2); ?>px;"></div>
		<hr class="none" />
		<div style="clear: both; width: 100%; height: <?php echo round($title / 2); ?>px;"></div>
	
	<?php
		endif;	
	}//end block
	
}//end class