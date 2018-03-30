<header>
            <div class="header-4">
                <?php if ($ievent_data['check_sticky_header']): ?>
                <div class="jx-ievent-header jx-ievent-sticky">
                <?php else: ?>
                <div class="jx-ievent-header">
                <?php endif; ?>
                        
                        
                    <div class="jx-ievent-topbar">
                        <div class="container">
                        
                            <div class="eight columns left">
                                <div class="jx-ievent-left-topbar"><?php echo $ievent_data['welcome_text']; ?></div>
                            </div>
                            
                            <!-- Left Items -->
                            
                            <div class="eight columns right">            
                                <div class="jx-ievent-right-topbar">
                                    <div class="jx-ievent-header-contact left"><span><i class="fa fa-phone"></i><?php echo $ievent_data['hotline_contact']; ?></span><span><i class="fa fa-envelope"></i><?php echo $ievent_data['email_contact']; ?></span> </div>
                                </div>
                            </div>  

                            <!-- Right Items -->
                        
                        </div>
                    </div>
                                
                    <div class="container">
                        <div class="sixteen columns">
                        
                            <div class="jx-ievent-logo left"><a href="<?php echo esc_url( home_url() ); ?>">
                                <img src="<?php echo esc_url($ievent_data['logo']); ?>" alt="<?php bloginfo('name'); ?>" class="logo" />
                                <?php if($ievent_data['logo_retina'] && $ievent_data['retina_logo_width'] && $ievent_data['retina_logo_height']): ?>
                                <?php
                                $pixels ="";
                                if(is_numeric($ievent_data['retina_logo_width']) && is_numeric($ievent_data['retina_logo_height'])):
                                $pixels ="px";
                                endif; ?>
                                <img src="<?php echo esc_url($ievent_data["logo_retina"]); ?>" alt="<?php bloginfo('name'); ?>" class="retina_logo" />
                                <?php endif; ?>
                                </a>
                       		</div>
                            <div class="jx-ievent-menu left">
                                <div id="jx-ievent-main-menu" class="main-menu">                               
                                    <?php
                                            
                                        if(is_page_template('template-onepage.php')):
                                            $menu_type='onepage_navigation';
                                        elseif(is_page_template('template-vc.php')):
                                            $menu_type='onepage_navigation';
                                        else:
                                            $menu_type='primary_navigation';
                                        endif;
                                        
                                        $default = array(
                                            'theme_location'  => $menu_type,
                                            'menu'            => '',
                                            'container'       => 'div',
                                            'menu_class'      => 'menu',
                                            'echo'            => true,
                                            'fallback_cb'     => '__return_false',
                                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'depth'           => 0,
                                            'walker'          => new ievent_mega_menu()
                                        );									
                                        
                                        
                                        wp_nav_menu($default);									
                                        
                                        
                                        ?>
                                        
                                                                        
										<?php if ( class_exists( 'WooCommerce' ) ) :?>
                                            <div class="jx-ievent-ticket">
                                                <a href="<?php echo esc_url( home_url('/') ); ?>shop"><?php esc_html_e('Buy Ticket','ievent'); ?></a>
                                            
                                            </div>
                                        <?php endif; ?>	
                                </div>
                                
                            </div>
                            
                            <div class="jx-ievent-header-social-icon right">
                            
                                <ul>
                                	<?php if($ievent_data['text_facebook']): ?>
                                    <li><a href="http://www.facebook.com/<?php echo $ievent_data['text_facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php endif; ?>
                                    <?php if($ievent_data['text_twitter']): ?>
                                    <li><a href="http://www.twitter.com/<?php echo $ievent_data['text_twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php endif; ?>
                                    <?php if($ievent_data['text_googleplus']): ?>
                                    <li><a href="http://www.googleplus.com/<?php echo $ievent_data['text_googleplus']; ?>"><i class="fa fa-google-plus"></i></a></li>
                                    <?php endif; ?>
                                </ul> 
                                                         
                            </div>
                            
                            
                        </div>
                        <!-- EOF columns -->
                    </div>
                </div>
            </div>        
        </header>     
        <!-- EDF Header -->