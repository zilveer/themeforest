<?php
function cs_shortcode_menu_render($atts) {
    extract(shortcode_atts(array(
                'title' => '',
                'nav_menu' => '',
                'el_class' => '',
                'menu_align' => 'left',
                'menu_line_height' => '80',
                'css' => '',
                'bg_image'        => '',
			    'bg_color'        => '',
			    'bg_image_repeat' => '',
			    'padding'         => '',
			    'margin_bottom'   => ''
                    ), $atts));
    ob_start();
    global $smof_data;
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'cs_custom_header_menu' . $el_class . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), 'cs-shortcode-menu', $atts );
    ?>
    <div id="menu" class="cs_mega_menu main-menu cs-menu-align-<?php echo $menu_align;?> cs-menu-line-height-<?php echo $menu_line_height;?> <?php echo $css_class;?>">
		<div class="main-menu-content cshero-menu-dropdown clearfix nav-menu cshero-mobile">
			<?php
				$menus = wp_get_nav_menus();
				 if ($nav_menu){
				     echo '<ul class="cshero-dropdown main-menu">';
					 wp_nav_menu(array('theme_location' => 'main_navigation','menu'=>$nav_menu, 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>new HeroMenuWalker()));
				     
				     if(is_active_sidebar('cshero-header-content-widget-1')){
                        ?>
                        <li>
                            <div class="header-cart-search">
                                <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Content Widget 1")): endif;?>
                            </div>
                        </li>
                        <?php 
                    }
                    if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar'] && !isMobile()){
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-navicon cs_open"></i></a>
                        </li>
                        <?php
                    }
                    echo '</ul>';
				 } elseif (empty($menus)) {
				     echo '<div class="menu-pages">';
					 wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s'));
					 echo '</div>';
				 } else {
				     echo '<ul class="cshero-dropdown main-menu">';
				     wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>new HeroMenuWalker()));
                    echo '</ul>';
				 }
				 ?>
		</div>
	</div>
	<button type="button" class="btn btn-default btn-navbar navbar-toggle" data-toggle="collapse" data-target="#cshero-main-menu-mobile"><i class="fa fa-align-justify"></i></button>
	<div id="cshero-main-menu-mobile" class="collapse navbar-collapse cshero-mmenu"></div>
    <?php
    return ob_get_clean();
}

add_shortcode('cs-shortcode-menu', 'cs_shortcode_menu_render');
?>