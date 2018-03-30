<?php
/**
 * Multiselect
 *
 * A select box that can contain multiple selections.
 *
 * @since Listify 1.5.0
 */
class 
	Listify_Customize_Control_Multiselect
extends 
	WP_Customize_Control {

	/**
	 * @var string $type
	 * @access public
	 */
	public $type = 'multiselect';

	public function to_json() {
		parent::to_json();

		$this->json[ 'selection' ] = $this->get_saved_value();
	}

	/**
	 * Output the control HTML
	 *
	 * @since 1.5.0
	 * @return void
	 */
    public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		$saved_value = $this->get_saved_value();
?>

<label>
	<?php if ( ! empty( $this->label ) ) : ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<?php endif;
	if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
	<?php endif; ?>

	<select <?php $this->link(); ?> multiple>
		<?php
		foreach ( $this->choices as $value => $label ) {
			echo '<option value="' . esc_attr( $value ) . '"' . selected( false !== array_search( $value, $saved_value ), true, false ) . '>' . $label . '</option>';
		}
		?>
	</select>
</label>

<?php
    }

	/**
	 * Before this control was available some things were saved in comma
	 * separated lists. This converts it in to an array.
	 *
	 * @since 1.5.0
	 * @return array
	 */
	public function get_saved_value() {
		$saved_value = $this->value();

		if ( ! is_array( $this->value() ) ) {
			$saved_value = array_map( 'trim', explode( ',', $this->value() ) );
		}

		return $saved_value;
	}
}
