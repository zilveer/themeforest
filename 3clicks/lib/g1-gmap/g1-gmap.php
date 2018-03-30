<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Map_Module
 * @since G1_Map_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_GMap_Module extends G1_Module {
    private $mapInPrecontent;

    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    public function getMapTypes () {
        return array(
            'roadmap'   => __( 'Roadmap', Redux_TEXT_DOMAIN ),
            'satellite' => __( 'Satellite', Redux_TEXT_DOMAIN ),
            'hybrid'    => __( 'Hybrid', Redux_TEXT_DOMAIN ),
            'terrain'   => __( 'Terrain', Redux_TEXT_DOMAIN ),
        );
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
        add_action( 'g1_single_elements_register',      array( $this, 'register_single_element' ) );
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );
        add_action( 'g1_precontent',   array($this, 'render_in_precontent'), 11 );
        add_action( 'g1_prefooter_begin', array( $this, 'render_in_prefooter' ) );

        if ( $this->is_g1_gmaps_plugin_active() ) {
            add_filter( 'g1_gmaps_api_key', array( $this, 'set_gmaps_api_key' ) );
        }
    }

    public function set_gmaps_api_key( $api_key ) {
        $theme_api_key = $api_key = g1_get_theme_option('map', 'api_key', '');

        if ( ! empty( $theme_api_key ) ) {
            $api_key = $theme_api_key;
        }

        return $api_key;
    }

    public function render_in_precontent () {
		// new gmaps plugin right now handles map only on single page
		if ( $this->is_g1_gmaps_plugin_active() ) {
            $post_id = null;

            if ( is_singular() ) { // single page
                global $post;

                $post_id = $post->ID;
            } else if ( is_home() ) { // blog
                $post_id = absint( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );
            } else if ( is_post_type_archive( 'g1_work' ) ) { // works
                $post_id = absint( g1_get_theme_option( 'post_type_g1_work', 'page_for_posts' ) );
            }

            if ( $post_id && G1_WPML_LOADED ) {
                $post_id = absint( icl_object_id( $post_id, 'page', true ) );
            }

            $gmaps_meta = get_post_meta( $post_id, '_g1_gmaps_metabox', true );

			// user saved gmaps metabox data
			if ( ! empty ( $gmaps_meta ) && isset( $gmaps_meta['precontent_map_id'] ) ) {
				$precontent_map_id = $gmaps_meta['precontent_map_id'];

				if ( $precontent_map_id !== 'none' && $precontent_map_id !== '') {
					$this->render_g1_gmap( $precontent_map_id );
					$this->mapInPrecontent = true;
				}
			// user have plugin activated but not saved yet metabox (use old setting for new map)
			} else {
				$gmap = G1_Elements()->get( 'gmap' );

				if( ! empty( $gmap ) && $gmap === 'standard' ) {
					$global_map_id = g1_get_theme_option('ta_prefooter', 'gmap', 'none');

					$this->render_g1_gmap( $global_map_id );
					$this->mapInPrecontent = true;
				}
			}
		} else {
            // backward compatibility code
            $gmap = G1_Elements()->get( 'gmap' );

            if( !empty($gmap) && $gmap === 'standard' ) {
                $this->render_global_gmap();
                $this->mapInPrecontent = true;
            }
        }
    }

    public function render_in_prefooter () {
		// new G1 GMaps plugin right now can be set globally for all pages
        // or individually only for single page, blog and works archive page
		if ( $this->is_g1_gmaps_plugin_active() ) {
            $post_id = null;

            if ( is_singular() ) { // single page
                global $post;

                $post_id = $post->ID;
            } else if ( is_home() ) { // blog
                $post_id = absint( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );
            } else if ( is_post_type_archive( 'g1_work' ) ) { // works
                $post_id = absint( g1_get_theme_option( 'post_type_g1_work', 'page_for_posts' ) );
            }

            if ( $post_id && G1_WPML_LOADED ) {
                $post_id = absint( icl_object_id( $post_id, 'page', true ) );
            }

            $gmaps_meta = get_post_meta( $post_id, '_g1_gmaps_metabox', true );

            // user saved gmaps metabox data
            if ( ! empty ( $gmaps_meta ) && isset( $gmaps_meta['prefooter_map_id'] ) ) {
                $map_id = $gmaps_meta['prefooter_map_id'];

                // disable map
                if ( $map_id === 'none' ) {
                    return;
                }

                // inherit from global map
                if ( $map_id === '' ) {
                    $global_map_id = g1_get_theme_option('ta_prefooter', 'gmap', 'none');

                    if ( 'none' === $global_map_id ) {
                        return;
                    }

                    $this->render_g1_gmap( $global_map_id );

                    return;
                }

                // user selected a map
                $this->render_g1_gmap( $map_id );

                // user have plugin activated but not saved yet metabox (use old setting for new map)
            } else {
                $global_map_id = g1_get_theme_option('ta_prefooter', 'gmap', 'none');

                if ( 'none' === $global_map_id || $this->isMapInPrecontent() ) {
                    return;
                }

                $this->render_g1_gmap( $global_map_id );
            }
		} else {
            // backward compatibility code
            $gmap = g1_get_theme_option('ta_prefooter', 'gmap', 'none');

            if ( 'none' === $gmap || $this->isMapInPrecontent()) {
                return;
            }

            $this->render_global_gmap();
        }
    }

	public function render_g1_gmap ( $id ) {
		echo do_shortcode('[g1_gmap map_id="'. $id .'"]');
	}

    public function render_global_gmap () {
        $latitude = g1_get_theme_option('map', 'latitude', '');
        $longitude = g1_get_theme_option('map', 'longitude', '');

        if ( strlen($latitude) === 0 || strlen($longitude) === 0 ) {
            return;
        }

        $color = g1_get_theme_option('map', 'color', '');
        $map_type = g1_get_theme_option('map', 'type', 'roadmap');
        $invert_lightness = abs(g1_get_theme_option('map', 'invert_lightness', 0));
        $zoom = g1_get_theme_option('map', 'zoom', 15);
        $marker = g1_get_theme_option('map', 'marker', 'none');
        $marker_icon = g1_get_theme_option('map', 'marker_icon', '');
        $marker_content = g1_get_theme_option('map', 'marker_content', '');


        echo do_shortcode(
            sprintf(
                '[gmap color="%s" map_type="%s" invert_lightness="%s" latitude="%s" longitude="%s" zoom="%s" marker="%s" marker_icon="%s" height="%s"]%s[/gmap]',
                esc_attr($color),
                $map_type,
                $invert_lightness ? 1 : 0,
                esc_attr($latitude),
                esc_attr($longitude),
                esc_attr($zoom),
                esc_attr($marker),
                esc_attr($marker_icon),
                '680px',
                $marker_content
            )
        );
    }

    public function isMapInPrecontent () {
        return (bool)$this->mapInPrecontent;
    }

    public function register_widgets() {
        register_widget( 'G1_GMap_Widget' );
    }

	protected function is_g1_gmaps_plugin_active () {
		return is_plugin_active('g1-gmaps/g1-gmaps.php');
	}

    public function register_single_element ( $manager ) {
		if ( $this->is_g1_gmaps_plugin_active() ) {
			return;
		}

        $manager->add_element( 'gmap', array(
            'label' => __( 'GMap', 'g1_theme' ),
            'choices' => array(
                'none'		=> __( 'hide', 'g1_theme' ),
                'standard'	=> __( 'show', 'g1_theme' ),
            ),
            'help' =>
            '<p>' . __( 'Here you can decide whether a map should be displayed in the precontent theme area (right after the header and just before the content).', 'g1_theme' ) . '<p>',
            'priority' => 210,
        ));
    }

    public function add_theme_options ( $sections ) {
        $sections['map'] = array(
            'priority'   => 950,
            'icon'       => 'map-marker',
            'icon_class' => 'icon-large',
            'title'      => __( 'Map', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                array(
                    'id'        => 'map_api_key',
                    'priority'  => 1590,
                    'type'      => 'text',
                    'title'     => __( 'API Key', Redux_TEXT_DOMAIN ),
                    'desc'      => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">'. __( 'How to get API key?', Redux_TEXT_DOMAIN ) .'</a>',
                    'sub_desc'     => __( 'Required', Redux_TEXT_DOMAIN ),
                    'std'       => ''
                ),
                array(
                    'id'        => 'map_color',
                    'priority'  => 1600,
                    'type'      => 'color',
                    'title'     => __( 'Base Color', Redux_TEXT_DOMAIN ),
                    'std'       => '#808080'
                ),
                array(
                    'id'        => 'map_invert_lightness',
                    'priority'  => 1610,
                    'type'      => 'checkbox',
                    'title'     => __( 'Invert Lightness', Redux_TEXT_DOMAIN ),
                    'std'       => 0
                ),
                array(
                    'id'        => 'map_type',
                    'priority'  => 1615,
                    'type'      => 'select',
                    'title'     => __( 'Type', Redux_TEXT_DOMAIN ),
                    'options'   => $this->getMapTypes(),
                    'std'       => 'roadmap'
                ),
                array(
                    'id'        => 'map_latitude',
                    'priority'  => 1620,
                    'type'      => 'text',
                    'title'     => __( 'Latitude', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'Eg. 40.714353 for New York, USA', Redux_TEXT_DOMAIN ) . '<br />' . __( 'Remember to add "-" sign for S (south) latitude', Redux_TEXT_DOMAIN ),
                    'sub_desc'     => __( 'To center the map on a specific point', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => '40.714353'
                ),
                array(
                    'id'        => 'map_longitude',
                    'priority'  => 1630,
                    'type'      => 'text',
                    'title'     => __( 'Longitude', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'Eg. -74.005973 for New York, USA', Redux_TEXT_DOMAIN ) . '<br />' . __( 'Remember to add "-" sign for W (west) longitude', Redux_TEXT_DOMAIN ),
                    'sub_desc'     => __( 'To center the map on a specific point', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => '-74.005973'
                ),
                array(
                    'id'        => 'map_zoom',
                    'priority'  => 1640,
                    'type'      => 'g1_range',
                    'min'       =>  0,
                    'max'       =>  25,
                    'step'       =>  1,
                    'title'     => __( 'Zoom', Redux_TEXT_DOMAIN ),
                    'sub_desc'     => __( 'The initial resolution at which to display the map', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => 15
                ),
                array(
                    'id'        => 'map_marker',
                    'priority'  => 1650,
                    'type'      => 'select',
                    'title'     => __( 'Marker On The Map', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'none'          => 'none',
                        'standard'      => 'standard',
                        'open-bubble'   => 'with open bubble',
                    ),
                    'switch'    => true,
                    'std'       => 'standard',
                ),
                array(
                    'id'        => 'map_marker_icon',
                    'priority'  => 1655,
                    'type'      => 'upload',
                    'title'     => __( 'Marker Icon', Redux_TEXT_DOMAIN ),
                    'desc'      => __( 'optional, if empty default marker will be used', Redux_TEXT_DOMAIN )
                ),
                array(
                    'id'        => 'map_marker_content',
                    'priority'  => 1660,
                    'type'      => 'textarea',
                    'title'     => __( 'Text In The Marker Bubble', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'HTML allowed', Redux_TEXT_DOMAIN )
                )
            )
        );

		$migrated_map_id = false;

		if ( is_admin() ) {
			$migrated_map_id = G1_Theme_Admin()->get_g1_gmaps_migrated_map_id();
		}

		if ( $migrated_map_id !== false ) {
			$info = array(
				'id' => 'map_migration_info',
				'priority' => 1599,
				'type' => 'info',
				'desc'     =>
					'<p id="g1-gmaps-plugin-activated">' .
					__( 'Since theme version 3.3 the map was replaced by external plugin.', 'g1_theme' ) . '<br />' .
					__( 'Your old map was migrated and now you can modify it in the WP Admin > G1 GMaps > Old map.', 'g1_theme' ).
					'</p>'.
					'<p>' .
					__( 'If something is not working as it should, please deactivate the G1 Gmaps plugin and let use know on support forum.', 'g1_theme' ) .
					'</p>',
			);

			array_unshift($sections['map']['fields'], $info);
		}

        return $sections;
    }
}
function G1_GMap_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_GMap_Module();

    return $instance;
}
// Fire in the hole :)
G1_GMap_Module();


class G1_GMap_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
            'label' => __( 'content', 'g1_theme' ),
            'hint'	=> __( 'Text to show in marker bubble', 'g1_theme' ),

        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        $this->add_attribute( 'width', array(
            'form_control'  => 'Text',
            'hint'		    => __( 'Map width eg. 800px (leave it empty to use 100% width)', 'g1_theme' ),
            'default'       => '100%'
        ));

        $this->add_attribute( 'height', array(
            'form_control'  => 'Text',
            'hint'		    => __( 'Map height eg. 500px', 'g1_theme' ),
        ));

        $this->add_attribute( 'type', array(
            'form_control'  => 'Choice',
            'hint'		    => __( 'Map interface. Simple has no controls', 'g1_theme' ),
            'choices'   => array(
                'simple'    => __( 'simple', 'g1_theme' ),
                'rich'      => __( 'rich', 'g1_theme' ),
            ),
            'default' => 'rich'
        ));

        $this->add_attribute( 'color', array(
            'form_control'  => 'Color',
        ));

        $this->add_attribute( 'invert_lightness', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'invertlightness',
                'invert-lightness',
                'invert',
            ),
            'choices'   => array(
                '0'      => __( 'none', 'g1_theme' ),
                '1'  => __( 'standard', 'g1_theme' ),
            )
        ));

        $this->add_attribute( 'map_type', array(
            'form_control'  => 'Choice',
            'choices' => G1_GMap_Module()->getMapTypes()
        ));

        $this->add_attribute( 'latitude', array(
            'form_control'  => 'Text',
            'id_aliases' => array(
                'lat',
            ),
            'hint'          =>  __( 'To center the map on a specific point (eg. 40.714353 for New York, USA)', 'g1_theme' ),
        ));

        $this->add_attribute( 'longitude', array(
            'form_control'  => 'Text',
            'id_aliases' => array(
                'lng',
            ),
            'hint'          =>  __( 'To center the map on a specific point (eg. -74.005973 for New York, USA)', 'g1_theme' ),
        ));

        $this->add_attribute( 'zoom', array(
            'form_control'  => 'Text',
            'id_aliases' => array(
                'z',
            ),
            'hint'		    => __( 'The initial resolution at which to display the map (default: 15)', 'g1_theme' ),
        ));

        $this->add_attribute( 'marker', array(
            'form_control'  => 'Choice',
            'choices' => array(
                'none'      => __( 'none', 'g1_theme' ),
                'standard'  => __( 'standard', 'g1_theme' ),
                'open-bubble' => __( 'with open bubble', 'g1_theme' )
            ),
            'hint'		    => __( 'Decide if you want to show marker on the map', 'g1_theme' ),
        ));

        $this->add_attribute( 'marker_icon', array(
            'form_control'  => 'Text',
            'id_aliases' => array(
                'markericon',
                'marker-icon',
                'icon',
            ),
            'hint'		    => __( 'optional, if empty default marker will be used', 'g1_theme' ),
        ));
    }

    /**
     * Enqueues javascripts
     */
    public function enqueue_scripts() {
        $api_key = g1_get_theme_option('map', 'api_key', '');

        wp_enqueue_script('google_maps', 'https://maps.googleapis.com/maps/api/js?sensor=false&key=' . $api_key, array(), '3.0', true);
        wp_enqueue_script('google_maps_utility_library_infobox', get_template_directory_uri().'/lib/g1-gmap/js/infobox_packed.js', array('google_maps'), true);
        wp_enqueue_script('g1_gmap', get_template_directory_uri().'/lib/g1-gmap/js/g1-gmap.js', array('g1_main', 'google_maps', 'google_maps_utility_library_infobox'), true);
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-gmap-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-gmap'
        );

        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        if (!$width) {
            $width = '100%';
        }

        if (!$height) {
            return '';
        }

        $inline_style = ' style="width: '.esc_attr($width).'; height: '.esc_attr($height).';"';

        $config = array(
            'map_type'  => !empty($map_type) ? $map_type : 'roadmap',
            'invert_lightness' => $invert_lightness,
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'zoom'      => !empty($zoom) ? $zoom : 15,
            'marker'    => !empty($marker) ? $marker : 'none',
            'marker_icon' => !empty($marker_icon) ? $marker_icon : '',
            'type' => $type
        );

        if (!empty($color)) {
            $colorObj = new G1_Color($color);

            $colorConfig = array(
                'color'               => $color,
                'color_hue'           => '#'.$colorObj->get_hex(),
                'color_saturation'    => ($colorObj->get_saturation() - 50) * 2,
                'color_lightness'     => ($colorObj->get_lightness() - 50) * 2,
            );

            $config = array_merge($config, $colorConfig);
        }

        $data_attr = ' data-g1-gmap-config="'.g1_data_capture($config).'"';

        // Compose output
        $out = '<div class="g1-gmap-wrapper">'."\n";
        $out .= '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '"'.$data_attr.$inline_style.'>'."\n";
        $out .= '<div class="g1-gmap-content" style="display: none;">';
        $out .= $content;
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>'."\n";

        return $out;

    }
}
function G1_GMap_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_GMap_Shortcode( 'gmap' );

    return $instance;
}
// Fire in the hole :)
G1_GMap_Shortcode();


class G1_GMap_Widget extends G1_Shortcode_Widget {
    public function get_id_base() { return 'gmap_widget'; }
    public function get_name() { return __( 'G1 GMap', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_GMap_Shortcode();
    }
}