<?php
/**
 * Template name: My Account Page
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

global $current_user, $user_id, $user_info;
get_currentuserinfo();
$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
$user_info = get_userdata($user_id);

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php if ( !is_user_logged_in() ) { _e( 'Ooops', 'themesdojo' ); } else { _e( 'Hi', 'themesdojo' ); ?> <?php the_author_meta('display_name', $user_id); } ?>.</h1>

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

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div id="my-account-content">

							<?php if ( !is_user_logged_in() ) { ?>

							<style>

								#popup-td-login {
									display: block;
								}

							</style>

							<h2><?php _e( 'Please login.', 'themesdojo' ); ?></h2>

							<?php } else { ?>

						    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

						        <li class="active"><a href="#my-events" data-toggle="tab"><i class="fa fa-ticket"></i><span><h3><?php _e( 'My Events', 'themesdojo' ); ?></h3></span><i class="fa fa-chevron-right"></i></a></li>
						        <li><a href="#my-favorites" data-toggle="tab"><i class="fa fa-heart"></i><span><h3><?php _e( 'My Favorites', 'themesdojo' ); ?></h3></span><i class="fa fa-chevron-right"></i></a></li>
						        <li><a href="#my-active-plans" data-toggle="tab"><i class="fa fa-database"></i><span><h3><?php _e( 'My Active Plans', 'themesdojo' ); ?></h3></span><i class="fa fa-chevron-right"></i></a></li>
						        <li><a href="#my-transactions" data-toggle="tab"><i class="fa fa-credit-card"></i><span><h3><?php _e( 'Transactions', 'themesdojo' ); ?></h3></span><i class="fa fa-chevron-right"></i></a></li>
						        <?php 

									if ( is_user_logged_in() && current_user_can('administrator')) {

										$pending_items = $wpdb->get_var( "SELECT COUNT(*) FROM `{$wpdb->prefix}posts` WHERE (post_type = 'item' and post_status = 'pending') OR (post_type = 'event' and post_status = 'pending')");

								?>
						        <li><a href="#my-review" data-toggle="tab"><i class="fa fa-gavel"></i><span><h3><?php _e( 'Pending Items', 'themesdojo' ); ?> <?php if(!empty($pending_items)) { ?>(<?php echo esc_attr($pending_items); ?>)<?php } ?></h3></span><i class="fa fa-chevron-right"></i></a></li>
						        <?php } ?>
						        <li><a href="#my-settings" data-toggle="tab"><i class="fa fa-cog"></i><span><h3><?php _e( 'Account Settings', 'themesdojo' ); ?></h3></span><i class="fa fa-chevron-right"></i></a></li>

						    </ul>
						    <div id="my-tab-content" class="tab-content">

						        <div class="tab-pane active" id="my-events">

						        	<div class="item-block-title">

										<i class="fa fa-ticket"></i><h4><?php _e( 'My Events', 'themesdojo' ); ?></h4>

									</div>

									<div id="my-events-holder-loader" class="item-block-content item-image-gallery-block">
										<i class="fa fa-spinner fa-spin"></i>
									</div>

									<div id="my-events-holder" class="item-block-content item-image-gallery-block">

										<?php					

											$currentNum = 0;

											$listings_per_page = 5;
											$total_companies = 0;
											$current_page = max(1, get_query_var('paged'));

											query_posts( array('post_type' => 'event', 'author' => $user_id, 'posts_per_page' => 5, 'order_by' => 'ID', 'order' => 'DESC', 'post_status' => 'publish, draft, pending' ));

											$custom_posts = new WP_Query();
											$custom_posts->query('post_type=event&posts_per_page=-1&author='.$user_id.'&post_status=publish, draft, pending');
											$total_items = $custom_posts->post_count;

											$total_pages = ceil($total_items/$listings_per_page);

											if (have_posts()) : while (have_posts()) : the_post();

											$postID = get_the_ID();

											$currentNum++;

										?>

											<div id="listing-<?php echo esc_attr($postID); ?>" class="my-listings-item">

												<div class="row">

													<div class="col-sm-3">

														<?php if ( get_post_status ( $postID ) == 'publish' ) { ?>
														<span class="my-listings-item-status">
															<span><i class="fa fa-play"></i><?php _e( 'Published', 'themesdojo' ); ?></span>
														</span>
														<?php } elseif ( get_post_status ( $postID ) == 'draft' ) { ?>
														<span class="my-listings-item-status">
															<span><i class="fa fa-pencil-square-o"></i><?php _e( 'Draft', 'themesdojo' ); ?></span>
														</span>
														<?php } elseif ( get_post_status ( $postID ) == 'pending' ) { ?>
														<span class="my-listings-item-status">
															<span><i class="fa fa-pause"></i><?php _e( 'Pending', 'themesdojo' ); ?></span>
														</span>
														<?php } ?>

														<?php  

															$event_status = get_post_meta($postID, 'event_status', true);

														?>

														<span class="my-listings-item-status featured-listing">
															<span><?php echo esc_attr($event_status); ?></span>
														</span>

													</div>

													<div class="col-sm-6">

														<h2 class="my-listings-item-title"><a href="<?php if ( get_post_status ( $postID ) == 'publish' ) {  the_permalink(); } elseif ( get_post_status ( $postID ) == 'draft' ) { echo "#"; } elseif ( get_post_status ( $postID ) == 'pending' ) {  echo "#"; } ?>"><?php the_title(); ?></a></h2>

														<?php $event_start_date = get_post_meta($postID, 'event_start_date', true); $event_start_time = get_post_meta($postID, 'event_start_time', true); $event_location = get_post_meta($postID, 'event_location', true); if(!empty($event_location)) { ?>

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

															<span class="my-listings-item-metadata my-fav-metadata"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

														<?php  } ?>

														<span class="my-listings-item-metadata my-fav-metadata">
															<span>
																<i class="fa fa-map-marker"></i>
																<?php 

																	$terms = get_the_terms($postID, 'event_loc' );
																	if ($terms && ! is_wp_error($terms)) :
																		$term_slugs_arr = array();
																		foreach ($terms as $term) {
																		    $term_slugs_arr[] = $term->name;
																		}
																		$terms_slug_str = join( " ", $term_slugs_arr);
																	endif;
																	echo esc_attr($terms_slug_str); 

																?>
															</span>
														</span>

														<span class="my-listings-item-metadata my-fav-metadata">
															<i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews($postID) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span>
														</span>

													</div>

													<div class="col-sm-3">

														<?php if ( get_post_status ( $postID ) == 'publish' ) { ?>
														<span id="unpublish-button-<?php echo esc_attr($postID); ?>" class="my-listings-item-unpublish" data-rel="tooltip" rel="top" title="<?php _e( "Unpublish", "themesdojo" ); ?>">
															<i class="fa fa-eye"></i>
														</span>
														<script type="text/javascript">

															jQuery(function($) {

																jQuery(document).on("click","#unpublish-button-<?php echo esc_attr($postID); ?>",function(e){

																	jQuery('#postStatusForm #postStatus').val('unpublish');
																	jQuery('#postStatusForm #postIdStatus').val('<?php echo esc_attr($postID); ?>');

																    $.fn.tdSubmitPostStatusPublishFunction<?php echo esc_attr($postID); ?>();

																	e.preventDefault();
																	return false;

																});

																$.fn.tdSubmitPostStatusPublishFunction<?php echo esc_attr($postID); ?> = function() {

																	jQuery('#postStatusForm').ajaxSubmit({
																	    type: "POST",
																		data: jQuery('postStatusForm').serialize(),
																		url: '<?php echo admin_url('admin-ajax.php'); ?>',
																		beforeSend: function() { 
																        	jQuery('#loading-button-<?php echo esc_attr($postID); ?>').css('display', 'inline-block');
																        	jQuery('#unpublish-button-<?php echo esc_attr($postID); ?>').css('display', 'none');
																        },	 
																	    success: function(response) {
																	    	window.location.reload(true);
																	    },
																	    error: function(response) {
																	    	window.location.reload(true);
																	    }
																	});
																}

															});

														</script>
														<?php } elseif ( get_post_status ( $postID ) == 'draft' ) { ?>
														<span id="publish-button-<?php echo esc_attr($postID); ?>" class="my-listings-item-publish" data-rel="tooltip" rel="top" title="<?php _e( "Publish", "themesdojo" ); ?>">
															<i class="fa fa-eye-slash"></i>
														</span>
														<script type="text/javascript">

															jQuery(function($) {

																jQuery(document).on("click","#publish-button-<?php echo esc_attr($postID); ?>",function(e){

																	jQuery('#postStatusForm #postStatus').val('publish');
																	jQuery('#postStatusForm #postIdStatus').val('<?php echo esc_attr($postID); ?>');

																    $.fn.tdSubmitPostStatusUnpublishFunction<?php echo esc_attr($postID); ?>();

																	e.preventDefault();
																	return false;

																});

																$.fn.tdSubmitPostStatusUnpublishFunction<?php echo esc_attr($postID); ?> = function() {

																	jQuery('#postStatusForm').ajaxSubmit({
																	    type: "POST",
																		data: jQuery('postStatusForm').serialize(),
																		url: '<?php echo admin_url('admin-ajax.php'); ?>',
																		beforeSend: function() { 
																        	jQuery('#loading-button-<?php echo esc_attr($postID); ?>').css('display', 'inline-block');
																        	jQuery('#publish-button-<?php echo esc_attr($postID); ?>').css('display', 'none');
																        },	 
																	    success: function(response) {
																	    	window.location.reload(true);
																	    },
																	    error: function(response) {
																	    	window.location.reload(true);
																	    }
																	});
																}

															});

														</script>
														<?php } ?>

														<span id="loading-button-<?php echo esc_attr($postID); ?>" class="my-listings-item-loading">
															<i class="fa fa-spinner fa-spin"></i>
														</span>

														<?php

															global $redux_demo; 
															$edit_event_link = $redux_demo['page-url-edit-event']; 

															if(!empty($edit_event_link)) {

														?>

														<a href="<?php echo get_permalink( $edit_event_link ); ?>?post=<?php echo esc_attr($postID); ?>" class="my-listings-item-edit" data-rel="tooltip" rel="top" title="<?php _e( "Edit", "themesdojo" ); ?>">
															<i class="fa fa-pencil"></i>
														</a>

														<?php } ?>

														<form id="postStatusForm" type="post" action="" >

														    <input type="hidden" id="postIdStatus" name="postId" value="">
														    <input type="hidden" id="postStatus" name="postStatus" value="">

														    <input type="hidden" name="action" value="tdSubmitPostStatusForm" />
															<?php wp_nonce_field( 'tdSubmitPostStatus_html', 'tdSubmitPostStatus_nonce' ); ?>

													   	</form>

													</div>

												</div>

											</div>

										<?php

											endwhile; endif;
											wp_reset_postdata();

										?>

										<?php if($currentNum == 0) { ?>

											<p><?php _e( 'You have no listings at the moment.', 'themesdojo' ); ?></p>

										<?php } ?>

										<?php

											if($total_pages > 1) {  

								                $td_pagination = array(
													'base' => esc_url_raw(@add_query_arg('page','%#%')),
													'format' => '',
													'total' => $total_pages,
													'current' => $current_page,
													'prev_next' => true,
													'prev_text'    => __('« Previous', 'themesdojo'),
													'next_text'    => __('Next »', 'themesdojo'),
													'type' => 'plain',
													);

												if( $wp_rewrite->using_permalinks() )
													$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}
											
										?>

									</div>

									<form id="tdMyEventsPaginationForm" type="post" action="" >

										<input type="hidden" id="my_events_current_page" name="my_events_current_page" value="1" />
										<input type="hidden" name="action" value="tdMyAccountMyEventsPaginationForm" />
										<?php wp_nonce_field( 'tdMyAccountMyEventsPagination_html', 'tdMyAccountMyEventsPagination_nonce' ); ?>

									</form>

									<script type="text/javascript">

										jQuery(function($) {

											jQuery(document).on("click","#my-events-holder .pagination a.page-numbers",function(e){

										     	var hrefprim = jQuery(this).attr('href');
										     	var href = hrefprim.replace("#", "");

						                		jQuery('#my_events_current_page').val(href);

										     	$.fn.wpjobusSubmitFormFunctionEvents();

										     	e.preventDefault();
												return false;

											});

											$.fn.wpjobusSubmitFormFunctionEvents = function() {

												$contentheight = jQuery('#my-events-holder').height(),
												jQuery("html, body").animate({ scrollTop: 0 }, 800);

												jQuery('#tdMyEventsPaginationForm').ajaxSubmit({
												    type: "POST",
													data: jQuery('#tdMyEventsPaginationForm').serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													beforeSend: function() { 
											        	jQuery('#my-events-holder-loader').css('display', 'inline-block');
											        	jQuery('#my-events-holder').stop().animate({'opacity' : '0'}, 0, function() {
											        		jQuery('#my-events-holder').css('height', $contentheight);
											        	}); 
											        },	 
												    success: function(response) {
														jQuery('#my-events-holder-loader').fadeOut(100, function(){
											        		jQuery("#my-events-holder").html(response);
											        		jQuery("#my-events-holder").css('height', 'auto');
												            jQuery("#my-events-holder").stop().animate({'opacity' : '1'}, 250);
											        	});
												        return false;
												    }
												});
											}

										});

									</script>
						            
						        </div>

						        <div class="tab-pane" id="my-favorites">
						            
						            <div class="item-block-title">

										<i class="fa fa-heart"></i><h4><?php _e( 'My Favorites', 'themesdojo' ); ?></h4>

									</div>

									<div id="my-favorites-holder-loader" class="item-block-content item-image-gallery-block">
										<i class="fa fa-spinner fa-spin"></i>
									</div>

									<div id="my-favorites-holder" class="item-block-content item-image-gallery-block">

										<?php 

											global $wpdb;
											$table_name = "td_favorites";
											if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

												$currentFeat = 0;

												$fav_per_page = 6;
												$total_items = 0;
												$current_page_fav = 1;
												$total_items = 0;

												global $wpdb;
												$listings = $wpdb->get_results( "SELECT * FROM td_favorites WHERE user_id = '".$user_id."' ORDER BY `ID` DESC");

												foreach ($listings as $key) {

													$listing_id = $key->listing_id;

													if(get_post_status($listing_id) == 'publish') {
														$total_items++;
													}

												}

												$total_fav_pages = ceil($total_items/$fav_per_page);

												$current_pos = -1; 

												foreach ($listings as $key) {

												    if($current_page_fav == 1) {
														$start_loop = 0;
													} else {
														$start_loop = ($current_page_fav - 1) * $fav_per_page;
													}

													$listing_id = $key->listing_id;

													if(get_post_status($listing_id) == 'publish') {

														$current_pos++;

												    	$currentFeat++;

														$end_loop = $current_page_fav * $fav_per_page;

														if($current_pos >= $start_loop && $current_pos <= ($end_loop-1)) {

															$permalink = get_permalink( $listing_id ); 

										?>

											<div id="my-fav-listing-<?php echo esc_attr($listing_id); ?>" class="my-listings-item">

												<div class="row">

													<div class="col-sm-10">
														<?php

															if(get_post_type($listing_id) == 'event') {

														?>
														<div class="my-fav-label" style="background-color: #f1c40f;">
															<?php _e( 'Event', 'themesdojo' ); ?>
														</div>
														<?php } else { ?>
														<div class="my-fav-label">
															<?php _e( 'Listing', 'themesdojo' ); ?>
														</div>
														<?php } ?>

														<div class="my-fav-content">

															<h2 class="my-listings-item-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo get_the_title( $listing_id ); ?></a></h2>

															<?php

																if(get_post_type($listing_id) == 'event') {

															?>
															<?php $event_start_date = get_post_meta($listing_id, 'event_start_date', true); $event_start_time = get_post_meta($listing_id, 'event_start_time', true); $event_location = get_post_meta($listing_id, 'event_location', true); if(!empty($event_location)) { ?>

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

																<span class="my-listings-item-metadata my-fav-metadata" style="width: 100%"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

															<?php  } ?>

															<span class="my-listings-item-metadata my-fav-metadata">
																<span>
																	<i class="fa fa-map-marker"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'event_loc' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																				$term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
															</span>

															<span class="my-listings-item-metadata my-fav-metadata">
																<i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews($postID) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span>
															</span>
															<?php } else { ?>
															<span class="my-listings-item-metadata my-fav-metadata">
																<span>
																	<i class="fa fa-map-marker"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'loc' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																			    $term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
																<span>
																	<i class="fa fa-folder-o"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'cat' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																			    $term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
															</span>

															<span class="my-listings-item-metadata my-fav-metadata">
																<i class="fa fa-calendar-o"></i><span><?php echo get_the_time('M j, Y', $listing_id); ?></span>
															</span>

															<?php 

																$item_expiration_date = get_post_meta($listing_id, 'item_expiration_date', true);
																if(!empty($item_expiration_date)) { 
																	$start = current_time('timestamp'); 
																	$end = $item_expiration_date; 
																	$days_between = ceil(abs($end - $start) / 86400); 

															?>
															<span class="my-listings-item-metadata my-fav-metadata" style="width: 100%">
																<i class="fa fa-clock-o"></i><span><?php _e( 'Expires in', 'themesdojo' ); ?> <?php echo esc_attr($days_between); ?> <?php _e( 'days', 'themesdojo' ); ?></span>
															</span>
															<?php } ?>
															<?php } ?>

														</div>

													</div>

													<div class="col-sm-2">

														<span id="like-listing-remove-<?php echo esc_attr($listing_id); ?>" class="my-listings-item-delete" data-rel="tooltip" rel="top" title="<?php _e( "Delete", "themesdojo" ); ?>">
															<i class="fa fa-trash-o"></i>
														</span>

														<form id="favorite-form-<?php echo esc_attr($listing_id); ?>" method="post" class="form">

											      			<input name="favorite_listing_id" id="favorite_listing_id" type="hidden" value="<?php echo esc_attr($listing_id); ?>" />
											      			<input name="favorite_user_id" id="favorite_user_id" type="hidden" value="<?php echo esc_attr($user_ID); ?>" />
											      			<input name="favorite_status" id="favorite_status" type="hidden" value="1" />

															<input type="hidden" name="action" value="favoriteForm" />
															<?php wp_nonce_field( 'favoriteForm_html', 'favoriteForm_nonce' ); ?>

														</form>

														<script type="text/javascript">

																jQuery(function($) {

																	document.getElementById('like-listing-remove-<?php echo esc_attr($listing_id); ?>').addEventListener('click', function(e) {
																					
																		$.fn.favoriteForm<?php echo esc_attr($listing_id); ?>();

																	});

																	$.fn.favoriteForm<?php echo esc_attr($listing_id); ?> = function() {

																		jQuery('#favorite-form-<?php echo esc_attr($listing_id); ?>').ajaxSubmit({
																			type: "POST",
																			data: jQuery('#favorite-form').serialize(),
																			url: '<?php echo admin_url('admin-ajax.php'); ?>',
																			beforeSend: function() {
																	        	jQuery('#post-preloader-<?php echo esc_attr($listing_id); ?>').css('display', 'block');
																	        },	 
																		    success: function(response) {
																		    	jQuery('#my-fav-listing-<?php echo esc_attr($listing_id); ?>').css('display', 'none');
																		       	return false;
																			}
																		});

																	}

																});

														</script>

													</div>

												</div>

												<div id="post-preloader-<?php echo esc_attr($listing_id); ?>" class="pending-post-single-loading">
													<i class="fa fa-spinner fa-spin"></i>
												</div>

											</div>

										<?php
													}

												}

											}

										?>

										<?php if($currentFeat == 0) { ?>

											<p><?php _e( 'You have no favorite listings at the moment.', 'themesdojo' ); ?></p>

										<?php  } ?>

										<?php

											if($total_fav_pages > 1) {  

								                $td_pagination = array(
													'base' => esc_url_raw(@add_query_arg('page','%#%')),
													'format' => '',
													'total' => $total_fav_pages,
													'current' => $current_page_fav,
													'prev_next' => true,
													'prev_text'    => __('« Previous', 'themesdojo'),
													'next_text'    => __('Next »', 'themesdojo'),
													'type' => 'plain',
													);

												if( $wp_rewrite->using_permalinks() )
													$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}

										}
											
										?> 

									</div>

									<form id="tdMyFavoriesPaginationForm" type="post" action="" >

										<input type="hidden" id="my_favorites_current_page" name="my_favorites_current_page" value="1" />
										<input type="hidden" name="action" value="tdMyAccountMyFavoritesPaginationForm" />
										<?php wp_nonce_field( 'tdMyAccountMyFavoritesPagination_html', 'tdMyAccountMyFavoritesPagination_nonce' ); ?>

									</form>

									<script type="text/javascript">

										jQuery(function($) {

											jQuery(document).on("click","#my-favorites-holder .pagination a.page-numbers",function(e){

										     	var hrefprim = jQuery(this).attr('href');
										     	var href = hrefprim.replace("#", "");

						                		jQuery('#my_favorites_current_page').val(href);

										     	$.fn.wpjobusSubmitFormFunctionFavorites();

										     	e.preventDefault();
												return false;

											});

											$.fn.wpjobusSubmitFormFunctionFavorites = function() {

												$contentheight = jQuery('#my-favorites-holder').height(),
												jQuery("html, body").animate({ scrollTop: 0 }, 800);

												jQuery('#tdMyFavoriesPaginationForm').ajaxSubmit({
												    type: "POST",
													data: jQuery('#tdMyFavoriesPaginationForm').serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													beforeSend: function() { 
											        	jQuery('#my-favorites-holder-loader').css('display', 'inline-block');
											        	jQuery('#my-favorites-holder').stop().animate({'opacity' : '0'}, 0, function() {
											        		jQuery('#my-favorites-holder').css('height', $contentheight);
											        	}); 
											        },	 
												    success: function(response) {
														jQuery('#my-favorites-holder-loader').fadeOut(100, function(){
											        		jQuery("#my-favorites-holder").html(response);
											        		jQuery("#my-favorites-holder").css('height', 'auto');
												            jQuery("#my-favorites-holder").stop().animate({'opacity' : '1'}, 250);
											        	});
												        return false;
												    }
												});
											}

										});

									</script>

						        </div>

						        <div class="tab-pane" id="my-active-plans">
						            
						            <div class="item-block-title">

										<i class="fa fa-database"></i><h4><?php _e( 'My Active Plans', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content item-image-gallery-block">

										<div class="full">

											<span id="signup-package" class="td-buttom sign-up-button" style="margin-bottom: 30px;">

												<?php _e( 'Add New Plan', 'themesdojo' ); ?>

											</span>

											<script type="text/javascript">

												jQuery(function($) {

													document.getElementById('signup-package').addEventListener('click', function(e) {
																							
														$.fn.OpenClaimForm();

														e.preventDefault();

													});

													$.fn.OpenClaimForm = function() {

														jQuery("html, body").animate({ scrollTop: 0 }, 800);

													    jQuery('#popup-td-register .item-block-title h4').text("<?php _e( 'Select Payment System', 'themesdojo' ); ?>");
													    jQuery('#popup-td-register').css('display', 'block');

													}

												});

											</script>

										</span>

										</div>

										<?php

											global $wpdb, $totalEvents, $eventsTotal;
											$table_name = "td_payments";
											if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {	

												$myActivePackages = 0;				

												query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'DESC' ));

												if (have_posts()) : while (have_posts()) : the_post();

												$postID = $post->ID;

												$totalPackages = 0;
												$totalPrice = 0;
												$totalRegularListings = 0;
												$totalRegularListingsUSed = 0;
												$regularListings = 0;
												$totalFeaturedListings = 0;
												$totalFeaturedListingsUSed = 0;
												$featuredListings = 0;
												$totalEvents = 0;

												$user_email = get_the_author_meta('user_email', $user_id);

												$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND package_id = '".$postID."' AND status = 'success' ORDER BY `ID` DESC");

												foreach ($my_transactions as $key) {

												    $transaction_id           = $key->id;
												    $transaction_package_id   = $key->package_id;
												    $transaction_name         = $key->package_name;
												    $transaction_price        = $key->price;
												    $transaction_currency     = $key->currency;
												    $transaction_payment_type = $key->payment_type;
												    $transaction_status       = $key->status;
												    $transaction_charge_id    = $key->transaction_id;
												    $transaction_date         = $key->created;
												    $transaction_custom_id    = $key->custom_id;

												    $package_items_amount = get_post_meta($transaction_package_id, 'package_items_amount', true);
												    $package_events_amount = get_post_meta($transaction_package_id, 'package_events_amount', true);

												    $package_items_feat_amount = get_post_meta($transaction_package_id, 'package_items_feat_amount', true);
													if(empty($package_items_feat_amount)) {
														$package_items_feat_amount = 0;
													}

													$package_items_expiration = get_post_meta($transaction_package_id, 'package_items_expiration', true);
													if(empty($package_items_expiration) or $package_items_expiration == 0) {
														$package_items_expiration = __( 'Unlimited', 'themesdojo' );
														$package_items_expiration_value = "";
													} else {
														$package_items_expiration_value = __( 'Days', 'themesdojo' );
													}

													$regular_listings_used = get_user_meta($user_id, "user_regular_listings_used_".$transaction_custom_id, true);
													if(empty($regular_listings_used)) {
														$regular_listings_used = 0;
													}
													$feat_listings_used = get_user_meta($user_id, "user_featured_listings_used_".$transaction_custom_id, true);
													if(empty($feat_listings_used)) {
														$feat_listings_used = 0;
													}
													$events_used = get_user_meta($user_id, "user_events_used", true);
													if(empty($events_used)) {
														$events_used = 0;
													}

													$totalPrice                = $totalPrice + $transaction_price;

													$totalRegularListings      = $totalRegularListings + $package_items_amount;
													$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
													$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

													$totalPackages++;

													$eventsTotal = $eventsTotal + $package_events_amount;

										?>

										<?php

											}

											if(($totalPackages > 0)) {

												if(($featuredListings > 0) OR ($regularListings > 0)) {

													$myActivePackages++;

										?>

										<div id="transaction-<?php echo esc_attr($postID); ?>" class="transaction-block">

											<div class="transaction-block-header">

												<h5><?php the_title(); ?> <?php _e( 'Plan Status', 'themesdojo' ); ?> </h5>

												<a class="td-buttom" href="#" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($postID); ?>" style="float: right;"><i class="fa fa-plus-square"></i><?php _e( 'View Plan Details', 'themesdojo' ); ?></a>

											</div>

											<div class="row">

												<?php if($regularListings > 0) { ?>

												<div class="col-sm-12">

													<div class="row">

														<div class="col-sm-9">

															<p><?php _e( 'Events Slots Available:', 'themesdojo' ); ?></p>

														</div>

														<div class="col-sm-3">

															<p class="text-align-center"><strong><?php echo esc_attr($regularListings); ?></strong></p>

														</div>

													</div>

												</div>

												<?php } ?>

											</div>

											<div id="collapse-<?php echo esc_attr($postID); ?>" class="item-block-content item-image-gallery-block collapse">

												<ul class="package-capabilities">

													<?php 

														$package_approve_item = get_post_meta($post->ID, 'package_approve_item', true);
														if(empty($package_approve_item)) {
															$package_approve_item = __( 'Instant', 'themesdojo' );
														} else {
															$package_approve_item = __( 'Admin Moderated', 'themesdojo' );
														}

														$package_allow_feat_image = get_post_meta($post->ID, 'package_allow_feat_image', true);
														if(empty($package_allow_feat_image)) {
															$package_allow_feat_image = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_feat_image = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_gallery = get_post_meta($post->ID, 'package_allow_gallery', true);
														if(empty($package_allow_gallery)) {
															$package_allow_gallery = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_gallery = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_map = get_post_meta($post->ID, 'package_allow_map', true);
														if(empty($package_allow_map)) {
															$package_allow_map = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_map = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_streetview = get_post_meta($post->ID, 'package_allow_streetview', true);
														if(empty($package_allow_streetview)) {
															$package_allow_streetview = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_streetview = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_phone = get_post_meta($post->ID, 'package_allow_phone', true);
														if(empty($package_allow_phone)) {
															$package_allow_phone = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_phone = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_web = get_post_meta($post->ID, 'package_allow_web', true);
														if(empty($package_allow_web)) {
															$package_allow_web = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_web = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_social = get_post_meta($post->ID, 'package_allow_social', true);
														if(empty($package_allow_social)) {
															$package_allow_social = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_social = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_workinghours = get_post_meta($post->ID, 'package_allow_workinghours', true);
														if(empty($package_allow_workinghours)) {
															$package_allow_workinghours = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_workinghours = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_amenities = get_post_meta($post->ID, 'package_allow_amenities', true);
														if(empty($package_allow_amenities)) {
															$package_allow_amenities = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_amenities = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_video = get_post_meta($post->ID, 'package_allow_video', true);
														if(empty($package_allow_video)) {
															$package_allow_video = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_video = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_bookonline = get_post_meta($post->ID, 'package_allow_bookonline', true);
														if(empty($package_allow_bookonline)) {
															$package_allow_bookonline = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_bookonline = '<i class="fa fa-check main-color"></i>';
														}

														$package_allow_ratings = get_post_meta($post->ID, 'package_allow_ratings', true);
														if(empty($package_allow_ratings)) {
															$package_allow_ratings = '<i class="fa fa-times"></i>';
														} else {
															$package_allow_ratings = '<i class="fa fa-check main-color"></i>';
														}

													?>

													<li>
														<span class="package-cap-title"><?php _e( 'Publishing', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo esc_attr($package_approve_item); ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Cover Image', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_feat_image; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Gallery', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_gallery; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Book Online', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_bookonline; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Ratings', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_ratings; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Map', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_map; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Streetview', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_streetview; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Pnone Number', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_phone; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Website', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_web; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Social Links', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_social; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Working Hours', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_workinghours; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Amenitites', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_amenities; ?></span>
													</li>

													<li>
														<span class="package-cap-title"><?php _e( 'Video', 'themesdojo' ); ?></span>
														<span class="package-cap-value"><?php echo $package_allow_video; ?></span>
													</li>

												</ul>

											</div>

										</div>

										<?php } } ?>
										
										<?php endwhile; endif; ?>
										<?php wp_reset_postdata(); ?>

										<?php 

											$events_used = get_user_meta($user_id, "user_events_used", true);
											if(empty($events_used)) {
												$events_used = 0;
											}

											$eventsTotalFinal = $eventsTotal - $events_used;

											if($eventsTotal > 0) {

										?>

										<div class="transaction-block">

											<div class="row">

												<div class="col-sm-8">

													<h5 style="margin-bottom: 0;"><?php _e( 'Events Slots Available:', 'themesdojo' ); ?></h5>

												</div>

												<div class="col-sm-4">

													<h5 class="listing-lifetime" style="margin-bottom: 0;"><strong><?php echo esc_attr($eventsTotalFinal); ?></strong></h5>

												</div>

											</div>

										</div>

										<?php } ?>

										<?php if($myActivePackages == 0) { ?>

											<p><?php _e( 'Looks like you have no active plan at the moment.', 'themesdojo' ); ?> <?php global $redux_demo; $price_plans_link = $redux_demo['page-url-price-plans']; if(!empty($price_plans_link)) { ?><?php _e( 'Well,', 'themesdojo' ); ?> <a href="<?php echo get_permalink( $price_plans_link ); ?>"><?php _e( 'choose one from our Plans.', 'themesdojo' ); ?></a><?php } ?></p>

										<?php } } ?>

									</div>

						        </div>

						        <div class="tab-pane" id="my-transactions">
						            
						            <div class="item-block-title">

										<i class="fa fa-credit-card"></i><h4><?php _e( 'Transactions', 'themesdojo' ); ?></h4>

									</div>

									<div id="my-transactions-holder-loader" class="item-block-content item-image-gallery-block">
										<i class="fa fa-spinner fa-spin"></i>
									</div>

									<div id="my-transactions-holder" class="item-block-content item-image-gallery-block">

										<?php

											global $wpdb;
											$table_name = "td_payments";
											if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

												$myTransactions = 0;

												$current_pos = -1;

												$user_email = get_the_author_meta('user_email', $user_id);

												$transactions_per_page = 3;
												$total_transactions = 0;
												$current_page_transactions = 1;

												global $wpdb;

												$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND status = 'success' ORDER BY `ID` DESC");

												$total_transactions = $wpdb->get_var( "SELECT COUNT(*) FROM `td_payments` WHERE email = '".$user_email."' AND status = 'success' ORDER BY `ID` DESC");

												$total_transactions_pages = ceil($total_transactions/$transactions_per_page);

												foreach ($my_transactions as $key) {

													$current_pos++;

												    $currentFeat++;

												    if($current_page_transactions == 1) {
														$start_loop = 0;
													} else {
														$start_loop = ($current_page_transactions - 1) * $transactions_per_page;
													}

													$end_loop = $current_page_transactions * $transactions_per_page;

													if($current_pos >= $start_loop && $current_pos <= ($end_loop-1)) {

													    $transaction_id           = $key->id;
													    $transaction_package_id   = $key->package_id;
													    $transaction_name         = $key->package_name;
													    $transaction_price        = $key->price;
													    $transaction_currency     = $key->currency;
													    $transaction_payment_type = $key->payment_type;
													    $transaction_status       = $key->status;
													    $transaction_charge_id    = $key->transaction_id;
													    $transaction_date         = $key->created;
													    $transaction_custom_id    = $key->custom_id;

													    $package_items_amount = get_post_meta($transaction_package_id, 'package_items_amount', true);

													    $package_items_feat_amount = get_post_meta($transaction_package_id, 'package_items_feat_amount', true);
														if(empty($package_items_feat_amount)) {
															$package_items_feat_amount = 0;
														}

														$package_items_expiration = get_post_meta($transaction_package_id, 'package_items_expiration', true);
														if(empty($package_items_expiration) or $package_items_expiration == 0) {
															$package_items_expiration = __( 'Unlimited', 'themesdojo' );
															$package_items_expiration_value = "";
														} else {
															$package_items_expiration_value = __( 'Days', 'themesdojo' );
														}

														$regular_listings_used = get_user_meta($user_id, "user_regular_listings_used_".$transaction_custom_id, true);
														if(empty($regular_listings_used)) {
															$regular_listings_used = 0;
														}
														$feat_listings_used = get_user_meta($user_id, "user_featured_listings_used_".$transaction_custom_id, true);
														if(empty($feat_listings_used)) {
															$feat_listings_used = 0;
														}

														$myTransactions++;

										?>

										<div id="transaction-<?php echo esc_attr($transaction_id); ?>" class="transaction-block">

											<div class="transaction-block-header">

												<h5><?php echo esc_attr($transaction_name); ?> - <span><?php echo esc_attr($transaction_currency); echo esc_attr($transaction_price); ?></span></h5>

												<span class="transaction-block-date"><i class="fa fa-calendar-o"></i><?php echo date('m/d/Y H:i:s', $transaction_date); ?></span>

											</div>

											<div class="row">

												<div class="col-sm-12">

													<div class="row">

														<div class="col-sm-6">

															<p><?php _e( 'Events Slots:', 'themesdojo' ); ?></p>

														</div>

														<div class="col-sm-6">

															<p class="text-align-center"><strong><?php echo esc_attr($package_items_amount); ?></strong> (<?php echo esc_attr($regular_listings_used); ?> <?php _e( 'used and ', 'themesdojo' ); ?> <?php $remaining = $package_items_amount - $regular_listings_used;  echo esc_attr($remaining); ?> <?php _e( 'available', 'themesdojo' ); ?>)</p>

														</div>

													</div>

												</div>

											</div>

											<span class="divider-dark"></span>
											
											<p class="transaction-block-bottom"><span class="transaction-type"><?php if($transaction_payment_type == "Stripe") { ?><i class="fa fa-credit-card"></i><?php } elseif($transaction_payment_type == "PayPal") { ?><i class="fa fa-paypal"></i><?php } else { ?><i class="fa fa-star"></i><?php } ?> <?php echo esc_attr($transaction_payment_type); ?></span> <span class="transaction-id"><?php _e( 'Transaction ID:', 'themesdojo' ); ?> <strong><?php echo esc_attr($transaction_charge_id); ?></strong></span></p>

										</div>

										<?php }

											}

										?>

										<?php if($myTransactions == 0) { ?>

											<p><?php _e( 'We haven\'t registered any transaction movement until now.', 'themesdojo' ); ?> <?php global $redux_demo; $price_plans_link = $redux_demo['page-url-price-plans']; if(!empty($price_plans_link)) { ?><?php _e( 'We\'ll certainly show up here the', 'themesdojo' ); ?> <a href="<?php echo get_permalink( $price_plans_link ); ?>"><?php _e( 'plans you\'ve chosen to use.', 'themesdojo' ); ?></a><?php } ?></p>

										<?php } ?>

										<?php

											if($total_transactions_pages > 1) {  

								                $td_pagination = array(
													'base' => esc_url_raw(@add_query_arg('page','%#%')),
													'format' => '',
													'total' => $total_transactions_pages,
													'current' => $current_page_transactions,
													'prev_next' => true,
													'prev_text'    => __('« Previous', 'themesdojo'),
													'next_text'    => __('Next »', 'themesdojo'),
													'type' => 'plain',
													);

												if( $wp_rewrite->using_permalinks() )
													$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}

										}
											
										?>

									</div>

									<form id="tdMyTransactionsPaginationForm" type="post" action="" >

										<input type="hidden" id="my_transactions_current_page" name="my_transaction_current_page" value="1" />
										<input type="hidden" name="action" value="tdMyAccountMyTransactionsPaginationForm" />
										<?php wp_nonce_field( 'tdMyAccountMyTransactionsPagination_html', 'tdMyAccountMyTransactionsPagination_nonce' ); ?>

									</form>

									<script type="text/javascript">

										jQuery(function($) {

											jQuery(document).on("click","#my-transactions-holder .pagination a.page-numbers",function(e){

										     	var hrefprim = jQuery(this).attr('href');
										     	var href = hrefprim.replace("#", "");

						                		jQuery('#my_transactions_current_page').val(href);

										     	$.fn.wpjobusSubmitFormFunctionTransactions();

										     	e.preventDefault();
												return false;

											});

											$.fn.wpjobusSubmitFormFunctionTransactions = function() {

												$contentheight = jQuery('#my-transactions-holder').height(),
												jQuery("html, body").animate({ scrollTop: 0 }, 800);

												jQuery('#tdMyTransactionsPaginationForm').ajaxSubmit({
												    type: "POST",
													data: jQuery('#tdMyTransactionsPaginationForm').serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													beforeSend: function() { 
											        	jQuery('#my-transactions-holder-loader').css('display', 'inline-block');
											        	jQuery('#my-transactions-holder').stop().animate({'opacity' : '0'}, 0, function() {
											        		jQuery('#my-transactions-holder').css('height', $contentheight);
											        	}); 
											        },	 
												    success: function(response) {
														jQuery('#my-transactions-holder-loader').fadeOut(100, function(){
											        		jQuery("#my-transactions-holder").html(response);
											        		jQuery("#my-transactions-holder").css('height', 'auto');
												            jQuery("#my-transactions-holder").stop().animate({'opacity' : '1'}, 250);
											        	});
												        return false;
												    }
												});
											}

										});

									</script>

						        </div>

						        <?php 

									if ( is_user_logged_in() && current_user_can('administrator')) {

										$pending_items = $wpdb->get_var( "SELECT COUNT(*) FROM `{$wpdb->prefix}posts` WHERE (post_type = 'item' and post_status = 'pending') OR (post_type = 'event' and post_status = 'pending')");

								?>

						        <div class="tab-pane" id="my-review">

						        	<div class="item-block-title">

										<i class="fa fa-gavel"></i><h4><?php _e( 'Pending Items', 'themesdojo' ); ?></h4>

									</div>

									<div id="my-pendings-holder-loader" class="item-block-content item-image-gallery-block">
										<i class="fa fa-spinner fa-spin"></i>
									</div>

									<div id="my-pendings-holder" class="item-block-content item-image-gallery-block">

										<?php 

											$currentFeat = 0;

											$myPendings = 0;

											$current_pos = -1;

											$pendings_per_page = 5;
											$total_pendings = 0;
											$current_page_pendings = 1;

											global $wpdb;
											$pending_listings = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE (post_type = 'item' and post_status = 'pending') OR (post_type = 'event' and post_status = 'pending') ORDER BY `ID` DESC ");

											$total_pending_items = $wpdb->get_var( "SELECT COUNT(*) FROM `{$wpdb->prefix}posts` WHERE (post_type = 'item' and post_status = 'pending') OR (post_type = 'event' and post_status = 'pending')");

											$total_pendings_pages = ceil($total_pending_items/$pendings_per_page);

											foreach ($pending_listings as $key) {

												$current_pos++;

											    $currentFeat++;

											    if($current_page_transactions == 1) {
													$start_loop = 0;
												} else {
													$start_loop = ($current_page_pendings - 1) * $pendings_per_page;
												}

												$end_loop = $current_page_pendings * $pendings_per_page;

												if($current_pos >= $start_loop && $current_pos <= ($end_loop-1)) {
											    
												    $listing_id = $key->ID;

												    $permalink = get_permalink( $listing_id ); 

												    $currentFeat++;

										?>

										<div id="my-pending-listing-<?php echo esc_attr($listing_id); ?>" class="my-listings-item">

												<div class="row">

													<div class="col-sm-9">

														<?php

															if(get_post_type($listing_id) == 'event') {

														?>
														<div class="my-fav-label" style="background-color: #f1c40f;">
															<?php _e( 'Event', 'themesdojo' ); ?>
														</div>
														<?php } else { ?>
														<div class="my-fav-label">
															<?php _e( 'Listing', 'themesdojo' ); ?>
														</div>
														<?php } ?>

														<div class="my-fav-content">

															<h2 class="my-listings-item-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo get_the_title( $listing_id ); ?></a></h2>

															<?php

																if(get_post_type($listing_id) == 'event') {

															?>
															<?php $event_start_date = get_post_meta($listing_id, 'event_start_date', true); $event_start_time = get_post_meta($listing_id, 'event_start_time', true); $event_location = get_post_meta($listing_id, 'event_location', true); if(!empty($event_location)) { ?>

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

																<span class="my-listings-item-metadata my-fav-metadata" style="width: 100%"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

															<?php  } ?>

															<span class="my-listings-item-metadata my-fav-metadata">
																<span>
																	<i class="fa fa-map-marker"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'event_loc' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																				$term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
															</span>

															<span class="my-listings-item-metadata my-fav-metadata">
																<i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews($postID) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span>
															</span>
															<?php } else { ?>
															<span class="my-listings-item-metadata my-fav-metadata">
																<span>
																	<i class="fa fa-map-marker"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'loc' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																			    $term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
																<span>
																	<i class="fa fa-folder-o"></i>
																	<?php 

																		$terms = get_the_terms($listing_id, 'cat' );
																		if ($terms && ! is_wp_error($terms)) :
																			$term_slugs_arr = array();
																			foreach ($terms as $term) {
																			    $term_slugs_arr[] = $term->name;
																			}
																			$terms_slug_str = join( " ", $term_slugs_arr);
																		endif;
																		echo esc_attr($terms_slug_str); 

																	?>
																</span>
															</span>

															<span class="my-listings-item-metadata my-fav-metadata">
																<i class="fa fa-calendar-o"></i><span><?php echo get_the_time('M j, Y', $listing_id); ?></span>
															</span>

															<?php 

																$item_expiration_date = get_post_meta($listing_id, 'item_expiration_date', true);
																if(!empty($item_expiration_date)) { 
																	$start = current_time('timestamp'); 
																	$end = $item_expiration_date; 
																	$days_between = ceil(abs($end - $start) / 86400); 

															?>
															<span class="my-listings-item-metadata my-fav-metadata" style="width: 100%">
																<i class="fa fa-clock-o"></i><span><?php _e( 'Expires in', 'themesdojo' ); ?> <?php echo esc_attr($days_between); ?> <?php _e( 'days', 'themesdojo' ); ?></span>
															</span>
															<?php } ?>
															<?php } ?>

														</div>

													</div>

													<div class="col-sm-3">

														<span class="my-listings-item-delete delete-listing" data-rel="tooltip" rel="top" title="<?php _e( "Delete", "themesdojo" ); ?>" style="margin-left: 15px;">
															<i class="fa fa-times"></i>
															<input type="hidden" class="review_post_id" name="review_post_id" value="<?php echo esc_attr($listing_id); ?>" />
														</span>

														<span class="my-listings-item-delete approve-listing" data-rel="tooltip" rel="top" title="<?php _e( "Approve", "themesdojo" ); ?>">
															<i class="fa fa-check"></i>
															<input type="hidden" class="review_post_id" name="review_post_id" value="<?php echo esc_attr($listing_id); ?>" />
														</span>

													</div>

												</div>

												<div id="post-preloader-<?php echo esc_attr($listing_id); ?>" class="pending-post-single-loading">
													<i class="fa fa-spinner fa-spin"></i>
												</div>

											</div>

										<?php }

											}

										?>

										<?php if($currentFeat == 0) { ?>

											<p><?php _e( 'You have no pending items at the moment.', 'themesdojo' ); ?></p>

										<?php  } ?>

										<?php

											if($total_pendings_pages > 1) {  

								                $td_pagination = array(
													'base' => esc_url_raw(@add_query_arg('page','%#%')),
													'format' => '',
													'total' => $total_pendings_pages,
													'current' => $current_page_pendings,
													'prev_next' => true,
													'prev_text'    => __('« Previous', 'themesdojo'),
													'next_text'    => __('Next »', 'themesdojo'),
													'type' => 'plain',
													);

												if( $wp_rewrite->using_permalinks() )
													$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}
											
										?>

										<form id="td-pending-posts" method="post" class="form">

											<input type="hidden" id="review_post_status" name="review_post_status" value="" />
											<input type="hidden" id="review_post_current_id" name="review_post_current_id" value="" />

											<input type="hidden" name="action" value="tdSubmitReviewStat" />
											<?php wp_nonce_field( 'tdSubmitReviewStat_html', 'tdSubmitReviewStat_nonce' ); ?>

										</form>

										<script type="text/javascript">

											jQuery(function($) {

												jQuery(document).on("click",".delete-listing",function(e){

													jQuery('#review_post_status').val('reject');

													var globalVar = jQuery(this).find('.review_post_id').val();
													jQuery('#review_post_current_id').val(globalVar);

													jQuery('#post-preloader-'+globalVar).fadeIn(500);

											        $.fn.tdSubmitFormFunction();

												});

												jQuery(document).on("click",".approve-listing",function(e){

													jQuery('#review_post_status').val('approve');

													var globalVar = jQuery(this).find('.review_post_id').val();
													jQuery('#review_post_current_id').val(globalVar);

													jQuery('#post-preloader-'+globalVar).fadeIn(500);

											        $.fn.tdSubmitFormFunction();

												});

												$.fn.tdSubmitFormFunction = function() {

													var globalVar = jQuery('#review_post_current_id').val();

													jQuery('#td-pending-posts').ajaxSubmit({
														type: "POST",
														data: jQuery('#td-pending-posts').serialize(),
														url: '<?php echo admin_url('admin-ajax.php'); ?>',	 
														success: function(response) {
															jQuery('#post-preloader-'+response).fadeOut(100);
															jQuery('#my-pending-listing-'+response).fadeOut(100, function(){
													        	jQuery(this).css('display', 'none');
													        });
														    return false;
														}
													});
												}

											});

										</script>

									</div>

									<form id="tdMyPendingsPaginationForm" type="post" action="" >

										<input type="hidden" id="my_pendings_current_page" name="my_pendings_current_page" value="1" />
										<input type="hidden" name="action" value="tdMyAccountMyPendingsPaginationForm" />
										<?php wp_nonce_field( 'tdMyAccountMyPendingsPagination_html', 'tdMyAccountMyPendingsPagination_nonce' ); ?>

									</form>

									<script type="text/javascript">

										jQuery(function($) {

											jQuery(document).on("click","#my-pendings-holder .pagination a.page-numbers",function(e){

										     	var hrefprim = jQuery(this).attr('href');
										     	var href = hrefprim.replace("#", "");

						                		jQuery('#my_pendings_current_page').val(href);

										     	$.fn.wpjobusSubmitFormFunctionPendings();

										     	e.preventDefault();
												return false;

											});

											$.fn.wpjobusSubmitFormFunctionPendings = function() {

												$contentheight = jQuery('#my-pendings-holder').height(),
												jQuery("html, body").animate({ scrollTop: 0 }, 800);

												jQuery('#tdMyPendingsPaginationForm').ajaxSubmit({
												    type: "POST",
													data: jQuery('#tdMyPendingsPaginationForm').serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													beforeSend: function() { 
											        	jQuery('#my-pendings-holder-loader').css('display', 'inline-block');
											        	jQuery('#my-pendings-holder').stop().animate({'opacity' : '0'}, 0, function() {
											        		jQuery('#my-pendings-holder').css('height', $contentheight);
											        	}); 
											        },	 
												    success: function(response) {
														jQuery('#my-pendings-holder-loader').fadeOut(100, function(){
											        		jQuery("#my-pendings-holder").html(response);
											        		jQuery("#my-pendings-holder").css('height', 'auto');
												            jQuery("#my-pendings-holder").stop().animate({'opacity' : '1'}, 250);
											        	});
												        return false;
												    }
												});
											}

										});

									</script>
						            
						        </div>

						        <?php } ?>

						        <div class="tab-pane" id="my-settings">
						            
						            <div class="item-block-title">

										<i class="fa fa-cog"></i><h4><?php _e( 'Account Settings', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content item-image-gallery-block">

										<div id="success">
											<span>
												<h5><?php _e( 'Account updated successful.', 'themesdojo' ); ?></h5>
											</span>
										</div>
												 
										<div id="error">
											<span>
												<h5><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h5>
											</span>
										</div>

										<div class="row">

											<form id="update-account-form" type="post" autocomplete="off" action="" >

												<div class="col-sm-4">

													<span class="author-settings-image">

														<?php 

															$author_avatar_url = get_user_meta($user_id, "user_meta_image", true);

														?>

														<span class="author-avatar-container" <?php if(!empty($author_avatar_url)) { ?>style="background: none;"<?php } ?>>

															<?php 

																get_template_part( 'inc/BFI_Thumb' );
																$params = array( 'width' => 120, 'height' => 120, 'crop' => true );

															?>

						                                	<img class="author-avatar" <?php if(empty($author_avatar_url)) { ?>style="display: none;"<?php } ?> src="<?php if(!empty($author_avatar_url)) { echo bfi_thumb( $author_avatar_url, $params ); } ?>" alt="" /> 

					                                	</span>

					                                	<input id="avatar-image-url" type="hidden" name="avatar-image-url" value="<?php if (!empty($author_avatar_url)) echo esc_url($author_avatar_url); ?>" /> 
					                                	                                   
					                                </span>

					                                <a href="#" id="avatar-upload-image" class="td-buttom" <?php if(!empty($author_avatar_url)) { ?>style="display: none;"<?php } ?> ><i class="fa fa-cloud-upload"></i><?php _e( 'Upload Image', 'themesdojo' ); ?></a>
					                                <a href="#" id="avatar-delete-image" class="td-buttom" <?php if(empty($author_avatar_url)) { ?>style="display: none;"<?php } ?>><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

					                                <script>
														var image_custom_uploader;
														var $thisItem = '';

														jQuery(document).on('click','#avatar-upload-image', function(e) {
														    e.preventDefault();

														    $thisItem = jQuery(this);

														    //If the uploader object has already been created, reopen the dialog
														    if (image_custom_uploader) {
														        image_custom_uploader.open();
														        return;
														    }

														    //Extend the wp.media object
														    image_custom_uploader = wp.media.frames.file_frame = wp.media({
														        title: 'Choose Image',
														        button: {
														            text: 'Choose Image'
														        },
														        multiple: false
														    });

														    //When a file is selected, grab the URL and set it as the text field's value
														    image_custom_uploader.on('select', function() {
														        attachment = image_custom_uploader.state().get('selection').first().toJSON();
														        var url = '';
														        url = attachment['url'];
														        var attachId = '';
														        attachId = attachment['id'];
														        jQuery('#avatar-image-url').val(url);
														        jQuery( "img.author-avatar" ).attr({
														            src: url
														        });
														        jQuery( "img.author-avatar" ).css("display", "inline-block");
														        jQuery(".author-avatar-container").css("background", "none");
														        jQuery("#avatar-upload-image").css("display", "none");
														        jQuery("#avatar-delete-image").css("display", "inline-block");
														    });

														    //Open the uploader dialog
														    image_custom_uploader.open();
														});

														jQuery(document).on('click','#avatar-delete-image', function(e) {
															e.preventDefault();
														    jQuery('#avatar-image-url').val('');
														    jQuery( "img.author-avatar" ).attr({
														        src: ''
														    });
														    jQuery( "img.author-avatar" ).css("display", "none");
														    jQuery(".author-avatar-container").css("background", "url(<?php echo esc_url(get_template_directory_uri()); ?>/images/avatar.png)");
														    jQuery(".author-avatar-container").css("background-size", "contain");
														    jQuery("#avatar-upload-image").css("display", "inline-block");
														    jQuery(this).css("display", "none");
														});
													</script>

												</div>

												<div class="col-sm-8">

													<div class="full" >  
							  	
													  	<span class="form-label"><?php _e( 'Display Name', 'themesdojo' ); ?></span>

													  	<?php $user_display_name = $user_info->display_name; ?>
														
														<input type="text" name="userNameLogin" id="userNameLogin" value="<?php if(!empty($user_display_name)) { echo esc_attr($user_display_name); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Password', 'themesdojo' ); ?></span>
														
														<input type="password" name="userPasswordLogin" id="userPasswordLogin" value="" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Repeat Password', 'themesdojo' ); ?></span>
														
														<input type="password" name="userConfirmPasswordLogin" id="userConfirmPasswordLogin" value="" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Facebook link', 'themesdojo' ); ?></span>

														<?php

															// Social
															$author_facebook_url = get_user_meta($user_id, "user_meta_facebook", true);

														?>
														
														<input type="text" name="facebook-link" id="facebook-link" value="<?php if(!empty($author_facebook_url)) { echo esc_url($author_facebook_url); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Twitter link', 'themesdojo' ); ?></span>

														<?php

															// Social
															$author_twitter_url = get_user_meta($user_id, "user_meta_twitter", true);

														?>
														
														<input type="text" name="twitter-link" id="twitter-link" value="<?php if(!empty($author_twitter_url)) { echo esc_url($author_twitter_url); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Google+ link', 'themesdojo' ); ?></span>

														<?php

															// Social
															$author_googleplus_url = get_user_meta($user_id, "user_meta_googleplus", true);

														?>
														
														<input type="text" name="google-plus-link" id="google-plus-link" value="<?php if(!empty($author_googleplus_url)) { echo esc_url($author_googleplus_url); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="full" >

														<span class="form-label"><?php _e( 'Dribbble link', 'themesdojo' ); ?></span>

														<?php

															// Social
															$author_dribbble_url = get_user_meta($user_id, "user_meta_dribbble", true);

														?>
														
														<input type="text" name="dribbble-link" id="dribbble-link" value="<?php if(!empty($author_dribbble_url)) { echo esc_url($author_dribbble_url); } ?>" class="input-textarea" placeholder="" />

													</div>

													<input id="update-account-button" name="submit" type="submit" value="<?php _e( 'Update Settings', 'themesdojo' ); ?>" class="input-submit">	

													<span class="submit-loading" style="margin-bottom: 20px; margin-top: 10px;"><i class="fa fa-refresh fa-spin"></i></span> 	 

												</div>

												<input type="hidden" name="userID" value="<?php echo get_current_user_id(); ?>" />
								 
								
												<input type="hidden" name="action" value="tdUpdateAccountForm" />
												<?php wp_nonce_field( 'tdUpdateAccount_html', 'tdUpdateAccount_nonce' ); ?>

											</form>

											<script type="text/javascript">

												jQuery(function($) {

													jQuery('#update-account-form').validate({
												        rules: {
												            userPasswordLogin: {
												                minlength: 6,
												            },
												            userConfirmPasswordLogin: {
												                minlength: 6,
												                equalTo: "#userPasswordLogin"
												            }
												        },
												        messages: {
													        userPasswordLogin: {
													            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
													        },
													        userConfirmPasswordLogin: {
													            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>",
													            equalTo: "<?php _e( 'Please enter the same password as above', 'themesdojo' ); ?>"
													        }
													    },
												        submitHandler: function(form) {
												        	jQuery('#update-account-button').css('display','none');
												        	jQuery('#update-account-form .submit-loading').css('display','inline-block');
												            jQuery(form).ajaxSubmit({
												            	type: "POST",
														        data: jQuery(form).serialize(),
														        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
												                success: function(data) {

												                	if(data == 1) {
												                		jQuery('#update-account-form :input').attr('disabled', 'disabled');
													                    jQuery('#update-account-form').fadeTo( "slow", 0, function() {
													                    	jQuery('#update-account-form').css('display','none');
													                        jQuery(this).find(':input').attr('disabled', 'disabled');
													                        jQuery(this).find('label').css('cursor','default');
													                        jQuery('#success').fadeIn();

													                        var delay = 10;
					      													setTimeout(function(){ window.location.reload(); }, delay);

													                    });
												                	}

												                	if(data == 2) {
												                		jQuery('#update-account-form :input').attr('disabled', 'disabled');
													                    jQuery('#update-account-form').fadeTo( "slow", 0, function() {
													                    	jQuery('#update-account-form').css('display','none');
													                        jQuery(this).find(':input').attr('disabled', 'disabled');
													                        jQuery(this).find('label').css('cursor','default');
													                        jQuery('#success').fadeIn();

													                        var delay = 10;
					      													setTimeout(function(){ window.location.reload(); }, delay); 

													                    });
												                	}

												                	if(data == 3) {
												                		jQuery('#update-account-form :input').attr('disabled', 'disabled');
													                    jQuery('#update-account-form').fadeTo( "slow", 0, function() {
													                    	jQuery('#update-account-form').css('display','none');
													                        jQuery(this).find(':input').attr('disabled', 'disabled');
													                        jQuery(this).find('label').css('cursor','default');
													                        jQuery('#success').fadeIn();

													                        var delay = 10;
					      													setTimeout(function(){ window.location.reload(); }, delay); 

													                    });
												                	}

												                },
												                error: function(data) {
												                    jQuery('#update-account-form').fadeTo( "slow", 0, function() {
												                        jQuery('#error').fadeIn();
												                    });
												                }
												            });
												        }
												    });

												});
											</script>

										</div>

									</div>

						        </div>

						    </div>

						    <?php } ?>

						</div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>