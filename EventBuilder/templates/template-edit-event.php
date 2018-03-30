<?php
/**
 * Template name: Edit Event Page
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

global $current_user, $user_id, $user_info;
get_currentuserinfo();
$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
$user_info = get_userdata($user_id);

$user_error = 0;

if(isset($_GET['post'])) {

	$postID = $_GET['post'];

	$post_author_id = get_post_field( 'post_author', $postID );

	if($post_author_id == $user_id)  { 

		$current_post = $postID;

		$td_slot_id = get_post_meta($current_post, 'item_package_id',true);

		$content = get_post_field('post_content', $current_post);

		// Location & Date
		$event_start_date = get_post_meta($postID, 'event_start_date', true);
		$event_start_time = get_post_meta($postID, 'event_start_time', true);
		$event_end_date = get_post_meta($postID, 'event_end_date', true);
		$event_end_time = get_post_meta($postID, 'event_end_time', true);
		$event_location = get_post_meta($postID, 'event_location', true);

		// Video
		$item_video = get_post_meta($postID, 'event_video', true);

		// Event Stats
		$item_crowd = get_post_meta($postID, 'item_crowd', true);
		$item_involvement = get_post_meta($postID, 'item_involvement', true);
		$item_preparation = get_post_meta($postID, 'item_preparation', true);
		$item_transformation = get_post_meta($postID, 'item_transformation', true);

		// Social
		$item_facebook = get_post_meta($postID, 'item_facebook', true);
		$item_foursquare = get_post_meta($postID, 'item_foursquare', true);
		$item_skype = get_post_meta($postID, 'item_skype', true);
		$item_googleplus = get_post_meta($postID, 'item_googleplus', true);
		$item_twitter = get_post_meta($postID, 'item_twitter', true);
		$item_dribbble = get_post_meta($postID, 'item_dribbble', true);
		$item_behance = get_post_meta($postID, 'item_behance', true);
		$item_linkedin = get_post_meta($postID, 'item_linkedin', true);
		$item_pinterest = get_post_meta($postID, 'item_pinterest', true);
		$item_tumblr = get_post_meta($postID, 'item_tumblr', true);
		$item_youtube = get_post_meta($postID, 'item_youtube', true);
		$item_delicious = get_post_meta($postID, 'item_delicious', true);
		$item_medium = get_post_meta($postID, 'item_medium', true);
		$item_soundcloud = get_post_meta($postID, 'item_soundcloud', true);

		$item_ticket_tailor = get_post_meta($postID, 'item_ticket_tailor', true);

		// Address & Contact Details
		$event_address_country = get_post_meta($postID, 'event_address_country', true);
		$event_address_state = get_post_meta($postID, 'event_address_state', true);
		$event_address_city = get_post_meta($postID, 'event_address_city', true);
		$event_address_address = get_post_meta($postID, 'event_address_address', true);
		$event_address_zip = get_post_meta($postID, 'event_address_zip', true);
		$event_phone = get_post_meta($postID, 'event_phone', true);
		$event_email = get_post_meta($postID, 'event_email', true);
		$event_website = get_post_meta($postID, 'event_website', true);

		$event_address_latitude = get_post_meta($postID, 'event_address_latitude', true);
		$event_address_longitude = get_post_meta($postID, 'event_address_longitude', true);
		$event_address_streetview = get_post_meta($postID, 'event_address_streetview', true);

		if(empty($event_address_latitude)) { $event_address_latitude = 0; };
		if(empty($event_address_longitude)) { $event_address_longitude = 0; };

		$event_googleaddress = get_post_meta($postID, 'event_googleaddress', true);

		$terms = get_the_terms($current_post, 'event_loc' );
		if ($terms && ! is_wp_error($terms)) :
			$term_slugs_arr = array();
			foreach ($terms as $term) {
				$term_slugs_arr[] = $term->slug;
			}
			$terms_slug_str = join( " ", $term_slugs_arr);
		endif;

		$terms_cat = get_the_terms($postID, 'event_cat' );
		if ($terms_cat && ! is_wp_error($terms_cat)) :
			$term_slugs_arr_cat = array();
				foreach ($terms_cat as $term_cat) {
					$term_slugs_arr_cat[] = $term_cat->slug;
				}
			$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
		endif;

		$terms_place = get_the_terms($postID, 'event_place' );
		if ($terms_place && ! is_wp_error($terms_place)) :
			$term_slugs_arr_cat = array();
				foreach ($terms_place as $term_place) {
					$term_slugs_arr_cat[] = $term_place->name;
				}
			$terms_slug_str_place = join( " ", $term_slugs_arr_cat);
		endif;

	    //show edit link    
	} else {

		$user_error = 1;

	}

}

global $current_post, $td_slot_id, $content;

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php if ( !is_user_logged_in() ) { _e( 'Ooops', 'themesdojo' ); } elseif($user_error == 1) { _e( 'Ooops', 'themesdojo' ); } else {?><?php the_title(); ?> - <?php echo get_the_title( $current_post ); ?><?php } ?></h1>

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

								<?php } elseif($user_error == 1) { ?>

								<h2><?php _e( 'We are sorry but this isn\'t your listing.', 'themesdojo' ); ?></h2>

								<?php } else { ?>

								<div id="td-upload-listing-success">

									<div class="item-block-title">

										<i class="fa fa-check-square"></i><h4><?php _e( 'Congratulations.', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

									<h5><?php _e( 'Event updated successfuly.', 'themesdojo' ); ?></h5>

									</div>

								</div>

								<form id="td-upload-listing" type="post" action="" >

									<div id="upload-form-holder-main-settings" style="display: inline-block;">

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

														<input type="text" name="listingFormTitle" id="listingFormTitle" value="<?php echo get_the_title( $current_post ); ?> " class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Category:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<select id="listingFormCat" name="listingFormCat">

															<?php

																$categories = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => 0) );

																foreach ($categories as $category) {
																	$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
																	$option .= $category->cat_name;
																	$option .= '</option>';

																	$catID = $category->term_id;

																	$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $catID) );

																	foreach ($categories_child as $category_child) {
																		$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
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
																	$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str, $category->slug ) .' >';
																	$option .= $category->cat_name;
																	$option .= '</option>';

																	$catID = $category->term_id;

																	$categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

																	foreach ($categories_child as $category_child) {
																		$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str, $category_child->slug ) .' > - ';
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

														<span class="form-label"><?php _e( 'Buy Ticket Shortcode (Tickera or TicketTailor:', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<textarea type='text' cols="70" rows="7" id='item_ticketailor' name='item_ticketailor'><?php if(!empty($item_ticket_tailor)) { echo $item_ticket_tailor; } ?></textarea>
														<p><?php _e( 'Add TicketTailor or Tickera shortcode here (<a href="http://www.tickettailor.com/?rf=ur8178-ex">https://www.tickettailor.com</a> or <a href="https://tickera.com/">https://tickera.com/</a>)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4" style="margin-top: 30px;">

														<span class="form-label"><?php _e( 'Event Stats - Crowd', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8" style="margin-top: 30px;">

														<input type="text" name="eventStatsCrowd" id="eventStatsCrowd" value="<?php if(!empty($item_crowd)) { echo esc_attr($item_crowd); } ?>" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add crowd percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Involvement', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsInvolvement" id="eventStatsInvolvement" value="<?php if(!empty($item_involvement)) { echo esc_attr($item_involvement); } ?>" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add involvement percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Preparation', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsPreparation" id="eventStatsPreparation" value="<?php if(!empty($item_preparation)) { echo esc_attr($item_preparation); } ?>" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add preparation percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Event Stats - Transformation', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="eventStatsTransformation" id="eventStatsTransformation" value="<?php if(!empty($item_transformation)) { echo esc_attr($item_transformation); } ?>" class="input-textarea" placeholder="80" />
														<p><?php _e( 'Add transformation percent (ex: 80)', 'themesdojo' ); ?></p>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div id="upload-form-holder" style="display: inline-block;">

										<div class="item-block-title">

											<i class="fa fa-camera"></i><h4><?php _e( 'Cover Image', 'themesdojo' ); ?></h4>

											<span id="cover-image-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#cover-image-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div class="row">

												<div id="cover-image-block" class="collapse in">

													<div class="col-sm-12">

														<?php if(has_post_thumbnail($current_post)) { ?>

														<span class="listing-cover-image">

															<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post ), false, '' ); ?>

															<img id="item-cover-photo" class="author-avatar" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

														    <input id="avatar-image-url" type="hidden" name="avatar-image-url" value="<?php echo esc_url($image_src[0]); ?>" /> 
														    <input id="avatar-image-id" type="hidden" name="avatar-image-id" value="<?php echo td_get_attachment_id_from_src($image_src[0]); ?>" /> 
														                                	                                   
														</span>

														<a href="#" id="avatar-upload-image" class="td-buttom" style="display: none;" ><i class="fa fa-cloud-upload"></i><?php _e( 'Upload Image', 'themesdojo' ); ?></a>
														<a href="#" id="avatar-delete-image" class="td-buttom" ><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

														<?php } else { ?>

														<span class="listing-cover-image">

															<img id="item-cover-photo" class="author-avatar" style="display: none;" src="" alt="" />

														    <input id="avatar-image-url" type="hidden" name="avatar-image-url" value="" /> 
														    <input id="avatar-image-id" type="hidden" name="avatar-image-id" value="" /> 
														                                	                                   
														</span>

														<a href="#" id="avatar-upload-image" class="td-buttom" ><i class="fa fa-cloud-upload"></i><?php _e( 'Upload Image', 'themesdojo' ); ?></a>
														<a href="#" id="avatar-delete-image" class="td-buttom" style="display: none;" ><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

														<?php } ?>

														<script>
															var image_custom_uploader_1;
															var $thisItem = '';

															jQuery(document).on('click','#avatar-upload-image', function(e) {
																e.preventDefault();

																$thisItem = jQuery(this);

																//If the uploader object has already been created, reopen the dialog
																if (image_custom_uploader_1) {
																	image_custom_uploader_1.open();
																	return;
																}

																//Extend the wp.media object
																image_custom_uploader_1 = wp.media.frames.file_frame = wp.media({
																	title: 'Choose Image',
																	button: {
																		text: 'Choose Image'
																	},
																	multiple: false
																});

																//When a file is selected, grab the URL and set it as the text field's value
																image_custom_uploader_1.on('select', function() {
																	attachment = image_custom_uploader_1.state().get('selection').first().toJSON();
																	var url = '';
																	url = attachment['url'];
																	var attachId = '';
																	attachId = attachment['id'];
																	jQuery('#avatar-image-id').val(attachId);
																	jQuery('#avatar-image-url').val(url);
																	jQuery( "img#item-cover-photo" ).attr({
																		src: url
																	});
																	jQuery( "img#item-cover-photo" ).css("display", "inline-block");
																	jQuery(".author-avatar-container").css("background", "none");
																	jQuery("#avatar-upload-image").css("display", "none");
																	jQuery("#avatar-delete-image").css("display", "inline-block");
																});

																//Open the uploader dialog
																image_custom_uploader_1.open();
															});

															jQuery(document).on('click','#avatar-delete-image', function(e) {
																e.preventDefault();
																jQuery('#avatar-image-url').val('');
																jQuery('#avatar-image-id').val('');
																jQuery( "img#item-cover-photo" ).attr({
																	src: ''
																});
																jQuery( "img#item-cover-photo" ).css("display", "none");
																jQuery("#avatar-upload-image").css("display", "inline-block");
																jQuery(this).css("display", "none");
															});
														</script>

													</div>

												</div>

											</div>

										</div>

										<?php $package_allow_gallery = get_post_meta($td_slot_id, 'package_allow_gallery', true); if(!empty($package_allow_gallery)) { ?>

										<div class="item-block-title">

											<i class="fa fa-file-image-o"></i><h4><?php _e( 'Gallery', 'themesdojo' ); ?></h4>

											<span id="gallery-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#gallery-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="gallery-block" class="collapse in">

												<div class="row">

													<div id="listing-upload-gallery">

														<?php

															$attachments = get_children(array('post_parent' => $current_post,
																							'post_status' => 'inherit',
																							'post_type' => 'attachment',
																							'post_mime_type' => 'image',
																							'order' => 'DESC',
																							'orderby' => 'menu_order ID'));

															get_template_part( 'inc/BFI_Thumb' );
															$params = array( 'width' => 500, 'height' => 500, 'crop' => true ); 

															$currentId = 0;

															foreach($attachments as $att_id => $attachment) {
																$full_img_url = wp_get_attachment_url($attachment->ID);
																$split_pos = strpos($full_img_url, 'wp-content');
																$split_len = (strlen($full_img_url) - $split_pos);
																$abs_img_url = substr($full_img_url, $split_pos, $split_len);
																$full_info = @getimagesize(ABSPATH.$abs_img_url);

																$currentId++;

														?>

														<div class="option_item" id="<?php echo esc_attr($currentId); ?>">
															
															<div class="listing-upload-gallery-image">
																
																<span class="gallery-image-holder" style="background-image: url(<?php echo esc_url(bfi_thumb( $full_img_url, $params )); ?>);"></span> 
																<span class="gallery-image-background"><i class="fa fa-file-image-o"></i></span> 

															</div>
																			
															<input class="listing-upload-gallery-image-data-url" id="listing-upload-gallery-image-data[<?php echo esc_attr($currentId); ?>][0]" type="hidden" name="listing-upload-gallery-image-data[<?php echo esc_attr($currentId); ?>][0]" value="<?php echo esc_url($full_img_url); ?>"/>
															<input class="listing-upload-gallery-image-data-id" id="listing-upload-gallery-image-data[<?php echo esc_attr($currentId); ?>][1]" type="hidden" name="listing-upload-gallery-image-data[<?php echo esc_attr($currentId); ?>][1]" value="<?php echo td_get_attachment_id_from_src($full_img_url); ?>"/>

															<a href="#" class="td-buttom avatar-upload-image" style="display: none;" ><?php _e( 'Upload', 'themesdojo' ); ?></a>
															<a href="#" class="td-buttom avatar-delete-image" ><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

															<script>
																var image_custom_uploader_2;
																var $thisItem = '';

																jQuery(document).on('click','.avatar-upload-image', function(e) {
																	e.preventDefault();

																	$thisItem = jQuery(this);

																	//If the uploader object has already been created, reopen the dialog
																	if (image_custom_uploader_2) {
																		image_custom_uploader_2.open();
																		return;
																	}

																	//Extend the wp.media object
																	image_custom_uploader_2 = wp.media.frames.file_frame = wp.media({
																		title: 'Choose Image',
																		button: {
																			text: 'Choose Image'
																		},
																		multiple: false
																	});

																	//When a file is selected, grab the URL and set it as the text field's value
																	image_custom_uploader_2.on('select', function() {
																		attachment = image_custom_uploader_2.state().get('selection').first().toJSON();
																		var url = '';
																		url = attachment['url'];
																		var attachId = '';
																		attachId = attachment['id'];
																		$thisItem.parent().find('.listing-upload-gallery-image-data-url').val(url);
																		$thisItem.parent().find('.listing-upload-gallery-image-data-id').val(attachId);
																		$thisItem.parent().find(".gallery-image-holder").css("background-image", "url("+url+")");
																		$thisItem.parent().find(".avatar-upload-image").css("display", "none");
																		$thisItem.parent().find(".avatar-delete-image").css("display", "inline-block");
																	});

																	//Open the uploader dialog
																	image_custom_uploader_2.open();
																});

																jQuery(document).on('click','.avatar-delete-image', function(e) {
																	jQuery(this).parent().find('.listing-upload-gallery-image-data-url').val('');
																	jQuery(this).parent().find('.listing-upload-gallery-image-data-id').val('');
																	jQuery(this).parent().find(".gallery-image-holder").css("background-image", "none");
																	jQuery(this).parent().find(".avatar-upload-image").css("display", "inline-block");
																	jQuery(this).css("display", "none");
																});

															</script>
																	
														</div>

														<?php 

															}
														
														?>

													</div>

													<div id="listing-upload-gallery-template">
																
														<div class="option_item" id="0">
															
															<div class="listing-upload-gallery-image">
																
																<span class="gallery-image-holder"></span> 
																<span class="gallery-image-background"><i class="fa fa-file-image-o"></i></span> 

															</div>
																			
															<input class="listing-upload-gallery-image-data-url" id="" type="hidden" name="" />
															<input class="listing-upload-gallery-image-data-id" id="" type="hidden" name="" />

															<a href="#" class="td-buttom avatar-upload-image" ><?php _e( 'Upload', 'themesdojo' ); ?></a>
															<a href="#" class="td-buttom avatar-delete-image" style="display: none;" ><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

															<script>
																var image_custom_uploader_2;
																var $thisItem = '';

																jQuery(document).on('click','.avatar-upload-image', function(e) {
																	e.preventDefault();

																	$thisItem = jQuery(this);

																	//If the uploader object has already been created, reopen the dialog
																	if (image_custom_uploader_2) {
																		image_custom_uploader_2.open();
																		return;
																	}

																	//Extend the wp.media object
																	image_custom_uploader_2 = wp.media.frames.file_frame = wp.media({
																		title: 'Choose Image',
																		button: {
																			text: 'Choose Image'
																		},
																		multiple: false
																	});

																	//When a file is selected, grab the URL and set it as the text field's value
																	image_custom_uploader_2.on('select', function() {
																		attachment = image_custom_uploader_2.state().get('selection').first().toJSON();
																		var url = '';
																		url = attachment['url'];
																		var attachId = '';
																		attachId = attachment['id'];
																		$thisItem.parent().find('.listing-upload-gallery-image-data-url').val(url);
																		$thisItem.parent().find('.listing-upload-gallery-image-data-id').val(attachId);
																		$thisItem.parent().find(".gallery-image-holder").css("background-image", "url("+url+")");
																		$thisItem.parent().find(".avatar-upload-image").css("display", "none");
																		$thisItem.parent().find(".avatar-delete-image").css("display", "inline-block");
																	});

																	//Open the uploader dialog
																	image_custom_uploader_2.open();
																});

																jQuery(document).on('click','.avatar-delete-image', function(e) {
																	e.preventDefault();
																	jQuery(this).parent().find('.listing-upload-gallery-image-data-url').val('');
																	jQuery(this).parent().find('.listing-upload-gallery-image-data-id').val('');
																	jQuery(this).parent().find(".gallery-image-holder").css("background-image", "none");
																	jQuery(this).parent().find(".avatar-upload-image").css("display", "inline-block");
																	jQuery(this).css("display", "none");
																});

															</script>
																	
														</div>

													</div>

													<div class="option_item">
														<button type="button" name="submit_add_portfolio" id='submit_add_portfolio' value="add" class="button-secondary"><i class="fa fa-plus-circle"></i></button>
													</div>

													<script>

														//ADD PORTFOLIO
												        jQuery('#listing-upload-gallery-template').hide();
												        jQuery('#submit_add_portfolio').on('click', function() {        
												            $newItem = jQuery('#listing-upload-gallery-template .option_item').clone().appendTo('#listing-upload-gallery').show();
												            if ($newItem.prev('.option_item').size() == 1) {
												                var id = parseInt($newItem.prev('.option_item').attr('id')) + 1;
												            } else {
												                var id = 0; 
												            }
												            $newItem.attr('id', id);

												            var nameText = 'listing-upload-gallery-image-data[' + id + '][0]';
												            $newItem.find('.listing-upload-gallery-image-data-url').attr('id', nameText).attr('name', nameText);

												            var nameText = 'listing-upload-gallery-image-data[' + id + '][1]';
												            $newItem.find('.listing-upload-gallery-image-data-id').attr('id', nameText).attr('name', nameText);


												            //event handler for newly created element
												            $newItem.children('.avatar-delete-image').on('click', function(e) {
												            	e.preventDefault();
												                jQuery(this).parent('.option_item').remove();
												            });

												        });
												        
												        //DELETE
												        jQuery('.avatar-delete-image').on('click', function(e) {
												        	e.preventDefault();
												            jQuery(this).parent('.option_item').remove();
												        });

													</script>

												</div>

											</div>

										</div>

										<?php } ?>

										<div class="item-block-title">

											<i class="fa fa-map-marker"></i><h4><?php _e( 'Address', 'themesdojo' ); ?></h4>

											<span id="address-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#address-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="address-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Country', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormCountry" id="listingFormCountry" value="<?php if(!empty($event_address_country)) { echo esc_attr($event_address_country); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'State', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormState" id="listingFormState" value="<?php if(!empty($event_address_state)) { echo esc_attr($event_address_state); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'City', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormCity" id="listingFormCity" value="<?php if(!empty($event_address_city)) { echo esc_attr($event_address_city); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Address', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormAddress" id="listingFormAddress" value="<?php if(!empty($event_address_address)) { echo esc_attr($event_address_address); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Zip Code', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormZipCode" id="listingFormZipCode" value="<?php if(!empty($event_address_zip)) { echo esc_attr($event_address_zip); } ?>" class="input-textarea" placeholder="" />

													</div>

												</div>

											</div>

										</div>

										<div class="item-block-title">

											<i class="fa fa-envelope-o"></i><h4><?php _e( 'Contact Details', 'themesdojo' ); ?></h4>

											<span id="contact-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#contact-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="contact-block" class="collapse in">

												<div class="row">

													<?php $package_allow_phone = get_post_meta($td_slot_id, 'package_allow_phone', true); if(!empty($package_allow_phone)) { ?>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Phone', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormPhone" id="listingFormPhone" value="<?php if(!empty($event_phone)) { echo esc_attr($event_phone); } ?>" class="input-textarea" placeholder="" />

													</div>

													<?php } ?>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'E-Mail', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormEmail" id="listingFormEmail" value="<?php if(!empty($event_email)) { echo esc_attr($event_email); } ?>" class="input-textarea" placeholder="" />

													</div>

													<?php $package_allow_web = get_post_meta($td_slot_id, 'package_allow_web', true); if(!empty($package_allow_web)) { ?>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Website', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="listingFormWebsite" id="listingFormWebsite" value="<?php if(!empty($event_website)) { echo esc_url($event_website); } ?>" class="input-textarea" placeholder="" />

													</div>

													<?php } ?>

												</div>

											</div>

										</div>

										<?php $package_allow_social = get_post_meta($td_slot_id, 'package_allow_social', true); if(!empty($package_allow_social)) { ?>

										<div class="item-block-title">

											<i class="fa fa-facebook-official"></i><h4><?php _e( 'Social Links', 'themesdojo' ); ?></h4>

											<span id="social-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#social-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>
								 
										<div class="item-block-content">

											<div id="social-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Facebook', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_facebook" id="item_facebook" value="<?php if(!empty($item_facebook)) { echo esc_url($item_facebook); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Foursquare', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_foursquare" id="item_foursquare" value="<?php if(!empty($item_foursquare)) { echo esc_url($item_foursquare); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Google+', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_googleplus" id="item_googleplus" value="<?php if(!empty($item_googleplus)) { echo esc_url($item_googleplus); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Twitter', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_twitter" id="item_twitter" value="<?php if(!empty($item_twitter)) { echo esc_url($item_twitter); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Dribbble', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_dribbble" id="item_dribbble" value="<?php if(!empty($item_dribbble)) { echo esc_url($item_dribbble); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Behance', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_behance" id="item_behance" value="<?php if(!empty($item_behance)) { echo esc_url($item_behance); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Linkedin', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_linkedin" id="item_linkedin" value="<?php if(!empty($item_linkedin)) { echo esc_url($item_linkedin); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Pinterest', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_pinterest" id="item_pinterest" value="<?php if(!empty($item_pinterest)) { echo esc_url($item_pinterest); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Tumblr', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_tumblr" id="item_tumblr" value="<?php if(!empty($item_tumblr)) { echo esc_url($item_tumblr); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'YouTube', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_youtube" id="item_youtube" value="<?php if(!empty($item_youtube)) { echo esc_url($item_youtube); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Delicious', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_delicious" id="item_delicious" value="<?php if(!empty($item_delicious)) { echo esc_url($item_delicious); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Medium', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_medium" id="item_medium" value="<?php if(!empty($item_medium)) { echo esc_url($item_medium); } ?>" class="input-textarea" placeholder="" />

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'SoundCloud', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_soundcloud" id="item_soundcloud" value="<?php if(!empty($item_soundcloud)) { echo esc_url($item_soundcloud); } ?>" class="input-textarea" placeholder="" />

													</div>

												</div>

											</div>

										</div>

										<?php } ?>

										<?php $package_allow_video = get_post_meta($td_slot_id, 'package_allow_video', true); if(!empty($package_allow_video)) { ?>

										<div class="item-block-title">

											<i class="fa fa-file-video-o"></i><h4><?php _e( 'Video Presentation', 'themesdojo' ); ?></h4>

											<span id="video-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#video-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="video-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Video', 'themesdojo' ); ?></span>
														<p><?php _e( 'YouTube & Vimeo embedded code.', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-8">

														<textarea type='text' cols="70" rows="7" id='item_video' name='item_video'><?php if(!empty($item_video)) { echo $item_video; } ?></textarea>

													</div>

												</div>

											</div>

										</div>

										<?php } ?>

										<div class="item-block-title">

											<i class="fa fa-check-square"></i><h4><?php _e( 'Tags', 'themesdojo' ); ?></h4>

											<span id="amenities-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#amenities-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="amenities-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Tags', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<textarea type='text' cols="70" rows="7" id='item_amenities' name='item_amenities'><?php

																$tags = wp_get_object_terms($current_post, 'event_tag'); 
																if(!empty($tags)) {

																	foreach ( (array) $tags as $tag ) {

																		echo ''.$tag->name.', ';

																	}

																}

															?></textarea>
														<p><?php _e( 'Add tag separated by comma.', 'themesdojo' ); ?></p>

													</div>

												</div>

											</div>

										</div>

										<div class="item-block-title">

											<i class="fa fa-globe"></i><h4><?php _e( 'Map', 'themesdojo' ); ?></h4>

											<span id="map-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#map-block" style="float: right;">

												<i class="fa fa-plus-circle"></i>
												<i class="fa fa-minus-circle"></i>

											</span>

										</div>

										<div class="item-block-content">

											<div id="map-block" class="collapse in">

												<div class="row">

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Google Map Address', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input type="text" name="item_googleaddress" id="item_googleaddress" value="<?php if(!empty($event_googleaddress)) { echo esc_attr($event_googleaddress); } ?>" class="input-textarea" placeholder="" />
														<p><?php _e( 'Start typing an address and select from the dropdown.', 'themesdojo' ); ?></p>

													</div>

													<div class="col-sm-12">

														<div id="map-canvas"></div>

														<input type="hidden" id="latitude" name="item_address_latitude" value="<?php if(!empty($event_address_latitude)) { echo esc_attr($event_address_latitude); } ?>" size="12" class="form-text required">
														<input type="hidden" id="longitude" name="item_address_longitude" value="<?php if(!empty($event_address_longitude)) { echo esc_attr($event_address_longitude); } ?>" size="12" class="form-text required">

														<script type="text/javascript">

															jQuery(document).ready(function($) {

																var geocoder;
																var map;
																var marker;

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
																}

																function updateMarkerPosition(latLng) {
																	jQuery('#latitude').val(latLng.lat());
																	jQuery('#longitude').val(latLng.lng());
																}

																function updateMarkerAddress(str) {
																	jQuery('#item_googleaddress').val(str);
																}

																function initialize() {

																	var latlng = new google.maps.LatLng(<?php if(empty($event_address_latitude)) { ?>40.7127837<?php } else { echo esc_attr($event_address_latitude); } ?>, <?php if(empty($event_address_longitude)) { ?>-74.00594130000002<?php } else { echo esc_attr($event_address_longitude); } ?>);
																	var mapOptions = {
																		zoom: 16,
																		center: latlng
																	}

																	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

																	geocoder = new google.maps.Geocoder();

																	marker = new google.maps.Marker({
																		position: latlng,
																		map: map,
																		draggable: true
																	});

																	// Add dragging event listeners.
																	google.maps.event.addListener(marker, 'dragstart', function() {
																		updateMarkerAddress('Dragging...');
																	});
																			  
																	google.maps.event.addListener(marker, 'drag', function() {
																		updateMarkerPosition(marker.getPosition());
																	});
																			  
																	google.maps.event.addListener(marker, 'dragend', function() {
																		geocodePosition(marker.getPosition());
																	});

																}

																google.maps.event.addDomListener(window, 'load', initialize);

																jQuery(document).ready(function() { 
																			         
																	initialize();
																			          
																	jQuery(function() {
																		jQuery("#item_googleaddress").autocomplete({
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

																			var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

																			marker.setPosition(location);
																			map.setZoom(16);
																			map.setCenter(location);

																		}
																	});
																});
																			  
																//Add listener to marker for reverse geocoding
																google.maps.event.addListener(marker, 'drag', function() {
																	geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
																		if (status == google.maps.GeocoderStatus.OK) {
																			if (results[0]) {
																			        jQuery('#item_googleaddress').val(results[0].formatted_address);
																			        jQuery('#latitude').val(marker.getPosition().lat());
																			        jQuery('#longitude').val(marker.getPosition().lng());
																			    }
																			}
																		});
																	});
																			  
																});

															});

														</script>

													</div>

													<div class="col-sm-4">

														<span class="form-label"><?php _e( 'Enable Streetview', 'themesdojo' ); ?></span>

													</div>

													<div class="col-sm-8">

														<input style="width: 14px !important;" type="checkbox" name="item_address_streetview" value="enabled-streetview" <?php if(!empty($event_address_streetview)) { ?>checked<?php } ?>>

													</div>

												</div>

											</div>

										</div>

										<div class="item-block-title">

											<i class="fa fa-cloud-upload"></i><h4><?php _e( 'Update Event', 'themesdojo' ); ?></h4>

										</div>

										<div id="upload-listing-buttons" class="item-block-content">

											<div class="row">

												<div class="col-sm-6">

													<button id="listingDraft" name="submit" type="submit" ><i class="fa fa-floppy-o"></i><?php _e( 'Save as Draft', 'themesdojo' ); ?></button>

													<script>
														jQuery(document).on('click','#listingDraft', function() {

															jQuery('#postStatus').val('draft');
																	
														});
													</script>

												</div>

												<div class="col-sm-6">

													<?php 

														$package_approve_item = get_post_meta($td_slot_id, 'package_approve_item', true);
														if(empty($package_approve_item)) {

													?>

													<button id="listingPublish" name="submit" type="submit" ><i class="fa fa-cloud-upload"></i><?php _e( 'Update', 'themesdojo' ); ?></button>

													<script>
														jQuery(document).on('click','#listingPublish', function() {

															jQuery('#postStatus').val('published');
																	
														});
													</script>

													<?php } else { ?>

													<button id="listingPublish" name="submit" type="submit" ><i class="fa fa-cloud-upload"></i><?php _e( 'Submit for Review', 'themesdojo' ); ?></button>

													<script>
														jQuery(document).on('click','#listingPublish', function() {

															jQuery('#postStatus').val('published');
																	
														});
													</script>

													<?php } ?>

												</div>

											</div>

										</div>

										<div id="upload-listing-buttons-spinner" class="item-block-content">

											<div class="row">

												<div class="col-sm-12">

													<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

												</div>

											</div>

										</div>

									</div>

									<input type="hidden" id="postId" name="post_id" value="<?php echo esc_attr($current_post); ?>">
									<input type="hidden" id="postStatus" name="postStatus" value="">

									<input type="hidden" name="action" value="tdEditEventForm" />
									<?php wp_nonce_field( 'tdEditEvent_html', 'tdEditEvent_nonce' ); ?>

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
											        		jQuery('#upload-form-holder-main-settings').css('display','none');
											        		jQuery('#upload-form-holder').css('display','none');
											        		jQuery('#td-upload-listing-success').css('display','inline-block');
											        		jQuery('html, body').scrollTo(jQuery('#header'), 300);
					      									 
											            } else {

											            	jQuery('#pageloader').css('display','none');
											            	jQuery('#upload-listing-buttons').css('display','block');
												        	jQuery('#upload-listing-buttons-spinner').css('display','none');

												            jQuery('html, body').scrollTo(jQuery('#header'), 300);

												            jQuery('#slot-check-result').html('<i class="fa fa-exclamation-triangle"></i><h5><?php _e( "Something went wrong. Please reload and try again.", "themesdojo" ); ?></h5>');
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