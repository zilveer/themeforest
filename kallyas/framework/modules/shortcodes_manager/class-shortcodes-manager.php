<?php

class ZnHgTFw_Shortcode_Manager{
	function __construct(){
		// Add shortcode button after media button
		add_action( 'media_buttons', array( $this, 'addMediaButton' ), 999 );
	}

	function enqueueScripts(){
		// Load the css files
		wp_enqueue_style( 'znhgtfw-shortcode-mngr-css', FW_URL .'/assets/css/shortcodes.css', array(), ZN_FW_VERSION );
		wp_enqueue_style( 'znhg-options-machine' );

		// Load the main shortcodes Scripts
		wp_register_script( 'znhgtfw-shortcode-mngr-js', FW_URL .'/assets/js/dist/admin/shortcodes/shortcodes.min.js', array( 'backbone', 'jquery-ui-accordion', 'znhg-options-machine' ), ZN_FW_VERSION, true );

		// Finally enqueue the script
		wp_enqueue_script( 'znhgtfw-shortcode-mngr-js' );
	}


	/**
	 * Will add the shortcode button after insert media button
	 */
	function addMediaButton(){
		global $pagenow;
		if( $pagenow === 'post.php' || $pagenow === 'post-new.php' || ZNPB()->is_active_editor ) {
			// Only enqueue scripts if the button is added in page
			$this->enqueueScripts();
			echo '<span id="znhgtfw-shortcode-modal-open" title="Add shortcode" class="button"></span>';
		}
	}
}

new ZnHgTFw_Shortcode_Manager();