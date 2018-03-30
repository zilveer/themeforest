<?php
class MET_HTML_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'HTML',
			'size' => 'span6'
		);

		parent::__construct('MET_HTML_Block', $block_options);
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
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		$text = str_replace('%permalink%',get_permalink(),$text);
		echo '<div class="row-fluid"><div class="span12">'.do_shortcode(htmlspecialchars_decode($text)).'</div></div>';
	}

}