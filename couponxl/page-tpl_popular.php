<?php
/*
	Template Name: Sort By Ratings
*/
get_header();
the_post();

$search_sidebar_location = couponxl_get_option( 'search_sidebar_location' );

get_template_part( 'includes/title' );
?>
<section class="contact-page">
    <div class="container">

        <?php 
        $content = get_the_content();
        if( !empty( $content ) ):
        ?>
            <div class="white-block">
                <div class="white-block-content">
                    <div class="page-content clearfix">
                        <?php echo apply_filters( 'the_content', $content ) ?>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>
    
        <div class="row">

            <?php if( $search_sidebar_location == 'left' ): ?>
                <?php get_sidebar( 'popular' ) ?>
            <?php endif; ?>

            <div class="col-md-<?php echo is_active_sidebar( 'sidebar-popular' ) ? '9' : '12' ?>">

                <?php 
                $show_search_slider = couponxl_get_option( 'show_search_slider' );
                if( $show_search_slider == 'yes' ){
                    include( locate_template( 'includes/featured-slider.php' ) );
                }
                ?>

            	<?php
                    if( get_query_var( 'paged' ) ){
                        $cur_page = get_query_var( 'paged' );
                    }
                    else if( get_query_var( 'page' ) ){
                        $cur_page = get_query_var( 'page' );
                    }
                    else{
                        $cur_page = 1;
                    }
            		$args = array(
            			'post_status' => 'publish',
            			'posts_per_page' => couponxl_get_option( 'offers_per_page' ),
            			'post_type'	=> 'offer',
            			'paged' => $cur_page,
            			'orderby' => array( 'meta_value_num' => 'ASC', 'date' =>'DESC' ),
            			'meta_key' => 'couponxl_average_rate',
            			'order' => 'DESC',
            			'meta_query' => array(
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
            			),
            			'tax_query' => array(
            				'relation' => 'AND'
            			)
            		);

                    if( !empty( $offer_sort ) ){
                        $temp = explode( '-', $offer_sort );
                        if( $temp[0] == 'date' ){
                            unset( $args['meta_key'] );
                            $args['orderby'] = $temp[0];
                            $args['order'] = $temp[1];
                        }
                        else{
                            if( $temp[0] == 'rate' ){
                                $temp[0] = 'couponxl_average_rate';
                            }
                            else if( $temp[0] == 'offer_expire' ){
                                $args['orderby'] = array( 'meta_value_num' => $temp[1], 'date' =>'DESC' );
                            }                            
                            $args['meta_key'] = $temp[0];
                            $args['order'] = $temp[1];
                        }
                    }

            		
            		$offers = new WP_Query( $args );
					$page_links_total =  $offers->max_num_pages;
                    $pagination_args =  array(
                        'prev_next' => true,
                        'end_size' => 2,
                        'mid_size' => 2,
                        'total' => $page_links_total,
                        'current' => $cur_page, 
                        'prev_next' => false,
                        'type' => 'array',
                    );
                    if( is_front_page() ){
                        $pagination_args['format'] = '?paged=%#%';
                    }

                    $page_links = paginate_links( $pagination_args );
                    $pagination = couponxl_format_pagination( $page_links );          		

                    $permalink = couponxl_get_permalink_by_tpl( 'page-tpl_popular' );
                    include( locate_template( 'includes/filter-bar.php' ) );

            		if( $offers->have_posts() ){
            			?>
            			<div class="row masonry">
	            			<?php
                            $col = is_active_sidebar( 'sidebar-popular' ) ? '6' : '4';
                            if( $offer_view == 'list' ){
                                $col = 12;
                            }                            
	            			while( $offers->have_posts() ){
	            				$offers->the_post();
	            				?>
	            				<div class="col-sm-<?php echo esc_attr( $col ) ?> masonry-item">
	            					<?php include( locate_template( 'includes/offers/offers.php' ) ); ?>
	            				</div>
	            				<?php
	            			}
	            			?>
                            <?php if( !empty( $pagination ) ): ?>
	            			    <div class="col-sm-<?php echo esc_attr( $col ) ?> masonry-item">
	            			    	<ul class="pagination">
    	            					<?php echo $pagination; ?>
    	            				</ul>
	            			    </div>
                            <?php endif; ?>
            			</div>
            			<?php
            		}
            	?>
            </div>

            <?php if( $search_sidebar_location == 'right' ): ?>
                <?php get_sidebar( 'popular' ) ?>
            <?php endif; ?>
            
        </div>
    </div>
</section>
<?php
get_footer();
?>