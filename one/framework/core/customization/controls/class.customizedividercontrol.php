<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer divider control class.
 *
 * This class is entitled to manage the theme customizer divider controls.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( ! class_exists('THB_CustomizeDividerControl') ) {
	class THB_CustomizeDividerControl extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'divider';

		/**
		 * Render the control.
		 */
		public function render_content() {
			?>
			<div class="customize-control-divider">
				<span class="thb-section-label"><?php echo esc_html( $this->label ); ?></span>
				<span class="thb-divider"></span>
			</div>
			<?php
		}

	}
}