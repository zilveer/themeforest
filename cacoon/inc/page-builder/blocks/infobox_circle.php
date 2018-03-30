<?php
class MET_Info_Box_Circle extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'InfoBox Circle',
			'size' => 'span3',
			'resize' => 0
		);

		parent::__construct('MET_Info_Box_Circle', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'title'			=> '',
			'title_icon'	=> '',
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
			<label for="<?php echo $this->get_field_id('title_icon') ?>">
				Title Icon (<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Icon List</a> )
				<?php echo aq_field_input('title_icon', $block_id, $title_icon, $size = 'full icon_chose_input') ?>
			</label>
		</p>
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

		$text = do_shortcode(htmlspecialchars_decode($text));

		$result = '
		<div class="row-fluid scrolled">
			<div class="span12 scrolled__item">
				<div class="met_ball_wrap">
					<p class="met_ball">
						<span class="met_ball_border"></span>
						<span class="met_icon_ball"></span>
						<span class="met_icon_ball_small"></span>
						<i class="'.$title_icon.'"></i>
					</p>
				</div>
				<h3 class="met_ball_title">'.$title.'</h3>
				<p class="met_ball_text">'.$text.'</p>
			</div>
		</div>';
		echo $result;
	}

}