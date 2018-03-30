<?php

class AQ_Ticker_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Ticker',
			'size' => 'span12',
			'block_icon' => '<i class="fa fa-font"></i>',
			'block_description' => 'Use to add Ticker<br />text to the page.'
		);
		
		//create the block
		parent::__construct('aq_ticker_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => ''
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
			<label for="<?php echo $this->get_field_id('text') ?>">
				Ticker Text, 1 per line <code>Add line return (return key) to create a new ticker.</code>
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full', true) ?>
			</label>
		</p>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
		
		$tickers = preg_split( '/\r\n|\r|\n/', $text );
		$output = false;
		
		foreach( $tickers as $ticker ){
			$output .= '"'. $ticker .'",';	
		}
		
		$output = rtrim($output, ",");
	?>
	
		<h1 class="like wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">
			
			<?php 
				if( $title )
					echo htmlspecialchars_decode($title) . '<br />';
			?>
				
		<span id="<?php echo $block_id; ?>" class="ticker"></span></h1>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#<?php echo $block_id; ?>.ticker").airport([ <?php echo $output; ?> ]);
			});
		</script>
			
	<?php
	}//end block
	
}//end class