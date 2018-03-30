<?php
if(!class_exists('MET_Heading_Block')) {
	class MET_Heading_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Heading',
				'size' => 'span6',
			);

			parent::__construct('MET_Heading_Block', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'title' 	=> 'Im Heading!',
				'type' 		=> 'h1',
				'weight'	=> '0'
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$htypes = array('h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','h6'=>'h6');
			$weights = array('0' => 'Thin', '1' => 'Bold');
			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (required)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Heading Type<br/>
					<?php echo aq_field_select('type', $block_id, $htypes, $type) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('weight') ?>">
					Thin or Bold?<br/>
					<?php echo aq_field_select('weight', $block_id, $weights, $weight) ?>
				</label>
			</p>
		<?php

		}

		function block($instance) {
			extract($instance);
			echo '<'.$type.' '.(($weight == 1) ? 'class="met_bold_one"' : '').'>' . htmlspecialchars_decode($title) . '</'.$type.'>';
		}

	}
}