<?php

/* ------------------------------------
:: CONFIGURE HEADER
------------------------------------*/ 

	if( $show_slider == "stageslider" ||
		$show_slider == "nivo" ||
		$show_slider == "islider" || 
		$show_slider == "gallery3d" || 
		$show_slider == "revslider" ||
		$show_slider == "galleryaccordion" && is_page() )
	{
		$page_type = 'gallery'; 
	}
	else
	{
		$page_type = 'pages'; 
	}
	
	if( !empty( $NV_infobar ) ) 
	{ ?>
		<div class="header-infobar <?php echo $NV_infobar_classes; ?>">
			<div class="infobar-content"><?php echo do_shortcode($NV_infobar); ?></div><span class="infobar-close"><a href="#"></a></span>
		</div>
	<?php 
	}
	
	// Check if drop panel is enabled or infobar is empty
	$NV_isdroppanel = '';
	
	if( of_get_option('enable_droppanel' ) != 'disable' || !empty ( $NV_infobar ) || of_get_option('header_customfield') !='' || of_get_option('enable_search') !='disable' )
	{ 
		$NV_isdroppanel = 'droppanel'; ?> 

		<div id="toppanel">			
		<?php
					
		if( of_get_option('enable_droppanel' ) !='disable' || of_get_option('header_customfield') != '' || of_get_option('enable_search') !='disable' ) 
		{ 
			if( of_get_option('enable_droppanel' ) !='disable' )
			{ ?>    
				<div id="topslidepanel" style=" <?php if(isset($hasError) || isset($captchaError)) { ?>min-height:300px <?php } ?>">
					<div class="content row">
					<?php
					
					echo '<div class="toppaneltrigger-wrap">';
					echo '<div class="toppaneltrigger mobile skinset-main nv-skin"><a class="close-toppanel" href="#"><i class="fa fa-times fa-lg"></i></a></div>';
					echo '</div>';
                    
					// If not set, default to 4 columns
					$get_droppanel_num = ( of_get_option('droppanel_columns_num') !="" ) ? of_get_option('droppanel_columns_num' ) : '4'; 
                    
					// convert number to word
					$NV_droppanelcolumns_text = numberToWords( $get_droppanel_num ); 
						
					$i = 1;
                 
					while( $i <= $get_droppanel_num )
					{ 
						if ( is_active_sidebar( 'droppanel'.$i ) ) 
						{ ?>
							<div class="block columns <?php echo $NV_droppanelcolumns_text."_column "; if($i == $get_droppanel_num) { echo "last"; } ?>">	
								<ul>
									<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Drop Panel Column '.$i)) : endif; ?>
								</ul>
							</div>
						<?php 
						} $i++;	
					} ?>
					</div><!-- / content -->
				</div> <!-- / panel -->
            <?php 
			} ?>
			
            <div class="tab-wrap">
				<ul class="icon-dock clearfix">
                            <?php
                            if( of_get_option('enable_search') !='disable' )
                            { ?>                       
                                <li class="searchform">
                                    <form method="get" id="panelsearchform" action="<?php echo home_url(); ?>" class="active">
                                        <fieldset>
                                            <input type="text" name="s" id="drops" placeholder="<?php _e('Search', 'themeva' ); ?>" />
                                            <input type="button" id="panelsearchsubmit" value="&#xf002;" />
                                        </fieldset>
                                    </form>
                                </li>
                            <?php 
                            } 
                            
                            // Custom Header Field			
                            if( of_get_option('header_customfield') )
                            {
								$class = '';
								if( of_get_option('enable_search') =='disable' ) $class = 'collapse';
								
                                echo '<li class="customfield '. $class .'"><div class="custom-content">'.do_shortcode( of_get_option('header_customfield') ).'</div></li>'; 
                            }

                            // WPML ( SitePress )			
							if ( class_exists('SitePress') )
							{ ?>
								<li class="wpml-tab">
									<?php do_action('icl_language_selector'); ?>
								</li>				
							<?php
							}				
            
                            // WooCommerce Shopping Cart			
                            if( class_exists('Woocommerce') )
                            {
                                global $woocommerce;  ?>
                                <li class="shop-cart">
                                    <span class="shop-cart-items">
                                        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'themeva'); ?>">
                                            <span class="shop-cart-itemnum">
                                                <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'themeva'), $woocommerce->cart->cart_contents_count);?> -
                                            </span>
                                            <?php echo $woocommerce->cart->get_cart_total(); ?>
                                        </a>
                                    </span>
                                    <span class="shop-cart-icon">
                                        <a target="_parent" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"></a>
                                    </span>
                                </li>
                            <?php
                            }
                            
                            // WP e-Commerce Shopping Cart
                            if ( function_exists('wpsc_cart_item_count') ) 
                            { ?>
                                <li class="shop-cart">
                                    <span class="shop-cart-items">
                                        <a target="_parent" href="<?php echo get_option('shopping_cart_url'); ?>"><span class="shop-cart-itemnum"><?php echo wpsc_cart_item_count(); ?></span> <?php _e( 'items', 'themeva' ); ?></a> 
                                    </span>
                                    <span class="shop-cart-icon">
                                        <a target="_parent" href="<?php echo get_option('shopping_cart_url'); ?>"></a>
                                    </span>
                                    <div class="shopping-cart-wrapper widget_wp_shopping_cart shop-cart-contents">
                                        <?php include( wpsc_get_template_file_path( 'wpsc-cart_widget.php' ) ); ?>
                                    </div>
                                </li>
                            <?php 
                            }
							
							if( of_get_option('enable_droppanel' ) !='disable' )
							{ ?>
								<li class="toppaneltrigger">
									<a class="toggle" href="#"><i class="fa fa-lg fa-chevron-down"></i></a>
								</li>									
							<?php
							} ?>
				</ul>
			</div> <!-- / tab-wrap -->
		<?php 				
		} ?>
            
		</div> <!--/toppanel -->
	<?php 
	} 
	
	$menu_slug 		= ( get_post_meta( $post->ID, '_cmb_menu', true ) !='' ) 				? get_post_meta( $post->ID, '_cmb_menu', true ) : '';
	$onepage_mobile 	= ( get_post_meta( $post->ID, '_cmb_onepage_mobile', true ) !='' ) 	? 'onepage_config' : '';
	
	if( of_get_option('mobile_menu') != 'select' && !class_exists('UberMenu') )
	{				
		echo "\n". '<div id="mobile-tabs" class="skinset-main nv-skin '. $onepage_mobile .'">';
	
		echo '<div class="mobilemenu-init clearfix skinset-main nv-skin"><a href="#"><i class="fa fa-times fa-lg"></i></a></div>';
	
			if( $menu_slug != 'disable' ) :
			
				if ( !class_exists('UberMenu') && ( of_get_option('enable_responsive') !='disable' ) ) : // check if responsive is disabled
	
					if ( has_nav_menu( 'mobilenav' ) )
					{
						$walker = new dyn_walker;

						wp_nav_menu( array(
							'echo' => true,
							'container' => 'ul',
							'menu_class' => 'menu hide-on-desktops', 
							'menu_id' => 'mobilemenu',
							'theme_location' => 'mobilenav',
							'walker' => $walker,
							'menu' => $menu_slug
						));						
					}
					elseif ( has_nav_menu( 'mainnav' ) )
					{
						$walker = new dyn_walker;

						wp_nav_menu( array(
							'echo' => true,
							'container' => 'ul',
							'menu_class' => 'menu hide-on-desktops', 
							'menu_id' => 'mobilemenu',
							'theme_location' =>  'mainnav',
							'walker' => $walker,
							'menu' => $menu_slug
						));						
					}
					
				endif;
			endif;
			
		echo "\n". '</div>';
	}
	
	?>
    


	<div class="header-wrap <?php echo $page_type . ( of_get_option('sticky_menu') != 'disable' ? ' sticky-header' : '' ); ?>">
    	<div class="header-skin-wrap">
            <div id="custom-layer1" class="custom-layer"></div>
            <div id="custom-layer2" class="custom-layer"></div>
            <div class="shadow top custom-layer"></div>      
        </div>     
        <div class="wrapper">
			<header id="header" class="skinset-header row nv-skin <?php echo $NV_isdroppanel. ' '. $page_type. ' '. $NV_header_divider; ?>">            
        	
			<?php 

			if( of_get_option('mobile_menu') != 'select' )
			{
				echo '<div class="mobilemenu-init skinset-main nv-skin"><a href="#" '. $onepage_mobile .'><i class="fa fa-bars fa-lg"></i></a></div>';
			} 				

			if( of_get_option('enable_droppanel' ) != 'disable' )
			{ 			
				echo '<div class="toppaneltrigger mobile skinset-main nv-skin"><a class="toggle" href="#"><i class="fa fa-lg fa-chevron-down"></i></a></div>';
			}
                
           if( of_get_option('header_html') )
           { ?>
				<div class="custom-html"><?php echo do_shortcode( of_get_option('header_html') ); ?></div>
           <?php 
           }
                    
           if( get_option('branding_disable') !='disable' ) : ?>
                    
                <div id="header-logo" class="<?php echo $NV_branding_alignment; ?>">
                    <div id="logo">
                    <?php 
                    if( of_get_option('branding_url') ) : // Is Branding Image Set 
                		
						$ver = '';
						
						if( $NV_branding_ver == 'secondary' ) : 
							$NV_branding_url = of_get_option('branding_url_sec'); 
							$ver = 'secondary';
						else : 
							$NV_branding_url = of_get_option('branding_url'); // check is secondary branding is selected 
							$ver = 'primary';
						endif; ?>
    
						<a href="<?php echo home_url(); ?>/"><img src="<?php echo $NV_branding_url; ?>" class="<?php echo $ver; ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php
						
						if( get_bloginfo('description') !='' && of_get_option('header_tagline') == 'enable' ) :
						   echo '<h2 class="description">'. get_bloginfo('description') .'</h2>'; 
						endif;  					
                        
                    else: ?>
                        
                        <h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
                        <h2 class="description"><?php bloginfo('description'); ?></h2>
                            
                    <?php 
                    endif; ?>
                    </div>
                    <div class="clear"></div>
                   </div><!-- /header-logo -->
	 			<?php 
				endif;

				if( !class_exists('UberMenu') )
				{					
					echo '<nav id="nv-tabs" class="static '. $NV_menu_alignment .'">';
	   
				   		// WP3.0 Custom Menu Support
						if( of_get_option('wpcustomm_enable') !='disable' ) : 
                                              
                        if( $menu_slug != 'disable' ) :
                            
								if( has_nav_menu( 'mainnav' ) )
								{
									$walker = new dyn_walker;
									
									wp_nav_menu( array(
										'echo' => true,
										'container' => 'ul',
										'menu_class' => 'menu clearfix hide-on-phones', 
										'menu_id' => 'dyndropmenu',
										'theme_location' => 'mainnav',
										'walker' => $walker,
										'menu' => $menu_slug
									));
								}
                        
                        
                            if ( of_get_option('enable_responsive') !='disable' && of_get_option('mobile_menu') == 'select' ) : // check if responsive is disabled
							
									if ( has_nav_menu( 'mobilenav' ) )
									{
										$walker = new dyn_walker;
										
										wp_nav_menu( array(
											'theme_location' =>  'mobilenav',
											'container' => 'div',
											'container_class' => 'hide-on-desktops', 
											'container_id' => 'nv_selectmenu',					
											'walker' => new Walker_Nav_Menu_Dropdown(),
											'items_wrap' => '<select><option value="">'.__( 'Select a Page', 'themeva' ).'</option>%3$s</select>',
											'menu' => $menu_slug
										));
									}
									elseif ( has_nav_menu( 'mainnav' ) )
									{
										$walker = new dyn_walker;
										
										wp_nav_menu( array(
											'theme_location' =>  'mainnav',
											'container' => 'div',
											'container_class' => 'hide-on-desktops', 
											'container_id' => 'nv_selectmenu',					
											'walker' => new Walker_Nav_Menu_Dropdown(),
											'items_wrap' => '<select><option value="">'.__( 'Select a Page', 'themeva' ).'</option>%3$s</select>',
											'menu' => $menu_slug
										));
									}
                                
                            endif;
                        endif;
                    
                    else :
                        
                        if ( of_get_option('enable_responsive') !='disable' ) : // check if responsive is disabled ?>
                                          
                            <div id="nv_selectmenu" class="wp-page-nav">
                                <?php wp_dropdown_pages( $args ); ?> 
                            </div> 
                        <?php 
                        endif; ?>
                        
                        <ul id="dropmenu" class="skinset-menu nv-skin menu">
                        <?php echo DYN_menupages(); 
                        
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
				} ?>					
				
				<div class="clear"></div>
			</header><!-- /header -->     
        </div>
    </div>