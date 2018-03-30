<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//AJAX callbacks------------------------------------------------------------

add_action('wp_ajax_change_options', array('TMM', 'change_options'));
add_action('wp_ajax_add_sidebar', array('TMM_Custom_Sidebars', 'add_sidebar'));
add_action('wp_ajax_add_sidebar_page', array('TMM_Custom_Sidebars', 'add_sidebar_page'));
add_action('wp_ajax_add_sidebar_category', array('TMM_Custom_Sidebars', 'add_sidebar_category'));
add_action('wp_ajax_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
add_action('wp_ajax_add_comment', array('TMM_Helper', 'add_comment'));
add_action('wp_ajax_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
add_action('wp_ajax_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
add_action('wp_ajax_save_google_fonts', array('TMM_HelperFonts', 'save_google_fonts'));
add_action('wp_ajax_add_seo_group', array('TMM_SEO_Group', 'add_seo_group'));
add_action('wp_ajax_add_seo_group_category', array('TMM_SEO_Group', 'add_seo_group_category'));
add_action('wp_ajax_get_resized_image_url', array('TMM_Helper', 'get_resized_image_url'));

add_action('wp_ajax_nopriv_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
add_action('wp_ajax_nopriv_add_comment', array('TMM_Helper', 'add_comment'));
add_action('wp_ajax_nopriv_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
add_action('wp_ajax_nopriv_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));

add_action('wp_ajax_add_new_cars_location', array('Carlocation_List_Table', 'add_new_cars_location'));
add_action('wp_ajax_delete_cars_location', array('Carlocation_List_Table', 'delete_cars_location'));

add_action('wp_ajax_update_cars_location', array('Carlocation_List_Table', 'update_cars_location'));

add_action('wp_ajax_doaction_delete_cars_locations', array('Carlocation_List_Table', 'doaction_delete_cars_locations'));
add_action('wp_ajax_doaction_delete_cars_state', array('Carlocation_List_Table', 'doaction_delete_cars_state'));
add_action('wp_ajax_doaction_delete_cars_country', array('Carlocation_List_Table', 'doaction_delete_cars_country'));

add_action('wp_ajax_add_post_podtype_gallery_image', array('TMM_Page', 'add_post_podtype_gallery_image'));

add_action('wp_ajax_tmm_dismiss_notice', 'tmm_dismiss_notice');

add_action('admin_menu', 'thememakers_theme_add_admin');
add_action('admin_enqueue_scripts', 'thememakers_theme_admin_head', 1);
add_action('admin_bar_menu', 'thememakers_theme_admin_bar_menu', 89);

global $pagenow;
if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {

	/* Set default options */
	TMM::register();

	$theme_was_activated = TMM::get_option('theme_was_activated');

	if (!$theme_was_activated) {
		$current_theme = get_option('stylesheet');
		$menu_id = wp_update_nav_menu_object(0, array('menu-name' => 'Primary Menu'));
		$theme_mods = get_option('theme_mods_' . $current_theme);
		$theme_mods['nav_menu_locations']['primary'] = $menu_id;
		update_option('theme_mods_' . $current_theme, $theme_mods);

		TMM::update_option('theme_was_activated', 1);
		TMM::update_option('sidebar_position', 'sbr');
		TMM::update_option('copyright_text', 'Copyright &copy; '.date('Y').'. <a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a>. All rights reserved');
	}

	if (is_child_theme()) {
		$child_theme_was_activated = TMM::get_option('child_theme_was_activated');

		if (!$child_theme_was_activated) {
			$current_theme = strtolower( get_option('stylesheet') );
			$parent_theme = strtolower( get_option('template') );
			$theme_mods = get_option('theme_mods_' . $parent_theme);
			update_option('theme_mods_' . $current_theme, $theme_mods);

			TMM::update_option('child_theme_was_activated', 1);
		}
	}

	/* Install cardealer tables */
	global $wpdb;

	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `tmm_cars_features` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `car_id` int(11) NOT NULL DEFAULT '0',
		  `time_length` int(11) NOT NULL DEFAULT '0',
		  `exp_date` int(11) NOT NULL DEFAULT '0',
		  `is_ended` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		);
	");

	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `tmm_cars_packets` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `packet_key` varchar(24) NOT NULL,
		  `start_date` int(11) NOT NULL,
		  `exp_date` int(11) NOT NULL,
		  `is_ended` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		);
	");

	$wpdb->query("
		CREATE TABLE IF NOT EXISTS `tmm_cars_locations` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `parent_id` int(11) NOT NULL,
		  `name` varchar(24) NOT NULL,
		  `slug` varchar(24) NOT NULL,
		   PRIMARY KEY (`id`),
		   INDEX (`parent_id`),
		   INDEX (`slug`)
		);
	");

}

add_action('admin_notices', 'thememakers_print_admin_notice');

function thememakers_print_admin_notice() {
	$notices = "";

	if (!is_writable(TMM_THEME_PATH . "/css/custom1.css") && !get_option('tmm_dismiss_custom-css1-notice')) {
		$notices .= sprintf(__('<div class="update-nag notice custom-css1-notice is-dismissible"><p>'
							. '<b>' . __('Notice:', 'cardealer') . ' </b>'
							. __('permissions 755 (in some cases 775) for %s/css/custom1.css file are required for correct theme work.', 'cardealer') . '<br>'
							. __('Please follow', 'cardealer') . ' <a href="'.THEMEMAKERS_LINK.'tutorials/permissions/" target="_blank">'
							. __('this link', 'cardealer') . '</a> ' . __('to read the instructions how to do it properly.', 'cardealer')
							. '</p></div>', 'cardealer'), TMM_THEME_PATH);
	}

	if (!is_writable(TMM_THEME_PATH . "/css/custom2.css") && !get_option('tmm_dismiss_custom-css2-notice')) {
		$notices .= sprintf(__('<div class="update-nag notice custom-css2-notice is-dismissible"><p>'
		                       . '<b>' . __('Notice:', 'cardealer') . ' </b>'
		                       . __('permissions 755 (in some cases 775) for %s/css/custom2.css file are required for correct theme work.', 'cardealer') . '<br>'
		                       . __('Please follow', 'cardealer') . ' <a href="'.THEMEMAKERS_LINK.'tutorials/permissions/" target="_blank">'
		                       . __('this link', 'cardealer') . '</a> ' . __('to read the instructions how to do it properly.', 'cardealer')
		                       . '</p></div>', 'cardealer'), TMM_THEME_PATH);
	}

	if (!is_writable(TMM_Ext_PostType_Car::get_image_upload_folder()) && !get_option('tmm_dismiss_image-upload-notice')) {
		$notices .= sprintf(__('<div class="update-nag notice image-upload-notice is-dismissible"><p>'
		                       . '<b>' . __('Notice:', 'cardealer') . ' </b>'
		                       . __('permissions 755 (in some cases 775) for %s directory are required for correct theme work.', 'cardealer') . '<br>'
		                       . __('Please follow', 'cardealer') . ' <a href="'.THEMEMAKERS_LINK.'tutorials/permissions/" target="_blank">'
		                       . __('this link', 'cardealer') . '</a> ' . __('to read the instructions how to do it properly.', 'cardealer')
		                       . '</p></div>', 'cardealer'), TMM_Ext_PostType_Car::get_image_upload_folder());
	}

	if ( (!class_exists('TMM_Theme_Features') || !class_exists('TMM_Content_Composer')) && !get_option('tmm_dismiss_required-plugins-notice') ) {
		$notices .= sprintf(__('<div class="update-nag notice required-plugins-notice is-dismissible"><p>'
		                       . '<b>' . __('Notice:', 'cardealer') . ' </b>'
		                       . __('For correct theme work you need to install ThemeMakers Required Plugins.', 'cardealer') . '<br>'
		                       . __('Please follow', 'cardealer') . ' <a href="' . admin_url('themes.php?page=tgmpa-install-plugins') . '">'
		                       . __('this link', 'cardealer') . '</a> ' . __('to proceed the installation.', 'cardealer')
		                       .'</a></p></div>', 'cardealer'), TMM_THEME_PATH);
	}

	echo $notices;
}

/* * ****************** functions *********************** */

function thememakers_theme_admin_bar_menu()
{
	global $wp_admin_bar;
	if (!is_super_admin() || !is_admin_bar_showing())
		return;
	$wp_admin_bar->add_menu(array(
		'id' => 'thememakers_link',
		'title' => __("Theme Options", 'cardealer'),
		'href' => admin_url() . 'themes.php?page=tmm_theme_options',
	));
}

function thememakers_theme_add_admin()
{
	add_theme_page(__("Theme Options", 'cardealer'), __("Theme Options", 'cardealer'), 'manage_options', 'tmm_theme_options', 'thememakers_theme_admin');
}

function thememakers_theme_admin()
{
	echo TMM::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/theme_options.php');
}

function thememakers_theme_admin_head()
{
	wp_enqueue_style("thememakers_admin_styles_css", TMM_THEME_URI . '/admin/css/styles.css');

	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-sortable');
	
	if ( isset($_GET['page']) && ($_GET['page'] == 'tmm_theme_options' || $_GET['page'] == 'tmm_cardealer_settings') ) {
		wp_enqueue_media();
	}

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thememakers_theme_admin_js', TMM_THEME_URI . '/admin/js/general.js', array('jquery'));

	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');

	wp_enqueue_style("thememakers_theme_fancybox_css", TMM_THEME_URI . '/js/fancybox/jquery.fancybox.css');

	wp_enqueue_script('thememakers_theme_fancybox_js', TMM_THEME_URI . '/js/jquery.fancybox.pack.js');
	wp_enqueue_script('thememakers_theme_colorpicker_js', TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.js');

	$translation_array = array(
		'required_fields' => __('Please fill all required fields!', 'cardealer'),
	);

	wp_localize_script('thememakers_theme_admin_js', 'tmm_l10n', $translation_array);
	wp_localize_script('tmm_theme', 'ajaxurl', admin_url('admin-ajax.php'));
	?>
	<!--[if IE]>
	<script>
		document.createElement('header');
		document.createElement('footer');
		document.createElement('section');
		document.createElement('aside');
		document.createElement('nav');
		document.createElement('article');
	</script>
	<![endif]-->
	<script type="text/javascript">
		var tmm_theme_options_url = "<?php echo admin_url('themes.php?page=tmm_theme_options&tmm_action=save_options'); ?>";
		//translations
		var lang_edit = "<?php _e('Edit', 'cardealer'); ?>";
		var lang_updated = "<?php _e('Updated', 'cardealer'); ?>";
		var lang_delete = "<?php _e('Delete', 'cardealer'); ?>";
		var lang_cancel = "<?php _e('Cancel', 'cardealer'); ?>";
		var lang_sure = "<?php _e('Sure?', 'cardealer'); ?>";
		var lang_one_moment = "<?php _e('One moment', 'cardealer') ?>";
		var cardealer_slug = "<?php echo TMM_Ext_PostType_Car::$slug ?>";
		var lang_loading = "<?php _e('Loading', 'cardealer') ?> ...";
		var lang_add_location_error1 = "<?php _e('Please enter location name!', 'cardealer') ?>";
		var lang_add_location_error2 = "<?php _e('Please select country!', 'cardealer') ?>";
		var lang_add_location_error3 = "<?php _e('Please select state!', 'cardealer') ?>";
		var lang_popup_close = "<?php _e('Close', 'cardealer') ?>";
		var lang_popup_apply = "<?php _e('Apply', 'cardealer') ?>";
	</script>

	<?php
}

/**
 * Dismiss admin notices (by ajax)
 */
function tmm_dismiss_notice() {
	if (isset($_POST['type'])) {
		$type = explode(' ', $_POST['type']);
		$notice = '';

		foreach ($type as $v) {
			if (strpos($v, '-notice') !== false) {
				$notice = trim($v);
				break;
			}
		}

		if ($notice) {
			update_option('tmm_dismiss_'.$notice, 1);
		}
		exit;

	}
}