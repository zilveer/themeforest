<?php
/* Registered Sidebars Blocks */
class CF7_Block extends AQ_Block {
	
	function __construct() {
		$block_options = array(
			'name' => 'Contact Form 7',
			'size' => 'span6',
		);
		
		parent::__construct('CF7_Block', $block_options);
	}
	
	function form($instance) {
		
	
		$instance = wp_parse_args($instance);
		$contactform = '';
		extract($instance);
		$url = plugins_url();
		$cf7 = $url .'contact-form-7/wp-contact-form-7.php';
		if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) { ?>
		<p class="description half">
			<label for="<?php echo $block_id ?>_title">
				Title (optional)<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description half last">
			<label for="">
				Choose widget area<br/>
				<?php echo aq_cf7_select('contactform', $block_id, $contactform); ?>
			</label>
		</p>
		<?php } else {
			echo 'You Need To Install Contact Form 7 to use this block';
		}
	}
	
	function block($instance) {
		extract($instance);

		if(!empty($title)) {
			echo '<h3>'.$title.'</h3>';
		}
		echo do_shortcode('[contact-form-7 id="'.$contactform.'"]');

	}
	
}