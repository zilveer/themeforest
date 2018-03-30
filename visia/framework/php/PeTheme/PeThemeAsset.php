<?php

class PeThemeAsset {

	protected $master;
	protected $minifyJS = false;
	protected $minifyCSS = false;

	protected $minifiedJS = "theme.min.js";
	protected $minifiedCSS = "theme.min.css";

	public function __construct(&$master) {
		$this->master = &$master;
		$this->minifyJS = ($this->master->options->get("minifyJS") == "yes");
		$this->minifyCSS = ($this->master->options->get("minifyCSS") == "yes");
	}

	public function registerAssetsUtils() {
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.preloader.js",array("jquery"),"pe_theme_utils_preloader");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.ticker.js",array("jquery"),"pe_theme_utils_ticker");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.timer.js",array("jquery"),"pe_theme_utils_timer");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.geom.js",array("jquery"),"pe_theme_utils_geom");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.easing.js",array("jquery"),"pe_theme_utils_easing");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.transition.js",array("jquery"),"pe_theme_utils_transition");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.browser.js",array("jquery"),"pe_theme_utils_browser");
		$this->addScript("framework/js/pe/jquery.pixelentity.transform.js",array("jquery"),"pe_theme_transform");
	}


	public function registerAssets() {

		$this->addScript("framework/js/pe/boot.js",NULL,"pe_theme_boot");
		$this->addScript("framework/js/admin/jquery.theme.utils.js",array(),"pe_theme_utils");
		$this->registerAssetsUtils();
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.youtube.js",array("jquery"),"pe_theme_utils_youtube");
		$this->addScript("framework/js/pe/froogaloop.js",array("jquery"),"pe_theme_froogaloop");
		$this->addScript("framework/js/pe/jquery.pixelentity.utils.vimeo.js",
						 array(
							   "jquery",
							   "pe_theme_froogaloop"
							   ),"pe_theme_utils_vimeo");

		$this->addScript("framework/js/video/projekktor.min.js",array("jquery"),"pe_theme_projekktor");

		$this->addStyle("framework/js/video/theme/style.css",array(),"pe_theme_projekktor");
		
		$deps = 
			array(
				  "pe_theme_utils_youtube",
				  "pe_theme_utils_vimeo"
				  );

		if (defined('PE_THEME_LOCAL_VIDEO_SUPPORT')) {
			$deps[] = "pe_theme_projekktor";
		}

		$this->addScript("framework/js/pe/jquery.pixelentity.video.js",apply_filters("pe_theme_video_js_deps",$deps),"pe_theme_video");
		
		$this->addScript("framework/js/pe/jquery.pixelentity.videoPlayer.js",array("pe_theme_video"),"pe_theme_videoPlayer");

		$this->addScript("framework/js/pe/jquery.pixelentity.transitions.hilight.js",
						 array(
							   "pe_theme_utils_preloader"
							   ),"pe_theme_transition_hilight");

		$this->addScript("framework/js/pe/jquery.pixelentity.influxSlider.js",
						 array(
							   "pe_theme_utils_timer",
							   "pe_theme_transition_hilight"
							   ),"pe_theme_influxSlider");

		$this->addStyle("framework/css/video/style.css",array(),"pe_theme_video");
		
		$this->addScript("framework/js/pe/jquery.pixelentity.effects.icon.js",array("jquery"),"pe_theme_effects_icon");
		$this->addScript("framework/js/pe/jquery.pixelentity.effects.iconmove.js",array("pe_theme_utils_easing"),"pe_theme_effects_iconmove");
		$this->addScript("framework/js/pe/jquery.pixelentity.effects.bw.js",array("jquery"),"pe_theme_effects_bw");
		$this->addScript("framework/js/pe/jquery.pixelentity.effects.info.js",array("pe_theme_utils_transition","pe_theme_utils_easing"),"pe_theme_effects_info");

		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.js",array("jquery"),"pe_theme_widgets");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.links.js",array("pe_theme_widgets"),"pe_theme_widgets_links");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.ngg.js",
						 array(
							   "pe_theme_utils_geom",
							   "pe_theme_transform",
							   "pe_theme_widgets"
							   ),"pe_theme_widgets_ngg");

		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.slider.js",
						 array(
							   "pe_theme_widgets",
							   "pe_theme_influxSlider"
							   ),"pe_theme_widgets_slider");

		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.prettyphoto.js",
						 array(
							   "pe_theme_widgets_links",
							   "pe_theme_effects_icon",
							   "pe_theme_videoPlayer"
							   ),"pe_theme_widgets_prettyphoto");

		$this->addScript("framework/js/pe/jquery.pixelentity.thumblist.js",
						 array(
							   "pe_theme_utils_preloader",
							   ),"pe_theme_thumblist");

		$this->addStyle("framework/css/jquery.pixelentity.background.css",array(),"pe_theme_background");
		$this->addScript("framework/js/pe/jquery.pixelentity.backgroundSlider.js",
						 array(
							   "json2",
							   "pe_theme_utils_preloader",
							   "pe_theme_utils_ticker",
							   "pe_theme_utils_geom",
							   "pe_theme_transform",
							   ),"pe_theme_backgroundSlider");


		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.backgroundSlider.js",array("pe_theme_backgroundSlider","pe_theme_widgets"),"pe_theme_widgets_backgroundSlider");

		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.dynamicBackground.js",array("pe_theme_widgets"),"pe_theme_widgets_dynamicBackground");

		$this->addScript("framework/js/pe/jquery.pixelentity.galleryslider.js",array("jquery"),"pe_theme_galleryslider");
		
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.galleryslider.js",
						 array(
							   "pe_theme_widgets",
							   "pe_theme_widgets_volo",
							   "pe_theme_galleryslider"
							   ),"pe_theme_widgets_galleryslider");

		$this->addScript("framework/js/pe/jquery.pixelentity.contactForm.js",array("jquery"),"pe_theme_contactForm");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.contact.js",array("pe_theme_contactForm","pe_theme_widgets"),"pe_theme_widgets_contact");	
		//wp_localize_script("pe_theme_contactForm", 'peContactForm',array("url"=>urlencode(admin_url("admin-ajax.php"))));

		if ($this->minifyJS) {
			$this->addScript($this->minifiedJS,apply_filters("pe_theme_minified_js_deps",array("jquery")),"pe_theme_init");	   
		} else {
			$this->addScript(apply_filters("pe_theme_js_init_file","framework/js/pe/init.js"),apply_filters("pe_theme_js_init_deps",array("pe_theme_boot","jquery","pe_theme_controller")),"pe_theme_init");
		}

		// bootstrap files
		$this->addStyle("framework/css/reset.css",array(),"pe_theme_reset");
		$this->addStyle("framework/js/bootstrap/2.2.1/css/bootstrap.css",array(),"pe_theme_bootstrap");
		$this->addStyle("framework/js/bootstrap/2.2.1/css/bootstrap-responsive.css",array("pe_theme_bootstrap"),"pe_theme_bootstrap_responsive");
		$this->addScript(apply_filters("pe_theme_bootstrap_js","framework/js/bootstrap/2.2.1/js/bootstrap.min.js"),array("jquery"),"pe_theme_bootstrap");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.bslinks.js",array("pe_theme_bootstrap","pe_theme_widgets"),"pe_theme_widgets_bslinks");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.bootstrap.js",array("pe_theme_bootstrap","pe_theme_widgets"),"pe_theme_widgets_bootstrap");


		// menu
		$this->addScript("framework/js/jquery.debouncedresize.js",array(),"pe_theme_debouncedresize",false);
		$this->addScript("framework/js/pe/jquery.pixelentity.menu.js",array("jquery","pe_theme_debouncedresize","pe_theme_utils_browser"),"pe_theme_menu");

		// prettify
		$this->addStyle("framework/js/prettify/css/prettify.css",array(),"pe_theme_prettify");
		$this->addScript("framework/js/prettify/prettify.js",array("jquery"),"pe_theme_prettify");

		// selectnav
		$this->addScript("framework/js/selectnav.js",array(),"pe_theme_selectnav");

		// selectivizr
		$this->addScript("framework/js/selectivizr-min.js",array(),"pe_theme_selectivizr",false);

		// lazyload
		// $this->addScript("framework/js/jquery.lazyload.js",array(),"pe_theme_lazyload");
		$this->addScript("framework/js/pe/jquery.pixelentity.lazyload.js",array(),"pe_theme_lazyload");
		
		// jquery mobile
		$this->addScript("framework/js/jquery.mobile.custom.min.js",array(),"pe_theme_mobile");

		// isotope
		$this->addStyle("framework/css/isotope.css",array(),"pe_theme_isotope_plugin");
		$this->addScript("framework/js/jquery.isotope.min.js",array("jquery"),"pe_theme_isotope");
		$this->addStyle("framework/css/jquery.pixelentity.isotope.css",array("pe_theme_isotope_plugin"),"pe_theme_isotope");
		$this->addScript("framework/js/pe/jquery.pixelentity.isotope.js",array("pe_theme_isotope"),"pe_theme_peisotope");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.isotope.js",array("pe_theme_peisotope","pe_theme_widgets"),"pe_theme_widgets_isotope");

		// animate.css
		$this->addStyle("framework/css/animate.min.css",array(),"pe_theme_animate_css");

		// refineslide
		$this->addScript("framework/js/refineslide/jquery.refineslide.js",array("jquery"),"pe_theme_refineslide");
		$this->addScript("framework/js/pe/jquery.pixelentity.refineslide.js",array("pe_theme_refineslide"),"pe_theme_perefineslide");
		$this->addStyle("framework/js/refineslide/refineslide.css",array(),"pe_theme_refineslide");

		// volo slider
		$this->addStyle("framework/js/pe.volo/themes/common.css",array(),"pe_theme_volo");
		$this->addScript("framework/js/pe/jquery.pixelentity.volo.js",array("jquery"),"pe_theme_volo");
		$this->addScript("framework/js/pe/jquery.pixelentity.volo.captions.js",array("jquery"),"pe_theme_volo_captions");
		$this->addScript("framework/js/pe/jquery.pixelentity.volo.simpleskin.js",array("pe_theme_volo"),"pe_theme_volo_skin");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.volo.js",array("pe_theme_volo_skin","pe_theme_volo_captions","pe_theme_widgets"),"pe_theme_widgets_volo");

		// vario slider
		$this->addStyle("framework/css/vario-transitions.css",array("pe_theme_volo"),"pe_theme_vario");
		$this->addScript("framework/js/pe/jquery.pixelentity.vario.js",array("pe_theme_volo_skin","pe_theme_volo_captions"),"pe_theme_vario");

		$deps = array();
		if (defined('PE_THEME_LOCAL_VIDEO_SUPPORT')) {
			$deps[] = "pe_theme_projekktor";
		}
		$deps[] = "pe_theme_flare_common";


		// flare lightbox
		$this->addStyle("framework/js/pe.flare/themes/common.css",array(),"pe_theme_flare_common");
		$this->addStyle("framework/js/pe.flare/themes/default/skin.css",apply_filters("pe_theme_flare_css_deps",$deps),"pe_theme_flare");

		$this->addScript("framework/js/pe/jquery.mousewheel.js",array("jquery"),"pe_theme_mousewheel");
		$this->addScript("framework/js/pe/jquery.pixelentity.flare.lightbox.js",array("jquery"),"pe_theme_flare_common");
		$this->addScript("framework/js/pe/jquery.pixelentity.simplethumb.js",array("jquery"),"pe_theme_flare_simplethumb");
		$this->addScript("framework/js/pe/jquery.pixelentity.flare.lightbox.render.gallery.js",array("jquery"),"pe_theme_flare_gallery");
		$this->addScript("framework/js/pe/jquery.pixelentity.flare.lightbox.render.image.js",
						 array(
							   "pe_theme_utils",
							   "pe_theme_mousewheel",
							   "pe_theme_utils_browser",
							   "pe_theme_utils_geom",
							   "pe_theme_utils_preloader",
							   "pe_theme_utils_transition",
							   "pe_theme_transform",
							   "pe_theme_videoPlayer",
							   "pe_theme_backgroundSlider",
							   "pe_theme_flare_common",
							   "pe_theme_flare_simplethumb",
							   "pe_theme_flare_gallery"
							   ),"pe_theme_flare");

		// black and white
		$this->addStyle("framework/css/jquery.pixelentity.blackandwhite.css",array(),"pe_theme_blackandwhite");
		$this->addScript("framework/js/pe/jquery.pixelentity.blackandwhite.js",array("jquery"),"pe_theme_blackandwhite");

		// twitter widget
		$this->addScript("framework/js/pe/jquery.pixelentity.twitter.js",array("jquery"),"pe_theme_twitter");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.twitter.js",array("pe_theme_twitter","pe_theme_widgets"),"pe_theme_widgets_twitter");

		// flickr widget
		$this->addScript("framework/js/pe/jquery.pixelentity.flickr.js",array("jquery"),"pe_theme_flickr");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.flickr.js",array("pe_theme_flickr","pe_theme_widgets"),"pe_theme_widgets_flickr");

		// newsletter widget
		$this->addScript("framework/js/pe/jquery.pixelentity.newsletter.js",array("jquery"),"pe_theme_newsletter");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.newsletter.js",array("pe_theme_newsletter","pe_theme_widgets"),"pe_theme_widgets_newsletter");

		// additional widgets
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.gmap.js",array("pe_theme_widgets"),"pe_theme_widgets_gmap");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.social.facebook.js",array("pe_theme_widgets"),"pe_theme_widgets_social_facebook");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.social.twitter.js",array("pe_theme_widgets"),"pe_theme_widgets_social_twitter");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.social.google.js",array("pe_theme_widgets"),"pe_theme_widgets_social_google");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.social.pinterest.js",array("pe_theme_widgets"),"pe_theme_widgets_social_pinterest");


		$this->addStyle("framework/css/jquery.pixelentity.carousel.css",array(),"pe_theme_carousel");
		$this->addScript("framework/js/pe/jquery.pixelentity.widgets.carousel.js",array("pe_theme_widgets"),"pe_theme_widgets_carousel");


		wp_localize_script($this->minifyJS ? "pe_theme_init" : "pe_theme_contactForm", 'peContactForm',array("url"=>urlencode(admin_url("admin-ajax.php"))));
		wp_localize_script($this->minifyJS ? "pe_theme_init" : "pe_theme_newsletter", 'peNewsletter',array("url"=>urlencode(admin_url("admin-ajax.php"))));

		if (defined('PE_THEME_LOCAL_VIDEO_SUPPORT')) {
			wp_localize_script($this->minifyJS ? "pe_theme_init" : "pe_theme_video", 'peFallBackPlayer',array("url"=>urlencode(PE_THEME_URL."/framework/js/video/jarisplayer.swf")));
		}

		$this->addStyle($this->minifiedCSS,array(),"pe_theme_compressed");

	}

	public static function getAssetLink($res) {
		return file_exists(get_stylesheet_directory() . "/$res") ? get_stylesheet_directory_uri()."/$res" : PE_THEME_URL."/$res";  
	}

	public static function addAsset($type,$res,$deps = NULL,$name = NULL,$footer = false) {
		if (!isset($name)) {
			$name = $res;
		}
		$fun = "wp_register_$type";
		if (PE_THEME_MODE || PE_THEME_PLUGIN_MODE && is_admin()) {
			$fun($name,self::getAssetLink($res),$deps,self::version($res),$type === "style" ? "all" : $footer);
		}
	}

	public static function addScript($res,$deps = NULL,$name = NULL,$footer = true) {
		self::addAsset("script",$res,$deps,$name,$footer ? (is_admin() ? false : true) : false);
	}

	public static function addStyle($res,$deps = NULL,$name = NULL) {
		self::addAsset("style",$res,$deps,$name);
	}

	public static function version($res) {
		$version = @filemtime(PE_THEME_PATH."/".$res);
		return $version ? $version : "1.0";
	}

	public function style() {
		if ($this->minifyCSS) {
			echo PE_THEME_URL."/".$this->minifiedCSS;
		} else {
			bloginfo("stylesheet_url"); 
		}
		
	}


	public function enqueueAssets() {
		$this->registerAssets();
		wp_enqueue_style("pe_theme_init");
		wp_enqueue_script("pe_theme_init");
	}


}

?>