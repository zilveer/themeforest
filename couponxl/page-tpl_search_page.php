<?php
/*
	Template Name: Search Page
*/
get_header();
the_post();
require_once( locate_template( 'includes/title.php' ) );
$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );

$search_sidebar_location = couponxl_get_option( 'search_sidebar_location' );

ob_start();
require_once( locate_template( 'includes/search-sidebar.php' ) );
$sidebar_html = ob_get_contents();
ob_end_clean();

?>
<section>
    <div class="container">
        <div class="row">

            <?php if( $search_sidebar_location == 'left' ): ?>
                <?php echo $sidebar_html ?>
            <?php endif; ?>

            <div class="col-md-9">

                <?php 
                $show_search_slider = couponxl_get_option( 'show_search_slider' );
                if( $show_search_slider == 'yes' ){
                    include( locate_template( 'includes/featured-slider.php' ) );
                }

                include( locate_template( 'includes/filter-bar.php' ) );
                ?>

            	<?php
                    $cur_page = 1;
                    if( get_query_var( 'paged' ) ){
                        $cur_page = get_query_var( 'paged' );
                    }
                    else if( get_query_var( 'page' ) ){
                        $cur_page = get_query_var( 'page' );
                    }
            		$args = array(
            			'post_status' => 'publish',
            			'posts_per_page' => couponxl_get_option( 'offers_per_page' ),
            			'post_type'	=> 'offer',
            			'paged' => $cur_page,
            			'orderby' => array( 'meta_value_num' => 'ASC', 'date' =>'DESC' ),
            			'meta_key' => 'offer_expire',
            			'order' => 'ASC',
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

            		if( !empty( $offer_type ) ){
                        if( !empty( $offer_type ) || $offer_type == 'deal' ){
                            $args['meta_query'][] = array(
                                'key' => 'deal_status',
                                'value' => 'has_items',
                                'compare' => '='
                            );
                        }
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

                    if( !empty( $keyword ) ){
                        $args['s'] = urldecode( $keyword );
                    }


            		$offers = new WP_Query( $args );
					$page_links_total =  $offers->max_num_pages;
                    $pagination_args = array(
                        'prev_next' => true,
                        'end_size' => 2,
                        'mid_size' => 2,
                        'total' => $page_links_total,
                        'current' => $cur_page, 
                        'prev_next' => false,
                        'type' => 'array'
                    );
                    if( is_front_page() ){
                        $pagination_args['base'] = '%_%';
                        $pagination_args['format'] = '?page=%#%';
                    }
					$page_links = paginate_links( $pagination_args );

					$pagination = couponxl_format_pagination( $page_links );            		

            		if( $offers->have_posts() ){
                        $col = is_active_sidebar( 'sidebar-search' ) ? '6' : '4';
                        if( $offer_view == 'list' ){
                            $col = 12;
                        }
            			?>
            			<div class="row masonry">
	            			<?php
	            			while( $offers->have_posts() ){
	            				$offers->the_post();
	            				?>
	            				<div class="col-sm-<?php echo esc_attr( $col ) ?> masonry-item">
	            					<?php include( locate_template( 'includes/offers/offers.php' ) ); ?>
	            				</div>
	            				<?php
	            			}
                            wp_reset_postdata();
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
                    else{
                        ?>
                        <div class="white-block">
                            <div class="white-block-content">
                                <p class="nothing-found"><?php echo couponxl_get_option( 'search_no_offers_message' ); ?></p>
                            </div>
                        </div>
                        <?php
                    }
            	?>
            </div>

            <?php if( $search_sidebar_location == 'right' ): ?>
                <?php echo $sidebar_html ?>
            <?php endif; ?>            
            
        </div>
    </div>
</section>
<?php
get_footer();
?>