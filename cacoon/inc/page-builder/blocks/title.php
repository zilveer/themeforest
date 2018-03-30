<?php
if(!class_exists('MET_Title_Block')) {
	class MET_Title_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Header w/ Icon',
				'size' => 'span6',
			);

			parent::__construct('met_title_block', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'icon' => '',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (required)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<?php include_once get_template_directory()."/inc/page-builder/icon_choser.php"; ?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('icon') ?>">
					Icon (required)<br/>
					<?php echo aq_field_input('icon', $block_id, $icon, 'full icon_chose_input') ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('style') ?>">
					Additional inline css styling (optional)<br/>
					<?php echo aq_field_input('style', $block_id, $style) ?>
				</label>
			</p>
		<?php

		}

		function block($instance) {
			extract($instance);

			echo '<div class="title" style="'. $style .'"><div class="'.$icon.'"></div>' . do_shortcode(htmlspecialchars_decode($title)) . '</div>';

		}

	}
}