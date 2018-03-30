<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * YIT Testimonial
 *
 * Manage Testimonials in the YIT Framework
 *
 * @class YIT_Testimonial
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 */


class YIT_Testimonial {

	/**
	 * @var string
	 */
	public $version = YIT_TESTIMONIALS_VERSION;

	/**
	 * @var string
	 */
	public $plugin_url;

	/**
	 * @var string
	 */
	public $plugin_path;

	/**
	 * @var string
	 */
	public $plugin_assets_url;


	/**
	 * @var object The single instance of the class
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * @var object The instance of the panel
	 * @since 1.0
	 */
	protected $_panel = null;


	/**
	 * @var string $testimonial_post_type The post type name for the post type of all testimonial
	 */
	public $testimonial_post_type = 'testimonial';

	/**
	 * @var string $category_testimonial_taxonomy the category of portfolio
	 */
	public $category_testimonial_taxonomy = 'category-testimonial';


	/**
	 * @var string $testimonial_post_type The post type name for the post type of all testimonial
	 */
	public $plugin_options = 'yit_testimonial_options';


	/**
	 * Main plugin Instance
	 *
	 * @static
	 * @return object Main instance
	 *
	 * @since  1.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function __construct() {

		$this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/testimonial' );
		$this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/testimonial' );
		$this->plugin_assets_url = $this->plugin_url . '/assets';

		// fix the base url and base path in case is the plugin
		add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

		// load the core plugins library from an yit-theme
		add_action( 'after_setup_theme', array( $this, 'register_plugin_panel' ) );

		// register taxonomy and post type
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );

		$this->set_image_size();

		//register metabox to testimonial
		add_action( 'init', array( $this, 'add_metabox' ), 1 );


		// enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// change the columns of the tables in administrator
		add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
		add_filter( 'manage_edit-testimonial_columns', array( &$this, 'edit_columns' ) );

		// add the shortcode 'testimonials'
		$this->register_shortcodes();


		// add the widget 'testimonial'
		add_action( 'widgets_init', array( &$this, 'register_widget' ) );


	}

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
        if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
            return;
        }

		$this->plugin_url        = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->plugin_assets_url = $this->plugin_url . '/assets';
	}


	/**
	 * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
	 *
	 * @return void
	 * @since  1.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */

	public function register_plugin_panel() {
		$this->register_panel();
	}

	/**
	 * Set the image sizes
	 *
	 * set new sizes for thumbnail
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function set_image_size() {
		add_image_size( 'thumb-testimonial', 160, 160, true );
		add_image_size( 'thumb-testimonial-quote', 160, 160, true );
	}

	/**
	 * Register post type
	 *
	 * Register the post type for the creation of testimonials
	 *
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function register_post_type() {

		$labels = array(
			'name'               => __( 'Testimonials', 'yit' ),
			'singular_name'      => __( 'Testimonial', 'yit' ),
			'plural_name'        => __( 'Testimonials', 'yit' ),
			'item_name_sing'     => __( 'Testimonial', 'yit' ),
			'item_name_plur'     => __( 'Testimonials', 'yit' ),
			'add_new'            => __( 'Add New Testimonial', 'yit' ),
			'add_new_item'       => __( 'Add New Testimonial', 'yit' ),
			'edit'               => __( 'Edit', 'yit' ),
			'edit_item'          => __( 'Edit Testimonials', 'yit' ),
			'new_item'           => __( 'New Testimonial', 'yit' ),
			'view'               => __( 'View Testimonial', 'yit' ),
			'view_item'          => __( 'View Testimonial', 'yit' ),
			'search_items'       => __( 'Search Testimonials', 'yit' ),
			'not_found'          => __( 'No testimonials', 'yit' ),
			'not_found_in_trash' => __( 'No testimonials in the Trash', 'yit' ),
		);

		$args = array(
			'labels'             => apply_filters( 'yit_testimoial_labels', $labels ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => null,
			'has_archive'        => 'testimonial',
			'rewrite'            => array( 'slug' => apply_filters( 'yit_testimonials_rewrite', 'testimonial' ) ),
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'description'        => 'Testimonials',
			'menu_icon'          => 'dashicons-format-status'
		);

		register_post_type( $this->testimonial_post_type, apply_filters( 'yit_testimonial_args', $args ) );
	}


	/**
	 * Register taxonomy for Testimonials categories
	 *
	 * Register the taxonomy for the creation of testimonial's category
	 *
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function register_taxonomy() {

		$labels = array(
			'name'          => __( 'Categories', 'yit' ),
			'singular_name' => __( 'Category', 'yit' ),
			'menu_name'     => __( 'Category', 'yit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => apply_filters( 'yit_taxonomy_testimonial_labels', $labels ),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true
		);

		register_taxonomy( $this->category_testimonial_taxonomy, $this->testimonial_post_type, apply_filters( 'yit_testimonial_taxonomy_args', $args ) );

	}

	/**
	 * Add metabox to testimonial custom post
	 *
	 * Add metabox to the custom post
	 *
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function add_metabox() {

		$args = array(
			'label'    => __( 'Other Testimonial Info', 'yit' ),
			'pages'    => $this->testimonial_post_type, //or array( 'post-type1', 'post-type2')
			'context'  => 'normal', //('normal', 'advanced', or 'side')
			'priority' => 'default',
			'tabs'     => array(
				'settings' => array(
					'label'  => __( 'Settings', 'yit' ),
					'fields' => apply_filters( 'yit_testimonial_metabox', array(
							'yit_testimonial_social'      => array(
								'label' => __( 'Label', 'yit' ),
								'desc'  => __( 'Insert the label used for testimonial if Website Url is set.', 'yit' ),
								'type'  => 'text',
								'std'   => '' ),

							'yit_testimonial_website'     => array(
								'label' => __( 'Web Site Url', 'yit' ),
								'desc'  => __( 'Insert the url referred to Testimonial', 'yit' ),
								'type'  => 'text',
								'std'   => '' ),

							'yit_testimonial_small_quote' => array(
								'label' => __( 'Small Quote', 'yit' ),
								'desc'  => __( 'Insert the text to show with blockquote', 'yit' ),
								'type'  => 'text',
								'std'   => '' ),
						)
					)
				)
			)

		);

		$metabox = YIT_Metabox( 'yit-testimonial-info' );
		$metabox->init( $args );
	}


	/**
	 * Add custom columns to testimonial custom post
	 *
	 * Add custom columns to testimonial list in administrator
	 *
	 * @param $column
	 *
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function custom_columns( $column ) {
		global $post;

		switch ( $column ) {
			case "image-test":
				if ( has_post_thumbnail() ) {
					echo get_the_post_thumbnail( null, 'thumb-testimonial' );
				}
				break;
			case 'story':
				the_excerpt();
				break;
			case 'website':
				$label   = get_post_meta( get_the_ID(), '_yit_testimonial_social', true );
				$siteurl = get_post_meta( get_the_ID(), '_yit_testimonial_website', true );
				if ( $siteurl != '' ):
					if ( $label != '' ):
						echo '<a href="' . esc_url( $siteurl ) . '">' . $label . '</a>';
					else:
						echo '<a href="' . esc_url( $siteurl ) . '">' . $siteurl . '</a>';
					endif;
				endif;
				break;
		}

	}

	/**
	 * Edit the columns
	 *
	 * Edit the columns in the table of testimonial post types
	 *
	 * @param $columns
	 *
	 *
	 * @return void
	 * @since    1.0
	 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function edit_columns( $columns ) {
		$columns['image-test'] = __( 'Image', 'yit' );
		$columns['story']      = __( 'Story', 'yit' );
		$columns['website']    = __( 'Web Site', 'yit' );
		return $columns;
	}


	/**
	 * Enqueue script and styles in frontend side
	 *
	 * Add style and scripts to frontend
	 *
	 * @return void
	 * @since    1.0
	 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function enqueue_scripts() {
		yit_enqueue_style( 'yit-testimonial', $this->plugin_assets_url . '/css/yit-testimonial.css', $this->version );
		yit_enqueue_script( 'yit-testimonial', $this->plugin_assets_url . '/js/yit-testimonial-frontend.js', $this->version );
	}

	/**
	 * Return an array with all testimonial categories
	 *
	 * All testimonial categories in an array, the first element of array is a general item
	 * that is useful to show all categories
	 *
	 * @return array
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function get_testimonial_categories() {

		global $wpdb;

		$terms           = $wpdb->get_results( 'SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "' . $this->category_testimonial_taxonomy . '" ORDER BY name ASC;' );
		$categories      = array();
		$categories['0'] = __( 'All categories', 'yit' );
		if ( $terms ) :
			foreach ( $terms as $cat ) :
				$categories[$cat->term_id] = ( $cat->name ) ? $cat->name : 'ID: ' . $cat->term_id;
			endforeach;
		endif;

		return $categories;
	}

	/**
	 * Return an array with all testimonial categories
	 *
	 * All testimonial categories in an array, the first element of array is a general item
	 * that is useful to show all categories
	 *
	 * @internal param $atts
	 * @internal param string $content
	 * @internal param $shortcode
	 *
	 * @return array
	 * @since    1.0
	 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function register_shortcodes() {

		$shortcodes = $this->shortcodes_hook();

		if ( defined( 'YIT_SHORTCODE' ) ) {
			add_filter( 'yit-shortcode-plugin-init', array( &$this, 'add_shortcode_to_panel' ) );
		}

		foreach ( $shortcodes as $name => $shortcode ) {
			add_shortcode( $name, array( $this, 'add_shortcode' ) );
			if ( defined( 'YIT_SHORTCODE' ) ) {
				add_filter( 'yit_shortcode_' . $name . '_icon', array( &$this, 'shortcode_icon' ), 10, 2 );
			}
		}
	}


	/**
	 * Return an array with all testimonial categories
	 *
	 * All testimonial categories in an array, the first element of array is a general item
	 * that is useful to show all categories
	 *
	 * @param        $atts
	 * @param string $content
	 * @param        $shortcode
	 *
	 * @return array
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 * @author Francesco Licandro <francesco.licandro@yithemes.it>
	 */
	public function add_shortcode( $atts, $content = "", $shortcode ) {


		$all_atts            = $atts;
		$all_atts['content'] = $content;



		if( defined('YIT_SHORTCODE') ){
			$shortcodes = YIT_Shortcodes()->shortcodes;

		}
		else{
			$shortcodes = $this->shortcodes_hook();
		}



		if ( isset( $shortcodes[$shortcode]['unlimited'] ) && $shortcodes[$shortcode]['unlimited'] ) {
			$atts['content'] = $content;
		}
		else {
			//retrieves default atts
			$default_atts = array();

			if( !empty( $shortcodes[ $shortcode ]['attributes'] ) ) {
				foreach( $shortcodes[ $shortcode ]['attributes'] as $name=>$type ) {
					$default_atts[ $name ] = isset( $type['std'] ) ? $type['std'] : '';
					if( isset( $atts[$name] ) && $type['type'] == "checkbox"  ){

						if ( $atts[$name] == 1 || $atts[$name] == 'yes' ){
							$atts[$name] = 'yes';
						}else{
							$atts[$name] = 'no';
						}

					}
				}
			}

//
//            if ( ! empty( $shortcodes[$shortcode]['attributes'] ) ) {
//                foreach ( $shortcodes[$shortcode]['attributes'] as $name => $type ) {
//                    $default_atts[$name] = isset( $type['std'] ) ? $type['std'] : '';
//                }
//            }

			//combines with user attributes
			$atts  =  shortcode_atts( $default_atts, $atts );

		}

		// remove validate attrs
		foreach ( $atts as $att => $v ) {
			unset( $all_atts[$att] );
		}


		$atts['content'] = $content;

		ob_start();
		yit_plugin_get_template( $this->plugin_path, 'shortcodes/' . $shortcode . '.php', $atts );
		$shortcode_html = ob_get_clean();

		return apply_filters( 'yit_shortcode_' . $shortcode, $shortcode_html );

	}

	/**
	 * Return an array with testimonial options to shortcode panel
	 *
	 * All definition settings to add testimonial shortcode to Yit Shortcode Panel
	 *
	 * @return array
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function shortcodes_hook() {

		return apply_filters( 'yit_testimonial_section_shortcode', array(
			'testimonial'        => array(
				'title'       => __( 'Testimonials', 'yit' ),
				'description' => __( 'Show all post on testimonials post types', 'yit' ),
				'tab'         => 'cpt',
				'has_content' => false,
				'in_visual_composer' => true,
				'create'      => false,
				'attributes'  => array(
					'items' => array(
						'title'       => __( 'N. of items', 'yit' ),
						'description' => __( 'Show all with -1', 'yit' ),
						'type'        => 'number',
						'std'         => '-1'
					),
					'cat'   => array(
						'title'       => __( 'Categories', 'yit' ),
						'description' => __( 'Select the categories of posts to show', 'yit' ),
						'type'        => 'select',
						'options'     => is_admin() ? $this->get_testimonial_categories() : array(),
						'std'         => ''
					)
				)
			),
			'testimonial_slider' => array(
				'title'       => __( 'Testimonials slider', 'yit' ),
				'description' => __( 'Show a slider with testimonials', 'yit' ),
				'tab'         => 'cpt',
				'has_content' => false,
				'in_visual_composer' => true,
				'create'      => false,
				'attributes'  => array(
					'items'           => array(
						'title'       => __( 'N. of items', 'yit' ),
						'description' => __( 'Show all with -1', 'yit' ),
						'type'        => 'number',
						'std'         => '-1'
					),
					'excerpt'         => array(
						'title' => __( 'Limit words', 'yit' ),
						'type'  => 'number',
						'std'   => '32'
					),
					'speed'           => array(
						'title' => __( 'Speed (ms)', 'yit' ),
						'type'  => 'number',
						'std'   => '300'
					),
					'paginationspeed' => array(
						'title' => __( 'Pagination Speed (ms)', 'yit' ),
						'type'  => 'number',
						'std'   => '400'
					),
					'navigation'      => array(
						'title' => __( 'Navigation', 'yit' ),
						'type'  => 'checkbox',
						'std'   => 'yes'
					),
					'pagination'      => array(
						'title' => __( 'Pagination', 'yit' ),
						'type'  => 'checkbox',
						'std'   => 'no'
					),
					'autoplay'        => array(
						'title' => __( 'Autoplay', 'yit' ),
						'type'  => 'checkbox',
						'std'   => 'no'
					),
					'cat'             => array(
						'title'       => __( 'Categories', 'yit' ),
						'description' => __( 'Select the categories of posts to show', 'yit' ),
						'type'        => 'select',
						'options'     => is_admin() ? $this->get_testimonial_categories() : array(),
						'std'         => ''
					),
				)
			),
		));
	}

	/**
	 * Return an array with testimonial options to shortcode panel filter
	 *
	 * Merge all definition settings to add testimonial shortcode with
	 * the list of definition settings of Yit Shortcode Panel
	 *
	 * @param $shortcodes
	 *
	 * @return array
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function add_shortcode_to_panel( $shortcodes ) {
		return array_merge( $shortcodes, $this->shortcodes_hook() );
	}

	/**
	 * Return the url of the image for YIT_Shortcodes Plugin
	 *
	 * Add an image to shortcode panel for add testimonial shortcodes
	 *
	 *
	 * @param $icon_url
	 * @param $shortcode
	 *
	 * @return string
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function shortcode_icon( $icon_url, $shortcode ) {
		return $this->plugin_assets_url . '/images/' . $shortcode . '.png';
	}

	/**
	 * Add a panel under Testimonial Custom Post Type
	 *
	 * add a setting page for Testimonial Plugin
	 *
	 *
	 * @return void
	 * @since    1.0
	 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function register_panel() {

		if ( ! empty( $this->_panel ) ) {
			return;
		}

		$admin_tabs = array(
			'general' => __( 'General', 'yit' ),
		);

		$args = array(
			'parent'       => $this->testimonial_post_type,
			'parent_page'  => 'post_type=' . $this->testimonial_post_type,
			'page'         => 'testimonial-settings-page',
			'admin-tabs'   => $admin_tabs,
			'options-path' => $this->plugin_path . '/plugin-options'
		);

		$this->_panel = new YIT_Plugin_Panel( $args );

	}



	/**
	 * Get option from Plugin Panel
	 *
	 * return the option from database
	 *
	 * @param $option
	 *
	 * @return mixed
	 * @since    1.0
	 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function get_option( $option ) {

		$options = get_option( $this->plugin_options );

		if ( isset( $options[$option] ) ) {
			return $options[$option];
		}
		else {
			return '';
		}
	}

	/**
	 * Register the widget Testimonial
	 *
	 * add a slider testimonial widget
	 *
	 * @return void
	 * @since  1.0
	 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
	 */
	public function register_widget() {

        if( ! defined( 'YIT_THEME_PATH' ) || ! file_exists( YIT_THEME_PATH.'/yit/widgets/YIT_Testimonials_Widget.php' ) ) {

            include( $this->plugin_path . '/yit-testimonials.widget.php' );

            register_widget( 'YIT_Testimonials_Widget' );

        }

	}
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Testimonial() {
	return YIT_Testimonial::instance();
}

/**
 * Instantiate Testimonial class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Testimonial();
