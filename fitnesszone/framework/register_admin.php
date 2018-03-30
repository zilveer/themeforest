<?php
add_action('admin_init', 'dt_theme_admin_options_init', 1);
add_action('admin_enqueue_scripts', 'dt_theme_admin_panel_scripts');

##Admin panel media uploader hooks( to alter the media uploder used to upload logo , favicon ... )
if (isset($_GET['mytheme_upload_button']) || isset($_POST['mytheme_upload_button']) && (isset($_GET['page']) && $_GET['page'] == 'parent')) :
	add_action('admin_init', 'dt_theme_image_upload_option');
endif;
## End hook

function dt_theme_admin_panel_scripts() {
	global $wp_version;

	wp_enqueue_style('thickbox');
	wp_enqueue_style('my-adminpanel', IAMD_FW_URL.'theme_options/style.css');

	echo "<script type=\"text/javascript\">
	//<![CDATA[
	var mysiteWpVersion = '$wp_version';
	//]]>\r</script>\r";

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');

	if (version_compare($wp_version, '3.5', '>=')) :
		wp_enqueue_style('wp-color-picker'); #New Color Picker
		wp_enqueue_script('wp-color-picker');		
	else :
		wp_enqueue_style('farbtastic'); #Color Picker
		wp_enqueue_script('farbtastic');
	endif;

	wp_enqueue_script('mytheme-tooltip', IAMD_FW_URL.'js/admin/jquery.tools.min.js');
	wp_enqueue_script('mytheme', IAMD_FW_URL.'js/admin/mytheme.admin.js');
	wp_enqueue_media();
	
	wp_localize_script('mytheme', 'objectL10n', array(
		'saveall' => __('Save All','iamd_text_domain'),
		'saving' => __('Saving ...','iamd_text_domain'),
		'resetConfirm' => __('This will restore all of your options to default. Are you sure?', 'iamd_text_domain'),
		'importConfirm' => __('You are going to import the dummy data provided with the theme, kindly confirm?', 'iamd_text_domain'),
		'disableImportMsg' => __('Importing is disabled.. :), Please set Disable Import to NO in Buddha Panel General Settings', 'iamd_text_domain'),
		'backupMsg' => __('Click OK to backup your current saved options.', 'iamd_text_domain'),
		'backupSuccess' => __('Your options are backuped successfully', 'iamd_text_domain'),
		'backupFailure' => __('Backup Process not working', 'iamd_text_domain'),
		'restoreMsg' => __('Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'iamd_text_domain'),
		'restoreSuccess' => __('Your options are restored from previous backup successfully', 'iamd_text_domain'),
		'restoreFailure' => __('Restore Process not working', 'iamd_text_domain'),
		'importMsg' => __('Click ok import options from the above textarea', 'iamd_text_domain'),
		'importSuccess' => __('Your options are imported successfully', 'iamd_text_domain'),
		'importFailure' => __('Import Process not working', 'iamd_text_domain'),
		'pageBuilderUpdate' => esc_html__('You page and post contents are updated successfully for page builder latest version!', 'iamd_text_domain'),
		'pageBuilderUpdateAlready' => esc_html__('Page builder updates are implemented already to your page and post contents!', 'iamd_text_domain')));
}

function dt_theme_admin_options_init() {
	register_setting(IAMD_THEME_SETTINGS, IAMD_THEME_SETTINGS);
	add_option(IAMD_THEME_SETTINGS, dt_theme_default_option());
	if (isset($_POST['mytheme-option-save'])) :
		mysite_ajax_option_save();
	endif;
	
	if (isset($_POST['mytheme']['reset'])) :
		delete_option(IAMD_THEME_SETTINGS);
		update_option(IAMD_THEME_SETTINGS, dt_theme_default_option()); # To set Default options
		wp_redirect(admin_url('admin.php?page=parent&reset=true'));
		exit;
	endif;
}

function mysite_ajax_option_save() {
	check_ajax_referer(IAMD_THEME_SETTINGS.'_wpnonce', 'dt_theme_admin_wpnonce');
	$data = $_POST;
	unset($data['_wp_http_referer'], $data['_wpnonce'], $data['action']);
	unset($data['dt_theme_admin_wpnonce'], $data['mytheme-option-save'], $data['option_page']);

	$msg = array('success' => false, 'message' => __('Error: Options not saved, please try again.', 'iamd_text_domain'));

	$data = array_filter($data[IAMD_THEME_SETTINGS]);

	if (get_option(IAMD_THEME_SETTINGS) != $data) {
		if (update_option(IAMD_THEME_SETTINGS, $data))
			$msg = array('success' => 'options_saved', 'message' => __('Options Saved.', 'iamd_text_domain'));
	} else {
		$msg = array('success' => true, 'message' => __('Options Saved.', 'iamd_text_domain'));
	}

	$echo = json_encode($msg);
	@header('Content-Type: application/json; charset='.get_option('blog_charset'));
	echo $echo;
	exit;
}

add_action('admin_head-toplevel_page_parent', 'dt_theme_admin_toplevel_scripts');
function dt_theme_admin_toplevel_scripts() {
	echo "<script type=\"text/javascript\">
	//<![CDATA[
	jQuery(document).ready(function(){
		mythemeAdmin.menuSort();
	});
	//]]>\r</script>\r";
}

function custom_login_logo() {
	$logo = dt_theme_option('advance', 'admin-login-logo-url');

	if ("true" == dt_theme_option('advance', 'enable-admin-login-logo-url')) :
		if (!empty($logo))
			echo '<style type="text/css">  div#login h1 a { background-image:url('.$logo.')} </style>';
	endif;
}
add_action('login_head', 'custom_login_logo');

function custom_logo() {
	$logo = dt_theme_option('advance', 'admin-logo-url');

	if ("true" == dt_theme_option('advance', 'enable-admin-logo-url')) :
		if (!empty($logo))
			echo '<style type="text/css"> #wp-admin-bar-wp-logo .ab-icon { background-image: url('.$logo.') !important;  background-position:0px !important;}</style>';
	endif;

}
add_action('admin_head', 'custom_logo');

#Ajax Import functionality
add_action('wp_ajax_dt_theme_ajax_importer', 'dt_theme_ajax_importer');
function dt_theme_ajax_importer() {
	require_once IAMD_CORE_PLUGIN . '/importer/import.php';
}
#Ajax Import functionality end

######### SAMPLE FONT PREVIEW ##########
add_action('wp_ajax_dt_theme_font_url', 'dt_theme_font_url');
function dt_theme_font_url() {
	$recieve_font = $_POST['font'];
	$font_url = array('url' => 'http'.dt_theme_ssl().'://fonts.googleapis.com/css?family='.str_replace(' ', '+', $recieve_font));
	die(json_encode($font_url));
}

#### BACKUP OPTION #####
add_action('wp_ajax_dt_theme_backup_and_restore_action', 'dt_theme_backup_and_restore_action');
function dt_theme_backup_and_restore_action() {

	$save_type = $_POST['type'];

	if ($save_type == 'backup_options') :
		$data = array('general' => dt_theme_option('general'),
			'appearance' => dt_theme_option('appearance'),
			'integration' => dt_theme_option('integration'),
			'seo' => dt_theme_option('seo'),
			'specialty' => dt_theme_option('specialty'),
			'widgetarea' => dt_theme_option("widgetarea"),
			'mobile' => dt_theme_option('mobile'),
			'advance' => dt_theme_option('advance'),
			'bbar' => dt_theme_option('bbar'),
			'backup' => date('r'));
		update_option("dt_theme_backup", $data);
		die('1');
	elseif ($save_type == 'restore_options') :
		$data = get_option("dt_theme_backup");
		update_option(IAMD_THEME_SETTINGS, $data);
		die('1');
	elseif ($save_type == "import_options") :
		$data = $_POST['data'];
		$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
		update_option(IAMD_THEME_SETTINGS, $data);
		die('1');
	elseif( $save_type == "reset_options") :
		delete_option(IAMD_THEME_SETTINGS);
		update_option(IAMD_THEME_SETTINGS, dt_theme_default_option()); # To set Default options
		die('1');
	endif;
}
?>