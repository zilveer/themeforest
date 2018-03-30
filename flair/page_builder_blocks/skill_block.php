<?php

class AQ_Skill_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Skill',
			'size' => 'span6',
			'block_icon' => '<i class="fa fa-font"></i>',
			'block_description' => 'Use to add Skill<br />text to the page.'
		);
		
		//create the block
		parent::__construct('aq_skill_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'percentage' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('percentage') ?>">
				Skill Percentage <code>Numeric Only, 0 - 100</code>
				<?php echo aq_field_input('percentage', $block_id, $percentage, $size = 'full', $type = 'number') ?>
			</label>
		</p>
		
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
	?>
	
		<div class="bars-wrapper">
			<div>
				<div class="pull-left"><?php echo $title; ?></div>
				<div class="pull-right"><?php echo (int) $percentage; ?>%</div>
				<div class="clearfix"></div>
			</div>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (int) $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (int) $percentage; ?>%"></div>
			</div>
		</div>
			
	<?php
	}//end block
	
}//end class