<?php
$atts = apply_filters( 'job_manager_ouput_jobs_defaut', array( 
    'per_page' => get_option( 'job_manager_per_page' ),
    'orderby' => 'featured',
    'order' => 'DESC',
    'show_categories' => true,
    'categories' => true,
    'selected_category' => false,
    'job_types' => false,
    'location' => false,
    'keywords' => false,
    'selected_job_types' => false,
    'show_category_multiselect' => false,
	'selected_region' => false,
	'flat' => true
) );
?>

<?php do_action( 'job_manager_job_filters_before', $atts ); ?>

<form class="job_search_form" action="<?php echo get_post_type_archive_link( 'job_listing' ); ?>" method="GET">
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

	<div class="search_jobs">
		<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

		<div class="search_keywords">
			<label for="search_keywords"><?php _e( 'Keywords', 'listify' ); ?></label>
            <input type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'What are you looking for?', 'listify' ); ?>" />
		</div>

		<div class="search_location">
			<label for="search_location"><?php _e( 'Location', 'listify' ); ?></label>
			<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'listify' ); ?>" />
		</div>

        <?php if ( get_option( 'job_manager_enable_categories' ) ) : ?>

        <div class="search_categories">
            <label for="search_categories"><?php _e( 'Category', 'listify' ); ?></label>
            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'All categories', 'listify' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
        </div>

        <?php endif; ?>

		<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
	</div>

	<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
</form>

<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>
