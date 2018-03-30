<?php
if(!class_exists('MET_Page_Header_Two')) {
	class MET_Page_Header_Two extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Page Header 2',
				'size' => 'span12',
				'resize' => 0
			);

			parent::__construct('MET_Page_Header_Two', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'title' 		=> 'Im Page Header',
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
		<?php

		}

		function block($instance) {
			extract($instance);

			echo '
			<div class="row-fluid">
				<div class="span12">
					<div class="met_page_heading">'.htmlspecialchars_decode($title).'</div>
				</div>
			</div>';

		}

	}
}