<?php
/* List Block */
if(!class_exists('Counter_Block')) {
	class Counter_Block extends AQ_Block {
	
		function __construct() {
			$accent = get_option('accent_colour');
			$block_options = array(
				'name' => 'Counter',
				'size' => 'span4',
				'skillvalue' => '',
				'icon' => '',
			);
			
			//create the widget
			parent::__construct('Counter_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_bar_add_new', array($this, 'add_bar'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
			);

			$accent = get_option('accent_colour');
			$fgcolor = isset($fgcolor) ? $fgcolor : $accent;
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<p class="description" id="service-icon">
				<label for="<?php echo $this->get_field_id('icon') ?>">
					Select Icon
					<?php $themeurl = get_template_directory_uri(); ?>
					<?php echo aq_field_input('icon', $block_id, $icon) ?>
					<a href="#TB_inline?width=600&height=550&inlineId=icon-selector" class="thickbox">View Icons</a>
				</label>
			</p>

			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('skillvalue') ?>">
					Number
					<?php echo aq_field_input('skillvalue', $block_id, $skillvalue, $size = 'full') ?>
				</label>
			</div>

			<?php
		}

		function block($instance) {
			extract($instance); ?>

			<div class="centered bounce-inr">
		        <span class="stat-icon"><?php if (strpos($icon,'fa-') !== false) { ?><i class="fa <?php echo $icon; ?> bounce-in"></i><?php } else { ?><span class="bounce-in <?php echo $icon; ?>"></span><?php } ?></span>
		        <h1><span class="counter"><?php echo $skillvalue; ?></span></h1>
		        <?php if(!empty($title)) { ?><h3><?php echo esc_attr($title); ?></h3><?php } ?>
		    </div>
			
		<?php }
		
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
