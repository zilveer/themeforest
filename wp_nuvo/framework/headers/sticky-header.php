<?php global $smof_data, $woocommerce, $main_menu, $post;
    $c_pageID = null;
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
    $sticky_navigation = null;
    
    if(!empty($menu_locations['main_navigation']))
        $main_navigation = $menu_locations['main_navigation'];
    
    if(isset($menu_locations['sticky_navigation']))
    	$sticky_navigation = $menu_locations['sticky_navigation'];
    
    /* show stiky */
    $show_sticky_header = $smof_data['header_sticky'];
    if(get_post_meta($c_pageID, 'cs_show_sticky_header', true) == 'show'){
        $show_sticky_header = '1';
    } elseif (get_post_meta($c_pageID, 'cs_show_sticky_header', true) == 'hide') {
        $show_sticky_header = '0';
    }
?>

<?php if ($show_sticky_header == '1'): ?>
    <header id="header-sticky" class="sticky-header<?php if($smof_data['logo_alignment'] == 'left'){echo ' cshero-logo-left';}?> <?php if($smof_data['logo_alignment'] == 'right'){echo ' cshero-logo-right';}?>">
        <div class="container">
            <div class="row">
                <div class="cshero-logo logo-sticky col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo $smof_data['logo_header_sticky']; ?>" alt="<?php bloginfo('name'); ?>" class="sticky-logo" />
                    </a>
                </div>
                <div class="sticky-menu col-xs-9 col-sm-9 col-md-9 col-lg-9 cs_menu_position_<?php echo $smof_data["menu_position"]; ?>">
                    <nav id="sticky-nav-wrap" class="cs_mega_menu nav-holder cshero-menu-dropdown cshero-mobile">
                    <?php
                         $custom_sticky_navigation = get_post_meta($c_pageID, 'cs_sticky_navigation', true);
                         if (in_array($sticky_navigation, $menus_id) || in_array($custom_sticky_navigation, $menus_id)) {
                             echo '<ul class="cshero-dropdown main-menu sticky-nav">';
                             wp_nav_menu(array('theme_location' => 'sticky_navigation','menu'=>$custom_sticky_navigation, 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>new HeroMenuWalker()));
                             if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){
                             ?>
                             <li class="menu-item menu-item-open hidden-xs hidden-sm">
                                 <a href="#"><i class="fa fa-navicon cs_open"></i></a>
                             </li>
                             <?php
                             }
                             echo '</ul>';
                         } elseif (in_array($main_navigation, $menus_id)) {
                            echo '<ul class="cshero-dropdown main-menu">';
                            wp_nav_menu(array('theme_location' => 'main_navigation', 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>new HeroMenuWalker()));
                            if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){
                            ?>
                            <li class="menu-item menu-item-open hidden-xs hidden-sm">
                                <a href="#"><i class="fa fa-navicon cs_open"></i></a>
                            </li>
                            <?php
                            }
                            echo '</ul>';
                         } elseif (empty($menus_id)) {
                            echo '<div class="menu-pages">';
                            wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s'));
                            echo '</div>';
                         } else {
                            echo '<ul class="cshero-dropdown main-menu sticky-nav">';
                            wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>new HeroMenuWalker()));
                            echo '</ul>';
                         }
                         ?>
                    </nav>
                </div>
                <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target="#cshero-sticky-menu-mobile"><i class="fa fa-align-justify"></i></button>
                <div id="cshero-sticky-menu-mobile" class="collapse navbar-collapse cshero-mmenu"></div>
            </div>
        </div>
    </header>
<?php endif; ?>