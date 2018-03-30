<?php

class PeThemeVisia extends PeThemeController {

	public $preview = array();

	public function __construct() {
		// custom post types
		add_action("pe_theme_custom_post_type",array(&$this,"pe_theme_custom_post_type"));

		// wp_head stuff
		add_action("pe_theme_wp_head",array(&$this,"pe_theme_wp_head"));

		// google fonts
		add_filter("pe_theme_font_variants",array(&$this,"pe_theme_font_variants_filter"),10,2);

		// menu
		add_filter("wp_nav_menu_objects",array(&$this,"wp_nav_menu_objects_filter"),10,2);

		// social links
		add_filter("pe_theme_social_icons",array(&$this,"pe_theme_social_icons_filter"));
		add_filter("pe_theme_content_get_social_link",array(&$this,"pe_theme_content_get_social_link_filter"),10,4);

		// comment submit button class
		add_filter("pe_theme_comment_submit_class",array(&$this,"pe_theme_comment_submit_class_filter"));

		// use prio 30 so gets executed after standard theme filter
		add_filter("the_content_more_link",array(&$this,"the_content_more_link_filter"),30);

		// hide the admin bar (known to cause issues with the theme when enabled)
		show_admin_bar(false);

		// custom homepage meta js
		add_action( 'admin_enqueue_scripts', array( $this, 'pe_theme_visia_custom_meta_js' ) );

		// remove junk from project screen
		add_action('pe_theme_metabox_config_project',array(&$this,'pe_theme_visia_metabox_config_project'),200);

		// add featured image to testimonial
		add_action('init',array(&$this,'pe_theme_visia_testimonial_supports'),200);

		// shortcodes
		add_filter("pe_theme_shortcode_columns_mapping",array(&$this,"pe_theme_shortcode_columns_mapping_filter"));
		add_filter("pe_theme_shortcode_columns_options",array(&$this,"pe_theme_shortcode_columns_options_filter"));

		// portfolio
		add_filter("pe_theme_filter_item",array(&$this,"pe_theme_project_filter_item_filter"),10,4);

	}

	public function the_content_more_link_filter($link) {
		return sprintf('<a class="more-link" href="%s">%s</a>',get_permalink(),__("Continue Reading..",'Pixelentity Theme/Plugin'));
	}

	public function pe_theme_project_filter_item_filter($html,$aclass,$slug,$name) {
		return sprintf('<li class="%s" data-filter="%s">%s</li>',"filter",$slug === "" ? "all" : "filter-$slug",$name);
	}

	public function pe_theme_visia_custom_meta_js() {

		PeThemeAsset::addScript("js/visia-homepage-meta.js",array('jquery'),"pe_theme_visia_homepage_meta");

		$screen = get_current_screen();

		if ( is_admin() && 'page' === $screen->post_type ) {
			wp_enqueue_script("pe_theme_visia_homepage_meta");
		}

	}

	public function pe_theme_wp_head() {
		$this->font->apply();
		$this->color->apply();

		// custom CSS field
		if ($customCSS = $this->options->get("customCSS")) {
			printf('<style type="text/css">%s</style>',stripslashes($customCSS));
		}

		// custom JS field
		if ($customJS = $this->options->get("customJS")) {
			printf('<script type="text/javascript">%s</script>',stripslashes($customJS));
		}

	}

	public function pe_theme_font_variants_filter($variants,$font) {
		if ($font === "Open Sans") {
			$variants="$font:400italic,300,400,600,700";
		}
		return $variants;
	}

	public function wp_nav_menu_objects_filter($items,$args) {
		if (is_array($items) && !empty($args->theme_location)) {
			$home = false;

			if (is_page()) {
				if ($this->content->pageTemplate() === "page-home.php") {
					$home = get_page_link(get_the_id());
				}
			}

			foreach ($items as $id => $item) {
				if (!empty($item->post_parent)) {
					if ($item->object === "page") {
						$page = get_page($item->object_id);
						if (!empty($page->post_name)) {
							$parent = get_page_link($item->post_parent);
							$slug = $page->post_name;
							$items[$id]->url = "{$parent}#{$slug}";
						}
					}
				} else if ($item->url === $home) {
					$items[$id]->url .= "#home";
				}
			}
		}
		return $items;
	}

	public function pe_theme_social_icons_filter($icons = null) {
		return 
			array(
				  // label => icon | tooltip text
				  __("Twitter",'Pixelentity Theme/Plugin') => "icon-twitter large|Twitter",
				  __("Facebook",'Pixelentity Theme/Plugin') => "icon-facebook large|Facebook",
				  __("Linkedin",'Pixelentity Theme/Plugin') => "icon-linkedin large|Linkedin",
				  __("Pinterest",'Pixelentity Theme/Plugin') => "icon-pinterest large|Pinterest",
				  __("Skype",'Pixelentity Theme/Plugin') => "icon-skype large|Skype",
				  __("Forrst",'Pixelentity Theme/Plugin') => "icon-forrst large|Forrst",
				  __("YouTube",'Pixelentity Theme/Plugin') => "icon-youtube large|YouTube",
				  __("Gmail",'Pixelentity Theme/Plugin') => "icon-gmail large|Gmail",
				  __("WordPress",'Pixelentity Theme/Plugin') => "icon-wordpress large|WordPress",
				  __("Dropbox",'Pixelentity Theme/Plugin') => "icon-dropbox-1 large|Dropbox",
				  __("Instagram",'Pixelentity Theme/Plugin') => "icon-instagram large|Instagram",
				  __("Dribbble",'Pixelentity Theme/Plugin') => "icon-dribbble large|Dribbble",
				  __("Google+",'Pixelentity Theme/Plugin') => "icon-gplus large|Google+",
				  __("Vimeo",'Pixelentity Theme/Plugin') => "icon-vimeo large|Vimeo",
				  __("Flickr",'Pixelentity Theme/Plugin') => "icon-flickr large|Flickr",
				  __("Github",'Pixelentity Theme/Plugin') => "icon-github large|Github",
				  __("Picasa",'Pixelentity Theme/Plugin') => "icon-picasa large|Picasa",
				  __("Soundcloud",'Pixelentity Theme/Plugin') => "icon-soundcloud large|Soundcloud",
				  __("Behance",'Pixelentity Theme/Plugin') => "icon-behance large|Behance",
				  __("LinkedIn",'Pixelentity Theme/Plugin') => "icon-linkedin large|LinkedIn"

				  );
	}

	public function pe_theme_content_get_social_link_filter($html,$link,$tooltip,$icon) {
		return sprintf('<li><a href="%s" target="_blank" title="%s"><span class="icon-circle large"><i class="%s"></i></span></a></li>',$link,$tooltip,strtr($icon,array("linked_in"=>"linkedin")),$tooltip);
	}

	public function pe_theme_comment_submit_class_filter() {
		return "contour-btn red";
	}

	public function init() {
		parent::init();

		if (PE_THEME_PLUGIN_MODE) {
			return;
		}
		
		if ($this->options->get("retina") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_retina_filter"),10,5);
		} else if ($this->options->get("lazyImages") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_img_filter"),10,4);
		}
	}

	public function pe_theme_custom_post_type() {
		$this->gallery->cpt();
		$this->video->cpt();
		$this->project->cpt();
		//$this->ptable->cpt();
		$this->staff->cpt();
		$this->service->cpt();
		$this->testimonial->cpt();
		//$this->logo->cpt();
		//$this->slide->cpt();
		//$this->view->cpt();
	}

	public function pe_theme_shortcode_columns_mapping_filter($array) {
		return array(
					"1/3" => "grid-2",
					"1/2" => "grid-half",
					"2/3" => "grid-4",
					"1/6" => "grid-1",
					"last" => ""
			  );
		}

	public function pe_theme_shortcode_columns_options_filter($array) {
		unset($array['2 Column layouts']['5/6 1/6']);
		unset($array['2 Column layouts']['1/6 5/6']);
		unset($array['2 Column layouts']['1/4 3/4']);
		unset($array['2 Column layouts']['3/4 1/4']);
		unset($array['3 Column layouts']['1/4 1/4 2/4']);
		unset($array['3 Column layouts']['2/4 1/4 1/4']);
		unset($array['4 Column layouts']);
		//unset($array['6 Column layouts']);

		return $array;
	}


	public function boot() {
		parent::boot();

		
		PeGlobal::$config["content-width"] = 990;
		PeGlobal::$config["post-formats"] = array("video","gallery");
		PeGlobal::$config["post-formats-project"] = array("video","gallery");

		PeGlobal::$config["image-sizes"]["thumbnail"] = array(120,90,true);
		PeGlobal::$config["image-sizes"]["post-thumbnail"] = array(260,200,false);
		

		// blog layouts
		PeGlobal::$config["blog"] =
			array(
				  __("Default",'Pixelentity Theme/Plugin') => "",
				  __("Search",'Pixelentity Theme/Plugin') => "search",
				  __("Alternate",'Pixelentity Theme/Plugin') => "project"
				  );

		PeGlobal::$config["shortcodes"] = 
			array(
				  //"BS_Badge",
				  //"BS_Label",
				  //"BS_Button",
				  "VisiaHeading",
				  "VisiaTabs",
				  "VisiaAccordion",
				  "VisiaButton",
				  "VisiaAlert",
				  "BS_Columns",
				  "BS_Video"
				  );

		PeGlobal::$config["sidebars"] =
			array(
				  "default" => __("Default post/page",'Pixelentity Theme/Plugin'),
				  //"footer" => __("Footer Widgets",'Pixelentity Theme/Plugin')
				  );

		PeGlobal::$config["colors"] = 
			array(
				  "color1" => 
				  array(
						"label" => __("Primary Color",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  "a" => "color",
							  ".feature:hover" => "color",
							  "a:visited" => "color",
							  ".desktop.navigation .nav-content a:hover" => "color",
							  ".desktop.navigation .nav-content a.active" => "color",
							  ".post-title a:hover" => "color",
							  ".cat-item a:hover" => "color",
							  ".widget-archive a:hover" => "color",
							  ".filter.active, .filter:hover" => "color",
							  ".recentcomments a:hover" => "color", 
							  ".widget-recent-entries a:hover" => "color", 
							  ".comment-meta a:hover" => "color", 
							  ".required" => "color",
							  ".feature:hover .feature-icon" => "color",
							  ".sticky .post-title a" => "color",

							  ".gallery-next .bx-next:hover" => "background-color",
							  ".gallery-prev .bx-prev:hover" => "background-color",
							  ".parallax.colored" => "background-color",
							  ".list-dot" => "background-color",
							  ".projectlist a:hover .projectinfo" => "background-color",

							  "a.button" => "border-color",
							  ".tagcloud a" => "border-color",
							  ".tabs ul li.active a" => "border-top-color",
							  //".post .tags a" => "border-color"
							  
							  ),
						"default" => "#ee3b16"
						),
					"color2" => 
				  array(
						"label" => __("Primary Hover Color",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  "a:hover" => "color",
							  ".sticky .post-title a:hover" => "color",
							  "a.button:hover" => "border-color",
							  ".tagcloud a:hover" => "border-color",
							  //".post .tags a:hover" => "border-color"
							  
							  ),
						"default" => "#ffa593"
						)
				  );
		

		PeGlobal::$config["fonts"] = 
			array(
				  "fontBody" => 
				  array(
						"label" => __("General Font",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  "body",
							  ".form-field span input",
							  ".form-field span textarea",
							  ".form-click input",
							  ),
						"default" => "Open Sans"
						)
				  );


		

		$options = array();

		$options = array_merge($options,
			array(
				  "import_demo" => $this->defaultOptions["import_demo"],
				  "logo" => 
				  array(
						"label"=>__("Logo",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("This is the main site logo image. The image should be a .png file.",'Pixelentity Theme/Plugin'),
						"default"=> PE_THEME_URL."/images/logo.png"
						),
				  "favicon" => 
						 array(
							   "label"=>__("Favicon",'Pixelentity Theme/Plugin'),
							   "type"=>"Upload",
							   "section"=>__("General",'Pixelentity Theme/Plugin'),
							   "description" => __("This is the favicon for your site. The image can be a .jpg, .ico or .png with dimensions of 16x16px ",'Pixelentity Theme/Plugin'),
							   "default"=> PE_THEME_URL."/favicon.png"
							   ),
				  "customCSS" => $this->defaultOptions["customCSS"],
				  "customJS" => $this->defaultOptions["customJS"],
				  "footerCopyright" => 
				  array(
						"label"=>__("Copyright",'Pixelentity Theme/Plugin'),
						"wpml"=> true,
						"type"=>"TextArea",
						"section"=>__("Footer",'Pixelentity Theme/Plugin'),
						"description" => __("This is the footer copyright message.",'Pixelentity Theme/Plugin'),
						"default"=> sprintf('&copy;2013 Visia. All Rights Reserved.',"\n")
						),
				  "footerSocialLinks" => 
				  array(
						"label"=>__("Social Profile Links",'Pixelentity Theme/Plugin'),
						"type"=>"Items",
						"section"=>__("Footer",'Pixelentity Theme/Plugin'),
						"description" => __("Add one or more links to social networks.",'Pixelentity Theme/Plugin'),
						"button_label" => __("Add Social Link",'Pixelentity Theme/Plugin'),
						"sortable" => true,
						"auto" => __("Layer",'Pixelentity Theme/Plugin'),
						"unique" => false,
						"editable" => false,
						"legend" => false,
						"fields" => 
						array(
							  array(
									"label" => __("Social Network",'Pixelentity Theme/Plugin'),
									"name" => "icon",
									"type" => "select",
									"options" => apply_filters('pe_theme_social_icons',array()),
									"width" => 185,
									"default" => ""
									),
							  array(
									"name" => "url",
									"type" => "text",
									"width" => 300, 
									"default" => "#"
									)
							  ),
						"default" => ""
						),
				  "colors" =>
				  array(
						"label"=>__("Custom Colors",'Pixelentity Theme/Plugin'),
						"type"=>"Help",
						"section"=>__("Colors",'Pixelentity Theme/Plugin'),
						"description" => __("In this page you can set alternative colors for the main colored elements in this theme. Four color options have been provided. A primary color, a secondary or complimentary color, a primary or dark grey and a secondary or light grey. To change the colors used on these elements simply write a new hex color reference number into the fields below or use the color picker which appears when each field obtains focus. Once you have selected your desired colors make sure to save them by clicking the <b>Save All Changes</b> button at the bottom of the page. Then just refresh your page to see the changes.<br/><br/><b>Please Note:</b> Some of the elements in this theme are made from images (Eg. Icons) and these items may have a color. It is not possible to change these elements via this page, instead such elements will need to be changed manually by opening the images/icons in an image editing program and manually changing their colors to match your theme's custom color scheme. <br/><br/>To return all colors to their default values at any time just hit the <b>Restore Default</b> link beneath each field.",'Pixelentity Theme/Plugin'),
						),
				  "googleFonts" => 
				  array(
						"label"=>__("Custom Fonts",'Pixelentity Theme/Plugin'),
						"type"=>"Help",
						"section"=>__("Fonts",'Pixelentity Theme/Plugin'),
						"description" => __("In this page you can set the typefaces to be used throughout the theme. For each elements listed below you can choose any front from the Google Web Font library. Once you have chosen a font from the list, you will see a preview of this font immediately beneath the list box. The icons on the right hand side of the font preview, indicate what weights are available for that typeface.<br/><br/><strong>R</strong> -- Regular,<br/><strong>B</strong> -- Bold,<br/><strong>I</strong> -- Italics,<br/><strong>BI</strong> -- Bold Italics<br/><br/>When decideing what font to use, ensure that the chosen font contains the font weight required by the element. For example, main headings are bold, so you need to select a new font for these elements which supports a bold font weight. If you select a font which does not have a bold icon, the font will not be applied. <br/><br/>Browse the online <a href='http://www.google.com/webfonts'>Google Font Library</a><br/><br/><b>Custom fonts</b> (Advanced Users):<br/> Other then those available from Google fonts, custom fonts may also be applied to the elements listed below. To do this an additional field is provided below the google fonts list. Here you may enter the details of a font family, size, line-height etc. for a custom font. This information is entered in the form of the shorthand 'font:' CSS declaration, for example:<br/><br/><b>bold italic small-caps 1em/1.5em arial,sans-serif</b><br/><br/>If a font is specified in this field then the font listed in the Google font drop menu above will not be applied to the element in question. If you wish to use the Google font specified in the drop down list and just specify a new font size or line height, you can do so in this field also, however the name of the Google font <b>MUST</b> also be entered into this field. You may need to visit the Google fonts web page to find the exact CSS name for the font you have chosen.",'Pixelentity Theme/Plugin'),
						),
				  "contactEmail" => $this->defaultOptions["contactEmail"],
				  "contactSubject" => $this->defaultOptions["contactSubject"],
				  "contactPhone" => 
				  array(
						"label"=>__("Phone Number",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Phone number, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default"=> "+353 (0) 123 456 78"
						),
				  "contactAddress" => 
				  array(
						"label"=>__("Address",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Address, leave empty to hide (used only for display).",'Pixelentity Theme/Plugin'),
						"default"=> "1000 Coney Island Ave.<br> Brooklyn NY 11230"
						),
				  "contactAddressLink" => 
				  array(
						"label"=>__("Address Link",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Address Link, leave empty to hide (used for linking address to external map like Google Maps).",'Pixelentity Theme/Plugin'),
						"default"=> "#"
						),
				  "contactHeading" => 
				  array(
						"wpml"=> true,
						"label"=>__("Contact Form Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Message displayed above contact form.",'Pixelentity Theme/Plugin'),
						"default"=> "Get in touch"
						),
				  "msgOK" => 	
				  array(
						"wpml"=> true,
						"label"=>__("Mail Sent Message",'Pixelentity Theme/Plugin'),
						"type"=>"TextArea",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Message shown when form message has been sent without errors",'Pixelentity Theme/Plugin'),
						"default"=>'<strong>Yay!</strong> Message sent.'
						),
				  "msgKO" => 	
				  array(
						"wpml"=> true,
						"label"=>__("Form Error Message",'Pixelentity Theme/Plugin'),
						"type"=>"TextArea",
						"section"=>__("Contact Form",'Pixelentity Theme/Plugin'),
						"description" => __("Message shown when form message encountered errors",'Pixelentity Theme/Plugin'),
						"default"=>'<strong>Error!</strong> Please validate your fields.'
						),
				  "sidebars" => 
				  array(
						"label"=>__("Widget Areas",'Pixelentity Theme/Plugin'),
						"type"=>"Sidebars",
						"section"=>__("Widget Areas",'Pixelentity Theme/Plugin'),
						"description" => __("Create new widget areas by entering the area name and clicking the add button. The new widget area will appear in the table below. Once a widget area has been created, widgets may be added via the widgets page.",'Pixelentity Theme/Plugin'),
						"default"=>""
						),
				  ));

		$options = array_merge($options,$this->font->options());
		$options = array_merge($options,$this->color->options());

		$options["retina"] =& $this->defaultOptions["retina"];
		$options["lazyImages"] =& $this->defaultOptions["lazyImages"];
		$options["minifyJS"] =& $this->defaultOptions["minifyJS"];
		$options["minifyCSS"] =& $this->defaultOptions["minifyCSS"];

		$options["adminThumbs"] =& $this->defaultOptions["adminThumbs"];
		if (!empty($this->defaultOptions["mediaQuick"])) {
			$options["mediaQuick"] =& $this->defaultOptions["mediaQuick"];
			$options["mediaQuickDefault"] =& $this->defaultOptions["mediaQuickDefault"];
		}

		//$options["updateCheck"] =& $this->defaultOptions["updateCheck"];
		//$options["updateUsername"] =& $this->defaultOptions["updateUsername"];
		//$options["updateAPIKey"] =& $this->defaultOptions["updateAPIKey"];

		$options["adminLogo"] =& $this->defaultOptions["adminLogo"];
		$options["adminUrl"] =& $this->defaultOptions["adminUrl"];

		
		
		PeGlobal::$config["options"] = apply_filters("pe_theme_options",$options);

	}

	public function pe_theme_metabox_config_post() {
		parent::pe_theme_metabox_config_post();

		unset( PeGlobal::$config["metaboxes-post"]['gallery']['content']['type'] );
	}

	public function pe_theme_metabox_config_page() {

		$bgMbox = 
			array(
				  "title" => __("Settings.",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "page_home"
						),
				  "content" =>
				  array(
				  		"type" =>				
						array(
							  "label"=>__("Landing page type",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description"=>__('You can choose between slider and static image landing page types.','Pixelentity Theme/Plugin'),
							  "options" => Array(__("Slider",'Pixelentity Theme/Plugin')=>"slider",__("Image",'Pixelentity Theme/Plugin')=>"image",__("Video",'Pixelentity Theme/Plugin')=>"video"),
							  "default"=>"image"
							  ),
						"video" => 
						array(
							  "label"=>__("Video Upload",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Upload video in MP4 format. Note that you should upload the .ogv fomratted video with the same name in the same folder, as some browsers do not support MP4 playback. Also note that MP4 video should not use H.264 compression type as Chrome no longer supports it. Video playback is not possible on mobile devices, to cover that, upload the image of .jpg format that has the same name as the video file, in the same folder. That image will be used instead of video on mobile devices.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/images/video/video.mp4"
							  ),
						"gallery" => 
						array(
							  "label"=>__("Slider Gallery",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "options" => $this->gallery->option(),
							  "description" => __("Select a gallery used for a landing page.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"background" => 
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Background images.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/images/bg.jpg"
							  ),
						"headlines" => 
						array(
							  "label"=>__("Headlines",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "sortable" => true,
							  "description" => __("Add one or more headlines to be shown above the home backgaround.",'Pixelentity Theme/Plugin'),
							  "default"=>
							  array(
									__("Creative solutions.",'Pixelentity Theme/Plugin'),
									__("Creative ideas.",'Pixelentity Theme/Plugin'),
									__("Creative design.",'Pixelentity Theme/Plugin'),
									)
							  ),
						"label1" => 
						array(
							  "label"=>__("Label 1 Text",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("If empty, hides the label 1.",'Pixelentity Theme/Plugin'),
							  "default"=> __("Learn more",'Pixelentity Theme/Plugin')
							  ),
						"url1" => 
						array(
							  "label"=>__("Label 1 Url",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=> "#about-us"
							  ),
						"label2" => 
						array(
							  "label"=>__("Label 2 Text",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("If empty, hides the label 2.",'Pixelentity Theme/Plugin'),
							  "default"=> __("Buy Now",'Pixelentity Theme/Plugin')
							  ),
						"url2" => 
						array(
							  "label"=>__("Label 2 Url",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=> "#"
							  )
						)
				  );

		$servicesMbox = 
			array(
				  "title" => __("Settings.",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "page_services"
						),
				  "content" =>
				  array(
				  		"background" => 
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Background images.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/images/bg.jpg"
							  ),
						"services" => 
						array(
							  "label"=>__("Services",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "options" => $this->service->option(),
							  "description" => __("Add one or more services.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "default"=> array()
							  ),				
						)
				  );

		$staffMbox = 
			array(
				  "type" =>"",
				  "title" =>__("Staff",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page_staff",
						),
				  "content"=>
				  array(
						"members" => 
						array(
							  "label"=>__("Staff",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "options" => $this->staff->option(),
							  "description" => __("Add one or more staff member.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "default"=> array()
							  ),
						)
				  );

		$clientsMbox = 
			array(
				  "type" =>"",
				  "title" =>__("Testimonials",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page_clients",
						),
				  "content"=>
				  array(
				  		"background" => 
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Background images.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/images/bg.jpg"
							  ),
						"members" => 
						array(
							  "label"=>__("Testimonials",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "options" => $this->testimonial->option(),
							  "description" => __("Add one or more testimonial.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "default"=> array()
							  ),
						)
				  );
		
		$backgroundMbox = 
			array(
				  "title" => __("Background.",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "page_background"
						),
				  "content" =>
				  array(
				  		"background" => 
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Background image.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/images/bg.jpg"
							  ),
						"parallax" => 
						array(
							  "label"=>__("Parallax",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Whether to show parallax effect on the background or not.",'Pixelentity Theme/Plugin'),
							  "options" => array(__("Yes",'Pixelentity Theme/Plugin') => "yes",__("No",'Pixelentity Theme/Plugin') => ""),
							  "default"=> "yes"
							  )
						)
				  );


		$blog = PeGlobal::$const->blog->metabox;

		$portfolioMbox =& PeGlobal::$const->portfolio->metabox;
		unset($portfolioMbox["content"]["pager"]);
		unset($portfolioMbox["content"]["filterable"]);
		unset($portfolioMbox["content"]["columns"]);

		$portfolioMbox["where"]["page"] = "page_portfolio";

		unset( $blog['content']['layout'] );
		unset( $blog['content']['media'] );
		//unset( $blog['content']['sticky'] );

		PeGlobal::$config["metaboxes-page"] = 
			array(
				"bg" => $bgMbox,
				"sidebar" => array_merge(PeGlobal::$const->sidebar->metabox,array("where"=>array("post"=>"page_blog"))),
				"blog" => array_merge($blog,array("where"=>array("post"=>"page_blog"))),
				"portfolio" => $portfolioMbox,
				"services" => $servicesMbox,
				"staff" => $staffMbox,
				"clients" => $clientsMbox,
				"background" => $backgroundMbox,
			);
	}

	public function pe_theme_metabox_config_project() {
		parent::pe_theme_metabox_config_project();

		$galleryMbox = 
			array(
				  "title" => __("Slider",'Pixelentity Theme/Plugin'),
				  "type" => "GalleryPost",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "gallery"
						),
				  "content" =>
				  array(
						"id" => PeGlobal::$const->gallery->id,
				  )
				);

		PeGlobal::$config["metaboxes-project"] = 
			array(
				  "gallery" => $galleryMbox,
				  "video" => PeGlobal::$const->video->metaboxPost
				  );

	}

	public function pe_theme_visia_testimonial_supports() {

		add_post_type_support( 'testimonial', 'thumbnail' );

	}

	public function pe_theme_visia_metabox_config_project() {

		PeGlobal::$config["metaboxes-project"]["ajax"] = 
			array(
				"title" => __("Slider",'Pixelentity Theme/Plugin'),
				"type" => "GalleryPost",
				"priority" => "core",
				"where" =>
				array(
					"post" => "gallery, video, standard"
				),
				"content" =>
					array(
						"ajax" =>				
						array(
							  "label"=>__("Ajax-load",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description"=>__('Should this project be ajax-loaded when clicked on in portfolio.','Pixelentity Theme/Plugin'),
							  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							  "default"=>"yes"
							  ),
					)
			);

		unset( PeGlobal::$config["metaboxes-project"]['portfolio'] );
		unset( PeGlobal::$config["metaboxes-project"]['info'] );

	}

	protected function init_asset() {
		return new PeThemeVisiaAsset($this);
	}


}

?>
