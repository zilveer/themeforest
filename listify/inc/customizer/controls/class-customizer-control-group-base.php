<?php
/**
 * Control Group
 *
 * A single control that updates multiple
 *
 * @since Listify 1.3.0
 */
class 
	Listify_Customize_Control_ControlGroup 
extends 
	WP_Customize_Control {

	/**
	 * @var $type
	 * @access public
	 */
    public $type = 'ControlGroup';

	/**
	 * @var array $group
	 * @access public
	 */
	public $group;

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		// clean up map, which isn't a group contorl, but is a color scheme
		if ( 'map-appearance-scheme' == $id ) {
			global $listif_job_manager;

			$id = 'map-color-scheme';
		}

		if ( ! $this->group ) {
			$this->group = listify_get_control_group( $id );
		}
	}

	/**
	 * Enqueue additional scripts
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'listify-controlgroup', get_template_directory_uri() . '/inc/customizer/assets/js/controls/controlgroup.js', array( 'jquery', 'customize-controls' ), 20160811 );
	}

	/**
	 * Output the control HTML
	 *
	 * @since 1.3.0
	 * @return void
	 */
    public function render_content() {
        $name = '_customize-radio-' . $this->id;
?>

<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

<?php foreach ( $this->group as $group_id => $group_data ) : ?>

	<p>
		<label>
			<input <?php $this->link(); ?> name="<?php echo esc_attr( $name ); ?>" value="<?php echo $group_id; ?>" type="radio" <?php echo $this->generate_group_data( $group_data[ 'controls' ] ); ?> <?php checked( $group_id, sanitize_title( $this->value() ) ); ?> />
			<span class="label"><?php echo esc_attr( $group_data[ 'title' ] ); ?></span>
		</label>
	</p>

<?php endforeach; ?>

<?php if ( $this->description ) : ?>
	<p><?php echo $this->description; ?></p>
<?php endif; ?>

<?php
    }

	/**
	 * Using the group data generate the the data attribute linking
	 * the rest of the controls to this one.
	 *
	 * @since 1.0.0
	 * @param array $group_items
	 * @return string
	 */
    public function generate_group_data( $group_items ) {
        $output = array();

        foreach ( $group_items as $key => $value ) {
            $output[ $key ] = $value;
        }

        return "data-controls='" . json_encode( $output )  . "'";
    }

}
