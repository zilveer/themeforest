<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
		if (get_option(DESIGNARE_SHORTNAME."_disable_responsive") !== "on"){
			?>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">
			<?php		
		}
	?>
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $woocommerce;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'smartbox' ), max( $paged, $page ) );

	?></title>

	<meta name="author" content="">
	<meta name="keywords" content="<?php if(get_option(DESIGNARE_SHORTNAME."_seo_keywords")) echo get_option(DESIGNARE_SHORTNAME."_seo_keywords"); ?>">
	
	<meta name="description" content="<?php if(get_option(DESIGNARE_SHORTNAME."_seo_description")) echo get_option(DESIGNARE_SHORTNAME."_seo_description"); ?>">
    
	<!-- Place favicon.ico and apple-touch-icons in the images folder -->
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php if (get_option(DESIGNARE_SHORTNAME."_favicon")) echo get_option(DESIGNARE_SHORTNAME."_favicon"); else echo '#'; ?>">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png"><!--60X60-->
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-ipad.png"><!--72X72-->
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-iphone4.png"><!--114X114-->
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-ipad3.png">	<!--144X144-->	
	
	<link rel="profile" href="http://gmpg.org/xfn/11" >

	
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
	
	<?php wp_head(); ?>
	</head>


	<body <?php body_class(); ?>>	
		
	<?php
	global $smartbox_custom;
	global $smartbox_styleColor;
	$bodyLayoutType = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type");
	if (empty($bodyLayoutType)) $bodyLayoutType = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type option:selected");
	$headerType = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	if (empty($headerType)) $headerType = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
	?>	
	
	<div id="bodyLayoutType" class="smartbox_helper_div"><?php echo $bodyLayoutType; ?></div>
	<div id="headerType" class="smartbox_helper_div"><?php echo $headerType; ?></div>
	<?php 
		$bodyShadowEnabled = des_get_value(DESIGNARE_SHORTNAME."_body_shadow");
		if ($bodyShadowEnabled == "on"){
			?>
			<div id="bodyShadowColor" class="smartbox_helper_div"><?php echo "#".des_get_value(DESIGNARE_SHORTNAME."_body_shadow_color"); ?></div>
			<?php
		}
		$headerStyleType = get_option(DESIGNARE_SHORTNAME."_header_style_type");
		if (!is_404() && get_post_meta($post->ID, 'des_custom_header_style_value', true) == "on") $headerStyleType = get_post_meta($post->ID, 'headerStyleType_value', true);
	?>
	<div id="templatepath" class="smartbox_helper_div"><?php  echo get_template_directory_uri()."/"; ?></div>
	<div id="homeURL" class="smartbox_helper_div"><?php echo home_url(); ?>/</div>
	<div id="styleColor" class="smartbox_helper_div"><?php echo $smartbox_styleColor;?></div>	
	<div id="headerStyleType" class="smartbox_helper_div"><?php echo $headerStyleType; ?></div>
	
	<?php 
		if ($headerStyleType){
			switch($headerStyleType){
				case "style1":
				
					/* the original */
					if (des_get_value(DESIGNARE_SHORTNAME."_enable_top_panel") == "on") { 
					?>
		
						<div id="toppanel">
							<div class="toppanel_content">
							
								<div class="container content">
									<div class="trigger_toppanel_closer" onclick="$('#toppanel_trigger').click();">
										<div class="clicker">
											<div class="signal"></div>
										</div>
									</div>
														
									<?php 
									
										if (get_option(DESIGNARE_SHORTNAME."_enable_widgets_area") === "on"){
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "one"){ 
											?>
												<div class="sixteen columns"><?php print_sidebar('toppanel-one-column'); ?></div>
											<?php }
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "two"){ ?>
												<div class="eight columns"><?php print_sidebar('toppanel-two-column-left'); ?></div>
												<div class="eight columns"><?php print_sidebar('toppanel-two-column-right'); ?></div>
											<?php }
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "three"){
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_three"){ 
												?>
												<div class="one-third column"><?php print_sidebar('toppanel-three-column-left'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-center'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-right'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_two_three"){ ?>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-left-1_3'); ?></div>
													<div class="two-thirds column"><?php print_sidebar('toppanel-three-column-right-2_3'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "two_one_three"){ ?>
													<div class="two-thirds column"><?php print_sidebar('toppanel-three-column-left-2_3'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-right-1_3'); ?></div>
												<?php }
											}
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "four"){
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_four"){ 
												?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-center-left'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-center-right'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "two_one_two_four"){ ?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left-1_2_4'); ?></div>
													<div class="eight columns"><?php print_sidebar('toppanel-four-column-center-2_2_4'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right-1_2_4'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "three_one_four"){ ?>
													<div class="twelve columns"><?php print_sidebar('toppanel-four-column-left-3_4'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right-1_4'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_three_four"){ ?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left-1_4'); ?></div>
													<div class="twelve columns"><?php print_sidebar('toppanel-four-column-right-3_4'); ?></div>
												<?php }
											}		
										}
										
										if (des_get_value(DESIGNARE_SHORTNAME."_info_above_menu") === "on"){
											?>
										</div> <!-- fechar o anterior para ter a fullwidth -->	
											<?php
										} else {
											?>
									</div>
											<?php
										}
									
									?>
							</div>
						
						</div>
						
						
					
					<?php }
				
				
				
					break;
				case "style2": case "style3": case "style4":
				
					if (des_get_value(DESIGNARE_SHORTNAME."_enable_top_panel") == "on") { ?>
		
						<div id="toppanel">
							<div class="toppanel_content">
							
								<div class="container content">
									<div class="trigger_toppanel_closer" onclick="$('#toppanel_trigger').click();">
										<div class="clicker">
											<div class="signal"></div>
										</div>
									</div>				
									<?php 
									
										if (get_option(DESIGNARE_SHORTNAME."_enable_widgets_area") === "on"){
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "one"){ 
											?>
												<div class="sixteen columns"><?php print_sidebar('toppanel-one-column'); ?></div>
											<?php }
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "two"){ ?>
												<div class="eight columns"><?php print_sidebar('toppanel-two-column-left'); ?></div>
												<div class="eight columns"><?php print_sidebar('toppanel-two-column-right'); ?></div>
											<?php }
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "three"){
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_three"){ 
												?>
												
												<div class="one-third column"><?php print_sidebar('toppanel-three-column-left'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-center'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-right'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_two_three"){ ?>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-left-1_3'); ?></div>
													<div class="two-thirds column"><?php print_sidebar('toppanel-three-column-right-2_3'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "two_one_three"){ ?>
													<div class="two-thirds column"><?php print_sidebar('toppanel-three-column-left-2_3'); ?></div>
													<div class="one-third column"><?php print_sidebar('toppanel-three-column-right-1_3'); ?></div>
												<?php }
											}
											if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "four"){
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_four"){ ?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-center-left'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-center-right'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "two_one_two_four"){ ?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left-1_2_4'); ?></div>
													<div class="eight columns"><?php print_sidebar('toppanel-four-column-center-2_2_4'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right-1_2_4'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "three_one_four"){ ?>
													<div class="twelve columns"><?php print_sidebar('toppanel-four-column-left-3_4'); ?></div>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-right-1_4'); ?></div>
												<?php }
												if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_three_four"){ ?>
													<div class="four columns"><?php print_sidebar('toppanel-four-column-left-1_4'); ?></div>
													<div class="twelve columns"><?php print_sidebar('toppanel-four-column-right-3_4'); ?></div>
												<?php }
											}		
										}
										
									?>
								</div>
									
							</div>
						
						</div>
						
						
					
					<?php }
					
					break;
			}	
		}
		
	?>
	
	<div class="everything">
	
		<div class="header_container headerstyle-<?php echo $headerStyleType; ?>">
		
			<?php
				switch($headerStyleType){
					case "style2": case "style3":
						if (des_get_value(DESIGNARE_SHORTNAME."_info_above_menu") === "on"){
						?>
						<div class="fullwidth_container style-top-bar">
							<div class="container">
								<div class="info_above_menu">
								
									<div class="sixteen columns" style="float:left;top: 0; position:relative;">
									<?php
										$firstEl = false;
										if (get_option(DESIGNARE_SHORTNAME."_text_field_menu") != ""){
											?>
												<div class="textfield" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-info-sign"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_text_field_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										if (get_option(DESIGNARE_SHORTNAME."_telephone_menu") != ""){
											?>
												<div class="telephone" style="<?php $firstEl = true; ?>"><i class="icon-phone"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_telephone_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										
										if (get_option(DESIGNARE_SHORTNAME."_email_menu") != ""){
											?>
												<div class="email" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-envelope"></i>
													<a href="mailto:<?php _e(get_option(DESIGNARE_SHORTNAME."_email_menu"), "smartbox"); ?>"><?php _e(get_option(DESIGNARE_SHORTNAME."_email_menu"), "smartbox"); ?></a>
												</div>
											<?php
										} 
										
										if (get_option(DESIGNARE_SHORTNAME."_address_menu") != ""){
											?>
												<div class="address" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-map-marker"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_address_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										
									?>
										
									<?php 
										if (isset($woocommerce) && des_get_value(DESIGNARE_SHORTNAME."_woocommerce_shopping_cart") == "on"){ ?>
											<div class="smartbox_dynamic_shopping_bag">
						                
						                        <div class="smartbox_little_shopping_bag_wrapper">
						                            <div class="smartbox_little_shopping_bag">
						                                <div class="title">
										                	
										                	<i class="icon-shopping-cart"></i>
										                	
										                </div>
										                
										                <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'smartbox'), $woocommerce->cart->cart_contents_count); ?></span></div>
						                            </div>
						                            <div class="smartbox_minicart_wrapper">
						                                <div class="smartbox_minicart">
						                                <?php                                    
						                                echo '<ul class="cart_list">';                                        
						                                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
						                                    
						                                        $_product = $cart_item['data'];                                            
						                                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
						                                            echo '<li class="cart_list_product">';                                                
						                                                echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
						                                                echo '<div class="cart_list_product_title">';
						                                                    $smartbox_product_title = $_product->get_title();
						                                                    $smartbox_short_product_title = (strlen($smartbox_product_title) > 28) ? substr($smartbox_product_title, 0, 25) . '...' : $smartbox_product_title;
						                                                    echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $smartbox_short_product_title, $_product) . '</a>';
						                                                    echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'smartbox').' '.$cart_item['quantity'].'</div>';
						                                                echo '</div>';
						                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'smartbox') ), $cart_item_key );
						                                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
						                                                echo '<div class="clr"></div>';                                                
						                                            echo '</li>';                                         
						                                        endif;                                        
						                                    endforeach;
						                                    ?>
						                                            
						                                    <div class="minicart_total_checkout">                                        
						                                        <?php _e('Cart subtotal', 'smartbox'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
						                                    </div>
						                                    
						                                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button smartbox_minicart_cart_but"><?php _e('View Shopping Bag', 'smartbox'); ?></a>   
						                                    
						                                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button smartbox_minicart_checkout_but"><?php _e('Proceed to Checkout', 'smartbox'); ?></a>
						                                    
						                                    <?php                                        
						                                    else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;                                    
						                                echo '</ul>';                                    
						                                ?>                                                                        
						                
						                                </div>
						                            </div>
						                            
						                        </div>
						                        
						                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="smartbox_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
						                    
						                    </div>
						                    <?php
										}
										
										/* wpml selector */
										if (des_get_value(DESIGNARE_SHORTNAME."_wpml_menu_widget") == "on") { ?>
											<div class="menu_wpml_widget">
												<?php if (function_exists('icl_object_id')) do_action('icl_language_selector'); ?>
											</div>
										<?php
										}
										
										/* top bar menu */
										if (des_get_value(DESIGNARE_SHORTNAME."_top_bar_menu") == "on"){
											?>
											<div class="top-bar-menu">
												<?php wp_nav_menu( array( 'theme_location' => 'topbarnav', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_top_bar' )); ?>
											</div>
											<?php
										}
																			
										/* woocommerce menu */
										if (des_get_value(DESIGNARE_SHORTNAME."_woocommerce_menu") == "on"){
											?>
											<div class="woocommerce-menu">
												<?php wp_nav_menu( array( 'theme_location' => 'woonav', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_woo_commerce' )); ?>
											</div>
											<?php
										}
										/* socials */
										if (get_option(DESIGNARE_SHORTNAME."_enable_socials") === "on"){
											$iconstyle = des_get_value(DESIGNARE_SHORTNAME."_social_icons_style");
											if (empty($iconstyle)) $iconstyle = des_get_value(DESIGNARE_SHORTNAME."_social_icons_style option:selected");
											?>
												<div class="socialdiv<?php if ($iconstyle === "dark") echo "-dark"; ?>" style="float:right;">
													<ul>
														<?php
															$icons = array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("forrst","Forrst"),array("stumble","Stumble"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google","Google"),array("vimeo","Vimeo"),array("picasa","Picasa"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("myspace","MySpace"),array("blogger","Blogger"),array("wordpress","Wordpress"),array("grooveshark","GrooveShark"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"),array("yelp","Yelp"), array("foursquare","Foursquare"), array("xing","Xing"));
															foreach ($icons as $i){
																if (get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]) != ""){
																?>
																<li>
																	<a href="<?php echo get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]); ?>" target="_blank" class="<?php echo $i[0]; ?>" title="<?php echo $i[1]; ?>"></a>
																</li>
																<?php
																}
															}
														?>
													</ul>
												</div>
											
											<?php
										}
									
									?>
									
															
									</div>						
									
								</div>
							</div>
						</div>
						<?php
					}	
					break;
					
					case "style4":
						if (des_get_value(DESIGNARE_SHORTNAME."_info_above_menu") === "on"){
						?>
						<div class="fullwidth_container style-top-bar">
							<div class="container" style="min-height: 44px;">
								<div class="info_above_menu">
								
									<div class="sixteen columns" style="float:left;top: 0; position:relative;">
									<?php
										$firstEl = false;
										if (get_option(DESIGNARE_SHORTNAME."_text_field_menu") != ""){
											?>
												<div class="textfield" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-info-sign"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_text_field_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										if (get_option(DESIGNARE_SHORTNAME."_telephone_menu") != ""){
											?>
												<div class="telephone" style="<?php $firstEl = true; ?>"><i class="icon-phone"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_telephone_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										
										if (get_option(DESIGNARE_SHORTNAME."_email_menu") != ""){
											?>
												<div class="email" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-envelope"></i>
													<a href="mailto:<?php _e(get_option(DESIGNARE_SHORTNAME."_email_menu"), "smartbox"); ?>"><?php _e(get_option(DESIGNARE_SHORTNAME."_email_menu"), "smartbox"); ?></a>
												</div>
											<?php
										} 
										
										if (get_option(DESIGNARE_SHORTNAME."_address_menu") != ""){
											?>
												<div class="address" style="<?php if (!$firstEl){ $firstEl = true; } ?>"><i class="icon-map-marker"></i>
													<?php _e(get_option(DESIGNARE_SHORTNAME."_address_menu"), "smartbox"); ?>
												</div>
											<?php
										}
										
									?>
									
									<?php 
										if (isset($woocommerce) && des_get_value(DESIGNARE_SHORTNAME."_woocommerce_shopping_cart") == "on"){ ?>
											<div class="smartbox_dynamic_shopping_bag">
						                
						                        <div class="smartbox_little_shopping_bag_wrapper">
						                            <div class="smartbox_little_shopping_bag">
						                                <div class="title">
										                	
										                	<i class="icon-shopping-cart"></i>
										                	
										                </div>
										                
										                <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'smartbox'), $woocommerce->cart->cart_contents_count); ?></span></div>
						                            </div>
						                            <div class="smartbox_minicart_wrapper">
						                                <div class="smartbox_minicart">
						                                <?php                                    
						                                echo '<ul class="cart_list">';                                        
						                                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
						                                    
						                                        $_product = $cart_item['data'];                                            
						                                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
						                                            echo '<li class="cart_list_product">';                                                
						                                                echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
						                                                echo '<div class="cart_list_product_title">';
						                                                    $smartbox_product_title = $_product->get_title();
						                                                    $smartbox_short_product_title = (strlen($smartbox_product_title) > 28) ? substr($smartbox_product_title, 0, 25) . '...' : $smartbox_product_title;
						                                                    echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $smartbox_short_product_title, $_product) . '</a>';
						                                                    echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'smartbox').' '.$cart_item['quantity'].'</div>';
						                                                echo '</div>';
						                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'smartbox') ), $cart_item_key );
						                                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
						                                                echo '<div class="clr"></div>';                                                
						                                            echo '</li>';                                         
						                                        endif;                                        
						                                    endforeach;
						                                    ?>
						                                            
						                                    <div class="minicart_total_checkout">                                        
						                                        <?php _e('Cart subtotal', 'smartbox'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
						                                    </div>
						                                    
						                                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button smartbox_minicart_cart_but"><?php _e('View Shopping Bag', 'smartbox'); ?></a>   
						                                    
						                                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button smartbox_minicart_checkout_but"><?php _e('Proceed to Checkout', 'smartbox'); ?></a>
						                                    
						                                    <?php                                        
						                                    else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;                                    
						                                echo '</ul>';                                    
						                                ?>                                                                        
						                
						                                </div>
						                            </div>
						                            
						                        </div>
						                        
						                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="smartbox_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
						                    
						                    </div>
						                <?php
										}
										
										/* wpml selector */
										if (des_get_value(DESIGNARE_SHORTNAME."_wpml_menu_widget") == "on") { ?>
											<div class="menu_wpml_widget">
												<?php if (function_exists('icl_object_id')) do_action('icl_language_selector'); ?>
											</div>
										<?php
										}
										
										/* top bar menu */
										if (des_get_value(DESIGNARE_SHORTNAME."_top_bar_menu") == "on"){
											?>
											<div class="top-bar-menu">
												<?php wp_nav_menu( array( 'theme_location' => 'topbarnav','container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_top_bar' )); ?>
											</div>
											<?php
										}
																			
										/* woocommerce menu */
										if (des_get_value(DESIGNARE_SHORTNAME."_woocommerce_menu") == "on"){
											?>
											<div class="woocommerce-menu">
												<?php wp_nav_menu( array( 'theme_location' => 'woonav','container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_woo_commerce' )); ?>
											</div>
											<?php
										}
									
									?>
									
									</div>						
									
								</div>
							</div>
						</div>
						<?php
					}
					break;
				}
			?>
		
			<header id="header" class="container">
						
				<div class="logo_and_menu">
				
					<div class="logo columns" style="<?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) echo "margin-top: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) . ";"; ?> margin-left: 0px;">
						<h1><a href="<?php echo home_url(); ?>" tabindex="-1">
							<?php 
				    			
				    			if(get_option(DESIGNARE_SHORTNAME."_logo_type") == "text"){
				    				?>
				    					<h1 class="logo" style="<?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) echo "left: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) . ";"; ?> 
				    						<?php echo "background: none;";  ?>
				    						<?php
												if (get_option(DESIGNARE_SHORTNAME."_logo_font")){
											 		$font = get_option(DESIGNARE_SHORTNAME."_logo_font");
											 		if ($font == "Helvetica" || $font == "Helvetica Neue") echo "font-family:'$font', Arial, sans-serif;";
											 		else echo "font-family:'$font';";
										 		}
											?>
				    						<?php 
				    						if (get_option(DESIGNARE_SHORTNAME."_logo_font_style") != ""){
				    							$styles = explode(',', get_option(DESIGNARE_SHORTNAME."_logo_font_style"));
													foreach ($styles as $style){
														switch($style){
															case "italic": 
																echo "font-style: italic; ";
																break;
															case "bold": 
																echo "font-weight: bold; ";
																break;
															case "underline": 
																echo "text-decoration: underline; ";
																break;
														}
													}  
											}?>
												<?php echo "font-size: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_size")) . ";";  ?>
												<?php echo "color: #" . get_option(DESIGNARE_SHORTNAME."_logo_color") . ";";  ?>
											
				    					"><?php echo get_option(DESIGNARE_SHORTNAME."_logo_text"); ?></h1>
				    				<?php
				    			} else {
					    				$alone = true;
					    				if (get_option(DESIGNARE_SHORTNAME."_logo_retina_image_url") != ""){
						    				$alone = false;
					    				}
				    			
				    				?>
				    					<img class="logo_normal <?php if (!$alone) echo "notalone"; ?>" style="position: relative; <?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) echo "margin-top: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) . ";margin-bottom: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) . ";"; ?> <?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) echo "margin-left: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) . ";"; if(get_option(DESIGNARE_SHORTNAME."_logo_height")) echo "max-height:" . get_option(DESIGNARE_SHORTNAME."_logo_height") . ";"; ?>" src="<?php echo get_option(DESIGNARE_SHORTNAME."_logo_image_url"); ?>" alt="<?php _e("", "smartbox"); ?>" title="<?php _e("", "smartbox"); ?>">
				    					
				    				<?php 
				    					if (get_option(DESIGNARE_SHORTNAME."_logo_retina_image_url") != ""){
					    				?>
						    				<img class="logo_retina" style="display:none; position: relative; <?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) echo "margin-top: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")) . ";"; ?> <?php if(get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) echo "margin-left: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_left")) . ";"; if(get_option(DESIGNARE_SHORTNAME."_logo_height")) echo "max-height:" . get_option(DESIGNARE_SHORTNAME."_logo_height") . ";"; ?>" src="<?php echo get_option(DESIGNARE_SHORTNAME."_logo_retina_image_url"); ?>" alt="<?php _e("", "smartbox"); ?>" title="<?php _e("", "smartbox"); ?>">
					    				<?php
				    					}
				    			}
				    			
				    		?>
	
						
						</a></h1>
						
						<?php 
	    			
		    			if(get_option(DESIGNARE_SHORTNAME."_slogan") == "on"){
		    				?>
		    					<div class="slogan" style="
		    						<?php echo "background: none;";  ?>
		    						<?php
										if (get_option(DESIGNARE_SHORTNAME."_slogan_font")){
									 		$font = get_option(DESIGNARE_SHORTNAME."_slogan_font");
									 		if ($font == "Helvetica" || $font == "Helvetica Neue") echo "font-family:'$font', Arial, sans-serif;";
									 		else echo "font-family:'$font';";
									 	}
									?>
		    						<?php
		    							if (get_option(DESIGNARE_SHORTNAME."_slogan_font_style") != "" && !is_array(get_option(DESIGNARE_SHORTNAME."_slogan_font_style"))){
			    							$styles = explode(',', get_option(DESIGNARE_SHORTNAME."_slogan_font_style"));
											foreach ($styles as $style){
												switch($style){
													case "italic": 
														echo "font-style: italic; ";
														break;
													case "bold": 
														echo "font-weight: bold; ";
														break;
													case "underline": 
														echo "text-decoration: underline; ";
														break;
												}
											} 	
		    							}
										?>
										<?php echo "font-size: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_slogan_size")) . ";";  ?>
										<?php echo "color: #" . get_option(DESIGNARE_SHORTNAME."_slogan_color") . ";";  ?>
										<?php
											if(get_option(DESIGNARE_SHORTNAME."_logo_height")) {
												$halfheight = intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_height")))/2 - 5;
												echo "margin-top: " . $halfheight ."px;";
											}
										?>
		    					"><?php echo get_bloginfo( 'description' ); ?></div>
		    				<?php
		    			}
		    			
		    		?>
					</div>
				
				
				<?php 
					if ($headerStyleType !== "style4"){
						?>
							<nav id="menu" class="columns">
							
							<?php
								if (des_get_value(DESIGNARE_SHORTNAME."_enable_top_panel") == "on"){
									?>
									<div class="trigger_toppanel_closer" onclick="$(this).siblings('#toppanel_trigger').click();">
										<div class="clicker">
											<div class="signal"></div>
										</div>
									</div>
									<div id="toppanel_trigger">
										<div class="signal"></div>
									</div>	
									<?php
								}
										
								/* search gizmo */	
								if (des_get_value(DESIGNARE_SHORTNAME."_search_menu_widget") == "on") {
									$firstEl = false;
								
								?>
									 <form method="get" id="searchform_top" action="<?php echo home_url( '/' ); ?>">
										<?php
											$msie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false;
											if ($msie){
												?>
												<input type="text" value="" class="field" name="s" id="s_top"  placeholder=""	 />
												<?php
											} else {
												?>
												<input type="text" value="" class="field closed" name="s" id="s_top"  placeholder="<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>" onfocus="this.value = this.value;"/>
												<?php
											}
										?>
								    </form>
								    
								    <script type="text/javascript">
									    jQuery(document).ready(function(){
										    jQuery('#searchform_top').click(function(){
											    jQuery('#s_top').focus();
											    jQuery('#s_top').click();
										    });
										    
										    jQuery('#s_top').click(function(e){
											    e.preventDefault();
											    e.stopPropagation();
											    if (jQuery(this).val() == "" || jQuery(this).val() == "<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>"){
												    jQuery(this).val('');
											    }
											}).blur(function(){ 
												if (jQuery(this).val() == "" || jQuery(this).val() == "<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>"){
												    jQuery(this).val('');
											    }
											});
									    });
								    </script>
								    
								    <?php
								}
							?>
													
							<!-- Start Menu -->
							<?php wp_nav_menu( array( 'theme_location' => 'primary-navigation', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menulava' ) ); 
							?>
												
							<div id="dl-menu" class="dl-menuwrapper">
								<button class="dl-trigger"><?php _e(get_option(DESIGNARE_SHORTNAME."_open_menu"),"smartbox"); ?></button>
								<?php wp_nav_menu( array( 'theme_location' => 'primary-navigation', 'container' => false, 'menu_class' => 'dl-menu' ) ); 
							?>
							</div> 
							<!-- End Menu -->
						</nav>
						
						
						<?php
					} else {
						?> <div class=" style4" style="
						<?php
							if(get_option(DESIGNARE_SHORTNAME."_logo_height")) {
								$halfheight = intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_height")))/2 - 5;
								echo "margin-top: " . $halfheight ."px;";
							}
						?>"> <?php
						
						if (des_get_value(DESIGNARE_SHORTNAME."_enable_top_panel") == "on"){
							?>
							<div class="trigger_toppanel_closer" onclick="$(this).siblings('#toppanel_trigger').click();">
								<div class="clicker">
									<div class="signal"></div>
								</div>
							</div>
							<div id="toppanel_trigger">
								<div class="signal"></div>
							</div>	
							<?php
						}
						
						/* search gizmo */	
						if (des_get_value(DESIGNARE_SHORTNAME."_search_menu_widget") == "on") {
							$firstEl = false;
						
						?>
							 <form method="get" id="searchform_top" action="<?php echo home_url( '/' ); ?>">
								<?php
									$msie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false;
									if ($msie){
										?>
										<input type="text" value="" class="field" name="s" id="s_top"  placeholder=""	 />
										<?php
									} else {
										?>
										<input type="text" value="<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>" class="field closed" name="s" id="s_top"  placeholder="" onfocus="this.value = this.value;"/>
										<?php
									}
								?>
						    </form>
						    
						    <script type="text/javascript">
							    jQuery(document).ready(function(){
								    jQuery('#searchform_top').click(function(){
									    jQuery('#s_top').focus();
									    jQuery('#s_top').click();
								    });
								    
								    jQuery('#s_top').click(function(e){
									    e.preventDefault();
									    e.stopPropagation();
									    if (jQuery(this).val() == "" || jQuery(this).val() == "<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>"){
										    jQuery(this).val('');
									    }
									}).blur(function(){
										if (jQuery(this).val() == "" || jQuery(this).val() == "<?php _e(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>"){
										    jQuery(this).val('');
									    }
									});
							    });
						    </script>
						    
						    
						<?php
						}
						
						/* socials */
						if (get_option(DESIGNARE_SHORTNAME."_enable_socials") === "on"){
							$iconstyle = des_get_value(DESIGNARE_SHORTNAME."_social_icons_style_four");
							if (empty($iconstyle)) $iconstyle = des_get_value(DESIGNARE_SHORTNAME."_social_icons_style_four option:selected");
							?>
								<div class="socialdiv<?php if ($iconstyle === "dark") echo "-dark"; ?>" style="float:right;">
									<ul>
										<?php
											$icons = array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("forrst","Forrst"),array("stumble","Stumble"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google","Google"),array("vimeo","Vimeo"),array("picasa","Picasa"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("myspace","MySpace"),array("blogger","Blogger"),array("wordpress","Wordpress"),array("grooveshark","GrooveShark"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"), array("foursquare","Foursquare"), array("xing","Xing"));
											foreach ($icons as $i){
												if (get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]) != ""){
												?>
												<li>
													<a href="<?php echo get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]); ?>" target="_blank" class="<?php echo $i[0]; ?>" title="<?php echo $i[1]; ?>"></a>
												</li>
												<?php
												}
											}
										?>
									</ul>
								</div>
							
							<?php
						}
						
						?> </div> <?php
					}
				?>
				
				</div>
			</header>
			
			
			<?php
				if ($headerStyleType === "style4"){
					?>
					
					<div class="fullwidth_container fullwidth_container_menu">
						<div class="container">
						
							
						
							<!-- Start Menu -->
							<?php wp_nav_menu( array( 'theme_location' => 'primary-navigation', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menulava' ) ); 
							?>
							
							<div id="dl-menu" class="dl-menuwrapper">
								<button class="dl-trigger"><?php _e(get_option(DESIGNARE_SHORTNAME."_open_menu"),"smartbox"); ?></button>
								<?php wp_nav_menu( array( 'theme_location' => 'primary-navigation', 'container' => false, 'menu_class' => 'dl-menu' ) ); 
							?>
							</div>  
							<!-- End Menu -->
						</div>
					</div>
					
					
					<?php
				}
			?>
			
			<div class="header-shadow" 
				<?php
					if ($smartbox_custom == "on"){
						$type = get_post_meta($post->ID, 'headerType_value', true);
						if ($type == "border") echo " style='display:none;'";	
						$hs = get_post_meta($post->ID, 'headerShadow_value', true); 
						if ($hs == "off") echo "style='display:none;'"; 
					} else {
						$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
						if ($type == "border") echo " style='display:none;'";
						$hs = get_option(DESIGNARE_SHORTNAME."_header_shadow");
						if ($hs == "off") echo "style='display:none;'"; 
					}	
				?>
			></div>
		</div>

	
	
	
	<?php 
		
		if ( is_page_template('template-home.php') ) get_template_part("homeslider", "header");
		else{ 
			
		?>
			
			<div id="header_bg"></div>
		
		<?php
			
		}
		
		$printheader = des_get_value(DESIGNARE_SHORTNAME."_header_type");
		
		if ($printheader === "without"){
			echo "<style>.fullwidth-container{display:none;}</style>";		
			?>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						$('.fullwidth-container').css('display','none');
						$('.header-shadow').css('display','none');
					});
				</script>
			<?php
		}
	?>
	