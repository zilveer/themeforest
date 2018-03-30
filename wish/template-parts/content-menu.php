    <?php  
        $redux_wish = wish_redux();
        $logo_image = $redux_wish['wish-logo-image'];
    ?>

    <div id="preloader">
            <div class="preloader"><img src="<?php echo esc_url( get_template_directory_uri() )  ?>/images/icons/progress/progress.gif" width="64" height="64" alt=""></div>
        </div>

        <div class="wish-rkt-menu-default">
                <div class="container">
                    <div class="wish-wp-menu-wrapper">
                        <div class="wish-primary-menu">
                            <div class="row">
                                <div class="container">
                                    <div class="wish-wp-menu-wrapper">

                                      <div id="load-mobile-menu">
                                </div>
                                        <div class="logo image">
                                                <a href="" rel="home" style="max-width: 225px;">
                                                <span class="helper"></span><img src="<?php echo esc_url($logo_image['url']); ?>" alt=""></a>
                                        </div>  

                                       
                                        <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                            <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'before' => '',
                                                'after' => '',
                                                'link_before' => '',
                                                'link_after' => '',
                                                'depth' => 4,
                                                'container' => 'div',
                                                'container_class' => 'wish-rkt-main-menu',
                                                'fallback_cb' => false,
                                                'walker' => new primary_wish_menu() )
                                            );
                                            ?>
                                        <?php } else { ?>
                                            <p class="setup-message"><?php esc_html_e("You can set your main menu in Appearance &gt; Menus", "wish"); ?></p>
                                        <?php } ?>

                                    </div><!--/wish-wp-menu-wrapper -->
                                </div><!--/container -->
                            </div><!--/row -->
                        </div><!--/wish-primary-menu -->
                    </div><!--/wish-wp-menu-wrapper -->
                </div><!--/container -->
            </div><!--/wish-rkt-menu-default -->
            
            <!-- ========================== cp navigation ends -=-->
         <!--FIXED -->
            <div class="wish-header-fixed-wrapper">
                <div class="wish-header-fixed">
                    <div class="container">
                        <div class="wish-wp-menu-wrapper">
                            <div class="wish-primary-menu">
                                <div class="row">
                                    <div class="container">
                                        <div class="wish-wp-menu-wrapper">
                                            


                                        <div class="logo image">
                                                <a href="" rel="home" style="max-width: 225px;">
                                                <span class="helper"></span><img src="<?php echo esc_url($logo_image['url']); ?>" alt=""></a>
                                        </div>
                                           
                                            <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                                <?php
                                                wp_nav_menu( array(
                                                    'theme_location' => 'primary',
                                                    'before' => '',
                                                    'after' => '',
                                                    'link_before' => '',
                                                    'link_after' => '',
                                                    'depth' => 4,
                                                    'fallback_cb' => false,
                                                    'walker' => new primary_wish_menu() )
                                                );
                                                ?>
                                            <?php } else { ?>
                                                <p class="setup-message"><?php esc_html_e("You can set your main menu in Appearance &gt; Menus", "wish"); ?></p>
                                            <?php } ?>

                                        </div><!--/wish-wp-menu-wrapper -->
                                    </div><!--/container -->
                                </div><!--/row -->
                            </div><!--/wish-primary-menu -->

                                

                        </div><!--/wish-wp-menu-wrapper -->
                    </div><!--/container -->
                </div><!--/wish-header-fixed -->
            </div><!--/wish-header-fixed-wrapper. -->
            
            <div id="mobile-menu">
 
                <?php

                if ( function_exists( 'has_nav_menu' ) ) {
                    wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_id' => '', 'menu_class' => 'mobile-menu-wrap', 'walker' => new mobile_wish_menu()) );
                }
                ?>
            </div><!--/mobile-menu -->
            
            <!-- ========================================================================= -->
            
        
        