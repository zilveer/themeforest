<?php
if(!class_exists('MET_Page_Header')) {
	class MET_Page_Header extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Page Header',
				'size' => 'span12',
				'resize' => 0
			);

			parent::__construct('MET_Page_Header', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'title' 		=> 'Im Page Header',
				'second_title'	=> ''
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

			<p class="description">
				<label for="<?php echo $this->get_field_id('second_title') ?>">
					Second Title (Optional)<br/>
					<?php echo aq_field_input('second_title', $block_id, $second_title) ?>
				</label>
			</p>
		<?php

		}

		function block($instance) {
			extract($instance);

			echo '
			<div class="row-fluid">
				<div class="span12">
					<div class="met_page_header met_bgcolor5 clearfix">
						<h1 class="met_bgcolor met_color2">'.htmlspecialchars_decode($title).'</h1>
						<h2 class="met_color2">'.htmlspecialchars_decode($second_title).'&nbsp;</h2>
					</div>
				</div>
			</div>';

		}

	}
}