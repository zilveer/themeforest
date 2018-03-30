<?php
class TD_WYSIWYG_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('WYSIWYG Editor', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-fw"></i>',
			'block_description' => __('Use the editor to add custom content.', 'smartfood'),
			'block_category'    => 'text'
		);
		
		//create the block
		parent::__construct('td_wysiwyg_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'white_text' => 0
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		echo __('Click the button below here to display the editor.', 'smartfood') . '<br/><br/>';

		echo td_field_editor('text', $block_id, $text);

		echo "<br/><br/>";

		echo __('Set as white text ', 'smartfood');
		echo td_field_checkbox('white_text', $this->block_id, $white_text);
		
	}// end form
	
	function block($instance) {
		extract($instance);

		if($white_text):
			echo '<div class="white-text-wrapper">';
		endif;

		echo wpautop(do_shortcode(htmlspecialchars_decode($text)));

		if($white_text):
			echo '</div>';
		endif;

	}//end block
	
}//end class