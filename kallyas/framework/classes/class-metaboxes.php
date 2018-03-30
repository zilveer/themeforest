<?php if(! defined('ABSPATH')){ return; }

/**
*
*/
class ZnMetabox
{
	// Container metaboxes locations
	var $zn_meta_locations;
	// Contains metaboxes options
	var $metaboxes_options;

	function __construct()
	{

		if(basename( $_SERVER['PHP_SELF']) == "post-new.php"
		|| basename( $_SERVER['PHP_SELF']) == "post.php")
		{

			//add_action('add_meta_boxes', array(&$this, 'load_metaboxes_config'));
			add_action('add_meta_boxes', array(&$this, 'zn_init_options'));
			add_action('save_post', array(&$this, 'zn_save_options') , 10 );
		}

	}

	function load_metaboxes_config(){

		if ( file_exists(THEME_BASE.'/template_helpers/metaboxes/metaboxes.php') ){
			include( THEME_BASE.'/template_helpers/metaboxes/metaboxes.php');
		}



		$this->metaboxes_options = apply_filters( 'zn_metabox_elements' , $zn_meta_elements );
		$this->zn_meta_locations = apply_filters( 'zn_metabox_locations' , $zn_meta_locations );

	}

	function zn_init_options()
	{

		$this->load_metaboxes_config();

		foreach( $this->zn_meta_locations as $key=>$type)
		{
			foreach ($type['page'] as $page )
			{
				$slug = $type['slug'];

				add_meta_box(
					$slug,
					$type['title'],
					array($this,'zn_render_meta_box'),
					$page,
					$type['context'],
					$type['priority'],
					array('what_box'=>$type)
				);

				add_filter( "postbox_classes_".$page."_".$slug, array($this, 'zn_add_meta_box_classes') );
			}
		}

	}

	function zn_add_meta_box_classes( $classes=array() ) {

	    if( !in_array( 'zn-metabox', $classes ) )
	        $classes[] = 'zn-metabox';

	    return $classes;
	}

	function zn_render_meta_box( $post , $metabox ) {

		// Get the current metabox
		$zn_metabox = $metabox['args']['what_box'];
		$output = '';

		//var_dump( get_post_meta($post->ID) );

		$output .= ZN()->html()->zn_render_meta_start($zn_metabox['slug']);

		if ( !empty( $this->metaboxes_options ) ) {
			foreach ($this->metaboxes_options as $key => $element) {
				if( in_array( $metabox['id'], $element['slug']  ) )
				{
					if ( method_exists( ZN()->html(), $element['type'] ) )
					{

						$saved_value = get_post_meta( $post->ID, $element['id'] , true);
						if(  !empty($saved_value) ) {
							$element['std'] = $saved_value;
						}

						$output .= ZN()->html()->zn_render_single_option($element);

					}
				}
			}
		}

		$output .= ZN()->html()->zn_render_meta_end();
		$output .= wp_nonce_field( 'zn_ajax_nonce', 'zn_ajax_nonce' ,false ,false);
		echo $output;

	}

	function zn_save_options( $post_id ) {
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

		// Check permissions
		if ( 'page' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) )
			return;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) )
			return;
		}

		// LOAD METABOXES CONFIG
		$this->load_metaboxes_config();

		// Create array of values to save
		$values_to_save = array();

		do_action('zn_save_metaboxes', $post_id );

		foreach($this->metaboxes_options as $element)
		{
			if ( isset ( $_POST[$element['id']] ) ) {
				update_post_meta($post_id, $element['id'], $_POST[$element['id']]);
			}

		}

	}
}
