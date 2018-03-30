<?php 
$login_url = wp_login_url();
$logout_url = wp_logout_url();
$register_url = wp_registration_url();
if(defined('WOOCOMMERCE_VERSION')){
	$login_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
	$logout_url = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
}
?>
<header id="header" class="header-container page-heading-<?php echo esc_attr($page_heading) ?> header-type-classic header-navbar-classic<?php if($menu_transparent):?> header-absolute header-transparent<?php endif?> header-scroll-resize" itemscope="itemscope" itemtype="<?php echo dh_get_protocol()?>://schema.org/Organization" role="banner">
	<?php if(dh_get_theme_option('show-topbar',1)):?>
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="left-topbar">
            			<?php
            			$left_topbar_content = dh_get_theme_option('left-topbar-content','info');
            			if($left_topbar_content === 'info'): 
            				echo '<div class="topbar-info">';
            				echo '<a href="#"><i class="fa fa-phone"></i> '.esc_html(dh_get_theme_option('left-topbar-phone','(123) 456 789')).'</a>';
            				echo '<a href="mailto:'.esc_attr(dh_get_theme_option('left-topbar-email','info@domain.com')).'"><i class="fa fa-envelope-o"></i> '.esc_html(dh_get_theme_option('left-topbar-email','info@domain.com')).'</a>';
            				echo '<a href="skype:'.esc_attr(dh_get_theme_option('left-topbar-skype','skype.name')).'?call"><i class="fa fa-skype"></i> '.esc_html(dh_get_theme_option('left-topbar-skype','skype.name')).'</a>';
            				echo '</div>';
            			elseif ($left_topbar_content === 'custom'):
            				echo (dh_get_theme_option('left-topbar-custom-content',''));
            			endif;
            			?>
            			<?php 
            			if(($left_topbar_content == 'menu_social')):
            			echo '<div class="topbar-social">';
            			dh_social(dh_get_theme_option('left-topbar-social',array('facebook','twitter','google-plus','pinterest','rss','instagram')),true);
            			echo '</div>';
            			endif;
            			?>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="right-topbar">
            			
            			
						<?php if(function_exists('icl_get_languages')){?>
							<div class="language-switcher">
								<?php 
								//do_action('icl_language_selector'); 
								$languages = icl_get_languages();
								if( is_array( $languages ) ){
								
									foreach( $languages as $lang_k=>$lang ){
										if( $lang['active'] ){
											$active_lang = $lang;
											unset( $languages[$lang_k] );
										}
									}
										
									// disabled
									if( count( $languages ) ){
										$lang_status = 'enabled';
									} else {
										$lang_status = 'disabled';
									}
								
									echo '<div class="wpml-languages '. $lang_status .'">';
									echo '<a class="active" href="'. $active_lang['url'] .'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
									echo '<img src="'. $active_lang['country_flag_url'] .'" alt="'. $active_lang['translated_name'] .'"/> '.strtoupper($active_lang['language_code']);
									echo '</a>';
										
									if( count( $languages ) ){
										echo '<ul class="wpml-lang-dropdown dropdown-menu">';
										foreach( $languages as $lang ){
											echo '<li><a href="'. $lang['url'] .'"><img src="'. $lang['country_flag_url'] .'" alt="'. $lang['translated_name'] .'"/> '.strtoupper($lang['language_code']).'</a></li>';
										}
										echo '</ul>';
									}
										
									echo '</div>';
								
								}
								?>
							</div>
						<?php } ?>
						<?php if(dh_get_theme_option('ajaxsearch')){?>
							<div class="navbar-toggle-search">
								<div class="navbar-search"><a class="navbar-search-button" href="#"><i class="fa fa-search"></i></a></div>
							</div>
						<?php }?>
						<?php if(dh_get_theme_option('woo-cart-nav')){?>
							<div class="navcart">
								<div class="navcart-wrap">
									<?php 
									echo (class_exists('DH_Woocommerce') ? DH_Woocommerce::instance()->get_minicart():'');
									?>
								</div>
							</div>
						<?php }?>
						<?php if(dh_get_theme_option('user-icon',1)){?>
							<?php 
							$login_url = wp_login_url();
							$logout_url = wp_logout_url();
							$register_url = wp_registration_url();
							if(defined('WOOCOMMERCE_VERSION')){
								$login_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
								$logout_url = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
							}
							?>
							
							<div class="navbar-user"><a title="<?php echo esc_attr__('My Account','jakiro'); ?>" rel="loginModal" href="<?php echo esc_url($login_url); ?>" class="navbar-user"><i class="fa fa-user"></i></a>
								<?php
								if(is_user_logged_in()):
								?>
								<ul  class="dropdown-menu">
									<li>
										<a href="<?php echo esc_url($logout_url) ?>"><i class="fa fa-sign-out"></i><?php esc_html_e('Logout', 'jakiro'); ?></a>
									</li>
								</ul>
								<?php
								endif;
								?>
							</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	<div class="navbar-container">
		<div class="navbar navbar-default <?php if(dh_get_theme_option('sticky-menu',0)):?> navbar-scroll-fixed<?php endif;?>">
			<div class="navbar-default-wrap">
				<div class="<?php dh_container_class() ?>">
					<div class="row">
						<div class="col-md-12 navbar-default-col">
							<div class="navbar-wrap">
								<div class="navbar-header">
									<button <?php /*data-target=".primary-navbar-collapse" data-toggle="collapse"*/?> type="button" class="navbar-toggle">
										<span class="sr-only"><?php echo esc_html__('Toggle navigation','jakiro')?></span>
										<span class="icon-bar bar-top"></span> 
										<span class="icon-bar bar-middle"></span> 
										<span class="icon-bar bar-bottom"></span>
									</button>
									<?php if(dh_get_theme_option('ajaxsearch')){?>
									<a class="navbar-search-button search-icon-mobile" href="#"><i class="fa fa-search"></i></a>
							    	<?php }?>
							    	<?php if(defined('WOOCOMMERCE_VERSION') && dh_get_theme_option('woo-cart-mobile',1)):?>
							     	<?php 
							     	global $woocommerce;
							     	if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
							     		$cart_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_cart_url() );
							     	}else{
							     		$cart_url = esc_url( $woocommerce->cart->get_cart_url() );
							     	}
							     	?>
									<a class="cart-icon-mobile" href="<?php echo esc_url($cart_url) ?>"><i class="elegant_icon_bag"></i><span><?php echo absint($woocommerce->cart->cart_contents_count)?></span></a>
									<?php endif;?>
									<a class="navbar-brand" itemprop="url" title="<?php esc_attr(bloginfo( 'name' )); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php if(!empty($logo_url)):?>
											<img class="logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_url)?>">
										<?php else:?>
											<?php echo bloginfo( 'name' ) ?>
										<?php endif;?>
										<img class="logo-fixed" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_fixed_url)?>">
										<img class="logo-mobile" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_mobile_url)?>">
										<meta itemprop="name" content="<?php bloginfo('name')?>">
									</a>
								</div>
								<nav class="collapse navbar-collapse primary-navbar-collapse" itemtype="<?php echo dh_get_protocol() ?>://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
									<?php
									$page_menu = '' ;
									if(is_page() && ($selected_page_menu = dh_get_post_meta('main_menu'))){
										$page_menu = $selected_page_menu;
									}
									if(has_nav_menu('primary') || !empty($page_menu)):
										wp_nav_menu( array(
											'theme_location'    => 'primary',
											'container'         => false,
											'depth'				=> 3,
											'menu'				=> $page_menu,
											'menu_class'        => 'nav navbar-nav primary-nav',
											'walker' 			=> new DH_Mega_Walker
										) );
									else:
										echo '<ul class="nav navbar-nav primary-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">' . esc_html__( 'No menu assigned!', 'jakiro' ) . '</a></li></ul>';
									endif;
									?>
								</nav>
		
								<div class="navbar-toggle-right">
									<?php if(dh_get_theme_option('ajaxsearch')){?>
									<div class="navbar-toggle-search">
										<div class="navbar-search"><a class="navbar-search-button" href="#"><i class="fa fa-search"></i></a></div>
									</div>
									
									<?php }?>
									<?php if(dh_get_theme_option('woo-cart-nav')){?>
									<div class="navcart">
										<div class="navcart-wrap">
											<?php 
											echo (class_exists('DH_Woocommerce') ? DH_Woocommerce::instance()->get_minicart():'');
											?>
										</div>
									</div>
									<?php }?>
									<?php if(dh_get_theme_option('user-icon',1)){?>
									<?php 
									$login_url = wp_login_url();
									$logout_url = wp_logout_url();
									$register_url = wp_registration_url();
									if(defined('WOOCOMMERCE_VERSION')){
										$login_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
										$logout_url = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
									}
									?>
									
									<div class="navbar-user"><a title="<?php echo esc_attr__('My Account','jakiro'); ?>" rel="loginModal" href="<?php echo esc_url($login_url); ?>" class="navbar-user"><i class="fa fa-user"></i></a>
										<?php
										if(is_user_logged_in()):
										?>
										<ul  class="dropdown-menu">
											<li>
												<a href="<?php echo esc_url($logout_url) ?>"><i class="fa fa-sign-out"></i><?php esc_html_e('Logout', 'jakiro'); ?></a>
											</li>
										</ul>
										<?php
										endif;
										?>
									</div>
									<?php }?>
									<?php if(function_exists('icl_get_languages')){?>
										<div class="language-switcher">
											<?php 
											//do_action('icl_language_selector'); 
											$languages = icl_get_languages();
											if( is_array( $languages ) ){
											
												foreach( $languages as $lang_k=>$lang ){
													if( $lang['active'] ){
														$active_lang = $lang;
														unset( $languages[$lang_k] );
													}
												}
													
												// disabled
												if( count( $languages ) ){
													$lang_status = 'enabled';
												} else {
													$lang_status = 'disabled';
												}
											
												echo '<div class="wpml-languages '. $lang_status .'">';
												echo '<a class="active" href="'. $active_lang['url'] .'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
												echo '<img src="'. $active_lang['country_flag_url'] .'" alt="'. $active_lang['translated_name'] .'"/> '.strtoupper($active_lang['language_code']);
												echo '</a>';
													
												if( count( $languages ) ){
													echo '<ul class="wpml-lang-dropdown dropdown-menu">';
													foreach( $languages as $lang ){
														echo '<li><a href="'. $lang['url'] .'"><img src="'. $lang['country_flag_url'] .'" alt="'. $lang['translated_name'] .'"/> '.strtoupper($lang['language_code']).'</a></li>';
													}
													echo '</ul>';
												}
													
												echo '</div>';
											
											}
											?>
										</div>
									<?php } ?>
									
								</div>
		
							</div>
						</div>
					</div>
					<?php if(dh_get_theme_option('ajaxsearch')){?>
					<div class="header-search-overlay hide">
						<div class="<?php echo dh_container_class()?>">
							<div class="header-search-overlay-wrap">
								<?php echo dh_get_search_form(false)?>
								<button type="button" class="close">
									<span aria-hidden="true" class="fa fa-times"></span><span class="sr-only"><?php echo esc_html__('Close','jakiro') ?></span>
								</button>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</header>