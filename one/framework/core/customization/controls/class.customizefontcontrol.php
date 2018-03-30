<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer font control class.
 *
 * This class is entitled to manage the theme customizer font controls.
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
if( ! class_exists('THB_CustomizeFontControl') ) {
	class THB_CustomizeFontControl extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'font';

		/**
		 * Render the control.
		 */
		public function render_content() {
			?>
			<label>
				<?php if ( $this->label != '' ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php
					$link = str_replace( '"', '', $this->get_link() );
					$attrs = explode( '=', $link );
					thb_input_select_fonts( '', $this->value(), array( $attrs[0] => $attrs[1] ) );
				?>
			</label>
			<?php
		}

	}
}