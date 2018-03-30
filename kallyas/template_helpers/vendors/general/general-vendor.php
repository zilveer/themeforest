<?php if(! defined('ABSPATH')){ return; }

class ZnHg_Kallyas_Vendors{

	var $registered_vendors = array();

	function __construct(){

		$this->register_default_vendors();

		// Let others add custom vendors
		do_action( 'znhg_kallyas_vendors', $this );
		add_action('wp', array($this, 'check_post_type'));
	}

	function register_default_vendors(){
		$vendors = array(
			'ecwd_event'
		);

		foreach ($vendors as $key => $value) {
			$this->register_post_type($value);
		}
	}

	/**
	 * Check if we need to render the header and closing divs
	 * @return null
	 */
	function check_post_type(){

		$queried_object = get_queried_object();
		$should_render = false;

		// we should find the proper post type for the current post/archive
		if( is_archive() ){
			// print_z($queried_object);
			if( ! empty( $queried_object->taxonomy ) ){
				$taxonomy = $queried_object->taxonomy;
				$taxonomy_object = get_taxonomy( $taxonomy );
				$post_types = $taxonomy_object->object_type;
				if( is_array( $post_types ) ){
					foreach ($post_types as $key => $value) {
						if( in_array( $value, $this->registered_vendors ) ){
							$should_render = true;
						}
					}
				}
			}
		}
		elseif( is_singular() ){
			if( in_array( $queried_object->post_type, $this->registered_vendors ) ){
				$should_render = true;
			}
		}

		// Finally check if we can render the header and footer
		if( $should_render === true ){
			add_action( 'zn_after_header', array( $this, '_after_header' ) );
			add_action( 'zn_before_footer', array( $this, '_before_footer' ) );
		}

	}

	/**
	 * Register a vendor
	 * @param  string $post_type the post type you want to add
	 * @return null
	 */
	function register_post_type( $post_type, $args = array() ){
		$this->registered_vendors[$post_type] = $post_type;
	}

	/**
	 * Un-Register a vendor
	 * @param  string $post_type the post type you want to add
	 * @return null
	 */
	function unregister_vendor( $post_type ){
		unset( $this->registered_vendors[$post_type] );
	}

	/**
	 * Render the opening divs and section
	 * @return string the HTML markup for opening opened tags
	 */
	function _after_header(){
		$args = array();
		if( ! is_single() ){

			// SHOW THE HEADER
			$post          = get_queried_object();
			$post_type     = get_post_type_object(get_post_type($post));
			$args['title'] = $post_type->labels->name;

			if( is_tax() ) {
				$args['title'] = get_the_archive_title();
				$args['subtitle'] = ''; // Reset the subtitle for categories and tags
			}
		}

		WpkPageHelper::zn_get_subheader( $args );

		global $zn_config;
		$zn_config['force_sidebar'] = 'blog_sidebar';
		$main_class = zn_get_sidebar_class( 'blog_sidebar' );
		if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
		$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-9' : 'col-sm-12';

		// Disable sidebar if it's called from the plugin
		$zn_config['disable_sidebar'] = true;
		?>
		<section id="content" class="site-content">
			<div class="container">
				<div class="row">
					<div class="<?php echo $main_class; ?>">
		<?php
	}

	/**
	 * Render the closing divs and section
	 * @return string the HTML markup for closing opened tags
	 */
	function _before_footer(){
		global $zn_config;
		$zn_config['disable_sidebar'] = false;
		?>
					</div>
					<!-- sidebar -->
					<?php locate_template( 'sidebar.php', true, false ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}

new ZnHg_Kallyas_Vendors();