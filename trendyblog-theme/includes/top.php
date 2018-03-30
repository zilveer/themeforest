<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	$page_layout = df_get_option(THEME_NAME."_page_layout");

	//logo settings
	$logo = df_get_option(THEME_NAME.'_logo');	
	// search
	$search = df_get_option(THEME_NAME.'_search');	
	//woocommerce cart
	$cart = df_get_option(THEME_NAME.'_cart');	


	//top banner	
	$topBanner = df_get_option(THEME_NAME."_top_banner");
	$topBannerCode = df_get_option(THEME_NAME."_top_banner_code");

	//fixed menu
	$stickyMenu = df_get_option(THEME_NAME."_stickyMenu");

	$weatherSet = df_get_option(THEME_NAME."_weather");

	$locationType = df_get_option(THEME_NAME."_weather_location_type");
	if($locationType == "custom") {
		$weather = DF_weather_forecast(str_replace(' ', '+', df_get_option(THEME_NAME."_weather_city")));
	} else {
		$weather = DF_weather_forecast($_SERVER['REMOTE_ADDR']);
	}

	//logo wrapper
	$subCount = df_get_option(THEME_NAME."_subcount");
	if(!$subCount) { $subCount = 6; }


	//header style 
	$headerStyle = df_get_option(THEME_NAME."_headerStyle");
?>
			
    <!-- Wrapper -->
    <div id="wrapper" class="<?php echo esc_attr__($page_layout=="boxed" ? " boxed" : 'wide'); ?>">
        <!-- Header -->
        <header id="header" role="banner">    
        	<?php if($weatherSet=="link" || $weatherSet=="on" || has_nav_menu('top-menu')) { ?>
            <!-- Header meta -->
            <div class="header_meta">
                <div class="container">
					<?php
						if($weatherSet=="on") { 
							if(!isset($weather['error'])) { 
					?>
		                    <!-- Weather forecast -->
		                    <div class="weather_forecast">
		                        <i class="wi wi-<?php echo esc_html__($weather['image']);?>"></i>
		                        <span class="city"><?php echo esc_html__($weather['city']).', '.esc_html__($weather['country']);?></span>
		                        <span class="temp"><?php echo esc_html__($weather['temp_'.df_get_option(THEME_NAME."_temperature")]);?></span>
		                    </div><!-- End Weather forecast -->
					<?php 
							} else { 
								echo esc_html__($weather['error']);
							} 
						}
					?>
					<?php
						if($weatherSet=="link") { 
							$weatherText = df_get_option(THEME_NAME."_weather_text");
							$weatherUrl = df_get_option(THEME_NAME."_weather_url");
							$weatherTarget = df_get_option(THEME_NAME."_weather_target");
					?>
		                    <div class="weather_forecast">
		                        <?php if($weatherUrl) { ?>
		                        	<a class="city" href="<?php echo esc_url($weatherUrl);?>"<?php if($weatherTarget=="on") { echo ' target="_blank"'; } ?>>
		                        <?php } ?>
		                        	<?php esc_html_e($weatherText);?>
		                        <?php if($weatherUrl) { ?>
		                        	</a>
		                        <?php } ?>
		                    </div>
					<?php 
						}
					?>
					<?php
						if($weatherSet=="date") { 
					?>
		                    <div class="weather_forecast date">
		                    	<?php echo date(get_option('date_format'));?>
		                    </div>
					<?php 
						}
					?>
					<?php
						if($search=="on") {
							$searchHTML = '		
									<li class="search_icon_form"><a href="javascript:voiud(0);"><i class="fa fa-search"></i></a>
		                                <div class="sub-search">
		                                    <form  method="get" action="'.home_url().'">
		                                        <input type="search" placeholder="'.esc_attr__("Search...", THEME_NAME).'" name="s" id="s">
		                                        <input type="submit" value="'.esc_attr__("Search", THEME_NAME).'">
		                                    </form>
		                                </div>
		                            </li>';
		                } else {
		                	$searchHTML = false;
		                }
						if ( function_exists( 'register_nav_menus' )) {
							$walker = new DF_Walker_Top;
							$args = array(
								//'container' => 'nav',
								//'container_class' => 'top-menu',
								'theme_location' => 'top-menu',
								'menu_class'      => 'menu',
								'items_wrap' => '<ul class="%2$s" rel="'.esc_html__("Top Menu", THEME_NAME).'">%3$s'.$searchHTML.'</ul>',
								'depth' => 3,
								'walker' => $walker,
								"echo" => false
							);

							if(has_nav_menu('top-menu')) {
					?>
						<!-- Top menu -->
	                    <nav class="top_navigation" role="navigation">
	                        <span class="top_navigation_toggle"><i class="fa fa-reorder"></i></span>
	                        <?php echo wp_nav_menu($args); ?>
	                    </nav>
	                    <!-- End Top menu -->
					<?php
							}		

						}	

					?>	
                </div>
            </div>
            <!-- End Header meta -->
            <?php } ?>
            <!-- Header main -->
            <div id="<?php echo ($headerStyle=="2") ? "header_main_alt" : "header_main";?>" class="<?php if($stickyMenu=="on") { ?>sticky <?php } ?>header_main <?php if($headerStyle=='2' && ($topBanner!="on" || !$topBannerCode)) echo esc_attr('site_brand_center');?>">
				<div class="container">
                	<!-- Logo -->
                    <div class="site_brand">
						<?php if($logo) { ?>
								<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logo);?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } else { ?>
								<h1 id="site_title">
									<a href="<?php echo esc_url(home_url()); ?>">
										<?php echo esc_html__(mb_substr(get_bloginfo('name'),0,$subCount));?>
										<span><?php echo esc_html__(mb_substr(get_bloginfo('name'),$subCount));?></span>
									</a>
								</h1>
							    <?php if(get_bloginfo('description')) { ?>
							    	<h2 id="site_description"><?php echo esc_html__(bloginfo('description'));?></h2>
								<?php } ?>
						<?php } ?>
					</div>
					<!-- End Logo -->
					<?php if($headerStyle=="2" && $topBanner=="on") { ?>
				        <!-- Banner -->
				        <div class="header_banner">
				            <?php echo stripslashes($topBannerCode);?>
				        </div>
			        <?php } ?>
			        <?php if($headerStyle=="2") { ?>
			        	</div>
			        <?php } ?>
			        <?php if($headerStyle=="2") { ?>
			        	<div class="container">
			        <?php } ?>
					<!-- Site navigation -->
                    <nav class="site_navigation" role="navigation">
                        <span class="site_navigation_toggle"><i class="fa fa-reorder"></i></span>

						<?php	
							if($cart == "on" && df_is_woocommerce_activated() == true) {
								global $woocommerce;
								if(sizeof( $woocommerce->cart->get_cart() ) == 1) {
									$cartSize = sizeof( $woocommerce->cart->get_cart() ).' '.esc_html__("Item", THEME_NAME);
								} else {
									$cartSize = sizeof( $woocommerce->cart->get_cart() ).' '.esc_html__("Items", THEME_NAME);
								}
								$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
								$cartHtml = '
								<li class="menu-item-has-children">
									<a href="'.esc_url($shop_page_url).'">
										<i class="fa fa-shopping-cart"></i>
										<div class="subtitle df-cart-count" data-one="'.esc_attr__("Item", THEME_NAME).'" data-more="'.esc_attr__("Items", THEME_NAME).'">'.$cartSize.'</div>
									</a>
	                                <span class="site_sub_menu_toggle"></span>
	                                <div class="cart_content df-cart">
	                                    <div class="widget_shopping_cart_content"></div>
	                                </div>
	                            </li>';
							} else {
								$cartHtml = false;
							}
							wp_reset_query();
							if ( function_exists( 'register_nav_menus' )) {
								$walker = new DF_Walker;
								$args = array(
									'container' => '',
									'theme_location' => 'main-menu',
									'menu_class'      => 'menu',
									'items_wrap' => '<ul class="%2$s" rel="'.esc_html__("Main Menu", THEME_NAME).'">%3$s'.$cartHtml.'</ul>',
									'depth' => 3,
									"echo" => false,
									'walker' => $walker
								);
											
											
								if(has_nav_menu('main-menu')) {
									echo wp_nav_menu($args);		
								} else {
									echo "<ul class=\"menu\"><li class=\"navi-none\"><a href=\"".esc_url(admin_url("nav-menus.php")) ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
								}		

							}
						?>
                    </nav>
                    <!-- End Site navigation -->
			        <?php if($headerStyle=="2") { ?>
			        	</div>
			        <?php } ?>
		        <?php if($headerStyle!="2") { ?>
		        	</div>
		        <?php } ?>
            </div>
            <!-- End Header main -->
        </header>
        <!-- End Header -->

<?php wp_reset_query(); ?>
