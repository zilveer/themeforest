<?php
	$page_layout = get_option(THEME_NAME."_page_layout");

	//logo settings
	$logo = get_option(THEME_NAME.'_logo');	

	//shopping cart
	$shoppingCart = get_option(THEME_NAME.'_shopping_cart');	

	//header info	
	$headerText = get_option(THEME_NAME."_header_text");
	$headerSlider = get_option(THEME_NAME."_header_slider");

	//social icons
	$vimeo = get_option(THEME_NAME."_vimeo");
	$twitter = get_option(THEME_NAME."_twitter");
	$facebook = get_option(THEME_NAME."_facebook");
	$googlepluss = get_option(THEME_NAME."_googlepluss");
	$pinterest = get_option(THEME_NAME."_pinterest");
	$linkedin = get_option(THEME_NAME."_linkedin");

	global $woocommerce;

?>
		<!-- BEGIN .boxed -->
		<div class="boxed<?php echo $page_layout=="boxed" ? " active" : false; ?>">
			
			<!-- BEGIN .very-top -->
			<div class="very-top">

				<!-- BEGIN .wrapper -->
				<div class="wrapper">

					<?php

						if ( function_exists( 'register_nav_menus' )) {
							$walker = new OT_Walker_Top;
							$args = array(
								'container' => '',
								'theme_location' => 'top-menu',
								'items_wrap' => '<ul class="left" rel="Top Menu">%3$s</ul>',
								'depth' => 1,
								"echo" => false,
								'walker' => $walker
							);
										
										
							if(has_nav_menu('top-menu')) {
								echo wp_nav_menu($args);		
							}		

						}	

					?>
					<?php if($vimeo || $twitter || $facebook || $googlepluss || $pinterest || $linkedin) { ?>
						<ul class="right">
							<?php if($vimeo) { ?><li><a href="<?php echo $vimeo;?>" target="_blank" class="icon-text">&#62214;</a></li><?php } ?>
							<?php if($twitter) { ?><li><a href="<?php echo $twitter;?>" target="_blank" class="icon-text">&#62217;</a></li><?php } ?>
							<?php if($facebook) { ?><li><a href="<?php echo $facebook;?>" target="_blank" class="icon-text">&#62222;</a></li><?php } ?>
							<?php if($googlepluss) { ?><li><a href="<?php echo $googlepluss;?>" target="_blank" class="icon-text">&#62223;</a></li><?php } ?>
							<?php if($pinterest) { ?><li><a href="<?php echo $pinterest;?>" target="_blank" class="icon-text">&#62226;</a></li><?php } ?>
							<?php if($linkedin) { ?><li><a href="<?php echo $linkedin;?>" target="_blank" class="icon-text">&#62232;</a></li><?php } ?>
						</ul>
					<?php } ?>
					<div class="clear-float"></div>

				<!-- END .wrapper -->
				</div>
				
			<!-- END .very-top -->
			</div>
			
			<!-- BEGIN .header -->
			<div class="header">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">

					<div class="logo-header">
						<?php if($logo) { ?>
							<a href="<?php echo home_url(); ?>" class="logo-image"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } else { ?>
							<h1 class="logo-text"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						<?php } ?>
					</div>

					<?php if($headerText) { ?>
						<p class="header-info"><?php echo stripslashes(nl2br($headerText));?></p>
					<?php  } ?>
					<?php if($headerSlider=="on") { ?>
						<div class="header-featured">
							<ul class="header-featured-blocks">
								<?php for($i=1; $i<=3; $i++) {  ?>
									<?php 
										$file = get_option(THEME_NAME."_slider_image_".$i);
										$image = get_post_thumb(false, 115, 139, false, $file);
										$text = get_option(THEME_NAME."_slider_text_".$i);
										$link = get_option(THEME_NAME."_slider_link_".$i);
										$title = get_option(THEME_NAME."_slider_title_".$i);
										if(!$file && !$text && !$title) break;
									?>
									<li>
										<?php if($image['show']==true) { ?>
											<div class="featured-photo">
												<?php if($link) { ?>
													<a href="<?php echo $link;?>">
												<?php } ?>
													<img src="<?php echo $image['src'];?>" alt="<?php echo $title;?>" />
												<?php if($link) { ?>
													</a>
												<?php } ?>
											</div>
										<?php } ?>
										<div class="featured-content">
											<?php if($title) { ?>
												<h3>
													<?php if($link) { ?>
														<a href="<?php echo $link;?>">
													<?php } ?>
														<?php echo $title;?>
													<?php if($link) { ?>
														</a>
													<?php } ?>
												</h3>
											<?php } ?>
											<p><?php echo stripslashes($text);?></p>
											<?php if($link) { ?>
												<a href="<?php echo $link;?>" class="button-link invert">
													<?php _e("Read More", THEME_NAME);?>
													<span class="icon-text">&#9656;</span>
												</a>
											<?php } ?>
										</div>
										<div class="clear-float"></div>
									</li>
								<?php } ?>
							</ul>
							<ul class="header-featured-navi"></ul>
						</div>
					<?php } ?>
				<!-- END .wrapper -->
				</div>
				
			<!-- END .header -->
			</div>

			<!-- BEGIN .main-menu -->
			<div class="main-menu">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					<?php if ( ot_is_woocommerce_activated() == true && $shoppingCart == "on") { ?>
						<!-- BEGIN .menu-cart -->
						<div class="menu-cart right">
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="icon-text">&#59197;<i><span class="ot-cart-count"><?php echo sizeof( $woocommerce->cart->get_cart() );?></span></i></a>
							<div class="ot-cart">
								<strong><span class="icon-text">&#59197;</span><span class="ot-cart-count"><?php echo sizeof( $woocommerce->cart->get_cart() );?></span> <?php _e("Items in Your cart", THEME_NAME);?></strong>
								<div class="widget_shopping_cart_content"></div>
							</div>
						<!-- END .menu-cart -->
						</div>
					<?php } ?>
					<?php	
		
						wp_reset_query();
						if ( function_exists( 'register_nav_menus' )) {
							$walker = new OT_Walker;
							$args = array(
								'container' => '',
								'theme_location' => 'middle-menu',
								'items_wrap' => '<ul class="%2$s" rel="'.__("Main Menu", THEME_NAME).'">%3$s</ul>',
								'depth' => 3,
								"echo" => false,
								'walker' => $walker
							);
										
										
							if(has_nav_menu('middle-menu')) {
								echo wp_nav_menu($args);		
							} else {
								echo "<ul rel=\"".__("Main Menu", THEME_NAME)."\"><li class=\"navi-none\"><a href=\"".admin_url("nav-menus.php") ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
							}		

						}
					?>

				<!-- END .wrapper -->
				</div>
				
			<!-- END .main-menu -->
			</div>