<?php
/**
 * Control Group
 *
 * A single control that updates multiple
 *
 * @since Listify 1.5.0
 */
class 
	Listify_Customize_Control_BigChoices
extends 
	WP_Customize_Control {

	/**
	 * @var $type
	 * @access public
	 */
    public $type = 'BigChoices';

	/**
	 * @var array $choices
	 * @access public
	 */
	public $choices;

	public function __construct( $manager, $id, $args = array() ) {
		$this->choices = $args[ 'choices' ];

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ), 5 );

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Send the choices we want to use to the JS
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json[ 'choices' ] = $this->choices;
	}

	/**
	 * Add a filter to the listify_customizer_scripts
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function customizer_scripts() {
		add_filter( 'listify_customizer_scripts', array( $this, 'set_big_choices' ) );
	}

	/**
	 * Set the BigChoices in the listifyCustomizer JS object
	 *
	 * This should be more dynamic on a per-control basis or ane extended class.
	 *
	 * @since 1.5.0
	 * @param array $data
	 * @return array $data
	 */
	public function set_big_choices( $data ) {
		if ( isset( $data[ 'BigChoices' ] ) && ! isset( $data[ 'BigChoices' ][ $this->choices ] ) ) {
			$what = $this->choices;

			$data[ 'BigChoices' ][ $this->choices ] = Listify_Customizer::$$what->get_item_choices( null, false );
		}

		return $data;
	}

	/**
	 * Enqueue additional scripts
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'listify-bigchoices', get_template_directory_uri() . '/inc/customizer/assets/js/controls/bigchoices.js', array( 'jquery', 'listify-select2', 'customize-controls' ) );
		wp_enqueue_style( 'listify-select2-customizer' );
	}

	/**
	 * Output the control HTML
	 *
	 * @since 1.5.0
	 * @return void
	 */
    public function render_content() {
?>

<label>
	<?php if ( ! empty( $this->label ) ) : ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<?php endif;
	if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
	<?php endif; ?>

	<select <?php $this->link(); ?>>
		<option selected="selected"><?php _e( 'Loading...', 'listify' ); ?></option>
	</select>
</label>
<?php
    }

}
