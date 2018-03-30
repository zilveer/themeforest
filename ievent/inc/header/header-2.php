<header>
            <div class="header-2">
                <?php if ($ievent_data['check_sticky_header']): ?>
                <div class="jx-ievent-header jx-ievent-sticky">
                <?php else: ?>
                <div class="jx-ievent-header">
                <?php endif; ?>
                                
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
                            <div class="jx-ievent-menu right">
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
                        </div>
                        <!-- EOF columns -->
                    </div>
                </div>
            </div>        
        </header>     
        <!-- EDF Header -->