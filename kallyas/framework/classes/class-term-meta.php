<?php if(! defined('ABSPATH')){ return; }

/**
*
*/
class ZnTermMeta
{
	// Container metaboxes locations
	var $term_options = array();

	function __construct()
	{

		if(basename( $_SERVER['PHP_SELF']) == "edit-tags.php"
		|| basename( $_SERVER['PHP_SELF']) == "term.php")
		{

			// We need to have access to the taxonomy slug
			if ( isset( $_REQUEST['taxonomy'] ) && $_REQUEST['taxonomy'] !== '' ) {
				$taxonomy = sanitize_text_field( $_REQUEST['taxonomy'] );
				add_action(  $taxonomy . '_edit_form', array(&$this, 'zn_init_options'), 41, 2 );
				add_action(  $taxonomy . '_add_form_fields', array(&$this, 'zn_init_options'), 41, 2 );

				add_action( 'edited_'.$taxonomy, array(&$this, 'save_options') , 10 );
			}

		}

		add_action( 'create_term', array(&$this, 'save_options') , 10 );

	}

	function load_metaboxes_config(){

		$zn_term_meta = array();
		if ( file_exists(THEME_BASE.'/template_helpers/termmeta/termoptions.php') ){
			include( THEME_BASE.'/template_helpers/termmeta/termoptions.php');
		}

		$this->term_options = apply_filters( 'zn_termmeta_elements' , $zn_term_meta );

	}

	function zn_init_options( $tag, $taxonomy = false )
	{

		// On edit-tags.php screen we receive the taxonomy as first parameter
		if( is_string( $tag ) && ! $taxonomy && basename( $_SERVER['PHP_SELF']) == "edit-tags.php" ){
			$taxonomy = $tag;
		}

		$this->load_metaboxes_config();

		if( ! is_array( $this->term_options ) ){
			return;
		}

		$output = '';

		foreach( $this->term_options as $key => $type)
		{

			$tax_slug = is_object($tag) ? $tag->slug : $tag;

			// Render the options
			$output .= ZN()->html()->zn_render_meta_start( $tax_slug );

			if ( !empty( $this->term_options ) ) {
				foreach ($this->term_options as $option_arags ) {
					if ( in_array( $taxonomy, $option_arags['taxonomy'] ) ){
						if ( method_exists( ZN()->html(), $option_arags['type'] ) ) {

							$saved_value = '';

							if(isset($tag->term_id)){
								$saved_value = get_term_meta( $tag->term_id, $option_arags['id'] , true);
							}
							else {
								$option_arags['class'] = 'zn_full';
							}

							if(  ! empty($saved_value) ) {
								$option_arags['std'] = $saved_value;
							}

							$output .= ZN()->html()->zn_render_single_option($option_arags);

						}
					}
				}
			}

			$output .= ZN()->html()->zn_render_meta_end();
			$output .= wp_nonce_field( 'zn_ajax_nonce', 'zn_ajax_nonce' ,false ,false);
			echo $output;

		}

	}

	function save_options( $term_id ) {
		// verify if this is an auto save routine.
		// If it is our form has not been submitted, so we dont want to do anything
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// Verify Nonce key + Don't Break other post types
		if ( isset ( $_POST['zn_ajax_nonce'] ) ) {
			$nonce = $_POST['zn_ajax_nonce'];
			if (! wp_verify_nonce($nonce, 'zn_ajax_nonce') ) return;
		}
		else {
			return;
		}

		// LOAD METABOXES CONFIG
		$this->load_metaboxes_config();

		foreach($this->term_options as $option_arags) {
			if ( isset ( $_POST[$option_arags['id']] ) ) {
				update_term_meta($term_id, $option_arags['id'], $_POST[$option_arags['id']]);
			}
		}

	}
}
