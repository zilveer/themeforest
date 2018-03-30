
    <nav class="menu" id="theMenu">
        <div class="menu-wrap">
            <i class="fa fa-bars menu-close"></i>
            <div id="menu-logo">
                <a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php $logo = get_theme_mod('logo'); if($logo) { ?>
                        <img src="<?php echo $logo; ?>" class="logo-img" alt="Logo"/>
                    <?php } else { ?>
                        <h2><?php bloginfo('name'); ?></h2>
                    <?php } ?>
                </a>
            </div>
            <?php 
            if ( has_nav_menu( 'primary' ) ) {
              wp_nav_menu( array(
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_id'         => 'main-menu',
                'menu_class'      => ' ',
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => new wp_bootstrap_navwalker()
                )
              ); 
            } else { ?>
                <div id="main-menu" class="setup-nag">To Setup A Menu - Visit Appearance > Menus in your dashboard</div>
            <?php
            }
            
            $twitter = get_theme_mod('twitter-social');
            $facebook = get_theme_mod('facebook-social');
            $gplus = get_theme_mod('gplus-social');
            $flickr = get_theme_mod('flickr-social');
            $youtube = get_theme_mod('youtube-social');             
            $pinterest = get_theme_mod('pinterest-social');
            $rss = get_theme_mod('rss-social'); ?>
            <ul id="social-icons">
                <?php if($twitter) { ?><li><a href="<?php echo esc_url($twitter); ?>" target="_blank" title="Follow Us"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if($facebook) { ?><li><a href="<?php echo esc_url($facebook); ?>" target="_blank" title="Like Us"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if($gplus) { ?><li><a href="<?php echo esc_url($gplus); ?>" target="_blank" title="Add Us To Your Circle"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                <?php if($flickr) { ?><li><a href="<?php echo esc_url($flickr); ?>" target="_blank" title="View Our Flickr"><i class="fa fa-flickr"></i></a></li><?php } ?>
                <?php if($youtube) { ?><li><a href="<?php echo esc_url($youtube); ?>" target="_blank" title="Visit Us on Youtube"><i class="fa fa-youtube"></i></a></li><?php } ?>
                <?php if($pinterest) { ?><li><a href="<?php echo esc_url($pinterest); ?>" target="_blank" title="Our Pinterest Profile"><i class="fa fa-pinterest"></i></a></li><?php } ?>
                <?php if($rss) { ?><li><a href="<?php echo esc_url($rss); ?>" target="_blank" title="Our News Feed"><i class="fa fa-rss"></i></a></li><?php } ?>
            </ul>
        </div>
    </nav>
    <!-- END NAV -->