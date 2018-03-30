<?php

class PeThemeController {

	protected $runtime;
	protected $defaultOptions;

	public function boot() {
		$this->localize();

		if (!is_admin()) {
			add_filter('pre_get_posts',array(&$this,"pre_get_posts_filter"));
		}

		// add post__in sorting
		add_filter("posts_orderby",array(&$this,"posts_orderby_filter"), 10, 2 );
		add_filter("redirect_canonical",array(&$this,"redirect_canonical_filter"), 10, 2 );
		add_filter("pe_theme_options",array(&$this,"pe_theme_options_filter"));

		add_action('pe_theme_metabox_config_post',array(&$this,'pe_theme_metabox_config_post'));
		add_action('pe_theme_metabox_config_project',array(&$this,'pe_theme_metabox_config_project'));
		add_action('pe_theme_metabox_config_page',array(&$this,'pe_theme_metabox_config_page'));

		PeGlobal::$config["content-width"] = 940;
		PeGlobal::$config["post-formats"] = array("image","video");
		PeGlobal::$config["nav-menus"]["main"] = __("Main menu",'Pixelentity Theme/Plugin');

		$this->media->w(940);
		$this->media->h(350);

		PeGlobal::$config["shortcodes"] = 
			array(
				  "BS_Tooltip",
				  "BS_Hero",
				  "BS_ContentBox",
				  "BS_Badge",
				  "BS_Label",
				  "BS_Button",
				  "BS_Alert",
				  "BS_Video"
				  );

		PeGlobal::$config["columns"] = 
			array(
				  __("2 Column layouts",'Pixelentity Theme/Plugin') =>
				  array(
						__("1/2 1/2",'Pixelentity Theme/Plugin') => "1/2 1/2", /*span6 span6*/
						__("1/3 2/3",'Pixelentity Theme/Plugin') => "1/3 2/3", /*span4 span8*/
						__("2/3 1/3",'Pixelentity Theme/Plugin') => "2/3 1/3", /*span8 span4*/
						__("1/4 3/4",'Pixelentity Theme/Plugin') => "1/4 3/4", /*span3 span9*/
						__("3/4 1/4",'Pixelentity Theme/Plugin') => "3/4 1/4", /*span9 span3*/
						__("5/6 1/6",'Pixelentity Theme/Plugin') => "5/6 1/6", /*span10 span2*/
						__("1/6 5/6",'Pixelentity Theme/Plugin') => "1/6 5/6", /*span2 span10*/
						),
				  __("3 Column layouts",'Pixelentity Theme/Plugin') =>
				  array(
						__("1/3 1/3 1/3",'Pixelentity Theme/Plugin') => "1/3 1/3 1/3", /*span4 span4 span4*/
						__("1/4 1/4 2/4",'Pixelentity Theme/Plugin') => "1/4 1/4 2/4", /*span3 span3 span6*/
						__("2/4 1/4 1/4",'Pixelentity Theme/Plugin') => "2/4 1/4 1/4", /*span6 span3 span3*/ 
						),

				  __("4 Column layouts",'Pixelentity Theme/Plugin') =>
				  array(
						__("1/4 1/4 1/4 1/4",'Pixelentity Theme/Plugin') => "1/4 1/4 1/4 1/4" /*span3 span3 span3 span3*/
						),
				  __("6 Column layouts",'Pixelentity Theme/Plugin') =>
				  array(
						__("1/6 1/6 1/6 1/6 1/6 1/6",'Pixelentity Theme/Plugin') => "1/6 1/6 1/6 1/6 1/6 1/6" /*span2 x 6*/
						)
				  );

		PeGlobal::$config["views"] = 
			array(
				  "SliderVolo",
				  "SliderVario",
				  "GalleryGrid",
				  "GallerySlider",
				  "GalleryCover",
				  "GalleryImages",
				  "Carousel",
				  "Blog",
				  "PortfolioGrid",
				  "Portfolio",
				  "PortfolioList",
				  "Layout",
				  "LayoutModuleText",
				  "LayoutModuleHeading",
				  "LayoutModuleVideo",
				  "LayoutModuleView",
				  "LayoutModuleVideo",
				  "LayoutModuleCallToAction",
				  "LayoutModuleFeaturedProject",
				  "LayoutModuleServices",
				  "LayoutModuleStaff",
				  "LayoutModuleTestimonials",
				  "LayoutModuleSpacer",
				  "LayoutModuleColumns",
				  "LayoutModuleContainer",
				  "LayoutModuleHomeColumns",
				  "LayoutModuleHomeColumn",
				  "LayoutModuleForm",
				  "LayoutModuleGmap",
				  "LayoutModuleTabs",
				  "LayoutModuleTabsItem",
				  "LayoutModuleTabsItemContainer",
				  "LayoutModuleAccordion",
				  "LayoutModuleAccordionItem",
				  "LayoutModuleAccordionItemContainer",
				  "LayoutModuleFaqs",
				  "LayoutModuleFaqsItem",
				  "LayoutModuleFaqsItemContainer",
				  "LayoutModulePricingTable",
				  "LayoutModulePricingColumn"
				  );


		
		$brandingSection = isset($_GET["branding"]) ? __("Branding",'Pixelentity Theme/Plugin') : "hidden";
		
		$options = array(
						 "import_demo" => 
						 array(
							   "label"=>__("Import Demo Content",'Pixelentity Theme/Plugin'),
							   "type"=>"ImportDemo",
							   "section"=>__("General",'Pixelentity Theme/Plugin'),
							   "description" => __("Will import all demo data, including menus, sidebars, widgets and configuration",'Pixelentity Theme/Plugin'),
							   "default"=>"default"
							   ),
						 "favicon" => 
						 array(
							   "label"=>__("Favicon",'Pixelentity Theme/Plugin'),
							   "type"=>"Upload",
							   "section"=>__("General",'Pixelentity Theme/Plugin'),
							   "description" => __("This is the favicon for your site. The image can be a .jpg, .ico or .png with dimensions of 16x16px ",'Pixelentity Theme/Plugin'),
							   "default"=> PE_THEME_URL."/favicon.jpg"
							   ),
						 "customCSS" =>
						 array(
							   "label"=>__("Custom CSS",'Pixelentity Theme/Plugin'),
							   "type"=>"TextArea",
							   "section"=>__("General",'Pixelentity Theme/Plugin'),
							   "description" => __("Here you can enter custom CSS selectors to add to or overwrite the theme's default CSS styles. See the help documentation for some code snippets which can be pasted here",'Pixelentity Theme/Plugin'),
							   "default"=>""
							   ),
						 "customJS" =>
						 array(
							   "label"=>__("Custom JS",'Pixelentity Theme/Plugin'),
							   "type"=>"TextArea",
							   "section"=>__("General",'Pixelentity Theme/Plugin'),
							   "description" => __("Here you can enter custom javascript code and it will be added to the theme's existing javascript code",'Pixelentity Theme/Plugin'),
							   "default"=>""
							   ),
						 "adminLogo" => 
						 array(
							   "label"=>__("Custom Admin Panel Logo",'Pixelentity Theme/Plugin'),
							   "type"=>"Upload",
							   "section"=>$brandingSection,
							   "description" => __("Enter the url of the logo you would like to be displayed in this theme's custom options panel. The image should be aprox. 170x50px .png file. This field is hidden to prevent further rebranding. See the help docs for more info.",'Pixelentity Theme/Plugin'),
							   "default"=> PE_THEME_URL."/framework/images/framework_logo.png"
							   ),
						 "adminUrl" =>
						 array(
							   "label"=>__("Custom Admin Panel Url",'Pixelentity Theme/Plugin'),
							   "type"=>"Text",
							   "section"=>$brandingSection,
							   "description" => __("This is the link which will be added to the theme options panel's custom logo. This field is also hidden",'Pixelentity Theme/Plugin'),
							   "default"=>"http://pixelentity.com"
							   ),
						 "lazyImages" =>				
						 array(
							   "label"=>__("Lazy Loading",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", enables Lazy Loading. All image assets are loaded upon page load, with Lazy Loading enabled, images are only loaded once they are needed. Page loads faster and rendering requires less cpu , which is especially useful in mobile and tablet devices.','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"no"
							   ),
						 "thumbscache" =>				
						 array(
							   "label"=>__("Clear Thumbs Cache",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('The thumb cache shows all thumbs associated with a certain attachment in the media library thumb cropping control. These thumbs are auto generated by the theme at various sizes where the attachment had been used. If images are later removed, swapped, inserted elsewhere etc. all of the generated thumbnails will still appear in the cropping control dialog even though they may not be used anymore by the theme. There are 2 options to deal with this situation:<br/><br/><b>Hide</b>:<br/><br/>Removes all the thumbnails appearing in the cropping control dialog. Only those thumbnails loaded when the website is viewed become visible again in the cropping control area. Preview the page in a browser to see the required thumbs only in the dialog again. No thumbnails are deleted.<br/><br/><b>Delete:</b><br/><br/>Removes all the thumbnails appearing in the cropping control dialog and also deletes the thumbnail image files from the server. This option puts more of a strain on the server because images have to be regenerated, however it keeps the media folders free from unecessary thumbnail sizes.','Pixelentity Theme/Plugin'),
							   "options" => 
							   array(
									 __("No",'Pixelentity Theme/Plugin') => "",
									 __("Hide",'Pixelentity Theme/Plugin')=>"thumbnails",
									 __("Delete",'Pixelentity Theme/Plugin')=>"files"
									 ),
							   "default"=>""
							   ),
						 "retina" =>				
						 array(
							   "label"=>__("Retina Support",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", higher resolution images will be served to retina devices provided that your original images are big enough to create 2X versions. It requires lazy loading to work. ','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"no"
							   ),
						 "minifyJS" =>				
						 array(
							   "label"=>__("Javascript Compression",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", a single compressed javascript file will be loaded instead of multiple ones: site will load faster but any customization you made to theme javascript sources will be ignored','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"no"
							   ),
						 "minifyCSS" =>				
						 array(
							   "label"=>__("CSS Compression",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", a single compressed css file will be loaded instead of multiple ones: site will load faster but any customization you made to style.css or other theme stylesheet will be ignored','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"no"
							   ),
						 "adminThumbs" =>				
						 array(
							   "label"=>__("Show Thumbnails",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", shows thumbnails (featured images) in admin post list view.','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"yes"
							   ),
						 "mediaQuick" =>				
						 array(
							   "label"=>__("Enable Quick Browse Mode",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES", a new tab will appear in the default WordPress media uploader. This tab, named "Quick Browse" will display a filterable thumbnail grid of all uploaded media content. Media may be selected from this grid and added to galleries, posts and pages. When disabled, some functions related Galleries managment won\'t be available.','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"yes"
							   ),
						 "mediaQuickDefault" =>				
						 array(
							   "label"=>__("Make Quick Browse the Default Tab",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section" => __("Advanced",'Pixelentity Theme/Plugin'),
							   "description"=>__('If set to "YES" the default WordPress Media Loader\'s dialog  will display this "Quick Browse" mode as its default tab.','Pixelentity Theme/Plugin'),
							   "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							   "default"=>"no"
							   ),
						 "contactEmail" =>				
						 array(
							   "label"=>__("Email Address",'Pixelentity Theme/Plugin'),
							   "type"=>"Text",
							   "section" => __("Contact Form",'Pixelentity Theme/Plugin'),
							   "description"=>__('Enter the email address where the contact form emails will be sent. If this field is left blank, the Admin email address will be used. The Admin email address is that entered in General Settings > Email Address.','Pixelentity Theme/Plugin'),
							   "default"=>""
							   ),
						 "contactSubject" =>				
						 array(
							   "label"=>__("Subject Line",'Pixelentity Theme/Plugin'),
							   "type"=>"Text",
							   "section" => __("Contact Form",'Pixelentity Theme/Plugin'),
							   "description"=>__('Enter a custom subject line which will appear on all email sent from the contact form. This is useful when setting up email filters.','Pixelentity Theme/Plugin'),
							   "default"=>"Contact Form Message",
							   "wpml" => true
							   ),
						 "updateCheck" => 
						 array(
							   "label"=>__("Check for Theme Updates",'Pixelentity Theme/Plugin'),
							   "type"=>"RadioUI",
							   "section"=>__("Auto Update",'Pixelentity Theme/Plugin'),
							   "description" => __("Specify if theme should automatically check for updates.",'Pixelentity Theme/Plugin'),
							   "options" => 
							   array(
									 __("Yes",'Pixelentity Theme/Plugin') => "yes",
									 __("No",'Pixelentity Theme/Plugin') => "0",
									 ),
							   "default"=>"0"
							   ),
						 "updateUsername" => 
						 array(
							   "label"=>__("Envato Username",'Pixelentity Theme/Plugin'),
							   "type"=>"EnvatoUsername",
							   "section"=>__("Auto Update",'Pixelentity Theme/Plugin'),
							   "description" => __("Insert your Envato Username (account used to purchase this theme).",'Pixelentity Theme/Plugin'),
							   "default"=>""
							   ),
						 "updateAPIKey" => 
						 array(
							   "label"=>__("API Key",'Pixelentity Theme/Plugin'),
							   "type"=>"EnvatoAPI",
							   "section"=>__("Auto Update",'Pixelentity Theme/Plugin'),
							   "description" => __("Insert your API Key %swhich can be obtained here%s. (Generate one if none available)",'Pixelentity Theme/Plugin'),
							   "default"=>""
							   )

						 );

		if (function_exists("wp_enqueue_media")) {
			unset($options["mediaQuick"]);
			unset($options["mediaQuickDefault"]);
		}

		if ($this->is_ngg_active()) {
			$options["nggCustom"] = 
				array(
					  "label"=>__("Enable NextGen Plugin Integration",'Pixelentity Theme/Plugin'),
					  "type"=>"RadioUI",
					  "section"=>__("NextGen",'Pixelentity Theme/Plugin'),
					  "description" => __("If you have installed the NextGEN Gallery plugin, this option will enable it to be auto configured. See help docs for more info.",'Pixelentity Theme/Plugin'),
					  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
					  "default"=>"yes"
					  );
				
			$options["nggColumns"] = 
				array(
					  "label"=>__("Gallery columns",'Pixelentity Theme/Plugin'),
					  "type"=>"RadioUI",
					  "section"=>__("NextGen",'Pixelentity Theme/Plugin'),
					  "description" => __("Select the number of columns to be shown in the NextGen galleries",'Pixelentity Theme/Plugin'),
					  "single" => true,
					  "options" => range(1,3),
					  "default"=>3
					  );
		}

		$this->defaultOptions =& $options;
		PeGlobal::$config["options"] = $this->defaultOptions;

		// no common metaboxes
		PeGlobal::$config["metaboxes"] = array();

		// custom post types
		if (PE_THEME_PLUGIN) {
			do_action("pe_theme_custom_post_type");
		}
	}

	public function pe_theme_options_filter($options) {
		if (!PE_THEME_PLUGIN) {
			if (isset($options["import_demo"])) {
				unset($options["import_demo"]);
			}
		}
		return $options;
	}


	public function mboxGallery() {
		
		/*
		$options = $this->view->option(true,array(__("Gallery",'Pixelentity Theme/Plugin'),__("Slider",'Pixelentity Theme/Plugin')));

		if (count($options) === 0) {
			$options = 
				array(
					  __("No Gallery/Slider views avalable, please create one",'Pixelentity Theme/Plugin') => ""
					  );
		}
		*/

		$views = $this->view->supporting("gallery");

		$mbox =
			array(
				  "title" => __('Gallery','Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "gallery"
						),
				  "content" =>
				  array(
						"id" =>
						array(
							  "label" => __("Gallery",'Pixelentity Theme/Plugin'),
							  "description" => __("Select the gallery.",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "options" => $this->gallery->option()
							  ),
						"type" =>
						array(
							  "label" => __("Show as",'Pixelentity Theme/Plugin'),
							  "description" => __("Select how the gallery should be shown.",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "options" => $views,
							  "default" => current($views)
							  ),
						"width" =>
						array(
							  "label"=>__("Media Width",'Pixelentity Theme/Plugin'),
							  "type"=>"Number",
							  "description" => __("Leave empty to use default width.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"height" =>
						array(
							  "label"=>__("Media Height",'Pixelentity Theme/Plugin'),
							  "type"=>"Number",
							  "description" => __("Leave empty to avoid image cropping. In this case, slider based views will require all the (original) images to have the same size to work correctly.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  )
						)
				  );

		return $mbox;
	}


	public function pe_theme_metabox_config_post() {

		$mboxes =
			array(
				  "video" => PeGlobal::$const->video->metaboxPost,
				  "gallery" => $this->mboxGallery()
				  );
		 
		PeGlobal::$config["metaboxes-post"] =& $mboxes;
		return $mboxes;
	}

	public function pe_theme_metabox_config_page() {

		$bview = new PeThemeViewLayout();
		$mbox = $bview->mbox();

		$mboxBuilder = 
			array(
				  "title" => __("Builder",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => PE_THEME_MODE ? "page-builder" : "all"
						),
				  "content" => $mbox["content"]
				  );



		if (PE_THEME_MODE) {
			$mboxes = 
				array(
					  "layout" => $this->layout->mbox,
					  "builder" => $mboxBuilder,
					  "gmap" => PeGlobal::$const->gmap->metabox,
					  );
		} else {
			$mboxes["builder"] = $mboxBuilder;

		}

		PeGlobal::$config["metaboxes-page"] =& $mboxes;
		return $mboxes;
	}

	public function pe_theme_metabox_config_project() {

		$mboxes = 
			array(
				  //"footer" => PeGlobal::$const->sidebar->metaboxFooter,
				  "gallery" => $this->mboxGallery(),
				  "video" => PeGlobal::$const->video->metaboxPost
				  );
		PeGlobal::$config["metaboxes-project"] =& $mboxes;

		return $mboxes;
	}

	
	public function posts_orderby_filter($s,$q) {
		global $wpdb;
		if (!empty($q->query['post__in']) && isset($q->query['orderby']) && $q->query['orderby'] == 'post__in' )
			$s = "find_in_set({$wpdb->posts}.ID, '" . implode( ',', $q->query['post__in'] ) . "')";

		return $s;
	}	

	// WordPress removes the "page" parameter from the url when is_single() === true
	// we bring it back since we can allow custom (paged) loop in single posts
	public function redirect_canonical_filter($from,$to) {
		global $wp_rewrite;

		$pager = "";

		if ( get_query_var('paged') > 0 ) {
			$paged = get_query_var('paged');
			if ($paged > 1 && !is_feed() && is_single() ) {
				$pager = user_trailingslashit("$wp_rewrite->pagination_base/$paged", 'paged');
			}
		}

		return $to.$pager;
	}


	public function localize() {
		$tp = get_template_directory();

		load_theme_textdomain('Pixelentity Theme/Plugin',"$tp/languages");
		
		$locale = get_locale();
		$locale_file = "$tp/languages/$locale.php";
		
		if (is_readable($locale_file)) {
			require_once($locale_file);
		}
	}


	// after_theme_setup hook
	public function after_setup_theme() {
		if (isset(PeGlobal::$config["post-formats"])) {
			add_theme_support("post-formats",PeGlobal::$config["post-formats"]);
		}
		
		add_theme_support("post-thumbnails");
		add_theme_support("automatic-feed-links");
		
		if (!empty(PeGlobal::$config["theme-support"]["custom-header"])) {
			add_theme_support('custom-header',PeGlobal::$config["theme-support"]["custom-header"]);
		}

		if (!empty(PeGlobal::$config["theme-support"]["custom-background"])) {
			add_theme_support('custom-background',PeGlobal::$config["theme-support"]["custom-background"]);
		}

	}

	// init hook
    public function init() {

		// menus
		$nav_menu =& PeGlobal::$config["nav-menus"];
		if (isset($nav_menu) && count($nav_menu) > 0) {
			foreach ($nav_menu as $name => $description ) {
				register_nav_menu($name,$description);				
			}
		}

		$image_sizes =& PeGlobal::$config["image-sizes"];
		if (isset($image_sizes) && count($image_sizes) > 0) {
			foreach ($image_sizes as $name => $params ) {
				add_image_size($name,$params[0],$params[1],$params[2]);
			}
		}

		// taxonomies
		$taxonomies =& PeGlobal::$config["taxonomies"];
		if (isset($taxonomies) && count($taxonomies) > 0) {
			foreach ($taxonomies as $name=>$params) {
				register_taxonomy($name,$params[0],$params[1]);
			}
		}
		// custom post types
		$post_types =& PeGlobal::$config["post_types"];
		if (isset($post_types) && count($post_types) > 0) {
			foreach ($post_types as $name=>$params) {
				register_post_type($name,$params);
			}
		}

		// sidebars
		$this->sidebar->register();

		// shortcodes
		if (PE_THEME_PLUGIN) {
			$this->shortcode->add();
		}

		// instantiate content module
		$this->content->instantiate();

		if ($this->options->get("nggCustom") && $this->is_ngg_active()) {
			$this->ngg->instantiate();
		}

	}

	public function widgets_init() {
		// WPML plugin support
		if (defined('ICL_LANGUAGE_CODE')) {
			$this->wpml->instantiate();
		}

		$this->widget->add();
	}


	public function is_ngg_active() {
		return ($this->is_plugin_active("nextgen-gallery/nggallery.php"));
	}


	public function after_switch_theme($theme) {
		// update rewrite rules for custom post types
		flush_rewrite_rules();

		if (PE_THEME_PLUGIN_MODE) {
			return;
		}

		if (isset(PeGlobal::$config["image-sizes"]["thumbnail"])) {
			list($width,$height,$crop) = PeGlobal::$config["image-sizes"]["thumbnail"];
			update_option("thumbnail_size_w",$width);
			update_option("thumbnail_size_h",$height);
			update_option("thumbnail_crop",$crop);
		}

		if (isset(PeGlobal::$config["image-sizes"]["medium"])) {
			list($width,$height,$crop) = PeGlobal::$config["image-sizes"]["medium"];
			update_option("medium_size_w",$width);
			update_option("medium_size_h",$height);
		}

		if (isset(PeGlobal::$config["image-sizes"]["large"])) {
			list($width,$height,$crop) = PeGlobal::$config["image-sizes"]["large"];
			update_option("large_size_w",$width);
			update_option("large_size_h",$height);
		}

		wp_redirect(admin_url("themes.php?page=pe_theme_options"));

	}


	public function enqueueAssets() {
		$this->asset->enqueueAssets();
		global $wp_query;
	}

	public function &__get($what) {
		$runtime =& $this->runtime[$what];
		
		if (!isset($runtime)) {
			$m = "init_$what";
			if (method_exists($this,$m)) {
				$runtime = $this->$m();
			} else {
				throw new Exception("Unknown theme object: $what");
			}
		} 
		return $runtime;
	}

	public function get_template_part($slug,$name = null) {
		$this->template->inside($slug);
		if (PE_THEME_MODE) {
			get_template_part($slug,$name);
		} else {
			$templates = array();
			$name = (string) $name;
			if ( '' !== $name ) $templates[] = "{$slug}-{$name}.php";
			$templates[] = "{$slug}.php";
			if (locate_template($templates, false, false)) {
				get_template_part($slug,$name);
			} else {
				$base = dirname(PE_FRAMEWORK);
				foreach ($templates as $template) {
					$template = "$base/$template";
					if (file_exists($template)) {
						include($template);
						break;
					}
				}
			}
		}
		$this->template->outside();
	}

	public function pe_theme_resized_img_filter($markup,$url,$w,$h) {

		return sprintf('<img class="peLazyLoading" src="%s" data-original="%s" width="%s" height="%s" alt="" />',
					   $this->image->blank($w,$h),
					   $url,
					   $w,
					   $h
					   );
	}

	public function pe_theme_resized_retina_filter($markup,$url,$w,$h,$unscaled) {

		return sprintf('<img class="peLazyLoading" src="%s" data-original="%s" data-original-hires="%s" width="%s" height="%s" alt="" />',
					   $this->image->blank($w,$h),
					   $url,
					   $this->image->resizedImgUrl($unscaled,$w*2,$h*2),
					   $w,
					   $h
					   );
	}

	

	public function getMetaboxConfig($type) {
		static $cache;

		if (!empty($cache[$type])) {
			return $cache[$type];
		}

		do_action("pe_theme_metabox_config_$type");

		$config =& PeGlobal::$config;
		$metaboxes = PeGlobal::$config["metaboxes"];

	    $pmboxes = empty($config["metaboxes-$type"]) ? null : $config["metaboxes-$type"];

		if ($custom = apply_filters("pe_theme_metabox_$type",$pmboxes)) {
			//print_r(array_keys(PeGlobal::$config["metaboxes-view"]));
			$keys = array_keys($custom);
			foreach ($keys as $key) {
				$metaboxes[$key] = $custom[$key];
				$where =& $metaboxes[$key]["where"];
				list($orig,$values) = each($where);
				if ($orig != $type) {
					unset($where[$orig]);
					$where[$type] = $values;
				}
			}
		}
		$cache[$type] = $metaboxes;
		return $metaboxes;

	}

	
	protected function init_header() {
		return new PeThemeHeader();
	}

	protected function init_footer() {
		return new PeThemeFooter($this);
	}

	protected function init_layout() {
		return new PeThemeLayout($this);
	}

	protected function init_menu() {
		return new PeThemeMenu();
	}

	protected function init_category() {
		return new PeThemeCategory();
	}

	protected function init_sidebar() {
		return new PeThemeSidebar($this);
	}

	protected function init_content() {
		return new PeThemeContent($this);
	}

	protected function init_shortcode() {
		return new PeThemeSCManager($this);
	}

	protected function init_slide() {
		return new PeThemeSlide($this);
	}

	protected function init_widget() {
		return new PeThemeWGManager($this);
	}

	protected function init_asset() {
		return new PeThemeAsset($this);
	}

	protected function init_image() {
		return new PeThemeImage();
	}

	protected function init_utils() {
		return new PeThemeUtils();
	}

	protected function init_browser() {
		return new PeThemeBrowser();
	}

	protected function init_admin() {
		return new PeThemeAdmin($this);
	}

	protected function init_metabox() {
		return new PeThemeMBox($this);
	}

	protected function init_options() {
		return new PeThemeOptions($this);
	}

	protected function init_comments() {
		return new PeThemeComments($this);
	}

	protected function init_data() {
		return new PeThemeData($this);
	}

	protected function init_ngg() {
		return new PeThemeNgg($this);
	}

	protected function init_media() {
		return new PeThemeMedia($this);
	}

	protected function init_gallery() {
		return new PeThemeGallery($this);
	}

	protected function init_thumbnail() {
		return new PeThemeThumbnail($this);
	}

	protected function init_view() {
		return new PeThemeVManager($this);
	}

	protected function init_ptable() {
		return new PeThemePricingTable($this);
	}

	protected function init_staff() {
		return new PeThemeStaff($this);
	}

	protected function init_logo() {
		return new PeThemeLogo($this);
	}

	protected function init_testimonial() {
		return new PeThemeTestimonial($this);
	}

	protected function init_service() {
		return new PeThemeService($this);
	}

	protected function init_editor() {
		return new PeThemeEditor($this);
	}

	protected function init_video() {
		return new PeThemeVideo($this);
	}

	protected function init_project() {
		return new PeThemeProject($this);
	}

	protected function init_background() {
		return new PeThemeBackground($this);
	}

	protected function init_export() {
		return new PeThemeExport($this);
	}
	
	protected function init_template() {
		return new PeThemeTemplate($this);
	}

	protected function init_meta() {
		return new PeThemeMeta($this);
	}

	protected function init_font() {
		return new PeThemeFont($this);
	}

	protected function init_color() {
		return new PeThemeColor($this);
	}

	protected function init_wpml() {
		return new PeThemeWPML($this);
	}

	public function add_meta_boxes($page,$object) {
		return $this->metabox->add_meta_boxes($page,$object);
	}

	public function save_post($id,$post) {
		return $this->metabox->save_post($id,$post);
	}

	public function edit_attachment($id) {
		return $this->metabox->edit_attachment($id);
	}

	public function admin_menu() {
		return $this->admin->admin_menu();
	}

	public function admin_init() {
		return $this->admin->admin_init();
	}

	public function export_wp() {
		return $this->export->export_wp();
	}

	public function rss2_head() {
		return $this->export->rss2_head();
	}

	public function dbx_post_advanced() {
		if (PE_THEME_PLUGIN) {
			return $this->shortcode->admin();
		}
	}

	public function sidebar_admin_setup() {
		return $this->widget->admin();
	}
	
	public function is_plugin_active( $plugin ) {
        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || $this->is_plugin_active_for_network( $plugin );
	}

	public function is_plugin_active_for_network( $plugin ) {
        if ( !is_multisite() )
			return false;

        $plugins = get_site_option( 'active_sitewide_plugins');
        if ( isset($plugins[$plugin]) )
			return true;

        return false;
	}

	public function pre_get_posts_filter($query) {
		if ($query->is_search) {
			$query->set('post_type',array('post'));
		}
		return $query;
	}

	public function contactForm() {
		$data = array_map('stripslashes_deep',$_POST["data"]);
		$success = false;

		if (count($data) > 0) {
			$from = $to = (@$this->options->contactEmail) ? $this->options->contactEmail : get_bloginfo("admin_email");
			$email_text = "";

			foreach($data as $key => $value){
				if ($value != "") {
					if ($key == "email") {
						$from = $value;
					}
					$email_text.="<br><b>".ucfirst(str_replace("_", " ",$key))."</b> - ".nl2br($value);
				}
			}
			$subject = (@$this->options->contactSubject) ? @$this->options->contactSubject : "Contact from ".get_bloginfo('name');
			$from = "<$from>";

			if (isset($data["author"])) {
				$from = $data["author"]." $from";
			} else {
				$from = "User $from";
			}

			$headers = "From: $from\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=utf-8\n";
			$success = wp_mail($to, $subject, $email_text, $headers);
		}

		$response = json_encode(array("success" => $success,"mail"=>$email_text));
		header( "Content-Type: application/json" );
		echo $response;
		die();
	}

	public function newsletter() {
		$data = array_map('stripslashes_deep',$_POST["data"]);
		$success = false;
		$to = false;

		if (count($data) > 0 || !$data["email"] || !$data["instance"]) {

			if ($data["instance"] === "options") {
				$to = $this->options->get("newsletter");
			} else {
				list($instance,$id) = explode("-","widget_".$data["instance"]);
				$options = get_option($instance);
				if ($options && $options[$id]) {
					$to=$options[$id]["subscribe"];
				}
			}

			if ($to) { 

				$from = "Subscriber <".$data["email"].">";
				$email_text = "subscribe";

				$subject = "Subscribe from ".get_bloginfo('name');
				$headers = "From: $from\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=utf-8\n";
				$success = wp_mail($to, $subject, $email_text, $headers);
			}
		}

		$response = json_encode(array("success" => $success,"mail"=>$email_text));
		header( "Content-Type: application/json" );
		echo $response;
		die();
	}

}

?>