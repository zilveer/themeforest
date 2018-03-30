<?php

/*
*	Footer Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Prints Footer Background Image
 */
 if ( !function_exists('blade_grve_print_footer_bg_image') ) {

	function blade_grve_print_footer_bg_image() {

		if ( 'custom' == blade_grve_option( 'footer_bg_mode' ) ) {
			$grve_footer_custom_bg = array(
				'bg_mode' => 'custom',
				'bg_image_id' => blade_grve_option( 'footer_bg_image', '', 'id' ),
				'bg_position' => blade_grve_option( 'footer_bg_position', 'center-center' ),
				'pattern_overlay' => blade_grve_option( 'footer_pattern_overlay' ),
				'color_overlay' => blade_grve_option( 'footer_color_overlay' ),
				'opacity_overlay' => blade_grve_option( 'footer_opacity_overlay' ),
			);
			blade_grve_print_title_bg_image( $grve_footer_custom_bg );
		}

	}
}

/**
 * Prints Footer Widgets
 */
 if ( !function_exists('blade_grve_print_footer_widgets') ) {

	function blade_grve_print_footer_widgets() {

		if ( blade_grve_visibility( 'footer_widgets_visibility' ) ) {

			if ( ( is_singular() && 'yes' == blade_grve_post_meta( 'grve_disable_footer' ) ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_footer' ) ) ) {
				return;
			}

			$grve_footer_columns = blade_grve_option('footer_widgets_layout');

			switch( $grve_footer_columns ) {
				case 'footer-1':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-4-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-2':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-2',
							'tablet-column' => '1',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-3':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-3-sidebar',
							'column' => '1-2',
							'tablet-column' => '1',
						),
					);
				break;
				case 'footer-4':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-5':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'grve-footer-3-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
					);
				break;
				case 'footer-6':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '2-3',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-7':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '2-3',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-8':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'grve-footer-2-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'grve-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-3',
						),
					);
				break;
				case 'footer-9':
				default:
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'grve-footer-1-sidebar',
							'column' => '1',
							'tablet-column' => '1',
						),
					);
				break;
			}

			$section_type = blade_grve_option( 'footer_section_type', 'fullwidth-background' );
			$footer_class = '';
			if( 'fullwidth-element' == $section_type ) {
				$footer_class = 'grve-fullwidth';
			}
	?>
			<!-- Footer -->
			<div class="grve-widget-area <?php echo esc_attr( $footer_class ); ?>">
				<div class="grve-container">
					<div class="grve-row">
		<?php

					foreach ( $footer_sidebars as $footer_sidebar ) {
						echo '<div class="grve-column-' . $footer_sidebar['column'] . ' grve-tablet-column-' . $footer_sidebar['tablet-column'] . '">';
						dynamic_sidebar( $footer_sidebar['sidebar-id'] );
						echo '</div>';
					}
		?>
					</div>
				</div>
			</div>
	<?php

		}
	}
}

/**
 * Prints Footer Bar Area
 */

if ( !function_exists('blade_grve_print_footer_bar') ) {
	function blade_grve_print_footer_bar() {

		if ( blade_grve_visibility( 'footer_bar_visibility' ) ) {
			if ( blade_grve_visibility( 'footer_copyright_visibility' ) ) {
				if ( ( is_singular() && 'yes' == blade_grve_post_meta( 'grve_disable_copyright' ) ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_copyright' ) ) ) {
					return;
				}

				$section_type = blade_grve_option( 'footer_bar_section_type', 'fullwidth-background' );
				$footer_class = '';
				if( 'fullwidth-element' == $section_type ) {
					$footer_class = 'grve-fullwidth';
				}
				$align_center = blade_grve_option( 'footer_bar_align_center', 'no' );
				$second_area = blade_grve_option( 'second_area_visibility', '1' );
	?>

				<div class="grve-footer-bar <?php echo esc_attr( $footer_class ); ?>" data-align-center="<?php echo esc_attr( $align_center ); ?>">
					<div class="grve-container">
						<div class="grve-row">

							<div class="grve-bar-content grve-left-side">
								<div class="grve-copyright grve-small-text">
									<?php echo do_shortcode( blade_grve_option( 'footer_copyright_text' ) ); ?>
								</div>
							</div>
							<?php if ( '2' == $second_area ) { ?>
							<div class="grve-bar-content grve-right-side">
								<nav class="grve-footer-menu grve-small-text grve-list-divider">
									<?php blade_grve_footer_nav(); ?>
								</nav>
							</div>
							<?php
							} else if ( '3' == $second_area ) { ?>
							<div class="grve-bar-content grve-right-side">
								<?php
								global $blade_grve_social_list;
								$options = blade_grve_option('footer_social_options');
								$social_display = blade_grve_option('footer_social_display', 'text');
								$social_options = blade_grve_option('social_options');

								if ( !empty( $options ) && !empty( $social_options ) ) {
									if ( 'text' == $social_display ) {
										echo '<ul class="grve-social grve-small-text grve-list-divider">';
										foreach ( $social_options as $key => $value ) {
											if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
												if ( 'skype' == $key ) {
													echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '">' . $blade_grve_social_list[$key] . '</a></li>';
												} else {
													echo '<li><a href="' . esc_url( $value ) . '" target="_blank">' . $blade_grve_social_list[$key] . '</a></li>';
												}
											}
										}
										echo '</ul>';
									} else {
										echo '<ul class="grve-social grve-social-icons">';
										foreach ( $social_options as $key => $value ) {
											if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
												if ( 'skype' == $key ) {
													echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '" class="fa fa-' . esc_attr( $key ) . '"></a></li>';
												} else {
													echo '<li><a href="' . esc_url( $value ) . '" target="_blank" class="fa fa-' . esc_attr( $key ) . '"></a></li>';
												}
											}
										}
										echo '</ul>';
									}
								}
								?>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>

	<?php
			}
		}
	}
}

/**
 * Prints Back To Top Link
 */
if ( !function_exists('blade_grve_print_back_top') ) {
	function blade_grve_print_back_top() {

		if ( ( is_singular() && 'yes' == blade_grve_post_meta( 'grve_disable_back_to_top' ) ) || ( blade_grve_is_woo_shop() && 'yes' == blade_grve_post_meta_shop( 'grve_disable_back_to_top' ) ) ) {
			return;
		}

		if ( blade_grve_visibility( 'back_to_top_enabled' )  ) {

			$grve_back_to_top_color = blade_grve_option( 'back_to_top_color', 'grey' );
			$grve_back_to_top_shape = blade_grve_option( 'back_to_top_shape', 'none' );
			$grve_back_to_top_bg_color = blade_grve_option( 'back_to_top_bg_color', 'primary-1' );

			$grve_back_to_top_classes = array('grve-back-top');

			if( 'none' != $grve_back_to_top_shape ){
				$grve_back_to_top_classes[] = 'grve-' . $grve_back_to_top_shape;
				$grve_back_to_top_classes[] = 'grve-bg-' . $grve_back_to_top_bg_color;
			}
			$grve_back_to_top_class_string = implode( ' ', $grve_back_to_top_classes );

			$grve_back_to_top_icon_classes = array('grve-icon-arrow-top-alt');
			$grve_back_to_top_icon_classes[] = 'grve-text-' . $grve_back_to_top_color;
			$grve_back_to_top_icon_class_string = implode( ' ', $grve_back_to_top_icon_classes );

		?>
			<div class="<?php echo esc_attr( $grve_back_to_top_class_string ); ?>">
				<i class="<?php echo esc_attr( $grve_back_to_top_icon_class_string ); ?>"></i>
			</div>
		<?php
		}
	}
}


/**
 * Prints Custom javascript code
 */
add_action( 'wp_footer', 'blade_grve_print_custom_js_code', 100 );
if ( !function_exists('blade_grve_print_custom_js_code') ) {

	function blade_grve_print_custom_js_code() {
		$custom_js_code = blade_grve_option( 'custom_js' );
		if ( !empty( $custom_js_code ) ) {
			echo "<script type='text/javascript'>" . $custom_js_code . "</script>";
		}
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
