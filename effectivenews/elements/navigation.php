<?php
$dd_effect = 'dd-effect-'.mom_option('nav_dd_animation');
if ($dd_effect == '') {
    $dd_effect = 'dd-effect-slide';
}
$nav_sh = '';
if (mom_option('nav_shadow') == 1) {
    $nav_sh = ' nav_shadow_on';
}
?>
<nav id="navigation" itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation" class="<?php echo $dd_effect.$nav_sh; ?> ">
    <div class="navigation-inner">
    <div class="inner">
	<?php if ( has_nav_menu( 'main' ) ) { ?>
	    <?php wp_nav_menu ( array( 'menu_class' => 'main-menu main-default-menu mom_visibility_desktop','container'=> 'ul', 'theme_location' => 'main', 'walker' => new mom_custom_Walker()  )); ?>
	    <?php
	    if (file_exists(get_template_directory() . '/demo/demo.php')) {
		global $mom_iconic_menu;
		    wp_nav_menu ( array( 'menu_class' => 'main-menu mom_visibility_desktop display_none iconic_menu','container'=> 'ul', 'menu' => $mom_iconic_menu, 'walker' => new mom_custom_Walker()  ));
	    }
	    ?>
	    <div class="mom_visibility_device device-menu-wrap">
	    <div class="device-menu-holder">
		<i class="fa-icon-align-justify mh-icon"></i> <span class="the_menu_holder_area"><i class="dmh-icon"></i><?php _e('Menu', 'theme'); ?></span><i class="mh-caret"></i>
	    </div>
	    <?php wp_nav_menu ( array( 'menu_class' => 'device-menu' ,'container'=> 'ul', 'theme_location' => 'main', 'walker' => new mom_custom_Walker()  )); ?>
	    </div>
	<?php } else { ?>
	    <span><?php _e('', 'theme'); ?></span>
	<?php } ?>
	<div class="nav-buttons">
	<?php if (mom_option('nav_cart') == 1) {
	    if (class_exists('woocommerce')) {
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			$num = $woocommerce->cart->cart_contents_count;
	    }
	    $in_woo = mom_option('nav_cart_in_woo');
	    $output = '<a href="'.$cart_url.'" class="nav-button nav-cart"><i class="fa-icon-shopping-cart"></i><span class="numofitems" data-num="'.$num.'">'.$num.'</span></a>';

	    if ($in_woo) {
		if(function_exists('is_woocommerce') && mom_is_woocommerce_page()) {
		    echo $output;
		}
	    } else {
		echo $output;
	    }
	} ?>
	<?php if (mom_option('nav_login') == 1) { ?>
	    <span class="nav-button nav-login">
		<i class="momizat-icon-users"></i>
	    </span>
	    <div class="nb-inner-wrap">
		<div class="nb-inner lw-inner">
		<?php mom_login_widget(mom_option('nav_login_register_link'), mom_option('nav_login_reset_link')); ?>
		</div>
	    </div>
	<?php } ?>		    
	</div> <!--nav-buttons-->
	
    </div>
    </div> <!--nav inner-->
</nav> <!--Navigation-->
<div class="boxed-content-wrapper clearfix">
<?php if (mom_option('nav_shadow') == 1) { ?> 
<div class="nav-shaddow"></div>
<?php } else { ?>
<div style="height:20px;"></div>
<?php } ?>