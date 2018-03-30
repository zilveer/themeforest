<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); 

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

?>

		<?php themesdojo_setPostViews(get_the_ID()); ?>

		<?php while ( have_posts() ) : the_post(); ?>

		<!--===============================-->
		<!--== Contact Owner ==============-->
		<!--===============================-->
		<div id="popup-contact-owner">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-envelope-o"></i><h4><?php _e( 'Contact For Reservation', 'themesdojo' ); ?></h4>

							<a id="close-popup-login" href="#" data-rel="tooltip" rel="top" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></a>

						</div>

						<div class="item-popup-content">

							<?php

								global $redux_demo; 
								$contact_state = $redux_demo['contact-owner-state'];

								if($contact_state == 1) {

							?>

							<form id="contact" type="post" action="" >  
							  	
							  	<span class="contact-name">
									<input type="text"  name="contactName" id="contactName" value="" class="input-textarea" placeholder="<?php _e("Name*", "themesdojo"); ?>" />
								</span>
								 
								<span class="contact-email">
									<input type="text" name="email" id="email" value="" class="input-textarea" placeholder="<?php _e("Email*", "themesdojo"); ?>" />
								</span>

								<span class="contact-message">
								    <textarea name="message" id="message" cols="8" rows="5" ></textarea>
								</span>

								<span class="contact-test">
								    <p><?php _e("Human test. Please input the result of 5+3=?", "themesdojo"); ?></p>
								    <input type="text" onfocus="if(this.value=='')this.value='';" onblur="if(this.value=='')this.value='';" name="answer" id="humanTest" value="" class="input-textarea" />
								</span>

								<?php $event_email = get_post_meta($post->ID, 'event_email', true); ?>

								<input type="text" name="receiverEmail" id="receiverEmail" value="<?php echo esc_attr($event_email); ?>" class="input-textarea" style="display: none;"/>

								<input type="text" name="emailSubject" id="emailSubject" value="<?php _e( 'Message from', 'themesdojo' ); ?> <?php $blog_name = get_bloginfo('name'); echo esc_attr($blog_name); ?>" class="input-textarea" style="display: none;"/>

								<input type="hidden" name="action" value="ContactOwnerForm" />
								<?php wp_nonce_field( 'ContactOwnerForm_html', 'ContactOwnerForm_nonce' ); ?>

								<span class="full">

									<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Send Message', 'themesdojo' ); ?>" class="input-submit">	 

									<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

								</span>
							  	  
							</form>

							<div id="success">
								<span><?php _e( 'Thank you! We will get back to you as soon as possible.', 'themesdojo' ); ?></span>
							</div>
								 
							<div id="error">
								<span><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></span>
							</div>

							<script type="text/javascript">

							jQuery(function($) {
								jQuery('#contact').validate({
							        rules: {
							            contactName: {
							                required: true
							            },
							            email: {
							                required: true,
							                email: true
							            },
							            message: {
							                required: true
							            },
							            answer: {
							                required: true,
							                answercheck: true
							            }
							        },
							        messages: {
							            name: {
							                required: "<?php _e( 'You have a name don’t you?', 'themesdojo' ); ?>"
							            },
							            email: {
							                required: "<?php _e( 'No email, no message.', 'themesdojo' ); ?>"
							            },
							            message: {
							                required: "<?php _e( 'You have to write something to send this form.', 'themesdojo' ); ?>"
							            },
							            answer: {
							                required: "<?php _e( 'Sorry, wrong answer!', 'themesdojo' ); ?>"
							            }
							        },
							        submitHandler: function(form) {
							        	jQuery('#contact .input-submit').css('display','none');
							        	jQuery('#contact .submit-loading').css('display','inline-block');
							            jQuery(form).ajaxSubmit({
							            	type: "POST",
									        data: jQuery(form).serialize(),
									        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
							                success: function(data) {
							                   	jQuery('#contact #contactName').val('');
							                   	jQuery('#contact #email').val('');
							                   	jQuery('#contact #message').val('');
							                   	jQuery('#contact #humanTest').val('');
							                   	jQuery('#contact .input-submit').css('display','block');
							        			jQuery('#contact .submit-loading').css('display','none');
							        			jQuery('#success').css('display','inline-block');
							                    jQuery('#popup-contact-owner').fadeTo( "slow", 0, function() {
							                    	jQuery('#popup-contact-owner').css('display','none');
							                        jQuery('#success').css('display','none');
							                        jQuery('#popup-contact-owner').css('opacity','1');
							                    });
							                },
							                error: function(data) {
							                    jQuery('#contact').fadeTo( "slow", 0, function() {
							                        jQuery('#error').fadeIn();
							                    });
							                }
							            });
							        }
							    });
							});
							</script>
	                        
	                        <?php } elseif($contact_state == 2) { ?>

								<?php $contact_form = $redux_demo['contact-owner-contact-form-7']; echo do_shortcode($contact_form); ?>

							<?php } elseif($contact_state == 3) { ?>

								<?php $contact_form = $redux_demo['contact-owner-gravity-forms']; echo do_shortcode("[gravityform title=false id=".$contact_form." ajax=true]"); ?>

							<?php } elseif($contact_state == 4) { ?>
	                        
								<?php $contact_form = $redux_demo['contact-owner-ninja-forms']; echo do_shortcode($contact_form); ?>

							<?php } ?>

						</div>
					
					</div>

				</div>

			</div>

			<div id="close-login" class="close-login"></div>

			<script type="text/javascript">

				jQuery(function($) {

					document.getElementById('close-login').addEventListener('click', function(e) {
												
						jQuery('#popup-contact-owner').css('display','none');

					});

					document.getElementById('close-popup-login').addEventListener('click', function(e) {
												
						jQuery('#popup-contact-owner').css('display','none');

					});

				});
			</script>

		</div>

		<?php

			$event_header_slider = esc_attr(get_post_meta($post->ID, 'event_header_slider',true));

			if($event_header_slider == "Map") { 

				$event_address_latitude = get_post_meta($post->ID, 'event_address_latitude', true);
				$event_address_longitude = get_post_meta($post->ID, 'event_address_longitude', true);

				if(!empty($event_address_latitude) AND $event_address_latitude != 0) {

		?>

		<!--===============================-->
		<!--== Big Map Header =============-->
		<!--===============================-->
		<div id="big-maps-holder">

			<div class="maps-buttons">
				<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
				<span class="streetview-switcher" data-rel="tooltip" rel="top" title="<?php _e( "Streetview", "themesdojo" ); ?>"><i class="fa fa-street-view"></i></span>
				<?php } ?>
				<span class="map-switcher" data-rel="tooltip" rel="top" title="<?php _e( "Map", "themesdojo" ); ?>"><i class="fa fa-map-marker"></i></span>

				<script type="text/javascript">

					jQuery(function($) {

						jQuery(document).on("click",".map-switcher",function(e){

							jQuery("#item-big-map-streetview").css('z-index', '9');
							jQuery("#item-big-map").css('z-index', '99');

							e.preventDefault();
							return false;

						});

						jQuery(document).on("click",".streetview-switcher",function(e){

							jQuery("#item-big-map-streetview").css('z-index', '99');
							jQuery("#item-big-map").css('z-index', '9');

							e.preventDefault();
							return false;

						});

					});

				</script>

			</div>

			<div id="item-big-map"></div>
			<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
			<div id="item-big-map-streetview"></div>
			<?php } ?>

		</div>

			<script type="text/javascript">
													
				var mapDiv,
					map,
					infobox;

				jQuery(document).ready(function($) {

					var fenway = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>);

					mapDiv = $("#item-big-map");
					mapDiv.height(550).gmap3({
					map: {
						options: {
							"center": [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>]
							,"zoom": 16
							,"draggable": true
							,"mapTypeControl": true
							,"mapTypeId": google.maps.MapTypeId.ROADMAP
							,"scrollwheel": false
							,"panControl": true
							,"rotateControl": false
							,"scaleControl": true
							,"streetViewControl": true
							,"zoomControl": true
							<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>,"styles": <?php echo $map_style; ?> <?php } ?>
						}
					}
					,marker: {
						values: [

							<?php

								$iconPath = get_template_directory_uri() .'/images/icon-services.png';

							?>

							{
								<?php get_template_part( 'inc/BFI_Thumb' ); ?>
								<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "single-post-thumbnail" ); ?>

								latLng: [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>],
								options: {
									icon: "<?php echo esc_url($iconPath); ?>",
									shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
								}
							}	
																	
						],
							options:{
								draggable: false
							}
						}
					});

					map = mapDiv.gmap3("get");

					infobox = new InfoBox({
						pixelOffset: new google.maps.Size(-50, -65),
						closeBoxURL: '',
						enableEventPropagation: true
					});
					mapDiv.delegate('.infoBox .close','click',function () {
						infobox.close();
					});

					if (Modernizr.touch){
						map.setOptions({ draggable : false });
						var draggableClass = 'inactive';
						var draggableTitle = "Activate map";
						var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
						draggableButton.click(function () {
							if($(this).hasClass('active')){
								$(this).removeClass('active').addClass('inactive').text("Activate map");
								map.setOptions({ draggable : false });
							} else {
								$(this).removeClass('inactive').addClass('active').text("Deactivate map");
								map.setOptions({ draggable : true });
							}
						});
					}

				});

			</script>

			<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
			<script type="text/javascript">
													
				var mapDiv,
					map,
					infobox;

				jQuery(document).ready(function($) {

					var fenway = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>);

					mapDiv = $("#item-big-map-streetview");
					mapDiv.height(550).gmap3({
					map: {
						options: {
							"center": [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>]
							,"zoom": 16
							,"draggable": true
							,"mapTypeControl": true
							,"mapTypeId": google.maps.MapTypeId.ROADMAP
							,"scrollwheel": false
							,"panControl": true
							,"rotateControl": false
							,"scaleControl": true
							,"streetViewControl": true
							,"zoomControl": true
							<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>,"styles": <?php echo $map_style; ?> <?php } ?>
						}
					}
					,streetviewpanorama:{
						options: {
							container: mapDiv,
							opts:{
								position: [parseFloat(<?php echo esc_attr($event_address_latitude); ?>),parseFloat(<?php echo esc_attr($event_address_longitude); ?>)],
								pov: {
									heading: parseFloat("0"),
									pitch: parseFloat("0"),
									zoom: parseInt("0")
								},
								scrollwheel : false,
								enableCloseButton : true
							}
						}
					}
					,marker: {
						values: [

							<?php

								$iconPath = get_template_directory_uri() .'/images/icon-services.png';

							?>

							{
								<?php get_template_part( 'inc/BFI_Thumb' ); ?>
								<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "single-post-thumbnail" ); ?>

								latLng: [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>],
								options: {
									icon: "<?php echo esc_url($iconPath); ?>",
									shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
								}
							}	
																	
						],
							options:{
								draggable: false
							}
						}
					});

					map = mapDiv.gmap3("get");

					infobox = new InfoBox({
						pixelOffset: new google.maps.Size(-50, -65),
						closeBoxURL: '',
						enableEventPropagation: true
					});
					mapDiv.delegate('.infoBox .close','click',function () {
						infobox.close();
					});

					if (Modernizr.touch){
						map.setOptions({ draggable : false });
						var draggableClass = 'inactive';
						var draggableTitle = "Activate map";
						var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
						draggableButton.click(function () {
							if($(this).hasClass('active')){
								$(this).removeClass('active').addClass('inactive').text("Activate map");
								map.setOptions({ draggable : false });
							} else {
								$(this).removeClass('inactive').addClass('active').text("Deactivate map");
								map.setOptions({ draggable : true });
							}
						});
					}

				});

			</script>
			<?php } ?>

			<?php } ?>

		<?php } else { ?>

		<!--===============================-->
		<!--== Page Title =================-->
		<!--===============================-->
		<div id="page-title">

			<div class="content page-title-container">

				<div class="container box">

					<div class="row item-title-flex">

						<div class="col-sm-8">

							<?php themesdojo_breadcrumb(); ?>

							<div data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="item-title-block">

								<h1 class="page-title"><?php the_title(); ?></h1>

								<?php $event_start_date = get_post_meta($post->ID, 'event_start_date', true); $event_start_time = get_post_meta($post->ID, 'event_start_time', true); $event_location = get_post_meta($post->ID, 'event_location', true); if(!empty($event_location)) { ?>

									<span class="item-tagline"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($event_start_date); ?> <?php echo esc_attr($event_start_time); ?></span>

								<?php  } ?>

							</div>

							<div data-0="opacity:1;margin-left:0px;" data-290="opacity:0;margin-left:30px;" class="item-author-content">

								<span class="author-meta-image">

									<?php 

										$authorID = get_the_author_meta('ID');

										$author_avatar_url = get_user_meta($authorID, "user_meta_image", true);

										get_template_part( 'inc/BFI_Thumb' );
										$params = array( 'width' => 30, 'height' => 30, 'crop' => true );

										if(!empty($author_avatar_url)) { ?>

                                		<img class="author-avatar" src="<?php echo bfi_thumb( $author_avatar_url, $params ); ?>" alt="" />  

                                	<?php } else { ?>

										<img class="author-avatar" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/avatar.png" alt="" />

                                	<?php } ?>  
                                	                                   
                                </span>

                                <span class="author-name">
									<?php the_author_posts_link(); ?>
								</span>

								<?php

									// Social
									$author_facebook_url = get_user_meta($authorID, "user_meta_facebook", true);
									$author_googleplus_url = get_user_meta($authorID, "user_meta_googleplus", true);
									$author_twitter_url = get_user_meta($authorID, "user_meta_twitter", true);
									$author_dribbble_url = get_user_meta($authorID, "user_meta_dribbble", true);

								?>

								<ul id="author-social-links" class="item-social-links">

									<?php if(!empty($author_facebook_url)) { ?>
										<li class="item-social-facebook">
											<a rel="external" href="<?php echo esc_url($author_facebook_url); ?>"><i class="fa fa-facebook"></i></a>
										</li>
									<?php } ?>

									<?php if(!empty($author_googleplus_url)) { ?>
										<li class="item-social-googleplus">
											<a rel="external" href="<?php echo esc_url($author_googleplus_url); ?>"><i class="fa fa-google-plus"></i></a>
										</li>
									<?php } ?>

									<?php if(!empty($author_twitter_url)) { ?>
										<li class="item-social-twitter">
											<a rel="external" href="<?php echo esc_url($author_twitter_url); ?>"><i class="fa fa-twitter"></i></a>
										</li>
									<?php } ?>

									<?php if(!empty($author_dribbble_url)) { ?>
										<li class="item-social-dribbble">
											<a rel="external" href="<?php echo esc_url($author_dribbble_url); ?>"><i class="fa fa-dribbble"></i></a>
										</li>
									<?php } ?>

								</ul>

							</div>

						</div>

						<div class="col-sm-4 item-title-metadata" data-0="opacity:1;" data-450="opacity:0;">

							<span class="item-title-metadata-add-favorites">
								<?php
								    get_template_part( 'partials/part-add-favorites' );
								?>
							</span>

							<span class="item-title-metadata-views">
								<span><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span><i class="fa fa-eye"></i>
							</span>

							<span class="item-title-metadata-share">

								<span class="item-title-metadata-share-content">

									<span><?php _e( 'Share', 'themesdojo' ); ?></span><i class="fa fa-share-alt"></i>

									<ul class="share-links">

										<li class="service-links-facebook-share">
											<div id="fb-root"></div>
											<script>(function(d, s, id) {
												var js, fjs = d.getElementsByTagName(s)[0];
												if (d.getElementById(id)) return;
												js = d.createElement(s); js.id = id;
												js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=247363645312964";
												fjs.parentNode.insertBefore(js, fjs);
												}(document, 'script', 'facebook-jssdk'));</script>
											<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div>
										</li>

										<li class="service-links-twitter-widget ">
											<iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.1384205748.html#_=1384949268081&amp;count=horizontal&amp;counturl=<?php the_permalink(); ?>&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=<?php the_permalink(); ?>&amp;size=m&amp;text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="twitter-share-button service-links-twitter-widget twitter-tweet-button twitter-count-horizontal" title="Twitter Tweet Button" data-twttr-rendered="true" style="width: 80px; height: 20px;"></iframe>
										</li>  

										<li class="service-links-google-plus-one">
											<!-- Place this tag where you want the share button to render. -->
											<div class="g-plus" data-action="share" data-annotation="bubble"></div>

											<!-- Place this tag after the last share tag. -->
											<script type="text/javascript">
												(function() {
													var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
													po.src = 'https://apis.google.com/js/platform.js';
													var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
												})();
											</script>
										</li>

									</ul>

								</span>

							</span>

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

					<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/title-bg.jpg" alt="" />

				<?php } ?>

			</div>

		</div>

		<?php } ?>

		<!--===============================-->
		<!--== Main Section ===============-->
		<!--===============================-->
		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<?php

					if($event_header_slider == "Map") {

				?>

				<!--===============================-->
				<!--== Page Title =================-->
				<!--===============================-->
				<div id="page-title" class="page-title-content">

					<div class="content page-title-container">

							<div class="row item-title-flex">

								<div class="col-sm-8">

									<?php themesdojo_breadcrumb(); ?>

									<div class="item-title-block">

										<h1 class="page-title"><?php the_title(); ?></h1>

										<?php $event_start_date = get_post_meta($post->ID, 'event_start_date', true); $event_start_time = get_post_meta($post->ID, 'event_start_time', true); $event_location = get_post_meta($post->ID, 'event_location', true); if(!empty($event_location)) { ?>

											<span class="item-tagline"><?php echo esc_attr($event_location); ?> - <?php echo esc_attr($event_start_date); ?> <?php echo esc_attr($event_start_time); ?></span>

										<?php  } ?>

									</div>

									<div class="item-author-content">

										<span class="author-meta-image">
											<?php 

												$authorID = get_the_author_meta('ID');

												$author_avatar_url = get_user_meta($authorID, "user_meta_image", true);

												get_template_part( 'inc/BFI_Thumb' );
												$params = array( 'width' => 30, 'height' => 30, 'crop' => true );

												if(!empty($author_avatar_url)) { ?>

		                                		<img class="author-avatar" src="<?php echo bfi_thumb( $author_avatar_url, $params ); ?>" alt="" />  

		                                	<?php } else { ?>

												<img class="author-avatar" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/avatar.png" alt="" />

		                                	<?php } ?>                                     
		                                </span>

		                                <span class="author-name">
											<?php the_author_posts_link(); ?>
										</span>

										<?php

											// Social
											$author_facebook_url = get_user_meta($authorID, "user_meta_facebook", true);
											$author_googleplus_url = get_user_meta($authorID, "user_meta_googleplus", true);
											$author_twitter_url = get_user_meta($authorID, "user_meta_twitter", true);
											$author_dribbble_url = get_user_meta($authorID, "user_meta_dribbble", true);

										?>

										<ul id="author-social-links" class="item-social-links">

											<?php if(!empty($author_facebook_url)) { ?>
												<li class="item-social-facebook">
													<a rel="external" href="<?php echo esc_url($author_facebook_url); ?>"><i class="fa fa-facebook"></i></a>
												</li>
											<?php } ?>

											<?php if(!empty($author_googleplus_url)) { ?>
												<li class="item-social-googleplus">
													<a rel="external" href="<?php echo esc_url($author_googleplus_url); ?>"><i class="fa fa-google-plus"></i></a>
												</li>
											<?php } ?>

											<?php if(!empty($author_twitter_url)) { ?>
												<li class="item-social-twitter">
													<a rel="external" href="<?php echo esc_url($author_twitter_url); ?>"><i class="fa fa-twitter"></i></a>
												</li>
											<?php } ?>

											<?php if(!empty($author_dribbble_url)) { ?>
												<li class="item-social-dribbble">
													<a rel="external" href="<?php echo esc_url($author_dribbble_url); ?>"><i class="fa fa-dribbble"></i></a>
												</li>
											<?php } ?>

										</ul>

									</div>

								</div>

								<div class="col-sm-4 item-title-metadata" >

									<span class="item-title-metadata-add-favorites">
										<?php
								        	get_template_part( 'partials/part-add-favorites' );
								    	?>
							    	</span>

									<span class="item-title-metadata-views">
										<span><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span><i class="fa fa-eye"></i>
									</span>

									<span class="item-title-metadata-share">

										<span class="item-title-metadata-share-content">

											<span><?php _e( 'Share', 'themesdojo' ); ?></span><i class="fa fa-share-alt"></i>

											<ul class="share-links">

												<li class="service-links-facebook-share">
													<div id="fb-root"></div>
													<script>(function(d, s, id) {
														var js, fjs = d.getElementsByTagName(s)[0];
														if (d.getElementById(id)) return;
														js = d.createElement(s); js.id = id;
														js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=247363645312964";
														fjs.parentNode.insertBefore(js, fjs);
														}(document, 'script', 'facebook-jssdk'));</script>
													<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div>
												</li>

												<li class="service-links-twitter-widget ">
													<iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.1384205748.html#_=1384949268081&amp;count=horizontal&amp;counturl=<?php the_permalink(); ?>&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=<?php the_permalink(); ?>&amp;size=m&amp;text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="twitter-share-button service-links-twitter-widget twitter-tweet-button twitter-count-horizontal" title="Twitter Tweet Button" data-twttr-rendered="true" style="width: 80px; height: 20px;"></iframe>
												</li>  

												<li class="service-links-google-plus-one">
													<!-- Place this tag where you want the share button to render. -->
													<div class="g-plus" data-action="share" data-annotation="bubble"></div>

													<!-- Place this tag after the last share tag. -->
													<script type="text/javascript">
														(function() {
															var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
															po.src = 'https://apis.google.com/js/platform.js';
															var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
														})();
													</script>
												</li>

											</ul>

										</span>

									</span>

								</div>

							</div>

					</div>

				</div>

				<?php } ?>

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-8">

						<div <?php post_class(); ?>>

							<div class="row">

								<div class="col-sm-12">

									<div class="item-block-title">

										<i class="fa fa-clock-o"></i><h4><?php _e( 'Event Starts In', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<div id="flipclock-script" class="clock"></div>

										<?php

					                        /* add javascript */
					                        wp_enqueue_script( 'td-flipclock' );
					                                                                
					                    ?>

										<script type="text/javascript">

											<?php $enddate = get_post_meta($post->ID, 'event_start_date_number', true); ?>

											jQuery(function($) {

												var enddate = <?php echo esc_attr($enddate); ?>; 
												var y = new Date();
												var x = y.getTimezoneOffset();
												var ts = Date.parse(y); 
												var tsFinal = (ts / 1000) - x * 60;
												var diff = enddate - tsFinal;

												if(enddate >= tsFinal) {

													var clock = jQuery('.clock').FlipClock(diff, {
														clockFace: 'DailyCounter',
														countdown: true
													});

												} else {

													jQuery("#event-started-state").html("<h4><?php _e( 'Event started.', 'themesdojo' ); ?></h4>");

												}

											});
										</script>

										<div id="event-started-state"></div>

									</div>

								</div>

								<?php $event_desc = get_the_content(); if($event_desc != '') { ?>

								<div class="col-sm-12">

									<div class="item-block-title">

										<i class="fa fa-file-text-o"></i><h4><?php _e( 'Event Details', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<?php echo the_content(); ?>

									</div>

								</div>

								<?php } ?>

								<div class="col-sm-12">

									<div class="item-block-title">

										<i class="fa fa-envelope-o"></i><h4><?php _e( 'Address & Reservation', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<div class="row">

											<div class="col-sm-6">

												<?php

													// Address & Contact Details
													$event_address_country = get_post_meta($post->ID, 'event_address_country', true);
													$event_address_state = get_post_meta($post->ID, 'event_address_state', true);
													$event_address_city = get_post_meta($post->ID, 'event_address_city', true);
													$event_address_address = get_post_meta($post->ID, 'event_address_address', true);
													$event_address_zip = get_post_meta($post->ID, 'event_address_zip', true);

												?>

												<span class="item-address-block">

													<i class="fa fa-map-marker" style="margin-top: 14px;"></i>

													<span class="item-address">

														<?php $event_location = get_post_meta($post->ID, 'event_location', true); if(!empty($event_location)) { ?>

															<h5><?php echo esc_attr($event_location); ?></h5>

														<?php } ?>

														<p>
															<?php if(!empty($event_address_address) ) { echo esc_attr($event_address_address); echo ", "; } ?> <?php if(!empty($event_address_zip)) { echo esc_attr($event_address_zip); } ?><br />
															<?php if(!empty($event_address_city)) { echo esc_attr($event_address_city); echo ", "; } ?> <?php if(!empty($event_address_state)) { echo esc_attr($event_address_state); } ?><br />
															<?php if(!empty($event_address_country)) { echo esc_attr($event_address_country); ?><br /><?php } ?>
														</p>

													</span>

												</span>

											</div>

											<div class="col-sm-6">

												<?php

													// Address & Contact Details
													$event_phone = get_post_meta($post->ID, 'event_phone', true);
													$event_email = get_post_meta($post->ID, 'event_email', true);
													$event_website = get_post_meta($post->ID, 'event_website', true);

												?>

												<?php if(!empty($event_phone)) { ?>

												<span class="item-address-block">

													<i class="fa fa-phone"></i>

													<span class="item-address">

														<p><?php echo esc_attr($event_phone); ?></p>

													</span>

												</span>

												<?php } ?>

												<?php if(!empty($event_website)) { ?>

												<span class="item-address-block">

													<i class="fa fa-link"></i>

													<span class="item-address">

														<p><a rel="external" href="<?php echo esc_url($event_website); ?>" ><?php echo esc_url($event_website); ?></a></p>

													</span>

												</span>

												<?php } ?>

												<span id="contact-owner" class="td-buttom"><i class="fa fa-paper-plane"></i><?php _e( 'Contact For Reservation', 'themesdojo' ); ?></span>

												<script type="text/javascript">

														jQuery(function($) {

															document.getElementById('contact-owner').addEventListener('click', function(e) {
																			
																$.fn.OpenContactOwner();

																e.preventDefault();

															});

															$.fn.OpenContactOwner = function() {

																jQuery('#popup-contact-owner').css('display', 'block');

															}

														});

												</script>

											</div>

										</div>

									</div>

								</div>

								<?php

									$event_address_latitude = get_post_meta($post->ID, 'event_address_latitude', true);
									$event_address_longitude = get_post_meta($post->ID, 'event_address_longitude', true);

									if(!empty($event_address_latitude) AND $event_address_latitude != 0) {

								?>

								<div class="col-sm-12">

									<div class="item-block-content nopadding">

										<div id="maps-holder">

											<div class="maps-buttons">
												<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
												<span class="streetview-switcher" data-rel="tooltip" rel="top" title="<?php _e( "Streetview", "themesdojo" ); ?>"><i class="fa fa-street-view"></i></span>
												<?php } ?>
												<span class="map-switcher" data-rel="tooltip" rel="top" title="<?php _e( "Map", "themesdojo" ); ?>"><i class="fa fa-map-marker"></i></span>

												<script type="text/javascript">

													jQuery(function($) {

														jQuery(document).on("click",".map-switcher",function(e){

													     	jQuery("#item-small-map-streetview").css('z-index', '9');
													     	jQuery("#item-small-map").css('z-index', '99');

													     	e.preventDefault();
															return false;

														});

														jQuery(document).on("click",".streetview-switcher",function(e){

													     	jQuery("#item-small-map-streetview").css('z-index', '99');
													     	jQuery("#item-small-map").css('z-index', '9');

													     	e.preventDefault();
															return false;

														});

													});

												</script>

											</div>

											<div id="item-small-map"></div>
											<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
											<div id="item-small-map-streetview"></div>
											<?php } ?>

										</div>

										<script type="text/javascript">
													var mapDiv,
														map,
														infobox;
													jQuery(document).ready(function($) {

														var fenway = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>);

														mapDiv = $("#item-small-map");
														mapDiv.height(400).gmap3({
															map: {
																options: {
																	"center": [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>]
																	,"zoom": 16
																	,"draggable": true
																	,"mapTypeControl": true
																	,"mapTypeId": google.maps.MapTypeId.ROADMAP
																	,"scrollwheel": false
																	,"panControl": true
																	,"rotateControl": false
																	,"scaleControl": true
																	,"streetViewControl": true
																	,"zoomControl": true
																	<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>,"styles": <?php echo $map_style; ?> <?php } ?>
																}
															}
															,marker: {
																values: [

																<?php

																	$iconPath = get_template_directory_uri() .'/images/icon-services.png';

																?>

																{
																	<?php get_template_part( 'inc/BFI_Thumb' ); ?>
																	<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "single-post-thumbnail" ); ?>

																	latLng: [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>],
																	options: {
																		icon: "<?php echo esc_url($iconPath); ?>",
																		shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
																	}
																}	
																	
																],
																options:{
																	draggable: false
																}
															}
														});

														map = mapDiv.gmap3("get");

													    infobox = new InfoBox({
													    	pixelOffset: new google.maps.Size(-50, -65),
													    	closeBoxURL: '',
													    	enableEventPropagation: true
													    });
													    mapDiv.delegate('.infoBox .close','click',function () {
													    	infobox.close();
													    });

													    if (Modernizr.touch){
													    	map.setOptions({ draggable : false });
													        var draggableClass = 'inactive';
													        var draggableTitle = "Activate map";
													        var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
													        draggableButton.click(function () {
													        	if($(this).hasClass('active')){
													        		$(this).removeClass('active').addClass('inactive').text("Activate map");
													        		map.setOptions({ draggable : false });
													        	} else {
													        		$(this).removeClass('inactive').addClass('active').text("Deactivate map");
													        		map.setOptions({ draggable : true });
													        	}
													        });
													    }

													});
										</script>

										<?php $event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true); if(!empty($event_address_streetview)) { ?>
										<script type="text/javascript">
													var mapDiv,
														map,
														infobox;
													jQuery(document).ready(function($) {

														var fenway = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>);

														mapDiv = $("#item-small-map-streetview");
														mapDiv.height(400).gmap3({
															map: {
																options: {
																	"center": [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>]
																	,"zoom": 16
																	,"draggable": true
																	,"mapTypeControl": true
																	,"mapTypeId": google.maps.MapTypeId.ROADMAP
																	,"scrollwheel": false
																	,"panControl": true
																	,"rotateControl": false
																	,"scaleControl": true
																	,"streetViewControl": true
																	,"zoomControl": true
																	<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>,"styles": <?php echo $map_style; ?> <?php } ?>
																}
															}
															,streetviewpanorama:{
																options: {
																	container: mapDiv,
																	opts:{
																		position: [parseFloat(<?php echo esc_attr($event_address_latitude); ?>),parseFloat(<?php echo esc_attr($event_address_longitude); ?>)],
																		pov: {
																			heading: parseFloat("0"),
																			pitch: parseFloat("0"),
																			zoom: parseInt("0")
																		},
																		scrollwheel : false,
																		enableCloseButton : true
																	}
																}
															}
															,marker: {
																values: [

																<?php

																	$iconPath = get_template_directory_uri() .'/images/icon-services.png';

																?>

																{
																	<?php get_template_part( 'inc/BFI_Thumb' ); ?>
																	<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "single-post-thumbnail" ); ?>

																	latLng: [<?php echo esc_attr($event_address_latitude); ?>,<?php echo esc_attr($event_address_longitude); ?>],
																	options: {
																		icon: "<?php echo esc_url($iconPath); ?>",
																		shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
																	}
																}	
																	
																],
																options:{
																	draggable: false
																}
															}
														});

														map = mapDiv.gmap3("get");

													    infobox = new InfoBox({
													    	pixelOffset: new google.maps.Size(-50, -65),
													    	closeBoxURL: '',
													    	enableEventPropagation: true
													    });
													    mapDiv.delegate('.infoBox .close','click',function () {
													    	infobox.close();
													    });

													    if (Modernizr.touch){
													    	map.setOptions({ draggable : false });
													        var draggableClass = 'inactive';
													        var draggableTitle = "Activate map";
													        var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
													        draggableButton.click(function () {
													        	if($(this).hasClass('active')){
													        		$(this).removeClass('active').addClass('inactive').text("Activate map");
													        		map.setOptions({ draggable : false });
													        	} else {
													        		$(this).removeClass('inactive').addClass('active').text("Deactivate map");
													        		map.setOptions({ draggable : true });
													        	}
													        });
													    }

													});
										</script>
										<?php } ?>

									</div>

								</div>

								<?php } ?>

								<?php $tags = wp_get_object_terms($post->ID, 'event_tag'); if(!empty($tags)) { ?>

								<div class="col-sm-12">

									<div class="item-block-title">

										<i class="fa fa-check-square"></i><h4><?php _e( 'Tags', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<div class="row">

											<?php

												foreach ( (array) $tags as $tag ) {

													$tag_link = get_term_link( $tag );

													echo '<div class="col-sm-6 amenities-item"><i class="fa fa-check"></i><a href="' . $tag_link . '">' . $tag->name . '</a></div>';

												}

											?>

										</div>

									</div>

								</div>

								<?php } ?>

							</div>

						</div>

						<?php

				        	global $redux_demo; 
							$full_width_banner = $redux_demo['ads-event-full-width'];

							if(!empty($full_width_banner)) {

						?>

						<div class="post" style="padding: 10px;">

							<?php echo $full_width_banner; ?>

						</div>

						<?php } ?>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

						<?php endwhile; ?>

					</div>

					<div class="col-sm-4">

						<?php

				        	global $redux_demo; 
							$sidebar_banner = $redux_demo['ads-event-sidebar'];

							if(!empty($sidebar_banner)) {

						?>

						<div class="clearfix widget-container" style="padding: 30px;">

							<?php echo $sidebar_banner; ?>

						</div>

						<?php } ?>

						<?php get_sidebar('event'); ?>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>