<?php
/* List Block */
if(!class_exists('Skill_Block')) {
	class Skill_Block extends AQ_Block {
	
		function __construct() {
			$accent = get_option('accent_colour');
			$block_options = array(
				'name' => 'Skill',
				'size' => 'span4',
				'skillvalue' => '',
				'title' => '',
				'desc' => '',
			);
			
			//create the widget
			parent::__construct('Skill_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_bar_add_new', array($this, 'add_bar'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
				'desc' => '',
				'skillbg_color' => '#00b29e',
			);

			$accent = get_option('accent_colour');
			$fgcolor = isset($fgcolor) ? $fgcolor : $accent;
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('desc') ?>">
					Description
					<?php echo aq_field_input('desc', $block_id, $desc, $size = 'full') ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('skillvalue') ?>">
					Percentage
					<?php echo aq_field_input('skillvalue', $block_id, $skillvalue, $size = 'full') ?>
				</label>
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('skillbg_color') ?>">
					Pick a Background colour for the percentage<br/>
					<?php echo aq_field_color_picker('skillbg_color', $block_id, $skillbg_color, $defaults['skillbg_color']) ?>
				</label>
			</div>

			<?php
		}
		
		function block($instance) {
			extract($instance);
			$output = '';
			$output .= '<div class="tile-progress tile-red bounce-in">';	
			$output .= '<div class="tile-header">';		
			$output .= ( !empty($title) ? '<h3>'.esc_attr($title).'</h3>' : '');
			$output .= ( !empty($desc) ? '<span>'.esc_attr($desc).'</span>' : '');
			$output .= '</div>';
			$output .= '<div class="tile-progressbar">';	
			$output .= '<span data-fill="'.$skillvalue.'%" style="width: '.$skillvalue.'%;"></span>';
			$output .= '</div>';
			$output .= '<div class="tile-footer" style="background: '.$skillbg_color.';">';
			$output .= '<h4><span class="pct-counter counter">'.$skillvalue.'</span>%</h4>';
			$output .= '</div>';
			$output .= '</div>';
				
			echo $output;
			
		}
		
		/* AJAX add bar */
		function add_bar() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the bar
			$bar = array(
				'title' => 'New Bar',
				'width' => '80',
			);
			
			if($count) {
				$this->bar($bar, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
