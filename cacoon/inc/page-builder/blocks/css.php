<?php
class MET_CSS_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'CSS',
			'size' => 'span12'
		);

		parent::__construct('MET_CSS_Block', $block_options);
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
				CSS Codes
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		echo '<style type="text/css">'.$text.'</style>';
	}

}