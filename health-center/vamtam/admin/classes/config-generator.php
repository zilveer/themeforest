<?php
/**
 * A meta programming helper used to generated the html code needed for a configuration page
 *
 * @package wpv
 */

/**
 * class WpvConfigGenerator
 */
class WpvConfigGenerator {

	/**
	 * Options page name
	 * @var string
	 */
	public $name;

	/**
	 * Options page config
	 * @var array
	 */
	protected $options;

	/**
	 * Initialize the generator
	 *
	 * @param string $name
	 * @param array $options definitions for the config page
	 */
	public function __construct( $name, $options ) {

		$this->name    = $name;
		$this->options = $options;

		if ( isset( $_POST['save-wpv-config'] ) )
			$this->save_config();

		$this->render();

		add_action( 'admin_footer', array( __CLASS__, 'print_templates' ) );
	}

	/**
	 * Save the current page config
	 */
	private function save_config() {
		wpv_save_config( $this->options );

		global $wpv_config_messages;

		$wpv_config_messages .= '<div class="message updated fade"><p><strong>Updated Successfully</strong></p></div>';
	}

	/**
	 * Single options row template
	 * @param  string $template template name
	 * @param  array  $value    options row config
	 */
	protected function tpl( $template, $value ) {
		extract( $value );
		if ( ! isset( $desc ) )
			$desc = '';

		if ( ! isset( $default ) )
			$default = null;

		if ( ! isset( $class ) )
			$class = '';

		include WPV_ADMIN_HELPERS . "config_generator/$template.php";
	}

	/**
	 * Renders the option page
	 */
	private function render() {
		echo '<div class="wrap wpv-config-page">';
		echo '<form method="post" action="">';
		if ( isset( $_GET['allowreset'] ) ) {
			echo '<input type="hidden" name="doreset" value="true" />';
		}

		if ( isset( $_GET['cacheonly'] ) ) {
			echo '<input type="hidden" name="cacheonly" value="true" />';
		}

		foreach ( $this->options as $option ) {
			if ( method_exists( $this, $option['type'] ) )
				$this->$option['type']( $option );
			else
				$this->tpl( $option['type'], $option );
		}

		echo '</div>'; // #theme-config

		if ( ! isset( $this->options[0]['no-save-button'] ) ) {
			$this->tpl( 'save', array() );
		}

		echo '</form>';
		echo '</div>';
	}

	/**
	 * Prints the templates for the Backbone.js-powered parts of our admin
	 */
	public static function print_templates() {
		$templates = apply_filters(
			'wpv-admin-backbone-template-files',
			array(
				WPV_ADMIN_TEMPLATES . 'social-links.php'
			)
		);

		foreach ( $templates as $file ) {
			readfile( $file, true );
		}
	}

	/**
	 * Auto fill <select> options
	 * @param  string $type autofill type
	 * @return array        options list
	 */
	public static function get_select_target_config( $type ) {
		return self::target_config( $type );
	}

	/**
	 * Auto fill <select> options
	 * @param  string $type autofill type
	 * @return array        options list
	 */
	public static function target_config( $type ) {
		$config = array();
		switch ( $type ){
			case 'page':
				$entries = get_pages( 'title_li=&orderby=name' );
				foreach ( $entries as $key => $entry )
					$config[$entry->ID] = $entry->post_title;
			break;
			case 'cat':
				$entries = get_categories( 'orderby=name&hide_empty=0' );
				foreach ( $entries as $key => $entry )
					$config[$entry->term_id] = $entry->name;
			break;
			case 'post':
				$entries = get_posts( 'orderby=title&numberposts=-1&order=ASC' );
				foreach ( $entries as $key => $entry )
					$config[$entry->ID] = $entry->post_title;
			break;
			case 'portfolio':
				$entries = get_posts( 'post_type=portfolio&orderby=title&numberposts=-1&order=ASC' );
				foreach ( $entries as $key => $entry )
					$config[$entry->ID] = $entry->post_title;
			break;
			case 'portfolio_category':
				$entries = get_terms( 'portfolio_category', 'orderby=name&hide_empty=0' );
				foreach ( $entries as $key => $entry )
					$config[$entry->slug] = $entry->name;
			break;
			case 'testimonials':
				$entries = get_posts( 'post_type=testimonials&orderby=title&numberposts=-1&order=ASC' );
				foreach ( $entries as $key => $entry )
					$config[$entry->ID] = $entry->post_title;
			break;
			case 'testimonials_category':
				$entries = get_terms( 'testimonials_category', 'orderby=name&hide_empty=0' );
				foreach ( $entries as $key => $entry )
					$config[$entry->slug] = $entry->name;
			break;
			case 'tribe_events_category':
				$entries = get_terms('tribe_events_cat', 'orderby=name&hide_empty=0');
				foreach($entries as $key => $entry)
					$config[$entry->slug] = $entry->name;
			break;
			case 'sidebars':
				$sidebars = wpv_get_option( 'custom-sidebars' );
				$sidebars = explode( ',', $sidebars );

				foreach ( $sidebars as $sidebar ) {
					$config[$sidebar] = str_replace( 'wpv_sidebar-', '', $sidebar );
				}
			break;
		}

		return $config;
	}
}

