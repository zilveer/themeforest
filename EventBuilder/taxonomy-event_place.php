<?php
/**
 * Template for event location category
 */

global $main_cat_id;
$term = $wp_query->get_queried_object(); 
$parent = $term->parent;
$main_cat_id = $term->term_id;

if($parent == 0) {

	$tag = $main_cat_id;

	$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
	$category_page_template = isset( $tag_extra_fields[$tag]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$tag]['category_page_template'] ) : '';

} else {

	$term_id = $main_cat_id; //Get ID of current term
	$ancestors = get_ancestors( $term_id, 'event_place' ); // Get a list of ancestors
	$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
	$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
	$term = get_term( $top_term_id, 'event_place' ); //Get the term
	$tag = $term->term_id;

	$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
	$category_page_template = isset( $tag_extra_fields[$tag]['category_page_template'] ) ? esc_attr( $tag_extra_fields[$tag]['category_page_template'] ) : '';

}

get_header();

themesdojo_load_map_scripts();

global $redux_demo, $main_cat_id; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; } 

global $redux_demo, $maximRange; 
$max_range = $redux_demo['max_range'];
if(!empty($max_range)) {
	$maximRange = $max_range;
} else {
	$maximRange = 1000;
}

$term = $wp_query->get_queried_object(); 
$main_cat_id = $term->slug;

$custom_posts = new WP_Query();
$custom_posts->query(array(
    'post_type'      => 'event',
    'posts_per_page' => '-1',
    'post_status'    => 'publish',
    'event_place'      => $main_cat_id,
    'meta_query' => array(
            array(
                'key'     => 'event_status',
                'value'   => 'upcoming',
            ),
        ),
    )
);
$total_items = $custom_posts->post_count;

?>

		<div id="main-wrapper" class="content grey-bg" style="padding: 30px 0">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="item-block-title-events">

							<div class="row">

								<div class="col-sm-12">

									<div class="full">

										<h4><?php esc_html_e("Upcoming events at ", "themesdojo"); ?> <?php printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );	?></h4>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="col-sm-12">

						<div id="map-canvas-holder" style="height: 0; opacity: 0;">

							<div id="map-canvas" style="height: 660px;"></div>

						</div>

						<div class="row">

							<div class="col-sm-12"><noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'themesdojo' ); ?></noscript></div>

							<div class="col-sm-12"><div class="listing-loading"><h3><i class="fa fa-spinner fa-spin"></i></h3></div></div>

							<div id="cat-listing-holder">

								<?php

									global $custom_posts2;
									$custom_posts2 = new WP_Query();
									$custom_posts2->query(array(
									    'post_type'      => 'event',
									    'posts_per_page' => '30',
									    'post_status'    => 'publish',
									    'meta_key'       => 'event_start_date_number',
									    'orderby'        => 'meta_value',
									    'order'          => 'ASC',
									    'event_place'      => $main_cat_id,
									    'meta_query' => array(
									            array(
									                'key'     => 'event_status',
									                'value'   => 'upcoming',
									            ),
									        ),
									    )
									);

									$currentEvent = 0;

									if ( $custom_posts2->have_posts() ) {

								?>

									<?php while ($custom_posts2->have_posts()) : $custom_posts2->the_post(); $currentEvent++; ?>

									<div class="col-sm-12 event-block id-<?php echo get_the_ID(); ?>">

								                <div class="upcoming-events-v2">

								                    <a class="upcoming-events-big-button" href="<?php the_permalink(); ?>"></a>

								                    <div class="row">

								                        <div class="col-sm-2 upcoming-events-number">

								                            <h2><?php if($currentEvent <= 9) { ?>0<?php } ?><?php echo $currentEvent; ?></h2>

								                        </div>

								                        <div class="col-sm-5 upcoming-events-title">

								                            <div class="upcoming-events-avatar">

								                                <?php 

								                                    if(has_post_thumbnail()) { 

								                                      $image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

								                                      $image_src = $image_src_all[0];

								                                    } elseif(!empty($redux_default_img_bg)) { 

								                                      $image_src = esc_url($redux_default_img_bg); 

								                                    } else { 

								                                      $image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

								                                    } 

								                                    get_template_part( 'inc/BFI_Thumb' );
								                                    $params = array( 'width' => 71, 'height' => 71, 'crop' => true );

								                                ?> 

								                                <img src="<?php echo bfi_thumb( $image_src, $params ); ?>" alt="" />  

								                            </div>

								                            <div class="upcoming-events-title-cont">

								                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>

								                                <?php 

								                                    $postID = get_the_ID();

								                                    $terms = get_the_terms($postID, 'event_cat' );
								                                    if ($terms && ! is_wp_error($terms)) :
								                                        $term_slugs_arr = array();
								                                        foreach ($terms as $term) {
								                                            $term_slugs_arr[] = $term->name;
								                                        }
								                                        $terms_slug_str = join( " ", $term_slugs_arr);
								                                    endif; 

								                                ?>

								                                <span><i class="fa fa-folder-open"></i><?php echo esc_attr($terms_slug_str); ?></span>

								                            </div>

								                        </div>

								                        <div class="col-sm-5 upcoming-events-details">

								                            <div class="full">

								                            <?php 

								                                $event_address_country = get_post_meta(get_the_ID(), 'event_address_country', true);
								                                $event_address_state = get_post_meta(get_the_ID(), 'event_address_state', true);
								                                $event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);
								                                $event_address_address = get_post_meta(get_the_ID(), 'event_address_address', true);
								                                $event_address_zip = get_post_meta(get_the_ID(), 'event_address_zip', true);
								                                $event_location = get_post_meta(get_the_ID(), 'event_location', true);

								                            ?>

								                            <i class="fa fa-map-marker"></i> 

								                            <?php if(!empty($event_location)) { ?>
								                                <?php echo esc_attr($event_location); ?><?php _e( ' - ', 'themesdojo' ); ?>
								                            <?php } ?>

								                            <?php if(!empty($event_address_city)) { ?>
								                                <?php echo esc_attr($event_address_city); ?><?php _e( ', ', 'themesdojo' ); ?>
								                            <?php } ?>

								                            <?php if(!empty($event_address_country)) { ?>
								                                <?php echo esc_attr($event_address_country); ?>
								                            <?php } ?>

								                            </div>

								                            <div class="full">

								                            <?php $event_phone = get_post_meta(get_the_ID(), 'event_phone', true); if(!empty($event_phone)) { ?>
								                            <span><i class="fa fa-phone"></i><?php echo esc_attr($event_phone); ?></span><?php } ?>

								                            </div>

								                            <div class="full">

								                            <i class="fa fa-calendar"></i>

								                            <?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); $event_start_time = get_post_meta(get_the_ID(), 'event_start_time', true); $event_location = get_post_meta(get_the_ID(), 'event_location', true); if(!empty($event_start_date)) { ?>

								                            <?php

																	global $redux_demo; 
																	if(isset($redux_demo['events-date-format'])) {
																		$time_format = $redux_demo['events-date-format'];
																		if($time_format == 1) {

																?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

																	<?php } elseif($time_format == 2) { ?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("d/m/Y",$start_unix_time); ?>

																	<?php } } else { ?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

																<?php } ?>

																<?php

																	global $redux_demo; 
																	if(isset($redux_demo['events-time-format'])) {
																		$time_format = $redux_demo['events-time-format'];
																		if($time_format == 1) {

																?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																	<?php } elseif($time_format == 2) { ?>

																	<?php $start_time = date("H:i", strtotime($event_start_time)); ?>

																	<?php } } else { ?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																<?php } ?>

														        <span><?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

						                            <?php } ?>

						                            </div>

						                        </div>

						                    </div>

						                </div>

						            </div>

									<?php endwhile; ?>

									<div class="col-sm-12">

										<?php 

											global $wp_rewrite;			
											$custom_posts2->query_vars['paged'] > 1 ? $current = $custom_posts2->query_vars['paged'] : $current = 1;

											$td_pagination = array(
												'base' => esc_url_raw(@add_query_arg('page','%#%')),
												'format' => '',
												'total' => $custom_posts2->max_num_pages,
												'current' => $current,
												'show_all' => false,
												'type' => 'plain',
												);

											if( $wp_rewrite->using_permalinks() )
												$td_pagination['base'] = '#%#%';

											if( !empty($custom_posts2->query_vars['s']) )
												$td_pagination['add_args'] = array('s'=>get_query_var('s'));

											$total_pages = $custom_posts2->max_num_pages;

											if($total_pages > 1) {
												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 
											}

										?>

									</div>

									<?php } else { ?>

										<div class="col-sm-12"><?php _e( 'No listings found.', 'themesdojo' ); ?></div>

									<?php } ?>

							</div>

						</div>

					</div>

				</section>

			</div>

		</div>

<?php get_footer(); ?>