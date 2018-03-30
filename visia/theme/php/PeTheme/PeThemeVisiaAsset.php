<?php

class PeThemeVisiaAsset extends PeThemeAsset  {

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
		
		parent::registerAssets();

		if ($this->minifyCSS) {
			$deps = 
				array(
					  "pe_theme_compressed"
					  );
		} else {


			// theme styles
			$this->addStyle("css/loader.css",array(),"pe_theme_visia-loader");
			$this->addStyle("css/reset.css",array(),"pe_theme_visia-reset");
			$this->addStyle("css/grid.css",array(),"pe_theme_visia-grid");
			$this->addStyle("css/icons.css",array(),"pe_theme_visia-icons");
			$this->addStyle("css/style.css",array(),"pe_theme_visia-style");
			$this->addStyle("css/shortcodes.css",array(),"pe_theme_visia-shortcodes");
			$this->addStyle("css/ruby-red.css",array(),"pe_theme_visia-color");
			$this->addStyle("css/animations.css",array(),"pe_theme_visia-animations");
			$this->addStyle("css/ie.css",array(),"pe_theme_visia-ie");
			$this->addStyle("css/custom.css",array(),"pe_theme_visia-custom");

			$deps = 
				array(
					  "pe_theme_visia-loader",
					  "pe_theme_visia-reset",
					  "pe_theme_visia-grid",
					  "pe_theme_visia-icons",
					  "pe_theme_visia-style",
					  "pe_theme_visia-shortcodes",					  
					  "pe_theme_visia-color",
					  "pe_theme_visia-animations",
					  "pe_theme_visia-ie",
					  "pe_theme_flare",
					  "pe_theme_visia-custom",
					  );
		}

		$this->addStyle("style.css",$deps,"pe_theme_init");

		$this->addScript("theme/js/pe/pixelentity.controller.js",
						 array(
							   "pe_theme_mobile",
							   "pe_theme_selectivizr",
							   "pe_theme_lazyload",
							   "pe_theme_flare",
							   "pe_theme_visia-smoothscroll",
							  "pe_theme_visia-vegas",
							  "pe_theme_visia-imagesloaded",
							  "pe_theme_visia-mixitup",
							  "pe_theme_visia-countto",
							  "pe_theme_visia-jqueryui",
							  "pe_theme_visia-video",
							  "pe_theme_visia-bigvideo",
							  "pe_theme_visia-waypoints",
							  "pe_theme_visia-parallax",
							  "pe_theme_widgets_contact",					  
							  "pe_theme_visia-navigation",
							  "pe_theme_visia-jquery-easing",
							  "pe_theme_visia-jquery-fittext",
							  "pe_theme_visia-jquery-localscroll",
							  "pe_theme_visia-jquery-scrollto",
							  "pe_theme_visia-jquery-appear",
							  "pe_theme_visia-jquery-waitforimages",
							  "pe_theme_visia-jquery-bxslider",
							  "pe_theme_visia-jquery-fitvids",
							  "pe_theme_visia-shortcodes",
							  "pe_theme_visia-main",
							  "pe_theme_visia-custom"
							   ),"pe_theme_controller");

		$this->addScript("js/smoothscroll.js",array(),"pe_theme_visia-smoothscroll");
		$this->addScript("js/jquery.imagesloaded.js",array(),"pe_theme_visia-imagesloaded");
		$this->addScript("js/jquery.mixitup.js",array(),"pe_theme_visia-mixitup");
		$this->addScript("js/jquery.countto.js",array(),"pe_theme_visia-countto");
		$this->addScript("js/jqueryui.js",array(),"pe_theme_visia-jqueryui");
		$this->addScript("js/video.js",array(),"pe_theme_visia-video");
		$this->addScript("js/bigvideo.js",array(),"pe_theme_visia-bigvideo");
		$this->addScript("js/vegas.js",array(),"pe_theme_visia-vegas");
		$this->addScript("js/waypoints.js",array(),"pe_theme_visia-waypoints");
		$this->addScript("js/parallax.js",array(),"pe_theme_visia-parallax");
		$this->addScript("js/navigation.js",array(),"pe_theme_visia-navigation");
		$this->addScript("js/jquery.easing.js",array(),"pe_theme_visia-jquery-easing");
		$this->addScript("js/jquery.fittext.js",array(),"pe_theme_visia-jquery-fittext");
		$this->addScript("js/jquery.localscroll.js",array(),"pe_theme_visia-jquery-localscroll");
		$this->addScript("js/jquery.scrollto.js",array(),"pe_theme_visia-jquery-scrollto");
		$this->addScript("js/jquery.appear.js",array(),"pe_theme_visia-jquery-appear");
		$this->addScript("js/jquery.waitforimages.js",array(),"pe_theme_visia-jquery-waitforimages");
		$this->addScript("js/jquery.bxslider.js",array(),"pe_theme_visia-jquery-bxslider");
		$this->addScript("js/jquery.fitvids.js",array(),"pe_theme_visia-jquery-fitvids");
		$this->addScript("js/shortcodes.js",array(),"pe_theme_visia-shortcodes");
		$this->addScript("js/main.js",array(),"pe_theme_visia-main");
		$this->addScript("js/custom.js",array(),"pe_theme_visia-custom");
		
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

	public function enqueueAssets() {
		$this->registerAssets();

		$t =& peTheme();
		
		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/init.js")) {
			$this->addScript("preview/init.js",array("jquery"),"pe_theme_preview_init");
			wp_localize_script("pe_theme_preview_init", 'o',
							   array(
									 //"dark" => PE_THEME_URL."/css/dark_skin.css",
									 "css" => $this->master->color->customCSS(true,"color1")
									 ));
			wp_enqueue_script("pe_theme_preview_init");
		}	
		
		wp_enqueue_style("pe_theme_init");
		wp_enqueue_script("pe_theme_init");

		wp_localize_script("pe_theme_init","_visia",
			array(
				"ajax-loading" => PE_THEME_URL . '/images/ajax-loader.gif',
				"home_url"     => home_url('/'),
			));

		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/preview.js")) {
			$this->addScript("preview/preview.js",array("pe_theme_init"),"pe_theme_skin_chooser");
			wp_localize_script("pe_theme_skin_chooser","pe_skin_chooser",array("url"=>urlencode(PE_THEME_URL."/")));
			wp_enqueue_script("pe_theme_skin_chooser");
		}
	}


}

?>