<?php

global $clapat_bg_theme_options;

// retrieve the path to the logo displayed in the menu bar
$logo_positive_path = $clapat_bg_theme_options['clapat_bg_logo_positive']['url'];
if( !$logo_positive_path ){
    $logo_positive_path = get_template_directory_uri() . "/images/logo.png";
}

$logo_negative_path = $clapat_bg_theme_options['clapat_bg_logo_negative']['url'];
if( !$logo_negative_path ){
    $logo_negative_path = get_template_directory_uri() . "/images/logo_white.png";
}

?>
	
			<!-- Logo-->
            <div id="logo">
            	<a href="<?php echo get_home_url(); ?>">
					<img class="logo-positive" src="<?php echo esc_url( $logo_positive_path ); ?>" alt="logo">
					<img class="logo-negative" src="<?php echo esc_url( $logo_negative_path ); ?>" alt="logo">
				</a>
            </div>
        	<!--/Logo-->
            
            
            
            <!-- Menu Button-->
            <a class="btn_menu clapat-menubtn <?php if( $clapat_bg_theme_options['clapat_bg_hide_header_scroll_down'] ) echo 'hsm'; ?>">
                <span class="btn_menu_line"></span>
                <span class="btn_menu_line"></span>
                <span class="btn_menu_line"></span>
            </a>
            <!--/Menu Button-->
            
            
            
            <!-- Secondary Menu-->
            <div id="secondary-menu" class="hide-secondary">
                <?php if( ( is_page_template('portfolio-page.php') || is_page_template('portfolio-mixed-page.php') ) && $clapat_bg_theme_options['clapat_bg_portfolio_secondary_menu'] ){ ?>
                <ul class="menu">
                    <li><a class="toggle-filters" href="#"><?php
                    $show_filters = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-show-filters' );
                    if( $show_filters ){
                        echo $clapat_bg_theme_options['clapat_bg_portfolio_secondary_menu_hide'];
                    } else {
                        echo $clapat_bg_theme_options['clapat_bg_portfolio_secondary_menu_show'];
                    }
                    ?></a></li>
                </ul>
                <?php } else if( (is_page_template('blog-page.php') || is_category() || is_search()) && $clapat_bg_theme_options['clapat_bg_blog_secondary_menu'] ) {
                
                	$display_search = true;
                	if( is_search() || is_category() ){
                		
                		$post_types = get_query_var('post_type');
                		if( is_array( $post_types ) ) {
                			
                			if( !in_array('post', $post_types) ){
                		                			
                				$display_search = false;
                			}
                		}
                		else if( $post_types != 'post' ){
                			$display_search = false;
                		}
                	}
                	
                	if( $display_search ){
                	?>
                <ul class="menu">
                    <li><a class="toggle-search" href="#"><?php echo $clapat_bg_theme_options['clapat_bg_blog_secondary_menu_show']; ?></a></li>
                </ul>
                <?php    }  ?>
                <?php } else if( is_page_template('contact-page.php') && $clapat_bg_theme_options['clapat_bg_map_secondary_menu'] ){ ?>
                    <ul class="menu">
                        <li><a class="toggle-sm" href="#"><?php
                                $show_contact = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-toggle-contact-info' );
                                if( $show_contact ){
                                    echo $clapat_bg_theme_options['clapat_bg_map_secondary_menu_hide'];
                                } else {
                                    echo $clapat_bg_theme_options['clapat_bg_map_secondary_menu_show'];
                                }
                        ?></a></li>
                    </ul>
                <?php } else if( function_exists('is_woocommerce') ) {
                	if (  is_woocommerce() ) {
                ?>		
                		
                		<!-- Shopping Cart -->            
                		<ul class="site-header-cart menu">
                
                    		<li><a class="cart-contents"></a></li>
                    
                    		<!-- Shopping Cart Dropdown -->
                    		<?php the_widget('WC_Widget_Cart'); ?>
                    		<!-- //Shopping Cart Dropdown -->
                    	</ul>	
                <?php    		
                	} 
                			if( is_shop() ){
                ?>
                <!-- Toggle Shop Filters --> 
                <ul class="menu">
                    <li><a class="toggle-shop-filters" href="#"><?php echo $clapat_bg_theme_options['clapat_bg_shop_filters_show']; ?></a></li>
                </ul>
                <!--/Toggle Shop Filters -->
                			<?php } ?>    
                <?php } else if( is_singular() ) {
                    if( (get_post_type() == 'post') && $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu'] ){ ?>
                <ul class="menu">
                    <li><a class="toggle-share" href="#"><?php echo $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu_show']; ?></a></li>
                </ul>
                    <?php } ?>
                <?php } ?>

            </div>
            <!--/Secondary Menu-->
            
            
            
            <!-- Overlay Menu-->
            <nav class="clapat-overlay-menu">
                    
                <div class="clapat-menu-container">
                        
                    <div class="outer">
                        <div class="inner">
                        
                        
                            <div class="scr_menu">
                            
                                <div class="outer">
                                    <div class="inner text-align-center">
                                
                                        <?php
										
										wp_nav_menu(array(
											'menu_class' => 'categories',
											'menu_id' => 'nav',
											'echo' => true
										));
										?>
                                
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    
                    
                    <a class="clapat-menuclosebtn">
                    	<div class="closebtn-rotate">
                            <span class="btn_menu_line"></span>
                            <span class="btn_menu_line"></span>
                        </div>
            		</a>
                    
					<?php if( $clapat_bg_theme_options['clapat_bg_menu_copyright'] ){ ?>
                    <p class="menu-copyright"><?php echo $clapat_bg_theme_options['clapat_bg_footer_copyright']; ?></p>
                    <?php } ?>
					
                    <?php if( $clapat_bg_theme_options['clapat_bg_menu_copyright'] ){ 
							get_template_part('sections/menu_social_links_section');
                    } ?>
                       
                </div>
                
                
                <div class="clapat-menubg"><div class="clapat-menubg-overlay"></div></div>
                
                
            </nav>
            <!--/Overlay Menu-->