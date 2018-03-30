<?php

/**
 * Filter URLs from uploaded media fields and replaces them with keywords.
 * This is to keep from storing the site URL in the database to make
 * migrations easier.
 */
function of_filter_save_media_upload($data) {
	if(!is_array($data)) return $data;

	foreach ($data as $key => $value) {
		if (is_string($value)) {
			$data[$key] = str_replace(
				array( site_url('', 'http'), site_url('', 'https') ),
				array( '[site_url]', '[site_url_secure]' ),
				$value
			);
		}
	}
	return $data;
}
add_filter('of_options_before_save', 'of_filter_save_media_upload');

/**
 * Filter URLs from uploaded media fields and replaces the site URL keywords
 * with the actual site URL.
 */
function of_filter_load_media_upload($data) {
	if(!is_array($data)) return $data;

	foreach ($data as $key => $value) {
		if (is_string($value)) {
			$data[$key] = str_replace(
				array( '[site_url]', '[site_url_secure]' ),
				array( site_url('', 'http'), site_url('', 'https') ),
				$value
			);
		}
	}
	return $data;
}
add_filter('of_options_after_load', 'of_filter_load_media_upload');

/* Admin Init */
function optionsframework_admin_init() {
	global $of_options, $options_machine, $smof_data, $smof_details;
	if (!isset($options_machine)) $options_machine = new Options_Machine($of_options);
	do_action('optionsframework_admin_init_before', array(
		'of_options' => $of_options,
		'options_machine' => $options_machine,
		'smof_data' => $smof_data
	));
	if (empty($smof_data['smof_init'])) {
		of_save_options($options_machine->Defaults);
		of_save_options(date('r'), 'smof_init');
		$smof_data = of_get_options();
		$options_machine = new Options_Machine($of_options);
	}
	do_action('optionsframework_admin_init_after', array(
		'of_options' => $of_options,
		'options_machine' => $options_machine,
		'smof_data' => $smof_data
	));
}

/* Create Options page */
function optionsframework_add_admin() {
	$of_page = add_theme_page( THEMENAME, __( 'Theme Options', 'royalgold' ), 'edit_theme_options', 'optionsframework', 'optionsframework_options_page');
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
}
function of_style_only() {
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/theme-options.css');
	wp_enqueue_style( 'wp-color-picker' );
	do_action('of_style_only_after');
}
function of_load_only() {
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('smof', ADMIN_DIR .'assets/theme-options.js', array( 'jquery' ));
	wp_enqueue_script( 'wp-color-picker' );
	if ( function_exists( 'wp_enqueue_media' ) ) wp_enqueue_media();
	do_action('of_load_only_after');
}

/* Build Options page */
function optionsframework_options_page() {
	global $options_machine;
	include_once( ADMIN_PATH . 'lib/markup.php' );
}

/* Ajax Save Options */
function of_ajax_callback() {
	global $options_machine, $of_options;
	$nonce=$_POST['security'];
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1');
	$all = of_get_options();
	$save_type = $_POST['type'];
	if($save_type == 'upload') {
		$clickedID = $_POST['data']; // acts as the name
		$filename = $_FILES[$clickedID];
		$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';
		$uploaded_file = wp_handle_upload($filename,$override);
		$upload_tracking[] = $clickedID;
		$upload_image = $all; // preserve current data
		$upload_image[$clickedID] = $uploaded_file['url'];
		of_save_options($upload_image);
		if(!empty($uploaded_file['error'])) {
			echo __('Upload Error: ','royalgold') . $uploaded_file['error'];
		} else {
			echo $uploaded_file['url'];
		}
	} elseif ($save_type == 'image_reset') {
		$id = $_POST['data']; // acts as the name
		$delete_image = $all; //preserve rest of data
		$delete_image[$id] = ''; // update array key with empty value
		of_save_options($delete_image ) ;
	} elseif ($save_type == 'backup_options') {
		$backup = $all;
		$backup['backup_log'] = date('r');
		of_save_options($backup, BACKUPS) ;
		die('1'); 
	} elseif ($save_type == 'restore_options') {
		$smof_data = of_get_options(BACKUPS);
		of_save_options($smof_data);
		die('1'); 
	} elseif ($save_type == 'import_options'){
		$smof_data = unserialize(base64_decode($_POST['data'])); //100% safe - ignore theme check nag
		of_save_options($smof_data);
		die('1'); 
	} elseif ($save_type == 'save') {
		wp_parse_str(stripslashes($_POST['data']), $smof_data);
		unset($smof_data['security']);
		unset($smof_data['of_save']);
		of_save_options($smof_data);
		die('1');
	} elseif ($save_type == 'reset') {
		of_save_options($options_machine->Defaults);
		die('1');
	}
	die();
}


/* Head Hook */
function of_head() {
	do_action( 'of_head' );
}

/* Add default options upon activation else DB does not exist */
function of_option_setup() {
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
	if (!of_get_options()) {
		of_save_options($options_machine->Defaults);
	}
}

/* Change activation message */
function optionsframework_admin_message() {
?>
	<script type="text/javascript">
		jQuery(function(){
			jQuery('.themes-php #message2').html('<p><?php printf( __( "This theme comes with an %s to configure settings. It is recommanded you also visit the %s and %s.", 'royalgold' ), '<a href="' . admin_url('themes.php?page=optionsframework') .'">' . __('options panel', 'royalgold') . '</a>', '<a href="' . admin_url('widgets.php') .'">' . __('widgets editor', 'royalgold') . '</a>','<a href="' . admin_url('nav-menus.php') .'">' . __('menu editor', 'royalgold') . '</a>' ); ?></p>');
		});
	</script>
<?php
}

/* Get header classes */
function of_get_header_classes_array() {
	global $of_options;
	foreach ($of_options as $value) {
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));
	}
	return $hooks;
}

/* Get options from the database and process them with the load filter hook. */
function of_get_options($key = null, $data = null) {
	global $smof_data;
	do_action('of_get_options_before', array(
		'key'=>$key,
		'data'=>$data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();
	}
	$data = apply_filters('of_options_after_load', $data);
	if ($key == null) {
		$smof_data = $data;
	} else {
		$smof_data[$key] = $data;
	}
	do_action('of_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;
}

/* Save options to the database after processing them */
function of_save_options($data, $key = null) {
	global $smof_data;
	if (empty($data)) return;

	do_action('of_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('of_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ( $data as $k=>$v ) {
			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
		}
	}
	do_action('of_save_options_after', array(
		'key'=>$key, 'data'=> $data
	));
}

/* For use in themes */
of_get_options();
if (!isset($smof_details)) $smof_details = array();