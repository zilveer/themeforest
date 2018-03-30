<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Code Control
 *
 * This class adds a CSS/JS code editor to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Code_Control extends WP_Customize_Control {

	public $type = 'youxi_code';

	public $mode = 'css';

	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );

		if( ! in_array( $this->mode, array( 'css', 'javascript' ) ) ) {
			$this->mode = 'css';
		}
	}

	public function to_json() {
		parent::to_json();
		$this->json['mode'] = $this->mode;
	}

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'codemirror', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/codemirror/codemirror{$suffix}.js", 
			array(), '5.14.2', true
		);

		if( 'javascript' == $this->mode ) {

			wp_enqueue_script( 'codemirror-javascript', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/codemirror/mode/javascript{$suffix}.js", 
				array( 'codemirror' ), '5.14.2', true
			);
			
		} elseif( 'css' == $this->mode ) {
			
			wp_enqueue_script( 'codemirror-css', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/codemirror/mode/css{$suffix}.js", 
				array( 'codemirror' ), '5.14.2', true
			);
		}

		wp_enqueue_style( 'codemirror', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/codemirror/codemirror.css", 
			array(), '5.14.2'
		);

		wp_enqueue_script( 'youxi-code-control', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/code-control{$suffix}.js", 
			array(), YOUXI_CUSTOMIZER_VERSION, true
		);
	}

	public function render_content() {
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<textarea rows="5" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		<?php
	}
}