<?php

class PeThemeOneUp extends PeThemeController {

	public $preview = array();
	public $mega = array();


	public function __construct() {

		// this theme has sticky nav so the wp admin bar makes navigation impossible, hence we disable it
		// comment or remove the following line if you still want it.
		add_filter('show_admin_bar', '__return_false');

		// custom post types
		add_action("pe_theme_custom_post_type",array(&$this,"pe_theme_custom_post_type"));

		// wp_head stuff
		add_action("pe_theme_wp_head",array(&$this,"pe_theme_wp_head"));

		// google fonts
		add_filter("pe_theme_font_variants",array(&$this,"pe_theme_font_variants_filter"),10,2);

		// menu
		add_filter("pe_theme_menu_items_wrap_default",array(&$this,"pe_theme_menu_items_wrap_default_filter"));
		add_filter("pe_theme_menu_top_level_icon",array(&$this,"pe_theme_menu_top_level_icon_filter"));
		add_filter("pe_theme_menu_nth_level_icon",array(&$this,"pe_theme_menu_top_level_icon_filter"));
		add_filter("pe_theme_menu_item_title",array(&$this,"pe_theme_menu_item_title_filter"),10,2);
		add_filter("pe_theme_menu_item_classes",array(&$this,"pe_theme_menu_item_classes_filter"),10,3);
		add_filter("pe_theme_menu_item_after",array(&$this,"pe_theme_menu_item_after_filter"),10,3);

		// custom layout markup
		add_filter("pe_theme_view_layout_open",array(&$this,"pe_theme_view_layout_open_filter"),10,4);
		add_filter("pe_theme_view_layout_close",array(&$this,"pe_theme_view_layout_open_filter"),10,4);

		// custom menu fields
		add_filter("pe_theme_menu_custom_fields",array(&$this,"pe_theme_menu_custom_fields_filter"),10,3);

		// social links
		add_filter("pe_theme_social_icons",array(&$this,"pe_theme_social_icons_filter"));

		// comment submit button class
		add_filter("pe_theme_comment_submit_class",array(&$this,"pe_theme_comment_submit_class_filter"));

		// mboxes customization
		add_filter("pe_theme_metabox_service",array(&$this,"pe_theme_metabox_service_filter"));
		add_filter("pe_theme_metabox_project",array(&$this,"pe_theme_metabox_project_filter"));

		// views customization
		add_filter("pe_theme_view_Carousel_options",array(&$this,"pe_theme_view_Carousel_options_filter"));

		// layout modules customization
		add_filter("pe_theme_view_layout_module_Staff_options",array(&$this,"pe_theme_view_layout_module_Staff_options_filter"));
		add_filter("pe_theme_view_layout_module_Services_options",array(&$this,"pe_theme_view_layout_module_Services_options_filter"));
		add_filter("pe_theme_view_layout_module_Testimonials_options",array(&$this,"pe_theme_view_layout_module_Testimonials_options_filter"));
		add_filter("pe_theme_view_layout_module_CallToAction_content",array(&$this,"pe_theme_view_layout_module_CallToAction_content_filter"));

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

	public function pe_theme_view_layout_open_filter($markup) {
		return "";
	}


	public function pe_theme_menu_items_wrap_default_filter($wrapper) {
		return '<ul id="navigation" class="pe-menu">%3$s</ul>';
	}

	public function pe_theme_menu_top_level_icon_filter($wrapper) {
		return ' <b class="icon-down-open-mini"></b>';
	}

	public function pe_theme_menu_item_title_filter($title,$item) {
		if (!empty($item->pe_meta->icon)) {
			return sprintf('<b class="%s"></b> %s',$item->pe_meta->icon,$title);
		}
		return $title;
	}

	public function pe_theme_menu_item_classes_filter($classes,$item,$depth) {
		// remove active class if a section is set
		if (($pos = array_search("active",$classes)) !== false) {
			if (!empty($item->pe_meta->name) || $item->url === '#') {
				unset($classes[$pos]);
			}
		}
		return $classes;
	}

	public function pe_theme_menu_item_after_filter($after,$item,$depth) {
		if ($item->object == 'page' && !empty($item->pe_meta->name)) {
			$section = strtr($item->pe_meta->name,array('#' => ''));
			$section = urlencode( $section );
			$item->url .= "#$section";
		}
		return $after;
	}

	public function pe_theme_menu_custom_fields_filter($options,$depth = false,$item = false) {

		if (!empty($item->object) && $item->object != "page") {
			// if menu item is not a page, no custom option
			return $options;
		}

		$options =
			array(
				  "name" => 
				  array(
						"label"=>__("Section",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Optional section link name.",'Pixelentity Theme/Plugin'),
						"default"=> ""
						)
				  );

	
		return $options;

	}

	public function pe_theme_font_variants_filter($variants,$font) {
		if ($font === "Open Sans") {
			$variants="$font:400italic,300,400,600,700";
		} else 
		if ($font === "Montserrat") {
			$variants="$font:400,700";
		}
		return $variants;
	}

	public function pe_theme_social_icons_filter($icons = null) {
		return 
			array(
				  // label => icon | tooltip text
				  __("Twitter Circled",'Pixelentity Theme/Plugin') => "icon-twitter-circled|Twitter",
				  __("Twitter",'Pixelentity Theme/Plugin') => "icon-twitter|Twitter",
				  __("Facebook Circled",'Pixelentity Theme/Plugin') => "icon-facebook-circled|Facebook",
				  __("Facebook",'Pixelentity Theme/Plugin') => "icon-facebook|Facebook",
				  __("Linkedin Circled",'Pixelentity Theme/Plugin') => "icon-linkedin-circled|Linkedin",
				  __("Linkedin",'Pixelentity Theme/Plugin') => "icon-linkedin|Linkedin",
				  __("Pinterest Circled",'Pixelentity Theme/Plugin') => "icon-pinterest-circled|Pinterest",
				  __("Pinterest",'Pixelentity Theme/Plugin') => "icon-pinterest|Pinterest",
				  __("Skype Circled",'Pixelentity Theme/Plugin') => "icon-skype-circled|Skype",
				  __("Skype",'Pixelentity Theme/Plugin') => "icon-skype|Skype",
				  __("Forrst",'Pixelentity Theme/Plugin') => "icon-forrst|Forrst",
				  __("YouTube",'Pixelentity Theme/Plugin') => "icon-youtube|YouTube",
				  __("Gmail",'Pixelentity Theme/Plugin') => "icon-gmail|Gmail",
				  __("WordPress",'Pixelentity Theme/Plugin') => "icon-wordpress|WordPress",
				  __("Dropbox",'Pixelentity Theme/Plugin') => "icon-dropbox-1|Dropbox",
				  __("Instagram",'Pixelentity Theme/Plugin') => "icon-instagram|Instagram",
				  __("Dribbble Circled",'Pixelentity Theme/Plugin') => "icon-dribbble-circled|Dribbble",
				  __("Dribbble",'Pixelentity Theme/Plugin') => "icon-dribbble|Dribbble",
				  __("Google+ Circled",'Pixelentity Theme/Plugin') => "icon-gplus-circled|Google+",
				  __("Google+",'Pixelentity Theme/Plugin') => "icon-gplus|Google+",
				  __("Vimeo Circled",'Pixelentity Theme/Plugin') => "icon-vimeo-circled|Vimeo",
				  __("Vimeo",'Pixelentity Theme/Plugin') => "icon-vimeo|Vimeo",
				  __("Flickr Circled",'Pixelentity Theme/Plugin') => "icon-flickr-circled|Flickr",
				  __("Flickr",'Pixelentity Theme/Plugin') => "icon-flickr|Flickr",
				  __("Github",'Pixelentity Theme/Plugin') => "icon-github|Github",
				  __("Picasa",'Pixelentity Theme/Plugin') => "icon-picasa|Picasa",
				  __("Soundcloud",'Pixelentity Theme/Plugin') => "icon-soundcloud|Soundcloud",
				  __("Behance",'Pixelentity Theme/Plugin') => "icon-behance|Behance",
				  __("Tumblr Circled",'Pixelentity Theme/Plugin') => "icon-tumblr-circled|Tumblr",
				  __("Tumblr",'Pixelentity Theme/Plugin') => "icon-tumblr|Tumblr",
				  __("Soundcloud",'Pixelentity Theme/Plugin') => "icon-soundcloud|Soundcloud",
				  __("Picasa",'Pixelentity Theme/Plugin') => "icon-picasa|Picasa",
				  __("Spotify Circled",'Pixelentity Theme/Plugin') => "icon-spotify-circled|Spotify",
				  __("Spotify",'Pixelentity Theme/Plugin') => "icon-spotify|Spotify",
				  __("Stumbleupon Circled",'Pixelentity Theme/Plugin') => "icon-stumbleupon-circled|Stumbleupon",
				  __("Stumbleupon",'Pixelentity Theme/Plugin') => "icon-stumbleupon|Stumbleupon",
				  __("LastFM Circled",'Pixelentity Theme/Plugin') => "icon-lastfm-circled|Last FM",
				  __("LastFM",'Pixelentity Theme/Plugin') => "icon-lastfm|Last FM",
				  __("Github Circled",'Pixelentity Theme/Plugin') => "icon-github-circled|Github",
				  __("Github",'Pixelentity Theme/Plugin') => "icon-github|Github",
				  __("Forrst",'Pixelentity Theme/Plugin') => "icon-forrst|Forrst",
				  __("Grooveshark",'Pixelentity Theme/Plugin') => "icon-grooveshark|Grooveshark",
				  __("Digg",'Pixelentity Theme/Plugin') => "icon-digg|Digg",
				  __("Delicious",'Pixelentity Theme/Plugin') => "icon-delicious|Delicious"
				  );
	}

	public function pe_theme_comment_submit_class_filter() {
		return "contour-btn red";
	}
	
	public function pe_theme_view_Carousel_options_filter($mbox) {
		$content =& $mbox["content"];
		unset($content["title"]);
		unset($content["subtitle"]);
		unset($content["description"]);
		unset($content["style"]);
		return $mbox;
	}

	public function pe_theme_view_layout_module_Services_options_filter($options) {
		$custom["columns"] = 
			array(
				  "label" => __("Columns",'Pixelentity Theme/Plugin'),
				  "description" => __("Number of columns to use for the layout",'Pixelentity Theme/Plugin'),
				  "type" => "RadioUI",
				  "options" => array("1" => 1,"2" => 2,"3" => 3,"4" => 4,"5" => 5),
				  "default" => 4
				  );

		unset($options["title"]);
		unset($options["content"]);
		unset($options["textpos"]);

		return array_merge($custom,$options);
	}

	public function pe_theme_view_layout_module_Staff_options_filter($options) {
		$custom["columns"] = 
			array(
				  "label" => __("Columns",'Pixelentity Theme/Plugin'),
				  "description" => __("Number of columns to use for the layout",'Pixelentity Theme/Plugin'),
				  "type" => "RadioUI",
				  "options" => array("1" => 1,"2" => 2,"3" => 3,"4" => 4),
				  "default" => 3
				  );

		unset($options["title"]);
		unset($options["content"]);
		unset($options["textpos"]);

		return array_merge($custom,$options);
	}

	public function pe_theme_view_layout_module_Testimonials_options_filter($options) {

		unset($options["title"]);
		unset($options["content"]);
		unset($options["textpos"]);

		return $options;
	}

	public function pe_theme_view_layout_module_CallToAction_content_filter( $content ) {

		return '<h2 style="text-align:center;">This Is Call To Action Section</h2>
<h3 style="text-align:center; font-weight:300; color:#1fbba6;">With a centrally aligned sub heading to add extra persuasive power</h3>
<a class="outline-btn"  href="#">BUTTON TYPE B<i class="icon-right-open-mini"></i></a> <a class="contour-btn" href="#">BUTTON TYPE  A <i class="icon-right-open-mini"></i></a>';

	}

	public function pe_theme_pager_load_more_filter($value) {
		return is_home() || is_category() || is_tag() || is_tax('prj-category') ? true : $value;
	}

	public function init() {
		do_action("pe_theme_before_init");

		parent::init();

		if (PE_THEME_PLUGIN_MODE) {
			return;
		}
		
		if ($this->options->get("retina") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_retina_filter"),10,5);
		} else if ($this->options->get("lazyImages") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_img_filter"),10,4);
		} 

		if ($this->options->get("loadMore") === "yes") {
			// enable load more feature on default (blog, category, etc)
			add_filter("pe_theme_pager_load_more",array(&$this,"pe_theme_pager_load_more_filter"));
		}


		do_action("pe_theme_after_init");
	}

	public function pe_theme_custom_post_type() {
		$this->gallery->cpt();
		$this->video->cpt();
		$this->project->cpt();
		$this->staff->cpt();
		$this->service->cpt();
		$this->testimonial->cpt();
		//$this->logo->cpt();
		$this->slide->cpt();
		$this->view->cpt();
	}


	public function boot() {
		parent::boot();

		/*
		if (PE_THEME_MODE) {

			require_once(get_template_directory()."/framework/php/lib/pixelentity-theme-bundled-plugins/class-pixelentity-theme-bundled-plugins.php");
			PixelentityThemeBundledPlugins::init(
												 array(
													   array(
															 "slug" => "pe-theme-framework",
															 "name" => __("Pixelentity Theme Framework Plugin",'Pixelentity Theme/Plugin'),
															 "version" => "1.1.0",
															 "download_link" => get_template_directory_uri()."/plugins/pe-theme-framework.zip"
															 )
													   )
												 );
		}
		*/

		PeGlobal::$config["content-width"] = 940;
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

		PeGlobal::$config["widgets"] = 
			array(
				  );

		PeGlobal::$config["shortcodes"] = 
			array(
				  "BS_Badge",
				  "BS_Label",
				  "BS_Button",
				  "BS_Video",
				  "BS_Columns",
				  "View"
				  );

		PeGlobal::$config["views"] = 
			array(
				  "SliderVolo",
				  "SliderVista",
				  "SliderVario",
				  "GalleryGrid",
				  "GalleryCover",
				  "GalleryImages",
				  "GalleryCarousel",
				  "Carousel",
				  "Blog",
				  "Masonry",
				  "PortfolioPreview",
				  "PortfolioGrid",
				  "Layout",
				  "LayoutModuleSection",
				  "LayoutModuleText",
				  "LayoutModuleView",
				  "LayoutModuleVideo",
				  "LayoutModuleGalleryCarousel",
				  "LayoutModuleServices",
				  "LayoutModuleStaff",
				  "LayoutModuleTestimonials",
				  "LayoutModuleColumns",
				  "LayoutModuleContainer",
				  "LayoutModuleForm",
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
				  "LayoutModulePricingColumn",
				  "LayoutModuleCallToAction",
				  "LayoutModuleHomeColumns",
				  "LayoutModuleHomeColumn",
				  "LayoutModuleFeature",
				  "LayoutModuleSkills",
				  "LayoutModuleStats",
				  "LayoutModuleStat",
				  "LayoutModuleOneUpRevolutionSlider",
				  );

		PeGlobal::$config["sidebars"] =
			array(
				  "default" => __("Default post/page",'Pixelentity Theme/Plugin')
				  );

		PeGlobal::$config["colors"] = 
			array(
				  "color1" => 
				  array(
						"label" => __("Primary Color",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  "a" => "color",
							  ".pe-main-section h6 [class^='icon-']" => "color",
							  ".peSlider > div.peCaption h3" => "color",
							  ".desktop h3 a:hover" => "color",
							  ".accent" => "color",
							  "a.read-more" => "color",
							  "a.more-link" => "color",
							  ".desktop .sm-icon-wrap a:hover" => "color",
							  ".desktop .social-media-wrap .social-media a:hover" => "color",
							  ".widget_info a" => "color",
							  ".pe-view-layout-class-testimonials .peWrap > div > div > div > i" => "color",
							  ".desktop .project-item h6 a:hover" => "color",
							  ".project-filter .pe-menu > li > a:hover" => "color",
							  ".project-filter .pe-menu > li >a.active" => "color",
							  ".filter-keywords" => "color",
							  ".peIsotopeFilter.pe-menu > li > a.active" => "color",
							  ".staff-item .position" => "color",
							  ".staff-item .details .social-media-wrap a:hover i" => "color",
							  ".desktop .widget_nav_menu a:hover" => "color",
							  ".widget_nav_menu .menu li.current_page_item a" => "color",
							  ".desktop .widget_nav_menu li.current_page_item a:hover" => "color",
							  ".desktop .widget_recent_comments li a:hover" => "color",
							  ".widget_links li a" => "color",
							  ".widget_pages li a" => "color",
							  ".widget_meta li a" => "color",
							  ".widget_nav_menu li a" => "color",
							  ".widget_recent_entries li a" => "color",
							  ".desktop .widget_categories a:hover" => "color",
							  ".desktop .post-title a:hover" => "color",
							  ".post-meta .user" => "color",
							  ".post-meta .user a" => "color",
							  ".desktop .post-meta .categories a:hover" => "color",
							  ".desktop .post-meta .date a:hover" => "color",
							  ".post-pagination a span:first-child" => "color",
							  "#comments-title span" => "color",
							  ".bypostauthor > .comment-body .fn a" => "color",
							  ".peThemeContactForm .help-inline" => "color",
							  ".bay h6" => "color",
							  ".pagination a" => "color",
							  ".project-data h6" => "color",
							  ".project-tags h6" => "color",
							  ".pricing-table .row-titles .price span" => "color",
							  ".sticky .post-title a" => "color",
							  ".sticky .post-title h2:before" => "color",
							  ".peFlareLightbox .peFlareLightboxCaptions>div>div>h3 a" => "color",
							  ".product mark" => "color",
							  "body.woocommerce-page .woocommerce-breadcrumb > a:hover" => "color",
							  "body .woocommerce div.product form.cart .variations .value a:hover"  => "color",
							  "body .woocommerce #content div.product form.cart .variations .value a:hover" => "color", 
							  "body.woocommerce-page div.product form.cart .variations .value a:hover"  => "color",
							  "body.woocommerce-page #content div.product form.cart .variations .value a:hover" => "color",
							  ".desktop .pe-menu > li.wcmenucart-display-standard:hover a" => "color",
							  ".wcmenucart-display-standard .wcmenucart-contents .amount" => "color",
							  ".action h3" => "color",
							  ".process > div > div > div .read-more" => "color",
							  ".pe-view-layout-class-feature h5" => "color",
							  ".pe-style-dark .pe-view-layout-class-feature h5" => "color",
							  ".pe-view-layout-class-skills h5" => "color",
							  ".pe-style-dark .pe-view-layout-class-skills h5" => "color",
							  ".pe-view-layout-class-stat .pe-stat h5" => "color",
							  ".pe-style-dark .pe-view-layout-class-stat .pe-stat h5" => "color",
							  ".desktop .nav-tabs > li > a:hover" => "color",
							  ".nav-tabs> li.active>a" => "color",
							  ".desktop .faq-heading:hover > div"=> "color",
							  ".faq-heading > div"=> "color",



							  ".contour-btn" => "background-color",
							  "div.overlay-image" => "background-color",
							  ".contentBox" => "background-color",
							  ".filter-keywords li a.active" => "background-color",
							  ".desktop .filter-keywords li a:hover" => "background-color",
							  ".service-item > div" => "background-color",
							  ".service-single > .service-icon" => "background-color",
							  ".featureIcon" => "background-color",
							  ".desktop #comments .reply .label:hover" => "background-color",
							  ".desktop .pagination a:hover" => "background-color",
							  ".pagination li.active a" => "background-color",
							  ".pricing-table .high .price" => "background-color",
							  ".ie8 .over-effect:hover > .cell-title" => "background-color",
							  "body > p.demo_store" => "background-color",
						      "body .woocommerce a.button"  => "background-color",
					   		  "body .woocommerce button.button" => "background-color",
				   			  "body .woocommerce input.button"  => "background-color",
					   		  "body .woocommerce #respond input#submit"  => "background-color",
					   		  "body .woocommerce #content input.button"  => "background-color",
					   		  "body.woocommerce-page a.button"  => "background-color",
				   			  "body.woocommerce-page button.button"  => "background-color",
							  "body.woocommerce-page input.button"  => "background-color",
					   		  "body.woocommerce-page #respond input#submit"  => "background-color",
					   		  "body.woocommerce-page #content input.button" => "background-color",
					   		  "body .woocommerce .widget_product_search form input[type=submit]" => "background-color",
							  ".widget_product_search form input[type=submit]" => "background-color",
							  ".process .process-icon > span" => "background-color",
							  ".pe-view-layout-class-skills .pe-skill .pe-skill-value" => "background-color:0.6",
							  ".desktop .pagination a.pe-load-more-button:hover" => "background-color",

							  ".pe-menu" => "border-color",
							  ".pe-menu .dropdown-menu" => "border-color",
							  ".pe-menu .dropdown-menu .sub-menu" => "border-color",

							  ".contour-btn " => "border-color",
							  ".desktop a.over-effect:hover" => "border-color",
							  "blockquote" => "border-color",
							  ".filter-keywords li a.active " => "border-color",
							  ".desktop .filter-keywords li a:hover " => "border-color",
							  ".bypostauthor > .comment-body > .comment-author img" => "border-color",
							  ".desktop .pagination a:hover " => "border-color",
							  ".pagination li.active a " => "border-color",
							  ".desktop .pe-menu > li:hover" => "border-color",
							  ".pe-menu > li.active" => "border-color",
							  ".dropdown-menu" => "border-color",
							  ".desktop .pe-menu > li:hover" => "border-color",
							  ".pe-menu > li.active" => "border-color",
							  "body > p.demo_store " => "border-color",
							  "body .woocommerce a.button "  => "border-color",
					   		  "body .woocommerce button.button " => "border-color",
				   			  "body .woocommerce input.button "  => "border-color",
					   		  "body .woocommerce #respond input#submit "  => "border-color",
					   		  "body .woocommerce #content input.button "  => "border-color",
					   		  "body.woocommerce-page a.button "  => "border-color",
				   			  "body.woocommerce-page button.button "  => "border-color",
							  "body.woocommerce-page input.button "  => "border-color",
					   		  "body.woocommerce-page #respond input#submit " => "border-color", 
					   		  "body.woocommerce-page #content input.button " => "border-color",
					   		  ".desktop .pagination a.pe-load-more-button:hover " => "background-color",
						   		


							  ".service-item > div > .arrow" => "border-top-color",
							  ".service-single > .service-icon > .arrow" => "border-top-color",

							  ".col.high" => "outline-color"


							  ),
						"default" => "#1fbba6"
						),
						"color2" => 
						array(
								"label" => __("Splash Caption Color",'Pixelentity Theme/Plugin'),
								"selectors" => 
								array(
									  ".pe-splash-section .pe-headlines > div" => "color",
									  ".pe-splash-section .pe-caption-persistent>.peCaptionLayer a>span" => "color",
									  ".pe-splash-section .pe-caption-persistent>.peCaptionLayer a>span>i" => "color"
									  ),
						"default" => "#ffffff"
						)
						);
		

		PeGlobal::$config["fonts"] = 
			array(
				  "fontBody" => 
				  array(
						"label" => __("Body Font",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  "body",
							  "p",
							  ".subtitle",
							  "input",
							  "button",
							  "select",
							  "textarea",
							  ".peSlider > div.peCaption",
							  ".peSlider > div.peCaption h3",
							  ".peSlider > div.peCaption > .peCaptionLayer.pe-caption-style-black",
							  ".pe-menu .dropdown-menu li > a.pe-menu-back",
							  ".pe-menu > li > a"
							  ),
						"default" => "Open Sans"
						),
				  "fontHeading1" => 
				  array(
						"label" => __("Heading Font",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  
							  "h1",
							  "h2",
							  "h3",
							  "h4",
							  "h5",
							  "h6"

							  ),
						"default" => "Open Sans"
						),
				  "fontHeading2" => 
				  array(
						"label" => __("Splash Caption Font",'Pixelentity Theme/Plugin'),
						"selectors" => 
						array(
							  
							  ".pe-splash-section .pe-headlines > div"
							  ),
						"default" => "Open Sans"
						)
				  );
		

		$options = array();

		$options = array_merge($options,
			array(
				  /*
				  "plugins" => 
				  array(
						"label"=>__("Plugins",'Pixelentity Theme/Plugin'),
						"type"=>"Plugins",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("This is the main site logo image. The image should be a .png file.",'Pixelentity Theme/Plugin')
						),
				  */
				  "import_demo" => $this->defaultOptions["import_demo"],
				  "skin" => 
				  array(
						"label"=>__("Skin",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("Select Theme Skin",'Pixelentity Theme/Plugin'),
						"options" => array("light","dark"),
						"single" => true,
						"default"=>"light"
						),				  
				  "logo" => 
				  array(
						"label"=>__("Logo",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("This is the main site logo image. The image should be a .png file.",'Pixelentity Theme/Plugin'),
						"default"=> PE_THEME_URL."/img/skin/header_logo.png"
						),
				  "favicon" => $this->defaultOptions["favicon"],
				  "animations" => 
				  array(
						"label"=>__("Use Animations",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("Enable or disable theme animations.",'Pixelentity Theme/Plugin'),
						"options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
						"default"=> "yes",
						'jsexport' => true,
						),
				  "customCSS" => $this->defaultOptions["customCSS"],
				  "customJS" => $this->defaultOptions["customJS"],
				  "footerSticky" => 
				  array(
						"label"=>__("Sticky Footer",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"section"=>__("Footer",'Pixelentity Theme/Plugin'),
						"description" => __("Sticky footer is only supported in fullwidth pages where template is set to 'builder'.",'Pixelentity Theme/Plugin'),
						"options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
						"default"=> "yes"
						),
				  "footerLogo" => 
				  array(
						"label"=>__("Logo",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"section"=>__("Footer",'Pixelentity Theme/Plugin'),
						"description" => __("This is the footer logo image. The image should be a .png file.",'Pixelentity Theme/Plugin'),
						"default"=> PE_THEME_URL."/img/skin/footer_logo.png"
						),
				  "footerCopyright" => 
				  array(
						"label"=>__("Copyright",'Pixelentity Theme/Plugin'),
						"wpml"=> true,
						"type"=>"TextArea",
						"section"=>__("Footer",'Pixelentity Theme/Plugin'),
						"description" => __("This is the footer copyright message.",'Pixelentity Theme/Plugin'),
						"default"=> sprintf('<span>&copy; OneUp - a WordPress theme with serious impact. Created by</span>%s<a href="#">pixelentity</a>',"\n")
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
						"description" => __("In this page you can set alternative colors for the main colored elements in this theme. The colored elements available to be changed are listed below. To change the colors used in these areas simply write a new hex color reference number into the fields below or use the color picker which appears when each field obtains focus. Once you have selected your desired colors make sure to save them by clicking the <b>Save All Changes</b> button at the bottom of the page. Then just refresh your page to see the changes. To reset a color to it's default simply click the 'Default' button in the color picker.",'Pixelentity Theme/Plugin'),
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
		$options = array_merge($options,$this->font->options());
		$options = array_merge($options,$this->color->options());

		$options["loadMore"] =& $this->defaultOptions["loadMore"];
		$options["retina"] =& $this->defaultOptions["retina"];
		$options["lazyImages"] =& $this->defaultOptions["lazyImages"];
		$options["builderInContent"] =& $this->defaultOptions["builderInContent"];
		$options["minifyJS"] =& $this->defaultOptions["minifyJS"];
		$options["minifyCSS"] =& $this->defaultOptions["minifyCSS"];
		$options["thumbscache"] =& $this->defaultOptions["thumbscache"];

		$options["adminThumbs"] =& $this->defaultOptions["adminThumbs"];
		if (!empty($this->defaultOptions["mediaQuick"])) {
			$options["mediaQuick"] =& $this->defaultOptions["mediaQuick"];
			$options["mediaQuickDefault"] =& $this->defaultOptions["mediaQuickDefault"];
		}

		$options["updateCheck"] =& $this->defaultOptions["updateCheck"];
		$options["updateUsername"] =& $this->defaultOptions["updateUsername"];
		$options["updateAPIKey"] =& $this->defaultOptions["updateAPIKey"];

		$options["adminLogo"] =& $this->defaultOptions["adminLogo"];
		$options["adminUrl"] =& $this->defaultOptions["adminUrl"];
		
		PeGlobal::$config["options"] = apply_filters("pe_theme_options",$options);

		$this->mboxBG = 
			array(
				  "title" => __("Background Video Settings",'Pixelentity Theme/Plugin'),
				  "type" => "Conditional",
				  "priority" => "core",
				  "options" => 
				  array(
						"bg" =>
						array(
							  "yes" => 
							  array(
									"show" => "fallback,video"
									),
							  "no" => 
							  array(
									"hide" => "fallback,video"
									)
							  )
						),
				  "where" =>
				  array(
						"post" => "page_builder"
						),
				  "content" => 
				  array(
						"bg" =>
						array(
							  "label" => __("Use Youtube Video",'Pixelentity Theme/Plugin'),
							  "description" => __("Whether to show a youtube video as page background.",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							  "default"=> "no"
							  ),
						"videos" => 
						array(
							  "label"=> __("YouTube Videos",'Pixelentity Theme/Plugin'),
							  "description" => __("Add one or more youtube video urls.",'Pixelentity Theme/Plugin'),
							  "type"=>"Items",
							  "button_label" => __("Add New Video",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "unique" => false,
							  "editable" => false,
							  "legend" => false,
							  "fields" => 
							  array(
									array(
										  "type" => "empty",
										  "width" => "186"
										  ),
									array(
										  "name" => "url",
										  "type" => "text",
										  "width" => "500",
										  "default" => ""
										  )
									)
							  ),
						"fallback" => 
						array(
							  "label"=>__("Fallback Image",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Fallback image used for mobile and browsers lacking video playback feature.",'Pixelentity Theme/Plugin'),
							  "default"=>PE_THEME_URL.'/img/content/1920x1080.jpeg'
							  )
						)
				  );


	}

	public function pe_theme_metabox_config_post() {
		parent::pe_theme_metabox_config_post();
	}

	public function pe_theme_metabox_config_page() {
		parent::pe_theme_metabox_config_page();

		$mbox = 
			array(
				  "title" => __("Home Page Settings",'Pixelentity Theme/Plugin'),
				  "type" => "Conditional",
				  "priority" => "core",
				  "options" => 
				  array(
						"splash" =>
						array(
							  "yes" => 
							  array(
									"show" => "slider,header,logo,label,link,taglines,minh,maxh,offset"
									),
							  "no" => 
							  array(
									"hide" => "slider,header,logo,label,link,taglines,minh,maxh,offset"
									)
							  )
						),
				  "where" =>
				  array(
						"post" => "page_builder"
						),
				  "content" => 
				  array(
						"splash" =>
						array(
							  "label" => __("Splash Section",'Pixelentity Theme/Plugin'),
							  "description" => __("Whether to show the home splash section or not.",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							  "default"=> "no"
							  ),
						"minh" =>
						array(
							  "label" => __("Min Height",'Pixelentity Theme/Plugin'),
							  "description" => __("Minimum height (in pixel) of the splash section. Values lesser than 300 could be ignored to make sure the splash section is visible on mobile.",'Pixelentity Theme/Plugin'),
							  "type"=>"Number",
							  "default"=> 300
							  ),
						"maxh" =>
						array(
							  "label" => __("Max Height",'Pixelentity Theme/Plugin'),
							  "description" => __("Maximum height (in pixel) of the splash section, when 0 is used, the section will extend to fill the whole page.",'Pixelentity Theme/Plugin'),
							  "type"=>"Number",
							  "default"=> 0
							  ),
						"header" =>
						array(
							  "label" => __("Menu",'Pixelentity Theme/Plugin'),
							  "description" => __("Select the menu bar type.",'Pixelentity Theme/Plugin'),
							  "type" => "RadioUI",
							  "options" => 
							  array(
									__("Normal",'Pixelentity Theme/Plugin') => "",
									__("Transparent",'Pixelentity Theme/Plugin') => "transparent"
									)
							  ),						
						"slider" =>
						array(
							  "label" => __("Slider",'Pixelentity Theme/Plugin'),
							  "description" => __("Select a slider view to be used in home splash section.",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "options" => $this->view->option(false,array(__("Slider",'Pixelentity Theme/Plugin')),false),
							  "editable" => admin_url('post.php?post=%0&action=edit')
							  ),
						"logo" => 
						array(
							  "label"=>__("Logo",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Logo.",'Pixelentity Theme/Plugin'),
							  "default"=>PE_THEME_URL.'/img/skin/splash_logo.png'
							  ),
						"offset" =>
						array(
							  "label" => __("Logo Offset",'Pixelentity Theme/Plugin'),
							  "description" => __("Logo distance (in pixel) from the splash section center. 0 means centered, a negative value will move logo up (towards the header) while a positive value will do the opposite.",'Pixelentity Theme/Plugin'),
							  "type"=>"Number",
							  "default"=> -100
							  ),
						"label" => 
						array(
							  "label"=>__("Label",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Label text to show when overing the logo.",'Pixelentity Theme/Plugin'),
							  "default"=> __('START HERE','Pixelentity Theme/Plugin')
							  ),
						"link" => 
						array(
							  "label"=>__("Link",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Logo link.",'Pixelentity Theme/Plugin'),
							  "default"=> '#portfolio'
							  ),
						"taglines" => 
						array(
							  "label"=> __("Taglines",'Pixelentity Theme/Plugin'),
							  "description" => __("Add one or more taglines.",'Pixelentity Theme/Plugin'),
							  "type"=>"Items",
							  "button_label" => __("Add New",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "auto" => __("Tagline %",'Pixelentity Theme/Plugin'),
							  "unique" => false,
							  "editable" => false,
							  "legend" => false,
							  "fields" => 
							  array(
									array(
										  "type" => "empty",
										  "width" => "186"
										  ),
									array(
										  "name" => "content",
										  "type" => "text",
										  "width" => "500",
										  "default" => ""
										  )
									)
							  ),
						)
				  );

		
		$mboxes =& PeGlobal::$config["metaboxes-page"];
		$mboxes["home"] = $mbox;
		$mboxes["bg"] = $this->mboxBG;

		if (PE_THEME_MODE && isset($mboxes["builder"]["content"]["builder"])) {
			$mboxes["builder"]["content"]["builder"]["allowed"] = "section";
		}

		if (isset($mboxes["gmap"])) {
			unset($mboxes["gmap"]);	
		}

		if (isset(PeGlobal::$config["metaboxes-page"]["layout"])) {
			$fields =& PeGlobal::$config["metaboxes-page"]["layout"]["content"];
			unset($fields["fullscreen"]);
			unset($fields["headerMargin"]);
			unset($fields["footerMargin"]);
			unset($fields["footerStyle"]);
			//unset($fields["content"]);
		}
	}

	public function pe_theme_metabox_service_filter($mbox) {
		unset($mbox["info"]["content"]["features"]);
		return $mbox;
	}

	public function pe_theme_metabox_project_filter($mbox) {
		unset($mbox["info"]);
		return $mbox;
	}

	public function pe_theme_metabox_config_project() {
		parent::pe_theme_metabox_config_project();
	}

	public function pe_theme_metabox_config_service() {
		parent::pe_theme_metabox_config_service();
	}

	public function splash() {
		$meta =& $this->content->meta();
		$splash = !empty($meta->home->splash) && $meta->home->splash === "yes";
		return $splash;
	}

	public function transparent() {
		$meta =& $this->content->meta();
		return $this->splash() && !empty($meta->home->header);
	}

	public function hasBgVideo() {
		$meta =& $this->content->meta();
		return  !empty($meta->bg->bg) && $meta->bg->bg === "yes" && !empty($meta->bg->videos);
	}

	public function stickyFooter() {
		return !$this->hasBgVideo() && $this->options->get('footerSticky') === 'yes';
	}

	protected function init_asset() {
		return new PeThemeOneUpAsset($this);
	}


}

?>
