<?php
if(!defined('AIT_CUSTOM_FIELDS')){define('AIT_CUSTOM_FIELDS', false);}

/* ALL THEME PACKAGES */
class ThemePackages {
	private $avalaible = array();
	private $enabled = array();
	private $ordered_packages = array();

	public function __construct(){
		$options = aitOptions()->getOptionsByType('theme');
		foreach($options['packages']['packageTypes'] as $package){
			$options = array(
				'adminApprove' 		=> isset($package['adminApprove']) ? (bool)$package['adminApprove'] : false,
				'adminApproveEdit' 	=> isset($package['adminApproveEdit']) ? (bool)$package['adminApproveEdit'] : false,
				'featured'			=> isset($package['itemsFeatured']) ? (bool)$package['itemsFeatured'] : false,
				'maxItems' 			=> $package['maxItems'],
				'expirationLimit' 	=> $package['expirationLimit'],
				/*'payment' 			=> isset($package['payment']) ? $package['payment'] : 'payment-id-0',*/
				'price'				=> isset($package['price']) ? $package['price'] : 0
			);
			$options = apply_filters( 'ait_add_package_option', $options, $package );

			$features = array(
				'package_feature_editor'			=> isset($package['capabilityEditor']) ? (bool)$package['capabilityEditor'] : false,
				'package_feature_editor_media'		=> isset($package['capabilityMedia']) ? (bool)$package['capabilityMedia'] : false,
				'package_feature_excerpt'			=> isset($package['capabilityExcerpt']) ? (bool)$package['capabilityExcerpt'] : false,
				'package_feature_image'				=> isset($package['capabilityImage']) ? (bool)$package['capabilityImage'] : false,
				'package_feature_comments'			=> isset($package['capabilityComments']) ? (bool)$package['capabilityComments'] : false,

				'package_feature_yoastSeo'			=> isset($package['capabilityYoastseo']) ? (bool)$package['capabilityYoastseo'] : false,

				// theme specific features
				'_ait-item_item-data_featuredItem'			=> isset($package['itemsFeatured']) ? (bool)$package['itemsFeatured'] : false,

				'_ait-item_item-data_headerType'			=> isset($package['capabilityHeaderType']) ? (bool)$package['capabilityHeaderType'] : false,
				'_ait-item_item-data_headerType-image'		=> isset($package['capabilityHeaderType']) ? (bool)$package['capabilityHeaderType'] : false,

				'_ait-item_item-data_map'					=> isset($package['capabilityAddress']) ? (bool)$package['capabilityAddress'] : false,
				'_ait-item_item-data_telephone'				=> isset($package['capabilityTelephone']) ? (bool)$package['capabilityTelephone'] : false,
				'_ait-item_item-data_telephoneAdditional'	=> isset($package['capabilityTelephone']) ? (bool)$package['capabilityTelephone'] : false,
				'_ait-item_item-data_email'					=> isset($package['capabilityEmail']) ? (bool)$package['capabilityEmail'] : false,
				'_ait-item_item-data_web'					=> isset($package['capabilityWeb']) ? (bool)$package['capabilityWeb'] : false,
				'_ait-item_item-data_webLinkLabel'			=> isset($package['capabilityWeb']) ? (bool)$package['capabilityWeb'] : false,

				'_ait-item_item-data_showEmail'				=> isset($package['capabilityEmail']) ? (bool)$package['capabilityEmail'] : false,
				'_ait-item_item-data_contactOwnerBtn'		=> isset($package['capabilityEmail']) ? (bool)$package['capabilityEmail'] : false,

				'_ait-item_item-data_itemOpeningHours'		=> isset($package['capabilityOpeningHours']) ? (bool)$package['capabilityOpeningHours'] : false,
				'_ait-item_item-data_itemSocialIcons'		=> isset($package['capabilitySocialIcons']) ? (bool)$package['capabilitySocialIcons'] : false,
				'_ait-item_item-data_itemGallery'			=> isset($package['capabilityGallery']) ? (bool)$package['capabilityGallery'] : false,
				'_ait-item_item-data_itemFeatures'			=> isset($package['capabilityFeatures']) ? (bool)$package['capabilityFeatures'] : false,
			);
			$features = apply_filters('ait_add_package_feature', $features, $package );
			
			$slug = isset($package['slug']) ? $package['slug'] : str_replace(".", "", uniqid("", true)); 	// if there is no slug stored, create a new one | bug prevention
			$desc = isset($package['desc']) ? $package['desc'] : "";

			array_push($this->avalaible, new ThemePackage($package['name'], $slug, $desc, $options, $features));
			//array_push($this->ordered_packages, "cityguide_".AitUtils::webalize($package['name']) );
			array_push($this->ordered_packages, "cityguide_".$slug );
		}

		$this->loadEnabled();

		//add_action('init', array(__CLASS__, 'init'), 9, 0);
	}

	public function init(){
		$packages = new ThemePackages();

		$similar = array();
		foreach ($packages->getEnabled() as $role) {
			$slug = $role->name;
			if($packages->getPackageBySlug($role->name) == null){
				// this is unique old
				remove_role($role->name);
			} else {
				// this is similar
				array_push($similar,$role->name);
				$packages->getPackageBySlug($role->name)->updateWpCapabilities();
			}
		}

		// enable new packages from cloneable input
		foreach ($packages->getAvalaible() as $package) {
			if(!isset($similar[$package->getSlug()])){
				// this is unique new
				$package->enable();
			}
		}
	}

	public function getOrderedPackages(){
		return $this->ordered_packages;
	}

	private function loadEnabled(){
		global $wp_roles;
		foreach($wp_roles->role_objects as $key => $role){
			if(strpos($key, 'cityguide_') !== FALSE){
				$this->enabled[$key] = $role;
			}
		}
	}

	public function getEnabled(){
		return $this->enabled;
	}

	public function getAvalaible(){
		return $this->avalaible;
	}

	public function getPackageBySlug($slug){
		$result = null;
		foreach($this->avalaible as $themePackage){
			if($themePackage->getSlug() == $slug){
				$result = $themePackage;
			}
		}
		return $result;
	}
}

/* SINGLE THEME PACKAGE */
class ThemePackage {
	private $enabled;

	private $name;
	private $desc;
	private $slug;

	private $options;

	private $features;

	private $wp_avalaible_caps = array(
		'ait_toolkit_items_edit_item',
		'ait_toolkit_items_edit_items',
		'ait_toolkit_items_read_item',
		'ait_toolkit_items_read_items',
		'ait_toolkit_items_publish_items',
		'ait_toolkit_items_delete_items',
		'ait_toolkit_items_delete_published_items',
		'ait_toolkit_items_edit_published_items',
		'ait_toolkit_items_category_assign_items',
		'ait_toolkit_items_category_assign_locations',
		'ait_toolkit_eventspro_edit_event',
		'ait_toolkit_eventspro_edit_events',
		'ait_toolkit_eventspro_read_event',
		'ait_toolkit_eventspro_read_events',
		'ait_toolkit_eventspro_publish_events',
		'ait_toolkit_eventspro_delete_events',
		'ait_toolkit_eventspro_delete_published_events',
		'ait_toolkit_eventspro_edit_published_events',
		'ait_toolkit_eventspro_category_assign_events_pro',
		'read',
		'upload_files',
		'delete_published_posts',
		'delete_posts'
	);
	private $wp_enabled_caps = array();

	public function __construct($name, $slug, $desc, $options = array(), $features = array()){
		$this->name = $name;
		$this->desc = $desc;
		//$this->slug = "cityguide_".AitUtils::webalize($this->name);
		$this->slug = "cityguide_".$slug;

		$this->options = $options;
		$this->features = $features;

		// wp capabilities setup
		foreach($this->wp_avalaible_caps as $capName) {
			if($capName == 'ait_toolkit_items_publish_items' || $capName == 'ait_toolkit_eventspro_publish_events'){
				$this->wp_enabled_caps[$capName] = (bool)!$this->options['adminApprove'];
			} else {
				$this->wp_enabled_caps[$capName] = true;
			}
		}
	}

	public function getName(){
		return $this->name;
	}

	public function getDesc(){
		return $this->desc;
	}

	public function getSlug(){
		return $this->slug;
	}

	public function getOptions(){
		return $this->options;
	}

	public function getFeatures(){
		return $this->features;
	}

	public function enable(){
		$this->enabled = true;
		$this->register();
		$this->setupCustomFeatures();
	}

	public function disable(){
		$this->enabled = false;
		$this->deregister();
	}

	private function register(){
		global $wp_roles;
		add_role($this->slug, $this->name, $this->wp_enabled_caps);
	}

	private function deregister(){
		global $wp_roles;
		remove_role($this->slug);
	}

	private function enableCapability($capablity){
		global $wp_roles;
		$wp_roles->role_objects[$this->slug]->add_cap($capablity, true);
	}

	private function disableCapability($capablity){
		global $wp_roles;
		$wp_roles->role_objects[$this->slug]->remove_cap($capablity);
	}

	public function updateWpCapabilities(){
		foreach($this->wp_enabled_caps as $key => $val) {
			if($val == true){
				$this->enableCapability($key);
			} else {
				$this->disableCapability($key);
			}
		}
	}

	public function setupCustomFeatures(){
		foreach($this->features as $key => $val){
			if($val == true){
				$this->enableCapability($key);
			} else {
				$this->disableCapability($key);
			}
		}
		if(AIT_CUSTOM_FIELDS == false){
			$this->disableCapability('_ait-item_item-data_itemCustomFields');
		}
	}
}

/* INIT FUNCTIONS */
$packages = new ThemePackages();
$packages->init();
/* INIT FUNCTIONS */

/* AIT PERMISSIONS CLASS FUNCTIONS */
function addRole($name, $capabilities){
	global $wp_roles;
	$slug = str_replace(" ", "_", strtolower(trim($name)));
	$result = add_role($slug, $name, $capabilities);
}

function removeRole($name){
	global $wp_roles;
	$slug = str_replace(" ", "_", strtolower(trim($name)));
	remove_role($slug);
}

function enableRoleCapability($role, $capablity){
	global $wp_roles;
	if(!empty($wp_roles->role_objects[$role]) and !isset($wp_roles->role_objects[$role]->capabilities[$capablity])){
		$wp_roles->role_objects[$role]->add_cap($capablity, true);
	}
}

function disableRoleCapability($role, $capablity){
	global $wp_roles;
	if(!empty($wp_roles->role_objects[$role]) and isset($wp_roles->role_objects[$role]->capabilities[$capablity])){
		$wp_roles->role_objects[$role]->remove_cap($capablity);
	}
}

function getThemeUserRoles(){
	global $wp_roles;
	$result = array();
	foreach($wp_roles->role_objects as $key => $role){
		if(strpos($key, 'cityguide_') !== FALSE){
			$result[$key] = $role;
		}
	}
	return $result;
}

function getThemeUserRole($key){
	global $wp_roles;
	$result = null;
	$key = "cityguide_".strtolower($key);
	if(!empty($wp_roles->role_objects[$key])){
		return $wp_roles->role_objects[$key];
	}
	return $result;
}

function isThemeUserRole($key){
	global $wp_roles;
	$result = false;
	if(strpos($key, 'cityguide_') !== FALSE){
		return true;
	}
	return $result;
}

function getRoleDisplayName($slug){
	global $wp_roles;
	$result = "";
	if(!empty($wp_roles->role_names[$slug])){
		$result = $wp_roles->role_names[$slug];
	}
	return $result;
}
/* AIT PERMISSIONS CLASS FUNCTIONS */

function initAdminCapabilities(){
	$toolkitItemCapabilities = array(
		'ait_toolkit_items_edit_item',
		'ait_toolkit_items_read_item',
		'ait_toolkit_items_delete_item',
		'ait_toolkit_items_edit_items',
		'ait_toolkit_items_edit_others_items',
		'ait_toolkit_items_publish_items',
		'ait_toolkit_items_read_private_items',
		'ait_toolkit_items_read_items',
		'ait_toolkit_items_delete_items',
		'ait_toolkit_items_delete_private_items',
		'ait_toolkit_items_delete_published_items',
		'ait_toolkit_items_delete_others_items',
		'ait_toolkit_items_edit_private_items',
		'ait_toolkit_items_edit_published_items',
		// category options
		'ait_toolkit_items_category_manage_items',
		'ait_toolkit_items_category_edit_items',
		'ait_toolkit_items_category_delete_items',
		'ait_toolkit_items_category_assign_items',
		'ait_toolkit_items_category_manage_locations',
		'ait_toolkit_items_category_edit_locations',
		'ait_toolkit_items_category_delete_locations',
		'ait_toolkit_items_category_assign_locations',
		'ait_toolkit_items_category_manage_tags',
		'ait_toolkit_items_category_edit_tags',
		'ait_toolkit_items_category_delete_tags',
		'ait_toolkit_items_category_assign_tags',
	);

	$toolkitEventCapabilities = array(
		'ait_toolkit_eventspro_edit_event',
		'ait_toolkit_eventspro_read_event',
		'ait_toolkit_eventspro_delete_events',
		'ait_toolkit_eventspro_edit_events',
		'ait_toolkit_eventspro_edit_others_events',
		'ait_toolkit_eventspro_publish_events',
		'ait_toolkit_eventspro_read_private_events',
		'ait_toolkit_eventspro_read_events',
		'ait_toolkit_eventspro_delete_events',
		'ait_toolkit_eventspro_delete_private_events',
		'ait_toolkit_eventspro_delete_published_events',
		'ait_toolkit_eventspro_delete_others_events',
		'ait_toolkit_eventspro_edit_private_events',
		'ait_toolkit_eventspro_edit_published_events',
		// category options
		'ait_toolkit_eventspro_category_manage_events_pro',
		'ait_toolkit_eventspro_category_edit_events_pro',
		'ait_toolkit_eventspro_category_delete_events_pro',
		'ait_toolkit_eventspro_category_assign_events_pro',
	);

	foreach($toolkitItemCapabilities as $capablity){
		enableRoleCapability('administrator', $capablity);
	}
	foreach($toolkitEventCapabilities as $capablity){
		enableRoleCapability('administrator', $capablity);
	}
}
add_action('init', 'initAdminCapabilities', 8, 0);

function initAdminFeatures(){
	$features = array(
		'package_feature_editor',
		'package_feature_editor_media',
		'package_feature_image',
		'package_feature_excerpt',
		'package_feature_comments',
		'package_feature_author',
		'package_feature_yoastSeo',
		'_ait-item_item-data_featuredItem',
		'_ait-item_item-data_headerType',
		'_ait-item_item-data_headerType-image',
		'_ait-item_item-data_map',
		'_ait-item_item-data_telephone',
		'_ait-item_item-data_telephoneAdditional',
		'_ait-item_item-data_email',
		'_ait-item_item-data_showEmail',
		'_ait-item_item-data_contactOwnerBtn',
		'_ait-item_item-data_web',
		'_ait-item_item-data_webLinkLabel',
		'_ait-item_item-data_itemOpeningHours',
		'_ait-item_item-data_itemSocialIcons',
		'_ait-item_item-data_itemGallery',
		'_ait-item_item-data_itemFeatures',
		'_ait-item_item-author_author',
	);
	foreach($features as $feature){
		enableRoleCapability('administrator', $feature);
	}

	if(AIT_CUSTOM_FIELDS === true){
		enableRoleCapability('administrator', '_ait-item_item-data_itemCustomFields');
	}
}
add_action('init', 'initAdminFeatures', 8, 0);

function currentUserPackageFeatures(){
	if(isCityguideUser()){
		// standard wordpress features
		remove_post_type_support( 'ait-item', 'page-attributes' );
		if(!current_user_can('package_feature_editor')){
			remove_post_type_support( 'ait-item', 'editor' );
		}
		if(!current_user_can('package_feature_editor_media')){
			remove_action( 'media_buttons', 'media_buttons' );
		}
		if(!current_user_can('package_feature_excerpt')){
			remove_post_type_support( 'ait-item', 'excerpt' );
		}
		if(!current_user_can('package_feature_image')){
			remove_post_type_support( 'ait-item', 'thumbnail' );
		}
		if(!current_user_can('package_feature_comments')){
			remove_post_type_support( 'ait-item', 'comments' );
		}
	}
}
add_action('admin_init', 'currentUserPackageFeatures', 10, 0);

function currentUserPluginFeatures(){
	if(isCityguideUser()){
		// Yoast SEO
		if(!current_user_can('package_feature_yoastSeo')){
			remove_meta_box('wpseo_meta', 'ait-item', 'normal');
		}

		// author metabox
		if(!current_user_can('package_feature_author')){
			remove_meta_box('ait-item-item-author-metabox', 'ait-item', 'advanced');
		}
	}
}
add_action('add_meta_boxes', 'currentUserPluginFeatures', 99);

add_action( 'wp_print_scripts', function(){
	// Yoast SEO
	if(!current_user_can('package_feature_yoastSeo')){
		// remove script
		wp_dequeue_script( 'yoast-seo-post-scraper' );
		wp_dequeue_script( 'yoast-seo-featured-image' );
	}
}, 100 );