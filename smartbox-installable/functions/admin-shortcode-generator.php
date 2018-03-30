<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: Designare shortcode generator.
Date Created: 2011-01-21.
Author: Based on the work of the Shortcode Ninja plugin by VisualShortcodes.com.
Integration and Addons: Matty.
Since: 3.5.0


TABLE OF CONTENTS

- Constructor Function
- function init()
- function filter_mce_buttons()
- function filter_mce_external_plugins()

- Utility Functions
- framework_url()
- ajax_action_check_url()
- shortcode_testing()

INSTANTIATE CLASS

-----------------------------------------------------------------------------------*/

class DesThemes_Shortcode_Generator {

/*-----------------------------------------------------------------------------------
  Class Variables
  
  * Setup of variable placeholders, to be populated when the constructor runs.
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------
  Class Constructor
  
  * Constructor function. Sets up the class and registers variable action hooks.
-----------------------------------------------------------------------------------*/

	function DesThemes_Shortcode_Generator () {
		// Register the necessary actions on `admin_init`.
		add_action( 'admin_init', array( $this, 'init' ) );

		add_action( 'wp_ajax_des_check_url_action', array( $this, 'ajax_action_check_url' ) );
		// Output the markup in the footer.
		add_action( 'admin_footer', array( $this, 'output_dialog_markup' ) );
	} // End WooThemes_Shortcode_Generator()


/*-----------------------------------------------------------------------------------
  init()
  
  * This guy runs the show. Rocket boosters... engage!
-----------------------------------------------------------------------------------*/

	function init() {
	
		if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {
		  	
		  	
		  	wp_enqueue_script('jquery');
		  	// Add the tinyMCE buttons and plugins.
			add_filter( 'mce_buttons', array( &$this, 'filter_mce_buttons' ) );
			add_filter( 'mce_external_plugins', array( &$this, 'filter_mce_external_plugins' ) );
			
			// Register the colourpicker JavaScript.
			wp_register_script( 'des-colourpicker', $this->framework_url() . 'js/colorpicker.js', array( 'jquery' ), '3.6', true ); // Loaded into the footer.
			wp_enqueue_script( 'des-colourpicker' );
			
			// Register the colourpicker CSS.
			wp_register_style( 'des-colourpicker', $this->framework_url() . 'css/colorpicker.css' );
			wp_enqueue_style( 'des-colourpicker' );
			
			// Register the custom CSS styles.
			wp_register_style( 'des-shortcode-generator', $this->framework_url() . 'css/shortcode-generator.css' );
			wp_enqueue_style( 'des-shortcode-generator' );
			
			wp_enqueue_style('font-awesome', DESIGNARE_CSS_PATH .'font-awesome.min.css');
			
		} // End IF Statement
	
	} // End init()

/*-----------------------------------------------------------------------------------
  filter_mce_buttons()
  
  * Add our new button to the tinyMCE editor.
-----------------------------------------------------------------------------------*/
	
	function filter_mce_buttons( $buttons ) {
		
		array_push( $buttons, '|', 'desthemes_shortcodes_button' );
		
		return $buttons;
		
	} // End filter_mce_buttons()

/*-----------------------------------------------------------------------------------
  filter_mce_external_plugins()
  
  * Add functionality to the tinyMCE editor as an external plugin.
-----------------------------------------------------------------------------------*/
	
	function filter_mce_external_plugins( $plugins ) {
		global $wp_version;
		$suffix = '';
		if ( '3.9' <= $wp_version ) {
			$suffix = '_w39t4';
		}
        $plugins['DesThemesShortcodes'] = wp_nonce_url( esc_url( $this->framework_url() . 'js/shortcode-generator/editor_plugin' . $suffix . '.js' ), 'designare-shortcode-generator' );

        return $plugins;

	} // End filter_mce_external_plugins()
	
/*-----------------------------------------------------------------------------------
  Utility Functions
  
  * Helper functions for this class.
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------
  framework_url()
  
  * Returns the full URL of the DesFramework, including trailing slash.
-----------------------------------------------------------------------------------*/

function framework_url() {
	
	return trailingslashit( get_template_directory_uri() . '/' . basename( dirname( __FILE__ ) ) );

} // End framework_url()

/*-----------------------------------------------------------------------------------
  ajax_action_check_url()
  
  * Checks if a given url (via GET or POST) exists.
  * Returns JSON.
  *
  * NOTE: For users that are not logged in this is not called.
  * The client recieves <code>-1</code> in that case.
-----------------------------------------------------------------------------------*/

function ajax_action_check_url() {

	$hadError = true;

	$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

	if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
			
		$file_headers = @get_headers( $url );
		$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
		$hadError     = false;
	}

	echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

	die();
	
} // End ajax_action_check_url()

/*-----------------------------------------------------------------------------------
  shortcode_testing()
  
  * Used for testing that the shortcodes are functioning.
-----------------------------------------------------------------------------------*/

function shortcode_testing( $atts, $content = null ) {
	
	if ($content === null) return '';
	
	return '<strong>Working: ' . $content . '</strong>' . "\n";
	
} // End shortcode_testing()

public function output_dialog_markup () {
?>
<div id="des-dialog" style="display: none;">

<div id="des-options-buttons" class="clear">
	<div class="alignleft">

	    <input type="button" id="des-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />

	</div>
	<div class="alignright">
	    <input type="button" id="des-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#woo-options-buttons .clear-->

<div id="des-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'paris' ); ?></h3>

	<table id="des-options-table">
	</table>

</div>
<div class="clear"></div>


<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/column-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/tab-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/acc-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/bars-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/diagram-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/team-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/service-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/servicefa-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/fontawesome-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/partners-control.js' ); ?>"></script>

<div style="float: right"><input type="button" id="des-btn-cancel"
	class="button" name="cancel" value="Cancel" accesskey="C" /></div>
</div>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() . '/functions/js/shortcode-generator/js/dialog-js.php' ); ?>"></script>
</div>
<?php
	} // End output_dialog_markup()
} // End Class

/*-----------------------------------------------------------------------------------
  INSTANTIATE CLASS
-----------------------------------------------------------------------------------*/

$des_shortcode_generator = new DesThemes_Shortcode_Generator();
?>