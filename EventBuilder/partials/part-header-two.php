<header id="header">

		<div id="top-menu">

			<div class="container box">

				<div class="row">
							
					<div class="col-md-12">
						
						<?php if(has_nav_menu('secondary')) { wp_nav_menu( $topmenu ); } else { wp_nav_menu( $topmenu ); } ?>

						<div class="top-menu-right">
							<ul class="top-menu">

								<?php 
									if ( is_user_logged_in() ) {
								?>	

									<?php
										global $redux_demo; 
										$my_account_link = $redux_demo['page-url-my-account'];
										if(!empty($my_account_link)) {
									?>

									<?php 
										if ( is_user_logged_in() && current_user_can('administrator')) {

											$pending_items = $wpdb->get_var( "SELECT COUNT(*) FROM `{$wpdb->prefix}posts` WHERE (post_type = 'item' and post_status = 'pending') OR (post_type = 'event' and post_status = 'pending') ");

										}
									?>

									<li class="first">
										<a href="<?php echo get_permalink( $my_account_link ); ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Login"><?php printf( __( 'My Account', 'themesdojo' )); ?> <?php if(!empty($pending_items)) { ?>(<?php echo esc_attr($pending_items); ?>)<?php } ?></a>
									</li>

									<?php } ?>
									
									<li>
										<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Logout"><?php printf( __( 'Log out', 'themesdojo' )); ?></a>
									</li>

								<?php } else { ?>

									<li><span id="top-menu-login" class="top-menu-login"><?php _e( 'Login', 'themesdojo' ); ?></span></li>
									<li><span id="top-menu-register" class="top-menu-register"><?php _e( 'Register', 'themesdojo' ); ?></span></li>

									<script type="text/javascript">

										jQuery(function($) {

											document.getElementById('top-menu-login').addEventListener('click', function(e) {
																					
												jQuery('#popup-td-login').css('display', 'block');

												e.preventDefault();

											});

											document.getElementById('top-menu-register').addEventListener('click', function(e) {
																					
												jQuery('#popup-td-register').css('display', 'block');

												e.preventDefault();

											});

										});

									</script>

								<?php } ?>	
						
							</ul>
						</div>

					</div>

				</div>

			</div>

		</div>

		<div id="main-menu">

			<div class="container box">

				<div class="row">
							
					<div class="col-md-12">

						<div class="main-menu-holder">

							<!--== Logo ==-->
							<span class="logo">

								<?php 

									global $redux_demo; 
									$logo_type = $redux_demo['logo-type'];
									$logo_text_icon = $redux_demo['logo-text-icon'];
									$logo_text_text = $redux_demo['logo-text-text'];
									if(isset($redux_demo['logo-image']['url'])) { 
										$logo = $redux_demo['logo-image']['url'];
									}

									if($logo_type == 1) {

								?>

									<a href="<?php echo home_url(); ?>"><span class="fa <?php echo $logo_text_icon; ?>"></span><?php echo esc_attr($logo_text_text); ?></a>

								<?php

									} else { 

								?>

									<a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($logo); ?>" alt="Logo" /></a>

								<?php

									}

								?>

							</span>

							<?php
								global $redux_demo; 
								$upload_event = $redux_demo['page-url-upload-event'];
								$upload_event_bttn = $redux_demo['menu-upload-event'];
								if(!empty($upload_event) AND $upload_event_bttn == 1) {
							?>
								<a href="<?php echo get_permalink( $upload_event ); ?>" class="td-buttom td-upload-event-bttn"><i class="fa fa-plus"></i><i class="fa fa-glass"></i><span><?php _e( "Add Event", "themesdojo" ); ?></span></a>
							<?php } ?>

							<?php
								global $redux_demo; 
								$upload_listing = $redux_demo['page-url-upload-listing'];
								$upload_listing_bttn = $redux_demo['menu-upload-listing'];
								if(!empty($upload_listing) AND $upload_listing_bttn == 1) {
							?>
								<a href="<?php echo get_permalink( $upload_listing ); ?>" class="td-buttom td-upload-listing-bttn"><i class="fa fa-plus"></i><i class="fa fa-map-marker"></i><span><?php _e( "Add Listing", "themesdojo" ); ?></span></a>
							<?php } ?>

							<span class="top-social-2">

								<?php 

									global $redux_demo; 

									if(isset($redux_demo['facebook-link'])) { $facebook_link = $redux_demo['facebook-link']; }
									if(isset($redux_demo['twitter-link'])) { $twitter_link = $redux_demo['twitter-link']; }
									if(isset($redux_demo['dribbble-link'])) { $dribbble_link = $redux_demo['dribbble-link']; }
									if(isset($redux_demo['flickr-link'])) { $flickr_link = $redux_demo['flickr-link']; }
									if(isset($redux_demo['github-link'])) { $github_link = $redux_demo['github-link']; }
									if(isset($redux_demo['pinterest-link'])) { $pinterest_link = $redux_demo['pinterest-link']; }
									if(isset($redux_demo['youtube-link'])) { $youtube_link = $redux_demo['youtube-link']; }
									if(isset($redux_demo['google-plus-link'])) { $google_plus_link = $redux_demo['google-plus-link']; }
									if(isset($redux_demo['linkedin-link'])) { $linkedin_link = $redux_demo['linkedin-link']; }
									if(isset($redux_demo['tumblr-link'])) { $tumblr_link = $redux_demo['tumblr-link']; }
									if(isset($redux_demo['vimeo-link'])) { $vimeo_link = $redux_demo['vimeo-link']; }

								?>

								<?php if(!empty($facebook_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($facebook_link); ?>"><i class="fa fa-facebook-square"></i></a>

								<?php } ?>

								<?php if(!empty($twitter_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($twitter_link); ?>"><i class="fa fa-twitter-square"></i></a>

								<?php } ?>

								<?php if(!empty($dribbble_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($dribbble_link); ?>"><i class="fa fa-dribbble"></i></a>

								<?php } ?>

								<?php if(!empty($flickr_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($flickr_link); ?>"><i class="fa fa-flickr"></i></a>

								<?php } ?>

								<?php if(!empty($github_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($github_link); ?>"><i class="fa fa-github-square"></i></a>

								<?php } ?>

								<?php if(!empty($pinterest_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($pinterest_link); ?>"><i class="fa fa-pinterest-square"></i></a>

								<?php } ?>

								<?php if(!empty($youtube_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($youtube_link); ?>"><i class="fa fa-youtube-square"></i></a>

								<?php } ?>

								<?php if(!empty($google_plus_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($google_plus_link); ?>"><i class="fa fa-google-plus-square"></i></a>

								<?php } ?>

								<?php if(!empty($linkedin_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($linkedin_link); ?>"><i class="fa fa-linkedin-square"></i></a>

								<?php } ?>

								<?php if(!empty($tumblr_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($tumblr_link); ?>"><i class="fa fa-tumblr-square"></i></a>

								<?php } ?>

								<?php if(!empty($vimeo_link)) { ?>

									<a class="target-blank" href="<?php echo esc_url($vimeo_link); ?>"><i class="fa fa-vimeo-square"></i></a>

								<?php } ?>

							</span>

						</div>

						<div id="main-menu-style-2">

							<div class="main-menu-style-2-container">

								<?php if(has_nav_menu('primary')) { wp_nav_menu( $mainmenu ); } else { wp_nav_menu( $mainmenu ); } ?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</header>