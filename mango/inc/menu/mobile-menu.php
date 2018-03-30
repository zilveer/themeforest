<?php
/**
 * The template for displaying mobile menu
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
?>

<?php
global $mobile_menu,$mango_settings;
$mobile_menu = false;
		if(has_nav_menu('mobile_menu')){
		 $menu_location = 'mobile_menu';
		$mobile_menu = true; 
		}
		elseif(has_nav_menu('main_menu')){
        $menu_location = 'main_menu';
        $mobile_menu = true;
		}
		
		if(has_nav_menu('primary_menu')){
		$menu_location_pre = 'primary_menu';
		$mobile_menu = true;
		}
		?>
<?php if ( $mobile_menu ) { ?>
    <div id="mobile-menu">
        <div id="mobile-menu-wrapper">
            <header>
                <?php _e("Navigation",'mango') ?>
                <a href="#" id="mobile-menu-close" title="Close Panel"></a>
            </header>
                        <?php
                            wp_nav_menu (
                                array (
                                    'theme_location' => $menu_location,
                                    'menu_class' => 'mobile-menu',
                                    'container'       => 'nav',
									 'walker' => new mango_top_navwalker_mobile
                                ) ); ?>
								 <?php
								 if($mango_settings['mango_site_header'] ==22){
									wp_nav_menu (
									array (
										'theme_location' => $menu_location_pre,
										'menu_class' => 'mobile-menu',
										'container'       => 'nav',
										 'walker' => new mango_top_navwalker_mobile
									 ) );
								 } 
								 ?>
            <footer>
                <?php get_template_part("inc/social-icons"); ?>
                <p class="copyright"><?php echo htmlspecialchars_decode(esc_textarea($mango_settings['mango_copyright'])) ?></p>
            </footer>
        </div>
        <div id="mobile-menu-overlay"></div>
    </div>
    <?php } ?>