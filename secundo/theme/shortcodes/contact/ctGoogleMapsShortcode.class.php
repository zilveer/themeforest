<?php
/**
 * Google maps shortcode
 */
class ctGoogleMapsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Google maps';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'google_maps';
	}

	/**
	 * Enqueue scripts
	 */

	public function enqueueScripts() {
		wp_register_script('jquery-gmap', CT_THEME_ASSETS . '/js/vendor/jquery.gmap.min.js', array('jquery', 'google-map-api'), '2.1');
		wp_register_script('google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
		wp_enqueue_script('jquery-gmap');
		wp_enqueue_script('google-map-api');
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		if ($width) {
			if (is_numeric($width)) {
				$width = $width . 'px';
			}
			$width = 'width:' . $width . ';';
		} else {
			$width = '';
			$align = false;
		}
		if ($height) {
			if (is_numeric($height)) {
				$height = $height . 'px';
			}
			$height = 'height:' . $height . ';';
		} else {
			$height = '';
		}
		$html = str_replace('{linebreak}', '<br/>', $html);
		wp_print_scripts('jquery-gmap');

		/* fix */
		$search = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
		$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
		$maptype = str_replace($search, $replace, $maptype);
		/* end fix */

		if ($controls == 'true') {
			$controls = "
		{
			panControl: {$pancontrol},
			zoomControl: {$zoomcontrol},
			mapTypeControl: {$maptypecontrol},
			scaleControl: {$scalecontrol},
			streetViewControl: {$streetviewcontrol},
			overviewMapControl: {$overviewmapcontrol}
		}
		";
		}

		$align = $align ? ' align' . $align : '';
		$id = rand(100, 1000);
		if ($marker != 'false') {
			$this->addInlineJS("jQuery(document).ready(function($) {
						var tabs = jQuery('#google_map_{$id}').parents('.tabs_container,.mini_tabs_container,.accordion');
						jQuery('#google_map_{$id}').bind('initGmap',function(){
							jQuery(this).gMap({
								zoom: {$zoom},
								markers:[{
									address: '{$address}',
									latitude: {$latitude},
									longitude: {$longitude},
									html: '{$html}',
									popup: {$popup}
								}],
								controls: {$controls},
								maptype: '{$maptype}',
								doubleclickzoom:{$doubleclickzoom},
								scrollwheel:{$scrollwheel}
							});
							jQuery(this).data('gMapInited',true);
						}).data('gMapInited',false);
						if(tabs.size()!=0){
							tabs.find('ul.tabs,ul.mini_tabs,.accordion').data('tabs').onClick(function(index) {
								this.getCurrentPane().find('.google_map').each(function(){
									if(jQuery(this).data('gMapInited')==false){
										jQuery(this).trigger('initGmap');
									}
								});
							});
						}
						else{
								jQuery('#google_map_{$id}').trigger('initGmap');
							}
						});");
			return "<div id='google_map_{$id}' class='google_map{$align}' style='{$width}{$height}'></div>";
		} else {
			$this->addInlineJS("jQuery(document).ready(function($) {
								var tabs = jQuery('#google_map_{$id}').parents('.tabs_container,.mini_tabs_container,.accordion');
								jQuery('#google_map_{$id}').bind('initGmap',function(){
									jQuery('#google_map_{$id}').gMap({
										zoom: {$zoom},
										latitude: {$latitude},
										longitude: {$longitude},
										address: '{$address}',
										controls: {$controls},
										maptype: '{$maptype}',
										doubleclickzoom:{$doubleclickzoom},
										scrollwheel:{$scrollwheel}
									});
									jQuery(this).data('gMapInited',true);
								}).data('gMapInited',false);
								if(tabs.size()!=0){
									tabs.find('ul.tabs,ul.mini_tabs,.accordion').data('tabs').onClick(function(index) {
										this.getCurrentPane().find('.google_map').each(function(){
											if(jQuery(this).data('gMapInited')==false){
												jQuery(this).trigger('initGmap');
											}
										});
									});
								}else{
									jQuery('#google_map_{$id}').trigger('initGmap');
								}
							});");
			return "<div class='simpleFrame'><div id='google_map_{$id}' class='thumbnail google_map{$align} linkable' style='{$width}{$height}'></div></div>";
		}
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			"width" => array('default' => false, 'type' => 'input'),
			"height" => array('label' => __('height', 'ct_theme'),'default' => '400', 'type' => 'input'),
			"address" => array('label' => __('address', 'ct_theme'),'default' => '', 'type' => 'input'),
			"latitude" => array('label' => __('latitude', 'ct_theme'),'default' => 0, 'type' => 'input'),
			"longitude" => array('label' => __('longitude', 'ct_theme'),'default' => 0, 'type' => 'input'),
			"zoom" => array('label' => __('zoom', 'ct_theme'),'default' => 14, 'type' => 'input'),
			"html" => array('default' => '', 'type' => 'input', 'label' => __('Localization note','ct_theme')),
			"popup" => array('label' => __('popup', 'ct_theme'),'default' => 'false', 'type' => 'checkbox'),
			"controls" => array('label' => __('controls', 'ct_theme'),'default' => 'false', 'type' => 'checkbox'),
			'pancontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Pan control','ct_theme')),
			'zoomcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Zoom control','ct_theme')),
			'maptypecontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Map type control','ct_theme')),
			'scalecontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Scale control','ct_theme')),
			'streetviewcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Streetview control','ct_theme')),
			'overviewmapcontrol' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Overview map control','ct_theme')),
			"scrollwheel" => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Scroll Wheel','ct_theme')),
			'doubleclickzoom' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Doubleclick zoom','ct_theme')),
			"maptype" => array('label' => __('map type', 'ct_theme'),'default' => 'ROADMAP', 'type' => 'select', 'choices' => array('ROADMAP' => __('ROADMAP','ct_theme'), 'SATELLITE' => __('SATELLITE','ct_theme'), 'HYBRID' => __('HYBRID','ct_theme'), 'TERRAIN' => __('TERRAIN','ct_theme'))),
			"marker" => array('label' => __('marker', 'ct_theme'),'default' => 'false', 'type' => 'checkbox'),
			'align' => array('default' => false, 'type' => false),
		);
	}
}

new ctGoogleMapsShortcode();