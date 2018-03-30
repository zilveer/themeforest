				<?php

					$geo_status = 0;

					$page = sanitize_text_field($_POST['my_listings_current_page']);

					$keyword = sanitize_text_field($_POST['filterKeywords']);
					$cat = sanitize_text_field($_POST['category']);
					$loc = $_POST['listingFormLoc'];
					$time = sanitize_text_field($_POST['listingFormTime']);
					if(isset($_POST['cat_tag'])) { $tags = $_POST['cat_tag']; } else { $tags = ""; }
					if(isset($_POST['geo-radius'])) { $geo_radius_search =  $_POST['geo-radius']; } else { $geo_radius_search = ""; };
					if(isset($_POST['item_address_latitude'])) { $geo_search_lat = $_POST['item_address_latitude']; } else { $geo_search_lat =""; };
					if(isset($_POST['item_address_longitude'])) { $geo_search_lng = $_POST['item_address_longitude']; } else { $geo_search_lng = ""; };

					if($time == 1) {

						$dt = new DateTime();
						$dtDay = $dt->format('d');
						$dtMonth = $dt ->format('m');
						$dtYear = $dt ->format('Y');

						if (substr($dtDay,0,1)=="0") $dtDay = substr($dtDay,1);
						if (substr($dtMonth,0,1)=="0") $dtMonth = substr($dtMonth,1);

						$time_args = array(
							'key'     => 'event_start_date', 
							'value'   => $dtMonth."/".$dtDay."/".$dtYear, 
							'compare' => '==',
							'orderby' => 'value',
					    	'order'   => 'ASC',
						);

					} elseif($time == 2) {

						$dt_min = new DateTime("last sunday");
						$dt_max = clone($dt_min);
						$dt_max->modify('+7 days');
						$end_date = $dt_max->format('m/d/Y');

						$date = $end_date." 23:59:59";
						$event_start_date_number = strtotime($date);

						$time_args = array(
							'key'     => 'event_start_date_number', 
							'value'   => $event_start_date_number, 
							'compare' => '<=',
							'orderby' => 'value',
					    	'order'   => 'ASC',
						);

					} elseif($time == 3) {

						$dt = new DateTime();
						$dtDay = date("t");
						$dtMonth = $dt ->format('m');
						$dtYear = $dt ->format('Y');

						if (substr($dtDay,0,1)=="0") $dtDay = substr($dtDay,1);
						if (substr($dtMonth,0,1)=="0") $dtMonth = substr($dtMonth,1);

						$date = $dtMonth."/".$dtDay."/".$dtYear." 23:59:59";
						$event_start_date_number = strtotime($date);

						$time_args = array(
							'key'     => 'event_start_date_number', 
							'value'   => $event_start_date_number, 
							'compare' => '<=',
							'orderby' => 'value',
					    	'order'   => 'ASC',
						);

					} else {

						$time_args = array(
							'key'     => 'event_start_date_number', 
							'orderby' => 'value',
					    	'order'   => 'ASC',
						);

					}
					
					$geo_status = 0;

					if( ($geo_search_lat != 0) OR ($geo_search_lng != 0) ) {
						$geo_status = 1;
					}

					if(!empty($tags)) {
						$tags = implode(',', $tags);
					}

					if($geo_status == 1) {
						$post_per_page = '-1';
						$page = 1;
					} else {
						$post_per_page = '30';
					}

					$currentNum = 0;
					$total_items_geo = 0;

					$total_companies = 0;
					$current_page = $page;

					global $custom_posts;
					$custom_posts = new WP_Query();
					$custom_posts->query(array(
						's'              => $keyword,
					    'post_type'      => 'event',
					    'posts_per_page' => $post_per_page,
					    'post_status'    => 'publish',
					    'event_cat'      => $cat,
					    'event_loc'      => $loc,
					    'event_tag'      => $tags,
					    'paged'          => $page,
					    'meta_key'       => 'event_start_date_number',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
					    'meta_query' => array(
					            array(
					                'key'     => 'event_status',
					                'value'   => 'upcoming',
					            ),
					            $time_args,
					        ),
					    )
					);

					$custom_posts2 = new WP_Query();
					$custom_posts2->query(array(
						's'              => $keyword,
					    'post_type'      => 'event',
					    'posts_per_page' => '-1',
					    'post_status'    => 'publish',
					    'event_cat'      => $cat,
					    'event_loc'      => $loc,
					    'event_tag'      => $tags,
					    'meta_key'       => 'event_start_date_number',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
					    'meta_query' => array(
					            array(
					                'key'     => 'event_status',
					                'value'   => 'upcoming',
					            ),
					            $time_args,
					        ),
					    )
					);
					$total_items = $custom_posts2->post_count;

					?>

					<script type="text/javascript">

						jQuery(document).ready(function($) {
							jQuery(".page-title-aright span").text(<?php echo esc_attr($total_items); ?>);
						});

					</script>

					<?php

					if ( $custom_posts->have_posts() ) {

					while ($custom_posts->have_posts()) : $custom_posts->the_post(); 

						if($geo_status == 1) {

							$post_latitude = get_post_meta(get_the_ID(), 'event_address_latitude', true);
							$post_longitude = get_post_meta(get_the_ID(), 'event_address_longitude', true);

							global $redux_demo;
							$measure_system = $redux_demo['measure-system'];

							if(!empty($measure_system)) {

								if($measure_system == "1") { 

									$distance = 3958.755864232 * acos(sin($post_latitude / 57.2958) * sin($geo_search_lat / 57.2958) +cos($post_latitude / 57.2958) * cos($geo_search_lat / 57.2958) *cos($geo_search_lng / 57.2958 - $post_longitude / 57.2958));


								} else {

									$distance = 6371 * acos(sin($post_latitude / 57.2958) * sin($geo_search_lat / 57.2958) +cos($post_latitude / 57.2958) * cos($geo_search_lat / 57.2958) *cos($geo_search_lng / 57.2958 - $post_longitude / 57.2958));

								}

							} else {

								$distance = 6371 * acos(sin($post_latitude / 57.2958) * sin($geo_search_lat / 57.2958) +cos($post_latitude / 57.2958) * cos($geo_search_lat / 57.2958) *cos($geo_search_lng / 57.2958 - $post_longitude / 57.2958));

							}

							if( $distance <= $geo_radius_search ) {

								$total_items_geo++;

						?>

						<div class="col-sm-4">

								<?php 

								if(has_post_thumbnail()) { 

									$image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

									$image_src = $image_src_all[0];

								} elseif(!empty($redux_default_img_bg)) { 

									$image_src = esc_url($redux_default_img_bg); 

								} else { 

									$image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

								} 

								?> 

								<div class="listing-container">

											<a class="listing-container-big-button" href="<?php the_permalink(); ?>"></a>
											
											<div class="listing-container-block" >

												<div class="listing-container-block-body">

													<div class="listing-block-title">

														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

														<span class="listing-container-event-date">

															<?php 

																$event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);

															?> 

															<?php if(!empty($event_address_city)) { ?>
																<span><i class="fa fa-map-marker"></i><?php echo esc_attr($event_address_city); ?></span>
															<?php } ?>

														</span>

													</div>



													<?php

														global $wpdb, $all_reviews_media;
														$post_id = get_the_ID();
														$table_name = "td_reviews";

														if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

															$all_reviews = $wpdb->get_var( "SELECT COUNT(*) FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

															if(!empty($all_reviews) && $all_reviews != 0) {

																$all_reviews_media = $wpdb->get_results( "SELECT * FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

																$review_media_total = 0;

																foreach ($all_reviews_media as $key) {

																	$review_media = $key->listing_review_values_med;

																	$review_media_total = $review_media_total + $review_media;

																}

																$review_overall = $review_media_total/$all_reviews;

															}

														}

													?>

													<div class="listing-container-rating">

														<i class="fa fa-calendar"></i>

														<?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); if(!empty($event_start_date)) { ?>

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

														<span><?php echo esc_attr($start_date); ?></span>

														<?php } ?>

													</div>

													<div class="listing-container-views">

														<i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?></span>

													</div>

													<?php 

														$this_post_id = get_the_ID();

										      			$allFav = $wpdb->get_var( 'SELECT COUNT(*) FROM td_favorites WHERE listing_id = "'.$this_post_id.'" ' );

										      			if(empty($allFav)) {
										      				$allFav = 0;
										      			}

										      		?>

													<div class="listing-container-bookmarks">

														<i class="fa fa-heart"></i><span><?php echo esc_attr($allFav); ?></span>

													</div>

												</div>

											</div>

											<div class="listing-container-black-shadow"></div>

											<div class="listing-container-image-bg" style="background: #fff url(<?php echo esc_url($image_src); ?>) no-repeat center center;"></div>

										</div>

							</div>

							<?php } ?>

							<?php } else { ?>

							<div class="col-sm-4">

								<?php 

								if(has_post_thumbnail()) { 

									$image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

									$image_src = $image_src_all[0];

								} elseif(!empty($redux_default_img_bg)) { 

									$image_src = esc_url($redux_default_img_bg); 

								} else { 

									$image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

								} 

								?> 

								<div class="listing-container">

											<a class="listing-container-big-button" href="<?php the_permalink(); ?>"></a>
											
											<div class="listing-container-block" >

												<div class="listing-container-block-body">

													<div class="listing-block-title">

														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

														<span class="listing-container-event-date">

															<?php 

																$event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);

															?> 

															<?php if(!empty($event_address_city)) { ?>
																<span><i class="fa fa-map-marker"></i><?php echo esc_attr($event_address_city); ?></span>
															<?php } ?>

														</span>

													</div>



													<?php

														global $wpdb, $all_reviews_media;
														$post_id = get_the_ID();
														$table_name = "td_reviews";

														if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

															$all_reviews = $wpdb->get_var( "SELECT COUNT(*) FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

															if(!empty($all_reviews) && $all_reviews != 0) {

																$all_reviews_media = $wpdb->get_results( "SELECT * FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

																$review_media_total = 0;

																foreach ($all_reviews_media as $key) {

																	$review_media = $key->listing_review_values_med;

																	$review_media_total = $review_media_total + $review_media;

																}

																$review_overall = $review_media_total/$all_reviews;

															}

														}

													?>

													<div class="listing-container-rating">

														<i class="fa fa-calendar"></i>

														<?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); if(!empty($event_start_date)) { ?>

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

														<span><?php echo esc_attr($start_date); ?></span>

														<?php } ?>

													</div>

													<div class="listing-container-views">

														<i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?></span>

													</div>

													<?php 

														$this_post_id = get_the_ID();

										      			$allFav = $wpdb->get_var( 'SELECT COUNT(*) FROM td_favorites WHERE listing_id = "'.$this_post_id.'" ' );

										      			if(empty($allFav)) {
										      				$allFav = 0;
										      			}

										      		?>

													<div class="listing-container-bookmarks">

														<i class="fa fa-heart"></i><span><?php echo esc_attr($allFav); ?></span>

													</div>

												</div>

											</div>

											<div class="listing-container-black-shadow"></div>

											<div class="listing-container-image-bg" style="background: #fff url(<?php echo esc_url($image_src); ?>) no-repeat center center;"></div>

										</div>

							</div>

							<?php } ?>

							<?php endwhile; ?>

							<div class="col-sm-12">

								<?php 

									global $wp_rewrite;			
									$custom_posts->query_vars['paged'] > 1 ? $current = $custom_posts->query_vars['paged'] : $current = 1;

									$td_pagination = array(
										'base' => esc_url_raw(@add_query_arg('page','%#%')),
										'format' => '',
										'total' => $custom_posts->max_num_pages,
										'current' => $current,
										'show_all' => false,
										'type' => 'plain',
										);

									$td_pagination['base'] = '#%#%';

									if( !empty($custom_posts->query_vars['s']) )
										$td_pagination['add_args'] = array('s'=>get_query_var('s'));

									$total_pages = $custom_posts->max_num_pages;

									if($total_pages > 1) {
										echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 
									}

								?>

							</div>

							<?php } else { ?>

								<div class="col-sm-12"><?php _e( 'No listings found.', 'themesdojo' ); ?></div>

							<?php } ?>

							<?php

							if($geo_status == 1) {

								$total_items = $total_items_geo;

								if($total_items_geo == 0) { ?>

								<div class="col-sm-12"><?php _e( 'No listings found.', 'themesdojo' ); ?></div>

								<?php }
							}
								
							?>

							<input type="hidden" id="total_items" value="<?php echo esc_attr($total_items); ?>" />

							<script type="text/javascript">

								jQuery(document).ready(function($) {
									jQuery(".page-title-aright span").text(<?php echo esc_attr($total_items); ?>);
								});

							</script>

						</div>
