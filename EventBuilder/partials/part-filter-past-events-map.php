										<?php 

											$geo_status = 0;

											$page = sanitize_text_field($_POST['my_listings_current_page']);

											$keyword = sanitize_text_field($_POST['filterKeywords']);
											$cat = $_POST['category'];
											$loc = $_POST['listingFormLoc'];
											$time = sanitize_text_field($_POST['listingFormTime']);
											if(isset($_POST['cat_tag'])) { $tags = $_POST['cat_tag']; } else { $tags = ""; }
											if(isset($_POST['geo-radius'])) { $geo_radius_search =  $_POST['geo-radius']; } else { $geo_radius_search = ""; };
											if(isset($_POST['item_address_latitude'])) { $geo_search_lat = $_POST['item_address_latitude']; } else { $geo_search_lat =""; };
											if(isset($_POST['item_address_longitude'])) { $geo_search_lng = $_POST['item_address_longitude']; } else { $geo_search_lng = ""; };

											global $redux_demo, $maximRange; 
											$max_range = $redux_demo['max_range'];
											if(!empty($max_range)) {
												$maximRange = $max_range;
											} else {
												$maximRange = 1000;
											}

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


											if( ($geo_search_lat != 0) OR ($geo_search_lng != 0) ) {
												$geo_status = 1;
											}

											if(!empty($tags)) {
												$tags = implode(',', $tags);
											}

												$post_per_page = "&posts_per_page=-1";
												$page = 1;
											

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
												                'value'   => 'past',
												            ),
												            $time_args,
												        ),
												    )
												);


											?>
												

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

															var latlng = new google.maps.LatLng(<?php if(empty($post_latitude)) { ?>40.7127837<?php } else { echo esc_attr($post_latitude); } ?>, <?php if(empty($post_longitude)) { ?>-74.00594130000002<?php } else { echo esc_attr($post_longitude); } ?>);
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

														    var totalItems = 0;

													<?php


															if ( $custom_posts->have_posts() ) {

															while ($custom_posts->have_posts()) : $custom_posts->the_post(); 

																$post_latitude = get_post_meta(get_the_ID(), 'event_address_latitude', true);
																$post_longitude = get_post_meta(get_the_ID(), 'event_address_longitude', true);

																$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle;

																if(!empty($post_latitude) AND $post_latitude != 0) {

																	if($geo_status == 1) {

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

																
																?> 

																<?php get_template_part( 'inc/BFI_Thumb' ); ?>
																<?php 

																	$terms = get_the_terms(get_the_ID(), 'event_loc' );
																	if ($terms && ! is_wp_error($terms)) :
																		$term_slugs_arr = array();
																		foreach ($terms as $term) {
																			$term_slugs_arr[] = $term->name;
																		}
																		$terms_slug_str_loc = join( " ", $term_slugs_arr);
																	endif;

																	$terms = get_the_terms(get_the_ID(), 'event_cat' );
																	if ($terms && ! is_wp_error($terms)) :
																		$term_slugs_arr = array();
																		foreach ($terms as $term) {
																			$term_slugs_arr[] = $term->name;
																		}
																		$terms_slug_str_cat = join( " ", $term_slugs_arr);
																	endif;

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

																	$params = array( "width" => 100, "height" => 100, "crop" => true );

																?>

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

															        var siteLatLng = new google.maps.LatLng(<?php echo esc_attr($post_latitude); ?>, <?php echo esc_attr($post_longitude); ?>);
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

														            totalItems++;
												            		jQuery(".page-title-aright span.map-pins-total").text(totalItems);

																<?php } }  else { ?>

																	<?php get_template_part( 'inc/BFI_Thumb' ); ?>
																<?php

																	$terms = get_the_terms(get_the_ID(), 'event_loc' );
																	if ($terms && ! is_wp_error($terms)) :
																		$term_slugs_arr = array();
																		foreach ($terms as $term) {
																			$term_slugs_arr[] = $term->name;
																		}
																		$terms_slug_str_loc = join( " ", $term_slugs_arr);
																	endif;

																	$terms = get_the_terms(get_the_ID(), 'event_cat' );
																	if ($terms && ! is_wp_error($terms)) :
																		$term_slugs_arr = array();
																		foreach ($terms as $term) {
																			$term_slugs_arr[] = $term->name;
																		}
																		$terms_slug_str_cat = join( " ", $term_slugs_arr);
																	endif; 

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
																	
																	$params = array( "width" => 100, "height" => 100, "crop" => true );  

																	?>

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

															        var siteLatLng = new google.maps.LatLng(<?php echo esc_attr($post_latitude); ?>, <?php echo esc_attr($post_longitude); ?>);
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

														            totalItems++;
												            		jQuery(".page-title-aright span.map-pins-total").text(totalItems);

																<?php } } endwhile; } ?>

															jQuery(".page-title-aright span.map-pins-total").text(totalItems);

															map.fitBounds(bounds);

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
													      	value: <?php if(empty($geo_radius_search)) { echo "100"; } else { echo esc_attr($geo_radius_search); } ?>,
													      	min: 1,
													      	max: 500,
													      	slide: function( event, ui ) {
													       		jQuery( "#geo-radius" ).val( ui.value );
													       		jQuery( "#geo-radius-search" ).val( ui.value );
													      	}
													    });
													    jQuery( "#geo-radius" ).val( jQuery( "#advance-search-slider" ).slider( "value" ) );
													    jQuery( "#geo-radius-search" ).val( jQuery( "#advance-search-slider" ).slider( "value" ) );

														});

													</script>



