<?php
/**
 * The template for displaying the WP Job Manager frontend listing submission form
 *
 * @package Listable
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $job_manager;
?>

<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">

	<?php if ( apply_filters( 'submit_job_form_show_signin', true ) ) : ?>

		<?php get_job_manager_template( 'account-signin.php' ); ?>

	<?php endif; ?>

	<?php if ( job_manager_user_can_post_job() ) : ?>

		<!-- Job Information Fields -->
		<?php do_action( 'submit_job_form_job_fields_start' );

		$all_fields = $job_fields;
		if ( $company_fields ) {
			$all_fields = $job_fields + $company_fields;
		}

		uasort( $all_fields, 'listable_sort_array_by_priority' ); ?>

		<?php foreach ( $all_fields as $key => $field ) : ?>
			<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
				<label for="<?php echo esc_attr( $key ); ?>">
					<?php
					if ( isset( $field['label'] ) ) {
						echo $field['label'];
					}

					echo apply_filters( 'submit_job_form_required_label', (isset($field['required'])&&$field['required']) ? '' : ' <small>' . esc_html__( '(optional)', 'listable' ) . '</small>', $field );
					?>
				</label>
				<div class="field <?php echo ( isset($field['required']) && $field['required'] ) ? 'required-field' : ''; ?>">
					<?php
					if ( isset( $field['type'] ) ) {
						get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) );
					} ?>
				</div>
			</fieldset>
		<?php endforeach; ?>

		<?php do_action( 'submit_job_form_job_fields_end' ); ?>

		<!-- Company Information Fields -->
		<?php if ( $company_fields ) : ?>
			<?php do_action( 'submit_job_form_company_fields_start' ); ?>
			<?php do_action( 'submit_job_form_company_fields_end' ); ?>
		<?php endif; ?>

		<p>
			<input type="hidden" name="job_manager_form" value="<?php echo $form; ?>" />
			<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
			<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
			<input type="submit" name="submit_job" class="button" value="<?php echo esc_attr( $submit_button_text ); ?>" />
		</p>

	<?php else : ?>

		<?php do_action( 'submit_job_form_disabled' ); ?>

	<?php endif; ?>
</form>