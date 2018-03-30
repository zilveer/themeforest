		
		<?php if ( isset( $_GET['charge'] ) OR isset( $_GET['charge_failed'] ) ) { ?>

		<!--===============================-->
		<!--== Payment Confirmation =======-->
		<!--===============================-->
		<div id="popup-td-payment-confirm">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-shopping-cart"></i><h4><?php _e( 'Payment Details', 'themesdojo' ); ?></h4>

							<span id="close-popup-payment-confirm" data-rel="tooltip" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></span>

						</div>

						<div class="item-popup-content">

							<?php 

								global $test_mode;

								sc_set_stripe_key( $test_mode );

								if ( isset( $_GET['charge'] ) && ! isset( $_GET['charge_failed'] ) ) {

									$charge_id = esc_html( $_GET['charge'] );

									// https://stripe.com/docs/api/php#charges
									$charge_response = \Stripe\Charge::retrieve( $charge_id );

							?>

							<div class="full" style="margin-bottom: 20px;"><h5><?php _e( 'Congratulations. Your payment went through!', 'themesdojo' ); ?></h5></div>

							<?php 

								if( ! empty( $charge_response->description ) ) { ?>

									<p><strong><?php _e( 'Here\'s what you bought:', 'themesdojo' ); ?></strong> <?php $chargesDesc = $charge_response->description; echo esc_attr($chargesDesc); ?></p> 

								<?php }

							if ( isset( $_GET['store_name'] ) && ! empty( $_GET['store_name'] ) ) { ?>

								<p><strong><?php _e( 'From:', 'themesdojo' ); ?></strong> <?php $chargesFrom = esc_html( $_GET['store_name'] ); echo esc_attr($chargesFrom); ?></p>

							<?php }

							?>

							<p><strong><?php _e( 'Total Paid:', 'themesdojo' ); ?></strong> <span style="text-transform: uppercase;"><?php $chargesAmmount = $charge_response->amount; $chargesCurrency = $charge_response->currency; echo esc_attr($chargesAmmount/100); echo esc_attr($chargesCurrency); ?></span> </p> 

							<p><strong><?php _e( 'Your transaction ID is:', 'themesdojo' ); ?></strong> <?php echo esc_attr($charge_id); ?> </p> 

							<?php

								} elseif ( isset( $_GET['charge_failed'] ) ) {
									// TODO Failed charge output.

									$charge_id = esc_html( $_GET['charge_failed'] );
							?>	

								<h5><?php _e( 'Sorry, but your card was declined and your payment was not processed.', 'themesdojo' ); ?></h5>
								<p><?php _e( 'Transaction ID:', 'themesdojo' ); ?> <?php echo esc_attr($charge_id); ?> </p> 

							<?php	} 

							?>

						</div>
					
					</div>

				</div>

			</div>

			<div id="close-td-payment-confirm" class="close-login"></div>

			<script type="text/javascript">

				jQuery(function($) {

					document.getElementById('close-popup-payment-confirm').addEventListener('click', function(e) {
												
						jQuery('#popup-td-payment-confirm').css('display','none');

					});

					document.getElementById('close-td-payment-confirm').addEventListener('click', function(e) {
												
						jQuery('#popup-td-payment-confirm').css('display','none');

					});

				});
			</script>

		</div>

		<?php } ?>

		<?php 
			if ( !is_user_logged_in() ) {
		?>	

		<!--===============================-->
		<!--== Login ======================-->
		<!--===============================-->
		<div id="popup-td-login">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<div class="item-block-title price-plan-header">

							<i class="fa fa-user"></i><h4><?php _e( 'Login', 'themesdojo' ); ?></h4>

							<span id="close-popup-td-login" data-rel="tooltip" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></span>

						</div>

						<div class="item-popup-content">

							<form id="tdlogin">

								<div class="row">

									<div class="col-sm-6" style="margin-bottom: 0;"> 
								  	
									  	<span class="form-label"><?php _e( 'Username:', 'themesdojo' ); ?></span>
										
										<input type="text" name="userNameLogin" id="userNameLogin" value="" class="input-textarea" placeholder="" />

									</div>

									<div class="col-sm-6" style="margin-bottom: 0;">

										<span class="form-label"><?php _e( 'Password:', 'themesdojo' ); ?></span>
										
										<input type="password" name="userPasswordLogin" id="userPasswordLogin" value="" class="input-textarea" placeholder="" />

									</div>

								</div>

								<div class="full" style="margin-bottom: 10px;">

									<input name="rememberme" type="checkbox" value="forever" style="float: left; width: auto !important; margin-top: 6px;"/><span style="margin-left: 10px; float: left; margin-bottom: 10px;"><?php _e( 'Remember me', 'themesdojo' ); ?></span>
									<a id="top-menu-reset" style="float: right;" class="" href="#"><?php _e( 'Forgot Password', 'themesdojo' ); ?></a>

									<script type="text/javascript">

										jQuery(function($) {

											document.getElementById('top-menu-reset').addEventListener('click', function(e) {
																					
												jQuery('#popup-td-login').css('display', 'none');
												jQuery('#popup-td-reset').css('display', 'block');

												e.preventDefault();

											});

										});

									</script>

								</div>
								
								<input type="hidden" name="action" value="tdLoginForm" />
								<?php wp_nonce_field( 'tdLogin_html', 'tdLogin_nonce' ); ?>

								<input style="margin-bottom: 0; width: 100%;" name="submit" type="submit" value="<?php _e( 'Login', 'themesdojo' ); ?>" class="input-submit">	 

								<span class="submit-loading" style="width: 100%; text-align: center;"><i class="fa fa-refresh fa-spin"></i></span>
							  	  
							</form>

							<div id="tdlogin-success">
								<span>
								   	<span class="form-label"><?php _e( 'Login successful.', 'themesdojo' ); ?></span>
								</span>
							</div>
								 
							<div id="tdlogin-error">
								<span>
								   	<span class="form-label"><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></span>
								</span>
							</div>

							<script type="text/javascript">

							jQuery(function($) {
								jQuery('#tdlogin').validate({
							        rules: {
							            userNameLogin: {
							                required: true,
							                minlength: 3
							            },
							            userPasswordLogin: {
							                required: true,
							                minlength: 1,
							            }
							        },
							        messages: {
								        userNameLogin: {
								            required: "<?php _e( 'Please provide a username', 'themesdojo' ); ?>",
								            minlength: "<?php _e( 'Your username must be at least 3 characters long', 'themesdojo' ); ?>"
								        },
								        userPasswordLogin: {
								            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
								            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
								        }
								    },
							        submitHandler: function(form) {
							        	jQuery('#tdlogin .input-submit').css('display','none');
							        	jQuery('#tdlogin .submit-loading').css('display','inline-block');
							            jQuery(form).ajaxSubmit({
							            	type: "POST",
									        data: jQuery(form).serialize(),
									        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
							                success: function(data) {
							                	if(data == 1) {
							                		jQuery("#userName").addClass("error");
							                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
							                		jQuery('.userNameError').css('display','inline-block');

							                		jQuery('#tdlogin .input-submit').css('display','inline-block');
							        				jQuery('#tdlogin .submit-loading').css('display','none');
							                	}

							                	if(data == 2) {
							                		jQuery("#userPassword").addClass("error");
							                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
							                		jQuery('.userPasswordError').css('display','block');

							                		jQuery('#tdlogin .input-submit').css('display','block');
							        				jQuery('#tdlogin .submit-loading').css('display','none');
							                	}

							                	if(data == 3) {
							                		jQuery("#userName").addClass("error");
							                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
							                		jQuery('.userNameError').css('display','block');

							                		jQuery("#userPassword").addClass("error");
							                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
							                		jQuery('.userPasswordError').css('display','block');

							                		jQuery('#tdlogin .input-submit').css('display','block');
							        				jQuery('#tdlogin .submit-loading').css('display','none');
							                	}

							                	if(data == 4) {
								                    jQuery('#tdlogin').css('display','none');
								                    jQuery(this).find('label').css('cursor','default');
								                    jQuery('#tdlogin-success').fadeIn();

	      											var delay = 5;
	      											setTimeout(function(){ window.location.reload(); }, delay); 
							                	}

							                	if(data == 5) {
							                		jQuery('#tdlogin').fadeTo( "slow", 0, function() {
								                        jQuery('#tdlogin-error').fadeIn();
								                    });
							                	}
							                },
							                error: function(data) {
							                    jQuery('#tdlogin').fadeTo( "slow", 0, function() {
							                        jQuery('#tdlogin-error').fadeIn();
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

			<div id="close-td-login" class="close-login"></div>

			<script type="text/javascript">

				jQuery(function($) {

					document.getElementById('close-popup-td-login').addEventListener('click', function(e) {
												
						jQuery('#popup-td-login').css('display','none');

					});

					document.getElementById('close-td-login').addEventListener('click', function(e) {
												
						jQuery('#popup-td-login').css('display','none');

					});

				});
			</script>

		</div>

		<?php } ?>

		<!--===============================-->
		<!--== Register ===================-->
		<!--===============================-->
		<div id="popup-td-register">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<div class="item-block-title price-plan-header">

							<i class="fa fa-user"></i><h4><?php _e( 'Register', 'themesdojo' ); ?></h4>

							<span id="close-popup-td-register" data-rel="tooltip" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></span>

						</div>

						<div class="item-popup-content">

							<?php if ( get_option( 'users_can_register' ) ) { ?>

							<?php 
								if ( !is_user_logged_in() ) {
							?>
							<form id="tdregister" >
							<?php } else { ?>
							<div id="tdregister" >
							<?php } ?>

							  	<div class="row">

							  		<?php 
										if ( !is_user_logged_in() ) {
									?>

								  	<div class="col-sm-12">

								  		<div class="row">
							  	
										  	<div class="col-sm-6">
												<span class="form-label"><?php _e( 'Username:', 'themesdojo' ); ?></span>
												<input type="text" name="userName" id="userName" value="" class="input-textarea" placeholder="" />
												<label for="userName" class="error userNameError"></label>
											</div>

											<div class="col-sm-6">
												<span class="form-label"><?php _e( 'Email:', 'themesdojo' ); ?></span>
												<input type="text" name="userEmail" id="userEmail" value="" class="input-textarea" placeholder="" />
												<label for="userEmail" class="error userEmailError"></label>
											</div>

										</div>

									</div>

									<div class="col-sm-12">

								  		<div class="row">

											<div class="col-sm-6">
												<span class="form-label"><?php _e( 'Password:', 'themesdojo' ); ?></span>
												<input type="password" name="userPassword" id="userPassword" value="" class="input-textarea" placeholder="" />
											</div>

											<div class="col-sm-6">
												<span class="form-label"><?php _e( 'Repeat Password:', 'themesdojo' ); ?></span>
												<input type="password" name="userConfirmPassword" id="userConfirmPassword" value="" class="input-textarea" placeholder="" />
											</div>

										</div>

									</div>

									<?php } ?>

									<!--===============================-->
									<!--== Select Packages ============-->
									<!--===============================-->
									<?php					

										$currentNum = 0;

										query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'ASC' ));

										if (have_posts()) : while (have_posts()) : the_post();

										$package_active = get_post_meta($post->ID, 'package_active', true);

										if(!empty($package_active)) {

											$currentNum++;

										}

										endwhile; endif;
										wp_reset_postdata();

										if($currentNum > 0) {
									?>

										<?php if ( !is_user_logged_in() ) { ?>
										<div class="col-sm-6">
										<?php } else { ?>
										<div class="col-sm-12">
										<?php } ?>

											<span class="form-label"><?php _e( 'Choose a plan:', 'themesdojo' ); ?></span>
											
											<select name="account_type" id="account_type" style="width: 100%; margin-bottom: 10px;">

												<?php					

													$currentNum = 0;

													query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'ASC' ));

													if (have_posts()) : while (have_posts()) : the_post();

													$package_active = get_post_meta($post->ID, 'package_active', true);

													if(!empty($package_active)) {

														$currentNum++;

														$postID = $post->ID;

														$package_price = get_post_meta($post->ID, 'package_price', true);

														global $redux_demo; 

														if($currentNum == 1 ){ ?>

															<script type="text/javascript">

																(function ($) {

																	$(document).ready(function () {

																		jQuery('#stripe-payment-package').val("<?php echo esc_attr($postID); ?>");
									    								jQuery('#paypal-payment-package').val("<?php echo esc_attr($postID); ?>");
									    								jQuery('#free-payment-package').val("<?php echo esc_attr($postID); ?>");
									    								jQuery('#payment-package-id').val("<?php echo esc_attr($postID); ?>");
									    								jQuery('#payment-package-title').val("<?php the_title(); ?>");
									    								jQuery('#payment-package-price').val("<?php echo esc_attr($package_price); ?>");

																	});

																})(jQuery);

															</script>

														<?php }

														$package_price = get_post_meta($post->ID, 'package_price', true);

														if(empty($package_price) or $package_price == 0) {
															$package_price = __( 'Free', 'themesdojo' );
															$currency_symbol = "";
														} else {
															$currency_symbol = $redux_demo['currency-symbol'];
														}

												?>

												<option value='<?php echo esc_attr($postID); ?>' autocomplete="off"><?php the_title(); ?> - <?php echo esc_attr($currency_symbol); echo esc_attr($package_price); ?></option>

												<?php

													}

													endwhile; endif;
													wp_reset_postdata();

												?>

											</select>
											
										</div>

										<?php					

											$currentNum = 0;

											query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'ASC' ));

											if (have_posts()) : while (have_posts()) : the_post();

											$package_active = get_post_meta($post->ID, 'package_active', true);

											if(!empty($package_active)) {

												$currentNum++;

												$postID = $post->ID;

												$package_price = get_post_meta($post->ID, 'package_price', true);

										?>

												<input type="hidden" id="package-title-<?php echo esc_attr($postID); ?>" name="payment-package-title" value="<?php the_title(); ?>">
												<input type="hidden" id="package-price-<?php echo esc_attr($postID); ?>" name="payment-package-price" value="<?php echo esc_attr($package_price); ?>">

										<?php

											}

											endwhile; endif;
											wp_reset_postdata();

										?>

									<?php } ?>
									<!--===============================-->
									<!--== End Select Packages ========-->
									<!--===============================-->

								</div>

								<!--===============================-->
								<!--== Terms & Conditions =========-->
								<!--===============================-->
								<?php
									global $redux_demo; 
									$price_plans_link = $redux_demo['page-url-price-plans'];
									if(!empty($price_plans_link)) {
								?>
								<div class="col-sm-12" style="text-align: center; margin-top: 20px; margin-bottom: 15px;">
										<a style="float: none; display: inline-block;" rel="external" href="<?php echo get_permalink( $price_plans_link ); ?>"><i class="fa fa-database"></i> <?php _e( 'Pricing Plans', 'themesdojo' ); ?></a>
								</div>
								<?php } ?>
								<script type="text/javascript">

									(function ($) {

										$(document).ready(function () {

											jQuery('#free-package-button').prop('disabled', false);
											jQuery('#stripe-package-button').prop('disabled', false);
											jQuery('#paypal-package-button').prop('disabled', false);

										});

									})(jQuery);

								</script>

								<?php
									global $redux_demo; 
									$terms_link = $redux_demo['page-url-terms'];
									if(!empty($terms_link)) {
								?>

								<div class="full" style="text-align: center; margin-bottom: 10px;">

									<span class="agree-terms">
										
										<input id="agree-terms" type="checkbox" name="agree-terms" autocomplete="off" >
										<a rel="external" class="" href="<?php echo get_permalink( $terms_link ); ?>"><i class="fa fa-file-text-o"></i> <?php _e( 'Agree to our Terms & Conditions', 'themesdojo' ); ?></a>

										<script type="text/javascript">

											(function ($) {

												$(document).ready(function () {

													jQuery('#free-package-button').prop('disabled', true);
													jQuery('#stripe-package-button').prop('disabled', true);
													jQuery('#paypal-package-button').prop('disabled', true);

												});

											})(jQuery);

											jQuery("#agree-terms").change(function() {
											    if ( jQuery(this).is(':checked') ) {
											        jQuery('#free-package-button').prop('disabled', false);
												    jQuery('#stripe-package-button').prop('disabled', false);
												    jQuery('#paypal-package-button').prop('disabled', false);
											    } else {
											        jQuery('#free-package-button').prop('disabled', true);
												    jQuery('#stripe-package-button').prop('disabled', true);
												    jQuery('#paypal-package-button').prop('disabled', true);
												}
											});

										</script>

									</span>

								</div>

								<?php } ?>
								<!--===============================-->
								<!--== End Terms & Conditions =====-->
								<!--===============================-->

								<!--===============================-->
								<!--== Register/Buy Buttons =======-->
								<!--===============================-->
								<div id="buy-buttons" class="full" style="margin-bottom: 0;">

									<?php
										global $redux_demo; 
										$terms_link = $redux_demo['page-url-terms'];
									?>

									<?php 

										$posts = get_posts('post_type=package&posts_per_page=1&order=ASC');
										$postsID = $posts[0]->ID;

										$package_price = get_post_meta($postsID, 'package_price', true);

										if(empty($package_price) or $package_price == 0) {

									?>

										<style>
											#free-package-button {
												display: inline-block;
											}
											#payed-package-button {
												display: none;
											}
										</style>

									<?php } else { ?>

										<style>
											#free-package-button {
												display: none;
											}
											#payed-package-button {
												display: inline-block;
											}
										</style>

									<?php } ?>

									<button id="free-package-button" style="margin-bottom: 0; width: 100%; margin-top: 10px;" name="submit" type="submit" class="input-submit" >

										<?php if ( !is_user_logged_in() ) { ?>
											<i class="fa fa-sign-in"></i><?php  _e( 'Register', 'themesdojo' ); ?>
										<?php } else { ?>
											<i class="fa fa-cart-plus"></i><?php  _e( 'Assign this plan now', 'themesdojo' ); ?>
										<?php } ?>

									</button>

									<script type="text/javascript">

										jQuery(function($) {

											document.getElementById('free-package-button').addEventListener('click', function(e) {

												jQuery('#payment-gateway').val("free");

												<?php 
													if ( is_user_logged_in() ) {
												?>

												$.fn.tdFreeBuyPackage();

												<?php } ?>

											});

											$.fn.tdFreeBuyPackage = function() {

												jQuery('#tdSubmitPaymentFree').ajaxSubmit({
												    type: "POST",
													data: jQuery('#tdSubmitPaymentFree').serialize(),
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													beforeSend: function() { 
														jQuery('#tdregister').fadeOut();
														jQuery('#tdregister-success .form-label').text("<?php _e( 'Please wait. Update in progress.', 'themesdojo' ); ?>");
									                	jQuery('#tdregister-success').fadeIn();
													},	 
												    success: function(response) {
												    	if(response == 1) {
															//
														} 
														if(response == 0) {
															
															var delay = 0;
															<?php
																global $redux_demo; 
																$upload_event = $redux_demo['page-url-upload-event'];
																if(!empty($upload_event)) {
															?>
															window.location.href = "<?php echo get_permalink( $upload_event ); ?>";
															<?php } else { ?>
	      													setTimeout(function(){ window.location.reload(); }, delay);
	      													<?php } ?>

														}
												        return false;
												    }
												});

											}

										});

									</script>

									<script type="text/javascript">

										jQuery("#account_type").change(function() {
										    var val = jQuery(this).val();

										    jQuery('#stripe-payment-package').val(val);
										    jQuery('#paypal-payment-package').val(val);
										    jQuery('#payment-package-id').val(val);

										    var val2 = jQuery("#package-title-"+val).val();
										    var val3 = jQuery("#package-price-"+val).val();

										    jQuery('#payment-package-title').val(val2);
										    jQuery('#payment-package-price').val(val3);

										    <?php					

												query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'ASC' ));

												if (have_posts()) : while (have_posts()) : the_post();

												$package_active = get_post_meta($post->ID, 'package_active', true);

												if(!empty($package_active)) {

													$postID = $post->ID;

													$package_price = get_post_meta($post->ID, 'package_price', true);

													if(empty($package_price) or $package_price == 0) {
															

											?>

										    if( val == <?php echo esc_attr($postID); ?> ) {
										        jQuery("#free-package-button").css({"display":"inline-block"});
										        jQuery("#payed-package-button").css({"display":"none"});
										    } 

										    <?php } else { ?>

										    if( val == <?php echo esc_attr($postID); ?> ) {
										        jQuery("#free-package-button").css({"display":"none"});
										        jQuery("#payed-package-button").css({"display":"inline-block"});
										    } 

										    <?php } ?>

										    <?php } endwhile; endif; ?>
										    <?php wp_reset_postdata(); ?>

										});

									</script>

									<div class="full" id="payed-package-button" style="margin-bottom: 0;">

										<div class="row">

											<?php
												global $redux_demo; 
												$payment_activate_stripe = $redux_demo['payment-activate-stripe'];
												$payment_activate_paypal = $redux_demo['payment-activate-paypal'];

												if(($payment_activate_stripe == 1) AND ($payment_activate_paypal == 1)) {
													$twobuttons = 1;
												} else {
													$twobuttons = 0;
												}

												if($payment_activate_stripe == 1) {
											?>

												<div class="col-sm-<?php if($twobuttons == 1) {?>6<?php  } else { ?>12<?php } ?>">

													<button id="stripe-package-button" style="margin-bottom: 0; width: 100%; margin-top: 10px;" name="submit" type="submit" class="input-submit" ><i class="fa fa-credit-card"></i><?php _e( 'Pay with Card', 'themesdojo' ); ?></button>

												</div>

												<script src="http://checkout.stripe.com/checkout.js"></script>
												<script type="text/javascript">

													<?php  

														global $redux_demo;
														$stripe_test = $redux_demo['stripe-state'];

														if($stripe_test == 2) {
															$test_key = $redux_demo['stripe-test-publishable-key'];
														} elseif($stripe_test == 1){
															$test_key = $redux_demo['stripe-live-publishable-key'];
														}

													?>

													jQuery(function($) {

														document.getElementById('stripe-package-button').addEventListener('click', function(e) {

															jQuery('#payment-gateway').val("stripe");

															<?php 
																if ( is_user_logged_in() ) {
															?>

															$.fn.tdStripeBuyPackage();

															<?php } ?>

														});

														$.fn.tdStripeBuyPackage = function() {

															jQuery('#popup-td-register').css('display','none');

															var paymentPackageID = jQuery("#payment-package-id").val();
															var paymentPackageTitle = jQuery('#payment-package-title').val();
										    				var paymentPackagePrice = jQuery('#payment-package-price').val();
										    				var paymentPackageEmail = jQuery('#stripe-payment-email').val();

															var handler_register_event = StripeCheckout.configure({
																key: '<?php echo $test_key; ?>',
																token: function(token) {
																	// Use the token to create the charge with a server-side script.
																	// You can access the token ID with `token.id`
																	var options = {
																		success: jQuery('#tdSubmitPaymentStripe').ajaxSubmit({
																			type: "POST",
																			data: {stripeToken: token.id, paymentPackageEmail: paymentPackageEmail, paymentPackageID: paymentPackageID},
																			url: '<?php echo admin_url('admin-ajax.php'); ?>', 
																			beforeSend: function() { 
																				jQuery('#pageloader').css('display', 'inline-block');
																			},	
																			success: function(data) {
																				jQuery('#tdpayment-success').css('display', 'inline-block');
																				var delay = 0;
																				var data_url = "<?php echo get_permalink( $upload_event ); ?>"+data;
																				<?php
																					global $redux_demo; 
																					$upload_event = $redux_demo['page-url-upload-event'];
																					if(!empty($upload_event)) {
																				?>
																				window.location.href = "<?php echo get_permalink( $upload_event ); ?>";
																				<?php } else { ?>
						      													window.location.href = data_url;
						      													<?php } ?>
							      												 

																			}
																		}),
																	};
																}
															});

															// Open Checkout with further options
															handler_register_event.open({
																name: paymentPackageTitle,
																amount: paymentPackagePrice*100
															});

															// Close Checkout on page navigation
															$(window).on('popstate', function() {
															    handler.close();
															});

														}

													});

												</script>

											<?php } ?>

											<?php 
												if($payment_activate_paypal == 1) {
											?>

											<div class="col-sm-<?php if($twobuttons == 1) {?>6<?php  } else { ?>12<?php } ?>">

												<button id="paypal-package-button" style="margin-bottom: 0; width: 100%; margin-top: 10px;" name="submit" type="submit" class="input-submit" ><i class="fa fa-paypal"></i><?php _e( 'Pay via PayPal', 'themesdojo' ); ?></button>

											</div>

											<script type="text/javascript">

												jQuery(function($) {

													document.getElementById('paypal-package-button').addEventListener('click', function(e) {

														jQuery('#payment-gateway').val("paypal");

														<?php 
															if ( is_user_logged_in() ) {
														?>

														jQuery('#tdSubmitPaymentPaypal').submit();

														<?php } ?>

													});

												});

											</script>

											<?php } ?>

										</div>

									</div>

								</div>

								<input type="hidden" name="action" value="tdRegisterForm" />
								<?php wp_nonce_field( 'tdRegister_html', 'tdRegister_nonce' ); ?>	 

								<span class="submit-loading" style="width: 100%; text-align: center; margin-top: 20px;"><i class="fa fa-refresh fa-spin"></i></span>

							<?php 
								if ( !is_user_logged_in() ) {
							?>
							</form>
							<?php } else { ?>
							</div>
							<?php } ?>
							<!--===============================-->
							<!--== End Register/Buy Buttons ===-->
							<!--===============================-->

							<div id="tdregister-success">
								<span>
									<span class="form-label"><?php _e( 'Registration successful.', 'themesdojo' ); ?></span>
								</span>
							</div>
									 
							<div id="tdregister-error">
								<span>
									<span class="form-label"><?php _e( 'Something went wrong with registration, try refreshing and submitting the form again.', 'themesdojo' ); ?></span>
								</span>
							</div>

							<div id="tdpayment-success">
								<span>
									<span class="form-label"><?php _e( 'Successful payment.', 'themesdojo' ); ?></span>
								</span>
							</div>

							<div id="tdpayment-error">
								<span>
									<span class="form-label"><?php _e( 'Something went wrong with payment, try refreshing and submitting the form again.', 'themesdojo' ); ?></span>
								</span>
							</div>

							<input type="hidden" id="payment-package-id" name="payment-package-id" value="">
							<input type="hidden" id="payment-package-title" name="payment-package-title" value="">
							<input type="hidden" id="payment-package-price" name="payment-package-price" value="">
							<input type="hidden" id="payment-gateway" name="payment-gateway" value="">
							
							<form id="tdSubmitPaymentStripe" method="POST" >

								<input type="hidden" id="stripe-payment-email" name="stripe-payment-email" value="">
								<input type="hidden" id="stripe-payment-package" name="stripe-payment-package" value="">

								<input type="hidden" name="action" value="paymentStripeForm" />
								<?php wp_nonce_field( 'paymentStripe_html', 'paymentStripe_nonce' ); ?>

							</form>

							<form id="tdSubmitPaymentPaypal" method="post" action="<?php echo get_template_directory_uri(); ?>/inc/payments/paypal/form-handler.php?func=addrow">

								<input type="hidden" id="paypal-payment-email" name="paypal-payment-email" value="">
								<input type="hidden" id="paypal-payment-package" name="paypal-payment-package" value="">

					    		<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">
					    		<input type="hidden" name="page_url" value="<?php echo home_url(); ?>">

					    		<?php $planID = uniqid(); ?>
								<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo esc_attr($planID); ?>">

								<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
												  
								<?php if ( isset($paypal_success) ) { ?>
									<input type="hidden" name="RETURN_URL" value="<?php echo esc_url($paypal_success); ?>" />
								<?php } ?>
												  
								<?php if ( isset($paypal_fail) ) { ?>
									<input type="hidden" name="CANCEL_URL" value="<?php echo esc_url($paypal_fail); ?>" />
								<?php } ?>
												  
								<input type="hidden" name="func" value="start" />

							</form>

							<form id="tdSubmitPaymentFree" method="POST" >

								<input type="hidden" id="free-payment-email" name="free-payment-email" value="">
								<input type="hidden" id="free-payment-package" name="free-payment-package" value="">

								<input type="hidden" name="action" value="paymentFreeForm" />
								<?php wp_nonce_field( 'paymentFree_html', 'paymentFree_nonce' ); ?>

							</form>

							<?php 
								if ( !is_user_logged_in() ) {
							?>	

							<script type="text/javascript">

								jQuery(function($) {

									jQuery('#tdregister').validate({
								        rules: {
								            userName: {
								                required: true,
								                minlength: 3
								            },
								            userEmail: {
								                required: true,
								                email: true
								            },
								            userPassword: {
								                required: true,
								                minlength: 6,
								            },
								            userConfirmPassword: {
								                required: true,
								                minlength: 6,
								                equalTo: "#userPassword"
								            }
								        },
								        messages: {
									        userName: {
									            required: "<?php _e( 'Please provide a username', 'themesdojo' ); ?>",
									            minlength: "<?php _e( 'Your username must be at least 3 characters long', 'themesdojo' ); ?>"
									        },
									        userEmail: {
									            required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
									            email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
									        },
									        userPassword: {
									            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
									            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
									        },
									        userConfirmPassword: {
									            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
									            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>",
									            equalTo: "<?php _e( 'Please enter the same password as above', 'themesdojo' ); ?>"
									        }
									    },
								        submitHandler: function(form) {

								        	var userEmail = jQuery("#userEmail").val();
											jQuery("#stripe-payment-email").val(userEmail);
											jQuery("#paypal-payment-email").val(userEmail);
											jQuery("#free-payment-email").val(userEmail);

								        	jQuery('#tdregister #buy-buttons').css('display','none');
								        	jQuery('#tdregister .submit-loading').css('display','inline-block');
								            jQuery(form).ajaxSubmit({
								            	type: "POST",
										        data: jQuery(form).serialize(),
										        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
								                success: function(data) {
								                	if(data == 1) {
								                		jQuery("#userName").addClass("error");
								                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
								                		jQuery('.userNameError').css('display','inline-block');

								                		jQuery('#tdregister #buy-buttons').css('display','inline-block');
								        				jQuery('#tdregister .submit-loading').css('display','none');
								                	}

								                	if(data == 2) {
								                		jQuery("#userEmail").addClass("error");
								                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
								                		jQuery('.userEmailError').css('display','inline-block');

								                		jQuery('#tdregister #buy-buttons').css('display','inline-block');
								        				jQuery('#tdregister .submit-loading').css('display','none');
								                	}

								                	if(data == 3) {
								                		jQuery("#userName").addClass("error");
								                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
								                		jQuery('.userNameError').css('display','inline-block');

								                		jQuery("#userEmail").addClass("error");
								                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
								                		jQuery('.userEmailError').css('display','inline-block');

								                		jQuery('#tdregister #buy-buttons').css('display','inline-block');
								        				jQuery('#tdregister .submit-loading').css('display','none');
								                	}

								                	if(data == 4) {

								                		var paymentGateway = jQuery("#payment-gateway").val();

								                		if(paymentGateway == "stripe") {

								                			jQuery('#tdregister-success').fadeIn();
								                			jQuery('#tdregister').fadeOut();

									                		$.fn.tdStripeBuyPackage();

									                	}

									                	if(paymentGateway == "paypal") {

									                		jQuery('#tdregister-success').fadeIn();
								                			jQuery('#tdregister').fadeOut();

									                		jQuery('#tdSubmitPaymentPaypal').submit();

									                	}

									                	if(paymentGateway == "free") {

									                		$.fn.tdFreeBuyPackage();

									                	}
								                	}

								                	if(data == 5) {
								                		jQuery('#tdregister').fadeTo( "slow", 0, function() {
									                        jQuery('#tdregister-error').fadeIn();
									                    });
								                	}
								                },
								                error: function(data) {
								                    jQuery('#tdregister').fadeTo( "slow", 0, function() {
								                        jQuery('#tdregister-error').fadeIn();
								                    });
								                }
								            });
								        }
								    });
								});

							</script>

							<?php } ?>

							<?php } else { ?>

							<div class="row">

								<div class="col-sm-12">

									<?php _e( 'Registration has been disabled.', 'themesdojo' ); ?>

								</div>

							</div>

							<?php } ?>

						</div>
					
					</div>

				</div>

			</div>

			<div id="close-td-register" class="close-login"></div>

			<script type="text/javascript">

				jQuery(function($) {

					document.getElementById('close-popup-td-register').addEventListener('click', function(e) {
												
						jQuery('#popup-td-register').css('display','none');

					});

					document.getElementById('close-td-register').addEventListener('click', function(e) {
												
						jQuery('#popup-td-register').css('display','none');

					});

				});
			</script>

		</div>

		<?php 
			if ( !is_user_logged_in() ) {
		?>	

		<!--===============================-->
		<!--== Reset Password =============-->
		<!--===============================-->
		<div id="popup-td-reset">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<div class="item-block-title">

							<i class="fa fa-user"></i><h4><?php _e( 'Reset Password', 'themesdojo' ); ?></h4>

							<span id="close-popup-td-reset" data-rel="tooltip" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></span>

						</div>

						<div class="item-popup-content">

							<form id="tdreset" >

								<div class="full" style="margin-bottom: 0;">  
							  	
								  	<span class="one_fourth first">
										<span class="form-label"><?php _e( 'Email:', 'themesdojo' ); ?></span>
									</span>

									<span class="three_fourth">
										<input type="text" name="userEmail" id="userEmail" value="" class="input-textarea" placeholder="" />
										<label for="userEmail" class="error userEmailError"></label>
									</span>

								</div>
								
								<input type="hidden" name="action" value="tdResetForm" />
								<?php wp_nonce_field( 'tdReset_html', 'tdReset_nonce' ); ?>

								<input style="margin-bottom: 0; width: 100%" name="submit" type="submit" value="<?php _e( 'Submit', 'themesdojo' ); ?>" class="input-submit">	 

								<span class="submit-loading" style="width: 100%; text-align: center;"><i class="fa fa-refresh fa-spin"></i></span>
							  	  
							</form>

							<div id="tdreset-success">
								<span>
								   	<span class="form-label"><?php _e( 'Check your email for new password.', 'themesdojo' ); ?></span>
								</span>
							</div>
								 
							<div id="tdreset-error">
								<span>
								   	<span class="form-label"><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></span>
								</span>
							</div>

							<script type="text/javascript">

							jQuery(function($) {
								jQuery('#tdreset').validate({
							        rules: {
							            userEmail: {
							                required: true,
							                email: true
							            }
							        },
							        messages: {
								        userEmail: {
								            required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
								            email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
								        }
								    },
							        submitHandler: function(form) {
							        	jQuery('#tdreset .input-submit').css('display','none');
							        	jQuery('#tdreset .submit-loading').css('display','inline-block');
							            jQuery(form).ajaxSubmit({
							            	type: "POST",
									        data: jQuery(form).serialize(),
									        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
							                success: function(data) {
							                	if(data == 2) {
							                		jQuery("#userEmail").addClass("error");
							                		jQuery(".userEmailError").text("<?php _e( 'There is no user available for this email.', 'themesdojo' ); ?>");
							                		jQuery('.userEmailError').css('display','inline-block');

							                		jQuery('#tdreset .input-submit').css('display','inline-block');
							        				jQuery('#tdreset .submit-loading').css('display','none');
							                	}

							                	
							                	if(data == 1) {
								                    jQuery('#tdreset').fadeTo( "slow", 0, function() {
								                    	jQuery('#tdreset').css('display','none');
								                        jQuery(this).find('label').css('cursor','default');
								                        jQuery('#tdreset-success').fadeIn();

								                        var delay = 5;
	      												setTimeout(function(){ window.location.reload(); }, delay);
								                    });
							                	}

							                	if(data == 3) {
							                		jQuery('#tdreset').fadeTo( "slow", 0, function() {
								                        jQuery('#tdreset-error').fadeIn();
								                    });
							                	}
							                },
							                error: function(data) {
							                    jQuery('#tdreset').fadeTo( "slow", 0, function() {
							                        jQuery('#tdreset-error').fadeIn();
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

			<div id="close-td-reset" class="close-login"></div>

			<script type="text/javascript">

				jQuery(function($) {

					document.getElementById('close-popup-td-reset').addEventListener('click', function(e) {
												
						jQuery('#popup-td-reset').css('display','none');

					});

					document.getElementById('close-td-reset').addEventListener('click', function(e) {
												
						jQuery('#popup-td-reset').css('display','none');

					});

				});
			</script>

		</div>
		<!--===============================-->
		<!--== End Login/Register/Reset ===-->
		<!--===============================-->
		<?php } ?>