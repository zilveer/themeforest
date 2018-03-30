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
		wp_register_script('google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
		wp_register_script('jquery-gmap', CT_THEME_ASSETS . '/js/jquery.gmap.min.js', array('jquery', 'google-map-api'), '2.1');
		wp_enqueue_script('jquery-gmap');
		wp_enqueue_script('google-map-api',false,array(),false,true);
		wp_register_script('ct-infobox', CT_THEME_ASSETS . '/js/infobox_packed.js');
		wp_enqueue_script('ct-infobox');
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);
		$id = rand(100, 1000);

		if ($height) {
			if (is_numeric($height)) {
				$height = $height . 'px';
			}
			$height = 'height:' . $height . ';';
		} else {
			$height = '';
		}

		$this->addInlineJS($this->getInlineJS($attributes, $id));
		return '<div'.$this->buildContainerAttributes(array('class'=>array('gMapCustom')),$atts).'>
                    <div id="map_canvas' . $id . '" style="width:100%;' . $height . '">

                    </div>
                </div>';
	}


	/**
	 * returns inline js
	 * @param $attributes
	 * @return string
	 */
	protected function getInlineJS($attributes, $id){
		extract($attributes);

		/* fix */
		$search = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
		$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
		$maptype = str_replace($search, $replace, $maptype);
		/* end fix */

		$disableDoubleClickZoom = ($doubleclickzoom == 'false'||$doubleclickzoom =='0') ? 'false' : 'true';

		if($style == 'mono'){
			return 'function initializeMap' . $id . '() {


			        var secheltLoc = new google.maps.LatLng(' . $latitude . ', ' . $longitude . ');

					var myMapOptions = {
						 zoom: ' . $zoom . '
						,center: secheltLoc
						,mapTypeId: google.maps.MapTypeId.' . $maptype . '
						,scrollwheel:'.$scrollwheel.'
						,disableDoubleClickZoom:'.$disableDoubleClickZoom.'
                        ,mapTypeControlOptions: {
                            mapTypeIds: ["map_style", google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE]
                        }
					};

					var theMap = new google.maps.Map(document.getElementById("map_canvas' . $id . '"), myMapOptions);


					var marker = new google.maps.Marker({
						map: theMap,
						draggable: true,
						position: new google.maps.LatLng(' . $latitude . ', ' . $longitude . '),
						visible: false
					});

					var boxText = document.createElement("div");
					boxText.style.cssText = " ";
					boxText.innerHTML = "<div class=' . "'" . 'customMapMarker' . "'" . '><i class=' . "'" . 'fa fa-map-marker' . "'" . '></i></div>";

					var myOptions = {
						 content: boxText
						,disableAutoPan: false
						,maxWidth: 0
						,pixelOffset: new google.maps.Size(-30, -30)
						,zIndex: null
						,boxStyle: {
			              background: " "
						  ,opacity: 1.0
						  ,width: "60px"
			              ,height: "60px"
						 }
						,closeBoxMargin: "10px 2px 2px 2px"
						,closeBoxURL: " "
						,infoBoxClearance: new google.maps.Size(1, 1)
						,isHidden: false
						,pane: "floatPane"
						,enableEventPropagation: false
					};

					google.maps.event.addListener(marker, "click", function (e) {
						ib.open(theMap, this);
					});

					var ib = new InfoBox(myOptions);

			        // Create an array of styles.
					  var styles = [
					    {
						    featureType: "all",
						    stylers: [
						      { saturation: -100 }
						    ]
						  }
					  ];

		            var styledMap = new google.maps.StyledMapType(styles,
                    {name: "Monochromatic"});

                    theMap.mapTypes.set("map_style", styledMap);
                    theMap.setMapTypeId("map_style");

					ib.open(theMap, marker);
				}


			    jQuery(window).load(function () {

			        initializeMap' . $id . '();

			    });';
		}else{
			return '/* custom google map marker */


				function initializeMap' . $id . '() {
			        var secheltLoc = new google.maps.LatLng(' . $latitude . ', ' . $longitude . ');

					var myMapOptions = {
						 zoom: ' . $zoom . '
						,center: secheltLoc
						,mapTypeId: google.maps.MapTypeId.' . $maptype . '
						,scrollwheel:'.$scrollwheel.'
						,disableDoubleClickZoom:'.$disableDoubleClickZoom.'
					};
					var theMap = new google.maps.Map(document.getElementById("map_canvas' . $id . '"), myMapOptions);


					var marker = new google.maps.Marker({
						map: theMap,
						draggable: true,
						position: new google.maps.LatLng(' . $latitude . ', ' . $longitude . '),
						visible: false
					});

					var boxText = document.createElement("div");
					boxText.style.cssText = " ";
					boxText.innerHTML = "<div class=' . "'" . 'customMapMarker' . "'" . '><i class=' . "'" . 'icon-map-marker' . "'" . '></i></div>";

					var myOptions = {
						 content: boxText
						,disableAutoPan: false
						,maxWidth: 0
						,pixelOffset: new google.maps.Size(-30, -30)
						,zIndex: null
						,boxStyle: {
			              background: " "
						  ,opacity: 1.0
						  ,width: "60px"
			              ,height: "60px"
						 }
						,closeBoxMargin: "10px 2px 2px 2px"
						,closeBoxURL: " "
						,infoBoxClearance: new google.maps.Size(1, 1)
						,isHidden: false
						,pane: "floatPane"
						,enableEventPropagation: false
					};

					google.maps.event.addListener(marker, "click", function (e) {
						ib.open(theMap, this);
					});

					var ib = new InfoBox(myOptions);

					ib.open(theMap, marker);
				}


			    jQuery(window).load(function () {

			        initializeMap' . $id . '();

			    });';
		}

	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			"height" => array('label' => __('height', 'ct_theme'), 'default' => '350', 'type' => 'input'),
			"latitude" => array('label' => __('latitude', 'ct_theme'), 'default' => 0, 'type' => 'input'),
			"longitude" => array('label' => __('longitude', 'ct_theme'), 'default' => 0, 'type' => 'input'),
			"zoom" => array('label' => __('zoom', 'ct_theme'), 'default' => 16, 'type' => 'input'),
			"scrollwheel" => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Scroll Wheel', 'ct_theme')),
			'doubleclickzoom' => array('default' => 'true', 'type' => 'checkbox', 'label' => __('Doubleclick zoom', 'ct_theme')),
			"maptype" => array('label' => __('map type', 'ct_theme'), 'default' => 'ROADMAP', 'type' => 'select', 'choices' => array('ROADMAP' => __('ROADMAP', 'ct_theme'), 'SATELLITE' => __('SATELLITE', 'ct_theme'), 'HYBRID' => __('HYBRID', 'ct_theme'), 'TERRAIN' => __('TERRAIN', 'ct_theme'))),
			"style" => array('label' => __('map style', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array('default' => __('default', 'ct_theme'), 'mono' => __('monochrome', 'ct_theme'))),
		);
	}
}

new ctGoogleMapsShortcode();