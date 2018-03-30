		<?php 

		$page = get_page(get_the_ID());
		$current_page_id = $page->ID;

		$page_slider = esc_attr(get_post_meta($current_page_id, 'page_slider', true)); 

		?>

		<?php if($page_slider == "search-events") : ?>

		<?php if(has_post_thumbnail()) { 

			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );  $image_src = $image_src[0]; 

		} elseif(!empty($redux_default_img_bg)) { 

			$image_src = $redux_default_img_bg; 

		} else { 

			$image_src = get_template_directory_uri()."/images/title-bg.jpg"; 

		} ?>

		<div id="search-items-events-block" style="background-image: url(<?php echo esc_url($image_src); ?>);" data-0="background-position: 50% -100px" data-700="background-position: 50% 100px">

			<div class="container box">

				<div class="row">

					<div class="col-sm-12">

						<div class="explore-fun-block" style="width: 100%; text-align: center;">
							<h2><i class="fa fa-child"></i></h2>
							<h2><?php _e( "Explore the fun", "themesdojo" ); ?></h2>
							<h4><?php _e( "Discover awesome events around you. And not only :)", "themesdojo" ); ?></h4>
						</div>

					</div>

					<div class="col-sm-12">

							<?php
								global $redux_demo; 
								$all_events = $redux_demo['page-url-all-events'];
								if(!empty($all_events)) {
							?>

							<form action="<?php echo get_permalink( $all_events ); ?>" method="get" accept-charset="UTF-8">

								<div class="col-sm-3">

									<i class="explore-fun-block-icon fa fa-calendar"></i>

									<select id="listingFormTime" name="time">

										<option value=""><?php _e( "When", "themesdojo" ); ?></option>
										<option value="1"><?php _e( "Today", "themesdojo" ); ?></option>
										<option value="2"><?php _e( "This Week", "themesdojo" ); ?></option>
										<option value="3"><?php _e( "This Month", "themesdojo" ); ?></option>

									</select>

								</div>

								<div class="col-sm-3">

									<i class="explore-fun-block-icon fa fa-tags"></i>

									<select name="category">

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

								<div class="col-sm-3">

									<i class="explore-fun-block-icon fa fa-map-marker"></i>

									<select name="location">

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

								<div class="col-sm-3" style="text-align: center;">

									<i class="explore-fun-block-icon fa fa-binoculars"></i>

									<button class="td-buttom" type="submit" style="width: 100%; padding: 16px 15px;"><i class="fa fa-search"></i><?php _e( 'Show me the fun!', 'themesdojo' ); ?></button>

								</div>

							</form>

							<?php } else { ?>

							<div class="col-sm-12" style="text-align: center;">

								<div class="section-header">
					               	<h3><?php _e( 'If you are the admin, please setup "all events" page in backend.', 'themesdojo' ); ?></h3>
					           	</div>

							</div>

							<?php } ?>

					</div>

				</div>

			</div>

			<div id="search-items-events-block-shadow"></div>
			<!-- Youtube -->

			<?php $video_id = get_post_meta($current_page_id, 'video_code_bg', true); ?>

			<?php if(!empty($video_id)) { ?>
				
			<!-- Slideshow Container -->
			<div id="fullscreen-gallery-v2">

				<script type="text/javascript">
					jQuery(function(){
						jQuery(".player").mb_YTPlayer();
					});
				</script>
						
				<div id="wrapper-video-bg">

					<div id="wrapper-video-container-bg" class="player fullscreen-video mb_YTVPlaye" data-property="{videoURL:'http://youtu.be/<?php echo $video_id; ?>',containment:'self',autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, showControls:false}" data-0="margin-top: 0px" data-700="margin-top: 150px"></div>

				</div>
							
				<?php

					/* add javascript */
					wp_enqueue_script( 'ytplayer', get_template_directory_uri().'/js/jquery.ytplayer.js', array('jquery'));
								
				?>

			</div>	
			<!-- End Youtube -->

			<?php } ?>

		</div>

		<?php elseif($page_slider == "bigmap") : ?>

		<?php

			themesdojo_load_map_scripts();

			global $redux_demo, $cat_id; 
			if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; } 

			global $redux_demo, $maximRange; 
			$max_range = $redux_demo['max_range'];
			if(!empty($max_range)) {
				$maximRange = $max_range;
			} else {
				$maximRange = 1000;
			}

			global $keyword, $cat, $loc, $time;

			$custom_posts = new WP_Query();
			$custom_posts->query('post_type=event&posts_per_page=-1&post_status=publish&event_cat=&event_loc=&meta_key=event_start_date_number&orderby=meta_value&order=ASC');
			$total_items = $custom_posts->post_count;

		?>

		<!-- Big Map -->
		<div id="big-map-header" class="only-map-page">

			<div id="map-canvas-holder">

				<div id="map-canvas"></div>

				<div id="map-canvas-shadow"><i class="fa fa-spinner fa-spin"></i></div>

			</div>

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12" style="margin-top: -88px; z-index: 999;">

						<div class="item-block-title">

							<i class="fa fa-child"></i><h4><?php _e( "Explore the fun", "themesdojo" ); ?></h4>

							<span class="page-title-aright">
								<span class="map-pins-total"></span> <?php if($total_items == 1) { _e( 'Result Found', 'themesdojo' ); } elseif($total_items == 0) { _e( 'No Results Found', 'themesdojo' ); } else { _e( 'Results Found', 'themesdojo' ); } ?>
							</span>

						</div>

						<div class="item-block-content">

							<form id="td-filter-listings" type="post" action="" >

								<div class="row">

									<div class="col-sm-3">

										<input type="text" name="filterKeywords" id="filterKeywords" value="<?php echo esc_attr($keyword); ?>" class="input-textarea" placeholder='<?php _e( "Keywords", "themesdojo" ); ?>' />

									</div>

									<div class="col-sm-3">

										<select id="listingFormTime" name="listingFormTime">

											<option value="" <?php selected( $time, "" ); ?>><?php _e( "When", "themesdojo" ); ?></option>
											<option value="1" <?php selected( $time, 1 ); ?>><?php _e( "Today", "themesdojo" ); ?></option>
											<option value="2" <?php selected( $time, 2 ); ?>><?php _e( "This Week", "themesdojo" ); ?></option>
											<option value="3" <?php selected( $time, 3 ); ?>><?php _e( "This Month", "themesdojo" ); ?></option>

										</select>

									</div>

									<div class="col-sm-3">

										<select id="listingFormCat" name="category">

											<option value=""><?php _e( "What", "themesdojo" ); ?></option>

											<?php

												$categories = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => 0) );

												foreach ($categories as $category) {
													$option = '<option value="'.$category->slug.'" '.selected( $cat, $category->slug ).'>';
													$option .= $category->cat_name;
													$option .= '</option>';

													$catID = $category->term_id;

													$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $catID) );

													foreach ($categories_child as $category_child) {
														$option .= '<option value="'.$category_child->slug.'" '.selected( $cat, $category_child->slug ).'> - ';
														$option .= $category_child->cat_name;
														$option .= '</option>';

													}

													echo $option;
												}

											?>

										</select>

									</div>

									<div class="col-sm-3">

										<select id="listingFormLoc" name="listingFormLoc">

											<option value=""><?php _e( "Where", "themesdojo" ); ?></option>

											<?php

												$categories = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => 0) );

												foreach ($categories as $category) {
													$option = '<option value="'.$category->slug.'" '.selected( $loc, $category->slug ).'>';
													$option .= $category->cat_name;
													$option .= '</option>';

													$catID = $category->term_id;

													$categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

													foreach ($categories_child as $category_child) {
														$option .= '<option value="'.$category_child->slug.'" '.selected( $loc, $category_child->slug ).'> - ';
														$option .= $category_child->cat_name;
														$option .= '</option>';

													}

													echo $option;
												}

											?>

										</select>

										<input type="hidden" id="latitude" name="event_address_latitude" value="<?php if(!empty($event_address_latitude)) { echo esc_attr($event_address_latitude); } ?>" size="12" class="form-text required">
										<input type="hidden" id="longitude" name="event_address_longitude" value="<?php if(!empty($event_address_longitude)) { echo esc_attr($event_address_longitude); } ?>" size="12" class="form-text required">

										<div id="advance-search-slider" class="value-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
											<a class="ui-slider-handle ui-state-default ui-corner-all" href="#">
												<span class="range-pin">
													<input type="text" name="geo-radius" id="geo-radius" value="100" data-default-value="100">
												</span>
											</a>
										</div>

										<div id="map-script-holder">

											<script type="text/javascript">

														jQuery(document).ready(function($) {

															var geocoder;
															var map;
															var marker;
															var markers = [];

															var geocoder = new google.maps.Geocoder();

															function geocodePosition(pos) {
																geocoder.geocode({
																latLng: pos
																}, function(responses) {
																	if (responses && responses.length > 0) {
																		updateMarkerAddress(responses[0].formatted_address);
																	} else {
																		updateMarkerAddress('Cannot determine address at this location.');
																	}
																});

																jQuery('.locate-me').removeClass('loading');
																jQuery('.locate-me').removeClass('fa-spin');
															}

															function updateMarkerPosition(latLng) {
																jQuery('#latitude').val(latLng.lat());
																jQuery('#longitude').val(latLng.lng());
																jQuery( "#advance-search-slider" ).css("display", "inline-block");
															}

															function updateMarkerAddress(str) {
																jQuery('#filterLocation').val(str);
															}

															function initialize() {

																var latlng = new google.maps.LatLng(<?php if(empty($event_address_latitude)) { ?>40.7127837<?php } else { echo esc_attr($event_address_latitude); } ?>, <?php if(empty($event_address_longitude)) { ?>-74.00594130000002<?php } else { echo esc_attr($event_address_longitude); } ?>);
																	var mapOptions = {
																		zoom: 16,
																		scrollwheel: false,
																		<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>styles: <?php echo $map_style; ?>, <?php } ?>
																		center: latlng
																}

																map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

																var oms = new OverlappingMarkerSpiderfier(map);

														      	oms.addListener('spiderfy', function(markers) {
														      	});
														      	oms.addListener('unspiderfy', function(markers) {
														     	});

																geocoder = new google.maps.Geocoder();

																var infowindow = new google.maps.InfoWindow(); 
															    //var marker, i;
															    var bounds = new google.maps.LatLngBounds();

																<?php

																	if ( $custom_posts->have_posts() ) {

																		while ($custom_posts->have_posts()) : $custom_posts->the_post();

																		$event_address_latitude = get_post_meta(get_the_ID(), 'event_address_latitude', true);
																		$event_address_longitude = get_post_meta(get_the_ID(), 'event_address_longitude', true);

																		$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle;

																		if(!empty($event_address_latitude) AND $event_address_latitude != 0) {

																			$post_id = get_the_ID();

																			$terms = get_the_terms($post_id, 'event_cat' );
																			if ($terms && ! is_wp_error($terms)) :
																				$term_slugs_arr = array();
																				foreach ($terms as $term) {
																					$term_id_arr = $term->term_id;
																					$parent      = $term->parent;
																				}
																			endif;

															        		$cat_id = $term_id_arr;

																			if($parent == 0) {

																				$tag = $cat_id;

																				$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
																				$your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';

																			} else {

																				$term_id = $cat_id; //Get ID of current term
																				$ancestors = get_ancestors( $term_id, 'event_cat' ); // Get a list of ancestors
																				$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
																				$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
																				$term = get_term( $top_term_id, 'event_cat' ); //Get the term
																				$tag = $term->term_id;

																				$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
																				$your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';

																			}

																			if(!empty($your_image_url)) {

																				$iconPath = $your_image_url;

																			} else {

																				$iconPath = get_template_directory_uri() .'/images/icon-services.png';

																			} 

																			$terms = get_the_terms(get_the_ID(), 'event_cat' );
																			if ($terms && ! is_wp_error($terms)) :
																				$term_slugs_arr = array();
																				foreach ($terms as $term) {
																				    $term_slugs_arr[] = $term->name;
																				}
																				$terms_slug_str_cat = join( " ", $term_slugs_arr);
																			endif;

																
																?> 

																<?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); $event_start_time = get_post_meta(get_the_ID(), 'event_start_time', true); $event_location = get_post_meta(get_the_ID(), 'event_location', true); ?>

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

																<?php get_template_part( 'inc/BFI_Thumb' ); ?>
																<?php $params = array( "width" => 100, "height" => 100, "crop" => true ); ?>

															        var siteLatLng = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>, <?php echo esc_attr($event_address_longitude); ?>);
														            var marker = new google.maps.Marker({
														                position: siteLatLng,
														                map: map,
														                title: '<?php echo esc_attr($theTitle); ?>',
														                html: '<div class="marker-holder"><div class="marker-content"><div class="marker-image"><img src="<?php echo bfi_thumb( "$image_src", $params ) ?>" /></div><div class="marker-info-holder"><div class="marker-info"><div class="marker-info-title"><a href="<?php the_permalink(); ?>"><?php echo esc_attr($theTitle); ?></a><span class="marker-meta"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span><span class="marker-meta"><i class="fa fa-folder-o"></i><?php echo esc_attr($terms_slug_str_cat); ?></span></div></div></div><div class="close"></div></div></div>',
														                icon: '<?php echo esc_url($iconPath); ?>'
														            });

														            var contentString = "...";

														            google.maps.event.addListener(marker, "click", function () {
														                infowindow.setContent(this.html);
														                infowindow.open(map, this);
														            });
														            bounds.extend(siteLatLng);
														            markers.push(marker);
														            oms.addMarker(marker);
																<?php } endwhile; } ?>	
																map.fitBounds(bounds);
																jQuery(".only-map-page #map-canvas-shadow").css("display","none");
																var markerCluster = new MarkerClusterer(map, markers, { maxZoom: 9 });

															}

															$.fn.tdClearMap = function() {
														        //Loop through all the markers and remove
														        for (var i = 0; i < markers.length; i++) {
														            markers[i].setMap(null);
														        }
														        markers = [];
														    };

															//google.maps.event.addDomListener(window, 'load', initialize);

															jQuery(document).ready(function() { 
																						         
																initialize();
																						          
																jQuery(function() {
																	jQuery("#filterLocation").autocomplete({
																	//This bit uses the geocoder to fetch address values
																	source: function(request, response) {
																		geocoder.geocode( {'address': request.term }, function(results, status) {
																			response(jQuery.map(results, function(item) {
																				return {
																					label:  item.formatted_address,
																					value: item.formatted_address,
																					latitude: item.geometry.location.lat(),
																					longitude: item.geometry.location.lng()
																				}
																			}));
																		})
																	},
																	//This bit is executed upon selection of an address
																	select: function(event, ui) {
																		jQuery("#latitude").val(ui.item.latitude);
																		jQuery("#longitude").val(ui.item.longitude);
																		jQuery( "#advance-search-slider" ).css("display", "inline-block");

																		var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

																	}
																});
															});

															jQuery(document).on('click','.locate-me', function() {

																jQuery(this).addClass('loading');
																jQuery(this).addClass('fa-spin');

																navigator.geolocation.getCurrentPosition(function(position) {
															      	var pos = new google.maps.LatLng(position.coords.latitude,  position.coords.longitude);
															      	geocodePosition(pos);
																	jQuery('#latitude').val(position.coords.latitude);
																	jQuery('#longitude').val(position.coords.longitude);
																	jQuery( "#advance-search-slider" ).css("display", "inline-block");
															    });
																				
															});

														});

														jQuery( "#advance-search-slider" ).slider({
													      	range: "min",
													      	value: 100,
													      	min: 1,
													      	max: <?php echo esc_attr($maximRange); ?>,
													      	slide: function( event, ui ) {
													       		jQuery( "#geo-radius" ).val( ui.value );
													       		jQuery( "#geo-radius-search" ).val( ui.value );
													      	}
													    });
													    jQuery( "#geo-radius" ).val( jQuery( "#advance-search-slider" ).slider( "value" ) );
													    jQuery( "#geo-radius-search" ).val( jQuery( "#advance-search-slider" ).slider( "value" ) );

														});

													</script>

										</div>

									</div>

									<div class="col-sm-12">

										<div class="filter-by-tag-holder">

											<div class="row">

												<div class="col-sm-6">

													<span id="header-settings-block-expand" class="td-buttom collapsed"  data-toggle="collapse" data-target="#main-settings-block" style="float: left; margin-right: 10px;">

														<i class="fa fa-filter"></i>
														<span><?php _e( 'Advanced Filters', 'themesdojo' ); ?></span>

													</span>

												</div>

												<div class="col-sm-6" style="float: right;">

													<button class="td-buttom" id="submit-filter" name="submit" type="submit"><i class="fa fa-check"></i><?php _e( 'Update Listings', 'themesdojo' ); ?></button>

													<button class="td-buttom" id="reset-filter" name="submit" type="submit" style="margin-bottom: 0!important"><i class="fa fa-times"></i><?php _e( 'Reset', 'themesdojo' ); ?></button>

												</div>

												<div class="col-sm-12">

													<div id="main-settings-block" class="collapse">

														<div class="row filter-by-tag-wide">

															<?php $tags = get_terms('event_tag'); if(!empty($tags)) { ?>

																<?php

																	foreach ( (array) $tags as $tag ) {

																?>

																	<div class="col-sm-3 tag-filter-item">

																		<a href="#" class="tag-filter" title="<?php echo esc_attr($tag->slug); ?>" name="<?php echo esc_attr($tag->slug); ?>" ><span class="tag-filter-icon"></span><span class="tag-filter-title"><?php echo esc_attr($tag->name); ?></span></a>

																	</div>

																<?php
																	}

																?>

															<?php } ?>

															<div id="filter-tags-holder">

															</div>

															<script type="text/javascript">

																jQuery(document).ready(function($) {

																	jQuery(document).on('click','.filter-by-tag-wide a', function(e) {

																		e.preventDefault();

																		var tag_name = jQuery(this).attr('title');
																		var tag_slug = jQuery(this).attr('name');

																		if ( jQuery(this).hasClass('active') ) {

															                jQuery(this).removeClass('active');

															                jQuery('#filter-tags-holder .tag-name-'+tag_slug).remove();

															            } else {

															                jQuery(this).addClass('active');

															                jQuery("#filter-tags-holder").append('<input class="tag-name-'+tag_slug+'" type="hidden" name="cat_tag[]" value="'+tag_name+'">');

															            }

																		$.fn.tdSubmitFilterMap();
																					
																	});

																});

															</script>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

								<input type="hidden" id="my_listings_current_page" name="my_listings_current_page" value="1" />
								<input type="hidden" id="content_type" name="content_type" value="" />

								<input type="hidden" name="action" value="tdEventsFilterForm" />
								<?php wp_nonce_field( 'tdEventsFilter_html', 'tdEventsFilter_nonce' ); ?>

							</form>

							<?php

								$term = $wp_query->get_queried_object(); 
								$term_id = $term->slug;

							?>

							<script type="text/javascript">

								jQuery(function($) {

									jQuery(document).on('click','#reset-filter', function(e) {

										jQuery('#my_listings_current_page').val('1');
										jQuery('#filterKeywords').val('');
										jQuery('#filterLocation').val('');
										jQuery('#listingFormTime').val('');
										jQuery('#listingFormLoc').val('<?php echo esc_attr($term_id); ?>');
										jQuery('#listingFormCat').val('');
										jQuery('#latitude').val('');
										jQuery('#longitude').val('');
										jQuery('.tag-filter').removeClass('active');
										jQuery('#filter-tags-holder input').remove();
										jQuery( "#advance-search-slider" ).css("display", "none");

										$.fn.tdSubmitFilterMap();

										e.preventDefault();

									});

									jQuery(document).on('click','#submit-filter', function(e) {

										$.fn.tdSubmitFilterMap();

										e.preventDefault();

									});

									jQuery(document).on("click",".pagination a.page-numbers",function(e){

										var hrefprim = jQuery(this).attr('href');
										var href = hrefprim.replace("#", "");

						                jQuery('#my_listings_current_page').val(href);

										$.fn.tdSubmitFilterMap();

										e.preventDefault();
										return false;

									});

									$.fn.tdSubmitFilter = function() {

										jQuery('#content_type').val('grid-full-width');

										jQuery('#td-filter-listings').ajaxSubmit({
											type: "POST",
											data: jQuery('#td-filter-listings').serialize(),
											url: '<?php echo admin_url('admin-ajax.php'); ?>',
											beforeSend: function() { 
												jQuery("#cat-listing-holder").css("display", "none");
												jQuery(".listing-loading").fadeIn(200);
											},	 
											success: function(response) {
												jQuery("#cat-listing-holder").html(response);
												jQuery("#cat-listing-holder").fadeIn(200);
												jQuery(".listing-loading").css("display", "none");
												var total_items = jQuery("#total_items").val();
												jQuery(".page-title-aright span").html(total_items);
											}
										});

									}

									$.fn.tdSubmitFilterMap = function() {

										$.fn.tdClearMap();

										jQuery('#content_type').val('map');

										jQuery('#td-filter-listings').ajaxSubmit({
											type: "POST",
											data: jQuery('#td-filter-listings').serialize(),
											url: '<?php echo admin_url('admin-ajax.php'); ?>',
											beforeSend: function() { 
												jQuery("#map-script-holder").html("");
												jQuery(".only-map-page #map-canvas-shadow").css("display","inline-block");
											},	 
											success: function(response) {
												jQuery("#map-script-holder").html(response);
												jQuery(".only-map-page #map-canvas-shadow").css("display","none");
											}
										});

									}


								});

							</script>

						</div>

					</div>

					<div class="col-sm-12"><noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'themesdojo' ); ?></noscript></div>

					<div class="col-sm-12"><div class="listing-loading"><h3><i class="fa fa-spinner fa-spin"></i></h3></div></div>

				</section>

			</div>

		</div>
		<!-- End Big Map -->

		<?php elseif($page_slider == "video") : ?>

		<!-- Youtube -->
		<?php $video_id = get_post_meta($current_page_id, 'video_code', true); ?>
			
		<!-- Slideshow Container -->
		<div id="fullscreen-gallery">

			<script type="text/javascript">
				jQuery(function(){
					jQuery(".player").mb_YTPlayer();
				});
			</script>
					
			<div id="wrapper-video">

				<div id="wrapper-video-container" class="player fullscreen-video mb_YTVPlaye" data-property="{videoURL:'http://youtu.be/<?php echo $video_id; ?>',containment:'self',autoPlay:true, loop:true, vol:10, startAt:0, opacity:1, showControls:false}" data-0="margin-top: 0px" data-700="margin-top: 150px"></div>

			</div>
						
			<?php

				/* add javascript */
				wp_enqueue_script( 'ytplayer', get_template_directory_uri().'/js/jquery.ytplayer.js', array('jquery'));
							
			?>

		</div>	
		<!-- End Youtube -->

		<?php elseif($page_slider == "layerslider") : ?>

		<!-- Parallax Container -->
		<div id="layerslider">

			<?php

				$page_layer_slider_shortcode = get_post_meta($current_page_id, 'layerslider_shortcode', true);

				if(!empty($page_layer_slider_shortcode))
				{

			?>

				<?php echo do_shortcode($page_layer_slider_shortcode); ?>

			<?php } else { ?>

				<?php echo do_shortcode('[layerslider id="1"]'); ?>

			<?php } ?>

		</div>	
		<!-- End Parallax Container -->

		<?php endif; ?>