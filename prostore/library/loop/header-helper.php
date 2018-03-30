<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/header-helper.php
 * @file	 	1.0
 */
?>
<?php
	global $data, $prefix, $userdata;
?>
<div class="contain-to-grid hide-on-print" id="helper">
	<nav class="top-bar">
		<ul class="left">
			<?php if($data[$prefix."header_helper_bar_left"]=="text") { ?>
				<li class="name"><?php echo $data[$prefix."header_helper_bar_left_text"]; ?></li>
			<?php } elseif($data[$prefix."header_helper_bar_left"]=="menu") { ?>
				<li class="show-for-custom-bp">
					<?php
						if(has_nav_menu('helper_nav')) {
							$args = array(
								'theme_location' => 'helper_nav',
								'container'      => '',
								'items_wrap' => '%3$s',
								'walker' => new helper_menu_walker(),
								'depth' => '1'
								);
							wp_nav_menu( $args );
						}
					?>
	  			</li>
				<li>&nbsp;</li>
			<?php } ?>
	  		<li class="hide-for-custom-bp search"><a href="#"><em class="icon-search"></em></a></li>
	  		<li class="show-for-small menu">
			   <a href="#" id="mobile-nav-button">
					<svg xml:space="preserve" enable-background="new 0 0 48 48" viewBox="0 0 48 48" height="18px" width="18px" y="9px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1">
						<line y2="8.907" x2="48" y1="8.907" x1="0" stroke-miterlimit="10" stroke-width="8" stroke="#ffffff" fill="none"/>
						<line y2="24.173" x2="48" y1="24.173" x1="0" stroke-miterlimit="10" stroke-width="8" stroke="#ffffff" fill="none"/>
						<line y2="39.439" x2="48" y1="39.439" x1="0" stroke-miterlimit="10" stroke-width="8" stroke="#ffffff" fill="none"/>
						Menu
					</svg>
				</a>
			</li>
	    	<li class="toggle-topbar"><a href="#"></a></li>
	  	</ul>
	  	<section>
	  		<ul class="right">
	  			<?php if($data[$prefix."header_helper_bar_left"]=="menu") { ?>
	  			<li class="has-dropdown hide-for-custom-bp helper-menu">
	  				<a href="#">Menu</a>
	  				<ul class="dropdown">
	  					<?php
	  						if(has_nav_menu('helper_nav')) {
	  							$args = array(
	  								'theme_location' => 'helper_nav',
	  								'container'      => '',
	  								'items_wrap' => '%3$s',
									'depth' => '1'
	  								);
	  							wp_nav_menu( $args );
	  						}
	  					?>
	  				</ul>
	  			</li>
	  			<?php } ?>
	  			<?php if ( is_user_logged_in() ) { ?>
		    		<li class="user-info has-dropdown">
    					<a href="#" title="<?php _e('Logged in as ','prostore-theme'); echo $userdata->display_name; ?>"><?php get_currentuserinfo(); echo get_avatar( $userdata->ID, 18 ); ?>	<?php echo $userdata->display_name; ?></a>
							<ul class="dropdown">
								<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My account','prostore-theme');?>"><?php _e('My account','prostore-theme'); ?></a></li>
								<li class="divider"></li>
								<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>
							</ul>
		    		</li>
				<?php } else { ?>
					<li class="user-info">
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','prostore-theme'); ?>"><?php _e('Login / Register','prostore-theme'); ?></a>
					</li>
				<?php } ?>

		    	<?php
		    		if(plugin_is_active('qtranslate/qtranslate.php')=="activated") {
		    			global $q_config;
						$language = $q_config['language'];
		    	?>

					<li class="language has-dropdown">
    					<a class="qtrans_flag_<?php echo $language; ?>"><?php echo $q_config['language_name'][$language]; ?></a>
							<ul class="dropdown">
								<?php echo qtrans_generateLanguageSelectCode('both'); ?>
							</ul>
		    		</li>
				<?php
		    		}
		    	?>

		    	<?php if(plugin_is_active('woocommerce/woocommerce.php')=="activated") { ?>
					<?php global $woocommerce; ?>
					<?php if (sizeof($woocommerce->cart->cart_contents)>0) { ?>
			    		<li class="cart-header has-dropdown">
							<a class="cart-contents" href="#" title="<?php _e('View your shopping cart', 'prostore-theme'); ?>"><em class="icon-basket"></em> <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'prostore-theme'), $woocommerce->cart->cart_contents_count);?> /  <?php echo $woocommerce->cart->get_cart_total(); ?></a>
							<ul class="mini-cart dropdown">
								<?php
									echo '<li class="divider first"></li>';
									foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
										$_product = $values['data'];
										if ( $_product->exists() && $values['quantity'] > 0 ) {
											echo '<li class="item">';
											if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
												echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
											else
												echo '<dl>';
													echo '<dt>';
														printf('<a href="%s"><strong>%s (%s)</strong></a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ), $values['quantity']);
													echo '</dt>';
													echo '<dd class="text-right">';
														$amount =  apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
														printf('<a href="%s"><strong>%s</strong></a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $amount );
													echo '</dd>';
													echo '<div class="clear"></div>';
												echo '</dl>';

											echo '</li>';
											echo '<li class="divider"></li>';

										}
									}
								?>
								<li class="text-center footer">
									<a class="cart-contents button success" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'prostore-theme'); ?>" class="button">View cart</a>

									<a href="<?php echo $woocommerce->cart->get_checkout_url()?>" title="<?php _e('Checkout','prostore-theme') ?>" class="button"><?php _e('Checkout','prostore-theme') ?></a>
								</li>
							</ul>
			    		</li>
			    	<?php } else { ?>
			    		<li class="cart-header">
			    			<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'prostore-theme'); ?>"><em class="icon-basket"></em> <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'prostore-theme'), $woocommerce->cart->cart_contents_count);?> /  <?php echo $woocommerce->cart->get_cart_total(); ?></a>
			    		</li>
			    	<?php } ?>
			    <?php } ?>
	  		</ul>
		</section>
	</nav>
</div>