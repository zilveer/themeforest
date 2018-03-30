<?php
/**
 * Ionicons
 *
 * @since 1.5.0
 * @package Listify
 * @category Customizer
 */
class 
	Listify_Customizer_Icon_Source_Ionicons
extends 
	Listify_Customizer_Icon_Source {

	/**
	 * Ionicons
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		parent::__construct( 'ionicons', __( 'Ionicons', 'listify' ) );
	}

}
