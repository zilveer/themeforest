<?php
/**
 * This class handles all functionality for the page builder buttons from the admin edit pages
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( Zauan )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/hogash
 */

class ZnPageBuilderAdmin{

	function __construct() {

		$this->zn_wrap_editor();

		// Enqueue the page builder javascript
		add_action( 'admin_enqueue_scripts', array(&$this, 'zn_register_scripts') );
		add_filter( 'zn_metabox_elements', array(&$this, 'zn_meta_pb_fields') );
		add_filter( 'zn_metabox_locations', array(&$this, 'zn_meta_pb_locations') );
		// Add the "Edit with pagebuilder" to post/page row action
		add_filter( 'page_row_actions', array( &$this, 'render_row_action' ) );
		add_filter( 'post_row_actions', array( &$this, 'render_row_action' ) );

		add_action( 'admin_footer-post.php', array( &$this, 'print_pb_template' ) );
		add_action( 'admin_footer-post-new.php', array( &$this, 'print_pb_template' ) );

		// Load the exporter/importer class
		include( dirname(__FILE__).'/export/export_v2.php' );

	}

	/*
	 * Prints a json formatted string containing the current pb data
	 */
	function print_pb_template(){

		global $post;

		$pb_data = get_metadata('post', $post->ID, 'zn_page_builder_els', true);
		$page_content = ZNPB()->get_pb_content_data( $pb_data );

		?>
		<script type="text/javascript">
			var _znpb_page_content = <?php echo json_encode( $page_content ); ?>;
		</script>
		<?php
	}

	function zn_meta_pb_fields( $elements ){
		// Page description
		$elements[] = array (
							"name"	=> 'zn_page_builder_status',
							"slug" => array( 'page_options' , 'portfolio_options', 'post_options' ),
							"id" => "zn_page_builder_status",
							"std" => false,
							"type" => "hidden",
							"class" => "zn_pb_input_status"
						);

		return $elements;
	}

	function zn_meta_pb_locations( $locations ){
		// Page description
		$locations[] = array( 	'title' =>  'PB', 'slug'=>'zn_pb_options', 'page'=>array('page','portfolio','post'), 'context'=>'side', 'priority'=>'default' );

		return $locations;
	}

/**
 *
 * Wrap wordpress editor with our wrapper so we can add the buttons
 *
 */
	function zn_wrap_editor() {
		add_action( 'edit_form_after_title',array( &$this, 'zn_wrap_editor_start' ));
		add_action( 'edit_form_after_editor', array($this, 'zn_wrap_editor_end' ), 1);
	}

/**
 *
 * Script that handles the ajax requests for the admin editor
 *
 */
	function zn_register_scripts( $hook ){

		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_enqueue_script( 'zn_page_builder', FW_URL .'/pagebuilder/assets/js/zn_page_builder.js','jquery','',true );
		}

	}



/**
 *
 * Add the start of our wrapper
 * @uses $post
 *
 */
	function zn_wrap_editor_start() {

		global $post;

        $enable_text 	= 'Enable page builder';
        $disable_text  	= 'Disable page builder';
        $status 		= get_post_meta( $post->ID, 'zn_page_builder_status', true );
        $active_text  = $status == 'enabled' ? $disable_text : $enable_text;
        $button_css   = $status == 'enabled' ? "" : "style=\"display:none;\"";
		$preview_link = get_permalink( $post->ID );

		// Fixes the WPML issue when the edit/view link is not updated after the language is changed and the
		// translation is available in an other domain.
		$preview_link = apply_filters('preview_post_link', $preview_link);
		// Adds the zn_pb_edit=true to the url
		$preview_link = esc_url( add_query_arg( 'zn_pb_edit', 'true', $preview_link ));

		echo '<div class="zn_pb_buttons">';
			wp_nonce_field( 'ZnNonce', 'ZnNonce', false, true );
			echo '<div type="button" name="publish" id="zn_enable_pb" data-status="'.$status.'" data-postid="'.$post->ID.'" data-active-text="'.$disable_text.'" data-inactive-text="'.$enable_text.'" class="button button-zn_save button-large"><span class="spinner"></span> <span class="zn_bt_text">'.$active_text.'</span></div>';
			echo '<a href="'.$preview_link.'" id="zn_edit_page" class="button button-primary button-large zn_pb_button" '.$button_css.'>Edit this page with pagebuilder</a>';
		echo '</div>';
		echo '<div class="zn_editor_wrap">';

	}

/**
 *
 * Close our wrapper
 *
 */
	function zn_wrap_editor_end(){
		echo '</div>';
	}

	/**
	 * Adds the render with pagebuilder action to the inline actions
	 *
	 * @access public
	 * @param $actions array
	 * @return array
	 */
	public function render_row_action( $actions ){
		$post = get_post();

		$actions['zn_edit'] = '<a href="' . ZNPB()->get_edit_url( '', $post->ID ) . '">' . __( 'Edit with Page builder', 'zn_framework' ) . '</a>';

		return $actions;
	}

}
?>
