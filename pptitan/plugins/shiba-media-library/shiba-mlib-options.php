<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists("Shiba_Media_Library_Options")) :

class Shiba_Media_Library_Options {

	var $pagehook, $page_id, $settings_field, $options;


	function __construct() {
		$this->page_id = 'shiba_media_options';
		$this->settings_field = SHIBA_MLIB_OPTIONS;
		$this->options = get_option( $this->settings_field );

		add_action('admin_init', array($this,'admin_init'), 20 );
		add_action( 'admin_menu', array($this, 'admin_menu'), 20);
	}

	function admin_init() {
		global $shiba_mlib;
		
		register_setting( $this->settings_field, $this->settings_field, array($this, 'sanitize_theme_options') );
		add_option( $this->settings_field, Shiba_Media_Library::$default_settings );
		$this->options = $this->sanitize_theme_options($shiba_mlib->options);
	}


	function admin_menu() {
		if ( ! current_user_can('install_plugins') )
			return; 

		$url = 'edit.php?post_type=gallery'; //menu_page_url('gallery');
		// Add a new submenu under Gallery:
		$this->pagehook = $page  = add_submenu_page( 
			$url, 
			__('Options', 'shiba_mlib'), 
			__('Options', 'shiba_mlib'), 'install_plugins', 
			$this->page_id, array($this,'render') );

		// Executed on-load. Add all metaboxes.
		add_action( 'load-' . $this->pagehook, array( $this, 'metaboxes' ) );

		// Include js, css, or header *only* for our settings page
		add_action("admin_print_scripts-$page", array($this, 'js_includes'));
//		add_action("admin_print_styles-$page", array($this, 'css_includes'));
		add_action("admin_head-$page", array($this, 'admin_head') );
	}

	function admin_head() { 
		// This prints out page messages - from options-head.php
		wp_reset_vars( array( 'action' ) );

		settings_errors();
	}

    
	function js_includes() {
		// Needed to allow metabox layout and close functionality.
		wp_enqueue_script( 'postbox' );
	}


	/*
		Sanitize our plugin settings array as needed.
	*/	
	function sanitize_theme_options($options) {
		$options['shortcode'] = stripcslashes($options['shortcode']);
		return $options;
	}

	/*
		Settings access functions.
		
	*/
	protected function get_field_name( $name ) {

		return sprintf( '%s[%s]', $this->settings_field, $name );

	}

	protected function get_field_id( $id ) {

		return sprintf( '%s[%s]', $this->settings_field, $id );

	}

	protected function get_field_value( $key ) {

		return $this->options[$key];

	}
	
	/*
		Render metabox controls
	*/
	function checkbox($id, $label, $small) { ?>
		<p>
        	<input type="checkbox" name="<?php echo $this->get_field_name($id); ?>" <?php if (isset($this->options[$id]) && $this->options[$id]) echo 'checked';?>/>  
			<?php _e( $label, 'shiba_gallery' ); ?>
<!--            
			<label for="<?php echo $this->get_field_id($id); ?>">
				<?php _e( $label, 'shiba_gallery' ); ?>
            </label>
-->            
        </p>
        
        <?php 
		if ($small) { ?>
        	<small><?php echo $small;?></small>
        <?php }
	}
	
	
	function render() {
		global $shiba_mlib;
		
		$title = __('Shiba Media Library Options', 'shiba_mlib');
		?>
		<div class="wrap">   
			<h2><?php echo esc_html( $title ); ?></h2>
		
			<form class="settings_page_shiba_mlib" method="post" action="options.php">
				<p>
				<input type="submit" class="button button-primary" name="save_options" value="<?php esc_attr_e('Save Options'); ?>" />
				</p>
                
                <div class="metabox-holder">
                    <div class="postbox-container" style="width: 99%;">
                    <?php 
						// Render metaboxes
                        settings_fields($this->settings_field); 
                        do_meta_boxes( $this->pagehook, 'main', null );
                      	if ( isset( $wp_meta_boxes[$this->pagehook]['column2'] ) )
 							do_meta_boxes( $this->pagehook, 'column2', null );
                    ?>
                    </div>
                </div>

				<p>
				<input type="submit" class="button button-primary" name="save_options" value="<?php esc_attr_e('Save Options'); ?>" />
				</p>
			</form>
		</div>
        
        <!-- Needed to allow metabox layout and close functionality. -->
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function ($) {
				// close postboxes that should be closed
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// postboxes setup
				postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
			});
			//]]>
		</script>
	<?php }
	

	function metaboxes() {

		add_meta_box( 'shiba-mlib-version', __( 'Information', 'shiba_mlib' ), array( $this, 'info_box' ), $this->pagehook, 'main', 'high' );
		
		add_meta_box( 'shiba-mlib-other-settings', __('Other Media Library Settings', 'shiba_mlib' ), array( $this, 'other_mlib_settings' ), $this->pagehook, 'main' );

	}

	function info_box() {

		?>
		<p><strong><?php _e( 'Version:', 'shiba_mlib' ); ?></strong> <?php echo SHIBA_MLIB_VERSION; ?> <?php echo '&middot;'; ?> <strong><?php _e( 'Released:', 'shiba_mlib' ); ?></strong> <?php echo SHIBA_MLIB_RELEASE_DATE; ?></p>

		<p>
 			<label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php _e( 'Gallery Page Shortcode', 'shiba_mlib' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" id="<?php echo $this->get_field_id( 'shortcode' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'shortcode' ) ); ?>" style="width:100%;" />
            
			<small><p>Customize the shortcode used in gallery pages. Uses <a href="http://codex.wordpress.org/Gallery_Shortcode" target="_blank">WordPress gallery shortcode syntax</a>.</p></small>
		</p>
		<?php
		$this->checkbox('show_description', 'Show Gallery Description', '');

	}

	function other_mlib_settings() {
		$this->checkbox('qedit', 'Enable quick edit of images.', 'Adds quick edit capability for images to the Media >> Library and Gallery Edit page.');
		$this->checkbox('alt_search', 'Alt media manager search.', 'Allows image searches to be done based on title, caption, *and* alt fields.');
		$this->checkbox('ex_search', 'Expanded media manager search.', 'Expand media searches to posts, pages, galleries, and attachments.');
		$this->checkbox('image_posts', 'Show image posts.', 'Show the number of posts that are using a particular image in the Media >> Library screen. <strong>Turning this on will increase load time for that page.</strong>');
		
	}
	
} // end Shiba_Media_Library_Options class
endif; 

?>