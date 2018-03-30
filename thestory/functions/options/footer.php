<?php
/**
 * This file contains the instructions for the documentation and support
 * within the Options panel.
 */

$pexeto_general_options= array( array(
		'name' => 'Footer Settings',
		'type' => 'title',
		'img' => ' icon-footer'
	),

	array(
		'type' => 'open',
		'subtitles'=>array( array( 'id'=>'general', 'name'=>'General' ) )
	),

	/* ------------------------------------------------------------------------*
	 * FOOTER GENERAL SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'general'
	),


	array(
		'name' => 'Footer Layout',
		'id' => 'footer_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'4', 'name'=>'Four columns' ), 
			array( 'id'=>'3', 'name'=>'Three columns' ), 
			array( 'id'=>'2', 'name'=>'Two columns' ), 
			array( 'id'=>'1', 'name'=>'One column' ), 
			array( 'id'=>'no-footer', 'name'=>'No widgetized footer' ) ),
		'std' => '4'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Call to action section</h3>'
	),

	array(
		'name' => 'Show call to action section above footer columns',
		'id' => 'show_ca',
		'type' => 'checkbox',
		'std' => false
	),

	array(
		'name' => 'Use texts for this section from translated PO file(s)',
		'id' => 'ca_use_po',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'If enabled, you can set the "Call to action" section texts
		within the provided .po/.mo file for translation. This option should be
		enabled when multiple languages are set to the site. When this option
		is disabled, the texts set in the fields below will be used.'
	),

	array(
		'name' => 'Title',
		'id' => 'ca_title',
		'type' => 'text'
	),

	array(
		'name' => 'Description',
		'id' => 'ca_desc',
		'type' => 'textarea'
	),

	array(
		'name' => 'Button text',
		'id' => 'ca_btn_text',
		'type' => 'text'
	),

	array(
		'name' => 'Button link',
		'id' => 'ca_btn_link',
		'type' => 'text'
	),

	array(
		'name' => 'Open link in',
		'id' => 'ca_btn_link_open',
		'type' => 'select',
		'options' => array(
			array('id'=>'same', 'name'=>'Same tab / window'), 
			array('id'=>'new', 'name'=>'New tab / window')
		),
		'std' => 'same'
	),


	array(
		'type' => 'documentation',
		'text' => '<h3>Copyright Section</h3>'
	),

	array(
		'name' => 'Content',
		'id' => 'footer_copyright',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'copyright', 'name'=>'Default Copyright Text' ), 
			array( 'id'=>'custom', 'name'=>'Custom Text' )),
		'std' => 'copyright'
	),

	array(
		'name' => 'Custom Text',
		'id' => 'footer_copyright_text',
		'type' => 'text',
		'desc' => 'Select the "Custom Text" option in the "Content" field above 
		if you would like to set a custom text in the copyright section.'
	),


	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_general_options );
