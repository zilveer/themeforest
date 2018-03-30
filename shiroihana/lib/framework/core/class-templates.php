<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

final class Youxi_Templates {

	private $base_dir = '';

	private $datastack = array();

	public function __construct() {

		$this->base_dir = apply_filters( 'youxi_templates_base_dir', 'templates/' );
	}

	public function get( $slug, $name = null, $post_type = null, $subfolder = null, $userdata = array() ) {

		/*
			Push userdata to the internal stack array.
			Variables can be used inside the requsted template using Youxi()->templates->get_var();
		*/
		if( ! is_array( $userdata ) ) {
			$userdata = array();
		}
		$this->datastack[] = $userdata;

		/* If a post type template is requested */
		if( isset( $post_type ) ) {

			/* Construct directory path for the post type */
			$dir_name = trailingslashit( $this->base_dir ) . trailingslashit( $post_type );

			/* If the template is located in a subfolder */
			if( isset( $subfolder ) ) {

				$templates = array();
				$name = (string) $name;

				if( '' !== $name ) {
					$templates[] = $dir_name . trailingslashit( $subfolder ) . "{$slug}-{$name}.php";
				}
				$templates[] = $dir_name . trailingslashit( $subfolder ) . "{$slug}.php";

				if( '' !== $name ) {
					$templates[] = $dir_name . "{$slug}-{$name}.php";
				}
				$templates[] = $dir_name . "{$slug}.php";

				/* Get template located in a subfolder for the requested post type */
				locate_template( $templates, true, false );

			} else {

				/* Get template for the requested post type */
				get_template_part( $dir_name . $slug, $name );
			}

		} else {

			/* Get template from the base directory */
			get_template_part( trailingslashit( $this->base_dir ) . $slug, $name );
		}

		/* Pop userdata from the internal stack array */
		array_pop( $this->datastack );
	}

	public function get_var( $key, $default = '' ) {

		$current = end( $this->datastack );

		if( is_array( $current ) && isset( $current[ $key ] ) ) {
			return $current[ $key ];
		}

		return $default;
	}
}
