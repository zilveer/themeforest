<?php

    # get theme options
    $martanian_options = get_option( 'martanian_theme_options' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <title><?php bloginfo( 'name' ) . wp_title(); ?></title>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php martanian_get_colors(); ?>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/<?php echo str_replace( '-', '_', get_bloginfo( 'language' ) ); ?>/all.js#xfbml=1&status=0&appId=270545106449817";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div id="appointment-popup">
    
        <div class="appointment-popup-background">
        </div>
        
        <div class="appointment-popup-content" style="display: none;">
        
            <?php
            
                # get timetype
                $time_type = '12h';
                if( isset( $martanian_options['sections'] ) && is_array( $martanian_options['sections'] ) && isset( $martanian_options['sections']['data'] ) && is_array( $martanian_options['sections']['data'] ) && count( $martanian_options['sections']['data'] ) > 0 ) {
                
                    foreach( $martanian_options['sections']['data'] as $section_id => $section_data ) {
                    
                        if( $section_data['type'] == 'small-appointment' ) {
            
                            $time_type = $section_data['time_type'];
                        }
                    }
                }
            
            ?>
            
            <div class="appointment-header">

                <div class="h3-box">
                
                    <h3><?php _e( 'Make an <span>appointment!</span>', 'martanian' ); ?></h3>
                    <div class="header-line">
                                                
                        <div class="gray-line"></div>
                        <div class="color-line"></div>
                    
                    </div>
                
                </div>
                
                <i class="icon-remove" id="close-popup"></i>
            
            </div>
            
            <div class="appointment-form" id="appointment-form-in-popup">
            
                <form method="post">
                
                    <div class="input">
                                    
                        <div class="input-helper"><i class="icon-male"></i></div>
                        <input type="text" name="name" placeholder="<?php _e( 'Name...', 'martanian' ); ?>" />
                        
                        <div class="clear">
                        </div>
                    
                    </div>
                    
                    <div class="input">
                                    
                        <div class="input-helper"><i class="icon-phone"></i></div>
                        <input type="text" name="phone" placeholder="<?php _e( 'Phone number...', 'martanian' ); ?>" />
                        
                        <div class="clear">
                        </div>
                    
                    </div>
                    
                    <div class="input">
                                    
                        <div class="input-helper"><i class="icon-envelope"></i></div>
                        <input type="text" name="email" placeholder="<?php _e( 'Mail...', 'martanian' ); ?>" />
                        
                        <div class="clear">
                        </div>
                    
                    </div>
            
                    <div class="input">
                                    
                        <div class="input-helper"><i class="icon-calendar"></i></div>
                        <input type="text" name="appointment-date" placeholder="<?php _e( 'Appointment date', 'martanian' ); ?>" class="appointment-datepicker appointment-popup-form-datepicker" readonly />
                        
                        <div class="clear">
                        </div>
                    
                    </div>
                    
                    <div class="input approximate-time-input">
                    
                        <div class="input-helper"><i class="icon-time"></i></div>
                        <input type="text" name="approximate-time" placeholder="<?php _e( 'Approximate time', 'martanian' ); ?>" class="approximate-time" readonly data-timebox-id="1" />
                        
                        <div class="clear">
                        </div>
                        
                        <div class="approximate-time-box animated fadeInDown <?php echo $time_type == '24h' ? 'approximate-time-box-24h' : '' ?>" data-timebox-id="1">
                        
                            <div class="approximate-time-box-arrow"></div>
                            
                            <div class="element element-first">
                            
                                <i class="icon-chevron-up element-up hours hours-up time-change-action-event"></i>
                                <span class="element-value time-selector-hours" data-value="8">8</span>
                                <i class="icon-chevron-down element-down hours hours-down time-change-action-event"></i>
                            
                            </div>
                            
                            <div class="element">
                            
                                <i class="icon-chevron-up element-up mins mins-up time-change-action-event"></i>
                                <span class="element-value time-selector-mins" data-value="0">00</span>
                                <i class="icon-chevron-down element-down mins mins-down time-change-action-event"></i>
                            
                            </div>
            
                            <?php if( $time_type == '12h' ) { ?>
                            <div class="element">
                            
                                <i class="icon-chevron-up element-up time-change-action-event time-type"></i>
                                <span class="element-value time-selector-type" data-value="am">am</span>
                                <i class="icon-chevron-down element-down time-change-action-event time-type"></i>
                            
                            </div>
                            <?php } ?>
                        
                        </div>
                    
                    </div>
                    
                    <textarea placeholder="<?php _e( 'Additional notes...', 'martanian' ); ?>" name="additional-notes"></textarea>
                    <input type="button" value="<?php _e( 'Make an appointment!', 'martanian' ); ?>" class="button button-brown submit-appointment" />
                    
                    <div class="clear">
                    </div>
                
                </form>
                
                <div class="thanks"><?php _e( 'Thank you!', 'martanian' ); ?></div>
            
            </div>
        
        </div>
    
    </div>
    
    <?php $header_class = is_front_page() == true ? '' : ' class="subpage"'; ?>
    <header <?php echo $header_class; ?>>
    
        <div id="header-background-images">
        
        <?php
        
            if( isset( $martanian_options['header_backgrounds'] ) && is_array( $martanian_options['header_backgrounds'] ) ) {
            
                $pos = 0;
                $single = array();
                
                foreach( $martanian_options['header_backgrounds'] as $header_background ) {
        
                    # ...and create html
                    $single[ $pos + 1 ] = '<div class="header-background-image" style="'. ( $pos > 0 ? 'display: none; ' : '' ) .'background-image: url(\''. $header_background['url'] .'\'); background-position: 50% 50%;"></div>';
                    $pos++;
                }
                
                # if there is no header images order
                if( !isset( $martanian_options['header_images_order'] ) || $martanian_options['header_images_order'] == '' ) {
                
                    for( $i = 0; $i < count( $single ); $i++ ) echo $single[ $i + 1 ];
                }
                
                # or if it is here :)
                else {
        
                    $order = explode( ',', $martanian_options['header_images_order'] );
                    for( $i = 0; $i < count( $order ); $i++ ) {
        
                        if( isset( $single[trim($order[$i])] ) ) {
                        
                            echo $single[trim($order[$i])];
                            unset( $single[trim($order[$i])] );
                        }
                    }
                    
                    foreach( $single as $unordered ) echo $unordered;
                }
            }
        
        ?>
        
        </div>
        
        <div class="top-header-box">
        
            <?php
            
                if( has_nav_menu( 'martanian_main_left_menu' ) ) {
                
                    wp_nav_menu( array(
                        'theme_location' => 'martanian_main_left_menu',
                        'menu_class' => 'menu-left waitForLoad fadeInRight',
                        'container' => ''
                    ));
                }
            
            ?>

            <div class="logo">
            
                <a href="<?php echo home_url(); ?>">
                
                    <?php

                        $logo_url = isset( $martanian_options['logo_url'] ) && $martanian_options['logo_url'] != '' ? $martanian_options['logo_url'] : home_url() .'/wp-content/themes/frisieur/_assets/_img/logo.png';
                        echo '<img src="'. $logo_url .'" alt="'. get_bloginfo( 'title' ) .'" />';
                    
                    ?>
                
                </a>
            
            </div>
            
            <?php
            
                if( has_nav_menu( 'martanian_main_right_menu' ) ) {
                
                    wp_nav_menu( array(
                        'theme_location' => 'martanian_main_right_menu',
                        'menu_class' => 'menu-right waitForLoad fadeInLeft',
                        'container' => ''
                    ));
                }
            
            ?>

            <div class="clear">
            </div>
            
            <div class="responsive-menu"><i class="icon-reorder"></i> Menu</div>
        
        </div>

        <div id="slogan">
        
            <h1 class="waitForLoad fadeInDown"><?php echo isset( $martanian_options['slogan_main'] ) ? $martanian_options['slogan_main'] : 'Get Your Dream Hair'; ?></h1>
            <p class="waitForLoad fadeInUp"><?php echo isset( $martanian_options['slogan_description'] ) ? $martanian_options['slogan_description'] : 'WordPress Theme for Hairdressers, Stylists, Hair Salons and similar - responsive, with blog, great appointment form and beauty design.'; ?></p>

        </div>

    </header>
    
    <div id="responsive-menu-wrapper">
            
        <div id="responsive-menu-window">
        
            <h3>Menu</h3>
            <i class="icon-remove close-responsive-menu"></i>
            
            <?php
            
                if( has_nav_menu( 'martanian_responsive_menu' ) ) {
                
                    wp_nav_menu( array(
                        'theme_location' => 'martanian_responsive_menu',
                        'menu_class' => 'responsive-menu-list',
                        'container' => ''
                    ));
                }
            
            ?>
        
        </div>
    
    </div>
    
    <div id="scrollable-menu-wrapper">

        <div class="logo">
        
            <a href="<?php echo home_url(); ?>">
            
                <?php

                    $logo_responsive_url = isset( $martanian_options['logo_responsive_url'] ) && $martanian_options['logo_responsive_url'] != '' ? $martanian_options['logo_responsive_url'] : home_url() .'/wp-content/themes/frisieur/_assets/_img/logo-responsive.png'; 
                    echo '<img src="'. $logo_responsive_url .'" alt="'. get_bloginfo( 'title' ) .'" />';
                
                ?>
            
            </a>
        
        </div>
        
        <?php
            
            if( has_nav_menu( 'martanian_scrollable_menu' ) ) {
            
                wp_nav_menu( array(
                    'theme_location' => 'martanian_scrollable_menu',
                    'menu_class' => 'scrollable-menu-list',
                    'container' => ''
                ));
            }
        
        ?>
        
        <div class="scrollable-menu-responsive"><i class="icon-reorder"></i></div>
    
    </div>
    
    <div id="main-content" <?php echo $header_class; ?>>
    
        <div id="container">