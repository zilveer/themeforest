<?php

class TD_Embed_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Embed Media', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-text-width"></i>',
			'block_description' => __('Use to add embeddable media into your pages content.', 'smartfood'),
			'block_category'    => 'text',
		);
		
		//create the block
		parent::__construct('td_embed_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'url' => '',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
			
		echo __('URL', 'smartfood');
		echo td_field_input('url', $block_id, $url, $size = 'full');
		echo "<br/><br/>";
		echo '<p class="description">' . sprintf(__('Supported media can be found <a href="%s" target="_blank">here</a>', 'smartfood'), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ) . '</p>';
		
	}// end form
	
	function block($instance) {
		extract($instance);

		echo apply_filters('the_content', esc_url( $url ));

	}//end block
	
}//end class