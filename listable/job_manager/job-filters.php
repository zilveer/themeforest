<?php
/**
 * The template for displaying the WP Job Manager Filters
 *
 * @package Listable
 */

if ( listable_using_facetwp() ) : ?>

	<div class="job_filters">
		<div class="search_jobs">

			<?php
			$facets            = listable_get_facets_by_area( 'listings_archive_visible' );
			$hidden_facets     = listable_get_facets_by_area( 'listings_archive_hidden' );
			$navigation_facets = listable_get_facets_by_area( 'navigation_bar' );

			//$all_facets = listable_get_all_facets();

			if ( ! empty( $facets ) ) {
				foreach ( $facets as $key => $facet ) {

					if ( ! empty( $navigation_facets ) ) {
						foreach ( $navigation_facets as $nav_facet ) {
							//@todo we should do a little bit of sanity check here - if the facet actually exists
							if ( $facet['name'] == $nav_facet['name'] ) {
								unset( $facets[ $key ] );
							}
						}
					}

					if ( ! empty( $hidden_facets ) ) {
						foreach ( $hidden_facets as $hidden_facet ) {
							//@todo we should do a little bit of sanity check here - if the facet actually exists
							if ( $facet['name'] == $hidden_facet['name'] ) {
								unset( $facets[ $key ] );
							}
						}
					}
				}

				$facets = array_values( $facets );

				listable_display_facets( $facets );
			}

			if ( ! empty( $hidden_facets ) ) { ?>
				<div class="hidden_facets">
					<?php listable_display_facets( $hidden_facets ); ?>
				</div>
			<?php } ?>

		</div> <!-- .search-jobs -->

		<div class="mobile-buttons">
			<button class="btn btn--filter"><?php esc_html_e( 'Filter', 'listable' ); ?>
				<span><?php esc_html_e( 'Listings', 'listable' ); ?></span></button>
			<button class="btn btn--view btn--view-map"><span><?php esc_html_e( 'Map View', 'listable' ); ?></span>
			</button>
			<button class="btn btn--view btn--view-cards">
				<span><?php esc_html_e( 'Cards View', 'listable' ); ?> </span></button>
		</div>
	</div><!-- .job-filters -->
	<?php if ( ! empty( $hidden_facets ) ) { ?>
		<button class="toggle-hidden-facets  js-toggle-hidden-facets">
			<span class="text--inactive"><?php esc_html_e( 'More filters', 'listable' ); ?></span>
			<span class="text--active"><?php esc_html_e( 'Less filters', 'listable' ); ?></span>
		</button>
	<?php } ?>

<?php else :

	wp_enqueue_script( 'wp-job-manager-ajax-filters' );

	do_action( 'job_manager_job_filters_before', $atts ); ?>

	<form class="job_filters">
		<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

		<a href="#" class="findme  js-find-me"></a>

		<div class="search_jobs">
			<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
			<input type="hidden" name="search_keywords" id="search_keywords" value="<?php echo esc_attr( $keywords ); ?>"/>

			<div class="search_location">
				<label for="search_location"><?php esc_html_e( 'Location', 'listable' ); ?></label>
				<input type="text" name="search_location" id="search_location"
				       placeholder="<?php esc_attr_e( 'Location', 'listable' ); ?>"
				       value="<?php echo esc_attr( $location ); ?>"/>
			</div>

			<div class="select-categories">
				<?php
				$has_listing_categories = get_terms( 'job_listing_category' );
				if ( $show_categories && ! is_wp_error( $has_listing_categories ) && ! empty( $has_listing_categories ) ) :

					//select the current category
					if ( empty( $selected_category ) ) {
						//try to see if there is a search_categories (notice the plural form) GET param
						$search_categories = isset( $_REQUEST['search_categories'] ) ? $_REQUEST['search_categories'] : '';
						if ( ! empty( $search_categories ) && is_array( $search_categories ) ) {
							$search_categories = $search_categories[0];
						}
						$search_categories = sanitize_text_field( stripslashes( $search_categories ) );
						if ( ! empty( $search_categories ) ) {
							if ( is_numeric( $search_categories ) ) {
								$selected_category = intval( $search_categories );
							} else {
								$term              = get_term_by( 'slug', $search_categories, 'job_listing_category' );
								$selected_category = $term->term_id;
							}
						} elseif ( ! empty( $categories ) && isset( $categories[0] ) ) {
							if ( is_string( $categories[0] ) ) {
								$term              = get_term_by( 'slug', $categories[0], 'job_listing_category' );
								$selected_category = $term->term_id;
							} else {
								$selected_category = intval( $categories[0] );
							}
						}
					} ?>

					<div class="search_categories">
						<label for="search_categories"><?php esc_html_e( 'Category', 'listable' ); ?></label>
						<?php job_manager_dropdown_categories( array(
							'taxonomy'        => 'job_listing_category',
							'hierarchical'    => 1,
							'show_option_all' => esc_html__( 'Any category', 'listable' ),
							'name'            => 'search_categories',
							'orderby'         => 'name',
							'selected'        => $selected_category,
							'multiple'        => false,
							'hide_empty' => false
						) ); ?>
					</div>

				<?php endif; ?>
			</div><!-- .select-categories -->
			<?php
			$job_tags = get_terms( array( 'job_listing_tag' ), array( 'hierarchical' => 1 ) );
			if ( ! is_wp_error( $job_tags ) && ! empty ( $job_tags ) ) { ?>
				<div class="select-tags">
					<select class="tags-select" data-placeholder="<?php esc_html_e( 'Filter by tags', 'listable' ); ?>"
					        name="job_tag_select" multiple>
						<?php foreach ( $job_tags as $term ) : ?>
							<option value="<?php echo $term->name ?>"><?php echo $term->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="active-tags"></div>
			<?php }
			do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
		</div><!-- .search_jobs -->

		<div class="mobile-buttons">
			<button class="btn btn--filter"><?php esc_html_e( 'Filter', 'listable' ); ?>
				<span><?php esc_html_e( 'Listings', 'listable' ); ?></span></button>
			<button class="btn btn--view btn--view-map"><span><?php esc_html_e( 'Map View', 'listable' ); ?></span>
			</button>
			<button class="btn btn--view btn--view-cards">
				<span><?php esc_html_e( 'Cards View', 'listable' ); ?> </span></button>
		</div>

		<?php do_action( 'job_manager_job_filters_end', $atts ); ?>

	</form><!-- .job_filter -->

	<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

	<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'listable' ); ?></noscript>

<?php endif;
