<?php
/** Separator block 
 * 
 * Separate the floats vertically
 * Optional to use horizontal lines/images
**/
class AQ_Separator_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Separator',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_separator_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'height' => '5'
		);
		

		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#353535';
		
		?>
		<div class="description note">
			<?php _e('Use this block to clear the floats between two or more separate blocks vertically.', 'framework') ?>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height<br/>
				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
			</label>
			
		</div>

		<?php
		
	}
	
	function block($instance) {
		extract($instance);

				echo '<div class="cf" style="height: '.esc_attr($height).'px;margin-bottom: '.esc_attr($height).'px;"></div>';
	
		
	}
	
}