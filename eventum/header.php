<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	if(isset($themeum_options['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri().'/images/plus.png'); ?>" type="image/x-icon"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  
  <?php if( isset($themeum_options['preloader_en']) && $themeum_options['preloader_en']==1 ) { ?> 
        <div id="qLoverlay"></div>
  <?php } ?>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header header">
			<div id="header-container">
				<div id="navigation" class="container">
                    <div class="row">
                        <div class="col-sm-3">
        					<div class="navbar-header">
        						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
                                <div class="logo-wrapper">
        	                       <a class="navbar-brand" href="<?php echo site_url(); ?>">
        		                    	<?php
        									if (isset($themeum_options['logo']))
        								   {
        								   		
        										if($themeum_options['logo-text-en']) { ?>
        											<h1> <?php echo esc_html($themeum_options['logo-text']); ?> </h1>
        										<?php }
        										else
        										{
        											if(!empty($themeum_options['logo'])) {
        											?>
        												<img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="" title="">
        											<?php
        											}else{
        												echo esc_html(get_bloginfo('name'));
        											}
        										}
        								   }
        									else
        								   {
        								    	echo esc_html(get_bloginfo('name'));
        								   }
        								?>
        		                     </a>
                                </div>     
        					</div>    
                        </div>

                        <div class="col-sm-9 woo-menu-item-add">
                            <?php 
                                global $woocommerce;
                                if($woocommerce) { 
                                if( isset($themeum_options['cart_open']) && $themeum_options['cart_open']==1 ) { ?>
                                    <span id="themeum-woo-cart" class="woo-cart" style="display:none;">
                                            <?php
                                                $has_products = '';
                                                //if($woocommerce->cart->cart_contents_count) {
                                                $has_products = 'cart-has-products';
                                                //}
                                            ?>
                                            <span class="woo-cart-items">
                                                <span class="<?php echo $has_products; ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                            </span>
                                            <i class="fa fa-shopping-cart"></i>
                                        
                                        <?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
                                    </span>
                                <?php }} ?>                             

                            <div id="main-menu" class="hidden-xs">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 3,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                ?>

                            </div><!--/#main-menu--> 
                        </div>
                        
                        

                        <div id="mobile-menu" class="visible-xs">
                            <div class="collapse navbar-collapse">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'      => 'primary',
                                        'container'           => false,
                                        'menu_class'          => 'nav navbar-nav',
                                        'fallback_cb'         => 'wp_page_menu',
                                        'depth'               => 3,
                                        'walker'              => new wp_bootstrap_mobile_navwalker()
                                        )
                                    ); 
                                }
                                ?>
                            </div>
                        </div><!--/.#mobile-menu-->
                    </div><!--/.row--> 
				</div><!--/.container--> 
			</div>

		</header><!--/#header-->

        <?php
        if ( has_nav_menu( 'secondary_nav' ) )
        { ?>
        <div id="secondary-menu">
            <div class="secondary-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="secondary-menu">
                                <div class="navbar">

                                    <?php    $default = array( 'theme_location'  => 'secondary_nav',
                                                          'container'       => '', 
                                                          'menu_class'      => 'nav navbar-nav',
                                                          'menu_id'         => 'menu-secondary-menu',
                                                          'fallback_cb'     => 'wp_page_menu',
                                                          'depth'           => 1,
                                                          'walker'          => new wp_bootstrap_mobile_navwalker()
                                            );
                                        wp_nav_menu($default);

                                    ?>
                                </div><!--/.navbar--> 
                            </div><!--/.secondary-menu-->
                        </div><!--/.col-md-9-->
                        <div class="col-md-3 home-search hidden-xs hidden-sm">
                            <?php echo get_search_form();?>
                        </div><!--/.container-->
                    </div><!--/.row-->
                </div><!--/.container-->
            </div> <!--/secondary-menu-wrap-->
        </div> <!--/#secondary-menu-->
        <?php }?>