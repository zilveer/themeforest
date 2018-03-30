<?php
$show_breadcrumbs = couponxl_get_option( 'show_breadcrumbs' );
$theme_usage = couponxl_get_option( 'theme_usage' );
if( $show_breadcrumbs !== 'yes' ):
?>
	<section class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>
						<?php
							if ( is_category() ){
								echo single_cat_title();
							}
							else if( is_404() ){
								_e( '404 Page Doesn\'t exists', 'couponxl' );
							}
							else if( is_tag() ){
								echo __('Search results for: ', 'couponxl'). get_query_var('tag'); 
							}
							else if( is_author() ){
								_e('Posts by', 'couponxl'); 
							}
							else if( is_tax('offer_cat') ){
								$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
								echo esc_html__('Category: ', 'couponxl'). $term->name; 
							}
							else if( is_tax('location') ){
								$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
								echo esc_html__('Location: ', 'couponxl'). $term->name; 
							}
							else if( is_tax('offer_tag') ){
								$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
								echo esc_html__('Tag: ', 'couponxl'). $term->name; 
							}
							else if( is_archive() ){
								echo __('Archive for:', 'couponxl'). single_month_title(' ',false); 
							}
							else if( is_search() ){ 
								echo __('Search results for: ', 'couponxl').' '. get_search_query();
							}
							else if( is_front_page() || is_home() ){
								if( !class_exists('ReduxFramework') ){
									bloginfo( 'name' );
								}
								else if( is_front_page() ){
									the_title();
								}
								else{
									$blog_id = get_option('page_for_posts' );
									echo get_the_title( $blog_id );
								}
							}
							else{
								$page_template = get_page_template_slug();
								if( $page_template == 'page-tpl_search_page.php' ){
									if( empty( $offer_type ) && $theme_usage == 'all' ){
										_e( 'All Deals & Coupons', 'couponxl' );
									}
									else if( ( isset( $offer_type ) && $offer_type == 'deal' ) || $theme_usage == 'deals' ){
										_e( 'All Deals', 'couponxl' );
									}
									else if( ( isset( $offer_type ) && $offer_type == 'coupon' ) || $theme_usage == 'coupons' ){
										_e( 'All Coupons', 'couponxl' );
									}
								}
								else{
									the_title();
								}
							}							
						?>
					</h1>
					<?php
						$page_template = get_page_template_slug();
						if( $page_template == 'page-tpl_search_page.php' && ( !empty( $offer_cat ) || !empty( $location ) )){
							echo '<p>';
								_e( 'Showing ', 'couponxl' );

								if( empty( $offer_type ) && $theme_usage == 'all' ){
									_e( 'deals and coupons ', 'couponxl' );
								}
								else if( ( isset( $offer_type ) && $offer_type == 'deal' ) || $theme_usage == 'deals' ){
									_e( 'deals ', 'couponxl' );
								}
								else if( ( isset( $offer_type ) && $offer_type == 'coupon' ) || $theme_usage == 'coupons' ){
									_e( 'coupons ', 'couponxl' );
								}
								if( !empty( $offer_cat ) ){
									$offer_cat_term = get_term_by( 'slug', esc_sql( $offer_cat ), 'offer_cat' );
									if( !empty( $offer_cat_term ) ){
										_e( 'from category ', 'couponxl' );
										echo $offer_cat_term->name." ";
									}
								}
								if( !empty( $location ) ){
									$location_term = get_term_by( 'slug', esc_sql( $location ), 'location' );
									if( !empty( $location_term ) ){
										_e( 'located in ', 'couponxl' );
										echo $location_term->name;
									}
								}

							echo '</p>';
						}
						else{
							if( is_page() ){
								$page_subtitle = get_post_meta( get_the_ID(), 'page_subtitle', true );
								if( !empty( $page_subtitle ) ){
									echo '<p>';
										echo $page_subtitle;
									echo '</p>';
								}
							}
							else if( is_404() ){
									echo '<p>';
										_e( 'Page you have requested is not found', 'couponxl' );
									echo '</p>';
							}
							else if( is_singular('post') || is_archive() || is_category() || is_tag() || is_author() || is_search() || is_home() ){
									echo '<p>';
										echo couponxl_get_option( 'blog_subtitle' );
									echo '</p>';
							}
							else if( is_singular('offer') ){
									echo '<p>';
										echo couponxl_get_option( 'offer_subtitle' );
									echo '</p>';
							}
							else if( is_front_page() || is_home() ){
								if( !class_exists('ReduxFramework') ){
									bloginfo( 'description' );
								}
								else{
									echo couponxl_get_option( 'blog_subtitle' );
								}
							}

							else{
								echo '<p>';
									bloginfo( 'description' );
								echo '</p>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>

<?php include( locate_template( 'includes/breadcrumbs.php' ) ) ?>