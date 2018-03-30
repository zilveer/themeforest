<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Range Control
 *
 * This class adds an jQuery UI slider control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Range_Control extends WP_Customize_Control {

	public $type = 'youxi_range';

	public $min = 0;

	public $max = 100;

	public $step = 1;

	public function to_json() {
		parent::to_json();
		$this->json['ui'] = array(
			'min' => $this->min, 
			'max' => $this->max, 
			'step' => $this->step
		);
	}

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_style_is( 'youxi-range-control' ) ) {
			wp_enqueue_style( 'youxi-range-control', 
				get_template_directory_uri() . '/lib/framework/customizer/controls/assets/css/range-control.css', 
				array(), YOUXI_CUSTOMIZER_VERSION, 'screen'
			);
		}

		if( ! wp_script_is( 'youxi-range-control' ) ) {
			wp_enqueue_script( 'youxi-range-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/range-control{$suffix}.js", 
				array( 'jquery-ui-slider' ), YOUXI_CUSTOMIZER_VERSION, true
			);
		}
	}

	public function render_content() {
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<input type="text" readonly value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>>
		<div class="youxi-range-control"></div>
		<?php
	}
}