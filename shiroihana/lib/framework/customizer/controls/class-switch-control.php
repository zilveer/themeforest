<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Switch Control
 *
 * This class adds an iOS switch control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Switch_Control extends WP_Customize_Control {

	public $type = 'youxi_switch';

	public $disabled = false;

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style( 'switchery', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/switchery/switchery{$suffix}.css", 
			array(), '0.8.1', 'screen'
		);
		wp_enqueue_script( 'switchery',
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/switchery/switchery{$suffix}.js", 
			array(), '0.8.1', true
		);
		wp_enqueue_script( 'youxi-switch-control', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/switch-control.js", 
			array( 'switchery' ), YOUXI_CUSTOMIZER_VERSION, true
		);
	}

	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
			<input type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); disabled( $this->disabled, true ) ?>>
		</label>
		<?php
	}
}