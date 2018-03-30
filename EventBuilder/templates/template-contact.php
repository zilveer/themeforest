<?php
/**
 * Template name: Contact Us
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

global $redux_demo, $td_contact_test_error; 

$contact_email = esc_attr($redux_demo['contact-email']);
$td_contact_thankyou = esc_attr($redux_demo['contact-thankyou-message']);

$td_contact_latitude = esc_attr($redux_demo['contact-latitude']);
$td_contact_longitude = esc_attr($redux_demo['contact-longitude']);
$td_contact_zoomLevel = esc_attr($redux_demo['contact-zoom']);

$map_pin = esc_attr($redux_demo['map-pin']['url']);

$redux_default_img_bg = esc_attr($redux_demo['title-image-bg']['url']);

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

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div id="big-map">

							<div id="main-map"></div>

							<div id="big-map-holder">

								<script type="text/javascript">
								var mapDiv,
									map,
									infobox;
								jQuery(document).ready(function($) {

									mapDiv = $("#main-map");
									mapDiv.height(400).gmap3({
										map: {
											options: {
												"center": [<?php echo esc_attr($td_contact_latitude); ?>,<?php echo esc_attr($td_contact_longitude); ?>]
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

												if(empty($map_pin)) {

													$map_pin = get_template_directory_uri() .'/images/icon-property.png';

												} 

											?>

											{

												latLng: [<?php echo esc_attr($td_contact_latitude); ?>,<?php echo esc_attr($td_contact_longitude); ?>],
												options: {
													icon: "<?php echo esc_url($map_pin); ?>",
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

								});

								</script>

							</div>

						</div>

					</div>


					<div class="col-sm-4">

						<?php get_sidebar('page'); ?>

					</div>

					<div class="col-sm-8">

						<div class="post">

							<div class="row">

								<div class="col-sm-12">

									<span class="post-excerpt">
										
										<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
										<?php the_content(); ?>
																					
										<?php endwhile; endif; ?> 

									</span>

								</div>

								<form id="contact" type="post" action="" > 

									<div class="col-sm-12">

										<div class="single-title contact-error">

											<h4><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h4>

										</div>

										<div class="single-title contact-success">

											<h4><?php echo esc_attr($td_contact_thankyou); ?></h4>

										</div>

									</div>

									<div class="col-sm-6">

										<input name="name" id="name" type="text" placeholder="<?php _e( 'Your Name', 'themesdojo' ); ?>" required>

									</div>

									<div class="col-sm-6">

										<input name="email" id="email" type="text" placeholder="<?php _e( 'Your Email', 'themesdojo' ); ?>" required>

									</div>

									<div class="col-sm-12">

										<input name="subject" id="subject" type="text" placeholder="<?php _e( 'Subject', 'themesdojo' ); ?>" required>

									</div>

									<div class="col-sm-12">

										<div class="row">

											<div class="col-sm-12">

												<textarea name="message" id="message" cols="8" rows="8" placeholder="<?php _e( 'Type your message here ...', 'themesdojo' ); ?>" required></textarea>

											</div>

										</div>

										<div class="row">

											<div class="col-sm-6">

												<p style="margin: 12px 0;"><?php _e("Human test. Please input the result of 5+3=?", "themesdojo"); ?></p>

										    </div>

										    <div class="col-sm-6">

										    	<div class="row">

											    	<div class="col-sm-4">

											    		<input type="text" onfocus="if(this.value=='')this.value='';" onblur="if(this.value=='')this.value='';" name="answer" id="humanTest" value="" class="input-textarea" />

											    	</div>

											    	<div class="col-sm-8">

													    <input type="text" name="receiverEmail" id="receiverEmail" value="<?php echo esc_attr($contact_email); ?>" class="input-textarea" style="display: none;"/>

														<input type="hidden" name="action" value="ContactForm" />
														<?php wp_nonce_field( 'ContactForm_html', 'ContactForm_nonce' ); ?>

														<span id="contact-agent-button" class="td-buttom">

															<i class="fa fa-paper-plane"></i><?php _e("Get in Touch", "themesdojo"); ?>

														</span>	 

														<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

													</div>

												</div>

											</div>

										</div>

									</div>

								</form>

								<script type="text/javascript">

									jQuery(function($) {

										document.getElementById('contact-agent-button').addEventListener('click', function(e) {

											if(jQuery("#contact").valid()) {

												jQuery('.td-buttom').css('display', 'none');
												jQuery('.submit-loading').css('display', 'inline-block');
												
												jQuery("#contact").submit();

											} 

											e.preventDefault();
										});

										jQuery('#contact').validate({
										        rules: {
										            name: {
										                required: true
										            },
										            email: {
										                required: true,
										                email: true
										            },
										            subject: {
										                required: true
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
										            subject: {
										                required: "<?php _e( 'We need a subject here.', 'themesdojo' ); ?>"
										            },
										            message: {
										                required: "<?php _e( 'You have to write something to send this form.', 'themesdojo' ); ?>"
										            },
										            answer: {
										                required: "<?php _e( 'Sorry, wrong answer!', 'themesdojo' ); ?>"
										            }
										        },
										        submitHandler: function(form) {
										        	jQuery('.td-buttom').css('display', 'none');
													jQuery('.submit-loading').css('display', 'inline-block');
										            jQuery(form).ajaxSubmit({
										            	type: "POST",
												        data: jQuery(form).serialize(),
												        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
										                success: function(data) {
										                   	jQuery('.td-buttom').css('display', 'inline-block');
															jQuery('.submit-loading').css('display', 'none');
															jQuery('.contact-success').css('display', 'inline-block');
										                },
										                error: function(data) {
										                    jQuery('.contact-error').css('display', 'inline-block');
										                }
										            });
										        }
										    });

									});

								</script>

							</div>

						</div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>