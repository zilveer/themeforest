<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Theme_Admin_Category_Meta' ) ) {
	/**
	 * Category meta class
	 *
	 * Create category meta options
	 * Usually used for category page styling options
	 *
	 * @since 2.1
	 * @package WolfFramework
	 * @author WolfThemes
	 */
	class Wolf_Theme_Admin_Category_Meta {

		var $cat_meta = array();
		var $options_array_name;

		/**
		 * Wolf_Theme_Admin_Category_Meta constructor
		 */
		public function __construct( $cat_meta = array(), $options_array_name = 'wolf_post_category_meta' ) {

			$this->cat_meta = $cat_meta + $this->cat_meta;
			$this->options_array_name = $options_array_name;
			add_action( 'category_add_form_fields', array( $this, 'add' ) );
			add_action( 'category_edit_form_fields', array( $this, 'edit' ) );
			add_action( 'create_category', array( $this, 'save' ) );
			add_action( 'edited_category', array( $this, 'save' ) );
		}

		public function add( $cat ) {
			$options_array_name = $this->options_array_name;
			foreach ( $this->cat_meta as $field ) {
				$field_id	= sanitize_title( $field['id'] );
				$type     	= ( isset( $field['type'] ) ) ? $field['type'] : 'text';
				$label    	= ( isset( $field['label'] ) ) ? $field['label'] : 'Label';
				$desc    	= ( isset( $field['desc'] ) ) ? $field['desc'] : '';
				$def      	= ( isset( $field['def'] ) ) ? $field['def'] : '';
				$dependency	= ( isset( $field['dependency'] ) ) ? $field['dependency'] : array();
				$class 		= "form-field option-section-$field_id";
				$data 		= '';

				if ( array() != $dependency ) {
					$class .= ' has-dependency';

					$data .= ' data-dependency-element="' . $dependency['element'] . '"';

					$dependency_value = '[';
					foreach ( $dependency['value'] as $value ) {
						$dependency_value .= '"' . $value . '"';
					}
					$dependency_value .= ']';

					$data .= " data-dependency-values='$dependency_value'";
				}

				echo "<div class='$class'$data>";
				echo '<label for="' . $options_array_name . '[' . $field_id . ']' . '">';
				echo sanitize_text_field( $label );
				echo '</label>';

					/* Type */
					if ( 'text' == $type || 'int' == $type ) {

						?>
						<input type="text" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]">
						<?php

					} elseif ( 'colorpicker' == $type ) {
						?>
						<input name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_color'; ?>]" class="wolf-options-colorpicker" type="text">
						<?php

					} elseif ( 'image' == $type ) {

						?>
						<input type="hidden" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]">
						<img style="max-width:250px;display:none;" class="wolf-options-img-preview" src="" alt="<?php echo sanitize_title( $field_id ); ?>">
						<br><a href="#" class="button wolf-options-reset-bg"><?php _e( 'Clear', 'wolf' ); ?></a>
						<a href="#" class="button wolf-options-set-bg"><?php _e( 'Choose an image', 'wolf' ); ?></a>
						<?php

					} elseif ( 'background' == $type ) {

						$parallax = isset( $field['parallax'] ) ? $field['parallax'] : false;
						$exclude_params = isset( $field['exclude_params'] ) ?$field['exclude_params'] : array();

						if ( ! in_array( 'color', $exclude_params ) ) {
							?>
							<br><br>
							<p><?php _e( 'Background color', 'wolf' ); ?></p>
							<input name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_color'; ?>]" class="wolf-options-colorpicker" type="text">
							<br><br>
							<?php
						}

						if ( ! in_array( 'image', $exclude_params ) ) {
							?>
							<p><?php _e( 'Background image', 'wolf' ); ?></p>
							<div>
								<input type="hidden" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]">
								<img style="max-width:250px;display:none;" class="wolf-options-img-preview" src="" alt="<?php echo sanitize_title( $field_id ); ?>">
								<br><a href="#" class="button wolf-options-reset-bg"><?php _e( 'Clear', 'wolf' ); ?></a>
								<a href="#" class="button wolf-options-set-bg"><?php _e( 'Choose an image', 'wolf' ); ?></a>
							</div>
							<br><br>
							<?php
						}

						if ( ! in_array( 'repeat', $exclude_params ) ) {
							/* Bg Repeat */
							$options = array(  'no-repeat', 'repeat','repeat-x', 'repeat-y' );

							?>
							<br>
							<p><?php _e( 'Background repeat', 'wolf' ); ?></p>
							<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_repeat'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_repeat'; ?>]">
								<?php foreach ( $options as $o): ?>
									<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o ); ?></option>
								<?php endforeach; ?>
							</select>
							<?php
						}

						if ( ! in_array( 'position', $exclude_params ) ) {
						/* Bg position */
						$options = array(
							'center center',
							'center top',
							'left top' ,
							'right top' ,
							'center bottom',
							'left bottom' ,
							'right bottom' ,
							'left center' ,
							'right center'
						);

						?>
						<br><br>
						<p><?php _e( 'Background position', 'wolf' ); ?></p>
						<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_position'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_position'; ?>]">
							<?php foreach ( $options as $o): ?>
								<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php
						}
						if ( ! in_array( 'size', $exclude_params ) ) {

						/* size
						--------------------*/
						$options = array(
							'cover' => __( 'cover (resize)', 'wolf' ),
							'normal' => __( 'normal', 'wolf' ),
							'resize' => __( 'responsive (hard resize)', 'wolf' ),
						);

						?>
						<br><br>
						<p><?php _e( 'Background size', 'wolf' ); ?></p>
						<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_size'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_size'; ?>]">
							<?php foreach ( $options as $k =>$v ) : ?>
								<option value="<?php echo esc_attr( $k ); ?>"><?php echo sanitize_text_field( $v ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php
						}
						if ( $parallax ) {
							?>
							<br><br>
							<p><strong><?php _e( 'Parallax', 'wolf' ); ?></strong></p>
							<input type="checkbox" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_parallax'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_parallax'; ?>]">
							<?php
						}

					} elseif ( 'video' == $type ) {

						?>
						<div>
							<p><strong><?php _e( 'mp4 URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_mp4'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_mp4'; ?>]">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
							<p><strong><?php _e( 'webm URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_webm'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_webm'; ?>]">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
							<p><strong><?php _e( 'ogv URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_ogv'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_ogv'; ?>]">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
						<p><strong><?php _e( 'Video Image Fallback', 'wolf' ); ?></strong></p>
						<input type="hidden"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]">
						<img style="max-width:200px;display:none" src="" class="wolf-options-img-preview">
						<br><a href="#" class="button wolf-options-reset-img"><?php _e( 'Clear', 'wolf' ); ?></a>
						<a href="#" class="button wolf-options-set-img"><?php _e( 'Choose an image', 'wolf' ); ?></a>
						</div>
						<?php

					} elseif ( 'select' == $type ) {

						echo '<select name="' . $options_array_name . '[' . $field_id . ']' . '"  id="' . $options_array_name . '[' . $field_id . ']' . '">';

						if ( array_keys( $field['options'] ) != array_keys( array_keys( $field['options'] ) ) ) {

							foreach ( $field['options'] as $k => $v) {
								echo "<option value='$k'>$v</option>";
							}
						} else{
							foreach ( $field['options'] as $option) {
								echo "<option value='$option'>$option</option>";
							}
						}

						echo '</select>';

					}

				if ( $desc ) {
					echo "<p class='description'>$desc</p>";
				}
				echo '</div>';
			}
		}

		public function edit( $cat ) {
			$options_array_name = $this->options_array_name;
			$cat_id = $cat->term_id;
			$cat_meta_value = $this->validate( get_option( "_wolf_post_category_meta_$cat_id" ) );

			foreach ( $this->cat_meta as $field ) {

				$field_id	= sanitize_title( $field['id'] );
				$type     	= ( isset( $field['type'] ) ) ? $field['type'] : 'text';
				$label    	= ( isset( $field['label'] ) ) ? $field['label'] : 'Label';
				$desc    	= ( isset( $field['desc'] ) ) ? $field['desc'] : '';
				$def      	= ( isset( $field['def'] ) ) ? $field['def'] : '';
				$dependency	= ( isset( $field['dependency'] ) ) ? $field['dependency'] : array();
				$class 		= "form-field option-section-$field_id";
				$data 		= '';

				$value = isset( $cat_meta_value[$field_id] ) ? $cat_meta_value[$field_id] : null;

				if ( array() != $dependency ) {
					$class .= ' has-dependency';

					$data .= ' data-dependency-element="' . $dependency['element'] . '"';

					$dependency_value = '[';
					foreach ( $dependency['value'] as $value ) {
						$dependency_value .= '"' . $value . '"';
					}
					$dependency_value .= ']';

					$data .= " data-dependency-values='$dependency_value'";
				}

				echo "<tr class='$class'$data>";
					echo '<th scope="row" valign="top">';
				echo '<label for="' . $options_array_name . '[' . $field_id . ']' . '">';
				echo sanitize_text_field( $label );
				echo '</label></th><td>';

					/* Type */
					if ( 'text' == $type || 'int' == $type ) {

						?>
						<input type="text" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" value="<?php echo esc_attr( $value ); ?>">
						<?php

					} elseif ( 'colorpicker' == $type ) {
						?>
						<input name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" class="wolf-options-colorpicker" type="text" value="<?php echo esc_attr( $value ); ?>">
						<?php

					} elseif ( 'image' == $type ) {

						?>
						<input type="hidden" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ); ?>]" value="<?php echo esc_attr( $value ); ?>">
						<img style="max-width:250px;display:none;" class="wolf-options-img-preview" src="" alt="<?php echo sanitize_title( $field_id ); ?>">
						<br><a href="#" class="button wolf-options-reset-bg"><?php _e( 'Clear', 'wolf' ); ?></a>
						<a href="#" class="button wolf-options-set-bg"><?php _e( 'Choose an image', 'wolf' ); ?></a>
						<?php

					} elseif ( 'background' == $type ) {

						$parallax = isset( $field['parallax'] ) ? $field['parallax'] : false;
						$exclude_params = isset( $field['exclude_params'] ) ?$field['exclude_params'] : array();

						$bg_meta_color      = $cat_meta_value[$field_id . '_color'];
						$bg_meta_img_id        = $cat_meta_value[$field_id . '_img'];
						$bg_meta_img_url = wolf_get_url_from_attachment_id( $bg_meta_img_id );
						$bg_meta_repeat     = $cat_meta_value[$field_id . '_repeat'];
						$bg_meta_position   = $cat_meta_value[$field_id . '_position'];
						$bg_meta_size       = $cat_meta_value[$field_id . '_size'];

						if ( ! in_array( 'color', $exclude_params ) ) {
							?>
							<br><br>
							<p><?php _e( 'Background color', 'wolf' ); ?></p>
							<input name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_color'; ?>]" class="wolf-options-colorpicker" type="text" value="<?php echo esc_attr( $bg_meta_color ); ?>">
							<br><br>
							<?php
						}

						if ( ! in_array( 'image', $exclude_params ) ) {
							?>
							<p><?php _e( 'Background image', 'wolf' ); ?></p>
							<div>
								<input type="hidden" name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" value="<?php echo absint( $bg_meta_img_id ); ?>">
								<img style="max-width:250px;<?php if ( 0 == $bg_meta_img_id ) echo ' display:none;'; ?>" class="wolf-options-img-preview" src="<?php echo esc_url( $bg_meta_img_url ); ?>" alt="<?php echo sanitize_title( $field_id ); ?>">
								<br><a href="#" class="button wolf-options-reset-bg"><?php _e( 'Clear', 'wolf' ); ?></a>
								<a href="#" class="button wolf-options-set-bg"><?php _e( 'Choose an image', 'wolf' ); ?></a>
							</div>
							<br><br>
							<?php
						}

						if ( ! in_array( 'repeat', $exclude_params ) ) {
							/* Bg Repeat */
							$options = array( 'no-repeat', 'repeat','repeat-x', 'repeat-y' );

							?>
							<br>
							<p><?php _e( 'Background repeat', 'wolf' ); ?></p>
							<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_repeat'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_repeat'; ?>]">
								<?php foreach ( $options as $o): ?>
									<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $cat_meta_value[$field_id . '_repeat'], $o ); ?>><?php echo esc_attr( $o ); ?></option>
								<?php endforeach; ?>
							</select>
							<?php
						}

						if ( ! in_array( 'position', $exclude_params ) ) {
						/* Bg position */
						$options = array(
							'center center',
							'center top',
							'left top' ,
							'right top' ,
							'center bottom',
							'left bottom' ,
							'right bottom' ,
							'left center' ,
							'right center'
						);

						?>
						<br><br>
						<p><?php _e( 'Background position', 'wolf' ); ?></p>
						<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_position'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_position'; ?>]">
							<?php foreach ( $options as $o): ?>
								<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $cat_meta_value[$field_id . '_position'], $o ); ?>><?php echo esc_attr( $o ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php
						}
						if ( ! in_array( 'size', $exclude_params ) ) {

						/* size
						--------------------*/
						$options = array(
							'cover' => __( 'cover (resize)', 'wolf' ),
							'normal' => __( 'normal', 'wolf' ),
							'resize' => __( 'responsive (hard resize)', 'wolf' ),
						);

						?>
						<br><br>
						<p><?php _e( 'Background size', 'wolf' ); ?></p>
						<select name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_size'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_size'; ?>]">
							<?php foreach ( $options as $k =>$v ) : ?>
								<option value="<?php echo esc_attr( $k ); ?>" <?php selected( $cat_meta_value[$field_id . '_size'], $k ); ?>><?php echo sanitize_text_field( $v ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php
						}

					} elseif ( 'video' == $type ) {
						$mp4 = $cat_meta_value[$field_id . '_mp4'];
						$webm = $cat_meta_value[$field_id . '_webm'];
						$ogv = $cat_meta_value[$field_id . '_ogv'];
						$img_id = $cat_meta_value[$field_id . '_img'];
						$img = esc_url( wolf_get_url_from_attachment_id( $img_id, 'thumbnail' ) );
						?>
						<div>
							<p><strong><?php _e( 'mp4 URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_mp4'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_mp4'; ?>]" value="<?php echo esc_url( $mp4 ); ?>">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
							<p><strong><?php _e( 'webm URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_webm'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_webm'; ?>]" value="<?php echo esc_url( $webm ); ?>">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
							<p><strong><?php _e( 'ogv URL', 'wolf' ); ?></strong></p>
							<input type="text"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_ogv'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_ogv'; ?>]" value="<?php echo esc_url( $ogv ); ?>">
							<br><a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
							<br><br>
						</div>

						<div>
						<p><strong><?php _e( 'Video Image Fallback', 'wolf' ); ?></strong></p>
						<input type="hidden"  name="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" id="wolf_post_category_meta[<?php echo sanitize_title( $field_id ) . '_img'; ?>]" value="<?php echo absint( $img_id ); ?>">
						<img style="max-width:200px;<?php echo ( ! $img ) ? 'display:none;' : '' ?>" src="<?php echo esc_url( $img ); ?>" class="wolf-options-img-preview">
						<br><a href="#" class="button wolf-options-reset-img"><?php _e( 'Clear', 'wolf' ); ?></a>
						<a href="#" class="button wolf-options-set-img"><?php _e( 'Choose an image', 'wolf' ); ?></a>
						</div>
						<?php

					} elseif ( 'select' == $type ) {

						echo '<select name="' . $options_array_name . '[' . $field_id . ']' . '"  id="' . $options_array_name . '[' . $field_id . ']' . '">';

						if ( array_keys( $field['options'] ) != array_keys( array_keys( $field['options'] ) ) ) {

							foreach ( $field['options'] as $k => $v) {
								echo '<option '  . selected( $cat_meta_value[ $field_id ], $k, false ) .  ' value="' . $k . '">' . $v . '</option>';
							}
						} else{
							foreach ( $field['options'] as $option) {
								echo '<option '  . selected( $cat_meta_value[ $field_id ], $option, false ) .  ' value="' . $k . '">' . $option . '</option>';
							}
						}

						echo '</select>';

					}

				if ( $desc ) {
					echo "<p class='description'>$desc</p>";
				}
				echo '</td></tr>';
			}
		}

		public function save( $cat_id ) {
			if ( isset( $_POST[ $this->options_array_name ] ) ) {
				$post_cat_meta = $this->validate( $_POST[ $this->options_array_name ] );
				update_option( '_' . $this->options_array_name . '_' . $cat_id, $post_cat_meta );
			}
		}

		/**
		 * Validate input data
		 *
		 * @param array $input
		 * @return array $input
		 */
		public function validate( $inputs ) {

			foreach ( $this->cat_meta as $field ) {

				// $inputs[ $field['id'] ] = $inputs[ $field['id'] ];
				$type = $field['type'];

				if ( 'int' == $type ) {
					$inputs[ $field['id'] ] = ( isset( $inputs[ $field['id'] ] ) ) ?  absint( $inputs[ $field['id'] ] ) : null;
				}

				elseif ( 'text' == $type || 'select' == $type ) {
					$inputs[ $field['id'] ] = ( isset( $inputs[ $field['id'] ] ) ) ?  sanitize_text_field( $inputs[ $field['id'] ] ) : null;
				}

				elseif( 'background' == $type ) {
					$bg_settings = array( 'color', 'position', 'repeat', 'attachment', 'size', 'img', 'parallax' );

					foreach ( $bg_settings as $s ) {
						$inputs[ $field['id'] . '_' . $s ] = ( isset( $inputs[ $field['id'] . '_' . $s ] ) ) ? sanitize_text_field( $inputs[ $field['id'] . '_' . $s ] ) : null;
					}

				}

				elseif( 'video' == $type ) {
					$video_settings = array( 'mp4', 'webm', 'ogv' );
					foreach ( $video_settings as $s ) {
						$inputs[ $field['id'] . '_' . $s ] = ( isset( $inputs[ $field['id'] . '_' . $s ] ) ) ? esc_url( $inputs[ $field['id'] . '_' . $s ] ) : null;
					}

					$inputs[ $field['id'] . '_img'] = ( isset( $inputs[ $field['id'] . '_' . $s ] ) ) ? absint( $inputs[ $field['id'] . '_img'] ) : null;
				} else {
					$inputs[ $field['id'] ] = ( isset( $inputs[ $field['id'] ] ) ) ?  $inputs[ $field['id'] ] : null;
				}
			}
			return $inputs;
		}

	} // end class

} // end class exists check