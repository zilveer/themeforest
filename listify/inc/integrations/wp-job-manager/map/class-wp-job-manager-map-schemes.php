<?php

class Listify_WP_Job_Manager_Map_Schemes {

    public function __construct() {
        add_filter( 'listify_map_settings', array( $this, 'apply_color_scheme' ) );
        add_filter( 'listify_single_map_settings', array( $this, 'apply_color_scheme' ) );

		add_action( 'wp_ajax_listify-customizer-map-scheme', array( $this, 'ajax_apply_color_scheme' ) );
    }

    public function get_color_scheme() {
        return listify_theme_mod( 'map-appearance-scheme', 'blue-water' );
    }

    public function default_styles() {
        $default = apply_filters( 'listify_map_default_styles', array(
            array(
                'featureType' => "poi",
                'stylers' => array(
                    array(
                        'visibility' => "off"
                    )
                )
            )
        ) );

        return $default;
    }

	/**
	 * Return the JSON of the color scheme for AJAX.
	 *
	 * @since 1.7.0
	 * @return array
	 */
	public function ajax_apply_color_scheme() {
		$scheme = isset( $_POST[ 'scheme' ] ) ? esc_attr( $_POST[ 'scheme' ] ) : false;

		if ( ! $scheme ) {
			return wp_send_json_error();
		}

		add_filter( 'theme_mod_map-appearance-scheme', array( $this, 'ajax_preview_color_scheme' ) );

		$settings = $this->apply_color_scheme( array() );

		return wp_send_json_success( $settings[ 'mapOptions' ] );
	}

	/**
	 * Preview value for map color scheme.
	 *
	 * @since 1.7.0
	 * @return array
	 */
	public function ajax_preview_color_scheme( $value ) {
		$scheme = isset( $_POST[ 'scheme' ] ) ? esc_attr( $_POST[ 'scheme' ] ) : false;

		if ( $scheme ) {
			$value = $scheme;
		}

		return $value;
	}

    public function apply_color_scheme( $settings ) {
        $scheme = $this->get_color_scheme();
        $scheme = sanitize_title( $scheme ) . '.json';

        $styles = array();
        $file   = false;

        $custom = trailingslashit( get_stylesheet_directory() ) . $scheme;
        $included = trailingslashit( dirname( __FILE__ ) ) . trailingslashit( 'schemes' ) . $scheme;

        if ( file_exists( $custom ) ) {
            $file = $this->get_contents( $custom );
        } elseif ( file_exists( $included ) ) {
            $file = $this->get_contents( $included );
        }

        if ( $file ) {
            $styles = json_decode( $file, true );
        }

        $settings[ 'mapOptions' ][ 'styles' ] = array_merge( $this->default_styles(), $styles );

        return $settings;
    }

	/**
	 * Get the contents of the .json file using the WP_Filesystem
	 *
	 * @see WP_Filesystem
	 * @since 1.5.0
	 * @return mixed False if the file does not exist, or the file contents.
	 */
	public function get_contents( $file ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );

		if ( 'direct' != get_filesystem_method() ) {
			return false;
		}

		$creds = request_filesystem_credentials( admin_url() );

		if ( ! WP_Filesystem( $creds ) ) {
			return false;
		}

		global $wp_filesystem;

		return $wp_filesystem->get_contents( $file );
	}

    public function get_color_schemes() {

    }

}
