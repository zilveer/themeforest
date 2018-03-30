<?php

class Listify_WP_Job_Manager_Business_Hours extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager';

		parent::__construct();
	}

	public function setup_actions() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// save [front, back]
		add_action( 'job_manager_update_job_data', array( $this, 'job_manager_update_job_data' ), 10, 2 );
		add_action( 'job_manager_save_job_listing', array( $this, 'job_manager_update_job_data' ), 10, 2 );

		// add to frontend
		add_filter( 'submit_job_form_fields', array( $this, 'submit_job_form_fields' ) );
	
		// custom input
		add_action( 'job_manager_input_business_hours', array( $this, 'job_manager_input_business_hours' ), 10, 2 );
		
		// get current value
		add_filter( 'submit_job_form_fields_get_job_data', array( $this, 'get_job_data' ), 10, 2 );

		// output in admin
		add_action( 'listify_writepanels_business_hours', array( $this, 'output_admin' ) );
	}

	public function admin_enqueue_scripts() {
		global $pagenow;

		if ( ! ( in_array( $pagenow, array( 'post-new.php', 'post.php'  )) && get_post_type() == 'job_listing' ) ) {
			return;
		}

		wp_enqueue_script( 'timepicker', listify_Integration::get_url() . 'js/vendor/jquery.timepicker.min.js' );
		wp_enqueue_style( 'timepicker', get_template_directory_uri() . '/css/vendor/jquery.timepicker.css' );
	}

	public function submit_job_form_fields( $fields ) {
		$fields[ 'job' ][ 'job_hours' ] = array(
			'label'       => __( 'Hours of Operation', 'listify' ),
			'type'        => 'business-hours',
			'required'    => false,
			'placeholder' => '',
			'priority'    => 4.9,
			'default'     => ''
		);

		return $fields;
	}

	public function job_manager_update_job_data( $job_id, $values ) {
		if ( ! isset( $_POST[ 'job_hours' ] ) ) {
			return;
		}

		update_post_meta( $job_id, '_job_hours', stripslashes_deep( $_POST[ 'job_hours' ] ) );
	}

	public function get_job_data( $fields, $job ) {
		$hours = get_post_meta( $job->ID, '_job_hours', true );

		if ( ! $hours ) {
			return $fields;
		}

		$fields[ 'job' ][ 'job_hours' ][ 'value' ] = $hours;
		
		return $fields;
	}

	public function job_manager_input_business_hours( $key, $field ) {
		global $wp_locale, $post, $thepostid;

		$thepostid = $post->ID;
	?>

	<div class="form-field" style="position: relative;">

		<?php if ( ! is_admin() ) : ?>
		<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) ; ?>:</label>
		<?php endif; ?>

		<?php
			global $field;

			if ( empty( $field[ 'value' ] ) ) {
				$field[ 'value' ] = get_post_meta( $thepostid, '_job_hours', true );
			}

			get_job_manager_template( 'form-fields/business-hours-field.php' );
		?>

		<script>
			(function($) {
				$( '.timepicker' ).timepicker({
					timeFormat: '<?php echo str_replace( '\\', '\\\\', get_option( 'time_format' ) ); ?>',
					noneOption: {
						label: '<?php _e( 'Closed', 'listify' ); ?>',
						value: '<?php _e( 'Closed', 'listify' ); ?>' 
					}
				});
			})(jQuery);
		</script>

	</div>

	<?php
	}

	public function output_admin() {
		do_action( 'job_manager_input_business_hours', '_job_hours', array(
			'label' => __( 'Hours of Operation', 'listify' ),
			'type' => 'business_hours',
			'placeholder' => '',
			'priority' => 99
		) );
	}
}
