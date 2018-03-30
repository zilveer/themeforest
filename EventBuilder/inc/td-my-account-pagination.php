<?php

function tdMyAccountMyListingsPaginationForm() {

  	if ( isset( $_POST['tdMyAccountMyListingsPagination_nonce'] ) && wp_verify_nonce( $_POST['tdMyAccountMyListingsPagination_nonce'], 'tdMyAccountMyListingsPagination_html' ) ) {

  		ob_start();

		$page = sanitize_text_field($_POST['my_listings_current_page']);

		$currentNum = 0;

		$listings_per_page = 5;
		$total_companies = 0;
		$current_page = $page;

		global $current_user, $user_id, $user_info, $postID;
		get_currentuserinfo();
		$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.

		query_posts( array('post_type' => 'listing', 'author' => $user_id, 'posts_per_page' => 5, 'order' => 'DESC', 'post_status' => 'publish, draft, pending', 'paged' => $page ));

		$custom_posts = new WP_Query();
		$custom_posts->query('post_type=listing&posts_per_page=-1&author='.$user_id.'&post_status=publish, draft, pending');
		$total_items = $custom_posts->post_count;

		$total_pages = ceil($total_items/$listings_per_page);

		if (have_posts()) : while (have_posts()) : the_post();

		$postID = get_the_ID();

		$currentNum++;

	?>

		<div id="listing-<?php echo esc_attr($postID); ?>" class="my-listings-item">

			<div class="row">

				<div class="col-sm-3">

					<?php $item_status = get_post_meta($postID, 'item_status', true); ?>

					<?php if($item_status == "featured") { ?>

					<span class="my-listings-item-status featured-listing">
						<span><i class="fa fa-star"></i><?php _e( 'Featured', 'themesdojo' ); ?></span>
					</span>

					<?php } else { ?>

					<span class="my-listings-item-status">
						<span><i class="fa fa-star-o"></i><?php _e( 'Regular', 'themesdojo' ); ?></span>
					</span>

					<?php } ?>

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

				</div>

				<div class="col-sm-6">

					<h2 class="my-listings-item-title"><a href="<?php if ( get_post_status ( $postID ) == 'publish' ) {  the_permalink(); } elseif ( get_post_status ( $postID ) == 'draft' ) { echo "#"; } elseif ( get_post_status ( $postID ) == 'pending' ) {  echo "#"; } ?>"><?php the_title(); ?></a></h2>

					<span class="my-listings-item-metadata my-fav-metadata">
						<span>
							<i class="fa fa-map-marker"></i>
							<?php 

								$terms = get_the_terms($postID, 'loc' );
								if ($terms && ! is_wp_error($terms)) :
									$term_slugs_arr = array();
									foreach ($terms as $term) {
										$term_slugs_arr[] = $term->slug;
									}
									$terms_slug_str = join( " ", $term_slugs_arr);
								endif;
								echo esc_attr($terms_slug_str); 

							?>
						</span>
						<span>
							<i class="fa fa-folder-o"></i>
							<?php 

								$terms = get_the_terms($postID, 'cat' );
								if ($terms && ! is_wp_error($terms)) :
									$term_slugs_arr = array();
									foreach ($terms as $term) {
										$term_slugs_arr[] = $term->slug;
									}
									$terms_slug_str = join( " ", $term_slugs_arr);
								endif;
								echo esc_attr($terms_slug_str); 

								?>
							</span>
						</span>

						<?php

							$item_expiration_date = get_post_meta($postID, 'item_expiration_date', true); 
							if(!empty($item_expiration_date)) {
								$start = current_time('timestamp'); 
								$end = $item_expiration_date; 
								$days_between = ceil(abs($end - $start) / 86400); 

						?>
						<span class="my-listings-item-metadata my-fav-metadata">
							<i class="fa fa-clock-o"></i><span><?php _e( 'Expires in', 'themesdojo' ); ?> <?php echo esc_attr($days_between); ?> <?php _e( 'days', 'themesdojo' ); ?></span>
						</span>
						<?php } ?>

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
															$edit_listing_link = $redux_demo['page-url-edit-listing']; 

														?>

														<a href="<?php echo get_permalink( $edit_listing_link ); ?>?post=<?php echo esc_attr($postID); ?>" class="my-listings-item-edit" data-rel="tooltip" rel="top" title="<?php _e( "Edit", "themesdojo" ); ?>">
															<i class="fa fa-pencil"></i>
														</a>

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

				$td_pagination['base'] = '#%#%';

				if( !empty($wp_query->query_vars['s']) )
					$td_pagination['add_args'] = array('s'=>get_query_var('s'));

				echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

			}

        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdMyAccountMyListingsPaginationForm', 'tdMyAccountMyListingsPaginationForm' );
add_action( 'wp_ajax_nopriv_tdMyAccountMyListingsPaginationForm', 'tdMyAccountMyListingsPaginationForm' );

function tdMyAccountMyEventsPaginationForm() {

  	if ( isset( $_POST['tdMyAccountMyEventsPagination_nonce'] ) && wp_verify_nonce( $_POST['tdMyAccountMyEventsPagination_nonce'], 'tdMyAccountMyEventsPagination_html' ) ) {

  		ob_start();

		$page = sanitize_text_field($_POST['my_events_current_page']);

		$currentNum = 0;

		$listings_per_page = 5;
		$total_companies = 0;
		$current_page = $page;

		global $current_user, $user_id, $user_info, $postID;
		get_currentuserinfo();
		$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.

		query_posts( array('post_type' => 'event', 'author' => $user_id, 'posts_per_page' => 5, 'order_by' => 'ID', 'order' => 'DESC', 'post_status' => 'publish, draft, pending', 'paged' => $page ));

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

															<span class="my-listings-item-metadata my-fav-metadata"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($$start_date); ?> <?php echo esc_attr($start_time); ?></span>

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

												$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}

        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdMyAccountMyEventsPaginationForm', 'tdMyAccountMyEventsPaginationForm' );
add_action( 'wp_ajax_nopriv_tdMyAccountMyEventsPaginationForm', 'tdMyAccountMyEventsPaginationForm' );


function tdMyAccountMyFavoritesPaginationForm() {

  	if ( isset( $_POST['tdMyAccountMyFavoritesPagination_nonce'] ) && wp_verify_nonce( $_POST['tdMyAccountMyFavoritesPagination_nonce'], 'tdMyAccountMyFavoritesPagination_html' ) ) {

  		ob_start();

		$current_page = sanitize_text_field($_POST['my_favorites_current_page']);

		$currentFeat = 0;

											$fav_per_page = 6;
											$total_items = 0;

											global $wpdb;
											global $current_user, $user_id, $user_info;
											get_currentuserinfo();
											$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
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
														$start_loop = ($current_page - 1) * $fav_per_page;
													}

													$listing_id = $key->listing_id;

													if(get_post_status($listing_id) == 'publish') {

														$current_pos++;

												    	$currentFeat++;

														$end_loop = $current_page * $fav_per_page;

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
													'current' => $current_page,
													'prev_next' => true,
													'prev_text'    => __('« Previous', 'themesdojo'),
													'next_text'    => __('Next »', 'themesdojo'),
													'type' => 'plain',
													);

												$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}

        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdMyAccountMyFavoritesPaginationForm', 'tdMyAccountMyFavoritesPaginationForm' );
add_action( 'wp_ajax_nopriv_tdMyAccountMyFavoritesPaginationForm', 'tdMyAccountMyFavoritesPaginationForm' );

function tdMyAccountMyTransactionsPaginationForm() {

  	if ( isset( $_POST['tdMyAccountMyTransactionsPagination_nonce'] ) && wp_verify_nonce( $_POST['tdMyAccountMyTransactionsPagination_nonce'], 'tdMyAccountMyTransactionsPagination_html' ) ) {

  		ob_start();

		$current_page_transactions = sanitize_text_field($_POST['my_transaction_current_page']);

		$myTransactions = 0;

											$current_pos = -1;

											global $wpdb;
											global $current_user, $user_id, $user_info;

											get_currentuserinfo();
											$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.

											$user_email = get_the_author_meta('user_email', $user_id);

											$transactions_per_page = 3;
											$total_transactions = 0;

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

														<div class="col-sm-4">

															<p><?php _e( 'Regular Listing Slots:', 'themesdojo' ); ?></p>

														</div>

														<div class="col-sm-5">

															<p class="text-align-center"><strong><?php echo esc_attr($package_items_amount); ?></strong> (<?php echo esc_attr($regular_listings_used); ?> <?php _e( 'used and ', 'themesdojo' ); ?> <?php $remaining = $package_items_amount - $regular_listings_used;  echo esc_attr($remaining); ?> <?php _e( 'available', 'themesdojo' ); ?>)</p>

														</div>

														<div class="col-sm-3">

															<p class="listing-lifetime"><i class="fa fa-clock-o"></i><?php echo esc_attr($package_items_expiration); echo " "; echo esc_attr($package_items_expiration_value);?></p>	

														</div>

													</div>

												</div>

												<div class="col-sm-12">

													<div class="row">

														<div class="col-sm-4">

															<p><?php _e( 'Featured Listing Slots:', 'themesdojo' ); ?></p>

														</div>

														<div class="col-sm-5">

															<p class="text-align-center"><strong><?php echo esc_attr($package_items_feat_amount); ?></strong> (<?php echo esc_attr($feat_listings_used); ?> <?php _e( 'used and ', 'themesdojo' ); ?> <?php $remaining = $package_items_feat_amount - $feat_listings_used;  echo esc_attr($remaining); ?> <?php _e( 'available', 'themesdojo' ); ?>)</p>

														</div>

														<div class="col-sm-3">

															<p class="listing-lifetime"><?php if($package_items_feat_amount > 0 OR !empty($package_items_feat_amount)) { ?><i class="fa fa-clock-o"></i><?php echo esc_attr($package_items_expiration); echo " "; echo esc_attr($package_items_expiration_value);?><?php } ?></p>	

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

												$td_pagination['base'] = '#%#%';

												if( !empty($wp_query->query_vars['s']) )
													$td_pagination['add_args'] = array('s'=>get_query_var('s'));

												echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 

											}

        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdMyAccountMyTransactionsPaginationForm', 'tdMyAccountMyTransactionsPaginationForm' );
add_action( 'wp_ajax_nopriv_tdMyAccountMyTransactionsPaginationForm', 'tdMyAccountMyTransactionsPaginationForm' );

function tdMyAccountMyPendingsPaginationForm() {

  	if ( isset( $_POST['tdMyAccountMyPendingsPagination_nonce'] ) && wp_verify_nonce( $_POST['tdMyAccountMyPendingsPagination_nonce'], 'tdMyAccountMyPendingsPagination_html' ) ) {

  		ob_start();

		$current_page_pendings = sanitize_text_field($_POST['my_pendings_current_page']);

		$currentFeat = 0;

											$myPendings = 0;

											$current_pos = -1;

											$pendings_per_page = 5;
											$total_pendings = 0;

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

										<?php

        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdMyAccountMyPendingsPaginationForm', 'tdMyAccountMyPendingsPaginationForm' );
add_action( 'wp_ajax_nopriv_tdMyAccountMyPendingsPaginationForm', 'tdMyAccountMyPendingsPaginationForm' );



