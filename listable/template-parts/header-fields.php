<?php
/**
 * Template part for displaying the header fields like search or facets if FacetWP is active.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listable
 */

//do not show the navigation fields on the front page
if ( ! is_page_template( 'page-templates/front_page.php') ) :
	if ( listable_using_facetwp() ) :
		global $post;

		$facets = listable_get_facets_by_area( 'navigation_bar' );

		if ( ! empty( $facets ) ) : ?>
			<div class="header-facet-wrapper">
				<?php listable_display_facets($facets); ?>

				<?php if ( is_singular( 'job_listing' ) ) : ?>

					<button class="search-submit" name="submit" id="searchsubmit" onclick="FWP.refresh();facetwp_redirect_to_listings();">
						<?php get_template_part( 'assets/svg/search-icon-svg' ); ?>
					</button>

					<div style="display: none;">
						<?php echo facetwp_display('template', 'listings' ); ?>
					</div>

					<script>
						(function($) {
							$(document).on('keyup','.header-facet-wrapper input[type="text"]', function(e) {
								if (e.which === 13) {
									facetwp_redirect_to_listings();
								}
							});
						})(jQuery);

						function facetwp_redirect_to_listings() {
							//wait a little bit
							setTimeout(
								function() {
									//if the user presses ENTER/RETURN in a text field then redirect
									FWP.parse_facets();
									FWP.set_hash();

									var query_string = FWP.build_query_string();
									if ('' != query_string) {
										query_string = '?' + query_string;
									}
									window.location.href = '<?php echo listable_get_listings_page_url(); ?>' + query_string;
									return false;
								}, 700);

						}
					</script>

				<?php else : ?>

					<button class="search-submit" name="submit" id="searchsubmit" onclick="FWP.refresh();<?php echo ( ! has_shortcode( 'jobs', $post->post_content ) ) ? 'facetwp_redirect_to_listings();' : '' ?>">
						<?php get_template_part( 'assets/svg/search-icon-svg' ); ?>
					</button>

				<?php endif; ?>

			</div>
		<?php endif;
	else : ?>

		<form class="search-form  js-search-form" method="get" action="<?php echo get_post_type_archive_link( 'job_listing' ); ?>" role="search">
			<?php
			$has_search_menu = false;
			if ( has_nav_menu( 'search_suggestions' ) ) {
				$has_search_menu = true;
			} ?>
			<div class="search-field-wrapper<?php if ( $has_search_menu ) echo '  has--menu'; ?>">
				<label for="search_keywords"><?php esc_html_e( 'Keywords', 'listable' ); ?></label>
				<input class="search-field  js-search-mobile-field  js-search-suggestions-field" type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_html_e( 'What are you looking for?', 'listable' ); ?>" autocomplete="off" value="<?php the_search_query(); ?>"/>

				<?php wp_nav_menu( array(
					'container' => false,
					'theme_location' => 'search_suggestions',
					'menu_class' => 'search-suggestions-menu',
					'fallback_cb'     => false,
				) ); ?>

			</div>
	<span class="search-trigger--mobile  js-search-trigger-mobile">

		<?php get_template_part( 'assets/svg/search-icon-mobile-svg' ); ?>
		<?php get_template_part( 'assets/svg/close-icon-svg' ); ?>

	</span>
			<button class="search-submit  js-search-mobile-submit" name="submit" id="searchsubmit">

				<?php get_template_part( 'assets/svg/search-icon-svg' ); ?>

			</button>
		</form>

	<?php endif;
endif;
