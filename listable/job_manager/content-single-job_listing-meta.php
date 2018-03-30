<?php
/**
 * Single view Job meta box
 *
 * Hooked into single_job_listing_start priority 20
 *
 * @since  1.14.0
 */

global $post;

return ; // nothing for now

do_action( 'single_job_listing_meta_before' ); ?>

<ul class="meta">
	<?php do_action( 'single_job_listing_meta_start' ); ?>

	<li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>" itemprop="employmentType"><?php the_job_type(); ?></li>

	<li class="location" itemprop="jobLocation"><?php the_job_location(); ?></li>

	<li class="date-posted" itemprop="datePosted"><date><?php printf( esc_html__( 'Posted %s ago', 'listable' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>

	<?php if ( is_position_filled() ) : ?>
		<li class="position-filled"><?php esc_html_e( 'This position has been filled', 'listable' ); ?></li>
	<?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
		<li class="listing-expired"><?php esc_html_e( 'Applications have closed', 'listable' ); ?></li>
	<?php endif; ?>

	<?php do_action( 'single_job_listing_meta_end' ); ?>
</ul>

<?php do_action( 'single_job_listing_meta_after' ); ?>