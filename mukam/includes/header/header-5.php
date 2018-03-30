<?php 
if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
      }

    $animy1 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {    
      $animy1 = ' fadein scaleInv anim_1';
    }       
?>
<header id="mukam_header" class="mukam-header mukam-header-large header-5 fixbottom">
    <?php global $woocommerce; ?>
    <?php 

    $top_section = get_option_tree('show_top_section',$theme_options); 
    if ( $top_section == 'Yes') {
    if ( $animy == 'Yes') { ?>
      <div class ="<?php echo $animy1;?>"><?php } ?>      
      <div class="top-section-container">
      <div class="top-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6"><?php if($theme_options['top_section_phone'] != "") { ?><div class="phone"><i class="mukam-mobile icon-3x pull-left"></i> <?php echo $theme_options['top_section_phone']; ?></div> <?php } ?> 
                                <?php if($theme_options['top_section_email'] != "") { ?><div class="email"><i class="mukam-envelope icon-3x pull-left"></i> <?php echo $theme_options['top_section_email']; ?></div><?php } ?> 
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="social">
                <?php 
                  $showsocial = get_option_tree('top_section_social', $theme_options);
                  if ( $showsocial == 'Yes') {
                    mukam_mini_social();
                  }
                ?>  
            </div>
          </div>
        </div>
      </div>
    </div>
         <div class="showhide"><div class="trans-topsection">+</div></div>
    </div>
    <?php if ( $animy == 'Yes') { ?> </div> <?php } ?>  
    <?php } ?>   
      <div class="container<?php echo $animy1;?>">
        <div class="row">
          <div class="col-md-12">
          <!-- Main Menu -->
          <nav class="navbar navbar-default header-5" role="navigation">
          <div class="navbar-header">
                <a href="<?php echo home_url(); ?>"><?php if (!empty($theme_options['logo_upload'])){?>
                <img src="<?php echo $theme_options['logo_upload']?>" alt="<?php bloginfo('name'); ?>" class="logo" /></a>
                <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/mukam.png" alt="Mukam" class="logo" /></a>
                <?php } ?> 
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           <?php
            $disable_cart = get_option_tree('disable_cart',$theme_options);
            if ( $disable_cart == 'Yes' ) {?>
            <div class="shopping"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="shopping-cart"><i class="mukam-shop pull-left"></i><p><?php echo __('Shopping Cart', 'mukam');?></p><span>(<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>) <?php echo __('Cart Subtotal:', 'mukam');?> <?php echo $woocommerce->cart->get_cart_total(); ?></span></div></a> </div>
            <?php } ?>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
                          <?php wp_nav_menu(
                                    array(
                                        'theme_location'        => 'main_menu',
                                        'container'             => '',
                                        'container_class'       => false,
                                        'menu_class'            => 'nav navbar-nav',
                                        'fallback_cb'           => 'false',
                                        'walker'                => new mukam_walker_main_menu()
                                    ));
                          ?>
            <div class="search-widget hidden-xs hidden-sm"> 
        <div class="search">
                  <form method="get" action="<?php echo home_url(); ?>">
                  <input type="text" name="s" class="search-query" placeholder="<?php echo __('Search here...', 'mukam');?>" value="<?php the_search_query(); ?>">
                  </form>
        </div><a href="#"><div class="social-box"><i class="mukam-search"></i></div></a>
        </div>
          </div><!-- /.navbar-collapse -->
        </nav>
        </div>
      </div>
    </div>
</header>