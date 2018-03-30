    <?php  
        $redux_wish = wish_redux();
        $logo_image = $redux_wish['wish-logo-image'];
        $logo_image_transparent = $redux_wish['wish-logo-image-transparent'];
        if($logo_image_transparent == ""){
           $logo_image_transparent =  $logo_image;
        }

        $wish_topbar_show = $redux_wish['wish-topbar-show'];

        $tobar_extra_class = "";
        if($wish_topbar_show){
            $tobar_extra_class = "topbar_show";
        }

        
        $wish_topbar_text_left = $redux_wish['wish-topbar-text-left'];
        $wish_topbar_text_left_array = explode("\n", $wish_topbar_text_left);

        $wish_topbar_text = $redux_wish['wish-topbar-text'];
        $wish_topbar_array = explode("\n", $wish_topbar_text);

        $each_span = array();
        foreach ($wish_topbar_array as $key => $value) {
            $each_span[] = wish_line2fontawesome($value);
        }

        $float_menu = $redux_wish['wish-floating-menu'];

        //allows you to float menu on this page even if the menu is set to not float
        if( function_exists('rwmb_meta') && isset($post) ){
            $force_float_menu = rwmb_meta('wish_force_float_menu', $post->ID);
        }else{
            $force_float_menu = false; 
        }
        
        
    ?>
    <?php if ($redux_wish['wish-show-progressbar'] == true) {
        $loading_image = $redux_wish['wish-loading-screen-image'];
        $loading_gif = $loading_image['url'];

        if($loading_image['url'] == ""){
            $selected_loading_gif = $redux_wish['wish-loading-select-gif'];
            $loading_gif = get_template_directory_uri() . '/images/icons/progress/'. $selected_loading_gif . '.gif';
        }
        
        $loading_screen_bgcolor = $redux_wish['wish-loading-screen-bgcolor'];
        ?>
    <div id="preloader" style='background-color:<?php echo esc_attr($loading_screen_bgcolor); ?>'>
            <div class="preloader"><img src="<?php echo esc_url( $loading_gif )?>"  alt=""></div>
    </div>
    <?php } ?>

<?php 
    $extra_class1 = ""; 
    if ( !is_front_page() && !$force_float_menu) {
        $extra_class1 = "menu-inner-pages";
    }

    $extra_class2 = ""; 
    if ( !is_front_page() && !$force_float_menu) {
        $extra_class2 = "menu-inner-pages-fixed";
    }

    $top_bar_class = "";
    $top_bar_container = "";
    if ( !is_front_page() && !$force_float_menu ) {
        $top_bar_class = "topbar-inner-pages";
        $top_bar_container = "container";
    }


    $shadow_class = "";
    
    if(is_front_page() && $float_menu){
        $shadow_class = "shadow_class_temp";
    }


?>


        <div class="wish-rkt-menu-default <?php echo sanitize_html_class($extra_class1); ?> <?php echo sanitize_html_class($tobar_extra_class); ?>">

        <?php if($wish_topbar_show){ ?>
        <div id="tc" class="top-contact container hidden-md hidden-sm hidden-xs <?php echo sanitize_html_class($top_bar_container); ?> <?php echo sanitize_html_class($top_bar_class); ?>">
                <div class="row">
                    <div class="col-lg-12 top-bar-list-right">

                        <?php wish_hook_before_topbar(); ?>

                        <?php  
                            foreach ($each_span as $key => $value) {
                                echo "<span>" . stripslashes($value) . "</span>";
                            }
                        ?>

                        <?php  
                            foreach ($wish_topbar_text_left_array as $key => $value) {
                                echo "<span class='pull-left topbar-social'>" . stripslashes($value) . "</span>";
                            }

                        ?>

                        <?php wish_hook_after_topbar(); ?>

                    </div>

                </div>
        </div>
        <?php } ?>


                <div class="container">
                    <div class="wish-wp-menu-wrapper">
                        <div class="wish-primary-menu">
                            <div class="row">
                                <div class="container <?php echo sanitize_html_class($shadow_class); ?>">
                                    <div class="wish-wp-menu-wrapper">

                                      <div id="load-mobile-menu">
                                </div>

                                        <?php wish_hook_before_logo(); ?>

                                        <div class="logo image">
                                                <a href="<?php echo home_url(); ?>" rel="home" style="max-width: 225px;">
                                                
                                                <?php if(is_front_page() && $float_menu || $force_float_menu){ ?>
                                                    <span class="helper"></span><img src="<?php echo esc_url($logo_image_transparent['url']); ?>" alt=""></a>
                                                <?php }else{ ?>   
                                                    <span class="helper"></span><img src="<?php echo esc_url($logo_image['url']); ?>" alt=""></a>
                                                <?php } ?>     

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

                                        <?php wish_hook_after_menu(); ?>

                                    </div><!--/wish-wp-menu-wrapper -->
                                </div><!--/container -->
                            </div><!--/row -->
                        </div><!--/wish-primary-menu -->
                    </div><!--/wish-wp-menu-wrapper -->
                </div><!--/container -->
            </div><!--/wish-rkt-menu-default -->
            
            <!-- ========================== cp navigation ends -=-->
         <!--FIXED -->
            <div class="wish-header-fixed-wrapper <?php echo sanitize_html_class($extra_class2); ?>">
                <div class="wish-header-fixed">
                    <div class="container">
                        <div class="wish-wp-menu-wrapper">
                            <div class="wish-primary-menu">
                                <div class="row">
                                    <div class="container">
                                        <div class="wish-wp-menu-wrapper">
                                            

                                        <?php wish_hook_before_logo(); ?>        
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

                                            <?php wish_hook_after_menu(); ?>

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
            
        
        