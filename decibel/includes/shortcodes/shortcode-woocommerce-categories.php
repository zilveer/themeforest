<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_woocommerce_categories_shortcode' ) ) {
	/**
	 * Woocommerce mosaic category shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_woocommerce_categories_shortcode( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_woocommerce_categories', $atts );
		}

		extract( shortcode_atts( array(
			'layout' => 'classic-thumb',
			'columns' => 3,
			'padding' => 'yes',
			'exclude' => '',
			'include' => '',
		), $atts ) );

		$padding = sanitize_text_field( $padding );
		$exclude = sanitize_text_field( $exclude );
		$include = sanitize_text_field( $include );
		$layout = sanitize_text_field( wolf_get_image_size( $layout ) );
		$columns = absint( $columns );

		$include_ids = array();
		if ( '' != $include ) {
			$include = explode( ',', str_replace( ' ', '', $include ) );
			foreach ( $include as $slug ) {
				$cat = get_term_by( 'slug', $slug, 'product_cat' );
				$include_ids[] = $cat->term_id;
			}
		}

		$exclude_ids = array();
		if ( '' != $exclude ) {
			$exclude = explode( ',', str_replace( ' ', '', $exclude ) );
			foreach ( $exclude as $slug ) {
				$cat = get_term_by( 'slug', $slug, 'product_cat' );
	  			$exclude_ids[] = $cat->term_id;
			}
		}

		$output = '';
		include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );
		$cats_args = array(
			'taxonomy'     => 'product_cat',
			'parent' => 0,
			'show_count'   => 0,
			'pad_counts'   => 0,
			'hide_empty' => 1,
			'title_li'     => '',
			'menu_order' => 'asc',
			'walker' => new WC_Product_Cat_List_Walker,
			//'exclude' => $include_ids,
			//'include' => $exclude_ids,
		);

		if ( '' != $include )
			$cats_args['include'] = $include_ids;

		if ( '' != $exclude )
			$cats_args['exclude'] = $exclude_ids;

		$cats = get_categories( $cats_args );
		if ( array() != $cats ) {

			$rand_id = rand( 0,999 );
			$selector = "shop-categories-$rand_id";

			if ( 'mosaic' == $layout ) {

				$output .= "<div class='mosaic-shop-categories-container' id='$selector'>";
			} else {

				$columns = intval( $columns );
				$itemwidth = $columns > 0 ? floor( 100/$columns ) : 100;
				$float = is_rtl() ? 'right' : 'left';

				$css = "<style type='text/css'>
					#{$selector} .mosaic-shop-category{
						float: {$float};
						width: {$itemwidth}%;

				";

				if ( 'yes' == $padding )
					$css .= "padding:1rem;";

				if ( 1 == $columns ) {
					$css .= 'padding-bottom:10px!important;';
				}

				$css .= '}</style>';

				$output .= wolf_compact_css( $css );

				$output .= "<div class='shop-categories-container' id='$selector'>";
			}

			foreach ( $cats as $cat ) {
				$title = $cat->name;
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );


				$link = get_term_link( $cat );
				$class = 'mosaic-shop-category product-cat';
				$size = $layout;

				if ( 'mosaic' == $layout ) {
					$size = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_size', true );
					if ( '2x1' == $size ) {
						$class .= ' width2 wide';
					} elseif ( '2x2' == $size ) {
						$class .= ' width2 height2 big';
					}
				}

				$img_url = wolf_get_url_from_attachment_id( absint( $thumbnail_id ), $size );
				if ( $thumbnail_id ) {
					$output .= "<div class='$class'>
						<figure class='effect-edouard'>
							<img src='$img_url'>
							<figcaption>
								<div class='figcaption-inner table'>
									<div class='table-cell' >
										<a href='$link' class='mask-link'></a>
										<h2 class='category-title'>$title</h2>
									</div>
								</div>
							</figcaption>
						</figure>
					</div>";
				}
			} // endforeach
			$output .= '</div>';

			if ( 'mosaic' == $layout ) {
				wp_enqueue_script( 'packery' );
				$output .= '<script type="text/javascript">jQuery(document).ready(function(){';
					$output .= 'jQuery( ".mosaic-shop-categories-container" ).imagesLoaded( function() {
					jQuery( ".mosaic-shop-categories-container" ).isotope( {
						itemSelector : ".mosaic-shop-category",
						//animationEngine : "none",
						layoutMode: "packery"
					} );
				});';
				$output .= '});</script>';
			}
		} // endif

		return $output;
	}
	add_shortcode( 'wolf_woocommerce_categories', 'wolf_woocommerce_categories_shortcode' );
}