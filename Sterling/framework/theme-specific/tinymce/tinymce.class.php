<?php

class tt_tinymce
{	
	function __construct()
	{
		add_action('admin_enqueue_scripts', array( &$this, 'tt_head' ));
		add_action('init', array( &$this, 'tt_tinymce_rich_buttons' ));
		//add_action('admin_print_scripts', array( &$this, 'tt_quicktags' ));
	}
	
	// --------------------------------------------------------------------------
	
	function tt_head()
	{
		$current_screen = get_current_screen();
		if ( 'post' !== $current_screen->base )
			return;
			
		if ( ! post_type_supports( get_post_type(), 'editor' ) )
			return;
			
		// css
		wp_enqueue_style( 'tt-popup', TT_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable');
		wp_enqueue_script( 'jquery-livequery', TT_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', TT_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', TT_TINYMCE_URI . '/js/base64.js', false, '1.0', false );


		global $wp_version;
		if ( $wp_version >= 3.9 ) {
			wp_enqueue_script( 'tt-popup', TT_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
		} else {
			wp_enqueue_script( 'tt-popup', TT_TINYMCE_URI . '/js/popup-wp38.js', false, '1.0', false );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function tt_tinymce_rich_buttons()
	{
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array( &$this, 'tt_add_rich_plugins' ) );
			add_filter( 'mce_buttons', array( &$this, 'tt_register_rich_buttons' ) );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function tt_add_rich_plugins( $plugin_array )
	{
		global $wp_version;
		if ( $wp_version >= 3.9 ) {
			$plugin_array['ttShortcodes'] = TT_TINYMCE_URI . '/plugin.js';
		} else {
			$plugin_array['ttShortcodes'] = TT_TINYMCE_URI . '/plugin-wp38.js';
		}

		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function tt_register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'tt_button' );
		return $buttons;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Registers TinyMCE HTML editor quicktags buttons
	 *
	 * @return	void
	 */
	function tt_quicktags() {
		// wp_enqueue_script( 'tt_quicktags', TT_TINYMCE_URI . '/plugins/wizylabs_quicktags.js', array('quicktags') );
	}
}