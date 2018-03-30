<?php
/**
 * Mtheme Style
 *
 * Adds custom styles and fonts
 *
 * @class MthemeStyle
 * @author Mtheme
 */
 
class MthemeStyle {

	/**
	 * Adds actions and filters
     *
     * @access public
     * @return void
     */
	public static function init() {
	
		//add custom styles
		add_action('wp_head', array(__CLASS__,'renderStyles'));
		
		add_action( 'wp_head', array(__CLASS__,'mp6_override_toolbar_margin' ), 11);
		
		//add custom fonts
		add_action('wp_head', array(__CLASS__,'renderFonts'));
		
	}
	
	
	public static function mp6_override_toolbar_margin()
	{		
		$out='<style type="text/css" media="screen">@media screen and (max-width: 782px) { html {margin-top: 0 !important;}}';
		if ( is_admin_bar_showing() ) {
			$out.='.header{ margin-top: 32px; }';
			$out.='.slideshow nav span.nav-close{ top: 42px; }';
		}
		$out.='</style>';
		echo mtheme_html($out);
	}
	/**
	 * Adds custom styles
     *
     * @access public
     * @return void
     */
	public static function renderStyles() {
		
		$out='<link rel="shortcut icon" href="'.MthemeCore::getOption('favicon', CHILD_URI."site/img/favicon.ico").'"/>';
				
		$out.='<style type="text/css">';
		
		if(isset(MthemeCore::$components['custom_styles'])) {
			foreach(MthemeCore::$components['custom_styles'] as $style) {
				$out.=$style['elements'].'{';
				
				foreach($style['attributes'] as $attribute) {
					
					$option=MthemeCore::getOption($attribute['option'],$attribute['default']);
					
					if($option) {
						if($attribute['name']=='background-image') {
							$option='url('.$option.')';
						} else if($attribute['name']=='font-family') {
							$option=$option.', sans-serif';
						}
						
						if(isset($attribute['important']) && $attribute['important']) {
							$option=$option.'!important';
						}
						
						$out.=$attribute['name'].':'.$option.';';
					}
				}				
				
				$out.='}';				
			}
		}
		
		$out.=MthemeCore::getOption('css');
		$out.='</style>';
		$out.='<script type="text/javascript">';
		$out.=MthemeCore::getOption('js');
		$out.='</script>';
		
		echo mtheme_html($out);		
	}
	
	/**
	 * Adds custom fonts
     *
     * @access public
     * @return void
     */
	public static function renderFonts() {
		$fonts=array();
		
		$nice_scrool=MthemeCore::getOption('nice_scrool','true');
		$out='<script type="text/javascript">';
		$out.='window.globalNiceScroolVar = "'.esc_js($nice_scrool).'";';
		$out.='window.years = "'.esc_js(__('Years','mtheme')).'";';
		$out.='window.months = "'.esc_js(__('Months','mtheme')).'";';
		$out.='window.weeks = "'.esc_js(__('Weeks','mtheme')).'";';
		$out.='window.days = "'.esc_js(__('Days','mtheme')).'";';
		$out.='window.hours = "'.esc_js(__('Hours','mtheme')).'";';
		$out.='window.minutes = "'.esc_js(__('Minutes','mtheme')).'";';
		$out.='window.seconds = "'.esc_js(__('Seconds','mtheme')).'";';
		$out.='window.year = "'.esc_js(__('Year','mtheme')).'";';
		$out.='window.month = "'.esc_js(__('Month','mtheme')).'";';
		$out.='window.week = "'.esc_js(__('Week','mtheme')).'";';
		$out.='window.day = "'.esc_js(__('Day','mtheme')).'";';
		$out.='window.hour = "'.esc_js(__('Hour','mtheme')).'";';
		$out.='window.minute = "'.esc_js(__('Minute','mtheme')).'";';
		$out.='window.second = "'.esc_js(__('Second','mtheme')).'";';
		$out.='</script>';
		echo mtheme_html($out);
		$out='';
		
		$out.='<script type="text/javascript">';
		$out.='window.globalDateVar=[];';
		$out.='window.globalSpeakersSlider=[];';
		$out.='window.globalSpeakersSliderAutoplay=[];';		
		$out.='window.globalcbpFWTabs=[];';
		$out.='window.globalSponsorGallery=[];';
		$out.='window.globalSponsorSlideWidth=[];';
		$out.='window.globalSponsorSlideHeight=[];';
		$out.='window.globalNLForm=[];';
		$out.='window.globalGridGallery=[];';
		$out.='window.globalThreeDImageId=[];';
		$out.='window.globalEventVideoHoverId=[];';
		$out.='window.globalTotalTabs=[];';
		$out.='window.globalcbpFWTabsId=[];';
		$out.='window.globalThreeDImageHoverOut=[];';
		$out.='window.globalThreeDImageHoverColor=[];';
		$out.='window.globalEventVideoHoverColor=[];';
		$out.='window.globalEventVideoHoverOut=[];';
		$out.='</script>';		
		echo mtheme_html($out);
		$out='';
		
		foreach(MthemeCore::$options as $option) {
			
			if($option['type']=='select_font') {
				$font=MthemeCore::getOption($option['id'], $option['default']);
				
				if($font=='Open Sans') {
					$font.=':300italic,400italic,600italic,700italic,800italic,400,300,600,700,800';
				}
				else {
					$font.=':400,700,600,500,300,200,100,800,900';
				}
				
				if($font=='Crete Round') {
					$out.='<style type="text/css">@font-face {
						font-family: "Crete Round";
						src: url("'.THEME_URI.'site/fonts/creteround-regular-webfont.eot");
						src: url("'.THEME_URI.'site/fonts/creteround-regular-webfont.eot?#iefix") format("embedded-opentype"),
							 url("'.THEME_URI.'site/fonts/creteround-regular-webfont.woff") format("woff"),
							 url("'.THEME_URI.'site/fonts/creteround-regular-webfont.ttf") format("truetype"),
							 url("'.THEME_URI.'site/fonts/creteround-regular-webfont.svg#crete_roundregular") format("svg");
						font-weight: normal;
						font-style: normal;
					}</style>';
				} else {
					$fonts[]=$font;
				}
			}
		}
		
		$fonts = array_unique($fonts);
		
		if(!empty($fonts)) {
			$out.='<script type="text/javascript">
			WebFontConfig = {google: { families: [ "'.implode($fonts, '","').'" ] } };
			(function() {
				var wf = document.createElement("script");
				wf.src = ("https:" == document.location.protocol ? "https" : "http") + "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
				wf.type = "text/javascript";
				wf.async = "true";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(wf, s);
			})();
			</script>';
			
			echo mtheme_html($out);
		}		
	}
	
}