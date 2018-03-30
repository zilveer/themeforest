<?php

/* ------------------------------------
:: CONFIGURE HEADER
------------------------------------*/ 


	$fixed_header = ( of_get_option('sticky_menu') != 'disable' ) ? 'fixed' : '';  
	
	if( $collapse_menu == 'collapse-menu' || $collapse_menu == 'collapse-menu-mobile' )
	{
		echo '<div class="collapse-menu-trigger-wrap '. ( $collapse_menu == 'collapse-menu-mobile' ? 'mobile' : '' ) .' skinset-header nv-skin"><div class="collapse-menu trigger"><i class="fa fa-bars fa-lg"></i></div></div>';
	} ?>


	<header id="header-wrap" class="<?php echo $NV_frame_header .' '. $NV_autohide_menu . ' '. $collapse_menu .' '. $header_float .' '. $NV_navalign .' ' . $fixed_header;  ?> clearfix <?php if ( of_get_option('sticky_menu') != 'disable' && $header_layout != 'left' ) { echo ' sticky-header'; } ?>" <?php echo $auto_hide_menu_timeout; ?>>
		<div id="header-bg" class="skinset-header nv-skin"></div>    
        
		<div id="header" class="skinset-header nv-skin clearfix">
		<?php 
		
		if( of_get_option('enable_responsive') !== 'disable' || of_get_option('enable_search') !=='disable' || class_exists('Woocommerce') || class_exists('SitePress') || of_get_option('header_customfield') || $NV_socialicons == "yes" )
		{  ?>
            
			<div class="dock-panel-wrap">
				<ul class="dock-panel clearfix">
				<?php 

				if ( class_exists('SitePress') )
				{ ?>
					<li class="wpml-trigger dock-tab">
						<a data-show-dock="wpml" class="dock-tab-trigger" href="#"><i class="fa fa-flag-o fa-lg"></i></a>
						<ul class="dock-tab-wrapper wpml skinset-header nv-skin">
							<li><?php do_action('icl_language_selector'); ?></li>
						</ul>
					</li>				
				<?php
				}				

				$mobile_social = '';
				
				if( $NV_socialicons == "yes" )
				{
					require NV_FILES .'/inc/social-icons.php';

					if( of_get_option('enable_responsive') != 'disable' && $NV_disableheart == 'yes' )
					{
						$mobile_social = 'mobile-social';
						require NV_FILES .'/inc/social-icons.php';
					}
				}							
							
				if( of_get_option('enable_search') !='disable' )
				{ ?>  
                	<li class="search-trigger dock-tab">
                    	<a data-show-dock="searchform" class="dock-tab-trigger" href="#"><i class="fa fa-search fa-lg"></i></a>
                        <ul class="dock-tab-wrapper searchform skinset-header nv-skin">
                            <li>
                                <form method="get" id="panelsearchform" class="disabled" action="<?php echo home_url(); ?>">
                                    <fieldset>
                                        <input type="text" name="s" id="drops" />
                                        <i class="fa fa-search fa-lg" id="panelsearchsubmit"></i>
                                    </fieldset>
                                </form>
                            </li>
                        </ul>
                    </li>
				<?php 
				} 

				// WooCommerce Shopping Cart			
				if( class_exists('Woocommerce') )
				{
					global $woocommerce;  ?>
                    <li class="cart-trigger dock-tab">
						<a data-show-dock="shop-cart" class="dock-tab-trigger" href="#">
							<?php 				
							// Show count if more than 1
							$display = '';
							
							if( $woocommerce->cart->cart_contents_count >=1 )
							{
								$display = 'display';
							}
							
							echo '<span class="items-count '. $display .'">'. $woocommerce->cart->cart_contents_count .'</span>'; 
							 ?>                     
                        	<i class="fa fa-shopping-cart fa-lg"></i>
						</a>
                        <ul class="dock-tab-wrapper skinset-header nv-skin shop-cart">
                            <li>
								<span class="shop-cart-items">
									<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'themeva'); ?>">
										<span class="shop-cart-itemnum">
                                        	<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'themeva'), $woocommerce->cart->cart_contents_count);?> -
                                    	</span>
                                    	<?php echo $woocommerce->cart->get_cart_total(); ?>
                                	</a>
                            	</span>
                            </li>
                        </ul>
                    </li>
				<?php
              }	
				
				if ( is_active_sidebar('infopanel') )
				{ ?>
					<li class="infopanel-trigger dock-tab">
                    	<a data-show-dock="infodock" class="dock-tab-trigger" href="#"><i class="fa fa-info fa-lg"></i></a>
                        <ul class="dock-tab-wrapper infodock skinset-header nv-skin">
                          	<li>
                            	<ul>
                              		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Information Panel')) : endif; ?>
								</ul>
                            </li>
                        </ul>
                    </li>					
				<?php
              } 
				
				
				if( of_get_option('enable_responsive') != 'disable' )			
				{ ?>
					<li class="dock-tab mobile-menu">
						<a class="dock-menu-trigger" href="#"><i class="fa fa-bars fa-lg"></i></a>
					</li>						
				<?php
                } ?>
				</ul>
                <div class="clear"></div>  
			</div>     
			<?php 
			} 
			
			echo "\n" . '<div class="header-inner-wrap">';
			echo "\n" . '<div class="header-inner '. ( $header_layout == '' || $header_layout == 'left' ? 'flexcroll' : '' ) .'">';
			
				if( $header_layout != 'top-rl' ) : ?>
					
					<div id="header-logo">
						<div id="logo">
						<?php 
						
						$ver = '';
						
						if( of_get_option('branding_url') ) : // Is Branding Image Set 
				
							if( $NV_branding_ver == 'secondary' ) : 
								$NV_branding_url = of_get_option('branding_url_sec'); 
								$ver = 'secondary';
							else : 
								$NV_branding_url = of_get_option('branding_url'); // check is secondary branding is selected 
								$ver = 'primary';
							endif; ?>
		
							<a href="<?php echo home_url(); ?>/">
					
								<?php
								// Transparent Logo
								if( $NV_transparent_branding_ver != '' && $NV_transparent_branding_ver != $NV_branding_ver && $header_float == 'header_float header_transparent' && of_get_option('sticky_menu') != 'disable' )
								{ 
									if( $NV_transparent_branding_ver == 'secondary' ) : 
										$NV_transparent_branding_url = of_get_option('branding_url_sec'); 
										$trans_ver = 'secondary';
									else : 
										$NV_transparent_branding_url = of_get_option('branding_url'); // check is secondary branding is selected 
										$trans_ver = 'primary';
									endif; ?>
									
									<img src="<?php echo $NV_branding_url; ?>" class="sticky <?php echo $ver; ?>" alt="<?php bloginfo('name'); ?>" />		
									<img src="<?php echo $NV_transparent_branding_url; ?>" class="transparent <?php echo $trans_ver; ?>" alt="<?php bloginfo('name'); ?>" />
								<?php
								}	
								else
								{ ?>
									<img src="<?php echo $NV_branding_url; ?>" class="<?php echo $ver; ?>" alt="<?php bloginfo('name'); ?>" />								
								<?php
								}
								?>
						  
							</a>
						   
						   <?php 

							if( get_bloginfo('description') != '' && of_get_option('header_tagline') != 'disable' ) :
							   echo '<h2 class="description">'. get_bloginfo('description') .'</h2>'; 
							endif;  
					   
	
						else: ?>
						
							<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>

                         <?php

							if( get_bloginfo('description') != '' && of_get_option('header_tagline') != 'disable' ) :
							   echo '<h2 class="description">'. get_bloginfo('description') .'</h2>'; 
							endif;  
							
						endif; ?>
						</div>
						<div class="clear"></div>
					</div><!-- /header-logo -->
				<?php 
				endif; 
 	
				if( !class_exists('UberMenu') )
				{
					echo '<nav id="nv-tabs">';
                    
					// WP3.0 Custom Menu Support
					if( of_get_option('wpcustomm_enable') !='disable' ) : 
                        
						$menu_slug = ( get_post_meta( $post->ID, '_cmb_menu', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_menu', true ) : '';
                        
						$selected_menu = '';
						
						if ( empty( $menu_slug ) && !has_nav_menu( 'mainnav' ) ) 
						{
							$selected_menu = 'none';
						}
						
						if(  $menu_slug != 'disable' && $selected_menu !='none' ) :
									
							$walker = new dyn_walker;
								
							wp_nav_menu( array(
								'echo' => true,
								'container' => 'ul',
								'menu_class' => 'menu hide-on-phones',
								'menu_id' => 'dyndropmenu',
								'theme_location' => 'mainnav',
								'walker' => $walker,
								'menu' => $menu_slug
							));
						
						else:
						
						endif;
						
						$selected_menu = '';

						if ( empty( $menu_slug ) && !has_nav_menu( 'mobilenav' ) && !has_nav_menu( 'mainnav' ) ) 
						{
							$selected_menu = 'none';
						}					
						
						
						// Mobile Menu
						if( has_nav_menu( 'mobilenav' ) )
						{
							$mobile_location = 'mobilenav';
						}
						else
						{
							$mobile_location = 'mainnav';
						}

						if( of_get_option('enable_responsive') !== 'disable' && ( $menu_slug != 'disable' && $selected_menu !='none' ) ) :
									
							$walker = new dyn_walker;
								
							wp_nav_menu( array(
								'echo' => true,
								'container' => 'ul',
								'menu_class' => 'menu hide-on-desktops',
								'menu_id' => 'mobilemenu',
								'theme_location' => $mobile_location,
								'walker' => $walker,
								'menu' => $menu_slug
							));
						
						endif;							
					
                    else :
                        
                        ?>
                        
                        <ul id="dropmenu" class="skinset-menu nv-skin menu">
                        <?php echo DYN_menupages(); ?>
                            <li class="menubreak"></li>
                        <?php 
                        
                        if( of_get_option('droppanel') !='disable' )
                        { 
                            if( of_get_option('droptriggername') !='' ) 
                            { ?>
                                <li class="page_item">
                                    <a href="#" class="droppaneltrigger" title="<?php echo of_get_option('droptriggername'); ?>"><?php echo of_get_option('droptriggername'); ?></a>
                                    <span class="menudesc"><?php echo of_get_option('droptriggerdesc'); ?></span>
                                </li>
                            <?php 
                            }
                        } ?>
                        </ul>
					<?php 
 					endif;
					
					echo '</nav><!-- /nv-tabs -->';
				}
				else
				{
					wp_nav_menu( array(
						'theme_location' => 'mainnav'
					));		
					
				}

				if( $header_layout == 'top-rl' ) : ?>
					
					<div id="header-logo">
						<div id="logo">
						<?php 
						
						$ver = '';
						
						if( of_get_option('branding_url') ) : // Is Branding Image Set 
				
							if( $NV_branding_ver == 'secondary' ) : 
								$NV_branding_url = of_get_option('branding_url_sec'); 
								$ver = 'secondary';
							else : 
								$NV_branding_url = of_get_option('branding_url'); // check is secondary branding is selected 
								$ver = 'primary';
							endif; ?>
	
							<a href="<?php echo home_url(); ?>/"><img src="<?php echo $NV_branding_url; ?>"  class="<?php echo $ver; ?>" alt="<?php bloginfo('name'); ?>" /></a>
						   
						   <?php 
	
							if( get_bloginfo('description') != '' && of_get_option('header_tagline') != 'disable' ) :
							   echo '<h2 class="description">'. get_bloginfo('description') .'</h2>'; 
							endif;  
					   
	
						else: ?>
						
							<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
                            
                         <?php

							if( get_bloginfo('description') != '' && of_get_option('header_tagline') != 'disable' ) :
							   echo '<h2 class="description">'. get_bloginfo('description') .'</h2>'; 
							endif;                                

						endif; ?>
						</div>
						<div class="clear"></div>
					</div><!-- /header-logo -->
				<?php 
				endif; 				
				
				if( $header_layout == 'top-rl' || $header_layout == 'top-lr' || $header_layout == 'top-cc' )
				{
					echo "\n" . '</div>'; 	
				}
		
				if ( is_active_sidebar('menusidepanel') )
				{ ?>
					<ul class="menu-sidebar-panel clearfix">
						<li>
							<ul>
								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Menu Sidebar Panel')) : endif; ?>
							</ul>
						</li>
                    </ul>					
				<?php
				} 
								
			if( $header_layout == 'left' || $header_layout == '' )
			{
				echo "\n" . '</div>'; 	
			}
			
			echo "\n" . '</div>'; ?>
                
		</div><!-- /header -->
	</header><!-- /header-wrap -->