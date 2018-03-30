<?php

class PeThemeOneUpAsset extends PeThemeAsset  {

	public function __construct(&$master) {
		$this->minifiedJS = "theme/compressed/theme.min.js";
		$this->minifiedCSS = "theme/compressed/theme.min.css";

		//define("PE_THEME_LOCAL_VIDEO_SUPPORT",true);

		parent::__construct($master);
	}

	public function registerAssets() {

		add_filter("pe_theme_js_init_file",array(&$this,"pe_theme_js_init_file_filter"));
		add_filter("pe_theme_js_init_deps",array(&$this,"pe_theme_js_init_deps_filter"));
		add_filter("pe_theme_minified_js_deps",array(&$this,"pe_theme_minified_js_deps_filter"));
		add_action('pe_theme_asset_style_pe_theme_init_deps',array(&$this,'pe_theme_asset_style_pe_theme_init_deps_filter'),99);
		
		parent::registerAssets();

		if ($this->minifyCSS) {
			$deps = 
				array(
					  "pe_theme_compressed"
					  );
		} else {


			// theme styles
			$this->addStyle("css/slider_captions.css",array("pe_theme_animate_css"),"pe_theme_windfall_slider_captions");
			$this->addStyle("css/slider_captions_style.css",array(),"pe_theme_windfall_slider_captions_style");
			$this->addStyle("css/slider_ui.css",array(),"pe_theme_windfall_slider_ui");
			$this->addStyle("css/style.css",array(),"pe_theme_windfall_style");
			$this->addStyle("css/style_responsive.css",array(),"pe_theme_windfall_style_responsive");
			$this->addStyle("css/entypo-icon-font.css",array(),"pe_theme_windfall_icon_font");
			$this->addStyle("css/menu.css",array(),"pe_theme_windfall_menu");
			$this->addStyle("css/menu_style.css",array(),"pe_theme_windfall_menu_style");
			
			$deps = 
				array(
					  "pe_theme_reset",
					  "pe_theme_bootstrap",
					  "pe_theme_bootstrap_responsive",
					  "pe_theme_windfall_icon_font",					  
					  "pe_theme_video",
					  "pe_theme_background",
					  "pe_theme_isotope",
					  "pe_theme_carousel",
					  "pe_theme_ajaxportfolio",
					  "pe_theme_volo",
					  "pe_theme_vario",
					  "pe_theme_flare",
					  "pe_theme_windfall_slider_ui",
					  "pe_theme_windfall_slider_captions",
					  "pe_theme_windfall_slider_captions_style",
					  "pe_theme_windfall_menu",
					  "pe_theme_windfall_menu_style",
					  "pe_theme_windfall_style",
					  "pe_theme_windfall_style_responsive"
					  );
		}

		$this->addStyle("style.css",$deps,"pe_theme_init");

		$this->addScript("theme/js/pe/pixelentity.controller.js",
						 array(
							   "pe_theme_mobile",
							   "pe_theme_menu",
							   "pe_theme_smoothscroll",
							   "pe_theme_waypoints",
							   "pe_theme_parallax",
							   "pe_theme_yt_bg_player",
							   "pe_theme_lazyload",
							   "pe_theme_loadmore",
							   "pe_theme_flare",
							   "pe_theme_vario",
							   "pe_theme_vista",
							   "pe_theme_widgets_bslinks",
							   "pe_theme_widgets_contact",
							   "pe_theme_widgets_bootstrap",
							   "pe_theme_widgets_isotope",
							   "pe_theme_widgets_backgroundSlider",
							   "pe_theme_widgets_volo",
							   "pe_theme_widgets_carousel",
							   "pe_theme_widgets_newsletter",
							   "pe_theme_widgets_gmap",
							   "pe_theme_widgets_dynamicBackground",
							   "pe_theme_widgets_social_facebook",
							   "pe_theme_widgets_social_twitter",
							   "pe_theme_widgets_social_pinterest",
							   "pe_theme_widgets_social_google",
							   "pe_theme_widgets_ajaxportfolio"
							   ),"pe_theme_controller");
		
	}

	public function pe_theme_js_init_file_filter($js) {
		return $js;
		//return "js/custom.js";
	}

	public function pe_theme_js_init_deps_filter($deps) {
		return $deps;
		/*
		  return array(
		  "jquery",
		  );
		*/
	}

	public function pe_theme_minified_js_deps_filter($deps) {
		return $deps;
		//return array("jquery");
	}

	public function style() {
		bloginfo("stylesheet_url"); 
	}

	public function pe_theme_asset_style_pe_theme_init_deps_filter($deps) {
		if ($this->master->options->get("skin") == "dark") {
			$this->addStyle("css/dark_skin.css",array(),"pe_theme_oneup_dark_skin");
			$deps[] = "pe_theme_oneup_dark_skin";
		}
		return $deps;
	}

	public function enqueueAssets() {
		$this->registerAssets();

		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/init.js")) {
			$this->addScript("preview/init.js",array("jquery"),"pe_theme_preview_init");
			wp_localize_script("pe_theme_preview_init", 'o',
							   array(
									 "dark" => PE_THEME_URL."/css/dark_skin.css",
									 "css" => $this->master->color->customCSS(true,"color1")
									 ));
			wp_enqueue_script("pe_theme_preview_init");
		}	
		
		wp_enqueue_style("pe_theme_init");
		wp_enqueue_script("pe_theme_init");

		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/preview.js")) {
			$this->addScript("preview/preview.js",array("pe_theme_init"),"pe_theme_skin_chooser");
			wp_localize_script("pe_theme_skin_chooser","pe_skin_chooser",array("url"=>urlencode(PE_THEME_URL."/")));
			wp_enqueue_script("pe_theme_skin_chooser");
		}
	}


}

?>