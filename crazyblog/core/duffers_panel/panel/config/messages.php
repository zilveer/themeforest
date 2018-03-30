<?php

return array(
	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet' => esc_html__( 'Value needs to be Alphabet', 'crazyblog' ),
		'alphanumeric' => esc_html__( 'Value needs to be Alphanumeric', 'crazyblog' ),
		'numeric' => esc_html__( 'Value needs to be Numeric', 'crazyblog' ),
		'email' => esc_html__( 'Value needs to be Valid Email', 'crazyblog' ),
		'url' => esc_html__( 'Value needs to be Valid URL', 'crazyblog' ),
		'maxlength' => esc_html__( 'Length needs to be less than {0} characters', 'crazyblog' ),
		'minlength' => esc_html__( 'Length needs to be more than {0} characters', 'crazyblog' ),
		'maxselected' => esc_html__( 'Select no more than {0} items', 'crazyblog' ),
		'minselected' => esc_html__( 'Select at least {0} items', 'crazyblog' ),
		'required' => esc_html__( 'This is required', 'crazyblog' ),
	),
	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success' => esc_html__( 'Import succeed, option page will be refreshed..', 'crazyblog' ),
		'import_failed' => esc_html__( 'Import failed', 'crazyblog' ),
		'export_success' => esc_html__( 'Export succeed, copy the JSON formatted options', 'crazyblog' ),
		'export_failed' => esc_html__( 'Export failed', 'crazyblog' ),
		'restore_success' => esc_html__( 'Restoration succeed, option page will be refreshed..', 'crazyblog' ),
		'restore_nochanges' => esc_html__( 'Options identical to default', 'crazyblog' ),
		'restore_failed' => esc_html__( 'Restoration failed', 'crazyblog' ),
	),
	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => esc_html__( 'Select option(s)', 'crazyblog' ),
		// fontawesome chooser
		'fac_placeholder' => esc_html__( 'Select an Icon', 'crazyblog' ),
	),
);

/**
 * EOF
 */