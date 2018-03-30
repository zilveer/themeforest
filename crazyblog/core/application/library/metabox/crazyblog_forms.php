<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_crazyblog_forms_Meta {

	static public $options = array();
	static public $title = 'Form Options';
	static public $type = array( 'crazyblog_forms' );
	static public $priority = 'high';

	static public function init() {

		self::$options = array(
			array(
				'type' => 'textbox',
				'name' => 'form_email',
				'label' => esc_html__( 'Reciever Email', 'crazyblog' ),
				'default' => '',
				'description' => esc_html__( 'Enter the email address of receiver to send the form submission detail', 'crazyblog' )
			),
			array(
				'type' => 'textarea',
				'name' => 'form_success_msg',
				'label' => esc_html__( 'Success Message', 'crazyblog' ),
				'default' => '',
				'description' => esc_html__( 'Enter the message to show after successful submission of the form', 'crazyblog' )
			),
			array(
				'type' => 'textbox',
				'name' => 'button_label',
				'label' => esc_html__( 'Button Label', 'crazyblog' ),
				'default' => '',
				'description' => esc_html__( 'Enter the form submit button label', 'crazyblog' )
			),
			array(
				'type' => 'textbox',
				'name' => 'button_class',
				'label' => esc_html__( 'Button Class', 'crazyblog' ),
				'default' => '',
				'description' => esc_html__( 'Enter the form submit button class', 'crazyblog' )
			),
			array(
				'type' => 'group',
				'repeating' => true,
				'sortable' => true,
				'name' => 'field',
				'title' => esc_html__( 'Field', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'select',
						'name' => 'type',
						'label' => esc_html__( 'Field Type', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'text', 'label' => esc_html__( 'Text Input', 'crazyblog' ) ),
							array( 'value' => 'password', 'label' => esc_html__( 'Password', 'crazyblog' ) ),
							array( 'value' => 'email', 'label' => esc_html__( 'Email', 'crazyblog' ) ),
							array( 'value' => 'url', 'label' => esc_html__( 'URL', 'crazyblog' ) ),
							array( 'value' => 'select', 'label' => esc_html__( 'Dropdown', 'crazyblog' ) ),
							array( 'value' => 'checkbox', 'label' => esc_html__( 'Checkbox', 'crazyblog' ) ),
							array( 'value' => 'radio', 'label' => esc_html__( 'Radio Button', 'crazyblog' ) ),
							array( 'value' => 'textarea', 'label' => esc_html__( 'Textarea', 'crazyblog' ) ),
							array( 'value' => 'hiddentextbox', 'label' => esc_html__( 'Hidden Input', 'crazyblog' ) ),
						),
						'default' => 'text',
					),
					array(
						'type' => 'group',
						'repeating' => true,
						'sortable' => true,
						'name' => 'select_value',
						'title' => esc_html__( 'Dropdown Values', 'crazyblog' ),
						'dependency' => array(
							'field' => 'type',
							'function' => 'crazyblog_dep_pb_dropdown',
						),
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'dropdown_value',
								'label' => esc_html__( 'Value', 'crazyblog' ),
								'default' => 'option1',
							),
							array(
								'type' => 'textbox',
								'name' => 'dropdown_label',
								'label' => esc_html__( 'Label', 'crazyblog' ),
								'default' => 'Value1',
							),
						),
					),
					array(
						'type' => 'group',
						'repeating' => true,
						'sortable' => true,
						'name' => 'checkbox_value',
						'title' => esc_html__( 'Checkbox Values', 'crazyblog' ),
						'dependency' => array(
							'field' => 'type',
							'function' => 'crazyblog_dep_pb_checkbox',
						),
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'check_value',
								'label' => esc_html__( 'Value', 'crazyblog' ),
								'default' => 'option1',
							),
							array(
								'type' => 'textbox',
								'name' => 'check_label',
								'label' => esc_html__( 'Label', 'crazyblog' ),
								'default' => 'Value1',
							),
						),
					),
					array(
						'type' => 'group',
						'repeating' => true,
						'sortable' => true,
						'name' => 'radio_value',
						'title' => esc_html__( 'Radio Values', 'crazyblog' ),
						'dependency' => array(
							'field' => 'type',
							'function' => 'crazyblog_dep_pb_radio',
						),
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'radio_value',
								'label' => esc_html__( 'Value', 'crazyblog' ),
								'default' => 'option1',
							),
							array(
								'type' => 'textbox',
								'name' => 'radio_label',
								'label' => esc_html__( 'Label', 'crazyblog' ),
								'default' => 'Value1',
							),
						),
					),
					array(
						'type' => 'checkbox',
						'name' => 'validation',
						'label' => esc_html__( 'Validation', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'required', 'label' => esc_html__( 'Required', 'crazyblog' ) ),
							array( 'value' => 'alphabet', 'label' => esc_html__( 'Alphabetic', 'crazyblog' ) ),
							array( 'value' => 'alphanumeric', 'label' => esc_html__( 'Alphanumeric', 'crazyblog' ) ),
							array( 'value' => 'numeric', 'label' => esc_html__( 'Numeric', 'crazyblog' ) ),
							array( 'value' => 'valid_email', 'label' => esc_html__( 'Email', 'crazyblog' ) ),
							array( 'value' => 'url', 'label' => esc_html__( 'URL', 'crazyblog' ) ),
						),
						'default' => 'text',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Field Name', 'crazyblog' ),
						'name' => 'name',
						'validation' => '',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Field Label', 'crazyblog' ),
						'name' => 'label',
						'validation' => '',
					),
					array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => esc_html__( 'Label Icon', 'crazyblog' ),
						'default' => ''
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Default Value', 'crazyblog' ),
						'name' => 'default',
						'validation' => '',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Placeholder', 'crazyblog' ),
						'name' => 'placeholder',
						'validation' => '',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Class Attribute', 'crazyblog' ),
						'name' => 'class',
						'validation' => '',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'Field Container Class Attribute', 'crazyblog' ),
						'name' => 'container_class',
						'validation' => '',
					),
					array(
						'type' => 'textbox',
						'label' => esc_html__( 'id Attribute', 'crazyblog' ),
						'name' => 'id',
						'validation' => '',
					),
				),
			),
		);



		return apply_filters( 'crazyblog_extend_crazyblog_forms_meta_', self::$options );
	}

}
