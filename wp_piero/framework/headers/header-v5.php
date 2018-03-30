<?php global $smof_data, $header_setings, $post;
    $data_parallax = $c_pageID = null;
    if($post){
        $c_pageID = $post->ID;
    }
    /* object menu */
    $menus = wp_get_nav_menus();
    /* array menu id */
    $menus_id = array();
    if(!empty($menus)){
        foreach ($menus as $menu){
            $menus_id[] = $menu->term_id;
        }
    }
    /* menu location */
    $menu_locations = get_nav_menu_locations();
    $main_navigation = null;
    if(!empty($menu_locations) && isset($menu_locations['main_navigation'])){
        $main_navigation = $menu_locations['main_navigation'];
    }
    /* show stiky */
    $show_sticky = get_post_meta($c_pageID, 'cs_show_sticky_header', true);
    if($show_sticky != ''){
        $smof_data['header_sticky'] = $show_sticky;
    }
    /** data parallax */
    if($smof_data['header_bg_parallax'] && !empty($smof_data['background-header']['media'])){
        $data_parallax = " data-stellar-background-ratio='0.6' data-background-width='{$smof_data['background-header']['media']['width']}' data-background-height='{$smof_data['background-header']['media']['height']}'";
    }
?>

<div class="header header-v5">
    <?php   if (is_active_sidebar('cshero-header-top-widget-1') || is_active_sidebar('cshero-header-top-widget-2')): ?>
    <div id="header-top" <?php echo $header_setings->top_padding; ?>>
        <div class="<?php echo ($smof_data['header_full_width'])?'no-container':'container';?>">
            <div class="row">
                <div class="header-top clearfix">
                    <div class='header-top-1 <?php echo $smof_data['header_top_widgets_1']; ?>'>
                    <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Top Widget 1")):
                    endif;?>
                    </div>
                    <?php if ($smof_data['header_top_widgets_columns'] != '1') : ?>
                    <div class='header-top-2 <?php echo $smof_data['header_top_widgets_2']; ?>'>
                    <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Top Widget 2")):
                    endif;?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div id="cshero-header" class="stripe-parallax-bg <?php if($smof_data['header_fixed_top']){ echo ' transparentFixed';} ?>"<?php echo $data_parallax; ?>>
        <div class="<?php echo ($smof_data['header_full_width'])?'no-container':'container';?>">
            <div class="cshero-header-full">

                <div id="menu" class="main-menu-wrap menu-fw">
                    <div class="cs-main-menu-wrap clearfix">

                        <div class="logo logo-line-height-nav logo-fw left">
                            <a href="<?php echo esc_url(home_url()); ?>">
                                <img src="<?php echo esc_url($smof_data['logo']['url']); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"
                                     style="height: <?php echo esc_attr($smof_data["logo_width"]); ?>" class="normal-logo logo-v5"/>
                            </a>
                        </div>

                        <div class="cshero-header-content-widget cshero-menu-mobile hidden-lg hidden-md right">
                            <div class="cshero-header-content-widget-inner">
                                <a class="btn-navbar" data-toggle="collapse" data-target="#cshero-main-menu-mobile" href="#" ><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                        <?php if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){ ?>
                            <div class="cshero-header-content-widget cshero-hidden-sidebar right">
                                <div class="cshero-hidden-sidebar-btn">
                                    <a href="#"><i class="fa fa-columns cs_open"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($smof_data['header_content_widgets']): ?>
                        <?php if(is_active_sidebar('cshero-header-content-widget-1')){ ?>
                            <div class="cshero-header-content-widget cshero-header-content-widget1 right">
                                <div class="cshero-header-content-widget-inner">
                                    <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Content Widget 1")): endif;?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(is_active_sidebar('cshero-header-content-widget-2')){ ?>
                            <div class="cshero-header-content-widget cshero-header-content-widget-2 right">
                                <div class="cshero-header-content-widget-inner">
                                    <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Content Widget 2")): endif;?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php endif; ?>
                        <div class="cs_mega_menu cshero-menu-dropdown clearfix cshero-mobile <?php echo $smof_data["menu_position"]; ?>">
                            <?php
                            $megamenu = null;
                            if(class_exists('HeroMenuWalker')){
                                $megamenu = new HeroMenuWalker();
                            }
                            $custom_main_navigation = get_post_meta($c_pageID, 'cs_main_navigation', true);
                            if (in_array($main_navigation, $menus_id) || in_array($custom_main_navigation, $menus_id)) {
                                echo '<ul class="cshero-dropdown main-menu menu-item-padding">';
                                wp_nav_menu(array('theme_location' => 'main_navigation','menu'=>$custom_main_navigation, 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>$megamenu));
                                echo '</ul>';
                            } elseif (empty($menus_id)) {
                                echo '<div class="menu-pages">';
                                wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s'));
                                echo '</div>';
                            } else {
                                echo '<ul class="cshero-dropdown main-menu menu-item-padding">';
                                wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>$megamenu));
                                echo '</ul>';
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <div id="cshero-main-menu-mobile" class="collapse navbar-collapse cshero-mmenu"></div>
            </div>
        </div>
    </div>
</div>
<?php
if($smof_data['header_sticky']){
    get_template_part('framework/headers/sticky-header-width-auto');
}
?>