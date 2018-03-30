<?php

class crazyblog_Forms {

	private $_hash;
	private static $_instance = null;

	function __construct() {


		$this->_hash = uniqid( 'form_builder_' );

		$this->_old_hash = crazyblog_set( $_COOKIE, 'crazyblog_form_builder_hash' );

		setcookie( 'crazyblog_form_builder_hash', $this->_hash );

		if ( function_exists( 'crazyblog_shortcode_setup' ) )
			crazyblog_shortcode_setup( 'crazyblog_form', array( $this, 'form' ) );
	}

	function form( $atts = '', $content = null ) {

		extract( shortcode_atts( array(
			'id' => '',
			'type' => '',
						), $atts ) );

		if ( !$id )
			return;

		$this->form_type = ($type) ? $type : '';
		$this->loops = array( 'select', 'checkbox', 'radio' );
		$this->labels = array( 'select' => 'dropdown', 'checkbox' => 'check', 'radio' => 'radio' );

		$this->build( $id );
	}

	private function build( $id ) {

		$this->meta = get_post_meta( $id, 'crazyblog_crazyblog_forms_meta', true ); //printr($this->meta);

		$this->id = $id;
		$fields = crazyblog_set( $this->meta, 'field' );

		if ( !$fields )
			return;

		$this->fields = $fields;
		$button_label = (crazyblog_set( $this->meta, 'button_label' )) ? crazyblog_set( $this->meta, 'button_label' ) : esc_html__( 'Submit', 'crazyblog' );
		$button_class = (crazyblog_set( $this->meta, 'button_class' )) ? crazyblog_set( $this->meta, 'button_class' ) : 'submit';

		echo $this->post();

		do_action( 'crazyblog_form_before_form' );
		$class = 'class="form-builder"';
		$action = admin_url( 'admin-ajax.php' ) . '?action=_crazyblog_ajax_callback&amp;subaction=crazyblog_form_builder';

		echo form_open( $action, $class . ' method="' . crazyblog_set( $this->meta, 'form_method', 'post' ) . '"' );
		echo '<div class="row">';

		foreach ( $this->fields as $i => $field ) {

			$this->type = $this->type( crazyblog_set( $field, 'type' ) );

			$this->build_field( $field );
		}

		echo '<input type="hidden" name="form_id" value="' . $this->id . '" />';

		echo '<input type="hidden" name="form_secret" value="' . $this->_hash . '" />';
		echo '<input type="hidden" name="form_id" value="' . $this->id . '" />';
		echo '<div class="col-md-12">' . form_submit( array( 'class' => $button_class ), $button_label ) . '</div>';
		echo '</div>';
		echo form_close();

		do_action( 'crazyblog_form_after_form' );
	}

	function build_field( $field, $label = true, $settings = array() ) {
		$fiel = $this->parse_field( $field );

		extract( $fiel );

		$class = ( isset( $class ) && $class ) ? $class : '';

		if ( $label ) {
			do_action( 'crazyblog_form_before_label', $field );

			//echo form_label( $label, $name,  $icon);

			do_action( 'crazyblog_form_after_label', $field );
		}

		if ( $placeholder ) {
			$settings['attrs']['placeholder'] = $placeholder;
		}

		$settings['attrs']['class'] = $class;
		$settings['attrs']['container_class'] = $container_class;

		$default = crazyblog_set( $settings, $name ) ? crazyblog_set( $settings, $name ) : $default;
		switch ( $this->type ) {
			case "password":
			case "input":
				$html['element'] = form_input( array_merge( array( 'label' => $label, 'name' => $name, 'type' => $type, 'value' => '', 'id' => $id ), (array) $settings['attrs'] ) );
				break;

			case "dropdown":
				$container_class = crazyblog_set( crazyblog_set( $settings, 'attrs' ), 'container_class' );
				$settings['attrs'] = _parse_form_attributes( '', array_merge( (array) $settings['attrs'], array( 'id' => $name ) ) );
				if ( $container_class ) {
					$html['element'] = '<div class="' . $container_class . '">' . form_dropdown( $name, $options, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'] ) . '</div>';
				} else {
					$html['element'] = form_dropdown( $name, $options, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'] );
				}
				break;

			case "multiselect":
				$size = (count( $settings['value'] ) < 10) ? count( $settings['value'] ) * 20 : 220;
				$settings['attrs'] = array_to_string( array_merge( (array) $settings['attrs'], array( 'id' => $field, 'style' => "height:" . $size . "px;" ) ) );
				$html['element'] = form_multiselect( $field . '[]', $settings['value'], crazyblog_Validation::get_instance()->set_value( $name, $default_value ), $settings['attrs'] );
				break;

			case "textarea":
				$settingsvalue = empty( $user_settings[$name] ) ? crazyblog_set( $settings, 'value' ) : $user_settings[$name];
				$html['element'] = form_textarea( array_merge( array( 'label' => $label, 'name' => $name, 'value' => crazyblog_Validation::get_instance()->set_value( $name, $settingsvalue ), 'id' => preg_replace( '/\s+/', '', $name ) ), (array) $settings['attrs'] ) );
				break;


			case "switch" :
				$html['element'] = '';

				$checked = (crazyblog_set( $user_settings, $field ) == 'on') ? 'checked="checked"' : '';
				$html['element'] = '<span class="form_style switch"><input type="checkbox" name="' . $field . '" ' . $checked . '></span>';


				break;
			case 'file':
				$html['element'] = '<span class="file_upload">';
				$html['element'] .= form_input( array_merge( array( 'name' => $field, 'value' => $default_value, 'id' => $field ), (array) $settings['attrs'] ) ) .
						'<input type="file" onchange="this.form.' . $field . '.value = this.value" class="fileUpload" name="' . $field . '_file" id="fileUpload">
									<em>' . esc_html__( 'UPLOAD', 'crazyblog' ) . '</em>';
				$html['element'] .= '</span>';
				$html['preview'] = '';
				if ( crazyblog_set( $user_settings, $field ) )
					$html['preview'] = crazyblog_set( $user_settings, $field );
				break;

			case "checkbox":
				$settings['attrs']['class'] = 'styled';
				$container_class = crazyblog_set( crazyblog_set( $settings, 'attrs' ), 'container_class' );
				$input_id = array();
				if ( !crazyblog_set( $field, 'id' ) )
					unset( $field['id'] );
				else
					$input_id = array( 'id' => $field['id'] );
				$settings['attrs'] = _parse_form_attributes( '', array_merge( (array) $settings['attrs'], $input_id ) );

				if ( $container_class ) {
					$html['element'] = '<div class="' . $container_class . '">';
					foreach ( $options as $k => $v ) {
						$html['element'] .=form_checkbox( $name, $k, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'], $v );
					}
					$html['element'] .='</div>';
				} else {
					$html['element'] = '';
					foreach ( $options as $k => $v ) {
						$html['element'] .= form_checkbox( $name, $k, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'], $v );
					}
				}
				break;
			case "radio":
				$settings['attrs']['class'] = 'styled';
				$container_class = crazyblog_set( crazyblog_set( $settings, 'attrs' ), 'container_class' );
				$input_id = array();
				if ( !crazyblog_set( $field, 'id' ) )
					unset( $field['id'] );
				else
					$input_id = array( 'id' => $field['id'] );
				$settings['attrs'] = _parse_form_attributes( '', array_merge( (array) $settings['attrs'], $input_id ) );

				if ( $container_class ) {
					$html['element'] = '<div class="' . $container_class . '">';
					foreach ( $options as $k => $v ) {
						$html['element'] .=form_radio( $name, $k, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'], $v );
					}
					$html['element'] .='</div>';
				} else {
					$html['element'] = '';
					foreach ( $options as $k => $v ) {
						$html['element'] .= form_radio( $name, $k, crazyblog_Validation::get_instance()->set_value( $name, $default ), $settings['attrs'], $v );
					}
				}
				break;

			case "colorbox":
				$html['element'] = form_input( array_merge( array( 'name' => $field, 'value' => $default_value, 'id' => $field, 'class' => 'nuke-color-field' ), (array) $settings['attrs'] ) );
				break;

			case "timepicker":
				$html['element'] = form_input( array_merge( array( 'name' => $field, 'value' => $default_value, 'id' => $field ), (array) $settings['attrs'] ) );
				break;

			case "hidden":
				$html['label'] = '';
				$html['element'] = form_input( array_merge( array( 'type' => 'hidden', 'name' => $field, 'value' => $default_value, 'id' => $field ), crazyblog_set( $settings, 'attrs' ) ) );
				break;
		}

		do_action( 'crazyblog_form_before_field', $fiel );

		echo $html['element'];

		do_action( 'crazyblog_form_after_field', $fiel );
	}

	/**
	 * return the array to generate form field
	 *
	 */
	private function parse_field( $field ) {
		$default = array( 'name', 'label', 'icon', 'type', 'settings', 'class', 'container_class', 'default', 'placeholder', 'id' );

		$new = array();

		foreach ( $default as $d ) {
			$new[$d] = crazyblog_set( $field, $d );
		}

		$new = $this->options( $new, $field );

		return $new;
	}

	/**
	 * return options array for select, checkbox and radio button
	 *
	 */
	private function options( $new = array(), $field ) {

		$type = $new['type'];

		$loop = crazyblog_set( $field, $type . '_value' );

		if ( in_array( $type, $this->loops ) ) {

			$label = crazyblog_set( $this->labels, $type );

			foreach ( $loop as $l ) {
				$new['options'][crazyblog_set( $l, $label . '_value' )] = crazyblog_set( $l, $label . '_label' );
			}
		}
		return $new;
	}

	private function type( $type ) {
		$array = array(
			'text' => 'input',
			'email' => 'input',
			'url' => 'input',
			'select' => 'dropdown'
		);

		return crazyblog_set( $array, $type, $type );
	}

	function post() {

		if ( !$_POST )
			return;

		if ( isset( $_POST['form_id'] ) ) {
			$this->meta = get_post_meta( $_POST['form_id'], 'crazyblog_crazyblog_forms_meta', true );
			$this->id = $_POST['form_id'];
			$fields = crazyblog_set( $this->meta, 'field' );

			if ( !$fields )
				return;

			$this->fields = $fields;
		}



		$settings = get_option( 'crazyblog' . '_theme_options' );

		$message = '';
		//printr($this->fields);
		foreach ( $this->fields as $f ) {
			$field_name = crazyblog_set( $f, 'name' );

			$validation = array();

			$placehold = crazyblog_set( $f, 'placeholder' );

			if ( crazyblog_set( $f, 'validation' ) ) {
				foreach ( crazyblog_set( $f, 'validation' ) as $valid )
					$validation[] = $valid;
			}

			/** set validation rules for contact form */
			crazyblog_Validation::get_instance()->set_rules( $field_name, '<strong>' . crazyblog_set( $f, 'placeholder' ) . '</strong>', implode( '|', $validation ) );

			$message .= "$placehold\t" . crazyblog_Validation::get_instance()->post( $field_name ) . ":" . crazyblog_set( $_POST, $field_name ) . "\r\n";
		}


		if ( crazyblog_Validation::get_instance()->run() !== FALSE && empty( crazyblog_Validation::get_instance()->_error_array ) ) {
			if ( !class_exists( 'PHPMailer' ) )
				include(ABSPATH . 'wp-includes/class-phpmailer.php');

			if ( crazyblog_set( $_POST, 'member' ) ) {
				$meta = get_post_meta( crazyblog_set( $_POST, 'member' ), 'crazyblog_team_meta', true );
				$page_option = crazyblog_set( crazyblog_set( $meta, 'crazyblog_page_options' ), 0 );
				$contact_to = (crazyblog_set( $page_option, 'email' )) ? crazyblog_set( $page_option, 'email' ) : get_option( 'admin_email' );
			} else {

				$contact_to = (crazyblog_set( $this->meta, 'form_email' )) ? crazyblog_set( $this->meta, 'form_email' ) : get_option( 'admin_email' );
			}

			$headers = 'From: ' . get_option( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
			wp_mail( $contact_to, sprintf( esc_html__( '%s - Form Submitted', 'crazyblog' ), get_the_title( $this->id ) ), $message, $headers );

			$response = crazyblog_set( $this->meta, 'form_success_msg' ) ? $this->meta['form_success_msg'] : sprintf( esc_html__( 'Form is successfully submitted, we\'ll response you shortly.', 'crazyblog' ), $field_name );

			return "<div class=\"alert alert-success\">" .
					"<strong>" . esc_html__( "Successful! ", 'crazyblog' ) . "</strong>" .
					$response .
					"</div>";
		} else {
			$messages = '';
			if ( is_array( crazyblog_Validation::get_instance()->_error_array ) ) {
				foreach ( crazyblog_Validation::get_instance()->_error_array as $msg ) {
					$messages .= '<div class="alert alert-danger">' . esc_html__( 'Error! ', 'crazyblog' ) . $msg . '</div>';
				}
			}

			return $messages;
		}

		return '';
	}

	static public function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
