<?php
/**
 * Template Name: Page: Campaigns
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
get_header();

$items = rwmb_meta('sd_campaign_items');
$items = ( ! empty( $items ) ? $items : '6' );
$layout = rwmb_meta('sd_camp-page-layout');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-full-width clearfix' ); ?>> 
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<!-- entry-content -->
</article>

<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		
	// Only pull from selected taxonomy
		$selected_filters = rwmb_meta( 'sd_campaign-taxonomies', 'type=checkbox_list' );
	
		if ( $selected_filters && $selected_filters[0] == 0 ) {
			unset( $selected_filters[0] );
		}
			
		if ( $selected_filters ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'download_category',
				'field'	   => 'ID',
				'terms'    => $selected_filters
			);
		}
		
	$args = array(
			'post_type'      => 'download',
			'posts_per_page' => $items,
			'paged'          => $paged,
	);

	$wp_query = new WP_Query( $args );
		
	$i = 0;
?>

<div class="sd-campaign-listing sd-campaigns">
	<div class="container">
			<?php
				$campaign_filters = get_terms( 'download_category' );
	
				if ( $campaign_filters ) : ?>
					<div class="sd-campaign-filters">
						<ul>
							<li>
								<a href="#" data-filter="*" class="sd-active sd-link-trans"><?php _e( 'All', 'sd-framework' ); ?></a>
							</li>
							<?php foreach( $campaign_filters as $campaign_filter ): ?>
								<?php if( $selected_filters && !in_array( '0', $selected_filters ) ) : ?>
									<?php if ( in_array( $campaign_filter->term_id, $selected_filters ) ): ?>
										<li>
											<a href="#" data-filter=".<?php echo esc_attr( str_replace(' ', '', $campaign_filter->name ) ); ?>" class="sd-link-trans"><?php echo $campaign_filter->name; ?></a>
										</li>
									<?php endif; ?>
								<?php else: ?>
									<li>
										<a href="#" data-filter=".<?php echo esc_attr( str_replace(' ', '', $campaign_filter->name ) ); ?>" class="sd-link-trans"><?php echo $campaign_filter->name; ?></a>
									</li>
									
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
					<!-- sd-campaign-filters -->
				<?php endif; ?>
			
			<div class="row">
				<div class="sd-listing-content <?php if ( $layout == 2 ) echo 'sd-listing-list'; ?>">
					<?php $i = 0; while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<?php $filters = get_the_terms( get_the_ID(), 'download_category' ); ?>
							<div class="col-md-<?php if ( $layout == 1 ) { echo '4 col-sm-4'; } else { echo '12'; } ?> sd-listing-item <?php if ( $filters ) : foreach ( $filters as $filter ) { echo str_replace(' ', '', $filter->name ) . ' '; } endif; ?>">
								<?php
									if ( $layout == 1 ) {
										get_template_part('framework/inc/vc/shortcodes/sd-campaign-carousel/sd-campaign-item-carousel');
									} else {
										get_template_part('framework/inc/vc/shortcodes/sd-campaign-listing/list');
								
									}
								?>
							</div>
							<!-- col-md-4 -->
							<?php $i++; if ( $i == 3 && $layout == 1 ) { echo '<div class="clearfix"></div>'; $i = 0; } ?>
					<?php endwhile; wp_reset_postdata(); ?>	
				</div>
				<!-- sd-listing-content -->
			</div>
			<!-- row -->
			<?php sd_custom_pagination(); ?>
		</div>
		<!-- container -->
	</div>
	<!-- sd-campaign-listing -->

<?php get_footer(); ?>