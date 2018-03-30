<?php
/**
 * Description Control
 *
 * @uses WP_Customize_Control
 * @since Listify 1.5.0
 */
class Listify_Customize_Control_Description extends WP_Customize_Control {

	/**
	 * @var string $type
	 */
	public $type = 'description';

	/**
	 * Output the control HTML
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public function render_content() {
		echo '<p>' . wp_kses_post( $this->label ) . '</p>';
	}

}
