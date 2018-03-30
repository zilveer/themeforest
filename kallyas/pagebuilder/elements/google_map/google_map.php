<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Google Map
	Description: This element will generate a map
	Class: ZnGoogleMap
	Category: Content, Fullwidth
	Level: 3
	Scripts: true
	Styles: true
*/

class ZnGoogleMap extends ZnElements {

	function options() {

		$zoom = array ();

		for ( $i = 1; $i<24; $i++) {
			$zoom[$i] = $i;
		}

		$icon_sizes = array(
			'20' => '20 x 20' ,
			'30' => '30 x 30' ,
			'40' => '40 x 40' ,
			'50' => '50 x 50' ,
			'60' => '60 x 60' ,
			'70' => '70 x 70' ,
			'80' => '80 x 80' ,
			);

		$mapstyleurl = 'http://snazzymaps.com';
		$latlong_url = esc_url('http://www.latlong.net/');
		$itouchmap_url = esc_url('http://itouchmap.com/latlong.html');

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						"name" => "Google Maps Api Key (Mandatory!)",
						"description" => 'Add a Google Map Api Key. More on <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key">Google Maps Key</a>',
						"id" => "sc_map_apikey",
						"std" => "",
						"type" => "text",
						"class" => "zn_input_xl"
					),

					array(
							'id'         	=> 'single_multiple_maps',
							'name'       	=> 'Locations',
							'description' 	=> 'Here you can add your map locations.',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'Map Location',
							'subelements' 	=> array(
								array(
									"name" => "Marker Latitude",
									"description" => 'Please enter the latitude value for your location. Here\'s 2 links where you can get the coordinates <a href="'.$latlong_url.'" target="_blank">LatLong.net</a> or <a href="'.$itouchmap_url.'" target="_blank">iTouchMap.com</a>.',
									"id" => "sc_map_latitude",
									"std" => "41.447390",
									"type" => "text"
								),
								array(
									"name" => "Marker Longitude",
									"description" => 'Please enter the longitude value for your location. Here\'s 2 links where you can get the coordinates <a href="'.$latlong_url.'" target="_blank">LatLong.net</a> or <a href="'.$itouchmap_url.'" target="_blank">iTouchMap.com</a>.',
									"id" => "sc_map_longitude",
									"std" => "-72.843868",
									"type" => "text"
								),
								array(
									"name" => "Marker tooltip",
									"description" => "Add a text that will appear when the user clicks on the marker.",
									"id" => "tooltip",
									"type" => "textarea"
								),
								array(
									"name" => "Marker location icon",
									"description" => "Select an icon that will appear as your current location. The default icon will be used if this is left blank.",
									"id" => "sc_map_icon",
									"std" => "",
									'class' => 'zn_full',
									"type" => "media"
								),
								array(
									"name" => "Marker animation",
									"description" => "Select an animation that the icon will use.",
									"id" => "sc_map_icon_animation",
									"std" => "",
									"type" => "select",
									"options" => array ( "" => "None", "DROP" => "Drop" , "BOUNCE" =>  "Bounce" ),
								),
								array(
									"name" => "Icon size",
									"description" => "Select the size of the marker icon.",
									"id" => "icon_size",
									"type" => "select",
									"options" => $icon_sizes,
								)
							)

						),
						array(
							"name" => "Zoom level",
							"description" => "Select the start zoom level you want to use for this map ( default is 14 )",
							"id" => "sc_map_zoom",
							"std" => "14",
							"type" => "select",
							"options" => $zoom,
							"class" => ""
						),
						array(
							"name" => "Map Type",
							"description" => "Select the desired map type you want to use.",
							"id" => "sc_map_type",
							"std" => "roadmap",
							"type" => "select",
							"options" => array ( "ROADMAP" => "Roadmap", "SATELLITE" => "Satellite" , "TERRAIN" => "Terrain" , "HYBRID" => "Hybrid" ),
							"class" => ""
						),
						array(
							"name" => "Add directions box",
							"description" => "Select if you want to add a textbox in which the user can enter a departure location and get directions to the office location (first one if there are more than one).",
							"id" => "sc_map_directions",
							"std" => 'yes',
							"type" => "toggle2",
							"value" => "yes"
						),
						array(
							"name" => "Directions box text",
							"description" => "Please enter the direction box text you want to use.",
							"id" => "sc_map_directions_text",
							"std" => 'Visit us from...',
							"type" => "text",
							'dependency'  => array( 'element' => 'sc_map_directions' , 'value'=> array('yes') ),
						),

						array(
							"name" => "Directions box position",
							"description" => "Please select the direction box's position.",
							"id" => "sc_map_directions_pos",
							"std" => 'top-left',
							"type" => "select",
							"options" => array (
								"top-left" => "Top Left",
								"middle-left" => "Middle Left",
								"bottom-left" => "Bottom Left",
								"top-right" => "Top Right",
								"middle-right" => "Middle Right",
								"bottom-right" => "Bottom Right",
								"top-center" => "Top Center",
								"bottom-center" => "Bottom Center",
							),
							'dependency'  => array( 'element' => 'sc_map_directions' , 'value'=> array('yes') ),
						),

						array(
							'id'            => 'show_overview',
							'name'          => 'Show overview map',
							'description'   => 'Select if you wish to add the overview map option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_streetview',
							'name'          => 'Show street view',
							'description'   => 'Select if you wish to add the street view option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_maptype',
							'name'          => 'Show map type',
							'description'   => 'Select if you wish to add the map type option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),

						array (
							"name"        => __( "Info bubble type", 'zn_framework' ),
							"description" => __( "Please select the info type", 'zn_framework' ),
							"id"          => "ww_mapinfo_type",
							"std"         => "infobox",
							"type"        => "select",
							"options"     => array (
								'infobox'  => __( "Info Box", 'zn_framework' ),
								'infopanel' => __( "Info Panel", 'zn_framework' )
							)
						),

						array (
							"name"        => __( "Button Main Text", 'zn_framework' ),
							"description" => __( "Please enter a main text for this button", 'zn_framework' ),
							"id"          => "ww_slide_m_button",
							"std"         => "",
							"type"        => "text",
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
						),
						array (
							"name"        => __( "Button Link Text", 'zn_framework' ),
							"description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
							"id"          => "ww_slide_l_text",
							"std"         => "",
							"type"        => "text",
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
						),
						array (
							"name"        => __( "Button link", 'zn_framework' ),
							"description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
							"id"          => "ww_slide_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
						),

						array (
							"name"        => __( "Panel Image", 'zn_framework' ),
							"description" => __( "Display an image into the info panel.", 'zn_framework' ),
							"id"          => "sc_map_panel_img",
							"std"         => "",
							"type"        => "media",
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
						),

						array (
							"name"        => __( "Panel Title", 'zn_framework' ),
							"description" => __( "Title in panel.", 'zn_framework' ),
							"id"          => "sc_map_panel_title",
							"std"         => "",
							"type"        => "text",
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
						),

						array (
							"name"        => __( "Panel Content", 'zn_framework' ),
							"description" => __( "Content in panel.", 'zn_framework' ),
							"id"          => "sc_map_panel_text",
							"std"         => "",
							"type"        => "visual_editor",
							'class'		  => 'zn_full',
							"dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
						),
				),
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array (
						"name"        => __( "Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use. Please note that styles can be created
									from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "ww_header_style",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						"class"       => ""
					),
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => zn_get_bottom_masks(),
					),

					array(
						'id'          => 'hm_header_bmasks_bg',
						'name'        => 'Bottom Mask Background Color',
						'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
						'type'        => 'colorpicker',
						'std'         => '',
						"dependency"  => array( 'element' => 'hm_header_bmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6') ),
					),

					array (
						"name"        => __( "Enable fullscreen?", 'zn_framework' ),
						"description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
						"id"          => "sc_fullscreen",
						"std"         => "no",
						"type"        => "zn_radio",
						"options"     => array (
							'yes'  => __( "Yes", 'zn_framework' ),
							'no' => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
					),
					array(
						"name" => "Map Height",
						"description" => "Please select value in pixels for the map height.",
						"id" => "sc_map_height",
						"std" => "600",
						"type" => "slider",
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '200',
							'max' => '1080',
							'step' => '1'
						),
						"dependency"  => array( 'element' => 'sc_fullscreen' , 'value'=> array('no') ),
						),
					array(
						'id'            => 'use_custom_style',
						'name'          => 'Map custom style',
						'description'   => 'Use a custom map style. You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),
					array(
						'id'          => 'custom_style',
						'name'        => 'Normal map style',
						'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
						'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'custom_style_active',
						'name'        => 'Active map style (when a popup is visible)',
						'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
						'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
					),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(

					array(
						"name" => "Custom center point",
						"description" => "You might want to have the center point of the map onto the a side. For example if you enable the info-panel, it might overlap a marker from the map. Therefore you can custom center the map to show all markers.",
						"id" => "sc_ccenter",
						"std" => "",
						"value" => "1",
						"type" => "toggle2"
					),
					array(
						"name" => "Marker Latitude",
						"description" => 'Please enter the latitude value for your location. Here\'s 2 links where you can get the coordinates <a href="'.$latlong_url.'" target="_blank">LatLong.net</a> or <a href="'.$itouchmap_url.'" target="_blank">iTouchMap.com</a>.',
						"id" => "sc_cc_latitude",
						"std" => "",
						"placeholder" => 'eg: 41.447390',
						"type" => "text",
						"dependency"  => array( 'element' => 'sc_ccenter' , 'value'=> array('1') ),
					),
					array(
						"name" => "Marker Longitude",
						"description" => 'Please enter the longitude value for your location. Here\'s 2 links where you can get the coordinates <a href="'.$latlong_url.'" target="_blank">LatLong.net</a> or <a href="'.$itouchmap_url.'" target="_blank">iTouchMap.com</a>.',
						"id" => "sc_cc_longitude",
						"std" => "",
						"placeholder" => 'eg: -72.843868',
						"type" => "text",
						"dependency"  => array( 'element' => 'sc_ccenter' , 'value'=> array('1') ),
					),
					array(
						"name" => "Allow Mousewheel",
						"description" => "Select if you want to allow map zooming using the mouse scroll (may interfere with page scroll).",
						"id" => "sc_map_zooming_mousewheel",
						"std" => "",
						"type" => "toggle2",
						"value" => "yes",
					),
					array(
						"name" => "Map localization",
						"description" => "Force the map localization to a specific language",
						"id" => "sc_map_localization",
						"std" => "",
						"type" => "select",
						"options" => array ( '' => 'Use browser language','ar'=>'ARABIC','eu'=>'BASQUE','bg'=>'BULGARIAN','bn'=>'BENGALI','ca'=>'CATALAN','cs'=>'CZECH','da'=>'DANISH','de'=>'GERMAN','el'=>'GREEK','en'=>'ENGLISH','en-AU'=>'ENGLISH (AUSTRALIAN)','en-GB'=>'ENGLISH (GREAT BRITAIN)','es'=>'SPANISH','eu'=>'BASQUE','fa'=>'FARSI','fi'=>'FINNISH','fil'=>'FILIPINO','fr'=>'FRENCH','gl'=>'GALICIAN','gu'=>'GUJARATI','hi'=>'HINDI','hr'=>'CROATIAN','hu'=>'HUNGARIAN','id'=>'INDONESIAN','it'=>'ITALIAN','iw'=>'HEBREW','ja'=>'JAPANESE','kn'=>'KANNADA','ko'=>'KOREAN','lt'=>'LITHUANIAN','lv'=>'LATVIAN','ml'=>'MALAYALAM','mr'=>'MARATHI','nl'=>'DUTCH','no'=>'NORWEGIAN','pl'=>'POLISH','pt'=>'PORTUGUESE','pt-BR'=>'PORTUGUESE (BRAZIL)','pt-PT'=>'PORTUGUESE (PORTUGAL)','ro'=>'ROMANIAN','ru'=>'RUSSIAN','sk'=>'SLOVAK','sl'=>'SLOVENIAN','sr'=>'SERBIAN','sv'=>'SWEDISH','tl'=>'TAGALOG','ta'=>'TAMIL','te'=>'TELUGU','th'=>'THAI','tr'=>'TURKISH','uk'=>'UKRAINIAN','vi'=>'VIETNAMESE','zh-CN'=>'CHINESE (SIMPLIFIED)','zh-TW'=>'CHINESE (TRADITIONAL)'),
						"class" => ""
					),

				)
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#qtw5ShCYcNY',
				'docs'    => 'http://support.hogash.com/documentation/google-map/',
				'copy'    => $uid,
				'general' => true,
			)),

		);


		return $options;

	}

	function element(){

		$uid = $this->data['uid'];
		$options = $this->data['options'];

		$locations = $this->opt('single_multiple_maps') ? $this->opt('single_multiple_maps') : '';
		$sc_map_directions_text = $this->opt('sc_map_directions_text') ? $this->opt('sc_map_directions_text') : __('Visit us from...','zn_framework');
		$sc_map_apikey = $this->opt('sc_map_apikey', '');

		if ( !$this->validation('locations') ) {
			echo '<div class="zn-pb-notification">Please configure the element options and add at least one location.</div>';
			return;
		}

		/**
		 * TODO
		 * For the moment it still partially works without an API Key,
		 * but let's notice to user to anticipate the change.
		 * In the future when API Key is fully required, stop running script and force the API key.
		 */
		if ( !$this->validation('key') && ZN()->pagebuilder->is_active_editor ) {
			$key_notice = sprintf(
				'%s <a href="%s" target="_blank">%s</a>.',
				__('Please add a Google Maps API Key. Very soon it\'s likely the map will stop working without one.', 'zn_framework'),
				esc_url( 'https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,places_backend&keyType=CLIENT_SIDE&reusekey=true' ),
				__('Generate one here', 'zn_framework')
			);
			echo '<div class="zn-pb-notification">'.$key_notice.'</div>';
		}

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		$attributes = zn_get_element_attributes($options);

		?>

		<div class="zn_google_map kl-slideshow static-content__slideshow scontent__maps <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo ( $this->opt('sc_fullscreen', 'no') == 'yes' ? 'static-content--fullscreen' : '' ); ?> <?php echo zn_get_element_classes($options); ?>" <?php echo $attributes; ?>>

			<div class="bgback"></div>
			<div class="th-sparkles"></div>

			<!-- map container -->
			<div id="zn_google_map_<?php echo $this->data['uid']; ?>" class="zn_gmap_canvas th-google_map">
				<?php if ( $this->opt('sc_map_directions') === 'yes') {?>
					<div class="zn_visitUsContainer zn_visit--pos-<?php echo $this->opt('sc_map_directions_pos','top-left'); ?>">
						<input type="text" required placeholder="<?php echo esc_attr($sc_map_directions_text); ?>" class="animate zn_startLocation kl-font-alt" />
						<span class="zn_removeRoute zn_icon" data-unicode="ue855" data-zniconfam="glyphicons_halflingsregular" data-zn_icon="&#xe014;"></span>
					</div>
				<?php };?>
			</div>

				<?php

				if( $this->opt('ww_mapinfo_type', 'infobox') == 'infobox' ) {

					$ww_slide_m_button = $this->opt('ww_slide_m_button');
					if ( $ww_slide_m_button || $options['ww_slide_l_text'] ) {
						echo '<div class="static-content__infopop" data-arrow="top">';

						if ( $options['ww_slide_l_text'] ) {
							$ww_slide_link = zn_extract_link($this->opt('ww_slide_link',''), 'sc-infopop__btn text-custom', '');
							echo $ww_slide_link['start'] . $options['ww_slide_l_text'] . $ww_slide_link['end'];
						}
						// BUTTON LEFT TEXT
						if ( isset ( $ww_slide_m_button ) && ! empty ( $ww_slide_m_button ) ) {
							echo '<h5 class="sc-infopop__text kl-font-alt">' . $ww_slide_m_button . '</h5>';
						}

						echo '<div class="clear"></div>';
						echo '</div>';
					}
				} else {

					?>
					<div class="kl-contentmaps__panel">

						<?php if($this->opt('sc_map_panel_img','') && $panel_img = $this->opt('sc_map_panel_img','')){ ?>
							<a href="#" class="js-toggle-class kl-contentmaps__panel-tgg hidden-xs" data-target=".kl-contentmaps__panel" data-target-class="is-closed"></a>
							<a href="<?php echo $panel_img ?>" data-lightbox="image" class="kl-contentmaps__panel-img">
								<img src="<?php echo $panel_img ?>" <?php echo ZngetImageSizesFromUrl($panel_img, true); ?> <?php echo ZngetImageAltFromUrl($panel_img, true); ?> <?php echo ZngetImageTitleFromUrl($panel_img, true); ?> class="kl-contentmaps__panel-img cover-fit-img">
							</a>
						<?php } ?>

						<?php if( $panel_text = $this->opt('sc_map_panel_text','')){ ?>

							<div class="kl-contentmaps__panel-info">
								<?php
								if( $this->opt('sc_map_panel_title','') ){
									echo '<h5 class="kl-contentmaps__panel-title">'.$this->opt('sc_map_panel_title','').'</h5>';
								}
								?>
								<div class="kl-contentmaps__panel-info-text">
								<?php
								$content = wpautop( $panel_text );
								if ( ! empty ( $panel_text ) ) {
									if ( preg_match( '%(<[^>]*>.*?</)%i', $content, $regs ) ) {
										echo do_shortcode( $content );
									}
									else {
										echo '<p>' . do_shortcode( $content ) . '</p>';
									}
								}
								?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php
				}
			zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
		</div>

	<?php
	}

	function scripts() {

		$params=array();
		$params[] = ($this->opt('sc_map_localization', '') ? 'language='.$this->opt('sc_map_localization') : '');
		$params[] = ($this->opt('sc_map_apikey', '') ? 'key='.$this->opt('sc_map_apikey') : '');
		wp_enqueue_script( 'zn_google_api', 'https://maps.googleapis.com/maps/api/js?v=3.exp'.implode('&',$params), array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_gmap', THEME_BASE_URI .'/pagebuilder/elements/google_map/assets/gmaps.js', array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_style( 'zn_static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
	}

	// Loads the required JS
	function js() {

			$locations = $this->opt('single_multiple_maps') ? $this->opt('single_multiple_maps') : array();
			$zoom = $this->opt('sc_map_zoom') ? $this->opt('sc_map_zoom') : '14' ;
			$terrain = $this->opt('sc_map_type') ? $this->opt('sc_map_type') : 'ROADMAP' ;
			$scroll = $this->opt('sc_map_zooming_mousewheel') === 'yes' ? 'true' : 'false' ;
			$routingColor = zget_option( 'sliding_background' , 'style_options' );
			$uid = $this->data['uid'];
			$mainOfficeLocation = '[0,0]';
			$markers = '';
			$use_custom_style = $this->opt('use_custom_style','');
			$custom_style = 'null';
			$custom_style_active = 'null';
			if ($use_custom_style === 'yes') {
				$custom_style = $this->opt('custom_style','null');
				$custom_style_active = $this->opt('custom_style_active','null');
			}
			$show_overview = $this->opt('show_overview') === 'yes' ? 'true' : 'false';
			$show_streetview = $this->opt('show_streetview') === 'yes' ? 'true' : 'false';
			$show_maptype = $this->opt('show_maptype') === 'yes' ? 'true' : 'false';

			if ( !empty( $locations ) )
			{
				$mainOfficeLocation = '['.$locations[0]['sc_map_latitude'].', '.$locations[0]['sc_map_longitude'].']';
				// Custom Center map
				if( $this->opt('sc_ccenter','') == 1 ){
					if($cc_lat = $this->opt('sc_cc_latitude','') && $cc_lon = $this->opt('sc_cc_longitude','')){
						$mainOfficeLocation = '['.$this->opt('sc_cc_latitude','').', '.$this->opt('sc_cc_longitude','').']';
					}
				}

				//** Build the markers [[lat, long, tooltip, icon, size, animation, anchor],...]
				$markers = '[';
				foreach ( $locations as $location ) {

					$latitude = preg_match( "/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/", $location['sc_map_latitude'], $matches ) ? $location['sc_map_latitude'] : false;
					$longitude = preg_match( "/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/", $location['sc_map_longitude'], $matches ) ? $location['sc_map_longitude'] : false;

					if( empty( $latitude ) || empty( $longitude ) ){
						continue;
					}


					$tooltip = !empty( $location['tooltip'] ) ? $location['tooltip'] : '';
					$icon_size = !empty( $location['icon_size'] ) ? $location['icon_size'] : '20';
					$sc_map_icon_animation = !empty( $location['sc_map_icon_animation'] ) ? $location['sc_map_icon_animation'] : '';
					$markers .= sprintf('[%1$s,%2$s,\'%3$s\',\'%4$s\',%5$s,\'%6$s\',%7$s],',
										$latitude,
										$longitude,
										preg_replace( "/\r|\n/", "", wpautop(addslashes($tooltip)) ),
										$location['sc_map_icon'],
										$icon_size,
										$sc_map_icon_animation,
										'');
				}
				$markers .= ']';

				$zn_g_map = array ( 'gmap'.$this->data['uid'] =>
						"
							var zn_google_map_$uid = new Zn_google_map('zn_google_map_$uid', $mainOfficeLocation, '$routingColor', $markers, '$terrain', $zoom, $scroll, $custom_style, $custom_style_active, $show_overview, $show_streetview, $show_maptype);
							zn_google_map_$uid.init_map();
							$(window).on('zn_tabs_refresh zn_slide_refresh', function(){ zn_google_map_$uid.refreshUI(); });
						");
						return $zn_g_map;
			};

		return false;

	}

		/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$height = (int)$this->opt('sc_map_height', '600');

		if( $height != 600 ) {
			$css = '
.'.$uid.':not(.static-content--fullscreen) { height:'.$height.'px;}
@media only screen and (max-height : '.$height.'px){ .'.$uid.':not(.static-content--fullscreen) {height:90vh;} }';
		}

		return $css;
	}


	function validation($which){
		$is_ok = true;
		$sc_map_apikey = $this->opt('sc_map_apikey', '');
		$locations = $this->opt('single_multiple_maps') ? $this->opt('single_multiple_maps') : array();
		if ( $which == 'locations' && empty($locations) ) {
			$is_ok = false;
		}
		elseif ( $which == 'key' && empty($sc_map_apikey) ) {
			$is_ok = false;
		}
		return $is_ok;
	}
}


?>
