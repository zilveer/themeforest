<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_get_grid_images_height' ) ) {
	/**
	 * The the number of columns set for the current grid layout.
	 *
	 * @return integer
	 */
	function thb_get_grid_images_height() {
		return thb_get_post_meta( thb_get_page_ID(), 'grid_images_height' );
	}
}

if( ! function_exists( 'thb_get_grid_columns' ) ) {
	/**
	 * The the number of columns set for the current grid layout.
	 *
	 * @return integer
	 */
	function thb_get_grid_columns() {
		return thb_get_post_meta( thb_get_page_ID(), 'grid_columns' );
	}
}

if( ! function_exists( 'thb_get_grid_gutter' ) ) {
	/**
	 * The gutter setup for the current grid layout.
	 *
	 * @return integer
	 */
	function thb_get_grid_gutter() {
		return thb_get_post_meta( thb_get_page_ID(), 'grid_gutter' );
	}
}

if( ! function_exists( 'thb_grid_layout_add_fields' ) ) {
	/**
	 * Adds the grid control fields to the container.
	 *
	 * @param THB_FieldsContainer $thb_container
	 * @param array $options
	 * @param boolean|integer $index
	 */
	function thb_grid_layout_add_fields( $thb_container, $options, $index = false ) {
		$grid_gutter = thb_config( 'backpack/layout', 'grid_gutter' );
		$use_index = $index !== false;

		$thb_field = new THB_SelectField( 'grid_columns' );
		$thb_field->setLabel( __( 'Columns', 'thb_text_domain' ) );
		$thb_field->setOptions( $options );
		$thb_container->addField( $thb_field, $index );

		if ( $grid_gutter ) {
			if ( $use_index ) { $index = $index + 1; }

			$thb_field = new THB_SelectField( 'grid_gutter' );
			$thb_field->setLabel( __( 'Grid spacing', 'thb_text_domain' ) );
			$thb_field->setOptions( $grid_gutter );
			$thb_container->addField( $thb_field, $index );
		}

		if ( $use_index ) { $index = $index + 1; }

		$thb_field = new THB_SelectField( 'grid_images_height' );
		$thb_field->setLabel( __( 'Images height', 'thb_text_domain' ) );
		$thb_field->setOptions( array(
			'fixed' => __( 'Fixed', 'thb_text_domain' ),
			'variable' => __( 'Variable', 'thb_text_domain' )
		) );
		$thb_container->addField( $thb_field, $index );
	}
}

if( ! function_exists( 'thb_get_grid_class_name' ) ) {
	/**
	 * Get the grid columns body class name.
	 *
	 * @param integer $columns
	 * @param string $gutter
	 * @param string $images_height
	 * @return string
	 */
	function thb_get_grid_class_name( $columns, $gutter = false, $images_height = false ) {
		$classes = sprintf( 'thb-grid-layout-%scols', $columns );

		if ( $gutter !== false ) {
			$classes .= sprintf( ' thb-grid-gutter-%s', $gutter );
		}

		if ( $images_height !== false ) {
			$classes .= sprintf( ' thb-grid-images-height-%s', $images_height );
		}

		return $classes;
	}
}

if( ! function_exists( 'thb_grid_layout_id' ) ) {
	/**
	 * Output the id attribute for the grid layout container.
	 */
	function thb_grid_layout_id() {
		echo thb_get_grid_layout_id();
	}
}

if( ! function_exists( 'thb_get_grid_layout_id' ) ) {
	/**
	 * Get the id attribute for the grid layout container.
	 *
	 * @return string
	 */
	function thb_get_grid_layout_id() {
		if ( thb_config( 'backpack/layout', 'grid_body_class' ) ) {
			return 'thb-grid-layout';
		}

		return '';
	}
}

if( ! function_exists( 'thb_grid_layout_class' ) ) {
	/**
	 * Output the class attribute for the grid layout container.
	 *
	 * @param integer $columns
	 * @param string $gutter
	 * @param string $height
	 */
	function thb_grid_layout_class( $columns = false, $gutter = false, $height = false ) {
		echo implode( ' ', thb_get_grid_layout_class( $columns, $gutter, $height ) );
	}
}

if( ! function_exists( 'thb_get_grid_layout_class' ) ) {
	/**
	 * Get the class attribute for the grid layout container.
	 *
	 * @param integer $columns
	 * @param string $gutter
	 * @param string $height
	 * @return array
	 */
	function thb_get_grid_layout_class( $columns = false, $gutter = false, $height = false ) {
		if ( thb_config( 'backpack/layout', 'grid_body_class' ) ) {
			return array();
		}

		if ( ! $columns ) {
			$columns = thb_get_grid_columns();
		}

		if ( ! $gutter ) {
			$gutter = thb_get_grid_gutter();
		}

		if ( ! $height ) {
			$height = thb_get_grid_images_height();
		}

		return array(
			'thb-grid-layout',
			thb_get_grid_class_name( $columns, $gutter, $height )
		);
	}
}

if( ! function_exists( 'thb_grid_layout_item_class' ) ) {
	/**
	 * Output the class attribute for the grid layout item.
	 */
	function thb_grid_layout_item_class() {
		echo thb_get_grid_layout_item_class();
	}
}

if( ! function_exists( 'thb_get_grid_layout_item_class' ) ) {
	/**
	 * Get the class attribute for the grid layout item.
	 *
	 * @return string
	 */
	function thb_get_grid_layout_item_class() {
		return 'item';
	}
}

if( ! function_exists( 'thb_get_grid_image_size' ) ) {
	/**
	 * Get the appropriate image size to use according to the chosen grid column
	 * layout and the images desired height.
	 *
	 * @param integer $columns Number of grid columns.
	 * @param string $height Image size mode (eg. fixed|variable).
	 * @return string
	 */
	function thb_get_grid_image_size( $columns = false, $height = false ) {
		if ( ! $columns ) {
			$columns = thb_get_grid_columns();
		}

		if ( ! $height ) {
			$height = thb_get_grid_images_height();
		}

		$columns = apply_filters( 'thb_grid_image_size', $columns );
		$config = thb_config( 'backpack/layout', 'grid_columns' );

		if ( isset($config[$columns]) ) {
			if ( is_array( $config[$columns] ) ) {
				if ( isset($config[$columns][$height]) ) {
					return $config[$columns][$height];
				}
			}
			else {
				return $config[$columns];
			}
		}

		return 'full';
	}
}

if( ! function_exists('thb_get_page_subtitle') ) {
	/**
	 * Get the page subtitle.
	 *
	 * @param int $id The page ID.
	 * @return string
	 */
	function thb_get_page_subtitle( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'subtitle' );
	}
}

if( ! function_exists('thb_page_subtitle') ) {
	/**
	 * Get the page subtitle.
	 *
	 * @param int $id The page ID.
	 */
	function thb_page_subtitle( $id = null ) {
		echo thb_get_page_subtitle( $id );
	}
}

if( ! function_exists('thb_page_header_disabled') ) {
	/**
	 * Check if the page header should be disabled for the current page.
	 *
	 * @param  int $id The page ID.
	 * @return bool
	 */
	function thb_page_header_disabled( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}
		$value = thb_get_post_meta( $id, 'pageheader_disable' );

		$value = apply_filters( 'thb_pageheader_disable', $value );

		return $value == '1';
	}
}

if( ! function_exists( 'thb_get_entry_slides' ) ) {
	/**
	 * Get the entry (post/page etc.) slides.
	 *
	 * @param string $key The slides key.
	 * @param integer $id The id.
	 * @return array
	 */
	function thb_get_entry_slides( $key, $id ) {
		$slides_manager = new THB_SlidesManager( $key );

		if ( $id !== null ) {
			$slides_manager->setPageID( $id );
		}

		return $slides_manager->getSlides();
	}
}

if( ! function_exists( 'thb_get_footer_layout' ) ) {
	/**
	 * Get the footer layout.
	 *
	 * @return string
	 */
	function thb_get_footer_layout() {
		return thb_get_option( 'footer_layout' );
	}
}

if( ! function_exists( 'thb_footer_active' ) ) {
	/**
	 * Check if the footer has a layout and its widget areas are active.
	 *
	 * @return boolean
	 */
	function thb_footer_active() {
		$footer_layout = thb_get_footer_layout();

		if ( empty( $footer_layout ) ) {
			return false;
		}

		$footer_columns_classes = explode( ',', $footer_layout );
		$footer_columns_number = count( $footer_columns_classes );

		$display_footer = false;

		for( $i=0; $i<$footer_columns_number; $i++ ) {
			if ( ! $display_footer && is_active_sidebar( 'footer-sidebar-' . $i ) ) {
				$display_footer = true;
			}
		}

		return $display_footer;
	}
}

if( ! function_exists('thb_footer_layout') ) {
	/**
	 * Display the footer sidebar.
	 */
	function thb_footer_layout() {
		if ( ! thb_footer_active() ) {
			return;
		}

		thb_get_subtemplate( 'backpack/layout', dirname(__FILE__), 'footer_sidebar' );
	}
}

if( !function_exists('thb_get_logo_position') ) {
	/**
	 * Get the logo position
	 * @return string
	 */
	function thb_get_logo_position() {
		$logo_position = thb_get_option('logo_position');

		if ( empty($logo_position) ) {
			$logo_position = 'logo-left';
		}

		return $logo_position;
	}
}