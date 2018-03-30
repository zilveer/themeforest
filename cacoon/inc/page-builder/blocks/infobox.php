<?php
class MET_Info_Box extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'InfoBox (Icon)',
			'size' => 'span6'
		);

		parent::__construct('MET_Info_Box', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'title'			=> '',
			'title_icon'	=> '',
			'title_color'	=> '#65676F',
			'text' 			=> ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title_color') ?>">
				Title Color
				<?php echo aq_field_color_picker('title_color', $block_id, $title_color, '#65676F') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title_icon') ?>">
				Title Icon (<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Icon List</a> )
				<?php echo aq_field_input('title_icon', $block_id, $title_icon, $size = 'full icon_chose_input') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full met_ckeditor') ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		$text = do_shortcode(htmlspecialchars_decode($text));
		if(!isset($title_color)) $title_color = '#65676F';
?>
		<div class="row-fluid">
			<div class="span12">
				<article class="met_service_box clearfix">
					<h2 class="met_bold_one" style="color: <?php echo $title_color ?>"><?php echo $title ?></h2>
					<div><i class="<?php echo $title_icon ?>"></i></div>
					<p><?php echo htmlspecialchars_decode($text) ?></p>
				</article>
			</div>
		</div>
<?php
	}

}