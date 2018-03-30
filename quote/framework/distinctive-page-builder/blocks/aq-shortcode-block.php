<?php
/** Shortcode block **/
class AQ_Shortcode_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Shortcode Block',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_shortcode_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'shortcode' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('shortcode') ?>">
				Shortcode
				<?php echo aq_field_textarea('shortcode', $block_id, $shortcode, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo do_shortcode(strip_tags($shortcode));
	}
	
}