    <?php 
    $menustyle = get_theme_mod('menu_style'); 
    if ($menustyle == 'top') { ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-top-wrapper">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php $logo = get_theme_mod('logo'); if($logo) { ?>
                      <img src="<?php echo $logo; ?>" alt="Logo"/>
                      <?php } else { ?>
                      <h2><?php bloginfo('name'); ?></h2>
                      <?php } ?>
                  </a>
                </div>            

            <?php wp_nav_menu(
                array(
                    'theme_location' => 'single-page',
                    'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => '',
                    'container_id'    => 'main-menu-top-wrapper',
                    'menu_id' => 'main-menu-top',
                    'walker' => new wp_bootstrap_navwalker()
                )
            ); ?>
            </div>
        </div><!-- /.container-fluid -->
    </nav>  
    <?php } elseif ($menustyle == 'side') { ?>
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
            if ( has_nav_menu( 'single-page' ) ) {
              wp_nav_menu( array(
                'theme_location'  => 'single-page',
                'container'       => false,
                'menu_id'         => 'main-menu',
                'menu_class'      => ' ',
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => new wp_bootstrap_navwalker()
                )
              ); 
            }
            
            $twitter = get_theme_mod('twitter-social');
            $facebook = get_theme_mod('facebook-social');
            $gplus = get_theme_mod('gplus-social');
            $flickr = get_theme_mod('flickr-social');
            $youtube = get_theme_mod('youtube-social');             
            $pinterest = get_theme_mod('pinterest-social');
            $rss = get_theme_mod('rss-social'); ?>
            <ul id="social-icons">
                <?php if($twitter) { ?><li><a href="<?php echo $twitter ?>" target="_blank" title="Follow Us"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if($facebook) { ?><li><a href="<?php echo $facebook ?>" target="_blank" title="Like Us"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if($gplus) { ?><li><a href="<?php echo $gplus ?>" target="_blank" title="Add Us To Your Circle"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                <?php if($flickr) { ?><li><a href="<?php echo $flickr ?>" target="_blank" title="View Our Flickr"><i class="fa fa-flickr"></i></a></li><?php } ?>
                <?php if($youtube) { ?><li><a href="<?php echo $youtube ?>" target="_blank" title="Visit Us on Youtube"><i class="fa fa-youtube"></i></a></li><?php } ?>
                <?php if($pinterest) { ?><li><a href="<?php echo $pinterest ?>" target="_blank" title="Our Pinterest Profile"><i class="fa fa-pinterest"></i></a></li><?php } ?>
                <?php if($rss) { ?><li><a href="<?php echo $rss ?>" target="_blank" title="Our News Feed"><i class="fa fa-rss"></i></a></li><?php } ?>
            </ul>
        </div>
    </nav>
    <!-- END NAV -->
    <?php } ?>    
    
 