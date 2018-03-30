<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php

class Themnific_Shortcode_Generator {

/*-----------------------------------------------------------------------------------
  Class Variables

  * Setup of variable placeholders, to be populated when the constructor runs.
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------
  Class Constructor

  * Constructor function. Sets up the class and registers variable action hooks.
-----------------------------------------------------------------------------------*/

	function Themnific_Shortcode_Generator () {
		// Register the necessary actions on `admin_init`.
		add_action( 'admin_init', array( $this, 'init' ) );

		// wp_ajax_... is only run for logged users.
		add_action( 'wp_ajax_tmnf_check_url_action', array( $this, 'ajax_action_check_url' ) );
		add_action( 'wp_ajax_tmnf_shortcodes_nonce', array( $this, 'ajax_action_generate_nonce' ) );

		// Output the markup in the footer.
		add_action( 'admin_footer', array( $this, 'output_dialog_markup' ) );
	} // End Themnific_Shortcode_Generator()

/*-----------------------------------------------------------------------------------
  init()

  * This guy runs the show. Rocket boosters... engage!
-----------------------------------------------------------------------------------*/

	function init() {
		global $pagenow;

		if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) )  {

		  	// Add the tinyMCE buttons and plugins.
			add_filter( 'mce_buttons', array( $this, 'filter_mce_buttons' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_external_plugins' ) );

			// Register the colourpicker JavaScript.
			wp_register_script( 'tmnf-colourpicker', esc_url( $this->framework_url() . 'js/colorpicker.js' ), array( 'jquery' ), '3.6', true ); // Loaded into the footer.
			wp_enqueue_script( 'tmnf-colourpicker' );

			// Register the colourpicker CSS.
			wp_register_style( 'tmnf-colourpicker', esc_url( $this->framework_url() . 'css/colorpicker.css' ) );
			wp_enqueue_style( 'tmnf-colourpicker' );

			wp_register_style( 'tmnf-shortcode-icon', esc_url( $this->framework_url() . 'css/shortcode-icon.css' ) );
			wp_enqueue_style( 'tmnf-shortcode-icon' );

			// Register the custom CSS styles.
			wp_register_style( 'tmnf-shortcode-generator', esc_url( $this->framework_url() . 'css/shortcode-generator.css' ) );
			wp_enqueue_style( 'tmnf-shortcode-generator' );

		} // End IF Statement

	} // End init()

/*-----------------------------------------------------------------------------------
  filter_mce_buttons()

  * Add our new button to the tinyMCE editor.
-----------------------------------------------------------------------------------*/

	function filter_mce_buttons( $buttons ) {

		array_push( $buttons, '|', 'Themnific_shortcodes_button' );

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
			$suffix = '_39';
		}
        $plugins['ThemnificShortcodes'] = wp_nonce_url( esc_url( $this->framework_url() . 'js/shortcode-generator/editor_plugin' . $suffix . '.js' ), 'framework-shortcode-generator' );

        return $plugins;

	} // End filter_mce_external_plugins()

/*-----------------------------------------------------------------------------------
  Utility Functions

  * Helper functions for this class.
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------
  framework_url()

  * Returns the full URL of the framework, including trailing slash.
-----------------------------------------------------------------------------------*/

function framework_url() {
	return esc_url( trailingslashit( get_template_directory_uri() . '/' . basename( dirname( __FILE__ ) ) ) );
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
		$url = esc_url( $url );
		$file_headers = @get_headers( $url );
		$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
		$hadError     = false;
	}

	echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

	die();
} // End ajax_action_check_url()

/*-----------------------------------------------------------------------------------
  ajax_action_generate_nonce()

  * Generate a nonce.
  *
  * NOTE: For users that are not logged in this is not called.
  * The client recieves <code>-1</code> in that case.
-----------------------------------------------------------------------------------*/

function ajax_action_generate_nonce() {
	echo wp_create_nonce( 'framework-shortcode-generator' );
	die();
} // End ajax_action_generate_nonce()


	/**
	 * Output the HTML markup for the dialog box.
	 * @access public
	 * @since  5.5.6
	 * @return void
	 */
	public function output_dialog_markup () {
		$tmnf_framework_url = $this->framework_url();
		$tmnf_framework_version = '3.9';

		$MIN_VERSION = '2.9';

		$meetsMinVersion = version_compare($tmnf_framework_version, $MIN_VERSION) >= 0;

		$isTheminficTheme = true;
?>
<div id="tmnf-dialog" style="display: none;">

<?php if ( $meetsMinVersion && $isTheminficTheme ) { ?>
<div id="tmnf-options-buttons" class="clear">
	<div class="alignleft">

	    <input type="button" id="tmnf-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />

	</div>
	<div class="alignright">
	    <input type="button" id="tmnf-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#tmnf-options-buttons .clear-->

<div id="tmnf-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'Themnific' ); ?></h3>

	<table id="tmnf-options-table">
	</table>

</div>
<div class="clear"></div>


<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/column-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/tab-control.js' ); ?>"></script>
<?php  }  else { ?>

<div id="tmnf-options-error">

    <h3><?php echo __( 'Ninja Trouble', 'Themnific' ); ?></h3>

    <?php if ( $isTheminficTheme && ( ! $meetsMinVersion ) ) { ?>
    <p><?php echo sprinf ( __( 'Your version of the framework (%s) does not yet support shortcodes. Shortcodes were introduced with version %s of the framework.', 'Themnific' ), $tmnf_framework_version, $MIN_VERSION ); ?></p>

    <h4><?php echo __( 'What to do now?', 'Themnific' ); ?></h4>

    <p><?php echo __( 'Upgrading your theme, or rather the framework portion of it, will do the trick.', 'Themnific' ); ?></p>

	<p><?php echo sprintf( __( 'The framework is a collection of functionality that all Themnific have in common. In most cases you can update the framework even if you have modified your theme, because the framework resides in a separate location (under %s).', 'Themnific' ), '<code>/functions/</code>' ); ?></p>

	<p><?php echo sprintf ( __( 'There\'s a tutorial on how to do this on Themnific.com: %sHow to upgradeyour theme%s.', 'Themnific' ), '<a title="Themnific Tutorial" target="_blank" href="http://www.Themnific.com/2009/08/how-to-upgrade-your-theme/">', '</a>' ); ?></p>

	<p><?php echo __( '<strong>Remember:</strong> Every Ninja has a backup plan. Safe or not, always backup your theme before you update it or make changes to it.', 'Themnific' ); ?></p>

<?php } else { ?>

    <p><?php echo __( 'Looks like your active theme is not from Themnific. The shortcode generator only works with themes from Themnific.', 'Themnific' ); ?></p>

    <h4><?php echo __( 'What to do now?', 'Themnific' ); ?></h4>

	<p><?php echo __( 'Pick a fight: (1) If you already have a theme from Themnific, install and activate it or (2) if you don\'t yet have one of the awesome Themnific head over to the <a href="http://www.Themnific.com/themes/" target="_blank" title="Themnific Gallery">Themnific Gallery</a> and get one.', 'Themnific' ); ?></p>

<?php } ?>

<div style="float: right"><input type="button" id="tmnf-btn-cancel"
	class="button" name="cancel" value="Cancel" accesskey="C" /></div>
</div>

<?php  } ?>

<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/dialog-js.php' ); ?>"></script>
</div>
<?php
	} // End output_dialog_markup()
} // End Class

/*-----------------------------------------------------------------------------------
  INSTANTIATE CLASS
-----------------------------------------------------------------------------------*/

$tmnf_shortcode_generator = new Themnific_Shortcode_Generator();
?>