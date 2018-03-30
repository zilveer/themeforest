<?php

$args = array(
	'post_status' => 'publish',
	'post_type' => 'offer',
	'posts_per_page' => -1,
);
if( !is_home() && !is_front_page() ){
	$args['orderby'] = 'meta_value_num';
	$args['order'] = 'ASC';
	$args['meta_key'] = 'offer_expire';
	$args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'offer_start',
			'value' => current_time( 'timestamp' ),
			'compare' => '<='
		),
		array(
			'key' => 'offer_expire',
			'value' => current_time( 'timestamp' ),
			'compare' => '>='
		),
		array(
			'key' => 'deal_status',
			'value' => 'has_items',
			'compare' => '='
		),
		array(
			'key' => 'offer_in_slider',
			'value' => 'yes',
			'compare' => '='
		)
	);

	if( !empty( $offer_type ) ){
		$args['meta_query'][] = array(
			'key' => 'offer_type',
			'value' => $offer_type,
			'compare' => '='
		);
	}

	if( !empty( $offer_store ) ){
	    $args['meta_query'][] = array(
	        'key' => 'offer_store',
	        'value' => $offer_store,
	        'compare' => '=',
	    );
	}

	if( !empty( $offer_cat ) ){
		$args['tax_query'][] = array(
			'taxonomy' => 'offer_cat',
			'field'	=> 'slug',
			'terms' => $offer_cat,
		);
	}

	if( !empty( $offer_tag ) ){
		$args['tax_query'][] = array(
			'taxonomy' => 'offer_tag',
			'field'	=> 'slug',
			'terms' => $offer_tag,
		);
	}
	if( !empty( $location ) ){
		$args['tax_query'][] = array(
			'taxonomy' => 'location',
			'field'	=> 'slug',
			'terms' => $location,
		);
	}

	$do_search = true;
}
else{
	$home_page_slider_items = couponxl_get_option( 'home_page_slider_items' );
	if( !empty( $home_page_slider_items ) ){
		if( !is_array( $home_page_slider_items ) ){
			$home_page_slider_items = explode( ',', $home_page_slider_items );
		}
		$args['post__in'] = $home_page_slider_items;
		$args['posts_per_page'] = count( $home_page_slider_items );
		$args['orderby'] = 'post__in';		
	}

	$do_search = true;
	if( count( $home_page_slider_items ) == 0 || empty( $home_page_slider_items ) ){
		$do_search = false;
	}
}

if( $do_search ){
	$offers = new WP_Query( $args );
	$slide_caption = couponxl_get_option( 'slide_caption' );
	if( $offers->have_posts() ){
		?>
		<div class="featured-slider-wrap">
			
			<div class="featured-slider-loader embed-responsive embed-responsive-16by9">
				<div class="featured-slider-loader-holder embed-responsive-item">
					<i class="fa fa-spin fa-spinner"></i>
				</div>
			</div>
			
			<ul class="list-unstyled featured-slider" data-slider_auto_rotate="<?php echo esc_attr( couponxl_get_option( 'slider_auto_rotate' ) ) ?>" data-slider_speed="<?php echo esc_attr( couponxl_get_option( 'slider_speed' ) ) ?>">
				<?php
				while( $offers->have_posts() ){
					$offers->the_post();
					$offer_expire = get_post_meta( get_the_ID(), 'offer_expire', true );
					$offer_type_ = get_post_meta( get_the_ID(), 'offer_type', true );
					?>
					<li>
						<?php
						if( has_post_thumbnail() ){
							the_post_thumbnail( 'post-thumbnail', array('class' => 'img-responsive') );
						}
						?>
						<div class="white-block <?php echo esc_attr( $slide_caption ); ?>">
							<div class="white-block-content clearfix">
								<div class="slider-left">
									<ul class="list-unstyled list-inline top-meta">
										<li>
											<?php echo couponxl_get_ratings() ?>
										</li>
										<li>
											<?php
												if( !empty( $offer_expire ) ){
													echo couponxl_remaining_time( $offer_expire );
												}
											?>
										</li>
									</ul>

									<h2>
										<?php if( $offer_type_ == 'coupon' ): ?>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<?php else: ?>
											<a href="<?php echo esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( 'deal' => get_the_ID() ), array('all') ) ); ?>"><?php the_title(); ?></a>
										<?php endif; ?>
									</h2>

									<ul class="list-unstyled list-inline bottom-meta">
										<li>
											<i class="fa fa-map-marker icon-margin"></i> 
											<?php echo couponxl_taxonomy( 'location', 1 ) ?>
										</li>
										<li>
											<i class="fa fa-circle icon-margin"></i> 
											<?php
												echo couponxl_taxonomy( 'offer_cat', 1);
											?>
										</li>
										<li>
											<i class="fa fa-dot-circle-o icon-margin"></i> 
											<?php
												$store_id = get_post_meta( get_the_ID(), 'offer_store', true );
												echo '<a href="'.get_permalink( $store_id ).'">'.get_the_title( $store_id ).'</a>'; 
											?>
										</li>
									</ul>
								</div>
								<div class="slider-right text-right">
									<div class="slider-action-button">
										<?php
										if( $offer_type_ == 'coupon' ){
											echo couponxl_coupon_button();
										}
										else{
											echo couponxl_get_deal_price();
											?>
											<a href="<?php the_permalink() ?>" class="btn"><?php _e( 'VIEW DEAL', 'couponxl' ) ?></a>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<?php
	}
	wp_reset_query();
}

?>