<?php
/**
 * Template name: All Events v4
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php the_title(); ?></h1>

							</div>

						</div>

					</div>

				</div>

				<div class="page-title-bg">

					<?php if(has_post_thumbnail()) { ?>

						<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

					<?php } elseif(!empty($redux_default_img_bg)) { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($redux_default_img_bg); ?>" alt="" />

					<?php } else { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo get_template_directory_uri(); ?>/images/title-bg.jpg" alt="" />

					<?php } ?>

				</div>

			</div>

		<?php } ?>

		<div id="main-wrapper" class="content grey-bg" style="padding: 30px 0;">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="post">

							<div class="row upcoming-events-filter">

								<form id="td-filter-events" type="post" action="" >

									<div class="col-md-15 col-sm-3">

										<select id="location-events" name="location">

											<option value=""><?php _e( "Where", "themesdojo" ); ?></option>

											<?php

												$categories = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => 0) );

												foreach ($categories as $category) {
													$option = '<option value="'.$category->slug.'">';
													$option .= $category->cat_name;
													$option .= '</option>';

													$catID = $category->term_id;

													$categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

													foreach ($categories_child as $category_child) {
														$option .= '<option value="'.$category_child->slug.'"> - ';
														$option .= $category_child->cat_name;
														$option .= '</option>';

													}

													echo $option;
												}

											?>

										</select>

									</div>

									<div class="col-md-15 col-sm-3">

										<select id="category-events" name="category">

											<option value=""><?php _e( "What", "themesdojo" ); ?></option>

											<?php

												$categories = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => 0) );

												foreach ($categories as $category) {
													$option = '<option value="'.$category->slug.'">';
													$option .= $category->cat_name;
													$option .= '</option>';

													$catID = $category->term_id;

													$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $catID) );

													foreach ($categories_child as $category_child) {
														$option .= '<option value="'.$category_child->slug.'"> - ';
														$option .= $category_child->cat_name;
														$option .= '</option>';

													}

													echo $option;
												}

											?>

										</select>

									</div>

									<div class="col-md-15 col-sm-3">

										<select id="year-event-filter" name="year">

											<option value=""><?php _e( "Year", "themesdojo" ); ?></option>

											<?php

												global $custom_posts2;
										        $custom_posts2 = new WP_Query();
										        $custom_posts2->query(array(
										            'post_type'      => 'event',
										            'posts_per_page' => '-1',
										            'post_status'    => 'publish',
										            'meta_key'       => 'event_start_date_number',
										            'orderby'        => 'meta_value',
										            'order'          => 'ASC',
										            'meta_query'     => array(
										                array(
										                    'key'     => 'event_status',
										                    'value'   => 'upcoming',
										                ),
										            ),
										        ));

										        if ( $custom_posts2->have_posts() ) { 

										        	while ($custom_posts2->have_posts()) : $custom_posts2->the_post();

										        		$event_start_date = get_post_meta(get_the_ID(), 'event_start_date_number', true);

										        		$event_year = date("Y", $event_start_date);

										        		$arr_year[] = $event_year;

										        	endwhile;

										        }

										        $result = array_unique($arr_year);

										        foreach ($result as $value) {
												    echo "<option value='$value'>$value</option>";
												}

											?>

										</select>

									</div>

									<div class="col-md-15 col-sm-3">

										<select id="month-event-filter" name="month" disabled>

											<option value=""><?php _e( "Month", "themesdojo" ); ?></option>
											<option value="1"><?php _e( "January", "themesdojo" ); ?></option>
											<option value="2"><?php _e( "February", "themesdojo" ); ?></option>
											<option value="3"><?php _e( "March", "themesdojo" ); ?></option>
											<option value="4"><?php _e( "April", "themesdojo" ); ?></option>
											<option value="5"><?php _e( "May", "themesdojo" ); ?></option>
											<option value="6"><?php _e( "June", "themesdojo" ); ?></option>
											<option value="7"><?php _e( "July", "themesdojo" ); ?></option>
											<option value="8"><?php _e( "August", "themesdojo" ); ?></option>
											<option value="9"><?php _e( "Setpember", "themesdojo" ); ?></option>
											<option value="10"><?php _e( "October", "themesdojo" ); ?></option>
											<option value="11"><?php _e( "November", "themesdojo" ); ?></option>
											<option value="12"><?php _e( "December", "themesdojo" ); ?></option>

										</select>

									</div>

									<div class="col-md-15 col-sm-3">

										<select id="day-event-filter" name="day" disabled>

											<option value=""><?php _e( "Day", "themesdojo" ); ?></option>

											<?php

												for ($x = 1; $x <= 31; $x++) {
												    echo "<option value='$x'>$x</option>";
												} 

											?>

										</select>

									</div>

									<input type="hidden" id="my_listings_current_page" name="my_listings_current_page" value="1" />
									<input type="hidden" id="content_type" name="content_type" value="" />

									<input type="hidden" name="action" value="tdUpcomingEventsFilterForm" />
									<?php wp_nonce_field( 'tdUpcomingEventsFilter_html', 'tdUpcomingEventsFilter_nonce' ); ?>

								</form>

								<script>
									jQuery(function($) {

										jQuery("#location-events").change(function() {
											$.fn.tdSubmitFilter();
										}); 

										jQuery("#category-events").change(function() {
											$.fn.tdSubmitFilter();
										}); 

										var val = jQuery("#year-event-filter").val();

										if( val === "" ) {
										    jQuery("#month-event-filter").attr('disabled', 'disabled');
										} else {
										    jQuery("#month-event-filter").removeAttr('disabled');
										}

										jQuery("#year-event-filter").change(function() {
											jQuery('#my_listings_current_page').val("1");
										    var val = jQuery(this).val();
										    if( val === "" ) {
											    jQuery("#month-event-filter").attr('disabled', 'disabled');
											    jQuery("#month-event-filter").val("");
											    jQuery("#day-event-filter").attr('disabled', 'disabled');
											    jQuery("#day-event-filter").val("");
											} else {
											    jQuery("#month-event-filter").removeAttr('disabled');
											}
											$.fn.tdSubmitFilter();
										});

										var val2 = jQuery("#month-event-filter").val();

										if( val2 === "" ) {
										    jQuery("#day-event-filter").attr('disabled', 'disabled');
										    jQuery("#day-event-filter").val("");
										} else {
										    jQuery("#day-event-filter").removeAttr('disabled');
										}

										jQuery("#month-event-filter").change(function() {
											jQuery('#my_listings_current_page').val("1");
										    var val = jQuery(this).val();
										    if( val === "" ) {
											    jQuery("#day-event-filter").attr('disabled', 'disabled');
											} else {
											    jQuery("#day-event-filter").removeAttr('disabled');
											}
											$.fn.tdSubmitFilter();
										});

										jQuery("#day-event-filter").change(function() {
											jQuery('#my_listings_current_page').val("1");
											$.fn.tdSubmitFilter();
										});

										jQuery(document).on("click",".pagination a.page-numbers",function(e){

											var hrefprim = jQuery(this).attr('href');
											var href = hrefprim.replace("#", "");

								            jQuery('#my_listings_current_page').val(href);

								            $.fn.tdSubmitFilter();

											e.preventDefault();
											return false;

										});

										$.fn.tdSubmitFilter = function() {

											jQuery('#td-filter-events').ajaxSubmit({
												type: "POST",
												data: jQuery('#td-filter-events').serialize(),
												url: '<?php echo admin_url('admin-ajax.php'); ?>',
												beforeSend: function() { 
													jQuery(".upcoming-events-holder").fadeOut(200);
													jQuery(".upcoming-events-holder").html("");
													jQuery(".listing-loading").css("display", "inline-block");
												},	 
												success: function(response) {
													jQuery(".listing-loading").css("display", "none");
													jQuery(".upcoming-events-holder").html(response);
													jQuery(".upcoming-events-holder").fadeIn(200);
												}
											});

										}

									});
								</script>

							</div>

						</div>

						<div class="row">
							<div class="col-sm-12"><div class="listing-loading" style="margin-bottom: 90px;"><h3><i class="fa fa-spinner fa-spin"></i></h3></div></div>
						</div>

						<div class="row upcoming-events-holder" style="margin-bottom: 90px;">

						    <?php

						        global $custom_posts2;
						        $custom_posts2 = new WP_Query();
						        $custom_posts2->query(array(
						            'post_type'      => 'event',
						            'posts_per_page' => '20',
						            'post_status'    => 'publish',
						            'meta_key'       => 'event_start_date_number',
						            'orderby'        => 'meta_value',
						            'order'          => 'ASC',
						            'meta_query'     => array(
						                array(
						                    'key'     => 'event_status',
						                    'value'   => 'upcoming',
						                ),
						            ),
						        ));

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

						        <div class="col-sm-12"><?php _e( 'No events found.', 'themesdojo' ); ?></div>

						    <?php } ?>

						</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>