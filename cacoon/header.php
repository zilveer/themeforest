<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php
    if(get_theme_mod('cacoon_responsive',1) == 1){echo '<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0" />';}
    ?>

    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>
<body <?php body_class('clearfix'); ?> data-smooth-scrolling="1">

<?php if(met_get_option('met_bg_image_type') == 'Image' AND get_theme_mod('cacoon_body_layout','0') == '1' AND met_get_option('met_bg_file','') != ''): wp_enqueue_script('metcreative-fullscreenr') ?>
    <img src="<?php echo met_get_option('met_bg_file') ?>" alt="fullscreenbg" id="met_fullScreenImg" />
    <script>
        jQuery().ready(function(){
            if(jQuery('#met_fullScreenImg').length > 0){
                var FullscreenrOptions = {  width: window.innerWidth, height: window.innerHeight, bgID: '#met_fullScreenImg' };
                jQuery.fn.fullscreenr(FullscreenrOptions);
            }
        });
    </script>
<?php endif; ?>

<div class="met_page_wrapper <?php echo ((get_theme_mod('cacoon_body_layout',0) == 1) ? 'met_boxed_layout' : '') ?>">

    <?php
    $currentPageParent = '';
    $locations = get_registered_nav_menus();
    $menus = wp_get_nav_menus();
    $menu_locations = get_nav_menu_locations();
    $parentMenus = array();

    $location_id = 'header_menu';
    if (isset($menu_locations[ $location_id ])) {
        foreach ($menus as $menu) {
            if ($menu->term_id == $menu_locations[ $location_id ]) {
                $menu_items = wp_get_nav_menu_items($menu);
                foreach($menu_items as $menu_item){
                    if($menu_item->menu_item_parent == 0){
                        $parentMenus[$location_id][] = $menu_item;
                    }
                }
                break;
            }
        }
    }

    $location_id = 'main_nav';
    if (isset($menu_locations[ $location_id ])) {
        foreach ($menus as $menu) {
            if ($menu->term_id == $menu_locations[ $location_id ]) {
                $menu_items = wp_get_nav_menu_items($menu);

                foreach($menu_items as $menu_item){
                    if($menu_item->menu_item_parent == 0){
                        $parentMenus[$location_id][] = $menu_item;
                    }else{
                        $childMenus[$location_id][$menu_item->menu_item_parent][] = $menu_item;
                    }
                }
                break;
            }
        }
    }
    ?>
    <header class="met_content">
        <div class="row-fluid">
            <div class="span12">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="met_logo met_logo_loading"><img src="<?php echo get_theme_mod('cacoon_logo',get_template_directory_uri().'/img/logo.png'); ?>" data-retina="<?php echo get_theme_mod('cacoon_retina_logo',get_template_directory_uri().'/img/logo@2x.png'); ?>" height="<?php echo get_theme_mod('cacoon_logo_height','44'); ?>" style="height: <?php echo get_theme_mod('cacoon_logo_height','44'); ?>px" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
                <aside class="clearfix">
                    <?php
						$header_social_links = get_theme_mod('cacoon_social_header','');
						echo $header_social_links;
                    ?>

                    <?php if( isset($parentMenus['header_menu']) AND $parentMenus['header_menu'] ): ?>
                        <nav>
                            <ul>
                                <?php foreach($parentMenus['header_menu'] as $header_menu_item): ?>
                                    <li><a href="<?php echo $header_menu_item->url ?>"  target="<?php echo $header_menu_item->target; ?>" class="met_color_transition <?php echo (($header_menu_item->url == current_page_url()) ? 'active' : '') ?>"><?php echo $header_menu_item->title; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </aside>
                <div id="dl-menu" class="dl-menuwrapper">
                    <button class="met_bgcolor met_bgcolor_transition2"><?php _e('MENU','metcreative') ?></button>
                    <ul class="dl-menu met_bgcolor7">
                        <?php
                        if($parentMenus['main_nav']){
                            foreach($parentMenus['main_nav'] as $parentMenuItem){
                                echo '<li class="'. (($parentMenuItem->url == current_page_url()) ? 'active' : '') .'"><a href="'.(isset($childMenus['main_nav'][$parentMenuItem->ID]) ? '#' : $parentMenuItem->url).'" target="'.$parentMenuItem->target.'">'.$parentMenuItem->title.'</a>';

                                if(isset($childMenus['main_nav'][$parentMenuItem->ID])){
                                    echo '<ul class="dl-submenu">';
                                    echo '<li class="dl-back"><a href="#">back</a></li>';
                                    echo !empty($parentMenuItem->url) && $parentMenuItem->url != '#' ? '<li class="'. (($parentMenuItem->url == current_page_url()) ? 'active' : '') .'"><a href="'.$parentMenuItem->url.'" target="'.$parentMenuItem->target.'">'.$parentMenuItem->title.'</a>' : '';
                                    foreach($childMenus['main_nav'][$parentMenuItem->ID] as $childMenuItem){
                                        if(isset($childMenus['main_nav'][$childMenuItem->ID])){$has_Child=true;}else{$has_Child=false;}

                                        echo '<li><a href="'.($has_Child ? '#' : $childMenuItem->url).'" target="'.$childMenuItem->target.'">'.$childMenuItem->title.'</a>';

                                        /* Level 3rd */
                                        if($has_Child){
                                            echo '<ul class="dl-submenu">';
                                            echo '<li class="dl-back"><a href="#">back</a></li>';
                                            echo !empty($childMenuItem->url) && $childMenuItem->url != '#' ? '<li><a href="'.$childMenuItem->url.'" target="'.$childMenuItem->target.'">'.$childMenuItem->title.'</a>' : '';
                                            foreach($childMenus['main_nav'][$childMenuItem->ID] as $_childMenuItem){
                                                echo '<li><a href="'.$_childMenuItem->url.'" target="'.$_childMenuItem->target.'">'.$_childMenuItem->title.'</a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                        /* Level 3rd */

                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }

                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div><!-- /dl-menuwrapper -->
            </div>
        </div>
    </header><!-- Header Ends  -->

    <nav class="met_content met_main_nav met_bgcolor3 clearfix" data-fixed="<?php echo get_theme_mod('cacoon_header_style',1) ?>">
        <ul>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="met_menu_home"><i class="icon-home"></i></a></li>

            <?php
            if($parentMenus['main_nav']){
                foreach($parentMenus['main_nav'] as $parentMenuItem){
                    echo '<li class="'. (($parentMenuItem->url == current_page_url()) ? 'active' : '') .'"><a href="'.$parentMenuItem->url.'" target="'.$parentMenuItem->target.'">'.$parentMenuItem->title.'</a>';

                    if(isset($childMenus['main_nav'][$parentMenuItem->ID])){
                        echo '<ul>';
                        foreach($childMenus['main_nav'][$parentMenuItem->ID] as $childMenuItem){
                            if(isset($childMenus['main_nav'][$childMenuItem->ID])){$has_Child=true;}else{$has_Child=false;}

                            echo '<li class="'.(($has_Child) ? 'met_has_lower' : '').' '. (($childMenuItem->url == current_page_url()) ? 'active' : '') .'"><a href="'.$childMenuItem->url.'" target="'.$childMenuItem->target.'">'.$childMenuItem->title.'</a>';

                            /* Level 3rd */
                            if($has_Child){
                                echo '<ul>';
                                foreach($childMenus['main_nav'][$childMenuItem->ID] as $_childMenuItem){
                                    echo '<li class="'. (($childMenuItem->url == current_page_url()) ? 'active' : '') .'"><a href="'.$_childMenuItem->url.'" target="'.$_childMenuItem->target.'">'.$_childMenuItem->title.'</a></li>';
                                }
                                echo '</ul>';
                            }
                            /* Level 3rd */

                            echo '</li>';
                        }
                        echo '</ul>';
                    }

                    echo '</li>';
                }
            }
            ?>
        </ul>

        <?php if(get_theme_mod('cacoon_header_search','1') == '1'): ?>
            <div class="pull-right met_bgcolor met_menu_search_wrapper">
                <form class="met_menu_search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" name="s" class="met_menu_search_text" required="" placeholder="Search">
                    <div class="met_menu_search_submit"><i class="icon-search"></i></div>
                </form>
            </div>
        <?php endif; ?>

    </nav><!-- Menu Ends  -->