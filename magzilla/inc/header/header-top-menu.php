<?php global $ft_option, $fave_container; ?>

<nav class="magazilla-top-nav navbar">
    <div class="<?php echo esc_attr( $fave_container ); ?>">
        <div class="top-menu clearfix">
            <!-- navbar-left -->
            <?php
            // Pages Menu
            if ( has_nav_menu( 'top-menu' ) ) :
                wp_nav_menu( array (
                    'theme_location' => 'top-menu',
                    'container' => '',
                    'container_class' => '',
                    'menu_class' => 'nav navbar-nav',
                    'menu_id' => 'top-nav',
                    'depth' => 4,
                    'walker' => new favethemes_secondary_nav()
                 ));
             endif;
            ?>
            
            <!-- navbar-right -->
            <ul class="nav navbar-nav navbar-right">
                
                <?php if( $ft_option['top_social_profiles'] != 0 ) { ?>
                    <li class="post-author-social-links"><?php get_template_part('inc/nav-social'); ?></li>
                <?php } ?>


                <?php if( $ft_option['login_top_menu'] != 0 ) { ?>
                    <?php if ( function_exists('login_with_ajax') ) { ?>

                            <?php if ( !is_user_logged_in()) { ?>
                                    <li><a data-toggle="modal" data-target="#modal-login-form" data-dismiss="modal" href="#"><?php _e( 'Login', 'magzilla' )?></a></li>
                                    <li><a data-toggle="modal" data-target="#modal-register-form" data-dismiss="modal" href="#"><?php _e( 'Register', 'magzilla' )?></a></li>
                            <?php } ?>
                            
                            <li><?php if ( function_exists('login_with_ajax')) {  login_with_ajax();  } ?></li>
                    <?php } ?>
                <?php } ?>

            </ul><!-- navbar-right -->
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
