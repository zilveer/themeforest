<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Datepicker
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_datepicker extends CSFramework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output(){

		$uni        = uniqid();

		echo $this->element_before();
		echo '<input id="ult-date-time' . $uni . '" type="'. $this->element_type() .'" name="'. $this->element_name() .'" value="'. $this->element_value() .'"'. $this->element_class() . $this->element_attributes() .'/>';
		echo $this->element_after();

		ob_start();?>
		<script type="text/javascript">
		             jQuery(document).ready(function () {
			             jQuery("#ult-date-time<?php echo esc_attr($uni) ;?>").datepicker({
						dateFormat: 'dd-MM-yy'
					});
				})
			</script>
		<?php echo ob_get_clean();

	}

}
