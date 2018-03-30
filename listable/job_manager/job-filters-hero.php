<?php
/**
 * The template for displaying the WP Job Manager Filters on the front page hero
 *
 * @package Listable
 */
?>

<?php if ( listable_using_facetwp() ) :

	$facets = listable_get_facets_by_area( 'front_page_hero' );

	$fields_num = count( $facets );
	if ( $fields_num > 0 ) : ?>

		<div class="search_jobs  search_jobs--frontpage  search_jobs--frontpage-facetwp<?php echo ( 1 == $fields_num ) ? '  has--one-field' : ''; ?>">

			<?php listable_display_facets( $facets ); ?>

			<button class="search-submit" name="submit" id="searchsubmit" onclick="facetwp_redirect_to_listings()">
				<?php get_template_part( 'assets/svg/search-icon-svg'); ?>
				<span><?php esc_html_e( 'Search', 'listable' ); ?></span>
			</button>

		</div>

		<div style="display: none;">

			<?php echo facetwp_display('template', 'listings' ); ?>

		</div>

		<script>
			(function($) {

				$(document).ready(function () {
					//prevent the facets from disappearing
					FWP.loading_handler = function() {}
				});

				$(document).on('keyup','.search_jobs--frontpage-facetwp input[type="text"]', function(e) {
					if (e.which === 13) {
						//wait a little bit
						setTimeout(
							function() {
								//if the user presses ENTER/RETURN in a text field then redirect
								facetwp_redirect_to_listings();
								return false;
							}, 500);
					}
				});
			})(jQuery);

			function facetwp_redirect_to_listings() {
				FWP.parse_facets();
				FWP.set_hash();
				var query_string = FWP.build_query_string();
				if ('' != query_string) {
					query_string = '?' + query_string;
				}
				var url = query_string;
				window.location.href = '<?php echo listable_get_listings_page_url(); ?>' + url;
			}
		</script>

		<?php
	endif;
else :

$show_categories = true;
if ( ! get_option( 'job_manager_enable_categories' ) ) {
	$show_categories = false;
}
$atts = apply_filters( 'job_manager_ouput_jobs_defaut', array(
    'per_page' => get_option( 'job_manager_per_page' ),
    'orderby' => 'featured',
    'order' => 'DESC',
    'show_categories' => $show_categories,
    'show_tags' => false,
    'categories' => true,
    'selected_category' => false,
    'job_types' => false,
    'location' => false,
    'keywords' => false,
    'selected_job_types' => false,
    'show_category_multiselect' => false,
    'selected_region' => false
) );

$fields_options = get_post_meta( get_the_ID(), 'frontpage_search_fields', false );

//it is not sufficient to check for emptiness since one can uncheck all options resulting in an empty array
//metadata_exists() helps by checking the existence of the key, even if empty
if ( empty( $fields_options ) && ! metadata_exists( 'post', get_the_ID(), 'frontpage_search_fields' ) ) {
	//in case the defaults were not saved in the database, impose them - only the keywords search field is shown by default
	$fields_options = array( 'keywords' );
}
$fields_num = count( $fields_options );
?>

<?php do_action( 'job_manager_job_filters_before', $atts ); ?>

<?php if ( $fields_num >= 1 ) : ?>
<form class="search-form   job_search_form  js-search-form" action="<?php echo listable_get_listings_page_url(); ?>" method="get" role="search">
	<?php if ( ! get_option('permalink_structure') ) {
		//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
		$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
		//only do this in case we do have a listings page selected
		if ( false !== $listings_page_id ) {
			echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
		}
	} ?>
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

	<div class="search_jobs  search_jobs--frontpage<?php if ( 1 == $fields_num ) echo '  has--one-field'; ?>">

		<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

		<?php if ( in_array( 'keywords', $fields_options ) ):

			$has_search_menu = false;
			if ( has_nav_menu( 'search_suggestions' ) )  {
				$has_search_menu = true;
			}
		?>

		<div class="search-field-wrapper  search-filter-wrapper<?php echo $has_search_menu ? '  has--menu' : ''; ?>">
			<label for="search_keywords"><?php _e( 'Keywords', 'listable' ); ?></label>
			<input class="search-field  js-search-suggestions-field" type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_html_e( 'What are you looking for?', 'listable' ); ?>" autocomplete="off" value="<?php the_search_query(); ?>"/>
			<?php wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'search_suggestions',
				'menu_class' => 'search-suggestions-menu',
				'fallback_cb'     => false,
			) ); ?>
		</div>

		<?php endif; ?>

		<?php if ( in_array( 'location', $fields_options ) ): ?>

			<div class="search_location  search-filter-wrapper">
				<label for="search_location"><?php esc_html_e( 'Location', 'listable' ); ?></label>
				<?php if ( class_exists( 'Astoundify_Job_Manager_Regions' ) && "1" === get_option('job_manager_regions_filter') ) { ?>
					<div class="search_region-dummy">
						<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'listable' ); ?>" style="display: none;" />
						<input type="text" class="select-region-dummy  search-field" disabled="disabled" placeholder="<?php esc_attr_e( 'All Regions', 'listable' ); ?>" />
					</div>
				<?php } else { ?>
					<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'listable' ); ?>" />
				<?php } ?>
			</div>

		<?php endif; ?>

		<?php if ( in_array( 'categories', $fields_options ) ):
			if ( true === $show_categories ) : ?>

        <div class="search_categories  search-filter-wrapper">
            <label for="search_categories"><?php esc_html_e( 'Category', 'listable' ); ?></label>
            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'Any category', 'listable' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
        </div>

        <?php endif;
		endif; ?>

		<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

		<button class="search-submit" name="submit" id="searchsubmit">
			<?php get_template_part( 'assets/svg/search-icon-svg'); ?>
			<span><?php esc_html_e( 'Search', 'listable' ); ?></span>
		</button>
	</div>

	<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
</form>
<?php endif; // if ( $fields_num >= 1 )?>

<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>

<?php endif;
