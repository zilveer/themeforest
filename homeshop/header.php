<!DOCTYPE html>


<!--[if IE 7]>
<html class="ie ie7  no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8  no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gte IE 9]>
<html class="ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE) ]><!-->
<html class="not-ie no-js"  <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' );?>" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php wp_title( '|', true, 'right' ); ?></title>


	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	
	<!--[if IE 9]>
			<link rel="stylesheet" href="css/ie9.css">
	<![endif]-->
	
	 <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
			<link rel="stylesheet" href="css/ie.css">
        <![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fontello-ie7.css">
		<![endif]-->




</head>

<?php
if (is_user_logged_in()) {
    echo '<script type="text/javascript">var logged_in=true;</script>';
} else {
    echo '<script type="text/javascript">var logged_in=false;</script>';
}
?>
<?php
$bg_image = get_template_directory_uri() .'/img/background.jpg';
$bg_color = '#7fcae8';
$color_top = '#e0f2f6';
$color_bottom = '#dde3e6';
$op = '1';
$header_style = 'style1';

$bg_image_repeat = 'no-repeat';
$bg_image_attachment = 'fixed';

	if(get_option('sense_settings_background_attachment') != '') {
	$bg_image_attachment = get_option('sense_settings_background_attachment');
	}
	
	if(get_option('sense_settings_bg_repeat') != '') {
	$bg_image_repeat = get_option('sense_settings_bg_repeat');
	}
	
	
	if(get_option('sense_style_header') != '') {
	$header_style = get_option('sense_style_header');
	}



	echo '<style type="text/css" >';

	if(get_option('sense_bg_image_homeshop') != '') {
	$bg_image = get_option('sense_bg_image_homeshop');
	}
	if(get_option('sense_bg_main_color') != '') {
	$bg_color = get_option('sense_bg_main_color');
	}

	if(get_option('sense_settings_bg') == 'show_all' || get_option('sense_settings_bg') == '') {
	echo 'body{background:'. $bg_color .'  url("'. esc_url($bg_image) .'")  '. esc_attr($bg_image_repeat) .' '. esc_attr($bg_image_attachment) .'; }';   
	}
    if(get_option('sense_settings_bg') == 'show_color' ) {
	echo 'body{background-color:'. esc_attr($bg_color) .' !important; }';
	}
	if(get_option('sense_settings_bg') == 'show_img' ) {
	echo 'body{background-image:url("'. esc_url($bg_image) .'");background-repeat:'. esc_attr($bg_image_repeat) .';background-attachment:'. esc_attr($bg_image_attachment) .';}';  
	}



	if(get_option('sense_bg_top_color') != '') {
	 $color_top = get_option('sense_bg_top_color');
	 }
	if(get_option('sense_bg_bottom_color') != '') {
	 $color_bottom = get_option('sense_bg_bottom_color');
	 }
	if(get_option('sense_bg_opacity') != '') {
	 $op = get_option('sense_bg_opacity');
	 }


	$color_top = homeshop_hex2rgb($color_top, $op);
	$color_bottom = homeshop_hex2rgb($color_bottom, $op);


	echo ' body .container {
		background: '. esc_attr($color_top) .';
		background: -moz-linear-gradient(top, '. esc_attr($color_top) .' 82%, '. esc_attr($color_bottom) .' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(82%,'. esc_attr($color_top) .'), color-stop(100%,'. $color_bottom .'));
		background: -webkit-linear-gradient(top, '. esc_attr($color_top) .' 82%,'. esc_attr($color_bottom) .' 100%);
		background: -o-linear-gradient(top, '. esc_attr($color_top) .' 82%,'. esc_attr($color_bottom) .' 100%);
		background: -ms-linear-gradient(top, '. esc_attr($color_top) .' 82%,'. esc_attr($color_bottom) .' 100%);
		background: linear-gradient(to bottom, '. esc_attr($color_top) .' 82%,'. esc_attr($color_bottom) .' 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'. esc_attr($color_top) .'", endColorstr="'. esc_attr($color_bottom) .'",GradientType=0 );
		}';



	echo '</style>';

?>


<?php
	wp_head();
?>









<body <?php body_class(); ?> >


<div class="pp_overlay" style="opacity: 0.8; height: 100%; width: 100%; display: none;"></div>


<!--==============================header=================================-->
<!-- Container -->
	<div class="container ">
		<!-- Header -->
		<header class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<!-- Top Header -->
				<div id="top-header" class="<?php echo $header_style; ?>">

						<div class="row">

							<?php
							global $woocommerce;
							$alignmenu_top = 'pull-left';
							$class_top_navigation = 'col-lg-7 col-md-7 col-sm-7';
							if ( $header_style == 'style2' )
							{
							$alignmenu_top = 'pull-right';
							$class_top_navigation = 'col-lg-12 col-md-12 col-sm-12';
							}
							?>

							<nav id="top-navigation" class="<?php echo esc_attr($class_top_navigation); ?>">

							<?php
							if (has_nav_menu('top_navigation')) :
								wp_nav_menu( array(
								'theme_location' => 'top_navigation',
								 'container' => false,
								 'menu_class' => esc_attr($alignmenu_top),
								 'menu_id' => 'menu-top',
								 'echo' => true,
								 'depth' => 0,
								 'fallback_cb'=> ''
								 ));
								endif;

							$accountPage = '';
							$search_type = '';
							if( is_shop_installed() ) {
							$search_type == 'product';
							$accountPage = esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') ));
							} else {
							$search_type = 'post';
							$accountPage = esc_url(wp_login_url());
							}
							?>
							</nav>



							<?php
							if ( $header_style != 'style2' )
							{
							?>

							<nav class="col-lg-5 col-md-5 col-sm-5">
								<ul class="pull-right">


							<?php
							if ( $header_style == 'style3' || $header_style == 'style6' )
							{
							
								if(function_exists( 'icl_get_languages' )  && function_exists( 'icl_disp_language' ) ){
								$languages = icl_get_languages('skip_missing=0&orderby=code');
								}
								
								if(!empty($languages)){
							?>
							<li>
							<a class="flag" href="#">

								<?php
								 foreach($languages as $l){
									if($l['active']) {
									if($l['country_flag_url']){
										echo '<img src="'. esc_url($l['country_flag_url']) .'" height="12" alt="'. esc_attr($l['language_code']) .'" width="18" />';
									}
									echo icl_disp_language($l['native_name'], $l['translated_name']);
									}

								}
								?>
							<i class="icons icon-down-dir"></i>
							</a>


								<ul class="box-dropdown parent-arrow">
									<li>
										<div class="box-wrapper no-padding parent-border">



											<?php
											wpml_languages_list();
											?>


										</div>
									</li>
								</ul>

							</li>
							<?php
							}
							?>


							<?php
							$currency = '';
							if(function_exists( 'get_woocommerce_currency' )){
							$currency = get_woocommerce_currency();
							}
							
							if ( $currency != '' ) {
							?>
							<li>
								<a href="#">


								<?php
								if(isset( $_COOKIE['woocommerce_current_currency'] ) && $_COOKIE['woocommerce_current_currency'] != '') {
								$currency = $_COOKIE['woocommerce_current_currency'];
								}
								$label = get_woocommerce_currency_symbol( $currency ).' '.$currency;
								echo $label;
								?>
								<i class="icons icon-down-dir"></i>
								</a>

								<ul class="box-dropdown parent-arrow">
									<li>
										<div class="box-wrapper no-padding parent-border">
										<?php dynamic_sidebar( 'Currency Converter Sidebar' ); ?>
										</div>
									</li>
								</ul>
							</li>
							<?php
							}
							?>




							<?php
							}
							?>

								<?php
								if ( $header_style == 'style1' || $header_style == 'style4' || $header_style == 'style5' || $header_style == 'style6' )
								{

								if ( !is_user_logged_in() ) { ?>
									<li class="purple"><a href="#"><i class="icons icon-user-3"></i> <?php _e( 'Login', 'homeshop' ); ?></a>
										<ul id="login-dropdown" class="box-dropdown">
											<li>
                                            	<div class="box-wrapper">
													<h4><?php _e( 'LOGIN', 'homeshop' ); ?></h4>
													
													<form action="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" method="post"  class="login" name="loginform">
													
														<?php do_action( 'woocommerce_login_form_start' ); ?>
														
														<div class="iconic-input">
															<input id="username" name="username"  type="text" tabindex="10" placeholder="<?php _e( 'Username', 'homeshop' ); ?>">
															<i class="icons icon-user-3"></i>
														</div>
														<div class="iconic-input">
															<input id="password" name="password"  type="password" tabindex="20" placeholder="<?php _e( 'Password', 'homeshop' ); ?>">
															<i class="icons icon-lock"></i>
														</div>
														
														<?php //do_action( 'woocommerce_login_form' ); ?>

		<input name="rememberme" tabindex="90" type="checkbox" id="rememberme" value="forever" style="display:none;">
		<label for="rememberme"> <?php _e( 'Remember Me', 'homeshop' ); ?></label>

														<br>
														<br>
														<div class="pull-left">	

		<?php wp_nonce_field( 'woocommerce-login' ); ?>											
		<input type="submit" name="login" class="orange" value="<?php _e( 'LOGIN', 'homeshop' ); ?>" />
		

														</div>
														<div class="pull-right">
															<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot your password?', 'homeshop' ); ?></a>
															<br>
															<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot your username?', 'homeshop' ); ?></a>
															<br>
														</div>
														<br class="clearfix">
														
														<?php do_action( 'woocommerce_login_form_end' ); ?>
													</form>
                                                </div>

												<div class="footer">
													<h4 class="pull-left"><?php _e( 'NEW CUSTOMER?', 'homeshop' ); ?></h4>
													<a class="button pull-right" href="<?php echo esc_url($accountPage); ?>"><?php _e( 'Create an account', 'homeshop' ); ?></a>
												</div>

											</li>
										</ul>
									</li>

									<?php } else {
									$current_user1 = wp_get_current_user();
									?>
									<li class="purple">
										<a href="<?php echo esc_url(wp_logout_url( homeShop_curPageURL() )); ?>">
											<i class="icons icon-user-3"></i> <?php _e('Logout', 'homeshop'); ?>
										</a>
									</li>
									<?php
									}
									?>


									<?php
									}
									?>

								</ul>
							</nav>


							<?php
							}
							?>

						</div>

				</div>
				<!-- /Top Header -->

				<!-- Main Header -->
				<div id="main-header">

					<div class="row">

						<div id="logo" class="col-lg-4 col-md-4 col-sm-12">
						<?php if(get_option('sense_settings_logo') == 'show_image')
							{
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" style="" >
							   <img class="logo_img" alt="Logo" src="<?php echo esc_url(get_option('sense_logo_image_loft')); ?>"/>
							</a>
						<?php } else { 
						$logo_text = get_bloginfo('name');
							if(get_option('sense_logo_text_loft') && get_option('sense_logo_text_loft') != '') {
								$logo_text = get_option('sense_logo_text_loft');
							}
						?>
							<h1>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
								<?php echo $logo_text;  ?>
								</a>
							</h1>
						<?php } ?>
						</div>

						
						
						<?php if(get_option('sense_show_header_info') == 'show') { ?>
						<div id="header_text" class="col-lg-3 col-md-3 col-sm-12">
					
							<?php echo get_option('sense_header_text');  ?>
							
						</div>
						<?php } ?>
						
						
						
						<?php 
					
						$items_title = __('Items', 'homeshop');
						
						 ?>
						<nav id="middle-navigation" class="
						<?php if(get_option('sense_show_header_info') == 'show') { ?>
						col-lg-5 col-md-5
						<?php } else { ?>
						col-lg-8 col-md-8
						<?php } ?>
						 col-sm-12">
							<ul class="pull-right">
									
									<?php 
									if(get_option('sense_show_compare') != '' && get_option('sense_show_compare') != 'hide'  && is_shop_installed() && class_exists('WC_Compare_Functions')) { ?> 
									<li class="blue top_compare" id="compare_button">
										<a id="top_compare_basket" href="<?php echo esc_url(get_option('sense_link_compare')); ?>"><i class="icons icon-docs"></i>
										
										
										<?php echo sprintf( _n( '%s Item', '%s Items', max(WC_Compare_Functions::get_total_compare_list(), 1), 'homeshop' ), number_format_i18n(WC_Compare_Functions::get_total_compare_list()) ); ?>
										
										</a>
                                    </li>

									<?php } ?> 
									
									
									<?php if(get_option('sense_show_wishlist') != '' && get_option('sense_show_wishlist') != 'hide'  && is_shop_installed() && class_exists( 'YITH_WCWL_Shortcode' )) { 
									
									?> 
									
									<li class="red top_wishlist">
										<a id="top_wishlist_basket" href="<?php echo esc_url(get_option('sense_link_wishlist')); ?>"><i class="icons icon-heart-empty"></i>
										<?php
										global $wpdb, $yith_wcwl, $woocommerce, $_SESSION;

										if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
											$user_id = $_GET['user_id'];
										} elseif( is_user_logged_in() ) {
											$user_id = get_current_user_id();
										}

										$limit_sql = '';
										$count_wishlist = '0';
										$wishlist = '';
										if( is_user_logged_in() )
											{
											$wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A );

											}

										elseif( yith_usecookies() )
											{ $wishlist = yith_getcookie( 'yith_wcwl_products' ); }
										else
											{ 
												if(!empty($_SESSION['yith_wcwl_products'])) {
												$wishlist = $_SESSION['yith_wcwl_products']; 
												}
										}


										$count_wishlist = 0 + count( $wishlist );
										if(!$count_wishlist){
											$count_wishlist = $yith_wcwl->count_products();
											}
										?>
										
										<?php echo sprintf( _n( '%s Item', '%s Items', max($count_wishlist, 1), 'homeshop' ), number_format_i18n($count_wishlist) ); ?>
									
										</a>
                                    </li>
									<?php } ?> 
									

									<?php if(get_option('sense_show_cart') != '' && get_option('sense_show_cart') != 'hide' && is_shop_installed() ) { ?> 				
			
									<li class="orange top_cart" id="top_cart_list">
									<a  class="top_cart_a" id="top_cart_basket" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icons icon-basket-2"></i>
									
									
									<?php echo sprintf( _n( '%s Item', '%s Items', max($woocommerce->cart->cart_contents_count, 1), 'homeshop' ), number_format_i18n($woocommerce->cart->cart_contents_count) ); ?>

									
									</a>

										<?php if (sizeof($woocommerce->cart->cart_contents)>0) :?>
										<ul id="cart-dropdown" class="box-dropdown parent-arrow" id="cart_drop_down">
											<li>






			<form action="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" method="post"  id="cart_form" class="cart_form">
            <div class="box-wrapper parent-border">
			
			<p class="cart-info"><?php _e('Recently added item(s)', 'homeshop'); ?></p>

				<table class="cart-table">
                    <?php
                    if (sizeof($woocommerce->cart->get_cart()) > 0) {
                        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
                            $_product = $values['data'];
                            ?>
							<tr>
								<td class="product_image">
									<?php
									$thumbnail = apply_filters('woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key);

									if (!$_product->is_visible() || (!empty($_product->variation_id) && !$_product->parent_is_visible() ))
										echo $thumbnail;
									else
										printf('<a href="%s">%s</a>', esc_url(get_permalink(apply_filters('woocommerce_in_cart_product_id', $values['product_id']))), $thumbnail);
									?>
								</td>

								<td class="product_desc">
									<h6><?php echo esc_html($_product->get_title()); ?></h6>
									<p><?php _e( 'Product code', 'homeshop' ) ?> <?php echo ( $sku = $_product->get_sku() ) ? $sku : __( 'n/a', 'homeshop' ); ?></p>
								</td>

								<td class="product_quantity">
								<span class="quantity"><span class="light"><?php echo  $values['quantity'] ?> x</span> <?php
							    echo apply_filters('woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal($_product, $values['quantity']), $values, $cart_item_key);
									?>
								</span>

								<?php
									echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="delete parent-color" title="%s">%s</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), __('Remove', 'homeshop'), __('Remove', 'homeshop')), $cart_item_key);
								?>

								</td>

							</tr>

                            <?php
                        }
                    }
                    ?>

                </table>
				<br class="clearfix">
			</div>

			<div class="footer">
				<table class="checkout-table pull-right">

					<tr>
						<td class="align-right"><strong><?php _e( 'Total', 'homeshop' ) ?>:</strong></td>
						<td><strong class="parent-color"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></strong></td>
					</tr>



				</table>
			</div>

			<div class="box-wrapper no-border">
				<a class="button pull-right parent-background" href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>"><?php _e( 'Checkout', 'homeshop' ) ?></a>
				<a class="button pull-right" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><?php _e( 'View Cart', 'homeshop' ) ?></a>
			</div>

            </form>


											</li>
										</ul>
										<?php endif; ?>

                                    </li>
									<?php } ?>		
									
									
									

						<?php
						if ( $header_style == 'style1' || $header_style == 'style5' )
						{
						
							 if(function_exists( 'icl_get_languages' )  && function_exists( 'icl_disp_language' ) ){
							$languages = icl_get_languages('skip_missing=0&orderby=code');
							}
							
							  if(!empty($languages) && get_option('sense_show_languages') != '' && get_option('sense_show_languages') != 'hide'){
						?>

						<li class="top_languages" ><a class="flag" href="#">
						<?php
							 foreach($languages as $l){
								if($l['active']) {
								if($l['country_flag_url']){
									echo '<img src="'. esc_url($l['country_flag_url']) .'" height="12" alt="'. esc_attr($l['language_code']) .'" width="18" />';
								}
								echo icl_disp_language($l['native_name'], $l['translated_name']);
								}

							}
						?>

						</a>
							<ul class="box-dropdown parent-arrow">
								<li>
									<div class="box-wrapper no-padding parent-border">

										<?php
											wpml_languages_list();
										?>


									</div>
								</li>
							</ul>
						</li>
							<?php
								}

						if(function_exists( 'get_woocommerce_currency' )){		
						$currency = get_woocommerce_currency();
						}

						if ( !empty($currency) && get_option('sense_show_currency') != '' && get_option('sense_show_currency') != 'hide'  ) {
						?>
							<li class="top_currency" >
								<a class="cur_currency" href="#">


								<?php
								if(isset( $_COOKIE['woocommerce_current_currency'] ) && $_COOKIE['woocommerce_current_currency'] != '') {
								$currency = $_COOKIE['woocommerce_current_currency'];
								}
								$label = get_woocommerce_currency_symbol( $currency ).' '.$currency;

								echo '<span style="display:block; font-size:18px; font-weight:500; padding-bottom: 6px;" >'.get_woocommerce_currency_symbol( $currency ).'</span>';

								echo $label;
								?>
								</a>

								<ul class="box-dropdown parent-arrow">
									<li>
										<div class="box-wrapper no-padding parent-border">
										<?php dynamic_sidebar( 'Currency Converter Sidebar' ); ?>
										</div>
									</li>
								</ul>
							</li>
						<?php
							}


						}
						?>

								<?php
								if ( $header_style == 'style2' || $header_style == 'style3' )
								{
								?>

									<li class="login-create purple">
                                    	<i class="icons icon-user"></i>

										<?php if ( !is_user_logged_in() ) { ?>
                                        <p><?php _e( 'Hello Guest!', 'homeshop' ); ?> <a href="<?php echo esc_url(wp_login_url()); ?>?action=login"><?php _e( 'Login', 'homeshop' ); ?></a> <?php _e( 'or', 'homeshop' ); ?><br><a href="<?php echo esc_url($accountPage); ?>"><?php _e( 'Create Account', 'homeshop' ); ?></a></p>
										<ul id="login-dropdown" class="box-dropdown">
											<li>
                                            	<div class="box-wrapper">
                                                    <h4><?php _e( 'LOGIN', 'homeshop' ); ?></h4>

                                                   <form action="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" method="post" class="login" name="loginform">
														
														<?php do_action( 'woocommerce_login_form_start' ); ?>
														<div class="iconic-input">
															<input name="username"  id="username" type="text" tabindex="10" placeholder="Username">
															<i class="icons icon-user-3"></i>
														</div>
														<div class="iconic-input">
															<input name="password" id="password"  type="password" tabindex="20" placeholder="Password">
															<i class="icons icon-lock"></i>
														</div>

		<input name="rememberme" tabindex="90" type="checkbox" id="rememberme" value="forever" style="display:none;">
		<label for="rememberme"> <?php _e( 'Remember Me', 'homeshop' ); ?></label>

														<br>
														<br>
														<div class="pull-left">
														
		<?php wp_nonce_field( 'woocommerce-login' ); ?>														
		<input type="submit" name="login" class="orange" value="Login" />
		
		
		
		
														</div>
														<div class="pull-right">
															<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot your password?', 'homeshop' ); ?></a>
															<br>
															<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot your username?', 'homeshop' ); ?></a>
															<br>
														</div>
														<br class="clearfix">
														
													<?php do_action( 'woocommerce_login_form_end' ); ?>
													</form>




                                                    <br class="clearfix">
                                                </div>
												<div class="footer">
													<h4 class="pull-left"><?php _e( 'NEW CUSTOMER?', 'homeshop' ); ?></h4>
													<a class="button pull-right" href="<?php echo esc_url($accountPage); ?>"><?php _e( 'Create an account', 'homeshop' ); ?></a>
												</div>
											</li>
										</ul>

										<?php } else {
										$current_user2 = wp_get_current_user();
										$current_login2 = $current_user2->user_login;

										?>
										<p style="margin-top:5px;"><?php _e( 'Hello', 'homeshop' ); ?> <?php echo $current_login2; ?>! <a href="<?php echo esc_url(wp_logout_url( homeShop_curPageURL() )); ?>"><?php _e( 'Logout', 'homeshop' ); ?></a></p>

										<?php } ?>
                                    </li>

								<?php
								}
								?>

							</ul>
						</nav>
					</div>

				</div>
				<!-- /Main Header -->

				<!-- Main Navigation -->
				<nav id="main-navigation" class="<?php  echo $header_style; ?>">

						<?php  if (has_nav_menu('main_navigation')) :
							wp_nav_menu( array(
							'theme_location' => 'main_navigation',
							'container' => false,
							 'menu_class' => '',
							 'menu_id' => 'main_menu_ul',
							 'echo' => true,
							 'depth' => 3,
							 'fallback_cb'=> '',
							 'walker' => new homeShop_Nav_Walker()
							 ));
							endif;
						?>

					<?php
					$search_class = '';
					if ( defined( 'YITH_WCAS' )  && get_option('sense_show_header_search') == 'show' ) {
					wp_enqueue_script('yith_wcas_jquery-autocomplete' );
					$search_class = 'yith-ajaxsearchform-container';
					}
					
					if ( get_option('sense_settings_search_mobile') == 'hide' && get_option('sense_show_header_search') == 'show' ) {
						$search_class .= ' hidden-xs';
					}
					
					
					?>
					
					<?php  if (get_option('sense_show_header_search') && get_option('sense_show_header_search') == 'show') { ?>
					
					<div id="search-bar" class="<?php echo $search_class ?>">
					<form role="search" id="yith-ajaxsearchform" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">


						<div class="col-lg-12 col-md-12 col-sm-12 search-bar-inner">
							<table id="search-bar-table">
								<tr>
									<td class="search-column-1">
										<p><span class="grey"><?php _e( 'Popular Searches', 'homeshop' ); ?>:</span>
										<?php
										$search_type = '';
										if( is_shop_installed() ) {
										$search_type == 'product';
										$taxonomy = "product_cat";
										} else {
										$search_type = 'post';
										$taxonomy = "category";
										}



										$wp_recent_searches_widget = new RecentSearchesWidget();
										$wp_recent_searches_widget->show_recent_searches( '', '', ", " );

										?>
										</p>
										<input type="search"  name="s" value="<?php echo get_search_query() ?>" id="yith-s1"  placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>">
										<?php
										if( is_shop_installed() ) {
										?>
										<input type="hidden" value="product" name="post_type" />
										<?php
										}
										?>

								   </td>
									<td class="search-column-2">

										<?php

										$args = array(
											'show_option_all'    => __( 'Select All', 'homeshop' ),
											'show_option_none'   => '',
											'orderby'            => 'name',
											'order'              => 'ASC',
											'show_count'         => 0,
											'hide_empty'         => 1,
											'child_of'           => '',
											'exclude'            => '',
											'echo'               => 1,
											'selected'           => 0,
											'hierarchical'       => 0,
											'name'               => $taxonomy,
											'id'                 => 'taxonomies-filter-top',
											'class'              => 'taxonomies-filter-top chosen-select-search',
											'depth'              => 2,
											'tab_index'          => 0,
											'taxonomy'           => $taxonomy,
											'hide_if_empty'      => false
										);
										 wp_dropdown_categories( $args );
										?>

									</td>
								</tr>
							</table>
						</div>

							<div id="search-button">
							<input type="submit" value="" id="mini-search-submit" name="ref-search" />
							<i class="icons icon-search-1"></i>
							</div>

					</form>
					</div>
					
					<?php  } ?>
					
					<?php 
					if ( defined( 'YITH_WCAS' )  && get_option('sense_show_header_search') == 'show' ) {
					?>
					<script type="text/javascript">
					jQuery(function($){
						var search_loader_url = <?php echo apply_filters('yith_wcas_ajax_search_icon', 'woocommerce_params.ajax_loader_url') ?>;

						var container_s1 = document.querySelector('#yith-s1');
						
						if( container_s1 ) {
						$('#yith-s1').autocomplete({
							minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
							appendTo: '.search-bar-inner',
							serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
							onSearchStart: function(){
								$(this).css('background', 'url('+search_loader_url+') no-repeat right center');
							},
							onSearchComplete: function(){
								$(this).css('background', '#fff');
							},
							onSelect: function (suggestion) {
								if( suggestion.id != -1 ) {
									window.location.href = suggestion.url;
								}
							}
						});
						}
						
					});
					</script>
					<?php 
					}
					?>
					
					
					
				</nav>
				<!-- /Main Navigation -->

			</div>

		</header>
		<!-- /Header -->





<!-- Banner -->
<section class="banner">

<?php
	if(!is_archive() && !is_404() && get_meta_option('custom_sidebar_top')) {
	$top_sidebar_id = get_meta_option('custom_sidebar_top');
	mm_sidebar('blog',$top_sidebar_id);
	}
 ?>

</section>
<!-- /Banner -->





	<!-- Content -->
	<div class="row content">
			<?php 
			
			$is_woo = false;
			
			if( is_shop_installed() ) {
			$is_woo = is_woocommerce();
			}

			if(function_exists('the_breadcrumbs') && !$is_woo && !is_page_template('page_home.php') && !is_home()) {
			the_breadcrumbs(); 
			} ?>	
