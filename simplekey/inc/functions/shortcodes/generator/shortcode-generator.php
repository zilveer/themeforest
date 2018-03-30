<?php

/* ---------------*/
	function vanshortcodes_register( $plugin_array )
	{
		$url =  get_template_directory_uri().'/inc/functions/shortcodes/generator/shortcode-generator.js';
	 
		$plugin_array['vanshortcodes'] = $url;
		
		return $plugin_array;
	}
	
	function vanshortcodes_add_button( $buttons )
	{
		array_push( $buttons, 'separator', 'vanshortcodes' );
		
		return $buttons;
	}

	
	add_filter( 'mce_external_plugins', 'vanshortcodes_register' );
	add_filter( 'mce_buttons', 'vanshortcodes_add_button', 0 );
?>