<?php
class MET_RichText_Block extends AQ_Block {

	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Rich Text',
			'size' => 'span6'
		);

		//create the block
		parent::__construct('MET_RichText_Block', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'text' 			=> ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Text
				<?php echo aq_field_textarea('text', $block_id, $text) ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		if(!empty($padding) OR !isset($padding)){
			$padding = 30;
		}
?>
		<div class="row-fluid">
			<div class="span12">
				<div class="met_text_block" style="font-size:<?php echo $font_size ?>;line-height:<?php echo $line_height ?>;background-color:<?php echo $background ?>!important;color:<?php echo $text_color ?>!important;padding: <?php echo $padding ?>"><?php echo do_shortcode(htmlspecialchars_decode($text)) ?></div>
			</div>
		</div>
<?php
	}

}