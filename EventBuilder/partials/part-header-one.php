<?php

		/*
		|--------------------------------------------------------------------------
		| Navigation Setting
		|--------------------------------------------------------------------------
		*/
					
		/* main navigation settings*/
		$mainmenu = array('container'            => 'div',
						  'container_id'         => 'main-navigation',
	                      'container_class'      => 'main-menu',
	                      'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	                      'menu_class'           => 'main-menu',
	                      'theme_location'       => 'primary',
	                      'walker'               => new td_menu_walker()
	    );

	    /* main navigation settings*/ 
	    $topmenu = array('container'             => 'div',
	                      'container_class'      => 'top-menu',
	                      'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	                      'menu_class'           => 'top-menu',
	                      'theme_location'       => 'secondary' 
	    );  

	?>

<header id="header">

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
								if(isset($redux_demo['hide-sidebar-menu'])) {
								$sidebar_menu = $redux_demo['hide-sidebar-menu'];
								if($sidebar_menu == 1) {

							?>

							<div class="main-menu">
								<ul class="main-menu">
									<li class="first sidebar-menu-button"><span class="sidebar-button"><i class="fa fa-bars author-menu-bars"></i></span></li>
								</ul>
							</div>

							<?php } } ?>

							<?php

								global $redux_demo; 
								$hide_login = $redux_demo['hide_login'];
								if($hide_login == 1) {

							?>

							<div id="extended-menu" class="main-menu">
								<ul class="main-menu">

									<?php 
										if ( is_user_logged_in() ) {

											global $userdata;
											$current_user = wp_get_current_user(); 
											$user_name = $current_user->display_name;
											$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
											$user_info = get_userdata($user_id);
									?>	

										<?php
											global $redux_demo; 
											if(isset($redux_demo['page-url-my-account'])) {
												$my_account_link = $redux_demo['page-url-my-account'];
												if(!empty($my_account_link)) {
										?>

										<li class="first">
											<a href="<?php echo get_permalink( $my_account_link ); ?>" class="my-account-button" title="My Account">
												<?php  $author_avatar_url = get_user_meta($user_id, "user_meta_image", true); ?>
												<b><?php _e( "Hi", "themesdojo" ); ?>, <?php echo $user_name; ?></b>
											</a>
											<ul class="sub-menu right-submenu" style="opacity: 0; display: none;">
												<?php
													global $redux_demo; 
													$upload_event = $redux_demo['page-url-upload-event'];
													$upload_event_bttn = $redux_demo['menu-upload-event'];
													if(!empty($upload_event) AND $upload_event_bttn == 1) {
												?>
													<li><a href="<?php echo get_permalink( $upload_event ); ?>" style="min-width: 116px;"><?php _e( "Add New Event", "themesdojo" ); ?></a></li>
												<?php } ?>
												<li><a href="<?php echo get_permalink( $my_account_link ); ?>" style="min-width: 116px;"><?php printf( __( 'My Account', 'themesdojo' )); ?></a></li>
												<li><a href="<?php echo wp_logout_url(get_option('siteurl')); ?>"><?php printf( __( 'Log out', 'themesdojo' )); ?></a></li>
											</ul>
										</li>

										<?php } } ?>

									<?php } else { ?>

										<li class="first"><a href="#" id="top-menu-login" class="top-menu-login"><?php _e( 'Login', 'themesdojo' ); ?></a></li>
										<li><a href="#" id="top-menu-register" class="top-menu-register"><?php _e( 'Register', 'themesdojo' ); ?></a></li>

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

							<?php } ?>
							
							<?php if(has_nav_menu('primary')) { wp_nav_menu( $mainmenu ); } else { wp_nav_menu( $mainmenu ); } ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	</header>