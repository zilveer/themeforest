<?php
/**
 * Template name: Packages
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

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

					<?php					

						query_posts( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'ASC' ));

						if (have_posts()) : while (have_posts()) : the_post();

						$package_active = get_post_meta($post->ID, 'package_active', true);

						if(!empty($package_active)) {

							$postID = $post->ID;

					?>

						<?php 

							$posts = get_posts('post_type=package'); 
							$count = count($posts);  

						?>

						<div class="col-sm-<?php if($count == 1) { ?>12<?php } elseif($count == 2) { ?>6<?php } elseif($count == 3) { ?>4<?php } else { ?>4<?php } ?>">

							<div class="item-block-title price-plan-header">

								<?php

									global $redux_demo; 

									$package_price = get_post_meta($post->ID, 'package_price', true);

									if(empty($package_price) or $package_price == 0) {
										$package_price = __( 'Free', 'themesdojo' );
										$currency_symbol = "";
									} else {
										$currency_symbol = $redux_demo['currency-symbol'];
									}

								?>

								<h4><?php the_title(); ?></h4>
								<span class="package-price"><?php echo esc_attr($currency_symbol); echo esc_attr($package_price); ?></span>

							</div>

							<div class="item-block-content item-image-gallery-block">

								<ul class="package-capabilities">

									<?php 

										$package_approve_item = get_post_meta($post->ID, 'package_approve_item', true);
										if(empty($package_approve_item)) {
											$package_approve_item = __( 'Instant', 'themesdojo' );
										} else {
											$package_approve_item = __( 'Admin Moderated', 'themesdojo' );
										}

										$package_events_amount = get_post_meta(get_the_ID(), 'package_events_amount', true);
					                    if(empty($package_events_amount)) {
					                      $package_events_amount = 0;
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

										$package_allow_ratings = get_post_meta($post->ID, 'package_allow_ratings', true);
										if(empty($package_allow_ratings)) {
											$package_allow_ratings = '<i class="fa fa-times"></i>';
										} else {
											$package_allow_ratings = '<i class="fa fa-check main-color"></i>';
										}

									?>

									<li>
										<span class="package-cap-title"><?php _e( 'Events', 'themesdojo' ); ?></span>
										<span class="package-cap-value"><?php echo esc_attr($package_events_amount); ?></span>
									</li>

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
										<span class="package-cap-title"><?php _e( 'Amenitites', 'themesdojo' ); ?></span>
										<span class="package-cap-value"><?php echo $package_allow_amenities; ?></span>
									</li>

									<li>
										<span class="package-cap-title"><?php _e( 'Video', 'themesdojo' ); ?></span>
										<span class="package-cap-value"><?php echo $package_allow_video; ?></span>
									</li>

									<li style="border-bottom: none; padding-bottom: 0px; margin-bottom: 0;">

										<span id="signup-package-<?php echo esc_attr($postID); ?>" class="td-buttom sign-up-button" style="margin-bottom: 0; margin-right: 0;">

											<?php 

												if ( !is_user_logged_in() ) {

													_e( 'Sign up & start publishing now', 'themesdojo' ); 

												} else {

													_e( 'Buy now', 'themesdojo' ); 

												}

											?>

										</span>

									</li>

									<script type="text/javascript">

										jQuery(function($) {

											document.getElementById('signup-package-<?php echo esc_attr($postID); ?>').addEventListener('click', function(e) {
																					
												$.fn.OpenClaimForm<?php echo esc_attr($postID); ?>();

												$('#account_type').val('<?php echo esc_attr($postID); ?>').trigger('change');

												e.preventDefault();

											});

											$.fn.OpenClaimForm<?php echo esc_attr($postID); ?> = function() {

												jQuery("html, body").animate({ scrollTop: 0 }, 800);

											    var val = <?php echo esc_attr($postID); ?>;

											    jQuery('#stripe-payment-package').val(val);
											    jQuery('#paypal-payment-package').val(val);
											    jQuery('#payment-package-id').val(val);

											    var val2 = jQuery("#package-title-"+val).val();
											    var val3 = jQuery("#package-price-"+val).val();

											    jQuery('#payment-package-title').val(val2);
											    jQuery('#payment-package-price').val(val3);

											    <?php					

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

											    jQuery('#popup-td-register .item-block-title h4').text("<?php _e( 'Select Payment System', 'themesdojo' ); ?>");
											    jQuery('#popup-td-register').css('display', 'block');

											}

										});

									</script>

								</ul>

							</div>

						</div>

					<?php } ?>

					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>

					<div class="col-sm-12">

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

				    </div>

				</section>
				<!--==========-->

<?php get_footer(); ?>