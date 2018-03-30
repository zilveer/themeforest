<?php
/**
 * Campaign Listing VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_campaign_listing' ) ) {
	function sd_campaign_listing( $atts ) {
		$sd = shortcode_atts( array(
			'cats'         => '',
			'items'        => '',
			'layout'       =>'',
			'hide_filters' => '',
		), $atts );
		
		$cats         = $sd['cats'];
		$items        = $sd['items'];
		$layout       = $sd['layout'];
		$hide_filters = $sd['hide_filters'];
		
		if ( ! empty( $cats ) ) {
			$cats = explode( ',', $cats );
		}
		
		wp_enqueue_script( 'sd-isotope' );
		
		global $post;
		
		ob_start();
		
		$args = array(
			'post_type'      => 'download',
			'posts_per_page' => $items,
		);
		
		// Only pull from selected taxonomy
		$selected_filters = $cats;
	
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

		$sd_query = new WP_Query( $args );
		
	?>
		<div class="sd-campaign-listing">
			<?php if ( $hide_filters !== 'true' ) : ?>
				<?php
					$campaign_filters = get_terms( 'download_category' );
		
					if ( $campaign_filters ) : ?>
						<div class="sd-campaign-filters">
							<ul>
								<li>
									<a href="#" data-filter="*" class="sd-active sd-link-trans"><?php _e( 'All', 'sd-framework' ); ?></a>
								</li>
								<?php foreach( $campaign_filters as $campaign_filter ): ?>
									<?php if( $cats && !in_array( '0', $cats ) ) : ?>
										<?php if ( in_array( $campaign_filter->term_id, $cats ) ): ?>
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
				<?php endif; ?>
				
				<div class="row">
					<div class="sd-listing-content <?php if ( $layout == 2 ) echo 'sd-listing-list'; ?>">		
						<?php $i = 0; $j = 0; while ( $sd_query->have_posts() ) : $sd_query->the_post(); ?>
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
								<?php $j++; if ( $j == 4 && $layout == 1 ) { echo '<div class="clearfix visible-sm"></div>'; $j = 0; } ?>
						<?php endwhile; wp_reset_postdata(); ?>	
					</div>
					<!-- sd-listing-content -->
				</div>
				<!-- row -->
			</div>
			<!-- sd-campaign-listing -->
		<?php 
			$out = ob_get_clean();
			
			
			
			return $out;
	}
	add_shortcode( 'sd_campaign_listing', 'sd_campaign_listing' );
}

// Register shortcode to VC

add_action( 'init', 'sd_campaign_listing_vcmap' );

if ( ! function_exists( 'sd_campaign_listing_vcmap' ) ) {
	function sd_campaign_listing_vcmap() {
		
		if ( post_type_exists( 'download' ) ) {
	
			$types = get_terms( 'download_category', 'hide_empty=0' );
			$types_array[__( 'All', 'sd-framework' )] = 0 ;
		
			if( $types ) {
				foreach ( $types as $type ) {
					$types_array[$type->name] = $type->term_id;
				}
			}
		}
		vc_map( array(
			'name'              => __( 'Campaign Listing', 'sd-framework' ),
			'description'       => __( 'Insert a campaign listing.', 'sd-framework' ),
			'base'              => "sd_campaign_listing",
			'class'             => "sd_campaign_listing",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-campaign-listing",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Layout Style', 'sd-framework' ),
					'param_name'  => 'layout',
					'value'       => array( 
										__( 'Grid', 'sd-framework' ) => '1',
										__( 'List', 'sd-framework' ) => '2',
									 ),
					'std'         => '1',
					'save_always' => true,
					'description' => __( 'Display latest campaign donors', 'sd-framework' ),
				),
				array(
					'type'        => 'checkbox',
					'class'       => '',
					'heading'     => __( 'Filter Categories', 'sd-framework' ),
					'param_name'  => 'cats',
					'value'       => $types_array,
					'description' => __( 'Select the categories to be filtered.', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number of Items', 'sd-framework' ),
					'param_name'  => 'items',
					'value'       => '9',
					'description' => __( 'Insert the number of items to display. Default is 9.', 'sd-framework' ),
				),
				array(
					'type'        => 'checkbox',
					'class'       => '',
					'heading'     => __( 'Hide Filters?', 'sd-framework' ),
					'param_name'  => 'hide_filters',
					'value'       => __( 'Yes', 'sd-framework' ),
					'description' => __( 'Check to hide filters from the page.', 'sd-framework' ),
				),
			),
		));
	}
}