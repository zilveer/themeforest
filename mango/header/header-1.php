<?php
/**
 * The template for header 1
*
*
* @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
	global $mango_settings, $mobile_menu,$search_button_class,$filter;
?>

	<header id="header" class="header1 mango_header1" role="banner">
		<div class="container">
			<div class="nav-logo nav-left">
				<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a><span><?php echo get_bloginfo("description"); ?></span></h1>
			</div><!-- End .nav-left -->
			<div class="nav-right">
				<div class="header-row text-right">
					<?php if($mango_settings['show-searchform']){ ?>
						<div class="dropdown search-dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">
								<i class="fa fa-search"></i><span class="header-text"><?php _e("Search",'mango') ?></span>
							</a>
							<div class="dropdown-menu pull-right" role="menu">
								<?php if($mango_settings['show-searchform']) {
									get_template_part("inc/mango_searchform");
								} ?>
							</div><!-- end .dropdown-menu -->
						</div><!-- End .search-dropdown -->
                <?php 	} ?>
                <?php if(is_user_logged_in()){ ?>
						<a href="<?php echo get_edit_user_link(); ?>" class="header-link" title="<?php _e("My Account",'mango')?>">
							<i class="fa fa-user"></i><span class="header-text"><?php _e("My Account",'mango')?></span>
						</a>
                <?php } ?>
                <?php get_template_part("inc/language"); ?>
                </div><!-- End .header-row -->
				<div class="header-row text-right">			
				<?php if($mango_settings['show-loginform']){?>				
					<?php if(is_user_logged_in()){ ?>		
						<div class="dropdown search-dropdown">			
						<a class="dropdown-toggle " href="<?php echo wp_logout_url( home_url() ); ?>">								
						<i class="fa fa-sign-out"></i>					
						<span class="header-text">				
						<?php _e("Logout",'mango') ;?>			
						</span>								
						</a>						
						</div>					
					<?php  }
					else { ?>            
						<div class="dropdown search-dropdown">			
						<a class="dropdown-toggle " href="<?php echo site_url('login');  ?>">							
						<i class="fa fa-lock"></i>				
						<span class="header-text">				
						<?php _e("Login",'mango') ;?>				
						</span>						
						</a>				
						</div>                
					<?php }  ?>					
				<?php } ?>
					<?php mango_compare_wishlist_links() ?>
					<?php mango_minicart(); ?>
				</div><!-- End .header-row -->
			</div><!-- End .nav-right -->
			<div class="nav-center nav-right">
				<span class="nav-text-big"><?php echo get_bloginfo("description"); ?></span>
					<?php if($mobile_menu){ ?>
						<button type="button" id="mobile-menu-btn">
							<span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>
								<i class="fa fa-navicon"></i>
						</button>
					<?php } ?>
			</div><!-- End .nav-center -->
		</div><!-- End .container -->
	<?php if(has_nav_menu('main_menu')) { ?>
    <div id="menu-container" class="sticky-menu dark">
        <div class="container">
            <?php
                wp_nav_menu(
							array (
								'theme_location' => 'main_menu',
								'menu_id' => 'menu-main-navigation',
								'menu_class' => 'menu btt-dropdown',
								"depth" => 5,
								'container'       => 'nav',
								'walker' => new mango_top_navwalker
							)
				);
            ?>
        </div><!-- End .container -->
    </div><!-- End .menu-cotainer -->
    <?php } else{
				echo '<div class="container">' . __('Define "Main Navigation" in <strong>Apperance > Menus</strong>','mango') . '</div>';
			} ?>
	</header><!-- End #header -->