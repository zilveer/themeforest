<?php

class AQ_Chart_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Pie Chart',
			'size' => 'span4',
			'block_icon' => '<i class="fa fa-font"></i>',
			'block_description' => 'Use to add Ticker<br />text to the page.'
		);
		
		//create the block
		parent::__construct('aq_chart_block', $block_options);
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
				Title (optional)
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
		
		$unique = wp_rand(0,10000);
	?>
	
		<div class="text-center pie wow bounceIn" data-wow-delay="1s">
			<span class="chart chart-<?php echo $unique; ?>">
				<span class="percent"><?php echo (int) $percentage; ?>%</span>
			</span>
			<?php
				if( $title )
					echo '<p class="center">'. htmlspecialchars_decode($title) .'</p>';
			?>
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.chart-<?php echo $unique; ?>').appear(function() {
					jQuery('.chart-<?php echo $unique; ?>').easyPieChart({
						animate: 1500, barColor:"#eee", trackColor:false, scaleColor:false, lineWidth:"14",
					});
					setTimeout(function() {
						jQuery('.chart-<?php echo $unique; ?>').data('easyPieChart').update(<?php echo (int) $percentage; ?>);
					}, 80);
				});
			});
		</script>
			
	<?php
	}//end block
	
}//end class