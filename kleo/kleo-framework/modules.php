<?php
/* MODULES */

class SQ_Modules {

	/**
	 * Modules variable
	 * NEW LOGIC
	 *
	 */
	public $mods;

	/**
	 * Name of the options to save the file version numbers
	 * @var string
	 */
	public $option_name;

	/**
	 * Current file version
	 * @var string
	 */
	public $current_file_version = '';

	/**
	 * Cache some values
	 * @var array
	 */
	public $transient = array(
		'version' => array()
	);

	/**
	 * @param array $mods
	 */
	public function set_mods( $mods ) {
		$this->mods = $mods;
	}

	/**
	 * @return array
	 */
	public function get_mods() {
		return $this->mods; 
	}

	public function add_mod( Modules_Scope $scope, $name, $value = array() ) {

		if ( ! property_exists( $this, $scope->name ) ) {
			$this->mods->{ $scope->name } = $scope;
		}

		if( isset( $name ) ) {
			$this->mods->{$scope->name}->entries[ $name ] = $value;
		}
	}

	
	/**
	 * Save related options names to look for changes on theme options save
	 * @var array
	 */
	public static $options = array();

	/**
	 * Query string that is added to the loaded resources
	 * @var
	 */
	public $query_string;

	/**
	 * @var SQ_Modules The reference to *SQ_Modules* instance of this class
	 */
	protected static $_instance = null;


	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {

		$this->init();
	}

	/**
	 * Returns the SQ_Modules instance of this class.
	 *
	 * @return SQ_Modules - Main instance
	 */
	public static function getInstance()
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function init() {

		$this->mods = new stdClass();
		$this->option_name = 'sq_mod_' . KLEO_DOMAIN;

		//set version
		$this->current_file_version = defined( 'KLEO_THEME_VERSION' ) ? KLEO_THEME_VERSION : '1.0';

		$this->query_string = $this->current_file_version;
	}


	/**
	 * Add the theme option name related to a module
	 * @param $name - option name to store
	 */
	public static function add_option( $name ) {
		self::$options[$name] = $name;
	}

	public function add_scope( Modules_Scope $scope ) {
		$this->mods->{ $scope->name } = $scope;
	}

	public function scope_exists( $scope ) {
		if ( property_exists( $this->mods, $scope ) ) {
			return true;
		}

		return false;
	}

	public function get_scope_data( $scope ) {
		
		if ( $this->scope_exists( $scope ) ) {
			return $this->mods->{$scope};
		}

		return false;
	}

	public function get_current_version( $scope ) {

		if ( isset( $this->transient['version'][$scope] ) ) {
			return $this->transient['version'][$scope];
		}

		$option = get_option( $this->option_name );

		if ( isset( $option[ $scope ] ) ) {
			$version = $option[ $scope ];
		} else {
			$version = false;
		}

		$this->transient['version'][ $scope ] = $version;

		return $version;
	}

	public function set_current_version( $scope ) {

		$option = get_option( $this->option_name );

		//set the option
		if ( ! $option ) {
			$option = array();
		}
		$option[$scope] = $this->current_file_version;
		update_option( $this->option_name, $option );

		//update transient
		$this->transient['version'][ $scope ] = $this->current_file_version;
	}

	public function file_needs_generation( $scope ) {
		
		//prepare main css file
		if( $this->get_current_version( $scope ) == false ) {
			$needs_update = true;
		} else {
			$needs_update = version_compare( $this->get_current_version( $scope ), $this->current_file_version, '<' );
		}
		
		if ( ! $this->file_exists( $scope ) || $needs_update ) {
			return true;
		}
		
		return false;

	}

	public function get_content( $scope, $compress = true ) {

		$scope_obj = $this->get_scope_data( $scope );
		$source_path = $scope_obj->source_path;
		$entries = $scope_obj->entries;
		$content = '';

		if (! empty( $entries ) ) {
			foreach ( $entries as $k => $v ) {
				if ( isset ( $v['path'] ) ) {
					if ( file_exists( $v['path'] ) ) {
						$content .= sq_fs_get_contents( $v['path'] );
					}
				} else {
					if ( file_exists( $source_path . $k . '.css' ) ) {
						$content .= sq_fs_get_contents( $source_path . $k . '.css' );
					}
				}
			}
		}

		$modules_content = apply_filters( $scope . '_content', $content );
		if ( $compress ) {
			$modules_content = kleo_compress( $modules_content );
		}

		return $modules_content;
	}
	

	public function generate_file( $scope, $content = '' ) {
		
		$this->remove_file( $scope );

		$scope_obj = $this->get_scope_data( $scope );
		if ( $content == '' ) {
			$content = $this->get_content( $scope );
		}

		if ( $content != '' ) {

			if( sq_fs_put_contents( $scope_obj->output_path . $scope_obj->filename, $content ) ) {
				
				$this->set_current_version( $scope );

				return true;
			}
		}

		return false;
	}


	public function file_exists_and_check_generation( $scope, $content = '' ) {

		$file_exists = false;

		if ( $this->file_needs_generation( $scope ) ) {

			if( $this->generate_file( $scope, $content ) ) {
				$file_exists = true;
			}
		} else {
			$file_exists = true;
		}
		
		return $file_exists;

	}


	/**
	 * Check if generated file exists for the specified scope
	 * @param $scope
	 *
	 * @return bool
	 */
	public function file_exists( $scope ) {
		$scope_obj = $this->get_scope_data( $scope );
		if ( file_exists( $scope_obj->output_path . $scope_obj->filename ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Remove generated file for the specified scope
	 * @param $scope
	 */
	public function remove_file( $scope ) {
		$scope_obj = $this->get_scope_data( $scope );

		if ( $this->file_exists( $scope ) ) {
			unlink( $scope_obj->output_path . $scope_obj->filename ) ; // Delete it
		}
	}

}

class Modules_Scope {
	
	public $name;
	public $source_path;
	public $output_path;
	public $output_url;
	public $entries = array();

	/**
	 * Modules_Scope constructor.
	 *
	 * @param $name
	 * @param $filename
	 * @param $source_path
	 * @param $output_path
	 * @param $output_url
	 * @param array $entries
	 */
	public function __construct( $name, $filename, $source_path, $output_path, $output_url, $entries = array() ) {
		
		$this->name = $name;
		$this->filename = $filename;
		$this->source_path = $source_path;
		$this->output_path = $output_path;
		$this->output_url = $output_url;
		$this->entries = $entries;
		
	}
	
}

SQ_Modules::getInstance();

