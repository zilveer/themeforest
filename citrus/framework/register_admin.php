<?php
add_action('admin_init', 'dttheme_admin_options_init', 1);
add_action('admin_enqueue_scripts', 'dttheme_admin_panel_scripts');

##Admin panel media uploader hooks( to alter the media uploder used to upload logo , favicon ... )
if (isset($_GET['mytheme_upload_button']) || isset($_POST['mytheme_upload_button']) && (isset($_GET['page']) && $_GET['page'] == 'parent')) :
	add_action('admin_init', 'dttheme_image_upload_option');
endif;
## End hook

function dttheme_admin_panel_scripts() {
	global $wp_version;

	echo "<script type=\"text/javascript\">
	//<![CDATA[
	var mysiteWpVersion = '$wp_version';
	//]]>\r</script>\r";

	wp_enqueue_style('thickbox');

	wp_enqueue_style('dttheme-adminpanel', IAMD_FW_URL.'theme_options/style.css');	

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	
	if (version_compare($wp_version, '3.5', '>=')) :
		wp_enqueue_script('wp-color-picker'); #New Color Picker
		wp_enqueue_style('wp-color-picker'); #New Color Picker
	else :
		wp_enqueue_script('farbtastic'); #Color picker
		wp_enqueue_style('farbtastic'); #Color Picker
	endif;

	wp_enqueue_script('dttheme-tooltip', IAMD_FW_URL.'js/admin/jquery.tools.min.js');
	wp_enqueue_script('dttheme', IAMD_FW_URL.'js/admin/mytheme.admin.js');
	
	wp_localize_script('dttheme', 'objectL10n', array(
		'saveall' => __('Save All','dt_themes'),
		'saving' => __('Saving ...','dt_themes'),
		'resetConfirm' => __('This will restore all of your options to default. Are you sure?', 'dt_themes'),
		'importConfirm' => __('You are going to import the dummy data provided with the theme, kindly confirm?', 'dt_themes'),
		'disableImportMsg' => __('Importing is disabled.. :), Please set Disable Import to NO in Buddha Panel General Settings', 'dt_themes'),
		'backupMsg' => __('Click OK to backup your current saved options.', 'dt_themes'),
		'backupSuccess' => __('Your options are backuped successfully', 'dt_themes'),
		'backupFailure' => __('Backup Process not working', 'dt_themes'),
		'restoreMsg' => __('Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'dt_themes'),
		'restoreSuccess' => __('Your options are restored from previous backup successfully', 'dt_themes'),
		'restoreFailure' => __('Restore Process not working', 'dt_themes'),
		'importMsg' => __('Click ok import options from the above textarea', 'dt_themes'),
		'importSuccess' => __('Your options are imported successfully', 'dt_themes'),
		'importFailure' => __('Import Process not working', 'dt_themes')));
}

function dttheme_admin_options_init() {
	register_setting(IAMD_THEME_SETTINGS, IAMD_THEME_SETTINGS);
	add_option(IAMD_THEME_SETTINGS, dttheme_default_option());
	if (isset($_POST['mytheme-option-save'])) :
		dttheme_ajax_option_save();
	endif;
	
	if (isset($_POST['mytheme']['reset'])) :
		delete_option(IAMD_THEME_SETTINGS);
		update_option(IAMD_THEME_SETTINGS, dttheme_default_option()); # To set Default options
		wp_redirect(admin_url('admin.php?page=parent&reset=true'));
		exit;
	endif;
}

function dttheme_ajax_option_save() {
	check_ajax_referer(IAMD_THEME_SETTINGS.'_wpnonce', 'mytheme_admin_wpnonce');
	$data = $_POST;
	unset($data['_wp_http_referer'], $data['_wpnonce'], $data['action']);
	unset($data['mytheme_admin_wpnonce'], $data['mytheme-option-save'], $data['option_page']);

	$msg = array('success' => false, 'message' => __('Error: Options not saved, please try again.', 'dt_themes'));

	$data = array_filter($data[IAMD_THEME_SETTINGS]);
	
	if (get_option(IAMD_THEME_SETTINGS) != $data) {
		if (update_option(IAMD_THEME_SETTINGS, $data))
			$msg = array('success' => 'options_saved', 'message' => __('Options Saved.', 'dt_themes'));
	} else {
		$msg = array('success' => true, 'message' => __('Options Saved.', 'dt_themes'));
	}

	$echo = json_encode($msg);
	@header('Content-Type: application/json; charset='.get_option('blog_charset'));
	echo $echo;
	exit;
}

add_action('admin_head-toplevel_page_parent', 'dttheme_admin_toplevel_page_parent_scripts');
function dttheme_admin_toplevel_page_parent_scripts() {
	echo "<script type=\"text/javascript\">
	//<![CDATA[
	jQuery(document).ready(function(){
		mythemeAdmin.menuSort();
	});
	//]]>\r</script>\r";
}

#Ajax Import functionality
add_action('wp_ajax_dttheme_ajax_import_data', 'dttheme_ajax_import_data');
function dttheme_ajax_import_data() {
	require_once (get_template_directory () . '/framework/wordpress-importer/my-importer.php');
}
#Ajax Import functionality end

######### SAMPLE FONT PREVIEW ##########
add_action('wp_ajax_dttheme_font_url', 'dttheme_font_url');
function dttheme_font_url() {
	$recieve_font = $_POST['font'];
	$font_url = array('url' => 'http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $recieve_font));
	die(json_encode($font_url));
}

#### BACKUP OPTION #####
add_action('wp_ajax_dttheme_backup_and_restore_action', 'dttheme_backup_and_restore_action');
function dttheme_backup_and_restore_action() {

	$save_type = $_POST['type'];

	if ($save_type == 'backup_options') :
		$data = array("general" => dttheme_option('general'),
			"appearance" => dttheme_option('appearance'),
			"integration" => dttheme_option('integration'),
			"mobile" => dttheme_option('mobile'),
			"social" => dttheme_option('social'),
			"seo" => dttheme_option('seo'),
			'widgetarea' => dttheme_option("widgetarea"),
			"specialty" => dttheme_option('specialty'),
			"dt_course" => dttheme_option('dt_course'),
			"pagebuilder" => dttheme_option('pagebuilder'),
			"woo" => dttheme_option('woo'),
			
			'backup' => date('r'));
		update_option("mytheme_backup", $data);
		die('1');
	elseif ($save_type == 'restore_options') :
		$data = get_option("mytheme_backup");
		update_option(IAMD_THEME_SETTINGS, $data);
		die('1');
	elseif ($save_type == "import_options") :
		$data = $_POST['data'];
		$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
		update_option(IAMD_THEME_SETTINGS, $data);
		die('1');
	elseif( $save_type == "reset_options") :
		delete_option(IAMD_THEME_SETTINGS);
		update_option(IAMD_THEME_SETTINGS, dttheme_default_option()); # To set Default options
		die('1');
	endif;
}?>