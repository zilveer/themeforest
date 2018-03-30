<div class="gbtr_header_wrapper">
    <div class="container_12">
        
        <div class="grid_3">
            <a href="<?php echo home_url(); ?>" class="gbtr_logo">
            
            <?php
			if ( !$theretailer_theme_options['site_logo'] ) {
				
				if (is_ssl()) {
					$site_logo_img = str_replace("http://", "https://", get_template_directory_uri() . "/images/logo.png");		
				} else {
					$site_logo_img = get_template_directory_uri() . "/images/logo.png";	
				}
				
			} else {
				
				if (is_ssl()) {
					$site_logo_img = str_replace("http://", "https://", $theretailer_theme_options['site_logo']);		
				} else {
					$site_logo_img = $theretailer_theme_options['site_logo'];
				}
			}
			?>
            
            <img src="<?php echo $site_logo_img; ?>" alt="" />
            </a>
        </div>
        
        <script type="text/javascript">
		//<![CDATA[
			
			// Set pixelRatio to 1 if the browser doesn't offer it up.
			var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
			
			logo_image = new Image();
			
			(function($){
				$(window).load(function(){
					
					if (pixelRatio > 1) {
						$('.gbtr_logo img').each(function() {
							
							var logo_image_width = $(this).width();
							var logo_image_height = $(this).height();
							
							$(this).css("width", logo_image_width);
							$(this).css("height", logo_image_height);
							<?php if ( !$theretailer_theme_options['site_logo'] ) { ?>
								$(this).attr('src', '<?php echo get_template_directory_uri(); ?>/images/logo@2x.png');
							<?php } else if ($theretailer_theme_options['site_logo_retina']) { ?>
								$(this).attr('src', '<?php echo $theretailer_theme_options['site_logo_retina'] ?>');
							<?php } ?>
						});
					}
				
				})
			})(jQuery);
			
		//]]>
		</script>
        
        <div class="grid_9">
        	<div class="menus_envelope">
            <div class="menus_wrapper
                <?php if (($theretailer_theme_options['shopping_bag_style']) && ($theretailer_theme_options['shopping_bag_style'] == "style2")) { ?>
                    menus_wrapper_shopping_bag_mobile_style
                <?php } ?>
                <?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "0")) { ?>
                    menus_wrapper_no_shopping_bag_in_header
                <?php } ?>
                <?php if ( !has_nav_menu( 'secondary' ) ) { ?>
                    menus_wrapper_no_secondary_menu
                <?php } ?>
                " <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>style="margin:0"<?php } ?>>
                <div class="gbtr_first_menu">
                    <div class="gbtr_first_menu_inside">                        
						<nav class="main-navigation first-navigation" role="navigation">  
                            <ul class="sf-menu">                        
	                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
	                            <?php  
	                            wp_nav_menu(array(
	                                'theme_location' => 'primary',
	                                'container' =>false,
	                                'menu_class' => '',
	                                'echo' => true,
	                                'items_wrap'      => '%3$s',
	                                'before' => '',
	                                'after' => '',
	                                'link_before' => '',
	                                'link_after' => '',
	                                'depth' => 0,
	                                'fallback_cb' => false,
	                            ));
	                            ?>
	                            <?php else: ?>
	                                <a>Define your primary navigation.</a>
	                            <?php endif; ?>
							</ul>
						</nav>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="gbtr_second_menu">
					<nav class="secondary-navigation main-navigation" role="navigation">  
						<ul>
							<?php if ( has_nav_menu( 'secondary' ) ) : ?>
							<?php  
							wp_nav_menu(array(
								'theme_location' => 'secondary',
								'container' =>false,
								'menu_class' => '',
								'echo' => true,
								'items_wrap'      => '%3$s',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 0,
								'fallback_cb' => false,
							));
							?>
							<?php else: ?>
							<style>
							.gbtr_first_menu_inside {
								border-bottom: 0;
							}
							</style>
							<?php endif; ?>
						</ul>
					</nav>
                </div>
            </div>
            
            <div class="
            <?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "0")) { ?>
                menus_wrapper_no_shopping_bag_in_header
            <?php } ?> mobiles_menus_wrapper">
                <div class="gbtr_menu_mobiles">
                <div class="gbtr_menu_mobiles_inside
                <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>
                gbtr_menu_mobiles_inside_catalog_mode
                <?php } ?>
                ">
                    <select>
                        <option selected><?php _e('Navigation', 'theretailer'); ?></option>
                        <?php
                        class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
                            function start_lvl(&$output, $depth = 0, $args = array()){
                              $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
                            }
                        
                            function end_lvl(&$output, $depth = 0, $args = array()){
                              $indent = str_repeat("\t", $depth); // don't output children closing tag
                            }
                        
                            function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
                              
                              // add spacing to the title based on the depth
                              $item->title = str_repeat("-", $depth). " " . $item->title;
                        
                              parent::start_el($output, $item, $depth, $args);
                              
                              $output = preg_replace( '/ title="[^"]*"/', '', $output );
							  
							  $output = str_replace("<li", "\n<option", $output);
                              
                              $output = str_replace('target="_blank" ', '', $output);
                              $output = str_replace('><a href=', ' value=', $output);
                              $output = str_replace('</a></option>', '</option>', $output);
                              $output = str_replace('</option></option>', '</option>', $output);
                              $output = str_replace("</a>", "</option>\n", $output);
							  $output = strip_tags($output, '<option>');
                            }
                        
                            function end_el(&$output, $item, $depth = 0, $args = array()){
                            }
                        }
                        
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' =>false,
                            'menu_class' => '',
                            'echo' => true,
                            'items_wrap'      => '%3$s',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'depth' => 0,
                            'fallback_cb' => false,
                            'walker' => new Walker_Nav_Menu_Dropdown()
                        ));
                        
                        wp_nav_menu(array(
                            'theme_location' => 'secondary',
                            'container' =>false,
                            'menu_class' => '',
                            'echo' => true,
                            'items_wrap'      => '%3$s',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'depth' => 0,
                            'fallback_cb' => false,
                            'walker' => new Walker_Nav_Menu_Dropdown(),
                        ));
                        
                        ?>
                    </select>            
                </div>
                
                </div>
                
                <?php if (($theretailer_theme_options['shopping_bag_in_header']) && ($theretailer_theme_options['shopping_bag_in_header'] == "1")) { ?>
                
                <?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
                
                <?php 
                /**
                * Check if WooCommerce is active
                **/
                if (class_exists('WooCommerce')) {
                
                ?>
                
                <!---->
                
                <div class="gbtr_dynamic_shopping_bag">
            
                    <div class="gbtr_little_shopping_bag_wrapper 
                    <?php if (($theretailer_theme_options['shopping_bag_style']) && ($theretailer_theme_options['shopping_bag_style'] == "style2")) { ?>
                        shopping_bag_mobile_style
                    <?php } else { ?>
                        shopping_bag_default_style
                    <?php } ?>
                    
                    <?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "1")) { ?>
                        shopping_bag_in_header
                    <?php } else{ ?>
                        no_shopping_bag_in_header
                    <?php } ?>
                    ">
                        <div class="gbtr_little_shopping_bag">
                            <div class="title"><a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"><?php _e('Cart', 'woocommerce'); ?></a></div>
                            <div class="overview"><?php echo WC()->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'theretailer' ), WC()->cart->cart_contents_count ); ?></span></div>
                            <div class="gb_cart_contents_count"><?php echo WC()->cart->cart_contents_count; ?></div>
                        </div>
                        <div class="gbtr_minicart_wrapper">
                            <div class="gbtr_minicart">
                            	<?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'theretailer_WC_Widget_Cart' ); } ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo WC()->cart->cart_contents_count; ?></span></a>
                
                </div>
                
                <!---->
                
                <?php } ?>
                
                <?php } ?>
                
                <?php } ?>
                
                <div class="clr"></div>
            
            </div><!--/menus_wrapper-->
            </div><!--/menus_envelope-->            
            
        </div><!--/grid_9-->
        
    </div>
</div>