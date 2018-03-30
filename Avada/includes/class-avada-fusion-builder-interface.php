<?php
/**
 * Class Avada_Fusion_Builder_Interface
 *
 * Class holding interace function for FusionBuilder.
 *
 * @author		ThemeFusion
 * @copyright	(c) Copyright by ThemeFusion
 * @link		http://theme-fusion.com
 * @since		Version 4.1
 */ 
class Avada_Fusion_Builder_Interface {

	/**
	 * 1. backup post content as post meta "fusion_builder_content_backup"
	 * 2. replace old shortcodes with new ones
	 * 3. insert fusion_builder_row where needed
	 * 4. search page content for opening [ tags. if is not a section add appropriate shortcodes.
	 * 5. insert missing columns shortcode inside fusion_builder_row where needed
	 * 6. run verification check. check opened & closed tags ( section, row, column )
	 * 7. add completed post meta flag
	 *
	 * @since 4.1
	 * @param string $id A post ID.
	 * @return void
	 */
	public static function restructure_shortcodes( $id = '' ) {

		if ( '' != $id ) {

			// check for "converted" post meta

			$content = get_post( $id );
			$content = $content->post_content;
			$page_converted = get_post_meta( $id, 'fusion_builder_converted', true );
			$builder_status = get_post_meta( $id, 'fusion_builder_status', true );

			// Backup page content if it was not converted previously
			if ( 'yes' != $page_converted ) {
				// Backup page content as post meta
				update_post_meta( $id, 'fusion_builder_content_backup', $content );
			}

			//if ( $builder_status == 'active' ) {

			$string_from_to = array(
				// Fullwidth container
				'[/fullwidth]'    => '[/fusion_builder_row][/fusion_builder_section]',

				// Columns
				'[one_full'       => '[fusion_builder_column type="4_4"',
				'[/one_full]'     => '[/fusion_builder_column]',

				'[one_half'       => '[fusion_builder_column type="1_2"',
				'[/one_half]'     => '[/fusion_builder_column]',

				'[two_third'      => '[fusion_builder_column type="2_3"',
				'[/two_third]'    => '[/fusion_builder_column]',

				'[two_fifth'      => '[fusion_builder_column type="2_5"',
				'[/two_fifth]'    => '[/fusion_builder_column]',

				'[/one_third]'    => '[/fusion_builder_column]',
				'[one_third'      => '[fusion_builder_column type="1_3"',

				'[/five_sixth]'   => '[/fusion_builder_column]',
				'[five_sixth'     => '[fusion_builder_column type="5_6"',

				'[/four_fifth]'   => '[/fusion_builder_column]',
				'[four_fifth'     => '[fusion_builder_column type="4_5"',

				'[/one_fifth]'    => '[/fusion_builder_column]',
				'[one_fifth'      => '[fusion_builder_column type="1_5"',

				'[/one_fourth]'   => '[/fusion_builder_column]',
				'[one_fourth'     => '[fusion_builder_column type="1_4"',

				'[/three_fifth]'  => '[/fusion_builder_column]',
				'[three_fifth'    => '[fusion_builder_column type="3_5"',

				'[/three_fourth]' => '[/fusion_builder_column]',
				'[three_fourth'   => '[fusion_builder_column type="3_4"',

				'[/one_sixth]'    => '[/fusion_builder_column]',
				'[one_sixth'      => '[fusion_builder_column type="1_6"',
			);

			// replace old layout shortcodes with new ones
			$content = strtr( $content, $string_from_to );

			//replace old element shortcodes with new ones
			$content = fusion_builder_convert_elements( $content );

			// Pricing shortcode inside text shortcode fix
			//TODO: expand to include woo, layer, etc ?
			$string_from_to = array(
				'[fusion_text][fusion_pricing_table'    => '[fusion_pricing_table',
				'[/fusion_pricing_table][/fusion_text]' => '[/fusion_pricing_table]',
			);
			$content = strtr( $content, $string_from_to );

			$needle = '[fullwidth';
			$last_pos = -1;
			$position_change = 0;
			$positions = array();

			// get all positions of [fullwidth shortcode
			while ( ( $last_pos = strpos( $content, $needle, $last_pos + 1 ) ) !== false ) {
				$positions[] = $last_pos;
			}

			foreach ( $positions as $position ) {

				// fullwidth tag closing position
				$section_close_position = strpos( $content, ']', $position + $position_change );

				// insert [fusion_builder_row] shortcode
				$content = substr_replace( $content, '][fusion_builder_row]', $section_close_position, 1 );

				// change in position
				$position_change = $position_change + 20;

			}

			// replace old [fullwidth shortcode with new [fusion_builder_section
			$string_from_to = array(
				'[fullwidth' => '[fusion_builder_section',
			);

			$content = strtr( $content, $string_from_to );

			// Convert outer elements and columns
			$content = fusion_builder_convert_outside_elements( $content );
			// Convert rows
			$content = fusion_builder_convert_rows( $content );

			// } else { // builder is inactive
			// 	$content = fusion_builder_convert_elements( $content );
			// }

			// update post content
			$updated_post = array(
				'ID'           => $id,
				'post_content' => $content,
			);

			wp_update_post( $updated_post, true );

			if ( is_wp_error( $id ) ) {
				$errors = $id->get_error_messages();

				foreach ( $errors as $error ) {
					echo $error;
				}
			} else {
				update_post_meta( $id, 'fusion_builder_converted', 'yes' );
			}
		}
	}

	/**
	 * Convert old Avada shortcode names to new FusionBuilder names
	 *
	 * @since 4.1
	 * @param string $content Content of a specific post.
	 * @return string The updated post content.
	 */
	public static function convert_elements( $content ) {
		$string_from_to = array(
			// Elements
			'[alert'                      => '[fusion_alert',
			'[/alert]'                    => '[/fusion_alert]',
			'[blog'                       => '[fusion_blog',
			'[/blog]'                     => '[/fusion_blog]',
			'[button'                     => '[fusion_button',
			'[/button]'                   => '[/fusion_button]',
			'[checklist'                  => '[fusion_checklist',
			'[/checklist]'                => '[/fusion_checklist]',
			'[li_item'                    => '[fusion_li_item',
			'[/li_item]'                  => '[/fusion_li_item]',
			'[content_boxes'              => '[fusion_content_boxes',
			'[/content_boxes]'            => '[/fusion_content_boxes]',
			'[content_box'                => '[fusion_content_box',
			'[/content_box]'              => '[/fusion_content_box]',
			'[counters_box'               => '[fusion_counters_box',
			'[/counters_box]'             => '[/fusion_counters_box]',
			'[counter_box'                => '[fusion_counter_box',
			'[/counter_box]'              => '[/fusion_counter_box]',
			'[counters_circle'            => '[fusion_counters_circle',
			'[/counters_circle]'          => '[/fusion_counters_circle]',
			'[counter_circle'             => '[fusion_counter_circle',
			'[/counter_circle]'           => '[/fusion_counter_circle]',
			'[dropcap'                    => '[fusion_dropcap',
			'[/dropcap]'                  => '[/fusion_dropcap]',
			'[flexslider'                 => '[fusion_flexslider',
			'[/flexslider]'               => '[/fusion_flexslider]',
			'[postslider'                 => '[fusion_postslider',
			'[/postslider]'               => '[/fusion_postslider]',
			'[flip_boxes'                 => '[fusion_flip_boxes',
			'[/flip_boxes]'               => '[/fusion_flip_boxes]',
			'[flip_box'                   => '[fusion_flip_box',
			'[/flip_box]'                 => '[/fusion_flip_box]',
			'[fontawesome'                => '[fusion_fontawesome',
			'[/fontawesome]'              => '[/fusion_fontawesome]',
			'[fusionslider'               => '[fusion_fusionslider',
			'[/fusionslider]'             => '[/fusion_fusionslider]',
			'[map'                        => '[fusion_map',
			'[/map]'                      => '[/fusion_map]',
			'[highlight'                  => '[fusion_highlight',
			'[/highlight]'                => '[/fusion_highlight]',
			'[images'                     => '[fusion_images',
			'[/images]'                   => '[/fusion_images]',
			'[image'                      => '[fusion_image',
			'[/image]'                    => '[/fusion_image]',
			'[clients'                    => '[fusion_clients',
			'[/clients]'                  => '[/fusion_clients]',
			'[client'                     => '[fusion_client',
			'[/client]'                   => '[/fusion_client]',
			'[imageframe'                 => '[fusion_imageframe',
			'[/imageframe]'               => '[/fusion_imageframe]',
			'[menu_anchor'                => '[fusion_menu_anchor',
			'[/menu_anchor]'              => '[/fusion_menu_anchor]',
			'[modal'                      => '[fusion_modal',
			'[/modal]'                    => '[/fusion_modal]',
			'[one_page_text_link'         => '[fusion_one_page_text_link',
			'[/one_page_text_link]'       => '[/fusion_one_page_text_link]',
			'[person'                     => '[fusion_person',
			'[/person]'                   => '[/fusion_person]',
			'[popover'                    => '[fusion_popover',
			'[/popover]'                  => '[/fusion_popover]',
			'[pricing_table'              => '[fusion_pricing_table',
			'[/pricing_table]'            => '[/fusion_pricing_table]',
			'[pricing_row'                => '[fusion_pricing_row',
			'[/pricing_row]'              => '[/fusion_pricing_row]',
			'[pricing_column'             => '[fusion_pricing_column',
			'[/pricing_column]'           => '[/fusion_pricing_column]',
			'[pricing_price'              => '[fusion_pricing_price',
			'[/pricing_price]'            => '[/fusion_pricing_price]',
			'[pricing_footer'             => '[fusion_pricing_footer',
			'[/pricing_footer]'           => '[/fusion_pricing_footer]',
			'[progress'                   => '[fusion_progress',
			'[/progress]'                 => '[/fusion_progress]',
			'[recent_posts'               => '[fusion_recent_posts',
			'[/recent_posts]'             => '[/fusion_recent_posts]',
			'[recent_works'               => '[fusion_recent_works',
			'[/recent_works]'             => '[/fusion_recent_works]',
			'[section_separator'          => '[fusion_section_separator',
			'[/section_separator]'        => '[/fusion_section_separator]',
			'[separator'                  => '[fusion_separator',
			'[/separator]'                => '[/fusion_separator]',
			'[sharing'                    => '[fusion_sharing',
			'[/sharing]'                  => '[/fusion_sharing]',
			'[slider'                     => '[fusion_slider',
			'[/slider]'                   => '[/fusion_slider]',
			'[slide'                      => '[fusion_slide',
			'[/slide]'                    => '[/fusion_slide]',
			'[social_links'               => '[fusion_social_links',
			'[/social_links]'             => '[/fusion_social_links]',
			'[soundcloud'                 => '[fusion_soundcloud',
			'[/soundcloud]'               => '[/fusion_soundcloud]',
			'[tabs'                       => '[fusion_tabs',
			'[/tabs]'                     => '[/fusion_tabs]',
			'[tab'                        => '[fusion_tab',
			'[/tab]'                      => '[/fusion_tab]',
			'[tagline_box'                => '[fusion_tagline_box',
			'[/tagline_box]'              => '[/fusion_tagline_box]',
			'[testimonials'               => '[fusion_testimonials',
			'[/testimonials]'             => '[/fusion_testimonials]',
			'[testimonial'                => '[fusion_testimonial',
			'[/testimonial]'              => '[/fusion_testimonial]',
			'[title'                      => '[fusion_title',
			'[/title]'                    => '[/fusion_title]',
			'[accordian'                  => '[fusion_accordion',
			'[/accordian]'                => '[/fusion_accordion]',
			'[toggle'                     => '[fusion_toggle',
			'[/toggle]'                   => '[/fusion_toggle]',
			'[tooltip'                    => '[fusion_tooltip',
			'[/tooltip]'                  => '[/fusion_tooltip]',
			'[vimeo'                      => '[fusion_vimeo',
			'[/vimeo]'                    => '[/fusion_vimeo]',
			'[featured_products_slider'   => '[fusion_featured_products_slider',
			'[/featured_products_slider]' => '[/fusion_featured_products_slider]',
			'[products_slider'            => '[fusion_products_slider',
			'[/products_slider]'          => '[/fusion_products_slider]',
			'[youtube'                    => '[fusion_youtube',
			'[/youtube]'                  => '[/fusion_youtube]',
		);

		$content = strtr( $content, $string_from_to );

		return $content;
	}

	/**
	 * Convert FusionBuilder rows.
	 *
	 * @since 4.1
	 * @param string $content Content of a specific post.
	 * @return string The updated post content.
	 */
	public static function convert_rows( $content ) {

		$needle = '[fusion_builder_row]';
		$last_pos = -1;
		$position_change = 0;
		$positions = array();

		// Get all positions of [fusion_builder_row shortcode
		while ( ( $last_pos = strpos( $content, $needle, $last_pos + 1 ) ) !== false ) {
			$positions[] = $last_pos;
		}

		// For each row
		foreach ( $positions as $position ) {

			$position = $position + $position_change;

			$row_closing_position = strpos( $content, '[/fusion_builder_row]', $position );

			// search within this range/row
			$range = $row_closing_position - $position + 1;
			// row content
			$row_content = substr( $content, $position + strlen( $needle ), $range );
			$original_row_content = $row_content;

			$element_needle = '[';
			$row_last_pos = -1;
			$row_position_change = 0;
			$elemet_positions = array();

			$column_opened = false;
			$element_position_change = 0;

			// get all positions for shortcode opening tag "["
			while ( ( $row_last_pos = strpos( $row_content, $element_needle, $row_last_pos + 1 ) ) !== false ) {
				$elemet_positions[] = $row_last_pos;
			}

			foreach ( $elemet_positions as $elemet_position ) {

				$column_needle = '[fusion_builder_column';
				$check_for_column = substr( $row_content, $elemet_position + $element_position_change, strlen( $column_needle ) );

				// If it's a column that is opened
				if ( $check_for_column == $column_needle ) {

					if ( true == $column_opened ) {
						// Close column
						$row_content = substr_replace( $row_content, '[/fusion_builder_column]', $elemet_position + $element_position_change, 0 );

						$column_opened = false;
						$element_position_change = $element_position_change + 24;
					}

					$column_opened = true;

					// If it's a column that is closed
				} elseif ( '[/fusion_builder_colum' == $check_for_column ) {
					$column_opened = false;

					// If end of row
				} elseif ( '[/fusion_builder_row]' == $check_for_column ) {
					if ( true == $column_opened ) {
						$row_content = substr_replace( $row_content, '[/fusion_builder_column]', $elemet_position + $element_position_change, 0 );

						$column_opened = false;
						$element_position_change = $element_position_change + 24;
					}

					// If it's an element
				} else {
					// this is an element, add column
					if ( false == $column_opened ) {

						$column_open_tag = '[fusion_builder_column type="4_4" background_position="left top" background_color="" border_size="" border_color="" border_style="solid" spacing="yes" background_image="" background_repeat="no-repeat" padding="" margin_top="0px" margin_bottom="0px" class="" id="" animation_type="" animation_speed="0.3" animation_direction="left" hide_on_mobile="no" center_content="no" min_height="none"]';

						$row_content = substr_replace( $row_content, $column_open_tag, $elemet_position + $element_position_change, 0 );

						$column_opened = true;

						// change in position
						$element_position_change = $element_position_change + strlen( $column_open_tag );
					}
				}
			}

			// Replace unprocessed row content with processed one
			$content = substr_replace( $content, $row_content, $position + 20, strlen( $original_row_content ) );

			// Get character difference between processed and unprocessed row content
			$content_difference = strlen( $row_content ) - strlen( $original_row_content );
			$position_change = $position_change + $content_difference;

		}

		return $content;
	}

	/**
	 * Convert content outside of FusionBuilder rows.
	 *
	 * @since 4.1
	 * @param string $content Content of a specific post.
	 * @return string The updated post content.
	 */
	public static function convert_outside_elements( $content ) {

		// Check for elements outside of fullwidth section
		$element_needle = '[';
		$last_pos = -1;
		$element_position_change = 0;
		$elemet_positions = array();

		$section_opened = false;
		$column_opened = false;

		// get all positions for shortcode opening tag "["
		while ( ( $last_pos = strpos( $content, $element_needle, $last_pos + 1 ) ) !== false ) {
			$elemet_positions[] = $last_pos;
		}

		foreach ( $elemet_positions as $elemet_position ) {

			$section_needle = '[fusion_builder_section';
			$check_for_section = substr( $content, $elemet_position + $element_position_change, strlen( $section_needle ) );

			// If it's a section that is opened
			if ( $check_for_section == $section_needle ) {

				if ( true == $section_opened ) {
					// close section
					$close_section_tag = '[/fusion_builder_row][/fusion_builder_section]';

					$content = substr_replace( $content, $close_section_tag, $elemet_position + $element_position_change, 0 );

					$section_opened = false;
					$element_position_change = $element_position_change + strlen( $close_section_tag );

				}
				$section_opened = true;

				// If section is closed
			} elseif ( '[/fusion_builder_sectio' == $check_for_section ) {
				$section_opened = false;

				// This is an element. Add column.
			} else {

				if ( false == $section_opened ) {

					// open section
					$open_section_tag = '[fusion_builder_section hundred_percent="yes" overflow="visible"][fusion_builder_row]';

					$content = substr_replace( $content, $open_section_tag, $elemet_position + $element_position_change, 0 );

					$section_opened = true;

					$element_position_change = $element_position_change + strlen( $open_section_tag );
				}
			}
		}

		// Close section if it was not closed
		if ( true == $section_opened ) {
			$content .= '[/fusion_builder_row][/fusion_builder_section]';
			$section_opened = false;
		}

		return $content;
	}
	
	/**
	 * Convert content inside of text widgets.
	 *
	 * @since 4.1
	 * @return void
	 */	
	public static function convert_elements_in_widgets() {
		global $wp_registered_sidebars, $wp_registered_widgets;

		$sidebars_widgets = wp_get_sidebars_widgets();
		
		foreach( $sidebars_widgets as $sidebar => $widget_ids ) {
			foreach( $widget_ids as $widget_id ) {
				$option_name = $wp_registered_widgets[$widget_id]['callback'][0]->option_name;
				
				// Only change text widgets
				if ( 'widget_text' == $option_name ) {
					$key = $wp_registered_widgets[$widget_id]['params'][0]['number'];
					$widget_data = get_option( $option_name );
					$widget_content = $widget_data[$key]['text'];

					// First convert layout columns
					$widget_data[$key]['text'] = self::restructure_shortcodes( $widget_data[$key]['text'] );
					// Then convert shortcodes
					$widget_data[$key]['text'] = self::convert_elements( $widget_data[$key]['text'] );
					
					update_option( $option_name, $widget_data );
				}
			}
		}
	}	


	/**
	 * Add slider information to FusionBuilder
	 *
	 * @since 4.1
	 * @return void
	 */
	public static function slider_helper() {
		global $post;
		$slider = get_post_meta( $post->ID, 'pyre_slider_type', true );

		if ( 'layer' == $slider ) {
			$slider_type = __( 'LayerSlider', 'textdomain' );
			$slide = get_post_meta( $post->ID, 'pyre_slider_type', true );
			$edit_link = admin_url( 'admin.php?page=layerslider' );

		} elseif ( 'rev' == $slider ) {
			$slider_type = 'Revolution Slider';
			$slide = get_post_meta( $post->ID, 'pyre_revslider', true );
			$edit_link = admin_url( 'admin.php?page=revslider' );

		} elseif ( 'flex' == $slider ) {
			$slider_type = 'Fusion Slider';
			$slide = get_post_meta( $post->ID, 'pyre_wooslider', true );
			$edit_link = admin_url( 'edit.php?post_type=slide' );

		} elseif ( 'elastic' == $slider ) {
			$slider_type = 'Elastic Slider';
			$slide = get_post_meta( $post->ID, 'pyre_elasticslider', true );
			$edit_link = admin_url( 'edit.php?post_type=themefusion_elastic' );

		} else {
			$slider_type = 'no';
		}

		if ( 'no' != $slider_type ) {
			echo '<div class="fusion-builder-slider-helper">';
			echo '<h2 class="fusion-builder-slider-type"><span class="fusion-module-icon fusiona-uniF61C"></span> ' . $slider_type . '</h2>';
			echo '<h4 class="fusion-builder-slider-id">' . __( 'Slide ID: ', 'textdomain' ) . $slide  . '</h4>';
			echo '<a href="' . $edit_link . '" title="' . __( 'Edit slider', 'textdomain' ) . '" target="_blank" class="button button-primary">' . __( 'Edit Slider', 'textdomain' ) . '</a>';
			echo '</div>';
		}
	}
}

// Omit closing PHP tag to avoid "Headers already sent" issues.
