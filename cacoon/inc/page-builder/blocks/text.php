<?php
/** A simple text block **/
class MET_Text_Block extends AQ_Block {

	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text',
			'size' => 'span6'
		);

		//create the block
		parent::__construct('MET_Text_Block', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'text' 			=> '',
			'font_size' 	=> '14px',
			'line_height' 	=> '21px',
			'text_color'	=> '#65676F',
			'background'	=> '#F1F4F7',
			'padding'		=> 30
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);


		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Text
				<?php echo aq_field_textarea('text', $block_id, $text,'full met_ckeditor') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('font_size') ?>">
				Font Size
				<?php echo aq_field_input('font_size', $block_id, $font_size) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('line_height') ?>">
				Line Height
				<?php echo aq_field_input('line_height', $block_id, $line_height) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text_color') ?>">
				Text Color
				<?php echo aq_field_color_picker('text_color', $block_id, $text_color, '#65676F') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('background') ?>">
				Background Color
				<?php echo aq_field_color_picker('background', $block_id, $background, '#F1F4F7') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('padding') ?>">
				Box Padding (Pixels)
				<?php echo aq_field_input('padding', $block_id, $padding) ?>
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
				<div class="met_text_block" style="font-size:<?php echo $font_size ?>;line-height:<?php echo $line_height ?>;background-color:<?php echo $background ?>!important;color:<?php echo $text_color ?>!important;padding: <?php echo $padding ?>"><?php echo do_shortcode(htmlspecialchars_decode($text)) ?> <div class="clearfix"></div></div>
			</div>
		</div>
<?php
	}

}