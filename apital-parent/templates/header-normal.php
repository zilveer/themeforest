<div class="w-nav normal-header" id="myaffix" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">

    <div class="w-container">
        <?php if(defined('FW')): ?>
            <?php fw_theme_type_logo();?>
        <?php endif;?>

        <nav class="nav-menu">
            <?php
            if(defined('FW'))
            {
                //display menu
                fw_theme_nav_menu('primary');
                //display search bar
                get_template_part('templates/menu', 'search' );
            }
            else
            {
                $menus = array(
                    'primary' => array(
                        'depth'           => 3,
                        'container'       => '',
                        'container_id'    => '',
                        'container_class' => '',
                        'menu_class'      => 'navigation-list',
                        'theme_location'  => 'primary',
                        'fallback_cb'     => 'fw_theme_select_menu_message',
                        'link_before'     => '',
                        'link_after'      => ''
                    )
                );
                wp_nav_menu($menus['primary']);
            }
            ?>

        </nav>
        <div class="w-nav-button hamburger">
            <div class="w-icon-nav-menu"></div>
        </div>
    </div>
</div>
