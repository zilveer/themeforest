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

							<i class="fa fa-envelope-o"></i><h4><?php _e( 'Contact For More Details', 'themesdojo' ); ?></h4>

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

		<!--===============================-->
		<!--== Page Title =================-->
		<!--===============================-->
		<div id="page-title" class="event-page-title">

			<div class="content page-title-container">

				<div class="container box">

					<div class="row item-title-flex">

						<div class="col-sm-4 item-title-metadata">

							<div class="event-header-container">

								<div class="event-header-block" data-0="margin-bottom:-217px;" data-140="margin-bottom:0px">

									<h1 class="event-page-title"><?php the_title(); ?></h1>

									<?php

										// Address & Contact Details
										$event_address_country = get_post_meta($post->ID, 'event_address_country', true);
										$event_address_city = get_post_meta($post->ID, 'event_address_city', true);

									?>

									<span class="event-page-subtitle"><i class="fa fa-map-marker"></i><?php echo esc_attr($event_address_city); ?>, <?php echo esc_attr($event_address_country); ?></span>

									<?php 

										$event_start_date = get_post_meta($post->ID, 'event_start_date', true); 
										$event_start_time = get_post_meta($post->ID, 'event_start_time', true); 

										$event_end_date = get_post_meta($post->ID, 'event_end_date', true); 
										$event_end_time = get_post_meta($post->ID, 'event_end_time', true);

									?>

									<div class="row">

										<div class="col-sm-6 col-xs-6">

											<span class="event-page-subtitle-alt"><?php _e( 'Starts:', 'themesdojo' ); ?></span>

											<span class="event-page-subtitle-alt-o"><i class="fa fa-calendar-o" style="margin-right: 0;"></i></span>

											<?php

												global $redux_demo; 
												if(isset($redux_demo['events-date-format'])) {
													$time_format = $redux_demo['events-date-format'];
													if($time_format == 1) {

												?>

												<span class="event-page-subtitle-alt"><?php $start_unix_time = strtotime($event_start_date); echo $start_time = date("m/d/Y",$start_unix_time); ?></span>

												<?php } elseif($time_format == 2) { ?>

												<span class="event-page-subtitle-alt"><?php $start_unix_time = strtotime($event_start_date); echo $start_time = date("d/m/Y",$start_unix_time); ?></span>

												<?php } } else { ?>

												<span class="event-page-subtitle-alt"><?php $start_unix_time = strtotime($event_start_date); echo $start_time = date("m/d/Y",$start_unix_time); ?></span>

											<?php } ?>

											<span class="event-page-subtitle-alt-o"><i class="fa fa-clock-o" style="margin-right: 0;"></i></span>

											<?php

												global $redux_demo; 
												$time_format = $redux_demo['events-time-format'];
												if($time_format == 1 OR !isset($time_format)) {

											?>

											<span class="event-page-subtitle-alt"><?php echo esc_attr($event_start_time); ?></span>

											<?php } else { ?>

											<span class="event-page-subtitle-alt"><?php echo date("H:i", strtotime($event_start_time)); ?></span>

											<?php } ?>

										</div>

										<div class="col-sm-6 col-xs-6">

											<span class="event-page-subtitle-alt"><?php _e( 'Ends:', 'themesdojo' ); ?></span>

											<span class="event-page-subtitle-alt-o"><i class="fa fa-calendar-o" style="margin-right: 0;"></i></span>

											<?php

												global $redux_demo; 
												if(isset($redux_demo['events-date-format'])) {
													$time_format = $redux_demo['events-date-format'];
													if($time_format == 1) {

												?>

												<span class="event-page-subtitle-alt"><?php $end_unix_time = strtotime($event_end_date); echo $end_time = date("m/d/Y",$end_unix_time); ?></span>

												<?php } elseif($time_format == 2) { ?>

												<span class="event-page-subtitle-alt"><?php $end_unix_time = strtotime($event_end_date); echo $end_time = date("d/m/Y",$end_unix_time); ?></span>

												<?php } } else { ?>

												<span class="event-page-subtitle-alt"><?php $end_unix_time = strtotime($event_end_date); echo $end_time = date("m/d/Y",$end_unix_time); ?></span>

											<?php } ?>

											<span class="event-page-subtitle-alt-o"><i class="fa fa-clock-o" style="margin-right: 0;"></i></span>

											<?php

												global $redux_demo; 
												$time_format = $redux_demo['events-time-format'];
												if($time_format == 1 OR !isset($time_format)) {

											?>

											<span class="event-page-subtitle-alt"><?php echo esc_attr($event_end_time); ?></span>

											<?php } else { ?>

											<span class="event-page-subtitle-alt"><?php echo date("H:i", strtotime($event_end_time)); ?></span>

											<?php } ?>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<?php if(has_post_thumbnail()) { ?>

				<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

				<div class="page-title-bg" style="background-image: url(<?php echo esc_url($image_src[0]); ?>); background-position: 50% 50%;"></div>

			<?php } elseif(!empty($redux_default_img_bg)) { ?>

				<div class="page-title-bg" style="background-image: url(<?php echo esc_url($redux_default_img_bg); ?>); background-position: 50% 50%;"></div>

			<?php } else { ?>

				<div class="page-title-bg" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/images/title-bg.jpg); background-position: 50% 50%;"></div>

			<?php } ?>

		</div>

		<!--===============================-->
		<!--== Main Section ===============-->
		<!--===============================-->
		<div id="main-wrapper" class="content grey-bg single-event-page">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="row">

							<div class="col-sm-8">

								<div class="row">

									<div class="col-sm-6 alignright">

										<div class="event-counter">

											<?php 

											    $currentDate = strtotime("now");

												$finishdate = get_post_meta($post->ID, 'event_end_date_number', true);
												$enddate = get_post_meta($post->ID, 'event_start_date_number', true);
												$month = date("m",$enddate);
												$year = date("Y",$enddate);
												$day = date("d",$enddate);
												$hour = date("H",$enddate); 
												$minute = date("i",$enddate); 

												if($currentDate < $enddate) {

											?>

											<script type="text/javascript">

												document.write("<h2 id='pageinval44' > </h2>");function countdown_load35(){var the_event="";var on_event="";var yr=<?php echo $year; ?>;var mo=<?php echo $month; ?>;var da=<?php echo $day; ?>;var hr=<?php echo $hour; ?>;var min=<?php echo $minute; ?>;var sec=0;var month='';var month=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");var bottom_event="";var now_d=new Date();var now_year=now_d.getYear();if (now_year < 1000)now_year+=1900;var now_month=now_d.getMonth();var now_day=now_d.getDate();var now_hour=now_d.getHours();var now_min=now_d.getMinutes();var now_sec=now_d.getSeconds();var now_val=month[now_month]+" "+now_day+", "+now_year+" "+now_hour+":"+now_min+":"+now_sec;event_val=month[mo-1]+" "+da+", "+yr+" "+hr+":"+min+":"+sec;difference=Date.parse(event_val)-Date.parse(now_val);differenceday=Math.floor(difference/(60*60*1000*24)*1);differencehour=Math.floor((difference%(60*60*1000*24))/(60*60*1000)*1);differencemin=Math.floor(((difference%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);differencesec=Math.floor((((difference%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);if(document.getElementById('pageinval44')){if(differenceday<=0&&differencehour<=0&&differencemin<=0&&differencesec<=1&&now_day==da){document.getElementById('pageinval44').innerHTML=on_event;} else {document.getElementById('pageinval44').innerHTML=the_event+ "<span>" +differenceday+" <span> days </span> </span> "+" <span> "+differencehour+"  <span> hours </span> </span>  "+  "<span>" + differencemin+"  <span> minutes </span> </span>  "+ "<span class='seconds'>"  + differencesec+"  <span> seconds </span> </span>  "+bottom_event;} }setTimeout("countdown_load35()",1000);}countdown_load35();

											</script>

											<?php } elseif($currentDate > $enddate AND $currentDate < $finishdate) { ?>

											<h2 id="pageinval44"><?php _e( 'Event Started', 'themesdojo' ); ?></h2>

											<?php } else { ?>

											<h2 id="pageinval44"><?php _e( 'Event Ended', 'themesdojo' ); ?></h2>

											<?php } ?>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="row">

											<div class="col-sm-6 col-xs-6">

												<span class="item-title-metadata-add-favorites">
													<?php
													    get_template_part( 'partials/part-add-favorites' );
													?>
												</span>

											</div>

											<div class="col-sm-6 col-xs-6 single-event-header-block">

												<?php

							                        global $wpdb, $all_reviews_media;
							                        $post_id = get_the_ID();
							                        $table_name = "td_reviews";

							                        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

							                          	$all_reviews_old = $wpdb->get_var( "SELECT COUNT(*) FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

							                          	if(!empty($all_reviews_old) && $all_reviews_old != 0) {

								                            $all_reviews_media_old = $wpdb->get_results( "SELECT * FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

								                            $review_media_total_old = 0;

								                            foreach ($all_reviews_media_old as $key) {

								                              	$review_media_old = $key->listing_review_values_med;

								                              	$review_media_total_old = $review_media_total_old + $review_media_old;

								                           	}

								                           	$post_reviews_status = get_post_meta($post_id, 'listing_review_status', true);

								                           	if(empty($post_reviews_status) && $post_reviews_status != 'updated') {

								                           		update_post_meta($post_id, 'listing_review_status', 'updated');
								                           		update_post_meta($post_id, 'listing_reviews', $all_reviews_media_old);

								                           	}

							                          	}

							                        }

							                        $all_reviews = array();
							                        $all_reviews = get_post_meta($post_id, 'listing_reviews', true);

							                        $all_reviews_num = 0;

							                        if(!empty($all_reviews)) {

								                        $review_media_total = 0;

								                        foreach ($all_reviews as $key) {

								                        	$all_reviews_num++;

								                            $review_media = $key->listing_review_values_med;

								                            $review_media_total = $review_media_total + $review_media;

								                        }

							                           	$review_overall = $review_media_total/$all_reviews_num;

							                        }

							                    ?>

							                    <div class="listing-container-rating">

							                        <?php if(!empty($all_reviews) && $all_reviews != 0) { ?>

							                        <?php

							                                $overview_stars_value = ($review_overall / 5) * 100;
							                                echo td_rating_func($overview_stars_value);    

							                        ?>

							                            <span><?php $rounded = round($review_overall, 1); echo esc_attr($rounded); ?> <?php _e( 'Stars Rated', 'themesdojo' ); ?></span>

							                            <?php } else { ?>

							                            <i class="fa fa-star-o"></i>

							                            <span><?php _e( 'No Ratings Yet', 'themesdojo' ); ?></span>

							                        <?php } ?>

							                    </div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<div class="col-sm-4">

								<div class="row">

									<div class="col-sm-6 col-xs-6">

										<span class="event-views"><i class="fa fa-eye"></i><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?> <?php _e( 'Views', 'themesdojo' ); ?></span>

									</div>

									<div class="col-sm-6 col-xs-6">

										<span class="item-title-metadata-share-content upcoming-event-share">

											<span><i class="fa fa-share-alt"></i><?php _e( 'Share', 'themesdojo' ); ?></span>

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

									</div>

								</div>

							</div>

						</div>

					</div>

					<?php 

						$td_slot_id = get_post_meta($post->ID, 'item_package_id',true); 
						$package_allow_gallery = get_post_meta($td_slot_id, 'package_allow_gallery', true); 
						if(!empty($package_allow_gallery)) { 

					?>

					<?php
													
						$attachments = get_children(array('post_parent' => $post->ID,
														'post_status' => 'inherit',
														'post_type' => 'attachment',
														'post_mime_type' => 'image',
														'order' => 'DESC',
														'orderby' => 'menu_order ID'));

						if(!empty($attachments)) {

					?>

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-camera-retro"></i><h4><?php _e( 'Photo Gallery', 'themesdojo' ); ?></h4>

						</div>

						<div class="item-block-content item-image-gallery-block">

							<div class="row">

								<div id="carousel" class="owl-carousel">

			                        <?php 

			                            get_template_part( 'inc/BFI_Thumb' );
										$params = array( 'width' => 500, 'height' => 400, 'crop' => true ); 

										foreach($attachments as $att_id => $attachment) {
											$full_img_url = wp_get_attachment_url($attachment->ID);
											$split_pos = strpos($full_img_url, 'wp-content');
											$split_len = (strlen($full_img_url) - $split_pos);
											$abs_img_url = substr($full_img_url, $split_pos, $split_len);
											$full_info = @getimagesize(ABSPATH.$abs_img_url);

			                            ?>

			                        <div class="item">
			                        	<a class="gallery-fancybox" href="<?php echo esc_url($full_img_url); ?>" rel="prettyPhoto[pp_gal]">
			                        		<img src="<?php echo esc_url(bfi_thumb( $full_img_url, $params )); ?>" alt="<?php echo esc_attr($attachment->post_title); ?>">
			                        	</a>
			                        </div>

			                        <?php } ?>

			                    </div>
			                    <div class="owl-carousel-navigation">
			                        <a class="owl-btn prev fa fa-angle-left"></a>
			                        <a class="owl-btn next fa fa-angle-right"></a>
			                    </div>

							</div>

						</div>

					</div>

					<?php } } ?>

					<?php $event_desc = get_the_content(); ?>

					<div class="col-sm-12">

						<div class="item-block-title" style="text-align: left;">

							<i class="fa fa-file-text-o"></i><h4><?php _e( 'Event Details & Reservation', 'themesdojo' ); ?></h4>

							<!-- AddThisEvent -->
							<script type="text/javascript" src="https://addthisevent.com/libs/1.6.0/ate.min.js"></script>

							<?php 

									$event_start_date = get_post_meta($post->ID, 'event_start_date', true); 
									$event_start_time = get_post_meta($post->ID, 'event_start_time', true); 

									$event_end_date = get_post_meta($post->ID, 'event_end_date', true); 
									$event_end_time = get_post_meta($post->ID, 'event_end_time', true);

									$event_location = get_post_meta($post->ID, 'event_location', true);

									$event_email = get_post_meta($post->ID, 'event_email', true);

									$my_post = get_post( $id );
				      				$this_post_id =  $my_post->post_author;
									$user_info = get_userdata($this_post_id);
									$user_name = $user_info->user_nicename; 

								?>

							<div title="Add to Calendar" class="addthisevent" style="float: right; margin-top: 3px;">
								Add to Calendar
								<span class="start"><?php echo esc_attr($event_start_date); echo " "; echo esc_attr($event_start_time); ?></span>
								<span class="end"><?php echo esc_attr($event_end_date); echo " "; echo esc_attr($event_end_time); ?></span>
								<span class="timezone">Europe/Paris</span>
								<span class="title"><?php the_title(); ?></span>
								<span class="location"><?php echo esc_attr($event_location); ?></span>
								<span class="organizer"><?php echo $user_name; ?></span>
								<span class="organizer_email"><?php echo esc_attr($event_email); ?></span>
								<span class="all_day_event">false</span>
								<span class="date_format">MM/DD/YYYY</span>
							</div>

						</div>

						<div class="item-block-content">

							<div class="row">

								<?php

									$item_ticket_tailor = get_post_meta($post->ID, 'item_ticket_tailor', true);

									if(empty($item_ticket_tailor)) {

								?>

								<div class="col-sm-6">

									<div class="full">

										<?php echo the_content(); ?>

									</div>

								</div>

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

										<span class="full">

											<i class="fa fa-building"></i>

											<span class="item-address">

												<?php

													$postID = get_the_ID();

													$terms = get_the_terms($postID, 'event_place' );
													if ($terms && ! is_wp_error($terms)) :
														$term_slugs_arr = array();
														foreach ($terms as $term) {
															$term_id_arr = $term->term_id;
															$term_id_slug = $term->name;
															$parent      = $term->parent;
															$tag_link = get_term_link( $term );
														}
													endif;

												    $cat_id = $term_id_arr;
												    $cat_name = $term_id_slug;

													if($parent == 0) {

														$tag = $cat_name;
														$tag_id = $cat_id;

													} else {

														$term_id = $cat_id; //Get ID of current term
														$ancestors = get_ancestors( $term_id, 'event_place' ); // Get a list of ancestors
														$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
														$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
														$term = get_term( $top_term_id, 'event_place' ); //Get the term
														$tag = $term->name;
														$tag_id = $term->term_id;
														$tag_link = get_term_link( $term );

													}

												?>

												<a href="<?php echo esc_url($tag_link); ?>"><?php echo($tag); ?></a>

											</span>

										</span>

										<span class="full">

											<i class="fa fa-map-marker"></i>

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

									</span>

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

									<?php

										// Social
										$item_facebook = get_post_meta($post->ID, 'item_facebook', true);
										$item_foursquare = get_post_meta($post->ID, 'item_foursquare', true);
										$item_skype = get_post_meta($post->ID, 'item_skype', true);
										$item_googleplus = get_post_meta($post->ID, 'item_googleplus', true);
										$item_twitter = get_post_meta($post->ID, 'item_twitter', true);
										$item_dribbble = get_post_meta($post->ID, 'item_dribbble', true);
										$item_behance = get_post_meta($post->ID, 'item_behance', true);
										$item_linkedin = get_post_meta($post->ID, 'item_linkedin', true);
										$item_pinterest = get_post_meta($post->ID, 'item_pinterest', true);
										$item_tumblr = get_post_meta($post->ID, 'item_tumblr', true);
										$item_youtube = get_post_meta($post->ID, 'item_youtube', true);
										$item_delicious = get_post_meta($post->ID, 'item_delicious', true);
										$item_medium = get_post_meta($post->ID, 'item_medium', true);
										$item_soundcloud = get_post_meta($post->ID, 'item_soundcloud', true);

									?>

									<ul class="item-social-links">

										<?php if(!empty($item_facebook)) { ?>
											<li class="item-social-facebook">
												<a rel="external" href="<?php echo esc_url($item_facebook); ?>"><i class="fa fa-facebook"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_foursquare)) { ?>
											<li class="item-social-foursquare">
												<a rel="external" href="<?php echo esc_url($item_foursquare); ?>"><i class="fa fa-foursquare"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_skype)) { ?>
											<li class="item-social-skype">
												<a rel="external" href="<?php echo esc_url($item_skype); ?>"><i class="fa fa-skype"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_googleplus)) { ?>
											<li class="item-social-googleplus">
												<a rel="external" href="<?php echo esc_url($item_googleplus); ?>"><i class="fa fa-google-plus"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_twitter)) { ?>
											<li class="item-social-twitter">
												<a rel="external" href="<?php echo esc_url($item_twitter); ?>"><i class="fa fa-twitter"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_dribbble)) { ?>
											<li class="item-social-dribbble">
												<a rel="external" href="<?php echo esc_url($item_dribbble); ?>"><i class="fa fa-dribbble"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_behance)) { ?>
											<li class="item-social-behance">
												<a rel="external" href="<?php echo esc_url($item_behance); ?>"><i class="fa fa-behance"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_linkedin)) { ?>
											<li class="item-social-linkedin">
												<a rel="external" href="<?php echo esc_url($item_linkedin); ?>"><i class="fa fa-linkedin"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_pinterest)) { ?>
											<li class="item-social-pinterest">
												<a rel="external" href="<?php echo esc_url($item_pinterest); ?>"><i class="fa fa-pinterest"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_tumblr)) { ?>
											<li class="item-social-tumblr">
												<a rel="external" href="<?php echo esc_url($item_tumblr); ?>"><i class="fa fa-tumblr"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_youtube)) { ?>
											<li class="item-social-youtube">
												<a rel="external" href="<?php echo esc_url($item_youtube); ?>"><i class="fa fa-youtube"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_delicious)) { ?>
											<li class="item-social-delicious">
												<a rel="external" href="<?php echo esc_url($item_delicious); ?>"><i class="fa fa-delicious"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_medium)) { ?>
											<li class="item-social-medium">
												<a rel="external" href="<?php echo esc_url($item_medium); ?>"><i class="fa fa-medium"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_soundcloud)) { ?>
											<li class="item-social-soundcloud">
												<a rel="external" href="<?php echo esc_url($item_soundcloud); ?>"><i class="fa fa-soundcloud"></i></a>
											</li>
										<?php } ?>

									</ul>

									<span id="contact-owner" class="td-buttom"><i class="fa fa-paper-plane"></i><?php _e( 'Contact For More Details', 'themesdojo' ); ?></span>

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

								<?php } else { ?>

								<div class="col-sm-6">

									<div class="full">

										<?php echo the_content(); ?>

									</div>

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

									<?php

										// Social
										$item_facebook = get_post_meta($post->ID, 'item_facebook', true);
										$item_foursquare = get_post_meta($post->ID, 'item_foursquare', true);
										$item_skype = get_post_meta($post->ID, 'item_skype', true);
										$item_googleplus = get_post_meta($post->ID, 'item_googleplus', true);
										$item_twitter = get_post_meta($post->ID, 'item_twitter', true);
										$item_dribbble = get_post_meta($post->ID, 'item_dribbble', true);
										$item_behance = get_post_meta($post->ID, 'item_behance', true);
										$item_linkedin = get_post_meta($post->ID, 'item_linkedin', true);
										$item_pinterest = get_post_meta($post->ID, 'item_pinterest', true);
										$item_tumblr = get_post_meta($post->ID, 'item_tumblr', true);
										$item_youtube = get_post_meta($post->ID, 'item_youtube', true);
										$item_delicious = get_post_meta($post->ID, 'item_delicious', true);
										$item_medium = get_post_meta($post->ID, 'item_medium', true);
										$item_soundcloud = get_post_meta($post->ID, 'item_soundcloud', true);

									?>

									<ul class="item-social-links">

										<?php if(!empty($item_facebook)) { ?>
											<li class="item-social-facebook">
												<a rel="external" href="<?php echo esc_url($item_facebook); ?>"><i class="fa fa-facebook"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_foursquare)) { ?>
											<li class="item-social-foursquare">
												<a rel="external" href="<?php echo esc_url($item_foursquare); ?>"><i class="fa fa-foursquare"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_skype)) { ?>
											<li class="item-social-skype">
												<a rel="external" href="<?php echo esc_url($item_skype); ?>"><i class="fa fa-skype"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_googleplus)) { ?>
											<li class="item-social-googleplus">
												<a rel="external" href="<?php echo esc_url($item_googleplus); ?>"><i class="fa fa-google-plus"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_twitter)) { ?>
											<li class="item-social-twitter">
												<a rel="external" href="<?php echo esc_url($item_twitter); ?>"><i class="fa fa-twitter"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_dribbble)) { ?>
											<li class="item-social-dribbble">
												<a rel="external" href="<?php echo esc_url($item_dribbble); ?>"><i class="fa fa-dribbble"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_behance)) { ?>
											<li class="item-social-behance">
												<a rel="external" href="<?php echo esc_url($item_behance); ?>"><i class="fa fa-behance"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_linkedin)) { ?>
											<li class="item-social-linkedin">
												<a rel="external" href="<?php echo esc_url($item_linkedin); ?>"><i class="fa fa-linkedin"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_pinterest)) { ?>
											<li class="item-social-pinterest">
												<a rel="external" href="<?php echo esc_url($item_pinterest); ?>"><i class="fa fa-pinterest"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_tumblr)) { ?>
											<li class="item-social-tumblr">
												<a rel="external" href="<?php echo esc_url($item_tumblr); ?>"><i class="fa fa-tumblr"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_youtube)) { ?>
											<li class="item-social-youtube">
												<a rel="external" href="<?php echo esc_url($item_youtube); ?>"><i class="fa fa-youtube"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_delicious)) { ?>
											<li class="item-social-delicious">
												<a rel="external" href="<?php echo esc_url($item_delicious); ?>"><i class="fa fa-delicious"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_medium)) { ?>
											<li class="item-social-medium">
												<a rel="external" href="<?php echo esc_url($item_medium); ?>"><i class="fa fa-medium"></i></a>
											</li>
										<?php } ?>

										<?php if(!empty($item_soundcloud)) { ?>
											<li class="item-social-soundcloud">
												<a rel="external" href="<?php echo esc_url($item_soundcloud); ?>"><i class="fa fa-soundcloud"></i></a>
											</li>
										<?php } ?>

									</ul>

									<span id="contact-owner" class="td-buttom"><i class="fa fa-paper-plane"></i><?php _e( 'Contact For More Details', 'themesdojo' ); ?></span>

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

								<div class="col-sm-6">

									<?php

										$item_ticket_tailor = get_post_meta($post->ID, 'item_ticket_tailor', true);

										if(!empty($item_ticket_tailor)) {

											echo do_shortcode($item_ticket_tailor);

										}

									?>

								</div>

								<?php } ?>

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

					<?php 

						$item_crowd = get_post_meta($post->ID, 'item_crowd', true); 
						$item_involvement = get_post_meta($post->ID, 'item_involvement', true);
						$item_preparation = get_post_meta($post->ID, 'item_preparation', true);
						$item_transformation = get_post_meta($post->ID, 'item_transformation', true);
						if( !empty($item_crowd) OR !empty($item_involvement) OR !empty($item_preparation) OR !empty($item_transformation) ) { 

					?>

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-bar-chart"></i><h4><?php _e( 'Event Stats', 'themesdojo' ); ?></h4>

						</div>

						<div class="item-block-content">

							<div class="row">

								<div class="col-sm-6">

									<div class="row">

										<div class="col-sm-12" style="margin-bottom: 20px;">

											<div class="row">

												<div class="col-sm-4">

													<span class="event-stats-label"><?php _e( 'Crowd', 'themesdojo' ); ?></span>

												</div>

												<div class="col-sm-8">

													<div class="event-stats">
														
														<div class="event-stats-percent" style="width: <?php echo $item_crowd; ?>% !important;"></div>

													</div>

												</div>

											</div>

										</div>

										<div class="col-sm-12">

											<div class="row">

												<div class="col-sm-4">

													<span class="event-stats-label"><?php _e( 'Involvement', 'themesdojo' ); ?></span>

												</div>

												<div class="col-sm-8">

													<div class="event-stats">
														
														<div class="event-stats-percent" style="width: <?php echo $item_involvement; ?>% !important;"></div>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

								<div class="col-sm-6">

									<div class="row">

										<div class="col-sm-12" style="margin-bottom: 20px;">

											<div class="row">

												<div class="col-sm-4">

													<span class="event-stats-label"><?php _e( 'Preparation', 'themesdojo' ); ?></span>

												</div>

												<div class="col-sm-8">

													<div class="event-stats">
														
														<div class="event-stats-percent" style="width: <?php echo $item_preparation; ?>% !important;"></div>

													</div>

												</div>

											</div>

										</div>

										<div class="col-sm-12">

											<div class="row">

												<div class="col-sm-4">

													<span class="event-stats-label"><?php _e( 'Transformation', 'themesdojo' ); ?></span>

												</div>

												<div class="col-sm-8">

													<div class="event-stats">
														
														<div class="event-stats-percent" style="width: <?php echo $item_transformation; ?>% !important;"></div>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

					<?php } ?>

					<?php $item_video = get_post_meta($post->ID, 'event_video', true); if(!empty($item_video)) { ?>

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-file-video-o"></i><h4><?php _e( 'Video Presentation', 'themesdojo' ); ?></h4>

						</div>

						<div class="item-block-content video-content">

							<?php echo $item_video; ?>

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

										echo '<div class="col-sm-6 amenities-item tag-filter-item"><i class="fa fa-check"></i><a href="' . $tag_link . '">' . $tag->name . '</a></div>';

									}

								?>

							</div>

						</div>

					</div>

					<?php } ?>

					<div class="col-sm-12">

						<div class="row">

							<?php

								$current_post = $post->ID;

								$td_slot_id = get_post_meta($current_post, 'item_package_id',true);

								$package_allow_ratings = get_post_meta($td_slot_id, 'package_allow_ratings', true);

								if(!empty($package_allow_ratings)) { ?>

								<?php

									global $wpdb, $all_reviews_media, $all_reviews_num, $all_reviews;
									$post_id = $post->ID;

									$all_reviews_num = 0;

									$all_reviews = array();
							        $all_reviews = get_post_meta($post_id, 'listing_reviews', true);

									if(!empty($all_reviews)) {

										$review_media_total = 0;

										foreach ($all_reviews as $key) {

											$all_reviews_num++;

											$review_media = $key->listing_review_values_med;

											$review_media_total = $review_media_total + $review_media;

										}

										$review_overall = $review_media_total/$all_reviews_num;

								?>

								<div class="col-sm-6">

									<div class="item-block-title">

										<i class="fa fa-star"></i><h4><?php _e( 'What Are People Saying', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<div class="row">

											<div class="col-sm-12" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating" title="<?php echo esc_attr($all_reviews_num); ?> <?php _e( 'Reviews', 'themesdojo' ); ?>">
												<span class="form-label" style="margin-top: 13px;"><?php _e( 'Overall rating from', 'themesdojo' ); ?> <span ><?php echo esc_attr($all_reviews_num); ?></span> <?php _e( 'reviewers', 'themesdojo' ); ?>.</span>
												<span class="form-label aright">
													<span class="overall-number" itemprop="ratingValue"><?php echo esc_attr($rounded = round($review_overall, 1)); ?></span>
													<span style="display: none;" itemprop="reviewCount"><?php echo esc_attr($all_reviews); ?></span>
													<?php

									                    $overview_stars_value = ($review_overall / 5) * 100;
									                    echo td_rating_func($overview_stars_value);		

									                ?> 
									            </span>
											</div>

										</div>

										<div class="row">
											
											<div class="col-sm-12">

												<?php

							                        /* add javascript */
							                        wp_enqueue_script( 'td-flexslider' );
							                                                                
							                    ?>

						                        <script type='text/javascript'>
						                            jQuery(function() {
						                                jQuery('.flexslider').flexslider( {
						                                    slideshowSpeed: 4200,   
						                                    animationSpeed: 500, 
						                                });
						                            });
						                        </script>

												<div id="reviews-flexslider" class="flexslider">

													<ul class="slides">

														<?php 

															foreach ($all_reviews as $key) {

																$review_med     = $key->listing_review_values_med;
																$review_content = $key->listing_review_comment;
																$user_name      = $key->user_name;
																$review_names   = $key->listing_review_names;
																$review_values  = $key->listing_review_values;

														?>

															<li>

																<div class="full" itemprop="review" itemscope="itemscope" itemtype="http://schema.org/Review">

																	<div class="row" itemprop="reviewBody">
												
																		<div class="col-sm-12">

																			<div class="review-main-content-holder">

																				<div class="row">
												
																					<div class="col-sm-6">

																						<span class="star-rating-nb">
																							<?php

																			                    $overview_stars_value = ($review_med / 5) * 100;
																			                    echo td_rating_func($overview_stars_value);		

																			                ?> 
																			            </span>

																					</div>

																					<div class="col-sm-6" itemprop="reviewRating" itemscope="itemscope" itemtype="http://schema.org/Rating">

																						<span class="star-rating-nb aright" itemprop="ratingValue">
																							<?php echo esc_attr($rounded = round($review_med, 1)); ?>
																						</span>
																						<meta itemprop="bestRating" content="5" />

																					</div>

																					<div class="col-sm-12">

																						<?php echo $review_content; ?>

																					</div>

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="row">
												
																		<div class="col-sm-3 review-item-author">

																			<span class="review-item-author-triangle"></span>
																			<span class="review-item-author-name" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span itemprop="name"><?php echo esc_attr($user_name); ?></span></span>

																		</div>

																		<div class="col-sm-9">

																			<div class="full">

																				<div class="review-item-author-title">

																				<?php

																					$array = explode(', ', $review_names); //split string into array seperated by ', '
																					foreach($array as $value)  {

																				?>

																					<span><?php echo esc_attr($value); ?></span>

																				<?php } ?>

																				</div>

																				<div class="review-item-author-value">

																				<?php

																					$array = explode(', ', $review_values); //split string into array seperated by ', '
																					foreach($array as $value)  {

																				?>

																					<span>
																					<?php

																			            $overview_stars_value = ($value / 5) * 100;
																			            echo td_rating_func($overview_stars_value);		

																			        ?>
																			        </span>

																				<?php } ?>

																				</div>

																			</div>

																		</div>

																	</div>

																</div>

															</li>

														<?php
															}
														?>
													</ul>

												</div>

											</div>

										</div>

									</div>

								</div>

								<?php } else { ?>

								<div class="col-sm-6">

									<div class="item-block-title">

										<i class="fa fa-star"></i><h4><?php _e( 'What Are People Saying', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<?php _e( 'No reviews, yet.', 'themesdojo' ); ?>

									</div>

								</div>

								<?php } } ?>

								<?php

								$current_post = $post->ID;

								$td_slot_id = get_post_meta($current_post, 'item_package_id',true);

								$package_allow_ratings = get_post_meta($td_slot_id, 'package_allow_ratings', true);

								if(!empty($package_allow_ratings)) { ?>

								<div class="col-sm-6">

									<div class="item-block-title">

										<i class="fa fa-star-o"></i><h4><?php _e( 'Submit Your Review', 'themesdojo' ); ?></h4>

									</div>

									<div class="item-block-content">

										<?php

											$post_id = $post->ID;

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
												$category_review_fields = isset( $tag_extra_fields[$tag]['category_review_fields'] ) ? esc_attr( $tag_extra_fields[$tag]['category_review_fields'] ) : '';

											} else {

												$term_id = $cat_id; //Get ID of current term
												$ancestors = get_ancestors( $term_id, 'event_cat' ); // Get a list of ancestors
												$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
												$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
												$term = get_term( $top_term_id, 'event_cat' ); //Get the term
												$tag = $term->term_id;

												$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
												$category_review_fields = isset( $tag_extra_fields[$tag]['category_review_fields'] ) ? esc_attr( $tag_extra_fields[$tag]['category_review_fields'] ) : '';

											}

											if(!empty($category_review_fields)) {

										?>

										<form id="submit-review" >

											<div id="submit-review-success" class="row" style="display: none;">
												<div class="col-sm-12">
													<h4><?php _e( 'Thank you for your review.', 'themesdojo' ); ?></h4>
												</div>
											</div>

											<div id="submit-review-error" class="row" style="display: none;">
												<div class="col-sm-12">
													<h4><?php _e( 'Something went wrong. Please reload and try again.', 'themesdojo' ); ?></h4>
												</div>
											</div>

											<div id="submit-review-holder" class="row">

												<div class="col-sm-12">

													<?php

														$num = -1;
														$array = explode(', ', $category_review_fields); //split string into array seperated by ', '
														foreach($array as $value)  {

															$num++;

													?>

															<div class="row">

																<div class="col-sm-4"><?php echo esc_attr($value); ?></div>

																<div class="col-sm-8">
																	<div id="review-<?php echo esc_attr($value); ?>" class="star-rating"> 
																	  	<span class="fa fa-star-o" data-rating="1"></span>
																	  	<span class="fa fa-star-o" data-rating="2"></span>
																	  	<span class="fa fa-star-o" data-rating="3"></span>
																	  	<span class="fa fa-star-o" data-rating="4"></span>
																	  	<span class="fa fa-star-o" data-rating="5"></span>
																	  	<input type="hidden" name="rating-names[<?php echo esc_attr($num); ?>]" class="" value="<?php echo esc_attr($value); ?>">
																	  	<input type="hidden" name="rating-values[<?php echo esc_attr($num); ?>]" class="rating-value" value="0">
																	  	<input type="hidden" name="rating-hover-value" class="hover-value" value="0">
																	</div>

																	<script type="text/javascript">
																		jQuery(document).ready(function () {

																	        var $star_rating = jQuery('#review-<?php echo esc_attr($value); ?>.star-rating .fa');

																	        var SetRatingStar = function() {
																	          	return $star_rating.each(function() {
																		            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt(jQuery(this).data('rating'))) {
																		              	return jQuery(this).removeClass('fa-star-o').addClass('fa-star');
																		            } else {
																		              	return jQuery(this).removeClass('fa-star').addClass('fa-star-o');
																		            }
																	          	});
																	        };

																	        var HoverRatingStar = function() {
																	          	return $star_rating.each(function() {
																		            if (parseInt($star_rating.siblings('input.hover-value').val()) >= parseInt(jQuery(this).data('rating'))) {
																		              	return jQuery(this).removeClass('fa-star-o').addClass('fa-star');
																		            } else {
																		              	return jQuery(this).removeClass('fa-star').addClass('fa-star-o');
																		            }
																	          	});
																	        };

																	        var HoverOutRatingStar = function() {
																	          	return $star_rating.each(function() {
																		            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt(jQuery(this).data('rating'))) {
																		              	return jQuery(this).removeClass('fa-star-o').addClass('fa-star');
																		            } else {
																		              	return jQuery(this).removeClass('fa-star').addClass('fa-star-o');
																		            }
																	          	});
																	        };

																	        $star_rating.on('click', function() {
																	          	$star_rating.siblings('input.rating-value').val(jQuery(this).data('rating'));
																	          	return SetRatingStar();
																	        });

																	        $star_rating.on('hover', function() {
																	          	$star_rating.siblings('input.hover-value').val(jQuery(this).data('rating'));
																	          	return HoverRatingStar();
																	        });

																	        $star_rating.on('mouseleave', function() {
																	          	return HoverOutRatingStar();
																	        });

																	        SetRatingStar();

																	    });
																	</script>

																</div>

															</div>

													<?php

														}

													?>

												</div>

												<div class="col-sm-12">

													<textarea cols="70" rows="4" id='rating-comment' name='rating-comment' placeholder="<?php _e( 'Type here your review', 'themesdojo' ); ?>" style="margin-top: 20px;"></textarea>

												</div>

												<div class="col-sm-3">

													<span class="form-label"><?php _e( 'Name', 'themesdojo' ); ?><span class="required">*</span></span>

												</div>

												<div class="col-sm-9">

													<input type="text" name="submit_review_name" id="submit_review_name" value="" class="input-textarea" placeholder="" />

												</div>

												<div class="col-sm-3">

													<span class="form-label"><?php _e( 'Email', 'themesdojo' ); ?><span class="required">*</span></span>

												</div>

												<div class="col-sm-9">

													<input type="text" name="submit_review_email" id="submit_review_email" value="" class="input-textarea" placeholder="" />

												</div>

												<div class="col-sm-12">

													<button id="reviewPublish" name="submit" type="submit" style="margin-bottom: 0;"><?php _e( 'Submit Review', 'themesdojo' ); ?></button>

													<span id="reviewPublishSpinner" class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

												</div>

											</div>

											<input type="hidden" name="rating-listing-id" value="<?php echo esc_attr($post_id = $post->ID); ?>">

											<input type="hidden" name="action" value="tdSubmitListingReviewForm" />
											<?php wp_nonce_field( 'tdSubmitListingReview_html', 'tdSubmitListingReview_nonce' ); ?>

										</form>

										<script type="text/javascript">

											jQuery(function($) {
												jQuery('#submit-review').validate({
													rules: {
													    submit_review_name: {
													        required: true,
													        minlength: 3
													    },
													    submit_review_email: {
													        required: true,
													        email: true
													    }
													},
													messages: {
														submit_review_name: {
														    required: "<?php _e( 'Please provide a name', 'themesdojo' ); ?>",
														    minlength: "<?php _e( 'Your name must be at least 3 characters long', 'themesdojo' ); ?>"
														},
														submit_review_email: {
														    required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
														    email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
														}
													},
													submitHandler: function(form) {
													    jQuery('#reviewPublish').css('display','none');
													    jQuery('#reviewPublishSpinner').css('display','inline-block');
													    jQuery(form).ajaxSubmit({
													        type: "POST",
															data: jQuery(form).serialize(),
															url: '<?php echo admin_url('admin-ajax.php'); ?>', 
													        success: function(data) {
													            jQuery('#submit-review-holder').css('display','none');
													            jQuery('#submit-review-success').css('display','inline-block');
													        },
													        error: function(data) {
													        	jQuery('#submit-review-error').css('display','inline-block');
													        	jQuery('#reviewPublish').css('display','inline-block');
													    		jQuery('#reviewPublishSpinner').css('display','none');
													        }
													    });
													}
												});
											});
										</script>

										<?php } ?>

									</div>

								</div>

							<?php } ?>

							<?php

								$postID = get_the_ID();

								$terms = get_the_terms($postID, 'event_cat' );
								if ($terms && ! is_wp_error($terms)) :
									$term_slugs_arr = array();
									foreach ($terms as $term) {
										$term_id_arr = $term->term_id;
										$term_id_slug = $term->slug;
										$parent      = $term->parent;
									}
								endif;

							    $cat_id = $term_id_arr;
							    $cat_name = $term_id_slug;

								if($parent == 0) {

									$tag = $cat_name;

								} else {

									$term_id = $cat_id; //Get ID of current term
									$ancestors = get_ancestors( $term_id, 'event_cat' ); // Get a list of ancestors
									$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
									$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
									$term = get_term( $top_term_id, 'event_cat' ); //Get the term
									$tag = $term->slug;

								}

								$custom_posts = new WP_Query();
								$custom_posts->query(array(
								    'post_type'      => 'event',
								    'posts_per_page' => '3',
								    'post_status'    => 'publish',
								    'meta_key'       => 'event_start_date_number',
									'orderby'        => 'meta_value',
									'order'          => 'ASC',
									'post__not_in'   => array($postID),
								    'event_cat'      => $tag,
								    'meta_query' => array(
								            array(
								                'key'     => 'event_status',
								                'value'   => 'upcoming',
								            ),
								        ),
								    )
								);

								if ( $custom_posts->have_posts() ) {

							?>
								<div class="col-sm-12">

									<div class="item-block-title widget-container widget_search">

										<h4><?php _e( 'Related by Category', 'themesdojo' ); ?></h4>

									</div>

									<div class="row">

										<?php while ($custom_posts->have_posts()) : $custom_posts->the_post(); ?>

										<div class="col-sm-4 id-<?php echo get_the_ID(); ?>">

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

										<?php endwhile;?>

										<?php wp_reset_postdata(); ?>

										</div>

									</div>

							<?php } ?>

							<?php

								$postID = get_the_ID();

								$terms = get_the_terms($postID, 'event_loc' );
								if ($terms && ! is_wp_error($terms)) :
									$term_slugs_arr = array();
									foreach ($terms as $term) {
										$term_id_arr = $term->slug;
										$parent      = $term->parent;
									}
								endif;

								$custom_posts2 = new WP_Query();
								$custom_posts2->query(array(
								    'post_type'      => 'event',
								    'posts_per_page' => '3',
								    'post_status'    => 'publish',
								    'meta_key'       => 'event_start_date_number',
									'orderby'        => 'meta_value',
									'order'          => 'ASC',
									'post__not_in'   => array($postID),
								    'event_loc'      => $term_id_arr,
								    'meta_query' => array(
								            array(
								                'key'     => 'event_status',
								                'value'   => 'upcoming',
								            ),
								        ),
								    )
								);

								if ( $custom_posts2->have_posts() ) {

							?>
								<div class="col-sm-12">

									<div class="item-block-title widget-container widget_search">

										<h4><?php _e( 'Related by Location', 'themesdojo' ); ?></h4>

									</div>

									<div class="row">

									<?php while ($custom_posts2->have_posts()) : $custom_posts2->the_post(); ?>

									<div class="col-sm-4 id-<?php echo get_the_ID(); ?>">

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

									<?php endwhile;?>

									<?php wp_reset_postdata(); ?>

									</div>

								</div>

							<?php } ?>

						</div>

					</div>

					<div class="col-sm-12">

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

						<?php endwhile; ?>

					</div>


				</section>
				<!--==========-->

<?php get_footer(); ?>