<?php

/*-----------------------------------------------------------------------------------*/
/*	Constants
/*-----------------------------------------------------------------------------------*/

define('MP_SHORTNAME', 'mp'); // this is used to prefix the individual field id
define('MP_PAGE_BASENAME', 'mp-settings'); // settings page slug

/*-----------------------------------------------------------------------------------*/
/*	Variables
/*-----------------------------------------------------------------------------------*/

global $shortname;
$shortname = "agera";

/*-----------------------------------------------------------------------------------*/
/*	Specify Hooks
/*-----------------------------------------------------------------------------------*/


add_action('init', 'massivepanel_rolescheck' );

function massivepanel_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action('admin_menu', 'mp_add_menu');
		add_action('admin_init', 'mp_register_settings');
		add_action( 'admin_init', 'mp_mlu_init' );
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Scripts (JS & CSS)
/*-----------------------------------------------------------------------------------*/

function mp_settings_scripts(){
	wp_enqueue_style('mp_theme_settings_css', get_template_directory_uri().'/massive-panel/css/mp-styles.css');
	wp_enqueue_style('color_picker_css', get_template_directory_uri().'/massive-panel/css/colorpicker.css');


	wp_enqueue_script('cufon', get_template_directory_uri().'/massive-panel/js/cufon-yui.js', array('jquery'));
	wp_enqueue_script('trebuchet_ms', get_template_directory_uri().'/massive-panel/js/Trebuchet_MS.js', array('jquery'));
	wp_enqueue_script('jquery_cookie', get_template_directory_uri().'/massive-panel/js/jquery.cookie.js', array('jquery'));
	wp_enqueue_script('color_picker_js', get_template_directory_uri().'/massive-panel/js/colorpicker.js', array('jquery'));
	// wp_enqueue_script('icheckbox', get_template_directory_uri().'/massive-panel/js/iphone-style-checkboxes.js', array('jquery'));
	wp_enqueue_script('mp_theme_settings_js', get_template_directory_uri().'/massive-panel/js/mp-scripts.js', array('jquery'));
}


/*-----------------------------------------------------------------------------------*/
/*	Admin Menu Page
/*-----------------------------------------------------------------------------------*/

function mp_add_menu(){
	$settings_output = mp_get_settings();

	// This code displays the link to Admin Menu under "Appearance"
	$mp_settings_page = add_menu_page(__('Massive Panel Options', 'agera'), __('Theme Options', 'agera'), 'manage_options', MP_PAGE_BASENAME, 'mp_settings_page_fn');

	// js & css
	add_action('load-'.$mp_settings_page, 'mp_settings_scripts');
}


/*-----------------------------------------------------------------------------------*/
/*	Helper function for defininf variables
/*-----------------------------------------------------------------------------------*/

function mp_get_settings() {
	global $shortname;
	$output = array();
	$output[$shortname.'_option_name']		= $shortname.'_options'; // option name as used in the get_option() call
	$output['mp_page_title']				=__('Massive Panel Settings Page', 'agera'); // the settings page title

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Admin Settings Page - display settings page
/*-----------------------------------------------------------------------------------*/

function mp_settings_page_fn(){
	// get the settings section
	global $shortname;
	$settings_output = mp_get_settings();
	$content = mp_display_content();

	?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"></div>
		<h2><?php echo $settings_output['mp_page_title']; ?></h2>

			<div id="top">
				<div id="logo"></div>
				<div id="top-nav">
					<?php echo $content[3]; ?>
					<?php echo $content[2]; ?>
				</div><!-- end topnav -->
			</div> <!-- end top -->
			<div id="bg-content">
				<div id="sidebar"><?php echo $content[1]; ?></div>
					<form action="options.php" method="post">
						<?php
							settings_fields($settings_output[$shortname.'_option_name']);
							echo $content[0];
						?>
						<div class="bottom-nav">
							<div class="mp-line">
								<div class="mp-line-around">
									<input name="mp-submit" class="save-button" type="submit" value="<?php esc_attr_e('Save Settings', 'agera'); ?>" />
									<input name="mp-reset" class="reset-button" type="submit" value="<?php esc_attr_e('Reset Settings', 'agera'); ?>" />
								</div>
						</div>
					</form>
				</div> <!-- end bg-content -->
		</div><!-- end wrap -->

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Register settings
/*	This function registers wordpress settings
/*-----------------------------------------------------------------------------------*/

function mp_register_settings() {
	global $shortname;
	require_once('theme-options.php');
	require_once('theme-interface.php');
	require_once('mpc-uploader.php');

	$settings_output	= mp_get_settings();
	$mp_option_name		= $settings_output[$shortname.'_option_name'];

	// set default if the option panel doesn't have them.
	if (!get_option($mp_option_name)) {
		mp_save_default();
	}

	// register panel settings
	register_setting($mp_option_name, $mp_option_name, 'mp_validate_options');
}

/*-----------------------------------------------------------------------------------*/
/*	Save Default options after activation
/*-----------------------------------------------------------------------------------*/

function mp_save_default() {
	global $shortname;

	$settings_output	= mp_get_settings();
	$mp_option_name		= $settings_output[$shortname.'_option_name'];

	$mp_settings = get_option($mp_option_name);

	// Gets the unique option id
	if (isset($mp_settings['id'])) {
		$option_name = $mp_settings['id'];
	} else {
		$option_name = $settings_output[$shortname.'_option_name'];
	}
	if (isset($mp_settings) && $mp_settings != "" && count($mp_settings) > 2 ) {
		//delete_option('agera_options'); // remove the delete_option feauture and check the reset to default option if that works.
		$knownoptions =  $mp_settings;

		if(!is_array($knownoptions)){
			$knownoptions = array();
		}

		if (!in_array($option_name, $knownoptions)) {
			array_push( $knownoptions, $option_name );
			$mp_settings = $knownoptions;
			update_option($option_name, $mp_settings);
		}
	}

	// Gets the default options data from the array in options.php
	$options = mp_options();

	// If the options haven't been added to the database yet, they are added now
	$values = mp_get_default_values();

	if (isset($values)) {
		if(isset($mp_settings))
			update_option($option_name, $values);
		else
			add_option($option_name, $values); // Add option with default settings
	}
}


function mp_get_default_values() {
	$output = array();
	$config = mp_options();
	foreach ((array) $config as $option) {
		if (!isset( $option['id'])) {
			continue;
		}
		if (!isset( $option['type'])) {
			continue;
		}

		if (isset( $option['std']))
			$output[$option['id']] = $option['std'];
		else
			$output[$option['id']] = '';
	}
	//print_r($output);
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Validate Input
/*-----------------------------------------------------------------------------------*/

function mp_validate_options($input) {
	global $reset;

	if(isset($_POST['mp-reset']) && $_POST['mp-reset'] == "Reset Settings"){
		$reset = "true";
	} else {
		$reset = "false";
	}

	// for enphaced security, create new array
	$valid_input = array();

	// get the settings section array
	$options = mp_options();

	// run a foreach and switch on option type
	foreach($options as $option) {
		// for hide module
		if(isset($option['id']) && isset($input[$option['id'].'_checkbox'])) {
			if($input[$option['id'].'_checkbox'] == 'on') {
				$valid_input[$option['id'].'_checkbox'] = '1';
			} else {
				$valid_input[$option['id'].'_checkbox'] = '0';
			}
		} elseif(isset($option['id'])) { // this was added
			$valid_input[$option['id'].'_checkbox'] = '0';
		}

		if(!isset($option['validation']))
			$option['validation'] = '';

		switch($option['type']) {
			case 'text-big':
			case 'text-small':
				//switch validation based on the class

				switch($option['validation']){
					//for numeric
					case 'numeric':
						if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}

						$input[$option['id']]		= trim($input[$option['id']]); // this trims the whitespace
						if(is_numeric($input[$option['id']])){
							$valid_input[$option['id']] = $input[$option['id']];
						} else {
							$valid_input[$option['id']] = 'Expecting a Numeric value!';
						}

						//register error
						if(is_numeric($input[$option['id']]) == FALSE) {
							add_settings_error(
								$option['id'], // settings title
								MP_SHORTNAME.'_txt_numeric_error', // error ID
								__('Expecting a Numeric value!', 'mp_textarea'),
								'error'
							);
						}
					break;

					// multi-numeric values separated by comma
					case 'multinumeric':
						if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
						//accept the input only when the numeric values are comma separated
						$input[$option['id']] = trim($input[$option['id']]); // trim whitespace
						if($input[$option['id']] != '') {
							// /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.
							$valid_input[$option['id']] = $valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values','agera');
						} else {
							$valid_input[$option['id']] = $input[$option['id']];
						}

						// register error
						if($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
							add_settings_error(
								$option['id'], // setting title
								MP_SHORTNAME . '_txt_multinumeric_error', // error ID
								__('Expecting comma separated numeric values!','agera'), // error message
								'error' // type of message
							);
						}
					break;

					//no html
					case 'nohtml':
						if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				//accept the input only after stripping out all html, extra white space etc!
	    				$input[$option['id']] = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
	    				$valid_input[$option['id']] = addslashes($input[$option['id']]);
	    			break;

	    			//for url
	    			case 'url':
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				//accept the input only when the url has been sanited for database usage with esc_url_raw()
	    				$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
	    				$valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
	    			break;

	    			//for email
	    			case 'email':
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				//accept the input only after the email has been validated
	    				$input[$option['id']] = trim($input[$option['id']]); // trim whitespace
	    				if($input[$option['id']] != ''){
	    					if(is_email($input[$option['id']])!== FALSE) {
	    						$valid_input[$option['id']] = $input[$option['id']];
	    					} else {
	    						$valid_input[$option['id']] = __('Invalid email! Please re-enter!','agera');
	    					}
	    				} elseif($input[$option['id']] == '') {
	    					$valid_input[$option['id']] = __('This setting field cannot be empty! Please enter a valid email address.','agera');
	    				}

	    				// register error
	    				if(is_email($input[$option['id']])== FALSE || $input[$option['id']] == '') {
	    					add_settings_error(
	    						$option['id'], // setting title
	    						MP_SHORTNAME . '_txt_email_error', // error ID
	    						__('Please enter a valid email address.','agera'), // error message
	    						'error' // type of message
	    					);
	    				}
	    			break;

	    			// a "cover-all" fall-back when the class argument is not set
	    			default:
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				// accept only a few inline html elements
	    				$allowed_html = array(
	    					'a' => array('href' => array (),'title' => array ()),
	    					'b' => array(),
	    					'em' => array (),
	    					'i' => array (),
	    					'strong' => array()
	    				);

	    				$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
	    				$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
	    				$input[$option['id']] 		= wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
	    				$valid_input[$option['id']] = addslashes($input[$option['id']]);
	    			break;
	    		}
	    	break;

	    	case 'textarea-big':
	    	case 'textarea':
	    		//switch validation based on the class!
	    		switch ( $option['validation'] ) {
	    			//for only inline html
	    			case 'inlinehtml':
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				// accept only inline html
	    				$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
	    				$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
	    				$input[$option['id']] 		= addslashes($input[$option['id']]); //wp_filter_kses expects content to be escaped!
	    				$valid_input[$option['id']] = wp_filter_kses($input[$option['id']]); //calls stripslashes then addslashes
	    			break;

	    			//for no html
	    			case 'nohtml':
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				//accept the input only after stripping out all html, extra white space etc!
	    				$input[$option['id']] 		= sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
	    				$valid_input[$option['id']] = addslashes($input[$option['id']]);
	    			break;

	    			//for allowlinebreaks
	    			case 'allowlinebreaks':
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}
	    				//accept the input only after stripping out all html, extra white space etc!
	    				$input[$option['id']] 		= wp_strip_all_tags($input[$option['id']]); // need to add slashes still before sending to the database
	    				$valid_input[$option['id']] = addslashes($input[$option['id']]);
	    			break;

	    			// a "cover-all" fall-back when the class argument is not set
	    			default:
	    				// accept only limited html
	    				if($reset == "true"){
							$valid_input[$option['id']] = $option['std'];
							break;
						}

	    				//my allowed html
	    				$allowed_html = array(
	    					'a' 			=> array('href' => array (),'title' => array ()),
	    					'b' 			=> array(),
	    					'blockquote' 	=> array('cite' => array ()),
	    					'br' 			=> array(),
	    					'dd' 			=> array(),
	    					'dl' 			=> array(),
	    					'dt' 			=> array(),
	    					'em' 			=> array (),
	    					'i' 			=> array (),
	    					'li' 			=> array(),
	    					'ol' 			=> array(),
	    					'p' 			=> array(),
	    					'q' 			=> array('cite' => array ()),
	    					'strong' 		=> array(),
	    					'ul' 			=> array(),
	    					'h1' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
	    					'h2' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
	    					'h3' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
	    					'h4' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
	    					'h5' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
	    					'h6' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
	    				);

	    				$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
	    				$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
	    				$input[$option['id']] 		= wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
	    				$valid_input[$option['id']] = addslashes($input[$option['id']]);
	    			break;
	    		}
	    	break;
	    	// settings that doesn't really require validation
	    	//case 'multi-upload':
	    	case 'upload':
	    	case 'info':
	     	case 'multi-checkbox':
	    	case 'select':
	    	case 'choose-portfolio':
		 	case 'choose-sidebar':
		 	case 'choose-sidebar-small':
		 	case 'choose-image':
		 	case "radio" :
		 		if($reset == "false"){
		 			if(isset($option['id']) && isset($input[$option['id']]))
	   	 				$valid_input[$option['id']] = $input[$option['id']];
	   	 		} elseif (isset($option['id']) && isset($option['std'])) {
	   	 			$valid_input[$option['id']] = $option['std'];
	   	 		} else {
	   	 			$valid_input[$option['id']] = '';
	   	 		}
	 	 	break;

	 	 	case 'multi-upload':
	 	 		//$input[$option['id']] 		= trim($input[$option['id']]); // need to add slashes still before sending to the database
	 	 		if(isset( $input[$option['id']])){
	    			$valid_input[$option['id']] = $input[$option['id']];
	    		} else {
	    			$valid_input[$option['id']] = '';
	    		}
	 	 	//	$valid_input[$option['id']] = $input[$option['id']];
	 	 		//print_r("Link przed zapisem = ".$input[$option['id']]);
	 	 	break;

	 	 	// color picker validation
	 	 	case 'color':
	 	 		//print_r($input[$option['id']]);
	 	 		if($reset == "false"){
	 	 			if(!isset($input[$option['id']]) || $input[$option['id']] == "")
	 	 				return;

	 		 		if(validate_hex($input[$option['id']])) {
						$valid_input[$option['id']] = $input[$option['id']];
					} else {
						$valid_input[$option['id']] = $option['std'];
						add_settings_error(
	    				$option['id'], // setting title
		    				MP_SHORTNAME . '_color_hex_error', // error ID
	    				__('Please insert HEX value.','agera'), // error message
		    				'error' // type of message
	    				);
	    				//echo "ERROR = ";
					}
				} else {
					$valid_input[$option['id']] = $option['std'];
				}

	 	 	break;

	    	// checkbox validation
	    	case 'checkbox-ios':
	    	case 'checkbox':

	    		// if it's not set, default to null!
	    		if($reset == "true"){
	    			if(isset($option['std'])) {
						$valid_input[$option['id']] = $option['std'];
					} else {
						$valid_input[$option['id']] = "";
					}
					break;
				}
	    		if (!isset($input[$option['id']])) {
	    			$input[$option['id']] = null;
	    		}
	    		// Our checkbox value is either 0 or 1
	    		if($input[$option['id']] == 1 || $input[$option['id']] == 'on'){
	    			$valid_input[$option['id']] = 1;
	    		} else {
	    			$valid_input[$option['id']] = 0;
	    		}
	   		break;
		}

	}
//	var_dump($valid_input);
	return $valid_input; // returns the valid input;
}

/* Helper function for HEX validation */
function validate_hex($hex) {
	//echo $hex;
	$hex = trim($hex);
	// Strip recognized prefixes.
	if (0 === strpos( $hex, '#')) {
		$hex = substr( $hex, 1 );
	} elseif ( 0 === strpos( $hex, '%23')) {
		$hex = substr($hex, 3);
	}
	//echo $hex;
	// Regex match.
	if (0 === preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
		return false;
	} else {
		return true;
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Callback function for displaying admin messages
/*	@return calls mp_show_msg()
/*-----------------------------------------------------------------------------------*/

function mp_admin_msgs(){
	// check for settings page
	if(isset($_GET['page']))
		$mp_settings_pg = strpos($_GET['page'], MP_PAGE_BASENAME);
	else
		$mp_settings_pg = FALSE;

	// collect setting error/notices
	$set_errors = get_settings_errors();

	// display admin message only for the admin to see, only on our settings page and only when setting errors/notices ocur
	if(current_user_can('manage_options') && $mp_settings_pg !== FALSE && !empty($set_errors)){
		// have the settings been updates succesfully
		if($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])) {
			mp_show_msg("<p>".$set_errors[0]['message']."</p>", 'updated');
		} else { // have errors been found?
			// loop through the errors
			foreach($set_errors as $set_error) {
				// set the title attribute to match the error "setting title" - need this in js file
				mp_show_msg("<p class='setting-error-message' title='".$set_error['setting']."'>".$set_error['message']."</p>", "error");

			}
		}
	}
}

// admin hook for notices
add_action('admin_notices', 'mp_admin_msgs');


/*-----------------------------------------------------------------------------------*/
/*	This is Helper function which displayes admin messages
/*	@param (string) $message The echoed message
/*	@param (string) $msgclass The message class: info, error, succes ect.
/*	@return echoes the message
/*-----------------------------------------------------------------------------------*/

function mp_show_msg($message, $msgclass = 'info') {
	echo "<div id='message' class='$msgclass'>$message</div>";
}

?>