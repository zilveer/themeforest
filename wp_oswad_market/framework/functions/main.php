<?php 
	$woocommerce_ready = false;
	$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if( in_array( "woocommerce/woocommerce.php", $_actived ) ){	
		$woocommerce_ready = true;
	}
	/* MENU PHONE */
	
	add_action( 'wd_before_header', 'wd_mobile_header_open_div', 1 );
	
	add_action( 'wd_before_header', 'wd_print_toggle_menu', 2 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_control', 3 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_bar_wrapper', 4 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_search', 5 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_logo', 6 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_cart', 8 );	
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_user', 7 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 9 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 10 );
	
	
	function wd_print_toggle_menu(){
	?>		
	
	<div class="toggle-menu-wrapper visible-xs">
		<div class="toggle-menu-control-close"><span></span></div>
		<?php 
		if( has_nav_menu( 'mobile' ) ){ 
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'mobile' ) ); 
		}
		else{
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'primary' ) ); 
		}
		?>
	</div>
	
	<?php
	}	
	
	if(!function_exists ('wd_mobile_header_bar_wrapper')){
		function wd_mobile_header_bar_wrapper(){
			global $wd_mega_menu_config_arr;
	?>	
	
		<?php  
			global $smof_data;
			$extra_class = '';
			if( isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] == 1 ){
				$extra_class = 'hidden-cart';
			}
		?>
		<div class="phone-header-bar-wrapper <?php echo $extra_class ?> visible-xs">
		<div class="toggle-menu-control-open"><?php if( isset($wd_mega_menu_config_arr) && isset($wd_mega_menu_config_arr['menu_text']) && strlen( trim($wd_mega_menu_config_arr['menu_text']) ) > 0 ){ echo $wd_mega_menu_config_arr['menu_text']; } ?></div>
	<?php
		}
	}	
	
	if(!function_exists ('wd_mobile_header_open_div')){
		function wd_mobile_header_open_div(){
		?>	
			<div class="phone-header visible-xs">
		<?php
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_control')){
		function wd_mobile_header_menu_control(){
			global $wd_mega_menu_config_arr;	
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_user')){
		function wd_mobile_header_menu_user(){
			global $smof_data;
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			$myaccount_page_url = "#";
			if ( $myaccount_page_id ) {
				$myaccount_page_url = esc_url( get_permalink( $myaccount_page_id ) );
			}	
			//echo "<a id='mobile-user-menu' href='{$myaccount_page_url}' title='" . __("Login/Register","wpdance") . "'></a>";
	?>
			<div class="wd_mobile_account <?php echo $smof_data['wd_header_layout']; ?> <?php echo wd_is_woocommerce()== false ? "full":"" ?> ">
				<?php if(!is_user_logged_in()):?>
					
					<a class="sign-in-form-control" href="<?php echo $myaccount_page_url;?>" title="<?php _e('Log in/Sign up','wpdance');?>">
						<span><?php _e('Log in / Sign up','wpdance');?></span>
					</a>
					<span class="visible-xs login-drop-icon"></span>			
				<?php else:?>		
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>">
						<?php _e('My Account','wpdance'); ?>
					</a>	
				<?php endif;?>
			</div>
	<?php
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_cart')){
		function wd_mobile_header_menu_cart(){
			global $smof_data;
			if((isset($smof_data['wd_header_layout'])) && (($smof_data['wd_header_layout']) != 'v5')):
			?>
				<div class="mobile_cart_container visible-xs <?php echo wd_is_woocommerce()== false ? "woo-hidden":"" ?>">
					<div class="mobile_cart">
					<?php
						if( wd_is_woocommerce() ){
						$_cart_size_id = "cart_size_value_head-".rand(); 
						?>
						
						<span class="cart_size">
							<a href="<?php echo WC()->cart->get_cart_url();?>" title="<?php _e('View your shopping bag','wpdance');?>">
								<span class="ic-bag"></span>
							
							<!--<span class="cart_division">/</span>-->
							<span class="cart_size_value_head" id="<?php echo $_cart_size_id; ?>">
								<span class="cart_text">
								<?php _e('My cart','wpdance'); ?>
								</span>
								<span class="cart_item">
									<span class="num_item">
										<?php 
										$number = WC()->cart->cart_contents_count;
										if( $number < 10 && $number != 0 )
											echo '0'.$number;
										else
											echo $number;
										?>
									</span>
								</span>
							</span>
							</a>
						</span>
						
						<?php } ?>
					</div>
				</div>		
			<?php
			endif;
		}
	}		

	if(!function_exists ('wd_mobile_header_menu_search')){
		function wd_mobile_header_menu_search(){
			global $smof_data;
			if( isset($smof_data['wd_enable_header_search_on_mobile']) && $smof_data['wd_enable_header_search_on_mobile'] == 0 )
				return;
			get_search_form();	
		}
	}

	if(!function_exists ('wd_mobile_header_logo')){
		function wd_mobile_header_logo(){
			theme_logo();
		}
	}
	
	if(!function_exists ('wd_mobile_header_close_div')){
		function wd_mobile_header_close_div(){
			?>	
			<div style="clear:both"></div>
			</div>
			<?php
		}
	}		
	/* END MENU PHONE */
	
	
	if(!function_exists ('wd_print_header_head')){
		function wd_print_header_head($version = 'v1'){
			global $smof_data;?>
			<div class="header-top hidden-xs <?php echo $version; ?>">
			
				<div class="header-top-container container">
					
					<?php if($version != 'v5'): ?>
						<div class="left-header-top-content">
							<?php if($smof_data['wd_text_shipping'] !==""): ?>
								<div class="shipping-text"><?php echo $smof_data['wd_text_shipping'] ?></div>
							<?php endif; ?>
							
							<?php if($smof_data['wd_phone'] !==""): ?>
								<div class="phone-text"><?php _e('Phone: ', 'wpdance'); echo $smof_data['wd_phone'] ?></div>
							<?php endif; ?>
							
							<?php if($smof_data['wd_hotline'] !=="" ): ?>
								<div class="hotline-text"><?php _e('HotLine: ', 'wpdance'); echo $smof_data['wd_hotline'] ?></div>
							<?php endif; ?>
						</div>
						
						<div class="right-header-top-content">
							<!-- WIDGET SOCIAL -->
							
							<?php
								wd_template_social_sharing();
								
								if ( wd_is_woocommerce() && defined('YITH_WCWL') ) {
									?>
										<div class="wd_tini_wishlist_wrapper"><?php echo wd_tini_wishlist(); ?></div>
									<?php
								}
							?>
							
							<?php echo wd_tini_account();//TODO : account form goes here?>	
							<!-- EFFECT ICON SOCIAL -->
							<script type="text/javascript">
								jQuery( document ).ready(function() {
									"use strict";
									
									var _time_delay=0;
									var _ul_social = jQuery('#header ul.social-share');
									jQuery.fn.reverse = [].reverse;
									_ul_social.find("li").reverse().each(function(index,element){
										TweenLite.from(jQuery(element), 1, {x:-80,repeat:0,delay:_time_delay,opacity:0,ease:Quad.easeIn});
										_time_delay += 0.4;
									});						
								});		
							</script>
							<!-- END WIDGET SOCIAL -->
						</div>
						
					<?php else: ?> <!-- Header top version 5 -->
					
						<div class="left-header-top-content">
							
							<?php echo wd_tini_account();//TODO : account form goes here?>
						
							<?php
								if ( wd_is_woocommerce() && defined('YITH_WCWL') ) {
									?>
										<div class="wd_tini_wishlist_wrapper"><?php echo wd_tini_wishlist(); ?></div>
									<?php
								}
							?>
							
						</div>
						
						<div class="right-header-top-content">
							<!-- WIDGET SOCIAL -->
							
							<?php
								wd_template_social_sharing();
							?>
							
							<!-- EFFECT ICON SOCIAL -->
							<script type="text/javascript">
								jQuery( document ).ready(function() {
									"use strict";
									
									var _time_delay=0;
									var _ul_social = jQuery('#header ul.social-share');
									jQuery.fn.reverse = [].reverse;
									_ul_social.find("li").reverse().each(function(index,element){
										TweenLite.from(jQuery(element), 1, {x:-80,repeat:0,delay:_time_delay,opacity:0,ease:Quad.easeIn});
										_time_delay += 0.4;
									});						
								});		
							</script>
							<!-- END WIDGET SOCIAL -->
						</div>
					
					<?php endif;?>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div>
			</div><!-- end header top -->
			<div style="clear:both"></div>
			
		<?php	
		}	
	}
	
	
	if(!function_exists ('wd_print_header_body')){
		function wd_print_header_body($version = 'v1'){
		global $smof_data, $page_datas;
			if($version == 'v1'):
			?>	
			<div class="header-middle hidden-xs <?php echo ( $smof_data['wd_enable_middle_header_custom_code'] )? "show_banner":"" ?> <?php echo $version; ?>">
				<div class="header-middle-content container">
					<!-- LOGO -->	
					<div class="left-header-middle-content">
						<div class="header-logo">						 
						<?php theme_logo();?>
						</div>
					</div>
					<!-- END LOGO -->
					
					<?php if ( $smof_data['wd_enable_middle_header_custom_code'] ) : ?>
					<div class="middle-header-middle-content">						
						<?php echo do_shortcode(stripslashes($smof_data['wd_middle_header_custom_code'])); ?>
					</div>
					<?php endif; ?>
					
					<div class="right-header-middle-content">
					<!-- HEADER CART -->	
						<div class="shopping-cart shopping-cart-wrapper <?php echo wd_is_woocommerce()== false ? "woo-hidden":"" ?>"><?php echo wd_tini_cart();?></div>
					<!-- END HEADER CART -->	
					</div>
					
				</div>
			</div><!-- end .header-middle -->	
			<?php
			endif;
			/* Version 2*/
			if($version == 'v2' || $version == 'v4'):
			?>
			<div class="header-middle hidden-xs <?php echo $version; ?>">
				<div class="header-middle-content container">
					<div class="left-header-middle-content">
						<?php if(( (int)$smof_data['wd_enable_header_search'] == 1 && $version=='v2') || ( (int)$smof_data['wd_enable_header_search'] == 1 && $version=='v4')): ?>
						<div class="header_search"><?php get_search_form(); ?></div>
						<?php endif;?>
					</div>
					<!-- LOGO -->	
					<div class="middle-header-middle-content">
						<div class="header-logo">						 
						<?php theme_logo();?>
						</div>
					</div>
					<!-- END LOGO -->
					
					<div class="right-header-middle-content">
					<!-- HEADER CART -->					
						<div class="shopping-cart shopping-cart-wrapper <?php echo wd_is_woocommerce()== false ? "woo-hidden":"" ?>"><?php echo wd_tini_cart();?></div>
					<!-- END HEADER CART -->	
					</div>
				</div>
			</div><!-- end .header-middle -->	
			<?php
			endif;
			
			/* Version 3*/
			if($version == 'v3'):
			?>
			<div class="header-middle hidden-xs <?php echo $version; ?>">
				<div class="header-middle-content container">
					<div class="left-header-middle-content">
					<!-- LOGO -->	
						<div class="header-logo">						 
						<?php theme_logo();?>
						</div>
					<!-- END LOGO -->
					</div>
					
					<div class="middle-header-middle-content">
						<?php if( (int)$smof_data['wd_enable_header_search'] == 1 && $version=='v3'): ?>
						<div class="header_search_categories"><?php  wd_search_form_by_category() ?></div>
						<?php endif;?>
					</div>
					
					
					<div class="right-header-middle-content">
					<!-- HEADER CART -->					
						<div class="shopping-cart shopping-cart-wrapper <?php echo ( !wd_is_woocommerce() )? "woo-hidden":"" ?>"><?php echo wd_tini_cart();?></div>
					<!-- END HEADER CART -->	
					</div>
					
					<?php if ( $smof_data['wd_enable_middle_header_custom_code'] ) : ?>
					<div class="header-middle-banner-content">						
						<?php echo do_shortcode(stripslashes($smof_data['wd_middle_header_custom_code'])); ?>
					</div>
					<?php endif; ?>
					
				</div>
			</div><!-- end .header-middle -->	
			<?php
			
			endif;
			
			wp_reset_query();
			?>			
			<script type="text/javascript">
                var _enable_sticky_menu = <?php echo (int) $smof_data['wd_sticky_menu']; ?>;
				var _sticky_menu_class = '<?php echo ( isset($page_datas) && ($page_datas['page_layout']=='box'))?"wd_box":""; ?>';
		    </script>
	<?php	
		}	
	}

	
	if(!function_exists ('wd_print_header_footer')){
		function wd_print_header_footer($version = 'v1'){
			global $smof_data;
		?>	
		<div class="header-bottom <?php echo (((int)$smof_data['wd_enable_header_search']==0 || $version !='v1')&&((int)$smof_data['wd_enable_header_search']==0 || $version !='v5'))?'search-hidden':''; ?> <?php echo $version; ?>">
			<div class="header-bottom-content container">
			<?php if($version == 'v1' || $version == 'v3') :?>
				<div class="header-logo wd-sticky-show hidden-xs">						 
					<?php theme_logo();?>
				</div>
			<?php endif; 
			
			if($version == 'v3') :?>
			<div class="header-category">
				<?php 
					if( class_exists('WP_Widget_Product_Categories') ){
						$instance = array(
										'title' => __('Categories', 'wpdance')
										,'show_post_count' => 0
										,'show_sub_cat' => 1
										,'is_dropdown' => 1
										,'orderby' => 'date'
										,'order' => 'desc'
										,'number' => 0
									);
						the_widget('WP_Widget_Product_categories',$instance);
					}
				?>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					
					if( typeof _on_tablet != 'undefined' && _on_tablet == 1 ){
						jQuery(".header-category .wd_widget_product_categories .widgettitle").bind('click',function(){
							if( !jQuery(this).hasClass('active') ){
								jQuery(this).addClass('active');
								jQuery(this).siblings(".wd_product_categories").find("ul:first").slideDown();
							}
							else{
								jQuery(this).removeClass('active');
								jQuery(this).siblings(".wd_product_categories").find("ul:first").slideUp();
							}
						});
					}
					else{
						jQuery(".header-category .wd_widget_product_categories").hoverIntent(
							function(){
								jQuery(this).find(".wd_product_categories > ul").slideDown();
							},
							function(){
								jQuery(this).find(".wd_product_categories > ul").slideUp();
							}
						);
					}
					
				});
				</script>
			</div>
			<?php endif; ?>
			<?php if($version == 'v4') :?>
			<div class="header-category">
				<?php 
					if( class_exists('WP_Widget_Product_Categories') ){
						$instance = array(
										'title' => __('Categories', 'wpdance')
										,'show_post_count' => 0
										,'show_sub_cat' => 1
										,'is_dropdown' => 0
										,'orderby' => 'date'
										,'order' => 'desc'
										,'number' => 0
									);
						the_widget('WP_Widget_Product_categories',$instance);
					}
				?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						"use strict";
						if( typeof _on_tablet != 'undefined' && _on_tablet == 1 ){
							jQuery(".header-category .wd_widget_product_categories .widgettitle").bind('click',function(){
								if( !jQuery(this).hasClass('active') ){
									jQuery(this).addClass('active');
									jQuery(this).siblings(".wd_product_categories").find("ul:first").slideDown();
								}
								else{
									jQuery(this).removeClass('active');
									jQuery(this).siblings(".wd_product_categories").find("ul:first").slideUp();
								}
							});
						}
						else{
							jQuery(".header-category .wd_widget_product_categories").hoverIntent(
								function(){
									jQuery(this).find(".wd_product_categories > ul").slideDown();
								},
								function(){
									jQuery(this).find(".wd_product_categories > ul").slideUp();
								}
							);
						}
					});
				</script>
			</div>
			<?php endif; ?>
			<!-- HEADER MENU -->
				<div class="nav">
					<?php 
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary','walker' => new WD_Walker_Nav_Menu() ) );
						}else{
							wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary' ) );
						}
					?>
				</div>
			<!-- END HEADER MENU -->
			
			<?php if( ((int)$smof_data['wd_enable_header_search'] == 1 && $version=='v1') || 
					  ((int)$smof_data['wd_enable_header_search'] == 1 && $version=='v5')): ?>
					<!-- HEADER SEARCH -->
					<div class="header_search"><span class="bt_search search_close"></span><?php get_search_form(); ?></div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";
							
							var _search_obj = jQuery("#header .header-bottom.v1 .header_search .bt_search");
							var _search_box = jQuery("#header .header-bottom.v1 .header_search");
							_search_obj.click(function(){
								var _windowWidth = jQuery('body').innerWidth();
								if(_windowWidth < 1199 && _windowWidth > 700 )
								{
									if(_search_obj.hasClass("search_open")){
										_search_obj.removeClass("search_open").addClass("search_close");
										_search_box.css("overflow","hidden");
										_search_box.find("form").css("height","0");
									}
									else if(_search_obj.hasClass("search_close")){
										_search_obj.removeClass("search_close").addClass("search_open");
										_search_box.css("overflow","visible");
										_search_box.find("form").css("height","52px");
									}
								}
							});
							
							var _search_obj_v5 = jQuery("#header .header-bottom.v5 .header_search .bt_search");
							var _search_box_v5 = jQuery("#header .header-bottom.v5 .header_search");
							_search_obj_v5.click(function(){
								var _windowWidth = jQuery('body').innerWidth();
								if(_windowWidth < 1199 && _windowWidth > 700 )
								{
									if(_search_obj_v5.hasClass("search_open")){
										_search_obj_v5.removeClass("search_open").addClass("search_close");
										_search_box_v5.css("overflow","hidden");
										_search_box_v5.find("form").css("height","0");
									}
									else if(_search_obj_v5.hasClass("search_close")){
										_search_obj_v5.removeClass("search_close").addClass("search_open");
										_search_box_v5.css("overflow","visible");
										_search_box_v5.find("form").css("height","52px");
									}
								}
							});
						});
					</script>
					<!-- END HEADER SEARCH -->
			<?php endif; ?>
			
			<!-- HEADER CART -->
			<?php if($version == 'v1' || $version == 'v3') :?>		
				<div class="shopping-cart shopping-cart-wrapper wd-sticky-show hidden-xs "><?php echo wd_tini_cart();?></div>
			<?php endif; ?>
			<!-- END HEADER CART -->
			
			</div>			
		</div><!-- end .header-bottom -->
		<div style="clear:both"></div>
		<script type="text/javascript">
			var _sub_menu_show_effect = '<?php echo isset($smof_data['wd_sub_menu_show_effect'])?$smof_data['wd_sub_menu_show_effect']:'dropdown'; ?>';
			var _sub_menu_show_duration = <?php echo (isset($smof_data['wd_sub_menu_show_duration']) && (int)$smof_data['wd_sub_menu_show_duration']>0)?(int)$smof_data['wd_sub_menu_show_duration']:'200'; ?>;
		</script>
		<?php
		}	
	}
	
	
	if(!function_exists ('wd_print_header_logo_header_5')){
		function wd_print_header_logo_header_5(){
			?>
			<div class="header-logo-bottom">
				<div class="header-logo-content container">
					<div class="header-logo">		
						<?php theme_logo();?>
					</div>
				</div>
			</div>
			<?php 
		}
	}
	/* wd_header_init hook */
	if(!function_exists('wd_multi_header_layout')){
		function wd_multi_header_layout(){
			global $smof_data;
			if(!isset($smof_data['wd_header_layout']))
				$wd_header_layout = 'v1';
			else
				$wd_header_layout = $smof_data['wd_header_layout'];
			wd_print_header_head($wd_header_layout);
			wd_print_header_body($wd_header_layout);
			wd_print_header_footer($wd_header_layout);
			if((isset($smof_data['wd_header_layout'])) && ($smof_data['wd_header_layout'] == 'v5') ):
				wd_print_header_logo_header_5();
			endif;
		}
	}
	add_action( 'wd_header_init', 'wd_multi_header_layout', 10 );
	
	
	add_action( 'wd_before_main_container', 'wd_print_inline_script', 10 );
	if(!function_exists ('wd_print_inline_script')){
		function wd_print_inline_script(){
	?>	
		<script type="text/javascript">
			<?php if( defined('ICL_LANGUAGE_CODE') ): ?>
				_ajax_uri = '<?php echo admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative');?>';
			<?php else: ?>
				_ajax_uri = '<?php echo admin_url('admin-ajax.php', 'relative');?>';
			<?php endif; ?>
			_on_phone = <?php echo WD_IS_MOBILE === true ? 1 : 0 ;?>;
			_on_tablet = <?php echo WD_IS_TABLET === true ? 1 : 0 ;?>;
			//if(navigator.userAgent.indexOf(\"Mac OS X\") != -1)
			//	console.log(navigator.userAgent);
			<?php 
				global $smof_data;
				//if(isset($smof_data['wd_nicescroll']) && $smof_data['wd_nicescroll'] == 1) :
			?>
			//var obj_nice_scroll = jQuery("html").niceScroll({cursorcolor:"#000"});
			//jQuery("#"+obj_nice_scroll.id).find("div:first").css({"width":"6px"});
			<?php //endif; ?>
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
	<?php
		}
	}
	add_action( 'wd_before_main_container', 'wd_print_top_content_widget_area', 15 );
	if(!function_exists ('wd_print_top_content_widget_area')) {
		function wd_print_top_content_widget_area(){
			global $smof_data, $page_datas;
			if ( is_active_sidebar( 'top-content-widget-area' ) && isset($page_datas['hide_top_content']) && (int)$page_datas['hide_top_content'] == 0 ) :
			?>
				<div class="wd_top_content_widget_area_wrapper <?php wd_page_layout_class(); ?>">
					<div class="wd_top_content container">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'top-content-widget-area' ); ?>
						</ul>
					</div>
				</div>		
			<?php 
			endif;
		}
	}
	add_action( 'wd_after_main_slideshow', 'wd_print_banner_top_content_widget_area', 10 );
	if(!function_exists ('wd_print_banner_top_content_widget_area')) {
		function wd_print_banner_top_content_widget_area(){
			global $smof_data, $page_datas;
			if ( is_active_sidebar( 'banner-top-content-widget-area' ) && (int) $page_datas['hide_banner_top_content'] == 0 ) :
			?>
				<div class="wd_banner_top_content_widget_area_wrapper <?php wd_page_layout_class(); ?>">
					<div class="wd_banner_top_content">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'banner-top-content-widget-area' ); ?>
						</ul>
					</div>
				</div>		
			<?php 
			endif;
		}
	}
	//add_action( 'wd_before_main_container', 'wd_print_ads_block', 20 );
	if(!function_exists ('wd_print_ads_block')){
		function wd_print_ads_block(){
			global $page_datas;
	?>	
			<div class="header_ads_wrapper">
				<?php 
					if( !is_home() && !is_front_page() ){
						if( !is_page() ){
							printHeaderAds();
						}else{
							if( isset($page_datas['hide_ads']) && absint($page_datas['hide_ads']) == 0 )
								printHeaderAds();
						}					
					}						
				?>
			</div>
	<?php
		}
	}	
	
	
	//add_action( 'wd_before_body_end', 'wd_before_body_end_widget_area', 10 );
	if(!function_exists ('wd_before_body_end_widget_area')){
		function wd_before_body_end_widget_area(){
	?>
		<div class="container body-end">
				<div class="body-end-widget-area">
					<?php
						if ( is_active_sidebar( 'body-end-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'body-end-widget-area' ); ?>
							</ul>
						<?php endif; ?>						
				</div><!-- end #footer-first-area -->
		</div>	
	
		<?php wp_reset_query();?>
	
	<?php
		}
	}	

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_1', 10 );
	if(!function_exists ('wd_footer_init_widget_area_1')){
		function wd_footer_init_widget_area_1(){
			global $smof_data;
			if( isset($smof_data['wd_show_first_footer_widget_area']) && (int) $smof_data['wd_show_first_footer_widget_area'] == 0){
				return;
			}
	?>	
	
		<?php //if( !wp_is_mobile() ): ?>
			<div class="first-footer-widget-area footer-front">
				<div class="container">
					<div class="first-footer-widget-area-1 col-sm-24">
						<?php if ( is_active_sidebar( 'first-footer-widget-area-1' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'first-footer-widget-area-1' ); ?>
							</ul>
						<?php endif; ?>
					</div>							
				</div>
			</div>
			<?php wp_reset_query();?>
		<?php //endif; ?>	
		
	<?php
		}
	}
	
	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_2', 20 );
	if(!function_exists ('wd_footer_init_widget_area_2')){
		function wd_footer_init_widget_area_2(){
			global $smof_data;
			if( isset($smof_data['wd_show_second_footer_widget_area']) && (int) $smof_data['wd_show_second_footer_widget_area'] == 0){
				return;
			}
	?>	
			<div class="second-footer-widget-area footer-front">
				<div class="container">
					<div class="second-footer-widget-area-1 col-sm-24">
						<?php if ( is_active_sidebar( 'second-footer-widget-area-1' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'second-footer-widget-area-1' ); ?>
							</ul>
						<?php endif; ?>
					</div>							
				</div>
			</div>
			<?php wp_reset_query();?>
		
	<?php
		}
	}

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_3', 30 );
	if(!function_exists ('wd_footer_init_widget_area_3')){
		function wd_footer_init_widget_area_3(){
			global $smof_data;
			if( isset($smof_data['wd_show_third_footer_widget_area']) && (int) $smof_data['wd_show_third_footer_widget_area'] == 0){
				return;
			}
	?>	
	
			<div class="third-footer-widget-area footer-bg">
				<div class="container">
					<div class="third-footer-widget-area-1 col-sm-24">
						<?php
							if ( is_active_sidebar( 'third-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'third-footer-widget-area-1' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
				</div>
			</div>
			<?php wp_reset_query();?>	
		
	<?php
		}
	}
	
	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_4', 40 );
	if(!function_exists ('wd_footer_init_widget_area_4')){
		function wd_footer_init_widget_area_4(){
			global $smof_data;
			if( isset($smof_data['wd_show_fourth_footer_widget_area']) && (int) $smof_data['wd_show_fourth_footer_widget_area'] == 0){
				return;
			}
	?>	
	
			<div class="fourth-footer-widget-area footer-bg" style="background:url(<?php echo $smof_data['wd_bg_third_footer_widget_area'] ?>) 50% no-repeat;">
				<div class="container">
					<div class="fourth-footer-widget-area-1 col-sm-24">
						<?php
							if ( is_active_sidebar( 'fourth-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'fourth-footer-widget-area-1' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
					
				</div>
			</div>
			<?php wp_reset_query();?>	
		
	<?php
		}
	}
	
	
	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_5', 50 );
	if(!function_exists ('wd_footer_init_widget_area_5')){
		function wd_footer_init_widget_area_5(){
			global $smof_data;
			if( isset($smof_data['wd_show_fifth_footer_widget_area']) && (int) $smof_data['wd_show_fifth_footer_widget_area'] == 0){
				return;
			}
	?>	
	
			<div class="fifth-footer-widget-area footer-bg">
				<div class="container">
					<div class="fifth-footer-widget-area-1 col-sm-6">
						<?php
							if ( is_active_sidebar( 'fifth-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'fifth-footer-widget-area-1' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
					<div class="fifth-footer-widget-area-2 col-sm-6">
						<?php
							if ( is_active_sidebar( 'fifth-footer-widget-area-2' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'fifth-footer-widget-area-2' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
					<div class="fifth-footer-widget-area-3 col-sm-6">
						<?php
							if ( is_active_sidebar( 'fifth-footer-widget-area-3' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'fifth-footer-widget-area-3' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
					<div class="fifth-footer-widget-area-4 col-sm-6">
						<?php
							if ( is_active_sidebar( 'fifth-footer-widget-area-4' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'fifth-footer-widget-area-4' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
				</div>
			</div>
			<?php wp_reset_query();?>	
		
	<?php
		}
	}
	
	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_6', 60 );
	if(!function_exists ('wd_footer_init_widget_area_6')){
		function wd_footer_init_widget_area_6(){
			global $smof_data;
			if( isset($smof_data['wd_show_sixth_footer_widget_area']) && (int) $smof_data['wd_show_sixth_footer_widget_area'] == 0){
				return;
			}
	?>	
	
			<div class="sixth-footer-widget-area footer-bg">
				<div class="container">
					<div class="sixth-footer-widget-area-1 col-sm-24">
						<?php
							if ( is_active_sidebar( 'sixth-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'sixth-footer-widget-area-1' ); ?>
								</ul>
						<?php endif; ?>								
					</div>
				</div>
			</div>
			<?php wp_reset_query();?>	
		
	<?php
		}
	}

	add_action( 'wd_footer_init', 'wd_end_footer_widget_area', 70 );
	if(!function_exists ('wd_end_footer_widget_area')){
		function wd_end_footer_widget_area(){
			global $smof_data;
			if( isset($smof_data['wd_show_end_footer_area']) && (int) $smof_data['wd_show_end_footer_area'] == 0){
				return;
			}
	?>	
			<div class="wd_footer_end footer-bg">
				<div class="container">
					<div id="copy-right" class="copy-right col-sm-12">
						<div class="copyright">
							<?php global $smof_data;?>
							<?php echo stripslashes($smof_data['footer_text']); ?>
						</div>
					</div>
					<div class="payment col-sm-12">
						<?php if( strlen($smof_data['wd_payment_image_1']) > 0 && (int)$smof_data['wd_show_payment_image_1'] == 1 ): ?>
							<a href="#"><img alt="payment 1" title ="payment 1" src="<?php echo $smof_data['wd_payment_image_1']; ?>" /></a>
						<?php endif; ?>
						<?php if( strlen($smof_data['wd_payment_image_2']) > 0 && (int)$smof_data['wd_show_payment_image_2'] == 1 ): ?>
							<a href="#"><img alt="payment 2" title ="payment 2" src="<?php echo $smof_data['wd_payment_image_2']; ?>" /></a>
						<?php endif; ?>
						<?php if( strlen($smof_data['wd_payment_image_3']) > 0 && (int)$smof_data['wd_show_payment_image_3'] == 1 ): ?>
							<a href="#"><img alt="payment 3" title="payment 3" src="<?php echo $smof_data['wd_payment_image_3']; ?>" /></a>
						<?php  endif; ?>
						<?php if( strlen($smof_data['wd_payment_image_4']) > 0 && (int)$smof_data['wd_show_payment_image_4'] == 1 ): ?>
							<a href="#"><img alt="payment 4" title="payment 4" src="<?php echo $smof_data['wd_payment_image_4']; ?>" /></a>
						<?php endif; ?>
						<?php if( strlen($smof_data['wd_payment_image_5']) > 0 && (int)$smof_data['wd_show_payment_image_5'] == 1 ): ?>
							<a href="#"><img alt="payment 5" title="payment 5" src="<?php echo $smof_data['wd_payment_image_5']; ?>" /></a>
						<?php endif; ?>
						<?php if( strlen($smof_data['wd_payment_image_6']) > 0 && (int)$smof_data['wd_show_payment_image_6'] == 1 ): ?>
							<a href="#"><img alt="payment 6" title="payment 6" src="<?php echo $smof_data['wd_payment_image_6']; ?>" /></a>
						<?php endif; ?>
					</div>
				</div>
			</div>	
			<?php wp_reset_query();?>
	
	<?php
		}
	}

	add_action( 'wd_before_footer_end', 'wd_before_body_end_content', 10 );
	if(!function_exists ('wd_before_body_end_content')){
		function wd_before_body_end_content(){
		global $smof_data;
	?>	
		<?php $_content = stripslashes($smof_data['wd_feedback_dialog_content']); ?>
		
		
		
		<?php if( strlen($_content) > 0 ):?>
			<?php if( isset( $smof_data['wd_show_feedback_button'] ) && (int)$smof_data['wd_show_feedback_button']==1): ?>
				<div id="feedback" class="wd_hidden_phone">
					<a class="feedback-button wd-prettyPhoto" href="#<?php if (strlen($_content) > 0) {  ?>wd_contact_content<?php } ?>" >
					<?php echo $smof_data['wd_feedback_button_text'] ?>
					</a>
				</div>
			<?php endif; ?>
			<div class="contact_form hidden-xs hidden" >
				<div class="contact_form_inner" style="overflow:hidden;" id="wd_contact_content"><?php echo do_shortcode($_content);?></div>
			</div>
		<?php endif;?>
		
		<?php if(!wp_is_mobile()): ?>
		<div id="to-top" class="scroll-button">
			<a class="scroll-button" href="javascript:void(0)" title="<?php _e('Back to Top','wpdance');?>"><?php _e('Top','wpdance'); ?></a>
		</div>
		<?php endif;
		}
	}
	
	
	
?>