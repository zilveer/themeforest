<?php
/**
 * Template name: Upload Listing Page
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

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php if ( !is_user_logged_in() ) { _e( 'Ooops', 'themesdojo' ); } else { ?><?php the_title(); ?><?php } ?></h1>

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

						<div class="row">

							<div class="col-sm-12">

								<?php if ( !is_user_logged_in() ) { ?>

								<style>

									#popup-td-login {
										display: block;
									}

								</style>

								<h2><?php _e( 'Please login.', 'themesdojo' ); ?></h2>

								<?php } else { ?>

								<div id="td-upload-listing-success">

									<div class="item-block-title">

										<i class="fa fa-check-square"></i><h4><?php _e( 'Congratulations.', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

									<h5><?php _e( 'Event uploaded successfuly.', 'themesdojo' ); ?></h5>

									</div>

								</div>

								<div id="td-upload-listing-header">

									<div class="item-block-title">

										<i class="fa fa-sitemap"></i><h4><?php _e( 'Select Event Slot', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<select id="select-listing-slot" name="select-listing-slot">

											<option value='none' autocomplete="off">None</option>

											<?php	

												$myActivePlans = 0;				

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

												$user_email = get_the_author_meta('user_email', $user_id);

												global $wpdb;
					                            $table_name = "td_payments";

					                            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

													$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND package_id = '".$postID."' AND status = 'success' ORDER BY `ID` DESC");

												} else {

													$my_transactions = "";

												}

												if(!empty($my_transactions)) {

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

												    $package_events_amount = get_post_meta($transaction_package_id, 'package_events_amount', true);

												    $package_items_feat_amount = get_post_meta($transaction_package_id, 'package_items_feat_amount', true);
													if(empty($package_items_feat_amount)) {
														$package_items_feat_amount = 0;
													}

													$regular_listings_used = get_user_meta($user_id, "user_regular_events_used_".$transaction_custom_id, true);
													if(empty($regular_listings_used)) {
														$regular_listings_used = 0;
													}
													$feat_listings_used = get_user_meta($user_id, "user_featured_events_used_".$transaction_custom_id, true);
													if(empty($feat_listings_used)) {
														$feat_listings_used = 0;
													}

													$totalPrice                = $totalPrice + $transaction_price;

													$totalRegularListings      = $totalRegularListings + $package_events_amount;
													$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
													$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

													$totalFeaturedListings     = $totalFeaturedListings + $package_items_feat_amount;
													$totalFeaturedListingsUSed = $totalFeaturedListingsUSed + $feat_listings_used;
													$featuredListings          = $totalFeaturedListings - $totalFeaturedListingsUSed;

													$totalPackages++;

											?>

											<?php

												}

												if(($totalPackages > 0)) {

													if(($featuredListings > 0) OR ($regularListings > 0)) {

														if($regularListings > 0) {

															$myActivePlans++;

											?>

												<option value='regular-<?php echo esc_attr($transaction_package_id); ?>' autocomplete="off"><?php the_title(); ?> - <?php echo esc_attr($regularListings); ?> <?php _e( 'Slots available for', 'themesdojo' ); ?></option>

											<?php } ?>

											<?php } } } ?>
											
											<?php endwhile; endif; ?>
											<?php wp_reset_postdata(); ?>

										</select>

										<?php if($myActivePlans == 0) { ?>

											<style>

												#select-listing-slot {
													display: none;
												}

											</style>

											<p><?php _e( 'Looks like you have no active plan at the moment.', 'themesdojo' ); ?> <?php global $redux_demo; $price_plans_link = $redux_demo['page-url-price-plans']; if(!empty($price_plans_link)) { ?><?php _e( 'Well,', 'themesdojo' ); ?> <a href="<?php echo get_permalink( $price_plans_link ); ?>"><?php _e( 'choose one from our Plans.', 'themesdojo' ); ?></a><?php } ?></p>

										<?php } ?>

										<form id="tdCheckSlotAvailability" method="POST" action="" >

											<input type="hidden" id="td-slot-id" name="td-slot-id" value="">
											<input type="hidden" id="user_id" name="user_id" value="<?php echo esc_attr($user_ID); ?>">

											<input type="hidden" name="action" value="tdCheckEventSlotAvailabilityForm" />
											<?php wp_nonce_field( 'tdCheckEventSlotAvailability_html', 'tdCheckEventSlotAvailability_nonce' ); ?>

										</form>

										<form id="tdLoadUploadListingForm" method="POST" action="" >

											<input type="hidden" id="td-slot-id-form" name="td-slot-id-form" value="">
											<input type="hidden" id="user_id_form" name="user_id" value="<?php echo esc_attr($user_ID); ?>">

											<input type="hidden" name="action" value="tdUploadEventForm" />
											<?php wp_nonce_field( 'tdUploadEventForm_html', 'tdUploadEventForm_nonce' ); ?>

										</form>

										<script type="text/javascript">

											jQuery(function($) {

												jQuery("#select-listing-slot").change(function() {

												    var val = jQuery(this).val();

												    if(val == "none") {

												    	jQuery("#upload-form-holder").html("");
														jQuery('#upload-form-holder-main-settings').css('display','none');

												    } else {

												    	jQuery("#upload-form-holder").html("");
														jQuery('#upload-form-holder-main-settings').css('display','none');

														jQuery('#slot-check-result').html('<i class="fa fa-spinner fa-spin"></i><h5><?php _e( "Checking slot availability.", "themesdojo" ); ?></h5>');

													    jQuery('#td-slot-id').val(val);
													    jQuery('#td-slot-id-form').val(val);
													    jQuery('#tdSlotId').val(val);

													    jQuery('#tdCheckSlotAvailability').ajaxSubmit({
															type: "POST",
															data: jQuery('#tdCheckSlotAvailability').serialize(),
															url: '<?php echo admin_url('admin-ajax.php'); ?>',
															beforeSend: function() { 
																jQuery('#slot-check-result').css('display','inline-block');
															},	 
															success: function(response) {
															    if(response == 1) {
																	// Good
																	$.fn.tdUploadForm();
																} 
																if(response == 2) {
																	// Bad
																	jQuery('#slot-check-result').html('<i class="fa fa-exclamation-triangle"></i><h5><?php _e( "Slot is not available anymore, please reload and select another one.", "themesdojo" ); ?></h5>');
																}
																if(response == 3) {
																	// Something went wrong
																	jQuery('#slot-check-result').html('<i class="fa fa-exclamation-triangle"></i><h5><?php _e( "Something went wrong, please reload.", "themesdojo" ); ?></h5>');
																}
															    return false;
															}
														});
													}

												});

												$.fn.tdUploadForm = function() {

													jQuery('#tdLoadUploadListingForm').ajaxSubmit({
													    type: "POST",
														data: jQuery('#tdLoadUploadListingForm').serialize(),
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
															jQuery('#slot-check-result').html('<i class="fa fa-spinner fa-spin"></i><h5><?php _e( "Slot available. Loading form.", "themesdojo" ); ?></h5>');
														},	 
													    success: function(response) {
													    	// Load form
													    	if(response == 0) {
																// Something went wrong
																
															} else {
																jQuery('#slot-check-result').css('display','none');
																jQuery("#upload-form-holder").html(response);
																//jQuery('#upload-form-holder-main-settings').css('display','inline-block');
																jQuery('#upload-form-holder-main-settings').fadeIn();
																//jQuery('#upload-form-holder-main-settings').addClass('loaded');
																jQuery('#upload-form-holder').fadeIn();
															}

													        return false;
													    }
													});

												}


											});

										</script>

									</div>

									<div id="slot-check-result" class="full">

										<i class="fa fa-spinner fa-spin"></i><h5><?php _e( 'Checking slot availability.', 'themesdojo' ); ?></h5>

									</div>

								</div>

								<form id="td-upload-listing" type="post" action="" >

									<div id="upload-form-holder-main-settings">

										<div class="item-block-title">

											<i class="fa fa-pencil-square"></i><h4><?php _e( 'Main Settings', 'themesdojo' ); ?></h4>

											<span id="main-settings-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#main-settings-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="main-settings-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Title:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormTitle" id="listingFormTitle" value="" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Category:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<select id="listingFormCat" name="listingFormCat">

															<?php

																$categories = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => 0) );

																foreach ($categories as $category) {
																	$option = '<option value="'.$category->term_id.'">';
																	$option .= $category->cat_name;
																	$option .= '</option>';

																	$catID = $category->term_id;

																	$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $catID) );

																	foreach ($categories_child as $category_child) {
																		$option .= '<option value="'.$category_child->term_id.'"> - ';
																		$option .= $category_child->cat_name;
																		$option .= '</option>';

																	}

																	echo $option;
																}

															?>

														</select>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Location:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<select id="listingFormLoc" name="listingFormLoc">

															<?php

																$categories = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => 0) );

																foreach ($categories as $category) {
																	$option = '<option value="'.$category->term_id.'">';
																	$option .= $category->cat_name;
																	$option .= '</option>';

																	$catID = $category->term_id;

																	$categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

																	foreach ($categories_child as $category_child) {
																		$option .= '<option value="'.$category_child->term_id.'"> - ';
																		$option .= $category_child->cat_name;
																		$option .= '</option>';

																	}

																	echo $option;
																}

															?>

														</select>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Place Name (Building/Facility):', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<script>
														  	jQuery(function() {
															    var availableTags = [
															    	<?php

															    		$all_events = array_unique(array_filter(td_get_all_event_places()));

															    		foreach ($all_events as $key => $value) { ?>
																	        "<?php echo $value; ?>",
																	  <?php  }

															    	?>
															    ];
															    jQuery( "#locationName" ).autocomplete({
															      	source: availableTags
															    });
														  	});
														</script>

														<input type="text" name="locationName" id="locationName" value="<?php if(!empty($terms_slug_str_place)) { echo esc_attr($terms_slug_str_place); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Start Date:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStartDate" id="eventStartDate" value="<?php if(!empty($event_start_date)) { echo esc_attr($event_start_date); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Start Time:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStartTime" id="eventStartTime" value="<?php if(!empty($event_start_time)) { echo esc_attr($event_start_time); } ?>" class="input-textarea" placeholder="" />

													</div>

													<script type="text/javascript">

														jQuery(function($) {

															jQuery('#eventStartDate').pickadate({
													            format: 'm/d/yyyy'
													        });

													        jQuery('#eventStartTime').pickatime({
													            format: 'h:i A'
													        });
													        
														});

													</script>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event End Date:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventEndDate" id="eventEndDate" value="<?php if(!empty($event_end_date)) { echo esc_attr($event_end_date); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event End Time:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventEndTime" id="eventEndTime" value="<?php if(!empty($event_end_time)) { echo esc_attr($event_end_time); } ?>" class="input-textarea" placeholder="" />

													</div>

													<script type="text/javascript">

														jQuery(function($) {

															jQuery('#eventEndDate').pickadate({
													            format: 'm/d/yyyy'
													        });

													        jQuery('#eventEndTime').pickatime({
													            format: 'h:i A'
													        });
													        
														});

													</script>

													<div class="col-sm-4" style="margin-bottom: 30px;">

														<span class="form-label"><?php _e( 'Description:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8" style="margin-bottom: 30px;">

														<?php 

															$editor_id = 'postContent';
															$content = '';
																		
															$settings = array(
																	'wpautop' => true,
																	'postContent' => 'content',
																	'textarea_name' => $editor_id,
																	'media_buttons' => false,
																	'editor_css' => '<style>.mceToolba { background-color: #faf9f4; padding: 5px; }</style>',
																	'tinymce' => array(
																		'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
																		'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
																		'theme_advanced_buttons3' => '',
																		'theme_advanced_buttons4' => ''
																	),
																	'quicktags' => false
															);
																				
															wp_editor( $content, 'postContent', $settings );

														?>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Buy Ticket Shortcode (Tickera or TicketTailor):', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<textarea type='text' cols="70" rows="7" id='item_ticketailor' name='item_ticketailor'></textarea>
														<p><?php _e( 'Add TicketTailor or Tickera shortcode here (<a href="http://www.tickettailor.com/?rf=ur8178-ex">https://www.tickettailor.com</a> or <a href="https://tickera.com/">https://tickera.com/</a>)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4" style="margin-top: 30px;">

														<span class="form-label"><?php _e( 'Event Stats - Crowd', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8" style="margin-top: 30px;">

														<input type="text" name="eventStatsCrowd" id="eventStatsCrowd" value="" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add crowd percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Involvement', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsInvolvement" id="eventStatsInvolvement" value="" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add involvement percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Preparation', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsPreparation" id="eventStatsPreparation" value="" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add preparation percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Transformation', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsTransformation" id="eventStatsTransformation" value="" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add transformation percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div id="upload-form-holder">



									</div>

									<input type="hidden" id="tdSlotId" name="tdSlotId" value="">
									<input type="hidden" id="userId" name="user_id" value="<?php echo esc_attr($user_ID); ?>">
									<input type="hidden" id="postStatus" name="postStatus" value="">

									<input type="hidden" name="action" value="tdUploadEventPrimForm" />
									<?php wp_nonce_field( 'tdUploadEventPrimForm_html', 'tdUploadEventPrimForm_nonce' ); ?>

								</form>

								<script type="text/javascript">

									jQuery(function($) {
										jQuery('#td-upload-listing').validate({
											rules: {
											    listingFormTitle: {
											        required: true,
											        minlength: 3
											    },
											    listingFormEmail: {
											        required: true,
											        email: true
											    },
											    locationName: {
											    	required: true
											    },
											    eventStartDate: {
											    	required: true
											    },
											    eventStartTime: {
											    	required: true
											    },
											    eventEndDate: {
											    	required: true
											    },
											    eventEndTime: {
											    	required: true
											    },
											    item_googleaddress: {
											    	required: true
											    }
											},
											messages: {
												listingFormTitle: {
												    required: "<?php _e( 'Please provide a name', 'themesdojo' ); ?>",
												    minlength: "<?php _e( 'Your name must be at least 3 characters long', 'themesdojo' ); ?>"
												},
												listingFormEmail: {
												    required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
												    email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
												},
												locationName: {
											    	required: "<?php _e( 'Please provide a place', 'themesdojo' ); ?>"
											    },
											    eventStartDate: {
											    	required: "<?php _e( 'Please provide a starting date', 'themesdojo' ); ?>"
											    },
											    eventStartTime: {
											    	required: "<?php _e( 'Please provide a starting time', 'themesdojo' ); ?>"
											    },
											    eventEndDate: {
											    	required: "<?php _e( 'Please provide an end date', 'themesdojo' ); ?>"
											    },
											    eventEndTime: {
											    	required: "<?php _e( 'Please provide an end time', 'themesdojo' ); ?>"
											    },
											    item_googleaddress: {
											    	required: "<?php _e( 'Please provide an address', 'themesdojo' ); ?>"
											    }
											},
											submitHandler: function(form) {
												tinyMCE.triggerSave();
											    jQuery('#upload-listing-buttons').css('display','none');
											    jQuery('#upload-listing-buttons-spinner').css('display','inline-block');
											    jQuery('#pageloader').css('display','inline-block');
											    jQuery(form).ajaxSubmit({
											        type: "POST",
													data: jQuery(form).serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>', 
											        success: function(data) {
											            if(data == 0) {

											            	jQuery('#pageloader').css('display','none');
											        		jQuery('#upload-listing-buttons-spinner').css('display','none');
											        		jQuery('#td-upload-listing').css('display','none');
											        		jQuery('#td-upload-listing-header').css('display','none');
											        		jQuery('#td-upload-listing-success').css('display','inline-block');
											        		jQuery('html, body').scrollTo(jQuery('#header'), 300);
					      									 
											            } else {

											            	jQuery('#pageloader').css('display','none');
											            	jQuery('#upload-listing-buttons').css('display','block');
												        	jQuery('#upload-listing-buttons-spinner').css('display','none');

												            jQuery('html, body').scrollTo(jQuery('#header'), 300);

												            jQuery('#slot-check-result').html('<i class="fa fa-exclamation-triangle"></i><h5><?php _e( "Slot is not available anymore, please reload and select another one.", "themesdojo" ); ?></h5>');
												            jQuery('#slot-check-result').css('display','inline-block');
												            
											            }
											        },
											        error: function(data) {

											        	jQuery('#pageloader').css('display','none');
											        	jQuery('#upload-listing-buttons').css('display','block');
											        	jQuery('#upload-listing-buttons-spinner').css('display','none');

											            jQuery('#error').fadeIn();
											        }
											    });
											}
										});
									});
								</script>

								<?php } ?>

							</div>

						</div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>