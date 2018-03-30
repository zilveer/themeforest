<?php

function tdUploadEventForm() {

	$response = 0;

  	if ( isset( $_POST['tdUploadEventForm_nonce'] ) && wp_verify_nonce( $_POST['tdUploadEventForm_nonce'], 'tdUploadEventForm_html' ) ) {

  		global $wpdb;
  		$user_id = $_POST['user_id'];
		$tdSlotId = $_POST['td-slot-id-form'];
		list($td_slot_type,$td_slot_id) = explode("-",$tdSlotId);

		?>

		<?php

		$package_allow_feat_image = get_post_meta($td_slot_id, 'package_allow_feat_image', true);

		if(!empty($package_allow_feat_image)) { ?>

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

						<span class="listing-cover-image">

							<img id="item-cover-photo" class="author-avatar" style="display: none;" src="" alt="" /> 

						    <input id="avatar-image-url" type="hidden" name="avatar-image-url" value="" /> 
						    <input id="avatar-image-id" type="hidden" name="avatar-image-id" value="" /> 
						                                	                                   
						</span>

						<a href="#" id="avatar-upload-image" class="td-buttom" ><i class="fa fa-cloud-upload"></i><?php _e( 'Upload Image', 'themesdojo' ); ?></a>
						<a href="#" id="avatar-delete-image" class="td-buttom" style="display: none;" ><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></a>

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

		<?php } ?>

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

						<div class="option_item" id="0" style="display: none;">
							
							<div class="listing-upload-gallery-image">
								
								<span class="gallery-image-holder"></span> 
								<span class="gallery-image-background"><i class="fa fa-file-image-o"></i></span> 

							</div>
											
							<input class="listing-upload-gallery-image-data-url" id="listing-upload-gallery-image-data[0][0]" type="hidden" name="listing-upload-gallery-image-data[0][0]" />
							<input class="listing-upload-gallery-image-data-id" id="listing-upload-gallery-image-data[0][1]" type="hidden" name="listing-upload-gallery-image-data[0][1]" />

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
									jQuery(this).parent().find('.listing-upload-gallery-image-data-url').val('');
									jQuery(this).parent().find('.listing-upload-gallery-image-data-id').val('');
									jQuery(this).parent().find(".gallery-image-holder").css("background-image", "none");
									jQuery(this).parent().find(".avatar-upload-image").css("display", "inline-block");
									jQuery(this).css("display", "none");
								});

							</script>
									
						</div>

					</div>

					<div id="listing-upload-gallery-template">
								
						<div class="option_item" id="0">
							
							<div class="listing-upload-gallery-image">
								
								<span class="gallery-image-holder"></span> 
								<span class="gallery-image-background"><i class="fa fa-file-image-o"></i></span> 

							</div>
											
							<input class="listing-upload-gallery-image-data-url" id="listing-upload-gallery-image-data[0][0]" type="hidden" name="listing-upload-gallery-image-data[0][0]" />
							<input class="listing-upload-gallery-image-data-id" id="listing-upload-gallery-image-data[0][1]" type="hidden" name="listing-upload-gallery-image-data[0][1]" />

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

						<input type="text" name="listingFormCountry" id="listingFormCountry" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'State', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormState" id="listingFormState" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'City', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormCity" id="listingFormCity" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Address', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormAddress" id="listingFormAddress" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Zip Code', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormZipCode" id="listingFormZipCode" value="" class="input-textarea" placeholder="" />

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

						<input type="text" name="listingFormPhone" id="listingFormPhone" value="" class="input-textarea" placeholder="" />

					</div>

					<?php } ?>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'E-Mail', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormEmail" id="listingFormEmail" value="" class="input-textarea" placeholder="" />

					</div>

					<?php $package_allow_web = get_post_meta($td_slot_id, 'package_allow_web', true); if(!empty($package_allow_web)) { ?>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Website', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="listingFormWebsite" id="listingFormWebsite" value="" class="input-textarea" placeholder="" />

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

						<input type="text" name="item_facebook" id="item_facebook" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Foursquare', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_foursquare" id="item_foursquare" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Google+', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_googleplus" id="item_googleplus" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Twitter', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_twitter" id="item_twitter" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Dribbble', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_dribbble" id="item_dribbble" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Behance', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_behance" id="item_behance" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Linkedin', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_linkedin" id="item_linkedin" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Pinterest', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_pinterest" id="item_pinterest" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Tumblr', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_tumblr" id="item_tumblr" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'YouTube', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_youtube" id="item_youtube" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Delicious', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_delicious" id="item_delicious" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Medium', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_medium" id="item_medium" value="" class="input-textarea" placeholder="" />

					</div>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'SoundCloud', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input type="text" name="item_soundcloud" id="item_soundcloud" value="" class="input-textarea" placeholder="" />

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

						<textarea type='text' cols="70" rows="7" id='item_video' name='item_video'></textarea>

					</div>

				</div>

			</div>

		</div>

		<?php } ?>

		<?php $package_allow_amenities = get_post_meta($td_slot_id, 'package_allow_amenities', true); if(!empty($package_allow_amenities)) { ?>

		<div class="item-block-title">

			<i class="fa fa-check-square"></i><h4><?php _e( 'Amenities', 'themesdojo' ); ?></h4>

			<span id="amenities-block-expand" class="td-buttom"  data-toggle="collapse" data-target="#amenities-block" style="float: right;">

				<i class="fa fa-plus-circle"></i>
				<i class="fa fa-minus-circle"></i>

			</span>

		</div>

		<div class="item-block-content">

			<div id="amenities-block" class="collapse in">

				<div class="row">

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Amenities', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<textarea type='text' cols="70" rows="7" id='item_amenities' name='item_amenities'></textarea>
						<p><?php _e( 'Add amenities separated by comma.', 'themesdojo' ); ?></p>

					</div>

				</div>

			</div>

		</div>

		<?php } ?>

		<?php $package_allow_map = get_post_meta($td_slot_id, 'package_allow_map', true); if(!empty($package_allow_map)) { ?>

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

						<input type="text" name="item_googleaddress" id="item_googleaddress" value="" class="input-textarea" placeholder="" />
						<p><?php _e( 'Start typing an address and select from the dropdown.', 'themesdojo' ); ?></p>

					</div>

					<div class="col-sm-12">

						<div id="map-canvas"></div>

						<input type="hidden" id="latitude" name="item_address_latitude" value="" size="12" class="form-text required">
						<input type="hidden" id="longitude" name="item_address_longitude" value="" size="12" class="form-text required">

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

									var latlng = new google.maps.LatLng(40.7127837, -74.00594130000002);
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

					<?php $package_allow_streetview = get_post_meta($td_slot_id, 'package_allow_streetview', true); if(!empty($package_allow_streetview)) { ?>

					<div class="col-sm-4">

						<span class="form-label"><?php _e( 'Enable Streetview', 'themesdojo' ); ?></span>

					</div>

					<div class="col-sm-8">

						<input style="width: 14px !important;" type="checkbox" name="item_address_streetview" value="enabled-streetview" >

					</div>

					<?php } ?>

				</div>

			</div>

		</div>

		<?php } ?>

		<div class="item-block-title">

			<i class="fa fa-cloud-upload"></i><h4><?php _e( 'Upload Event', 'themesdojo' ); ?></h4>

		</div>

		<div id="upload-listing-buttons" class="item-block-content">

			<div class="row">

				<div class="col-sm-6">

					<button id="listingDraft" name="submit" type="submit" class="td-buttom"><i class="fa fa-floppy-o"></i><?php _e( 'Save as Draft', 'themesdojo' ); ?></button>

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

					<button id="listingPublish" name="submit" type="submit" class="td-buttom"><i class="fa fa-cloud-upload"></i><?php _e( 'Upload', 'themesdojo' ); ?></button>

					<script>
						jQuery(document).on('click','#listingPublish', function() {

							jQuery('#postStatus').val('published');
									
						});
					</script>

					<?php } else { ?>

					<button id="listingPublish" name="submit" type="submit" class="td-buttom"><i class="fa fa-cloud-upload"></i><?php _e( 'Submit for Review', 'themesdojo' ); ?></button>

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

		<?php

		$response = ob_get_contents();

        //=========================================

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdUploadEventForm', 'tdUploadEventForm' );
add_action( 'wp_ajax_nopriv_tdUploadEventForm', 'tdUploadEventForm' );


