<?php
class MET_LayerSlider extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'LayerSlider',
			'size' => 'span6'
		);

		parent::__construct('MET_LayerSlider', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'text' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				LayerSlider Shortcode
				<?php echo aq_field_input('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		echo '<div style="margin-top:-40px">'.do_shortcode(htmlspecialchars_decode($text)).'</div>';
	}

}