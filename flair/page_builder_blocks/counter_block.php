<?php

class AQ_Counter_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Counter',
			'size' => 'span4',
			'block_icon' => '<i class="fa fa-font"></i>',
			'block_description' => 'Use to add a counter<br />to the page.'
		);
		
		//create the block
		parent::__construct('aq_counter_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'from' => '0',
			'to' => '1400'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('from') ?>">
				From number <code>Numeric Only</code>
				<?php echo aq_field_input('from', $block_id, $from, $size = 'full', $type = 'number') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('to') ?>">
				To number <code>Numeric Only</code>
				<?php echo aq_field_input('to', $block_id, $to, $size = 'full', $type = 'number') ?>
			</label>
		</p>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
		
		$unique = wp_rand(0,10000);
	?>
	
		<div class="text-center">
			<div class="counter wow bounceIn" data-wow-offset="80" data-wow-duration="2s">
				<div id="counter-<?php echo $unique; ?>"><?php echo (int) $from; ?></div>
				<?php 
					if( $title )
						echo '<p class="light">'. htmlspecialchars_decode($title) .'</p>';
				?>
			</div>	
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				jQuery('#counter-<?php echo $unique; ?>').appear(function() {
					jQuery('#counter-<?php echo $unique; ?>').countTo({
						from: <?php echo (int) $from; ?>,
						to: <?php echo (int) $to; ?>,
						speed: 4000,
						refreshInterval: 50,
						onComplete: function(value) { 
						//console.debug(this); 
						}
					});
				});
					
			});
		</script>
			
	<?php
	}//end block
	
}//end class