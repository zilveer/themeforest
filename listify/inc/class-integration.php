<?php
/**
 * Plugin integrations.
 */

class Listify_Integration {

	public static $integrations = array();

	public function __construct() {
		$dir = trailingslashit( get_template_directory() . '/inc/integrations/' . $this->integration() );
		$url = trailingslashit( get_template_directory_uri() . '/inc/integrations/' . $this->integration() );

		self::$integrations[ $this->integration() ] = array(
			'dir' => $dir,
			'url' => $url
		);

		$this->includes();
		$this->setup_actions();

		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	public function body_class( $classes ) {
		$classes[] = $this->integration;

		return $classes;
	}

	public function integration() {
		return $this->integration;
	}

	private function includes() {
		if ( ! isset( $this->includes ) ) {
			return;
		}

		foreach ( $this->includes as $file ) {
			require_once( trailingslashit( self::get_dir() ) . $file );
		}
	}

	public static function get_integrations() {
		return self::$integrations;
	}

	public function get_dir() {
		return self::$integrations[ $this->integration() ][ 'dir' ];
	}

	public function get_url() {
		return self::$integrations[ $this->integration() ][ 'url' ];
	}

}
