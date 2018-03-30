<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') ) 
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'RWMB_Slider_Slides_Field' ) ) 
{
	class RWMB_Slider_Slides_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( 'rwmb-slider-slide', RWMB_CSS_URL . 'slider-slides.css', array(), RWMB_VER );

			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'rwmb-slider-slide', RWMB_JS_URL . 'slider-slides.js', array( 'jquery' ), RWMB_VER, true );
		}

		/**
		 * Show begin HTML markup for fields
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function begin_html( $html, $meta, $field )
		{
			$html = '';

			return $html;
		}

		/**
		 * Show end HTML markup for fields
		 *
		 * @param string $html
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function end_html( $html, $meta, $field )
		{
			$html = '';

			return $html;
		}

		/**
		* Get field HTML
		*
		* @param $html
		* @param $field
		* @param $meta
		*
		* @return string
		*/
		static function html( $html, $meta, $field ) 
		{

			global $post;

			$id = $field['id'];

			$slider_slides = get_post_meta( $post->ID, $id, true ) ? get_post_meta( $post->ID, $id, true ) : false;

			$html = '<ul id="slider-slides">';

				if( $slider_slides ) {

					foreach ( $slider_slides as $i => $slide ) {

						$slide_img_src            = isset( $slide['slide-img-src'] )            ? $slide['slide-img-src']            : null;
						$slide_content            = isset( $slide['slide-content'] )            ? $slide['slide-content']            : null;

						$html .= '<li class="slide postbox">

									<div class="handlediv" title="' . __('Click to toggle', 'qs_framework') . '">&nbsp;</div>

									<h3 class="hndle"><span>' . __('Slide', 'qs_framework') . '</span></h3>

									<div class="inside">

										<div class="slider-slide-tabs">

											<ul>
												<li><a href="#slide-image">' . __('Image', 'qs_framework') . '</a></li>
												<li><a href="#slide-content">' . __('Caption', 'qs_framework') . '</a></li>
											</ul>

											<div id="slide-image" class="tabs-content">

												<div class="rwmb-field">

													<div class="rwmb-label">
														<label>' . __('Image URL', 'qs_framework') . '</label>
													</div><!-- end .rwmb-label -->

													<div class="rwmb-input">
														<input type="text" name="slide-img-src[]" class="rwmb-text" size="30" value="' . $slide_img_src . '">
														<input type="button" name="upload-image" class="upload-image" value="' . __('Upload Image', 'qs_framework') . '">
													</div><!-- end .rwmb-input -->

												</div><!-- end .rwmb-field -->											

											</div><!-- end #slide-image -->


											<div id="slide-content" class="tabs-content">
												
												<div class="rwmb-field">

													<div class="rwmb-label">
														<label>' . __('Slide Caption', 'qs_framework') . '</label>
													</div><!-- end .rwmb-label -->

													<div class="rwmb-input">
														<textarea name="slide-content[]" class="rwmb-textarea large-text" cols="60" rows="5">' . $slide_content . '</textarea>
														<p class="description">' . __('You can add slide text here if you like.  You can use both HTML and shortcodes.', 'qs_framework') . '</p>
													</div><!-- end .rwmb-input -->

												</div><!-- end .rwmb-field -->

											</div><!-- end #slide-content -->

											

										</div><!-- end .slider-slide-tabs -->

										<button class="remove-slide button-secondary">' . __('Remove Slide', 'qs_framework') . '</button>
										
										<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">
								
									</div><!-- end .inside -->
									
								</li>';

					}

				} else {


						$html .= '<li class="slide postbox">

									<div class="handlediv" title="' . __('Click to toggle', 'qs_framework') . '">&nbsp;</div>

									<h3 class="hndle"><span>' . __('Slide', 'qs_framework') . '</span></h3>

									<div class="inside">

										<div class="slider-slide-tabs">

											<ul>
												<li><a href="#slide-image">' . __('Image', 'qs_framework') . '</a></li>
												<li><a href="#slide-content">' . __('Caption', 'qs_framework') . '</a></li>
											</ul>

											<div id="slide-image" class="tabs-content">

												<div class="rwmb-field">

													<div class="rwmb-label">
														<label>' . __('Image URL', 'qs_framework') . '</label>
													</div><!-- end .rwmb-label -->

													<div class="rwmb-input">
														<input type="text" name="slide-img-src[]" class="rwmb-text" size="30" value="">
														<input type="button" name="upload-image" class="upload-image" value="' . __('Upload Image', 'qs_framework') . '">
													</div><!-- end .rwmb-input -->

												</div><!-- end .rwmb-field -->											

											</div><!-- end #slide-image -->


											<div id="slide-content" class="tabs-content">
												
												<div class="rwmb-field">

													<div class="rwmb-label">
														<label>' . __('Slide Content', 'qs_framework') . '</label>
													</div><!-- end .rwmb-label -->

													<div class="rwmb-input">
														<textarea name="slide-content[]" class="rwmb-textarea large-text" cols="60" rows="5"></textarea>
														<p class="description">' . __('(optional) HTML tags and WordPress shortcodes are allowed.', 'qs_framework') . '</p>
													</div><!-- end .rwmb-input -->

												</div><!-- end .rwmb-field -->

											</div><!-- end #slide-content -->


										</div><!-- end .slider-slide-tabs -->

										<button class="remove-slide button-secondary">' . __('Remove Slide', 'qs_framework') . '</button>
										
										<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">
								
									</div><!-- end .inside -->
									
								</li>';

				}

				$html .= '</ul><!-- end #slider-slides -->

						  <p> <button id="add-slider-slide" class="button-primary">' . __('Add New Slide', 'qs_framework') . '</button> </p>

						  <input type="hidden" name="slider-meta-info" value="' . $post->ID . '|' . $id . '">';

			return $html;
		}

		/**
		 * Save slides
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int $post_id
		 * @param array $field
		 *
		 * @return void
		 */
		static function save( $new, $old, $post_id, $field )
		{
				
			$name = $field['id'];

			$slider_slides = array();
			
			foreach( $_POST[$name] as $k => $v ) {

				$slider_slides[] = array(
					'slide-img-src'            => $_POST['slide-img-src'][$k],
					'slide-content'            => $_POST['slide-content'][$k],
				);

			}

			$new = $slider_slides;

			update_post_meta( $post_id, $name, $new );

		}
	}
}