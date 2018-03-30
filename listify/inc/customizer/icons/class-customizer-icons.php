<?php
/**
 * Icon management
 *
 * @since 1.0.0
 */
class 
	Listify_Customizer_Icons 
extends 
	Listify_Customizer_SourceLoader {

	/**
	 * Listify_Customize_Icons constructor
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		$this->files = array(
			'icons/class-customizer-icon-source.php',
			'icons/class-customizer-icon-source-ionicons.php'
		);

		parent::__construct();

		$this->add_source( 'ionicons', new Listify_Customizer_Icon_Source_Ionicons() );
	}

}
